<?php

use yii\db\Schema;
use yii\cms\models;
use \yii\cms\modules\content\modules\contentElements\models\ElementOption;
use yii\cms\modules\menu\models\Menu;

class m000009_200004_update extends \yii\db\Migration
{
    public $engine = 'ENGINE=MyISAM DEFAULT CHARSET=utf8';
    
    public function up()
    {
		$this->alterColumn(yii\cms\modules\catalog\models\Category::tableName(),'description', $this->text());
		$this->alterColumn(yii\cms\modules\article\models\Category::tableName(),'description', $this->text());
		$this->alterColumn(yii\cms\modules\gallery\models\Category::tableName(),'description', $this->text());
		$this->alterColumn(yii\cms\modules\entity\models\Category::tableName(),'description', $this->text());
	}

    public function down()
    {
    }
}
