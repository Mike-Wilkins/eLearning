<?php
require('../dbconnect.php');
$con = CreateConnection();
$dbtable = $_GET['dbtable'];
$page = $_GET['page'];

session_start();

$b_success = false;
    
    $ins_stmt = "";

    if(isset($_POST['review_comment']) && isset($_POST['submit_review'])){
        $comment = $_POST['review_comment'];
        $submit = $_POST['submit_review'];
        $colour = $_SESSION['colour'];
        $team = $_SESSION['team'];
       

            if($comment) {
                $sql = "INSERT INTO $dbtable (comment, colour, team) VALUES (:comment, :colour, :team)";
                $ins_stmt = $con-> prepare($sql);
                $ins_stmt -> bindValue(':comment', $comment);
                $ins_stmt -> bindValue(':colour', $colour);
                $ins_stmt -> bindValue(':team', $team);
                $ins_stmt -> execute();
            };
    };
    $con = null;
    header("location: $page");

?>