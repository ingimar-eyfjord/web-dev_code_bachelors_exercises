window.addEventListener("DOMContentLoaded", start);

const carousel = function (e) {
  const container = document.querySelector(".carousel_container");
  let po = parseInt(container.dataset.position);
  if (this.dataset.direction === "left" && po !== 0) {
    po = po - 1;
    container.dataset.position = po;
    container.style.transform = `translateX(-${po * 20}%)`;
  } else if (this.dataset.direction === "right" && po !== 4) {
    po = po + 1;
    container.dataset.position = po;
    container.style.transform = `translateX(-${po * 20}%)`;
  } else if (this.dataset.direction === "left" && po === 0) {
    container.dataset.position = 4;
    container.style.transform = `translateX(-80%)`;
  } else if (this.dataset.direction === "right" && po === 4) {
    container.dataset.position = 0;
    container.style.transform = `translateX(0%)`;
  }
};

function dotsFunc() {
  console.log(this.dataset);
  const container = document.querySelector(".carousel_container");
  container.dataset.position = this.dataset.dot_position;
  container.style.transform = `translateX(-${this.dataset.dot_position * 20}%)`;
}

function start() {
  const chevron = document.querySelectorAll(`[class*="chev-"]`);
  chevron.forEach((e) => {
    e.addEventListener("click", (e = carousel));
  });
  const dots = document.querySelectorAll("[data-dot_position]");
  console.log(dots);
  dots.forEach((e) => {
    e.addEventListener("click", (e = dotsFunc));
  });
  getIcons();
}

function theme(element) {
  const theme = document.querySelector(".mainthemes");
  const theme2 = document.querySelector(".changeTheme");
  if (element.dataset.theme === "change") {
    element.dataset.theme = "dark";
    theme2.setAttribute("href", "style/vegetarian_theme.css");
  } else if (element.dataset.theme === "dark") {
    element.dataset.theme = "change";
    theme2.setAttribute("href", "");
  } else {
    theme.setAttribute("href", `style/${element.dataset.theme}.css`);
  }
}

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
