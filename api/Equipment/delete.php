<?php
	/* @var $pdo PDO */
	require_once '../config/db.php';
	require_once '../config/helpers.php';
	require_once '../config/api-headers.php';
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		// _POST is a form data variable so it can't take json/string data
		
		$_POST = json_decode(file_get_contents("php://input"),true);
		$required = ['id'];
		[$values, $errors] = validateInputs($required, $_POST);
		
		if (!empty($errors))
			sendResponse(500, 'Error', 'Missing required fields: ' . implode(', ', $errors));

		try {
			$stmt = $pdo->prepare("DELETE FROM equipment WHERE id = ?");

			$eqRes = $stmt->execute(array_values($values));
			if ($eqRes)
				sendResponse(200, 'Success', 'Server rack created successfully');
		} catch (Exception $e) {
			sendResponse(500, 'Error', $e->getMessage());
		}
		
		sendResponse(405, 'Error', 'Unknown error');
	}
	
	sendResponse(405, 'Warning', 'Method not allowed');