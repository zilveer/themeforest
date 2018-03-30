<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Believe
 */
get_header();

global $ch_from_archive;
$ch_from_archive = true;
?>
<div class="white-bg">
	<div class="clearfix"></div>
		<div class="">
			<?php
			if (have_posts()) { ?>
				<h1 class="page-title">
					<?php echo ch_breadcrumbs();?>
					<?php if (is_day()) : ?>
						<?php printf(__('Daily Archives: %s', 'ch'), '<span>' . get_the_date() . '</span>'); ?>
					<?php elseif (is_month()) : ?>
						<?php printf(__('Monthly Archives: %s', 'ch'), '<span>' . get_the_date('F Y') . '</span>'); ?>
					<?php elseif (is_year()) : ?>
						<?php printf(__('Yearly Archives: %s', 'ch'), '<span>' . get_the_date('Y') . '</span>'); ?>
					<?php else : ?>
						<?php _e('Blog Archives', 'ch'); ?>
					<?php endif; ?>
				</h1>
			<?php
				// Include the Post-Format-specific template for the content.
				get_template_part('loop', get_post_format());
			} else { ?>
				<h1 class="page-title"><?php _e('Nothing Found', 'ch'); ?></h1>
				<div class="entry-content">
					<p><?php _e('Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'ch'); ?></p>
					<?php get_search_form(); ?>
				</div><!--end of entry-content-->
			<?php } ?>
			<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
		</div>
	<div class="clearfix"></div>
</div>
<?php $ch_is_in_sidebar = false; ?>
<?php get_footer();