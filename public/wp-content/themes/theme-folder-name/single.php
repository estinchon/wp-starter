<?php
/**
 * single.php
 *
 * @package theme-text-domain
*/

get_header();
while ( have_posts() ) {
  the_post();
  echo "<h1>Template: single.php</h1>";
}
get_footer();
