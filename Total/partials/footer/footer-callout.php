<?php
/**
 * Footer bottom content
 *
 * @package Total WordPress Theme
 * @subpackage Partials
 * @version 3.3.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get post ID
$post_id = wpex_global_obj( 'post_id' );

// Get post content
$content = wpex_global_obj( 'footer_callout_content' );

// Bail if content is empty
if ( ! $content ) {
	return;
}

// Get link
if ( $post_id && $meta = get_post_meta( $post_id, 'wpex_callout_link', true ) ) {
	$link = $meta;
} else {
	$link = wpex_get_mod( 'callout_link', 'http://www.wpexplorer.com' );
}

// Get link text
if ( $post_id && $meta = get_post_meta( $post_id, 'wpex_callout_link_txt', true ) ) {
	$link_text = $meta;
} else {
	$link_text = wpex_get_mod( 'callout_link_txt', 'Get In Touch' );
}

// If link is defined set target and rel
if ( $link ) {

	// Link target
	$target	= wpex_get_mod( 'callout_button_target', 'blank' );
	$target	= ( 'blank' == $target ) ? ' target="_blank"' : '';

	// Link rel
	$rel = wpex_get_mod( 'callout_button_rel', false );
	$rel = ( 'nofollow' == $rel ) ? ' rel="nofollow"' : '';

}

// Translate Theme mods
$content   = wpex_translate_theme_mod( 'callout_text', $content );
$link      = wpex_translate_theme_mod( 'callout_link', $link );
$link_text = wpex_translate_theme_mod( 'callout_link_txt', $link_text ); ?>
	
<div id="footer-callout-wrap" class="clr <?php echo wpex_get_mod( 'callout_visibility', 'always-visible' ); ?>">

	<div id="footer-callout" class="clr container">

		<div id="footer-callout-left" class="footer-callout-content clr <?php if ( ! $link ) echo 'full-width'; ?>">

			<?php echo do_shortcode( $content ); ?>

		</div><!-- #footer-callout-left -->

		<?php
		// Display footer callout button if callout link & text options are not blank in the admin
		if ( $link ) : ?>

			<div id="footer-callout-right" class="footer-callout-button wpex-clr">

				<a href="<?php echo esc_url( $link ); ?>" class="theme-button" title="<?php echo esc_attr( $link_text ); ?>"<?php echo $target; ?><?php echo $rel; ?>><?php echo $link_text; ?></a>

			</div><!-- #footer-callout-right -->

		<?php endif; ?>

	</div><!-- #footer-callout -->

</div><!-- #footer-callout-wrap -->	