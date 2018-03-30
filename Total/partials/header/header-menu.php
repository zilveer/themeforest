<?php
/**
 * Header menu template part.
 *
 * @package Total WordPress Theme
 * @subpackage Partials
 * @version 3.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Menu Location
$menu_location = wpex_global_obj( 'header_menu_location' );

// Multisite global menu
$ms_global_menu = apply_filters( 'wpex_ms_global_menu', false );

// Display menu if defined
if ( has_nav_menu( $menu_location ) || $ms_global_menu ) :

	// Menu arguments
	$menu_args = apply_filters( 'wpex_header_menu_args', array(
		'theme_location' => $menu_location,
		'menu_class'     => 'dropdown-menu sf-menu',
		'container'      => false,
		'fallback_cb'    => false,
		'link_before'    => '<span class="link-inner">',
		'link_after'     => '</span>',
		'walker'         => new WPEX_Dropdown_Walker_Nav_Menu(),
	) );

	// Check for custom menu
	if ( $menu = wpex_custom_menu() ) {
		$menu_args['menu']  = $menu;
	} ?>

	<?php wpex_hook_main_menu_before(); ?>

	<div id="site-navigation-wrap" class="<?php echo wpex_header_menu_classes( 'wrapper' );; ?>">

		<nav id="site-navigation" class="<?php echo wpex_header_menu_classes( 'inner' ); ?>"<?php wpex_schema_markup( 'site_navigation' ); ?>>

			<?php wpex_hook_main_menu_top(); ?>

				<?php
				// Display global multisite menu
				if ( is_multisite() && $ms_global_menu ) :
					
					switch_to_blog( 1 );  
					wp_nav_menu( $menu_args );
					restore_current_blog();

				// Display this site's menu
				else :

					wp_nav_menu( $menu_args );

				endif; ?>

			<?php wpex_hook_main_menu_bottom(); ?>

		</nav><!-- #site-navigation -->

	</div><!-- #site-navigation-wrap -->

	<?php wpex_hook_main_menu_after(); ?>

<?php endif; ?>