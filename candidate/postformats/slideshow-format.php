
<?php 
global $page_id;
$sidebar_position = get_post_meta($page_id,'mm_sidebar_position_meta_box',true); 


	global $post;
	$post_id = $post->ID;
	$slider_image_gallery = get_meta_option('slider_image_gallery', $post_id);
	$attachments = array_filter( explode( ',', $slider_image_gallery ) );

	
	$type = 'post-blog';
	if('full' == $sidebar_position) {
		$type = 'post-full';
		}
	
if($attachments && ! post_password_required() ) { ?>

	<!-- Slider -->
	<div class="flexslider-post flexslider"  style="margin:0;" >
		 <ul class="slides">
		<?php  
			foreach ($attachments as $attachment) 
				{
				$attachment_id = get_post( $attachment );
				$caption = trim(strip_tags($attachment_id->post_excerpt));
				$alt = trim(strip_tags(get_post_meta($attachment, '_wp_attachment_image_alt', true)));
				
				
				echo '<li>';
				echo candidat_get_featured_image($attachment, $type, 'post-image', $alt);
				echo '</li>'."\n";
				}
		?>

		</ul>
						
		
	</div>


<?php } ?>