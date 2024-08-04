<?php
namespace budimanlai\traits;

use yii\web\BadRequestHttpException;
use budimanlai\helpers\ModelHelper;
use common\helpers\QueryHelper;

trait TraitController {
    
    /**
     * Check if record is exists
     * 
     * @param String $sql
     * @param Array $params
     * @return boolean
     */
    public function isExists($sql, $params = []) {
        return QueryHelper::isExists($sql, $params);
    }
    
    public function queryOne($sql, $params = []) {
        return QueryHelper::queryOne($sql, $params);
    }
    
    public function queryAll($sql, $params = []) {
        return QueryHelper::queryAll($sql, $params);
    }
    
    public function queryScalar($sql, $params = []) {
        return QueryHelper::queryScalar($sql, $params);
    }
    
    public function queryExecute($sql, $params = []) {
        return QueryHelper::queryExecute($sql, $params);
    }
    
    public function queryUpdate($table, $columns, $condition, $params = []) {
        return QueryHelper::queryUpdate($table, $columns, $condition, $params);
    }
    
    public function queryInsert($table, $columns) {
        return QueryHelper::queryInsert($table, $columns);
    }
    
    /*
     * return model error as exception
     */
    public function asErrorModel($model) {
        throw new BadRequestHttpException(ModelHelper::getErrorModel($model), 888);
    }
    
    /**
     * Check if $json key is exists
     * 
     * @param array | object $json
     * @param array $field
     */
    public function requiredField($json, $field) {
        if (empty($json)) { throw new BadRequestHttpException("Invalid paramenter"); }
        foreach($field as $key) {
            if (empty($json[$key])) {
                throw new BadRequestHttpException("Invalid paramenter. Required {$key}");
            }
        }
    }
    
    /**
     * only get field $field from $json array
     * 
     * @param array | object $json
     * @param array $field
     * @return array
     */
    public function onlyField($json, $field) {
        $buffer = [];
        foreach($field as $key) {
            if (isset($json[$key])) {
                $buffer[$key] = $json[$key];
            }
        }
        return $buffer;
    }
}