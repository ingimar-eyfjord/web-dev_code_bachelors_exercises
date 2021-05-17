<?php
require_once(__DIR__.'./db.php');  
$whereSuccess = 'login';
$where = 'profile';
try{    
        $POST = [':user_id'=>$_SESSION['user_id']];
        $stmt = $db->prepare("UPDATE users set active = 0 WHERE user_id = :user_id AND active = 1");
        $stmt->execute($POST);
        if(!$stmt ->rowCount()){
            echo "Something went wrong";
            http_response_code(500);
            exit();
        }else{
            echo "You have successfully deactivated your account";
            http_response_code(200);
            exit();
        }
}catch(PDOException $ex){
    echo "Something went wrong";
    http_response_code(500);
    exit();
}