<?php

class ThemePrefixExampleComponent extends ThemePrefixComponent {
  public function render() {
    return $this->use_template( dirname( __FILE__ ) . '/template.php' );
  }

  public function get_default_props() {
    return array(
      "text" => "Placeholder Text"
    );
  }
}

ThemePrefixSite::register_component('example-component', 'ThemePrefixExampleComponent');
