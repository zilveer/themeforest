<?php
$slidernumber  = of_get_option('slider_number');
$slide_seconds = of_get_option('seconds_slide');
$page_layout   = sidebar_layout();
$slidertype    = of_get_option('slider_type');
$wp_slider_query = new WP_Query(array(
    'post_type' => 'slide',
    'posts_per_page' => $slidernumber,
    'orderby' => 'DATE',
    'order' => 'DESC'
));
switch ($slidertype) {
    case "slider_small":  
        switch ($page_layout) {
            case "layout-sidebar-left":
                echo '
   <div id="slider-right">';
                break;
            case "layout-sidebar-right":
                echo '
   <div id="slider-left">';
                break;             
        }
        echo '
      <div class="flexslider">
         <ul class="slides">';   
        if ($wp_slider_query->post_count) {
            while ($wp_slider_query->have_posts()):
                $wp_slider_query->the_post();
                $custom       = get_post_custom($post->ID);
                $image_id     = get_post_thumbnail_id();
                $slider_small = wp_get_attachment_image_src($image_id, 'slider-small');
                $slide_des    = $custom["slide_des"][0];
                $slide_url    = $custom["slide_url"][0];
                $slide_title  = get_the_title();
                $no_cover     = get_template_directory_uri();
                echo '			
            <li>'; 
                if ($slide_url != null) {
                    echo '
               <a href="' . $slide_url . '">';
                }
                if ($image_id) {
                    echo '
                  <img src="' . $slider_small[0] . '" alt="' . get_the_title() . '" />';
                } else {
                    echo '
                  <img src="' . $no_cover . '/images/no-cover/slider-small.png" alt="no image" />';
                }
				if ($slide_url != null) {
                    echo '
               </a>';
                }
                if ($slide_url != null) {
                    echo '
               <a href="' . $slide_url . '"> ';
                }     
                if ($slide_title != null) {
                    echo ' 
                  <div class="flex-title-small">
				' . $slide_title . '
                  </div>';
                }
                if ($slide_url != null) {
                    echo '
               </a>';
                }
                if ($slide_des != null) {
                    if ($slide_url != null) {
                        echo '
               <a href="' . $slide_url . '"> ';
                    }
                    echo '
                  <div class="flex-des-small">
				' . $slide_des . '
                  </div>';
                    if ($slide_url != null) {
                        echo '
               </a>';
                    }
                } 
                echo '
            </li>';
            endwhile;
            echo '	
         </ul>
      </div><!-- end .flexslider -->
   </div><!-- end #slider -->';
        }       
}
switch ($slidertype) {
    case "slider_large":
        echo '
   <div id="slider-large">
      <div class="flexslider">
         <ul class="slides">';  
        if ($wp_slider_query->post_count) {
            while ($wp_slider_query->have_posts()):
                $wp_slider_query->the_post();
                $custom       = get_post_custom($post->ID);
                $image_id     = get_post_thumbnail_id();
                $slider_large = wp_get_attachment_image_src($image_id, 'slider-large');
                $slide_des    = $custom["slide_des"][0];
                $slide_url    = $custom["slide_url"][0];
                $slide_title  = get_the_title();
                $no_cover     = get_template_directory_uri();
                echo '			
            <li>'; 
                if ($slide_url != null) {
                    echo '
               <a href="' . $slide_url . '">';
                }   
                if ($image_id) {
                    echo '
                  <img src="' . $slider_large[0] . '" alt="' . get_the_title() . '" />';
                } else {
                    echo '
                  <img src="' . $no_cover . '/images/no-cover/slider-large.png" alt="no image" />';
                }       
				if ($slide_url != null) {
                    echo '
               </a>';
                }               
                if ($slide_url != null) {
                    echo '
               <a href="' . $slide_url . '"> ';
                }     
                if ($slide_title != null) {
                    echo ' 
                  <div class="flex-title-large">
				' . $slide_title . '
                  </div>';
                }       
                if ($slide_url != null) {
                    echo '
               </a>';
                } 
                if ($slide_des != null) {
                    
                    
                    if ($slide_url != null) {
                        echo '
               <a href="' . $slide_url . '"> ';
                    }
                    echo '
                  <div class="flex-des-large">
				' . $slide_des . '
                  </div>';
                    if ($slide_url != null) {
                        echo '
               </a>';
                    }
                }               
                echo '
            </li>';
            endwhile;  
            echo '	
         </ul>
      </div><!-- end .flexslider -->
   </div><!-- end #slider-large -->';
        }      
}
?>