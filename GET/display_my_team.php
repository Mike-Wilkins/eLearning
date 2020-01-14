<?php
    $team = $_SESSION['team'];
    $sql = "SELECT * FROM login";
    $logindata = $con-> query($sql);

    foreach($logindata AS $row) {
        if($row['team'] == $team) {?>

            <div style="
            color:  <?php echo $row['colour']?>; 
            background-color: #1d2526;
            text-align: center;
            padding: 2px;
            width: 70px;
            border-radius: 10px;
            margin-top: 3px;
            ">
                <?php
                    echo $row['username'] . '<br>';
                ?>
            </div>
            <?php
                    }
                } 
            ?>