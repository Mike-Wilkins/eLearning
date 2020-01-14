<?php
    require('../dbconnect.php');
    $con = CreateConnection();
    $custom_team = $_GET['custom_team'];
    $dbtable = "what_custom_team";
    $dbtable_2 = "know_custom_team";
    $page = "../Custom_Team/what_custom.php";
    $discussion_table = "what_discussion_custom";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>What</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../CSS/styles1.css" />
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
    <div>
            <input class="nav-button" type="button" value="My Teams" onclick="window.location.href='create_team.php'" />
    </div>

    <div class="welcome-user" style="margin-left: 120px;">
            <?php
                session_start();

                if(isset($_SESSION['username'])){
                    echo 'Welcome ' . $custom_team;
                }
                
                else
                {
                    header("location: login.php");
                }
             ?>
    </div>
    <div>         
            
                <img src="../images/KWL_custom_team.png" style="width: 85px; height: 85px; position: absolute; left: 90px; top: 15px;">

                <div>
                    <img src="../images/planet-earth.jpg" style="width: 60px; height: 60px; position: absolute; left: 1250px; top: 28px;">
                    <img src="../images/saturn.png" style="width: 90px; height: 90px; position: absolute; left: 1400px; top: 20px;">
                    <img src="../images/jupiter.png" style="width: 80px; height: 80px; position: absolute; left: 1320px; top: 18px;">
                    <p style="font-size: 40px; position: absolute; left: 600px; top: 0px;">Our Solar System and the Planets</p>
                </div>   
    </div>
      
   </header>

<!-- Display my custom team -------------------------------------------------------------------------------------------->

<section>
    <div class="student-login-display">
        <div class="myteams" style="padding-left: 0px;">
            <p style="font-size: 18px; text-align: center;">My Team</p>
            
            <?php
                require('../GET/display_custom_team_kwl.php');
            ?>
        </div>

<!-- Display who is logged in ----------------------------------------------------------------------------------->

        <div class="myteams">
            <p style="font-size: 18px">Logged In</p>   

            <?php
                require('../GET/display_logged_in.php');
            ?>
        </div>
    </div>

<!-- KWL Display -------------------------------------------------------------------------------------------------->

    <div class="kwl-display">
       
    <div class="kwltabs">
        <ul>
            <li><a href="know_custom.php?custom_team=<?php echo($custom_team)?>">Know</a></li>
            <li><a href="what_custom.php?custom_team=<?php echo($custom_team)?>" id="onlink">What</a></li>
            <li><a href="learned_custom.php?custom_team=<?php echo($custom_team)?>">Learned</a></li>
            
        </ul>
    </div>
    <div class="kwl-container">

<!-- Input Form ---------------------------------------------------------------------------------->
    <section>
        <form id="comment_form" action="../POST/insert_comment_custom.php?custom_team=<?php echo ($custom_team)?>&dbtable=<?php echo $dbtable?>&page=<?php echo $page?>" method="post">
            <input id="submit_question_button" name="submit_know" type="submit" value="Submit Question"> 
            <textarea class="know_comments" name="Know_Comment" rows="2" cols="70" maxlength="100" placeholder="Enter what you want to know here"></textarea>
        </form>
    </section>
<!-- Titles --------------------------------------------------------------------------------------->
    <section>
        <div class="display_facts" style="height: 60px; margin-bottom: 8px; overflow: hidden">
            <p class="title_text">What we know</p>
        </div>
        <div class="display_questions" style="height: 60px; margin-bottom: 8px; overflow: hidden">
            <p class="title_text">What we want to know</p>
        </div>
    </section>

<!-- ************************ What we know ***************************************************** -->
        <section>
            <div class="display_facts">
               <div style="margin-top: 5px">
                <?php
                    require('../GET/display_my_comment_custom_db2.php');
                ?>
          
            </div> 

            </div>
<!-- ************************ What we Want to Know ***************************************************** -->

            <div class="display_questions" style="word-wrap: break-word;">

            <div style="margin-top: 5px">
                <?php
                    require('../GET/display_my_comment_custom.php');
                ?>
          
            </div>

            </div>
        </section>
        <?php
        ?>
       
    </div>
    
    </div>

<!------------------------------------ Student Guidance ----------------------------------------------------------------------------------->
    
   <div class="comment-display">
        
        <div style="margin-left: 60px;">
                <img src="../images/WANT_balloon.png" width="170" height="90"><br>
        </div>
        <div style="margin-left: 20px;">
                <img src="../images/owl_teacher.png" width="90" height="90">
        </div>

        <div class="blackboard">
                <p class="student_guidance">
                    Discuss with the other members of your team what you would like to know about our solar system and the planets.
                    If you can, try and relate your questions to the facts you already know. 
                </p>
                <p class="student_guidance">
                    When you are ready, enter your questions
                    in the form to the left. 
                </p>
                <p class="student_guidance">
                    Click the "Learned" tab when you are ready to move on to the final stage.
                </p>
                
        </div>
  
    </div>

</section>

<!-- Student forum ------------------------------------------------------------------------------------------------------------------>

<div class="chat">

        <form id="comment_form" action="../POST/insert_discussion_custom.php?custom_team=<?php echo ($custom_team)?>&dbtable=<?php echo $discussion_table?>&page=<?php echo $page?>" method="post">
            <div class="titleformat">
                <p>What would you like to know about the planets?...share your questions with other students</p>
            </div>
           
            <textarea id="comments" name="Comment" rows="8" cols="70" maxlength="200" placeholder="Please type your comment here (200 characters maximum)"></textarea><br>
            <span id="wordCount">200</span> characters remaining <br>
            <input id="comment_button" name="submit" type="submit" value="Comment"> 
        </form>
        
        <p class="titleformat">Comments</p>

        <div class="scroll_chats">
            <?php
                require('../GET/display_discussion.php');
            ?>
        </div>
    </div>


<footer style="margin-top: 900px;">

</footer>

</body>
</html>