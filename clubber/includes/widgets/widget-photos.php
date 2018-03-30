<?php
class Photos_Widget extends WP_Widget {
    /*--------------------------------------------------*/
    /* CONSTRUCT THE WIDGET
    /*--------------------------------------------------*/
    function Photos_Widget() {
        /* Widget name and description */
        $widget_opts = array(
            'classname' => 'photos_widget',
            'description' => __('Display your Photos.', 'clubber')
        );
        parent::__construct('photos-widget', esc_html__('CLUBBER - Photos', 'clubber'), $widget_opts);
    }
    /*--------------------------------------------------*/
    /* DISPLAY THE WIDGET
    /*--------------------------------------------------*/
    /* outputs the content of the widget
     * @args --> The array of form elements*/
    function widget($args, $instance) {
        extract($args, EXTR_SKIP);
        $title  = apply_filters('widget_title', $instance['title']);
        $id     = $instance['id_post'];
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
        $photo = null;
        $query = new WP_Query();
        $query->query('post_type=photo&p=' . $id . '');
        echo '
    <div class="widgets-col-photo">
      <div class="photo-widgets">';
        while ($query->have_posts()):
            $query->the_post();
            $args        = array(
                'post_type' => 'attachment',
                'numberposts' => -1,
                'post_status' => null,
                'post_parent' => $post->ID
            );
            $attachments = get_posts($args);
            $arrImages =& get_children('post_type=attachment&orderby=menu_order&order=DESC&post_mime_type=image&numberposts=' . $number . '&post_parent=' . get_the_ID());
            if ($arrImages) {
                foreach ($arrImages as $attachment) {
                    $cover_gallery = wp_get_attachment_image($attachment->ID, 'photo-widget');
                    $cover_large   = wp_get_attachment_image_src($attachment->ID, 'photo-large');
                    $photo .= '
        <div class="photo-widget-cover">
	  <a href="' . $cover_large[0] . '" class="photo-preview" rel="prettyPhoto-widget[pp_gal]">' . $cover_gallery . '</a>
	</div><!-- end .photo-widget-cover -->';
                }
            }
            echo $photo;
?>
                                  	

<?php
        endwhile;
        echo '
      </div><!-- .photo-widgets-->';
        wp_reset_query();
?>

    </div><!-- end .widgets-col-photo --> 
		<?php
        /* after widget */
        echo $after_widget;
    }
    /*--------------------------------------------------*/
    /* UPDATE THE WIDGET
    /*--------------------------------------------------*/
    function update($new_instance, $old_instance) {
        $instance            = $old_instance;
        $instance['title']   = strip_tags($new_instance['title']);
        $instance['id_post'] = strip_tags($new_instance['id_post']);
        $instance['number']  = strip_tags($new_instance['number']);
        return $instance;
    }
    /*--------------------------------------------------*/
    /* WIDGET ADMIN FORM
    /*--------------------------------------------------*/
    /* @instance	The array of keys and values for the widget. */
    function form($instance) {
        $instance = wp_parse_args((array) $instance, array(
            'title' => 'Photos',
            'number' => '6',
            'id_post' => null
            
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
        echo $this->get_field_id('id_post');
?>"><?php
        _e('Post ID:', 'clubber');
?></label>
		<input type="text" class="widefat" id="<?php
        echo $this->get_field_id('id_post');
?>" name="<?php
        echo $this->get_field_name('id_post');
?>" value="<?php
        echo $instance['id_post'];
?>" />
	</p>
	
	<p>
		<label for="<?php
        echo $this->get_field_id('number');
?>"><?php
        _e('Number of Photos:', 'clubber');
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
add_action('widgets_init', create_function('', 'register_widget("Photos_Widget");'));
?>