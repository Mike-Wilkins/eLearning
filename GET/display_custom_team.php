<?php
$username = $_SESSION['username'];

            $sql = "SELECT * FROM custom_team";
                $logindata = $con-> query($sql);
                  
                foreach($logindata AS $row) 
                {   
                    if($row['user1'] == $username || $row['user2'] == $username || $row['user3'] == $username) {
                        ?>
                        <div class="my_custom_teams">
                            <div class="custom_link">
                                <a href="know_custom_1.php?custom_team=<?php echo $row['myteam']?>" style="text-decoration: none"><?php echo $row['myteam'] . '<br>';?></a>
                            </div>
                            <?php
                                echo $row['user1'] . '<br>';
                                echo $row['user2'] . '<br>';
                                echo $row['user3'] . '<br>' . '<br>';
                                        
                            ?>
                        </div>
                        
                    <?php
                    }
                } 
?>