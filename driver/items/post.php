<?php global $enable_excerpts, $show_post_date, $show_date; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('media-block'); ?>>
	<a href="<?php the_permalink(); ?>">
		<div class="holder">
			<?php if(has_post_thumbnail()): ?>
			<div class="image"><?php the_post_thumbnail( 'medium' ); ?></div>
			<?php else :?>
			<div class="image empty"></div>
			<?php endif; ?>
			<div class="text-box<?php if(!has_post_thumbnail()){ echo " empty"; }?>">
			
				<?php if($show_post_date || $show_date): ?>
				<time class="datetime" datetime="<?php the_time('c'); ?>"><?php the_time( get_option('date_format') ); ?></time>
				<?php endif; ?>
				
				<h2><?php the_title(); ?></h2>
				<?php if($enable_excerpts): ?>
				<div class="excerpt">
					<?php the_excerpt(); ?>
				</div>
				<?php endif; ?>
				
				<div class="stickypost">
					<i class="fa fa-star"></i>
				</div>
			</div>
		</div>
	</a>
</article>
