<?php
// this page will fetch anything that matches the json that was posted here, you can set the limit here dynamically as well if you want
require 'db_connect.php';
$content = trim(file_get_contents("php://input"));
$decoded = json_decode($content, true);
$table = $decoded['payload']['Table'];
$result = pg_query($conn, "SELECT * FROM $table LIMIT 15");
if (!$result) {
    echo "An error occurred.\n";
    exit;
}
$arr = pg_fetch_all($result);
echo (json_encode($arr));