<?php
namespace yii\cms\models;

class Tag extends \yii\cms\components\ActiveRecord
{
    public static function tableName()
    {
        return 'cms_tags';
    }

    public function rules()
    {
        return [
            ['name', 'required'],
            ['frequency', 'integer'],
            ['name', 'string', 'max' => 64],
        ];
    }
}