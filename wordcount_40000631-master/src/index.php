<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json");
require('functions.inc.php');

$output = array(
      "error" => "",
    "answer" => 0
);

$paragraph = $_REQUEST['paragraph'];

//error handling is used to check for errors and return correct message
try {
  $answer=wordcount($paragraph);
} catch (Exception $e) {
	$output['error']=$e->getMessage();
}

$output['answer']=$answer;

echo json_encode($output);
exit();

?>
