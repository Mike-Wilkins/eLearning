<?php
    require('../dbconnect.php');
    $con = CreateConnection();
    $dbtable = "find_comment_mkwl";
    $dbtable_2 = "what_comment_mkwl";
    $page = "../mKWL_Team/find_mkwl.php";
    $discussion_table = "find_discussion_mkwl";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Find mKWL</title>
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
        <div>
            <input class="solo_button" style="margin-right: 15px" type="button" value="Go Solo" onclick="window.location.href='../Go_Solo_mkwl/find_solo.php'" />
        </div>
       
    <div class="mkwltabs">
        <ul>
            <li><a href="know_mkwl.php">What I think and know</a></li>
            <li><a href="what_mkwl.php">What Questions I have</a></li>
            <li><a href="find_mkwl.php " id ="onlink">How can I find out</a></li>
            <li><a href="learned_mkwl_2.php">What I learned</a></li>
            
        </ul>
    </div>


<!-- Insert what comments ----------------------------------------------------------------------------------------------------------------->
    <div class="kwl-container">
    <?php
        require('../GET/create_team_colour.php');
    ?>

<!-- Input Form ---------------------------------------------------------------------------------->
    <section>
        <form id="comment_form" action="../POST/insert_comment.php?dbtable=<?php echo $dbtable?>&page=<?php echo $page?>" method="post">
            <input id="submit_question_button" name="submit_know" type="submit" value="Submit"> 
            <textarea class="know_comments" name="Know_Comment" rows="2" cols="70" maxlength="100" placeholder="Enter how I can find out here"></textarea>
        </form>
    </section>
<!-- Titles --------------------------------------------------------------------------------------->
    <section>
        <div class="display_facts" style="height: 60px; margin-bottom: 8px; overflow: hidden">
            <p class="title_text">What we <strong>W</strong>ant to know</p>
        </div>
        <div class="display_questions" style="height: 60px; margin-bottom: 8px; overflow: hidden">
            <p class="title_text">How can I find out</p>
        </div>
    </section>

<!-- ************************ What we want to know ***************************************************** -->
        <section>
            <div class="display_facts">
                <div style="margin-top: 5px">
                <?php
                    require('../GET/display_team_comment_db2.php');
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
                <img src="../images/find_bubble.png" width="170" height="90"><br>
        </div>
        <div style="margin-left: 20px;">
                <img src="../images/owl_teacher.png" width="90" height="90">
        </div>

        <div class="blackboard">
            <p class="student_guidance">
                Use the form to the left to suggest where you may find information to help answer your questions. You could also
                use this opportunity to suggest an experiment to test a hypothesis you originally put forward at the start of the lesson.
            </p>
        </div>
    </div>
</section>


<!-- Student chat room ------------------------------------------------------------------------------------------->


    <div class="chat">

        <form id="comment_form" action="../POST/insert_discussion.php?dbtable=<?php echo $discussion_table?>&page=<?php echo $page?>" method="post">
            <div class="titleformat">
                <p>Where can we find information about forces and gravity?..share your thoughts here</p>
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



<footer style="margin-top: 950px;">

</footer>

</body>
</html>