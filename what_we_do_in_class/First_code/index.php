<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>First Homework</title>
    <link rel="stylesheet" href="app.css">
</head>

<body>
    <div class="MainContainer">
    </div>




    <template>

        <div class="user">
            <div class="userImgContainer">
                <img class="userImg" src="./img/1.jpg" alt="">
            </div>
            <div class="UserInfoContainer">

                <p class="Username">
                    First name:
                    <span data-color="red" data-element="first">Santiago</span>
                </p>

                <p class="Username">
                    Last name:
                    <span data-color="blue" data-element="last">Donoso</span>
                </p>

                <p class="email">
                    Email:
                    <a data-color="yellow" data-element="email" href="mailto: abc@example.com">Send Email
                    </a>
                </p>
            </div>


            <div class="HideButtonContainer buttonContainer">
                <button data-color="blue" onclick="activate('This is a string', this)" data-show_hide="first"
                    data-button="1">
                    Show/Hide first name
                </button>
                <button data-button="2" data-color="yellow" onclick="activate('This is a string', this)"
                    data-show_hide="last">
                    Show/Hide last name
                </button>
                <button data-button="3" data-color="red" onclick="activate('This is a string', this)"
                    data-show_hide="email">
                    Show/Hide email
                </button>
            </div>


        </div>



    </template>




    <script src="index.js"></script>
</body>

</html>