<?php
/*
Plugin Name: Bangkok Press 1/2 Banner Widget
Plugin URI: http://goodlayers.com/
Description: Bangkokpress title widget
Author: Goodlayers
Version: 1
Author URI: http://goodlayers.com/
*/

add_action( 'widgets_init', 'goodlayers_1_2_banner_init' );

function goodlayers_1_2_banner_init(){
	register_widget('Goodlayers_1_2_Banner_widget');      
}

class Goodlayers_1_2_Banner_widget extends WP_Widget{ 

	// Initialize the widget
    function Goodlayers_1_2_Banner_widget() {
        parent::__construct('goodlayers-1-2-banner-widget', __('1/2 Banner Widget (Goodlayers)','gdl_back_office'), 
			array('description' => __('Half size banner widget (116 px)', 'gdl_back_office')));  
    }  
	
	// Output of the widget
	function widget($args, $instance) {  
		global $wpdb;
	
		extract( $args );
		
		$title = apply_filters( 'widget_title', $instance['title'] );
		$image = apply_filters( 'widget_title', $instance['image'] );
		$link = apply_filters( 'widget_title', $instance['link'] );
		$image2 = apply_filters( 'widget_title', $instance['image2'] );
		$link2 = apply_filters( 'widget_title', $instance['link2'] );

		echo $before_widget;
		echo '<div class="banner-widget1-2">';
		
		// Widget Title
		if( !empty($title) ){
			echo '<div class="sidebar-header-wrapper">';
			echo '<h3 class="sidebar-header-title title-color gdl-title">' . $title . '</h3>';
			echo '<div class="sidebar-header-gimmick mr0"></div>';
			echo '<div class="clear"></div>';
			echo '</div>';
		}
		
		echo '<div class="percent-column1-2" >';
		echo '<div class="bkp-frame-wrapper mr10">';
		echo '<a href="' . $link . '">';
		echo '<img src="' . $image . '" alt="banner" />';
		echo '</a>';
		echo '</div>';
		echo '</div>'; // percent-column
		
		echo '<div class="percent-column1-2" >';
		echo '<div class="bkp-frame-wrapper ml10">';
		echo '<a href="' . $link2 . '">';
		echo '<img src="' . $image2 . '" alt="banner"/>';
		echo '</a>';	
		echo '</div>';
		echo '</div>'; // percent-column
		
		echo '<div class="clear"></div>';
		echo '</div>'; // 1-2 Banner Widget
		
		echo '</div>';
		//echo $after_widget;		
	
    }  	
	
	// Widget Form
	function form($instance) {  
		if ( $instance ) {
			$title = esc_attr( $instance[ 'title' ] );
			$image = esc_attr( $instance[ 'image' ] );
			$link = esc_attr( $instance[ 'link' ] );
			$image2 = esc_attr( $instance[ 'image2' ] );
			$link2 = esc_attr( $instance[ 'link2' ] );
			
		} else {
			$title = '';
			$image = '';
			$link = '';
			$image2 = '';
			$link2 = '';
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
		
		<!-- Image2 --> 
		<p>
			<label for="<?php echo $this->get_field_id('image2'); ?>"><?php _e( 'Banner Image Src 2 :', 'gdl_back_office' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('image2'); ?>" name="<?php echo $this->get_field_name('image2'); ?>" type="text" value="<?php echo $image2; ?>" />
		</p>		
		
		<!-- Link2 --> 
		<p>
			<label for="<?php echo $this->get_field_id('link2'); ?>"><?php _e( 'Banner Image URL 2 :', 'gdl_back_office' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('link2'); ?>" name="<?php echo $this->get_field_name('link2'); ?>" type="text" value="<?php echo $link2; ?>" />
		</p>		
		
		<?php
    }  
	
	// Update the widget
	function update($new_instance, $old_instance){  
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['image'] = strip_tags($new_instance['image']);
		$instance['link'] = strip_tags($new_instance['link']);
		$instance['image2'] = strip_tags($new_instance['image2']);
		$instance['link2'] = strip_tags($new_instance['link2']);
		return $instance;
    }
	
}  

?>