<?php

use yii\db\Migration;

/**
 * Class m240711_220908_base_tables_alter_refs
 */
class m240711_220908_base_tables_alter_refs extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%category_l1}}', 'refs_id', $this->bigInteger()->notNull());
        $this->alterColumn('{{%category_l2}}', 'refs_id', $this->bigInteger()->notNull());
        $this->alterColumn('{{%category_l3}}', 'refs_id', $this->bigInteger()->notNull());

        $this->alterColumn('{{%brands}}', 'refs_id', $this->bigInteger()->notNull());

        $this->alterColumn('{{%goods_group}}', 'refs_id', $this->bigInteger()->notNull());
        $this->alterColumn('{{%goods}}', 'refs_id', $this->bigInteger()->notNull());

        $this->alterColumn('{{%characteristics}}', 'refs_id', $this->bigInteger()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('{{%category_l1}}', 'refs_id', $this->integer()->notNull());
        $this->alterColumn('{{%category_l2}}', 'refs_id', $this->integer()->notNull());
        $this->alterColumn('{{%category_l3}}', 'refs_id', $this->integer()->notNull());

        $this->alterColumn('{{%brands}}', 'refs_id', $this->integer()->notNull());

        $this->alterColumn('{{%goods_group}}', 'refs_id', $this->integer()->notNull());
        $this->alterColumn('{{%goods}}', 'refs_id', $this->integer()->notNull());

        $this->alterColumn('{{%characteristics}}', 'refs_id', $this->integer()->notNull());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240711_220908_base_tables_alter_refs cannot be reverted.\n";

        return false;
    }
    */
}
