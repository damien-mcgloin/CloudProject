<?php

// this class was initially created for the purpose of writing logs to a csv file but instead logs were restricted to only the automated testing service
  function WordCount($paragraph, $word) {

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

  function KeyCheck($paragraph, $word) {
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

  function KeywordCount($paragraph, $word) {
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
