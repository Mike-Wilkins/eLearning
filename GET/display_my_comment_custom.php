<?php
 $getsql = "SELECT * FROM $dbtable ORDER BY id DESC";
 $data = $con -> query($getsql);

 foreach($data AS $row){  
     if($row['team'] == $custom_team) {
     ?>
     <div style=
     "background-color: #ccccff;
     border-radius: 10px;
     min-height: 70px;
     margin: 10px;
     padding: 12px;
     ">
         <?php echo $row['comment']?>
     </div>
 <?php
 }
}
?>