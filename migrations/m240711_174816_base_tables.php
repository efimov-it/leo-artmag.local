<?php

use yii\db\Migration;

/**
 * Class m240711_174816_base_tables
 */
class m240711_174816_base_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Категория 1ый уровень
        $this->createTable('{{%category_l1}}', [
            'id'        => $this->primaryKey(),
            'title'     => $this->string(150)->notNull(),
            'permalink' => $this->string(150)->notNull(),
            'img'       => $this->string(255)->notNull(),
            'icon'      => $this->string(255)->notNull(),
            'lang_key'  => $this->string(2)->notNull(),
            'main_id'   => $this->integer()->notNull(),
        ]);
        
        // Категория 2ой уровень
        $this->createTable('{{%category_l2}}', [
            'id'        => $this->primaryKey(),
            'title'     => $this->string(150)->notNull(),
            'permalink' => $this->string(150)->notNull(),
            'img'       => $this->string(255)->notNull(),
            'parent_id' => $this->integer()->notNull(),
            'lang_key'  => $this->string(2)->notNull(),
            'main_id'   => $this->integer()->notNull(),
        ]);
        $this->addForeignKey('cat_l2', '{{%category_l2}}', ['parent_id'], '{{%category_l1}}', ['id']);
        
        // Категория 3ий уровень
        $this->createTable('{{%category_l3}}', [
            'id'        => $this->primaryKey(),
            'title'     => $this->string(150)->notNull(),
            'permalink' => $this->string(150)->notNull(),
            'parent_id' => $this->integer()->notNull(),
            'lang_key'  => $this->string(2)->notNull(),
            'main_id'   => $this->integer()->notNull(),
        ]);
        $this->addForeignKey('cat_l3', '{{%category_l3}}', ['parent_id'], '{{%category_l2}}', ['id']);

        // Бренды
        $this->createTable('{{%brands}}', [
            'id'          => $this->primaryKey(),
            'name'        => $this->string(150)->notNull(),
            'permalink'   => $this->string(150)->notNull()->unique(),
            'logo'        => $this->string(255)->notNull(),
            'description' => $this->text(),
            'lang_key'    => $this->string(2)->notNull(),
            'main_id'     => $this->integer()->notNull(),
        ]);
        

        // Товары

        // Группа товаров
        $this->createTable('{{%goods_group}}', [
            'id'      => $this->primaryKey(),
            'name'    => $this->string()->notNull(),
            'preview' => $this->string(255),
        ]);

        // Товар
        $this->createTable('{{%goods}}', [
            'id'             => $this->primaryKey(),
            'name'           => $this->text()->notNull(),
            'permalink'      => $this->text()->notNull(),
            'description'    => $this->string(),
            'price'          => $this->float()->notNull(),
            'discount'       => $this->integer(),
            'old_price'      => $this->float(),
            'category_l1_id' => $this->integer()->notNull(),
            'category_l2_id' => $this->integer()->notNull(),
            'category_l3_id' => $this->integer(),
            'brand_id'       => $this->integer()->notNull(),
            'group_id'       => $this->integer(),
            'lang_key'       => $this->string(2)->notNull(),
            'main_id'        => $this->integer()->notNull(),
        ]);
        $this->addForeignKey('good_brand', '{{%goods}}', ['brand_id'], '{{%brands}}', ['id']);
        $this->addForeignKey('good_cat_l1', '{{%goods}}', ['category_l1_id'], '{{%category_l1}}', ['id']);
        $this->addForeignKey('good_cat_l2', '{{%goods}}', ['category_l2_id'], '{{%category_l2}}', ['id']);
        $this->addForeignKey('good_cat_l3', '{{%goods}}', ['category_l3_id'], '{{%category_l3}}', ['id']);
        $this->addForeignKey('good_group', '{{%goods}}', ['group_id'], '{{%goods_group}}', ['id']);

        // Фото товара
        $this->createTable('{{%goods_images}}', [
            'id'      => $this->primaryKey(),
            'url'     => $this->string(255)->notNull(),
            'good_id' => $this->integer()->notNull()
        ]);
        $this->addForeignKey('good_image', '{{%goods_images}}', ['good_id'], '{{%goods}}', ['id']);


        // Характеристики
        $this->createTable('{{%characteristics}}', [
            'id'       => $this->primaryKey(),
            'name'     => $this->string(255)->notNull(),
            'type'     => $this->string(255)->notNull(),
            'unit'     => $this->string(255)->notNull(),
            'lang_key' => $this->string(2)->notNull(),
            'main_id'  => $this->integer()->notNull(),
        ]);

        // Характеристики товаров
        $this->createTable('{{%characteristics_goods}}', [
            'id'                 => $this->primaryKey(),
            'value'              => $this->string(255)->notNull(),
            'color'              => $this->string(30),
            'good_group_id'            => $this->integer()->notNull(),
            'characteristic_id'  => $this->integer()->notNull(),
            'lang_key'           => $this->string(2)->notNull(),
            'main_id'            => $this->integer()->notNull(),
        ]);
        $this->addForeignKey('good_characteristic', '{{%characteristics_goods}}', ['good_group_id'], '{{%goods_group}}', ['id']);
        $this->addForeignKey('characteristic_good', '{{%characteristics_goods}}', ['characteristic_id'], '{{%characteristics}}', ['id']);


        // Баннеры
        $this->createTable('{{%banners}}', [
            'id'        => $this->primaryKey(),
            'title'     => $this->string(255)->notNull(),
            'text'      => $this->string(),
            'link_text' => $this->string(100),
            'link'      => $this->string()->notNull(),
            'image'     => $this->string(255)->notNull(),
            'place'     => $this->string(30)->notNull(),
            'global'    => $this->boolean()->notNull(),
            'active'    => $this->boolean()->notNull(),
            'lang_key'  => $this->string(2)->notNull(),
            'main_id'   => $this->integer()->notNull(),
        ]);

        // Связь баннеров с магазинами (региональные настройки)
        $this->createTable('{{%banners_stores}}', [
            'id'        => $this->primaryKey(),
            'banner_id' => $this->integer()->notNull(),
            'store_id'   => $this->integer()->notNull(),
        ]);
        $this->addForeignKey('banners_stores', '{{%banners_stores}}', ['banner_id'], '{{%banners}}', ['id']);
        $this->addForeignKey('stores_banners', '{{%banners_stores}}', ['store_id'], '{{%stores}}', ['id']);
        

        // Акции
        $this->createTable('{{%actions}}', [
            'id'          => $this->primaryKey(),
            'title'       => $this->string(255)->notNull(),
            'description' => $this->string(255),
            'contentHtml' => $this->string()->notNull(),
            'preview'     => $this->string(255)->notNull(),
            'dateCreated' => $this->timestamp()->notNull(),
            'dateStart'   => $this->timestamp(),
            'dateEnd'     => $this->timestamp(),
            'global'      => $this->boolean()->notNull(),
            'active'      => $this->boolean()->notNull(),
            'lang_key'    => $this->string(2)->notNull(),
            'main_id'     => $this->integer()->notNull(),
        ]);

        // Связь акций с магазинами (региональные настройки)
        $this->createTable('{{%actions_stores}}', [
            'id'        => $this->primaryKey(),
            'action_id' => $this->integer()->notNull(),
            'store_id'   => $this->integer()->notNull(),
        ]);
        $this->addForeignKey('actions_stores', '{{%actions_stores}}', ['action_id'], '{{%actions}}', ['id']);
        $this->addForeignKey('stores_actions', '{{%actions_stores}}', ['store_id'], '{{%stores}}', ['id']);


        // Информационные страницы
        $this->createTable('{{%info_page}}', [
            'id'          => $this->primaryKey(),
            'title'       => $this->string(255)->notNull(),
            'contentHtml' => $this->string()->notNull(),
            'permalink'   => $this->string(255)->notNull()->unique(),
            'lang_key'    => $this->string(2)->notNull(),
            'main_id'     => $this->integer()->notNull(),
        ]);


        // Заказы
        $this->createTable('{{%orders}}', [
            'id'                => $this->primaryKey(),
            'number'            => $this->string(20)->notNull(),
            'paymentMethod'     => $this->string(10)->notNull(),
            'paymentStatus'     => $this->string(10)->notNull(),
            'deliveryMethod'    => $this->string(10)->notNull(),
            'shop_id'           => $this->integer()->notNull(),
            'address'           => $this->string(),
            'floor'             => $this->integer(),
            'entrance'          => $this->integer(),
            'apartment'         => $this->integer(),
            'intercom'          => $this->integer(),
            'comment'           => $this->string(),
            'recipientName'     => $this->string(255)->notNull(),
            'recipientSurname'  => $this->string(255)->notNull(),
            'recipientPhone'    => $this->string(15)->notNull(),
            'recipientEmail'    => $this->string(100)->notNull(),
            'amount'            => $this->float()->notNull(),
            'dicount'           => $this->float(),
            'deliveryCost'      => $this->float(),
            'totalAmount'       => $this->float()->notNull(),
            'status'            => $this->string(30)->notNull(),
        ]);

        // Состав заказа
        $this->createTable('{{%orders_goods}}', [
            'id'       => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'good_id'  => $this->integer()->notNull(),
            'price'    => $this->float()->notNull(),
            'count'    => $this->integer()->notNull(),
        ]);
        $this->addForeignKey('orders_goods', '{{%orders_goods}}', ['order_id'], '{{%orders}}', ['id']);
        $this->addForeignKey('goods_orders', '{{%orders_goods}}', ['good_id'], '{{%goods}}', ['id']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Категория 1ый уровень
        $this->dropTable('{{%category_l1}}');
        
        // Категория 2ой уровень
        $this->dropTable('{{%category_l2}}');
        $this->dropForeignKey('cat_l2', '{{%category_l2}}');
        
        // Категория 3ий уровень
        $this->dropTable('{{%category_l3}}');
        $this->dropForeignKey('cat_l3', '{{%category_l3}}');

        // Бренды
        $this->dropTable('{{%brands}}');
        

        // Товары

        // Группа товаров
        $this->dropTable('{{%goods_group}}');

        // Товар
        $this->dropTable('{{%goods}}');
        $this->dropTable('good_brand');
        $this->dropTable('good_cat_l2');
        $this->dropTable('good_cat_l3');
        $this->dropTable('good_group');

        // Фото товара
        $this->dropTable('{{%goods_images}}');
        $this->dropForeignKey('good_image', '{{%goods_images}}');


        // Характеристики
        $this->dropTable('{{%characteristics}}');

        // Характеристики товаров
        $this->dropTable('{{%characteristics_goods}}');
        $this->dropForeignKey('good_characteristic', '{{%characteristics_goods}}');
        $this->dropForeignKey('characteristic_good', '{{%characteristics_goods}}');


        // Баннеры
        $this->dropTable('{{%banners}}');

        // Связь баннеров с магазинами (региональные настройки)
        $this->dropTable('{{%banners_stores}}');
        $this->dropForeignKey('banners_stores', '{{%banners_stores}}');
        $this->dropForeignKey('stores_banners', '{{%banners_stores}}');
        

        // Акции
        $this->dropTable('{{%actions}}');

        // Связь акций с магазинами (региональные настройки)
        $this->dropTable('{{%actions_stores}}');
        $this->dropForeignKey('actions_stores', '{{%actions_stores}}');
        $this->dropForeignKey('stores_actions', '{{%actions_stores}}');


        // Информационные страницы
        $this->dropTable('{{%info_page}}');


        // Заказы
        $this->dropTable('{{%orders}}');

        // Состав заказа
        $this->dropTable('{{%orders_goods}}');
        $this->dropForeignKey('orders_goods', '{{%orders_goods}}');
        $this->dropForeignKey('goods_orders', '{{%orders_goods}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240711_174816_base_tables cannot be reverted.\n";

        return false;
    }
    */
}
