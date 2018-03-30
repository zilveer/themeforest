<?php function thb_slider( $atts, $content = null ) {
  $atts = vc_map_get_attributes( 'thb_slider', $atts );
  extract( $atts );
  $images = explode(',', $images);
 	ob_start();
 	
 	$nav = ($navigation == 'true' ? 'true' : 'false');
 	?>
	<div class="carousel slick image-slider" data-columns="1" data-navigation="<?php echo esc_attr($nav); ?>">
		<?php
			foreach ($images as $image) {
				$image_link = wp_get_attachment_image_src($image, 'full');
				$image_src = aq_resize( $image_link[0], $width, $height, true, false, true);
				$image_title = get_the_title($image);
				?>
				<figure>
					<img src="<?php echo esc_attr($image_link[0]); ?>" alt="<?php echo esc_attr($image_title); ?>" />
				</figure>
				<?php
			}
		?>
	</div>
	<?php
   $out = ob_get_contents();
   if (ob_get_contents()) ob_end_clean();
  return $out;
}
add_shortcode('thb_slider', 'thb_slider');
