<div id="organique-jumbotron-slider" class="carousel  slide" data-ride="carousel" data-interval="<?php echo 0 === absint( get_theme_mod( 'front_carousel_interval', 5000 ) ) ? 'false' : absint( get_theme_mod( 'front_carousel_interval', 5000 ) ); ?>">
	<!-- Indicators -->
	<ol class="carousel-indicators">
		<?php
			$slider = new WP_Query( array(
				'post_type' => 'slider',
				'orderby' => 'menu_order',
				'order' => 'ASC',
				'nopaging' => true,
			) );
			$i = -1;
			while ( $slider->have_posts() ) :
				$slider->the_post();
				$i++;
		?>
		<li data-target="#organique-jumbotron-slider" data-slide-to="<?php echo $i; ?>"<?php echo 0 === $i ? ' class="active"': ''; ?>></li>
		<?php
			endwhile;
			wp_reset_postdata();
		?>
	</ol>

	<!-- Wrapper for slides -->
	<div class="carousel-inner">
		<?php
			$i = -1;
			while ( $slider->have_posts() ) :
				$slider->the_post();
				$i++;
		?>
		<div class="item<?php echo 0 === $i ? '  active' : ''; ?>">
			<?php the_post_thumbnail( 'jumbotron-slider' ); ?>
		</div>
		<?php
			endwhile;
			wp_reset_postdata();
		?>
	</div>

	<!-- Controls -->
	<a class="left  carousel-control" href="#organique-jumbotron-slider" data-slide="prev">
		<span class="glyphicon  glyphicon-chevron-left"></span>
	</a>
	<a class="right  carousel-control" href="#organique-jumbotron-slider" data-slide="next">
		<span class="glyphicon  glyphicon-chevron-right"></span>
	</a>
</div>