import { Component, registerComponent } from "@scripts/components";

class ExampleComponent extends Component {
  init() {
    console.log("=== ExampleComponent: init ===");
  }
}

registerComponent("example-component", ExampleComponent, {
  selector: ".example-component",
  autoDestroy: true
});
