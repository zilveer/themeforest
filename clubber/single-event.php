<?php
get_header();
?>


<div id="content">

<div class="title-head"><h1><?php
if (function_exists('cat_post_types'))
    cat_post_types();
?>
</h1></div>


<?php
$page_layout = of_get_option('event_images');
switch ($page_layout) {
    case "left-event-sidebar":
        echo '
<div class="sidebar-left">';
        wz_setSection('zone-sidebar');
        if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-page'));
        echo '
</div><!-- end .sidebar-left -->';
        break;
    case "right-event-sidebar":
        echo '
<div class="sidebar-right">';
        wz_setSection('zone-sidebar');
        if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-page'));
        echo '
</div><!-- end .sidebar-right -->';
        break;
}
?>

<div class="fixed">
  <div class="single-col">					
  
<?php
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
        $cover          = wp_get_attachment_image_src($image_id, 'event-cover-arc');
        $image_id       = get_post_thumbnail_id();
        $event_location = get_post_meta($post->ID, "event_location", true);
        $event_venue    = get_post_meta($post->ID, "event_venue", true);
        $tstart         = get_post_meta($post->ID, 'event_tstart', true);
        $tend           = get_post_meta($post->ID, 'event_tend', true);
        $event_ticket   = get_post_meta($post->ID, "event_ticket", true);
		$event_text     = get_post_meta($post->ID, "ev_text", true);
        $event_out      = get_post_meta($post->ID, "event_out", true);
        $event_cancel   = get_post_meta($post->ID, "event_cancel", true);
        $event_zoom     = get_post_meta($post->ID, "event_zoom", true);
        $coordinated    = get_post_meta($post->ID, "event_coordinated", true);
        $club           = get_post_meta($post->ID, "event_venue", true);
        $event_allday   = get_post_meta($post->ID, "event_allday", true, true);
        echo '
    <div class="event-cover">';
        if ($image_id) {
            echo '
      <img src="' . $cover[0] . '" alt="' . get_the_title() . '" />';
        } else {
            echo '
      <img src="' . get_template_directory_uri() . '/images/no-featured/event-single.png" alt="no image" />';
        }
		
		if ($data_finish != null) {
			echo '   
	  <div class="event-single-data">
        <div class="event-single-day">' . $date_d . '</div>
        <div class="event-single-month">' . $date_M . '</div>
        <div class="event-single-year">' . $date_yy . '</div>
      </div>
	  <div class="event-single-sep"></div>
      <div class="event-single-data">
        <div class="event-single-day">' . $date_d_finish . '</div>
        <div class="event-single-month">' . $date_M_finish . '</div>
        <div class="event-single-year">' . $date_yy_finish . '</div>
      </div>';
		} elseif ($data_event != null) {
			echo '        
      <div class="event-single-data">
        <div class="event-single-day">' . $date_d . '</div>
        <div class="event-single-month">' . $date_M . '</div>
        <div class="event-single-year">' . $date_yy . '</div>
      </div>';
        }
        echo '
	</div><!-- end .event-cover -->
    <div class="event-text">
      <h2 class="event-title">' . get_the_title($post->ID) . '</h2>
        <ul class="event-meta">';
        if ($event_location != null) {
            echo '
          <li><span>' . __('Location', 'clubber') . ':</span>' . $event_location . '</li>';
        }
        if ($club != null) {
            echo '
          <li><span>' . __('Venue', 'clubber') . ':</span>' . $club . '</li>';
        }                   
        if ($event_allday == 'yes'){            
            echo '<li><span>' . __('Length', 'clubber') . ':</span>All Day</li>';           
        } elseif ($tstart) {            
            echo '<li><span>' . __('Length', 'clubber') . ':</span>' . $tstart . '';            
        } if ($tend) { 
            echo ' – ' . $tend . '</li>';
        }                
        echo '
          <li>';
	if (get_post_meta($post->ID, 'event_disable', true) == 'no') {
        if ($event_text) {   
            echo '
                        <div class="event-tickets"><a href="' . $event_ticket . '" target="_blank">' . $event_text . '</a></div>';
        } else {  
            if (get_post_meta($post->ID, 'event_out', true) == 'yes') {
                echo '
                        <div class="event-cancel-out"><p>' . __('Sold Out', 'clubber') . '</p></div>';
            } elseif (get_post_meta($post->ID, 'event_cancel', true) == 'yes') {
                echo '
                        <div class="event-cancel-out"><p>' . __('Canceled', 'clubber') . '</p></div>';
            } elseif (get_post_meta($post->ID, 'event_free', true) == 'yes') {
                echo '
                        <div class="event-cancel-out"><p>' . __('Free Entry', 'clubber') . '</p></div>';
            } else {
                echo '
                        <div class="event-tickets"><a href="' . $event_ticket . '" target="_blank">' . __('Buy Tickets', 'clubber') . '</a></div>';
            }
        }
	}
        echo '</li>
        </ul><!-- end ul.event-meta -->';
        echo '
            ' . the_content() . '                                
    </div><!-- end .event-text -->';
        if ($coordinated != null) {
            echo '
       <script type="text/javascript">
      jQuery(document).ready(function($){
      
        $("#event-map").gmap3({
          marker:{
            latLng: [' . $coordinated . '],
            options:{
              draggable:true
            },
            events:{
              dragend: function(marker){
                $(this).gmap3({
                  getaddress:{
                    latLng:marker.getPosition(),
                    callback:function(results){
                      var map = $(this).gmap3("get"),
                        infowindow = $(this).gmap3({get:"infowindow"}),
                        content = results && results[1] ? results && results[1].formatted_address : "no address";
                      if (infowindow){
                        infowindow.open(map, marker);
                        infowindow.setContent(content);
                      } else {
                        $(this).gmap3({
                          infowindow:{
                            anchor:marker, 
                            options:{content: content}
                          }
                        });
                      }
                    }
                  }
                });
              }
            }
          },
          map:{
            options:{
              zoom: ' . $event_zoom . '
            }
          }
        });
        
      });
    </script>
 
    <div id="event-map"></div>';
        }
        echo '       
  </div><!-- end .single-col -->';
    endwhile;
?>

</div><!-- end .fixed -->
</div><!-- end #content -->
	
<?php
get_footer();
?>