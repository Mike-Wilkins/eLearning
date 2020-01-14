<?php
    require('../dbconnect.php');
    $con = CreateConnection();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>KWL Custom Team</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../CSS/styles1.css" />
    <script src="comments.js"></script>
</head>
<body>

    <header id="home_header">
        
    <div>
          <input class="nav-button" type="button" value="Home" onclick="window.location.href='../home.php'" />
    </div>

    <div class="KWL-images">
        <img src="../images/KWL_custom_team.png" width="130" height="80">
    </div>

    <div>
          <input class="nav-button" type="button" value="Logout" onclick="window.location.href='../logout.php'" />
    </div>

    <div class="welcome-class">
            <?php
                session_start();

                if(isset($_SESSION['username'])){
                    echo 'Welcome to the Classroom ' . $_SESSION['username'];
                    
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
   <section>
    <div class="classroom-display">
        <div>
            <input class="nav-button" type="button" value="Get Started" onclick="window.location.href='create_team.php'" />
        </div>
    <p class="subject-title">Today's Lesson</p>

        
        <p class="introduction">
            Today you will be using the <span style="color: purple">K</span>(Know) <span style="color: purple">W</span>(What) <span style="color: purple">L</span>(Learned) 
            model approach to learning in order to investigate our solar system and the planets. KWL is a learning tool designed to encourage students to adopt a more 
            active role in their learning, to question and explore new ideas, and to actively engage in discussion with other students. Your first task today is as follows:
        </p>
       <ul class="introduction_ul">
            <li>Read the introduction below about our solar system and the planets.</li>
            <li>Click the "Get Started" button where you can create a unique team and then move on to the first stage of your KWL journey.</li>
            <li>Work with your team to build up about six facts and when your team is happy with the facts you have submitted, click the
                "What" to move on to the next stage.</li>
       </ul>
       
       <p class="subject-title">Introduction: Our Solar System and The Planets</p>
       <p class="introduction">
          When you look up at the sky on a clear night, you can see thousands of stars. Humans have been around for many thousands of years
          but it is only in the last few hundred years that we have started to understand about the universe in which we live. Ancient civilisations
          noticed that there were five brighter 'stars' that moved around the sky in a strange way but had no idea about why they behaved like that.
          We now know these are the planets Mercury, Venus, Mars, Jupiter and Saturn. They are much closer to us than the stars and, like the Earth,
          they orbit our Sun. They are visible only because they reflect the Sun's light. When Galileo first pointed the newly-invented telescope at
          the sky, he noticed that one of these had moons orbiting it (Jupiter).
       </p>
      
       
        <div class="planet-images">
             <img src="../images/jupiter.png" width="100" height="100">
             <img src="../images/planet-earth.jpg" width="95" height="95">
             <img src="../images/saturn.png" width="105" height="105">
             <img src="../images/moon.png" width="85" height="85">
             <img src="../images/mars.png" width="85" height="85">
             <img src="../images/neptune.png" width="95" height="95">
       
        </div>
    </div>
    </section>
</section>

<footer class="home-footer" style="margin-top: 185px;">

</footer>

</body>
</html>