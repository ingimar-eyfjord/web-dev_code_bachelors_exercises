<html>

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="css.css">
</head>

<body>
    <div class="loginmodal card">

        <form class="login" action="includes/php-script/verify.php" method="post">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" name="mailuid" placeholder="Username" aria-label="Username"
                        aria-describedby="basic-addon1">
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-key"></i></span>
                    </div>
                    <input type="password" class="form-control" name="pwd" placeholder="Password" aria-label="Password"
                        aria-describedby="basic-addon1">
                </div>
            </div>



            <button class="btn" style="margin-bottom:1rem" type="submit" name="login-submit">Login</button>

        </form>

        <?php

        if (isset($_GET["newpwd"])) {
            if ($_GET["newpwd"] == "passwordupdated") {
                echo '<p class="signupsuccess">Your Password has been reset!</p>';
            }
        }

        if (isset($_GET["Session"])) {
            if ($_GET["Session"] == "Expired") {
                echo '<p class="warning">You were inactive too long. <br> The session expired!</p>';
            }
        }
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "wrongpassword") {
                echo '<p class="warning">Wrong password!</p>';
            }
        }


        ?>
        <a href="reset-password.php">Forgot/change your password?</a>
    </div>


</body>

</html>