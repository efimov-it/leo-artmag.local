<?php

use yii\db\Migration;

/**
 * Class m240711_230650_alter_good_description
 */
class m240711_230650_alter_good_description extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%goods}}', 'description', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('{{%goods}}', 'description', $this->string());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240711_230650_alter_good_description cannot be reverted.\n";

        return false;
    }
    */
}
