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
