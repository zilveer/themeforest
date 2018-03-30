<?php

// Prevent loading this file directly
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'widgets_init', 'gorilla_ads_load_widget' );

function gorilla_ads_load_widget() {
	register_widget( 'gorilla_ads_widget' );
}

class gorilla_ads_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function __construct() {
		parent::__construct(
			'advertisement-widget', // Base ID
			__( 'Alison - Ads Widget', 'alison' ), // Name
			array(
				'description' => __( 'Allows you to add two advertisement images. if you want to use just one img use 350px at least', 'alison' ), 
				'classname' => 'advertisement-widget',
				'width' => 250,
		    	'height' => 250
			) 
		);
	}


	/**
	 * How to display the widget on the screen.
	 */
	public function widget ($args,$instance) {
		extract($args);

		if(empty($instance)){
			$instance = array('title'=>'', 'img_src_1' => '', 'img_src_2' => '','img_link_1' => '','img_link_2' => '');
		}

		$title = $instance['title'];
		$img_src_1 = $instance['img_src_1'];
		$img_src_2 = $instance['img_src_2'];
		$img_link_1 = $instance['img_link_1'];
		$img_link_2 = $instance['img_link_2'];

		if(!empty($img_src_1) && !empty($img_src_2)) {
			$class="double";
		}


		$out = '<ul class="clearfix '. esc_attr($class) .'">';
		if (!empty($img_src_1)) {
			$img_src_1_full = wp_get_attachment_image_src($instance['img_src_1'],'full');
			$out .= '<li><a href="'. esc_url($img_link_1) .'" target="_blank"><img src="'. esc_url($img_src_1_full[0]) .'" alt=""></a></li>';
		}

		if (!empty($img_src_2)) {
			$img_src_2_full = wp_get_attachment_image_src($instance['img_src_2'],'full');
			$out .= '<li><a href="'. esc_url($img_link_2) .'" target="_blank"><img src="'. esc_url($img_src_2_full[0]) .'" alt=""></a></li>';
		}
		$out .= '</ul>';

		//print the widget for the sidebar
		echo wp_kses($before_widget, wp_kses_allowed_html( 'post' ));

		if (!empty($title)) {
		echo wp_kses($before_title, wp_kses_allowed_html( 'post' )).wp_kses($title, wp_kses_allowed_html( 'post' )).wp_kses($after_title, wp_kses_allowed_html( 'post' ));
		}
		
		echo wp_kses($out, wp_kses_allowed_html( 'post' ));
		echo wp_kses($after_widget, wp_kses_allowed_html( 'post' ));
		wp_reset_postdata();
	 }



	/**
	 * Update the widget settings.
	 */
	public function update ($new_instance, $old_instance) {
	  $instance = $old_instance;
	  
	  $instance['title'] = $new_instance['title'];
	  $instance['img_src_1'] = $new_instance['img_src_1'];
	  $instance['img_src_2'] = $new_instance['img_src_2'];
	  $instance['img_link_1'] = $new_instance['img_link_1'];
	  $instance['img_link_2'] = $new_instance['img_link_2'];

	  return $instance;
	}

	/**
	 * form in widget update area
	 */
	public function form ($instance) {
		/* Set up some default widget settings. */
		$defaults = array('title'=>'', 'img_src_1' => '', 'img_src_2' => '','img_link_1' => '','img_link_2' => '');
		$instance = wp_parse_args( (array) $instance, $defaults ); 

		$img_src_1_full = wp_get_attachment_image_src($instance['img_src_1'],'full');
		$img_src_2_full = wp_get_attachment_image_src($instance['img_src_2'],'full');

		?>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Title:</label>
			<input type="text" class="widefat" name="<?php echo esc_attr($this->get_field_name('title')); ?>" id="<?php echo esc_attr($this->get_field_id('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>">
		</p>

		<!-- image url -->
		<p class="upload-item">
	      <label for="<?php echo esc_attr($this->get_field_id('img_src_1')); ?>">Image:</label><br />
	        <img class="custom_media_image" src="<?php echo esc_url($img_src_1_full[0]); ?>" style="display:block;max-width:96%;height:auto;margin-bottom:8px;" />
	        <input type="hidden" class="widefat custom_media_id" name="<?php echo esc_attr($this->get_field_name('img_src_1')); ?>" id="<?php echo esc_attr($this->get_field_id('img_src_1')); ?>" value="<?php echo esc_attr($instance['img_src_1']); ?>">
	        <input type="button" value="<?php _e( 'Upload Image', 'alison' ); ?>" class="button custom_media_upload" id="custom_image_uploader"/>
	        <input type="button" value="<?php _e( 'Remove', 'alison' ); ?>" class="button custom_media_upload_remove"/><br>
	        <small style="display:block;margin-top:5px;">Image width should be 175px min.</small>
	    </p>

	    <!-- link -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('img_link_1')); ?>">Image-1 Link Url:</label>
			<input type="text" class="widefat" name="<?php echo esc_attr($this->get_field_name('img_link_1')); ?>" id="<?php echo esc_attr($this->get_field_id('img_link_1')); ?>" value="<?php if(isset($instance['img_link_1'])) echo esc_attr($instance['img_link_1']); ?>">
		</p>

		<!-- image url -->
		<p class="upload-item">
	      <label for="<?php echo esc_attr($this->get_field_id('img_src_2')); ?>">Image:</label><br />
	        <img class="custom_media_image" src="<?php echo esc_url($img_src_2_full[0]); ?>" style="display:block;max-width:96%;height:auto;margin-bottom:8px;" />
	        <input type="hidden" class="widefat custom_media_id" name="<?php echo esc_attr($this->get_field_name('img_src_2')); ?>" id="<?php echo esc_attr($this->get_field_id('img_src_2')); ?>" value="<?php echo esc_attr($instance['img_src_2']); ?>">
	        <input type="button" value="<?php _e( 'Upload Image', 'alison' ); ?>" class="button custom_media_upload" id="custom_image_uploader"/>
	        <input type="button" value="<?php _e( 'Remove', 'alison' ); ?>" class="button custom_media_upload_remove"/><br>
	        <small style="display:block;margin-top:5px;">Image width should be 175px min.</small>
	    </p>

	    <!-- link -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('img_link_2')); ?>">Image-2 Link Url:</label>
			<input type="text" class="widefat" name="<?php echo esc_attr($this->get_field_name('img_link_2')); ?>" id="<?php echo esc_attr($this->get_field_id('img_link_2')); ?> " value="<?php if(isset($instance['img_link_2'])) echo esc_attr($instance['img_link_2']); ?>">
		</p>

	<?php
	}

}
?>