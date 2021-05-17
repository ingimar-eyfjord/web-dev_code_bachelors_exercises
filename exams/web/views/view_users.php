<?php  require_once(__DIR__.'./header.php');
/// Main part pf the page
if(!isset($_SESSION['username'])){
    header("Location: /login");
}
?>
<main class="usersMain">
    <div id="usersOfSystem">
        <h3>Users of this platform</h3>
        <?php
    require_once("{$_SERVER['DOCUMENT_ROOT']}/service/db.php");
    try{
        $stmt = $db->prepare('SELECT username, first_name, last_name, email, age, active FROM users ORDER BY age DESC');
        $stmt->execute();
        $rows = $stmt->fetchAll();
        foreach ($rows as $value) {
?>
        <div class="usersOfSystem">
            <span class="profilePhoto-colour"></span>
            <div class="profilePhoto-container">
                <img class="profilePhoto-image" src="/content/images/profiles/<?=$value->username?>.jpg"
                    aria-alt="<?=$value->username?>'s profile photo">
            </div>
            <div class="userStats">
                <div>
                    <p><?=$value->first_name?> <?=$value->last_name?></p>
                    <p><?=$value->username?></p>
                </div>
                <div class="status">
                    <div style="border-left: none;">
                        <p>Age</p>
                        <p class="age"><?=$value->age?></p>
                    </div>
                    <div>
                        <p>Status</p>
                        <p><?=$value->active == 1 ? "active" : "inactive"?></p>
                    </div>
                </div>
                <div class="email">
                    <p><?=$value->email?></p>
                </div>
            </div>
        </div>
        <?php
        }
    }catch(PDOException $ex){
        echo "something went wrong";
        }
    ?>
    </div>
    <div>
        <h3>Fake users inside sqlite database</h3>
        <?php
require_once("view_search.php");
?>
        <div class="PaginationBtn">
            <button data-page="0" data-dir="decr" onclick="pagination(this)" type="button">&lsaquo;</button>
            <button data-page="0" data-dir="incr" onclick="pagination(this)" type="button">&rsaquo;</button>
        </div>

        <script>
        async function delete_user(element) {

            const parent = element.parentElement.parentElement
            const id = parent.dataset.user_id
            let conn = await fetch(`/users/delete/${id}`, {
                'method': "POST",
            })
            if (!conn.ok) {
                alert("no");
                return
            }
            let data = await conn.text()
            console.log(data)
            parent.remove()


        }

        async function delete_user(element) {

            const parent = element.parentElement.parentElement
            const id = parent.dataset.user_id
            let conn = await fetch(`/users/extra_users`, {
                'method': "POST",
            })
            if (!conn.ok) {
                alert("no");
                return
            }
            let data = await conn.text()
            console.log(data)
            parent.remove();
        }
        </script>



    </div>
</main>


<!-- // Bottom of the page -->
<?php  require_once(__DIR__.'./footer.php'); ?>