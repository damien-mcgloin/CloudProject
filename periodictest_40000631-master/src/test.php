<?php

header("Access-Control-Allow-Origin");

//phpinfo(INFO_MODULES);

$passw = "CNcLCtCbrbmQmD9q";
$username = "dmcgloin01";
$db = "dmcgloin01";
$host = "dmcgloin01.lampt.eeecs.qub.ac.uk";
$conn = new mysqli($host, $username, $passw, $db);

$word = generateWord();
$paragraph = generateParagraph();

$wordcount = WordCount($paragraph);
$KeyCheck = KeyCheck($paragraph, $word);
$KeywordCount = KeywordCount($paragraph, $word);


date_default_timezone_set('Europe/London');
$logDate = date('H:i:s');

checkDB($KeyCheck, $conn, $logDate);
wordcountDB($wordcount, $conn, $logDate);
keycountDB($KeywordCount, $conn, $logDate);




/*
$i = 0;
while($i < 1) {
  generateWord();
  $i += 1;
}
*/

//$KeywordCount = keywordCount($paragraph, $word);
//echo $KeywordCount;

function checkDB($KeyCheck, $conn, $logDate) {

  $service1 = 'Check';
  $expected1 = $KeyCheck['expected'];
  $actual1 = $KeyCheck['actual'];
  $testStatus1 = $KeyCheck['testStatus'];
  $performance1 = $KeyCheck['Performance'];
  $HTTPStatus1 = $KeyCheck['HTTPStatus'];

  if($conn->connect_error){
    echo "not connected".$conn->connect_error;
  } else {

  }

  $query = "INSERT INTO CloudLogs (Service, LogDate, Expected, Actual, TestStatus, Performance, HTTPStatus)
  VALUES('$service1', '$logDate', '$expected1', '$actual1', '$testStatus1', '$performance1', '$HTTPStatus1')";

  $result = $conn->query($query);

  if(!$result) {
    echo $conn->error;
  }
}

function wordcountDB($wordcount, $conn, $logDate) {

  $service2 = "WordCount";
  $expected2 = $wordcount['expected'];
  $actual2 = $wordcount['actual'];
  $testStatus2 = $wordcount['testStatus'];
  $performance2 = $wordcount['Performance'];
  $HTTPStatus2 = $wordcount['HTTPStatus'];

  if($conn->connect_error){
    echo "not connected".$conn->connect_error;
  } else {

  }

  $query = "INSERT INTO CloudLogs (Service, LogDate, Expected, Actual, TestStatus, Performance, HTTPStatus)
  VALUES('$service2', '$logDate', '$expected2', '$actual2', '$testStatus2', '$performance2', '$HTTPStatus2')";

  $result = $conn->query($query);

  if(!$result) {
    echo $conn->error;
  }

}

function keycountDB($KeywordCount, $conn, $logDate) {

  $service3 = "KeyCount";
  $expected3 = $KeywordCount['expected'];
  $actual3 = $KeywordCount['actual'];
  $testStatus3 = $KeywordCount['testStatus'];
  $performance3 = $KeywordCount['Performance'];
  $HTTPStatus3 = $KeywordCount['HTTPStatus'];

  if($conn->connect_error){
    echo "not connected".$conn->connect_error;
  } else {

  }

  $query = "INSERT INTO CloudLogs (Service, LogDate, Expected, Actual, TestStatus, Performance, HTTPStatus)
  VALUES('$service3', '$logDate', '$expected3', '$actual3', '$testStatus3', '$performance3', '$HTTPStatus3')";

  $result = $conn->query($query);

  if(!$result) {
    echo $conn->error;
  }

}

function generateWord() {
  $array = array('bookcase', 'shelf', 'pizza', 'fire', 'car');
  $random = rand(0, 4);

  return $array[$random];
  //echo $array[$random];
}

function generateParagraph() {
  $array = array('The bookcase is in the library.', 'The shelf is in the kitchen.', 'The pizza smells delicious.', 'The fire is so hot.', 'The car is really fast.');
  $random = rand(0, 4);

  return $array[$random];
  //echo $array[$random];
}

function WordCount($paragraph) {

  $start = microtime(true) * 1000;

  $paragraph = urlencode($paragraph);
  $url = 'http://newproxy.40000631.qpc.hal.davecutting.uk/?service=wordcount&paragraph='.$paragraph;

/*
  $data = json_decode(file_get_contents($url));
  //$cleanData = json_decode($data, true);
  return $data;

  */

  $ch = curl_init($url);

  curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

  $data = curl_exec($ch);

  $HTTPStatus = "";

  if (curl_exec($ch) === false) {
    $HTTPStatus = "ERROR";
  } else {
    $HTTPStatus = "200";
  }

  curl_close($ch);
  $cleanData = json_decode($data, true);

  $expected = str_word_count($paragraph);
  $actual = $cleanData['answer'];

  $testStatus = "";

  $performance = 0.0;

  if ($expected == $actual) {
    $testStatus = "Pass";
    $end = microtime(true) * 1000;
    $performance = $end-$start;
    $performance = round($performance, 2);
  } else {
    $testStatus = "Fail";
    $end = microtime(true) * 1000;
    $performance = $end-$start;
    $performance = round($performance, 2);
  }

  $output = array(
    "expected" => $expected,
    "actual" => $actual,
    "testStatus" => $testStatus,
    "Performance" => $performance,
    "HTTPStatus" => $HTTPStatus
  );

  return $output;
}

function KeyCheck($paragraph, $word) {

  $start = microtime(true) * 1000;

  $paragraph = urlencode($paragraph);
  $word = urlencode($word);
  $url = 'http://newproxy.40000631.qpc.hal.davecutting.uk/?service=check&paragraph='.$paragraph.'&word='.$word;

  $ch = curl_init($url);

  curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

  $data = curl_exec($ch);

  $HTTPStatus = "";

  if (curl_exec($ch) === false) {
    $HTTPStatus = "ERROR";
  } else {
    $HTTPStatus = "200";
  }

  $cleanData = json_decode($data, true);
  curl_close($ch);

  $paragrapharray = str_word_count($paragraph, 1);
  $count = 0;
  $expected = 0;

  foreach ($paragrapharray as $value) {
    if (strtolower($word) == strtolower($value)){
      $count+=1;
    }
  }

  if ($count > 0) {
    $expected = 1;
  } else {
    $expected = 0;
  }

  $actual = $cleanData['answer'];

  $testStatus = "";

  $performance = 0.0;

  if ($expected == $actual) {
    $testStatus = "Pass";
    $end = microtime(true) * 1000;
    $performance = $end-$start;
    $performance = round($performance, 2);
  } else {
    $testStatus = "Fail";
    $end = microtime(true) * 1000;
    $performance = $end-$start;
    $performance = round($performance, 2);
  }

  $output = array(
    "expected" => $expected,
    "actual" => $actual,
    "testStatus" => $testStatus,
    "Performance" => $performance,
    "HTTPStatus" => $HTTPStatus
  );

  return $output;
  //print_r($cleanData);
}

function KeywordCount($paragraph, $word) {

  $start = microtime(true) * 1000;

  $paragraph = urlencode($paragraph);
  $word = urlencode($word);
  $url = 'http://newproxy.40000631.qpc.hal.davecutting.uk/?service=keywordcount&paragraph='.$paragraph.'&word='.$word;

  $ch = curl_init($url);

  curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

  $data = curl_exec($ch);

  $HTTPStatus = "";

  if (curl_exec($ch) === false) {
    $HTTPStatus = "ERROR";
  } else {
    $HTTPStatus = "200";
  }

  curl_close($ch);
  $cleanData = json_decode($data, true);

  $actual = $cleanData['answer'];

  $paragrapharray = str_word_count($paragraph, 1);
  $count = 0;
  $expected = 0;

  foreach ($paragrapharray as $value) {
    if (strtolower($word) == strtolower($value)){
      $count+=1;
    }
  }

  $expected = $count;

  $testStatus = "";

  $performance = 0.0;

  if ($expected == $actual) {
    $testStatus = "Pass";
    $end = microtime(true) * 1000;
    $performance = $end-$start;
    $performance = round($performance, 2);
  } else {
    $testStatus = "Fail";
    $end = microtime(true) * 1000;
    $performance = $end-$start;
    $performance = round($performance, 2);
  }

  $output = array(
    "expected" => $expected,
    "actual" => $actual,
    "testStatus" => $testStatus,
    "Performance" => $performance,
    "HTTPStatus" => $HTTPStatus
  );

  return $output;
}

function WordCountService($paragraph) {

  $url = 'http://newproxy.40000631.qpc.hal.davecutting.uk/?service=wordcount&paragraph='.$paragraph;
  $url2 = 'http://newproxy2.40000631.qpc.hal.davecutting.uk/?service=wordcount&paragraph='.$paragraph;
  $url3 = 'http://newproxy3.40000631.qpc.hal.davecutting.uk/?service=wordcount&paragraph='.$paragraph;

  $ch_1 = curl_init($url);
  $ch_2 = curl_init($url2);
  $ch_3 = curl_init($url3);

  curl_setopt($ch_1, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch_2, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch_3, CURLOPT_RETURNTRANSFER, true);

  $mh = curl_multi_init();
  curl_multi_add_handle($mh, $ch_1);
  curl_multi_add_handle($mh, $ch_2);
  curl_multi_add_handle($mh, $ch_3);

  $running = null;
  do {
    curl_multi_exec($mh, $running);
  } while ($running);

  curl_multi_remove_handle($mh, $ch_1);
  curl_multi_remove_handle($mh, $ch_2);
  curl_multi_remove_handle($mh, $ch_3);
  curl_multi_close($mh);

  $result_1 = curl_multi_getcontent($ch_1);
  $result_2 = curl_multi_getcontent($ch_2);
  $result_3 = curl_multi_getcontent($ch_3);
}

function KeyCheckService($paragraph, $word) {
  $url = 'http://newproxy.40000631.qpc.hal.davecutting.uk/?service=check&paragraph='.$paragraph.'&word='.$word;
  $url2 = 'http://newproxy2.40000631.qpc.hal.davecutting.uk/?service=check&paragraph='.$paragraph.'&word='.$word;
  $url3 = 'http://newproxy3.40000631.qpc.hal.davecutting.uk/?service=check&paragraph='.$paragraph.'&word='.$word;

  $ch_1 = curl_init($url);
  $ch_2 = curl_init($url2);
  $ch_3 = curl_init($url3);

  curl_setopt($ch_1, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch_2, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch_3, CURLOPT_RETURNTRANSFER, true);

  $mh = curl_multi_init();
  curl_multi_add_handle($mh, $ch_1);
  curl_multi_add_handle($mh, $ch_2);
  curl_multi_add_handle($mh, $ch_3);

  $running = null;
  do {
    curl_multi_exec($mh, $running);
  } while ($running);

  curl_multi_remove_handle($mh, $ch_1);
  curl_multi_remove_handle($mh, $ch_2);
  curl_multi_remove_handle($mh, $ch_3);
  curl_multi_close($mh);

  $result_1 = curl_multi_getcontent($ch_1);
  $result_2 = curl_multi_getcontent($ch_2);
  $result_3 = curl_multi_getcontent($ch_3);
}

function KeywordCountService($paragraph, $word) {
  $url = 'http://newproxy.40000631.qpc.hal.davecutting.uk/?service=keywordcount&paragraph='.$paragraph.'&word='.$word;
  $url2 = 'http://newproxy2.40000631.qpc.hal.davecutting.uk/?service=keywordcount&paragraph='.$paragraph.'&word='.$word;
  $url3 = 'http://newproxy3.40000631.qpc.hal.davecutting.uk/?service=keywordcount&paragraph='.$paragraph.'&word='.$word;

  $ch_1 = curl_init($url);
  $ch_2 = curl_init($url2);
  $ch_3 = curl_init($url3);

  curl_setopt($ch_1, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch_2, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch_3, CURLOPT_RETURNTRANSFER, true);

  $mh = curl_multi_init();
  curl_multi_add_handle($mh, $ch_1);
  curl_multi_add_handle($mh, $ch_2);
  curl_multi_add_handle($mh, $ch_3);

  $running = null;
  do {
    curl_multi_exec($mh, $running);
  } while ($running);

  curl_multi_remove_handle($mh, $ch_1);
  curl_multi_remove_handle($mh, $ch_2);
  curl_multi_remove_handle($mh, $ch_3);
  curl_multi_close($mh);

  $result_1 = curl_multi_getcontent($ch_1);
  $result_2 = curl_multi_getcontent($ch_2);
  $result_3 = curl_multi_getcontent($ch_3);
}

?>
