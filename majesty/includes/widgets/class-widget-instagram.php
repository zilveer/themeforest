<?php
/*
 * Instagram Widget
 * thanks http://webdevstudios.com
 * @author 		SamaThemes
 * @category 	Widgets
 * @extends 	WP_Widget
 * @version 1.2.3
 * @update  1.3.1
 */
 
add_action('widgets_init', 'Sama_Widget_Instagram::register_this_widget');

class Sama_Widget_Instagram extends WP_Widget {
	protected $_transient_key = 'sama-instagram';
	
	function __construct() {	
		$widget_ops = array(
				'classname'   => 'sama_widget_instagram',
				'description' => esc_html__( 'Display your latest Instagrams in a sidebar widget..', 'theme-majesty')
		);
		add_action('wp_enqueue_scripts', array($this, 'load_css'), 101);
		parent::__construct('sama_widget_instagram', 'SAMA :: '. esc_html__('Instagram', 'theme-majesty'), $widget_ops);
		$this->_transient_key = $this->_transient_key . $this->id_base;
	}
	
	static function register_this_widget () {
		register_widget(__class__);
	}
	
	function load_css() {
		if ( is_active_widget( false, false, $this->id_base, true ) ) {
			wp_enqueue_style('prettyphoto');
			wp_enqueue_script('prettyphoto');
		}
	}
	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 * @access public
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */
	function widget ($args, $instance) {
	
		extract($args);
		
		$title     	      = apply_filters( 'widget_title', $instance['title'] );
		$username         = $instance['username'];
		$count			  = absint($instance['count']);
		$cachetime     	  = absint($instance['cachetime']);
		// Get instagrams
		$instagram = $this->get_instagrams( array(
			'username'     => $username,
			'count'       => $count,
			'cachetime' => $cachetime,
		) );
		if ( false !== $instagram ) {
			
			// Allow the image resolution to be filtered to use any available image resolutions from Instagram
			// low_resolution, thumbnail, standard_resolution
			$image_res = apply_filters( 'wds_instagram_widget_image_resolution', 'standard_resolution' );
			echo $before_widget;
			echo $before_title . esc_html( $title ) . $after_title;
			echo '<ul class="instagram-widget flickrbox">';
			$rand = rand(1,9999);
			$displayed = 0;
				foreach( $instagram['items'] as $key => $image ) {
					$displayed++;
					if ( $displayed <= $count ) {
				?>
						<li><a data-rel="prettyPhoto[instagram-feed-<?php echo $rand; ?>]" href="<?php echo esc_url($image['images']['standard_resolution']['url']);?>"><img src="<?php echo esc_url($image['images']['thumbnail']['url']); ?>" alt="<?php echo esc_attr($image['caption']['text']) ?>"></a></li>
			<?php
					}
				}
			echo '</ul>';
			if ( $instance['follow_link_show'] && $instance['follow_link_text'] ) { ?>
				<div class="clearfix text-center dark"><a class="btn btn-block btn-gold white instagram-follow-link" target="_blank" href="https://instagram.com/<?php echo esc_html( $username ); ?>"><?php echo esc_html( $instance['follow_link_text'] ); ?></a></div>
			<?php
			}
			echo $after_widget;
		} elseif( ( defined( 'WP_DEBUG' ) && true === WP_DEBUG ) && ( defined( 'WP_DEBUG_DISPLAY' ) && false !== WP_DEBUG_DISPLAY ) ) { ?>
			<div id="message" class="error"><p><?php esc_html_e( 'Error: We were unable to fetch your instagram feed.', 'theme-majesty' ); ?></p></div>
		<?php }
	}
	
	/**
	 * Get data from Instagram API.
	 *
	 * @param  array  $args  Defaults arguments to pass to Instagram API
	 * @return array  $instagrams  An array of Instagram data
	 */
	public function get_instagrams( $args = array() ) {

		// Get args
		$username   = ( ! empty( $args['username'] ) ) ? $args['username'] : '';
		$count      = ( ! empty( $args['count'] ) ) ? $args['count'] : 9;
		$cachetime  = ( ! empty( $args['cachetime'] ) ) ? $args['cachetime'] : 2;
		
		// If no user id, bail
		if ( empty( $username ) ) {
			return false;
		}
	

		if ( false === ( $instagrams = get_transient( $this->_transient_key ) ) ) {
			// Ping Instagram's API
			$api_url = "https://www.instagram.com/{$username}/media/";
			$response = wp_remote_get( add_query_arg( array(
				'count'    => absint( $count )
			), $api_url ) );
			
			if(is_wp_error($response)){
				echo 'Error Found ( '.$response->get_error_message().' )';
			}
			// Check if the API is up.
			if ( ! 200 == wp_remote_retrieve_response_code( $response ) ) {
				return false;
			}

			// Parse the API data and place into an array
			$instagrams = json_decode( wp_remote_retrieve_body( $response ), true );

			// Are the results in an array?
			if ( ! is_array( $instagrams ) ) {
				return false;
			}

			$instagrams = maybe_unserialize( $instagrams );

			// Store Instagrams in a transient, and expire every hour
			set_transient( $this->_transient_key, $instagrams, $cachetime * HOUR_IN_SECONDS );
		}

		return $instagrams;
	}
	/**
	 * update function.
	 *
	 * @see WP_Widget->update
	 * @access public
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	function update ($new_instance, $old_instance) {
		
		$instance 	= $old_instance;
		
		$instance['title']     			= esc_attr($new_instance['title']);
		$instance['username']  			= esc_attr($new_instance['username']);
		$instance['follow_link_text']   = esc_attr($new_instance['follow_link_text']);
		$instance['follow_link_show']   = esc_attr($new_instance['follow_link_show']);
		$instance['cachetime']     		= absint($new_instance['cachetime']);
		if ( intval($new_instance['count']) != 0 ) {
			$instance['count'] = $new_instance['count'];
		}
		delete_transient( $this->_transient_key );
		return $instance;		
	}
	
	/**
	 * form function.
	 *
	 * @see WP_Widget->form
	 * @access public
	 * @param array $instance
	 * @return void
	 */
	function form ($instance) {
	
		$defaults = array(  
			'title'  			=> '', 
			'username' 	 		=> '',
			'count'				=> 9,
			'cachetime'			=> 2,
			'follow_link_show'	=> '0',
			'follow_link_text'	=> '',
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults);
	?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e( 'Title:', 'theme-majesty'); ?> </label><input class="widefat" type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo esc_attr($instance['title']); ?>" size="20" /></p>
		<p><label for="<?php echo $this->get_field_id('username'); ?>"><?php esc_html_e( 'Username:', 'theme-majesty'); ?> </label><input class="widefat" type="text" name="<?php echo $this->get_field_name('username'); ?>" id="<?php echo $this->get_field_id('username'); ?>" value="<?php echo esc_attr($instance['username']); ?>" size="20" /></p>
		<p><label for="<?php echo $this->get_field_id('count'); ?>"><?php esc_html_e( 'Photo Count:', 'theme-majesty'); ?> </label><input class="widefat" type="text" name="<?php echo $this->get_field_name('count'); ?>" id="<?php echo $this->get_field_id('count'); ?>" value="<?php echo esc_attr($instance['count']); ?>" size="20" /></p>
		<p><label for="<?php echo $this->get_field_id('cachetime'); ?>"><?php esc_html_e( 'Cache time (in hours):', 'theme-majesty'); ?> </label><input class="widefat" type="text" name="<?php echo $this->get_field_name('cachetime'); ?>" id="<?php echo $this->get_field_id('count'); ?>" value="<?php echo esc_attr($instance['cachetime']); ?>" size="20" />
		</p>
		<p><input type="checkbox" name="<?php echo $this->get_field_name('follow_link_show'); ?>" id="<?php echo $this->get_field_id('follow_link_show'); ?>" value="1" <?php checked(1,esc_attr($instance['follow_link_show']));?> size="20" /> <label for="<?php echo $this->get_field_id('follow_link_show'); ?>" /><?php esc_html_e('Include link to Instagram page?', 'theme-majesty'); ?></label></p>
		<p><label for="<?php echo $this->get_field_id('follow_link_text'); ?>"><?php esc_html_e( 'Link Text:', 'theme-majesty'); ?> </label><input class="widefat" type="text" name="<?php echo $this->get_field_name('follow_link_text'); ?>" id="<?php echo $this->get_field_id('follow_link_text'); ?>" value="<?php echo esc_attr($instance['follow_link_text']); ?>" size="20" /></p>
	<?php
	}

} // End of class