<?php get_header(); ?>

<?php global $author; $userdata = get_userdata($author); ?>

<div id="main">
	<div id="content-wrapper">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="breadcrumb">
			<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
		</div><!--breadcrumb-->
		<div id="title-main">
			<h1 class="headline"><?php the_title(); ?></h1>
			<span class="post-byline"><?php _e( 'By', 'mvp-text' ); ?> <?php the_author_posts_link(); ?> <?php _e( 'on', 'mvp-text' ); ?> <?php the_time(get_option('date_format')); ?></span><?php $authordesc = get_the_author_meta( 'twitter' ); if ( ! empty ( $authordesc ) ) { ?><span class="twitter-byline"><a href="http://www.twitter.com/<?php the_author_meta('twitter'); ?>" target="blank">@<?php the_author_meta('twitter'); ?></a></span><?php } ?>
			<?php $ht_socialbox = get_option('ht_socialbox'); if ($ht_socialbox == "true") { ?>
				<div class="social-sharing-top">
					<?php mvp_share_count(); ?>
					<a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>', 'facebookShare', 'width=626,height=436'); return false;" title="Share on Facebook"><div class="facebook-share"><span class="fb-but1"></span><p><?php _e( 'Share', 'mvp-text' ); ?></p></div></a>
					<a href="#" onclick="window.open('http://twitter.com/share?text=<?php the_title(); ?> -&url=<?php the_permalink() ?>', 'twitterShare', 'width=626,height=436'); return false;" title="Tweet This Post"><div class="twitter-share"><span class="twitter-but1"></span><p><?php _e( 'Tweet', 'mvp-text' ); ?></p></div></a>
					<a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); echo $thumb['0']; ?>&description=<?php the_title(); ?>', 'pinterestShare', 'width=750,height=350'); return false;" title="Pin This Post"><div class="pinterest-share"><span class="pinterest-but1"></span><p><?php _e( 'Share', 'mvp-text' ); ?></p></div></a>
					<a href="#" onclick="window.open('https://plusone.google.com/_/+1/confirm?hl=en-US&url=<?php the_permalink() ?>', 'googleShare', 'width=626,height=436'); return false;" title="Share on Google+" target="_blank"><div class="google-share"><span class="google-but1"></span><p><?php _e( 'Share', 'mvp-text' ); ?></p></div></a>
					<a href="<?php comments_link(); ?>"><div class="social-comments"><p><?php comments_number(__( '0 comments', 'mvp-text'), __('1 comment', 'mvp-text'), __('% comments', 'mvp-text'));?></p></div></a>
				</div><!--social-sharing-top-->
			<?php } ?>
		</div><!--title-main-->
		<div class="mvp-cont-out">
			<div class="mvp-cont-in">
		<?php $mvp_post_temp = get_post_meta($post->ID, "mvp_post_template", true); if ($mvp_post_temp == "fullwidth") { ?>
		<?php } else { ?>
		<div id="home-main">
		<?php } ?>
			<div id="post-area" <?php post_class(); ?>>
				<div id="content-area">
					<?php $ht_featured_img = get_option('ht_featured_img'); if ($ht_featured_img == "true") { ?>
						<?php if(get_post_meta($post->ID, "mvp_video_embed", true)): ?>
							<?php echo get_post_meta($post->ID, "mvp_video_embed", true); ?>
						<?php else: ?>
							<?php $mvp_show_hide = get_post_meta($post->ID, "mvp_featured_image", true); if ($mvp_show_hide == "hide") { ?>
							<?php } else { ?>
								<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { /* if post has a thumbnail */ ?>
								<div class="post-image">
									<?php $mvp_post_temp = get_post_meta($post->ID, "mvp_post_template", true); if ($mvp_post_temp == "fullwidth") { ?>
										<?php the_post_thumbnail(''); ?>
									<?php } else { ?>
										<?php the_post_thumbnail('post-thumb'); ?>
									<?php } ?>
									<?php if(get_post_meta($post->ID, "mvp_photo_credit", true)): ?>
										<div id="featured-caption">
											<?php echo get_post_meta($post->ID, "mvp_photo_credit", true); ?>
										</div><!--featured-caption-->
									<?php endif; ?>
								</div><!--post-image-->
								<?php } ?>
							<?php } ?>
						<?php endif; ?>
					<?php } ?>
					<?php the_content(); ?>
					<?php wp_link_pages(); ?>
					<?php if(get_option('ht_article_ad')) { ?>
						<div id="article-ad">
							<?php $articlead = get_option('ht_article_ad'); if ($articlead) { echo stripslashes($articlead); } ?>
						</div><!--article-ad-->
					<?php } ?>
				</div><!--content-area-->
				<?php $author = get_option('ht_author_box'); if ($author == "true") { ?>
				<div id="author-info">
					<?php echo get_avatar( get_the_author_meta('email'), '60' ); ?>
					<div id="author-text">
						<?php the_author_meta('description'); ?>
					</div><!--author-text-->
				</div><!--author-info-->
				<?php } ?>
				<div class="post-tags">
					<span class="post-tags-header"><?php _e( 'Related Items', 'mvp-text' ); ?></span><?php the_tags('','','') ?>
				</div><!--post-tags-->
			</div><!--post-area-->
			<?php $ht_prev_next = get_option('ht_prev_next'); if ($ht_prev_next == "true") { ?>
			<div class="prev-next-wrapper">
				<div class="prev-post">
					<?php previous_post_link('&larr; '.__('Previous Story', 'mvp-text').' %link', '%title', TRUE); ?>
				</div><!--prev-post-->
				<div class="next-post">
					<?php next_post_link(''.__('Next Story', 'mvp-text').' &rarr; %link', '%title', TRUE); ?>
				</div><!--next-post-->
			</div><!--prev-next-wrapper-->
			<?php } ?>
			<?php getRelatedPosts(); ?>
			<?php comments_template(); ?>
		<?php $mvp_post_temp = get_post_meta($post->ID, "mvp_post_template", true); if ($mvp_post_temp == "fullwidth") { ?>
		<?php } else { ?>
		</div><!--home-main-->
		<?php } ?>
		<?php endwhile; endif; ?>
		</div><!--mvp-cont-in-->
<?php $mvp_post_temp = get_post_meta($post->ID, "mvp_post_template", true); if ($mvp_post_temp == "fullwidth") { ?>
<?php } else { ?>
	<?php get_sidebar(); ?>
<?php } ?>
</div><!--mvp-cont-out-->
<?php get_footer(); ?>