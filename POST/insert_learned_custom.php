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
        $team = $_SESSION['team'];
        $custom_team = urldecode($_GET['custom_team']);

            if($comment) {
                $sql = "INSERT INTO learned_custom_team (comment, team, website) VALUES (:comment, :team, :website)";
                $ins_stmt = $con-> prepare($sql);
                $ins_stmt -> bindValue(':comment', $comment);
                $ins_stmt -> bindValue(':team', $custom_team);
                $ins_stmt -> bindValue(':website', $weblink);
                $ins_stmt -> execute();
            };
    };
    header("location: $page?custom_team=$custom_team");
?>