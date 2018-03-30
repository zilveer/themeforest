<div class="post-pagination">
		
	<?php
	$prev_post = get_previous_post();
	$next_post = get_next_post();
	?>
	
	<?php if (!empty( $prev_post )) : ?>
	<div class="prev-post">
		<a href="<?php echo get_permalink( $prev_post->ID ); ?>">
		<div class="arrow">
			<i class="fa fa-angle-left"></i>
		</div>
		<div class="pagi-text">
			<span><?php _e('Previous Post', 'solopine'); ?></span>
			<h5><?php echo get_the_title( $prev_post->ID ); ?></h5>
		</div>
		</a>
	</div>
	<?php endif; ?>
	
	<?php if (!empty( $next_post )) : ?>
	<div class="next-post">
		<a href="<?php echo get_permalink( $next_post->ID ); ?>">
		<div class="arrow">
			<i class="fa fa-angle-right"></i>
		</div>
		<div class="pagi-text">
			<span><?php _e('Next Post', 'solopine'); ?></span>
			<h5><?php echo get_the_title( $next_post->ID ); ?></h5>
		</div>
		</a>
	</div>
	<?php endif; ?>
		
</div>