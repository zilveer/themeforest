<?php
class Videos_Widget extends WP_Widget {
    /*--------------------------------------------------*/
    /* CONSTRUCT THE WIDGET
    /*--------------------------------------------------*/
    function Videos_Widget() {
        /* Widget name and description */
        $widget_opts = array(
            'classname' => 'videos_widget',
            'description' => __('Display your latest Videos.', 'wizedesign')
        );
        $this->WP_Widget('videos-widget', __('SOUNDWAVE - Latest Videos', 'wizedesign'), $widget_opts);
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
        $query = new WP_Query();
        $query->query('post_type=video&posts_per_page=' . $number);
        echo '
<div class="vdwdg">';
        while ($query->have_posts()):
            $query->the_post();
            
            $image_id = get_post_thumbnail_id();
            $cover    = wp_get_attachment_image_src($image_id, 'video-widgets');
			$data_video     = get_post_meta($post->ID, 'vd_date', true);
	$time           = strtotime($data_video);
    $pretty_date_yy = date('Y', $time);
    $pretty_date_M  = date('F', $time);
    $pretty_date_d  = date('d', $time);
	$title       = get_the_title();
	$video    = get_post_meta($post->ID, "video_link", true);
	$venue    = get_post_meta($post->ID, "vd_venue", true);
	$cover_large   = wp_get_attachment_image_src($image_id, 'photo-large');
	$no_cover = get_template_directory_uri();
?>
 <?php	  
echo '                                    
	<div class="vdwdg-cover">
		<div class="wz-wrap wz-hover">';
		if ($image_id) {
		        echo '
			<img src="' . $cover[0] . '" alt="' . get_the_title() . '" />';
				} else {
				echo '
			<img src="' . $no_cover . '/images/no-cover/video-wdg.png" alt="no image" />';
			}
        echo '	
			<div class="he-view">
				<div class="bg a0" data-animate="fadeIn">
					<a href="' . $video . '" class="vdwdg-link a2" data-animate="zoomIn" data-rel="prettyPhoto"></a>
					<a href="' . $cover_large[0] . '" class="vdwdg-zoom a2" data-animate="zoomIn" data-rel="prettyPhoto-cover"></a>
				</div>
			</div>			
		</div>
    </div><!-- end .vdwdg-cover -->';
	  ?>
<?php	  
echo '
	<a href="' . $video . '" data-rel="prettyPhoto">
		<div class="vdwdg-info">		
			<div class="vdpage-title">' . $title . '</div>';
		if ($data_video) { 
		echo '
				<div class="vdpage-des">' .$pretty_date_d. ' ' .$pretty_date_M. ' ' .$pretty_date_yy. '</div>';
		} else {
		echo '
				<div class="vdpage-des">' .$venue. ' </div>';
		}
		echo '
		</div>
	</a>';
?>		

<?php
        endwhile;
        echo '
</div><!-- .vdwdg -->';
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
            'title' => 'Latest Videos',
            'number' => 1
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
add_action('widgets_init', create_function('', 'register_widget("Videos_Widget");'));
?>