<?php
	if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH');
		header('Access-Control-Allow-Headers: token, Content-Type');
		header('Access-Control-Max-Age: 86400');
		header('Content-Length: 0');
		header('Content-Type: text/plain');
		die();
	}
	
	header("Access-Control-Allow-Origin: *");
	//header("Content-Type: application/json");