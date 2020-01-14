<?php
    require('../dbconnect.php');
    $con = CreateConnection();
    $custom_team = $_GET['custom_team'];
    $dbtable = "learned_custom_team";
    $dbtable_2 = "what_custom_team";
    $page = "../Custom_Team/learned_custom.php";
    $discussion_table = "learned_discussion_custom";
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Learned</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../CSS/styles_2.css" />
    <script src="comments.js"></script>
</head>
<body>

    <header id="login_header">
    <div>
          <input disabled class="nav-button" type="button" value="Home" onclick="window.location.href='../home.php'" />
    </div>

    <div>
          <input disabled class="nav-button" type="button" value="Logout" onclick="window.location.href='../logout.php'" />
    </div>
    <div>
            <input disabled class="nav-button" type="button" value="My Teams" onclick="window.location.href='create_team.php'" />
    </div>


    <div class="welcome-user" style="margin-left: 120px;">
            <?php
                

                session_start();

                if(isset($_SESSION['username'])){
                  echo 'Welcome ' . $custom_team;
                    
                }
                
                else
                {
                    header("location: login.php");
                }

             ?>
    </div>
    <div>                    
        <img src="../images/KWL_custom_team.png" style="width: 85px; height: 85px; position: absolute; left: 90px; top: 15px;">

                 <div>
                    <img src="../images/planet-earth.jpg" style="width: 60px; height: 60px; position: absolute; left: 1250px; top: 28px;">
                    <img src="../images/saturn.png" style="width: 90px; height: 90px; position: absolute; left: 1400px; top: 20px;">
                    <img src="../images/jupiter.png" style="width: 80px; height: 80px; position: absolute; left: 1320px; top: 18px;">
                    <p style="font-size: 40px; position: absolute; left: 600px; top: 0px;">Our Solar System and the Planets</p>
                </div>
    </div>
      
   </header>

<!-- Display Video -------------------------------------------------------------------------------------------------------------------->

<div class="video-display">
    <video width="1200" height="700" controls autoplay>
        <source src="../videos/Solar System 101 _ National Geographic.mp4">
    </video>
    <div>
          <input class="nav-button" type="button" value="Back to KWL" onclick="window.location.href='learned_custom_1.php?custom_team=<?php echo($custom_team)?>'" />
    </div>

</div>

<section>
   
    <div class="kwl-display">
       

         <div>
            <input class="return_to_class_button" type="button" value="Return to Classroom" onclick="window.location.href='review_custom.php?<?php echo ($custom_team)?>'" />
        </div>

    <div class="kwltabs">
        <ul>
            <li><a style="color: grey" >Know</a></li>
            <li><a style="color: grey">What</a></li>
            <li><a href="learned_custom.php?custom_team=<?php echo($custom_team)?>" id="onlink">Learned</a></li>
            
        </ul>
    </div>
<div class="kwl-container">

<section>  
        <form id="comment_form" action="../POST/insert_learned_custom.php?custom_team=<?php echo ($custom_team)?>&dbtable=<?php echo $dbtable?>&page=<?php echo $page?>" method="post">
            <input disabled id="learned_button" name="submit_know" type="submit" value="Learned">
             <textarea disabled class="learned_comments" name="Know_Comment" rows="2" cols="30" maxlength="100" placeholder="Enter what you have learned here"></textarea>
             <textarea class="weblink" name="weblink" rows="2" cols="30" maxlength="100" placeholder="Enter website here"></textarea>

        </form>

        <form id="filter_form" action="filter_custom_learned.php?<?php echo ($custom_team)?>" method="post">
            <input type="text" class="filter_keyword" name="filter_keyword" rows="1" cols="20" maxlength="30" placeholder="Enter keyword here">
            <input type="submit" id="filter_button" name="submit_filter"  value="Filter Results">
        </form>
</section>

<!-- KWL Titles and SWAP sort algorithm--------------------------------------------------------------------------------------------------->

<section>
    <div class="list_title">
        <p class="title_text">What we want to know</p>
    </div>
    <div class="list_title">
        <?php
                    $team_array = array();

                    $getsql ="SELECT DISTINCT myteam FROM custom_team";
                    $data = $con -> query($getsql);

                    
                    foreach($data AS $row){
                        if($custom_team !== $row['myteam']) {
                            array_push($team_array, $row['myteam']);
                        }
                    };
                    
                    $swap = $team_array[array_rand($team_array)];

                    ?>
                        <p class="title_text">What team <?php echo($swap)?> want to know</p>
    </div>
    <div class="list_title" style="width: 415px;">
        <p class="title_text">What we have learned</p>
    </div>
</section>

<!-- Display what team questions ---------------------------------------------------------------------->

<section>

<div class="display_student_work" style="word-wrap: break-word;">

            <div> 
                <?php
                    require('../GET/display_my_comment_custom_db2.php');
                ?>
          
            </div>
</div>

<!-- Student SWAP -------------------------------------------------------------------------------------->

<div class="display_student_work" style="word-wrap: break-word; ">
   
                <?php
                $getsql = "SELECT * FROM what_custom_team ORDER BY id DESC";
                $data = $con -> query($getsql);

                foreach($data AS $row){
                    if($row['team'] == $swap) {

                        ?>
                        <div class="swap_comment">
                            <?php echo $row['comment'] . '<br>' . '<br>';?>   
                        </div>
                       
                    <?php
                    }
                }
    ?>          
</div>

<!-- display what we have learned ---------------------------------------------------------------------------------------------->

<div class="display_student_work" style="width: 420px;">
    
                <?php
                     require('../GET/display_my_custom_comment_website.php');
                ?>
        </div>
        </section>
    </div>
    
</div>

<!-- Student guidance form -------------------------------------------------------------------------------------->

    <div class="comment-display">
        <div style="margin-left: 60px;">
            <img src="../images/LEARNED_balloon.png" width="170" height="90"><br>
        </div>
        <div style="margin-left: 20px;">
            <img src="../images/owl_teacher.png" width="90" height="90">
        </div>

         
      <div class="blackboard">
                <p class="student_guidance">
                    This final activity allows you and your team to reflect on what you have learned in today's lesson.
                <p class="student_guidance">
                    Now that you have reached this stage you will notice new features have been unlocked to further enhance your 
                    investiagations. You now have complete access to all three of the KWL tabs.
                </p>
                <p class="student_guidance">
                    You also have access to all the websites found by other students in your class and the ability to share ideas using
                    the student forum.
                </p>  
                <p class="student_guidance">
                    When you are ready, click the "Return to Classroom" button.
                </p>    
      </div>
    </div>
</section>

<!-- Student chat room ------------------------------------------------------------------------------------------->
<section>

    <div class="chat">

        <form id="comment_form" action="POST/insert_learned_discussion_custom.php?<?php echo ($custom_team)?>" method="post">
            <div class="titleformat">
                <p>What have you learned about the planets?..share your thoughts here</p>
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

<!-- Display class resources ---------------------------------------------------------------------------------------------------->

    <div class="websites">
            <div class="titleformat">
                <div class="myteams" style="padding-bottom: 0px">
                    <p>Class Websites</p>
                </div>   
            </div>
            <div class="links" style="word-wrap: break-word;">

                <?php
                    require('../GET/display_website_links.php');
                ?>
            </div>
        </div>
</section>
<footer>

</footer>

</body>
</html>