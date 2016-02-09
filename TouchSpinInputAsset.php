<?php
namespace dowlatow\widgets;

use dowlatow\assets\WidgetGeneratorAsset;
use yii\web\AssetBundle;
use yii\widgets\MaskedInputAsset;

class TouchSpinInputAsset extends AssetBundle
{
    public $js = [
        'js' . DIRECTORY_SEPARATOR . 'touch-spin-input.js',
    ];

    public $css = [
        'css' . DIRECTORY_SEPARATOR . 'touch-spin-input.css',
    ];

    public $publishOptions = [
        'forceCopy' => true
    ];

    public function init()
    {
        parent::init();
        $this->sourcePath = __DIR__ . DIRECTORY_SEPARATOR . 'source';
        $this->depends[]  = WidgetGeneratorAsset::className();
        $this->depends[]  = MaskedInputAsset::className();
    }
}