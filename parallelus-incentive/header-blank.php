<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="shortcut icon" href="<?php options_data('options-page', 'favorites-icon'); ?>">
	<link rel="apple-touch-icon-precomposed" href="<?php options_data('options-page', 'mobile-bookmark'); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php

// Begin design
//................................................................
?>	
<div id="page" class="hfeed site">

	<div id="Middle">
		<div class="main-content">

			<?php 

			// Layout Manager - Start Layout
			//................................................................
			// do_action('output_layout','start'); // do_action('output_header'); // :/ 

			?>