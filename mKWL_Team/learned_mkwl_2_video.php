<?php
    require('../dbconnect.php');
    $con = CreateConnection();
    $dbtable = "learned_comment_mkwl";
    $dbtable_2 = "what_comment_mkwl";
    $dbtable_3 = "find_comment_mkwl";
    $page = "../mKWL_Team/learned_mkwl_2_video.php";
    $discussion_table = "learned_discussion_mkwl";
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
            <input disabled class="return_to_class_button" style="margin-right: 20px; margin-top: 12px;" type="button" value="Return to Classroom" onclick="window.location.href='review.php'" />
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
   
<!-- Display Video -------------------------------------------------------------------------------------------------------------------->

<div class="video-display">
    <video width="1200" height="700" controls autoplay>
        <source src="../videos/BBC bitesize forces - KS3.mp4">
    </video>
    <div>
          <input class="nav-button" type="button" value="Back to KWL" onclick="window.location.href='learned_mkwl_2.php'" />
    </div>
</div>

<!------------------------------------------------------------------------------------------------------------------------------------->

<section>
   
    <div class="kwl-display">
    <div>
        
         <div>
            <input class="solo_button" style="margin-right: 175px" type="button" value="Go Solo" onclick="window.location.href='../Go_Solo_mkwl/learned_solo.php'" />
        </div>
    </div>

    <div class="mkwltabs">
        <ul>
            <li><a style="color: black">What I think and know</a></li>
            <li><a href="what_mkwl.php">What Questions I have</a></li>
            <li><a href="find_mkwl.php" >How can I find out</a></li>
            <li><a href="learned_mkwl_2.php" id ="onlink">What I learned</a></li>
        </ul>
    </div>

  
<!-- Insert know comments ----------------------------------------------------------------------------------------------------------------->

<div class="kwl-container">
        <?php
             require('../GET/create_team_colour.php');
        ?>
     <section>  
        <form id="comment_form" action="../POST/insert_comment.php?dbtable=<?php echo $dbtable?>&page=<?php echo $page?>" method="post">
            <input disabled id="learned_button" name="submit_know" type="submit" value="Learned"> 
            <textarea disabled class="learned_comments" name="Know_Comment" rows="2" cols="70" maxlength="100" placeholder="Enter what you have learned here"></textarea>
            <textarea class="weblink" name="weblink" rows="2" cols="30" maxlength="100" placeholder="Enter website here"></textarea>
        </form>
</section>

<!-- KWL titles --------------------------------------------------------------------------------------------------->

<section>
    <div class="list_title">
        <p class="title_text">What we want to know</p>
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
        <p class="title_text">What we have learned</p>
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
                require('../GET/display_comment_team_website.php');
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
                    Now that you have reached this stage you will notice new features have been unlocked to further enhance your 
                    investiagations. You now have complete access to all three of the KWL tabs and the abilty to track your individual progress
                    throughout each stage of the KWL process using the "Go Solo" option. 
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

        <form id="comment_form" action="../POST/insert_discussion.php?dbtable=<?php echo $discussion_table?>&page=<?php echo $page?>" method="post">
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
                $getsql = "SELECT * FROM learned_discussion ORDER BY id DESC";
                $data = $con -> query($getsql);

                    foreach($data AS $row) {?>
                        <div id="comment_container">
                        <?php echo "From: " . $row['username'] . '<br>' . $row['comment'];?>
                        </div>
                        <?php
                    }
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