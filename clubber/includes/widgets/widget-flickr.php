<?php
class wz_Flickr_Widget extends WP_Widget {
    /*--------------------------------------------------*/
    /* CONSTRUCT THE WIDGET
    /*--------------------------------------------------*/
    function wz_Flickr_Widget() {
        /* Widget name and description */
        $widget_opts = array(
            'classname' => 'wz_flickr_widget',
            'description' => __('Display images from a Flickr account.', 'clubber')
        );
        parent::__construct('wz-flickr-widget', esc_html__('CLUBBER - Flickr', 'clubber'), $widget_opts);
    }
    /*--------------------------------------------------*/
    /* DISPLAY THE WIDGET
    /*--------------------------------------------------*/
    /* outputs the content of the widget
     * @args --> The array of form elements*/
    function widget($args, $instance) {
        extract($args, EXTR_SKIP);
        $title = apply_filters('widget_title', $instance['title']);
        $id    = $instance['id'];
        if (!$number = (int) $instance['number']) {
            $number = 3;
        } else if ($number < 1) {
            $number = 1;
        } else if ($number > 9) {
            $number = 9;
        }
        /* before widget */
        echo $before_widget;
        /* display title */
        if ($title)
            echo $before_title . $title . $after_title;
        /* display the widget */
?>
    <div class="widgets-col-flickr">
      <div class="flickr">
        <script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php
        echo $number;
?>&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php
        echo $id;
?>"></script>
        <div class="clear"></div>
      </div><!-- end .flickr -->
    </div><!-- end .widgets-col-flickr -->
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
        $instance['id']     = strip_tags($new_instance['id']);
        $instance['number'] = (int) $new_instance['number'];
        return $instance;
    }
    /*--------------------------------------------------*/
    /* WIDGET ADMIN FORM
    /*--------------------------------------------------*/
    /* @instance	The array of keys and values for the widget. */
    function form($instance) {
        $instance = wp_parse_args((array) $instance, array(
            'title' => 'Photos on flickr',
            'id' => '',
            'number' => '9'
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
        echo $this->get_field_id('id');
?>">Flickr ID (<a href="http://www.idgettr.com" target="_blank">idGettr</a>):</label>
                <input class="widefat" id="<?php
        echo $this->get_field_id('id');
?>" name="<?php
        echo $this->get_field_name('id');
?>" type="text" value="<?php
        echo $instance['id'];
?>" />
	</p>

	<p>
                <label for="<?php
        echo $this->get_field_id('number');
?>">Number of photos:</label>
                <input class="widefat" id="<?php
        echo $this->get_field_id('number');
?>" name="<?php
        echo $this->get_field_name('number');
?>" type="text" value="<?php
        echo $instance['number'];
?>" />
	</p>
	<?php
    } // end form
} // end class
add_action('widgets_init', create_function('', 'register_widget("wz_Flickr_Widget");'));
?>