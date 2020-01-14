<?php
    require('../dbconnect.php');
    $con = CreateConnection();
    $error_message = urldecode($_SERVER['QUERY_STRING']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Create Team</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="custom_team_styles.css" />
    <script src="comments.js"></script>
</head>
<body>

    <header id="home_header">
        
    <div>
          <input class="nav-button" type="button" value="Home" onclick="window.location.href='../home.php'" />
    </div>
   
    <div class="KWL-images">
        <img src="../images/KWL_custom_team.png" width="130" height="80">
    </div>

    <div>
          <input class="nav-button" type="button" value="Logout" onclick="window.location.href='../logout.php'" />
    </div>
   
    <div class="welcome-class">
            <?php
                

                session_start();

                if(isset($_SESSION['username'])){
                    echo 'Welcome to the Classroom ' . $_SESSION['username'];
                    
                }
                
                else
                {
                    header("location: login.php");
                }

             ?>
    </div>
    
   </header>

<section>

<!-- Display my custom teams -------------------------------------------------------------------------------------------->

<div class="customteam-display">
        <div class="myteams_label">
            <p>My Teams</p>
        </div>
        <div>
            <?php
                require('../GET/display_custom_team.php');
            ?>
        </div>
    </div>

<!-- Display guest and team input error message ------------------------------------------------------------------------------------------->
<?php

if($error_message =="guest_error"){
    
    ?>
     <img class="guest_error_2 fade" src="../images/guest_error_2.png">
    <?php
}

if($error_message =="team_error"){
    
    ?>
     <img class="team_error fade" src="../images/team_error.png">
    <?php
}

?>

<!-- Create a team --------------------------------------------------------------------------------------------------------------->

   <div class="classroom-display">
        <p class="create_title">Create a Team</p>
        <form id="login_form" action="../POST/insert_custom_team.php" method="post">
           
            <?php
                $sql = "SELECT * FROM login";
                $data = $con -> query($sql);
            ?>
                <section>
                    <div class="custom_team_details" style="height: 200px;">
                        <input class="login_details" name="guest1" value="<?php echo($username)?>" readonly="true"><br>
                            <select class="select_guest" name="guest2" placeholder="Enter guest 1">
                                
                                <option value="" disabled selected >Choose guest 1</option>
                                    <?php
                                        foreach($data AS $row) { ?>
                                            <option value="<?php echo $row['username']; ?>"> <?php echo $row['username']?> </option><?php
                                        }
                                    ?>
                                    
                                    <?php
                                        $sql = "SELECT * FROM login";
                                        $data = $con -> query($sql);
                                    ?>
                                
                            </select>
    
                            <input class="add-minus-button" type="button" value="Minus" onclick="window.location.href='create_team.php'" />    
                        
               
                        <select class="select_guest" name="guest3" placeholder="Enter guest 2">
                            <option value="" disabled selected>Choose guest 2</option>
                            <?php
                                foreach($data AS $row) { ?>
                                    
                                    <option value="<?php echo $row['username']; ?>"> <?php echo $row['username']?> </option><?php
                                }
                            ?>
                        </select>
                    </div>
                </section>
                <section>
                            <div class="custom_team_details" style="padding-bottom: 20px;">
                                <input class="login_details" name="custom_team" placeholder="Enter team name"><br>
                            </div>
                </section>

            <input id="login_submit" name="submit" type="submit" value="Create Team">
        </form>
   </div>
   
</section>

<footer class="home-footer" style="margin-top: 270px;">

</footer>

</body>
</html>