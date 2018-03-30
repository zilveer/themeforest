<?php                                   
        $query = array(
            'orderby' => 'meta_value',
            'meta_key' => 'event_date_interval',
            'meta_value' => strftime("%Y/%m/%d", time()- (60 * 60 * 24) ),
            'meta_compare' => '>',
            'order_by' => 'meta_value',
            'order' => 'ASC',
            'post_type' => 'event',
            'posts_per_page' => 4
        );                 
        $wp_query_event = new WP_Query($query);       
        echo '
      <div id="evftr">';
       while ($wp_query_event->have_posts()):
            $wp_query_event->the_post();
			global $post; 
            $data_event     = get_post_meta($post->ID, 'event_date_interval', true);
			$data_finish    = null;
            $time           = strtotime($data_event);
            $date_day       = date('d', $time);
			require('includes/language.php');
            $venue          = get_post_meta($post->ID, 'event_venue', true);
            $custom         = get_post_custom($post->ID);
echo '
         <div class="evftr-info">
            <a href="' . get_permalink() . '" rel="bookmark" title="' . get_the_title() . '">
               <div class="evftr-date">
                  <div class="evftr-dm">'.$date_day.' '.$date_M.'</div>
                  <div class="evftr-week">'.$date_w.'</div>
				'.$venue.'
               </div>
            </a>
         </div>';
	endwhile;
echo '	
      </div>';
 wp_reset_query();

?>