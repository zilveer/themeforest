<?php global $unik_data; 

	//post thumbnail 
	$carousel_images = get_post_meta($post->ID, THEMENAME.'_post_carousel');

	if(!empty($carousel_images) or has_post_thumbnail()): 
		get_template_part('inc/blog','image');
	else: // no carousel image or post thumbnail found so lets search for gallery shortcode
	
	if(!is_single() && has_shortcode( get_the_content(), 'gallery' )): ?>
	<div class="flexslider thumbnail-carousel entry-thumbnail sm-border">
		<ul class="slides">
		<?php
		
		global $post;
		$attachment_ids = array();
		$pattern = get_shortcode_regex();
		$ids = array();

		if (preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches ) ) {   //finds the "gallery" shortcode and puts the image ids in an associative array at $matches[3]
		$count=count($matches[3]);      //in case there is more than one gallery in the post.
		
			for ($i = 0; $i < $count; $i++){
				$atts = shortcode_parse_atts( $matches[3][$i] );
				
				if ( isset( $atts['ids'] ) ){
					$attachment_ids = explode( ',', $atts['ids'] );
					$ids = array_merge($ids, $attachment_ids);
				}		
			}
		}
		
		$count = 0; 
	foreach ($ids as $id):
		$count++;
		
		$image = wp_get_attachment_image_src($id, $unik_data['blog_image_size']);
		$full_image = wp_get_attachment_image_src($id, 'full');
		$image_data = wp_get_attachment_metadata($id);
		
		if($count < 7): // load up to six gallery images
		?>
		<li class="gallery-thumbnail">
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
		
<?php endif; endforeach; ?>
				
	</ul>
</div>
					
<?php endif;	?>
	
<?php endif;	?>