<?php
	/* @var $pdo PDO */
	require_once '../config/db.php';
	require_once '../config/helpers.php';
	require_once '../config/api-headers.php';
	
	$status = 'Warning';
	$message = 'Method not allowed';
	
	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
		$status = 'Error';
		$message = 'Unknown error';
		
		try {
			$stmt = $pdo->prepare('SELECT * FROM sensor_type');
			$stmt->execute();
			$sensorTypes = $stmt->fetchAll();
			
			$status = 'Success';
			$message = 'Sensor types retrieved successfully';
		} catch (Exception $e) {
			http_response_code(500);
			$status = 'Error';
			$message = $e->getMessage();
		}
		
		$response = ['status' => $status, 'message' => $message, 'data' => $sensorTypes];
		echo json_encode($response);
		exit();
	}
	
	http_response_code(405);
	echo json_encode(['status' => $status, 'message' => $message]);