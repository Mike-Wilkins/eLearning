<?php
    require('../dbconnect.php');
    $con = CreateConnection();
    $custom_team = $_GET['custom_team'];
    $dbtable = "learned_custom_team";
    $dbtable_2 = "what_custom_team";
    $page = "../Custom_Team/learned_custom_1.php";
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


<!-- Entry Counter ----------------------------------------------------------------------------------------------------------------------->

<?php
     $counter = 0;
       
     $getsql = "SELECT * FROM learned_custom_team ORDER BY id DESC";
     $data = $con -> query($getsql);

     foreach($data AS $row) {
        if($row['team'] == $custom_team) {
            $counter++;
        }
     }

     if($counter >= 3) {
        header("location: learned_custom.php?$custom_team");
     }?>

<section>
   
    <div class="kwl-display">

    <div class="kwltabs">
        <ul>
            <li><a style="color: grey" >Know</a></li>
            <li><a style="color: grey">What</a></li>
            <li><a href="learned_custom_1.php?custom_team=<?php echo($custom_team)?>" id="onlink">Learned</a></li>
            
        </ul>
    </div>
<div class="kwl-container">

<section>  
        <form id="comment_form" action="../POST/insert_learned_custom.php?custom_team=<?php echo ($custom_team)?>&dbtable=<?php echo $dbtable?>&page=<?php echo $page?>" method="post">
            <input disabled id="learned_button" name="submit_know" type="submit" value="Learned">
             <textarea  disabled class="learned_comments" name="Know_Comment" rows="2" cols="30" maxlength="100" placeholder="Enter what you have learned here"></textarea>
             <textarea class="weblink" name="weblink" rows="2" cols="30" maxlength="100" placeholder="Enter website here"></textarea>

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
                    $getsql = "SELECT * FROM learned_custom_team ORDER BY id DESC";
                    $data = $con -> query($getsql);

                    foreach($data AS $row){  
                     if($row['team'] == $custom_team) {
                        ?>
                        <div style=
                        "background-color: #eeccff;
                        border-radius: 10px;
                        margin: 10px;
                        padding: 12px;
                        
                        ">
                            <?php echo $row['comment'] . '<br>' . '<br>'?>
                            <a href=" <?php  echo $row['website']?> " target="_blank"><?php  echo $row['website']?></a>
                        </div>
                    <?php
                 }
                }
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
                </p>
                <p class="student_guidance">
                    Notice the middle column now shows what other teams in your class want to know.
                </p>
                
                <p class="student_guidance">
                    Try to answer the questions put forward by your team and the rest of the class.
                    Enter what you have learned about our solar system and the planets in the comment box provided 
                    along with a link to any websites you have found which help to answer your question.
                </p>
                <p class="student_guidance">
                    When you are ready, click the "Return to Classroom" button.
                </p>    
      </div>
    </div>
</section>

<footer>

</footer>

</body>
</html>