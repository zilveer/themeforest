<?php
/*
Plugin Name: Bangkok Press Video Widget
Plugin URI: http://goodlayers.com/
Description: Bangkokpress title widget
Author: Goodlayers
Version: 1
Author URI: http://goodlayers.com/
*/

add_action( 'widgets_init', 'goodlayers_1_1_video_init' );
function goodlayers_1_1_video_init(){
	register_widget('Goodlayers_1_1_Video_Widget');      
}

class Goodlayers_1_1_Video_Widget extends WP_Widget{ 

	// Initialize the widget
    function Goodlayers_1_1_Video_Widget() {
        parent::__construct('goodlayers-1-1-video-widget', __('1/1 Video Widget (Goodlayers)','gdl_back_office'), 
			array('description' => __('Full size video widget (266 px width)', 'gdl_back_office')));  
    }  
	
	// Output of the widget
	function widget($args, $instance) {  
		global $wpdb;
	
		extract( $args );
		
		$title = apply_filters( 'widget_title', $instance['title'] );
		$source = apply_filters( 'widget_title', $instance['source'] );
		$height = apply_filters( 'widget_title', $instance['height'] );

		echo $before_widget;
		echo '<div class="banner-widget1-1">';
		
		// Widget Title
		if ( $title ){ 
			echo $before_title . $title . $after_title; 
		}else if( strrpos($after_title, 'bkp-frame') > 0 ) {
			echo '<div class="bkp-frame-wrapper"><div class="bkp-frame sidebar-padding gdl-divider">';
		}
		
		get_video($source, 266, $height);
		
		echo '</div>'; // 1-1 Banner Widget
		echo $after_widget;		
	
    }  	
	
	// Widget Form
	function form($instance) {  
		if ( $instance ) {
			$title = esc_attr( $instance[ 'title' ] );
			$source = esc_attr( $instance[ 'source' ] );
			$height = esc_attr( $instance[ 'height' ] );
		} else {
			$title = '';
			$source = '';
			$height = 266;
		}
		?>
		
		<!-- Title --> 
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title :', 'gdl_back_office' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<!-- Source --> 
		<p>
			<label for="<?php echo $this->get_field_id('source'); ?>"><?php _e( 'Video URL( Vimeo/Youtube ) :', 'gdl_back_office' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('source'); ?>" name="<?php echo $this->get_field_name('source'); ?>" type="text" value="<?php echo $source; ?>" />
		</p>				
		
		<!-- Height --> 
		<p>
			<label for="<?php echo $this->get_field_id('height'); ?>"><?php _e( 'Video Height :', 'gdl_back_office' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo $height; ?>" />
		</p>			
		
		<?php
    }  
	
	// Update the widget
	function update($new_instance, $old_instance){  
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['source'] = strip_tags($new_instance['source']);
		$instance['height'] = strip_tags($new_instance['height']);
		return $instance;
    }
	
}  

?>