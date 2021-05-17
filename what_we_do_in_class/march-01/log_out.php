<?php
// Here i'm destroying all the session variables
session_start();
session_unset();
session_destroy();
if (isset($_COOKIE[session_name()])) :
    setcookie(session_name(), '', time() - 7000000, '/');
endif;
header("Location: log_in.php");