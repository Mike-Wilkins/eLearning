<?php
require('../dbconnect.php');
$con = CreateConnection();

session_start();

$b_success = false;
    
    $ins_stmt = "";

    if(isset($_POST['custom_team']) && isset($_POST['guest1']) && isset($_POST['guest2']) && isset($_POST['guest3']) && isset($_POST['submit'])){
        $custom_team = $_POST['custom_team'];
        $guest1 = $_POST['guest1'];
        $guest2 = $_POST['guest2'];
        $guest3 = $_POST['guest3'];
        $submit = $_POST['submit'];

        $sql = "SELECT * FROM custom_team";
        $logindata = $con-> query($sql);
        foreach($logindata AS $row){
             if($custom_team == $row['myteam']){
                $message = "team_error";
            }
        }

        if($message != "team_error"){
            if($custom_team && $guest1 != $guest2 && $guest1 != $guest3 && $guest2 != $guest3) {
                $sql = "INSERT INTO custom_team (myteam, user1, user2, user3) VALUES (:myteam, :user1, :user2, :user3)";
                $ins_stmt = $con-> prepare($sql);
                $ins_stmt -> bindValue(':myteam', $custom_team);
                $ins_stmt -> bindValue(':user1', $guest1);
                $ins_stmt -> bindValue('user2', $guest2);
                $ins_stmt -> bindValue(':user3', $guest3);
                $ins_stmt -> execute();

            }else{
                $message = "guest_error";
            }
        }
    };
    $con = null;
    header("location: ../Custom_Team/create_team_2guests.php?$message");
    
?>