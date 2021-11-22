<?php
header("Access-Control-Allow-Origin");

// used for checking to see if mysqli module was installed
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

// time information is stored when each test is run
date_default_timezone_set('Europe/London');
$logDate = date('H:i:s');

// adds test data for each service to the db
checkDB($KeyCheck, $conn, $logDate);
wordcountDB($wordcount, $conn, $logDate);
keycountDB($KeywordCount, $conn, $logDate);

// this will erase all info in db table at 23.55 each day
if (time() > strtotime("23:52:00") && time() < strtotime("23:58:00")) {
  eraseDB($conn);
}


// this function does not actually work but was intended for sending email alerts
function sendEmailAlert() {

  /*** Various attempts at getting email alerts to work - using mailjet's api - using the PEAR library - executing a separate python script - using PHP's mail() function

  require 'vendor/autoload.php';
  use \Mailjet\Resources;
  $mj = new \Mailjet\Client('ad6ea6a7811e293696ef78b0bc85a6ce','6ed039fb41f4a98c529a4513456499f9',true,['version' => 'v3.1']);
  $body = [
    'Messages' => [
      [
        'From' => [
          'Email' => "cloud40000631@outlook.com",
          'Name' => "Damien"
        ],
        'To' => [
          [
            'Email' => "cloud40000631@outlook.com",
            'Name' => "Damien"
          ]
        ],
        'Subject' => "Greetings from Mailjet.",
        'TextPart' => "My first Mailjet email",
        'HTMLPart' => "<h3>Dear passenger 1, welcome to <a href='https://www.mailjet.com/'>Mailjet</a>!</h3><br />May the delivery force be with you!",
        'CustomID' => "AppGettingStartedTest"
      ]
    ]
  ];
  $response = $mj->post(Resources::$Email, ['body' => $body]);
  $response->success() && var_dump($response->getData());

*/
/*
  require_once "Mail.php";

  $host = "smtp.mailgun.org";
  $username = "postmaster@sandbox21a78f8...3eb160ebc79.mailgun.org";
  $password = "75b958a6a0b...dd417c80133";
  $port = "587";
  $to = "Cloud40000631@outlook.com";

  $email_from = "test@outlook.com";
  $email_subject = "Service report";
  $email_body = "The service and proxy are ok";
  $content = "text/html; charset=utf-8";
  $mime = "1.0";

  $headers = array ('From' => $email_from,
  'To' => $to,
  'Subject' => $email_subject,
  'Reply-To' => $email_address,
  'MIME-Version' => $mime,
  'Content-type' => $content);

  $params = array ('host' => $host,
  'port' => $port,
  'auth' => true,
  'username' => $username,
  'password' => $password);

  $smtp = Mail::factory ('smtp', $params);
  $mail = $smtp->send($to, $headers, $email_body);

  if (PEAR::isError($mail)) {
    echo("<p>" . $mail->getMessage() . "</p>");
  } else {
    echo("<p>Message sent successfully!</p>");
  }



  $to = "rufus947@gmail.com";
  $subject1 = "Error Report";
  $subject2 = "Service Report";
  $errorMessage = "";


  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
  $headers .= 'From: <linux@DockerServer>' . "\r\n";


  //$headers = "From: test@outlook.com";


  $headers = array(
    'From' => 'linux@dockerserver',
    'Reply-To' => 'linux@dockerserver',
    'X-Mailer' => 'PHP/' . phpversion()
  );


  $headers = 'From: linux@dockerserver' . "\r\n" .
      'Reply-To: linux@dockerserver' . "\r\n" .
      'X-Mailer: PHP/' . phpversion();



  $subject = "Service report";
  //$to_email = "rufus947@gmail.com";
  //$to_fullname = "damien mcgloin";
  //$from_email = "linux@dockerserver";
  //$from_fullname = "Jane Linux";

  $to = "rufus947@gmail.com";

  $headers  = 'From: Jane Linux <linux@dockerserver>' . "\r\n" .
  $headers .= 'Reply-To: linux@dockerserver\r\n' . "\r\n" .
              'X-Mailer: PHP/' . phpversion();


  $msg = "The WordCount service or proxy are ok";
  $success = mail($to,$subject,$msg,$headers);

  if (!$success) {
    $errorMessage = error_get_last()['message'];
  }

  return $success;

  //exec('echo "Service or proxy are down" | sendmail -v rufus947@gmail.com');



  //$command_exec = escapeshellcmd('email.py');
  //shell_exec($command_exec);

  */

}

// this function erases all info in db table
function eraseDB($conn) {

  if($conn->connect_error){
    echo "not connected".$conn->connect_error;
  } else {

  }

  $query = "DELETE FROM CloudLogs";

  $result = $conn->query($query);

  if(!$result) {
    echo $conn->error;
  }

}

// this function stores testdata for check service in db
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

// this function stores test data for word count service in the db
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

// this function stores testdata for keyword count service in db
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

// this function returns 1 of 5 words at random
function generateWord() {
  $array = array('bookcase', 'shelf', 'pizza', 'fire', 'car');
  $random = rand(0, 4);

  return $array[$random];
}

// this function returns 1 of 5 sentences at random
function generateParagraph() {
  $array = array('The bookcase is in the library.', 'The shelf is in the kitchen.', 'The pizza smells delicious.', 'The fire is so hot.', 'The car is really fast.');
  $random = rand(0, 4);

  return $array[$random];
}

// this function tracks performance, accuracy, test status and http status for wordcount service
function WordCount($paragraph) {

  // microtime function is used for assessing performance
  $start = microtime(true) * 1000;

  $paragraph = urlencode($paragraph);
  $url = 'http://newproxy.40000631.qpc.hal.davecutting.uk/?service=wordcount&paragraph='.$paragraph;

  $ch = curl_init($url);

  curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

  $data = curl_exec($ch);

  $HTTPStatus = "";

/* additional attempt at creating email alert
  $headers = "From: testsite <Cloud40000631@outlook.com>\n";
  $headers .= "Cc: testsite <Cloud40000631@outlook.com>\n";
  $headers .= "X-Sender: testsite <Cloud40000631@outlook.com>\n";
  $headers .= "X-Priority: 1\n";
  $headers .= "Return-Path: Cloud40000631@outlook.com\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=iso-8859-1\n";
  */

  $to = 'Cloud40000631@gmail.com';
  $subject = 'Service report';

  $headers  = 'From: postmaster@sandboxdb4337370c634d27880afec8d56b41b6.mailgun.org' . "\r\n" .
              'Reply-To: postmaster@sandboxdb4337370c634d27880afec8d56b41b6.mailgun.org' . "\r\n" .
              'X-Mailer: PHP/' . phpversion();

  if (curl_exec($ch) === FALSE) {
    $HTTPStatus = "ERROR";
    $msg = "The WordCount service or proxy is down";
    mail($to,$subject,$msg,$headers);
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

// this function tracks performance, accuracy, test status and http status for check service
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

  $to = 'Cloud40000631@gmail.com';
  $subject = 'Service report';

  $headers  = 'From: postmaster@sandboxdb4337370c634d27880afec8d56b41b6.mailgun.org' . "\r\n" .
              'Reply-To: postmaster@sandboxdb4337370c634d27880afec8d56b41b6.mailgun.org' . "\r\n" .
              'X-Mailer: PHP/' . phpversion();

  if (curl_exec($ch) === FALSE) {
    $HTTPStatus = "ERROR";
    $msg = "The KeyCheck service or proxy is down";
    mail($to,$subject,$msg,$headers);
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

}

// this function tracks performance, accuracy, test status and http status for keywordcount service
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

  $to = 'Cloud40000631@gmail.com';
  $subject = 'Service report';

  $headers  = 'From: postmaster@sandboxdb4337370c634d27880afec8d56b41b6.mailgun.org' . "\r\n" .
              'Reply-To: postmaster@sandboxdb4337370c634d27880afec8d56b41b6.mailgun.org' . "\r\n" .
              'X-Mailer: PHP/' . phpversion();

  if (curl_exec($ch) === FALSE) {
    $HTTPStatus = "ERROR";
    $msg = "The KeywordCount service or proxy is down";
    mail($to,$subject,$msg,$headers);
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

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">

  <!-- Bootstrap CSS framework -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

  <!-- Favicon-->
  <link rel="icon" type="image" href="" alt="company-logo" />


  <!-- Font Awesome -->
  <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>

  <!-- JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

  <title>WebWordCount</title>
</head>

<body>

<section id ='logs'>
  <div class="logs" style ="padding-left: 7%">
    <br>
    <h3>Testing logs</h3>
    <hr style ="width: 80%; margin: auto">
    <br>
      <div><h5>Logs for <?php
      date_default_timezone_set('Europe/London');
      echo date("Y-m-d");
       ?></h5></div>
      <br>
  </div>
  <div>
      <br>
      <table class="table table-hover" style ="width: 80%; margin:auto">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td colspan="2">Larry the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>
  </div>
</section>

</body>

</html>
