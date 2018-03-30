<?php
/**
 * @package progression
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<div class="portfolio-index-pro">

		<div class="featured-image-portfolio">
		<?php if(has_post_thumbnail()): ?>
			
				<?php if( has_post_format( 'link' ) ): ?><a href="<?php echo get_post_meta($post->ID, 'progression_external_link', true) ?>">
				<?php else: ?><a href="<?php the_permalink(); ?>"><?php endif; ?>
					<?php the_post_thumbnail('progression-portfolio-thumb'); ?>
				</a>
		<?php else: ?>
			
			<?php if( has_post_format( 'gallery' ) ): ?>
					<div class="flexslider gallery-progression">
			      	<ul class="slides">
						<?php
						$args = array(
						    'post_type' => 'attachment',
						    'showposts' => '99',
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
						<?php $thumbnail = wp_get_attachment_image_src($attachment->ID, 'progression-portfolio-thumb'); ?>
						<li><a href="<?php the_permalink(); ?>"><img src="<?php echo $thumbnail[0]; ?>" alt="<?php echo $attachment->post_title; ?>" /></a></li>
						<?php endforeach; endif; ?>
					</ul>
					</div>
			<?php else: ?>
			
			<?php if(get_post_meta($post->ID, 'progression_media_embed', true)): ?>
					<div class="video-pro-portfolio"><?php echo apply_filters('the_content', get_post_meta($post->ID, 'progression_media_embed', true)); ?></div>
					
					<!--img src="<?php echo get_template_directory_uri(); ?>/images/blank-portfolio.png" class="filler-pro"-->
			<?php endif; ?> <!-- close media_embed option -->
			
			<?php endif; ?>
		<?php endif; ?>	<!-- close post_thumbnail -->
		
		</div>
		
		<div class="portfolio-index-text<?php if(get_post_meta($post->ID, 'progression_media_embed', true)): ?> video-portfolio-pro<?php endif; ?><?php if(has_post_thumbnail()): ?><?php else: ?><?php if( has_post_format( 'gallery' ) ): ?><?php else: ?><?php if(get_post_meta($post->ID, 'progression_media_embed', true)): ?><?php else: ?> no-image-pro<?php endif; ?><?php endif; ?><?php endif; ?>">
			<div class="portfolio-index-padding">
				<h4 class="portfolio-index-title">
					<?php if( has_post_format( 'link' ) ): ?><a href="<?php echo get_post_meta($post->ID, 'progression_external_link', true) ?>">
					<?php else: ?><a href="<?php the_permalink(); ?>"><?php endif; ?>
						<?php the_title(); ?>
					</a>
				</h4>
					<div class="meta-progression-port">
						<ul>
						<?php $terms = get_the_terms( $post->ID , 'portfolio_type' ); 
			        
					if ( !empty( $terms ) ) :
					foreach ( $terms as $term ) {
			            $term_link = get_term_link( $term, 'portfolio_type' );
			            if( is_wp_error( $term_link ) )
			            continue;
			        	echo '<li><a href="' . $term_link . '">' . $term->name . '</a> <i class="fa fa-asterisk"></i> </li>';
			        } 
					endif;
			    ?></ul></div>
			</div>
		</div><!-- close .portfolio-index-text -->
	<div class="clearfix"></div>
	</div>
</article><!-- #post-## -->