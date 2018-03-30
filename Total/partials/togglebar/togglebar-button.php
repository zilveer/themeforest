<?php
/**
 * Togglebar button output
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.3.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$icon        = wpex_get_mod( 'toggle_bar_button_icon', 'plus' );
$icon        = apply_filters( 'wpex_togglebar_icon_class', 'fa fa-'. $icon );
$active_icon = wpex_get_mod( 'toggle_bar_button_icon_active', 'minus');
$active_icon = apply_filters( 'wpex_togglebar_icon_active_class', 'fa fa-'. $active_icon ); ?>

<a href="#" class="toggle-bar-btn fade-toggle open-togglebar <?php echo wpex_get_mod( 'toggle_bar_visibility', 'always-visible' ); ?>" data-icon="<?php echo $icon; ?>" data-icon-hover="<?php echo $active_icon; ?>">
	<span class="<?php echo $icon; ?>"></span>
</a>