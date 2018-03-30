<?php global $enable_excerpts, $show_post_date, $show_date; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('media-block'); ?>>
		<div class="holder">
			<?php if(has_post_thumbnail()): ?>
				<a href="<?php the_permalink(); ?>" class="image"><?php the_post_thumbnail( 'large' ); ?></a>
			<?php else :?>
				<div class="image empty"></div>
			<?php endif; ?>
			<div class="text-box<?php if(!has_post_thumbnail()){ echo " empty"; }?>">
			
				<a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
				
				<div class="classic-meta">
				<?php if($show_post_date || $show_date): ?>
				<time class="datetime" datetime="<?php the_time('c'); ?>"><?php the_time( get_option('date_format') ); ?> <?php echo __('by', IRON_TEXT_DOMAIN); ?> <a class="meta-author-link" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a></time>
				<?php endif; ?>
				</div>
				
				<?php if($enable_excerpts): ?>
					<div class="excerpt">
						<?php the_excerpt(); ?>
					</div>
					<a href="<?php the_permalink(); ?>" class="readmore-classic"><?php echo __('Read more', IRON_TEXT_DOMAIN); ?></a>
				<?php endif; ?>
				<div class="stickypost">
					<i class="fa fa-star"></i>
				</div>
			</div>
		</div>
</article>
