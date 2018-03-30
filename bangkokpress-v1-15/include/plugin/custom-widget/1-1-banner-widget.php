<?php
/*
Plugin Name: Bangkok Press 1/1 Banner Widget
Plugin URI: http://goodlayers.com/
Description: Bangkokpress title widget
Author: Goodlayers
Version: 1
Author URI: http://goodlayers.com/
*/

add_action( 'widgets_init', 'goodlayers_1_1_banner_init' );

function goodlayers_1_1_banner_init(){
	register_widget('Goodlayers_1_1_Banner_widget');      
}

class Goodlayers_1_1_Banner_widget extends WP_Widget{ 

	// Initialize the widget
    function Goodlayers_1_1_Banner_widget() {
       parent::__construct('goodlayers-1-1-banner-widget', __('1/1 Banner Widget (Goodlayers)','gdl_back_office'), 
			array('description' => __('Full size banner widget (266 px)', 'gdl_back_office')));  
    }  
	
	// Output of the widget
	function widget($args, $instance) {  
		global $wpdb;
	
		extract( $args );
		
		$title = apply_filters( 'widget_title', $instance['title'] );
		$image = apply_filters( 'widget_title', $instance['image'] );
		$link = apply_filters( 'widget_title', $instance['link'] );

		echo $before_widget;
		echo '<div class="banner-widget1-1">';
		
		// Widget Title
		if ( $title ){ 
			echo $before_title . $title . $after_title; 
		}else if( strrpos($after_title, 'bkp-frame') > 0 ) {
			echo '<div class="bkp-frame-wrapper"><div class="bkp-frame sidebar-padding gdl-divider">';
		}
		
		echo '<a href="' . $link . '">';
		echo '<img src="' . $image . '" alt="banner" />';
		echo '</a>';
		
		echo '</div>'; // 1-1 Banner Widget
		echo $after_widget;		
	
    }  	
	
	// Widget Form
	function form($instance) {  
		if ( $instance ) {
			$title = esc_attr( $instance[ 'title' ] );
			$image = esc_attr( $instance[ 'image' ] );
			$link = esc_attr( $instance[ 'link' ] );
		} else {
			$title = '';
			$image = '';
			$link = '';
		}
		?>
		
		<!-- Title --> 
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title :', 'gdl_back_office' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<!-- Image --> 
		<p>
			<label for="<?php echo $this->get_field_id('image'); ?>"><?php _e( 'Banner Image Src :', 'gdl_back_office' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>" type="text" value="<?php echo $image; ?>" />
		</p>		
		
		<!-- Link --> 
		<p>
			<label for="<?php echo $this->get_field_id('link'); ?>"><?php _e( 'Banner Image URL :', 'gdl_back_office' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo $link; ?>" />
		</p>		
		
		<?php
    }  
	
	// Update the widget
	function update($new_instance, $old_instance){  
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['image'] = strip_tags($new_instance['image']);
		$instance['link'] = strip_tags($new_instance['link']);
		return $instance;
    }
	
}  

?>