<?php
/**
 * functions.php
 *
 * @package theme-text-domain
*/

// core
require_once( dirname( __FILE__ ) . '/core/class-component.php' );
require_once( dirname( __FILE__ ) . '/core/class-site.php' );
require_once( dirname( __FILE__ ) . '/core/class-theme.php' );
require_once( dirname( __FILE__ ) . '/core/autoload-components.php' );

// helpers
require_once( dirname( __FILE__ ) . '/includes/helpers-theme.php' );
require_once( dirname( __FILE__ ) . '/includes/helpers-debugging.php' );
require_once( dirname( __FILE__ ) . '/includes/helpers-media-img.php' );
require_once( dirname( __FILE__ ) . '/includes/helpers-media-svg.php' );
require_once( dirname( __FILE__ ) . '/includes/helpers-misc.php' );

$theme_prefix_theme = new ThemePrefixTheme();
