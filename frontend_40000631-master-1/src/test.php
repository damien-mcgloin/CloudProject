<?php

require_once 'PHPUnit/Autoload.php';

use PHPUnit\Framework\TestCase;

class test extends TestCase
{
    // this is used simply to test that the frontend is live
    public function testRequest()
    {
        $ch = curl_init('http://newfrontend.40000631.qpc.hal.davecutting.uk');
        curl_exec($ch);

        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        $this->assertEquals($http_code, 200);
    }

}
