<?php
namespace yii\cms\modules\faq\api;

use Yii;
use yii\cms\helpers\Data;
use yii\cms\modules\faq\FaqModule;
use yii\cms\modules\faq\models\Faq as FaqModel;


/**
 * FAQ module API
 * @package yii\cms\modules\faq\api
 *
 * @method static array items() list of all FAQ as FaqObject objects
 */

class Faq extends \yii\cms\components\API
{
    public function api_items($options = [])
    {
        $items = Data::cache(FaqModel::CACHE_KEY, 3600, function(){
            $items = [];

            $query = FaqModel::find()->select(['id', 'question', 'answer'])->status(FaqModel::STATUS_ON)->sort();
            if(FaqModule::setting('enableTags')){
                $query->with('tags');
            }

            foreach($query->all() as $item){
                $items[] = new FaqObject($item);
            }
            return $items;
        });

        if(!empty($options['tags'])){
            foreach($items as $i => $item){
                if(!in_array($options['tags'], $item->tags)){
                    unset($items[$i]);
                }
            }
        }

        return $items;
    }
}