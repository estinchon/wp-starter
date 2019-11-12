<?php
/**
 * Helpers: Theme
 *
 * Handles namespaces, theme url etc.
 *
 * @package theme-text-domain
 */

function theme_prefix_theme_url( $path ) {
  return get_template_directory_uri() . $path;
}

function theme_prefix_get_namespace() {
  if( is_page() ) {
    return "page";
  }
  else if( is_single() ) {
    return "post";
  }
  else if( is_404() ) {
    return "error";
  }

  return "default";
}
