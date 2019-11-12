export default class Component {
  constructor(element, props = {}) {
    this.element = element;
    this.props = props;
    this.listeners = [];

    this.init();
  }

  init() {
    // overwrite in component
  }

  addListener(element, event, handler, options = {}) {
    this.listeners.push({
      element,
      event,
      handler
    });

    element.addEventListener(event, handler, options);
  }

  removeAllListeners() {
    this.listeners.forEach(listener => {
      listener.element.removeEventListener(listener.event, listener.handler);
    });
  }
}
