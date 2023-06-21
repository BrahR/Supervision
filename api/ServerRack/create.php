<?php
	/* @var $pdo PDO */
	require_once '../config/db.php';
	require_once '../config/helpers.php';
	require_once '../config/api-headers.php';
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		// _POST is a form data variable so it can't take json/string data
		
		$_POST = json_decode(file_get_contents("php://input"),true);
		$required = ['name', 'airConditioning', 'rackType', 'coolingMethod', 'selectedX:0','selectedY:0'];
		[$values, $errors] = validateInputs($required, $_POST);
		
		if (!empty($errors))
			sendResponse(500, 'Error', 'Missing required fields: ' . implode(', ', $errors));
		
		$rack = array_slice($values, 0, 4);
		$selected = array_slice($values, 4);

		try {
			$stmt = $pdo->prepare('INSERT INTO coordinates VALUES (NULL, ?, ?)');
			$coordsRes = $stmt->execute(array_values($selected));
			$coordsId = $pdo->lastInsertId();
			
			$stmt = $pdo->prepare("INSERT INTO server_rack VALUES (null, ?, ?, ?, ?, $coordsId, 1)");
			$rackRes = $stmt->execute(array_values($rack));
			
			if ($rackRes && $coordsRes)
				sendResponse(200, 'Success', 'Server rack created successfully');
		} catch (Exception $e) {
			sendResponse(500, 'Error', $e->getMessage());
		}
		
		sendResponse(405, 'Error', 'Unknown error');
	}
	
	sendResponse(405, 'Warning', 'Method not allowed');