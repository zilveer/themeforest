<?php
include_once str_replace("\\","/",get_template_directory()).'/inc/init.php';
class WebnusTestimonialWidget extends WP_Widget{

	function __construct(){

		$params = array(
		'description'=> 'Webnus Testimonial Widget',
		'name'=> 'Webnus-Testimonial'
		);

		parent::__construct('WebnusTestimonialWidget', '', $params);

	}

	public function form($instance){


		extract($instance);
		?>
		<p>
		<label for="<?php echo $this->get_field_id('title') ?>">Title:</label>
		<input
		type="text"
		class="widefat"
		id="<?php echo $this->get_field_id('title') ?>"
		name="<?php echo $this->get_field_name('title') ?>"
		value="<?php if( isset($title) )  echo esc_attr($title); ?>"
		/>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('image') ?>">Image URL:</label>
		<input type="text"		
		class="widefat"
		id="<?php echo $this->get_field_id('image') ?>"
		name="<?php echo $this->get_field_name('image') ?>"
		
		value="<?php if( isset($image) )  echo esc_attr($image); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('name') ?>">Name:</label>
		<input type="text"
		
		class="widefat"
		id="<?php echo $this->get_field_id('name') ?>"
		name="<?php echo $this->get_field_name('name') ?>"
		
		value="<?php if( isset($name) )  echo esc_attr($name); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('subtitle') ?>">Subtitle:</label>
		<input type="text"
		
		class="widefat"
		id="<?php echo $this->get_field_id('subtitle') ?>"
		name="<?php echo $this->get_field_name('subtitle') ?>"
		
		value="<?php if( isset($subtitle) )  echo esc_attr($subtitle); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('text') ?>">Text:</label>
		<textarea
		
		class="widefat"
		id="<?php echo $this->get_field_id('text') ?>"
		name="<?php echo $this->get_field_name('text') ?>"
		
		><?php if( isset($text) )  echo esc_attr($text); ?></textarea>
		</p>
		<?php 
	}
	
	
	public function widget($args, $instance){
		//36587311
		extract($args);
		extract($instance);
		?>
		<?php echo $before_widget; ?>
		<?php if(!empty($title)) echo $before_title.$title.$after_title; ?>
		<?php echo do_shortcode("[testimonial img='$image' name='$name' subtitle='$subtitle'] $text [/testimonial]"); ?>	 
		<?php echo $after_widget; ?><!-- Disclaimer -->
		<?php 
	} 
}

add_action('widgets_init','register_webnus_testimonial_widget'); 
function register_webnus_testimonial_widget(){
	
	register_widget('WebnusTestimonialWidget');
	
}

