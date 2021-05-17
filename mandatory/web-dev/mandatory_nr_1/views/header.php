<!DOCTYPE html>
<html lang="en" style="--colour:#DC143C;--stWidth:33%">

<head>

    <?php $root = $_SERVER['DOCUMENT_ROOT']?>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?? 'Our page'?></title>
    <link rel="stylesheet" href="/style.css">
    <link rel="icon" type="image/png" href="content/images/favicon-32x32.png" />
    <script src="/library.js"></script>
    <script src="https://rawgit.com/moment/moment/2.2.1/min/moment.min.js"></script>
    <meta>
</head>

<body>

    <nav>
        <ul>
            <?php
            
            if(isset($_SESSION['username'])){
                echo "<li> <p> Welcome ".$_SESSION['username']." </p></li>";
            }            
            ?>
            <li><a href="/profile">Profile</a></li>
            <li><a href="/users">Users</a></li>
            <li><a href="/login">Login</a></li>
            <li><a href="/logout">Logout</a></li>
            <li><a href="/signup">Sign Up</a></li>
        </ul>
    </nav>

    <div class="verifyEmailMessage displayNone">
        <p>Please verify your email, within <span></span> </p>
    </div>


    <script>
    window.addEventListener("DOMContentLoaded", verifyEmail)
    let date = undefined;
    async function verifyEmail() {
        let conn = await fetch(`/signup/verify/ask`, {
            method: "GET",
            headers: {
                "Content-Type": "application/json" // sent request
                // "Accept":       "application/json"   // expected data sent back
            },
            cache: "no-cache"
        })


        let data = await conn.text()

        if (!conn.ok) {
            console.log(data)

            return
        } else {
            date = JSON.parse(data)
            startClock()
        }


    }

    let verify;

    function startClock() {
        verify = setTimeout(startClock, 1000);
        let duration = moment.duration(moment.unix(date).diff(moment()));
        let diff = duration;
        const hours = diff.asHours().toFixed(0);
        const minutes = diff.minutes().toFixed(0);
        const seconds = diff.seconds().toFixed(0);
        const message = $.one('.verifyEmailMessage')
        message.classList.remove('displayNone')
        message.querySelector('span').textContent = `${hours} hour ${minutes} minutes ${seconds} seconds left`;
    }
    </script>