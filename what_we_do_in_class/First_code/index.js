//? Show hide code ⬇️
const ShowHideElement = function (e) {
  const grandParent = this.parentNode.parentNode;
  const attribute = this.dataset.show_hide;
  const elementToHide = grandParent.querySelector(
    `[data-element=${attribute}]`
  );
  const OtherButtons = grandParent.querySelectorAll(
    `[data-show_hide]:not([data-show_hide=${attribute}])`
  );
  elementToHide.classList.toggle("hide");
  OtherButtons.forEach((e) => {
    e.classList.toggle("PointerNo");
  });
};

function ShowHideListener() {
  // const buttons = document.querySelectorAll("button")
  // buttons.forEach(e=>{
  //   e.addEventListener("click", (e = ShowHideElement))
  // })
  return;
}

function activate(string, button) {
  //? hide function that you already made
  const parent = button.parentNode;
  const OtherButtons = parent.querySelectorAll(
    `[data-button]:not([data-button='${button.dataset.button}'])`
  );
  OtherButtons.forEach((e) => {
    e.classList.toggle("PointerNo");
  });
}

//? ℹCode to generate dynamic users ⬇️

window.addEventListener("DOMContentLoaded", async (e) => {
  const response = await fetch("./JSON/people.json");
  makeUserProfiles(await response.json());
});
function makeUserProfiles(JSONData) {
  const template = document.querySelector("template");
  const MainContainer = document.querySelector(".MainContainer");
  JSONData.forEach((e) => {
    const clone = template.content.cloneNode(true);
    clone.querySelector('[data-element="first"]').textContent = e.FirstName;
    clone.querySelector('[data-element="last"]').textContent = e.LastName;
    clone.querySelector('[data-element="email"]').textContent = e.EmailAddress;
    clone
      .querySelector(".userImg")
      .setAttribute("src", `./img/${e.ProfileImg}`);
    MainContainer.appendChild(clone);
  });
  ShowHideListener();
}
