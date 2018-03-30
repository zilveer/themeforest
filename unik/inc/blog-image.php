<?php global $unik_data, $post; 
 
	$full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); // main attached image to make link
	$large_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');  // large image for blog single
	$blog_image = wp_get_attachment_image_src(get_post_thumbnail_id(), $unik_data['blog_image_size'] ); // selected image size from option
	$image_data = wp_get_attachment_metadata(get_post_thumbnail_id()); // get image data for alt tag
	
	$carousel_images = get_post_meta($post->ID, THEMENAME.'_post_carousel');
?>

<?php if(!empty($carousel_images) or has_post_thumbnail( $post->ID ) ): ?>

<!-- post thumbnail -->
<div class="entry-thumbnail">
	<?php 

	if(!empty($carousel_images)): ?>

		<div class="flexslider thumbnail-carousel clearfix sm-border">
			<ul class="slides">
			<?php foreach($carousel_images as $carousel_image): 
				$size = 'large';
				if(get_post_type( get_the_ID() )=='event'){$size = 'ext-large';}
				$image = wp_get_attachment_image_src($carousel_image, $size );
				$full_image = wp_get_attachment_image_src($carousel_image, 'full' );
			 ?>
				 <li>
					<div class="view effect-2">
						<img src="<?php echo $image[0]; ?>" alt="<?php echo $image_data['image_meta']['title']; ?>">
						<a data-rel="prettyPhoto['post-<?php echo $post-ID; ?>']" href="<?php echo $full_image[0]; ?>">
							<div class="mask">
								<div class="info">
									<i class="icon-search"></i>
								</div>						
							</div>
						</a>
								
					</div>
				 </li>
			<?php endforeach; ?>
			</ul>	
		</div><!-- Flex slider carousel -->
		
	<?php else : ?>		
		
		<div class="thumb-holder sm-border">
			<div class="view effect-2">
				<?php if($unik_data['blog_image_size']=='medium' && get_post_type( get_the_ID() )!='event'): ?>
				
					<img src="<?php echo $blog_image[0]; ?>" alt="<?php echo $image_data['image_meta']['title']; ?>">
				
				<?php elseif(get_post_type( get_the_ID() )=='event'): ?>
					
					<?php the_post_thumbnail('single-event'); ?>	
				
				<?php else: ?>
				
					<?php the_post_thumbnail(); ?>	
					
			<?php endif; ?>
				<a data-rel="prettyPhoto['post-<?php echo $post-ID; ?>']" href="<?php echo $full_image[0]; ?>">
					<div class="mask">
						<div class="info">
							<i class="icon-search"></i>
						</div>						
					</div>
				</a>

			</div>
		</div>
		
	<?php endif; ?>
</div>

<?php endif; ?>
