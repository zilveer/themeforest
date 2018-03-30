<?php

function wize_video2($atts, $content) {
    extract(shortcode_atts(array(
        "items" => 2,
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
	<div class="sh-media2 fixed">
	<div class="sh-width">';
    $wp_query = new WP_Query($query);
    while ($wp_query->have_posts()):
        $wp_query->the_post();
        global $post;
        $image_id = get_post_thumbnail_id();
        $cover    = wp_get_attachment_image_src($image_id, 'Bl1PhVd');
        $no_cover = get_template_directory_uri();
        $venue    = get_post_meta($post->ID, 'vd_venue', true);
        $youtube  = get_post_meta($post->ID, 'vd_youtube', true);
        $vimeo    = get_post_meta($post->ID, 'vd_vimeo', true);
        $date     = get_post_meta($post->ID, 'vd_date', true);
        $time     = strtotime($date);
        $year     = date('Y', $time);
        $month    = date('F', $time);
        $day      = date('d', $time);
        
        /* display */
        
        $look .= '
		<div class="pv2">
			<div class="pv2-cover">
				<div class="he-wrap he-wize">';
        if ($image_id) {
            $look .= '
					<img src="' . esc_url($cover[0]) . '" alt="' . esc_attr(get_the_title()) . '" />';
        } else {
            $look .= '
					<img src="' . esc_url($no_cover) . '/images/no-cover/media.png" alt="no-cover" />';
        }
        $look .= '
					<div class="he-view">
						<div class="bgmedia a0" data-animate="zoomIn">';
        if ($youtube) {
            $look .= '
							<a href="http://youtu.be/' . esc_attr($youtube) . '" class="pv2-video a2" data-rel="prettyPhoto" data-animate="zoomIn"></a>';
        } elseif ($vimeo) {
            $look .= '
							<a href="http://vimeo.com/' . esc_attr($vimeo) . '" class="pv2-video a2" data-rel="prettyPhoto" data-animate="zoomIn"></a>';
        }
        $look .= '
							<div class="pv2-lv">
								' . wize_like_info($post->ID) . '
								<div class="info-view">' . wize_get_views(get_the_ID()) . '</div>
							</div><!-- end .pv2-lkvw -->
						</div><!-- end .bgw a0 -->
					</div><!-- end .he-view -->
				</div><!-- end .he-wrap he-wize -->
				<div class="pv2-info">
					<div class="pv2-title">	
						<h2><a href="' . esc_url(get_permalink()) . '">' . get_the_title() . '</a></h2>
					</div><!-- end .pv2-title -->';
        if ($venue) {
            $look .= '
					<div class="pv2-venue">' . esc_html($venue, "wizedesign") . '</div>';
        }
        if ($date) {
            $look .= '
					<div class="pv2-date">' . esc_html($day, "wizedesign") . ' ' . esc_html($month, "wizedesign") . ' ' . esc_html($year, "wizedesign") . '</div>';
        }
        $look .= '
				</div><!-- end .pv2-info -->
			</div><!-- end .pv2-cover -->
		</div><!-- end .pv2 -->';
		
    endwhile;
    
    $look .= '
	</div><!-- end .sh-width -->
	</div><!-- end .sh-media2 -->
	';
    
    wp_reset_postdata();
    
    return $look;
}

add_shortcode("video2", "wize_video2");