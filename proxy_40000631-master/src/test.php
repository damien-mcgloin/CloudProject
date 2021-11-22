<?php

require_once 'PHPUnit/Autoload.php';

use PHPUnit\Framework\TestCase;

class test extends TestCase
{

  // testing three proxy services are live
    public function testRequest1()
    {
      $ch = curl_init('http://newproxy.40000631.qpc.hal.davecutting.uk?service=wordcount&paragraph=hello');
      curl_exec($ch);

      $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

      curl_close($ch);

      $this->assertEquals($http_code, 200);
    }

    public function testRequest2()
    {
      $ch = curl_init('http://newproxy2.40000631.qpc.hal.davecutting.uk?service=keywordcount&paragraph=hello&word=hello');
      curl_exec($ch);

      $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

      curl_close($ch);

      $this->assertEquals($http_code, 200);
    }

    public function testRequest3()
    {
      $ch = curl_init('http://newproxy3.40000631.qpc.hal.davecutting.uk?service=check&paragraph=hello&word=hello');
      curl_exec($ch);

      $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

      curl_close($ch);

      $this->assertEquals($http_code, 200);
    }

    // testing that proxy1 can return accurate results from wordcount service
    public function testProxy1Wordcount()
    {
        $paragraph = urlencode("This is a test.");
        $url = 'http://newproxy.40000631.qpc.hal.davecutting.uk?service=wordcount&paragraph='.$paragraph;
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

// testing that proxy2 can return accurate results from wordcount service
    public function testProxy2Wordcount()
    {
        $paragraph = urlencode("This is a test.");
        $url = 'http://newproxy2.40000631.qpc.hal.davecutting.uk?service=wordcount&paragraph='.$paragraph;
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

// testing that proxy3 can return accurate results from wordcount service
    public function testProxy3Wordcount()
    {
        $paragraph = urlencode("This is a test.");
        $url = 'http://newproxy3.40000631.qpc.hal.davecutting.uk?service=wordcount&paragraph='.$paragraph;
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

// testing that proxy1 can return accurate results from check service
    public function testProxy1Check()
    {
        $paragraph = urlencode("This is a test.");
        $word = urlencode("TEST");
        $url = 'http://newproxy.40000631.qpc.hal.davecutting.uk?service=check&paragraph='.$paragraph.'&word='.$word;
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

// testing that proxy2 can return accurate results from check service
    public function testProxy2Check()
    {
        $paragraph = urlencode("This is a test.");
        $word = urlencode("TEST");
        $url = 'http://newproxy2.40000631.qpc.hal.davecutting.uk?service=check&paragraph='.$paragraph.'&word='.$word;
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

// testing that proxy3 can return accurate results from check service
    public function testProxy3Check()
    {
        $paragraph = urlencode("This is a test.");
        $word = urlencode("TEST");
        $url = 'http://newproxy3.40000631.qpc.hal.davecutting.uk?service=check&paragraph='.$paragraph.'&word='.$word;
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

// testing that proxy1 can return accurate results from keyword count service
    public function testProxy1Keycount()
    {
        $paragraph = urlencode("This is a test.");
        $word = urlencode("TEST");
        $url = 'http://newproxy.40000631.qpc.hal.davecutting.uk?service=keywordcount&paragraph='.$paragraph.'&word='.$word;
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

// testing that proxy2 can return accurate results from keyword count service
    public function testProxy2Keycount()
    {
        $paragraph = urlencode("This is a test.");
        $word = urlencode("TEST");
        $url = 'http://newproxy2.40000631.qpc.hal.davecutting.uk?service=keywordcount&paragraph='.$paragraph.'&word='.$word;
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

// testing that proxy3 can return accurate results from keyword count service
    public function testProxy3Keycount()
    {
        $paragraph = urlencode("This is a test.");
        $word = urlencode("TEST");
        $url = 'http://newproxy3.40000631.qpc.hal.davecutting.uk?service=keywordcount&paragraph='.$paragraph.'&word='.$word;
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
