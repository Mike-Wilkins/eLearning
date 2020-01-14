
            <?php
            if(isset($_SESSION['username']) && isset($_SESSION['team'])){
                $username = $_SESSION['username'];
                $team = $_SESSION['team'];
                $sql = "UPDATE login SET login_status = true WHERE username = :username";
                $ins_stmt = $con-> prepare($sql);
                $ins_stmt -> bindValue('username', $username);
                $ins_stmt -> execute();

                
                $sql = "SELECT * FROM login WHERE login_status = true";
                $logindata = $con-> query($sql);

                foreach($logindata AS $row) {
                   if($row['team'] == $team) {
                        echo $row['username'] . '<br>';
                    }
                } 
            }
            else
            {
                header("location: login.php");
            }
            ?>