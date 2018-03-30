<?php
add_action('widgets_init','jellywp_ads728x90_load_widgets');

function jellywp_ads728x90_load_widgets(){
		register_widget("jellywp_ads728x90_widget");
}

class jellywp_ads728x90_widget extends WP_widget{

/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/

	function jellywp_ads728x90_widget(){
		$widget_ops = array( 'classname' => 'jellywp_ads728x90_widget', 'description' => esc_attr__( 'Ads 728x90' , 'nanomag') );
		parent::__construct('jellywp_ads728x90_widget', esc_attr__('jellywp: Ads 728x90', 'nanomag'), $widget_ops);
	}

/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
	function widget($args,$instance){
		extract($args);		

		$link = $instance['link'];
		$image = $instance['image'];
		?>
		<div class="widget">
			<div class="ads728x90-thumb">
				<a href="<?php if($link != ""){echo esc_attr($link);}else{echo esc_attr("#");} ?>">
					<img src="<?php if($image != ""){echo esc_attr($image);}else{echo get_template_directory_uri()."/img/728x90.jpg";} ?>" alt="" />
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
		
		$instance['link'] = $new_instance['link'];
		$instance['image'] = $new_instance['image'];
		
		return $instance;
	}




	function form($instance){
		?>
		<?php
			$defaults = array( 'title' => __( 'ADS 728', 'nanomag'), 'link' => '' , 'image' => '' );
			$instance = wp_parse_args((array) $instance, $defaults); 
		?>
		
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