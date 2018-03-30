<?php get_header(); ?>
<div id="body-wrapper">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div id="content-wrapper">
		<div id="content">
			<div id="post-header">
				<h1 class="story-title" itemprop="name"><?php the_title(); ?></h1>
			</div><!--post-header-->
			<div class="social-sharing-top">
					<?php mvp_share_count(); ?>
					<a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>', 'facebookShare', 'width=626,height=436'); return false;" title="Share on Facebook"><div class="facebook-share"><span class="fb-but1"></span><p><?php _e( 'Share', 'mvp-text' ); ?></p></div></a>
					<a href="#" onclick="window.open('http://twitter.com/share?text=<?php the_title(); ?> -&url=<?php the_permalink() ?>', 'twitterShare', 'width=626,height=436'); return false;" title="Tweet This Post"><div class="twitter-share"><span class="twitter-but1"></span><p><?php _e( 'Tweet', 'mvp-text' ); ?></p></div></a>
					<a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); echo $thumb['0']; ?>&description=<?php the_title(); ?>', 'pinterestShare', 'width=750,height=350'); return false;" title="Pin This Post"><div class="pinterest-share"><span class="pinterest-but1"></span><p><?php _e( 'Share', 'mvp-text' ); ?></p></div></a>
					<a href="#" onclick="window.open('https://plusone.google.com/_/+1/confirm?hl=en-US&url=<?php the_permalink() ?>', 'googleShare', 'width=626,height=436'); return false;" title="Share on Google+" target="_blank"><div class="google-share"><span class="google-but1"></span><p><?php _e( 'Share', 'mvp-text' ); ?></p></div></a>
					<a href="<?php comments_link(); ?>"><div class="social-comments"><p><?php comments_number(__( '0 comments', 'mvp-text'), __('1 comment', 'mvp-text'), __('% comments', 'mvp-text'));?></p></div></a>
			</div><!--social-sharing-top-->
			<div id="content-main">
				<div id="content-main-inner">
				<div id="post-area" itemscope itemtype="http://schema.org/Article" <?php post_class(); ?>>
					<?php $mvp_featured_img = get_option('mvp_featured_img'); if ($mvp_featured_img == "true") { ?>
						<?php if(get_post_meta($post->ID, "mvp_video_embed", true)): ?>
							<?php echo get_post_meta($post->ID, "mvp_video_embed", true); ?>
						<?php else: ?>
							<?php $mvp_show_hide = get_post_meta($post->ID, "mvp_featured_image", true); if ($mvp_show_hide == "hide") { ?>
							<?php } else { ?>
								<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
								<div id="featured-image" class="post-section" itemscope itemtype="http://schema.org/Article">
									<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); ?>
									<img itemprop="image" src="<?php echo $thumb['0']; ?>" />
								</div><!--featured-image-->
								<?php if(get_post_meta($post->ID, "mvp_photo_credit", true)): ?>
								<div id="featured-caption" class="post-section">
									<?php echo get_post_meta($post->ID, "mvp_photo_credit", true); ?>
								</div><!--featured-caption-->
								<?php endif; ?>
								<?php } ?>
							<?php } ?>
						<?php endif; ?>
					<?php } ?>
					<div id="content-area" class="post-section">
  						<?php if ( wp_attachment_is_image( $post->id ) ) : $att_image = wp_get_attachment_image_src( $post->id, "large"); ?>
							<a href="<?php echo wp_get_attachment_url($post->id); ?>" title="<?php the_title(); ?>" rel="attachment"><img src="<?php echo $att_image[0];?>" class="attachment-medium" alt="<?php the_title(); ?>" /></a>
						<?php else : ?>
							<a href="<?php echo wp_get_attachment_url($post->ID) ?>" title="<?php echo esc_html( get_the_title($post->ID), 1 ) ?>" rel="attachment"><?php echo basename($post->guid) ?></a>
						<?php endif; ?>
					</div><!--content-area-->
				</div><!--post-area-->
				</div><!--content-main-inner-->
			</div><!--content-main-->
			<?php endwhile; endif; ?>
			<?php get_sidebar(); ?>
		</div><!--content-->
	</div><!--content-wrapper-->
</div><!--body-wrapper-->
<?php get_footer(); ?>