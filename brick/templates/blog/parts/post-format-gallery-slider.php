<div class="flexslider">
	<ul class="slides">
		<?php
		$array_id = qode_gallery_post_format_ids_images(get_the_content());

		if($array_id !==false){
			foreach($array_id as $img_id){ ?>
				<li><a href="<?php the_permalink(); ?>"><?php echo wp_get_attachment_image( $img_id, 'full' ); ?></a></li>
			<?php }

		}
		?>
	</ul>
</div>
