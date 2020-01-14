<?php
require('../dbconnect.php');
$con = CreateConnection();
$dbtable = $_GET['dbtable'];
$page = $_GET['page'];
$custom_team = urldecode($_GET['custom_team']);

session_start();

$b_success = false;
    
    $ins_stmt = "";

    if(isset($_POST['review_comment']) && isset($_POST['submit_review'])){
        $comment = $_POST['review_comment'];
        $submit = $_POST['submit_review'];
       

            if($comment) {
                $sql = "INSERT INTO kwl_custom_review (comment) VALUES (:comment)";
                $ins_stmt = $con-> prepare($sql);
                $ins_stmt -> bindValue(':comment', $comment);
                $ins_stmt -> execute();
            };
    };
    $con = null;
    header("location: $page?custom_team=$custom_team");

?>