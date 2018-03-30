<!DOCTYPE html>

<!-- BEGIN html -->
<html <?php language_attributes() ?>>

<!-- BEGIN head -->
<head>

<!-- Metas -->
<meta charset="<?php bloginfo( 'charset' ) ?>">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
<meta http-equiv="x-ua-compatible" content="ie=edge,chrome=1">

<!-- Title & Favicon --> 
<title><?php wp_title( '|', true, 'right' ) ?><?php bloginfo( 'name' ) ?></title>
<link rel="shortcut icon" href="<?php Acorn::eget( 'favicon', '/favicon.ico' ) ?>">

<?php wp_head() ?>

</head>
<!-- END head -->

<?php flush() // http://developer.yahoo.com/performance/rules.html#flush ?>

<!-- BEGIN body -->
<body <?php body_class() ?>>

<?php get_template_part( 'tile', 'head' ) ?>