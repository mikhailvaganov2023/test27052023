<?php

use yii\db\Migration;


/**
 * Class m230527_175019_foreigth
 */
class m230527_175019_foreigth  extends Migration
{

    public function init()
    {
        $this->db = 'cbt';
        parent::init();
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addForeignKey('ts_trip_id', 'trip_service', 'trip_id', 'trip', 'id');
        $this->addForeignKey('fs_fligth_id', 'fligth_segment', 'fligth_id', 'trip_service', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }
}
