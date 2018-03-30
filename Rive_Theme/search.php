<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Believe
 */

get_header();
global $ch_from_search;
?>
<div class="white-bg">
	<div class="clearfix"></div>
		<div class="">
			<?php if ( have_posts() ) { ?>
				<h1 class="page-title">
					<?php echo ch_breadcrumbs(); ?>
					<?php printf( __( 'Search Results for: %s', 'ch' ), '<span>' . get_search_query() . '</span>' ); ?>
				</h1>
				<?php
					$ch_from_search = true;

					// Include the Post-Format-specific template for the content.
					get_template_part( 'loop', get_post_format() );
				?>
			<?php } else { ?>
				<h1 class="page-title">
					<?php echo ch_breadcrumbs(); ?>
					<?php _e( 'Nothing Found', 'ch' ); ?>
				</h1>
				<div class="entry-content">
					<p><?php _e('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'ch'); ?></p>
					<?php get_search_form(); ?>
				</div><!--end of entry-content-->
			<?php } ?>
		</div>
		<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
	<div class="clearfix"></div>
</div>
<?php $ch_is_in_sidebar = false; ?>
<?php get_footer();