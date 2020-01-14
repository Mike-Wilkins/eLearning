<?php
    require('../dbconnect.php');
    $con = CreateConnection();
    $dbtable = "know_comment_mkwl";
    $page = "../Go_Solo_mkwl/know_solo.php";
    $discussion_table = "know_discussion_mkwl";
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

    <div class="kwl-display">
        <div>
            <input class="solo_button" style="margin-right: 15px" type="button" value="Team" onclick="window.location.href='../mKWL_Team/know_mkwl.php'" />
        </div>
       
       
    <div class="mkwltabs">
        <ul>
            <li><a href="know_solo.php" id ="onlink">What I think and know</a></li>
            <li><a href="what_solo.php" >What Questions I have</a></li>
            <li><a href="find_solo.php">How can I find out</a></li>
            <li><a href="learned_solo.php">What I learned</a></li>
            
        </ul>
    </div>
    <div class="kwl-container">
       
    <section>
        <form id="comment_form" action="../POST/insert_comment.php?dbtable=<?php echo $dbtable?>&page=<?php echo $page?>" method="post">
            <input id="submit_question_button" name="submit_know" type="submit" value="I Know"> 
            <textarea class="know_comments" name="Know_Comment" rows="2" cols="70" maxlength="100" placeholder="Enter what you know here"></textarea>
        </form>
    </section>

    <section>
        <div class="display_facts" style="height: 60px; margin-bottom: 8px; overflow: hidden">
            <p class="title_text">What I <strong>T</strong>hink and what I <strong>K</strong>now</p>
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
                <img src="../images/forces_keywords.png" width="340" height="220" style="margin-left: 10px;">

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
                Using the form on the left, enter any facts or thoughts you have about forces or gravity.
            </p>

            <p class="student_guidance">
                You may recall a fact from a previous science lesson or from a documentary you watched at home. You might also want to suggest a hypthesis based
                on your observations of the world around you.   
            </p>
                
        </div>
  
    </div>

</section>

<!-- Student forum ----------------------------------------------------------------------------------------------------------->

<div class="chat">

        <form id="comment_form" action="../POST/insert_discussion.php?dbtable=<?php echo $discussion_table?>&page=<?php echo $page?>" method="post">
            <div class="titleformat">
                <p>Share what you know about forces and gravity with other students</p>
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