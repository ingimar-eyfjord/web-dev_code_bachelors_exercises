<?php  require_once(__DIR__.'./header.php'); ?>

<style>
.error {
    color: red;
}
</style>

<form class="flexColumn container log_sign_form mt-3" action="/login" method="POST">
    <legend>Login</legend>
    <div class="card h-100">

        <?php
        if(isset($errorMessage)){
            echo '<p class="error"> '.urldecode($errorMessage).'</p>';
        }
        ?>
        <div class="form-floating m-3">
            <input class="form-control" type="text" placeholder="Email or Username" id="floatingInputF"
                name="emailOrUsername" required>
            <label for="floatingInputF">Email or Username</label>
        </div>
        <div class="form-floating m-3">
            <input class="form-control" type="text" placeholder="Password" id="floatingInputP" name="Password" required>
            <label for="floatingInputP">Password</label>
        </div>
        <?php
            if(isset($errorMessage)){
                if(urldecode($errorMessage) == "This account is deactivated"){
                    ?>
        <button type="button" class="btn btn-primary m-3" onclick="reactivate(this); return false;">Reactivate
            account</button>
        <?php
                }else{
                    ?>
        <button class="btn btn-primary m-3">Login</button>
        <?php
              }
            }
            if(!isset($errorMessage)){
                ?>
        <button class="btn btn-primary m-3">Login</button>
        <?php
            }
            ?>
        <a href="/login/reset-password" class="text-center m-3">Forgot your password? Click here to reset it.</a>
    </div>
</form>

<form id="ReactivateForm" method="POST" action="/profile/reactivate">
    <input type="hidden" name="emailOrUsername">
    <input type="hidden" name="Password">
</form>


<script>
async function reactivate(button) {
    const form = document.querySelector("#ReactivateForm")
    const emailOrUsername = form.querySelector('[name="emailOrUsername"]')
    const Password = form.querySelector('[name="Password"]')
    const pass = $('#floatingInputP')
    const user = $('#floatingInputF')
    const Data = formToJSON([pass[0], user[0]])
    Password.value = Data.Password
    emailOrUsername.value = Data.emailOrUsername
    form.submit()
}
</script>
<?php  require_once(__DIR__.'./footer.php'); ?>