<?php

function CreateConnection() {
    require_once 'credentials.php';

    $dbhost = "mysql:host=$host;dbport=$dbport;dbname=$dbname";
    //create the PDO object
    $dbconn = new PDO($dbhost, $username, $password);
    return $dbconn;

    
}
/*
$con = CreateConnection();
 //test that you have successfully created a connection
var_dump($con);

success looks like:
object(PDO)#1 (0) { } 

*/