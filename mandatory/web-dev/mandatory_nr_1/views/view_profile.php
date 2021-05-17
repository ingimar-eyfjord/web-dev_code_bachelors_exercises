<?php  require_once(__DIR__.'./header.php'); 

if(!isset($_SESSION['username'])){
    header("Location: /login");
        }
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="container">
</div>
<?php 
$post_status = 0;

?>
<div class="usersOfSystem">
    <span class="profilePhoto-colour"></span>
    <div class="profilePhoto-container">

        <img class="profilePhoto-image" src="<?=glob("content/images/profiles/" . $_SESSION['username'] . ".*")[0]?>"
            aria-alt="<?=$_SESSION['username']?>'s profile photo">
    </div>

    <div class="userStats">

        <div>
            <p><?=$_SESSION['first_name']?> <?=$_SESSION['last_name']?></p>
            <p><?=$_SESSION['username']?></p>
        </div>
        <div class="status">

            <div style="border-left: none;">
                <p>Age</p>
                <p><?=$_SESSION['age']?></p>
            </div>

            <div>
                <p>Status</p>
                <p><?=$_SESSION['active'] == "1" ? "active" : "inactive"?></p>
            </div>

        </div>
        <div class="email">
            <p><?=$_SESSION['email']?></p>
        </div>
        <form action="profile/upload/image" id="uploadImage" method="post" enctype="multipart/form-data">
            <label class="custom-file-upload">
                <input type="file" onchange="loadFile(event)" name="File" id="fileToUpload">
                Upload or change your profile picture
            </label>
            <input type="submit" value="Confirm upload" name="submit">

            <img id="output" />

        </form>
        <script>
        const loadFile = function(event) {
            const output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
        </script>
        <button onclick="deactivate()">Deactivate my profile</button>
    </div>
</div>


<div class="postContainer">

    This is post
    <form class="<?= $post_status === 1 ? 'displayNone': '' ?>" onsubmit="like(); return false;">
        <button class="like_btn"><i class="fa fa-thumbs-up"></i></button>
    </form>
    <form class="<?= $post_status === 0 ? 'displayNone': '' ?>"" onsubmit=" dislike(); return false;">
        <button class="dislike_btn"><i class="fa fa-thumbs-down"></i></button>
    </form>
</div>






<!-- <script src="./library.js"></script> -->
<script>
async function deactivate() {
    let txt;
    let r = confirm("This will deactivate your account, are you sure?");
    if (r !== true) {
        return;
    }
    let conn = await fetch('/profile/deactivate', {
        method: "POST",
        cache: 'no-cache'
    });
    if (conn.ok) {
        window.location.replace("/logout");
    }

}

async function like() {
    event.preventDefault()
    let conn = await fetch('/post/1/1', {
        method: "POST"
    })
    // if( conn.status != 200 ){ alert("something went wrong") }
    if (!conn.ok) {
        alert("sorry, we are updating our servers")
        return
    }
    const parent = event.target.parentNode;
    parent.querySelector(".like_btn").classList.add("displayNone")
    parent.querySelector(".dislike_btn").classList.remove("displayNone")
}

async function dislike() {
    event.preventDefault()
    // let conn = await fetch('/post/1/0', {
    //     method: "POST"
    // })
    // if( conn.status != 200 ){ alert("something went wrong") }
    // if (!conn.ok) {
    //     alert("sorry, we are updating our servers")
    //     return
    // }
    const parent = event.target.parentElement
    parent.querySelector(".dislike_btn").classList.add("displayNone")
    parent.querySelector(".like_btn").classList.remove("displayNone")
}
</script>

<?php  require_once(__DIR__.'./footer.php'); ?>