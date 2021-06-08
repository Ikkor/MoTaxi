<?php
require_once "../../includes/db_connect.php";
require '../../vendor/autoload.php';
use Opis\JsonSchema\{
	Validator, ValidationResult, 
   		 Errors\ErrorFormatter, Exceptions\SchemaException, SchemaLoader
	};


$stmt = "SELECT * from chat_message";

if(isset($_GET['user_to']) && isset($_GET['user_from']))
{
	$user_to = $_GET['user_to'];
	$user_from = $_GET['user_from'];

	$stmt = $stmt . "WHERE to_user_id=$user_to AND from_user_id=$user_from";
} //if we specify to and from


$result = $pdo->query($stmt);

$chat_array = $result->fetchAll(PDO::FETCH_ASSOC);

		
$encoded = json_encode($chat_array, JSON_PRETTY_PRINT);
$decoded = json_decode($encoded);

$validator = new Validator();
$resolver = $validator->resolver();
$validator->resolver()->registerFile(
  		"http://example.com/JSONSchema.json","Schema_chat.json"

  	);

$result = $validator->validate($decoded, "http://example.com/JSONSchema.json");

if($result->isValid()) {
	header('Content-Type: application/json');
	echo $encoded;	
} else {
	$error = $result->getErrors();
	echo 'invalid ', PHP_EOL;

	foreach ($error as $key => $value) {
	    	# code...
	    	echo "Error: ", $value->keyword(), PHP_EOL;
	    	echo json_encode($value->keywordArgs(), JSON_PRETTY_PRINT), PHP_EOL;
	    }
}


?>