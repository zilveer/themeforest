<ul class="post-meta span2">
	<?php if (ct_get_option("posts_single_show_date", 1)): ?>
    <li class="date">
	    <?php echo get_the_date(); ?>
    </li>
	<?php endif; ?>

	<?php if (ct_get_option("posts_single_show_author", 1)): ?>
		<li class="author">
	        <?php _e('By', 'ct_theme');?> <span><?php the_author_posts_link() ?></span>
	    </li>
	<?php endif; ?>

	<?php if (ct_get_option("posts_single_show_comments_link", 1)): ?>
		<li class="comment">
	        <a href="<?php the_permalink()?>#comments"><?php echo wp_count_comments(get_the_ID())->approved?> <?php echo __("comments", "ct_theme");?></a>
	    </li>
	<?php endif; ?>

	<?php $cats = get_the_terms(get_the_ID(), 'category'); ?>
	<?php if (ct_get_option("posts_single_show_categories", 1) && $cats): ?>
		<li class="tags">
			<?php the_category('<br>', '', get_the_ID()) ?>
	    </li>
	<?php endif; ?>
</ul>