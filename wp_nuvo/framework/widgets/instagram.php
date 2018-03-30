<?php
class CS_Instagram_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'cs_instagram_widget', // Base ID
            esc_html__('CS Instagram', 'wp_nuvo'), // Name
            array('description' => esc_html__('CS Instagram Widget', 'wp_nuvo'),) // Args
        );
    }
    
    function widget($args, $instance) {      
        extract($args);
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$username = empty($instance['username']) ? '' : $instance['username'];
		$limit = empty($instance['number']) ? 9 : $instance['number'];
		$columns = empty($instance['columns']) ? 3 : $instance['columns'];
		$size = empty($instance['size']) ? 'thumbnail' : $instance['size'];
		$target = empty($instance['target']) ? '_self' : $instance['target'];
		$link = empty($instance['link']) ? '' : $instance['link'];
		$extra_class = empty($instance['extra_class']) ? '' : $instance['extra_class'];
		switch ($columns) {
			case 1:
	            $span = "col-xs-12 col-sm-12 col-md-12 col-lg-12";
	            break;
	        case 2:
	            $span = "col-xs-12 col-sm-6 col-md-6 col-lg-6";
	            break;
			case 3:
	            $span = "col-xs-12 col-sm-4 col-md-4 col-lg-4";
	            break;
	        case 4:
	            $span = "col-xs-12 col-sm-3 col-md-3 col-lg-3";
	            break;
	        default:
	            $span = "col-xs-12 col-sm-4 col-md-4 col-lg-4";
	    }
        echo $before_widget;

        if (!empty($title))
            echo $before_title . $title . $after_title;
        if ($username != '') {

			$media_array = $this->scrape_instagram($username, $limit);

			if ( is_wp_error($media_array) ) {

			   echo $media_array->get_error_message();

			} else {

				// filter for images only?
				if ( $images_only = apply_filters( 'cs_images_only', FALSE ) )
					$media_array = array_filter( $media_array, array( $this, 'images_only' ) );

				?><div class="cs-instagram-pics <?php echo $extra_class;?>"><?php
				foreach ($media_array as $item) {
					echo '<div class="instagram-item '.$span.'"><a href="'. esc_url( $item['link'] ) .'" target="'. esc_attr( $target ) .'"><img src="'. esc_url($item[$size]['url']) .'"  alt="'. esc_attr( $item['description'] ) .'" title="'. esc_attr( $item['description'] ).'"/></a></div>';
				}
				?></div><?php
			}
		}
		if ($link != '') {
			?><p class="clear"><a href="//instagram.com/<?php echo trim($username); ?>" rel="me" target="<?php echo esc_attr( $target ); ?>"><?php echo $link; ?></a></p><?php
		}
        echo $after_widget;
    }         
    
    function update( $new_instance, $old_instance ) {
         $instance = $old_instance;
         $instance['title'] = strip_tags($new_instance['title']);
		$instance['username'] = trim(strip_tags($new_instance['username']));
		$instance['number'] = !absint($new_instance['number']) ? 9 : $new_instance['number'];
		$instance['columns'] = !absint($new_instance['columns']) ? 3 : $new_instance['columns'];
		$instance['size'] = (($new_instance['size'] == 'thumbnail' || $new_instance['size'] == 'large') ? $new_instance['size'] : 'thumbnail');
		$instance['target'] = (($new_instance['target'] == '_self' || $new_instance['target'] == '_blank') ? $new_instance['target'] : '_self');
		$instance['link'] = strip_tags($new_instance['link']);
         $instance['extra_class'] = $new_instance['extra_class'];
         
         return $instance;
    }
    
    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => esc_html__('Instagram', 'wp_nuvo'), 'username' => '', 'link' => esc_html__('Follow Us', 'wp_nuvo'), 'number' => 9,'columns' => 3, 'size' => 'thumbnail', 'target' => '_self') );
		$title = esc_attr($instance['title']);
		$username = esc_attr($instance['username']);
		$number = absint($instance['number']);
		$columns = absint($instance['columns']);
		$size = esc_attr($instance['size']);
		$target = esc_attr($instance['target']);
		$link = esc_attr($instance['link']);
        $extra_class = isset($instance['extra_class']) ? esc_attr($instance['extra_class']) : '';
        ?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title', 'wp_nuvo'); ?>: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('username'); ?>"><?php esc_html_e('Username', 'wp_nuvo'); ?>: <input class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" type="text" value="<?php echo $username; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php esc_html_e('Number of photos', 'wp_nuvo'); ?>: <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('columns'); ?>"><?php esc_html_e('Columns', 'wp_nuvo'); ?>: <input class="widefat" id="<?php echo $this->get_field_id('columns'); ?>" name="<?php echo $this->get_field_name('columns'); ?>" type="text" value="<?php echo $columns; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('size'); ?>"><?php esc_html_e('Photo size', 'wp_nuvo'); ?>:</label>
			<select id="<?php echo $this->get_field_id('size'); ?>" name="<?php echo $this->get_field_name('size'); ?>" class="widefat">
				<option value="thumbnail" <?php selected('thumbnail', $size) ?>><?php esc_html_e('Thumbnail', 'wp_nuvo'); ?></option>
				<option value="large" <?php selected('large', $size) ?>><?php esc_html_e('Large', 'wp_nuvo'); ?></option>
			</select>
		</p>
		<p><label for="<?php echo $this->get_field_id('target'); ?>"><?php esc_html_e('Open links in', 'wp_nuvo'); ?>:</label>
			<select id="<?php echo $this->get_field_id('target'); ?>" name="<?php echo $this->get_field_name('target'); ?>" class="widefat">
				<option value="_self" <?php selected('_self', $target) ?>><?php esc_html_e('Current window (_self)', 'wp_nuvo'); ?></option>
				<option value="_blank" <?php selected('_blank', $target) ?>><?php esc_html_e('New window (_blank)', 'wp_nuvo'); ?></option>
			</select>
		</p>
		<p><label for="<?php echo $this->get_field_id('link'); ?>"><?php esc_html_e('Link text', 'wp_nuvo'); ?>: <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo $link; ?>" /></label></p>
		<p>
			<label for="<?php echo $this->get_field_id('extra_class'); ?>">Extra Class:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('extra_class'); ?>" name="<?php echo $this->get_field_name('extra_class'); ?>" value="<?php echo $instance['extra_class']; ?>" />
		</p>
         <?php
         
    } 
    function scrape_instagram($username, $slice = 9) {

		if (false === ($instagram = get_transient('instagram-media-'.sanitize_title_with_dashes($username)))) {

			$remote = wp_remote_get('http://instagram.com/'.trim($username));

			if (is_wp_error($remote))
	  			return new WP_Error('site_down', esc_html__('Unable to communicate with Instagram.', 'wp_nuvo'));

  			if ( 200 != wp_remote_retrieve_response_code( $remote ) )
  				return new WP_Error('invalid_response', esc_html__('Instagram did not return a 200.', 'wp_nuvo'));

			$shards = explode('window._sharedData = ', $remote['body']);
			$insta_json = explode(';</script>', $shards[1]);
			$insta_array = json_decode($insta_json[0], TRUE);

			if (!$insta_array)
	  			return new WP_Error('bad_json', esc_html__('Instagram has returned invalid data.', 'wp_nuvo'));

			$images = $insta_array['entry_data']['UserProfile'][0]['userMedia'];

			$instagram = array();
			foreach ($images as $image) {

				if ($image['user']['username'] == $username) {

					$image['link']                          = preg_replace( "/^http:/i", "", $image['link'] );
					$image['images']['thumbnail']           = preg_replace( "/^http:/i", "", $image['images']['thumbnail'] );
					$image['images']['standard_resolution'] = preg_replace( "/^http:/i", "", $image['images']['standard_resolution'] );

					$instagram[] = array(
						'description'   => $image['caption']['text'],
						'link'          => $image['link'],
						'time'          => $image['created_time'],
						'comments'      => $image['comments']['count'],
						'likes'         => $image['likes']['count'],
						'thumbnail'     => $image['images']['thumbnail'],
						'large'         => $image['images']['standard_resolution'],
						'type'          => $image['type']
					);
				}
			}

			$instagram = base64_encode( serialize( $instagram ) );
			set_transient('instagram-media-'.sanitize_title_with_dashes($username), $instagram, apply_filters('cs_instagram_cache_time', HOUR_IN_SECONDS*2));
		}

		$instagram = unserialize( base64_decode( $instagram ) );

		return array_slice($instagram, 0, $slice);
	}
	function images_only($media_item) {

		if ($media_item['type'] == 'image')
			return true;

		return false;
	}

}

/**
* Class CS_Social_Widget
*/

function register_instagram_widget() {
    register_widget('CS_instagram_Widget');
}

add_action('widgets_init', 'register_instagram_widget');
?>