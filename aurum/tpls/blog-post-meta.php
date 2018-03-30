<?php
/**
 *	Aurum WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

?>
<?php if($more): ?>
	<small>
		<?php if(get_data('blog_post_date')): ?>
			<?php the_date(); ?>
		<?php endif; ?>

		<?php if(get_data('blog_category') && has_category()): ?>
			<?php echo get_data('blog_post_date') ? '&ndash;' : ''; ?>
			<?php _e('Posted in:', 'aurum'); echo ' '; the_category(', '); ?>
		<?php endif; ?>

		<?php if(get_data('blog_tags') && has_tag()): ?>
			<?php echo get_data('blog_post_date') || get_data('blog_tags') ? '&ndash;' : ''; ?>
			<?php _e('Tags:', 'aurum'); echo ' '; the_tags('', ', ', ''); ?>
		<?php endif; ?>
	</small>
<?php endif; ?>