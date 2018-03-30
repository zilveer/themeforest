<?php
/**
 *
 */
class mysiteWidgets {
	
	/**
	 *
	 */
	function testimonial( $atts = null ) {
		
		if( $atts == 'generator' ) {
			$numbers = range(1,20);
			foreach( $numbers as $val )
				$number[$val] = $val;
				
			$option = array( 
				'name' => __( 'Testimonial', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'testimonial',
				'options' => array(
					array(
						'name' => __( 'Count', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select how many testimonials you want to be displayed.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'number',
						'default' => '',
						'options' => $number,
						'type' => 'select'
					),
					array(
						'name' => __('Testimonials Categories <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'If you want testimonials from specific categories to display then you may choose them here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'cat',
						'default' => array(),
						'target' => 'cat_testimonial',
						'type' => 'multidropdown'
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
		
		$defaults = array(
			'title' 			=> ' ',
			'number'			=> '4',
			'cat'				=> '',
			'testimonial_sc'	=> 'true',
		);
		
		$atts = wp_parse_args( $atts, $defaults );
		
		$instance = http_build_query( $atts );

		$args = array( 'widget_name' => 'MySite_Testimonial_Widget', 'instance' => $instance );
		
		$widget = new mysiteWidgets();
		return $widget->_widget_generator( $args );
	}

	/**
	 *
	 */
	function twitter( $atts = null ) {
		if( $atts == 'generator' ) {
			$numbers = range(1,20);
			foreach( $numbers as $val )
				$number[$val] = $val;

			$option = array( 
				'name' => __( 'Twitter', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'twitter',
				'options' => array(
					array(
						'name' => __( 'Username', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Paste your twitter username here.  You can find your username by going to your settings page within twitter.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'id',
						'default' => '',
						'type' => 'text'
					),
					array(
						'name' => __( 'Count', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select how many tweets you want to be displayed.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'number',
						'default' => '',
						'options' => $number,
						'type' => 'select'
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
		
		$defaults = array(
			'id' 		=> '',
			'number'	=> '1',
			'title' 	=> ' '
		);
		
		if( isset( $atts['count'] ) )
			$atts['number'] = $atts['count'];
		
		if( isset( $atts['username'] ) )
			$atts['id'] = $atts['username'];
			
		if( empty( $atts['id'] ) )
			$atts['id'] = mysite_get_setting( 'twitter_id' );
			
		$atts = wp_parse_args( $atts, $defaults );
		
		$instance = http_build_query( $atts );

		$args = array( 'widget_name' => 'MySite_Twitter_Widget', 'instance' => $instance );
		
		$widget = new mysiteWidgets();
		return $widget->_widget_generator( $args );
	}
	
	/**
	 *
	 */
	function flickr( $atts = null ) {
		if( $atts == 'generator' ) {
			$numbers = range(1,20);
			foreach( $numbers as $val )
				$number[$val] = $val;

			$option = array( 
				'name' => __( 'Flickr', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'flickr',
				'options' => array(
					array(
						'name' => __( 'Flickr id (<a target="_blank" href="http://idgettr.com/">idGettr</a>)', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Set your Flickr ID here.  You can use the idGettr service to easily find your ID.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'id',
						'default' => '',
						'type' => 'text'
					),
					array(
						'name' => __( 'Count', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select how many flickr images you wish to display.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'count',
						'default' => '',
						'options' => $number,
						'type' => 'select'
					),
					array(
						'name' => __( 'Size', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Set the size of your flickr images.<br /><br />Each setting will display differently so try and experiment with them to find which one suits you best.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'size',
						'default' => '',
						'options' => array(
							's' => __('Square', MYSITE_ADMIN_TEXTDOMAIN ),
							't' => __('Thumbnail', MYSITE_ADMIN_TEXTDOMAIN ),
							'm' => __('Medium', MYSITE_ADMIN_TEXTDOMAIN )
						),
						'type' => 'select'
					),
					array(
						'name' => __('Display', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select whether you want your latest images to display or a random selection.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'display',
						'default' => '',
						'options' => array(
							'latest' => __('Latest', MYSITE_ADMIN_TEXTDOMAIN ),
							'random' => __('Random', MYSITE_ADMIN_TEXTDOMAIN )
						),
						'type' => 'select'
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
		
		$defaults = array(
			'id' 		=> '44071822@N08',
			'number'	=> '9',
			'display'	=> 'latest',
			'size'		=> 's',
			'title' 	=> ' '
		);
		
		$atts = wp_parse_args( $atts, $defaults );
		
		$instance = http_build_query( $atts );

		$args = array( 'widget_name' => 'MySite_Flickr_Widget', 'instance' => $instance );
		
		$widget = new mysiteWidgets();
		return $widget->_widget_generator( $args );
	}
	
	/**
	 *
	 */
	function recent_posts( $atts = null ) {
		if( $atts == 'generator' ) {
			$numbers = range(1,20);
			foreach( $numbers as $val )
				$number[$val] = $val;

			$option = array( 
				'name' => __( 'Recent Posts', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'recent_posts',
				'options' => array(
					array(
						'name' => __( 'Number', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the number of posts you wish to display.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'number',
						'default' => '',
						'options' => $number,
						'type' => 'select'
					),
					array(
						'name' => __( 'Thumbnail', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Choose whether you want thumbnails to display alongside your posts.  The thumbnail uses the featured image of your post.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'disable_thumb',
						'default' => '',
						'options' => array(
							'0' => __( 'Yes', MYSITE_ADMIN_TEXTDOMAIN ),
							'1' => __( 'No', MYSITE_ADMIN_TEXTDOMAIN )
						),
						'type' => 'select'
					),
				'shortcode_has_atts' => true,
				)
			);

		return $option;
		
		}
		
		$defaults = array(
			'number'	=> '',
			'disable_thumb'	=> '',
			'title' 	=> ' '
		);
		
		$atts = wp_parse_args( $atts, $defaults );
		
		$instance = http_build_query( $atts );

		$args = array( 'widget_name' => 'MySite_RecentPost_Widget', 'instance' => $instance );
		
		$widget = new mysiteWidgets();
		return $widget->_widget_generator( $args );
	}
	
	/**
	 *
	 */
	function popular_posts( $atts = null ) {
		if( $atts == 'generator' ) {
			$numbers = range(1,20);
			foreach( $numbers as $val )
				$number[$val] = $val;

			$option = array( 
				'name' => __( 'Popular Posts', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'popular_posts',
				'options' => array(
					array(
						'name' => __( 'Number', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the number of posts you wish to display.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'number',
						'default' => '',
						'options' => $number,
						'type' => 'select'
					),
					array(
						'name' => __( 'Thumbnail', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Choose whether you want thumbnails to display alongside your posts.  The thumbnail uses the featured image of your post.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'disable_thumb',
						'default' => '',
						'options' => array(
							'0' => __( 'Yes', MYSITE_ADMIN_TEXTDOMAIN ),
							'1' => __( 'No', MYSITE_ADMIN_TEXTDOMAIN )
						),
						'type' => 'select'
					),
				'shortcode_has_atts' => true,
				)
			);

		return $option;
		
		}
		
		$defaults = array(
			'number'	=> '',
			'disable_thumb'	=> '',
			'title' 	=> ' '
		);
		
		$atts = wp_parse_args( $atts, $defaults );
		
		$instance = http_build_query( $atts );

		$args = array( 'widget_name' => 'MySite_PopularPost_Widget', 'instance' => $instance );
		
		$widget = new mysiteWidgets();
		return $widget->_widget_generator( $args );
	}
	
	/**
	 *
	 */
	function contact_info( $atts = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Contact Info', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'contact_info',
				'options' => array(
					array(
						'name' => __( 'Name', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type in your name.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'name',
						'default' => '',
						'type' => 'text'
					),
					array(
						'name' => __( 'Phone', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type in your phone number.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'phone',
						'default' => '',
						'type' => 'text'
					),
					array(
						'name' => __( 'Email', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type in your email address.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'email',
						'default' => '',
						'type' => 'text'
					),
					array(
						'name' => __( 'Address', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type in your address.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'address',
						'default' => '',
						'type' => 'text'
					),
					array(
						'name' => __( 'City', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type in your city.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'city',
						'default' => '',
						'type' => 'text'
					),
					array(
						'name' => __( 'State', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type in your state.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'state',
						'default' => '',
						'type' => 'text'
					),
					array(
						'name' => __( 'Zip', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type in your zip.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'zip',
						'default' => '',
						'type' => 'text'
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
		
		$defaults = array(
			'name'          => '',
			'address' 	=> '',
			'city'          => '',
			'state'         => '',
			'zip'           => '',
			'phone'         => '',
			'email'         => '',
			'title'         => ' '
		);
		
		$atts = wp_parse_args( $atts, $defaults );
		
		$instance = http_build_query( $atts );

		$args = array( 'widget_name' => 'MySite_Contact_Widget', 'instance' => $instance );
		
		$widget = new mysiteWidgets();
		return $widget->_widget_generator( $args );
	}
	
	/**
	 *
	 */
	function comments( $atts = null ) {
		if( $atts == 'generator' ) {
			$numbers = range(1,20);
			foreach( $numbers as $val )
				$number[$val] = $val;

			$option = array( 
				'name' => __( 'Comments', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'comments',
				'options' => array(
					array(
						'name' => __( 'Number', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the number of comments you wish to display.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'number',
						'default' => '',
						'options' => $number,
						'type' => 'select'
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
			
		$defaults = array(
			'title' => ' ',
			'number' => '5'
		);
		
		$atts = wp_parse_args( $atts, $defaults );
		
		$instance = http_build_query( $atts );

		$args = array( 'widget_name' => 'WP_Widget_Recent_Comments', 'instance' => $instance );
		
		$widget = new mysiteWidgets();
		return $widget->_widget_generator( $args );
	}
	
	/**
	 *
	 */
	function tags( $atts = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Tags', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'tags',
				'options' => array(
					array(
						'name' => __( 'Taxonomy', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select whether you wish to display categories or tags.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'taxonomy',
						'default' => '',
						'options' => array(
							'post_tag' => __( 'Post Tags', MYSITE_ADMIN_TEXTDOMAIN ),
							'category' => __( 'Category', MYSITE_ADMIN_TEXTDOMAIN )
						),
						'type' => 'select'
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
		
		$defaults = array(
			'title' => ' ',
			'taxonomy' => 'post_tag'
		);
			
		$atts = wp_parse_args( $atts, $defaults );
		
		$instance = http_build_query( $atts );

		$args = array( 'widget_name' => 'WP_Widget_Tag_Cloud', 'instance' => $instance );
		
		$widget = new mysiteWidgets();
		return $widget->_widget_generator( $args );
	}

	/**
	 *
	 */
	function rss( $atts = null ) {
		if( $atts == 'generator' ) {
			$numbers = range(1,20);
			foreach( $numbers as $val ) {
				$number[$val] = $val;
			}

			$option = array( 
				'name' => __( 'Rss', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'rss',
				'options' => array(
					array(
						'name' => __( 'RSS feed URL', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Paste the URL to your feed.  For example if you are using feedburner then you would paste something like this,<br /><br />http://feeds.feedburner.com/username', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'url',
						'default' => '',
						'type' => 'text'
					),
					array(
						'name' => __( 'How many items would you like to display?', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the number of RSS items you wish to display.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'items',
						'default' => '',
						'options' => $number,
						'type' => 'select'
					),
					array(
						'name' => __( 'Show Summary', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Check this if you wish to display a summary of the item.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'show_summary',
						'options' => array( '1' => __( 'Show Summary', MYSITE_ADMIN_TEXTDOMAIN )),
						'default' => '',
						'type' => 'checkbox'
					),
					array(
						'name' => __( 'Show Author', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Check if you wish to display the author of the item.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'show_author',
						'options' => array( '1' => __( 'Show Author', MYSITE_ADMIN_TEXTDOMAIN )),
						'default' => '',
						'type' => 'checkbox'
					),
					array(
						'name' => __( 'Show Date', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Check if you wish to display the date of the item.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'show_date',
						'options' => array( '1' => __( 'Show Date', MYSITE_ADMIN_TEXTDOMAIN )),
						'default' => '',
						'type' => 'checkbox'
					),
				'shortcode_has_atts' => true,
				)
			);
			
			return $option;
		}
		
		$defaults = array(
			'title' => ' ',
			'url' => '',
			'items' => 3,
			'error' => false,
			'show_summary' => 0,
			'show_author' => 0,
			'show_date' => 0
		);
		
		$atts = wp_parse_args( $atts, $defaults );
		
		$instance = http_build_query( $atts );

		$args = array( 'widget_name' => 'WP_Widget_RSS', 'instance' => $instance );
		
		$widget = new mysiteWidgets();
		return $widget->_widget_generator( $args );
	}
	
	/**
	 *
	 */
	function search( $atts = null ) {
		
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Search', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'search'
			);

			return $option;
		}
		
		$defaults = array( 'title' => ' ' );
		
		$atts = wp_parse_args( $atts, $defaults );
		
		$instance = http_build_query( $atts );

		$args = array( 'widget_name' => 'WP_Widget_Search', 'instance' => $instance );
		
		$widget = new mysiteWidgets();
		return $widget->_widget_generator( $args );
	}

	/**
	 *
	 */
	function _widget_generator( $args = array() ) {
		global $wp_widget_factory;
		
		$widget_name = esc_html( $args['widget_name'] );

		ob_start();
		the_widget( $widget_name, $args['instance'], array( 'before_title' => '', 'after_title' => '', 'widget_id' => '-1' ) );
		$out = ob_get_contents();
		ob_end_clean();
		return $out;
	}

	/**
	 *
	 */
	function _options( $class ) {
		$shortcode = array();
		
		$class_methods = get_class_methods( $class );
		
		foreach( $class_methods as $method ) {
			if( $method[0] != '_' ) {
				$shortcode[] = call_user_func(array( &$class, $method ), $atts = 'generator' );
			}
		}
		
		$options = array(
			'name' => __( 'Widget', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Select which widget shortcode you would like to use.', MYSITE_ADMIN_TEXTDOMAIN ),
			'value' => 'widget',
			'options' => $shortcode,
			'shortcode_has_types' => true
		);
		
		return $options;
	}
	
}

?>