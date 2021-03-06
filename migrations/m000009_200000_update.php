<?php
use yii\cms\helpers\Data;
use yii\cms\helpers\MigrationHelper;
use yii\cms\models;
use yii\cms\models\Setting;
use yii\cms\modules\entity;
use yii\cms\modules\catalog;
use yii\cms\modules\page\models\Page;
use yii\cms\modules\shopcart;
use yii\cms\modules\file;
use yii\cms\modules\article;
use yii\cms\modules\carousel\models\Carousel;
use yii\cms\modules\gallery;
use yii\cms\modules\news\models\News;
use yii\cms\modules\entity\EntityModule;

class m000009_200000_update extends \yii\db\Migration
{
    const VERSION = 0.92;

    public $engine = 'ENGINE=MyISAM DEFAULT CHARSET=utf8';
    
    public function up()
    {
        $this->addColumn(Page::tableName(), 'show_in_menu', $this->boolean()->defaultValue(0));
        $this->addColumn(Page::tableName(), 'fields', $this->text());
        $this->addColumn(Page::tableName(), 'data', $this->text());
        $this->addColumn(Page::tableName(), 'tree', $this->integer()->defaultValue(0));
        $this->addColumn(Page::tableName(), 'lft', $this->integer()->defaultValue(0));
        $this->addColumn(Page::tableName(), 'rgt', $this->integer()->defaultValue(0));
        $this->addColumn(Page::tableName(), 'depth', $this->integer()->defaultValue(0));
        $this->addColumn(Page::tableName(), 'order_num', $this->integer()->defaultValue(0));
        $this->addColumn(Page::tableName(), 'status', $this->boolean()->defaultValue(1));

        $i = 1;
        foreach(Page::find()->all() as $page) {
            $page->tree = $i;
            $page->lft = 1;
            $page->rgt = 2;
            $page->order_num = $i++;
            $page->update(false, ['tree', 'lft', 'rgt', 'order_num']);
        }

        MigrationHelper::appendModuleSettings('page', [
            'slugImmutable' => true,
        ]);
        MigrationHelper::appendModuleSettings('page', [
            'defaultFields' => '[]',
        ]);
    }

    public function down()
    {
        $this->dropColumn(Page::tableName(), 'fields');
        $this->dropColumn(Page::tableName(), 'data');
        $this->dropColumn(Page::tableName(), 'tree');
        $this->dropColumn(Page::tableName(), 'lft');
        $this->dropColumn(Page::tableName(), 'rgt');
        $this->dropColumn(Page::tableName(), 'depth');
        $this->dropColumn(Page::tableName(), 'order_num');
        $this->dropColumn(Page::tableName(), 'status');
    }
}
