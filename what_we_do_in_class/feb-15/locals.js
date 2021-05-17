document.addEventListener("DOMContentLoaded", HandleLocalStorageItems());
function createItem(e) {
  const elements = formToJSON(e.parentNode.children);
  if (elements.item === undefined) {
    alert("must contain name");
    return;
  }
  switch (localStorage.items) {
    case undefined:
      HandleLocalStorageItems(elements, false);
      break;
    default:
      HandleLocalStorageItems(elements, true);
  }
}
function HandleLocalStorageItems(elements, exists) {
  switch (exists) {
    case true:
      let local = JSON.parse(localStorage.items);
      const checkIfExists = local.some((e) => e.item === elements.item);
      if (checkIfExists) {
        alert("Item with that name already exists");
        return;
      }
      const currentID = local[local.length - 1].id;
      elements.id = parseInt(currentID) + 1;
      local.push(elements);
      localStorage.items = JSON.stringify(local);
      renderItems(local);
      break;
    case false:
      elements.id = 1;
      localStorage.items = JSON.stringify([elements]);
      renderItems([elements]);
      break;
    default:
      localStorage.items
        ? renderItems(JSON.parse(localStorage.items))
        : (document.querySelector("#itemsContainer").innerHTML = "");
  }
}

function renderItems(elements) {
  document.querySelector("#itemsContainer").innerHTML = "";
  for (e of elements) {
    const createContent = `<form class="item">
          <p>Elements name: <span>${e.item}</span></p>
          <p>Element id: <span>${e.id}</span></p>
          <input type="hidden" name="id" value="${e.id}"></input>
          <button onclick="deleteElement(this)" type="button">Delete this item</button>
         </form>`;
    document
      .querySelector("#itemsContainer")
      .insertAdjacentHTML("beforeend", createContent);
  }
}
//   insertAdjacentHTML
function deleteElement(button) {
  const id = formToJSON(button.parentNode.children);
  let local = JSON.parse(localStorage.items);
  console.log(parseInt(Object.values(id)));
  const filtered = local.filter((e) => {
    return parseInt(e.id) !== parseInt(Object.values(id));
  });
  filtered.length === 0
    ? localStorage.removeItem("items")
    : (localStorage.items = JSON.stringify(filtered));
  HandleLocalStorageItems();
}

const isValidElement = (element) => {
  if (element.type === "radio") {
    if (!element.checked === false) {
      return element.name && element.value;
    }
  } else {
    if (element.name !== "") {
      return element.name && element.value;
    } else {
      return;
    }
  }
};
const Convert = (elements) =>
  [].reduce.call(
    elements,
    (data, element) => {
      // Make sure the element has the required properties.
      if (isValidElement(element)) {
        data[element.name] = element.value;
      }
      return data;
    },
    {}
  );
function formToJSON(elements) {
  const data = Convert(elements);
  return data;
}
