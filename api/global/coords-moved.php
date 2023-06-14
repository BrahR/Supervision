<?php
	/* @var $pdo PDO */
	require_once '../config/db.php';
	require_once '../config/helpers.php';
	require_once '../config/api-headers.php';

	if ($_SERVER["REQUEST_METHOD"] !== 'POST') {
		sendResponse(405, 'Warning', 'Method not allowed');
	}
	
	$status = 'Error';
	$message = 'Unknown error';
	
	$_POST = json_decode(file_get_contents("php://input"),true);
	$required = ['x:0', 'y:0', 'i'];
	[$values, $errors] = validateInputs($required, $_POST);
	
	if (!empty($errors)) {
		sendResponse(
		   400,
		   'Error',
		   'Missing required fields: ' . implode(', ', $errors)
		);
	}
	
	try {
		$stmt = $pdo->prepare('UPDATE coordinates SET x = ?, y = ? WHERE id = ?');
		$res = $stmt->execute(array_values($values));
	} catch (Exception $e) {
		sendResponse(500, 'Error', $e->getMessage());
	}
	
	sendResponse(
	   200,
	   $res ? 'Success' : 'Error',
	   $res ? 'Coordinates updated successfully' : 'Coordinates not updated'
	);