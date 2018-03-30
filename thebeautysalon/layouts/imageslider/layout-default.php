<?php
/*
	Default Imageslider Layout
	This layout shows images in the default way
*/
global $imageslider;
?>
<?php if( $imageslider->have_posts() ) : ?>

  <ul class="slides" style='<?php echo $style_array['height'] ?>' >
	<?php
		while( $imageslider->have_posts() ) : $imageslider->the_post();
		$image = wp_get_attachment_image_src( $post->ID, 'rf-col-1' )
	?>
		<li style='<?php echo $style_array['height'] ?>' >
			<img src='<?php echo $image[0] ?>'>
			<?php if( $attributes['show_title'] == 'yes' OR $attributes['show_description'] == 'yes' ) : ?>
				<div class='title'>
					<h1><?php the_title() ?></h1>
					<?php if( $attributes['show_description'] == 'yes' ) : ?>
						<div class='description'><?php echo $post->post_content ?></div>
					<?php endif ?>
				</div>
			<?php endif ?>
		</li>
	<?php endwhile ?>
  </ul>


<?php endif ?>
