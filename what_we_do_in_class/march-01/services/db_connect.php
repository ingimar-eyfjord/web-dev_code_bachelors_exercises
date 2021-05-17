<?php
$conn = pg_connect("host=localhost port=5432 dbname={Yor database name} user={your postgres user name usually it's just postgres} password={the password you use to log in} options='--client_encoding=UTF8'");
?>