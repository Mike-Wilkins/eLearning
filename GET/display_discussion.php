
            <?php
                $getsql = "SELECT * FROM $discussion_table ORDER BY id DESC";
                $data = $con -> query($getsql);

                    foreach($data AS $row) {?>
                        <div id="comment_container">
                        <?php echo "From: " . $row['username'] . '<br>' . $row['comment'];?>
                        </div>
                        <?php
                    }
                   
            ?>