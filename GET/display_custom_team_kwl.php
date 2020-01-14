<?php
$sql = "SELECT * FROM custom_team";
$logindata = $con-> query($sql);

foreach($logindata AS $row) {
    if($row['myteam'] == $custom_team) { ?>

        <div style="
        color: #5900b3;
        text-align: center;
        margin-top: 0px;

        ">
        <?php
            echo $row['user1'] . '<br>';
            echo $row['user2'] . '<br>';
            echo $row['user3'] . '<br>';
        ?>
        </div>
        <?php
    }
} 
?>