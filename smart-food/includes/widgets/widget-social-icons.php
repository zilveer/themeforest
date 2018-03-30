<?php
/**
 *
 * This is the class that handles the widget creation. Duplicate this class as many times as you want,
 * and modify the class and values for each of your widgets.
 *
 * 
 * Set the field validation type/s
 * ///////////////////////////////
 * 
 * 'alpha_dash'			
 * Returns FALSE if the value contains anything other than alpha-numeric characters, underscores or dashes.
 * 
 * 'alpha'				
 * Returns FALSE if the value contains anything other than alphabetical characters.
 * 
 * 'alpha_numeric'		
 * Returns FALSE if the value contains anything other than alpha-numeric characters.
 * 
 * 'numeric'				
 * Returns FALSE if the value contains anything other than numeric characters.
 * 
 * 'boolean'				
 * Returns FALSE if the value contains anything other than a boolean value ( true or false ).
 * 
 * ----------
 * 
 * You can define custom validation methods. Make sure to return a boolean ( TRUE/FALSE ).
 * Example:
 * 
 * 'validate' => 'my_custom_validation', 
 * 
 * Will call for: $this->my_custom_validation( $value_to_validate );
 * Filter data before entering the DB
 *                    
 * strip_tags ( default )
 * wp_strip_all_tags
 * esc_attr
 * esc_url
 * esc_textarea *
 * 
 * @author Alessandro Tesoro
 * @version  1.0.0
 * @since  1.0.0
 *
 */

if (!class_exists('TDP_Social_Icons')) {
    class TDP_Social_Icons extends WPH_Widget {
        
        /**
		 * __construct function.
		 *
		 * @access public
		 * @return void
		 */
        public function __construct() {
            
           	/**
			 * Widget settings
			 *
			 * Simply use the following field examples to create the WordPress Widget options that
			 * will display to administrators. These options can then be found in the $args
			 * variable within the widget method.
			 *
			 */
            $args = array(
                'label' => __('[TDP] - Social Icons', 'smartfood'),
                'description' => __('Display social icons through a widget. Manage your profiles through the theme options panel.', 'smartfood')
            );
            
            /* 
             * Field Settings
             * 
             * The field options that you have available to you. Please
			 * contribute additional field options if you create any.
			 *
			 */
            $args['fields'] = array(
                
				array( 		
					'name'     => __( 'Title', 'smartfood'), 		
					'desc'     => __( 'Enter the widget title.', 'smartfood'), 
					'id'       => 'title', 
					'type'     =>'text', 	
					'class'    => 'widefat', 	
					'std'      => __( 'Connect with us', 'smartfood'), 
					'validate' => 'alpha_dash', 
					'filter'   => 'strip_tags|esc_attr'	
				), 
				array( 		
					'name'     => __( 'Description', 'smartfood'), 		
					'desc'     => __( 'Enter a description that will appear above the social icons list.', 'smartfood'), 
					'id'       => 'description', 
					'type'     =>'textarea', 	
					'class'    => 'widefat', 	
					'std'      => '', 
					'validate' => 'alpha_dash', 
					'filter'   => 'esc_textarea'	
				), 
                
            ); // fields array
            
            // create widget
            $this->create_widget($args);
        }
        
        /**
		 * Widget function.
		 * Outputs the content of the widget.
		 *
		 * @access public
		 * @return string $out
		 */
        public function widget($args, $instance) {
            
			$facebook  = esc_url(tdp_option('facebook'));
			$twitter   = esc_url(tdp_option('twitter'));
			$google    = esc_url(tdp_option('google'));
			$youtube   = esc_url(tdp_option('youtube'));
			$vimeo     = esc_url(tdp_option('vimeo'));
			$pinterest = esc_url(tdp_option('pinterest'));
			$linkedin  = esc_url(tdp_option('linkedin'));
			$instagram  = esc_url(tdp_option('instagram'));
			$email     = esc_attr(tdp_option('email'));

            // And here do whatever you want
			$out = $args['before_widget'];
			
			$out .= $args['before_title'];
			if (array_key_exists("title", $instance)) {
				$out .= esc_attr($instance['title']);            
			}
			$out .= $args['after_title'];
			
			if (array_key_exists("description", $instance)) {
				$out .= '<p>'.esc_attr($instance['description']).'</p>';
			}
			$out .= '<ul>';
				
				if($facebook) {
					$out .= '<li>';
						$out .= '<a href="'.$facebook.'" title="'.__('Follow us on Facebook', 'smartfood').'" rel="nofollow" target="_blank">';
							$out .= '<i class="fa fa-facebook-square"></i>';
						$out .= '</a>';
					$out .= '</li>';	
				}
				if($twitter) {
					$out .= '<li>';
						$out .= '<a href="'.$twitter.'" title="'.__('Follow us on Twitter', 'smartfood').'" rel="nofollow" target="_blank">';
							$out .= '<i class="fa fa-twitter"></i>';
						$out .= '</a>';
					$out .= '</li>';	
				}
				if($google) {
					$out .= '<li>';
						$out .= '<a href="'.$google.'" title="'.__('Follow us on Google+', 'smartfood').'" rel="nofollow" target="_blank">';
							$out .= '<i class="fa fa-google"></i>';
						$out .= '</a>';
					$out .= '</li>';	
				}
				if($youtube) {
					$out .= '<li>';
						$out .= '<a href="'.$youtube.'" title="'.__('Follow us on YouTube', 'smartfood').'" rel="nofollow" target="_blank">';
							$out .= '<i class="fa fa-youtube"></i>';
						$out .= '</a>';
					$out .= '</li>';	
				}
				if($vimeo) {
					$out .= '<li>';
						$out .= '<a href="'.$vimeo.'" title="'.__('Follow us on Vimeo', 'smartfood').'" rel="nofollow" target="_blank">';
							$out .= '<i class="fa fa-vimeo-square"></i>';
						$out .= '</a>';
					$out .= '</li>';	
				}
				if($pinterest) {
					$out .= '<li>';
						$out .= '<a href="'.$pinterest.'" title="'.__('Follow us on Pinterest', 'smartfood').'" rel="nofollow" target="_blank">';
							$out .= '<i class="fa fa-pinterest"></i>';
						$out .= '</a>';
					$out .= '</li>';	
				}
				if($linkedin) {
					$out .= '<li>';
						$out .= '<a href="'.$linkedin.'" title="'.__('Follow us on LinkedIn', 'smartfood').'" rel="nofollow" target="_blank">';
							$out .= '<i class="fa fa-linkedin"></i>';
						$out .= '</a>';
					$out .= '</li>';	
				}
				if($instagram) {
					$out .= '<li>';
						$out .= '<a href="'.$instagram.'" title="'.__('Follow us on Instagram', 'smartfood').'" rel="nofollow" target="_blank">';
							$out .= '<i class="fa fa-instagram"></i>';
						$out .= '</a>';
					$out .= '</li>';	
				}

			$out .= '</ul>';
			
			$out .= $args['after_widget'];
            
            echo $out;
        }
        
    }
}