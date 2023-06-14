<?php
	/* @var $pdo PDO */
	require_once '../config/db.php';
	require_once '../config/helpers.php';
	require_once '../config/api-headers.php';
	
	// TODO - NOT DONE
	
	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
		$stmt = $pdo->prepare('SELECT * FROM server_rack');
		$stmt->execute();
		$racks = $stmt->fetchAll();
		
		$response = ['status' => 'Success', 'message' => 'Server racks retrieved successfully', 'data' => $racks];
		echo json_encode($response);
		exit();
	}