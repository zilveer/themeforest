<?php $image_gallery_val = get_post_meta( get_the_ID(), 'eltd_post_gallery_images_meta' , true );?>
<?php if($image_gallery_val !== ""){ ?>
	<div class="eltd-post-image">
		<div class="eltd-blog-gallery eltd-owl-slider">
			<?php
			if($image_gallery_val != '' ) {
				$image_gallery_array = explode(',',$image_gallery_val);
			}
			if(isset($image_gallery_array) && count($image_gallery_array)!= 0):
				foreach($image_gallery_array as $gimg_id): ?>
					<div>
						<?php echo wp_get_attachment_image( $gimg_id, 'full' ); ?>
					</div>
				<?php endforeach;
			endif;
			?>
		</div>
	</div>
<?php } ?>