<?php
/**
 * Template Name: Home
 *
 * @package theme-text-domain
*/

get_header();
while ( have_posts() ) {
  the_post();
  echo "<h1>Template: page-home.php</h1>\n";
  ThemePrefixSite::render_component("example-content");
}
get_footer();
