<?php
/**
 * @package WordPress
 * @subpackage Fast_Blog_Theme
 * @since Fast Blog 1.0
 */
?>

<?php
	global $authordata;
	$meta = fastblog_get_option(is_page() ? 'page/meta' : 'post/meta');
?>

<div class="meta">
	<?php if ($meta['date']): ?>
		<?php if (is_page()): ?>
			<a class="date"><?php the_modified_date(); ?></a>
		<?php else: ?>
			<a href="<?php echo call_user_func_array('get_month_link', explode(' ', get_the_date('Y m'))); ?>" class="date">
				<?php echo get_the_date('Y.m.d') == date('Y.m.d') ? __('Today', 'fastblog').', '.get_the_time() : get_the_date(); ?>
			</a>
		<?php endif; ?>
	<?php endif; ?>
	<?php if (isset($meta['category']) && $meta['category']): ?>
		<?php
			if (count($categories = get_the_category()) == 1):
				$category = $categories[0];
		?>
			<a href="<?php echo get_category_link($category->term_id); ?>" class="category" rel="category" title="<?php echo esc_attr(sprintf(__('View all posts in %s', 'fastblog'), $category->name)); ?>"><?php echo $category->name; ?></a>
		<?php else: ?>
			<span class="category"><?php the_category(', '); ?></span>
		<?php endif; ?>
	<?php endif; ?>
	<?php if ($meta['comments'] && (comments_open() || have_comments())): ?>
		<a href="<?php comments_link(); ?>" title="<?php if (!(defined('DISQUS_VERSION') || defined('ID_PLUGIN_VERSION') || class_exists('Facebook_Loader') || function_exists('livefyre_comments_number'))) comments_number(); ?>" class="comments"><?php comments_number(); ?></a>
	<?php endif; ?>
	<?php if (isset($meta['author']) && $meta['author']): ?>
		<a href="<?php echo get_author_posts_url($authordata->ID, $authordata->user_nicename); ?>" title="<?php echo esc_attr(get_the_author()); ?>" class="author"><?php the_author(); ?></a>
	<?php endif; ?>
	<?php if (isset($meta['short_url']) && $meta['short_url'] && ($short_url = get_post_meta(get_the_ID(), '_fastblog_short_url', true))): ?>
		<a href="<?php echo $short_url; ?>" title="<?php _e('Short URL', 'fastblog'); ?>" class="short-url"><?php _e('Short URL', 'fastblog'); ?></a>
	<?php endif; ?>
	<?php if ($meta['admin_edit']) edit_post_link(__('Edit', 'fastblog')); ?>
</div>