<?php get_header(); ?>
<div id="body-wrapper">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div id="content-wrapper">
		<div id="content">
			<div id="post-header">
				<h1 class="story-title" itemprop="name"><?php the_title(); ?></h1>
			</div><!--post-header-->
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
						<?php the_content(); ?>
						<?php wp_link_pages(); ?>
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