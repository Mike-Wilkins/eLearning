<?php
 $counter = 0;
 $username = $_SESSION['username'];
            
 $getsql = "SELECT * FROM $dbtable ORDER BY id DESC";
 $data = $con -> query($getsql);

 foreach($data AS $row) {
    if($row['username'] == $username) {
        $counter++;
    }
 }

 if($counter >= 3) {
    header("location: $page2");
 }
?>