<?php
/*
	Default Imageslider Layout
	This layout shows images in the default way
*/
global $postslider, $attributes; $style_array;
?>
<?php if( $postslider->have_posts() ) : ?>

  <ul class="slides" style='<?php echo $style_array['height'] ?>' >
	<?php
		while( $postslider->have_posts() ) : $postslider->the_post();
		$image_id = get_post_thumbnail_id();
		$image = wp_get_attachment_image_src( $image_id, 'rf-col-1' )	;
	?>
		<li style='<?php echo $style_array['height'] ?>' >
			<img src='<?php echo $image[0] ?>'>
			<?php if( $attributes['show_title'] == 'yes' AND !empty( $post->post_title) ) : ?>
				<div class='title'><h1><a href='<?php the_permalink() ?>'><?php the_title() ?></a></h1></div>
			<?php endif ?>
		</li>
	<?php endwhile ?>
  </ul>


<?php endif ?>
