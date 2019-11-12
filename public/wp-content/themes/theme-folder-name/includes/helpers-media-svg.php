<?php
/**
 * Media helpers: SVGs
 *
 * For loading inline svgs
 *
 * @package theme-text-domain
 */

function theme_prefix_get_inline_svg($path) {
  $full_path = get_template_directory() . $path;

  if( ! file_exists( $full_path ) ) return;

  // read from file
  $file = fopen($full_path,"r");
  $contents = fread($file, filesize($full_path));
  fclose($file);

  // remove <?xml...
  $cleaned = preg_replace('/<\?xml .+\?>(.*)/i', "$1", $contents);
  return ltrim(rtrim($cleaned));
}
