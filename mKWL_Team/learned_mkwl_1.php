<?php
    require('../dbconnect.php');
    $con = CreateConnection();
    $dbtable = "learned_comment_mkwl";
    $dbtable_2 = "what_comment_mkwl";
    $dbtable_3 = "find_comment_mkwl";
    $page = "../mKWL_Team/learned_mkwl_1.php";
    $page2 = "learned_mkwl_2.php";
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

<section>
   
    <div class="kwl-display">
    <div>
         <a href="learned_mkwl_1_video.php">
             <img class="video_button" src="../images/camera3.png">
         </a>

    </div>

    <div class="mkwltabs">
        <ul>
            <li><a href="know_mkwl_2.php">What I think and know</a></li>
            <li><a href="what_mkwl_2.php">What Questions I have</a></li>
            <li><a href="find_mkwl_2.php" >How can I find out</a></li>
            <li><a href="learned_mkwl_1.php" id ="onlink">What I learned</a></li>
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
     <section>  
        <form id="comment_form" action="../POST/insert_learned.php?dbtable=<?php echo $dbtable?>&page=<?php echo $page?>" method="post">
            <input id="learned_button" name="submit_know" type="submit" value="Learned"> 
            <textarea class="learned_comments" name="Know_Comment" rows="2" cols="70" maxlength="100" placeholder="Enter what you have learned here"></textarea>
            <textarea class="weblink" name="weblink" rows="2" cols="30" maxlength="100" placeholder="Enter website here"></textarea>
        </form>
</section>

<!-- KWL titles --------------------------------------------------------------------------------------------------->

<section>
    <div class="list_title">
        <p class="title_text">What we <strong>W</strong>ant to know</p>
    </div>
    <div class="list_title">
        <?php
                    $team = $_SESSION['team'];
                    $team_array = array();

                    $getsql ="SELECT DISTINCT team FROM login";
                    $data = $con -> query($getsql);

                    
                    foreach($data AS $row){
                        if($team !== $row['team']) {
                            array_push($team_array, $row['team']);
                        }
                    };
                    
                    $swap = $team_array[array_rand($team_array)];

                    ?>
                        <p class="title_text">How can I find out</p>
    </div>
    <div class="list_title" style="width: 415px;">
        <p class="title_text">What I have <strong>L</strong>earned</p>
    </div>
</section>

<!-- Display what team questions ---------------------------------------------------------------------->

<section>

<div class="display_student_work" style="word-wrap: break-word;">

            <div> 
                <?php
                  require('../GET/display_team_comment_db2.php');
                ?>
            </div>
</div>

<!-- How can I find out -------------------------------------------------------------------------------------->

<div class="display_student_work" style="word-wrap: break-word; ">
   
                    
            <div style="margin-top: 5px">
                <?php
                    require('../GET/display_my_comment_db3.php');
                ?>
          
            </div>
</div>

<!-- display what I have learned ---------------------------------------------------------------------------------------------->

<div class="display_student_work" style="width: 420px; word-wrap: break-word;">
    
    <?php
               require('../GET/display_my_comment_website.php');
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
                    Watch the video to discover more about forces and gravity. You may find the video helps you to answer the questions you are looking for.
                </p>
                <p class="student_guidance">
                    Alternatively, you can search the internet to try and answer the questions put forward by your team.
                </p>
      
                <p class="student_guidance">
                    Using the resources you suggested try to answer the questions you put forward.
                    Enter what you have learned about forces and gravity in the comment box provided along with a link 
                    to any websites you find which help to answer your question.
                </p>

                 <p class="student_guidance">
                    Notice you can now see ideas put forward by your team. You may find their questions inspire you to explore
                    an area of this topic you hadn't previously thought of.
                </p>

                <p class="student_guidance">
                    As before, you will need to <span style="color: #ff8566"> enter at least three learned comments </span> to move on to the next stage.
                </p>
      </div>
    </div>
</section>

<footer>

</footer>

</body>
</html>