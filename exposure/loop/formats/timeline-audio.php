<?php
	$post_featured_image = thb_get_post_thumbnail_src(get_the_ID(), 'portfolio-thumb');
	$audio_url = thb_get_post_meta( get_the_ID(), 'audio_url' );
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

<?php if( !empty($audio_url) ) : ?>
	<?php echo thb_do_shortcode('[thb_audio src="'. $audio_url .'"]'); ?>
<?php endif; ?>

<?php if( get_the_excerpt() != '' ) : ?>
	<div class="thb-text">
		<?php the_excerpt(); ?>
	</div>
<?php endif; ?>

<a class="thb-btn readmore" href="<?php the_permalink(); ?>"><?php _e('Read', 'thb_text_domain'); ?></a>