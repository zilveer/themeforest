<?php
add_action('widgets_init','jellywp_ads300x250_load_widgets');


function jellywp_ads300x250_load_widgets(){
		register_widget("jellywp_ads300x250_widget");
}

class jellywp_ads300x250_widget extends WP_widget{

/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/

	function jellywp_ads300x250_widget(){
		$widget_ops = array( 'classname' => 'jellywp_ads300x250_widget', 'description' => esc_attr__( 'Ads 300x250' , 'nanomag') );
		parent::__construct('jellywp_ads300x250_widget', esc_attr__('jellywp: Ads 300x250', 'nanomag'), $widget_ops);
	}

/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
	function widget($args,$instance){
	extract($args);		
		
		$title = $instance['title'];
		$link = $instance['link'];
		$image = $instance['image'];
		?>

		<div class="widget">

<?php
		if($title) {
			echo $before_title.$title.$after_title;
		}
			?>				
		
			<div class="ads300x250-thumb">
				<a href="<?php if($link != ""){echo esc_attr($link);}else{echo esc_attr("#");} ?>">
					<img src="<?php if($image != ""){echo esc_attr($image);}else{echo get_template_directory_uri()."/img/300x250.png";} ?>" alt="" />
				</a>
			</div>
		</div>
		<?php
	
	}

/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['link'] = $new_instance['link'];
		$instance['image'] = $new_instance['image'];
		
		return $instance;
	}



	function form($instance){
		?>
		<?php
			$defaults = array( 'title' => __( 'ADS 300x250' , 'nanomag'), 'link' => '' , 'image' => '' );
			$instance = wp_parse_args((array) $instance, $defaults); 
		?>
		
        <p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e( 'Title:', 'nanomag'); ?></label>
			<input class="widefat" width="100%" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>
        
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('link')); ?>"><?php esc_attr_e( 'Link Url:' , 'nanomag' ); ?></label>
			<input class="widefat" width="100%" id="<?php echo esc_attr($this->get_field_id('link')); ?>" name="<?php echo esc_attr($this->get_field_name('link')); ?>" type="text" value="<?php echo esc_attr($instance['link']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('image')); ?>"><?php esc_attr_e( 'Image Url:' , 'nanomag' ); ?></label>
			<input class="widefat" width="100%" id="<?php echo esc_attr($this->get_field_id('image')); ?>" name="<?php echo esc_attr($this->get_field_name('image')); ?>" type="text" value="<?php echo esc_attr($instance['image']); ?>" />
		</p>
		<?php

	}
}
?>