<?php
$username = $_SESSION['username'];
    $getsql = "SELECT * FROM $dbtable_3 ORDER BY id DESC";
    $data = $con -> query($getsql);

    foreach($data AS $row){  
        if($row['username'] == $username) {
        ?>
        <div style=
        "background-color:  <?php echo $row['colour']?>;
        border-radius: 10px;
        margin: 10px;
        padding: 12px;
        
        ">
            <?php echo $row['comment'] . '<br>' . '<br>';?>   
        </div>
       
    <?php
    }
}
?>