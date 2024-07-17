<?php

use yii\db\Migration;

/**
 * Class m240711_214930_base_tables_add_refs
 */
class m240711_214930_base_tables_add_refs extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%category_l1}}', 'refs_id', $this->integer()->notNull());
        $this->addColumn('{{%category_l2}}', 'refs_id', $this->integer()->notNull());
        $this->addColumn('{{%category_l3}}', 'refs_id', $this->integer()->notNull());

        $this->addColumn('{{%brands}}', 'refs_id', $this->integer()->notNull());

        $this->addColumn('{{%goods_group}}', 'refs_id', $this->integer()->notNull());
        $this->addColumn('{{%goods}}', 'refs_id', $this->integer()->notNull());

        $this->addColumn('{{%characteristics}}', 'refs_id', $this->integer()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%category_l1}}', 'refs_id');
        $this->dropColumn('{{%category_l2}}', 'refs_id');
        $this->dropColumn('{{%category_l3}}', 'refs_id');

        $this->dropColumn('{{%brands}}', 'refs_id');
        
        $this->dropColumn('{{%goods_group}}', 'refs_id');
        $this->dropColumn('{{%goods}}', 'refs_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240711_214930_base_tables_add_refs cannot be reverted.\n";

        return false;
    }
    */
}
