<?php
/**
 * Theme Class
 *
 * @package theme-text-domain
 */

class ThemePrefixTheme {
  public $version = '1.0';

  function __construct() {
    $theme = wp_get_theme();
    $this->version = $theme->version;

    add_action( 'init', array( $this, 'disable_emojis') );
    add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
    add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_js_footer' ) );
    add_action( 'after_setup_theme', array($this, 'setup') );
    add_action( 'wp_head', array($this, 'detect_js_support'), 1 );
    add_action( 'acf/init', array($this, 'register_options_page') );
    add_action( 'after_setup_theme', array($this, 'add_image_sizes'));

    // editor & gutenberg
    add_action( 'admin_head', array($this, "disable_classic_editor") );
    add_filter( 'gutenberg_can_edit_post_type', array($this, "disable_gutenberg"), 10, 2 );
    add_filter( 'use_block_editor_for_post_type', array($this, "disable_gutenberg"), 10, 2 );
  }

  public function setup() {
    /* Translations. */
    // load_theme_textdomain( 'theme-text-domain', get_template_directory() . '/languages' );

    /* Add default posts and comments RSS feed links to head. */
    add_theme_support( 'automatic-feed-links' );

    /* Let WordPress manage the document title. */
    add_theme_support( 'title-tag' );

    /* Configure post thumbnails. */
    add_theme_support( 'post-thumbnails' );

    /* Register menus. */
    register_nav_menus(
      array(
        'nav' => 'Main Nav',
        'footer' => 'Footer Nav'
      )
    );

    /* Switch default core markup to output valid HTML5. */
    add_theme_support(
      'html5',
      array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
      )
    );

    /* Add support for block styles. */
    add_theme_support( 'wp-block-styles' );

    /* Add support for responsive embedded content. */
    add_theme_support( 'responsive-embeds' );
  }

  public function enqueue_assets() {
    // Remove Block Library Styles
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );

    // Styles
    wp_enqueue_style( 'theme-folder-name-style', get_template_directory_uri() . '/assets/styles/style.css', array(), $this->version );
    // Scripts
    wp_register_script( 'theme-folder-name-script', get_template_directory_uri() . '/assets/scripts/main.js', array(), $this->version, true );
    wp_localize_script( 'theme-folder-name-script', 'theme_prefix_data', array(
      "editing" => is_user_logged_in() ? "1" : "0"
    ));
    wp_enqueue_script('theme-folder-name-script');
  }

  public function detect_js_support() {
    echo '<script>document.documentElement.className = document.documentElement.className.replace("no-js","js");</script>'. "\n";
  }

  public function register_options_page() {
    if( !function_exists('acf_add_options_page') )
      return;

    // register: general
    $option_page = acf_add_options_page(array(
      'page_title'    => 'Theme Settings',
      'menu_title'    => 'Theme Settings',
      'menu_slug'     => 'theme-settings',
      'capability'    => 'edit_posts',
      'redirect'      => false
    ));
  }

  public function add_image_sizes() {
    /* === update medium size via update_option === */
    // update_option('medium_size_w', 480);
    // update_option('medium_size_h', 9999);

    /* === add custom size: medium_plus === */
    // add_image_size("medium_plus", 640, 9999, false);

    /* === update large size via update_option === */
    // update_option('large_size_w', 1024);
    // update_option('large_size_h', 9999);

    /* === add custom size: xlarge === */
    // add_image_size("xlarge", 1680, 9999, false);
  }

  public function enqueue_js_footer() {
    /* forcing the js to be output in the footer to eliminate render-blocking resources. */
    remove_action('wp_head', 'wp_print_scripts');
    remove_action('wp_head', 'wp_print_head_scripts', 9);
    remove_action('wp_head', 'wp_enqueue_scripts', 1);

    add_action('wp_footer', 'wp_print_scripts', 5);
    add_action('wp_footer', 'wp_enqueue_scripts', 5);
    add_action('wp_footer', 'wp_print_head_scripts', 5);
  }

  public function has_editor($id) {
    if( !empty($id) ) {
      $id = intval( $_GET["post"] );
      $template = get_page_template_slug( $id );

      $exclude_templates = array(
        "page-home.php"
      );

      if( in_array($template, $exclude_templates) ) {
        return false;
      }
    }
    return true;
  }

  public function disable_gutenberg( $can_edit, $post_type ) {
    if( is_admin() && !empty( $_GET["post"] ) ) {
      $can_edit = $this->has_editor( $_GET["post"] );
    }

    return $can_edit;
  }

  public function disable_classic_editor() {
    $screen = get_current_screen();

    if( 'page' !== $screen->id || ! isset( $_GET['post']) ) return;

    if( !$this->has_editor( $_GET['post'] ) ) {
      remove_post_type_support( 'page', 'editor' );
    }
  }

  public function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', array($this, 'disable_emojis_tinymce') );
  }

  public function disable_emojis_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
      return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
      return array();
    }
  }
}
