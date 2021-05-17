<?php
require_once(__DIR__.'./db.php');  
$whereSuccess = 'home';
$where = 'login';
require_once(__DIR__.'./validator.php');  
try{    
        $Post = $_POST['emailOrUsername'];
        $POST = [':email'=>$_POST['emailOrUsername'],'username'=>$_POST['emailOrUsername']];
        $stmt = $db->prepare('SELECT * FROM users where email = :email OR username = :username');
        $stmt->execute($POST);
        $rows = $stmt->fetchAll();

        if(count($rows) == 0){
            $UserError = "User does not exist";
            redirectError($UserError, $where);
        }else{
            $_SESSION['username'] = $rows[0]->username;
            $_SESSION['email'] = $rows[0]->email;
            redirectSuccess($whereSuccess);
        }
}catch(PDOException $ex){
redirectError($ex, $where);
}