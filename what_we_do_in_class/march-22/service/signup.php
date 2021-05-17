<?php
require_once(__DIR__.'./db.php'); 
$whereSuccess = 'home';
$where = 'signup';
require_once(__DIR__.'./validator.php');  
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['Password'];
$passwordRepeat = $_POST['cPassword'];
$hashedPwd = password_hash($password, PASSWORD_DEFAULT);
if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
    $error = "The some fields where left empty";
    redirectError($error, $where);
}
if ($password !== $passwordRepeat) {
    $error = "The passwords don't match";
    redirectError($error, $where);  
} 

try{    
    $stmt = $db->prepare('SELECT * FROM users where email = :username');
    $stmt->bindValue(':username', $username);
    $stmt->execute();
    $rows = $stmt->fetchAll();
    
    if(count($rows) >= 1){
        $UserError = "User with that username has already exists";
        redirectError($UserError, $where);
    }else{
        createUser($username,$email,$hashedPwd, $db, $whereSuccess);
    }
}catch(PDOException $ex){
    redirectError($ex, $where);
}
   function createUser($username,$email,$hashedPwd, $db, $whereSuccess){
        try{
            $POST = [$username,$email,$hashedPwd];
            $stmt = $db->prepare('INSERT INTO users (username, email, password) values(?,?,?)');
            $stmt->execute($POST);
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            redirectSuccess($whereSuccess);
        }catch(PDOException $ex){
            redirectError( $ex, $whereSuccess);
            }
    }



//    Bellow here is an email code, you can send emails with PHP but it would need to be connected 
// to a domain (the code and front end hosted) with email feature set up, its a good idea to send // the user a notification when 
//  they sign uo
    //   $emailmess =  '
    //   <p>Here is your new log in information for the Chat System.</p>
    //   <p>You can use your name (' . $name . ') or this email address as the username.</p>
    //   <p>Here is the password: ' . $password . '</p>';
    //   $to = $email;
    //   $subject = 'Your new log in details.';
    //   $message = $emailmess;
    //   $headers = "From: Dialogue One <dialogueone@dialogueone.com>\r\n";
    //   $headers .= "Reply-To: <noreply@dialogueone.com>\r\n";
    //   $headers .= "Content-type: text/html\r\n";
    //   mail($to, $subject, $message, $headers);
    //   exit();