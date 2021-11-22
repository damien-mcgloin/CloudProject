<?php
header("Access-Control-Allow-Origin");

//phpinfo was used for understanding errors related to mysqli function
//phpinfo(INFO_MODULES);

//current time is passed into functions and stored in the db
date_default_timezone_set('Europe/London');
$logDate = date('H:i:s');

//one of 5 random words/sentences are returned and used in other functions
$word = generateWord();
$paragraph = generateParagraph();

//functions for testing if services are live
$wordcount = WordCountService($paragraph);
$keycheck = KeyCheckService($paragraph, $word);
$keycount = KeywordCountService($paragraph, $word);
$proxy = ProxyService($paragraph);

$wordcount1 = $wordcount["wc1"];
$keycheck1 = $keycheck["KeyCheck1"];
$keycount1 = $keycount["KeyCount1"];
$proxy1 = $proxy["p1"];

$wordcount2 = $wordcount["wc2"];
$keycheck2 = $keycheck["KeyCheck2"];
$keycount2 = $keycount["KeyCount2"];
$proxy2 = $proxy["p2"];

$wordcount3 = $wordcount["wc3"];
$keycheck3 = $keycheck["KeyCheck3"];
$keycount3 = $keycount["KeyCount3"];
$proxy3 = $proxy["p3"];

//function for returning one of five random words
function generateWord() {
  $array = array('bookcase', 'shelf', 'pizza', 'fire', 'car');
  $random = rand(0, 4);

  return $array[$random];

}

// function for returning one of five random sentences
function generateParagraph() {
  $array = array('The bookcase is in the library.', 'The shelf is in the kitchen.', 'The pizza smells delicious.', 'The fire is so hot.', 'The car is really fast.');
  $random = rand(0, 4);

  return $array[$random];

}

// function for checking if wordcount services are live
function WordCountService($paragraph) {

  $paragraph = urlencode($paragraph);

  $url = 'http://newwordcount.40000631.qpc.hal.davecutting.uk/?paragraph='.$paragraph;
  $url2 = 'http://newwordcount2.40000631.qpc.hal.davecutting.uk/?paragraph='.$paragraph;
  $url3 = 'http://newwordcount3.40000631.qpc.hal.davecutting.uk/?paragraph='.$paragraph;

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

  $output = array(
    "wc1" => $result_1,
    "wc2" => $result_2,
    "wc3" => $result_3
  );

  return $output;
}

//function for checking if check services are live
function KeyCheckService($paragraph, $word) {

  $paragraph = urlencode($paragraph);
  $word = urlencode($word);

  $url = 'http://newcheck.40000631.qpc.hal.davecutting.uk/?paragraph='.$paragraph.'&word='.$word;
  $url2 = 'http://newcheck2.40000631.qpc.hal.davecutting.uk/?paragraph='.$paragraph.'&word='.$word;
  $url3 = 'http://newcheck3.40000631.qpc.hal.davecutting.uk/?paragraph='.$paragraph.'&word='.$word;

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

  $output = array(
    "KeyCheck1" => $result_1,
    "KeyCheck2" => $result_2,
    "KeyCheck3" => $result_3
  );

  return $output;
}

// function for checking if keyword count services are live
function KeywordCountService($paragraph, $word) {

  $paragraph = urlencode($paragraph);
  $word = urlencode($word);

  $url = 'http://newkeywordcount.40000631.qpc.hal.davecutting.uk/?paragraph='.$paragraph.'&word='.$word;
  $url2 = 'http://newkeywordcount2.40000631.qpc.hal.davecutting.uk/?paragraph='.$paragraph.'&word='.$word;
  $url3 = 'http://newkeywordcount3.40000631.qpc.hal.davecutting.uk/?paragraph='.$paragraph.'&word='.$word;

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

  $output = array(
    "KeyCount1" => $result_1,
    "KeyCount2" => $result_2,
    "KeyCount3" => $result_3
  );

  return $output;
}

// function for checking if proxy services are live
function ProxyService($paragraph) {

  $paragraph = urlencode($paragraph);

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

  $output = array(
    "p1" => $result_1,
    "p2" => $result_2,
    "p3" => $result_3
  );

  return $output;
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

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {'packages':['line']});
    google.charts.setOnLoadCallback(drawCheckChart);
    google.charts.setOnLoadCallback(drawWordcountChart);
    google.charts.setOnLoadCallback(drawKeycountChart);

    // functions for generating line graphs showing performance
    function drawCheckChart() {
      var data = new google.visualization.DataTable();
      data.addColumn('number', 'No. of tests');
      data.addColumn('number', 'Check');

      data.addRows([

        <?php

        $passw = "CNcLCtCbrbmQmD9q";
        $username = "dmcgloin01";
        $db = "dmcgloin01";
        $host = "dmcgloin01.lampt.eeecs.qub.ac.uk";
        $conn = new mysqli($host, $username, $passw, $db);

        $count = 0;

        $query = "SELECT CloudLogs.Performance FROM CloudLogs WHERE Service = 'Check'";

        $result = $conn->query($query);

        if(!$result){
          echo $conn->error;
        }else{

        while($row = $result->fetch_assoc()){

          $performance = $row['Performance'];

          $count++;

          echo  "[$count, $performance],";
        }
      }

        ?>

      ]);

      var options = {
        chart: {
          title: 'Performance for Check service',
          subtitle: 'measured in milliseconds'
        },
        width: 900,
        height: 500
      };

      var chart = new google.charts.Line(document.getElementById('linechart_material1'));

      chart.draw(data, google.charts.Line.convertOptions(options));
      }

      function drawWordcountChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('number', 'No. of tests');
        data.addColumn('number', 'Word Count');

        data.addRows([

          <?php

          $passw = "CNcLCtCbrbmQmD9q";
          $username = "dmcgloin01";
          $db = "dmcgloin01";
          $host = "dmcgloin01.lampt.eeecs.qub.ac.uk";
          $conn = new mysqli($host, $username, $passw, $db);

          $count = 0;

          $query = "SELECT CloudLogs.Performance FROM CloudLogs WHERE Service = 'WordCount'";

          $result = $conn->query($query);

          if(!$result){
            echo $conn->error;
          }else{

          while($row = $result->fetch_assoc()){

            $performance = $row['Performance'];

            $count++;

            echo  "[$count, $performance],";
          }
        }

          ?>

        ]);

        var options = {
          chart: {
            title: 'Performance for Word Count service',
            subtitle: 'measured in milliseconds'
          },
          width: 900,
          height: 500
        };

        var chart = new google.charts.Line(document.getElementById('linechart_material2'));

        chart.draw(data, google.charts.Line.convertOptions(options));
        }

        function drawKeycountChart() {
          var data = new google.visualization.DataTable();
          data.addColumn('number', 'No. of tests');
          data.addColumn('number', 'Keyword Count');

          data.addRows([

            <?php

            $passw = "CNcLCtCbrbmQmD9q";
            $username = "dmcgloin01";
            $db = "dmcgloin01";
            $host = "dmcgloin01.lampt.eeecs.qub.ac.uk";
            $conn = new mysqli($host, $username, $passw, $db);

            $count = 0;

            $query = "SELECT CloudLogs.Performance FROM CloudLogs WHERE Service = 'KeyCount'";

            $result = $conn->query($query);

            if(!$result){
              echo $conn->error;
            }else{

            while($row = $result->fetch_assoc()){

              $performance = $row['Performance'];

              $count++;

              echo  "[$count, $performance],";
            }
          }

            ?>

          ]);

          var options = {
            chart: {
              title: 'Performance for Keyword Count service',
              subtitle: 'measured in milliseconds'
            },
            width: 900,
            height: 500
          };

          var chart = new google.charts.Line(document.getElementById('linechart_material3'));

          chart.draw(data, google.charts.Line.convertOptions(options));
          }

/*** this function can be used to generate a pie chart but was later removed as it looked too clunky
          function drawPieChart() {

            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Test Status');
            data.addColumn('number', 'no. of tests');

            data.addRows([


/*
              $passw = "CNcLCtCbrbmQmD9q";
              $username = "dmcgloin01";
              $db = "dmcgloin01";
              $host = "dmcgloin01.lampt.eeecs.qub.ac.uk";
              $conn = new mysqli($host, $username, $passw, $db);

              $passcount = 0;
              $failcount = 0;

              $query = "SELECT * FROM CloudLogs";

              $result = $conn->query($query);

              if(!$result){
                echo $conn->error;
              }else{

              while($row = $result->fetch_assoc()){

                $performance = $row['TestStatus'];

                if($performance == 'Pass') {
                  $passcount+=1;
                } else {
                  $failcount+=1;
                }

              }

              echo  "['Pass Rate', $passcount],
                     ['Fail Rate', $failcount]";

            }

              ?>

            ]);

            var options = {
              chart: {
                title: 'Success rate of tests',
                sliceVisibilityThreshold: .2
            };

            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, options);
            }
*/

    </script>

  <title>WebWordCount</title>
</head>

<body>

  <section id ='title'>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Web Word Count</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="http://newmonitor.40000631.qpc.hal.davecutting.uk/">Testing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="http://newdashboard.40000631.qpc.hal.davecutting.uk/">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#logs">Logs - Check</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#logs2">Logs - Wordcount</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#logs3">Logs - Keywordcount</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
  </section>

<section id ="dashboard">
  <div class="data" style ="padding-left: 7%">
    <br>
    <h3>Data</h3>
    <hr style ="width: 80%; margin: auto">
    <br>
    <div id="linechart_material1" style="width: 900px; height: 500px"></div>
    <div id="linechart_material2" style="width: 900px; height: 500px"></div>
    <div id="linechart_material3" style="width: 900px; height: 500px"></div>
  </div>

  <div class="status" style ="padding-left: 7%">
    <br>
    <h3>Service Status</h3>
    <hr style ="width: 80%; margin: auto">
    <br>
    <div class="container">
      <div class="row" style="margin-top: 30px">
        <div class="col-4">

          <?php

        echo  "<strong><h6 style='margin-left: 15px'>WordCount-1</h6></strong>
          <div style='margin-left: 25px'>
            <i class='far ".(stripos($wordcount1, 'answer') ? "fa-check-circle far" : "fa-window-close")." fa-5x'></i>
          </div>
          <div style='margin-left: 15px'>
            <p>Status: ".(stripos($wordcount1, 'answer') ? "Online" : "Offline")."</p>
          </div>"
          ?>

        </div>
        <div class="col-4">
          <div class="col-4">

            <?php

            echo "<strong><h6 style='text-align: center'>WordCount-2</h6></strong>
            <div style='text-align: center'>
              <i class='far ".(stripos($wordcount2, 'answer') ? "fa-check-circle far" : "fa-window-close")." fa-5x'></i>
            </div>
            <div style='text-align: center'>
              <p>Status: ".(stripos($wordcount2, 'answer') ? "Online" : "Offline")."</p>
            </div>"

            ?>

          </div>
        </div>
        <div class="col-4">
          <div class="col-4">

            <?php

            echo "<strong><h6 style='text-align: center'>WordCount-3</h6></strong>
            <div style='text-align: center'>
              <i class='far ".(stripos($wordcount3, 'answer') ? "fa-check-circle far" : "fa-window-close")." fa-5x'></i>
            </div>
            <div>
              <p style='text-align: center'>Status: ".(stripos($wordcount3, 'answer') ? "Online" : "Offline")."</p>
            </div>"

            ?>

          </div>
        </div>
      </div>
      <div class="row" style="margin-top: 30px">
        <div class="col-4">

          <?php

          echo "<strong><h6 style='margin-left: 30px'>Check-1</h6></strong>
          <div style='margin-left: 25px'>
            <i class='far ".(stripos($keycheck1, 'answer') ? "fa-check-circle far" : "fa-window-close")." fa-5x'></i>
          </div>
          <div style='margin-left: 15px'>
            <p>Status: ".(stripos($keycheck1, 'answer') ? "Online" : "Offline")."</p>
          </div>"

          ?>

        </div>
        <div class="col-4">
          <div class="col-4">

            <?php

            echo "<strong><h6 style='text-align: center'>Check-2</h6></strong>
            <div style='text-align: center'>
              <i class='far ".(stripos($keycheck2, 'answer') ? "fa-check-circle far" : "fa-window-close")." fa-5x'></i>
            </div>
            <div>
              <p style='text-align: center'>Status: ".(stripos($keycheck2, 'answer') ? "Online" : "Offline")."</p>
            </div>"

            ?>

          </div>
        </div>
        <div class="col-4">
          <div class="col-4">

            <?php

            echo "<strong><h6 style='text-align: center'>Check-3</h6></strong>
            <div style='text-align: center'>
              <i class='far ".(stripos($keycheck3, 'answer') ? "fa-check-circle far" : "fa-window-close")." fa-5x'></i>
            </div>
            <div>
              <p style='text-align: center'>Status: ".(stripos($keycheck3, 'answer') ? "Online" : "Offline")."</p>
            </div>"

            ?>

          </div>
        </div>
      </div>
      <div class="row" style="margin-top: 30px">
        <div class="col-4">

          <?php

          echo "<strong><h6 style='margin-left: 15px'>KeyCount-1</h6></strong>
          <div style='margin-left: 25px'>
            <i class='far ".(stripos($keycount1, 'answer') ? "fa-check-circle far" : "fa-window-close")." fa-5x'></i>
          </div>
          <div style='margin-left: 15px'>
            <p>Status: ".(stripos($keycount1, 'answer') ? "Online" : "Offline")."</p>
          </div>"

          ?>

        </div>
        <div class="col-4">
          <div class="col-4">

            <?php

            echo "<strong><h6 style='text-align: center'>KeyCount-2</h6></strong>
            <div style='text-align: center'>
              <i class='far ".(stripos($keycount2, 'answer') ? "fa-check-circle far" : "fa-window-close")." fa-5x'></i>
            </div>
            <div style='text-align: center'>
              <p>Status: ".(stripos($keycount2, 'answer') ? "Online" : "Offline")."</p>
            </div>"

            ?>

          </div>
        </div>
        <div class="col-4">
          <div class="col-4">

            <?php

            echo "<strong><h6 style='text-align: center'>KeyCount-3</h6></strong>
            <div style='text-align: center'>
              <i class='far ".(stripos($keycount3, 'answer') ? "fa-check-circle far" : "fa-window-close")." fa-5x'></i>
            </div>
            <div style='text-align: center'>
              <p>Status: ".(stripos($keycount3, 'answer') ? "Online" : "Offline")."</p>
            </div>"

            ?>

          </div>
        </div>
      </div>
      <div class="row" style="margin-top: 30px">
        <div class="col-4">

          <?php

          echo "<strong><h6 style='margin-left: 35px'>Proxy-1</h6></strong>
          <div style='margin-left: 25px'>
            <i class='far ".(stripos($proxy1, 'answer') ? "fa-check-circle far" : "fa-window-close")." fa-5x'></i>
          </div>
          <div style='margin-left: 15px'>
            <p>Status: ".(stripos($proxy1, 'answer') ? "Online" : "Offline")."</p>
          </div>"

          ?>

        </div>
        <div class="col-4">
          <div class="col-4">

            <?php

            echo "<strong><h6 style='text-align: center'>Proxy-2</h6></strong>
            <div style='text-align: center'>
              <i class='far ".(stripos($proxy2, 'answer') ? "fa-check-circle far" : "fa-window-close")." fa-5x'></i>
            </div>
            <div style='text-align: center'>
              <p>Status: ".(stripos($proxy2, 'answer') ? "Online" : "Offline")."</p>
            </div>"

            ?>

          </div>
        </div>
        <div class="col-4">
          <div class="col-4">

            <?php

            echo "<strong><h6 style='text-align: center'>Proxy-3</h6></strong>
            <div style='text-align: center'>
              <i class='far ".(stripos($proxy3, 'answer') ? "fa-check-circle far" : "fa-window-close")." fa-5x'></i>
            </div>
            <div>
              <p style='text-align: center'>Status: ".(stripos($proxy3, 'answer') ? "Online" : "Offline")."</p>
            </div>"

            ?>

          </div>
        </div>
      </div>
    </div>
  </div>

</section>

<section id ='logs'>
  <div class="logs" style ="padding-left: 7%">
    <br>
    <h3>Testing logs</h3>
    <hr style ="width: 80%; margin: auto">
    <br>
  </div>
  <div>
      <br>
      <table class="table table-hover" style ="width: 80%; margin:auto">
  <thead>
    <tr>
      <th scope="col">Total Tests Run</th>
      <th scope="col">Remaining Tests</th>
      <th scope="col">Passed Tests</th>
      <th scope="col">Failed Tests</th>
      <th scope="col">Pass Rate</th>
    </tr>
  </thead>
  <tbody>

    <?php

    $passw = "CNcLCtCbrbmQmD9q";
    $username = "dmcgloin01";
    $db = "dmcgloin01";
    $host = "dmcgloin01.lampt.eeecs.qub.ac.uk";
    $conn = new mysqli($host, $username, $passw, $db);

    $count = 0;
    $passcount = 0;
    $failcount = 0;

    $query = "SELECT * FROM CloudLogs";

    $result = $conn->query($query);

    if(!$result){
      echo $conn->error;
    }else{

    while($row = $result->fetch_assoc()){

      $testStatus = $row['TestStatus'];

      if ($testStatus == 'Pass') {
        $passcount+=1;
      } else {
        $failcount+=1;
      }

      $count++;
    }

    $remain = 861-$count;
    $passrate = (100/$count) * $passcount;

      echo  "<tr>
              <th scope='row'>$count</th>
              <td>$remain</td>
              <td>$passcount</td>
              <td>$failcount</td>
              <td>{$passrate}%</td>
            </tr>";

  }

    ?>

  </tbody>
  </table>
  </div>

  <br>
  <br>
    <div><h5 style="margin-left: 8rem">Logs for Check service : <?php
    date_default_timezone_set('Europe/London');
    echo date("Y-m-d");
     ?></h5></div>
    <br>

  <div>
      <br>
      <table class="table table-hover" style ="width: 80%; margin:auto">
  <thead>
    <tr>
      <th scope="col">No.</th>
      <th scope="col">Service</th>
      <th scope="col">Time</th>
      <th scope="col">Expected</th>
      <th scope="col">Actual</th>
      <th scope="col">Test Status</th>
      <th scope="col">Performance</th>
      <th scope="col">HTTP Status</th>
    </tr>
  </thead>
  <tbody>

    <?php

    $passw = "CNcLCtCbrbmQmD9q";
    $username = "dmcgloin01";
    $db = "dmcgloin01";
    $host = "dmcgloin01.lampt.eeecs.qub.ac.uk";
    $conn = new mysqli($host, $username, $passw, $db);

    $count = 0;

    $query = "SELECT * FROM CloudLogs WHERE Service = 'Check'";

    $result = $conn->query($query);

    if(!$result){
      echo $conn->error;
    }else{

    while($row = $result->fetch_assoc()){

      $service = $row['Service'];
      $time = $row['LogDate'];
      $expected = $row['Expected'];
      $actual = $row['Actual'];
      $testStatus = $row['TestStatus'];
      $performance = $row['Performance'];
      $httpStatus = $row['HTTPStatus'];

      $count++;

      echo  "<tr>
              <th scope='row'>$count</th>
              <td>$service</td>
              <td>$time</td>
              <td>$expected</td>
              <td>$actual</td>
              <td>$testStatus</td>
              <td>$performance</td>
              <td>$httpStatus</td>
            </tr>";
    }
  }

    ?>

  </tbody>
</table>
  </div>

</section>
<section id ='logs2'>

  <br>
  <br>
    <div><h5 style="margin-left: 8rem">Logs for WordCount service : <?php
    date_default_timezone_set('Europe/London');
    echo date("Y-m-d");
     ?></h5></div>
    <br>

  <div>
      <br>
      <table class="table table-hover" style ="width: 80%; margin:auto">
  <thead>
    <tr>
      <th scope="col">No.</th>
      <th scope="col">Service</th>
      <th scope="col">Time</th>
      <th scope="col">Expected</th>
      <th scope="col">Actual</th>
      <th scope="col">Test Status</th>
      <th scope="col">Performance</th>
      <th scope="col">HTTP Status</th>
    </tr>
  </thead>
  <tbody>

    <?php

    $passw = "CNcLCtCbrbmQmD9q";
    $username = "dmcgloin01";
    $db = "dmcgloin01";
    $host = "dmcgloin01.lampt.eeecs.qub.ac.uk";
    $conn = new mysqli($host, $username, $passw, $db);

    $count = 0;

    $query = "SELECT * FROM CloudLogs WHERE Service = 'WordCount'";

    $result = $conn->query($query);

    if(!$result){
      echo $conn->error;
    }else{

    while($row = $result->fetch_assoc()){

      $service = $row['Service'];
      $time = $row['LogDate'];
      $expected = $row['Expected'];
      $actual = $row['Actual'];
      $testStatus = $row['TestStatus'];
      $performance = $row['Performance'];
      $httpStatus = $row['HTTPStatus'];

      $count++;

      echo  "<tr>
              <th scope='row'>$count</th>
              <td>$service</td>
              <td>$time</td>
              <td>$expected</td>
              <td>$actual</td>
              <td>$testStatus</td>
              <td>$performance</td>
              <td>$httpStatus</td>
            </tr>";
    }
  }

    ?>

  </tbody>
  </table>
  </div>

</section>
<section id ='logs3'>

  <br>
  <br>
    <div><h5 style="margin-left: 8rem">Logs for Keyword count service : <?php
    date_default_timezone_set('Europe/London');
    echo date("Y-m-d");
     ?></h5></div>
    <br>

  <div>
      <br>
      <table class="table table-hover" style ="width: 80%; margin:auto">
  <thead>
    <tr>
      <th scope="col">No.</th>
      <th scope="col">Service</th>
      <th scope="col">Time</th>
      <th scope="col">Expected</th>
      <th scope="col">Actual</th>
      <th scope="col">Test Status</th>
      <th scope="col">Performance</th>
      <th scope="col">HTTP Status</th>
    </tr>
  </thead>
  <tbody>

    <?php

    $passw = "CNcLCtCbrbmQmD9q";
    $username = "dmcgloin01";
    $db = "dmcgloin01";
    $host = "dmcgloin01.lampt.eeecs.qub.ac.uk";
    $conn = new mysqli($host, $username, $passw, $db);

    $count = 0;

    $query = "SELECT * FROM CloudLogs WHERE Service = 'KeyCount'";

    $result = $conn->query($query);

    if(!$result){
      echo $conn->error;
    }else{

    while($row = $result->fetch_assoc()){

      $service = $row['Service'];
      $time = $row['LogDate'];
      $expected = $row['Expected'];
      $actual = $row['Actual'];
      $testStatus = $row['TestStatus'];
      $performance = $row['Performance'];
      $httpStatus = $row['HTTPStatus'];

      $count++;

      echo  "<tr>
              <th scope='row'>$count</th>
              <td>$service</td>
              <td>$time</td>
              <td>$expected</td>
              <td>$actual</td>
              <td>$testStatus</td>
              <td>$performance</td>
              <td>$httpStatus</td>
            </tr>";
    }
  }

    ?>

  </tbody>
  </table>
  </div>
</section>

</body>

</html>
