<?php  require_once(__DIR__.'/header.php');
/// Main part pf the page

if(!isset($_SESSION['username'])){
    header("Location: /users");
}
if(!isset($id)){
    header("Location: /users");
}
if(strlen($id) != 32){
    header("Location: /users");
}
if(!ctype_alnum($id)){
    header("Location: /users");
}

try{
      $db = new PDO("sqlite:db/users.db");
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      $q = $db->prepare('SELECT user_name, user_last_name, user_email, user_phone FROM users WHERE user_uuid = :user_uuid');
      $q->bindValue(':user_uuid', $id);
      $q->execute();
      $user = $q->fetch();
      if(!$user){
        header("Location: /users");
      }
    }catch(PDOException $ex){
      echo $ex;
    }
    ?>
<div class="usersOfSystem">
    <span class="profilePhoto-colour"></span>
    <div class="profilePhoto-container">
        <img class="profilePhoto-image" src="/content/images/profiles/<?=$value->username?>.jpg"
            aria-alt="<?=$value->username?>'s profile photo">
    </div>
    <div class="userStats">
        <div>
            <p><?= $user['user_name']?> <?= $user['user_last_name']?></p>
        </div>
        <div class="status">
            <div style="border-left: none;">
                <p>Phone</p>
                <p><?= $user['user_phone']?>
                </p>
            </div>
            <div>
                <p>Email</p>
                <p>
                    <?= $user['user_email']?>
                </p>
            </div>
        </div>
        <div class="email">
            <p>Could seed the users to get more info maybe</p>
        </div>
    </div>