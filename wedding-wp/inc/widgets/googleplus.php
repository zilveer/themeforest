<?php
include_once str_replace("\\","/",get_template_directory()).'/inc/init.php';
class webnus_googleplus_widget extends WP_Widget{

	function __construct(){

		$params = array(
		'description'=> 'Google+ Box',
		'name'=> 'Webnus - Google+'
		);

		parent::__construct('webnus_googleplus_widget', '', $params);

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
		<label for="<?php echo $this->get_field_id('url') ?>">Page Address:</label>
		<input
		type="text"
		class="widefat"
		id="<?php echo $this->get_field_id('url') ?>"
		name="<?php echo $this->get_field_name('url') ?>"
		value="<?php if( isset($url) )  echo esc_attr($url); ?>"
		/>
		</p>			

		<?php 
	}
	
	
	public function widget($args, $instance){
		
		extract($args);
		extract($instance);
		?>
	
			<?php echo $before_widget; ?>
			<?php if(!empty($title)) echo $before_title.$title.$after_title; ?>

			<script src="https://apis.google.com/js/platform.js" async defer></script>
			<div class="g-page" data-width="302" data-href="<?php echo $url ?>" data-layout="landscape" data-rel="publisher"></div>

			<?php 
				$o = new webnus_options();
			?>
				
			<?php echo $after_widget; ?>

		<?php 
	} 
}

add_action('widgets_init', 'register_webnus_googleplus'); 
function register_webnus_googleplus(){
	
	register_widget('webnus_googleplus_widget');
	
}