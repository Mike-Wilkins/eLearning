<?php
    require('../dbconnect.php');
    $con = CreateConnection();
    $dbtable = "know_comment_plus";
    $page = "../KWL_Plus/know_plus_2.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Know +</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="kwl_plus_styles.css" />
    <script src="comments.js"></script>
</head>
<body>

    <header id="login_header">
    
        <div>
            <input class="nav-button" type="button" value="Home" onclick="window.location.href='../home.php'" />
        </div>

        <div>
            <input class="nav-button" type="button" value="Logout" onclick="window.location.href='../logout.php'" />
        </div>


        <div class="welcome-user">
                <?php
                  session_start(); 

                    if(isset($_SESSION['username'])){
                        echo 'Welcome team ' . $_SESSION['team'];  
                    }
                    else
                    {
                        header("location: login.php");
                    }
                ?>
        </div>
        <div>         
                <?php

                        $username = $_SESSION['username'];
                        $sql = 'SELECT symbol FROM login WHERE (username = :username)';
                        $stmt = $con -> prepare($sql);
                        $stmt -> bindValue(':username', $username);
                        $result = $stmt -> execute();
                        $rows = $stmt -> fetchAll();

                    $_SESSION['symbol'] = $rows[0]['symbol'];
                        $symbol = $_SESSION['symbol'];
                ?>
                
                    <img src="../<?php echo $symbol?>" style="width: 70px; height: 70px; position: absolute; left: 290px; top: 20px;">   
        </div>
        <div>
                <img src="../images/planet-earth.jpg" style="width: 60px; height: 60px; position: absolute; left: 1050px; top: 28px;">
                <p style="font-size: 40px; position: absolute; left: 800px; top: 0px;">Planet Earth</p>
        </div>

   </header>
  
<!-- Display my team -------------------------------------------------------------------------------------------->
<section>
    <div class="student-login-display">

        <div class="myteams">
            <p style="font-size: 18px;">Team A</p>

            <?php
                require('../GET/display_my_team.php');
            ?>
        </div>

<!-- Display Fellow Team --------------------------------------------------------------------------------------->
        
        <div class="myteams">

            <p style="font-size: 18px;">Team B</p>
            <?php
                require('../GET/display_team_plus.php');
            ?>
        </div>

<!-- Display who is logged in ----------------------------------------------------------------------------------->
        <div class="myteams">
            <p style="text-decoration: underline">Logged In</p>
            
            <?php
                require('../GET/display_logged_in_plus.php');
            ?>
        </div>
    </div>

<!------------------------------------- KWL Display ------------------------------------------------------------->
    <div class="kwl-display">
    
    <div class="kwltabs">
        <ul>
            <li><a href="know_plus_2.php" id="onlink">Know</a></li>
            <li><a href="what_plus_1.php">What</a></li>
            <li><a style="color: grey">Learned</a></li>
        </ul>
    </div>
       
 <div class="kwl-container">
        <?php
             require('../GET/create_team_colour.php');
        ?>
        <section>
            <form id="comment_form" action="../POST/insert_comment.php?dbtable=<?php echo $dbtable?>&page=<?php echo $page?>" method="post">
                <textarea class="know_comments" name="Know_Comment" rows="2" cols="70" maxlength="100" placeholder="Enter what you know here"></textarea><br>
                <input id="know_button" name="submit_know" type="submit" value="I Know"> 
            </form>
        </section>

<!-- Disply KWL column titles ------------------------------------------------------------------------------------------------->

<section>
<div class="list_title" style="padding-left: 200px;">
        <p class="title_text" style="float: left">Team </p>
        <img src="../<?php echo $symbol?>" style="width: 55px; height: 53px;">
    </div>
    <div class="list_title" style="padding-left: 200px;">
        <p class="title_text" style="float: left">Team </p>
        <?php
                $team = $_SESSION['team'];
                $getsql ="SELECT DISTINCT symbol, plus_team FROM login";
                $data = $con -> query($getsql);

                foreach($data AS $row) {
                   if($team == $row['plus_team']){
                        $teamx = $row['symbol'];
                    } 
                }
            ?>
               <img src="../<?php echo $teamx?>" style="width: 55px; height: 55px;">
    </div>
</section>


<!-- Display team know comments ----------------------------------------------------------------------------------------------->

    <section>
            <div class="myteam_container">
                <?php
                    require('../GET/display_team_comment.php');
                ?>
            </div>

<!-- Display teamx know comments ---------------------------------------------------------------------------------------------->

            <div class="teamx_container">
                <?php
                    require('../GET/display_teamX_comment.php');
                ?>

            </div>
        </section>    
    </div>
   </div>

<!-- Student Guidance -------------------------------------------------------------------------------------->

    <div class="comment-display">
        <div style="margin-left: 60px;">
            <img src="../images/KNOW_balloon.png" width="170" height="90"><br>
        </div>
        <div style="margin-left: 20px;">
            <img src="../images/owl_teacher.png" width="90" height="90">
        </div>
      
      <div class="blackboard">
      <p class="student_guidance">
                Excellent!!.....you should now be able to see facts entered by the rest of your team and ready to move on to the next stage.
            </p>
                
            <p class="student_guidance">
                Remember, you can keep adding additional facts to the team list at any point.
            </p>
            <p class="student_guidance">
                When you are ready, click the "What" tab to move on to the next stage.
            </p>
                
      </div>
    </div>
</section>


<footer>

</footer>

</body>
</html>