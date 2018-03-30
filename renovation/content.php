<?php
/**
 * @package progression
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="container-blog">
		<?php if( has_post_format( 'gallery' ) ): ?>
			<div class="featured-blog-progression">
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
				<?php $thumbnail = wp_get_attachment_image_src($attachment->ID, 'progression-blog'); ?>
				<li><?php if( has_post_format( 'link' ) ): ?><a href="<?php echo get_post_meta($post->ID, 'progression_external_link', true) ?>">
			<?php else: ?><a href="<?php the_permalink(); ?>"><?php endif; ?><img src="<?php echo $thumbnail[0]; ?>" alt="<?php echo $attachment->post_title; ?>" /></a></li>
				<?php endforeach; endif; ?>
			</ul>
			</div>
			</div>
		<?php else: ?>
		<?php if(has_post_thumbnail()): ?>
			<div class="featured-blog-progression">
				<?php if( has_post_format( 'link' ) ): ?><a href="<?php echo get_post_meta($post->ID, 'progression_external_link', true) ?>">
				<?php else: ?><a href="<?php the_permalink(); ?>"><?php endif; ?>
					<?php the_post_thumbnail('progression-blog'); ?>
				</a>
			</div>
			<?php else: ?>
			<?php if(get_post_meta($post->ID, 'progression_media_embed', true)): ?>
				<div class="featured-blog-progression">
				<div class="featured-video-progression">
					<?php echo apply_filters('the_content', get_post_meta($post->ID, 'progression_media_embed', true)); ?>
				</div>
				</div>
			<?php endif; ?> <!-- close media_embed option -->
		<?php endif; ?>
		<?php endif; ?>
		
		<div class="pro-cat"><?php progression_posted_on(); ?></div>
		
		<h2 class="blog-title">
			<?php if( has_post_format( 'link' ) ): ?><a href="<?php echo get_post_meta($post->ID, 'progression_external_link', true) ?>">
			<?php else: ?><a href="<?php the_permalink(); ?>"><?php endif; ?>
			<?php the_title(); ?>
			</a>
		</h2>
	
		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="meta-progression"><span class="author-meta-pro"><?php _e( 'By', 'progression' ); ?> <?php the_author_posts_link(); ?></span> / <span class="category-meta-pro"><?php the_category(', '); ?></span> / <span class="comment-meta-pro"><?php comments_popup_link( '' . __( 'No Comments', 'progression' ) . '', _x( '1 Comment', 'comments number', 'progression' ), _x( '% Comments', 'comments number', 'progression' ) ); ?></span>
		
		</div>
		<?php endif; ?>

		<div class="blog-container-text">
			<?php if ( is_search() ) : // Only display Excerpts for Search ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
			<?php else : ?>
			<div class="entry-content">	
	
				
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'progression' ) ); ?>
				
				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'progression' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->
			<?php endif; ?>
		</div><!-- close .blog-container-text -->

	</div>
</article>