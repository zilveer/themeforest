<?php function thb_thumbnail_gallery( $atts, $content = null ) {
  $atts = vc_map_get_attributes( 'thb_thumbnail_gallery', $atts );
  extract( $atts );
   
  $images = explode(',', $images);
  $thumbs = 'thumbs-'.rand(0,1000);
 	ob_start();
 	
 	?>
 	<div class="carousel-container thumbnail_container">
 			<div class="carousel thumbnail_gallery shortcode" data-columns="1" data-navigation="true" data-thumbs="#<?php echo $thumbs; ?>">
 			<?php
 				foreach ($images as $image) {
 					$image_link = wp_get_attachment_image_src($image,'full');
 					$image_src = aq_resize($image_link[0], 1170, 460, true, false, true);
 					?>
 					<figure>
 						<img  src="<?php echo $image_src[0]; ?>" width="<?php echo $image_src[1]; ?>" height="<?php echo $image_src[2]; ?>" alt="<?php echo $image_title; ?>" />
 					</figure>
 					<?php
 				}
 			?>
 		</div>
 		<div class="carousel owl thumbnails" data-columns="12" data-navigation="false" id="<?php echo $thumbs; ?>">
 			<?php
 				foreach ($images as $image) {
 					$image_link = wp_get_attachment_image_src($image,'full');
 					$image_src = aq_resize( $image_link[0],108, 108, true, false, true);
 					$image_title = get_post($image)->post_excerpt;
 					
 					?>
 					<figure>
 						<img  src="<?php echo $image_src[0]; ?>" width="<?php echo $image_src[1]; ?>" height="<?php echo $image_src[2]; ?>" title="<?php echo $image_title; ?>" data-placement="top" />
 					</figure>
 					<?php
 				}
 			?>
 		</div>
 	</div>
	<?php 
   $out = ob_get_contents();
   if (ob_get_contents()) ob_end_clean();
   
   wp_reset_query();
   wp_reset_postdata();
     
  return $out;
}
add_shortcode('thb_thumbnail_gallery', 'thb_thumbnail_gallery');