<?php
namespace budimanlai\helpers;

class ModelHelper {
    
    public static function normalizeAttribute($model, $attribute) {
        $tt = explode('.', $attribute);
        $result = null;
        $field = "";
        $c = count($tt);
        foreach($tt as $index => $row) {
            $field.= "->$row";
            if (!isset($model->$field)) {
                return null;
            } else if ($index == $c-1) {
                $result = $model->$field;
            }
        }
        return $result;
    }
    
    /**
     * Get model error message
     * 
     * @param \yii\base\Model $model
     * @return string
     */
    public static function getErrorModel($model) {
        $msg = [];
        foreach ($model->getFirstErrors() as $message) {
            $msg[] = $message;
        }
        
        return implode(", ", $msg);
    }
}