<?php

session_start();
require_once(__DIR__.'./router.php');
get('/', function() {
    if(isset($_SESSION['username'])){
        $page_title = 'Profile';
        require_once(__DIR__.'./views/profile.php');
    }else{
        $page_title = 'Login';
        require_once(__DIR__.'./views/view_login.php');
    }
    exit();
});


get('/home', function (){
        if(isset($_SESSION['username'])){
            $page_title = 'Profile';
            require_once(__DIR__.'./views/view_profile.php');
        }else{
            // unauthorized();
            $page_title = 'Login';
            require_once(__DIR__.'./views/view_login.php');
        }
        exit();
});

get('/login', function(){
    $page_title = 'Login';
        require_once(__DIR__.'./views/view_login.php');
    exit();
});

get('/logout', function (){
        session_destroy();
        require_once(__DIR__.'./views/view_login.php');
        exit();
});

get('/signup', function(){
    $page_title = 'Signup';
    require_once(__DIR__.'./views/view_sign_up.php');
    exit();
});


get('/login/error/:errorMess', 'render_login_error');
function render_login_error($errorMess){
$page_title = 'Login Error';
$errorMessage = $errorMess;
require_once(__DIR__.'./views/view_login.php');
exit();
}
get('/signup/error/:errorMess', 'render_signup_error');
// For GET or POST
function render_signup_error($errorMess){
    $page_title = 'Signup Error';
    $errorMessage = $errorMess;
    require_once(__DIR__.'./views/view_sign_up.php');
    exit();
    }


// get('/items/:gender/:item', 'get_products');
// function get_products($gender, $item){
//     echo $gender;
//     echo $item;
// exit();
// }
post('/signup', function(){

    
    require_once(__DIR__.'./service/signup.php');
    exit();
});
    
post('/login', function(){
    require_once(__DIR__.'./service/auth.php');
    exit();
});
   
post('/delete', function(){
    echo $_POST['id'];
    exit();
});
   
post('/block', function(){
    echo $_POST['id'];
    exit();
});
  

post('/post/:id/:like_dislike', function($id, $like_dislike){
    if(!ctype_digit($id)){
        bad_request("Invalid ID");
    };
    if(!ctype_digit($like_dislike)){
        bad_request("Client sent wrong info");
    };


    switch ($like_dislike):
        case 0:
            echo 'disliked';
            break;
        case 1:
            echo 'liked';
            break;
        default:
        bad_request("Invalid like or dislike");
    endswitch;
});


any('/404', function(){
    require_once(__DIR__.'./views/view_404_not.php');
    exit();
});
function bad_request($message){
    http_response_code(400);
    echo $message;
    exit();
    };
    function unauthorized(){
    http_response_code(401);
    exit();
    };
    function internal_server_error(){
    http_response_code(500);
    exit();
    };