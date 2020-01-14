<?php
    require('../dbconnect.php');
    $con = CreateConnection();
    $dbtable = "know_comment";
    $page = "../Go_Solo/know_solo.php";
    $discussion_table = "know_discussion";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Know</title>
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

                <div>

                    <img src="../images/planet-earth.jpg" style="width: 60px; height: 60px; position: absolute; left: 1250px; top: 28px;">
                    <img src="../images/saturn.png" style="width: 90px; height: 90px; position: absolute; left: 1400px; top: 20px;">
                    <img src="../images/jupiter.png" style="width: 80px; height: 80px; position: absolute; left: 1320px; top: 18px;">
                   
        
                    <p style="font-size: 40px; position: absolute; left: 600px; top: 0px;">Our Solar System and the Planets</p>
                </div>
                    
                
    </div>
      
   </header>

<!-- Display my team -------------------------------------------------------------------------------------------->

<section>
    <div class="student-login-display">
        <div class="myteams">
            <p style="font-size: 18px">My Team</p>
        
            <?php
                require('../GET/display_my_team.php');
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

    <div class="kwl-display">
        <div>
            <input class="nav-button" type="button" value="Team" onclick="window.location.href='../KWL_Team/know.php'" />
        </div>
       
    <div class="kwltabs">
        <ul>
            <li><a href="know_solo.php" id="onlink">Know</a></li>
            <li><a href="what_solo.php">What</a></li>
            <li><a href="learned_solo.php">Learned</a></li>
            
        </ul>
    </div>
    <div class="kwl-container">

<!-- Insert know comments ----------------------------------------------------------------------------------------------------------------->


    <section>
        <form id="comment_form" action="../POST/insert_comment.php?dbtable=<?php echo $dbtable?>&page=<?php echo $page?>" method="post">
            <input id="submit_question_button" name="submit_know" type="submit" value="I Know"> 
            <textarea class="know_comments" name="Know_Comment" rows="2" cols="70" maxlength="100" placeholder="Enter what you know here"></textarea>
        </form>
    </section>

    <section>
        <div class="display_facts" style="height: 60px; margin-bottom: 8px; overflow: hidden">
            <p class="title_text">What I know</p>
        </div>
    </section>

<!-- ************************ What we know ***************************************************** -->

        <section>
            <div class="display_facts">
                <div>
                
                <?php
                    require('../GET/display_my_comment.php');
                ?>
          
            </div> 



            </div>
<!-- ************************ Keywords ***************************************************** -->

            <div class="display_questions" style="height: 300px;">

            <p class="keyword_title">
                    Use the keywords below to help you.
                </p>
                 <table style="width: 70%; margin: auto; margin-bottom: 20px;">
                    <tr>
                        <td><img src="../images/key_moon.png" width="70" height="60"></td>
                        <td><img src="../images/orbit.png" width="70" height="60"></td>
                        <td><img src="../images/key_day.png" width="70" height="60"></td>
                    </tr>
                    <tr>
                        <td><img src="../images/key_year.png" width="70" height="60"></td>
                        <td><img src="../images/key_sun.png" width="70" height="60"></td>
                        <td><img src="../images/key_axis.png" width="70" height="60"></td>
                    </tr> 
                    <tr>
                        <td><img src="../images/key_night.png" width="70" height="60"></td>
                        <td><img src="../images/key_gavity.png" width="70" height="60"></td>
                        <td><img src="../images/seasons.png" width="70" height="60"></td>
                    </tr> 

                </table>

            </div>
        </section>
    </div>
    </div>

<!------------------------------------ Student Guidance ----------------------------------------------------------------------------------->
    
   <div class="comment-display">
        
        <div style="margin-left: 60px;">
                <img src="../images/KNOW_balloon.png" width="170" height="90"><br>
        </div>
        <div style="margin-left: 20px;">
                <img src="../images/owl_teacher.png" width="90" height="90">
        </div>

        <div class="blackboard">
            <p class="student_guidance">
                Using the form on the left, enter any facts that you know about our solar system and the planets.
            </p>
                
            <p class="student_guidance">
                Add your ideas to the student forum below. Can you think of a fact that no one else has mentioned?
            </p>
            <p class="student_guidance">
                When you are ready, click the "What" tab to move on to the next stage.
            </p>
                
        </div>
  
    </div>

</section>

<!-- Student forum ---------------------------------------------------------------------------------------------------------->

<div class="chat">

        <form id="comment_form" action="../POST/insert_discussion.php?dbtable=<?php echo $discussion_table?>&page=<?php echo $page?>" method="post">
            <div class="titleformat">
                <p>Share what you know about the planets and the solar system with other students</p>
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