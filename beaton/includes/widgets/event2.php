<?php
class wize_widget_event2 extends WP_Widget {
	
    /*--------------------------------------------------*/
    /* CONSTRUCT THE WIDGET
    /*--------------------------------------------------*/
	
    function wize_widget_event2() {
        $widget_opts = array(
            'classname' => 'widget_event_two',
            'description' => __('This widget displays events in the future, past or recent events.', 'wizedesign')
        );
        parent::__construct('widget-event#2', esc_html__('BEATON - Events #2', 'wizedesign'), $widget_opts);
    }
	
    /*--------------------------------------------------*/
    /* DISPLAY THE WIDGET
    /*--------------------------------------------------*/
	
    function widget($args, $instance) {
        extract($args, EXTR_SKIP);
        $title  = apply_filters('widget_title', $instance['title']);
        $number = $instance['number'];
        $period = empty($instance['period']) ? '' : $instance['period'];
		
        /* before widget */
		
        echo $before_widget;
		
        /* display title */
		
        if ($title)
            echo $before_title . $title . $after_title;
		
        /* display the widget */
        
		$current    = current_time('Y/m/d');
        global $post;
        $queryR = array(
            'post_type' => 'event',
            'posts_per_page' => $number
        );
        $queryU = array(
            'post_type' => 'event',
            'posts_per_page' => $number,
            'orderby' => 'meta_value',
            'order' => 'ASC',
            'meta_query' => array(
                array(
                    'key' => 'ev_date',
                    'compare' => '>=',
                    'value' => $current ,
                )),
            'meta_key' => 'ev_date'
        );
        $queryP = array(
            'post_type' => 'event',
            'posts_per_page' => $number,
            'orderby' => 'meta_value',
            'order' => 'ASC',
            'meta_query' => array(
                array(
                    'key' => 'ev_date',
                    'compare' => '<',
                    'value' => $current ,
                )),
            'meta_key' => 'ev_date'
        );
        switch ($period) {
            case "recent":
                $wp_query = new WP_Query($queryR);
                break;
            case "upcoming":
                $wp_query = new WP_Query($queryU);
                break;
            case "past":
                $wp_query = new WP_Query($queryP);
                break;
        }
        echo '
	<div id="wd-ev2">';
        while ($wp_query->have_posts()):
            $wp_query->the_post();
			global $post;
			$theme 		= get_template_directory();
            $image_id   = get_post_thumbnail_id();
            $cover      = wp_get_attachment_image_src($image_id, 'SldFull');
			$no_cover   = get_template_directory_uri();
            $date       = get_post_meta($post->ID, 'ev_date', true);
			require($theme.'/includes/language.php');
            $time       = strtotime($date);
            $day        = date('d', $time);
            $out        = get_post_meta($post->ID, 'ev_out', true);
            $cancel     = get_post_meta($post->ID, 'ev_cancel', true);
            $free       = get_post_meta($post->ID, 'ev_free', true);
            $disable    = get_post_meta($post->ID, 'ev_disable', true);
            $ticket_url = get_post_meta($post->ID, 'ev_ticket_url', true);
            $text       = get_post_meta($post->ID, 'ev_text', true);
			
		/* display */
		
            echo '
		<div class="wd-ev2">
			<div class="wd-ev2-cover">';
        if ($image_id) {
            echo '
				<img src="' . esc_url($cover[0]) . '" alt="' . esc_attr(get_the_title()) . '" />';
        } else {
            echo '
				<img src="' . esc_url($no_cover) . '/images/no-cover/wdev2.png" alt="no-cover" />';
        }
        echo '
				<div class="wd-ev2-bg"></div>
				<div class="wd-ev2-title">
					<div class="wd-ev2-date">
						<div class="wd-ev2-week"><span>' . esc_html($week, "wizedesign") . '</span></div>
						<div class="wd-ev2-dm">' . esc_html($day, "wizedesign") . ' ' . esc_html($month, "wizedesign") . '</div>
					</div><!-- end .wd-ev2-date -->
					<h2><a href="' . esc_url(get_permalink()) . '">';
            if (strlen($post->post_title) > 44) {
                echo substr(the_title($before = '', $after = '', FALSE), 0, 44) . '...';
            } else {
                the_title();
            }
            echo '</a></h2>
				</div><!-- end .wd-ev2-title -->';
            if ($disable == 'no') {
                if ($text) {
                    echo '
						<a href="' . esc_url($ticket_url) . '" class="wd-ev2-button">' . esc_html($text, "wizedesign") . '</a>';
                } else {
                    if ($out == 'yes') {
                        echo '
						<div class="wd-ev2-none">' . esc_html__('Sold Out', 'wizedesign') . '</div>';
                    } elseif ($cancel == 'yes') {
                        echo '
						<div class="wd-ev2-none">' . esc_html__('Canceled', 'wizedesign') . '</div>';
                    } elseif ($free == 'yes') {
                        echo '
						<div class="wd-ev2-none">' . esc_html__('Free Entry', 'wizedesign') . '</div>';
                    } else {
                        echo '
						<a href="' . esc_url($ticket_url) . '" class="wd-ev2-button">' . esc_html__("Buy Tickets", "wizedesign") . '</a>';
                    }
                }
            }
            echo '	
			</div><!-- end .wd-ev2-cover -->
		</div><!-- end .wd-ev2 -->';
		
        endwhile;
		
        echo '
	</div><!-- end #wd-bl2 -->
		';
		
        wp_reset_postdata();
		
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
        $instance['period'] = strip_tags($new_instance['period']);
        return $instance;
    }
	
    /*--------------------------------------------------*/
    /* WIDGET ADMIN FORM
    /*--------------------------------------------------*/
	
    function form($instance) {
        $instance = wp_parse_args((array) $instance, array(
            'title' => 'Events',
            'number' => 3
        ));
		
        /* display the admin form */
		
        echo '	
    <p>
		<label for="' . esc_attr($this->get_field_id('title')) . '">' . __('Title:', 'wizedesign') . '</label>
		<input type="text" class="widefat" id="' . esc_attr($this->get_field_id('title')) . '" name="' . esc_attr($this->get_field_name('title')) . '" value="' . esc_attr($instance['title']) . '" />
	</p>	
	<p>
		<label for="' . esc_attr($this->get_field_id('number')) . '">' . __('Posts Number:', 'wizedesign') . '</label>
		<input type="text" class="widefat" id="' . esc_attr($this->get_field_id('number')) . '" name="' . esc_attr($this->get_field_name('number')) . '" value="' . esc_attr($instance['number']) . '" />
	</p>
	<p>
		<label for="' . $this->get_field_id("text") . '">' . __('Period:', 'wizedesign') . '
			<select class="widefat" id="' . esc_attr( $this->get_field_id('period') ) . '" name="' . $this->get_field_name('period') . '" type="text">'; 
?>
				<option value='recent' <?php selected($instance['period'], 'recent'); ?>>Recent</option>
				<option value='upcoming' <?php selected($instance['period'], 'upcoming'); ?>>Upcoming</option> 
				<option value='past' <?php selected($instance['period'], 'past'); ?>>Past</option> 
<?php
		echo '
			</select>                
		</label>
    </p>';
    }
}

add_action('widgets_init', create_function('', 'register_widget("wize_widget_event2");'));