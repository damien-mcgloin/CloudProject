<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json");
require('functions.inc.php');

$paragraph = $_REQUEST['paragraph'];
$word = $_REQUEST['word'];

$output = array(
      "error" => "",
    "answer" => 0
);

// error handling to return error message to user
try {
  $count = keywordcount($paragraph,$word);
} catch (Exception $e) {
	$output['error']=$e->getMessage();
}

$output['answer']=$count;
echo json_encode($output);
exit();

?>
