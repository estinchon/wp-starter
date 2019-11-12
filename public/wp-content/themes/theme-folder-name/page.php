<?php
/**
 * page.php
 *
 * @package theme-text-domain
*/

get_header();
while ( have_posts() ) {
  the_post();
  echo "<h1>Template: page.php</h1>";
}
get_footer();
