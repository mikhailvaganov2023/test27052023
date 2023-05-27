<?php

use yii\db\Migration;

/**
 * Class m230527_180855_cbr_index
 */
class m230527_180855_cbr_index extends Migration
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
        $this->createIndex('idx_ts_trip_id', 'trip_service', 'trip_id');
        $this->createIndex('idx_fs_fligth_id', 'fligth_segment', 'fligth_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }
}
