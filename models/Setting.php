<?php
namespace yii\cms\models;

use Yii;

use yii\cms\helpers\Data;
use yii\cms\behaviors\CacheFlush;

class Setting extends \yii\cms\components\ActiveRecord
{
    const VISIBLE_NONE = 0;
    const VISIBLE_ROOT = 1;
    const VISIBLE_ALL = 2;

    const CACHE_KEY = 'cms_settings';

    static $_data;

    public static function tableName()
    {
        return 'cms_settings';
    }

    public function rules()
    {
        return [
            [['name', 'title', 'value'], 'required'],
            [['name', 'title', 'value'], 'trim'],
            ['name',  'match', 'pattern' => '/^[a-zA-Z][\w_-]*$/'],
            ['name', 'unique'],
            ['visibility', 'number', 'integerOnly' => true]
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => Yii::t('cms', 'Name'),
            'title' => Yii::t('cms', 'Title'),
            'value' => Yii::t('cms', 'Value'),
            'visibility' => Yii::t('cms', 'Only for developer')
        ];
    }

    public function behaviors()
    {
        return [
            CacheFlush::className()
        ];
    }

    public static function get($name)
    {
        if(!self::$_data){
            self::$_data =  Data::cache(self::CACHE_KEY, 3600, function(){
                $result = [];
                try {
                    foreach (parent::find()->all() as $setting) {
                        $result[$setting->name] = $setting->value;
                    }
                }catch(\yii\db\Exception $e){}
                return $result;
            });
        }
        return isset(self::$_data[$name]) ? self::$_data[$name] : null;
    }

    public static function getAsArray($name)
    {
        $result = [];
        $value = self::get($name);
        if($value) {
            foreach(explode(',', $value) as $item){
                $result[] = trim($item);
            }
            $result = array_filter($result);
        }
        return $result;
    }

    public static function set($name, $value)
    {
        if(self::get($name)){
            $setting = Setting::find()->where(['name' => $name])->one();
            $setting->value = $value;
        } else {
            $setting = new Setting([
                'name' => $name,
                'value' => $value,
                'title' => $name,
                'visibility' => self::VISIBLE_NONE
            ]);
        }
        $setting->save();
    }
}