<?php if ( function_exists( 'has_post_thumbnail' ) && has_post_thumbnail( get_the_ID() ) ) : ?>
	<div class="edd_download_image">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php
				//show the image in lightbox									
					$show_image_lightbox = get_post_meta($post->ID, 'kingsize_featured_img_lightbox', true );

				//POST featured image height
					if(get_post_meta($post->ID, 'kingsize_post_featured_img_height', true ))
						$post_featured_img_height = get_post_meta($post->ID, 'kingsize_post_featured_img_height', true );
					else
						$post_featured_img_height = 180;

						$post_featured_img_width = 400;//showing full width
							
					if(has_post_thumbnail()): // POST has thumbnail

						$org_img_url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
						$attachment_id =  get_post_thumbnail_id($post->ID);

						$url_post_img = wm_image_resize($post_featured_img_width,$post_featured_img_height, wp_get_attachment_url($attachment_id));
						
						if($show_image_lightbox=='enable')
							echo '<div class="blog_img"><a href="'.$org_img_url.'" class="image lightbox_blog" title="'.get_the_title().'" rel="gallery"><img src="'.$org_img_url.'" alt="'.get_the_title().'" class=""/></a></div>';
						else 
							echo '<div class="blog_img"><a href="'.get_permalink().'" class="lightbox_not" title="'.get_the_title().'"><img src="'.$org_img_url.'" alt="'.get_the_title().'" class=""/></a></div>';
						
					endif;
			?>
		</a>
	</div>
<?php endif; ?>
