<?php
namespace budimanlai\helpers;

class StringHelper {
    
    public function pre_dump($data) {
        echo "<pre>" . print_r($data, true) . "</pre>";
    }
    
}