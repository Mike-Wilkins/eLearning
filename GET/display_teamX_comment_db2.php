<?php
$plus_team = $_SESSION['plus_team'];
                    $getsql = "SELECT * FROM $dbtable_2 ORDER BY id DESC";
                    $data = $con -> query($getsql);

                    foreach($data AS $row){  
                        if($row['team'] == $plus_team) {
                        ?>
                        <div style=
                        "background-color:  <?php echo $row['colour']?>;
                        width: 95%;
                        border-radius: 10px;
                        margin: 10px;
                        padding: 12px;
                        min-height: 60px;
                        ">
                            <?php echo $row['comment']?>
                        </div>
                    <?php
                    }
                }
?>