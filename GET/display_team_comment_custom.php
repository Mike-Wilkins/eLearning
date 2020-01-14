<?php
$getsql = "SELECT * FROM $dbtable ORDER BY id DESC";
$data = $con -> query($getsql);

foreach($data AS $row){  
    ?>
    <div style=
    "background-color: #eeccff;
    border-radius: 10px;
    min-height: 70px;
    margin: 10px;
    padding: 12px;
    
    ">
        <?php echo $row['comment'] . '<br>' . '<br>';?>
    </div>
   
<?php
}
?>