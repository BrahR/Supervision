<?php
require '../config/db.php';

if(isset($_POST['edit'])){
    $name = $_POST['name'];
    $coord_id = $_POST['coord_id'];
    $sensor_type = $_POST['sensor_type'];
    $description = $_POST['description'];

    $update = "UPDATE `sensor` SET `name` = :name, `description` = :description,
               `sensor_type` = :sensor_type, `coord_id` = :coord_id WHERE id = 3";
    $stmt = $pdo->prepare($update);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':sensor_type', $sensor_type);
    $stmt->bindParam(':coord_id', $coord_id);
    $stmt->execute();
}

$select = "SELECT * FROM `sensor` WHERE id = 3";
$stmt = $pdo->prepare($select);
$stmt->execute();
$data = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<form action="" method="POST" align="center" width="">
    <label for="">Equipment name:</label>
    <input type="text" name="name" value="<?= $data['name'] ?? '' ?>">
    <br><br>

    <label for="">Equipment description:</label>
    <input type="text" name="description" value="<?= $data['description'] ?? '' ?>">
    <br><br>

    <label for="">Sensor type:</label>
    <input type="number" name="sensor_type" value="<?= $data['sensor_type'] ?? '' ?>">
    <br><br>

    <label for="">Coord ID:</label>
    <input type="number" name="coord_id" value="<?= $data['coord_id'] ?? '' ?>">
    <br><br>

    <button type="submit" name="edit">Edit</button>
</form>