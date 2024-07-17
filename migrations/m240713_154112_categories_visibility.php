<?php

use yii\db\Migration;

/**
 * Class m240713_154112_categories_visibility
 */
class m240713_154112_categories_visibility extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%category_l1}}', 'active', $this->boolean()->notNull()->defaultValue(1));
        $this->addColumn('{{%category_l1}}', 'visible', $this->boolean()->notNull()->defaultValue(1));
        
        $this->addColumn('{{%category_l2}}', 'active', $this->boolean()->notNull()->defaultValue(1));
        $this->addColumn('{{%category_l2}}', 'visible', $this->boolean()->notNull()->defaultValue(1));
        
        $this->addColumn('{{%category_l3}}', 'active', $this->boolean()->notNull()->defaultValue(1));
        $this->addColumn('{{%category_l3}}', 'visible', $this->boolean()->notNull()->defaultValue(1));
        
        $this->addColumn('{{%brands}}', 'active', $this->boolean()->notNull()->defaultValue(1));
        $this->addColumn('{{%brands}}', 'visible', $this->boolean()->notNull()->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%category_l1}}', 'active');
        $this->dropColumn('{{%category_l1}}', 'visible');
        
        $this->dropColumn('{{%category_l2}}', 'active');
        $this->dropColumn('{{%category_l2}}', 'visible');
        
        $this->dropColumn('{{%category_l3}}', 'active');
        $this->dropColumn('{{%category_l3}}', 'visible');
        
        $this->dropColumn('{{%brands}}', 'active');
        $this->dropColumn('{{%brands}}', 'visible');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240713_154112_categories_visibility cannot be reverted.\n";

        return false;
    }
    */
}
