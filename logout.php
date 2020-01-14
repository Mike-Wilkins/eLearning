<?php
    require('dbconnect.php');
    $con = CreateConnection();


    session_start();

    $username = $_SESSION['username'];
        $sql = "UPDATE login SET login_status = false WHERE username = :username";
        $ins_stmt = $con-> prepare($sql);
        $ins_stmt -> bindValue('username', $username);
        $ins_stmt -> execute();

    session_destroy();
    header("location:login.php");

?>