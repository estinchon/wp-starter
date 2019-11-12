import { Component, registerComponent } from "@scripts/components";

class ExampleComponent extends Component {
  init(basics) {
    console.log("=== ExampleComponent: init ===");
    console.log(basics);
  }

  onResize(basics) {
    console.log("=== ExampleComponent: onResize ===");
    console.log(basics);
  }

  onDebouncedResize(basics) {
    console.log("=== ExampleComponent: onDebouncedResize ===");
    console.log(basics);
  }

  onScroll(basics) {
    console.log("=== ExampleComponent: onScroll ===");
    console.log(basics);
  }

  onTransition({ hook, data }) {
    if (hook === "leave") {
      console.log(`=== ExampleComponent: onTransition (${hook}) ===`);
      console.log(data);
    }
  }

  beforeDestroy() {
    console.log("=== ExampleComponent: beforeDestroy ===");
  }
}

registerComponent("example-component", ExampleComponent, {
  selector: ".example-component",
  autoDestroy: true
});
