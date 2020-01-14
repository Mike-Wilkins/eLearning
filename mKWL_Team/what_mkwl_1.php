<?php
    require('../dbconnect.php');
    $con = CreateConnection();
    $dbtable = "what_comment_mkwl";
    $dbtable_2 = "know_comment_mkwl";
    $page = "../mKWL_Team/what_mkwl_1.php";
    $page2 = "what_mkwl_2.php";
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
                    <img src="../images/forces8.png" style="width: 210px; height: 70px; position: absolute; left: 1200px; top: 25px;">
                
                   <p style="font-size: 40px; position: absolute; left: 780px; top: 0px;">Forces and Gravity</p>
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

<!-- KWL Display -------------------------------------------------------------------------------------------------->

    <div class="kwl-display">
       
    <div class="mkwltabs">
        <ul>
            <li><a href="know_mkwl_2.php" >What I think and know</a></li>
            <li><a href="what_mkwl_1.php" id ="onlink">What Questions I have</a></li>
            <li><a style="color: grey">How can I find out</a></li>
            <li><a style="color: grey">What I learned</a></li>
            
        </ul>
    </div>

<!-- Entry Counter ----------------------------------------------------------------------------------------------------------------------->

<?php
    require('../GET/comment_counter.php');
?>


<!-- Insert what comments ----------------------------------------------------------------------------------------------------------------->
    <div class="kwl-container">
        <?php
             require('../GET/create_team_colour.php');
        ?>

<!-- Input Form ---------------------------------------------------------------------------------->
    <section>
        <form id="comment_form" action="../POST/insert_comment.php?dbtable=<?php echo $dbtable?>&page=<?php echo $page?>" method="post">
            <input id="submit_question_button" name="submit_know" type="submit" value="Submit Question"> 
            <textarea class="know_comments" name="Know_Comment" rows="2" cols="70" maxlength="100" placeholder="Enter what you want to know here"></textarea>
        </form>
    </section>
<!-- Titles --------------------------------------------------------------------------------------->
    <section>
        <div class="display_facts" style="height: 60px; margin-bottom: 8px; overflow: hidden">
            <p class="title_text">What I <strong>T</strong>hink and what I <strong>K</strong>now</p>
        </div>
        <div class="display_questions" style="height: 60px; margin-bottom: 8px; overflow: hidden">
            <p class="title_text">What I <strong>W</strong>ant to know</p>
        </div>
    </section>

<!-- ************************ What I know ***************************************************** -->
        <section>
            <div class="display_facts">
                <div style="margin-top: 5px">
                <?php
                    require('../GET/display_my_comment_db2.php');
                ?>
          
            </div> 

            </div>
<!-- ************************ What I Want to Know ***************************************************** -->

            <div class="display_questions" style="word-wrap: break-word;">

            <div style="margin-top: 5px">
                <?php
                    require('../GET/display_my_comment.php');
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
                    Discuss with the other members of your team what you would like to know about forces and gravity.
                    If you can, try and relate your questions to the ideas and facts you have previously submitted. 
                </p>
                <p class="student_guidance">
                    To move on to the next stage you will need to <span style="color: #ff8566"> enter at least three questions.</span>
                </p>
        
                <p class="student_guidance">
                    When you have entered three or more questions, click the "Learned" tab to move on to the final stage.
                </p>     
        </div>
    </div>
</section>


<footer>

</footer>

</body>
</html>