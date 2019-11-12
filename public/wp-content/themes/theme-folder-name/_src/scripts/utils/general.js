export function hasClass(el, className) {
  return el.classList
    ? el.classList.contains(className)
    : new RegExp("\\b" + className + "\\b").test(el.className);
}

export function addClass(el, className) {
  if (el.classList) el.classList.add(className);
  else if (!hasClass(el, className)) el.className += " " + className;
}

export function removeClass(el, className) {
  if (el.classList) el.classList.remove(className);
  else
    el.className = el.className.replace(
      new RegExp("\\b" + className + "\\b", "g"),
      ""
    );
}

export function isEditing() {
  const data = window.theme_prefix_data;

  if (data) {
    return data.editing === "1";
  }

  return false;
}

export function debounce(func, wait = 250, immediate) {
  let timeout;
  return function() {
    const context = this,
      args = arguments;
    const later = function() {
      timeout = null;
      if (!immediate) func.apply(context, args);
    };
    const callNow = immediate && !timeout;
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
    if (callNow) func.apply(context, args);
  };
}

export function disableScroll() {
  document.body.style.overflow = "hidden";
}

export function enableScroll() {
  document.body.style.overflow = "";
}

export function isTouch() {
  return "ontouchstart" in document.documentElement;
}
