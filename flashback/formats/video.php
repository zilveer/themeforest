<?php

	$video_embed = get_post_meta(get_the_ID(), "si_video_embed", true);
	
?>

<li id="post_<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post_video">

	<?php if($video_embed != "") : ?>
	
		<?php echo stripslashes(htmlspecialchars_decode($video_embed)); ?>
	
	<?php else: ?>
	
		<p><?php _e("Add Video", "shorti") ?></p>
		
	<?php endif; ?>
	
	</div>

	<h4 class="post_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

	<div class="post_date">
	
		<h6 class="day"><?php the_time("F j, Y"); ?></h6>
	
	</div>
	
	<div class="post_excerpt">
	
		<?php the_excerpt(); ?>
	
	</div>
	
	<div class="list_cats">
	
		<h6 class="list_cats_title"><?php _e("Posted in", "shorti"); ?>: </h6>
		<?php the_category(); ?>
	
	</div>

</li>