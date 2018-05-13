<?php
namespace yii\cms\helpers;

use Yii;
use yii\cms\models\Module;

class MigrationHelper
{
    public static  function appendModuleSettings($moduleName, $settings)
    {
        if(($module = Module::findOne(['name' => $moduleName])))
        {
            $module->settings = array_merge($module->settings, $settings);
            $module->save();
        }
    }
}