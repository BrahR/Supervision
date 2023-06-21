<?php
    require '../config/db.php';

    if(isset($_POST['add'])){
        $name = $_POST['name'];

        $rqt = "INSERT INTO sensor_type (`name`) VALUES (:name)";
        $stmt = $pdo->prepare($rqt);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
    }
?>


<form action="" method="POST" align="center" width="">

    <label for="">Name sensor_type :</label>
    <input type="text" name="name">
    <br><br>
    <button type="submit" name="add">Add</button>

</form>