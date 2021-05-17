<?php  require_once(__DIR__.'./header.php'); 
if(!isset($_SESSION['username'])){
header("Location: /login");
}
?>

<main class="content " style="max-height:100vh">
    <div id="openMessages">
        <h2>Messages - online: <span id="onlineNow">0</span></h2>
    </div>
    <div class="container p-0  messageContainer displayNone" style="max-height:100%; height:100%">
        <div class="messaging">
            <div id="userList" class="col-12 col-lg-5 col-xl-3 border-right">
                <div class="closeMessage- "><span onclick="closeMessageList()">&#10006;</span> </div>
                <div class="px-4 d-none d-md-block">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <input type="text" id="filterUser" class="form-control my-3" placeholder="Search...">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>

<script>
let currentUser = undefined
// let host = 'wss://exam-websocket.herokuapp.com/';

let host = 'ws://localhost:3000'
let socket = new WebSocket(host);

socket.onopen = async function() {
    await getUsers()

    const token = document.querySelector("#Token").value
    let login = {
        Token: token,
        intent: "login",
        username: `<?= $_SESSION['username']?>`
    }
    socket.send(JSON.stringify(login));

    socket.onmessage = function(e) {
        const data = JSON.parse(e.data)
        if (data.intent === "old-messages") {
            displayMessages(data, "old-messages")
        }
        if (data.intent === "typing") {
            displayUserIsTyping(data)
        }
        if (data.intent === "new-message") {
            const element = document.querySelector("#UserTyping");
            if (element !== null) {
                element.remove()
            }
            displayMessages(data, "new-message")
        }
        if (data.intent === "stopped-typing") {
            const element = document.querySelector(`.typing-${data.username}`);
            if (element !== null) {
                element.remove()
            }
        }
        if (data.intent === "logged-in") {
            loggedIn(data)
        }
        if (data.intent === "Disconnected") {
            loggedIn(data)
        }
    };


    // if (socket.readyState === WebSocket.CLOSED) {
    //    // Do your stuff...
    // }





    // let element = document.querySelector(".chat-messages");
    // element.scrollTop = element.scrollHeight;


}



function loggedIn(data) {
    const loggedInUsers = Object.values(data.users)
    const elseS = document.querySelectorAll('[class*="status-"]')
    elseS.forEach(e => {
        e.textContent = "Offline"
    })

    let onlineNow = loggedInUsers.length - 1
    $("#onlineNow").text(onlineNow)
    loggedInUsers.forEach(e => {
        if (e.Username !== `<?= $_SESSION['username']?>`) {
            const status = document.querySelector(`.status-${e.Username}`)
            status.textContent = "Online"
        }
    })

}

function sendMessage(button) {
    const element = button.parentElement.querySelector("textarea")
    const message = element.value
    socket.send(JSON.stringify({
        username: `<?= $_SESSION['username']?>`,
        message: message,
        intent: 'chat',
        toWhom: button.dataset.towho
    }))
    element.value = ""
}

function displayMessages(data, oldOrNew) {
    const messageContainer = document.querySelector(`.messageList-${data.identifier}`)
    data.data.forEach(e => {
        if (e.username === `<?= $_SESSION['username']?>`) {
            const message = `
            <div class="chat-message-right pb-4">
            <div>
            <img src="<?=glob("content/images/profiles/" . $_SESSION['username'] . ".*")[0]?>" class="rounded-circle mr-1" alt="${e.username}"
            width="80" height="80">
            <div class="text-muted small text-nowrap mt-2">${moment(e.date).fromNow()}</div>
            </div>
            <div class="flex-shrink-1 bg-primary rounded text-white py-2 px-3 mr-3 messageSent-right">
            <div class="font-weight-bold text-white mb-1">Me</div>
            ${e.message}
            </div>
            </div>`
            messageContainer.insertAdjacentHTML("beforeend", message)
        } else {
            if (messageContainer === null) {
                const haveMessage = document.querySelector(`.have_message-${e.username}`)
                haveMessage.classList.remove("displayNone")
                const numb = haveMessage.textContent
                haveMessage.textContent = parseInt(numb) + 1
            } else {

                const message = `
            <div class="chat-message-left pb-4">
            <div>
            <img class="rounded-circle mr-1 img-${e.username}" alt="${e.username}"
            width="80" height="80">
            <div class="text-muted small text-nowrap mt-2">${moment(e.date).fromNow()}</div>
            </div>
            <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3 messageSent-left">
            <div class="font-weight-bold mb-1">${e.username}</div>
            ${e.message}
            </div>
            </div>`

                const messageContainer = document.querySelector(`.messageList-${data.identifier}`)
                messageContainer.insertAdjacentHTML("beforeend", message)
            }
            tryImages(e.username)
        }
    })

    if (oldOrNew === "new-message") {
        const instance = OverlayScrollbars($(`.messageList-${data.identifier}`))
        instance.destroy();
    }
    const instance = $(`.messageList-${data.identifier}`).overlayScrollbars({}).overlayScrollbars();
    instance.scroll({
        y: "100%"
    });

}


let timer;
let TimeoutTimer;

function typing(element) {
    if (timer) {
        clearTimeout(timer)
    }
    timer = setTimeout(function() {
        if (element.value.length >= 2) {
            socket.send(JSON.stringify({
                username: `<?= $_SESSION['username']?>`,
                intent: 'typing',
                toWhom: currentUser
            }))
        } else {
            socket.send(JSON.stringify({
                username: `<?= $_SESSION['username']?>`,
                intent: 'stopped-typing',
                toWhom: currentUser
            }))
        }
    }, 2000)


    if (TimeoutTimer) {
        clearTimeout(TimeoutTimer)
    }
    TimeoutTimer = setTimeout(function() {
        socket.send(JSON.stringify({
            username: `<?= $_SESSION['username']?>`,
            intent: 'stopped-typing',
            toWhom: currentUser
        }))
    }, 30000)
}

function displayUserIsTyping(data) {

    const arr = ["<?= $_SESSION['username']?>", data.username]
    arr.sort();
    const ident = arr.join("-");
    ///Need here

    if (data.toWhom === `<?= $_SESSION['username']?>`) {
        const typing = document.querySelector(`.${data.username}-Typing`)
        const element = document.querySelector(`.typing-${data.username}`);
        if (element !== null) {
            return;
        }
        const message = `
                        <div class="text-muted small typing-${data.username}">
                        <em>Typing</em>
                        <div id="wave">
                        <span class="dot"></span>
                        <span class="dot"></span>
                        <span class="dot"></span>
                        </div>
    </div>
    `
        typing.insertAdjacentHTML("afterbegin", message)
        tryImages(data.username)
    }
}

function tryImages(username) {
    const images = document.querySelectorAll(`.img-${username}`)
    images.forEach(img => {
        img.src = `services/find_image/${username}`;
    })
}


async function getUsers() {
    await $.ajax({
        // dataType: "json",
        url: "/users/getAll",
        success: function(response) {
            let data = JSON.parse(response)
            const users = document.querySelector("#userList")


            data.forEach(e => {
                if (e.username === `<?= $_SESSION['username']?>`) {
                    return;
                }
                const message = `
                <a onclick="activateUserChat('${e.username}')" data-name="${e.username}" class="messageUser list-group-item list-group-item-action border-0">
                <div id="userSettings" data-userPreference='${e.username}' data-user_id='${e.user_id}' onclick="changeUserPreference(this)">
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                </div>
                <ul class="displayNone user_setting_list-${e.username}" class="list-group">
                <li class="list-group-item">Call</li>
                <!-- <a href="tel:+496170961709">Call</a>-->
                <li onclick="TakeMeToProfile('${e.username}')" class="list-group-item">More info</li>
                <li onclick="blockUser('${e.username}')" class="list-group-item list-group-item-danger">Block</li>
                </ul>
                               <div class="badge displayNone have_message-${e.username} bg-success float-right">0</div>
                                 <div class="d-flex align-items-start">
                                     <img class="rounded-circle mr-1 img-${e.username}" alt="${e.username}"
                                     width="80" height="80">
                                     <div class="username flex-grow-1 ml-3">
                                     ${e.username}
                                         <div class="small"><span class="fas fa-circle chat-online"></span><span class="status-${e.username}"> Offline</span></div>

                                         <div class="${e.username}-Typing"></div>
                                        
                                     </div>
                                 </div>
                                 <hr class="d-block mt-1 mb-0">
                            </a>
                `
                users.insertAdjacentHTML("beforeend", message)
                tryImages(e.username)
            })
        },
        error: function(result) {
            console.log(result)
        }
    });


    $(function() {
        //The passed argument has to be at least a empty object or a object with your desired options

        //set the scroll-offset to 50 on both axis.

        var instance = $("#userList").overlayScrollbars({}).overlayScrollbars();


    });

}

function activateUserChat(user) {

    const arr = ["<?= $_SESSION['username']?>", user]
    arr.sort();
    const ident = arr.join("-");


    currentUser = user
    const messageContainer = document.querySelector(".messaging")

    const container = document.querySelector(`.container-${ident}`)
    if (container === null) {
        messageContainer.insertAdjacentHTML("beforeend", `   <div class="card twoGrids container-${ident}" style="height:40%">
        <div class="closeMessage-${ident}"><span onclick="closeMessage('${ident}')" >&#10006;</span> </div>
        <div class="twoGird-Item" style="position:relative">
        <div class="py-2 px-4 border-bottom d-none d-lg-block" style="height:100%">
        <div class="position-relative" style="height:100%">
            <div class="chat-messages messageList-${ident} p-4" style="height:100%">
            </div>
        </div>
        </div>
        <div style="bottom:0; height:95px">
        <div class="flex-grow-0 py-3 px-4 border-top">
        <div class="input-group">
            <textarea type="text" class="form-control" onkeyup="typing(this)"
                onkeydown="typing(this)" placeholder="Type your message"></textarea>
            <button data-towho="${user}" onclick="sendMessage(this)" class="btn btn-primary">Send</button>
        </div>
         </div>
        </div>
        </div>`)

        socket.send(JSON.stringify({
            intent: 'old-messages',
            count: 20,
            toWhom: user,
            username: `<?= $_SESSION['username']?>`
        }))
    }


}

function changeUserPreference(element) {
    const list = element.nextElementSibling
    list.classList.remove("displayNone")
}

document.addEventListener("click", function(e) {
    if (e.target.id !== "userSettings" && !e.target.classList.contains("dot")) {
        $("[class*='user_setting_list']").addClass("displayNone")
    }
})

function TakeMeToProfile(element) {

}

function blockUser(element) {


}

$("#openMessages").click(function(element) {
    $(this).addClass("displayNone")
    $(".messageContainer").removeClass("displayNone")
})
$(function() {
    $('#filterUser').on('input', function() {
        const items = $(".messageUser");
        const val = this.value;
        items.hide().filter(function() {
            return new RegExp('^' + val, 'gi').test($(this).data('name'));
        }).show();
    });
});

function closeMessage(which) {
    $(`.container-${which}`).remove()
}

function closeMessageList() {
    $(".messageContainer").addClass("displayNone")
    $("#openMessages").removeClass("displayNone")

}
</script>

<?php  require_once(__DIR__.'./footer.php'); 