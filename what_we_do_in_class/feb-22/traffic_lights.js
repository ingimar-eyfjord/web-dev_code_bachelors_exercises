let trafficLight = [];
let timer;
initiate();
function initiate(amount) {
  timer = setInterval(lights, amount);
}
function lights() {
  if (trafficLight.length === 0) {
    trafficLight.push("🔴");
  } else if (trafficLight.includes("🔴") && !trafficLight.includes("🟡")) {
    clearInterval(timer);
    initiate(2000);
    trafficLight.push("🟡");
  } else if (trafficLight.includes("🔴") && trafficLight.includes("🟡")) {
    trafficLight = [];
    clearInterval(timer);
    initiate(5000);
    trafficLight.push("🟢");
  } else if (trafficLight.includes("🟢")) {
    trafficLight = [];
    clearInterval(timer);
    initiate(2000);
    trafficLight.push("🟡");
  } else if (trafficLight.includes("🟡") && !trafficLight.includes("🔴")) {
    trafficLight = [];
    clearInterval(timer);
    initiate(5000);
    trafficLight.push("🔴");
  }
  console.log(trafficLight);
}
