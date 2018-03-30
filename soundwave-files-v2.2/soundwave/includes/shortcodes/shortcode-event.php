<?php
add_shortcode("event1sty", "event1style_shortcode");
add_shortcode("event2sty", "event2style_shortcode");
add_shortcode("event1up", "event1up_shortcode");
add_shortcode("event1past", "event1past_shortcode");
add_shortcode("event2up", "event2up_shortcode");
add_shortcode("event2past", "event2past_shortcode");
function event1style_shortcode($atts, $content) {
    extract(shortcode_atts(array(
        "items" => 2,
        "cat" => null,
        "id" => null,
        "nav" => false,
        "order" => "desc",
        "orderby" => "ID",
        "events" => null
    ), $atts));
    $order       = strtoupper($order);
    $items_count = 0;
    $items_src   = null;
    if ($id == null) {
        $query = array(
            'post_type' => 'event',
            'orderby' => $orderby,
            'order' => $order,
            'posts_per_page' => $items
        );
	if ($cat) {
     $query = array(
        'posts_per_page' => $items, 
        'orderby' => $orderby,
		'order' => $order,
        'post_type' => 'event',
        'tax_query' => array(
            array(
                'taxonomy' => 'events',
                'field' => 'slug',
                'terms' => array($cat)
            )));
    }
        $wp_query_event = new WP_Query($query);
    }
    $items_src .= '
   <div class="home-shr clearfix">
      <div class="home-width">';
    while ($wp_query_event->have_posts()):
        $wp_query_event->the_post();
        global $post;
        $data_event     = get_post_meta($post->ID, 'event_date_interval', true);
		$data_finish    = get_post_meta($post->ID, 'event_date_interval_finish', true);
        $time           = strtotime($data_event);
		$time_finish    = strtotime($data_finish);
        $image_id       = get_post_thumbnail_id();
        $cover          = wp_get_attachment_image_src($image_id, 'event-style1');
        $cover_large    = wp_get_attachment_image_src($image_id, 'photo-large');
        $tstart         = get_post_meta($post->ID, 'event_tstart', true);
        $tend           = get_post_meta($post->ID, 'event_tend', true);
        $ev_location    = get_post_meta($post->ID, "event_location", true);
        $ev_venue       = get_post_meta($post->ID, "event_venue", true);
        $custom         = get_post_custom($post->ID);
        $event_ticket   = $custom["event_ticket"][0];
        $date_yy = date('Y', $time);
        $date_d  = date('d', $time);
		$date_yy_finish = date('Y', $time_finish);
		$date_d_finish  = date('d', $time_finish);
		$theme = get_template_directory();
		require($theme.'/includes/language.php');
        $ev_text        = get_post_meta($post->ID, "ev_text", true);
        $no_cover       = get_template_directory_uri();
		$event_allday   = get_post_meta($post->ID, "event_allday", true, true);
        $items_src .= '
         <div class="ev1shr-col">
            <div class="ev1shr-cover">
               <div class="wz-wrap wz-hover">';
        if ($image_id) {
            $items_src .= '
                  <img src="' . $cover[0] . '" alt="' . get_the_title() . '" />';
        } else {
            $items_src .= '
                  <img src="' . $no_cover . '/images/no-cover/event-1arc.png" alt="no image" />';
        }
        $items_src .= '	
                  <div class="he-view">
                     <div class="bg a1" data-animate="fadeIn">	
                        <a href="' . get_permalink() . '" class="ev1shr-link a2" data-animate="zoomIn"></a>
                        <a href="' . $cover_large[0] . '" class="ev1shr-zoom a2" data-animate="zoomIn" data-rel="prettyPhoto-cover"></a>';  
	if (get_post_meta($post->ID, 'event_disable', true) == 'no') {
        if ($ev_text) {    
            $items_src .= '
                        <div class="ev1shr-tickets"><a href="' . $event_ticket . '" target="_blank">' . $ev_text . '</a></div>';   
        } else {
            if (get_post_meta($post->ID, 'event_out', true) == 'yes') {
                $items_src .= '
                        <div class="ev1shr-cancel">' . __('Sold Out', 'wizedesign') . '</div>';
            } elseif (get_post_meta($post->ID, 'event_cancel', true) == 'yes') {
                $items_src .= '
                        <div class="ev1shr-cancel">' . __('Canceled', 'wizedesign') . '</div>';
            } elseif (get_post_meta($post->ID, 'event_free', true) == 'yes') {
                $items_src .= '
                        <div class="ev1shr-cancel">' . __('Free Entry', 'wizedesign') . '</div>';
            } else {
                $items_src .= '
                        <div class="ev1shr-tickets"><a href="' . $event_ticket . '" >' . __('Buy Tickets', 'wizedesign') . '</a></div><!-- end #event-tickets -->';
            }
        }
	}
        $items_src .= '	
                     </div>
                  </div>	
               </div>			
            </div><!-- end .ev1shr-cover -->';     
        $items_src .= '
            <div class="ev1shr-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></div>
            <div class="ev1shr-info">
			<div class="ev1shr-information">';
		if ($ev_location != null) {		   
			$items_src .= '
               <div class="ev1shr-location">' . $ev_location . '</div>'; 
		}
		if ($ev_venue != null) {		   
			$items_src .= '
               <div class="ev1shr-venue">' . $ev_venue . '</div>';  
		}
		if ($event_allday == 'yes') {            
            $items_src .= '
                   <div class="ev1shr-hour">' . __('All Day', 'wizedesign') . '</div>';
		} elseif ($tstart != null) {
            $items_src .= '
                   <div class="ev1shr-hour">' . $tstart . '';
				if ($tend != null) {
                $items_src .= ' - ';
            }
            $items_src .= '' . $tend . '</div>';
		}  
        $items_src .= '
			 </div> 
               <div class="ev1shr-data">';
			if ($data_finish != null) {
				$items_src .= '  
                     <div class="ev1page-finish">' . $date_d . ' ' . $date_M . '</div>
					 <div class="ev1page-sep">-</div>
                     <div class="ev1page-finish">' . $date_d_finish . ' ' . $date_M_finish . '</div>';
			} elseif ($data_event != null) {
				$items_src .= '
                     <div class="ev1shr-day">' . $date_d . ' ' . $date_M . '</div>
                     <div class="ev1shr-week">' . $date_w . '</div>';
			}
		$items_src .= '
               </div>
		    </div><!-- end .ev1shr-info -->
         </div><!-- end .ev1shr-col -->     ';
    endwhile;
    wp_reset_query();
    $items_src .= '
      </div><!-- end .home-width -->
   </div><!-- end .home-shr clearfix -->';
    return $items_src;
}
function event2style_shortcode($atts, $content) {
    extract(shortcode_atts(array(
        "items" => 2,
        "cat" => null,
        "id" => null,
        "nav" => false,
        "order" => "desc",
        "orderby" => "ID",
        "events" => null
    ), $atts));
    $order       = strtoupper($order);
    $items_count = 0;
    $items_src   = null;
    if ($id == null) {
        $query = array(
            'post_type' => 'event',
            'orderby' => $orderby,
            'order' => $order,
            'posts_per_page' => $items
        );
	if ($cat) {
     $query = array(
        'posts_per_page' => $items, 
        'orderby' => $orderby,
		'order' => $order,
        'post_type' => 'event',
        'tax_query' => array(
            array(
                'taxonomy' => 'events',
                'field' => 'slug',
                'terms' => array($cat)
            )));
    }
        $wp_query_event = new WP_Query($query);
    }
    $items_src .= '
   <div class="home-shr clearfix">
      <div class="home-width">';
    while ($wp_query_event->have_posts()):
        $wp_query_event->the_post();
        global $post;
        $image_id       = get_post_thumbnail_id();
        $cover          = wp_get_attachment_image_src($image_id, 'event-style2');
        $cover_large    = wp_get_attachment_image_src($image_id, 'photo-large');
        $image_large    = wp_get_attachment_image_src($image_id, 'large');
        $data_event     = get_post_meta($post->ID, 'event_date_interval', true);
		$data_finish    = get_post_meta($post->ID, 'event_date_interval_finish', true);
        $time           = strtotime($data_event);
		$time_finish    = strtotime($data_finish);
        $tstart         = get_post_meta($post->ID, "event_tstart", true);
        $tend           = get_post_meta($post->ID, "event_tend", true);
        $ev_venue       = get_post_meta($post->ID, "event_venue", true);
        $custom         = get_post_custom($post->ID);
        $event_ticket   = $custom["event_ticket"][0];
        $date_yy = date('Y', $time);
        $date_d  = date('d', $time);
		$date_yy_finish = date('Y', $time_finish);
		$date_d_finish  = date('d', $time_finish);
		$theme = get_template_directory();
		require($theme.'/includes/language.php');
        $ev_text        = get_post_meta($post->ID, "ev_text", true);
        $no_cover       = get_template_directory_uri();
		$event_allday   = get_post_meta($post->ID, "event_allday", true, true);
        $items_src .= '
         <div class="ev2shr-col">';  
			if ($data_finish != null) {
				$items_src .= ' 
			   <div class="ev2page-data-finish">
				  <div class="ev2page-finish">' . $date_d . ' ' . $date_M . '</div>
				  <div class="ev2page-sep">-</div>
                  <div class="ev2page-finish">' . $date_d_finish . ' ' . $date_M_finish . '</div>
			   </div><!-- end .ev2page-data-finish -->';
			} elseif ($data_event != null) {
				$items_src .= ' 		 
			   <div class="ev2shr-data">
                  <div class="ev2shr-day">' . $date_d . '</div>
                  <div class="ev2shr-month">' . $date_M . '</div>
                  <div class="ev2shr-year">' . $date_yy . '</div>
			   </div><!-- end .ev2shr-data -->';  
			}
		$items_src .= '
            <div class="ev2shr-cover">
               <div class="wz-wrap wz-hover">';
        if ($image_id) {
            $items_src .= '
                  <img src="' . $cover[0] . '" alt="' . get_the_title() . '" />';
        } else {
            $items_src .= '
                  <img src="' . $no_cover . '/images/no-cover/event-2arc.png" alt="no image" />';
        }
        $items_src .= '	
                  <div class="he-view">
                     <div class="bg a1" data-animate="fadeIn">
                        <a href="' . get_permalink() . '" class="ev2shr-link a2" data-animate="zoomIn"></a>
                        <a href="' . $cover_large[0] . '" class="ev2shr-zoom a2" data-animate="zoomIn" data-rel="prettyPhoto-cover"></a>						
                     </div>
                  </div>	
               </div>		
            </div><!-- end .ev2shr-cover -->   
            <h2 class="ev2shr-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>
            <div class="ev2shr-info">';
		if ($event_allday == 'yes') {            
            $items_src .= '
                   <div class="ev2shr-hour">' . __('All Day', 'wizedesign') . '</div>';
		} elseif ($tstart != null) {
            $items_src .= '
                   <div class="ev2shr-hour">' . $tstart . '';
				if ($tend != null) {
                $items_src .= ' - ';
            }
            $items_src .= '' . $tend . '</div>';
		}  
		if ($ev_venue != null) {	
			$items_src .= '	
               <div class="ev2shr-venue">' . $ev_venue . '</div>';
		}	   
        $items_src .= '
            </div><!-- end .ev2shr-info -->';
        $items_src .= 
            '<p>' . the_excerpt_max(165) . '</p>';
	if (get_post_meta($post->ID, 'event_disable', true) == 'no') {
        if ($ev_text) {
            $items_src .= '
            <div class="ev2shr-tickets"><a href="' . $event_ticket . '" target="_blank">' . $ev_text . '</a></div>'; 
        } else {
            if (get_post_meta($post->ID, 'event_out', true) == 'yes') {
                $items_src .= '
            <div class="ev2shr-cancel">' . __('Sold Out', 'wizedesign') . '</div>';
            } elseif (get_post_meta($post->ID, 'event_cancel', true) == 'yes') {
                $items_src .= '
            <div class="ev2shr-cancel">' . __('Canceled', 'wizedesign') . '</div>';
            } elseif (get_post_meta($post->ID, 'event_free', true) == 'yes') {
                $items_src .= '
            <div class="ev2shr-cancel">' . __('Free Entry', 'wizedesign') . '</div>';
            } else {
                $items_src .= '
            <div class="ev2shr-tickets"><a href="' . $event_ticket . '" >' . __('Buy Tickets', 'wizedesign') . '</a></div>';
            }
        }
	}
        $items_src .= '    
            <div class="ev2shr-week">' . $date_w . '</div>
         </div><!-- end .ev2shr-col -->';
    endwhile;
    $items_src .= '
      </div><!-- end .home-width -->
   </div><!-- end .home-shr clearfix -->';
    return $items_src;
}
function event1up_shortcode($atts, $content) {
    extract(shortcode_atts(array(
        "items" => 2,
        "cat" => null,
        "id" => null,
        "nav" => false,
        "order" => "asc",
        "events" => null
    ), $atts));
    $order       = strtoupper($order);
    $items_count = 0;
    $items_src   = null;
    if ($id == null) {
        $query = array(
            'post_type' => 'event',
            'orderby' => 'meta_value',
            'order' => $order,
		    'meta_key' => 'event_date_interval',
			'meta_value' => strftime("%Y/%m/%d", time()- (60 * 60 * 24) ),
			'meta_compare' => '>',
            'posts_per_page' => $items,
        );
	if ($cat) {
     $query = array(
        'posts_per_page' => $items, 
        'orderby' => 'meta_value',
		'meta_value' => strftime("%Y/%m/%d", time()- (60 * 60 * 24) ),
		'meta_key' => 'event_date_interval',
		'meta_compare' => '>',
		'order' => $order,
        'post_type' => 'event',
        'tax_query' => array(
            array(
                'taxonomy' => 'events',
                'field' => 'slug',
                'terms' => array($cat)
            )));
    }
        $wp_query_event = new WP_Query($query);
    }
    $items_src .= '
   <div class="home-shr clearfix">
      <div class="home-width">';
    while ($wp_query_event->have_posts()):
        $wp_query_event->the_post();
        global $post;
        $data_event     = get_post_meta($post->ID, 'event_date_interval', true);
		$data_finish    = get_post_meta($post->ID, 'event_date_interval_finish', true);
        $time           = strtotime($data_event);
		$time_finish    = strtotime($data_finish);
        $image_id       = get_post_thumbnail_id();
        $cover          = wp_get_attachment_image_src($image_id, 'event-style1');
        $cover_large    = wp_get_attachment_image_src($image_id, 'photo-large');
        $tstart         = get_post_meta($post->ID, 'event_tstart', true);
        $tend           = get_post_meta($post->ID, 'event_tend', true);
        $ev_location    = get_post_meta($post->ID, "event_location", true);
        $ev_venue       = get_post_meta($post->ID, "event_venue", true);
        $custom         = get_post_custom($post->ID);
        $event_ticket   = $custom["event_ticket"][0];
        $date_yy = date('Y', $time);
        $date_d  = date('d', $time);
		$date_yy_finish = date('Y', $time_finish);
		$date_d_finish  = date('d', $time_finish);
		$theme = get_template_directory();
		require($theme.'/includes/language.php');
        $ev_text        = get_post_meta($post->ID, "ev_text", true);
        $no_cover       = get_template_directory_uri();
		$event_allday   = get_post_meta($post->ID, "event_allday", true, true);
        $items_src .= '
         <div class="ev1shr-col">
            <div class="ev1shr-cover">
               <div class="wz-wrap wz-hover">';
        if ($image_id) {
            $items_src .= '
                  <img src="' . $cover[0] . '" alt="' . get_the_title() . '" />';
        } else {
            $items_src .= '
                  <img src="' . $no_cover . '/images/no-cover/event-1arc.png" alt="no image" />';
        }
        $items_src .= '	
                  <div class="he-view">
                     <div class="bg a1" data-animate="fadeIn">	
                        <a href="' . get_permalink() . '" class="ev1shr-link a2" data-animate="zoomIn"></a>
                        <a href="' . $cover_large[0] . '" class="ev1shr-zoom a2" data-animate="zoomIn" data-rel="prettyPhoto-cover"></a>';  
	if (get_post_meta($post->ID, 'event_disable', true) == 'no') {
        if ($ev_text) {    
            $items_src .= '
                        <div class="ev1shr-tickets"><a href="' . $event_ticket . '" target="_blank">' . $ev_text . '</a></div>';   
        } else {
            if (get_post_meta($post->ID, 'event_out', true) == 'yes') {
                $items_src .= '
                        <div class="ev1shr-cancel">' . __('Sold Out', 'wizedesign') . '</div>';
            } elseif (get_post_meta($post->ID, 'event_cancel', true) == 'yes') {
                $items_src .= '
                        <div class="ev1shr-cancel">' . __('Canceled', 'wizedesign') . '</div>';
            } elseif (get_post_meta($post->ID, 'event_free', true) == 'yes') {
                $items_src .= '
                        <div class="ev1shr-cancel">' . __('Free Entry', 'wizedesign') . '</div>';
            } else {
                $items_src .= '
                        <div class="ev1shr-tickets"><a href="' . $event_ticket . '" >' . __('Buy Tickets', 'wizedesign') . '</a></div><!-- end #event-tickets -->';
            }
        }
	}
        $items_src .= '	
                     </div>
                  </div>	
               </div>			
            </div><!-- end .ev1shr-cover -->';     
        $items_src .= '
            <div class="ev1shr-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></div>
            <div class="ev1shr-info">
			<div class="ev1shr-information">';
		if ($ev_location != null) {		   
			$items_src .= '
               <div class="ev1shr-location">' . $ev_location . '</div>'; 
		}
		if ($ev_venue != null) {		   
			$items_src .= '
               <div class="ev1shr-venue">' . $ev_venue . '</div>';  
		}
		if ($event_allday == 'yes') {            
            $items_src .= '
                   <div class="ev1shr-hour">' . __('All Day', 'wizedesign') . '</div>';
		} elseif ($tstart != null) {
            $items_src .= '
                   <div class="ev1shr-hour">' . $tstart . '';
				if ($tend != null) {
                $items_src .= ' - ';
            }
            $items_src .= '' . $tend . '</div>';
		}
        $items_src .= '
			 </div> 
               <div class="ev1shr-data">';
			if ($data_finish != null) {
				$items_src .= '  
                    <div class="ev1page-finish">' . $date_d . ' ' . $date_M . '</div>
					<div class="ev1page-sep">-</div>
                    <div class="ev1page-finish">' . $date_d_finish . ' ' . $date_M_finish . '</div>';
			} elseif ($data_event != null) {
				$items_src .= '
                    <div class="ev1shr-day">' . $date_d . ' ' . $date_M . '</div>
                    <div class="ev1shr-week">' . $date_w . '</div>';
			}
		$items_src .= ' 
               </div>
		    </div><!-- end .ev1shr-info -->
         </div><!-- end .ev1shr-col -->     ';
    endwhile;
    wp_reset_query();
    $items_src .= '
      </div><!-- end .home-width -->
   </div><!-- end .home-shr clearfix -->';
    return $items_src;
}
function event1past_shortcode($atts, $content) {
    extract(shortcode_atts(array(
        "items" => 2,
        "cat" => null,
        "id" => null,
        "nav" => false,
        "order" => "desc",
        "events" => null
    ), $atts));
    $order       = strtoupper($order);
    $items_count = 0;
    $items_src   = null;
    if ($id == null) {
        $query = array(
            'post_type' => 'event',
            'orderby' => 'meta_value',
            'order' => $order,
		    'meta_key' => 'event_date_interval',
			'meta_value' => strftime("%Y/%m/%d", time()- (60 * 60 * 24) ),
			'meta_compare' => '<',
            'posts_per_page' => $items,
        );
	if ($cat) {
     $query = array(
        'posts_per_page' => $items, 
        'orderby' => 'meta_value',
		'meta_value' => strftime("%Y/%m/%d", time()- (60 * 60 * 24) ),
		'meta_key' => 'event_date_interval',
		'meta_compare' => '>',
		'order' => $order,
        'post_type' => 'event',
        'tax_query' => array(
            array(
                'taxonomy' => 'events',
                'field' => 'slug',
                'terms' => array($cat)
            )));
    }
        $wp_query_event = new WP_Query($query);
    }
    $items_src .= '
   <div class="home-shr clearfix">
      <div class="home-width">';
    while ($wp_query_event->have_posts()):
        $wp_query_event->the_post();
        global $post;
        $data_event     = get_post_meta($post->ID, 'event_date_interval', true);
		$data_finish    = get_post_meta($post->ID, 'event_date_interval_finish', true);
        $time           = strtotime($data_event);
		$time_finish    = strtotime($data_finish);
        $image_id       = get_post_thumbnail_id();
        $cover          = wp_get_attachment_image_src($image_id, 'event-style1');
        $cover_large    = wp_get_attachment_image_src($image_id, 'photo-large');
        $tstart         = get_post_meta($post->ID, 'event_tstart', true);
        $tend           = get_post_meta($post->ID, 'event_tend', true);
        $ev_location    = get_post_meta($post->ID, "event_location", true);
        $ev_venue       = get_post_meta($post->ID, "event_venue", true);
        $custom         = get_post_custom($post->ID);
        $event_ticket   = $custom["event_ticket"][0];
        $date_yy = date('Y', $time);
        $date_d  = date('d', $time);
		$date_yy_finish = date('Y', $time_finish);
		$date_d_finish  = date('d', $time_finish);
		$theme = get_template_directory();
		require($theme.'/includes/language.php');
        $ev_text        = get_post_meta($post->ID, "ev_text", true);
        $no_cover       = get_template_directory_uri();
		$event_allday   = get_post_meta($post->ID, "event_allday", true, true);
        $items_src .= '
         <div class="ev1shr-col">
            <div class="ev1shr-cover">
               <div class="wz-wrap wz-hover">';
        if ($image_id) {
            $items_src .= '
                  <img src="' . $cover[0] . '" alt="' . get_the_title() . '" />';
        } else {
            $items_src .= '
                  <img src="' . $no_cover . '/images/no-cover/event-1arc.png" alt="no image" />';
        }
        $items_src .= '	
                  <div class="he-view">
                     <div class="bg a1" data-animate="fadeIn">	
                        <a href="' . get_permalink() . '" class="ev1shr-link a2" data-animate="zoomIn"></a>
                        <a href="' . $cover_large[0] . '" class="ev1shr-zoom a2" data-animate="zoomIn" data-rel="prettyPhoto-cover"></a>';  
	if (get_post_meta($post->ID, 'event_disable', true) == 'no') {
        if ($ev_text) {    
            $items_src .= '
                        <div class="ev1shr-tickets"><a href="' . $event_ticket . '" target="_blank">' . $ev_text . '</a></div>';   
        } else {
            if (get_post_meta($post->ID, 'event_out', true) == 'yes') {
                $items_src .= '
                        <div class="ev1shr-cancel">' . __('Sold Out', 'wizedesign') . '</div>';
            } elseif (get_post_meta($post->ID, 'event_cancel', true) == 'yes') {
                $items_src .= '
                        <div class="ev1shr-cancel">' . __('Canceled', 'wizedesign') . '</div>';
            } elseif (get_post_meta($post->ID, 'event_free', true) == 'yes') {
                $items_src .= '
                        <div class="ev1shr-cancel">' . __('Free Entry', 'wizedesign') . '</div>';
            } else {
                $items_src .= '
                        <div class="ev1shr-tickets"><a href="' . $event_ticket . '" >' . __('Buy Tickets', 'wizedesign') . '</a></div><!-- end #event-tickets -->';
            }
        }
	}
        $items_src .= '	
                     </div>
                  </div>	
               </div>			
            </div><!-- end .ev1shr-cover -->';     
        $items_src .= '
            <div class="ev1shr-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></div>
            <div class="ev1shr-info">
			<div class="ev1shr-information">';
		if ($ev_location != null) {		   
			$items_src .= '
               <div class="ev1shr-location">' . $ev_location . '</div>'; 
		}
		if ($ev_venue != null) {		   
			$items_src .= '
               <div class="ev1shr-venue">' . $ev_venue . '</div>';  
		}
		if ($event_allday == 'yes') {            
            $items_src .= '
                   <div class="ev1shr-hour">' . __('All Day', 'wizedesign') . '</div>';
		} elseif ($tstart != null) {
            $items_src .= '
                   <div class="ev1shr-hour">' . $tstart . '';
				if ($tend != null) {
                $items_src .= ' - ';
            }
            $items_src .= '' . $tend . '</div>';
		}
        $items_src .= '
			 </div> 
               <div class="ev1shr-data">';
			if ($data_finish != null) {
				$items_src .= '  
                     <div class="ev1page-finish">' . $date_d . ' ' . $date_M . '</div>
					 <div class="ev1page-sep">-</div>
                     <div class="ev1page-finish">' . $date_d_finish . ' ' . $date_M_finish . '</div>';
			} elseif ($data_event != null) {
				$items_src .= '			   
                     <div class="ev1shr-day">' . $date_d . ' ' . $date_M . '</div>
                     <div class="ev1shr-week">' . $date_w . '</div>';
			}
		$items_src .= '	
               </div>
		    </div><!-- end .ev1shr-info -->
         </div><!-- end .ev1shr-col -->     ';
    endwhile;
    wp_reset_query();
    $items_src .= '
      </div><!-- end .home-width -->
   </div><!-- end .home-shr clearfix -->';
    return $items_src;
}
function event2up_shortcode($atts, $content) {
    extract(shortcode_atts(array(
        "items" => 2,
        "cat" => null,
        "id" => null,
        "nav" => false,
        "order" => "asc",
        "events" => null
    ), $atts));
    $order       = strtoupper($order);
    $items_count = 0;
    $items_src   = null;
    if ($id == null) {
        $query = array(
            'post_type' => 'event',
            'orderby' => 'meta_value',
            'order' => $order,
		    'meta_key' => 'event_date_interval',
			'meta_value' => strftime("%Y/%m/%d", time()- (60 * 60 * 24) ),
			'meta_compare' => '>',
            'posts_per_page' => $items,
        );
	if ($cat) {
     $query = array(
        'posts_per_page' => $items, 
        'orderby' => 'meta_value',
		'meta_value' => strftime("%Y/%m/%d", time()- (60 * 60 * 24) ),
		'meta_key' => 'event_date_interval',
		'meta_compare' => '>',
		'order' => $order,
        'post_type' => 'event',
        'tax_query' => array(
            array(
                'taxonomy' => 'events',
                'field' => 'slug',
                'terms' => array($cat)
            )));
    }
        $wp_query_event = new WP_Query($query);
    }
    $items_src .= '
   <div class="home-shr clearfix">
      <div class="home-width">';
    while ($wp_query_event->have_posts()):
        $wp_query_event->the_post();
        global $post;
        $image_id       = get_post_thumbnail_id();
        $cover          = wp_get_attachment_image_src($image_id, 'event-style2');
        $cover_large    = wp_get_attachment_image_src($image_id, 'photo-large');
        $image_large    = wp_get_attachment_image_src($image_id, 'large');
        $data_event     = get_post_meta($post->ID, 'event_date_interval', true);
		$data_finish    = get_post_meta($post->ID, 'event_date_interval_finish', true);
        $time           = strtotime($data_event);
		$time_finish    = strtotime($data_finish);
        $tstart         = get_post_meta($post->ID, "event_tstart", true);
        $tend           = get_post_meta($post->ID, "event_tend", true);
        $ev_venue       = get_post_meta($post->ID, "event_venue", true);
        $custom         = get_post_custom($post->ID);
        $event_ticket   = $custom["event_ticket"][0];
        $date_yy = date('Y', $time);
        $date_d  = date('d', $time);
		$date_yy_finish = date('Y', $time_finish);
		$date_d_finish  = date('d', $time_finish);
		$theme = get_template_directory();
		require($theme.'/includes/language.php');
        $ev_text        = get_post_meta($post->ID, "ev_text", true);
        $no_cover       = get_template_directory_uri();
		$event_allday   = get_post_meta($post->ID, "event_allday", true, true);
        $items_src .= '
         <div class="ev2shr-col">';   
			if ($data_finish != null) {
				$items_src .= '  
			   <div class="ev2page-data-finish">
				  <div class="ev2page-finish">' . $date_d . ' ' . $date_M . '</div>
				  <div class="ev2page-sep">-</div>
                  <div class="ev2page-finish">' . $date_d_finish . ' ' . $date_M_finish . '</div>
			   </div><!-- end .ev2page-data-finish -->';
			} elseif ($data_event != null) {
				$items_src .= '
			   <div class="ev2shr-data">
				  <div class="ev2shr-day">' . $date_d . '</div>
				  <div class="ev2shr-month">' . $date_M . '</div>
				  <div class="ev2shr-year">' . $date_yy . '</div>
			   </div><!-- end .ev2shr-data -->';
			}
		$items_src .= '		
            <div class="ev2shr-cover">
               <div class="wz-wrap wz-hover">';
        if ($image_id) {
            $items_src .= '
                  <img src="' . $cover[0] . '" alt="' . get_the_title() . '" />';
        } else {
            $items_src .= '
                  <img src="' . $no_cover . '/images/no-cover/event-2arc.png" alt="no image" />';
        }
        $items_src .= '	
                  <div class="he-view">
                     <div class="bg a1" data-animate="fadeIn">
                        <a href="' . get_permalink() . '" class="ev2shr-link a2" data-animate="zoomIn"></a>
                        <a href="' . $cover_large[0] . '" class="ev2shr-zoom a2" data-animate="zoomIn" data-rel="prettyPhoto-cover"></a>						
                     </div>
                  </div>	
               </div>		
            </div><!-- end .ev2shr-cover -->   
            <h2 class="ev2shr-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>
            <div class="ev2shr-info">';
		if ($event_allday == 'yes') {            
            $items_src .= '
                   <div class="ev2shr-hour">' . __('All Day', 'wizedesign') . '</div>';
		} elseif ($tstart != null) {
            $items_src .= '
                   <div class="ev2shr-hour">' . $tstart . '';
				if ($tend != null) {
                $items_src .= ' - ';
            }
            $items_src .= '' . $tend . '</div>';
		}  
		if ($ev_venue != null) {	
			$items_src .= '	
               <div class="ev2shr-venue">' . $ev_venue . '</div>';
		}	
        $items_src .= '
            </div><!-- end .ev2shr-info -->';
        $items_src .= 
            '<p>' . the_excerpt_max(165) . '</p>';
	if (get_post_meta($post->ID, 'event_disable', true) == 'no') {
        if ($ev_text) {
            $items_src .= '
            <div class="ev2shr-tickets"><a href="' . $event_ticket . '" target="_blank">' . $ev_text . '</a></div>'; 
        } else {
            if (get_post_meta($post->ID, 'event_out', true) == 'yes') {
                $items_src .= '
            <div class="ev2shr-cancel">' . __('Sold Out', 'wizedesign') . '</div>';
            } elseif (get_post_meta($post->ID, 'event_cancel', true) == 'yes') {
                $items_src .= '
            <div class="ev2shr-cancel">' . __('Canceled', 'wizedesign') . '</div>';
            } elseif (get_post_meta($post->ID, 'event_free', true) == 'yes') {
                $items_src .= '
            <div class="ev2shr-cancel">' . __('Free Entry', 'wizedesign') . '</div>';
            } else {
                $items_src .= '
            <div class="ev2shr-tickets"><a href="' . $event_ticket . '" >' . __('Buy Tickets', 'wizedesign') . '</a></div>';
            }
        }
	}
        $items_src .= '    
            <div class="ev2shr-week">' . $date_w . '</div>
         </div><!-- end .ev2shr-col -->';
    endwhile;
    $items_src .= '
      </div><!-- end .home-width -->
   </div><!-- end .home-shr clearfix -->';
    return $items_src;
}
function event2past_shortcode($atts, $content) {
    extract(shortcode_atts(array(
        "items" => 2,
        "cat" => null,
        "id" => null,
        "nav" => false,
        "order" => "desc",
        "events" => null
    ), $atts));
    $order       = strtoupper($order);
    $items_count = 0;
    $items_src   = null;
    if ($id == null) {
        $query = array(
            'post_type' => 'event',
            'orderby' => 'meta_value',
            'order' => $order,
		    'meta_key' => 'event_date_interval',
			'meta_value' => strftime("%Y/%m/%d", time()- (60 * 60 * 24) ),
			'meta_compare' => '<',
            'posts_per_page' => $items,
        );
	if ($cat) {
     $query = array(
        'posts_per_page' => $items, 
        'orderby' => 'meta_value',
		'meta_value' => strftime("%Y/%m/%d", time()- (60 * 60 * 24) ),
		'meta_key' => 'event_date_interval',
		'meta_compare' => '>',
		'order' => $order,
        'post_type' => 'event',
        'tax_query' => array(
            array(
                'taxonomy' => 'events',
                'field' => 'slug',
                'terms' => array($cat)
            )));
    }
        $wp_query_event = new WP_Query($query);
    }
    $items_src .= '
   <div class="home-shr clearfix">
      <div class="home-width">';
    while ($wp_query_event->have_posts()):
        $wp_query_event->the_post();
        global $post;
        $image_id       = get_post_thumbnail_id();
        $cover          = wp_get_attachment_image_src($image_id, 'event-style2');
        $cover_large    = wp_get_attachment_image_src($image_id, 'photo-large');
        $image_large    = wp_get_attachment_image_src($image_id, 'large');
        $data_event     = get_post_meta($post->ID, 'event_date_interval', true);
		$data_finish    = get_post_meta($post->ID, 'event_date_interval_finish', true);
        $time           = strtotime($data_event);
		$time_finish    = strtotime($data_finish);
        $tstart         = get_post_meta($post->ID, "event_tstart", true);
        $tend           = get_post_meta($post->ID, "event_tend", true);
        $ev_venue       = get_post_meta($post->ID, "event_venue", true);
        $custom         = get_post_custom($post->ID);
        $event_ticket   = $custom["event_ticket"][0];
        $date_yy 		= date('Y', $time);
        $date_d  		= date('d', $time);
		$date_yy_finish = date('Y', $time_finish);
		$date_d_finish  = date('d', $time_finish);
		$theme = get_template_directory();
		require($theme.'/includes/language.php');
        $ev_text        = get_post_meta($post->ID, "ev_text", true);
        $no_cover       = get_template_directory_uri();
		$event_allday   = get_post_meta($post->ID, "event_allday", true, true);
        $items_src .= '
         <div class="ev2shr-col">';     
			if ($data_finish != null) {
				$items_src .= '   
			   <div class="ev2page-data-finish">
				  <div class="ev2page-finish">' . $date_d . ' ' . $date_M . '</div>
				  <div class="ev2page-sep">-</div>
                  <div class="ev2page-finish">' . $date_d_finish . ' ' . $date_M_finish . '</div>
			   </div><!-- end .ev2page-data-finish -->';
			} elseif ($data_event != null) {
				$items_src .= '  		 
			   <div class="ev2shr-data">
                  <div class="ev2shr-day">' . $date_d . '</div>
                  <div class="ev2shr-month">' . $date_M . '</div>
                  <div class="ev2shr-year">' . $date_yy . '</div>
			   </div><!-- end .ev2shr-data -->';
			}
		$items_src .= '
            <div class="ev2shr-cover">
               <div class="wz-wrap wz-hover">';
        if ($image_id) {
            $items_src .= '
                  <img src="' . $cover[0] . '" alt="' . get_the_title() . '" />';
        } else {
            $items_src .= '
                  <img src="' . $no_cover . '/images/no-cover/event-2arc.png" alt="no image" />';
        }
        $items_src .= '	
                  <div class="he-view">
                     <div class="bg a1" data-animate="fadeIn">
                        <a href="' . get_permalink() . '" class="ev2shr-link a2" data-animate="zoomIn"></a>
                        <a href="' . $cover_large[0] . '" class="ev2shr-zoom a2" data-animate="zoomIn" data-rel="prettyPhoto-cover"></a>						
                     </div>
                  </div>	
               </div>		
            </div><!-- end .ev2shr-cover -->   
            <h2 class="ev2shr-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>
            <div class="ev2shr-info">';
		if ($event_allday == 'yes') {            
            $items_src .= '
                   <div class="ev2shr-hour">' . __('All Day', 'wizedesign') . '</div>';
		} elseif ($tstart != null) {
            $items_src .= '
                   <div class="ev2shr-hour">' . $tstart . '';
				if ($tend != null) {
                $items_src .= ' - ';
            }
            $items_src .= '' . $tend . '</div>';
		}  
		if ($ev_venue != null) {	
			$items_src .= '	
               <div class="ev2shr-venue">' . $ev_venue . '</div>';
		}	
        $items_src .= '
            </div><!-- end .ev2shr-info -->';
        $items_src .= 
            '<p>' . the_excerpt_max(165) . '</p>';
	if (get_post_meta($post->ID, 'event_disable', true) == 'no') {
        if ($ev_text) {
            $items_src .= '
            <div class="ev2shr-tickets"><a href="' . $event_ticket . '" target="_blank">' . $ev_text . '</a></div>'; 
        } else {
            if (get_post_meta($post->ID, 'event_out', true) == 'yes') {
                $items_src .= '
            <div class="ev2shr-cancel">' . __('Sold Out', 'wizedesign') . '</div>';
            } elseif (get_post_meta($post->ID, 'event_cancel', true) == 'yes') {
                $items_src .= '
            <div class="ev2shr-cancel">' . __('Canceled', 'wizedesign') . '</div>';
            } elseif (get_post_meta($post->ID, 'event_free', true) == 'yes') {
                $items_src .= '
            <div class="ev2shr-cancel">' . __('Free Entry', 'wizedesign') . '</div>';
            } else {
                $items_src .= '
            <div class="ev2shr-tickets"><a href="' . $event_ticket . '" >' . __('Buy Tickets', 'wizedesign') . '</a></div>';
            }
        }
	}
        $items_src .= '    
            <div class="ev2shr-week">' . $date_w . '</div>
         </div><!-- end .ev2shr-col -->';
    endwhile;
    $items_src .= '
      </div><!-- end .home-width -->
   </div><!-- end .home-shr clearfix -->';
    return $items_src;
}
?>