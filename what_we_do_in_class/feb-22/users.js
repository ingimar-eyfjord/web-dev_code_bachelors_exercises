//? Json object

const user = { "id": 1, "name": "a" };
const user_on = {
  id: "one",
  name: "Spartan",
  create: function () {
    const item = `<div class="item" id="${this.id}">
              <p>id:
              <span>${this.id}</span>
               Name:
              <span>${this.name}</span>
              </p>
          <button
          onclick="user_on.delete(${this.id})"
          data-action="delete"
          data-delete_id="${this.name}"
          class="delete">Delete</button>
          </div>`;
    document.querySelector("#items").insertAdjacentHTML("beforeend", item);
  },
  delete: function () {
    const deleteThis = document.querySelector(`#${this.id}`);
    deleteThis.remove();
  },
};
