<?php

use yii\db\Migration;

/**
 * Class m240711_153632_alter_stores_images_columns
 */
class m240711_153632_alter_stores_images_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%stores_images}}', 'name');
        $this->addColumn('{{%stores_images}}', 'store_id', $this->integer()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%stores_images}}', 'name', $this->string(255));
        $this->dropColumn('{{%stores_images}}', 'store_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240711_153632_alter_stores_images_columns cannot be reverted.\n";

        return false;
    }
    */
}
