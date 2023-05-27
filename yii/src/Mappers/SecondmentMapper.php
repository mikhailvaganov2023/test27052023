<?php

namespace App\Mappers;

use App\Models\CBT\FlightSegmentModel;
use App\Models\CBT\TripModel;
use App\Models\CBT\TripServiceModel;
use yii\base\Model;
use yii\db\Query;

class SecondmentMapper extends Model
{
    /**
     * @param array $criteria
     * @return Query
     */
    public static function GetQuery($criteria = [])
    {
        $query = (new Query())->select([
            'tr.*',
            'fly_s.depAirPortId'
        ])
            ->from(['tr' => TripModel::tableName()])
            ->innerJoin(['tr_s' => TripServiceModel::tableName()],'tr_s.trip_id = tr.id')
            ->innerJoin(['fly_s' => FlightSegmentModel::tableName()],'fly_s.flight_id = tr_s.id')
        ;

        if(array_key_exists('corporateId', $criteria)){
            $query->andWhere(['tr.corporate_id' => $criteria['corporateId']]);
        }

        if(array_key_exists('serviceId', $criteria)){
            $query->andWhere(['tr_s.service_id' => $criteria['serviceId']]);
        }

        return $query;
    }
}
