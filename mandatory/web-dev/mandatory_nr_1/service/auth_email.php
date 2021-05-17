<?php
echo "<div>$token</div>";
echo "<div>$selector</div>";
require_once(__DIR__.'./db.php');  
function redirectSuccess($where){
    header("Location: /$where"); 
}

function redirectError($error, $where){
    header("Location: /$where/error/$error");
}

$whereSuccess = 'profile';
$where = 'signup';
try{
$POST = [':selector'=>$selector];
$stmt = $db->prepare("SELECT * FROM authenticate WHERE selector = :selector");           
$stmt->execute($POST);
$rows = $stmt->fetchAll();
$currentDate = date('U');
print_r($rows);
$tokenBin = hex2bin($token);
$tokenCheck = password_verify($tokenBin, $rows[0]->authToken);
if ($tokenCheck === false) {
    $error = "Your verification process failed, please try again";
    header("Location: /signup/verify/error/$error");
    exit;
}
$stmt_2 = $db->prepare("UPDATE authenticate SET emailVerified = 1 WHERE selector = :selector");  
$stmt_2->execute($POST);


$POST_3 = [':email'=>$rows[0]->email];
$stmt_3 = $db->prepare("SELECT * FROM users WHERE email = :email");  

$stmt_3->execute($POST_3);
$rows_3 = $stmt_3->fetchAll();


$_SESSION['username'] = $rows_3[0]->username;
$_SESSION['email'] = $rows_3[0]->email;
$_SESSION['user_id'] = $rows_3[0]->user_id;
redirectSuccess($whereSuccess);
}catch(PDOException $ex){
    echo $ex;
    redirectError( "Something went wrong", $where);
    }