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
        $custom_team = urldecode($_GET['custom_team']);

            if($comment) {
                $sql = "INSERT INTO $dbtable (comment, team) VALUES (:comment, :team)";
                $ins_stmt = $con-> prepare($sql);
                $ins_stmt -> bindValue(':comment', $comment);
                $ins_stmt -> bindValue(':team', $custom_team);
                $ins_stmt -> execute();
            };
    };
    
  header("location: $page?custom_team=$custom_team");
  

?>