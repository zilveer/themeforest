<div id="system">
	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
	<article class="item" data-permalink="<?php the_permalink(); ?>">
		<header>
			<h1 class="title">
				<?php the_title(); ?>
				<span class="article-dash"></span></h1>
			<p class="meta clearfix"> <span class="meta_author_date">
				<?php 
                    $date = '<time datetime="'.get_the_date('Y-m-d').'" pubdate>'.get_the_date().'</time>';
                    printf(__('Written by %s on %s. Posted in %s', 'warp'), '<a href="'.get_author_posts_url(get_the_author_meta('ID')).'" title="'.get_the_author().'">'.get_the_author().'</a>', $date, get_the_category_list(', '));
                ?>
				</span> <span class="comment-link">
				<?php comments_popup_link(__('No Comments', 'warp'), __('1 Comment', 'warp'), __('% Comments', 'warp'), "", ""); ?>
				</span> </p>
		</header>
		<?php if (has_post_thumbnail()) : ?>
		<div class="post-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
		<?php endif; ?>
		<div class="content clearfix">
			<?php the_content(''); ?>
		</div>
		<div class="meta-bottom clearfix">
			<?php edit_post_link(__('Edit this post', 'warp'), '<span class="edit-entry">','</span>'); ?>
			<?php if (pings_open()) : ?>
			<span class="trackback"><?php printf(__('<a href="%s">Trackback</a> from your site.', 'warp'), get_trackback_url()); ?></span>
			<?php endif; ?>
		</div>
		<div class="meta-tags clearfix">
			<?php the_tags('<p class="taxonomy">'.__('Tags: ', 'warp'), '', '</p>'); ?>
		</div>
		<?php if (get_the_author_meta('description')) : ?>
		<section class="author-box clearfix">
			<div class="author-avatar"> <?php echo get_avatar(get_the_author_meta('user_email'),96); ?></div>
			<div class="author-meta">
				<div class="author-name-social clearfix">
					<h3 class="name">
						<?php the_author(); ?>
					</h3>
					<div class="author-social">
						<?php if(get_the_author_meta('twitter')) : ?>
						<a class="button-default" href="<?php the_author_meta('twitter'); ?>" title="Twitter"><img src="<?php echo get_template_directory_uri(); ?>/images/twitter.png" alt="Twitter" /></a>
						<?php endif; ?>
						<?php if(get_the_author_meta('facebook')) : ?>
						<a class="button-default" href="<?php the_author_meta('facebook'); ?>" title="Facebook"><img src="<?php echo get_template_directory_uri(); ?>/images/facebook.png" alt="Facebook" /></a>
						<?php endif; ?>
						<?php if(get_the_author_meta('googleplus')) : ?>
						<a class="button-default" href="<?php the_author_meta('googleplus'); ?>" title="Google Plus"><img src="<?php echo get_template_directory_uri(); ?>/images/google-plus.png" alt="Google Plus" /></a>
						<?php endif; ?>
						<?php if(get_the_author_meta('linkedin')) : ?>
						<a class="button-default" href="<?php the_author_meta('linkedin'); ?>" title="Linked In"><img src="<?php echo get_template_directory_uri(); ?>/images/linkedin.png" alt="Linked In" /></a>
						<?php endif; ?>
						<?php if(get_the_author_meta('flickr')) : ?>
						<a class="button-default" href="<?php the_author_meta('flickr'); ?>" title="Flickr"><img src="<?php echo get_template_directory_uri(); ?>/images/flickr.png" alt="Flickr" /></a>
						<?php endif; ?>
					</div>
				</div>
				<div class="description">
					<?php the_author_meta('description'); ?>
				</div>
			</div>
		</section>
		<?php endif; ?>
		<?php comments_template(); ?>
	</article>
	<?php endwhile; ?>
	<?php endif; ?>
</div>
