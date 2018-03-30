<a href="<?php the_permalink(); ?>" class="item-thumb" title="<?php echo get_the_title(); ?>">
	<div class="thb-overlay">
		<header class="item-header">
			<h1>
				<?php the_title(); ?>
			</h1>
		</header>
	</div>

	<?php if( !empty($work_featured_image) ) : ?>
		<img src="<?php echo $work_featured_image; ?>" alt="">
	<?php endif; ?>
</a>