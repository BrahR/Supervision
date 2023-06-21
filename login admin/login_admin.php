<?php

require '../api/config/db.php';
session_start();

if(isset($_POST['login'])){
  $pw = $_POST['password'];
  $email = $_POST['email'];

  $rqt = "SELECT * FROM admin WHERE pw=:pw AND email_admin=:email";
  $stmt = $pdo->prepare($rqt);
  $stmt->bindParam(':pw', $pw);
  $stmt->bindParam(':email', $email);
  $stmt->execute();

  if($stmt->rowCount() > 0){
    $_SESSION['log_in'] = true;
    // header("Location: liste_client.php");
    exit();
  } else {
    header("Location: login_admin.php");
  }
}
?>



<!DOCTYPE html>
<html>

<head>
    <title> Login admin</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet" />
    <!-- <script src="https://kit.fontawesome.com/a81368914c.js"></script> -->
    <meta name="viewport" content="" />
</head>

<body>
    <div class="container">
        <div class="img">
            <img src="img/bg.svg" />
        </div>
        <div class="login-content">
            <form action="" method="POST">
                <img src="img/avatar.svg" />
                <h2 class="title">Welcome</h2>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Email</h5>
                        <input type="text" class="input" name="email" />
                    </div>
                </div>

                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Password</h5>
                        <input type="password" class="input" name="password" />
                    </div>
                </div>

                <input type="submit" class="btn" value="Login" name="login" />
            </form>
        </div>
    </div>
    <!-- <script type="text/javascript" src="js/main.js"></script> -->
</body>

</html>