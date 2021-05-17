<?php  require_once(__DIR__.'./header.php'); ?>

<style>
.error {
    color: red;
}
</style>

<body>
    <form class="flexColumn log_sign_form" action="/login" method="POST">
        <fieldset>
            <legend>Login</legend>
            <?php
        if(isset($errorMessage)){
            echo '<p class="error"> '.urldecode($errorMessage).'</p>';
        }
        ?>

            <div>
                <input name="emailOrUsername" placeholder="Email or Username" type="text">
            </div>
            <div>
                <input type="password" placeholder="Password" name="Password">
            </div>
            <?php
            if(isset($errorMessage)){
                if(urldecode($errorMessage) == "This account is deactivated"){
                    ?>
            <button type="button" onclick="reactivate(this); return false;">Reactivate account</button>
            <?php
                }else{
                    ?>
            <button>Login</button>
            <?php
              }
            }
            if(!isset($errorMessage)){
                ?>
            <button>Login</button>
            <?php
            }
            ?>
        </fieldset>
    </form>
    <?php  require_once(__DIR__.'./footer.php'); ?>

    <form id="ReactivateForm" method="POST" action="/profile/reactivate">
        <input type="hidden" name="emailOrUsername">
        <input type="hidden" name="Password">
    </form>

    <script>
    async function reactivate(button) {
        const form = $.one('#ReactivateForm')
        const emailOrUsername = form.querySelector('[name="emailOrUsername"]')
        const Password = form.querySelector('[name="Password"]')
        const Data = formToJSON(button.parentNode.parentNode.elements)
        Password.value = Data.Password
        emailOrUsername.value = Data.emailOrUsername
        form.submit()
    }
    </script>