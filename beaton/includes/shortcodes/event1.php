<?php

function wize_event1($atts, $content) {
    extract(shortcode_atts(array(
        "items" => 2,
        "cat" => null,
        "order" => "desc",
        "orderby" => "DATE"
    ), $atts));
    $look  = null;
    $query = array(
        'post_type' => 'event',
        'orderby' => $orderby,
        'order' => $order,
        'posts_per_page' => $items,
        'cat' => $cat
    );
    if ($cat) {
        $query = array(
            'post_type' => 'event',
            'orderby' => $orderby,
            'order' => $order,
            'posts_per_page' => $items,
            'tax_query' => array(
                array(
                    'taxonomy' => 'events',
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
		$theme 		= get_template_directory();
        $image_id   = get_post_thumbnail_id();
        $cover      = wp_get_attachment_image_src($image_id, 'Ev');
        $cover_full = wp_get_attachment_image_src($image_id, 'photo-large');
        $no_cover   = get_template_directory_uri();
        $venue      = get_post_meta($post->ID, 'ev_venue', true);
        $start      = get_post_meta($post->ID, 'ev_start', true);
        $end        = get_post_meta($post->ID, 'ev_end', true);
        $allday     = get_post_meta($post->ID, 'ev_allday', true);
        $coord 		= get_post_meta($post->ID, 'ev_coordinated', true);
        $date       = get_post_meta($post->ID, 'ev_date', true);
		require($theme.'/includes/language.php');
        $time       = strtotime($date);
        $day        = date('d', $time);
        $year       = date('Y', $time);
        $out        = get_post_meta($post->ID, 'ev_out', true);
        $cancel     = get_post_meta($post->ID, 'ev_cancel', true);
        $free       = get_post_meta($post->ID, 'ev_free', true);
        $disable    = get_post_meta($post->ID, 'ev_disable', true);
        $ticket_url = get_post_meta($post->ID, 'ev_ticket_url', true);
        $text       = get_post_meta($post->ID, 'ev_text', true);
        
        /* display */
        
        $look .= '
		<div class="ev1">
			<div class="ev1-cover">
				<div class="ev1-bg"></div>';
        if ($image_id) {
            $look .= '
				<img src="' . esc_url($cover[0]) . '" alt="' . esc_attr(get_the_title()) . '" />';
        } else {
            $look .= '
				<img src="' . esc_url($no_cover) . '/images/no-cover/ev1.png" alt="no-cover" />';
        }
        $look .= '
			
				<a href="' . esc_url( $cover_full[0] ) . '" class="ev1-zoom" data-rel="prettyPhoto-cover"></a>';
		if ($coord) {
			$look .= '
				<a href="http://maps.google.com/maps?q=' . esc_attr($coord) . '&output=embed?iframe=true&width=640&height=480" class="ev1-map" data-rel="prettyPhoto"></a>';
		}
		$look .= '
				<div class="ev1-title">';
		if ($date) {
			$look .= '
					<div class="ev1-dmy">
						' . esc_html($day, "wizedesign") . ' ' . esc_html($month, "wizedesign") . '<span>' . esc_html($year, "wizedesign") . '</span>
						<div class="ev1-week">' . esc_html($week, "wizedesign") . '</div>
					</div><!-- end .ev1-dmy -->';
		}
		$look .= '
					<h2><a href="' . esc_url(get_permalink()) . '">' . get_the_title() . '</a></h2>
				</div><!-- end .ev1-title -->
				<div class="ev1-info">';
		if ($venue) {
			$look .= '
					<div class="ev1-venue">' . esc_html($venue, "wizedesign") . '</div>';
		}
        if ($allday == 'yes') {
            $look .= '
					<div class="ev1-time">' . esc_html__("All Day", "wizedesign") . '</div>';
        } elseif ($start != null) {
            $look .= '
					<div class="ev1-time">' . esc_html($start, "wizedesign") . '';
            if ($end != null) {
                $look .= ' - ';
            }
            $look .= '' . esc_html($end, "wizedesign") . '</div>';
        }
        $look .= '
				</div><!-- end .ev1-info -->
				<div class="ev1-bn">';
        if ($disable == 'no') {
            if ($text) {
                $look .= '
					<a href="' . esc_url($ticket_url) . '" class="ev1-button">' . esc_html($text, "wizedesign") . '</a>';
            } else {
                if ($out == 'yes') {
                    $look .= '
					<div class="ev1-none">' . esc_html__('Sold Out', 'wizedesign') . '</div>';
                } elseif ($cancel == 'yes') {
                    $look .= '
					<div class="ev1-none">' . esc_html__('Canceled', 'wizedesign') . '</div>';
                } elseif ($free == 'yes') {
                    $look .= '
					<div class="ev1-none">' . esc_html__('Free Entry', 'wizedesign') . '</div>';
                } else {
                    $look .= '
					<a href="' . esc_url($ticket_url) . '" class="ev1-button">' . esc_html__("Buy Tickets", "wizedesign") . '</a>';
                }
            }
        }
        $look .= '		
				</div><!-- end .ev1-bn -->
				<div class="ev1-lv">
					' . wize_like_info($post->ID) . '
					<div class="info-view">' . wize_get_views(get_the_ID()) . '</div>
				</div><!-- end .ev1-lv -->
			</div><!-- end .ev1-cover -->
		</div><!-- end .ev1 -->';
		
    endwhile;
    
    $look .= '
	</div><!-- end .sh-width -->
	</div><!-- end .sh-media1 -->
	';
    
    wp_reset_postdata();
    
    return $look;
}

add_shortcode("event1", "wize_event1");

function wize_event1up($atts, $content) {
    extract(shortcode_atts(array(
        "items" => 2,
        "cat" => null
    ), $atts));
    $look  = null;
    $query = array(
		'post_type' => 'event',
        'orderby' => 'meta_value',
		'order' => 'ASC',
        'meta_key' => 'ev_date',
		'meta_value' => strftime("%Y/%m/%d", time() - (60 * 60 * 24)),
        'meta_compare' => '>',
        'posts_per_page' => $items,
		'cat' => $cat
    );
    if ($cat) {
        $query = array(
			'post_type' => 'event',
			'orderby' => 'meta_value',
			'order' => 'ASC',
			'meta_key' => 'ev_date',
			'meta_value' => strftime("%Y/%m/%d", time() - (60 * 60 * 24)),
			'meta_compare' => '>',
			'posts_per_page' => $items,
            'tax_query' => array(
                array(
                    'taxonomy' => 'events',
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
		$theme 		= get_template_directory();
        $image_id   = get_post_thumbnail_id();
        $cover      = wp_get_attachment_image_src($image_id, 'Ev');
        $cover_full = wp_get_attachment_image_src($image_id, 'photo-large');
        $no_cover   = get_template_directory_uri();
        $venue      = get_post_meta($post->ID, 'ev_venue', true);
        $start      = get_post_meta($post->ID, 'ev_start', true);
        $end        = get_post_meta($post->ID, 'ev_end', true);
        $allday     = get_post_meta($post->ID, 'event_allday', true);
        $coord 		= get_post_meta($post->ID, "ev_coordinated", true);
        $date       = get_post_meta($post->ID, 'ev_date', true);
		require($theme.'/includes/language.php');
        $time       = strtotime($date);
        $day        = date('d', $time);
        $year       = date('Y', $time);
        $out        = get_post_meta($post->ID, 'ev_out', true);
        $cancel     = get_post_meta($post->ID, 'ev_cancel', true);
        $free       = get_post_meta($post->ID, 'ev_free', true);
        $disable    = get_post_meta($post->ID, 'ev_disable', true);
        $ticket_url = get_post_meta($post->ID, 'ev_ticket_url', true);
        $text       = get_post_meta($post->ID, 'ev_text', true);
        
        /* display */
        
        $look .= '
		<div class="ev1">
			<div class="ev1-cover">
				<div class="ev1-bg"></div>';
        if ($image_id) {
            $look .= '
				<img src="' . esc_url($cover[0]) . '" alt="' . esc_attr(get_the_title()) . '" />';
        } else {
            $look .= '
				<img src="' . esc_url($no_cover) . '/images/no-cover/ev1.png" alt="no-cover" />';
        }
        $look .= '
			
				<a href="' . esc_url( $cover_full[0] ) . '" class="ev1-zoom" data-rel="prettyPhoto-cover"></a>';
		if ($coord) {
			$look .= '
				<a href="http://maps.google.com/maps?q=' . esc_attr($coord) . '&output=embed?iframe=true&width=640&height=480" class="ev1-map" data-rel="prettyPhoto"></a>';
		}
		$look .= '
				<div class="ev1-title">';
		if ($date) {
			$look .= '
					<div class="ev1-dmy">
						' . esc_html($day, "wizedesign") . ' ' . esc_html($month, "wizedesign") . '<span>' . esc_html($year, "wizedesign") . '</span>
						<div class="ev1-week">' . esc_html($week, "wizedesign") . '</div>
					</div><!-- end .ev1-dmy -->';
		}
		$look .= '
					<h2><a href="' . esc_url(get_permalink()) . '">' . get_the_title() . '</a></h2>
				</div><!-- end .ev1-title -->
				<div class="ev1-info">';
		if ($venue) {
			$look .= '
					<div class="ev1-venue">' . esc_html($venue, "wizedesign") . '</div>';
		}
        if ($allday == 'yes') {
            $look .= '
					<div class="ev1-time">' . esc_html__("All Day", "wizedesign") . '</div>';
        } elseif ($start != null) {
            $look .= '
					<div class="ev1-time">' . esc_html($start, "wizedesign") . '';
            if ($end != null) {
                $look .= ' - ';
            }
            $look .= '' . esc_html($end, "wizedesign") . '</div>';
        }
        $look .= '
				</div><!-- end .ev1-info -->
				<div class="ev1-bn">';
        if ($disable == 'no') {
            if ($text) {
                $look .= '
					<a href="' . esc_url($ticket_url) . '" class="ev1-button">' . esc_html($text, "wizedesign") . '</a>';
            } else {
                if ($out == 'yes') {
                    $look .= '
					<div class="ev1-none">' . esc_html__('Sold Out', 'wizedesign') . '</div>';
                } elseif ($cancel == 'yes') {
                    $look .= '
					<div class="ev1-none">' . esc_html__('Canceled', 'wizedesign') . '</div>';
                } elseif ($free == 'yes') {
                    $look .= '
					<div class="ev1-none">' . esc_html__('Free Entry', 'wizedesign') . '</div>';
                } else {
                    $look .= '
					<a href="' . esc_url($ticket_url) . '" class="ev1-button">' . esc_html__("Buy Tickets", "wizedesign") . '</a>';
                }
            }
        }
        $look .= '		
				</div><!-- end .ev1-bn -->
				<div class="ev1-lv">
					' . wize_like_info($post->ID) . '
					<div class="info-view">' . wize_get_views(get_the_ID()) . '</div>
				</div><!-- end .ev1-lv -->
			</div><!-- end .ev1-cover -->
		</div><!-- end .ev1 -->';
		
    endwhile;
    
    $look .= '
	</div><!-- end .sh-width -->
	</div><!-- end .sh-media1 -->
	';
    
    wp_reset_postdata();
    
    return $look;
}

add_shortcode("event1up", "wize_event1up");

function wize_event1past($atts, $content) {
    extract(shortcode_atts(array(
        "items" => 2,
        "cat" => null
    ), $atts));
    $look  = null;
    $query = array(
		'post_type' => 'event',
        'orderby' => 'meta_value',
		'order' => 'DESC',
        'meta_key' => 'ev_date',
		'meta_value' => strftime("%Y/%m/%d", time() - (60 * 60 * 24)),
        'meta_compare' => '<',
        'posts_per_page' => $items,
		'cat' => $cat
    );
    if ($cat) {
        $query = array(
			'post_type' => 'event',
			'orderby' => 'meta_value',
			'order' => 'DESC',
			'meta_key' => 'ev_date',
			'meta_value' => strftime("%Y/%m/%d", time() - (60 * 60 * 24)),
			'meta_compare' => '<',
			'posts_per_page' => $items,
            'tax_query' => array(
                array(
                    'taxonomy' => 'events',
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
		$theme 		= get_template_directory();
        $image_id   = get_post_thumbnail_id();
        $cover      = wp_get_attachment_image_src($image_id, 'Ev');
        $cover_full = wp_get_attachment_image_src($image_id, 'photo-large');
        $no_cover   = get_template_directory_uri();
        $venue      = get_post_meta($post->ID, 'ev_venue', true);
        $start      = get_post_meta($post->ID, 'ev_start', true);
        $end        = get_post_meta($post->ID, 'ev_end', true);
        $allday     = get_post_meta($post->ID, 'event_allday', true);
        $coord 		= get_post_meta($post->ID, "ev_coordinated", true);
        $date       = get_post_meta($post->ID, 'ev_date', true);
		require($theme.'/includes/language.php');
        $time       = strtotime($date);
        $day        = date('d', $time);
        $year       = date('Y', $time);
        $out        = get_post_meta($post->ID, 'ev_out', true);
        $cancel     = get_post_meta($post->ID, 'ev_cancel', true);
        $free       = get_post_meta($post->ID, 'ev_free', true);
        $disable    = get_post_meta($post->ID, 'ev_disable', true);
        $ticket_url = get_post_meta($post->ID, 'ev_ticket_url', true);
        $text       = get_post_meta($post->ID, 'ev_text', true);
        
        /* display */
        
        $look .= '
		<div class="ev1">
			<div class="ev1-cover">
				<div class="ev1-bg"></div>';
        if ($image_id) {
            $look .= '
				<img src="' . esc_url($cover[0]) . '" alt="' . esc_attr(get_the_title()) . '" />';
        } else {
            $look .= '
				<img src="' . esc_url($no_cover) . '/images/no-cover/ev1.png" alt="no-cover" />';
        }
        $look .= '
			
				<a href="' . esc_url( $cover_full[0] ) . '" class="ev1-zoom" data-rel="prettyPhoto-cover"></a>';
		if ($coord) {
			$look .= '
				<a href="http://maps.google.com/maps?q=' . esc_attr($coord) . '&output=embed?iframe=true&width=640&height=480" class="ev1-map" data-rel="prettyPhoto"></a>';
		}
		$look .= '
				<div class="ev1-title">';
		if ($date) {
			$look .= '
					<div class="ev1-dmy">
						' . esc_html($day, "wizedesign") . ' ' . esc_html($month, "wizedesign") . '<span>' . esc_html($year, "wizedesign") . '</span>
						<div class="ev1-week">' . esc_html($week, "wizedesign") . '</div>
					</div><!-- end .ev1-dmy -->';
		}
		$look .= '
					<h2><a href="' . esc_url(get_permalink()) . '">' . get_the_title() . '</a></h2>
				</div><!-- end .ev1-title -->
				<div class="ev1-info">';
		if ($venue) {
			$look .= '
					<div class="ev1-venue">' . esc_html($venue, "wizedesign") . '</div>';
		}
        if ($allday == 'yes') {
            $look .= '
					<div class="ev1-time">' . esc_html__("All Day", "wizedesign") . '</div>';
        } elseif ($start != null) {
            $look .= '
					<div class="ev1-time">' . esc_html($start, "wizedesign") . '';
            if ($end != null) {
                $look .= ' - ';
            }
            $look .= '' . esc_html($end, "wizedesign") . '</div>';
        }
        $look .= '
				</div><!-- end .ev1-info -->
				<div class="ev1-bn">';
        if ($disable == 'no') {
            if ($text) {
                $look .= '
					<a href="' . esc_url($ticket_url) . '" class="ev1-button">' . esc_html($text, "wizedesign") . '</a>';
            } else {
                if ($out == 'yes') {
                    $look .= '
					<div class="ev1-none">' . esc_html__('Sold Out', 'wizedesign') . '</div>';
                } elseif ($cancel == 'yes') {
                    $look .= '
					<div class="ev1-none">' . esc_html__('Canceled', 'wizedesign') . '</div>';
                } elseif ($free == 'yes') {
                    $look .= '
					<div class="ev1-none">' . esc_html__('Free Entry', 'wizedesign') . '</div>';
                } else {
                    $look .= '
					<a href="' . esc_url($ticket_url) . '" class="ev1-button">' . esc_html__("Buy Tickets", "wizedesign") . '</a>';
                }
            }
        }
        $look .= '		
				</div><!-- end .ev1-bn -->
				<div class="ev1-lv">
					' . wize_like_info($post->ID) . '
					<div class="info-view">' . wize_get_views(get_the_ID()) . '</div>
				</div><!-- end .ev1-lv -->
			</div><!-- end .ev1-cover -->
		</div><!-- end .ev1 -->';
		
    endwhile;
    
    $look .= '
	</div><!-- end .sh-width -->
	</div><!-- end .sh-media1 -->
	';
    
    wp_reset_postdata();
    
    return $look;
}

add_shortcode("event1past", "wize_event1past");