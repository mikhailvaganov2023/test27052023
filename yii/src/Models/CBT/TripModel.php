<?php

namespace App\Models\CBT;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

class TripModel extends ActiveRecord
{
    public static function getDb()
    {
        return \Yii::$app->cbt;
    }

    public static function tableName()
    {
        return '{{trip}}';
    }
}
