<?php

// Prevent loading this file directly
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'widgets_init', 'gorilla_about_load_widget' );

function gorilla_about_load_widget() {
	register_widget( 'gorilla_about_widget' );
}

class gorilla_about_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function __construct() {
		parent::__construct(
			'gorilla_about_widget', // Base ID
			__( 'Alison - About Me/Us', 'alison' ), // Name
			array(
				'description' => __( 'A widget that displays an about us/me content', 'alison' ), 
				'classname' => 'gorilla_about_widget',
				'width' => 250,
		    	'height' => 350
			) 
		);
	}

	/**
	 * How to display the widget on the screen.
	 */
	public function widget( $args, $instance ) {
		extract( $args );

		if(empty($instance)){
			$instance = array( 'title' => 'About Me', 'image' => '', 'description' => '','more_text' => '','more_link' => '', 'use_border' => '');
		}

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$image = $instance['image'];
		$description = $instance['description'];
		$more_text = $instance['more_text'];
		$more_link = $instance['more_link'];
		$use_border = $instance['use_border'];
		
		/* Before widget (defined by themes). */
		echo wp_kses($before_widget, wp_kses_allowed_html( 'post' ));

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo wp_kses($before_title, wp_kses_allowed_html( 'post' )) . wp_kses($title, wp_kses_allowed_html( 'post' )) . wp_kses($after_title, wp_kses_allowed_html( 'post' ));

		?>
			
			<div class="about-widget">
				<div class="widget-content clearfix">
					<?php if($image) : 

						$image_full = wp_get_attachment_image_src($instance['image'],'full');

						if ($use_border) { ?>
							<div class="img radius">
								<img src="<?php echo esc_url($image_full[0]); ?>" alt="<?php echo esc_attr($title); ?>" />
							</div>
						<?php } else { ?>
							<div class="img">
								<img src="<?php echo esc_url($image_full[0]); ?>" alt="<?php echo esc_attr($title); ?>" />
							</div>
					
					<?php }
					endif; ?>
					<?php if($description) : ?>
					<div class="widget-content-desription">
						<p><?php echo wp_kses($description, wp_kses_allowed_html( 'post' )); ?></p>
					</div>
					<?php endif; ?>
				</div>

				<?php if($more_link) : ?>
				<a class="widget-link animative-btn" href="<?php echo esc_url($more_link); ?>"><?php echo esc_html($more_text); ?></a>
				<?php endif; ?>	
			</div>
			
		<?php

		/* After widget (defined by themes). */
		echo wp_kses($after_widget, wp_kses_allowed_html( 'post' ));
	}

	/**
	 * Update the widget settings.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['image'] = strip_tags( $new_instance['image'] );
		$instance['description'] = $new_instance['description'];
		$instance['more_text'] = strip_tags( $new_instance['more_text'] );
		$instance['more_link'] = strip_tags( $new_instance['more_link'] );
		$instance['use_border'] = strip_tags( $new_instance['use_border'] );

		return $instance;
	}
	
	/**
	 * form in widget update area
	 */
	public function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'About Me', 'image' => '', 'description' => '','more_text' => '','more_link' => '', 'use_border' => '');
		$instance = wp_parse_args( (array) $instance, $defaults ); 

		$image_full = wp_get_attachment_image_src($instance['image'],'full');

		?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>">Title:</label>
			<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" style="width:96%;" />
		</p>

		<!-- image url -->
		<p class="upload-item">
	      <label for="<?php echo esc_attr($this->get_field_id('image')); ?>">Image:</label><br />
	        <img class="custom_media_image" src="<?php echo esc_url($image_full[0]); ?>" style="display:block;max-width:96%;height:auto;margin-bottom:8px;" />
	        <input type="hidden" class="widefat custom_media_id" name="<?php echo esc_attr($this->get_field_name('image')); ?>" id="<?php echo esc_attr($this->get_field_id('image')); ?>" value="<?php echo esc_attr($instance['image']); ?>">
	        <input type="button" value="<?php _e( 'Upload Image', 'alison' ); ?>" class="button custom_media_upload" id="custom_image_uploader"/>
	        <input type="button" value="<?php _e( 'Remove', 'alison' ); ?>" class="button custom_media_upload_remove"/><br>
	        <small style="display:block;margin-top:5px;">Insert your image URL (min 260px width)</small>
	    </p>

	    <!-- image radius -->
		<p>
			<input type="checkbox" id="<?php echo esc_attr($this->get_field_id( 'use_border' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'use_border' )); ?>" <?php checked( (bool) $instance['use_border'], true ); ?> />
			<label for="<?php echo esc_attr($this->get_field_id( 'use_border' )); ?>">Use Border Radius:</label>
		</p>

		<!-- description -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'description' )); ?>">About Me/Us Text:</label>
			<textarea id="<?php echo esc_attr($this->get_field_id( 'description' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'description' )); ?>" style="width:95%;" rows="6"><?php echo wp_kses($instance['description'], wp_kses_allowed_html( 'post' )); ?></textarea>
		</p>

		<!-- more text -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'more_text' )); ?>">More Text:</label>
			<input id="<?php echo esc_attr($this->get_field_id( 'more_text' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'more_text' )); ?>" value="<?php echo esc_attr($instance['more_text']); ?>" style="width:96%;" /><br />
		</p>

		<!-- more link -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'more_link' )); ?>">More Link URL:</label>
			<input id="<?php echo esc_attr($this->get_field_id( 'more_link' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'more_link' )); ?>" value="<?php echo esc_url($instance['more_link']); ?>" style="width:96%;" /><br />
			<small>Insert your about me/us detail page Url </small>
		</p>


	<?php
	}
}

?>