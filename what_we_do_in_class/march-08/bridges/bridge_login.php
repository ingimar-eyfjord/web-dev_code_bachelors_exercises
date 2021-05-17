<?php

if(!empty($_POST["Password"]) && ($_POST["Password"] == $_POST["cPassword"])) {
    if (strlen($_POST["Password"]) > '5') {
        $PasswordErr = "Your Password Must Contain At Most 5 Characters!";
        redirectError($PasswordErr);
        exit();
    }
    if(strlen($_POST["Password"]) < '2'){
        $PasswordErr = "Your Password Must Contain At Least 2 Characters!";
        redirectError($PasswordErr);
        exit();
    }
    if(!preg_match("#[0-9]+#",$_POST["Password"])) {
        $PasswordErr = "Your Password Must Contain At Least 1 Number!";
        redirectError($PasswordErr);
        exit();
    }
    if(!preg_match("#[A-Z]+#",$_POST["Password"])) {
        $PasswordErr = "Your Password Must Contain At Least 1 Capital Letter!";
        redirectError($PasswordErr);
        exit();
    }
    if(!preg_match("#[a-z]+#",$_POST["Password"])) {
        $PasswordErr = "Your Password Must Contain At Least 1 Lowercase Letter!";
        redirectError($PasswordErr);
        exit();
    }
}




if(empty($_POST["Password"])) {
    $PasswordErr = "Please enter Password";
     redirectError($PasswordErr);
     exit();
} 

if(($_POST["Password"] != $_POST["cPassword"])){
    $PasswordErr = "Passwords do not match";
    redirectError($PasswordErr);
    exit();
}



$right_email = 'a@a.com';

if($right_email == $_POST['Email']){
    redirectSuccess();
exit();
}else{
    $emailErr = "invalid email";
    redirectError($emailErr);
    exit();
}
function redirectSuccess(){
    header('Location: http://localhost/WEB-DEV/what_whe_do_in_class/march-08/profile'); 
}

function redirectError($error){
    header("Location: http://localhost/WEB-DEV/what_whe_do_in_class/march-08/login/error/$error");
}