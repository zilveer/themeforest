<?php 

	$post_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), "single-thumb");
	$full = wp_get_attachment_image_src(get_post_thumbnail_id(), "fullsize");

?>

<li id="post_<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
				
		<div class="post_thumb">
		
			
			<a href="<?php echo $full[0]; ?>" title="<?php the_title(); ?>" class="pretty prettyPhoto[posts]"><?php the_post_thumbnail(); ?></a>
			
		</div>
	
	<?php endif; ?>
	
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