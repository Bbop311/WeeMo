<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once './lib/database.php';

use LaPasserelle\ModelsML\ModelDVF;

// CRÉE LE MODÈLE À ENTRAINER
$model = new ModelDVF(dbConnect());

// CHARGE LE MODÈLE SAUVEGARDÉ
$model->loadSavedModel('dvf_model_84.rbx');

// LANCE UNE PRÉDICTION AVEC type de voie, cp, type logement, superficie, nb pièces, superficie terrain
$value = $model->predict(['RUE', '75020', 'Appartement', 60, 3, 0]);

// AFFICHE LA PRÉVISION
echo "Notre I.A. a estimé votre bien à $value euros (attendu 600 000)\n";


