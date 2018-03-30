<?php
/**
 * The template for the hero area (the top area) of the contact page template - The GMap.
 *
 * @package Pile
 * @since   Pile 2.0
 */

global $is_gmap;

$classes = array( 'djax-updatable' );
//first lets get to know this page a little better
// what is the hero height
$header_height = get_post_meta( get_the_ID(), '_pile_contact_page_header_height', true );
if ( empty( $header_height ) ) {
	$header_height = 'full-height'; //the default
}
$classes[] = $header_height;

//get the Google Maps URL
$gmap_url = get_post_meta( get_the_ID(), '_pile_gmap_url', true );

$gmap_custom_style = '';
$gmap_marker_content = '';
//this is already set in pile_scripts()
if ( true == $is_gmap ) {
	$gmap_custom_style   = get_post_meta( get_the_ID(), '_pile_gmap_custom_style', true );
	$gmap_marker_content = get_post_meta( get_the_ID(), '_pile_gmap_marker_content', true );
}

//to be or not to be a (visible) hero
if ( ! $is_gmap ) {
	$classes[] = 'djax--hidden';
} ?>

<div id="djaxHero" <?php pile_hero_classes( $classes ); ?>>

	<?php if ( $is_gmap ) : ?>

		<div class="hero js-hero">
			<div class="hero-slider">
				<div class="hero-bg--map" id="gmap"
				     data-url="<?php esc_attr_e( $gmap_url ); ?>" <?php echo ( $gmap_custom_style == 'on' ) ? 'data-customstyle' : ''; ?>
				     data-markercontent="<?php echo esc_attr( $gmap_marker_content ); ?>"></div>
			</div>
		</div><!-- .hero -->

	<?php endif; ?>

</div><!-- #djaxHero -->