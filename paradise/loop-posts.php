<?php
	$_readmore_text = get_option('blog_more_text');
	do {
?>
				<!-- Start Post -->
				<div class="post">
					<!-- Start Post Title -->
					<div class="post_title_wrap">
						<!-- Start Post Date -->
						<div class="post_date">
							<span class="day"><?php echo get_the_date('d'); ?></span>
							<span class="month"><?php echo get_the_date('M'); ?></span>
						</div>
						<div class="post_title">
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<!-- Posted When, Where &amp; Comments -->
							<div class="posted">
								<div class="alignright"><a href="<?php echo get_comments_link(); ?>" title="<?php comments_number(); ?>"><?php comments_number(); ?> &raquo;</a></div>
								<?php _e('Posted By:', TEMPLATENAME); ?>&nbsp;<?php printf('<a href="%1$s" title="%2$s">%3$s</a>', get_author_posts_url(get_the_author_meta('ID')), sprintf(esc_attr__('View all posts by %s', TEMPLATENAME), get_the_author()), get_the_author()); ?>&nbsp;<?php _e('on', TEMPLATENAME); ?>&nbsp;<?php echo get_the_time('M d, Y'); ?>&nbsp;<?php _e('in', TEMPLATENAME); ?>&nbsp;<?php if (count(get_the_category())): ?><?php echo get_the_category_list(', '); ?><?php endif; ?>
							</div>
						</div>
						<div class="clear"></div>
					</div>
					<!-- End Post Title -->
					<?php if(has_post_thumbnail()): ?>
					<!-- Post Thumbnail -->
					<div class="post_thumb"><?php the_post_thumbnail('blog', array('title' => false, 'class' => 'pic')); ?></div>
					<!-- End Post Thumbnail -->
					<?php endif; ?>
					<!-- Post Excerpt -->
					<?php the_excerpt(); ?>
					<!-- Read More Btn -->
					<?php if (!empty($_readmore_text)): ?>
					<a href="<?php the_permalink(); ?>" class="btn" title="<?php echo $_readmore_text; ?>"><?php echo $_readmore_text; ?></a>
					<?php endif; ?>
					<div class="clear"></div>
				</div>
				<!-- End Post -->
<?php
	if (!have_posts())
		break;
	the_post();
	} while (1);
?>
				<?php /* Display navigation to next/previous pages when applicable */
				if ($wp_query->max_num_pages > 1): ?>
				<!-- Start Paging -->
					<?php	if (function_exists('wp_pagenavi')):
							echo wp_pagenavi();
					else: ?>
				<div class="navigation" id="nav-below">
					<div class="nav-previous"><?php next_posts_link(__('<span class="meta-nav">&larr;</span> Older posts', TEMPLATENAME)); ?></div>
					<div class="nav-next"><?php previous_posts_link(__('Newer posts <span class="meta-nav">&rarr;</span>', TEMPLATENAME)); ?></div>
				</div><!-- #nav-below -->
					<?php endif; ?>
				<div class="clear"></div>
				<!-- End Paging -->
				<?php endif; ?>
