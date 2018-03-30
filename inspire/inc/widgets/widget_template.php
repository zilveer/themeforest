<?php

/**************************************
WIDGET: INSPIRE_SIDEBAR_TEMPLATE
***************************************/

	add_action('widgets_init', 'register_widget_INSPIRE_SIDEBAR_TEMPLATE' );
	function register_widget_INSPIRE_SIDEBAR_TEMPLATE () {
		register_widget('INSPIRE_SIDEBAR_TEMPLATE');	
	}

	class INSPIRE_SIDEBAR_TEMPLATE extends WP_Widget {

		/**************************************
		1. INIT
		***************************************/
		function __construct () {

				$widget_ops = array(
					'classname' => 'INSPIRE_SIDEBAR_TEMPLATE', 								
					'description' =>'YOUR STANDARD TEMPLATE BANNER' 				
				);
				$control_ops = array(
					'width' => 300, 
					'height' => 350, 
					'id_base' => 'INSPIRE_SIDEBAR_TEMPLATE' 														
				);

				parent::__construct('INSPIRE_SIDEBAR_TEMPLATE','TEMPLATE', $widget_ops, $control_ops );	
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
					'fb_faces' => 'checked'
				);	
			}

			//defaults
			$defaults = array( 
				'widget_title' 	=> 'Like us on facebook',
				'fb_like_page' 	=> 'http://www.facebook.com/envato',
			);

			//merge default
			if (!empty($defaults_checkboxes)) $defaults = array_merge($defaults, $defaults_checkboxes);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			?>

				<p>
					<label for="<?php echo $this->get_field_id('widget_title'); ?> ">Title: </label><br>
					<input type='text' id='<?php echo $this->get_field_id('widget_title'); ?>' name='<?php echo $this->get_field_name('widget_title'); ?>' value='<?php if(isset($widget_title)) echo $widget_title; ?>'>
				</p>

			<?php
		}

		/**************************************
		4. DISPLAY
		***************************************/
		function widget($args, $instance) {
			extract($args);								
			extract($instance);							
			?>

			<?php echo $before_widget; ?>

			<?php echo $before_title . $widget_title . $after_title; ?>

			<?php var_dump($instance); ?>

			<?php echo $after_widget; ?>


			<?php
		}

	} //END CLASS



