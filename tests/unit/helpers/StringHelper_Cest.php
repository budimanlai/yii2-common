<?php
/* 
 * @author Budiman Lai <budiman.lai@gmail.com>
 * @created_at 2024-08-04 16:24:11
 */
namespace budimanlai\common\tests\unit\helpers;

use budimanlai\common\tests\UnitTester;
use budimanlai\helpers\StringHelper;

class StringHelper_Cest {
    
    /*
     * @param UnitTester $I
     */
    public function normalizePhoneNumber(UnitTester $I) {
        $number = "081381382525";
        $normal = StringHelper::normalizePhoneNumber($number);
        $I->assertEquals("6281381382525", $normal);
    }
    
    /*
     * @param UnitTester $I
     */
    public function normalizePhoneNumberWithoutZero(UnitTester $I) {
        $number = "81381382525";
        $normal = StringHelper::normalizePhoneNumber($number);
        $I->assertEquals("81381382525", $normal);
    }
    
    /*
     * @param UnitTester $I
     */
    public function normalizePhoneNumberNonIndonesiaNumber(UnitTester $I) {
        $number = "1234567890";
        $normal = StringHelper::normalizePhoneNumber($number);
        $I->assertEquals("1234567890", $normal);
    }
    
    /*
     * @param UnitTester $I
     */
    public function normalizePhoneNumberWithPrefix62(UnitTester $I) {
        $number = "6281381385252";
        $normal = StringHelper::normalizePhoneNumber($number);
        $I->assertEquals("6281381385252", $normal);
    }
    
    /*
     * @param UnitTester $I
     */
    public function normalizePhoneNumberWithWithSpace(UnitTester $I) {
        $number = "0813 8138 2525";
        $normal = StringHelper::normalizePhoneNumber($number);
        $I->assertEquals("6281381382525", $normal);
    }
    
    /*
     * @param UnitTester $I
     */
    public function normalizePhoneNumberWithPlus(UnitTester $I) {
        $number = "+62813 8138 2525";
        $normal = StringHelper::normalizePhoneNumber($number);
        $I->assertEquals("6281381382525", $normal);
    }
}