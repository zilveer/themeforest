<?php
/**
 * The Homepage
 *
 * The section functions are located in function.php and can be overridden in a child theme.
 * 
 */

get_header(); 

// Set vars
$layout = 'cs';
$dd_count = 0;

// Set vars (with sidebar)
if ( $layout == 'cs' ) {
	
	// In page vars
	$content_class = 'two-thirds column ';
	$blog_posts_class = 'blog-listing-style-2';
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

		<div id="content" class="<?php echo $content_class; ?>">

			<div class="blog-posts blog-listing <?php echo $blog_posts_class; ?> clearfix">

				<?php

					if ( have_posts()) : while ( have_posts()) : the_post(); $dd_count++;
						
						get_template_part( 'templates/content', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) );

					endwhile; else:

						?><div class="align-center"><?php _e( 'This archive is empty.', 'dd_string' ); ?></div><?php

					endif;

				?>

			</div><!-- .blog-posts -->

			<?php dd_theme_pagination();  ?>

		</div><!-- #content -->
	
		<?php 
			if ( $has_sidebar ) {
				get_sidebar();
			}
		?>
		
	</div><!-- .container -->

<?php get_footer(); ?>