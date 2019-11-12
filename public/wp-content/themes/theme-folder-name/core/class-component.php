<?php
/**
 * Component Base Class
 *
 * @package theme-text-domain
 */

class ThemePrefixComponent {
  public $props;
  public $children;

  public function __construct( $props = array(), $children = array() ) {
    $this->props = array_merge($this->get_default_props(), $props);
    $this->children = $children;
  }

  public function get_default_props() {
    return array();
  }

  public function get_prop($key) {
    return $this->props[$key];
  }

  public function render() {
    /* overwrite in component */
    return "";
  }

  public function use_template( $template ) {
    $theme_prefix_component_props = $this->props;
    ob_start();
    include( $template );
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
  }

  public function render_children() {
    $output = "";
    if( !empty( $this->children ) ) {
      foreach( $this->children as $child ) {
        if( is_object( $child ) ) {
          $output .= $child->render();
        }
        else {
          $output .= $child;
        }
      }
    }
    return $output;
  }
}
