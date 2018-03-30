<?php

/*
 * Display a Flickr photo stream
 */
class wpgrade_flickr_widget extends WP_Widget
{
	public function __construct()
	{
		parent::__construct( 'wpgrade_flickr_widget', wpgrade::themename().' '.__('Flickr Widget','bucket'), array('description' => __('Display Flickr images in your sidebar or footer (maximum 20 but we recommend less).','bucket'),) );
	}

	/**
	 * The widget contents
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		$title = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';

		echo $args['before_widget'];
		if ( ! empty( $title ) )
		{
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$photos = $this->get_photos( array(
			'username' => $instance['username'],
			'count' => $instance['count'],
			'tags' => $instance['tags'],
		) );

		if ( is_wp_error( $photos ) )
		{
			echo $photos->get_error_message();
		}
		else
		{
			echo '<ul class="wpgrade-flickr-items">';
			foreach ( $photos as $photo )
			{
				$link = esc_url( $photo->link );
				$src = esc_url($this->resize($photo->media->m));
				$title = esc_attr( $photo->title );
				$item = sprintf( '<a class="wpgrade-flickr-link" href="%s"><img src="%s" alt="%s" /></a>', $link, $src, $title );
				$item = sprintf( '<li class="wpgrade-flickr-item">%s</li>', $item );
				echo $item;
			}
			echo '</ul>';
		}

		echo $args['after_widget'];
	}

	/**
	 * Returns an array of photos
	 */
	private function get_photos( $args = array() )
	{
		// do some caching to prevent Flickr from banning us
		$transient_key = md5( 'wpgrade-flickr-cache-' . print_r( $args, true ) );
		$cached = get_transient( $transient_key );

		//if there is a cached version use that one
		if ( $cached )
		{
			return $cached;
		}

		$username = isset( $args['username'] ) ? $args['username'] : '';
		$tags = isset( $args['tags'] ) ? $args['tags'] : '';
		$count = isset( $args['count'] ) ? absint( $args['count'] ) : 8;
		$query = array('tagmode' => 'any','tags' => $tags);

		// If username is actually an RSS feed
		if ( preg_match( '#^https?://api\.flickr\.com/services/feeds/photos_public\.gne#', $username ) )
		{
			$url = parse_url( $username );
			$url_query = array();
			wp_parse_str( $url['query'], $url_query );
			$query = array_merge( $query, $url_query );
		}
		elseif (strpos($username, '@N')) {
			//we are dealing with a user id
			$user_id = $username;
			$query['id'] = $user_id;
		} else {
			$user = $this->request( 'flickr.people.findByUsername', array( 'username' => $username ) );
			if ( is_wp_error( $user ) )
			{
				return $user;
			}

			$user_id = $user->user->id;
			$query['id'] = $user_id;
		}

		$photos = $this->request_feed( 'photos_public', $query );

		if ( ! $photos )
		{
			return new WP_Error( 'error', __('Something went wrong.', 'bucket') );
		}

		$photos = array_slice( $photos, 0, $count );
		//cache the photos for an hour
		set_transient( $transient_key, $photos, apply_filters( 'wpgrade_flickr_widget_cache_timeout', 3600 ) );
		return $photos;
	}

	/**
	 * Make a request to the Flickr API.
	 */
	private function request( $method, $args )
	{
		$args['method'] = $method;
		$args['format'] = 'json';
		// the api key we've aquired from Flickr
		$args['api_key'] = 'cf07a23ac8100c1b53c0fb164941bf62';
		$args['nojsoncallback'] = 1;
		$url = esc_url_raw( add_query_arg( $args, 'http://api.flickr.com/services/rest/' ) );

		$response = wp_remote_get( $url );
		if ( is_wp_error( $response ) )
		{
			return false;
		}

		$body = wp_remote_retrieve_body( $response );
		$obj = json_decode( $body );

		if ( $obj && $obj->stat == 'fail' )
		{
			return new WP_Error( 'error', $obj->message );
		}

		return $obj ? $obj : false;
	}

	/**
	 * Fetch items from the Flickr Feed API.
	 */
	private function request_feed( $feed = 'photos_public', $args = array() )
	{
		$args['format'] = 'json';
		$args['nojsoncallback'] = 1;
		$url = sprintf( 'http://api.flickr.com/services/feeds/%s.gne', $feed );
		$url = esc_url_raw( add_query_arg( $args, $url ) );

		$response = wp_remote_get( $url );
		if ( is_wp_error( $response ) )
		{
			return false;
		}

		$body = wp_remote_retrieve_body( $response );
		$body = preg_replace( "#\\\\'#", "\\\\\\'", $body );
		$obj = json_decode( $body );

		return $obj ? $obj->items : false;

	}

	/**
	 * Modify the url to get a new size of the image
	 */
	private function resize($url, $size = 'square')
	{
		$url_array = explode('/', $url);
		//strip the filename
		$photo = array_pop($url_array);

		switch($size)
		{
			case 'square': $suffix = '_s.';  break;
			case 'thumbnail': $suffix = '_t.';  break;
			case 'small': $suffix = '_m.';  break;
			case 'm640': $suffix = '_z.';  break;
			case 'm800': $suffix = '_c.';  break;
			case 's320': $suffix = '_n.';  break;
			case 's150': $suffix = '_q.';  break;
			case 'large': $suffix = '_b.';  break;
			default:  $suffix = '.';  break; // Medium
		}

		// replace the old size marker with the needed one
		$url_array[] =  preg_replace('/(_(s|t|c|n|q|m|b|z))?\./i', $suffix, $photo);
		return implode('/', $url_array);
	}

	/**
	 * Validate and update widget options.
	 */
	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = strip_tags( $new_instance['username'] );
		$instance['tags'] = strip_tags( $new_instance['tags'] );
		$instance['count'] = absint( $new_instance['count'] );
		return $instance;
	}

	/**
	 * Render widget controls.
	 */
	public function form( $instance )
	{
		$title = isset( $instance['title'] ) ? $instance['title'] : __('Flickr Shots','bucket');
		$username = isset( $instance['username'] ) ? $instance['username'] : '';
		$tags = isset( $instance['tags'] ) ? $instance['tags'] : '';
		$count = isset( $instance['count'] ) ? absint( $instance['count'] ) : 8;
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title','bucket'); ?>:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e( 'Username or RSS url','bucket'); ?>:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" type="text" value="<?php echo esc_attr( $username ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'tags' ); ?>"><?php _e( 'Tags' ,'bucket'); ?>:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'tags' ); ?>" name="<?php echo $this->get_field_name( 'tags' ); ?>" type="text" value="<?php echo esc_attr( $tags ); ?>" /><br />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Number of images','bucket'); ?>:</label><br />
			<input type="number" min="1" max="20" value="<?php echo esc_attr( $count ); ?>" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" />
		</p>

	<?php
	}
}

add_action('widgets_init', create_function('', 'return register_widget("wpgrade_flickr_widget");'));
