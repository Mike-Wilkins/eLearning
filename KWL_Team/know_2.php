<?php
    require('../dbconnect.php');
    $con = CreateConnection();
    $dbtable = "know_comment";
    $page = "../KWL_Team/know_2.php";
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
       
       
    <div class="kwltabs">
        <ul>
            <li><a href="know_2.php" id="onlink">Know</a></li>
            <li><a href="what_1.php">What</a></li>
            <li><a style="color: grey">Learned</a></li>
            
        </ul>
    </div>
    <div class="kwl-container">
        <?php
            require('../GET/create_team_colour.php');
        ?>
       
    <section>
        <form id="comment_form" action="../POST/insert_comment.php?dbtable=<?php echo $dbtable?>&page=<?php echo $page?>" method="post">
            <input id="submit_question_button" name="submit_know" type="submit" value="I Know"> 
            <textarea class="know_comments" name="Know_Comment" rows="2" cols="70" maxlength="100" placeholder="Enter what you know here"></textarea>
        </form>
    </section>

    <section>
        <div class="display_facts" style="height: 60px; margin-bottom: 8px; overflow: hidden">
            <p class="title_text">What we know</p>
        </div>
    </section>

<!-- ************************ What we know ***************************************************** -->

        <section>
            <div class="display_facts">
                <div>
               <?php
                require('../GET/display_team_comment.php');
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