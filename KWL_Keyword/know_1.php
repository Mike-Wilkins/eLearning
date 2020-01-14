<?php
    require('../dbconnect.php');
    $con = CreateConnection();
    $keyword_invalid = urldecode($_SERVER['QUERY_STRING']);
    $dbtable = "know_comment_keyword";
    $page = "../KWL_Keyword/know_1.php?";
    $page2 = "know_2.php?$keyword_invalid";
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
                <img src="../images/planet-earth.jpg" style="width: 60px; height: 60px; position: absolute; left: 1050px; top: 28px;">
                <p style="font-size: 40px; position: absolute; left: 800px; top: 0px;">Planet Earth</p>
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
     
<!-- Display who is logged in ----------------------------------------------------------------------------------------------------------->

        <div class="myteams">
            <p style="font-size: 18px">Logged In</p>   
            <?php
                    require('../GET/display_logged_in.php');
                ?>
        </div>
    </div>

<!-- Display KWL ------------------------------------------------------------------------------------------------------------------------>
    <div class="kwl-display">
       
       
    <div class="kwltabs">
        <ul>
            <li><a href="know_1.php" id="onlink">Know</a></li>
            <li><a style="color: grey">What</a></li>
            <li><a style="color: grey">Learned</a></li>
            
        </ul>
    </div>

<!-- Entry Counter ----------------------------------------------------------------------------------------------------------------------->

<?php
    require('../GET/comment_counter.php');
?>
   
<!-- Insert know comments ----------------------------------------------------------------------------------------------------------------->
 <div class="kwl-container">
        <?php
             require('../GET/create_team_colour.php');
        ?>

<!-- Keyword not entered alert ----------------------------------------------------------------------------------------->
<?php

if($keyword_invalid == true){
    
    ?>
     <img class="keyword_invalid fade" src="../images/keyword_invalid_3.png" style="height: 70px; width: 340px">
    <?php
}
?>
<!----------------------------------------------------------------------------------------------------------------------->

    <section>
        <form id="comment_form" action="../POST/insert_comment_keyword.php?dbtable=<?php echo $dbtable?>&page=<?php echo $page?>" method="post">
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
                <img src="../images/keywords.png" style="width: 320px; height: 200px; position: absolute; left: 958px; top: 490px;">
                
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
                Using the form on the left, enter any facts that you know about planet Earth.
            </p>

            <p class="student_guidance">
                To move on to the next stage you will need to <span style="color: #ff8566"> enter at least three facts using the keywords provided.</span>
            </p>
                
            <p class="student_guidance">
                When you have entered three or more facts, click the "What" tab to move on to the next stage.
            </p>
                
        </div>
  
    </div>

</section>



<footer>

</footer>

</body>
</html>
