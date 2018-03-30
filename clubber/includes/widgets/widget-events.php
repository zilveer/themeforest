<?php
class Events_Widget extends WP_Widget {
    /*--------------------------------------------------*/
    /* CONSTRUCT THE WIDGET
    /*--------------------------------------------------*/
    function Events_Widget() {
        /* Widget name and description */
        $widget_opts = array(
            'classname' => 'events_widget',
            'description' => __('Display your Upcoming Events.', 'clubber')
        );
        parent::__construct('events-widget', esc_html__('CLUBBER - Upcoming Events', 'clubber'), $widget_opts);
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
?>

	<?php
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
            $date_yy 		= date('Y', $time);
            $date_d 		= date('d', $time);
			$theme 			= get_template_directory();
			require($theme.'/includes/language.php');
            $location       = get_post_meta($post->ID, 'event_location', true);
            $venue          = get_post_meta($post->ID, 'event_venue', true);
			$event_text     = get_post_meta($post->ID, "ev_text", true);
            $custom         = get_post_custom($post->ID);
            $event_ticket   = $custom["event_ticket"][0];
?>

    <div class="event-widgets">                                                          
      <div class="event-w-data">
        <div class="event-w-day"><?php echo $date_d; ?></div>
        <div class="event-w-month"> <?php echo $date_M; ?></div>
      </div><!-- .event-w-data-->
      <div class="event-w-title"> <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php if (strlen($post->post_title) > 27) {
echo substr(the_title($before = '', $after = '', FALSE), 0, 27) . '...'; } else { 
the_title();} ?></a>
</div>
      <div class="event-w-venue"> <?php  echo $venue; ?></div><!-- .event-w-location-->
        <div class="event-w-status"><?php
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
?>
        </div><!-- .event-w-status-->
    </div><!-- .event-widgets-->                                                		
<?php
        endwhile;
        echo '
    </div><!-- .event-widgets-col-->';
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
        _e('Title:', 'clubber');
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
        _e('Posts Number:', 'clubber');
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

class Events_WidgetPast extends WP_Widget {
    /*--------------------------------------------------*/
    /* CONSTRUCT THE WIDGET
    /*--------------------------------------------------*/
    function Events_WidgetPast() {
        /* Widget name and description */
        $widget_opts = array(
            'classname' => 'events_widget_past',
            'description' => __('Display your Past Events.', 'clubber')
        );
        parent::__construct('events-widget-past', esc_html__('CLUBBER - Past Events', 'clubber'), $widget_opts);
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
?>

	<?php
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
            $date_yy 		= date('Y', $time);
            $date_d  		= date('d', $time);
			$theme 			= get_template_directory();
			require($theme.'/includes/language.php');
            $location       = get_post_meta($post->ID, 'event_location', true);
            $venue          = get_post_meta($post->ID, 'event_venue', true);
			$event_text     = get_post_meta($post->ID, "ev_text", true);
            $custom         = get_post_custom($post->ID);
            $event_ticket   = $custom["event_ticket"][0];
?>

    <div class="event-widgets">                                                          
      <div class="event-w-data">
        <div class="event-w-day"><?php echo $date_d; ?></div>
        <div class="event-w-month"> <?php echo $date_M; ?></div>
      </div><!-- .event-w-data-->
      <div class="event-w-title"> <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php if (strlen($post->post_title) > 27) {
echo substr(the_title($before = '', $after = '', FALSE), 0, 27) . '...'; } else { 
the_title();} ?></a>
</div>
      <div class="event-w-venue"> <?php  echo $venue; ?></div><!-- .event-w-location-->
        <div class="event-w-status"><?php
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
?>
        </div><!-- .event-w-status-->
    </div><!-- .event-widgets-->                                                		
<?php
        endwhile;
        echo '
    </div><!-- .event-widgets-col-->';
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
        _e('Title:', 'clubber');
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
        _e('Posts Number:', 'clubber');
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
add_action('widgets_init', create_function('', 'register_widget("Events_WidgetPast");'));
?>