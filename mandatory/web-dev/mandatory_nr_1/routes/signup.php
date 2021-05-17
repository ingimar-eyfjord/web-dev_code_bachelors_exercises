<?php 

get('/signup', "views/view_sign_up.php");

get('/signup/error/$errorMess', 'views/view_sign_up.php');


get('/signup/verify/ask', "service/verify_email.php");
get('/signup/verify/$token/$selector', "service/auth_email.php");

get('/signup/verify/error/$errorMessage', "views/view_sign_up.php");

post('/signup', 'service/signup.php');