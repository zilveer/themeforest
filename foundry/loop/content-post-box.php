<div class="masonry-item col-md-4 col-sm-6">
	<div class="feature bg-secondary p32 pt40 pb40 mb0">
	
		<span class="fade-1-4 mb16 display-block"><?php the_time('F j, Y'); ?> <?php _e('in','foundry'); ?> <?php the_category(', '); ?></span>
		
		<?php the_title('<h4 class="mb120">', '</h4>'); ?>
		
		<a href="<?php the_permalink(); ?>" class="mb0 right">
			<h6 class="uppercase mb0 color-primary fade-on-hover"><?php _e('Read Story','foundry'); ?> <i class="ti-arrow-right"></i></h6>
		</a>
		
	</div>
</div>