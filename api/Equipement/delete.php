<?php
    require '../config/db.php';

    if(isset($_POST['delete'])){
        $id = $_POST['id'];
        
       echo $rqt = "DELETE FROM `equipment` WHERE id=:id";
        $stmt = $pdo->prepare($rqt);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        header("Location: read.php");
        exit();
    }

?>

<form action="" method="POST" align="center" width="">

    <label for="">ID equipemenet :</label>
    <input type="text" name="id">
    <br><br>
    <button type="submit" name="delete">DELETE</button>

</form>