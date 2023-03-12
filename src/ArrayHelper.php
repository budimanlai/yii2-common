<?php
/**
 * @class: DateHelper
 * @author: Budiman Lai <budiman.lai@gmail.com>
 * 
 * Class ini berisi fungsi-fungsi manipulasi waktu/date
 */
namespace budimanlai\helpers;

use yii\helpers\ArrayHelper as YiiArrayHelper;
use yii\base\BadRequestException;

class ArrayHelper extends YiiArrayHelper {
    
    /**
     * Untuk check field $params[key] apakah kosong atau tidak
     * 
     * @param any | array $fields field yang harus ada value nya
     * @throws \yii\base\BadRequestException
     */
    public static function requiredField($params, $fields, $error_msg = "Invalid paramenters") {
        if (!is_array($fields)) { $fields[] = $fields; }
        foreach($fields as $key) {
            if (empty($params[$key])) { throw new BadRequestException($error_msg); }
        }
    }
    
    /**
     * $params = [
     *      'key1' => 'value1',
     *      'key2' => 'unwanted key',
     *      'key3' => 'value3'
     * ];
     * $rs = Helpers::safeField($params, ['key1', 'key3']);
     * // output: ['key1' => 'value1', 'key3' => 'value3'];
     * 
     * @param array $params
     * @param array $fields
     * @return array
     */
    public static function safeField($params, $fields) {
        $result = [];
        if (!is_array($fields)) { $fields[] = $fields; }
        foreach($fields as $row) {
            if (isset($params[$row])) {
                $result[$row] = $params[$row];
            }
        }
        
        return $result;
    }
    
    /**
     * $params = [
     *      'key1' => 'value1',
     *      'key2' => 'value2',
     *      'key3' => 'value3 and need to remove'
     * ];
     * $rs = Helpers::removeField($params, ['key3']);
     * // output: ['key1' => 'value1', 'key2' => 'value2'];
     * 
     * @param array $params
     * @param array $fields
     * @return array
     */
    public static function removeField($params, $fields) {
        if (!is_array($fields)) { $fields[] = $fields; }
        foreach($fields as $row) {
            unset($params[$row]);
        }
        
        return $params;
    }
}