<?php
/*
Template Name: Event Style 1
*/
?>

<?php get_header(); ?>

<div id="content">

<?php
$page_layout = sidebar_layout();
switch ($page_layout) {
    case "layout-sidebar-left":
        echo '
   <div class="col-right-media">	';
        break;
    
    case "layout-sidebar-right":
        echo '
   <div class="col-left-media">	';
        break;
    
    case "layout-full":
        echo '
   <div class="col-full-media">';
        break;
}
echo '
      <div class="title-head"><h1>';
$prefix = false;
if (function_exists('is_tag') && is_tag()) {
    $prefix = true;
} elseif (is_archive()) {
    wp_title(' ');
} elseif (is_page()) {
    the_title();
}
echo '</h1></div>
      <div class="ev1page clearfix">';
$term      = get_queried_object()->slug;
$events_nr = of_get_option('nr_events');
$query     = array(
    'post_type' => 'event',
    'posts_per_page' => $events_nr,
    'paged' => $paged,
    'taxonomy' => 'events',
	'term' => $term
);
$wp_query  = new WP_Query($query);
while ($wp_query->have_posts()):
    $wp_query->the_post();
    global $post;
    $results        = $wp_query->post_count;
    $data_event     = get_post_meta($post->ID, 'event_date_interval', true);
	$data_finish    = get_post_meta($post->ID, 'event_date_interval_finish', true);
    $time           = strtotime($data_event);
	$time_finish    = strtotime($data_finish);
    $date_yy 		= date('Y', $time);
    $date_d 	    = date('d', $time);
	$date_yy_finish = date('Y', $time_finish);
	$date_d_finish  = date('d', $time_finish);
	require('includes/language.php');
    $tstart         = get_post_meta($post->ID, 'event_tstart', true);
    $tend           = get_post_meta($post->ID, 'event_tend', true);
    $ev_venue       = get_post_meta($post->ID, 'event_venue', true);
    $ev_location    = get_post_meta($post->ID, "event_location", true);
    $custom         = get_post_custom($post->ID);
    $event_ticket   = $custom["event_ticket"][0];
    $image_id       = get_post_thumbnail_id();
    $cover_large    = wp_get_attachment_image_src($image_id, 'photo-large');
    $cover          = wp_get_attachment_image_src($image_id, 'event-style1');
    $ev_text        = get_post_meta($post->ID, "ev_text", true);
    $no_cover       = get_template_directory_uri(); 
	$event_allday   = get_post_meta($post->ID, "event_allday", true, true);
    echo '		
         <div class="home-width">
            <div class="ev1page-col">
               <div class="ev1page-cover">
                  <div class="wz-wrap wz-hover">';
    if ($image_id) {
        echo '
                     <img src="' . $cover[0] . '" alt="' . get_the_title() . '" />';
    } else {
        echo '
                     <img src="' . $no_cover . '/images/no-cover/event-1arc.png" alt="no image" />';
    }   
    echo '				 
                     <div class="he-view">
                        <div class="bg a1" data-animate="fadeIn">	
                           <a href="' . get_permalink() . '" class="ev1page-link a2" data-animate="zoomIn"></a>
                           <a href="' . $cover_large[0] . '" class="ev1page-zoom a2" data-animate="zoomIn" data-rel="prettyPhoto-cover"></a>'; 
if (get_post_meta($post->ID, 'event_disable', true) == 'no') {
    if ($ev_text) {      
        echo '
                           <div class="ev1page-tickets"><a href="' . $event_ticket . '" target="_blank">' . $ev_text . '</a></div><!-- end #evsng-tickets -->';    
    } else {      
        if (get_post_meta($post->ID, 'event_out', true) == 'yes') {
            echo '
                           <div class="ev1page-cancel">' . __('Sold Out', 'wizedesign') . '</div>';
        } elseif (get_post_meta($post->ID, 'event_cancel', true) == 'yes') {
            echo '
                           <div class="ev1page-cancel">' . __('Canceled', 'wizedesign') . '</div>';
        } elseif (get_post_meta($post->ID, 'event_free', true) == 'yes') {
            echo '
                           <div class="ev1page-cancel">' . __('Free Entry', 'wizedesign') . '</div>';
        } else {
            echo '
                           <div class="ev1page-tickets"><a href="' . $event_ticket . '">' . __('Buy Tickets', 'wizedesign') . '</a></div>';
        }
    }
}
    echo '	
                        </div>
                     </div>	
                  </div>			
               </div><!-- end .ev1page-cover --> ';
    
    echo '
               <div class="ev1page-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></div>
               <div class="ev1page-info">
			   <div class="ev1shr-information">';
	if ($ev_location != null) {		   
		echo '
                  <div class="ev1page-location">' . $ev_location . '</div>';
	}	
    if ($ev_venue != null) {		
		echo '                 
                  <div class="ev1page-venue">' . $ev_venue . '</div>';  
	}					  
	
	if ($event_allday == 'yes') {            
            echo '
                  <div class="ev1page-hour">' . __('All Day', 'wizedesign') . '</div>';
    } elseif ($tstart != null) {
            echo '
                  <div class="ev1page-hour">' . $tstart . '';
            if ($tend != null) {
                echo ' - ';
            }
            echo '' . $tend . '</div>';
    }  
		
    echo ' 
			   </div>
                  <div class="ev1page-data">';
			if ($data_finish != null) {
				echo '   
                     <div class="ev1page-finish">' . $date_d . ' ' . $date_M . '</div>
					 <div class="ev1page-sep">-</div>
                     <div class="ev1page-finish">' . $date_d_finish . ' ' . $date_M_finish . '</div>';
			} elseif ($data_event != null) {
				echo '	
					 <div class="ev1page-day">' . $date_d . ' ' . $date_M . '</div>
                     <div class="ev1page-week">' . $date_w . '</div>';
			}
			echo '
                  </div>		
               </div><!-- end .ev1page-info -->
            </div><!-- end .ev1page-col -->     
         </div><!-- end .home-width -->';
endwhile;

if (function_exists("pag_half_wz")) {
    pag_half_wz();
}
echo '
      </div><!-- end .ev1page clearfix -->
   </div><!-- end .col -->';
switch ($page_layout) {
    case "layout-sidebar-left":
        echo '
   <div class="sidebar-left">';
        wz_setSection('zone-sidebar');
        if (is_active_sidebar('sidebar-event-archive')) {
            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-event-archive'));
        } else {
            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-page'));
        }
        echo '
   </div><!-- end .sidebar-left -->';
        break;
    
    case "layout-sidebar-right":
        echo '
   <div class="sidebar-right">';
        wz_setSection('zone-sidebar');
        if (is_active_sidebar('sidebar-event-archive')) {
            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-event-archive'));
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