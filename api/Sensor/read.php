<?php

    require '../config/db.php';
    $select = "SELECT * FROM `sensor`";
    $stmt = $pdo->query($select);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    var_dump($data);

?>