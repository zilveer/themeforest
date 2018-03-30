<?php
/**
 * @package WordPress
 * @subpackage Fast_Blog_Theme
 * @since Fast Blog 1.0
 */
?>

<?php get_header(); ?>

<?php get_sidebar(); ?>

<div id="content" class="<?php echo fastblog_get_option('sidebar') == 'right' ? 'left' : 'right'; ?>">

	<?php if (is_404() || is_search() || is_tag() || is_date()): ?>
		<h2 class="message">
			<?php
				if (is_404())
					_e( 'Oops, the page you are trying to reach doesn\'t exist.', 'fastblog' );
				else if (is_search())
					printf(__('Search results for &#8216;%1$s&#8217; keyword', 'fastblog'), esc_html($s));
				else if (is_tag())
					printf(__('Posts tagged &#8216;%1$s&#8217;', 'fastblog'), single_tag_title('', false));
				else if (is_day())
					printf(__('Archive for %1$s', 'fastblog'), get_the_time('F jS, Y'));
				else if (is_month())
					printf(__('Archive for %1$s', 'fastblog'), get_the_time('F, Y'));
				else if (is_year())
					printf(__('Archive for %1$s', 'fastblog'), get_the_time('Y'));
			?>
		</h2>
	<?php endif; ?>

	<?php get_template_part('loop', 'index'); ?>

	<?php if (!is_singular()): ?>
		<!-- Posts navigation -->
		<div class="navigation" style="margin-bottom: 0;">
			<div class="alignleft"><?php next_posts_link('&laquo; '.__('Older posts', 'fastblog')); ?></div>
			<div class="alignright"><?php previous_posts_link(__('Newer posts', 'fastblog').' &raquo;'); ?></div>
			<div class="clear"></div>
		</div>
		<!-- // Posts navigation -->
	<?php endif; ?>

</div>

<?php get_footer(); ?>