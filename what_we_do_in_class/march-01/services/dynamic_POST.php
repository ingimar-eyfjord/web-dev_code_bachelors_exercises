<?php
// this file will Post data dynamically as set up by the json data in the form submition on the messages page
require 'db_connect.php';
$content = trim(file_get_contents("php://input"));
$decoded = json_decode($content, true);
$table = $decoded['payload']['Table'];
unset($decoded['payload']['Table']); 
$POST = $decoded['payload'];

$res = pg_insert($conn, $table, $POST, $options = PGSQL_DML_EXEC);
if ($res) {
 echo "item has been inserted";
 exit();
} else {
 echo "Something went wrong\n";
 exit();
}