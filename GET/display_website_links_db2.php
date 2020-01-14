<?php
    $team = $_SESSION['team'];

    $getsql ="SELECT website FROM $dbtable_2 ORDER BY id DESC";
    $data = $con -> query($getsql);
?>
    <ul style="list-style-type:circle;">
        <?php
            foreach($data AS $row) {
        ?>
            <li>  <a href=" <?php  echo $row['website']?> " target="_blank"><?php  echo $row['website']?></a> </li><br>
        <?php
        }
        ?>
    </ul>        