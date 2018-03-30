<?php

global $blog_column_count;

if (has_post_thumbnail($post->ID)){ $has_thumbnail = true; } else { $has_thumbnail = false; }

if ('audio' == get_post_format($post->ID)){
	$fa_icon = 'fa-headphones';
} else if ('video' == get_post_format($post->ID)){
	$fa_icon = 'fa-video-camera';
} else {
	$fa_icon = 'fa-file-text-o';
}

if (isset($blog_column_count) && $blog_column_count == 3): $last_class = 'last'; $blog_column_count = 0; else : $last_class = ''; endif;

$disable_post_meta = ot_get_option('to_disable_post_meta','no');
$disable_post_meta = ($disable_post_meta == 'yes' ? true : false);

?>
<div class="basilGridPostWrap">
	<article <?php post_class($last_class); ?>>
		<a class="basilPostThumb<?php if (!$has_thumbnail): ?>Empty<?php endif; ?>" href="<?php the_permalink(); ?>">
			<?php if ($has_thumbnail):
				$image_url_small = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'basil_post_thumbnail_small');
				$image_url_small = $image_url_small[0];
				$image_url_square = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'basil_post_thumbnail_square');
				$image_url_square = $image_url_square[0];
				?><div class="img" style="background:url('<?php echo $image_url_small; ?>') center center;"></div><img src="<?php echo $image_url_square; ?>" class="square" alt="<?php the_title(); ?>" /><?php
			echo '<span>'; endif;
			?><i class="fa <?php echo $fa_icon; ?>"></i><?php if ($has_thumbnail): ?></span><?php endif; ?>
		</a>
		<div class="basilPost"<?php if ($disable_post_meta): echo ' style="padding-top:0;"'; endif; ?>>
			<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
			<?php if (is_sticky()): echo '<div class="sticky-tag">'.__('Sticky Post','basil').'</div>'; endif; ?>
			<?php the_excerpt(); ?>
			<a class="basilButton bgColor-1" href="<?php the_permalink(); ?>"><?php
			
			if ('audio' == get_post_format($post->ID)){
				echo '<i class="fa fa-headphones"></i>&nbsp;&nbsp;'; _e('Listen to Audio','basil');
			} else if ('video' == get_post_format($post->ID)){
				echo '<i class="fa fa-video-camera"></i>&nbsp;&nbsp;'; _e('Watch Video','basil');
			} else {
				echo '<i class="fa fa-file-text-o"></i>&nbsp;&nbsp;'; _e('Continue Reading','basil');
			}
			
			?></a>
		</div>
		
		<?php
		
		if (!$disable_post_meta): ?>
		
		<div class="basilPostMeta">
			
			<?php $date_format = get_option('date_format'); ?>
	
			<span><i class="fa fa-calendar"></i>&nbsp;&nbsp;<?php echo get_the_time( $date_format ); ?></span>
			<span><a href="<?php the_permalink(); ?>#comments"><i class="fa fa-comment"></i>&nbsp;&nbsp;<?php comments_number(__('No comments','basil'),__('1 comment','basil'),'% '.__('comments','basil')); ?></a></span>
		</div>
		
		<?php endif; ?>
		
	</article>
</div>