<?php
$Current_page = "Messages";
require_once('./header.php');
if (!isset($_SESSION['username'])) {
    header("Location: log_in.php");
    exit();
}

?>

<div class="MessageBody">
    <div class="message_Container"></div>
    <form onsubmit="postMessage(this); return false" class="postMessage">
        <input type="hidden" name="user_id" value="<?= $_SESSION['user_id']; ?>">
        <input type="hidden" name="username" value="<?= $_SESSION['username']; ?>">
        <input type="hidden" name="Table" value="chat">
        <label for="message"></label>
        <textarea id="message" name="message" rows="3" cols="50"></textarea>
        <button>Send Message</button>
    </form>
</div>

<script src="library.js"></script>
<script>
async function postMessage(element) {
    console.log("called2")
    const POSTData = formToJSON(element)
    console.log(POSTData)
    let data = await fetch('services/dynamic_POST.php', {
        method: 'POST',
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            "payload": POSTData
        })
    })
    data = await data.text()
    alert(data)
    element.reset();
}
setInterval(() => {
    GetMessages()
}, 3000);

GetMessages()
async function GetMessages() {
    const GetWhat = {
        Table: 'chat'
    }
    let data = await fetch('services/dynamic_GET.php', {
        method: 'POST',
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            "payload": GetWhat
        })
    })
    data = await data.json()

    const elements = $.one('.message_Container').children
    const ids = await GetFirstChildrenID(elements)
    if (ids.length !== 0) {

        data.forEach((e, index) => {
            if (ids.includes(e.id)) {
                delete data[index]
            }
        })
    }
    if (data !== undefined) {
        data.forEach(e => {
            const message = `
                <div class="message" id="${e.id}">
                <div class="from"><h3>${e.username}</h3><p>Posted at ${moment(e.created_at).format("D/M/YYYY hh:mm a")}</p></div>
                <p class="InnerMessage">${e.message}</p>
                </div>`
            $.one('.message_Container').insertAdjacentHTML("afterbegin", message);
        })
    }

}
</script>
<?php
    require_once('./footer.php');
    ?>