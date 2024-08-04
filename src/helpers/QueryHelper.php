<?php
namespace budimanlai\helpers;

use Yii;

class QueryHelper {
    
    /**
     * Update data
     * 
     * @param string $table
     * @param array $columns
     * @param array | string $condition
     * @param array $params
     */
    public static function update($table, $columns, $condition, $params = []) {
        Yii::$app->db->createCommand()->update($table, $columns, $condition, $params)->execute();
    }
    
    /**
     * Insert data
     * 
     * @param string $table
     * @param array $columns
     */
    public static function insert($table, $columns) {
        Yii::$app->db->createCommand()->insert($table, $columns)->execute();
    }
    
    /*
     * Select one record from table and lock the row from updating or select from other query
     * 
     * @param string $sql
     * @param array $params
     * @return null | array
     */
    public static function queryForUpdate($sql, $params = []) {
        return self::queryOne("{$sql} LIMIT 1 FOR UPDATE", $params);
    }
    
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
     * Get first column in first row
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