<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json");
require('functions.inc.php');

$output = array(
	"error" => "",
    "string" => "",
	"answer" => 0
);

$paragraph = $_REQUEST['paragraph'];
$word = $_REQUEST['word'];

// error handling is used to return error message to end user
try {
	$answer=check($paragraph,$word);
} catch (Exception $e) {
	$output['error']=$e->getMessage();
}

$output['string']=$paragraph."+".$word."=".$answer;
$output['answer']=$answer;

echo json_encode($output);
exit();
