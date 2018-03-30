<?php
/*
Template Name: Homepage
*/
get_header(); ?>

	<div id="primary" class="content-area container">
		<main id="main" class="site-main row" role="main">

			<div class="col-xs-12">
			<div class="downloads">
			<?php if( function_exists( 'EDD' ))   : ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<!-- Homepage content -->
					<?php get_template_part( 'content', 'page' ); ?>

					<?php if( get_theme_mod('homelist')) : ?>

					<h4 class="text-center section-title"><?php echo get_theme_mod('homelisttitle'); ?></h4>
					
					<?php
					$number = get_theme_mod('homelistnumber');
					$category = get_theme_mod('homelistslug');

					if (get_theme_mod('homelistslug')) :
						echo do_shortcode('[downloads category="'.$category.'" number="'.$number.'"]');
					else :
						echo do_shortcode('[downloads number="'.$number.'"]');
					endif;
					endif; ?>
						
				<?php endwhile; // end of the loop. ?>
			<?php else : ?>
				<p class="lead text-center">No Products!</p>
				<p class="text-center">Please download and activate Easy Digital Downloads and start populate it.</p>
			<?php endif; ?>

			</div>
			</div>

		</main><!-- #main -->
		
		<?php if( get_theme_mod('homelabel')) : ?>
		<div class="row brand">
			<div class="col-xs-12"><h4 class="text-center section-title"><?php echo get_theme_mod('homelabeltitle'); ?></h4></div>
			<div class="col-xs-12">
				<div class="flexslider labels">
					<ul class="slides">
						<?php 
						$label = ot_get_option('label');
						if ($label) {
							foreach($label as $key => $value) {
							 	echo '<li><section>';
							 	if ($value['label_link']) {
							 		if ($value['label_img']) { 
								 		echo '<a href="'.$value['label_link'].'"><img src="'.$value['label_img'].'" alt="'.$value['title'].'" class="img-responsive" /></a>';
								 	} else {
									 	echo '<a href="'.$value['label_link'].'"><img src="http://placehold.it/300x180" /></a>';
								 	}
							 	} else {
							 		if ($value['label_img']) { 
								 		echo '<img src="'.$value['label_img'].'" alt="'.$value['title'].'" />';
								 	} else {
									 	echo '<img src="http://placehold.it/300x180" />';
								 	}
							 	}
							 	echo '</section></li>';
							} 
						} else { ?>
							<li><section><img src="//placehold.it/300x180" alt=""></section></li>
							<li><section><img src="//placehold.it/300x180" alt=""></section></li>
							<li><section><img src="//placehold.it/300x180" alt=""></section></li>
							<li><section><img src="//placehold.it/300x180" alt=""></section></li>
							<li><section><img src="//placehold.it/300x180" alt=""></section></li>
							<li><section><img src="//placehold.it/300x180" alt=""></section></li>
						<?php }
						?>
					</ul>		
				</div>
			</div>	
		</div>
		<?php endif; ?>

	</div><!-- #primary -->

<?php get_footer(); ?>