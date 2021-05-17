<?php  require_once(__DIR__.'./header.php'); ?>
<h1>Signup</h1>
<?php  require_once(__DIR__.'../../components/components.php'); ?>
<form class="flexColumn log_sign_form" action="http://localhost/WEB-DEV/mandatory/web-dev/mandatory_nr_1/signup/"
    method="POST">

    <?php
        if(isset($errorMessage)){
            echo '<p class="error"> '.urldecode($errorMessage).'</p>';
        }
        ?>
    <div>

        <input name="username" placeholder="Username" type="text">
    </div>
    <div>

        <input name="email" onkeydown="$.val(this)" onkeyup="$.val(this)" placeholder="email" type="email">
    </div>
    <div>
        <p class="pStrength">Password Strength: <span id="strength"></span></p>
        <input type="range" min="0" max="100" value="0" class="slider" id="myRange">
    </div>
    <div>
        <input type="password" onkeydown="$.val(this)" onkeyup="$.val(this)" autocomplete="new-password"
            placeholder="Password" name="Password">
    </div>
    <div>
        <input type="password" onkeydown="$.val(this)" onkeyup="$.val(this)" autocomplete="new-password"
            placeholder="Password" name="cPassword">
    </div>
    <?php 
    $input = 
    Input('cPassword', 
    ['autocomplete="new-password"', ''],
    'x',
    ['onkeyup="$.val(this)"',
    'onkeydown="$.val(this)"'],
    'Confirm Password',
    'cPassword',
    'password');
    echo $input;
    ?>
    <button>Button</button>
</form>
<?php  require_once(__DIR__.'./footer.php'); ?>