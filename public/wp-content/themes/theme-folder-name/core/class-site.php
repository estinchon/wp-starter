<?php
/**
 * Site Class
 *
 * For rendering components etc.
 *
 * @package theme-text-domain
 */

class ThemePrefixSite {
  private static $registered_components = array();

  public function __construct() {
  }

  public static function register_component( $type, $component ) {
    self::$registered_components[ $type ] = $component;
  }

  public static function component_exists($type) {
    return array_key_exists($type, self::$registered_components);
  }

  public static function render_component_r($type, $props = array(), $children = array()) {
    if( self::component_exists($type) ) {
      $component = new self::$registered_components[ $type ]($props, $children);
      return $component->render();
    }
    else {
      return "";
    }
  }

  public static function render_component($type, $props = array(), $children = array()) {
    if( self::component_exists($type) ) {
      echo self::render_component_r($type, $props, $children);
    }
  }

  public static function create_component($type, $props = array(), $children = array()) {
    if( self::component_exists($type) ) {
      return new self::$registered_components[ $type ]($props, $children);
    }
    else {
      return false;
    }
  }
}
