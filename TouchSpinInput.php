<?php
namespace dowlatow\widgets;

use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\MaskedInput;

class TouchSpinInput extends MaskedInput
{
    /** @var int */
    public $min = 0;

    /** @var int */
    public $max = 999;

    /** @var int */
    public $default = 100;

    /** @var string */
    public $wrapperOptions;

    public function run()
    {
        $this->registerClientScript();

        Html::addCssClass($this->wrapperOptions, 'input-touchspin');

        echo Html::beginTag('div', $this->wrapperOptions);

        if ($this->hasModel()) {
            if ($this->default !== false) {
                $value = $this->model->{$this->attribute};
                if (!is_numeric($value) || $value < $this->min || $value > $this->max) {
                    $this->model->{$this->attribute} = $this->default;
                }
            }
            echo Html::activeInput($this->type, $this->model, $this->attribute, $this->options);
        } else {
            if ($this->default !== false) {
                if (!is_numeric($this->value) || $this->value < $this->min || $this->value > $this->max) {
                    $this->value = $this->default;
                }
            }
            echo Html::input($this->type, $this->name, $this->value, $this->options);
        }

        echo Html::tag('div', null, ['class' => 'caret step-up']);
        echo Html::tag('div', null, ['class' => 'caret step-down']);

        echo Html::endTag('div');
    }

    public function init()
    {
        $this->mask = '9{*}';
        parent::init();
    }

    public function registerClientScript()
    {
        $this->registerAsset();
        $this->getView()->registerJs($this->getInitScript());
    }

    public function registerAsset()
    {
        TouchSpinInputAsset::register($this->getView());
    }

    public function getInitScript()
    {

        $js = '';
        $this->initClientOptions();
        if (!empty($this->mask)) {
            $this->clientOptions['mask'] = $this->mask;
        }
        $this->hashPluginOptions($this->getView());
        if (is_array($this->definitions) && !empty($this->definitions)) {
            $js .= '$.extend($.' . self::PLUGIN_NAME . '.defaults.definitions, ' . Json::htmlEncode($this->definitions) . ");\n";
        }
        if (is_array($this->aliases) && !empty($this->aliases)) {
            $js .= '$.extend($.' . self::PLUGIN_NAME . '.defaults.aliases, ' . Json::htmlEncode($this->aliases) . ");\n";
        }
        $id = $this->options['id'];
        $js .= '$("#' . $id . '").' . self::PLUGIN_NAME . "(" . $this->_hashVar . ");\n";

        $js .= '$("#' . $this->options['id'] . '").touchSpinInput({
            minValue: ' . $this->min . ',
            maxValue: ' . $this->max . '
        });' . "\n";

        return $js;
    }
}