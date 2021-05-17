<?php  require_once(__DIR__.'./header.php'); ?>

<style>
.error {
    color: red;
}
</style>

<body>
    <h1>Login</h1>
    <form class="flexColumn log_sign_form" action="http://localhost/WEB-DEV/mandatory/web-dev/mandatory_nr_1/login"
        method="POST">
        <?php
        if(isset($errorMessage)){
            echo '<p class="error"> '.urldecode($errorMessage).'</p>';
    }

    ?>
        <div>

            <input name="emailOrUsername" placeholder="Repeat Username" onkeydown="Email or Username" type="text">
        </div>
        <div>

            <input type="password" placeholder="Password" name="Password">
        </div>
        <div>

            <input type="password" placeholder="Repeat password" name="cPassword">
        </div>
        <button>Button</button>
    </form>
    <?php  require_once(__DIR__.'./footer.php'); ?>