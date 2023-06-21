<?php
    require '../config/db.php';

    if(isset($_POST['delete'])){
        $id = $_POST['id'];
        
       echo $rqt = "DELETE FROM `sensor_type` WHERE id=:id";
        $stmt = $pdo->prepare($rqt);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        header("Location: read.php");
        exit();
    }
?>


<form action="" method="POST" align="center" width="">

    <label for="">ID sensor_type :</label>
    <input type="text" name="id">
    <br><br>
    <button type="submit" name="delete">DELETE</button>

</form>