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
      // this email regex does not work
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
      // this Password regex does not work
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
