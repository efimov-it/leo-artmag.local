<?php

use yii\db\Migration;

/**
 * Class m240711_122542_add_store_table
 */
class m240711_122542_add_store_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%stores}}', [
            'id' => $this->primaryKey(),

            'name' => $this->string(255),
            'address' => $this->string(255),
            'shedule' => $this->string(),
            'phone' => $this->string(15),
            'email' => $this->string(100),
            'geo' => $this->string(30),
            'isOpened' => $this->boolean(),

            'lang_key' => $this->string(2),
            'main_id' => $this->integer(),
        ]);

        $this->createTable('{{%stores_images}}', [
            'id' => $this->primaryKey(),

            'name' => $this->string(255),
            'url' => $this->string(255),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%stores}}');
        $this->dropTable('{{%stores_images}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240711_122542_add_store_table cannot be reverted.\n";

        return false;
    }
    */
}
