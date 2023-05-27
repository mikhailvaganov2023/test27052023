<?php

use yii\db\Migration;

/**
 * Class m230527_180905_nemoGuideEtalon_index
 */
class m230527_180905_nemoGuideEtalon_index extends Migration
{

    public function init()
    {
        $this->db = 'nemoGuideEtalon';
        parent::init();
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex('idx_air_airport_id', 'airport_name', 'airport_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }
}
