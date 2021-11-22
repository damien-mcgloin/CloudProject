<?php

require_once 'PHPUnit/Autoload.php';
require('functions.inc.php');
use PHPUnit\Framework\TestCase;

class test extends TestCase
{

    //keywordcount function is tested here
    public function testKeywordCount()
    {
      $paragraph='This is a test paragraph.';
      $word='paragraph';
      $count = keywordcount($paragraph, $word);

      $this->assertEquals($count, 1);

    }

    // keywordcount function is tested to see if it can handle upper case keywords
    public function testKeywordCountUpperCase()
    {
      $paragraph='This is a test paragraph.';
      $word='PARAGRAPH';
      $count = keywordcount($paragraph, $word);

      $this->assertEquals($count, 1);

    }

    // test to see if keywordcount service1 is live
    public function testRequest1()
    {
      $ch = curl_init('http://newkeywordcount.40000631.qpc.hal.davecutting.uk');
      curl_exec($ch);

      $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

      curl_close($ch);

      $this->assertEquals($http_code, 200);
    }

    // test to see if keywordcount service2 is live
    public function testRequest2()
    {
      $ch = curl_init('http://newkeywordcount2.40000631.qpc.hal.davecutting.uk');
      curl_exec($ch);

      $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

      curl_close($ch);

      $this->assertEquals($http_code, 200);
    }

    // test to see if keywordcount service3 is live
    public function testRequest3()
    {
      $ch = curl_init('http://newkeywordcount3.40000631.qpc.hal.davecutting.uk');
      curl_exec($ch);

      $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

      curl_close($ch);

      $this->assertEquals($http_code, 200);
    }

    // test to see if keywordcount service returns correct error message if paragraph and word values are empty
    public function testKeyError1()
    {
      $paragraph = urlencode("");
      $word = urlencode("");
      $url = 'http://newkeywordcount.40000631.qpc.hal.davecutting.uk?paragraph='.$paragraph.'&word='.$word;
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

    // test to see if keywordcount service returns correct error message if word value is empty
    public function testKeyError2()
    {
      $paragraph = urlencode("hello");
      $word = urlencode("");
      $url = 'http://newkeywordcount.40000631.qpc.hal.davecutting.uk?paragraph='.$paragraph.'&word='.$word;
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

    // test to see if keywordcount service returns correct error message if paragraph value is empty
    public function testKeyError3()
    {
      $paragraph = urlencode("");
      $word = urlencode("hello");
      $url = 'http://newkeywordcount.40000631.qpc.hal.davecutting.uk?paragraph='.$paragraph.'&word='.$word;
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

    // test to see if keywordcount service1 returns correct value
    public function testKeyService1()
    {
      $paragraph = urlencode("This is a test paragraph.");
      $word = urlencode("paragraph");
      $url = 'http://newkeywordcount.40000631.qpc.hal.davecutting.uk?paragraph='.$paragraph.'&word='.$word;
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

    // test to see if keywordcount service2 returns correct value
    public function testKeyService2()
    {
      $paragraph = urlencode("This is a test paragraph.");
      $word = urlencode("paragraph");
      $url = 'http://newkeywordcount2.40000631.qpc.hal.davecutting.uk?paragraph='.$paragraph.'&word='.$word;
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

    // test to see if keywordcount service3 returns correct value
    public function testKeyService3()
    {
      $paragraph = urlencode("This is a test paragraph.");
      $word = urlencode("paragraph");
      $url = 'http://newkeywordcount3.40000631.qpc.hal.davecutting.uk?paragraph='.$paragraph.'&word='.$word;
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

?>
