<?php

require_once 'PHPUnit/Autoload.php';
require('functions.inc.php');
use PHPUnit\Framework\TestCase;

class test extends TestCase
{
  // testing that wordcount function returns accurate value
    public function testWordCount()
    {
      $paragraph='This is a test paragraph';

      $count = wordcount($paragraph);

      $this->assertEquals($count, 5);
    }

    // testing that wordcount service1 is live
    public function testRequest1()
    {
      $ch = curl_init('http://newwordcount.40000631.qpc.hal.davecutting.uk');
      curl_exec($ch);

      $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

      curl_close($ch);

      $this->assertEquals($http_code, 200);
    }

    // testing that wordcount service2 is live
    public function testRequest2()
    {
      $ch = curl_init('http://newwordcount2.40000631.qpc.hal.davecutting.uk');
      curl_exec($ch);

      $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

      curl_close($ch);

      $this->assertEquals($http_code, 200);
    }

    // testing that wordcount service3 is live
    public function testRequest3()
    {
      $ch = curl_init('http://newwordcount3.40000631.qpc.hal.davecutting.uk');
      curl_exec($ch);

      $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

      curl_close($ch);

      $this->assertEquals($http_code, 200);
    }

    // testing that wordcount service returns correct error message
    public function testWordcountError()
    {
        $paragraph = urlencode("");
        $url = 'http://newwordcount.40000631.qpc.hal.davecutting.uk?paragraph='.$paragraph;
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

    // testing that wordcount service1 returns correct word count
    public function testWordcountService1()
    {
        $paragraph = urlencode("this is a test.");
        $url = 'http://newwordcount.40000631.qpc.hal.davecutting.uk?paragraph='.$paragraph;
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

        $this->assertEquals($actual, 4);
    }

    // testing that wordcount service2 returns correct word count
    public function testWordcountService2()
    {
        $paragraph = urlencode("this is a test.");
        $url = 'http://newwordcount2.40000631.qpc.hal.davecutting.uk?paragraph='.$paragraph;
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

        $this->assertEquals($actual, 4);
    }

    // testing that wordcount service3 returns correct word count
    public function testWordcountService3()
    {
        $paragraph = urlencode("this is a test.");
        $url = 'http://newwordcount3.40000631.qpc.hal.davecutting.uk?paragraph='.$paragraph;
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

        $this->assertEquals($actual, 4);
    }

}

?>
