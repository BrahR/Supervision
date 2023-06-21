<?php

require '../config/db.php';
if(isset($_POST['edit'])){
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $type = $_POST['type'];
    $size = $_POST['size'];
    $position = $_POST['position'];
    $rack = $_POST['rack'];
    $id = 1;

    $rqt = "UPDATE `equipment` SET `name`=:name, `description`=:desc, `type`=:type,
            `unit_size`=:size, `position`=:position, `rack_id`=:rack
            WHERE id=:id";
    $stmt = $pdo->prepare($rqt);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':desc', $desc);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':size', $size);
    $stmt->bindParam(':position', $position);
    $stmt->bindParam(':rack', $rack);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}

$select = "SELECT * FROM `equipment` WHERE id = 1";
$stmt = $pdo->prepare($select);
$stmt->execute();
$data = $stmt->fetch(PDO::FETCH_ASSOC);


?>


<form action="" method="POST" align="center" width="">

    <label for="">Equipment name:</label>
    <input type="text" name="name" value="<?= $data['name']?>">
    <br><br>

    <label for="">Equipment description:</label>
    <input type="text" name="desc" value="<?= $data['description']?>">
    <br><br>

    <label for="">Equipment type:</label>
    <select name="type">
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
    </select>
    <br><br>

    <label for="">Unit size:</label>
    <select name="size">
        <?php
        for($i=0; $i<4; $i++){
        ?>
        <option value="<?= $i ?>"><?= $i ?></option>
        <?php } ?>
    </select>
    <br><br>

    <label for="">Position:</label>
    <select name="position">
        <?php
        for($i=0; $i<24; $i++){
        ?>
        <option value="<?= $i ?>"><?= $i ?></option>
        <?php } ?>
    </select>
    <br><br>

    <label for="">Rack ID:</label>
    <input type="number" name="rack" value="<?= $data['rack_id']?>">
    <br><br>

    <button type="submit" name="edit">Edit</button>

</form>