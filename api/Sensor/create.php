<?php
require '../config/db.php';

if(isset($_POST['add'])){
    $name = $_POST['name'];
    $coord_id = $_POST['coord_id'];
    $sensor_type = $_POST['sensor_type'];
    $description = $_POST['description'];

    $insert = "INSERT INTO `sensor` (`name`, `description`, `sensor_type`, `coord_id`) 
               VALUES (:name, :description, :sensor_type, :coord_id)";
		
    $stmt = $pdo->prepare($insert);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':sensor_type', $sensor_type);
    $stmt->bindParam(':coord_id', $coord_id);
    $stmt->execute();
}
?>

<form action="" method="POST" align="center" width="">
    <label for="">Equipment name:</label>
    <input type="text" name="name">
    <br><br>

    <label for="">Equipment description:</label>
    <input type="text" name="description">
    <br><br>

    <label for="">Sensor type:</label>
    <input type="number" name="sensor_type">
    <br><br>

    <label for="">Coord ID:</label>
    <input type="number" name="coord_id">
    <br><br>

    <button type="submit" name="add">Add</button>
</form>