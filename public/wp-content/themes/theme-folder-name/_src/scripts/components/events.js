/**
 * Events
 *
 * Listen to events and call components
 * (onResize, onDebouncedResize, onScroll)
 */

import { general as utilsGeneral } from "../utils";
import { callComponents } from "./base";

let scrollInterval = null;
let previousScrollY = 0;

function onResize() {
  callComponents("onResize", utilsGeneral.getBasics());
}

function onDebouncedResize() {
  callComponents("onDebouncedResize", utilsGeneral.getBasics());
}

function onScroll() {
  callComponents("onScroll", utilsGeneral.getBasics());
}

function onInterval() {
  const scrollY = utilsGeneral.getScrollPosition().y;

  if (scrollY !== previousScrollY) {
    onScroll();
    previousScrollY = scrollY;
  }
}

export function setupComponentEvents() {
  window.addEventListener("resize", onResize);

  window.addEventListener(
    "resize",
    utilsGeneral.debounce(onDebouncedResize, 250)
  );

  scrollInterval = setInterval(onInterval, 20);
}
