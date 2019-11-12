<!DOCTYPE html>
<html <?php language_attributes() ?> class="no-js">
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">
<!-- Favicons START -->
<?php
/*
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/favicons/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/assets/favicons/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/assets/favicons/favicon-16x16.png">
<link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/assets/favicons/site.webmanifest">
<link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/assets/favicons/safari-pinned-tab.svg" color="#000000">
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/favicons/favicon.ico">
<meta name="msapplication-TileColor" content="#000000">
<meta name="msapplication-config" content="<?php echo get_template_directory_uri(); ?>/assets/favicons/browserconfig.xml">
<meta name="theme-color" content="#ffffff">
*/
?>
<!-- Favicons END -->
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div class="transition-wrapper" data-barba="wrapper">
<div class="transition-container" data-barba="container" data-barba-namespace="<?php echo theme_prefix_get_namespace(); ?>" data-body-class="<?php echo implode(" ", get_body_class()); ?>">
<main>
