<?php
    require('../dbconnect.php');
    $con = CreateConnection();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>mKWL Team</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="mkwl_styles.css" />
    <script src="comments.js"></script>
</head>
<body>

<header id="home_header">
        
    <div>
          <input class="nav-button" type="button" value="Home" onclick="window.location.href='../home.php'" />
    </div>

    <div class="KWL-plus">
        <img src="../images/mKWL_logo.png" width="260" height="100" style="position: absolute; left: 80px; top: 10px;">
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

<!-- Entry Counter ----------------------------------------------------------------------------------------------------------------------->

<?php
     $counter = 0;
     $filename = "";
     $username = $_SESSION['username'];
                
     $getsql = "SELECT * FROM learned_comment_mkwl ORDER BY id DESC";
     $data = $con -> query($getsql);

     foreach($data AS $row) {
        if($row['username'] == $username) {
            $counter++;
        }
     }

     if($counter >= 3) {
         $filename = "know_mkwl.php";
     } else {
         $filename = "know_mkwl_1.php";
     }
?>

<!-- Today's Lesson and Introduction ----------------------------------------------------------------------------------------------------------------------->

   <section>
    <div class="classroom-display">

        <div>
          <input class="nav-button" type="button" value="Get Started" onclick="window.location.href='<?php echo($filename)?>'" />
        </div>
    
        <section>

            <div class="KWL_plus_earth_images">
                   
                        <div style="margin-left: 40px; margin-top: 0px;">
                            <img src="../images/gravity-clipart-1.jpg" width="350" height="350">
                        </div>
                   
            </div>

            <div class="KWL_plus_display_text">
                    <p class="introduction" style="margin-top: 95px">
                            Today you will be using the <span style="color: purple">K</span>(Know) <span style="color: purple">W</span>(What) <span style="color: purple">L</span>(Learned) 
                            model approach to learning in order to investigate forces and gravity. KWL is a learning tool designed to encourage students to adopt a more 
                            active role in their learning, to question and explore new ideas, and to actively engage in discussion with other students. Your task today is as follows:
                    </p>

                    <ul class="introduction_ul">
                            <li>Click the "Get Started" button which will take you to the first stage of your KWL journey.</li>
                            <li>Work through the first stage of the KWL form and when you are happy with the ideas and facts you have submitted, click the
                                "What" button to move on to the next stage.</li>
                            <li>After completing each stage you can work with your team 
                                and share your ideas and facts about forces and gravity. You can also share your ideas with the rest of the
                                class using the discussion forum at the bottom of the page.</li>
                    </ul>
            </div>   
        </section>
    </div>
    
    </section>
</section>


<footer class="home-footer" style="margin-top: 300px;">

</footer>

</body>
</html>