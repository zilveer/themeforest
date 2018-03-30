<?php

function wize_audio2($atts, $content) {
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
	<div class="sh-media2 fixed">
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
		<div class="ad2">
			<div class="ad2-cover">
				<div class="he-wrap he-wize">';
        if ($image_id) {
            $look .= '
					<img src="' . esc_url($cover[0]) . '" alt="' . esc_attr(get_the_title()) . '" />';
        } else {
            $look .= '
					<img src="' . esc_url($no_cover) . '/images/no-cover/audio.png" alt="no-cover" />';
        }
        $look .= '
					<div class="he-view">
						<div class="bgaudio a0" data-animate="zoomIn">
							<a href="' . esc_url(get_permalink()) . '" class="ad2-audio a2" data-animate="zoomIn"></a>	
							<div class="ad2-lv">
								' . wize_like_info($post->ID) . '
								<div class="info-view">' . wize_get_views(get_the_ID()) . '</div>
							</div><!-- end .ad2-lv -->
						</div><!-- end .bgaudio -->
					</div><!-- end .he-wrap he-wize -->		
				</div><!-- end .he-wrap he-wize -->
				<div class="pv2-info">
					<div class="ad2-title">	
						<h2><a href="' . esc_url(get_permalink()) . '">' . get_the_title() . '</a></h2>
					</div><!-- end .ad2-title -->';
        if ($genre) {
            $look .= '
					<div class="ad2-genre">' . esc_html($genre, "wizedesign") . '</div>';
        }
        if ($date) {
            $look .= '
					<div class="ad2-date">' . esc_html($day, "wizedesign") . ' ' . esc_html($month, "wizedesign") . ' ' . esc_html($year, "wizedesign") . '</div>';
        }
        $look .= '
				</div><!-- end .pv2-info -->
			</div><!-- end .ad2-cover -->
		</div><!-- end .ad2 -->';
		
    endwhile;
    
    $look .= '
	</div><!-- end .sh-width -->
	</div><!-- end .sh-media2 -->
	';
    
    wp_reset_postdata();
    
    return $look;
}

add_shortcode("audio2", "wize_audio2");