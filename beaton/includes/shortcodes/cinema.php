<?php

function wize_cinema($atts, $content) {
    extract(shortcode_atts(array(
        "items" => 5,
        "cat" => null,
        "order" => "desc",
        "orderby" => "DATE"
    ), $atts));
    $order = strtoupper($order);
    $look  = null;
    $query = array(
        'post_type' => 'video',
        'orderby' => $orderby,
        'order' => $order,
        'posts_per_page' => $items,
        'cat' => $cat
    );
    if ($cat) {
        $query = array(
            'post_type' => 'video',
            'orderby' => $orderby,
            'order' => $order,
            'posts_per_page' => $items,
            'tax_query' => array(
                array(
                    'taxonomy' => 'videos',
                    'field' => 'slug',
                    'terms' => array(
                        $cat
                    )
                )
            )
        );
    }
    $look .= '
	<div class="sh-media3 fixed">
	<div id="video-gallery" class="royalSlider videoGallery rsDefault">';
	$wp_query = new WP_Query($query);
    while ($wp_query->have_posts()):
        $wp_query->the_post();
        global $post;
        $image_id = get_post_thumbnail_id();
        $cover    = wp_get_attachment_image_src($image_id, 'Bl2Sng');
        $no_cover = get_template_directory_uri();
        $venue    = get_post_meta($post->ID, 'vd_venue', true);
        $youtube  = get_post_meta($post->ID, 'vd_youtube', true);
        $vimeo    = get_post_meta($post->ID, 'vd_vimeo', true);
        $date     = get_post_meta($post->ID, 'vd_date', true);
        $time     = strtotime($date);
        $year     = date('Y', $time);
        $month    = date('F', $time);
        $day      = date('d', $time);
        
        $look .= '
		<div class="rsContent">';
        if ($vimeo) {
            if ($image_id) {
                $look .= '
			<a class="rsImg" data-rsvideo="https://vimeo.com/' . esc_attr($vimeo) . '" href="' . esc_url($cover[0]) . '">';
            } else {
                $look .= '
			<a class="rsImg" data-rsvideo="https://vimeo.com/' . esc_attr($vimeo) . '" href="' . esc_url($no_cover) . '/images/no-cover/shvd.png">';
            }
        }
        
        if ($youtube) {
            if ($image_id) {
                $look .= '
			<a class="rsImg" data-rsvideo="https://www.youtube.com/watch?v=' . esc_attr($youtube) . '" href="' . esc_url($cover[0]) . '">';
            } else {
                $look .= '
			<a class="rsImg" data-rsvideo="https://www.youtube.com/watch?v=' . esc_attr($youtube) . '" href="' . esc_url($no_cover) . '/images/no-cover/shvd.png">';
            }
        }
        $look .= '
				<div class="rsTmb">
					<h2>';
		if (strlen($post->post_title) > 37) {
            $look .= substr(get_the_title($before = '', $after = '', FALSE), 0, 37) . '...';
        } else {
            $look .= get_the_title();
        }
		$look .= '</h2>';
		if ($date) {
			$look .= '
					<span>' . esc_html($day, "wizedesign") . ' ' . esc_html($month, "wizedesign") . ' ' . esc_html($year, "wizedesign") . '</span>';
		}
		$look .= '
				</div><!-- end a.rsTmb -->
			</a><!-- end a.rsImg -->
			<div class="rsABlock">';
		if ($date) {
			$look .= '
				<div class="rsContent-venue">' . esc_html($venue, "wizedesign") . '</div>';
		}
		$look .= '
			</div><!-- end .rsABlock -->
		</div><!-- end .rsContent -->';
		
    endwhile;
	
    $look .= '
	</div><!-- end #video-gallery -->
	</div><!-- end .sh-home3 -->';
    
    wp_reset_postdata();
    
    return $look;
}

add_shortcode("cinema", "wize_cinema");