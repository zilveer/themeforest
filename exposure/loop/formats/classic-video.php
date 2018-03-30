<?php
	$video_url = thb_get_post_meta( get_the_ID(), 'video_url' );
?>

<?php if( !empty($video_url) ) : ?>
	<?php echo do_shortcode('[thb_video url="'. $video_url .'"]'); ?> 
<?php endif; ?>

<header class="item-header">
	<h1>
		<a href="<?php the_permalink(); ?>" rel="permalink"><?php the_title(); ?></a>
	</h1>
</header>

<footer class="item-footer">
	<p class="post-meta">
		<time pubdate class="pubdate">
			<?php echo get_the_date(); ?>
		</time>
		<?php 
			$category = get_the_category();
			$comments = get_comments( 
				array(
					'post_id' => get_the_ID()
				)
			);
 		?>
		<?php if ( !empty($category) ) : ?>
			 / <span class="category"><?php the_category(', '); ?></span>
		<?php endif; ?>
		<?php if ( !empty($comments) ) : ?>
			 / <span class="comments" data-icon="o"><a href="<?php comments_link(); ?>" title="<?php thb_comments_number(); ?>"><?php thb_comments_number(true); ?></a></span>
		<?php endif; ?>
	</p>
</footer>

<?php if( get_the_excerpt() != '' ) : ?>
	<div class="thb-text">
		<?php the_excerpt(); ?>
	</div>
<?php endif; ?>