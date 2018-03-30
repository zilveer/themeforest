<?php
class wize_widget_month extends WP_Widget {
	
    /*--------------------------------------------------*/
    /* CONSTRUCT THE WIDGET
    /*--------------------------------------------------*/
	
    function wize_widget_month() {
        $widget_opts = array(
            'classname' => 'widget_like',
            'description' => __('This widget displays the the top articles liked of visitors.', 'wizedesign')
        );
        parent::__construct('widget-like', esc_html__('BEATON - Like Posts', 'wizedesign'), $widget_opts);
    }
	
    /*--------------------------------------------------*/
    /* DISPLAY THE WIDGET
    /*--------------------------------------------------*/
	
    function widget($args, $instance) {
        extract($args, EXTR_SKIP);
        $title    = apply_filters('widget_title', $instance['title']);
        $number   = $instance['number'];
        $types    = empty($instance['types']) ? '' : $instance['types'];
        $period   = empty($instance['period']) ? '' : $instance['period'];
		
        /* before widget */
		
        echo $before_widget;
		
        /* display title */
		
        if ($title)
            echo $before_title . $title . $after_title;
		
        /* display the widget */
		
        global $post;
        $today  = date('j');
        $month  = date('m');
        $week   = date('W');
        $year   = date('Y');
        $queryD = array(
            'year' => $year,
            'day' => $today,
            'post_type' => $types,
            'meta_key' => '_post_like_count',
            'orderby' => 'meta_value_num',
            'order' => 'DESC',
            'posts_per_page' => $number
        );
        $queryW = array(
            'year' => $year,
            'w' => $week,
            'post_type' => $types,
            'meta_key' => '_post_like_count',
            'orderby' => 'meta_value_num',
            'order' => 'DESC',
            'posts_per_page' => $number
        );
        $queryM = array(
            'year' => $year,
            'monthnum' => $month,
            'post_type' => $types,
            'meta_key' => '_post_like_count',
            'orderby' => 'meta_value_num',
            'order' => 'DESC',
            'posts_per_page' => $number
        );
        $queryY = array(
            'year' => $year,
            'post_type' => $types,
            'meta_key' => '_post_like_count',
            'orderby' => 'meta_value_num',
            'order' => 'DESC',
            'posts_per_page' => $number
        );
        switch ($period) {
            case "day":
                $wp_query = new WP_Query($queryD);
                break;
            case "week":
                $wp_query = new WP_Query($queryW);
                break;
            case "month":
                $wp_query = new WP_Query($queryM);
                break;
            case "year":
                $wp_query = new WP_Query($queryY);
                break;
        }
        echo '
	<ol id="wd-lk">';
        while ($wp_query->have_posts()):
            $wp_query->the_post();
            $image_id = get_post_thumbnail_id();
            $cover    = wp_get_attachment_image_src($image_id, 'WdLike');
            $no_cover = get_template_directory_uri();
			
			/* display */
			
            echo '		
		<div class="wd-lk">
			<a href="' . esc_url(get_permalink()) . '">
				<div class="wd-lk-cover">
					<div class="wd-lk-bg"></div>';
            if ($image_id) {
                echo '
					<img src="' . esc_url($cover[0]) . '" alt="' . esc_attr(get_the_title()) . '" /><li></li>';
            } else {
                echo '
					<img src="' . esc_url($no_cover) . '/images/no-cover/wdlike.png" alt="no-cover" /><li></li>';
            }
            echo '
					<div class="wd-lk-title">
						<h2>';
            if (strlen($post->post_title) > 65) {
                echo substr(the_title($before = '', $after = '', FALSE), 0, 65) . '...';
            } else {
                the_title();
            }
            echo '</h2>
					</div><!-- end .wd-lk-title -->
				</div><!-- end .wd-lk-cover -->
			</a>
		</div><!-- end .wd-lk -->';
		
        endwhile;
		
        echo '
	</ol><!-- end ol#wd-wd-lk -->';
	
        wp_reset_postdata();
		
        /* after widget */
		
        echo $after_widget;
    }
	
    /*--------------------------------------------------*/
    /* UPDATE THE WIDGET
    /*--------------------------------------------------*/
	
    function update($new_instance, $old_instance) {
        $instance             = $old_instance;
        $instance['title']    = strip_tags($new_instance['title']);
        $instance['number']   = strip_tags($new_instance['number']);
        $instance['types']    = strip_tags($new_instance['types']);
        $instance['period']   = strip_tags($new_instance['period']);
        return $instance;
    }
	
    /*--------------------------------------------------*/
    /* WIDGET ADMIN FORM
    /*--------------------------------------------------*/
	
    function form($instance) {
        $instance = wp_parse_args((array) $instance, array(
            'title' => 'Like posts month',
            'number' => 4,
            'types' => "post",
            'category' => null
        ));
		
        /* display the admin form */
		
        echo '	
    <p>
		<label for="' . esc_attr($this->get_field_id('title')) . '">' . esc_html__('Title:', 'wizedesign') . '</label>
		<input type="text" class="widefat" id="' . esc_attr($this->get_field_id('title')) . '" name="' . esc_attr($this->get_field_name('title')) . '" value="' . esc_attr($instance['title']) . '" />
	</p>
	<p>
		<label for="' . $this->get_field_id('text'). '">' . __('Post Types:', 'wizedesign') . ' 
			<select class="widefat" id="' . esc_attr( $this->get_field_id('types') ) . '" name="' . $this->get_field_name('types') . '" type="text">';
?>
				<option value='post' <?php selected($instance['types'], 'post'); ?>>Blog</option>
				<option value='photo' <?php selected($instance['types'], 'photo'); ?>>Photo</option> 
				<option value='video' <?php selected($instance['types'], 'video'); ?>>Video</option> 
				<option value='event' <?php selected($instance['types'], 'event'); ?>>Event</option> 
				<option value='audio' <?php selected($instance['types'], 'audio'); ?>>Audio</option> 
				<option value='mix' <?php selected($instance['types'], 'mix'); ?>>Mixes</option> 
				
<?php
	echo '		
			</select>                
		</label>
    </p>
	<p>
		<label for="' . $this->get_field_id("text") . '">' . __('Period:', 'wizedesign') . '
			<select class="widefat" id="' . esc_attr( $this->get_field_id('period') ) . '" name="' . $this->get_field_name('period') . '" type="text">'; 
?>
				<option value='year' <?php selected($instance['period'], 'year'); ?>>Year</option>
				<option value='month' <?php selected($instance['period'], 'month'); ?>>Month</option> 
				<option value='week' <?php selected($instance['period'], 'week'); ?>>Week</option> 
				<option value='day' <?php selected($instance['period'], 'day'); ?>>Day</option> 
<?php
		echo '
			</select>                
		</label>
    </p>
	<p>
		<label for="' . esc_attr($this->get_field_id('number')) . '">' . esc_html__('Posts Number:', 'wizedesign') . '</label>
		<input type="text" class="widefat" id="' . esc_attr($this->get_field_id('number')) . '" name="' . esc_attr($this->get_field_name('number')) . '" value="' . esc_attr($instance['number']) . '" />
	</p>';
    }
}

add_action('widgets_init', create_function('', 'register_widget("wize_widget_month");'));