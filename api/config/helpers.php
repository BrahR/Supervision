<?php
	function validateInputs(array $required, array $postValues): array {
		$values = [];
		$error = [];
		
		foreach ($required as $item) {
			$params = explode(':', $item);
			$val = $postValues[$params[0]] ?? null;
			
			if (str_contains($item, '?')) {
				$params = trim($params[0], '?');
				$val = $postValues[$params] ?? null;
				
				if ($val === null) continue;
				
				$values[$params] = $val;
				continue;
			}
			
			$isValid = count($params) == 1 ? empty($val) : (empty($val) && $val != $params[1]);
			
			if ($isValid) {
				$error[] = $item;
				continue;
			}
			
			$values[$params[0]] = $val;
		}
		
		return [$values, $error];
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