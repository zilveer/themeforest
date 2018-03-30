<?php

/**
* @global string    $title
* @global string    $hook_suffix
* @global WP_Screen $current_screen
* @global WP_Locale $wp_locale
* @global string    $pagenow
* @global string    $wp_version
* @global string    $update_title
* @global int       $total_update_count
* @global string    $parent_file
*/

global $title, $hook_suffix, $current_screen, $wp_locale, $pagenow, $wp_version,
$update_title, $total_update_count, $parent_file;

?><!DOCTYPE html>
<html id="ux-builder" ng-app="uxBuilder" ng-strict-di <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title><?php get_admin_page_title(); ?></title>
	<?php do_action( 'admin_enqueue_scripts', $hook_suffix ); ?>
	<?php do_action( 'admin_print_styles' ); ?>
	<?php do_action( 'admin_print_scripts' ); ?>
</head>

<body>

	<app></app>

	<app-loader></app-loader>
  <app-stack></app-stack>
	<draggable-helper></draggable-helper>
  <context-menu></context-menu>

	<!-- Templates -->
	<script id="components/text-editor/text-editor.html" type="text/ng-template">
		<?php wp_editor( '', 'uxb-editor', array( 'wpautop' => false, 'quicktags' => false ) ); ?>
	</script>

	<?php do_action( 'admin_footer', '' ); ?>
	<?php do_action( 'admin_print_footer_scripts' ); ?>

</body>
</html>
