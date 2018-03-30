<div class="featured-area">
		
	<div id="owl-demo" class="owl-carousel">
		
		<?php
		
			$featured_cat = get_theme_mod( 'sp_featured_cat' );
			$number = get_theme_mod( 'sp_featured_slider_slides' );
		
		?>
		
		<?php $feat_query = new WP_Query( array( 'cat' => $featured_cat, 'showposts' => $number ) ); ?>
		<?php if ($feat_query->have_posts()) : while ($feat_query->have_posts()) : $feat_query->the_post(); ?>
			<div class="item">
				<a href="<?php echo get_permalink() ?>"><?php the_post_thumbnail('slider-thumb'); ?></a>
				
				<div class="feat-overlay">
					<div class="feat-text">
						<span class="feat-cat"><?php sp_category(', '); ?></span>
						<h3><a href="<?php echo get_permalink() ?>"><?php the_title(); ?></a></h3>
					</div>
				</div>

			</div>
		<?php endwhile; endif; ?>

	</div>
	
</div>