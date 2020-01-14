<?php
    require('../dbconnect.php');
    $con = CreateConnection();
    $dbtable = "learned_comment_plus";
    $dbtable_2 = "what_comment_plus";
    $page = "../KWL_Plus/learned_plus.php";
    $discussion_table = "learned_discussion_plus";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Learned +</title>
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
                    
                
    </div>
    <div>
            <img src="../images/planet-earth.jpg" style="width: 60px; height: 60px; position: absolute; left: 1050px; top: 28px;">
            <p style="font-size: 40px; position: absolute; left: 800px; top: 0px;">Planet Earth</p>
    </div>
      
   </header>


<!-- Display Video -------------------------------------------------------------------------------------------------------------------->

<div class="video-display">
    <video width="1200" height="700" controls autoplay>
        <source src="../videos/The Planet Earth_ Astronomy and Space for Kids - FreeSchool.mp4">
    </video>
    <div>
          <input class="nav-button" type="button" value="Back to KWL" onclick="window.location.href='learned_plus.php'" />
    </div>

</div>

<!------------------------------------------------------------------------------------------------------------------------------------>


<section>
   
    <div class="kwl-display">
        
         <div>
            <input class="return_to_class_button" type="button" value="Return to Classroom" onclick="window.location.href='review_plus.php'" />
        </div>
        <div>
            <input class="solo_button" type="button" value="Go Solo" onclick="window.location.href='../Go_Solo_Plus/learned_plus_solo.php'" />
        </div>
                
    <div class="kwltabs">
        <ul>
            <li><a style="color: grey" >Know</a></li>
            <li><a style="color: grey">What</a></li>
            <li><a href="learned_plus.php" id="onlink">Learned</a></li>
            
        </ul>
    </div>
<div class="kwl-container">
        <?php
             require('../GET/create_team_colour.php');
        ?>
     <section>  
        <form id="comment_form" action="../POST/insert_learned.php?dbtable=<?php echo $dbtable?>&page=<?php echo $page?>" method="post">
            <input disabled id="learned_button" name="submit_know" type="submit" value="Learned"> 
             <textarea disabled class="learned_comments" name="Know_Comment" rows="2" cols="70" maxlength="100" placeholder="Enter what you have learned here"></textarea>
            <textarea class="weblink" name="weblink" rows="2" cols="30" maxlength="100" placeholder="Enter website here"></textarea>
        </form>

        <form id="filter_form" action="filter_learned_plus.php" method="post">
            <input type="text" class="filter_keyword" name="filter_keyword" rows="1" cols="20" maxlength="30" placeholder="Enter keyword here">
            <input type="submit" id="filter_button" name="submit_filter"  value="Filter Results">
        </form>
    </section>

<!-- KWL titles --------------------------------------------------------------------------------------------------->

<section>
    <div class="list_title" style="padding-left: 140px;">
        <p class="title_text" style="float: left">Team </p>
        <img src="../<?php echo $symbol?>" style="width: 55px; height: 53px;">
    </div>
    <div class="list_title" style="padding-left: 140px;">
        <p class="title_text" style="float: left">Team </p>
        <?php
                $team = $_SESSION['team'];
                $getsql ="SELECT DISTINCT symbol, plus_team FROM login";
                $data = $con -> query($getsql);

                foreach($data AS $row) {
                   if($team == $row['plus_team']){
                        $teamx = $row['symbol'];
                    } 
                }
            ?>
               <img src="../<?php echo $teamx?>" style="width: 55px; height: 55px;">
    </div>
    <div class="list_title" style="width: 415px;">
        <p class="title_text">What we have learned</p>
    </div>
</section>

<!-- Display myteam questions -------------------------------------------------------------------------------->
    <section>

<div class="display_student_work" style="word-wrap: break-word;">

            <div style="margin-top: 5px"> 
                <?php
                    require('../GET/display_team_comment_db2.php');
                ?>
          
            </div>   
</div>

<!-- Display Teamx questions  -------------------------------------------------------------------------------------->

<div class="display_student_work" style="word-wrap: break-word;">

            <div style="margin-top: 5px"> 
                    <?php
                    require('../GET/display_teamX_comment_db2.php');
                    ?>
          
            </div>   
</div>

<!---- Display Teamx and myteam Learned --------------------------------------------------------------------------------------------------->

<div class="display_student_work" style="width: 420px; word-wrap: break-word;">
            <div style="margin-top: 5px"> 
                    <?php
                    $team = $_SESSION['team'];
                        $getsql = "SELECT * FROM learned_comment_plus ORDER BY id DESC";
                        $data = $con -> query($getsql);

                        foreach($data AS $row){  
                            if($row['team'] == $team || $row['team'] == $plus_team) {
                            ?>
                            <div style=
                            "background-color:  <?php echo $row['colour']?>;
                            width: 95%;
                            border-radius: 10px;
                            margin: auto;
                            margin-bottom: 4px;
                            padding: 12px;
                            min-height: 45px;
                            
                            ">
                                <?php echo $row['comment'] .'<br>' . '<br>'?>
                                <a href=" <?php  echo $row['website']?> " target="_blank"><?php  echo $row['website']?></a> 
                            </div>
                        <?php
                        }
                    }
                    ?>
            </div>
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
                    This final activity allows you and your team to reflect on what you have learned in this lesson.
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
                <p>What have you learned about planet Earth?..share your thoughts here</p>
            </div>
        
            <textarea id="comments" name="Comment" rows="8" cols="70" maxlength="200" placeholder="Please type your comment here (200 characters maximum)"></textarea><br>
            <span id="wordCount">200</span> characters remaining <br>
            <input id="comment_button" name="submit" type="submit" value="Comment"> 
        </form>

        <p class="titleformat">Comments</p>
        <div class="scroll_chats">
            <?php
                $getsql = "SELECT * FROM learned_discussion_plus ORDER BY id DESC";
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

<!-- Class resources ------------------------------------------------------------------------------------------------------------->
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