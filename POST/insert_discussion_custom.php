<?php
require('../dbconnect.php');
$con = CreateConnection();
$discussion_table = $_GET['dbtable'];
$page = $_GET['page'];

session_start();

$b_success = false;
    
    $ins_stmt = "";

    if(isset($_POST['Comment']) && isset($_POST['submit'])){
        $comment = $_POST['Comment'];
        $submit = $_POST['submit'];
        $custom_team = $_GET['custom_team'];

            if($comment) {
            $sql = "INSERT INTO $discussion_table (comment, username) VALUES (:comment, :username)";
            $ins_stmt = $con-> prepare($sql);
            $ins_stmt -> bindValue(':comment', $comment);
            $ins_stmt -> bindValue(':username',  $_SESSION['username']);
            $ins_stmt -> execute();
        };
    }; 
    $con = null;
    header("location: $page?custom_team=$custom_team");

    ?>
    