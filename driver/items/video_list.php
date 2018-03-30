<?php
global $link_mode;
$term = get_field('vid_category');

if ( $term && is_array($term) )
{
	$term = get_term($term[0], 'video-category');
}

$vid_url = get_field('video_url',$post->ID); 
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('media-block link-mode-'.$link_mode); ?> data-url="<?php echo esc_url($vid_url); ?>">
	<a href="<?php the_permalink(); ?>">
		<div class="holder">
			<div class="image rel">
				<div class="play-button"><i class="fa fa-play-circle"></i></div>
				<?php the_post_thumbnail('medium'); ?>
			</div>
			<div class="text-box">
				<h2><?php the_title(); ?></h2>
			</div>
		</div>
	</a>
</article>