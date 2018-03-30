<?php get_header(); ?>
<div class="ef-row clearfix">
	<?php if (have_posts()) { ?>
		<?php while (have_posts()) : the_post(); ?>
			<?php
				$type = (sg_get_tpl() == 'portfolio|default') ? 'portfolio_category' : 'category';
			?>
			<div id="post-<?php the_ID(); ?>" <?php post_class('ef-blog-post ef-col1-4 bottom-2_4em'); ?>>
				<div class="ef-col">
					<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
					<div class="extras-descrp"><?php echo sg_the_tag_list($type, ', '); ?></div>
					<div class="ef-date-comments">
						<div><?php the_time('d'); ?><span><?php the_time('M'); ?></span></div>
						<div><?php echo sg_comments_count() . '<span>' . ((sg_comments_count() == 1) ? __('Comment', SG_TDN) : __('Comments', SG_TDN)) . '</span>'; ?></div>
					</div>
					<p><?php echo str_replace('<p>', '', str_replace('</p>', '<br />', sg_text_trim(get_the_excerpt(), 300))); ?></p>
					<a class="ef-read-more" href="<?php the_permalink(); ?>"><span><?php _e('More', SG_TDN); ?></span></a>
				</div>
			</div>
		<?php endwhile; ?>
	<?php } else {
		echo sg_message(__('Not Found', SG_TDN));
	} ?>
</div>
<?php sg_pagination($wp_query->max_num_pages); ?>
<?php get_footer(); ?>