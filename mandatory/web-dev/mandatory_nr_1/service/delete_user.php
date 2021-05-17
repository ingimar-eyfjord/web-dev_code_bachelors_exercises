<?php
try{
      $db = new PDO("sqlite:db/users.db");
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      $q = $db->prepare('DELETE FROM users WHERE user_uuid = :user_uuid');
      $q->bindValue(':user_uuid', $id);
      $q->execute();
      
    }catch(PDOException $ex){
      echo $ex;
    }