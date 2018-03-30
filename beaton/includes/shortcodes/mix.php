<?php

function wize_mix($atts, $content) {
    extract(shortcode_atts(array(
        "items" => 3,
        "cat" => null,
        "order" => "desc",
        "orderby" => "DATE"
    ), $atts));
    $order = strtoupper($order);
    $look  = null;
    $query = array(
        'post_type' => 'mix',
        'orderby' => $orderby,
        'order' => $order,
        'posts_per_page' => $items,
        'cat' => $cat
    );
    if ($cat) {
        $query = array(
            'post_type' => 'mix',
            'orderby' => $orderby,
            'order' => $order,
            'posts_per_page' => $items,
            'tax_query' => array(
                array(
                    'taxonomy' => 'mixes',
                    'field' => 'slug',
                    'terms' => array(
                        $cat
                    )
                )
            )
        );
    }
    $look .= '
	<div class="sh-media3 fixed">';
    $wp_query = new WP_Query($query);
    while ($wp_query->have_posts()):
        $wp_query->the_post();
        global $post;
        $image_id = get_post_thumbnail_id();
        $cover    = wp_get_attachment_image_src($image_id, 'SldFull');
		$coverMx  = wp_get_attachment_image_src($image_id, 'AdMx');
        $no_cover = get_template_directory_uri();
		$dj   	  = get_post_meta($post->ID, 'mx_dj', true);
		$genre    = get_post_meta($post->ID, 'mx_genre', true);
        $date     = get_post_meta($post->ID, 'mx_date', true);
		$sound      = get_post_meta($post->ID, 'mx_sd', true);
        $time     = strtotime($date);
        $year     = date('Y', $time);
        $month    = date('F', $time);
        $day      = date('d', $time);
		$player   = null;
        $playlist = null;
        $args     = array(
            'post_type' => 'attachment',
            'numberposts' => -1,
            'post_status' => null,
            'post_parent' => $post->ID
        );
        $attachments = get_posts($args);
        $arrImages =& get_children('post_type=attachment&orderby=title&order=ASC&post_mime_type=audio/mpeg&post_parent=' . get_the_ID());
        if ($arrImages) {
            foreach ($arrImages as $attachment) {
                $playlist .= '
				<a href="' . esc_url(wp_get_attachment_url($attachment->ID)) . '" class="fap-single-track mix-play no-ajax" title="' . esc_attr( $attachment->post_title) . '" rel="' . esc_attr($coverMx[0]) . '" data-meta="#player-meta-mix' . esc_attr($post->ID) . '"></a>';
            }
        }
		
				$playsdc .= '
				<a href="' . esc_url($sound) . '" class="fap-single-track mix-play no-ajax"></a>';

        /* display */
        
		$look .= '
		<div class="mix">
			<div class="mix-cover">
				<div class="mix-bg"></div>';
        if ($image_id) {
            $look .= '
				<img src="' . esc_url($cover[0]) . '" alt="' . esc_attr( get_the_title() ) . '" />';
        } else {
            $look .= '
				<img src="' . esc_url($no_cover) . '/images/no-cover/mix.png" alt="no-cover" />';
        }
		if ($sound) {
			$look .= ' ' . $playsdc . ' ';
		} else {
			$look .= ' ' . $playlist . ' ';
		}
        $look .= '
			</div><!-- end .mix-cover -->
			<div class="mix-lv">
				' . wize_like_info($post->ID) . '
				<div class="info-view">' . wize_get_views(get_the_ID()) . '</div>
			</div><!-- end .mix-lv -->
			<div class="mix-title">
				<h2><a href="' . esc_url( get_permalink() ) . '">';
        if (strlen($post->post_title) > 60) {
            $look .= substr(get_the_title($before = '', $after = '', FALSE), 0, 60) . '...';
        } else {
            $look .= get_the_title();
        }
        $look .= '</a></h2>';
		if ($date) {
			$look .= '				
				<span>' . esc_html($day, "wizedesign") . ' ' . esc_html($month, "wizedesign") . ' ' . esc_html($year, "wizedesign") . '</span>';
			}
		$look .= '
			</div><!-- end .mix-title -->
			<div class="mix-info">';
		if ($dj) {
			$look .= '
				<div class="mix-dj">' . esc_html($dj, "wizedesign") . '</div>';	
			}
		if ($genre) {
			$look .= '
				<div class="mix-genre">' . esc_html($genre, "wizedesign") . '</div>';	
			}
		$look .= '
			</div><!-- end .mix-info -->
		</div><!-- end .mix -->';
		
		$look .= ' 
        <span id="player-meta-mix' . esc_attr($post->ID) . '" class="player-meta-mix">
			<a href="' . esc_url(get_permalink()) . '#mixsng-tracklist">' . esc_html__("tracklist", "wizedesign") . '</a>
			<div>' . esc_html($genre, "wizedesign") . '</div>
        </span><!-- end span#player-meta-mix -->';
		
    endwhile;
    
    $look .= '
	</div><!-- end .sh-media3 -->
	';
    
    wp_reset_postdata();
    
    return $look;
}

add_shortcode("mix", "wize_mix");