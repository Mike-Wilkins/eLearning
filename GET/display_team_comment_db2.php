 
                <?php
                $team = $_SESSION['team'];
                    $getsql = "SELECT * FROM $dbtable_2 ORDER BY id DESC";
                    $data = $con -> query($getsql);

                    foreach($data AS $row){  
                        if($row['team'] == $team) {
                        ?>
                        <div style=
                        "background-color:  <?php echo $row['colour']?>;
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