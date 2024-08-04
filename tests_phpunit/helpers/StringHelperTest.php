<?php
/* 
 * @author Budiman Lai <budiman.lai@gmail.com>
 * @created_at 2024-08-04 15:26:37
 */
namespace yii2unit\common\helpers;

use yii2unit\common\TestCase;
use yii2\common\helpers\StringHelper;

class StringHelperTest extends TestCase {
    /**
     * @test
     */
    public function normalizePhoneNumber() {
        $phone = "081381382525";
        
        $normal = StringHelper::normalizePhoneNumber($phone);
    }
}
