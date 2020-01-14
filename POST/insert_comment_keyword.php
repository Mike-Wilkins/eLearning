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

        $comment_lower = strtolower($comment);

            if(strpos($comment_lower, 'moon') !== false || 
               strpos($comment_lower, 'sun') !== false || 
               strpos($comment_lower, 'gravity') !== false || 
               strpos($comment_lower, 'orbit') !== false || 
               strpos($comment_lower, 'axis') !== false || 
               strpos($comment_lower, 'season') !== false || 
               strpos($comment_lower, 'year') !== false || 
               strpos($comment_lower, 'night') !== false || 
               strpos($comment_lower, 'day') !== false)
               
               {
                $keyword_invalid = false;

                $sql = "INSERT INTO $dbtable (comment, colour, team, username) VALUES (:comment, :colour, :team, :username)";
                $ins_stmt = $con-> prepare($sql);
                $ins_stmt -> bindValue(':comment', $comment);
                $ins_stmt -> bindValue(':colour', $colour);
                $ins_stmt -> bindValue(':team', $team);
                $ins_stmt -> bindValue(':username', $username);
                $ins_stmt -> execute();
            }else{
               $keyword_invalid = true;
              
            }
    };
    $con = null;
    header("location: $page$keyword_invalid"); 

?>