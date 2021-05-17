<?php
$base_folder = 'march-08';
require_once(__DIR__.'./router.php');

get('/items/:gender/:item', 'get_products');
function get_products($gender, $item){
    echo $gender;
    echo $item;
exit();
}

post('/signup', 'sign_user_up');
    function sign_user_up(){
        echo $_POST['Name'];
        echo $_POST['Middle_Name'];
        echo $_POST['Last_Name'];
        echo $_POST['Email'];
        echo $_POST['Password'];
    exit();
}


post('/login', 'login_user');
    function login_user(){
        require_once(__DIR__.'./bridges/bridge_login.php');
        // echo $_POST['Email'];
        // echo $_POST['Password'];
    exit();
}

post('/delete', 'delete_user');
    function delete_user(){
        echo $_POST['id'];
    exit();
}
post('/block', 'block_user');
    function block_user(){
        echo $_POST['id'];
    exit();
}

get('/login', 'render_login');

function render_login(){
    require_once(__DIR__.'./views/view_login.php');
    exit();
}
get('/profile', 'render_profile');
function render_profile(){
require_once(__DIR__.'./views/view_profile.php');
exit();
}
get('/login/error/:errorMess', 'render_login_error');

function render_login_error($errorMess){
$errorMessage = $errorMess;
require_once(__DIR__.'./views/view_login.php');
exit();
}

// For GET or POST
any('/404', 'error404');
function error404(){
    require_once(__DIR__.'./views/view_404_not.php');
    exit();
}