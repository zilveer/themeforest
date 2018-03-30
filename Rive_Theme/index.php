<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme.
 */
	get_header();
	
	if ( have_posts() && !is_front_page() ) {
		while ( have_posts() ) {
			the_post();
			get_template_part( 'content', get_post_format() );
		}
	} else {
		?>
		<div class="white-bg">
			<div class="clearfix"></div>
			<h1 class="page-title"><?php _e( 'Nothing Found!', 'ch' ); ?></h1>
			<p><?php _e( 'Sorry, nothing found!', 'ch' ); ?></p>
			<div class="clearfix"></div>
		</div>
		<?php
		}
	?>
<?php get_footer();