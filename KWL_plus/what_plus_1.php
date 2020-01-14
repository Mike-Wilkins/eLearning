<?php
    require('../dbconnect.php');
    $con = CreateConnection();
    $dbtable = "what_comment_plus";
    $page = "../KWL_Plus/what_plus_1.php";
    $page2 = "what_plus_2.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>What +</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="kwl_plus_styles.css" />
    <script src="comments.js"></script>
</head>
<body>

<!-- Header ----------------------------------------------------------------------------------------------------------------------->

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

<!-- Entry Counter ----------------------------------------------------------------------------------------------------------------------->

<?php
     require('../GET/comment_counter.php');
?>
  
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
            <li><a href="know_plus_2.php">Know</a></li>
            <li><a href="what_plus_1.php" id="onlink">What</a></li>
            <li><a style="color: grey">Learned</a></li>
        </ul>
    </div>

 <div class="kwl-container">
        <?php
             require('../GET/create_team_colour.php');
        ?>
        <section>
            <form id="comment_form" action="../POST/insert_comment.php?dbtable=<?php echo $dbtable?>&page=<?php echo $page?>" method="post">
                <input id="submit_question_button" name="submit_know" type="submit" value="Submit Question"> 
                <textarea class="know_comments" name="Know_Comment" rows="2" cols="70" maxlength="100" placeholder="Enter what you want to know here"></textarea>
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

<!-- Display myteam questions -------------------------------------------------------------------------------------------------->

    <section>
            <div class="myteam_container">
                <?php
                    require('../GET/display_my_comment.php');
                ?>
            </div>

<!-- Display teamx questions ------------------------------------------------------------------------------------------------------->

            <div class="teamx_container">
                <p style="text-align: center; margin-top: 30px; color: #99004d; font-weight: bold">Enter three questions to unlock this team</p> 
            </div>
        </section>    
    </div>
   
   </div>

<!-- Student Guidance -------------------------------------------------------------------------------------->

    <div class="comment-display">
    <div style="margin-left: 60px;">
            <img src="../images/WANT_balloon.png" width="170" height="90"><br>
        </div>
        <div style="margin-left: 20px;">
            <img src="../images/owl_teacher.png" width="90" height="90">
        </div>
    
      <div class="blackboard">
                <p class="student_guidance">
                    Discuss with the other members of your team and the team you are working with what you would like to know about planet Earth.
                    If you can, try and relate your questions to the facts you already know. 
                </p>

                <p class="student_guidance">
                    To move on to the next stage you will need to <span style="color: #ff8566"> enter at least three questions.</span>
                </p>
                
                <p class="student_guidance">
                    When you are ready, enter your questions in the form to the left. 
                </p>
                <p class="student_guidance">
                    Click the "Learned" tab when you are ready to move on to the final stage.
                </p> 
      </div>
    </div>
</section>

<footer>

</footer>

</body>
</html>