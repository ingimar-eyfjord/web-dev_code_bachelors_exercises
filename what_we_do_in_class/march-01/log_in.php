<?php 
$Current_page = "Login";
require_once('./header.php');
?>

<div id="log_in_body">
    <div>
        <h2>Log in</h2>
        <form action="services/verify.php" class="log_in" method="post">
            <label for="username">Username</label>
            <input id="username" type="text" name="username">
            <label for="password">Password</label>
            <input id="password" type="password" name="password">
            <button type="submit" name="login-submit">Log in</button>
        </form>
    </div>
    <div>
        <h2>Sign up</h2>
        <form action="services/sign_up.php" class="signup" method="post">
            <label for="username">Username</label>
            <input id="username" type="text" name="username">
            <label for="email">Email address</label>
            <input id="email" type="email" name="email">
            <label for="password">Password</label>
            <input id="password" type="password" name="password">
            <label for="password-repeat">Repeat password</label>
            <input id="password-repeat" type="password" name="password-repeat">
            <button type="submit">Sign up</button>
        </form>
    </div>
</div>
<?php
    require_once('./footer.php');
?>