<?php

function wize_photo1($atts, $content) {
    extract(shortcode_atts(array(
        "items" => 2,
        "cat" => null,
        "order" => "desc",
        "orderby" => "DATE"
    ), $atts));
    $order = strtoupper($order);
    $look  = null;
    $query = array(
        'post_type' => 'photo',
        'orderby' => $orderby,
        'order' => $order,
        'posts_per_page' => $items,
        'cat' => $cat
    );
    if ($cat) {
        $query = array(
            'post_type' => 'photo',
            'orderby' => $orderby,
            'order' => $order,
            'posts_per_page' => $items,
            'tax_query' => array(
                array(
                    'taxonomy' => 'photos',
                    'field' => 'slug',
                    'terms' => array(
                        $cat
                    )
                )
            )
        );
    }
    $look .= '
	<div class="sh-media1 fixed">
	<div class="sh-width">';
    $wp_query = new WP_Query($query);
    while ($wp_query->have_posts()):
        $wp_query->the_post();
        global $post;
        $image_id = get_post_thumbnail_id();
        $cover    = wp_get_attachment_image_src($image_id, 'Bl1PhVd');
        $no_cover = get_template_directory_uri();
        $venue    = get_post_meta($post->ID, 'ph_venue', true);
        $date     = get_post_meta($post->ID, 'ph_date', true);
        $time     = strtotime($date);
        $year     = date('Y', $time);
        $month    = date('F', $time);
        $day      = date('d', $time);
        
        /* display */
        
        $look .= '
		<div class="pv1">
			<div class="pv1-cover">
				<div class="pv1-bg"></div>';
        if ($image_id) {
            $look .= '
				<img src="' . esc_url($cover[0]) . '" alt="' . esc_attr(get_the_title()) . '" />';
        } else {
            $look .= '
				<img src="' . esc_url($no_cover) . '/images/no-cover/media.png" alt="no-cover" />';
        }
        $look .= '
				<div class="pv1-title">';
		if ($venue) {
			$look .= '
					<div class="pv1-venue">' . esc_html($venue, "wizedesign") . '</div>';
		}
		$look .= '
					<h2><a href="' . esc_url(get_permalink()) . '">' . get_the_title() . '</a></h2>	
				</div><!-- end .pv1-title -->
				<div class="pv1-lv">
					' . wize_like_info($post->ID) . '
					<div class="info-view">' . wize_get_views(get_the_ID()) . '</div>
				</div><!-- end .pv1-lv -->';
		if ($date) {
			$look .= '
				<div class="pv1-date">' . esc_html($day, "wizedesign") . ' ' . esc_html($month, "wizedesign") . ' ' . esc_html($year, "wizedesign") . '</div>';
		}
        $look .= '		
			</div><!-- end .pv1-cover -->
		</div><!-- end .pv1 -->';
		
    endwhile;
    
    $look .= '
	</div><!-- end .sh-width -->
	</div><!-- end .sh-media1 -->
	';
    
    wp_reset_postdata();
    
    return $look;
}

add_shortcode("photo1", "wize_photo1");