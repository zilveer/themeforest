<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage grace
 * 
 */

get_header();
st_before_content($columns='');

if ( have_posts() ) : ?>
				<h1><?php printf( __( 'Search Results for: %s', 'grace' ), '' . get_search_query() . '' ); ?></h1>
				<?php
				/* Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called loop-search.php and that will be used instead.
				 */
				 get_template_part( 'loop', 'search' );
				?>
<?php else : ?>
				<div id="post-0" class="post no-results not-found">
					<h2><?php echo __( 'Nothing Found', 'grace' ); ?></h2>
					
					<p><?php echo __( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'grace' ); ?></p>
						<?php get_search_form(); ?>
					
				</div><!-- #post-0 -->
<?php endif;
st_after_content();
get_sidebar();
get_footer();
?>