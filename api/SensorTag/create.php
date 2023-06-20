<?php
	/* @var $pdo PDO */
	require_once '../config/db.php';
	require_once '../config/helpers.php';
	require_once '../config/api-headers.php';
	
	if ($_SERVER["REQUEST_METHOD"] !== 'POST') {
		sendResponse(405, 'Warning', 'Method not allowed');
	}
	
	$_POST = json_decode(file_get_contents("php://input"),true);
	
	$required = ['id', 'temperature?', 'humidity?'];
	[$values, $errors] = validateInputs($required, $_POST);
	$values = array_reverse($values);
	
	if (!empty($errors)) {
		sendResponse(
		   400,
		   'Error',
		   'Missing required field: ' . implode(', ', $errors)
		);
	}
	
	$field = array_keys($values)[0];
	
	try {
		$stmt = $pdo->prepare("INSERT INTO sensor_tag ($field, sensor_id) VALUES (?, ?)");
		$res = $stmt->execute(array_values($values));
	} catch (Exception $e) {
		sendResponse(500, 'Error', $e->getMessage());
	}
	
	sendResponse(
	   200,
	   $res ? 'Success' : 'Error',
	   $res ? 'Sensor tag created successfully' : "Couldn't create sensor tag"
	);