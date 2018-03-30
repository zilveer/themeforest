<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php if(get_post_meta($post->ID, 'videoembed_videoembed', true)): ?>
		<div class="blog-post-image video-post-image"><?php echo get_post_meta($post->ID, 'videoembed_videoembed', true) ?></div>
	<?php else: ?>
		
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
					<?php $thumbnail = wp_get_attachment_image_src($attachment->ID, 'progression-blog'); ?>
					<?php $image = wp_get_attachment_image_src($attachment->ID, 'large'); ?>
					<li><a href="<?php the_permalink(); ?>"><img src="<?php echo $thumbnail[0]; ?>" alt="gallery-image" /></a></li>
					<?php endforeach; endif; ?>
				</ul>
				</div>
			</div>
		<?php else: ?>
		
		<?php if(has_post_thumbnail()): ?>
		<div class="blog-post-image">
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail('progression-blog'); ?>
		</a>
		</div>
		<?php endif; ?>
		<?php endif; ?>
	<?php endif; ?>
	<div class="blog-post-background">
	<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	<div class="post-details-meta"><?php progression_posted_on(); ?></div><!-- close .blog-post-details -->
	<div class="blog-post-excerpt">
		<?php the_content( __( '<p class="rock-button">Read more</p>', 'progression' ) ); ?>
	</div><!-- close .blog-post-excerpt -->	
	<?php the_tags('<!--div class="tag-cloud">Tag Cloud: ', ', ', '</div></div-->'); ?>
	</div><!-- close .blog-post-background -->
</div><!-- #post-<?php the_ID(); ?> -->