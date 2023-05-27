<?php

namespace App\Mappers;

use App\Models\NEMO_GUIDE_ETALON\AirportNameModel;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\db\Query;

class AirportNameMapper extends Model
{
    /**
     * @param array $criteria
     * @return Query
     */
    public static function GetQuery($criteria = [])
    {
        $query = (new Query())->select([
            'air.*',
        ])
            ->from(['air' => AirportNameModel::tableName()])
            ->andWhere(array('in', 'air.airport_id', $criteria['depAirportIds']))
        ;

        if (array_key_exists('id', $criteria)){
            $query->andWhere(['air.id' => $criteria['id']]);
        }

        return $query;
    }
}
