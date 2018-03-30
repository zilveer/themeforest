<?php
/**
 * Mobile Icons Header Menu.
 *
 * @package Total WordPress Theme
 * @subpackage Partials
 * @version 3.3.5
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<div id="mobile-menu" class="clr wpex-mobile-menu-toggle wpex-hidden">
	<?php
	// Toggle only needed if main menu is defined
	$menu_location  = apply_filters( 'wpex_main_menu_location', 'main_menu' );
	$ms_global_menu = apply_filters( 'wpex_ms_global_menu', false );
	if ( has_nav_menu( $menu_location ) || $ms_global_menu ) : ?>
		<a href="#" class="mobile-menu-toggle"><?php echo apply_filters( 'wpex_mobile_menu_open_button_text', '<span class="fa fa-navicon"></span>' ); ?></a>
	<?php endif; ?>
	<?php
	// Output icons if the mobile_menu region has a menu defined
	if ( has_nav_menu( 'mobile_menu' ) ) {
		if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ 'mobile_menu' ] ) ) {
			$menu = wp_get_nav_menu_object( $locations[ 'mobile_menu' ] );
			if ( ! empty( $menu ) ) {
				$menu_items = wp_get_nav_menu_items( $menu->term_id );
				foreach ( $menu_items as $key => $menu_item ) {
					if ( in_array( $menu_item->title, wpex_get_awesome_icons() ) ) {
						$url = $menu_item->url;
						$attr_title = $menu_item->attr_title; ?>
						<a href="<?php echo esc_url( $url ); ?>" title="<?php echo esc_attr( $attr_title ); ?>" class="mobile-menu-extra-icons mobile-menu-<?php echo esc_attr( $menu_item->title ); ?>">
							<span class="fa fa-<?php echo esc_attr( $menu_item->title ); ?>"></span>
						</a>
				<?php }
				}
			}
		}
	} ?>
</div><!-- #mobile-menu -->