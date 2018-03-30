<?php
/*
Plugin Name: BKP TITLE
Plugin URI: http://goodlayers.com/
Description: Bangkokpress title widget
Author: Goodlayers
Version: 1
Author URI: http://goodlayers.com/
*/

register_widget('Goodlayers_title_widget');

class Goodlayers_title_widget extends WP_Widget {  

	// Initialize the widget
    function Goodlayers_title_widget() {
        parent::__construct('goodlayers-title-widget', __('Title Widget (Goodlayers)','gdl_back_office'), 
			array('description' => __('A sidebar widget that show the header title( out side the frame )', 'gdl_back_office')));  
    }  
	
	// Output of the widget
	function widget($args, $instance) {  
		global $wpdb;
	
		extract( $args );
		
		$title = apply_filters( 'widget_title', $instance['title'] );

		//Widget Title
		if ( !empty( $title ) ) { 
			
			echo '<div class="sidebar-header-wrapper">';
			echo '<h3 class="sidebar-header-title title-color gdl-title">' . $title . '</h3>';
			echo '<div class="sidebar-header-gimmick mr0"></div>';
			echo '<div class="clear"></div>';
			echo '</div>';				
		}
		
		//echo $before_widget;
		//echo $after_widget;		
	
    }  	
	
	// Widget Form
	function form($instance) {  
		if ( $instance ) {
			$title = esc_attr( $instance[ 'title' ] );
		} else {
			$title = '';
		}
		
		?>
		
		<!-- Title --> 
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title :', 'gdl_back_office' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		
		<?php
    }  
	
	// Update the widget
	function update($new_instance, $old_instance) {  
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
    }  
	
}  

?>