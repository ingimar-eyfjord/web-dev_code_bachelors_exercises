<?php
session_start();
require 'db_connect.php';
  $username = $_POST['username'];
  $password = $_POST['password'];
/// Here i'm checking if the user pushed the login button
if (isset($_POST['login-submit'])) {
// Here you check if any fields are empty if they are then it should not continue
  if (empty($username) || empty($password)) {
    echo 'some fields where left empty <a href="../log_in.php">Go Back</a>';
    exit();
} 
// Here Im preparing a statement for execution it's critical that we send safe data to the database with prepared statements
pg_prepare($conn, "my_query", 'SELECT * FROM log_in WHERE username = $1');
// execute the statement
$res = pg_execute($conn, "my_query", array($username));
if ($rows = pg_fetch_assoc($res)) {
  // Make php dehash/compare the passwords from the database to the one that was inserted to log in.
        $pwdCheck = password_verify($password, $rows['password']);
   if ($pwdCheck == false) {
    echo 'wrong password <a href="../log_in.php">Go Back</a>';
    exit();
    }else if ($pwdCheck == true) {
    echo "correct password";
    // start the session, these session variables are available in the server, it's connected via the cookies, if you log in and then delete the cookie for example, you loose your log_in
      session_start();
      $_SESSION['user_id'] = $rows['user_id'];
      $_SESSION['username'] = $rows['username'];
      $_SESSION['email'] = $rows['email'];
      $_SESSION['LoggedIn'] = "1";
      header("Location:../index.php?login=success");
    }
   } else {
      echo 'user does not exist <a href="../log_in.php">Go Back</a>'; 
   }
        }