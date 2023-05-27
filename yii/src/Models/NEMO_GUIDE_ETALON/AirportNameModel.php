<?php

namespace App\Models\NEMO_GUIDE_ETALON;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

class AirportNameModel extends ActiveRecord
{
    public static function getDb()
    {
        return \Yii::$app->nemoGuideEtalon;
    }

    public static function tableName()
    {
        return '{{airport_name}}';
    }
}
