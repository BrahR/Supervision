<?php
	/* @var $pdo PDO */
	require_once '../config/db.php';
	require_once '../config/helpers.php';
	require_once '../config/api-headers.php';
	
	$status = 'Warning';
	$message = 'Method not allowed';
	
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		$status = 'Error';
		$message = 'Unknown error';
		
		try {
			$relRes = $pdo->query("
				SELECT
				    CASE
				        WHEN sr.id IS NOT NULL THEN 'server_rack'
				        WHEN s.id IS NOT NULL THEN 'sensor'
				    END AS source_table,
				  
				    COALESCE(sr.id, s.id) AS source_id,
				    COALESCE(sr.name, s.name) AS source_name,
				    COALESCE(sr.rack_type, st.name) AS source_type,
				    COALESCE(s.description, NULL) AS source_description,
				    COALESCE(sr.air_conditioning_type, NULL) AS source_air_cond,
				    COALESCE(sr.cooling_method, NULL) AS source_cooling_method,
				    
                    1 as w,
                    1 as h,
				    
				    c.id AS i,
				    c.x AS x,
				    c.y AS y
				FROM coordinates AS c
				LEFT JOIN server_rack AS sr ON c.id = sr.coord_id
				LEFT JOIN sensor AS s ON c.id = s.coord_id
				LEFT JOIN sensor_type AS st ON s.sensor_type = st.id
				
				WHERE sr.id IS NOT NULL OR s.id IS NOT NULL
			    ORDER BY i;
			");
			
			$coords = $relRes->fetchAll(PDO::FETCH_ASSOC);
//			printArray($coords);
//
//			$stmt = $pdo->prepare('SELECT * FROM sensor_type WHERE name = ?');
//			$typeRes = $stmt->execute([$sensor['sensorType']]);
//
//			if ($typeRes) {
//				$type = $stmt->fetch(PDO::FETCH_ASSOC);
//				$sensor['sensorType'] = (int) $type['id'];
//			}
//
//			$stmt = $pdo->prepare('INSERT INTO coordinates VALUES (NULL, ?, ?)');
//			$coordsRes = $stmt->execute(array_values($selected));
//			$coordsId = $pdo->lastInsertId();
//
//			$stmt = $pdo->prepare("INSERT INTO sensor VALUES (null, ?, ?, ?, $coordsId)");
//			$sensorRes = $stmt->execute(array_values($sensor));
		} catch (Exception $e) {
			http_response_code(500);
			$status = 'Error';
			$message = $e->getMessage();
		}
		
		if ($relRes) {
			$status = 'Success';
			$message = 'Sensor created successfully';
		}
		
		$response = ['status' => $status, 'message' => $message, 'data' => $coords];
		echo json_encode($response);
		exit();
	}
	
	http_response_code(405);
	echo json_encode(['status' => $status, 'message' => $message]);
