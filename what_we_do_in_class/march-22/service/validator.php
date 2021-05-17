<?php
if(!empty($_POST["Password"]) && ($_POST["Password"] == $_POST["cPassword"])) {
   
    if(strlen($_POST["Password"]) < '5'){
        $PasswordErr = "Your Password Must Contain At Least 2 Characters!";
        redirectError($PasswordErr, $where);
        exit();
    }
    if(!preg_match("#[0-9]+#",$_POST["Password"])) {
        $PasswordErr = "Your Password Must Contain At Least 1 Number!";
        redirectError($PasswordErr, $where);
        exit();
    }
    if(!preg_match("#[A-Z]+#",$_POST["Password"])) {
        $PasswordErr = "Your Password Must Contain At Least 1 Capital Letter!";
        redirectError($PasswordErr, $where);
        exit();
    }
    if(!preg_match("#[a-z]+#",$_POST["Password"])) {
        $PasswordErr = "Your Password Must Contain At Least 1 Lowercase Letter!";
        redirectError($PasswordErr, $where);
        exit();
    }
}

if(empty($_POST["Password"])) {
    $PasswordErr = "Please enter Password";
     redirectError($PasswordErr, $where);
     exit();
} 

if(($_POST["Password"] != $_POST["cPassword"])){
    $PasswordErr = "Passwords do not match";
    redirectError($PasswordErr, $where);
    exit();
}

 function redirectSuccess($where){
    header("Location: http://localhost/WEB-DEV/mandatory/web-dev/mandatory_nr_1/$where"); 
}

function redirectError($error, $where){
    header("Location: http://localhost/WEB-DEV/mandatory/web-dev/mandatory_nr_1/$where/error/$error");
}