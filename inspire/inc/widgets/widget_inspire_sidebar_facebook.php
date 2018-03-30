<?php

/**************************************
WIDGET: inspire_sidebar_facebook
***************************************/

	add_action('widgets_init', 'register_widget_inspire_sidebar_facebook' );
	function register_widget_inspire_sidebar_facebook () {
		register_widget('inspire_sidebar_facebook');	
	}

	class inspire_sidebar_facebook extends WP_Widget {

		/**************************************
		1. INIT
		***************************************/
		function __construct () {

				$widget_ops = array(
					'classname' => 'inspire_sidebar_facebook', 								
					'description' =>'Facebook like box' 				
				);
				$control_ops = array(
					'id_base' => 'inspire_sidebar_facebook' 														
				);

				parent::__construct('inspire_sidebar_facebook','Inspire: Facebook', $widget_ops, $control_ops );	
		}

		/**************************************
		2. UPDATE
		***************************************/
		function update($new_instance, $old_instance) {
			return $new_instance;	 
		}

		/**************************************
		3. FORM
		***************************************/
		function form($instance) {

			//default for checkboxes
			if (empty($instance)) {
				$defaults_checkboxes = array(
				);	
			}

			//defaults
			$defaults = array( 
				'widget_title' 	=> 'Like us on facebook',
				'fb_page_url' 	=> 'http://www.facebook.com/envato',
			);

			//merge default
			if (!empty($defaults_checkboxes)) $defaults = array_merge($defaults, $defaults_checkboxes);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			?>

				<p>
					<label for="<?php echo $this->get_field_id('widget_title'); ?> ">Title: </label> 
					<input type='text' id='<?php echo $this->get_field_id('widget_title'); ?>' name='<?php echo $this->get_field_name('widget_title'); ?>' value='<?php if(isset($widget_title)) echo $widget_title; ?>'>
				</p>
				<p>
					<label for='<?php echo $this->get_field_id('fb_page_url'); ?>'>Facebook page URL: <i>(full url)</i> </label>
					<input class='widefat' type='text' id='<?php echo $this->get_field_id('fb_page_url'); ?>' name='<?php echo $this->get_field_name('fb_page_url'); ?>' value='<?php if (isset($fb_page_url)) echo esc_attr($fb_page_url); ?>'>
				</p>

				<p>
					<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'fb_faces' ); ?>" name="<?php echo $this->get_field_name( 'fb_faces' ); ?>" value="checked" <?php checked(isset($fb_faces)) ?>/> 
					<label for="<?php echo $this->get_field_id( 'fb_faces' ); ?>">Show faces?</label>
				</p>

				<p>
					<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'fb_wall' ); ?>" name="<?php echo $this->get_field_name( 'fb_wall' ); ?>" value="checked" <?php checked(isset($fb_wall)) ?>/> 
					<label for="<?php echo $this->get_field_id( 'fb_wall' ); ?>">Show wall?</label>
				</p>

				<p>
					<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'fb_header' ); ?>" name="<?php echo $this->get_field_name( 'fb_header' ); ?>" value="checked" <?php checked(isset($fb_header)) ?>/> 
					<label for="<?php echo $this->get_field_id( 'fb_header' ); ?>">Show header?</label>
				</p>

			<?php
		}

		/**************************************
		4. DISPLAY
		***************************************/
		function widget($args, $instance) {
			extract($args);								
			extract($instance);							

			// DEFAULTS
			if (empty($instance)) {
				$widget_title 	= 'Like us on facebook';
				$fb_page_url 	= 'http://www.facebook.com/envato';
			}


			?>

			<?php echo $before_widget; ?>

			<?php echo $before_title . $widget_title . $after_title; ?>

			<div class="fb-like-box" 
				data-href=<?php echo $fb_page_url; ?>
				data-width="300" 
				data-show-faces=<?php if (isset($fb_faces)) {echo "true";} else {echo "false";} ?>
				data-stream=<?php if (isset($fb_wall)) {echo "true";} else {echo "false";} ?> 
				data-header=<?php if (isset($fb_header)) {echo "true";} else {echo "false";} ?>>
			</div>

			<?php echo $after_widget; ?>

			<?php
		}

	} //END CLASS



