document.onkeydown = changeCSS;
function changeCSS(event) {
  let url = document.querySelectorAll("#stylesheet");
  if (event.keyCode == 37) {
    url[0].setAttribute("href", "will_media.css");
  } else if (event.keyCode == 39) {
    url[0].setAttribute("href", "will_grid.css");
  } else if (event.keyCode == 40) {
    url[0].setAttribute("href", "will_flexbox.css");
  }
}
alert('use "left" "down", "right" arrows to change the steps between media queries, flexbox and grid');
