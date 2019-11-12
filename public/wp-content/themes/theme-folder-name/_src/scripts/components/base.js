import { general as utilsGeneral } from "../utils";

let componentMap = {};
let activeComponents = {
  destroyable: {
    current: [],
    next: []
  },
  permanent: []
};

export function registerComponent(
  componentType = "",
  component = null,
  options = {}
) {
  componentMap[componentType] = { component, options };
}

export function getAllComponents() {
  return [
    ...activeComponents.destroyable.current,
    ...activeComponents.destroyable.next,
    ...activeComponents.permanent
  ];
}

export function callComponents(method, data = {}) {
  const components = getAllComponents();

  if (!components.length) return;

  components.forEach(component => {
    if (typeof component[method] === "function") {
      component[method](data);
    }
  });
}

export function initComponents($container = document.body, isNext = false) {
  // loop through components and see if they exist in the container
  for (let key in componentMap) {
    const c = componentMap[key];
    const elements = $container.querySelectorAll(c.options.selector);
    [...elements].forEach(el => {
      const instance = new c.component(el, {}, utilsGeneral.getBasics());
      if (c.options.autoDestroy) {
        const typeKey = isNext ? "next" : "current";
        activeComponents.destroyable[typeKey].push(instance);
      } else {
        activeComponents.permanent.push(instance);
      }
    });
  }
}

export function clearComponents() {
  activeComponents.destroyable.current.forEach(component => {
    if (typeof component.destroy === "function") {
      component.destroy();
    }
  });

  // set next as current & empty next
  activeComponents.destroyable.current = activeComponents.destroyable.next;
  activeComponents.destroyable.next = [];
}
