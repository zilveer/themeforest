<?php get_header(); ?>

<div id="content">

<?php
$page_layout = of_get_option('event_images');
switch ($page_layout) {
    case "left-event-sidebar":
        echo '
   <div class="col-right-single">';
        break;  
    case "right-event-sidebar":
        echo '
   <div class="col-left-single">';
        break;
}
echo '
      <div class="title-head"><h1>' . get_the_title() . '</h1></div>
      <div class="single-col clearfix">';
if (have_posts())
    while (have_posts()):
        the_post();
        global $post;
        $results        = $wp_query->post_count;
        $data_event     = get_post_meta($post->ID, 'event_date_interval', true);
		$data_finish    = get_post_meta($post->ID, 'event_date_interval_finish', true);
        $time           = strtotime($data_event);
		$time_finish    = strtotime($data_finish);
        $date_yy 		= date('Y', $time);
        $date_d  		= date('d', $time);
		$date_yy_finish = date('Y', $time_finish);
        $date_d_finish  = date('d', $time_finish);
		require('includes/language.php');
        $image_id       = get_post_thumbnail_id();
        $cover          = wp_get_attachment_image_src($image_id, 'event-single');
        $cover_large    = wp_get_attachment_image_src($image_id, 'photo-large');
        $image_id       = get_post_thumbnail_id();
        $ev_location    = get_post_meta($post->ID, "event_location", true);
        $ev_venue       = get_post_meta($post->ID, "event_venue", true);
        $ev_price       = get_post_meta($post->ID, "ev_price", true);
        $ev_status      = get_post_meta($post->ID, "ev_status", true);
        $ev_text        = get_post_meta($post->ID, "ev_text", true);
        $tstart         = get_post_meta($post->ID, 'event_tstart', true);
        $tend           = get_post_meta($post->ID, 'event_tend', true);
        $event_ticket   = get_post_meta($post->ID, "event_ticket", true);
        $event_out      = get_post_meta($post->ID, "event_out", true);
        $event_cancel   = get_post_meta($post->ID, "event_cancel", true);
        $club           = get_post_meta($post->ID, "event_venue", true);
        $event_allday   = get_post_meta($post->ID, "event_allday", true, true);
        $no_cover       = get_template_directory_uri();
        echo '
         <div class="event-info">
            <div class="evsng-cover">
               <div class="wz-wrap wz-hover">';
        if ($image_id) {
            echo '
                  <img src="' . $cover[0] . '" alt="' . get_the_title() . '" />';
        } else {
            echo '
                  <img src="' . $no_cover . '/images/no-cover/event-sng.png" alt="no image" />';
        }
        echo '	
                  <div class="he-view">
                     <div class="bg a1" data-animate="fadeIn">	
                        <a href="' . get_permalink() . '" class="evsng-link a2" data-animate="zoomIn"></a>
                        <a href="' . $cover_large[0] . '" class="evsng-zoom a2" data-animate="zoomIn" data-rel="prettyPhoto-cover"></a>'; 
						
	if (get_post_meta($post->ID, 'event_disable', true) == 'no') {
        if ($ev_text) {   
            echo '
                        <div class="evsng-hover-tickets"><a href="' . $event_ticket . '" target="_blank">' . $ev_text . '</a></div>';
        } else {  
            if (get_post_meta($post->ID, 'event_out', true) == 'yes') {
                echo '
                        <div class="evsng-hover-cancel">' . __('Sold Out', 'wizedesign') . '</div>';
            } elseif (get_post_meta($post->ID, 'event_cancel', true) == 'yes') {
                echo '
                        <div class="evsng-hover-cancel">' . __('Canceled', 'wizedesign') . '</div>';
            } elseif (get_post_meta($post->ID, 'event_free', true) == 'yes') {
                echo '
                        <div class="evsng-hover-cancel">' . __('Free Entry', 'wizedesign') . '</div>';
            } else {
                echo '
                        <div class="evsng-hover-tickets"><a href="' . $event_ticket . '" >' . __('Buy Tickets', 'wizedesign') . '</a></div>';
            }
        }
	}
        echo '
                     </div>
                  </div>	
               </div>			
            </div><!-- end .evsng-cover -->';
        if ($data_finish != null) {
            echo ' 
            <div class="event-single-data"> 
               <div class="event-single-finish">' . $date_d . ' ' . $date_M . ' ' . $date_yy . ' <span>' . $date_w . '</span></div>
			   <div class="event-single-sep">-</div>
			   <div class="event-single-finish">' . $date_d_finish . ' ' . $date_M_finish . ' ' . $date_yy_finish . ' <span>' . $date_w_finish . '</span></div>
            </div>';
        } elseif ($data_event != null) {
            echo ' 
            <div class="event-single-data"> 
               <div class="event-single-day">' . $date_d . ' </div>
               <div class="event-single-month"> / ' . $date_M . '</div>
               <div class="evsng-week">' . $date_w . '</div>
               <div class="event-single-year">' . $date_yy . '</div>
            </div>';
        }
        echo '
		 </div><!-- end .event-info -->
         <div class="event-text">';
		 
	if (get_post_meta($post->ID, 'event_disable', true) == 'no') {	 
        if ($ev_text) {    
            echo '
            <div class="evsng-tickets"><a href="' . $event_ticket . '" target="_blank">' . $ev_text . '</a></div>';   
        } else {
            if (get_post_meta($post->ID, 'event_out', true) == 'yes') {
                echo '
            <div class="evsng-out"><p>' . __('Sold Out', 'wizedesign') . '</p></div>';
            } elseif (get_post_meta($post->ID, 'event_cancel', true) == 'yes') {
                echo '
            <div class="evsng-out"><p>' . __('Canceled', 'wizedesign') . '</p></div>';
            } elseif (get_post_meta($post->ID, 'event_free', true) == 'yes') {
                echo '
            <div class="evsng-out"><p>' . __('Free Entry', 'wizedesign') . '</p></div>';
            } else {
                echo '
            <div class="evsng-tickets"><a href="' . $event_ticket . '" target="_blank">' . __('Buy Tickets', 'wizedesign') . '</a></div>';
            }  
        }  
	}
        echo '
            <div class="evsng-head">
               <h2 class="event-title">' . get_the_title($post->ID) . '</h2>
            </div>  	  
            <div class="evsng-info">';
        if ($ev_location != null) {
            echo ' 
               <div class="evsng-info-in">                                     
                  <div class="evsng-cell">' . __('Location', 'wizedesign') . '</div>
                  <div class="evsng-cell-info">' . $ev_location . '</div>                                    
               </div>';
        }
        
        
        if ($ev_venue != null) {
            echo '  
               <div class="evsng-info-in">                                     
                  <div class="evsng-cell">' . __('Venue', 'wizedesign') . '</div>
                  <div class="evsng-cell-info">' . $ev_venue . '</div>                                    
               </div>';
        }
        
		if ($event_allday == 'yes') {            
            echo '<div class="evsng-info-in">                                       
					<div class="evsng-cell">' . __('Time', 'wizedesign') . '</div>
					<div class="evsng-cell-info">' . __('All Day', 'wizedesign') . '</div>
				  </div>';           
        } elseif ($tstart != null) {
            echo '
               <div class="evsng-info-in">                                       
                  <div class="evsng-cell">' . __('Time', 'wizedesign') . '</div>
                  <div class="evsng-cell-info">' . $tstart . '';
            if ($tend != null) {
                echo ' - ';
            }
            echo '' . $tend . '</div>                                        
               </div>';
        }  
        
        if ($ev_price != null) {
            echo '
               <div class="evsng-info-in">                                       
                  <div class="evsng-cell">' . __('Price', 'wizedesign') . '</div>
                  <div class="evsng-cell-info">' . $ev_price . '</div>                                        
               </div>';
        }
        
        if ($ev_status != null) {
            echo '  
               <div class="evsng-info-in">                                       
                  <div class="evsng-cell">' . __('Status', 'wizedesign') . '</div>
                  <div class="evsng-cell-info">' . $ev_status . '</div>                                        
               </div>';
        } 
        echo '
            </div>';
        echo '
            ' . the_content() . '                                
         </div><!-- end .event-text -->';
        echo ' ' . get_template_part('gmap') . '';
    endwhile;
echo '       
      </div><!-- end .single-col clearfix -->
   </div><!-- end .col -->';
switch ($page_layout) {
    case "left-event-sidebar":
        echo '
   <div class="sidebar-left">';
        wz_setSection('zone-sidebar');
        if (is_active_sidebar('sidebar-event-single')) {
            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-event-single'));
        } else {
            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-page'));
        }
        echo '
   </div><!-- end .sidebar-left -->';
        break;
    case "right-event-sidebar":
        echo '
   <div class="sidebar-right">';
        wz_setSection('zone-sidebar');
        if (is_active_sidebar('sidebar-event-single')) {
            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-event-single'));
        } else {
            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-page'));
        }
        echo '
   </div><!-- end .sidebar-right -->';
        break;
}
?>

</div><!-- end #content -->
	
<?php get_footer(); ?>