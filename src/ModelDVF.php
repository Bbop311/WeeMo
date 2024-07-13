<?php 
namespace LaPasserelle\ModelsML;

use PDO;
use Rubix\ML\Datasets\Labeled;
use Rubix\ML\Datasets\Unlabeled;
use Rubix\ML\Extractors\CSV;
use Rubix\ML\Loggers\Logger;
use Rubix\ML\Loggers\Screen;
use Rubix\ML\PersistentModel;
use Rubix\ML\Persisters\Filesystem;
use Rubix\ML\Regressors\GradientBoost;
use Rubix\ML\Regressors\RegressionTree;
use Rubix\ML\Transformers\MissingDataImputer;
use Rubix\ML\Transformers\NumericStringConverter;
use stdClass;

/**
 * Modèle ML pour le traitement de donnée DVF françaises
 */
class ModelDVF {

    ////////////////////////////////////////////////////////////
    ////////// CONFIGURATION GÉNÉRALE DU PROGRAMME /////////////
    ////////////////////////////////////////////////////////////

    // LES COLONNES UTILISÉES POUR L'ENTRAÎNEMENT
    const TRAINING_COLUMNS      = ['type_voie', 'code_postal', 'type_local', 'surface_reelle_bati', 'nb_pieces', 'surface_terrain']; 
    // COLONNE À PRÉDIRE
    const COLUMN_TO_PREDICT     = 'valeur_fonciere';
    // TABLE SQL DANS LAQUELLE ALLER CHERCHER LES DATAS
    const SQL_TABLENAME         = 'paris_valeur_fonciere';
    // DOSSIER DE DESTINATION DES MODÈLES SAUVEGARDÉS
    const DIR_MODELS            = 'saved_models';
    // PRÉFIX À AJOUTER AUX NOMS DES MODÈLES LORS D'UN RENNOMAGE
    const MODEL_NAME_PREFIX     = 'dvf';    

    // CONNEXION À LA BDD
    private ?PDO $pdo               = null;    
    // LOGGER POUR AFFICHAGE DE MESSAGES DANS LE TERMINAL
    private ?Logger $logger         = null;
    // NOM DU FICHIER DE SAUVEGARDE DU MODÈLE
    private string $filename        = 'model.rbx';
    // NOM DU FICHIER DE SAUVEGARDE DE LA PROGRESSION
    private string $CSVFilename     = 'model_progress.csv';
    // MODÈLE ACTUELLEMENT CHARGÉ
    private ?PersistentModel $estimator = null;

    /**
     * Crée le modèle ML 
     *
     * @param PDO $pdo Connexion à la BDD
     */
   
    public function __construct(PDO $pdo){

        // RÉCUPÉRATION DE LA CONNEXION À LA BDD
        $this->pdo = $pdo;

        // CRÉATION DU LOGGER POUR AFFICHER DES MESSAGES DANS LE TERMINAL
        $this->logger = new Screen();
        $this->logger->info('Initialisation du modèle');

        // PRÉCUATION POUR NE PAS ÊTRE LIMITÉ EN MÉMOIRE
        ini_set('memory_limit', '-1');

        // VÉRIFICATION DU DOSSIER DE DESTINATION
        if(!is_dir(self::DIR_MODELS))
            mkdir(self::DIR_MODELS);
    }
    
    /**
     * Lance l'entraînement du modèle
     *
     * @param string $filename Nom de fichier de sauvegarde du modèle à enregistrer après l'entraînement
     * @param integer $nbTrainingDatas Nombre de données à utiliser pour l'entraînement
     * @return void
     */
    function train(string $filename = 'model.rbx', int $nbTrainingDatas = 2000) {
        
        // RÉCUPÉRATION DU NOM DU FICHIER DE SAUVEGARDE DU MODÈLE            
        $this->filename = pathinfo($filename, PATHINFO_EXTENSION) == 'rbx' ? $filename : $filename . '.rbx';

        // CRÉATION DU SQL D'EXTRACTION DES DONNÉES D'ENTRAÎNEMENT
        $SQL_training = 'SELECT ' .  implode(',', self::TRAINING_COLUMNS) . ',' . self::COLUMN_TO_PREDICT . ' FROM ' . self::SQL_TABLENAME .' ORDER BY RAND() LIMIT ' . $nbTrainingDatas;
        
        // ÉXÉCUTION DU SQL D'ENTRAÎNEMENT
        $this->logger->info('Chargement des données en mémoire');
        $query = $this->pdo->prepare($SQL_training);
        $query->execute();
        $samples = $query->fetchAll(PDO::FETCH_NUM);
        $this->logger->info('Chargement terminé');
    
        // GÉNÉRATION DU DATASET À PARTIR DES DONNÉES EXTRAITES
        $dataset = Labeled::fromIterator($samples);
    
        // FORMATAGE DU DATASET
        $dataset->apply(new NumericStringConverter())
            ->apply(new MissingDataImputer())
            ->transformLabels('intval');
    
        // CRÉATION DU MODÈLE DE MACHINE LEARNING DE TYPE GRADIENT BOOST
        $estimator = new PersistentModel(
            new GradientBoost(new RegressionTree(7), 0.1, 0.8, 1000, 10000, 10, 0.1),
            new Filesystem(self::DIR_MODELS . '/' . $this->filename, true)
        );
        $estimator->setLogger($this->logger);
    
        // ENTRAINEMENT DE L'ALGORITHME DE MACHINE LEARNING
        $this->logger->info('Début de l\'entraînement');
        $estimator->train($dataset);
        $this->logger->info('Entraînement terminé');

        // SAUVEGARDE (TEMPORAIRE) DU MODÈLE
        $estimator->save();
        $this->logger->info("Modèle sauvegardée en tant que $this->filename");

        // ENREGISTREMENT DE LA PROGRESSION DE L'APPRENTISSAGE DANS UN FICHIER CSV
        $this->CSVFilename = self::DIR_MODELS . '/' . str_replace('.rbx', '_progress.csv', $this->filename);
        $extractor = new CSV($this->CSVFilename, true);
        $extractor->export($estimator->steps());
        $this->logger->info("Progression sauvegardée dans $this->CSVFilename");
    }


    /**
     * Lance des tests de validation sur un modèle pré-entrainé
     *
     * @param string $savedModelFilename Nom du fichier du modèle rbx pré-entrainé
     * @param integer $nbValidationDatas Nombre de données à utiliser pour la validation
     * @param integer $iterations Nombre d'itérations des tests pour une plus fiabilité du calcul de la précision
     * @param bool $rename True pour renommer le fichier de modèle en fonction du score obtenu
     * @return void
     */
    function validate(string $savedModelFilename = "model.rbx", int $nbValidationDatas = 100, int $iterations = 1, bool $rename = false) {
        
        // VÉRIFICATION DE L'EXISTANE DU FICHIER DE MODÈLE
        if(!file_exists(self::DIR_MODELS . '/' . $savedModelFilename)) {
            $this->logger->error('Impossible de valider le modèle : fichier ' . self::DIR_MODELS . '/' . $savedModelFilename . ' non trouvé.');
            return;
        }
        
        $totalAccuracy = 0;
        for ($iter=0; $iter < $iterations; $iter++) {
            // CRÉATION DU SQL D'EXTRACTION DES DONNÉES D'ENTRAÎNEMENT
            $SQL_validation = 'SELECT ' .  implode(',', self::TRAINING_COLUMNS) . ',' . self::COLUMN_TO_PREDICT . ' FROM ' . self::SQL_TABLENAME .' ORDER BY RAND() LIMIT ' . $nbValidationDatas;

            // ÉXÉCUTION DU SQL DE RÉCUPÉRATION DES DONNÉES DE VALIDATION
            $this->logger->info("Chargement de nouvelles données de validation ($nbValidationDatas)");
            $query = $this->pdo->prepare($SQL_validation);
            $query->execute();
            $testsDatas = $query->fetchAll(PDO::FETCH_NUM);
            $this->logger->info('Données chargées');

            // RÉCUPÉRATION DES COLONNES NÉCESSAIRE (SANS LA VALEUR À PRÉDIRE)
            $samples = $testsDatas;
            array_walk($samples, function (&$data) {
                unset($data[count($data) -1]);
            });

            // CRÉATION ET FORMATAGE DU DATASET
            $dataset = Unlabeled::fromIterator($samples)->apply(new NumericStringConverter());

            // CHARGEMENT DU MODÈLE DE MACHINE LEARNING
            $estimator = PersistentModel::load(new Filesystem(self::DIR_MODELS . '/' . $savedModelFilename));

            // PRÉDICTIONS
            $this->logger->info('Prédictions en cours');
            $predictions = $estimator->predict($dataset);

            // RÉCUPÉRATION DES VALEURS ATTENDUES
            $wanted=[];
            foreach ($testsDatas as $data) {
                $wanted[] = $data[count($data) -1];
            }

            // CALCUL DE LA PRÉCISION DE CHAQUE PRÉDICTION
            $accuracies = [];
            $total = 0;
            for ($i = 0; $i < $nbValidationDatas; $i++){
                $accuracy = $wanted[$i]  / $predictions[$i];
                $accuracy = $accuracy > 1 ? 1 - ($accuracy-1) : $accuracy;
                $total += $accuracy;
                $accuracies[] = $accuracy;
            }

            // CALCUL DE LA PRÉCISION MOYENNE
            $accuracy = floor($total / count($accuracies) *100);

            // CRÉATION DU RAPPORT
            $rapport = [];
            for ($i = 0; $i < $nbValidationDatas; $i++){
                $obj                = new stdClass;
                $obj->wanted        = $wanted[$i];
                $obj->prediction    = $predictions[$i];
                $obj->accuracy      = $accuracies[$i];
                $rapport[$i]        = $obj;
            }

            // AJOUT  À LA PRÉCISION TOTAL DE TOUTES LES ITÉRATIONS
            $totalAccuracy += $accuracy;
        }

        // CALCUL DU SCORE MOYEN SUR TOUTES LES ITÉRATIONS
        $accuracy = floor($totalAccuracy / $iterations);

        $this->logger->info("Précision moyenne : " . $accuracy);

        // RENNOMAGE DU MODÈLE SELON RÉSULTAT OBTENU
        if ($rename) {
            rename(self::DIR_MODELS . '/' . $savedModelFilename, self::DIR_MODELS . '/' . self::MODEL_NAME_PREFIX .'_model_'. $accuracy .'.rbx');
            rename(self::DIR_MODELS . '/' .str_replace('.rbx', '_progress.csv',  $savedModelFilename), self::DIR_MODELS .  '/' . self::MODEL_NAME_PREFIX .'_model_'. $accuracy .'.csv');
        }

        // ENREGISTREMENT DU RAPPORT
        file_put_contents(self::DIR_MODELS .  '/' . self::MODEL_NAME_PREFIX .'_model_'. $accuracy .'.json', json_encode($rapport, JSON_PRETTY_PRINT));
    }


    /**
     * Charge le fichier de modèle spécifié
     *
     * @param string $filename Nom du fichier de sauvegarde du modèle
     * @return void
     */
    function loadSavedModel(string $filename){
        $this->estimator = PersistentModel::load(new Filesystem(self::DIR_MODELS . '/' . $filename));
        $this->logger->info("Modèle $filename chargé");
    }

    /**
     * Lance une prédiction à partir des données fournies
     *
     * @param array $datas Données à utiliser pour la prédiction
     * @return float Projection obtenue
     */
    function predict(array $datas):float {

        // GÉNÈRE UN DATASET
        $dataset = new Unlabeled([$datas]);

        // lance la prédiction
        $this->logger->info('Prédictions en cours');
        $predictions = $this->estimator->predict($dataset);

        return round($predictions[0], 2);
    }
}