<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$embed_url = get_post_meta($post->ID, 'folio_embed', true);

if ($embed_url):

	$embed_code = wp_oembed_get($embed_url);

	echo '<div class="single-folio-video">' . $embed_code . '</div>';

endif;

if ((get_post_meta($post->ID, 'folio_self_hosted_mp4', true) != '') || (get_post_meta($post->ID, 'folio_self_hosted_webm', true) != '')) {
	wp_enqueue_style('dfd_zencdn_video_css');
	wp_enqueue_script('dfd_zencdn_video_js');

	if (has_post_thumbnail()) {
		$thumb = get_post_thumbnail_id();
		$img_url = wp_get_attachment_url($thumb, 'full'); //get img URL
		$article_image = dfd_aq_resize($img_url, 900, 650, true, true, true);
		if(!$article_image) {
			$article_image = $img_url;
		}
		?>

	<?php } ?>

	<video id="video-post<?php the_ID(); ?>" class="video-js vjs-default-skin" controls
		   preload="auto"
		   width="900"
		   height="650"
		   poster="<?php echo esc_url($article_image) ?>"
		   data-setup="{}">

		<?php if (get_post_meta($post->ID, 'folio_self_hosted_mp4', true)): ?>
			<source src="<?php echo get_post_meta($post->ID, 'folio_self_hosted_mp4', true) ?>" type='video/mp4'>
		<?php endif; ?>
		<?php if (get_post_meta($post->ID, 'folio_self_hosted_webm"', true)): ?>
			<source src="<?php echo get_post_meta($post->ID, 'folio_self_hosted_webm"', true) ?>" type='video/webm'>
		<?php endif; ?>
	</video>


<?php
} ?>

<?php
if (metadata_exists('post', $post->ID, '_my_product_image_gallery')) {
	$my_product_image_gallery = get_post_meta($post->ID, '_my_product_image_gallery', true);
} else {
	// Backwards compat
	$attachment_ids = get_posts('post_parent=' . $post->ID . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids');
	$attachment_ids = array_diff($attachment_ids, array(get_post_thumbnail_id()));
	$my_product_image_gallery = implode(',', $attachment_ids);
}

$attachments = array_filter(explode(',', $my_product_image_gallery));

global $gallery_type;
global $description_position;

if ($attachments) {
	
	if (strcmp($gallery_type, 'default') === 0) {
		echo '<div class="portfolio-inside-width-slider">';

		echo '<div class="portfolio-inside-main-carousel">';
		foreach ($attachments as $attachment_key=>$attachment_id) {
			$image_src = wp_get_attachment_url($attachment_id, 'full'); // returns an array
			$alt_text = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
			$meta_extra = get_post($attachment_id);
			
			$description = '';
			if(isset($meta_extra->post_content) && $meta_extra->post_content != '')
				$description .= $meta_extra->post_content;

			$main_image = dfd_aq_resize($image_src, 1200, 750, true, true, true);
			
			if(!$main_image) {
				$main_image = $image_src;
			}
			
			$thumb_url = wp_get_attachment_image_src($attachment_id, 'thumbnail');
				
			$thumb_data_attr = '';
			if(!empty($thumb_url[0])) {
				$thumb_data_attr = 'data-thumb="'.esc_url($thumb_url[0]).'"';
			}
			
			echo '<div class="main-slide">';
				echo '<a href="'.esc_url($image_src).'" '.$thumb_data_attr.' data-rel="prettyPhoto[pp_gal]" title="'.esc_attr($description).'">';
					echo '<img src="'.esc_url($main_image).'" alt="'.esc_attr($alt_text).'" />';
				echo '</a>';
			echo '</div>';
		}
		echo '</div>';
		
		echo '<div class="portfolio-inside-thumbs-carousel">';
		foreach ($attachments as $attachment_key=>$attachment_id) {
			$image_src = wp_get_attachment_url($attachment_id, 'full'); // returns an array

			$thumb_image = dfd_aq_resize($image_src, 250, 250, true, true, true);
			if(!$thumb_image) {
				$thumb_image = $image_src;
			}
			
			echo '<div class="thumb-slide">';
				echo '<div class="thumb-cover">';
					echo '<img src="'.esc_url($thumb_image).'" alt="" />';
				echo '</div>';
			echo '</div>';
		}
		echo '</div>';

		echo '</div>';
	} else {
		echo '<div id="my-work-slider" class="loading"><ul class="slides">';

		$i = 0;
		foreach ($attachments as $attachment_key=>$attachment_id) {

			$image_attributes = wp_get_attachment_url($attachment_id);
			$image_src = wp_get_attachment_url($attachment_id); // returns an array
			
			$alt_text = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
			$meta_extra = get_post($attachment_id);
			
			$description = '';
			if(isset($meta_extra->post_content) && $meta_extra->post_content != '')
				$description .= $meta_extra->post_content;

			$thumb_image = dfd_aq_resize($image_attributes, 126, 88, true, true, true);
			if(!$thumb_image) {
				$thumb_image = $image_attributes;
			}
			$attachment_url = '';
			if (strcmp($gallery_type, 'advanced_gallery') === 0) {
				if ($attachment_key === 0) {
					$attachment_url = dfd_aq_resize($image_src, 800, 800, true, true, true);
					if(!$attachment_url) {
						$attachment_url = $image_src;
					}
					/*if(strcmp($description_position, 'left') === 0 || strcmp($description_position, 'right') === 0) {
						$attachment_url = dfd_aq_resize($image_src, 800, 800, true, true, true);
						if(!$attachment_url) {
							$attachment_url = $image_src;
						}
					} else {
						$attachment_url = dfd_aq_resize($image_src, 666, 666, true, true, true);
						if(!$attachment_url) {
							$attachment_url = $image_src;
						}
					}*/
				} else {
					$attachment_url = dfd_aq_resize($image_src, 400, 400, true, true, true);
					if(!$attachment_url) {
						$attachment_url = $image_src;
					}
					/*if(strcmp($description_position, 'left') === 0 || strcmp($description_position, 'right') === 0) {
						$attachment_url = dfd_aq_resize($image_src, 400, 400, true, true, true);
						if(!$attachment_url) {
							$attachment_url = $image_src;
						}
					} else {
						$attachment_url = dfd_aq_resize($image_src, 333, 333, true, true, true);
						if(!$attachment_url) {
							$attachment_url = $image_src;
						}
					}*/
				}
			} else {
				$attachment_url = $image_src;
			}

			if (strcmp($gallery_type, 'small_images_list') === 0) {
				$attachment_url = dfd_aq_resize($image_src, 400, 400, true, true, true);
				if(!$attachment_url) {
					$attachment_url = $image_src;
				}
			}
			if (strcmp($gallery_type, 'middle_image_list') === 0) {
				$attachment_url = dfd_aq_resize($image_src, 650, 650, true, true, true);
				if(!$attachment_url) {
					$attachment_url = $image_src;
				}
			}
			if (strcmp($gallery_type, 'big_images_list') === 0) {
				$attachment_url = dfd_aq_resize($image_src, 1280, 900, true, true, true);
				if(!$attachment_url) {
					$attachment_url = $image_src;
				}
			}
			
			$thumb_url = wp_get_attachment_image_src($attachment_id, 'thumbnail');
				
			$thumb_data_attr = '';
			if(!empty($thumb_url[0])) {
				$thumb_data_attr = 'data-thumb="'.esc_url($thumb_url[0]).'"';
			}

			echo '<li data-thumb="' . esc_url($thumb_image) . '">';
				echo '<a href="'.esc_url($image_src).'" '.$thumb_data_attr.' data-rel="prettyPhoto[pp_gal]" title="'.esc_attr($description).'">';
					echo '<img src="'.esc_url($attachment_url).'" alt="'.esc_attr($alt_text).'" />';
				echo '</a>';
			echo '</li>';
			if($i == 2 && strcmp($gallery_type, 'advanced_gallery') === 0) {
				echo '<li class="clear"></li>';
			}
			$i++;
		}
		echo '  </ul>';
		echo '</div>';
	}
} elseif (has_post_thumbnail() && (!$embed_url)) {

	$thumb = get_post_thumbnail_id();
	echo wp_get_attachment_image($thumb, 'full');
}