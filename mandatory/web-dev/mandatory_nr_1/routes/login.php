<?php

get('/login', "views/view_login.php");

get('/login/error/$errorMessage', 'views/view_login.php');
    
post ('/login', "service/auth.php");

post ('/login/reactivate' , 'service/auth_reactivate.php');