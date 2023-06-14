<?php
	/* @var $pdo PDO */
	require_once '../config/db.php';
	require_once '../config/helpers.php';
	require_once '../config/api-headers.php';
	
	$status = 'Warning';
	$message = 'Method not allowed';
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		// _POST is a form data variable so it can't take json/string data
		$status = 'Error';
		$message = 'Unknown error';
		
		$_POST = json_decode(file_get_contents("php://input"),true);
		$required = ['name', 'airConditioning', 'rackType', 'coolingMethod', 'selectedX:0','selectedY:0'];
		[$values, $errors] = validateInputs($required, $_POST);
		
		if (!empty($errors)) {
			$status = 'Error';
			$message = 'Missing required fields: ' . implode(', ', $errors);
		}
		
		$rack = array_slice($values, 0, 4);
		$selected = array_slice($values, 4);

		try {
			$stmt = $pdo->prepare('INSERT INTO coordinates VALUES (NULL, ?, ?)');
			$coordsRes = $stmt->execute(array_values($selected));
			$coordsId = $pdo->lastInsertId();
			
			$stmt = $pdo->prepare("INSERT INTO server_rack VALUES (null, ?, ?, ?, ?, $coordsId, 1)");
			$rackRes = $stmt->execute(array_values($rack));
			
			if ($rackRes && $coordsRes) {
				$status = 'Success';
				$message = 'Server rack created successfully';
			}
		} catch (Exception $e) {
			http_response_code(500);
			$status = 'Error';
			$message = $e->getMessage();
		}
		
		$response = ['status' => $status, 'message' => $message];
		echo json_encode($response);
		exit();
	}
	
	http_response_code(405);
	echo json_encode(['status' => $status, 'message' => $message]);
