<?php
/**
 * The template used for displaying portfolio post content
 *
 * @package progression
 * @since progression 1.0
 */
?>
<div class="portfolio-content-container aligncenter">
		
		<div class="item-portfolio-image">
			<?php if( has_post_format( 'gallery' ) ): ?>
				<div class="blog-post-image">
					<div class="flexslider gallery-progression">
			      	<ul class="slides">
						<?php
						$args = array(
						    'post_type' => 'attachment',
						    'numberposts' => '-1',
						    'post_status' => null,
						    'post_parent' => $post->ID,
							'orderby' => 'menu_order',
							'order' => 'ASC'
						);
						$attachments = get_posts($args);
						?>
						<?php 
						if($attachments):
						    foreach($attachments as $attachment):
						?>
						<?php $thumbnail = wp_get_attachment_image_src($attachment->ID, 'progression-portfolio-thumb'); ?>
						<?php $image = wp_get_attachment_image_src($attachment->ID, 'large'); ?>
						<li><a href="<?php echo $image[0]; ?>" rel="prettyPhoto[portfolio-gallery]" class="hover-icon"><img src="<?php echo $thumbnail[0]; ?>" alt="gallery-image" /></a></li>
						<?php endforeach; endif; ?>
					</ul>
					</div>
				</div>
			<?php else: ?>
				<?php if(has_post_thumbnail()): ?>
					<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large'); ?>
			
					<?php if(get_post_meta($post->ID, 'portfoliooptions_externallink', true)): ?>
						<a href="<?php echo get_post_meta($post->ID, 'portfoliooptions_externallink', true) ?>">
					<?php else: ?>
				
					<?php if(get_post_meta($post->ID, 'portfoliooptions_lightbox', true)): ?>
						<a href="<?php echo get_post_meta($post->ID, 'portfoliooptions_lightbox', true) ?>" rel="prettyPhoto[portfolio-gallery]" class="hover-icon">
					<?php else: ?>
						<a href="<?php echo $image[0]; ?>" rel="prettyPhoto[portfolio-gallery]" class="hover-icon">
					<?php endif; ?>
					<?php endif; ?>
						<?php the_post_thumbnail('progression-portfolio-thumb'); ?></a>
				<?php else: ?>
					<?php if(get_post_meta($post->ID, 'portfoliooptions_videoembed', true)): ?>
						<!-- iFrame Video Here --><div class="video-container"><?php echo get_post_meta($post->ID, 'portfoliooptions_videoembed', true) ?></div>
					<?php endif; ?>
				<?php endif; ?>
			<?php endif; ?>
		</div>
		<div class="portfolio-post-background">
			<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
			<p><?php echo get_the_excerpt(); ?></p>
		</div>
</div><!-- close .content-container -->