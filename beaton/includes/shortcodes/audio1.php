<?php

function wize_audio1($atts, $content) {
    extract(shortcode_atts(array(
        "items" => 2,
        "cat" => null,
        "order" => "desc",
        "orderby" => "DATE"
    ), $atts));
    $order = strtoupper($order);
    $look  = null;
    $query = array(
        'post_type' => 'audio',
        'orderby' => $orderby,
        'order' => $order,
        'posts_per_page' => $items,
        'cat' => $cat
    );
    if ($cat) {
        $query = array(
            'post_type' => 'audio',
            'orderby' => $orderby,
            'order' => $order,
            'posts_per_page' => $items,
            'tax_query' => array(
                array(
                    'taxonomy' => 'audios',
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
        $cover    = wp_get_attachment_image_src($image_id, 'AdMx');
        $no_cover = get_template_directory_uri();
        $genre    = get_post_meta($post->ID, 'ad_genre', true);
        $date     = get_post_meta($post->ID, 'ad_release', true);
        $time     = strtotime($date);
        $year     = date('Y', $time);
        $month    = date('F', $time);
        $day      = date('d', $time);
        
        /* display */
        
        $look .= '
		<div class="ad1">
			<div class="ad1-cover">
				<div class="ad1-bg"></div>';
        if ($image_id) {
            $look .= '
				<img src="' . esc_url($cover[0]) . '" alt="' . esc_attr(get_the_title()) . '" />';
        } else {
            $look .= '
				<img src="' . esc_url($no_cover) . '/images/no-cover/audio.png" alt="no-cover" />';
        }
        $look .= '
				<div class="ad1-title">	
					<h2><a href="' . esc_url(get_permalink()) . '">' . get_the_title() . '</a></h2>';
        if ($genre) {
            $look .= '
					<div class="ad1-genre">' . esc_html($genre, "wizedesign") . '</div>';
        }
        $look .= '
				</div><!-- end .ad1-title -->
				<div class="ad1-lv">
					' . wize_like_info($post->ID) . '
					<div class="info-view">' . wize_get_views(get_the_ID()) . '</div>
				</div><!-- end .ad1-lv -->';
        if ($date) {
            $look .= '
				<div class="ad1-date">' . esc_html($day, "wizedesign") . ' ' . esc_html($month, "wizedesign") . ' ' . esc_html($year, "wizedesign") . '</div>';
        }
        $look .= '
			</div><!-- end .ad1-cover -->
		</div><!-- end .ad1 -->';
		
    endwhile;
    
    $look .= '
	</div><!-- end .sh-width -->
	</div><!-- end .sh-media1 -->
	';
    
    wp_reset_postdata();
    
    return $look;
}

add_shortcode("audio1", "wize_audio1");