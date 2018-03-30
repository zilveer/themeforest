<?php
global $link_mode;

$term = get_field('vid_category');

if ( $term && is_array($term) )
{
	$term = get_term($term[0], 'video-category');
}

$vid_url = get_field('video_url',$post->ID); 
?>
<div id="post-<?php the_ID(); ?>" <?php post_class('videogrid link-mode-'.$link_mode); ?> data-url="<?php echo esc_url($vid_url); ?>">
	<a href="<?php the_permalink(); ?>">
		<div class="holder">
			<div class="image">
				<div class="play-button">
					<i class="fa fa-play-circle"></i>
				</div>
				<div class="video-mask">
				<?php the_post_thumbnail('medium'); ?>
				</div>
			</div>
			<div class="text-box">
				<h2><?php the_title(); ?></h2>
<?php if ( ! empty($term->name) ) { ?>
				<span class="category"><?php echo esc_html($term->name); ?></span>
<?php } ?>
			</div>
		</div>
	</a>
</div>