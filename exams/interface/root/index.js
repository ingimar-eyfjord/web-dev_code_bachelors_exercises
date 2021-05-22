function getIcons() {
  const i = document.querySelectorAll(`[class*="ic-"]`);
  console.log(i);
  i.forEach((e) => {
    let icon = e.classList.value.split("-")[1];
    fetch(`icons/${icon}.svg`)
      .then((r) => r.text())
      .then((text) => {
        e.innerHTML = text;
      })
      .catch(console.error.bind(console));
  });
}
window.onscroll = function () {
  myFunction();
};

// Get the navbar
function myFunction() {
  const stick = document.querySelectorAll(".stick");

  const navbar = document.querySelector("nav");
  const aside = document.querySelector(".aside");

  stick.forEach((e) => {
    // Get the offset position of the navbar
    const sticky = e.offsetTop - 75;
    const vw = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0);
    // Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
    if (window.pageYOffset >= sticky && vw > 600) {
      e.classList.add("FilterBar");
      navbar.classList.add("noShadow");
      aside.classList.add("noShadow");
    } else {
      e.classList.remove("FilterBar");
      navbar.classList.remove("noShadow");
      aside.classList.remove("noShadow");
    }
  });
}

document.addEventListener("DOMContentLoaded", click);

function click() {
  const articles = document.querySelectorAll("article");

  articles.forEach((e) => {
    e.addEventListener("click", loadPage);
  });
}
function loadPage() {
  window.open("http://127.0.0.1:56922/root/article.html");
}
