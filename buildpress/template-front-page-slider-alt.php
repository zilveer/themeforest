<?php
/*
Template Name: Front Page With Layer/Revolution Slider
*/

get_header();

// slider
$type = get_field( 'slider_type' );

if ( 'layer' === $type && function_exists( 'layerslider' ) ) { // layer slider
	layerslider( (int) get_field( 'layer_slider_id' ) );
}
else if( 'revolution' === $type && function_exists( 'putRevSlider' ) ) { // revolution slider
	putRevSlider( get_field( 'revolution_slider_alias' ) );
}

?>
<div class="master-container">
	<div <?php post_class( 'container' ); ?> role="main">
		<?php
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
					the_content();
				}
			}
		?>
	</div>
</div>

<?php get_footer(); ?>