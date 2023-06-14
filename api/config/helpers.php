<?php
	function validateInputs(array $required, array $postValues): array {
		$values = [];
		$error = [];
		
		foreach ($required as $item) {
			$params = explode(':', $item);
			$val = $postValues[$params[0]] ?? null;
			
			$isValid = count($params) == 1 ? empty($val) : (empty($val) && $val != $params[1]);
			
			if ($isValid) {
				$error[] = $item;
				continue;
			}
			
			$values[$item] = $val;
		}
		
		return [ $values, $error ];
	}
	
	function printArray($array): void {
		echo '<pre>';
		print_r($array);
		echo '</pre>';
	}
	
	// a fnction that does the jsoneconde and exits
	function jsonExit(array $array): void {
		echo json_encode($array);
		exit();
	}
	
	function sendResponse(int $httpCode, string $status, string $message, array | string $data = null): void {
		http_response_code($httpCode);
		$response = ['status' => $status, 'message' => $message];
		
		if ($data) $response['data'] = $data;
		
		echo json_encode($response);
		exit();
	}