<?php
	/* @var $pdo PDO */
	require_once '../config/db.php';
	require_once '../config/helpers.php';
	require_once '../config/api-headers.php';
	
	$status = 'Warning';
	$message = 'Method not allowed';
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$status = 'Error';
		$message = 'Unknown error';
		
		$_POST = json_decode(file_get_contents("php://input"),true);
		$required = ['name', 'description', 'sensorType', 'selectedX:0','selectedY:0'];
		[$values, $errors] = validateInputs($required, $_POST);
		
		if (!empty($errors)) {
			$status = 'Error';
			$message = 'Missing required fields: ' . implode(', ', $errors);
		}
		
		$sensor = array_slice($values, 0, 3);
		$selected = array_slice($values, 3);
		
		try {
			$stmt = $pdo->prepare('SELECT * FROM sensor_type WHERE name = ?');
			$typeRes = $stmt->execute([$sensor['sensorType']]);
			
			if ($typeRes) {
				$type = $stmt->fetch(PDO::FETCH_ASSOC);
				$sensor['sensorType'] = (int) $type['id'];
			}
			
			$stmt = $pdo->prepare('INSERT INTO coordinates VALUES (NULL, ?, ?)');
			$coordsRes = $stmt->execute(array_values($selected));
			$coordsId = $pdo->lastInsertId();
			
			$stmt = $pdo->prepare("INSERT INTO sensor VALUES (null, ?, ?, ?, $coordsId)");
			$sensorRes = $stmt->execute(array_values($sensor));
		} catch (Exception $e) {
			http_response_code(500);
			$status = 'Error';
			$message = $e->getMessage();
		}
		
		if ($typeRes && $coordsRes && $sensorRes) {
			$status = 'Success';
			$message = 'Sensor created successfully';
		}
		
		$response = ['status' => $status, 'message' => $message];
		echo json_encode($response);
		exit();
	}
	
  sendResponse(405, $status, $message);