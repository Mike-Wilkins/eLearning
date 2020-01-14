<?php
require('../dbconnect.php');
$con = CreateConnection();
$dbtable = $_GET['dbtable'];
$page = $_GET['page'];

session_start();

$b_success = false;
    
    $ins_stmt = "";

    if(isset($_POST['Know_Comment']) && isset($_POST['submit_know'])){
        $comment = $_POST['Know_Comment'];
        $submit = $_POST['submit_know'];
        $colour = $_SESSION['colour'];
        $team = $_SESSION['team'];
        $username = $_SESSION['username'];

            if($comment) {
                $sql = "INSERT INTO $dbtable (comment, colour, team, username) VALUES (:comment, :colour, :team, :username)";
                $ins_stmt = $con-> prepare($sql);
                $ins_stmt -> bindValue(':comment', $comment);
                $ins_stmt -> bindValue(':colour', $colour);
                $ins_stmt -> bindValue(':team', $team);
                $ins_stmt -> bindValue(':username', $username);
                $ins_stmt -> execute();
            }
    };
    $con = null;
    header("location: $page"); 

?>