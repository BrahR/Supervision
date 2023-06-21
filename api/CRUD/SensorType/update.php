<?php

require '../config/db.php';
if(isset($_POST['edit'])){
    $name = $_POST['name'];
    $id = 7;
    
    $rqt = "UPDATE `sensor_type` SET `name`=:name WHERE id=:id";
    $stmt = $pdo->prepare($rqt);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}

$select = "SELECT * FROM `sensor_type` WHERE id = 7";
$stmt = $pdo->prepare($select);
$stmt->execute();
$data = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<form action="" method="POST" align="center" width="">
    <label for="">Name sensor_type :</label>
    <input type="text" name="name" value="<?= $data['name']?>">
    <br><br>
    <button type="submit" name="edit">Edit</button>
</form>