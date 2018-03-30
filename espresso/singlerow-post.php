<?php

global $hide_thumbnails, $thumbnail_type;

?><article class="recent-post-block clearfix"><?php
	
	if (!isset($thumbnail_type) || isset($thumbnail_type) && !$thumbnail_type){ $thumbnail_type = 'recent-post-thumbnail'; }

	if (has_post_thumbnail($post->ID) && !$hide_thumbnails){
		$image_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),$thumbnail_type); $image_url = $image_url[0]; ?>
		<?php if ($thumbnail_type == 'recent-post-thumbnail-square'){ ?><div class="floated-thumb"><?php } ?>
		<a href="<?php the_permalink(); ?>"><img src="<?php echo $image_url; ?>" alt="<?php the_title(); ?>" /></a>
		<?php if ($thumbnail_type == 'recent-post-thumbnail-square'){ ?></div><div class="floated-content"><?php } ?>
	<?php } ?>
	
	<?php $date_format = get_option('date_format'); ?>
	
	<h3<?php if ($hide_thumbnails){ echo ' class="bordered"'; } ?>><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	
	<div class="post-meta sm">
		<span><i class="fa fa-calendar"></i> <?php echo get_the_date($date_format,$post->ID); ?></span>
		<span><i class="fa fa-user"></i> <?php the_author_posts_link(); ?></span>
		<span><i class="fa fa-comment"></i> <a href="#comments"><?php comments_number(__('No comments','espresso'),__('1 comment','espresso'),'% '.__('comments','espresso')); ?></a></span>
	</div>
	
	<?php the_excerpt(); ?>
	<a class="es-button" href="<?php the_permalink(); ?>"><?php
	
	if ('gallery' == get_post_format($post->ID)){
		_e('View Gallery','espresso');
	} else if ('audio' == get_post_format($post->ID)){
		_e('Listen to Audio','espresso');
	} else if ('video' == get_post_format($post->ID)){
		_e('Watch Video','espresso');
	} else {
		_e('Continue Reading','espresso');
	}
	
	?></a>
	
	<?php if (has_post_thumbnail($post->ID) && !$hide_thumbnails && $thumbnail_type == 'recent-post-thumbnail-square'){ ?></div><?php } ?>
	
</article>