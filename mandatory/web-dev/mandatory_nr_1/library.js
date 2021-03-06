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
    switch (element.name) {
      // this email regex does not work
      case "email":
        const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (re.test(element.value.toLowerCase())) {
          element.dataset.valid = true;
        } else {
          element.dataset.valid = false;
        }
        break;
      case "Password":
      case "cPassword":
        //? Check stenght of password
        const strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])(?=.{8,})");
        const mediumRegex = new RegExp(
          "^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})"
        );
        if (strongRegex.test(element.value)) {
          element.dataset.valid = true;
          $.one("#strength").textContent = "Strong";
          $.one("html").style = "--colour:#008000;--stWidth:100%";
        } else if (mediumRegex.test(element.value)) {
          element.dataset.valid = true;
          $.one("#strength").textContent = "Medium";
          $.one("html").style = "--colour:#FFA500;--stWidth:66%";
        } else {
          element.dataset.valid = false;
          $.one("#strength").textContent = "Weak";
          $.one("html").style = "--colour:#DC143C;--stWidth:33%";
        }

        // Password check
        break;
      default:
        console.log("ok");
    }
  },
};

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
// Get all the ID's of the elements first order children
function GetFirstChildrenID(elements) {
  let id_array = [];
  [].reduce.call(
    elements,
    (data, element) => {
      id_array.push(element.id);
    },
    {}
  );
  return id_array;
}
