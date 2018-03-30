<?php
/**
 * Topbar social profiles
 *
 * @package Total WordPress Theme
 * @subpackage Partials
 * @version 3.5.3
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get social options array
$social_options = wpex_topbar_social_options();

// Return if $social_options array is empty
if ( empty( $social_options ) ) {
	return;
}

// Add classes based on topbar style
$classes = '';
$topbar_style = wpex_get_mod( 'top_bar_style', 'one' );
if ( 'one' == $topbar_style ) {
	$classes = 'top-bar-right';
} elseif ( 'two' == $topbar_style ) {
	$classes = 'top-bar-left';
} elseif ( 'three' == $topbar_style ) {
	$classes = 'top-bar-centered';
}

// Display Social alternative
if ( $social_alt = wpex_global_obj( 'top_bar_social_alt' ) ) : ?>

	<div id="top-bar-social-alt" class="clr <?php echo $classes; ?>"><?php
		echo do_shortcode( $social_alt );
	?></div><!-- #top-bar-social-alt -->

<?php return; endif; ?>

<?php
// Return if there aren't any profiles defined and define var
if ( ! $profiles = wpex_get_mod( 'top_bar_social_profiles' ) ) {
	return;
}

// Get theme mods
$style       = wpex_get_mod( 'top_bar_social_style' );
$style       = $style ? $style : 'none';
$link_target = wpex_get_mod( 'top_bar_social_target', 'blank' );
$link_target = ( 'blank' == $link_target || '_blank' == $link_target ) ? ' target="_blank"' : '';
if ( $style == 'colored-icons' ) {
	$colored_icons_url = apply_filters( 'top_bar_social_img_url', get_template_directory_uri() .'/images/social' );
} ?>

<div id="top-bar-social" class="clr <?php echo $classes; ?> social-style-<?php echo $style; ?>">

	<?php
	// Loop through social options
	foreach ( $social_options as $key => $val ) :

		// Get URL from the theme mods
		$url = isset( $profiles[$key] ) ? $profiles[$key] : '';

		// Display if there is a value defined
		if ( $url ) :

			// Sanitize key
			$key = esc_html( $key );

			// Escape URL except for the following keys
			if ( ! in_array( $key, array( 'skype', 'email' ) ) ) {
				$url = esc_url( $url );
			}

			// Display link
			echo '<a href="'. $url .'" title="'. $val['label'] .'" class="wpex-'. $key .' '. wpex_get_social_button_class( $style ) .'"'. $link_target .'>';

				// Image Icons
				if ( $style == 'colored-icons' ) {

					echo '<img src="'. esc_url( $colored_icons_url ) .'/'. $key .'.png" alt="'. esc_attr( $val['label'] ) .'" />';
				
				// Font Awesome Icons
				} else {

					echo '<span class="'. esc_attr( $val['icon_class'] ) .'" aria-hidden="true"></span><span class="screen-reader-text">'. esc_attr( $val['label'] ) .' '. esc_html__( 'Profile', 'total' ) .'</span>';

				}

			echo '</a>';

		endif;

	endforeach; ?>

</div><!-- #top-bar-social -->