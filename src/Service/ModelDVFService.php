<?php

namespace App\Service;

use Rubix\ML\Datasets\Unlabeled;
use Rubix\ML\Loggers\Logger;
use Rubix\ML\PersistentModel;
use Rubix\ML\Persisters\Filesystem;

/**
 * Modèle ML pour le traitement de donnée DVF françaises
 */
class ModelDVFService
{
    const DIR_MODELS  = __DIR__ . '/saved_models';
    private ?PersistentModel $estimator = null;

    private string $filename = 'dvf_model_84.rbx' ;

    function loadSavedModel()
    {
        $this->estimator = PersistentModel::load(new Filesystem(self::DIR_MODELS . '/' . $this->filename));
    }

    function predict(array $datas): float
    {
        $dataset = new Unlabeled([$datas]);
        $predictions = $this->estimator->predict($dataset);

        return round($predictions[0], 2);
    }
}