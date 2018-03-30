<?php
/**
 * Visual Composer Callout
 *
 * @package Total WordPress Theme
 * @subpackage VC Templates
 * @version 3.3.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Not needed in admin ever
if ( is_admin() ) {
	return;
}

// Required VC functions
if ( ! function_exists( 'vc_map_get_attributes' ) || ! function_exists( 'vc_shortcode_custom_css_class' ) ) {
	vcex_function_needed_notice();
	return;
}

// Get and extract shortcode attributes
extract( vc_map_get_attributes( 'vcex_callout', $atts ) );

// Enqueue CSS
wp_enqueue_style( 'vcex-callout', WPEX_VCEX_DIR_URI . 'shortcodes/callout/callout.css', array(), WPEX_THEME_VERSION );

// Sanitize variables
$button_target = vcex_html( 'target_attr', $button_target );
$button_rel    = vcex_html( 'rel_attr', $button_rel );

// Add Classes
$wrap_classes = array( 'vcex-callout', 'clr' );
if ( $button_url ) {
	$wrap_classes[] = 'with-button';
}
if ( $visibility ) {
	$wrap_classes[] = $visibility;
}
if ( $css_animation ) {
	$wrap_classes[] = vcex_get_css_animation( $css_animation );
}
if ( $classes ) {
	$wrap_classes[] = vcex_get_extra_class( $classes );
}
$wrap_classes[] = vc_shortcode_custom_css_class( $css );
$wrap_classes = implode( ' ', $wrap_classes );

// Button style
if ( $button_url && $button_text ) {
	$button_inline_style = vcex_inline_style( array(
		'border_radius' => $button_border_radius,
	) );
} ?>

<div class="<?php echo esc_attr( $wrap_classes ); ?>"<?php vcex_unique_id( $unique_id ); ?>>

	<?php
	// Display content
	if ( $content ) : ?>

		<div class="vcex-callout-caption clr">
			<?php echo apply_filters ( 'the_content', $content ); ?>
		</div><!-- .vcex-callout-caption -->
		
	<?php endif; ?>

	<?php
	// Display button
	if ( $button_url && $button_text ) : ?>

		<div class="vcex-callout-button">
			<a href="<?php echo $button_url; ?>" class="<?php echo wpex_get_button_classes( $button_style, $button_color ); ?>" title="<?php echo $button_text; ?>"<?php echo $button_target; ?><?php echo $button_rel; ?><?php echo $button_inline_style; ?>>
				<?php
				// Display left button icon
				if ( $button_icon_left && 'none' != $button_icon_left ) : ?>
					<span class="theme-button-icon-left fa fa-<?php echo $button_icon_left; ?>"></span>
				<?php endif; ?>
				<?php
				// Button Text
				echo $button_text; ; ?>
				<?php
				// Display right button icon
				if ( $button_icon_right && 'none' != $button_icon_right ) : ?>
					<span class="theme-button-icon-right fa fa-<?php echo $button_icon_right; ?>"></span>
				<?php endif; ?>
			</a>
		</div><!-- .vcex-callout-button -->

	<?php endif; ?>

</div><!-- .vcex-callout -->