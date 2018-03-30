<?php
/**
 * The template for displaying Search Results pages
 */

get_header(); 

// Get Options
$layout = 'cs';

// Set vars
$dd_count = 0;

// Set vars (with sidebar)
if ( $layout == 'cs' ) {
	
	// In page vars
	$content_class = 'two-thirds column ';
	$blog_posts_class = 'blog-listing-style-2';
	$causes_class = ' causes-listing-style-2';
	$events_class = ' events-listing-style-2';
	$has_sidebar = true;

	// Template vars (globals)
	$dd_post_class = '';
	$dd_thumb_size = 'dd-one-fourth';
	$dd_style = '2';

// Set vars (without sidebar)
} else {

	// In page vars
	$content_class = '';
	$blog_posts_class = '';
	$has_sidebar = false;

	// Template vars (globals)
	$dd_post_class = 'four columns ';
	$dd_thumb_size = 'dd-one-fourth';
	$dd_style = '1';

}

?>

	<div class="container clearfix">

		<div id="content" class="clerfix <?php echo $content_class; ?>">

			<div class="blog-posts blog-listing causes causes-listing events events-listing <?php echo $blog_posts_class . $causes_class . $events_class; ?> clearfix">

				<?php

					if ( have_posts()) : while ( have_posts()) : the_post();
						
						if ( get_post_type() == 'dd_events' ) {
							get_template_part( 'templates/events', '' );
						} elseif ( get_post_type() == 'dd_causes' ) {
							get_template_part( 'templates/causes', '' );
						} else {
							get_template_part( 'templates/content', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) );
						}

					endwhile; else:

						?><div class="align-center"><?php _e( 'There are no posts that fit the search term.', 'dd_string' ); ?></div><?php

					endif;

				?>

			</div><!-- .blog-posts -->

			<?php dd_theme_pagination();  ?>

		</div><!-- #content -->

		<?php if ( $has_sidebar ) { get_sidebar(); } ?>
		
	</div><!-- .container -->

<?php get_footer(); ?>