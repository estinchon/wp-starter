import Component from "./component";

let componentMap = {};
let activeComponents = {
  destroyable: [],
  permanent: []
};

export function registerComponent(
  componentType = "",
  component = null,
  options = {}
) {
  componentMap[componentType] = { component, options };
}

export function initComponents($container = document.body) {
  for (let key in componentMap) {
    const c = componentMap[key];
    const elements = $container.querySelectorAll(c.options.selector);
    [...elements].forEach(el => {
      const instance = new c.component(el);
      if (c.options.autoDestroy) {
        activeComponents.destroyable.push(instance);
      } else {
        activeComponents.permanent.push(instance);
      }
    });
  }
}

export function clearComponents() {
  activeComponents.destroyable.forEach(component => {
    if (typeof component.destroy === "function") {
      component.destroy();
    }
  });
}

export { Component };
