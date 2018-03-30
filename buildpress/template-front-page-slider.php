<?php
/*
Template Name: Front Page With Slider
*/

get_header();

// only include the jumbotron if we defined some slides
if ( have_rows( 'slides' ) ) {
	get_template_part( 'part-jumbotron' );
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
