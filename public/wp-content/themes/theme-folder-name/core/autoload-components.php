<?php
/**
 * Component Autoloader
 *
 * @package theme-text-domain
 */

function theme_prefix_autoload_components() {
  $dir = dirname( __FILE__ ) . '/../components';

  if( !is_admin() && is_dir($dir) ) {
    foreach( scandir( $dir ) as $component ) {
      if( $component !== "." && $component !== ".." && is_dir( $dir . '/' . $component ) ) {
        $file = "{$dir}/{$component}/index.php";
        file_exists( $file ) && include_once( $file );
      }
    }
  }
}

add_action( 'init', 'theme_prefix_autoload_components' );
