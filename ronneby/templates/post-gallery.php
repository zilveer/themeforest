<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $dfd_ronneby;
$image_crop = isset($dfd_ronneby['thumb_image_crop']) ? $dfd_ronneby['thumb_image_crop'] : '';
if ($image_crop == "") {$image_crop = true;}
?>


<?php
	global $post;
	$postid = get_the_ID();
	
/*
    $args = array(
        'order' => 'ASC',
        'post_type' => 'attachment',
        'post_parent' => $postid,
        'post_mime_type' => 'image',
        'post_status' => null,
        'numberposts' => -1,
    );

    $attachments = get_posts($args);*/
	if (metadata_exists('post', $postid, '_my_post_image_gallery')) {
		$my_posts_image_gallery = get_post_meta($postid, '_my_post_image_gallery', true);
	} else {
		// Backwards compat
		$attachment_ids = get_posts('post_parent=' . $postid . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids');
		$attachment_ids = array_diff($attachment_ids, array(get_post_thumbnail_id()));
		$my_posts_image_gallery = implode(',', $attachment_ids);
	}

	$attachments = array_filter(explode(',', $my_posts_image_gallery));
    if ($attachments) {
		echo '<div class="dfd-gallery-cover">';
			echo '<div class="dfd-gallery-post-slider slide-post">';

				foreach ($attachments as $attachment) {
					$img_url =  wp_get_attachment_url($attachment); /*get img URL*/

					if (isset($dfd_ronneby['post_thumbnails_width']) && isset($dfd_ronneby['post_thumbnails_height']) && $dfd_ronneby['post_thumbnails_width'] && $dfd_ronneby['post_thumbnails_height']){
						$article_image = dfd_aq_resize($img_url, $dfd_ronneby['post_thumbnails_width'], $dfd_ronneby['post_thumbnails_height'], $image_crop, true, true);
					} else {
						$article_image = dfd_aq_resize($img_url, 900, 600, $image_crop, true, true);
					}
					if(!$article_image) {
						$article_image = $img_url;
					}
					?>
					<div>
						<img src="<?php echo esc_url($article_image); ?>" alt="<?php the_title(); ?>"/>
					</div>

				<?php  }
			echo '</div>';
			echo '<div class="dfd-gallery-bar"></div>';
			echo DFD_Carousel::controls();
			echo	'<script type="text/javascript">
						(function($) {
							if(typeof $.fn.initGallery !== "undefined") {
								$(".dfd-gallery-post-slider").initGallery();
							}
						})(jQuery);
					</script>';
        echo '</div>';
    }
?>