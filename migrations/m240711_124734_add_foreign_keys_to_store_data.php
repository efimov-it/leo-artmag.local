<?php

use yii\db\Migration;

/**
 * Class m240711_124734_add_foreign_keys_to_store_data
 */
class m240711_124734_add_foreign_keys_to_store_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%stores}}', 'city_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%stores_images}}', 'shop_id', $this->integer());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240711_124734_add_foreign_keys_to_store_data cannot be reverted.\n";

        return false;
    }
    */
}
