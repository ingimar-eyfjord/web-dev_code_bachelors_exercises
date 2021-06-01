<?php  require_once(__DIR__.'/header.php');
/// Main part pf the page
if(!isset($_SESSION['username'])){
    header("Location: /users");
}
if(!isset($id)){
    header("Location: /users");
}
if(!ctype_alnum($id)){
    header("Location: /users");
}
try{
    require_once("{$_SERVER['DOCUMENT_ROOT']}/api/models/dbc.php");
    $stmt = $db->prepare('SELECT user_id, username, first_name, last_name, email, age, active, phone FROM users WHERE user_id = :user_id');
    $stmt->bindValue(':user_id', $id);
    $stmt->execute();
    $user = $stmt->fetch();
    if(!$user){
        header("Location: /users");
    }
    }catch(PDOException $ex){
        echo $ex;
      echo "something went wrong, please try again";
    }
    ?>
<div class="usersOfSystem">
    <span class="profilePhoto-colour"></span>
    <div class="profilePhoto-container">
        <img class="profilePhoto-image" src="/content/images/profiles/<?=$user->username?>.jpg"
            aria-alt="<?=$user->username?>'s profile photo">
    </div>
    <div class="userStats">
        <div>
            <p><?= $user->first_name?> <?= $user->last_name?> age <?= $user->age?></p>
        </div>
        <div class="status">
            <div style="border-left: none;">
                <p>Phone</p>
                <p><?= $user->phone?>
                </p>
            </div>
            <div>
                <p>Active status</p>
                <p>
                    <?= $user->active == 1 ? "Active" : "Inactive"?>
                </p>
            </div>

        </div>
        <div class="email">
            <?= $user->email?>
        </div>
        <button class="btn btn-danger mt-3" style="width:100%" onclick="deactivate()">Deactivate my
            profile</button>
    </div>
    <script>
    async function deactivate() {
        let txt;
        let r = confirm("This will deactivate the account, are you sure?");
        if (r !== true) {
            return;
        }
        await $.ajax({
            type: "POST",
            url: "/profile/deactivate",
            data: JSON.stringify({
                id: `<?=$user->user_id?>`
                email: `<?=$user->user_id?>`
            }),
            success: function(response) {
                console.log(response)
                // window.location.replace("/logout");
            },
            error: function(result) {
                console.log(result)
            }
        });
    }
    document.addEventListener("DOMContentLoaded", () => {
        const image = document.querySelectorAll(".profilePhoto-image")
        image.src = `services/find_image/<?=$user->username?>`;
    })
    </script>
    <?php  require_once(__DIR__.'./footer.php'); ?>