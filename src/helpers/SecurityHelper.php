<?php
namespace budimanlai\helpers;

use yii\base\Security as YiiSecurity;

class SecurityHelper extends YiiSecurity {
    
    /**
     * Convert plain string of password to SHA512 hash with Base64 for more secure
     * 
     * @param string $password
     * @return string
     */
    public function generateSecurePasswordString($password) {
        return base64_encode(hash('sha512', "!{$password}$", true));
    }
    
    /**
     * Generate secure password hash with secure password string
     * 
     * @param string $password
     * @param int $cost
     * @return string
     */
    public function generatePasswordHash($password, $cost = null) {
        return parent::generatePasswordHash($this->generateSecurePasswordString($password), $cost);
    }
    
    /**
     * Validate secure password
     * 
     * @param string $password
     * @param string $hash
     * @return boolean
     */
    public function validatePassword($password, $hash) {
        return parent::validatePassword($this->generateSecurePasswordString($password), $hash);
    }
}