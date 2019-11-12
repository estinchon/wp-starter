<?php
/**
 * index.php
 *
 * @package theme-text-domain
*/

get_header();
while ( have_posts() ) {
  the_post();
  echo "<h1>Template: index.php</h1>";
  printf("<a href=\"%s\">random link</a>", get_permalink(1));
}
get_footer();
