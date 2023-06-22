<?php
	require_once '../config/db.php';
	require_once '../config/helpers.php';
	require_once '../config/api-headers.php';
	
	session_start();
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		// _POST is a form data variable so it can't take json/string data
		
		$_POST = json_decode(file_get_contents("php://input"),true);
		$required = ['email', 'password'];
		[$values, $errors] = validateInputs($required, $_POST);
		
		if (!empty($errors))
			sendResponse(500, 'Error', 'Missing required fields: ' . implode(', ', $errors));

		try {
			$stmt = $pdo->prepare("SELECT * FROM admin WHERE email_admin=? AND pw=?");
			$stmt->execute(array_values($values));
			
			if($stmt->rowCount() > 0) {
				sendResponse(200, 'Success', 'Logged in successfully');
			}
			
			sendResponse(500, 'Error', 'Wrong email or password');
		} catch (Exception $e) {
			sendResponse(500, 'Error', $e->getMessage());
		}
		
		sendResponse(405, 'Error', 'Unknown error');
	}
	
	sendResponse(405, 'Warning', 'Method not allowed');
	