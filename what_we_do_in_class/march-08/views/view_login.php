<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<style>
.error {
    color: red;
}
</style>

<body>
    <h1>Login</h1>



    <form action="http://localhost/WEB-DEV/what_whe_do_in_class/march-08/login" method="POST">

        <?php
        if(isset($errorMessage)){
            echo '<p class="error"> '.urldecode($errorMessage).'</p>';
    }

    ?>


        <input name="Email" placeholder="email" type="email">
        <input type="password" name="Password">
        <input type="password" name="cPassword">
        <button>Button</button>
    </form>
</body>

</html>