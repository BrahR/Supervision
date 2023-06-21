<?php

require '../config/db.php';
if(isset($_POST['add'])){
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $type = $_POST['type'];
    $size = $_POST['size'];
    $position = $_POST['position'];
    $rack = $_POST['rack'];

    $insert = "INSERT INTO `equipment`(`name`, `description`, `type`, `unit_size`, `position`, `rack_id`)
               VALUES (:name, :desc, :type, :size, :position, :rack)";
    $stmt = $pdo->prepare($insert);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':desc', $desc);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':size', $size);
    $stmt->bindParam(':position', $position);
    $stmt->bindParam(':rack', $rack);
    $stmt->execute();
}

?>


<form action="" method="POST" align="center" width="">

    <label for="">Equipment name:</label>
    <input type="text" name="name">
    <br><br>

    <label for="">Equipment description:</label>
    <input type="text" name="desc">
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
    <input type="number" name="rack">
    <br><br>

    <button type="submit" name="add">Add</button>

</form>