<?php
/**
 * @package progression
 */
?>

	<div class="portfolio-single-progression">
		
		<?php if(get_post_meta($post->ID, 'progression_remove_image', true)): ?><?php else: ?>
		<?php if(get_post_meta($post->ID, 'progression_media_embed', true)): ?>
			<div class="featured-image-portfolio-single">
				<div class="featured-video-single"><?php echo apply_filters('the_content', get_post_meta($post->ID, 'progression_media_embed', true)); ?></div>
			</div>
		<?php else: ?>
		<?php if( has_post_format( 'gallery' ) ): ?>
			<div class="featured-image-portfolio-single">
				<div class="flexslider gallery-progression">
		      	<ul class="slides">
					<?php
					$args = array(
					    'post_type' => 'attachment',
					    'numberposts' => '-1',
					    'post_status' => null,
					    'post_parent' => $post->ID,
						'post_mime_type' => 'image', // <----- this one is added by me
						'orderby' => 'menu_order',
						'order' => 'ASC'
					);
					$attachments = get_posts($args);
					?>
					<?php 
					if($attachments):
					    foreach($attachments as $attachment):
					?>
					<?php $thumbnail = wp_get_attachment_image_src($attachment->ID, 'progression-portfolio-single'); ?>
					<?php $image = wp_get_attachment_image_src($attachment->ID, 'large'); ?>
					<li><a href="<?php echo $image[0]; ?>" rel="prettyPhoto[gallery]"><img src="<?php echo $thumbnail[0]; ?>" alt="<?php echo $attachment->post_title; ?>" /></a></li>
					<?php endforeach; endif; ?>
				</ul>
				</div>
			</div>
		<?php else: ?>
			
			<?php if(has_post_thumbnail()): ?>
				<div class="featured-image-portfolio-single">
					<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large'); ?>
					<a href="<?php echo $image[0]; ?>" rel="prettyPhoto">
						<?php the_post_thumbnail('progression-portfolio-single'); ?>
					</a>
				</div>
			<?php endif; ?>	<!-- close post_thumbnail -->
		
		<?php endif; ?>
		
		<?php endif; ?> <!-- close media_embed option -->
		<?php endif; ?> 
	</div>

<div class="width-container">
<div id="portfolio-index">	
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<div class="portfolio-post-content">
		<?php the_content(); ?>
		
		<div id="backto-portfolio">
				<?php 
				$terms = get_the_terms( $post->ID , 'portfolio_type' ); 
		       
			   	if ( !empty( $terms ) ) :
			   	foreach ( $terms as $term ) {
		            $term_link = get_term_link( $term, 'portfolio_type' );
		            if( is_wp_error( $term_link ) )
		            continue;
		       	 	echo '<a href="' . $term_link . '" class="progression-button">' . __( 'Back to Portfolio', 'progression' ) . '</a>';
				    break;
				    unset($term);
		        } 
				endif;
		    	?>

		</div><!-- close #backto-portfolio -->
		<div class="clearfix"></div>
	</div>
	
	<div class="clearfix"></div>
</article><!-- #post-## -->
</div><!-- close #portfolio-index -->
</div><!-- close .width-container -->