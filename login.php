
<?php

session_start();
$message = "";

require('dbconnect.php');
$con = CreateConnection();

if(isset($_POST['submit'])){
    if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['team'])) {
        $message = "All fields are required";
    }
    else
    {
        $sql = "SELECT * FROM login WHERE username = :username AND password = :password AND team = :team";
        $query_stmt = $con -> prepare($sql);
        $query_stmt -> execute(
            array(
                'username' => $_POST["username"],
                'password' => $_POST["password"],
                'team' => $_POST["team"]
            )
        );
        $count = $query_stmt->rowCount();
        if($count > 0){
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['team'] = $_POST['team'];
            header("location: home.php");
        }
        else
        {
            $message= "Your login details were not recognised";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" media="screen" href="CSS/styles1.css" />
    <script src="main.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <header id="login_header">

    </header>

    <section>
        <form id="login_form" method="post">
            <p id="login_title">Login</p>

            <?php
            if(isset($message)){?>
            <div id="login_message">
                <?php echo $message; ?>
            </div>
           
       <?php }
    ?>
            <input class="login_details" name="username" placeholder="Enter your Username"><br>
            <input class="login_details" name="team" placeholder="Enter your Team"><br>
            <input class="login_details" name="password" type="password"  placeholder="Enter your Password"><br>
            <input id="login_submit" name="submit" type="submit" placeholder="Submit">
        </form>
    </section>

</body>
</html>