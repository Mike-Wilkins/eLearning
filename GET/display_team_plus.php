   <?php
        $getsql = "SELECT plus_team FROM login WHERE username = :username";
        $stmt = $con -> prepare($getsql);
        $stmt -> bindValue(':username', $username);
        $result = $stmt -> execute();
        $rows = $stmt -> fetchAll();

        $_SESSION['plus_team'] = $rows[0]['plus_team'];
        $plus_team = $_SESSION['plus_team'];

        $sql = "SELECT * FROM login";
        $logindata = $con-> query($sql);

        foreach($logindata AS $row) {
            if($row['team'] == $plus_team) { ?>

                <div style="
                color:  <?php echo $row['colour']?>; 
                background-color: #000d1a;
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