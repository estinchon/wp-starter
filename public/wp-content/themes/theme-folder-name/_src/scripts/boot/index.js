import { general as utilsGeneral } from "../utils";
import { initComponents, setupComponentEvents } from "../components";

function checkDeviceType() {
  const className = utilsGeneral.isTouch() ? "touch-device" : "hover-device";
  utilsGeneral.addClass(document.documentElement, className);
}

function setVh() {
  let wh = window.innerHeight;
  let vh = wh * 0.01;
  document.documentElement.style.setProperty("--vh", `${vh}px`);
  document.documentElement.style.setProperty("--vh100", `${wh}px`);
}

// update lazy sizes
function recalculateImageSizes() {
  if (window.lazySizes) {
    window.lazySizes.autoSizer.checkElems();
  }
}

const boot = () => {
  checkDeviceType();
  setTimeout(recalculateImageSizes, 100);
  setVh();

  // init component system
  initComponents();
  setupComponentEvents();

  if (utilsGeneral.isTouch()) {
    window.addEventListener("orientationchange", e => {
      setTimeout(setVh, 500);
    });
  } else {
    window.addEventListener("resize", setVh);
  }
};

// on ready
document.addEventListener("DOMContentLoaded", boot);
