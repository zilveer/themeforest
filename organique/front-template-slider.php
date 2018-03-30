<?php
/**
 * Template Name: Front page with slider
 *
 * @package Organique
 */

// WP header
get_header();

// slider
$alias = get_post_meta( get_the_ID() , 'revo_slider_alias', true );

if ( ! empty( $alias ) ) {
	// revolution slider
	if ( function_exists( 'putRevSlider' ) ) {
		putRevSlider( $alias );
	}
	// layer slider
	else if( function_exists( 'layerslider' ) ) {
		layerslider( (int) $alias );
	}
} else {
	get_template_part( 'jumbotron-slider' );
}

?>

<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<?php
				if ( have_posts() ) {
					the_post();
					the_content();
				}
			?>
		</div>
	</div>
</div>

<?php get_footer(); ?>