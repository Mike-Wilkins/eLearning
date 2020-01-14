<?php
    require('../dbconnect.php');
    $con = CreateConnection();
    $dbtable = "learned_comment";
    $dbtable_2 = "what_comment";
    $page = "../KWL_Team/learned.php";
    $discussion_table = "learned_discussion";
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
                    <img src="../images/planet-earth.jpg" style="width: 60px; height: 60px; position: absolute; left: 1250px; top: 28px;">
                    <img src="../images/saturn.png" style="width: 90px; height: 90px; position: absolute; left: 1400px; top: 20px;">
                    <img src="../images/jupiter.png" style="width: 80px; height: 80px; position: absolute; left: 1320px; top: 18px;">
                    <p style="font-size: 40px; position: absolute; left: 600px; top: 0px;">Our Solar System and the Planets</p>
                </div>  
    </div>
      
   </header>


<section>
   
    <div class="kwl-display">
         <div>
            <input class="nav-button" type="button" value="Return to Classroom" onclick="window.location.href='review.php'" />
        </div>
        <div>
            <input class="nav-button" type="button" value="Go Solo" onclick="window.location.href='../Go_Solo/learned_solo.php'" />
        </div>

    <div class="kwltabs">
        <ul>
            <li><a href="know.php" >Know</a></li>
            <li><a href="what.php">What</a></li>
            <li><a href="learned.php" id="onlink">Learned</a></li>
            
        </ul>
    </div>
<div class="kwl-container">

<section>  
        <form id="comment_form" action="../POST/insert_learned.php?dbtable=<?php echo $dbtable?>&page=<?php echo $page?>" method="post">
            <input id="learned_button" name="submit_know" type="submit" value="Learned">
             <textarea class="learned_comments" name="Know_Comment" rows="2" cols="30" maxlength="100" placeholder="Enter what you have learned here"></textarea>
             <textarea class="weblink" name="weblink" rows="2" cols="30" maxlength="100" placeholder="Enter website here"></textarea>

        </form>

        <form id="filter_form" action="filter_learned.php" method="post">
            <input type="text" class="filter_keyword" name="filter_keyword" rows="1" cols="20" maxlength="30" placeholder="Enter keyword here">
            <input type="submit" id="filter_button" name="submit_filter"  value="Filter Results">
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
                 require('../GET/display_team_comment_db2.php');
                ?>
            </div>
           

</div>

<!-- Student SWAP -------------------------------------------------------------------------------------->

<div class="display_student_work" style="word-wrap: break-word; ">
   
                <?php
                $getsql = "SELECT * FROM what_comment ORDER BY id DESC";
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

<!-- filter display what we have learned ---------------------------------------------------------------------------------------------->

<div class="display_student_work" style="width: 420px; word-wrap: break-word;">
    
            <?php
                if(isset($_POST['submit_filter']) && isset($_POST['filter_keyword'])){
                    $_SESSION['keyword'] = $_POST['filter_keyword'];
                    $filter = $_SESSION['keyword'];
                   
                }
                $query = $con->prepare('SELECT * FROM learned_comment WHERE comment LIKE ?');
                $query->bindValue(1, "%$filter%", PDO::PARAM_STR);
                $query->execute();
                
                if (!$query->rowCount() == 0) 
                {
                    while ($results = $query->fetch()) 
                    {
                    ?>
                    <div style=
                        "background-color:  <?php echo $results['colour']?>;
                        border-radius: 10px;
                        margin: 10px;
                        padding: 12px;
                        
                        ">

                    <?php echo $results['comment'] . '<br>' . '<br>';?>
                         <a href=" <?php  echo $results['website']?> " target="_blank"><?php  echo $results['website']?></a>
                    </div>
                       <?php
                    }       
                } 
                else 
                {
                    ?>
                    <p style="padding-left: 140px; padding-top: 70px; "><?php echo 'No results found';?></p>
                    <?php
                    
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
        <?php
            require('../GET/display_discussion.php');
        ?>
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