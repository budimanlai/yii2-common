<?php
namespace budimanlai\helpers;

class Html extends \yii\helpers\Html {
    
    public static function activeStaticField($model, $attribute, $options) {

        $value = isset($options['value']) ? $options['value'] : static::getAttributeValue($model, $attribute);
        if (!array_key_exists('id', $options)) {
            $options['id'] = static::getInputId($model, $attribute);
        }
        
        if (empty($value)) {
            $value = "<i>Not set</i>";
        }
        
        return Html::beginTag('p', array_merge([
            'class' => 'form-control-static'
        ], $options)).$value.Html::endTag('p');
    }
    
}