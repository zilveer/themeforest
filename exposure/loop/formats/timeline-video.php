<?php
	$video_url = thb_get_post_meta( get_the_ID(), 'video_url' );
?>

<header class="item-header">
	<h1>
		<a href="<?php the_permalink(); ?>" rel="permalink"><?php the_title(); ?></a>
	</h1>
</header>

<footer class="item-footer">
	<time pubdate class="pubdate">
		<?php echo get_the_date(); ?>
	</time>
</footer>

<div class="thb-timeline-video-wrapper">
	<?php if( !empty($video_url) ) : ?>
		<?php echo do_shortcode('[thb_video url="'. $video_url .'"]'); ?>
	<?php endif; ?>
</div>

<?php if( get_the_excerpt() != '' ) : ?>
	<div class="thb-text">
		<?php the_excerpt(); ?>
	</div>
<?php endif; ?>

<a class="thb-btn readmore" href="<?php the_permalink(); ?>"><?php _e('Read', 'thb_text_domain'); ?></a>