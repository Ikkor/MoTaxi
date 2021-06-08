<?php
require_once "../../includes/db_connect.php";
require '../../vendor/autoload.php';
use Opis\JsonSchema\{
	Validator, ValidationResult, 
   		 Errors\ErrorFormatter, Exceptions\SchemaException, SchemaLoader
	};


$stmt = "SELECT user.name, user.id FROM user WHERE utype = 'driver'";

if(isset($_GET['driver_id'])){
	$driver_id = $_GET['driver_id'];
	$stmt = $stmt . "WHERE user.id = $driver_id";
}

$result = $pdo->query($stmt);

$driver_array = $result->fetchAll(PDO::FETCH_ASSOC);

for($i=0; $i<count($driver_array); $i++)
{
	$driver_id = $driver_array[$i]['id'];

	$innerquery = "SELECT reg_no, s_type, seat, model_name, boot_capacity FROM vehicules WHERE vehicules.owned_by = $driver_id";

	$result2 = $pdo->query($innerquery);

	$driver_array[$i]['vehicules'] = $result2->fetchAll(PDO::FETCH_ASSOC);
	}

	$data = json_encode($driver_array, JSON_NUMERIC_CHECK); 
	// echo $data;
	// die;

	$data1 = json_decode($data);


	$validator = new Validator();

	$resolver = $validator->resolver();

	$validator->resolver()->registerFile("http://example.com/JSONSchema.json","Schema_drivervehicles.json");

	$result = $validator->validate($data1, "http://example.com/JSONSchema.json");

	if($result->isValid()){
		header('Content-Type: application/json');
		echo $data;
	} else {

		$error = $result->getErrors();
		echo '$data is invalid', PHP_EOL;

		foreach ($error as $key => $value) {
			# code...
	    	echo "Error: ", $value->keyword(), PHP_EOL;
	    	echo json_encode($value->keywordArgs(), JSON_PRETTY_PRINT), PHP_EOL;
	    }
	
}

?>