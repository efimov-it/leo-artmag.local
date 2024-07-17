<?php

use yii\db\Migration;

/**
 * Class m240714_004259_goods_update
 */
class m240714_004259_goods_update extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%goods}}', 'last_update', $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%goods}}', 'last_update');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240714_004259_goods_update cannot be reverted.\n";

        return false;
    }
    */
}
