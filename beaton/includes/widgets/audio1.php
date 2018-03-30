<?php
class wize_widget_audio1 extends WP_Widget {
	
    /*--------------------------------------------------*/
    /* CONSTRUCT THE WIDGET
    /*--------------------------------------------------*/
	
    function wize_widget_audio1() {
        $widget_opts = array(
            'classname' => 'widget_audio_one',
            'description' => __('This widget shows an player with album.', 'wizedesign')
        );
        parent::__construct('widget-audio#1', esc_html__('BEATON - Audio #1', 'wizedesign'), $widget_opts);
    }
	
    /*--------------------------------------------------*/
    /* DISPLAY THE WIDGET
    /*--------------------------------------------------*/
	
    function widget($args, $instance) {
        extract($args, EXTR_SKIP);
        $title = apply_filters('widget_title', $instance['title']);
        $id    = $instance['id'];
		
        /* before widget */
		
        echo $before_widget;
		
        /* display title */
		
        if ($title)
            echo $before_title . $title . $after_title;
		
		/* display the widget */
		
        global $post;
        $query    = array(
            'post_type' => 'audio',
            'posts_per_page' => 1,
            'p' => $id
        );
        $wp_query = new WP_Query($query);
        echo '
	<div id="wd-ad1">';
        while ($wp_query->have_posts()):
            $wp_query->the_post();
            $image_id    = get_post_thumbnail_id();
            $cover       = wp_get_attachment_image_src($image_id, 'AdMx');
			$no_cover 	 = get_template_directory_uri();
            $genre       = get_post_meta($post->ID, 'ad_genre', true);
            $itunes      = get_post_meta($post->ID, 'ad_itunes', true);
            $amazon      = get_post_meta($post->ID, 'ad_amazon', true);
            $beatport    = get_post_meta($post->ID, 'ad_beatport', true);
            $other       = get_post_meta($post->ID, 'ad_other', true);
            $other_text  = get_post_meta($post->ID, 'ad_other_text', true);
            $date        = get_post_meta($post->ID, 'ad_release', true);
            $time        = strtotime($date);
            $month       = date('F', $time);
            $day         = date('d', $time);
            $year        = date('Y', $time);
            $player      = null;
            $playlist    = null;
            $args        = array(
                'post_type' => 'attachment',
                'numberposts' => -1,
                'post_status' => null,
                'post_parent' => $post->ID
            );
            $attachments = get_posts($args);
            $arrImages =& get_children('post_type=attachment&orderby=title&order=ASC&post_mime_type=audio/mpeg&post_parent=' . get_the_ID());
            if ($arrImages) {
                foreach ($arrImages as $attachment) {
                    $playlist .= '
			<li><a href="' . esc_url(wp_get_attachment_url($attachment->ID)) . '" class="fap-single-track no-ajax" title="' . esc_attr($attachment->post_title) . '" rel="' . esc_attr($cover[0]) . '" data-meta="#player-meta-widget1">';
					if (strlen($attachment->post_title) > 34) {
						$playlist .= substr($attachment->post_title, 0, 34) . '...';
					} else {
						$playlist .= $attachment->post_title;
					}
					$playlist .= '</a></li>';
                }
            }
			
		/* display */

            echo '
		<div class="wd-ad1">
			<div class="wd-ad1-cover">';
        if ($image_id) {
            echo '
				<img src="' . esc_url($cover[0]) . '" alt="' . esc_attr(get_the_title()) . '" />';
        } else {
            echo '
				<img src="' . esc_url($no_cover) . '/images/no-cover/wdbl1.png" alt="no-cover" />';
        }
        echo '
			</div><!-- end .wd-ad1-cover -->
			<div class="wd-ad1-title">
				<h2><a href="' . esc_url(get_permalink()) . '">';
            if (strlen($post->post_title) > 28) {
                echo substr(the_title($before = '', $after = '', FALSE), 0, 28) . '...';
            } else {
                the_title();
            }
            echo '</a></h2>';
            if ($genre) {
                echo '
				<div class="wd-ad1-gen">' . esc_html($genre, "wizedesign") . '</div>';
            }
            if ($date) {
                echo '
				<div class="wd-ad1-date">' . esc_html($day, "wizedesign") . ' ' . esc_html($month, "wizedesign") . ' ' . esc_html($year, "wizedesign") . '</div>';
            }
            echo '
			</div><!-- end .wd-ad1-title -->
		</div><!-- end .wd-ad1 -->

        <ul class="songs-list">' . $playlist . '
		</ul><!-- end ul.songs-list -->
		
		<div class="wd-ad1-buy">
			<span>' . esc_html__("Buying", "wizedesign") . '</span>';
            if ($beatport) {
                echo ' 
			<a href="' . esc_url($beatport) . '" class="wd-ad1-beatport no-ajax" target="_blank"></a>';
            }
            if ($amazon) {
                echo ' 
			<a href="' . esc_url($amazon) . '" class="wd-ad1-amazon no-ajax" target="_blank"></a>';
            }
            if ($amazon) {
                echo ' 
			<a href="' . esc_url($itunes) . '" class="wd-ad1-itunes no-ajax" target="_blank"></a>';
            }
            if ($other) {
                echo '
			<a href="' . esc_url($other) . '" class="wd-ad1-other no-ajax" target="_blank">' . esc_html($other_text, "wizedesign") . '</a>';
            }
            echo ' 
		</div><!-- end .wd-ad1-buy -->';

		/* display  none */
		
			echo ' 
        <span id="player-meta-widget1">
			<a href="' . esc_url(get_permalink()) . '">' . get_the_title() . '</a>
			<div>' . esc_html($genre, "wizedesign") . '</div>
        </span><!-- end span#player-meta-widget1 -->';

        endwhile;
		
        echo '
	</div><!-- end #wd-ad1 -->
		';
	
        wp_reset_postdata();
		
        /* after widget */
		
        echo $after_widget;
    }
	
    /*--------------------------------------------------*/
    /* UPDATE THE WIDGET
    /*--------------------------------------------------*/
	
    function update($new_instance, $old_instance) {
        $instance          = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['id']    = strip_tags($new_instance['id']);
        return $instance;
    }
	
    /*--------------------------------------------------*/
    /* WIDGET ADMIN FORM
    /*--------------------------------------------------*/
	
    function form($instance) {
        $instance = wp_parse_args((array) $instance, array(
            'title' => 'Audio Style 1',
            'number' => 1,
            'id' => null
        ));
		
		/* display the admin form */
		
        echo '	
    <p>
		<label for="' . esc_attr($this->get_field_id('title')) . '">' . __('Title:', 'wizedesign') . '</label>
		<input type="text" class="widefat" id="' . esc_attr($this->get_field_id('title')) . '" name="' . esc_attr($this->get_field_name('title')) . '" value="' . esc_attr($instance['title']) . '" />
	</p>	
	<p>
		<label for="' . esc_attr($this->get_field_id('id')) . '">' . __('Audio ID (optional):', 'wizedesign') . '</label>
		<input type="text" class="widefat" id="' . esc_attr($this->get_field_id('id')) . '" name="' . esc_attr($this->get_field_name('id')) . '" value="' . esc_attr($instance['id']) . '" />
	</p>';
    }
}

add_action('widgets_init', create_function('', 'register_widget("wize_widget_audio1");'));