 <?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>  class="<?php freschi_theme_boxed(); ?>">
	<head>

		<meta charset="<?php echo esc_attr( get_bloginfo( 'charset' ) ); ?>" />

		<title><?php woo_title(); ?></title>

		<?php woo_meta(); ?>

		<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>" />

		<?php woo_head(); ?>

		<?php wp_head(); ?>
	
	</head>

	<body <?php body_class(); ?>>

		<?php woo_top(); ?>

		<?php df_ajax_search_front(); ?>

		<div id="wrapper">

			<?php woo_header_before(); ?>
		    
			<div id="header" class="col-full">

			 	<?php woo_header_inside(); ?>
		       
				<?php dahz_get_header('logo'); ?>

				<?php dahz_get_header('ads'); ?>
				

		        <h3 class="nav-toggle fa fa-reorder">
		        	<a href="#navigation"><?php _e('Navigation', 'woothemes'); ?></a>
		        </h3>

		    </div><!-- /#header -->

			<?php woo_header_after(); ?>

			<?php dahztheme_title_controller(); ?>

 