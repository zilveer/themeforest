<?php get_header(); ?>
<?php global $author; $userdata = get_userdata($author); ?>
<div id="post-main-wrap" class="left relative" itemscope itemtype="http://schema.org/Article">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post-wrap-out1">
			<div class="post-wrap-in1">
				<div id="post-left-col" class="relative">
					<article id="post-area" <?php post_class(); ?>>
						<div id="post-header">
							<h1 class="post-title left" itemprop="name headline"><?php the_title(); ?></h1>
						</div><!--post-header-->
						<div id="content-area" itemprop="articleBody" <?php post_class(); ?>>
							<div id="content-main" class="left relative">
								<?php $socialbox = get_option('mvp_social_box'); if ($socialbox == "true") { ?>
									<div class="social-sharing-top">
										<?php mvp_share_count(); ?>
										<a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>', 'facebookShare', 'width=626,height=436'); return false;" title="Share on Facebook"><div class="facebook-share"><span class="fb-but1"><i class="fa fa-facebook fa-2"></i></span><span class="social-text"><?php _e( 'Share', 'mvp-text' ); ?></span></div></a>
										<a href="#" onclick="window.open('http://twitter.com/share?text=<?php the_title(); ?> -&url=<?php the_permalink() ?>', 'twitterShare', 'width=626,height=436'); return false;" title="Tweet This Post"><div class="twitter-share"><span class="twitter-but1"><i class="fa fa-twitter fa-2"></i></span><span class="social-text"><?php _e( 'Tweet', 'mvp-text' ); ?></span></div></a>
										<a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); echo esc_url($thumb['0']); ?>&description=<?php the_title(); ?>', 'pinterestShare', 'width=750,height=350'); return false;" title="Pin This Post"><div class="pinterest-share"><span class="pinterest-but1"><i class="fa fa-pinterest-p fa-2"></i></span><span class="social-text"><?php _e( 'Share', 'mvp-text' ); ?></span></div></a>
									</div><!--social-sharing-top-->
								<?php } ?>
  								<?php if ( wp_attachment_is_image( $post->id ) ) : $att_image = wp_get_attachment_image_src( $post->id, "post"); ?>
									<a href="<?php echo esc_url(wp_get_attachment_url($post->id)); ?>" title="<?php the_title(); ?>" rel="attachment"><img src="<?php echo esc_url( $att_image[0] );?>" class="attachment-post" alt="<?php the_title(); ?>" /></a>
								<?php else : ?>
									<a href="<?php echo esc_url(wp_get_attachment_url($post->ID)); ?>" title="<?php echo esc_html( get_the_title($post->ID), 1 ) ?>" rel="attachment"><?php echo esc_html(basename($post->guid)); ?></a>
								<?php endif; ?>
							</div><!--content-main-->
						</div><!--content-area-->
					</article>
				</div><!--post-left-col-->
			</div><!--post-wrap-in1-->
			<div id="post-right-col" class="relative">
				<?php if(get_option('mvp_post_side') == 'Latest') { ?>
					<?php get_template_part('latest'); ?>
				<?php } else if(get_option('mvp_post_side') == 'Popular') { ?>
					<?php get_template_part('popular'); ?>
				<?php } else { ?>
					<?php get_sidebar(); ?>
				<?php } ?>
			</div><!--post-right-col-->
		</div><!--post-wrap-out1-->
	<?php endwhile; endif; ?>
</div><!--post-main-wrap-->
<?php get_footer(); ?>