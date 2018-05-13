<?php
namespace yii\cms\controllers;

use vova07\imperavi\actions\GetAction;
use Yii;
use yii\cms\helpers\Upload;
use yii\cms\models;
use yii\helpers\Url;

class RedactorController extends \yii\cms\components\Controller
{
    public function actions()
    {
        $uploadsUrl = Url::to(Upload::getPathUrl('redactor'), true);
        return [
            'image-upload' => [
                'class' => 'vova07\imperavi\actions\UploadAction',
                'url' => $uploadsUrl, // Directory URL address, where files are stored.
                'path' => '@uploads/redactor' // Or absolute path to directory where files are stored.
            ],
            'file-upload' => [
                'class' => 'vova07\imperavi\actions\UploadAction',
                'url' => $uploadsUrl, // Directory URL address, where files are stored.
                'path' => '@uploads/redactor' // Or absolute path to directory where files are stored.
            ],
            'images-get' => [
                'class' => 'vova07\imperavi\actions\GetAction',
                'url' => $uploadsUrl, // Directory URL address, where files are stored.
                'path' => '@uploads/redactor', // Or absolute path to directory where files are stored.
                'type' => GetAction::TYPE_IMAGES,
            ],
            'files-get' => [
                'class' => 'vova07\imperavi\actions\GetAction',
                'url' => $uploadsUrl, // Directory URL address, where files are stored.
                'path' => '@uploads/redactor', // Or absolute path to directory where files are stored.
                'type' => GetAction::TYPE_FILES,
            ]
        ];
    }
}