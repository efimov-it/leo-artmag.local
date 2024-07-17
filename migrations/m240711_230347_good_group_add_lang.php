<?php

use yii\db\Migration;

/**
 * Class m240711_230347_good_group_add_lang
 */
class m240711_230347_good_group_add_lang extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%goods_group}}', 'lang_key', $this->string(2)->notNull());
        $this->addColumn('{{%goods_group}}', 'main_id', $this->integer()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%goods_group}}', 'lang_key');
        $this->dropColumn('{{%goods_group}}', 'main_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240711_230347_good_group_add_lang cannot be reverted.\n";

        return false;
    }
    */
}
