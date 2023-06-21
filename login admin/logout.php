<?php

    require '../api/config/db.php';
    session_start();

    echo $_SESSION['log_in'];
    session_unset();
    session_destroy();

    header("Location: login_admin.php");
    exit();
?>