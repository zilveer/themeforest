<?php
class wize_widget_video extends WP_Widget {
	
    /*--------------------------------------------------*/
    /* CONSTRUCT THE WIDGET
    /*--------------------------------------------------*/
	
    function wize_widget_video() {
        $widget_opts = array(
            'classname' => 'widget_video',
            'description' => __('This widget displays recent videos.', 'wizedesign')
        );
        parent::__construct('widget-video', esc_html__('BEATON - Video', 'wizedesign'), $widget_opts);
    }
	
    /*--------------------------------------------------*/
    /* DISPLAY THE WIDGET
    /*--------------------------------------------------*/
	
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
		
        $query    = array(
            'post_type' => 'video',
            'posts_per_page' => $number
        );
        $wp_query = new WP_Query($query);
        echo '			
	<div id="wd-vd">';
        while ($wp_query->have_posts()):
            $wp_query->the_post();
            global $post;
            $image_id = get_post_thumbnail_id();
            $cover    = wp_get_attachment_image_src($image_id, 'Bl2Sng');
            $no_cover = get_template_directory_uri();
            $venue    = get_post_meta($post->ID, 'vd_venue', true);
            $youtube  = get_post_meta($post->ID, 'vd_youtube', true);
            $vimeo    = get_post_meta($post->ID, 'vd_vimeo', true);
			
		/* display */
		
            echo '		
		<div class="wd-vd">
			<div class="wd-vd-cover">
				<div class="wd-vd-bg"></div>';
            if ($image_id) {
                echo '
				<img src="' . esc_url($cover[0]) . '" alt="' . esc_attr(get_the_title()) . '" />';
            } else {
                echo '
				<img src="' . esc_url($no_cover) . '/images/no-cover/wdph.png" alt="no-cover" />';
            }
            echo '
				<div class="wd-vd-title">
					<div class="wd-vd-venue">' . esc_html($venue, "wizedesign") . '</div>
					<h2><a href="' . esc_url(get_permalink()) . '">' . get_the_title() . '</a></h2>
				</div><!-- end .wd-vd-title -->';
            if ($youtube) {
                echo '
				<a href="http://youtu.be/' . esc_attr($youtube) . '" data-rel="prettyPhoto"><div class="wd-vd-play"></div></a>';
            } elseif ($vimeo) {
                echo '
				<a href="http://vimeo.com/' . esc_attr($vimeo) . '" data-rel="prettyPhoto"><div class="wd-vd-play"></div></a>';
            }
            echo '
			</div><!-- end .wd-vd-cover -->
		</div><!-- end .wd-vd -->';
		
        endwhile;
		
        echo '
	</div><!-- end #wd-vd -->
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
        return $instance;
    }
	
    /*--------------------------------------------------*/
    /* WIDGET ADMIN FORM
    /*--------------------------------------------------*/
	
    function form($instance) {
        $instance = wp_parse_args((array) $instance, array(
            'title' => 'Recent Videos',
            'number' => 3
        ));
		
        /* display the admin form */
		
        echo '	
    <p>
		<label for="' . esc_attr($this->get_field_id('title')) . '">' . esc_html__('Title:', 'wizedesign') . '</label>
		<input type="text" class="widefat" id="' . esc_attr($this->get_field_id('title')) . '" name="' . esc_attr($this->get_field_name('title')) . '" value="' . esc_attr($instance['title']) . '" />
	</p>	
	<p>
		<label for="' . esc_attr($this->get_field_id('number')) . '">' . esc_html__('Posts Number:', 'wizedesign') . '</label>
		<input type="text" class="widefat" id="' . esc_attr($this->get_field_id('number')) . '" name="' . esc_attr($this->get_field_name('number')) . '" value="' . esc_attr($instance['number']) . '" />
	</p>';
    }
}

add_action('widgets_init', create_function('', 'register_widget("wize_widget_video");'));