<?php
/**
 * Helpers: Debugging
 *
 * PHP debugging output
 *
 * @package theme-text-domain
 */

function theme_prefix_var_dump($input) {
  echo "<div class=\"code-debug\">";
  echo "<pre>";
  echo "<code>";
  var_dump( $input );
  echo "</code>";
  echo "</pre>";
  echo "</div>";
}

function theme_prefix_var_dump_r($input) {
  ob_start();
  theme_prefix_var_dump($input);
  return ob_get_clean();
}
