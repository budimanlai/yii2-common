<?php
namespace budimanlai\helpers;

use Yii;

class Password {
    /**
     * Generate password hash
     * 
     * @param String $password
     * @return String
     */
    public static function generatePassword($password) {
        return Yii::$app->security->generatePasswordHash(self::generateHash($password));
    }
    
    /**
     * Validate password is valid hash
     * 
     * @param String $password
     * @param String $hash
     * @return bool
     */
    public static function validatePassword($password, $hash) {
        return Yii::$app->security->validatePassword(self::generateHash($password), $hash);
    }
    
    /**
     * Generate string hash
     * 
     * @param String $password
     * @return String
     */
    public static function generateHash($password) {
        return hash('sha3-512', $password, true);
    }
}