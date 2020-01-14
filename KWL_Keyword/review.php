<?php
    require('../dbconnect.php');
    $con = CreateConnection();
    $dbtable = "kwl_keyword_review";
    $page = "../KWL_Keyword/review.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Review</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../CSS/styles_3.css" />
    <script src="comments.js"></script>
</head>
<body>

    <header id="home_header">
    <div>
          <input class="nav-button" type="button" value="Home" onclick="window.location.href='../home.php'" />
    </div>

    <div >
        <img src="../images/keyword_support.png" width="260" height="100" style="position: absolute; left: 80px; top: 10px;">
    </div>

    <div>
          <input class="nav-button" type="button" value="Logout" onclick="window.location.href='../logout.php'" />
    </div>

    <div class="welcome-class">
            <?php
                session_start();

                if(isset($_SESSION['username'])){
                    echo 'Welcome back to the Classroom ' . $_SESSION['username'];  
                }
                
                else
                {
                    header("location: login.php");
                }
             ?>
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

<!-- Class Review ------------------------------------------------------------------------------------------------->

   <section>
    <div class="classroom-display">
        <p class="subject-title">Reflection and Review</p>
       <p class="introduction">
          Congratulations on completing your first journey exploring our planet and the solar system. Before you go we would like you to take 
          a moment to reflect on what you have learned and consider whether there may be any further aspects of this topic you would like to know about.
       </p>

       <p class="introduction">
          The KWL approach towards learning is designed to offer you an experience to explore and question the world around you. Often the process of
          answering one question will inevitably lead to a multitude of new questions which lead to new avenues of exploration which you may not have 
          initially considered.
       </p>
        
       <div class="planet-images">
             <img src="../images/jupiter.png" width="100" height="100">
             <img src="../images/planet-earth.jpg" width="95" height="95">
             <img src="../images/saturn.png" width="105" height="105">
             <img src="../images/moon.png" width="85" height="85">
             <img src="../images/mars.png" width="85" height="85">
             <img src="../images/neptune.png" width="95" height="95">
       
        </div>
        <p class="subject-title">Ask questions</p>
       
        <p class="introduction">
            Use this opportunity to put forward any additional aspects of this topic you would like to further investigate.
            This could include anything such as the impact of solar flares on Earth's satellites and navigation systems, or the importance of the 
            atmosphere and the role it plays in protecting life on planet Earth. Feel free to explore!
        </p>
    </div>

    <!-- Student Review form --------------------------------------------------------------------------------------->

        <div class="student_review">
                <p class="subject-title">What we still want to know</p>
                <section>
                     <form id="comment_form" action="../POST/insert_review.php?dbtable=<?php echo $dbtable?>&page=<?php echo $page?>" method="post">
                        <textarea class="know_comments" name="review_comment" rows="2" cols="70" maxlength="200" placeholder="Enter what you still want to learn"></textarea><br>
                        <input id="know_button" name="submit_review" type="submit" value="Submit"> 
                    </form>
                </section>

                <section>
                    <div class="display_facts">
                        <div style="margin-top: 10px">
                        <?php
                            require('../GET/review.php');
                        ?>
                    </div> 
                </section>
        </div>
    <!--------------------------------------------------------------------------------------------------------------->
    </section>
       
   
</section>

<footer class="home-footer">

</footer>

</body>
</html>