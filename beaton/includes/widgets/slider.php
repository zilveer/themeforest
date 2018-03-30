<?php
class wize_widget_slider extends WP_Widget {
	
    /*--------------------------------------------------*/
    /* CONSTRUCT THE WIDGET
    /*--------------------------------------------------*/
	
    function wize_widget_slider() {
        $widget_opts = array(
            'classname' => 'widget_slider',
            'description' => __('This widget displays a slider with blog articles.', 'wizedesign')
        );
        parent::__construct('widget-slider', esc_html__('BEATON - Slider', 'wizedesign'), $widget_opts);
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
            'category_name' => $category,
            'post__not_in' => get_option('sticky_posts')
        );
        $wp_query = new WP_Query($query);
        echo '
	<div class="wd-sld">
		<ul class="slides">';
        while ($wp_query->have_posts()):
            $wp_query->the_post();
            global $post;
            $image_id = get_post_thumbnail_id();
            $cover    = wp_get_attachment_image_src($image_id, 'AdMx');
            $no_cover = get_template_directory_uri();
            $category = get_the_category();
			
			/* display */
			
            echo '
			<li>	
				<a href="' . esc_url(get_permalink()) . '"><div class="wd-sld-bg"></div></a>';
            if ($image_id) {
                echo '
				<img src="' . esc_url($cover[0]) . '" alt="' . esc_attr(get_the_title()) . '" />';
            } else {
                echo '
				<img src="' . esc_url($no_cover) . '/images/no-cover/audio.png" alt="no-cover" />';
            }
            echo '
				<div class="wd-sld-title">
					<div class="wd-sld-cat">' . esc_html($category[0]->cat_name, "wizedesign") . '</div>
					<h2><a href="' . esc_url(get_permalink()) . '">' . get_the_title() . '</a></h2>
				</div><!-- end .wd-sld-title -->
				<div class="wd-sld-date">' . get_the_date('l, d F Y') . '</div>
			</li><!-- end li -->';
			
        endwhile;
		
        echo '    
		</ul><!-- end ul.slides -->
	</div><!-- end .wd-sld -->
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
            'title' => 'Slider Recent Posts ',
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

add_action('widgets_init', create_function('', 'register_widget("wize_widget_slider");'));