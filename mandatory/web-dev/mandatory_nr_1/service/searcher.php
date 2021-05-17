<?php
$body = file_get_contents('php://input');
$data = json_decode($body , true);
$_POST = $data;
if(!isset($_POST['search_for'])){
http_response_code(400);
exit();
}

if(strlen($_POST['search_for']) < 2){
    http_response_code(400);
    exit();
}
if(strlen($_POST['search_for']) > 20){
    http_response_code(400);
    exit();
}
$offset = intval($_POST['page']) * 20;
    
try{
      $db = new PDO("sqlite:db/users.db");
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      $q = $db->prepare('SELECT user_name, user_last_name, user_uuid FROM users WHERE user_name LIKE :user_name OR user_last_name LIKE :user_name LIMIT 20 OFFSET :offset COLLATE NOCASE');
      $q->bindValue(':user_name', '%'.trim($_POST['search_for']).'%');
      $q->bindValue(':offset', $offset);
      
      $q->execute();
      $users = $q->fetchAll();
      $users[0]['num_rows'] = count($users);

      $Q2 = $db->prepare('SELECT COUNT(:everything) FROM users WHERE user_name LIKE :user_name OR user_last_name LIKE :user_name'); 
      $Q2->bindValue(':everything', "*");
      $Q2->bindValue(':user_name', '%'.trim($_POST['search_for']).'%');
      $Q2->execute();
      $num = $Q2->fetchColumn(); 
      $users[0]['num_rows'] = $num;

      header("Content-type:application/json");
      echo json_encode($users);
    }catch(PDOException $ex){
      echo $ex;
    }