
<?php


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="CSS/styles1.css" />
    <script src="main.js"></script>
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