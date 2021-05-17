  <?php

try{
$root = "{$_SERVER['DOCUMENT_ROOT']}/WEB-DEV/mandatory/web-dev/mandatory_nr_1/db";
  $db = new PDO("sqlite:$root/users.db");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
  $q = $db->prepare('DROP TABLE IF EXISTS users');
  $q->execute();
  $q = $db->prepare('CREATE TABLE users(
    user_uuid         TEXT UNIQUE,
    user_name         TEXT,
    user_last_name    TEXT,
    user_email        TEXT UNIQUE,
    user_phone        TEXT UNIQUE,
    user_password     TEXT,
    PRIMARY KEY(user_uuid)
  ) WITHOUT ROWID');
  $q->execute();
}catch(PDOException $ex){
  echo $ex;
}