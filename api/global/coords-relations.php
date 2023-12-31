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
				WITH ranked_tags AS (
				  SELECT
				    sensor_id,
				    temperature,
				    humidity,
				    ROW_NUMBER() OVER (PARTITION BY sensor_id ORDER BY timestamp DESC) AS row_num
				  FROM
				    sensor_tag
				)
				
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
				  COALESCE(rt.temperature, rt.humidity) AS tag,
				  1 as w,
				  1 as h,
				  c.id AS i,
				  c.x AS x,
				  c.y AS y
				FROM
				  coordinates AS c
				  LEFT JOIN server_rack AS sr ON c.id = sr.coord_id
				  LEFT JOIN sensor AS s ON c.id = s.coord_id
				  LEFT JOIN ranked_tags AS rt ON s.id = rt.sensor_id AND rt.row_num = 1
				  LEFT JOIN sensor_type AS st ON s.sensor_type = st.id
				WHERE
				  sr.id IS NOT NULL OR s.id IS NOT NULL
				GROUP BY
				  tag, i, source_table, source_id, source_name, source_type, source_description, source_air_cond, source_cooling_method, w, h, x, y
				ORDER BY
				  i;

			");
			
			$coords = $relRes->fetchAll(PDO::FETCH_ASSOC);
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
