<?php

if(isset($image_size)){

	$image_size = $image_size;

}else{

	$image_size = "full";

}

$image_gallery_val = get_post_meta( get_the_ID(), 'eltd_post_gallery_images_meta' , true );

if($image_gallery_val != '' ) {
	$image_gallery_array = explode(',',$image_gallery_val);
}

?>
<?php if($image_gallery_val !== ""){ ?>
	<div class="eltd-post-image">
		<div class="eltd-blog-gallery eltd-owl-slider">
			<?php			
			if(isset($image_gallery_array) && count($image_gallery_array)!= 0):
				foreach($image_gallery_array as $gimg_id): 
					
					$background_image_object = wp_get_attachment_image_src($gimg_id,'full');	
					$background_image_src = $background_image_object[0];
					$style_attr  = 'background-image:url('.  esc_url($background_image_src) .')';
					
					?>
			
					<div class="eltd-blog-gallery-item" <?php echo flow_elated_get_inline_style($style_attr)?>>
						<a href="<?php the_permalink(); ?>">
							<?php echo wp_get_attachment_image( $gimg_id, $image_size ); ?>
						</a>
					</div>
			
				<?php endforeach;
			endif;
			?>
		</div>
	</div>
<?php } ?>