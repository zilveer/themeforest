<?php global $enable_excerpts, $show_post_date, $show_date; ?>

<div class="news-grid-wrap">
	<?php
		$issticky = "";
		if(is_sticky()){
			$issticky = 'sticky';
		};
	?>
	<a href="<?php echo get_permalink();?>" class="<?php echo esc_attr($issticky); ?>">
		<?php if(has_post_thumbnail()): ?>
			<?php the_post_thumbnail('medium'); ?>
		<?php endif; ?>
		<div class="news-grid-tab">
			<div class="tab-text">
				<?php if($show_post_date || $show_date): ?>
				<time class="datetime" datetime="<?php the_time('c'); ?>"><?php the_time( get_option('date_format') ); ?></time>
				<?php endif; ?>
				<h2 class="tab-title"><?php the_title(); ?></h2>
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
	<div class="clear"></div>
</div>