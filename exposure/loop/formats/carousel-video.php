<?php
	$video_url = thb_get_post_meta( get_the_ID(), 'video_url' );
?>

<?php if( !empty($video_url) ) : ?>
	<?php echo do_shortcode('[thb_video url="'. $video_url .'"]'); ?>
<?php endif; ?>

<footer class="item-footer">
	<p class="post-meta">
		<time pubdate class="pubdate">
			<?php echo get_the_date(); ?>
		</time> -
		<span class="category"><?php the_category(', '); ?></span>
		<span class="comments" data-icon="o"><a href="<?php comments_link(); ?>" title="<?php thb_comments_number(); ?>"><?php thb_comments_number(true); ?></a></span>
	</p>
</footer>

<header class="item-header">
	<h1>
		<a href="<?php the_permalink(); ?>" rel="permalink"><?php the_title(); ?></a>
	</h1>
</header>

<?php if( get_the_excerpt() != '' ) : ?>
	<div class="thb-text">
		<?php the_excerpt(); ?>
	</div>
<?php endif; ?>

<a class="thb-btn small readmore" href="<?php the_permalink(); ?>"><?php _e('Read', 'thb_text_domain'); ?></a>