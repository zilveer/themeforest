<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class WP_Widget_Social extends WP_Widget {
	
	protected $slug  = 'ut_social';
    
    public $profiles = array(
        
      array(
        'value'       => 'fa-adn',
        'label'       => 'Alpha'                    
      ),
      array(
        'value'       => 'fa-behance',
        'label'       => 'Behance'                    
      ),
      array(
        'value'       => 'fa-bitbucket',
        'label'       => 'Bitbucket'                    
      ),
      array(
        'value'       => 'fa-codepen',
        'label'       => 'Codepen'                    
      ),
      array(
        'value'       => 'fa-delicious',
        'label'       => 'Delicious'                    
      ),
      array(
        'value'       => 'fa-deviantart',
        'label'       => 'Deviantart'                    
      ),
      array(
        'value'       => 'fa-digg',
        'label'       => 'Digg'                    
      ),
      array(
        'value'       => 'fa-dribbble',
        'label'       => 'Dribbble'
      ),
      array(
        'value'       => 'fa-dropbox',
        'label'       => 'Dropbox'
      ),
      array(
        'value'       => 'fa-facebook',
        'label'       => 'Facebook'
      ),
      array(
        'value'       => 'fa-flickr',
        'label'       => 'Flickr'
      ),
      array(
        'value'       => 'fa-foursquare',
        'label'       => 'Foursquare'
      ),                  
      array(
        'value'       => 'fa-github',
        'label'       => 'Github'
      ),
      array(
        'value'       => 'fa-gittip',
        'label'       => 'Gittip'
      ),
      array(
        'value'       => 'fa-google-plus',
        'label'       => 'Google Plus'
      ),
      array(
        'value'       => 'fa-instagram',
        'label'       => 'Instagram'
      ),
      array(
        'value'       => 'fa-jsfiddle',
        'label'       => 'JSFiddle'
      ),
      array(
        'value'       => 'fa-linkedin',
        'label'       => 'LinkedIn'
      ),
      array(
        'value'       => 'fa-reddit',
        'label'       => 'Reddit'
      ),
      array(
        'value'       => 'fa-pinterest',
        'label'       => 'Pinterest'
      ),
      array(
        'value'       => 'fa-skype',
        'label'       => 'Skype'
      ),
      array(
        'value'       => 'fa-soundcloud',
        'label'       => 'Soundcloud'
      ),
      array(
        'value'       => 'fa-tumblr',
        'label'       => 'Tumblr'
      ),
      array(
        'value'       => 'fa-twitter',
        'label'       => 'Twitter'
      ),
      array(
        'value'       => 'fa-vimeo-square',
        'label'       => 'Vimeo'
      ),
      array(
        'value'       => 'fa-vk',
        'label'       => 'VK'
      ),
      array(
        'value'       => 'fa-xing',
        'label'       => 'Xing'
      ),
      array(
        'value'       => 'fa-youtube',
        'label'       => 'Youtube'
      ),
      array(
        'value'       => 'fa-spotify',
        'label'       => 'Spotify'
      )
    
    );
    	
    function __construct() {
        
        $widget_ops = array('classname' => 'ut_widget_social clearfix', 'description' => __( 'Displays Social Icons!', 'unitedthemes') );
        parent::__construct('ut_social', __('United Themes - Social Media Widget', 'unitedthemes'), $widget_ops);
        $this->alt_option_name = 'ut_widget_social';

    }


	function widget( $args, $instance ) {  
				
		extract( $args );
				
		$title = ( isset($instance['title']) && !empty($instance['title']) ) ? $instance['title'] : '' ; ?>
		
        
		<?php echo $before_widget; ?>
        		
		<?php if( !empty( $title ) ) echo '<h3 class="widget-title"><span>' . $title . '</span></h3>'; ?>
		                
            <?php 
                        
            echo '<ul class="ut-sociallinks">';    
                
                foreach( $this->profiles as $profile ) {
                    
                    $link  = !empty( $instance[str_replace( '-', '_', $profile['value'] )] )  ? esc_url( $instance[str_replace( '-', '_', $profile['value'] )] ) : '' ;
                    
                    if( !empty( $link ) ) {
                    
                        echo '<li>';
                            echo '<a href="'. esc_url( $link ) . '" target="_blank"><i class="fa ' . esc_attr( $profile['value'] ) . '"></i></a>';
                        echo '</li>';
                    
                    }
                    
                }
            
            echo '</ul>';    
            
	   
	   echo $after_widget;
	   
   }

   function update($new_instance, $old_instance) {                
       return $new_instance;
   }

   function form($instance) { 
		
		$title = isset($instance['title']) ? esc_attr($instance['title']) : ''; ?>
		 
		<p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'unitedthemes'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
        </p>
        
        <?php foreach( $this->profiles as $profile ) : ?>
            
            <?php $value = ( !empty($instance[str_replace( '-', '_', $profile['value'] )]) ) ? $instance[str_replace( '-', '_', $profile['value'] )] : '' ; ?>
            
            <p>
                <label for="<?php echo $this->get_field_id( str_replace( '-', '_', $profile['value'] ) ); ?>"><?php echo $profile['label']; ?></label>
                <input type="text" name="<?php echo $this->get_field_name( str_replace( '-', '_', $profile['value'] ) ); ?>" value="<?php echo esc_attr( $value ); ?>" class="widefat" id="<?php echo $this->get_field_id( str_replace( '-', '_', $profile['value'] ) ); ?>" />    
            </p>
        
        <?php endforeach; ?>
        
       
  <?php	}

}

add_action( 'widgets_init', create_function( '', 'return register_widget("WP_Widget_Social");' ) );
?>