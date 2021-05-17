<?php  require_once(__DIR__.'./header.php'); 

// echo '<div>Hi '.$_SESSION['username'].' your email is '.$_SESSION['email'].' </div>'
?>

<style>
*:not(a) {
    font-size: 2rem;
}

.like_btn,
.dislike_btn {
    background-color: transparent;
    border: none;
    border-color: none;
    float: right;
}

.postContainer {
    display: flex;
    flex-direction: row;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="container">

</div>

<?php 
$post_status = 0;
?>

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
async function like() {
    event.preventDefault()
    // let conn = await fetch('/post/1/1', {
    //     method: "POST"
    // })
    // // if( conn.status != 200 ){ alert("something went wrong") }
    // if (!conn.ok) {
    //     alert("sorry, we are updating our servers")
    //     return
    // }
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