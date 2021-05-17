const $ = {
  one: function (element) {
    return document.querySelector(element);
  },
  all: function (element) {
    return document.querySelector(element);
  },
  click: function (element, callback) {
    document.querySelector(element).addEventListener("click", callback);
  },
  submit: function (element, callback) {
    document.querySelector(element).addEventListener("submit", callback);
  },
  disable: function (element) {
    document.querySelector(element).disable = true;
  },
  enable: function (element) {
    document.querySelector(element).disable = false;
  },
  val: function (element) {
    switch (element.type) {
      case "email": {
        const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (re.test(element.value.toLowerCase())) {
          element.dataset.valid = true;
        } else {
          element.dataset.valid = false;
        }
      }
      case "text":
        const min = element.getAttribute("minlength");
        const max = element.getAttribute("maxlength");
        const length = element.value.length;
        if (length < min || length > max) {
          element.dataset.valid = false;
        } else {
          element.dataset.valid = true;
        }
        break;
      case "password":
        const reP = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/;
        if (!reP.test(element.value.toLowerCase())) {
          element.dataset.valid = false;
          document.querySelector(".passwordHelper").classList.remove("display_none");
        } else {
          element.dataset.valid = true;
        }
        if (element.previousSibling.type === "password") {
          element.previousSibling.value === element.value
            ? (element.dataset.valid = true)
            : (element.dataset.valid = false);
        }
        break;
      default:
        console.log("ok");
    }
  },
};

const red = "red";
const yellow = "yellow";
const green = "green";
let trafficLight = [];

let timer;
// initiate();
function initiate() {
  timer = setInterval(lights, 5000);
}
function lights() {
  console.clear();
  if (trafficLight.length === 0 || trafficLight.includes("green")) {
    trafficLight = [];
    trafficLight.push(red);
    timer = setInterval(lights, 5000);
  } else if (trafficLight.includes("red") && !trafficLight.includes("yellow")) {
    clearInterval(timer);
    timer = setTimeout(lights, 2000);
    trafficLight.push(yellow);
  } else if (trafficLight.includes("yellow")) {
    trafficLight = [];
    clearInterval(timer);
    timer = setTimeout(lights, 5000);
    trafficLight.push(green);
  }
  console.log(trafficLight);
}

function submit(form) {
  console.log(form.elements);

  // send it to a database
}

function formToJSON(elements) {
  const data = Convert(elements);
  return data;
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

/// Dynamically get form elements name=value and turn it into JSON
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
