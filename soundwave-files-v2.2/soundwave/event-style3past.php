<?php
/*
Template Name: Event Style 3 (PAST)
*/
?>

<?php get_header(); ?>

<div id="content">

<?php
$page_layout = sidebar_layout();
switch ($page_layout) {
    case "layout-sidebar-left":
        echo '
   <div class="col-right-media">';
        break;
    case "layout-sidebar-right":
        echo '
   <div class="col-left-media">';
        break; 
    case "layout-full":
        echo '
   <div class="title-head"><h1>Please select left or right from  "Sidebar layout settings" of this page.</h1></div>';
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
      <div class="ev2page clearfix">';
$term     = get_queried_object()->slug;
$query    = array(
    'post_type' => 'event',
    'orderby' => 'meta_value',
	'order' => 'desc',
	'posts_per_page' => 10,
	'meta_value' => strftime("%Y/%m/%d", time()- (60 * 60 * 24) ),
	'meta_key' => 'event_date_interval',
	'meta_compare' => '<',
	'paged' => $paged,
    'taxonomy' => 'events',
	'term' => $term->slug
);
$wp_query = new WP_Query($query);
$results = $wp_query->post_count;
if ($results != ''):
    while ($wp_query->have_posts()):
    $wp_query->the_post();
    global $post;
        setup_postdata($post);
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
        $tstart         = get_post_meta($post->ID, 'event_tstart', true);
        $tend           = get_post_meta($post->ID, 'event_tend', true);
        $ev_venue       = get_post_meta($post->ID, "event_venue", true);
        $custom         = get_post_custom($post->ID);
        $event_ticket   = $custom["event_ticket"][0];
        $image_id       = get_post_thumbnail_id();
        $cover          = wp_get_attachment_image_src($image_id, 'event-cover-arc');
        $ev_text        = get_post_meta($post->ID, "ev_text", true);
		$event_allday   = get_post_meta($post->ID, "event_allday", true, true);
        echo '
         <div class="ev3page">
            <div class="ev3page-data">';
			if ($data_finish != null) {
				echo ' 
               <div class="ev3page-finish">' . $date_d . ' ' . $date_M . '</div>
			   <div class="ev3page-sep">-</div>
			   <div class="ev3page-finish">' . $date_d_finish . ' ' . $date_M_finish . '</div>';
			} elseif ($data_event != null) {
				echo '
			   <div class="ev3page-day">' . $date_d . ' ' . $date_M . '</div>
			   <div class="ev3page-year">' . $date_yy . '</div>';
			}
			echo '			 
            </div><!-- end .ev3page-data -->   
            <div class="event-arc-text">';     
	if (get_post_meta($post->ID, 'event_disable', true) == 'no') {		
        if ($ev_text) { 
            echo '
               <div class="ev3page-tickets"><a href="' . $event_ticket . '" target="_blank">' . $ev_text . '</a></div>'; 
        } else {
            if (get_post_meta($post->ID, 'event_out', true) == 'yes') {
                echo '
               <div class="ev3page-cancel">' . __('Sold Out', 'wizedesign') . '</div>';  
            } elseif (get_post_meta($post->ID, 'event_cancel', true) == 'yes') {
                echo '
               <div class="ev3page-cancel">' . __('Canceled', 'wizedesign') . '</div>';  
            } elseif (get_post_meta($post->ID, 'event_free', true) == 'yes') {
                echo '
               <div class="ev3page-cancel">' . __('Free Entry', 'wizedesign') . '</div>';   
            } else {
                echo '
               <div class="ev3page-tickets"><a href="' . $event_ticket . '" >' . __('Buy Tickets', 'wizedesign') . '</a></div>';
            }
        }  
	}
        echo '
               <h2 class="ev3page-title"><a href="' . get_permalink() . '">';    
        if (strlen($post->post_title) > 38) {
            echo substr(the_title($before = '', $after = '', FALSE), 0, 38) . '...';
        } else {
            the_title();
        }
        echo '</a></h2>
               <div class="ev3page-info">'; 
        if ($ev_venue != null) {  
            echo '
                  <div class="ev3page-venue">' . $ev_venue . '</div>';
        }
		if ($event_allday == 'yes') {            
            echo '
                 <div class="ev3page-hour">' . __('All Day', 'wizedesign') . '</div>';
		} elseif ($tstart != null) {
            echo '
                  <div class="ev3page-hour">' . $tstart . '';
				if ($tend != null) {
                echo ' - ';
            }
            echo '' . $tend . '</div>';
		}
        echo '	  
               </div><!-- end .ev3page-info -->
               <div class="ev3page-week">' . $date_w . '</div>
            </div><!-- end .event-arc-text -->
         </div><!-- end .ev3page -->';
		 
	endwhile;

else :
echo '<h4>' . __('Sorry, no events past.', 'wizedesign') . '</h4>';
endif;

if (function_exists("pag_half_wz")) {
    pag_half_wz();
}
echo '
      </div><!-- end .ev2page clearfix -->
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