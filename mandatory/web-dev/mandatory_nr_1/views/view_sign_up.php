<?php  require_once(__DIR__.'./header.php'); ?>
<h1>Signup</h1>
<?php  require_once(__DIR__.'../../components/components.php'); ?>
<form class="flexColumn log_sign_form" method="POST" onsubmit="signUp(this); return false;">

    <fieldset>
        <?php
        if(isset($errorMessage)){
            echo '<p class="error"> '.urldecode($errorMessage).'</p>';
        }
        ?>
        <legend>Log in information</legend>
        <div>
            <input name="first_name" placeholder="First Name" type="text" required>
        </div>
        <div>
            <input name="last_name" placeholder="Second Name" type="text" required>
        </div>
        <div>
            <input name="age" onblur="$.val(this)" onkeydown="$.val(this)" onkeyup="$.val(this)" placeholder="age"
                min="1" max="100" type="number" required>
        </div>
        <div>
            <input name="username" placeholder="Username" type="text" required>
        </div>
        <div>
            <input name="email" onblur="$.val(this)" onkeydown="$.val(this)" onkeyup="$.val(this)" placeholder="email"
                type="email" required>
        </div>
        <div>
            <p class="pStrength">Password Strength: <span id="strength"></span></p>
            <input type="range" min="0" max="100" value="0" class="slider" id="myRange">
        </div>
        <div>
            <input type="password" onblur="$.val(this)" onkeydown="$.val(this)" onkeyup="$.val(this)"
                autocomplete="new-password" placeholder="Password" name="Password" required>
        </div>
        <div>
            <input type="password" onblur="$.val(this)" onkeydown="$.val(this)" onkeyup="$.val(this)"
                autocomplete="new-password" placeholder="Password" name="cPassword" required>
        </div>

        <h3 id="message" style="text-align:center;"></h3>
        <button>Sign up</button>

    </fieldset>
</form>


<script>
async function signUp(element) {
    const body = formToJSON(element)
    let conn = await fetch(`/signup`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json", // sent request
            // "Accept":       "application/json"   // expected data sent back
        },
        body: JSON.stringify(body),
        cache: "no-cache"
    })
    let data = await conn.text()

    if (!conn.ok) {
        console.log(data)
        $.one('#message').innerHTML = data;
        $.one('#message').style.color = "red";
        return
    }
    console.log(element.childNodes)
    element.querySelector("fieldset").childNodes.forEach(e => {
        console.log(e)
        e.disabled = true;
    })

    $.one('#message').innerHTML = data;
    $.one('#message').style.color = "green";
}
</script>
<?php  require_once(__DIR__.'./footer.php'); ?>