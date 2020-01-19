<?php
    require('dbconnect.php');
    $con = CreateConnection();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="CSS/styles1.css" />
    <script src="comments.js"></script>
</head>
<body>

    <header id="login_header">

    <div>
        <input class="nav-button" type="button" value="Home" onclick="window.location.href='home.php'" />
    </div>

    <div>
          <input class="nav-button" type="button" value="Logout" onclick="window.location.href='logout.php'" />
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
                <img src="<?php echo $symbol?>" style="width: 70px; height: 70px; position: absolute; left: 290px; top: 20px;">
           
                <div class="kwl_homepage_logo">
                    <img src="images/KWL_homepage.png" style="width: 350px; height: 110px;">
                   <!-- <img src="images/KWL_homepage.png" style="width: 350px; height: 110px; position: absolute; left: 770px; top: 0px;"> -->
                </div>
                
    </div>
      
   </header>

<!-- Display my team -------------------------------------------------------------------------------------------->

<section>
    <div class="student-login-display" style="margin-top: 50px">
        <div class="myteams">
            <p style="font-size: 18px">My Team</p>
        
            <?php
                require('GET/display_my_team.php');
            ?>
        </div>
     
<!-- Display who is logged in ----------------------------------------------------------------------------------->

        <div class="myteams">
            <p style="font-size: 18px">Logged In</p>   
                <?php
                require('GET/display_logged_in.php');
                ?>
        </div>
    </div>

<!-- Display KWL Team option and link -------------------------------------------------------------------------------->

    <div class="kwl_option_display">
       
       <p class="KWL-titles">KWL Team</p>
       <div class="kwl_team_logo">
           <!-- <img src="images/KWL_team_homepage.png" style="width: 220px; height: 125px; margin-left: 125px; margin-top: 23px; margin-bottom: 15px;">-->
           <img src="images/KWL_team_homepage.png" style="width: 220px; height: 125px">
       </div>
<section>
        <div>
            <input class="KWL-nav-button" type="button" value="KWL Team" onclick="window.location.href='classroom_team.php'" />
        </div>
        <div>
            <input class="KWL-nav-button" style="margin-left: 25px;" type="button" value="Keyword Support" onclick="window.location.href='KWL_Keyword/classroom_keyword.php'" />
        </div>
</section>

       <p class="KWL_option_info">
            KWL Team offers students the opportunity to work in groups to explore a specific area of study using the KWL learning framework. 
            The learning environment is designed specifically to enable students to work remotely within the classroom, or independently 
            at home whilst maintaining a sense of shared ownership throughout the entire learning process.<br><br>
            The application supports an additional “Go Solo” feature to facilitate student-centered learning and a resource filtering option to
            allow students to focus on individual avenues of enquiry.  
       </p>
    </div>

<!-- Display KWL+  option and link ------------------------------------------------------------------------------------>

    <div class="kwl_option_display">
        
        <p class="KWL-titles">KWL+</p>
<section>
        <div class="kwl_plus_logo">
            <img src="images/KWL_plus_homepage.png" style="width: 320px; height: 160px;">
        </div>
</section>
        <div>
            <input class="KWL-plus-nav-button" type="button" value="KWL Team+" onclick="window.location.href='KWL_plus/kwl_plus.php'" />
        </div>

        <p class="KWL_plus_option_info">
          KWL+ extends the core values of team learning by creating an environment, which brings two teams together in order to further encourage and enhance
          collaborative and co-operative learning.<br><br>
       As with the KWL Team option, KWL+ supports additional features such as resource filtering and the “Go Solo” option allowing students the ability 
       to track individual progress and target individual lines of enquiry.
       </p>
    </div>

<!-- Display KWL Custom Team option and link -------------------------------------------------------------------------->

    <div class="kwl_option_display">
       
       <p class="KWL-titles">KWL Custom Team</p>
       <div class="kwl_custom_logo">
            <img src="images/KWL_custom_homepage.png" style="width: 170px; height: 120px;">
            <!--<img src="images/KWL_custom_homepage.png" style="width: 170px; height: 120px; margin-left: 140px; margin-top: 23px; margin-bottom: 15px;">-->
       </div>
       <div>
            <input class="KWL-custom-nav-button" type="button" value="KWL Custom Team" onclick="window.location.href='Custom_Team/classroom_custom_team.php'" />
        </div>

       <p class="KWL_custom_option_info">
         KWL Custom Team provides students with the opportunity to create their own team offering a learning environment designed to enhance and 
         promote co-operative and collaborative team building skills.<br><br>
         The application supports options for teams working either in pairs or groups of three. In contrast to the KWL Team and KWL+ options, the custom 
         option is designed specifically to facilitate learners working together in teams with a goal of producing a single collaborative KWL based document.
       </p>
    </div>

<div class="mkwl_option_display">
       
       <p class="KWL-titles">mKWL Team Science</p>
       <img class="mkwl_science_logo" src="images/atom3.png">
       <!--<img src="images/atom3.png" style="width: 200px; height: 150px; margin-left: 130px; margin-top: 0px; margin-bottom: 15px;">-->

       <div>
            <input class="mKWL-nav-button" type="button" value="mKWL Team" onclick="window.location.href='mKWL_Team/classroom.php'" />
        </div>

       <p class="mKWL_option_info">
         mKWL is a unique adaptation of the original KWL model and is designed specifically to inspire creative thinking and questioning within the field of educational science.
         The revised edition offers extended facilities to promote and encourage students to formulate a hypothesis and devise experimental methods to test their ideas.<br><br>
         In contrast to previous KWL models offered on this site, the initial stages of the mKWL process are based on a learner-centered approach which later expand to incorporate methods of colaborative and
         co-operative learning during the final reflective stages.
        
       </p>
    </div>
    </section>

<footer style="margin-top: 130px;">

</footer>

</body>
</html>