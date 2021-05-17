<?php
session_start();
require_once("./router.php");
require_once("./routes/https_common.php");

   
post('/block', function(){
    echo $_POST['id'];
    exit();
});
  