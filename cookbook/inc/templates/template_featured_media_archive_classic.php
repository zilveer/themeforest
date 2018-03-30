<?php 

	$cmb_feature = get_post_meta(get_the_ID(), 'cmb_feature', true);
	$cmb_media_link = get_post_meta(get_the_ID(), 'cmb_media_link', true);

	if ( ($cmb_feature == "media") && (!empty($cmb_media_link)) ) {
		echo "<div class='featured_media'>";
		output_cmb_media_link($cmb_media_link);
		echo "</div>";
	} else {
		// $post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
		$post_thumbnail_src_fit = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
		$img_alt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
		$img_post = get_post(get_post_thumbnail_id(get_the_ID()));

		if ( ($cmb_feature == "media_in_lightbox") && (!empty($cmb_media_link)) && get_post(get_post_thumbnail_id(get_the_ID())) ) {

			echo "<div class='featured_media'>";
			echo '<div class="mosaic-block circle">';
			printf('<a href="%s" class="mosaic-overlay fancybox-media fancybox.iframe play"></a>', esc_url($cmb_media_link));
			printf('<div class="mosaic-backdrop"><img src="%s" alt="%s" /></div>', esc_url($post_thumbnail_src_fit[0]), esc_attr($img_alt));
			echo "</div>";
			echo '</div>';
		
		} elseif (has_post_thumbnail(get_the_ID()) && get_post(get_post_thumbnail_id(get_the_ID())) ) { 

			echo "<div class='featured-media'>";
			echo '<div class="mosaic-block circle">';
			printf('<a href="%s" class="mosaic-overlay link" title="%s"></a>', esc_url(get_permalink(get_the_ID())), esc_attr($img_post->post_title));
			printf('<div class="mosaic-backdrop"><img src="%s" alt="%s" /></div>', esc_url($post_thumbnail_src_fit[0]), esc_attr($img_alt));
			echo "</div>";
			echo '</div>';

		}

	}
