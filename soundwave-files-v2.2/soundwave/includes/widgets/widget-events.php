<?php
class Events_Widget extends WP_Widget {
    /*--------------------------------------------------*/
    /* CONSTRUCT THE WIDGET
    /*--------------------------------------------------*/
    function Events_Widget() {
        /* Widget name and description */
        $widget_opts = array(
            'classname' => 'events_widget',
            'description' => __('Display your Upcoming Events.', 'wizedesign')
        );
        $this->WP_Widget('events-widget', __('SOUNDWAVE - Upcoming Events', 'wizedesign'), $widget_opts);
    }
    /*--------------------------------------------------*/
    /* DISPLAY THE WIDGET
    /*--------------------------------------------------*/
    /* outputs the content of the widget
     * @args --> The array of form elements*/
    function widget($args, $instance) {
        extract($args, EXTR_SKIP);
        $title  = apply_filters('widget_title', $instance['title']);
        $number = $instance['number'];
        /* before widget */
        echo $before_widget;
        /* display title */
        if ($title)
            echo $before_title . $title . $after_title;
        /* display the widget */

        global $post;                             
        $args = array(
            'orderby' => 'meta_value',
            'meta_key' => 'event_date_interval',
            'meta_value' => strftime("%Y/%m/%d", time()- (60 * 60 * 24) ),
            'meta_compare' => '>',
            'order_by' => 'meta_value',
            'order' => 'ASC',
            'post_type' => 'event',
            'posts_per_page' => $number
        );                 
        $query = new WP_Query($args);        
        echo '
<div class="widgets-col">';
        while ($query->have_posts()):
            $query->the_post();
            $data_event     = get_post_meta($post->ID, 'event_date_interval', true);
			$data_finish    = null;
            $time           = strtotime($data_event);
            $date_yy = date('Y', $time);
            $date_d  = date('d', $time);
			$theme = get_template_directory();
			require($theme.'/includes/language.php');
            $location       = get_post_meta($post->ID, 'event_location', true);
            $venue          = get_post_meta($post->ID, 'event_venue', true);
            $custom         = get_post_custom($post->ID);
            $event_ticket   = $custom["event_ticket"][0];
			$ev_text      = get_post_meta($post->ID, "ev_text", true);
?>

   <div class="evwdg">                                                          
      <div class="evwdg-data">
         <div class="evwdg-day"><?php echo $date_d; ?></div>
         <div class="evwdg-month"><?php echo $date_M; ?></div>
         <div class="evwdg-year"><?php echo $date_yy; ?></div>
      </div><!-- .evwdg-data-->
      <div class="evwdg-title"> <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php if (strlen($post->post_title) > 25) {
echo substr(the_title($before = '', $after = '', FALSE), 0, 25) . '...'; } else { 
the_title();} ?></a>
      </div>
<?php
echo '
      <div class="evwdg-status">';
	if ($venue != null) { 
	  echo '
      <div class="evwdg-venue">' . $venue . '</div>';
	} else {
	  echo '
      <div class="evwdg-venue-gol"></div>';
	}
	  echo '
		<div class="evwdg-test">';
if (get_post_meta($post->ID, 'event_disable', true) == 'no') {
    if ($ev_text) {
      echo '
	  <div class="evwdg-tickets"><a href="' . $event_ticket . '" target="_blank">' .$ev_text. '</a></div>';
	} else {
	 if (get_post_meta($post->ID, 'event_out', true) == 'yes') {
            echo '
	  <div class="evwdg-out"><p>' . __('Sold Out', 'wizedesign') . '</p></div>';
        } elseif (get_post_meta($post->ID, 'event_cancel', true) == 'yes') {
            echo '
	  <div class="evwdg-out"><p>' . __('Canceled', 'wizedesign') . '</p></div>';
        }elseif (get_post_meta($post->ID, 'event_free', true) == 'yes') { 
            echo '
	  <div class="evwdg-out"><p>' . __('Free Entry', 'wizedesign') . '</p></div>';
        } else {
            echo '
	  <div class="evwdg-tickets"><a href="' . $event_ticket . '" target="_blank">' . __('Buy Tickets', 'wizedesign') . '</a></div>';
        }
	
	}
}
?>
</div>
      </div><!-- .evwdg-status -->
   </div><!-- .evwdg -->                                                		
<?php
        endwhile;
        echo '
</div><!-- .widgets-col-->';
        wp_reset_query();
?>
		<?php
        /* after widget */
        echo $after_widget;
    }
    /*--------------------------------------------------*/
    /* UPDATE THE WIDGET
    /*--------------------------------------------------*/
    function update($new_instance, $old_instance) {
        $instance           = $old_instance;
        $instance['title']  = strip_tags($new_instance['title']);
        $instance['number'] = strip_tags($new_instance['number']);
        return $instance;
    }
    /*--------------------------------------------------*/
    /* WIDGET ADMIN FORM
    /*--------------------------------------------------*/
    /* @instance	The array of keys and values for the widget. */
    function form($instance) {
        $instance = wp_parse_args((array) $instance, array(
            'title' => 'Upcoming Events',
            'number' => 3
        ));
        // Display the admin form
?>
        <p>
		<label for="<?php
        echo $this->get_field_id('title');
?>"><?php
        _e('Title:', 'wizedesign');
?></label>
		<input type="text" class="widefat" id="<?php
        echo $this->get_field_id('title');
?>" name="<?php
        echo $this->get_field_name('title');
?>" value="<?php
        echo $instance['title'];
?>" />
	</p>
		
	<p>
		<label for="<?php
        echo $this->get_field_id('number');
?>"><?php
        _e('Posts Number:', 'wizedesign');
?></label>
		<input type="text" class="widefat" id="<?php
        echo $this->get_field_id('number');
?>" name="<?php
        echo $this->get_field_name('number');
?>" value="<?php
        echo $instance['number'];
?>" />
	</p>
	<?php
    } // end form
} // end class
add_action('widgets_init', create_function('', 'register_widget("Events_Widget");'));

class EventsPast_Widget extends WP_Widget {
    /*--------------------------------------------------*/
    /* CONSTRUCT THE WIDGET
    /*--------------------------------------------------*/
    function EventsPast_Widget() {
        /* Widget name and description */
        $widget_opts = array(
            'classname' => 'eventspast_widget',
            'description' => __('Display your Past Events.', 'wizedesign')
        );
        $this->WP_Widget('eventspast-widget', __('SOUNDWAVE - Past Events', 'wizedesign'), $widget_opts);
    }
    /*--------------------------------------------------*/
    /* DISPLAY THE WIDGET
    /*--------------------------------------------------*/
    /* outputs the content of the widget
     * @args --> The array of form elements*/
    function widget($args, $instance) {
        extract($args, EXTR_SKIP);
        $title  = apply_filters('widget_title', $instance['title']);
        $number = $instance['number'];
        /* before widget */
        echo $before_widget;
        /* display title */
        if ($title)
            echo $before_title . $title . $after_title;
        /* display the widget */

        global $post;                             
        $args = array(
            'orderby' => 'meta_value',
            'meta_key' => 'event_date_interval',
            'meta_value' => strftime("%Y/%m/%d", time()- (60 * 60 * 24) ),
            'meta_compare' => '<',
            'order_by' => 'meta_value',
            'order' => 'DESC',
            'post_type' => 'event',
            'posts_per_page' => $number
        );                 
        $query = new WP_Query($args);        
        echo '
<div class="widgets-col">';
        while ($query->have_posts()):
            $query->the_post();
            $data_event     = get_post_meta($post->ID, 'event_date_interval', true);
			$data_finish    = null;
            $time           = strtotime($data_event);
            $date_yy = date('Y', $time);
            $date_d  = date('d', $time);
			$theme = get_template_directory();
			require($theme.'/includes/language.php');
            $location       = get_post_meta($post->ID, 'event_location', true);
            $venue          = get_post_meta($post->ID, 'event_venue', true);
            $custom         = get_post_custom($post->ID);
            $event_ticket   = $custom["event_ticket"][0];
			$ev_text      = get_post_meta($post->ID, "ev_text", true);
?>

   <div class="evwdg">                                                          
      <div class="evwdg-data">
         <div class="evwdg-day"><?php echo $date_d; ?></div>
         <div class="evwdg-month"><?php echo $date_M; ?></div>
         <div class="evwdg-year"><?php echo $date_yy; ?></div>
      </div><!-- .evwdg-data-->
      <div class="evwdg-title"> <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php if (strlen($post->post_title) > 25) {
echo substr(the_title($before = '', $after = '', FALSE), 0, 25) . '...'; } else { 
the_title();} ?></a>
      </div>
<?php
echo '
      <div class="evwdg-status">';
	if ($venue != null) { 
	  echo '
      <div class="evwdg-venue">' . $venue . '</div>';
	} else {
	  echo '
      <div class="evwdg-venue-gol"></div>';
	}
	  echo '
		<div class="evwdg-test">';
if (get_post_meta($post->ID, 'event_disable', true) == 'no') {
    if ($ev_text) {
      echo '
	  <div class="evwdg-tickets"><a href="' . $event_ticket . '" target="_blank">' .$ev_text. '</a></div>';
	} else {
	 if (get_post_meta($post->ID, 'event_out', true) == 'yes') {
            echo '
	  <div class="evwdg-out"><p>' . __('Sold Out', 'wizedesign') . '</p></div>';
        } elseif (get_post_meta($post->ID, 'event_cancel', true) == 'yes') {
            echo '
	  <div class="evwdg-out"><p>' . __('Canceled', 'wizedesign') . '</p></div>';
        }elseif (get_post_meta($post->ID, 'event_free', true) == 'yes') { 
            echo '
	  <div class="evwdg-out"><p>' . __('Free Entry', 'wizedesign') . '</p></div>';
        } else {
            echo '
	  <div class="evwdg-tickets"><a href="' . $event_ticket . '" target="_blank">' . __('Buy Tickets', 'wizedesign') . '</a></div>';
        }
	
	}
}
?>
</div>
      </div><!-- .evwdg-status -->
   </div><!-- .evwdg -->                                                		
<?php
        endwhile;
        echo '
</div><!-- .widgets-col-->';
        wp_reset_query();
?>
		<?php
        /* after widget */
        echo $after_widget;
    }
    /*--------------------------------------------------*/
    /* UPDATE THE WIDGET
    /*--------------------------------------------------*/
    function update($new_instance, $old_instance) {
        $instance           = $old_instance;
        $instance['title']  = strip_tags($new_instance['title']);
        $instance['number'] = strip_tags($new_instance['number']);
        return $instance;
    }
    /*--------------------------------------------------*/
    /* WIDGET ADMIN FORM
    /*--------------------------------------------------*/
    /* @instance	The array of keys and values for the widget. */
    function form($instance) {
        $instance = wp_parse_args((array) $instance, array(
            'title' => 'Past Events',
            'number' => 3
        ));
        // Display the admin form
?>
        <p>
		<label for="<?php
        echo $this->get_field_id('title');
?>"><?php
        _e('Title:', 'wizedesign');
?></label>
		<input type="text" class="widefat" id="<?php
        echo $this->get_field_id('title');
?>" name="<?php
        echo $this->get_field_name('title');
?>" value="<?php
        echo $instance['title'];
?>" />
	</p>
		
	<p>
		<label for="<?php
        echo $this->get_field_id('number');
?>"><?php
        _e('Posts Number:', 'wizedesign');
?></label>
		<input type="text" class="widefat" id="<?php
        echo $this->get_field_id('number');
?>" name="<?php
        echo $this->get_field_name('number');
?>" value="<?php
        echo $instance['number'];
?>" />
	</p>
	<?php
    } // end form
} // end class
add_action('widgets_init', create_function('', 'register_widget("EventsPast_Widget");'));
?>