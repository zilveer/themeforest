<?php global $item_rel; ?>

<section id="portfolio" class="isotope">

	<?php while ( have_posts() ): the_post(); wpb_metadata(); ?>
	<?php $item_link = wpb_portfolio_link(); ?>

	<div class="isotope-item <?php echo wpb_portfolio_classes(); ?>">
		<article class="portfolio-item">
			<a class="portfolio-thumbnail" href="<?php echo $item_link; ?>" title="<?php the_title_attribute(); ?>" <?php echo $item_rel; ?>>	
				
				<?php if (has_post_thumbnail()): ?>			
					<?php $img = wp_get_attachment_image_src(get_post_thumbnail_id(),'thumbnail-portfolio'); ?>
					<img src="<?php echo $img[0]; ?>" alt="<?php the_title() ;?>" />								
				<?php else: ?>			
					<img src="<?php echo get_template_directory_uri(); ?>/img/placeholder.png" alt="<?php the_title() ;?>" />			
				<?php endif; ?>

				<?php if (wpb_meta('_portfolio_video')): ?><span class="play"></span><?php endif; ?>		
				<span class="glass"></span>
				
			</a>
			
			<?php if (!wpb_option('hide-meta-portfolio')): ?>
			<a class="portfolio-meta" href="<?php echo wpb_meta('_link', get_permalink()); ?>">
				<h4 class="portfolio-title"><?php the_title(); ?></h4>
				<span class="portfolio-category"><?php echo air_portfolio::get_category_list(); ?></span>
			</a>
			<?php endif; ?>
			
		</article>
	</div><!--/.isotope-item-->
	<?php endwhile; ?>
	
	<div class="clear"></div>
</section>