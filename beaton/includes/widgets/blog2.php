<?php
class wize_widget_blog_two extends WP_Widget {
	
    /*--------------------------------------------------*/
    /* CONSTRUCT THE WIDGET
    /*--------------------------------------------------*/
	
    function wize_widget_blog_two() {
        $widget_opts = array(
            'classname' => 'widget_blog_two',
            'description' => __('Recent posts on blog your site, style #2.', 'wizedesign')
        );
        parent::__construct('widget-blog#2', esc_html__('BEATON - Recent Posts #2', 'wizedesign'), $widget_opts);
    }
	
    /*--------------------------------------------------*/
    /* DISPLAY THE WIDGET
    /*--------------------------------------------------*/
	
    function widget($args, $instance) {
        extract($args, EXTR_SKIP);
        $title    = apply_filters('widget_title', $instance['title']);
        $number   = $instance['number'];
        $category = $instance['category'];
		
        /* before widget */
		
        echo $before_widget;
		
        /* display title */
		
        if ($title)
            echo $before_title . $title . $after_title;
		
        /* display the widget */
		
        $query    = array(
            'posts_per_page' => $number,
            'category_name' => $category
        );
        $wp_query = new WP_Query($query);
        echo '			
	<div id="wd-bl2">';
        while ($wp_query->have_posts()):
            $wp_query->the_post();
            global $post;
            $image_id = get_post_thumbnail_id();
            $cover    = wp_get_attachment_image_src($image_id, 'Bl2Sng');
            $no_cover = get_template_directory_uri();
            $category = get_the_category();
			
		/* display */
		
            echo '		
		<div class="wd-bl2">
			<a href="' . esc_url(get_permalink()) . '">
				<div class="wd-bl2-cover">
					<div class="wd-bl2-bg"></div>';
            if ($image_id) {
                echo '
					<img src="' . esc_url($cover[0]) . '" alt="' . esc_attr(get_the_title()) . '" />';
            } else {
                echo '
					<img src="' . esc_url($no_cover) . '/images/no-cover/wdbl2.png" alt="no-cover" />';
            }
            echo '
					<div class="wd-bl2-date">' . get_the_date('l, d F Y') . '</div>
					<div class="wd-bl2-title">
						<div class="wd-bl2-cat">' . esc_html($category[0]->cat_name, "wizedesign") . '</div>
						<h2>';
            if (strlen($post->post_title) > 65) {
                echo substr(the_title($before = '', $after = '', FALSE), 0, 65) . '...';
            } else {
                the_title();
            }
            echo '</h2>
					</div><!-- end .wd-bl2-title -->
				</div><!-- end .wwd-bl2-cover -->
			</a>
		</div><!-- end .wd-bl2 -->';
		
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
        $instance             = $old_instance;
        $instance['title']    = strip_tags($new_instance['title']);
        $instance['number']   = strip_tags($new_instance['number']);
        $instance['category'] = strip_tags($new_instance['category']);
        return $instance;
    }
	
    /*--------------------------------------------------*/
    /* WIDGET ADMIN FORM
    /*--------------------------------------------------*/
	
    function form($instance) {
        $instance = wp_parse_args((array) $instance, array(
            'title' => 'Recent Posts',
            'number' => 4,
            'category' => null
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
	</p>
	<p>
		<label for="' . esc_attr($this->get_field_id('category')) . '">' . esc_html__('Category Slug (optional):', 'wizedesign') . '</label>
		<input type="text" class="widefat" id="' . esc_attr($this->get_field_id('category')) . '" name="' . esc_attr($this->get_field_name('category')) . '" value="' . esc_attr($instance['category']) . '" />
	</p>';
    }
}

add_action('widgets_init', create_function('', 'register_widget("wize_widget_blog_two");'));