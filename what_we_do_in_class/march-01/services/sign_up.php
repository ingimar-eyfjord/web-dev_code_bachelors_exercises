<?php
session_start();
require 'db_connect.php';
// here I'm defining the information that is passed by form over to this file
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$passwordRepeat = $_POST['password-repeat'];
// this function hashes the password so it won't be readable
$hashedPwd = password_hash($password, PASSWORD_DEFAULT);
$POST = ['username' => $username, 'email' => $email, 'password' => $hashedPwd];
// Here you check if any fields are empty if they are then it should not continue
if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
  echo "The some fields where left empty";
  header("Location:../log_in.php?empty_fields.");
  exit();
  // here it's checking if the passwords match
} else if ($password !== $passwordRepeat) {
  echo "The passwords don't match";
  header("Location:../log_in.php?passwords_no_match.");
  exit();
} else {
  // Here you would usually check if the connection works but I think this is wrong I need to fix it
 // I'm preparing a statement for execution it's critical that we send safe data to the database with prepared statements
  if (!pg_prepare($conn, "my_query", 'SELECT * FROM log_in WHERE username = $1')) {
    echo "There has been an error";
    header("Location:../log_in.php?some_error.");
    exit();
  } else {
    // Execute the prepared statement above, this block of code checks if the user exists already
    $res = pg_execute($conn, "my_query", array($username)); 
    if ($rows = pg_num_rows($res) >= 1) {
     echo 'User with that username has already exists';
     header("Location:../log_in.php?user_already_exists.");
     exit();
    } else {
      // This is the insert statement, it will create the user if all the other if statements are passed
        $res = pg_insert($conn, 'log_in', $POST, $options = PGSQL_DML_EXEC);
           if ($res) {
            echo "user $username | $email has been created.";
            header("Location:../index.php?userCreate=$username.");
            exit();
        } else {
            echo "Something went wrong\n";
            exit();
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
    }
  }