<?php
/**
 * Plugin Name: Greatives Instagram Feed
 * Description: A widget that displays latest posts.
 * @author		Greatives Team
 * @URI			http://greatives.eu
 */

add_action( 'widgets_init', 'blade_grve_widget_instagram_feed' );

function blade_grve_widget_instagram_feed() {
	register_widget( 'Blade_GRVE_Widget_Instagram_Feed' );
}

class Blade_GRVE_Widget_Instagram_Feed extends WP_Widget {

	function __construct() {
		$widget_ops = array(
			'classname' => 'grve-instagram-feed',
			'description' => esc_html__( 'A widget that displays instagram feed', 'blade'),
		);
		$control_ops = array(
			'width' => 300,
			'height' => 400,
			'id_base' => 'grve-widget-instagram-feed',
		);
		parent::__construct( 'grve-widget-instagram-feed', '(Greatives) ' . esc_html__( 'Instagram Feed', 'blade' ), $widget_ops, $control_ops );
	}

	function Blade_GRVE_Widget_Instagram_Feed() {
		$this->__construct();
	}

	function widget( $args, $instance ) {

		//Our variables from the widget settings.
		extract( $args );

		$username = $instance['username'];
		$limit = $instance['limit'];
		$order_by = $instance['order_by'];
		$order = $instance['order'];
		$target = $instance['target'];
		$cache = $instance['cache'];

		if( !isset( $cache ) ) {
			$cache = '';
		}

		if( empty( $limit ) ) {
			$limit = 9;
		}

		echo $before_widget; // XSS OK

		// Display the widget title
		$title = apply_filters( 'widget_title', $instance['title'] );
		if ( $title ) {
			echo $before_title . esc_html( $title ) . $after_title; // XSS OK
		}

		if ( !empty( $username ) ) {

			$media_array = $this->blade_grve_get_instagram_array( $username, $limit, $order_by, $order, $cache );
			$output = '';

			if ( is_wp_error( $media_array ) ) {

			   echo wp_kses_post( $media_array->get_error_message() );

			} else {

			?>
				<ul class="grve-instagram-images">
			<?php
				foreach ($media_array as $item) {
			?>
					<li>
						<a href="<?php echo esc_url( $item['link'] ); ?>" target="<?php echo esc_attr( $target ); ?>">
							<img width="150" height="150" src="<?php echo esc_url( $item['thumbnail']['url'] ); ?>"  alt="<?php echo esc_attr( $item['description'] ); ?>" title="<?php echo esc_attr( $item['description'] ); ?>"/>
						</a>
					</li>
			<?php
				}
			?>
				</ul>
			<?php
			}
		}

		echo $after_widget; // XSS OK
	}

	//Get instagram array
	function blade_grve_get_instagram_array( $username, $limit, $order_by, $order, $cache ) {

		$username = strtolower( $username );

		if ( false === ( $instagram = get_transient('grve-instagram-feed-v1-'.sanitize_title_with_dashes( $username ) ) ) || empty( $cache ) ) {

			$url = 'https://www.instagram.com/' . $username . '/media/';
			$remote = wp_remote_get( $url );

			if ( is_wp_error( $remote ) ) {
				if( current_user_can( 'administrator' ) ) {
					return new WP_Error( 'site_down', esc_html__( 'Unable to communicate with Instagram!', 'blade' ) );
				} else {
					return new WP_Error('site_down', '' );
				}
			}
  			if ( 200 != wp_remote_retrieve_response_code( $remote ) ) {
				if( current_user_can( 'administrator' ) ) {
					return new WP_Error('invalid_response', esc_html__( 'Instagram invalid response!', 'blade' ) );
				} else {
					return new WP_Error('invalid_response', '' );
				}
			}

			$insta_array = json_decode( $remote['body'], TRUE );

			$images = isset( $insta_array['items'] ) ? $insta_array['items'] : array();

			$instagram = array();

			foreach ( $images as $image ) {

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

			//Instagram Order
			if ( 'none' != $order_by ) {
				foreach ($instagram as $key => $row) {
					$time[$key] = $row['time'];
					$comments[$key]  = $row['comments'];
					$likes[$key] = $row['likes'];
				}
				if ( 'ASC' == $order ) {
					$order = SORT_ASC;
				} else {
					$order = SORT_DESC;
				}
				if ( 'datetime' == $order_by ) {
					$order_by = $time;
				} elseif ( 'comments' == $order_by ) {
					$order_by = $comments;
				} elseif ( 'likes' == $order_by ) {
					$order_by = $likes;
				}
				array_multisort( $order_by, $order, $instagram );
			}

			if( !empty( $cache ) ) {
				set_transient('grve-instagram-feed-v1-'.sanitize_title_with_dashes( $username ), $instagram, apply_filters( 'blade_grve_instagram_cache_time', HOUR_IN_SECONDS ) );
			}
		}

		return array_slice( $instagram, 0, $limit );
	}


	//Update the widget

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = strip_tags( $new_instance['username'] );
		$instance['limit'] = strip_tags( $new_instance['limit'] );
		$instance['order_by'] = strip_tags( $new_instance['order_by'] );
		$instance['order'] = strip_tags( $new_instance['order'] );
		$instance['target'] = strip_tags( $new_instance['target'] );
		$instance['cache'] = strip_tags( $new_instance['cache'] );

		return $instance;
	}


	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array(
			'title' => '',
			'username' => '',
			'limit' => '9',
			'order_by' => 'none',
			'order' => 'ASC',
			'target' => '_blank',
			'cache' => '1',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = esc_attr($instance['title']);
		$username = esc_attr($instance['username']);
		$limit = absint($instance['limit']);
		$order_by = esc_attr($instance['order_by']);
		$order = esc_attr($instance['order']);
		$target = esc_attr($instance['target']);
		$cache = esc_attr($instance['cache']);

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>"><?php esc_html_e( 'Username:', 'blade' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'username' ) ); ?>" value="<?php echo esc_attr( $username ); ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'blade' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>"><?php echo esc_html__( 'Number of Images:', 'blade' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'limit' ) ); ?>" value="<?php echo esc_attr( $limit ); ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'order_by' ) ); ?>"><?php echo esc_html__( 'Order By:', 'blade' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id('order_by') ); ?>" name="<?php echo esc_attr( $this->get_field_name('order_by') ); ?>" style="width:100%;">
				<option value="none" <?php selected('none', $order_by) ?>><?php esc_html_e( 'None', 'blade' ); ?></option>
				<option value="datetime" <?php selected('datetime', $order_by) ?>><?php esc_html_e( 'Recent', 'blade' ); ?></option>
				<option value="likes" <?php selected('likes', $order_by) ?>><?php esc_html_e( 'Likes', 'blade' ); ?></option>
				<option value="comments" <?php selected('comments', $order_by) ?>><?php esc_html_e( 'Comments', 'blade' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"><?php echo esc_html__( 'Order:', 'blade' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id('order') ); ?>" name="<?php echo esc_attr( $this->get_field_name('order') ); ?>" style="width:100%;">
				<option value="ASC" <?php selected('ASC', $order) ?>><?php esc_html_e( 'Ascending', 'blade' ); ?></option>
				<option value="DESC" <?php selected('DESC', $order) ?>><?php esc_html_e( 'Descending', 'blade' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>"><?php echo esc_html__( 'Link Target:', 'blade' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id('target') ); ?>" name="<?php echo esc_attr( $this->get_field_name('target') ); ?>" style="width:100%;">
				<option value="_self" <?php selected('_self', $target) ?>><?php esc_html_e( 'Same Page', 'blade' ); ?></option>
				<option value="_blank" <?php selected('_blank', $target) ?>><?php esc_html_e( 'New Page', 'blade' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'cache' ) ); ?>"><?php echo esc_html__( 'Caching:', 'blade' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id('cache') ); ?>" name="<?php echo esc_attr( $this->get_field_name('cache') ); ?>" type="checkbox" value="1" <?php checked( $cache, 1 ); ?> />
		</p>
		<p>
			<em><?php echo esc_html__( 'Note: Uncheck caching if you want to test your configuration. It is recommended to leave caching enabled to increase performance. Caching timeout is 60 minutes.', 'blade' ); ?></em>
		</p>

	<?php
	}
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
