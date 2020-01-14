<?php
require('../dbconnect.php');
$con = CreateConnection();
$dbtable = $_GET['dbtable'];
$page = $_GET['page'];

session_start();

$b_success = false;
    
    $ins_stmt = "";

    if(isset($_POST['Know_Comment']) && isset($_POST['submit_know']) && isset($_POST['weblink'])){
        $comment = $_POST['Know_Comment'];
        $weblink = $_POST['weblink'];
        $submit = $_POST['submit_know'];
        $colour = $_SESSION['colour'];
        $team = $_SESSION['team'];
        $username = $_SESSION['username'];

            if($comment) {
                $sql = "INSERT INTO $dbtable (comment, colour, team, username, website) VALUES (:comment, :colour, :team, :username, :website)";
                $ins_stmt = $con-> prepare($sql);
                $ins_stmt -> bindValue(':comment', $comment);
                $ins_stmt -> bindValue(':website', $weblink);
                $ins_stmt -> bindValue(':colour', $colour);
                $ins_stmt -> bindValue(':team', $team);
                $ins_stmt -> bindValue(':username', $username);
                $ins_stmt -> execute();
            };
    };
    $con = null;
    header("location: $page");
?>