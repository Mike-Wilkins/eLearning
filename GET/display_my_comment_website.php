<?php
                $team = $_SESSION['team'];
                $username = $_SESSION['username'];
                    $getsql = "SELECT * FROM $dbtable ORDER BY id DESC";
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
                            <?php echo $row['comment'] . '<br>' . '<br>'?>
                            <a href=" <?php  echo $row['website']?> " target="_blank"><?php  echo $row['website']?></a>  
                        </div>
                    <?php
                    }
                }
?>