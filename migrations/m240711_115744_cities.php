<?php

use yii\db\Migration;

/**
 * Class m240711_115744_cities
 */
class m240711_115744_cities extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cities}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'geo' => $this->string(30)->notNull(),
            'lang_key' => $this->string(2)->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cities}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240711_115744_cities cannot be reverted.\n";

        return false;
    }
    */
}
