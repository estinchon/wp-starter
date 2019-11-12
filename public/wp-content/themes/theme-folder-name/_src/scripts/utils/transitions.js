export function syncBodyClass($container) {
  const bodyClasses = $container.getAttribute("data-body-class");

  if (bodyClasses) {
    document.body.className = bodyClasses;
  }
}
