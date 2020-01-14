<?php
    $team = $_SESSION['team'];
    $getsql = "SELECT * FROM $dbtable ORDER BY id DESC";
    $data = $con -> query($getsql);

        foreach($data AS $row){  
            ?>
            <div style=
                "background-color:  <?php echo $row['colour']?>;
                border-radius: 10px;
                margin: 10px;
                padding: 12px;
                                
                ">
                <?php echo $row['comment']?>
            </div>
            <?php
            }
?>