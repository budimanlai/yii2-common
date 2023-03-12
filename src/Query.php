<?php
namespace budimanlai\helpers;

use Yii;

class Query {
    
    /**
     * Execute SQL query
     * 
     * @param string $sql
     * @param array $params
     * @return int
     */
    public static function execute($sql, $params = []) {
        return Yii::$app->db->createCommand($sql, $params)->execute();
    }
    
    /**
     * Find record and return all row
     * 
     * @param string $sql
     * @param array $params
     * @return boolean
     */
    public static function all($sql, $params = []) {
        return Yii::$app->db->createCommand($sql, $params)->queryAll();
    }
    
    /**
     * Find record and return first row
     * 
     * @param string $sql
     * @param array $params
     * @return array | null
     */
    public static function one($sql, $params = []) {
        return Yii::$app->db->createCommand($sql, $params)->queryOne();
    }
    
    /**
     * 
     * 
     * @param string $sql
     * @param array $params
     * @return any
     */
    public static function scalar($sql, $params = []) {
        return Yii::$app->db->createCommand($sql, $params)->queryScalar();
    }
    
    /**
     * Check if query $sql is have record or exists. True if record found
     * 
     * @param string $sql
     * @param array $params
     * @return boolean
     */
    public static function isExists($sql, $params = []) {
        return self::one($sql, $params) == null ? false : true;
    }
}