<?php

require_once 'PHPUnit/Autoload.php';
require('functions.inc.php');
use PHPUnit\Framework\TestCase;

class test extends TestCase
{

    // check function is tested here for accuracy
    public function testCheck()
    {
        $check = 0;
        $paragraph='This is a test paragraph';
        $word='test';

        if (check($paragraph, $word) == 1) {
          $count = 1;
        } else {
          $count = 0;
        }

        $this->assertEquals($count, 1);
    }

    // test function is checked to ensure upper case keywords can be used
    public function testCheckUpperCase()
    {
        $check = 0;
        $paragraph='This is a test paragraph';
        $word='PARAGRAPH';

        if (check($paragraph, $word) == 1) {
          $count = 1;
        } else {
          $count = 0;
        }

        $this->assertEquals($count, 1);
    }

    // test to see if check service1 is live
    public function testRequest1()
    {
        $ch = curl_init('http://newcheck.40000631.qpc.hal.davecutting.uk');
        curl_exec($ch);

        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        $this->assertEquals($http_code, 200);
    }

    // test to see if check service2 is live
    public function testRequest2()
    {
        $ch = curl_init('http://newcheck2.40000631.qpc.hal.davecutting.uk');
        curl_exec($ch);

        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        $this->assertEquals($http_code, 200);
    }

    // test to see if check service3 is live
    public function testRequest3()
    {
        $ch = curl_init('http://newcheck3.40000631.qpc.hal.davecutting.uk');
        curl_exec($ch);

        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        $this->assertEquals($http_code, 200);
    }

    // test to see if correct error message is returned for empty paragraph and word values
    public function testCheckError1()
    {
        $paragraph = urlencode("");
        $word = urlencode("");
        $url = 'http://newcheck.40000631.qpc.hal.davecutting.uk?paragraph='.$paragraph.'&word='.$word;
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

        $data = curl_exec($ch);
        $cleandata = json_decode($data, true);
        $actual = $cleandata['error'];

        curl_close($ch);

        $this->assertEquals($actual, 'Enter text and a keyword');
    }

    // test to see if correct error message is returned for empty word values
    public function testCheckError2()
    {
        $paragraph = urlencode("test");
        $word = urlencode("");
        $url = 'http://newcheck.40000631.qpc.hal.davecutting.uk?paragraph='.$paragraph.'&word='.$word;
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

        $data = curl_exec($ch);
        $cleandata = json_decode($data, true);
        $actual = $cleandata['error'];

        curl_close($ch);

        $this->assertEquals($actual, 'Enter a keyword');
    }

    // test to see if correct error message is returned for empty paragraph values
    public function testCheckError3()
    {
        $paragraph = urlencode("");
        $word = urlencode("test");
        $url = 'http://newcheck.40000631.qpc.hal.davecutting.uk?paragraph='.$paragraph.'&word='.$word;
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

        $data = curl_exec($ch);
        $cleandata = json_decode($data, true);
        $actual = $cleandata['error'];

        curl_close($ch);

        $this->assertEquals($actual, 'Enter a paragraph');
    }

    // test to see if check service 1 returns correct value
    public function testCheckService1()
    {
        $paragraph = urlencode("this is a test.");
        $word = urlencode("test");
        $url = 'http://newcheck.40000631.qpc.hal.davecutting.uk?paragraph='.$paragraph.'&word='.$word;
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

        $data = curl_exec($ch);
        $cleandata = json_decode($data, true);
        $actual = $cleandata['answer'];

        curl_close($ch);

        $this->assertEquals($actual, 1);
    }

    // test to see if check service 2 returns correct value
    public function testCheckService2()
    {
        $paragraph = urlencode("this is a test.");
        $word = urlencode("test");
        $url = 'http://newcheck2.40000631.qpc.hal.davecutting.uk?paragraph='.$paragraph.'&word='.$word;
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

        $data = curl_exec($ch);
        $cleandata = json_decode($data, true);
        $actual = $cleandata['answer'];

        curl_close($ch);

        $this->assertEquals($actual, 1);
    }

    // test to see if check service 3 returns correct value
    public function testCheckService3()
    {
        $paragraph = urlencode("this is a test.");
        $word = urlencode("test");
        $url = 'http://newcheck3.40000631.qpc.hal.davecutting.uk?paragraph='.$paragraph.'&word='.$word;
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

        $data = curl_exec($ch);
        $cleandata = json_decode($data, true);
        $actual = $cleandata['answer'];

        curl_close($ch);

        $this->assertEquals($actual, 1);
    }

}
