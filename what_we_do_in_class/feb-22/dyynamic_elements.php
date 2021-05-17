<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>


    <button onclick="onclickEvent(this)" data-action="getMore">Get more Items</button>
    <div id="items">
        <form onsubmit="return false"></form>
        <div class="item" id="one">
            <p>id: <span>1</span> Name: <span>name</span></p>
            <button onclick="onclickEvent(this)" data-action="delete" data-delete_id="one"
                class="delete">Delete</button>
        </div>

    </div>


    <script>
    function onclickEvent(element) {
        if (element.dataset.action === "delete") {
            const deleteThis = document.querySelector(`#${element.dataset.delete_id}`)
            deleteThis.remove()
        } else {
            const items = [{
                    "id": "2",
                    "name": "two"
                },
                {
                    "id": "3",
                    "name": "three"
                },
                {
                    "id": "4",
                    "name": "four"
                },
            ]
            let arr = []
            items.forEach(e => {
                const newItem =
                    `<div class="item" id="${e.name}">
                    <p>id: 
                    <span>${e.id}</span>
                     Name: 
                    <span>${e.name}</span>
                    </p>
                <button 
                onclick="onclickEvent(this)" 
                data-action="delete" 
                data-delete_id="${e.name}"  
                class="delete">Delete</button>
                </div>`
                document.querySelector("#items").insertAdjacentHTML('beforeend', newItem)
            })
        }
    }
    </script>
</body>

</html>