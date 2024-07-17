<?php

use yii\db\Migration;

/**
 * Class m240711_120723_add_field_main_id_to_cities
 */
class m240711_120723_add_field_main_id_to_cities extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%cities}}', 'main_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%cities}}', 'main_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240711_120723_add_field_main_id_to_cities cannot be reverted.\n";

        return false;
    }
    */
}
