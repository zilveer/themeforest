<div class="share">
	<?php _e('Share: ',THEMENAME); ?>
	<?php
		$thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'small-thumb');
	?>
	<!--facebook-->
	<a target="_blank" data-toggle="tooltip" data-placement="top" title="facebook" href="https://www.facebook.com/sharer/sharer.php?src=bm&amp;u=<?php the_permalink(); ?>&amp;t=<?php echo urlencode(get_the_title()); ?>&amp;v=3"><i class="icon-facebook"></i></a>
	
	<!--twitter-->
	<a target="_blank"  data-toggle="tooltip" data-placement="top" title="twitter" href="https://twitter.com/intent/tweet?original_referer=<?php the_permalink(); ?>&amp;text=<?php echo urlencode(get_the_title()); ?>&amp;tw_p=tweetbutton&amp;url=<?php echo urlencode(get_the_title()); ?>"><i class="icon-twitter"></i></a>
	
	<!--google plus-->
	<a target="_blank" data-toggle="tooltip" data-placement="top" title="google plus" href="https://plus.google.com/share?url=<?php the_permalink(); ?>"><i class="icon-gplus"></i></a>
	
	<!--linkedin-->
	<a target="_blank"  data-toggle="tooltip" data-placement="top" title="linkedin" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php echo urlencode(get_the_title()); ?>&amp;summary=<?php echo get_the_excerpt(); ?>&amp;source=<?php the_permalink(); ?>" ><i class="icon-linkedin"></i></a>
	
	<!--pinterest-->
	<a target="_blank" data-toggle="tooltip" data-placement="top" title="pinterest" href="http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php echo $thumb[0]; ?>&amp;description=<?php echo get_the_excerpt(); ?>"><i class="icon-pinterest"></i></a>
</div>