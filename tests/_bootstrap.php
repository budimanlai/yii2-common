<?php

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'test');

$vendor_path = dirname(dirname(__DIR__)) . "/demo";

if (!is_dir($vendor_path)) {
    $vendor_path = dirname(dirname(__DIR__));
}

defined('YII_APP_BASE_PATH') or define('YII_APP_BASE_PATH', $vendor_path);

require_once YII_APP_BASE_PATH . "/vendor/autoload.php";
require_once YII_APP_BASE_PATH . "/vendor/yiisoft/yii2/Yii.php";
require_once YII_APP_BASE_PATH . "/common/config/bootstrap.php";
