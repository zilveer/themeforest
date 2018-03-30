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

if (!class_exists('TDP_Find_Us')) {
    class TDP_Find_Us extends WPH_Widget {
        
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
                'label' => __('[TDP] - Find Us', 'smartfood'),
                'description' => __('Display information related to address and contact details of the restaurant.', 'smartfood')
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
					'std'      => __( 'Where To Find Us', 'smartfood'), 
					'validate' => 'alpha_dash', 
					'filter'   => 'strip_tags|esc_attr'	
				), 
				array( 		
					'name'     => __( 'Address', 'smartfood'), 		
					'desc'     => __( 'Enter your custom google map url here.', 'smartfood'), 
					'id'       => 'map_url', 
					'type'     =>'text', 	
					'class'    => 'widefat', 	
					'std'      => '', 
					'validate' => 'alpha_dash', 
					'filter'   => 'esc_url'	
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
            
			$email     = esc_attr(tdp_option('email'));

            // And here do whatever you want
			$out = $args['before_widget'];
			
			$out .= $args['before_title'];
			if (array_key_exists("title", $instance)) {
				$out .= esc_attr($instance['title']);            
			}
			$out .= $args['after_title'];
			
			$out .='<ul class="footer-contact-details">';
				$out .='<li><span>' . __('Visit us:', 'smartfood') . '</span> '.esc_attr(tdp_option('restaurant_address')).'</li>';
				$out .='<li><span>' . __('Email:', 'smartfood') . '</span> <a href="mailto:'.antispambot($email).'">'.antispambot($email).'</a></li>';
				$out .='<li><span>' . __('Phone:', 'smartfood') . '</span> '.esc_attr(tdp_option('phone')).'</li>';
			$out .='</ul>';

			$out .= '<a href="'.esc_url($instance['map_url']).'" target="_blank" class="widget-a-button">'.__('Get Directions', 'smartfood').'</a>';
			
			$out .= $args['after_widget'];
            
            echo $out;
        }
        
    }
}