<?php
class wize_widget_photo extends WP_Widget {
	
    /*--------------------------------------------------*/
    /* CONSTRUCT THE WIDGET
    /*--------------------------------------------------*/
	
    function wize_widget_photo() {
        $widget_opts = array(
            'classname' => 'widget_photo',
            'description' => __('This widget displays a photo gallery.', 'wizedesign')
        );
        parent::__construct('widget-photo', esc_html__('BEATON - Photo', 'wizedesign'), $widget_opts);
    }
	
    /*--------------------------------------------------*/
    /* DISPLAY THE WIDGET
    /*--------------------------------------------------*/
	
    function widget($args, $instance) {
        extract($args, EXTR_SKIP);
        $title  = apply_filters('widget_title', $instance['title']);
        $number = $instance['number'];
        $id     = $instance['id'];
		
        /* before widget */
		
        echo $before_widget;
		
        /* display title */
		
        if ($title)
            echo $before_title . $title . $after_title;
		
        /* display the widget */
		
        global $post;
        $photo 		= null;
        $queryphoto = array(
            'post_type' => 'photo',
            'posts_per_page' => 1,
            'p' => $id
        );
        echo '
	<div class="wd-ph">';
        $wp_queryphoto = new WP_Query($queryphoto);
        while ($wp_queryphoto->have_posts()):
            $wp_queryphoto->the_post();
            $args        = array(
                'post_type' => 'attachment',
                'numberposts' => -1,
                'post_status' => null,
                'post_parent' => $post->ID
            );
            $image_id    = get_post_thumbnail_id();
            $cover       = wp_get_attachment_image_src($image_id, 'Bl2Sng');
			$no_cover 	 = get_template_directory_uri();
            $venue       = get_post_meta($post->ID, 'ph_venue', true);
            $attachments = get_posts($args);
            $arrImages =& get_children('post_type=attachment&orderby=menu_order&order=DESC&post_mime_type=image&numberposts=' . $number . '&post_parent=' . get_the_ID());
            if ($arrImages) {
                foreach ($arrImages as $attachment) {
                    $cover_gallery = wp_get_attachment_image($attachment->ID, 'AdMx');
                    $cover_large   = wp_get_attachment_image_src($attachment->ID, 'photo-large');
                    $photo .= '
		<div class="wd-ph-photo">
			<a href="' . esc_url($cover_large[0]) . '" class="photo-preview" data-rel="prettyPhoto-widget[pp_gallery]">' . $cover_gallery . '</a>
		</div><!-- end .wd-ph-photo -->';
                }
            }
			
			/* display */
			
            echo '
		<div class="wd-ph-cover">
			<div class="wd-ph-bg"></div>';
        if ($image_id) {
            echo '
				<img src="' . esc_url($cover[0]) . '" alt="' . esc_attr(get_the_title()) . '" />';
        } else {
            echo '
				<img src="' . esc_url($no_cover) . '/images/no-cover/wdph.png" alt="no-cover" />';
        }
        echo '
			<div class="wd-ph-title">
				<div class="wd-ph-venue">' . esc_html($venue, "wizedesign") . '</div>
				<h2><a href="' . esc_url(get_permalink()) . '">' . get_the_title() . '</a></h2>
			</div><!-- end .wd-ph-title -->
		</div><!-- end .wd-ph-cover -->
		' . $photo . '';
		
        endwhile;
		
        echo '
	</div><!-- end .wd-ph -->
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
        $instance['id']     = strip_tags($new_instance['id']);
        return $instance;
    }
	
    /*--------------------------------------------------*/
    /* WIDGET ADMIN FORM
    /*--------------------------------------------------*/
	
    function form($instance) {
        $instance = wp_parse_args((array) $instance, array(
            'title' => 'Recent Photos',
            'number' => 9,
            'id' => null
        ));
		
        /* display the admin form */
		
        echo '	
    <p>
		<label for="' . esc_attr($this->get_field_id('title')) . '">' . esc_html__('Title:', 'wizedesign') . '</label>
		<input type="text" class="widefat" id="' . esc_attr($this->get_field_id('title')) . '" name="' . esc_attr($this->get_field_name('title')) . '" value="' . esc_attr($instance['title']) . '" />
	</p>	
	<p>
		<label for="' . esc_attr($this->get_field_id('number')) . '">' . esc_html__('Photos number:', 'wizedesign') . '</label>
		<input type="text" class="widefat" id="' . esc_attr($this->get_field_id('number')) . '" name="' . esc_attr($this->get_field_name('number')) . '" value="' . esc_attr($instance['number']) . '" />
	</p>
	<p>
		<label for="' . esc_attr($this->get_field_id('id')) . '">' . esc_html__('Photo ID (optional):', 'wizedesign') . '</label>
		<input type="text" class="widefat" id="' . esc_attr($this->get_field_id('id')) . '" name="' . esc_attr($this->get_field_name('id')) . '" value="' . esc_attr($instance['id']) . '" />
	</p>';
    }
}

add_action('widgets_init', create_function('', 'register_widget("wize_widget_photo");'));