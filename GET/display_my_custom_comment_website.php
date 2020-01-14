<?php
$getsql = "SELECT * FROM learned_custom_team ORDER BY id DESC";
$data = $con -> query($getsql);

foreach($data AS $row){  
 
    ?>
    <div style=
    "background-color: #eeccff;
    border-radius: 10px;
    margin: 10px;
    padding: 12px;
    
    ">
        <?php echo $row['comment'] . '<br>' . '<br>'?>
        <a href=" <?php  echo $row['website']?> " target="_blank"><?php  echo $row['website']?></a>
    </div>
<?php

}
?>
