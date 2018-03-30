<?php get_header(); ?>
	<?php

	$portfolio_slide = get_post_meta($post->ID,'vsc_slider_repeat',true);
	$port_more_images = get_post_meta($post->ID, 'vsc_more_images_block', true);
	
	?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<div id="main-content">
		<div class="container inner">

				<section class="portfolio-single">
				
					<div class="portfolio-navigation">
						<h2 class="aligncenter">
							<?php next_post_link('<span class="next">%link</span>', '<i class="icon icon-arrows-03"></i>'); ?>
							<?php the_title(); ?>	
							<?php previous_post_link('<span class="prev">%link</span>', '<i class="icon icon-arrows-04"></i>'); ?>
						</h2>
					</div>
					
					<article id="post-<?php the_ID(); ?>" class="begin-content">
						<?php the_content(); ?>
					</article>
					
				</section>

				<div class="clear"></div>
		</div>
	</div>

	<?php endwhile; endif; ?>

<?php get_footer(); ?>
