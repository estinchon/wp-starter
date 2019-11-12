/**
 * Basic component
 *
 * Methods available in component:
 * - init (basics)
 * - onResize(basics)
 * - onDebouncedResize (basics)
 * - onScroll (basics)
 * - onTransition(data [hook, data]) - Barba.JS events
 * - beforeDestroy
 */

export default class Component {
  constructor(element, props = {}, basics = {}) {
    this.element = element;
    this.props = props;
    this.listeners = [];

    this.init(basics);
  }

  init(basics = {}) {
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
    if (!this.listeners.length) return;

    this.listeners.forEach(listener => {
      listener.element.removeEventListener(listener.event, listener.handler);
    });
  }

  destroy() {
    typeof this.beforeDestroy === "function" && this.beforeDestroy();
    this.removeAllListeners();
  }
}
