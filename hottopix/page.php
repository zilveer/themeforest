<?php get_header(); ?>

<div id="main">
	<div id="content-wrapper">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="breadcrumb">
			<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
		</div><!--breadcrumb-->
		<div id="title-main">
			<h1 class="headline-page"><?php the_title(); ?></h1>
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
		<div id="home-main">
			<div id="post-area" <?php post_class(); ?>>
				<div id="content-area">
					<?php the_content(); ?>
					<?php wp_link_pages(); ?>
				</div><!--content-area-->
			</div><!--post-area-->
		</div><!--home-main-->
		<?php endwhile; endif; ?>
	</div><!--mvp-cont-in-->
<?php get_sidebar(); ?>
</div><!--mvp-cont-out-->
<?php get_footer(); ?>