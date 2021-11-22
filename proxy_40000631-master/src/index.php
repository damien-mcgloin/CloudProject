<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Content-type: application/json");

/* maybe you can separate the proxy url based on & to work out requested
functions
$url = $_GET or maybe $_REQUEST;
$parameters = explode('&', $url);
$parameter1 = $parameters[0];
$parameter2 = $parameters[1];
*/

$paragraph = urlencode($_REQUEST['paragraph']);

if (isset($_REQUEST['word'])) {
  $word = urlencode($_REQUEST['word']);
} else {
  $word = '';
}
  $url = 'http://new'.$_REQUEST['service'].'.40000631.qpc.hal.davecutting.uk/?paragraph='.$paragraph.'&word='.$word;
  $url2 = 'http://new'.$_REQUEST['service'].'2.40000631.qpc.hal.davecutting.uk/?paragraph='.$paragraph.'&word='.$word;
  $url3 = 'http://new'.$_REQUEST['service'].'3.40000631.qpc.hal.davecutting.uk/?paragraph='.$paragraph.'&word='.$word;

/*** Initial proxy - hardcoded values - much less dynamic
if($_REQUEST['service']=='wordcount') {
    $url = 'http://newwordcount.40000631.qpc.hal.davecutting.uk/?paragraph='.$paragraph;
} else if($_REQUEST['service']=='check') {
    $url = 'http://newcheck.40000631.qpc.hal.davecutting.uk/?paragraph='.$paragraph.'&word='.$word;
} else if($_REQUEST['service']=='keyword') {
    $url = 'http://newkeywordcount.40000631.qpc.hal.davecutting.uk/?paragraph='.$paragraph.'&word='.$word;
}
***/


// multi curl is used here to help prevent a single point of failure
// if one service goes down the result from another is returned
try {

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

  // if the result is not json then it is an error and should not be returned to user
  if (is_string($result_1)) {
    echo $result_3;
  } elseif (is_string($result_3)) {
    echo $result_2;
  } else {
    echo $result_1;
  }

/*** initial attempt at altering url to allow proxy to reach other services
      $urlparts = explode('.', $url);
      $num+=1;
      $numurl = strval($num);
      $urlparts[1] = $urlparts[1].$numurl;
      $url = implode('.', $urlparts);
      $ch = curl_init($url);
***/

} catch(Exception $e) {

  echo $e->getMessage();

}

?>
