<?php

namespace App\Service;

use App\Models\NEMO_GUIDE_ETALON\AirportNameModel;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\db\Query;

class SecondmentService extends Model
{
    /**
     * @param array $criteria
     * @return []
     */
    public static function compileData(array $a, array $b, string $keyA = 'depAirPortId', string $keyB = 'airport_id', $resultKey = 'depAirPort')
    {
        $bSort = $result = [];

        foreach ($b as $row){
            $bSort[$row[$keyB]] = $row;
        }

        foreach ($a as $key => $row){
            $result[$key] = $row;
            $result[$key][$resultKey] = array_key_exists($row[$keyA], $bSort) ? $bSort[$row[$keyA]]['value'] : null;
        }

        return $result;
    }
}
