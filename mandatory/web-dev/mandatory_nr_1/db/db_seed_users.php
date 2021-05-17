<?php
try{
  // require_once "../faker/autoload.php";

  $root = "{$_SERVER['DOCUMENT_ROOT']}/WEB-DEV/mandatory/web-dev/mandatory_nr_1/";
  require_once "$root/faker/autoload.php";
  $faker = Faker\Factory::create();
  $db_path = "$root/db/users.db";
  $db = new PDO("sqlite:$db_path");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  $q = $db->prepare("INSERT INTO users VALUES (:user_uuid, :user_name, :user_last_name, :user_email, :user_phone, :user_password)");
  for($i = 0; $i < 500; $i++){
    $q->bindValue(':user_uuid', bin2hex(random_bytes(16)));
    $q->bindValue(':user_name', $faker->firstName());
    $q->bindValue(':user_last_name', $faker->lastName());
    $q->bindValue(':user_email', $faker->email());
    $q->bindValue(':user_phone', mt_rand(10000000,99999999));
    $q->bindValue(':user_password', $faker->password());
    $q->execute();
  }  
}catch(PDOException $ex){
  echo $ex;
}