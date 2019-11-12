<?php
/**
 * Media helpers: Images
 *
 * For rendering images etc.
 *
 * @package theme-text-domain
 */

function theme_prefix_get_all_image_sizes( $include_cropped = true ) {
  global $_wp_additional_image_sizes;

  $default_image_sizes = get_intermediate_image_sizes();

  foreach ( $default_image_sizes as $size ) {
      $image_sizes[ $size ][ 'width' ] = intval( get_option( "{$size}_size_w" ) );
      $image_sizes[ $size ][ 'height' ] = intval( get_option( "{$size}_size_h" ) );
      $image_sizes[ $size ][ 'crop' ] = get_option( "{$size}_crop" ) ? boolval( get_option( "{$size}_crop" ) ) : false;
  }

  if ( isset( $_wp_additional_image_sizes ) && count( $_wp_additional_image_sizes ) ) {
      $image_sizes = array_merge( $image_sizes, $_wp_additional_image_sizes );
  }

  if( $include_cropped === false ) {
    foreach( $image_sizes as $key => $size ) {
      if( $size["crop"] !== false ) {
        unset($image_sizes[$key]);
      }
    }
  }

  return $image_sizes;
}

function theme_prefix_get_image_alt( $id ) {
  $alt = get_post_meta( $id, '_wp_attachment_image_alt', true );

  if( empty( $alt ) ) {
    $alt = preg_replace("/[\-_]/", " ", get_the_title( $id ));
  }

  return $alt;
}

function theme_prefix_get_image_placeholder_data_url() {
  return "data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==";
}

function theme_prefix_get_responsive_image($id, $args = array()) {
  $default_args = array(
    "alt" => "",
    "class" => "",
    "sizes" => array(),
    "default_size" => "medium_large"
  );

  $merged_args = array_merge( $default_args, $args );
  extract( $merged_args );

  $image_src = wp_get_attachment_image_src( $id );

  if( $image_src === false ) {
    // image doesnt exist
    return "";
  }

  if( empty( $sizes ) ) {
    // add all sizes, uncropped only
    $all_sizes = theme_prefix_get_all_image_sizes(false);

    foreach($all_sizes as $key => $value) {
      array_push( $sizes, $key );
    }

    // add full size
    array_push( $sizes, "full" );
  }

  $sizes_array = array();

  foreach( $sizes as $size ) {
    $img_src = wp_get_attachment_image_src( $id, $size );
    array_push( $sizes_array, array(
      "width" => $img_src[1],
      "src" => $img_src[0]
    ));
  }

  // sort array by width ASC
  usort($sizes_array, function($a, $b) {
    if ($a["width"] == $b["width"]) {
      return 0;
    }
    return ($a["width"] < $b["width"]) ? -1 : 1;
  });

  // generate srcset atts
  $srcset_array = array();
  foreach( $sizes_array as $size ) {
    array_push($srcset_array, $size["src"] . " " . $size["width"] . "w");
  }

  $srcset_array = array_unique($srcset_array);

  $srcset = implode(", ", $srcset_array);

  // get default image src
  $default_src = wp_get_attachment_image_src($id, $default_size);

  // low quality
  $lq_src = wp_get_attachment_image_src($id, "medium");

  return sprintf(
    "<img src=\"%s\" srcset=\"%s\" data-src=\"%s\" data-srcset=\"%s\" data-sizes=\"auto\" alt=\"%s\" class=\"lazyload%s\">",
    $lq_src[0],
    theme_prefix_get_image_placeholder_data_url(),
    $default_src[0],
    $srcset,
    empty($alt) ? theme_prefix_get_image_alt($id) : $alt,
    empty($class) ? "" : " " . $class
  );
}

function theme_prefix_get_image($id, $size = "full", $args = array()) {
  $default_args = array(
    "alt" => "",
    "class" => ""
  );

  $merged_args = array_merge( $default_args, $args );
  extract( $merged_args );

  $attachment_image = wp_get_attachment_image_src( $id, $size );

  if( $attachment_image === false ) {
    // image doesnt exist
    return "";
  }

  $src = $attachment_image[0];

  return sprintf(
    "<img data-src=\"%s\" alt=\"%s\" class=\"lazyload%s\">",
    $src,
    empty($alt) ? theme_prefix_get_image_alt($id) : $alt,
    empty($class) ? "" : " " . $class
  );
}
