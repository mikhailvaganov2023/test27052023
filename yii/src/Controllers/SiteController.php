<?php

namespace App\Controllers;

use App\Models\CBT\TripModel;
use App\Models\NEMO_GUIDE_ETALON\AirportNameModel;
use App\Service\SecondmentService;
use App\Mappers\AirportNameMapper;
use App\Mappers\SecondmentMapper;
use Yii;
use App\Shared\Controller\ControllerBase;
use yii\data\ArrayDataProvider;


class SiteController extends ControllerBase
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        $request = Yii::$app->request;

        $coprorateId = $request->get('coprorateId');
        $serviceId = $request->get('serviceId');
        $airportId = $request->get('airportId');

        $query = SecondmentMapper::GetQuery(['corporateId' => $coprorateId, 'serviceId' => $serviceId]);

        $data = [];

        foreach ($query->batch(100, TripModel::getDb()) as $chunk) {
            $depAirportIds = array_map(function ($n){
                return $n['depAirPortId'] ? $n['depAirPortId'] : 0;
            }, $chunk);


            $criteria = ['depAirportIds' => $depAirportIds];
            if ($airportId){
                $criteria['id'] = $airportId;
            }
            $airPorts = AirportNameMapper::GetQuery($criteria)->all(AirportNameModel::getDb());

            $data += SecondmentService::compileData($chunk, $airPorts);
        }

        $dataProvider = new ArrayDataProvider([
            'allModels' => $data,
        ]);



        return $this->render('index', ['model' => $dataProvider]);
    }

}
