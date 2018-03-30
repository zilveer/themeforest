<?php 

$full = wp_get_attachment_image_src(get_post_thumbnail_id(), "fullsize");

?>

<li id="post_<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
				
		<div class="post_thumb">
		
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail(); ?></a>
			
		</div>
	
	<?php endif; ?>

</li>