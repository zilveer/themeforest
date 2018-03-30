<?php

/**
 * @package WordPress
 * @subpackage Agera
 */

?>

<!DOCTYPE html>
<!--[if lte IE 9 ]> <html class="ie" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
	<head>
		<?php $mp_options = agera_get_global_options(); ?>
    	<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php
		if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
		wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>

		<div id="main-container">
			<div id="header-container">
				<div id="header">
					<?php if(has_nav_menu('main')) {
	   					 wp_nav_menu(array( 'theme_location' => 'main', 'container' => '', 'menu_id' => 'nav' ));
					} else {
						wp_nav_menu(array( 'container' => '', 'menu_id' => 'nav' ));
					} ?> <!-- end menu -->

	     			 <div id="slogan">
	    	  			<?php agera_add_logo(); ?>
	  				</div> <!-- end slogan -->
	   			</div> <!-- end header -->
			</div> <!-- end header-container -->