<?php

/**************************************
WIDGET: inspire_sidebar_banner
***************************************/

	add_action('widgets_init', 'register_widget_inspire_sidebar_banner' );
	function register_widget_inspire_sidebar_banner () {
		register_widget('inspire_sidebar_banner');	
	}

	class inspire_sidebar_banner extends WP_Widget {

		/**************************************
		1. INIT
		***************************************/
		function __construct () {

				$widget_ops = array(
					'classname' => 'inspire_sidebar_banner', 								
					'description' =>'Displays sidebar banner' 				
				);
				$control_ops = array(
					'width' => 400, 
					'height' => 350, 
					'id_base' => 'inspire_sidebar_banner' 														
				);

				parent::__construct('inspire_sidebar_banner','Inspire: Sidebar banner', $widget_ops, $control_ops );	
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

			//defaults
			$defaults = array( 
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			?>
				<p>
					<label for='<?php echo $this->get_field_id('content'); ?>'>Banner HTML</label>
					<textarea class='widefat' id='<?php echo $this->get_field_id('content'); ?>' name='<?php echo $this->get_field_name('content'); ?>' rows='15'><?php if (isset($content)) echo esc_attr($content); ?></textarea>
					<p>Sidebar width: 300 px</p>
				</P>
			<?php
		}

		/**************************************
		4. DISPLAY
		***************************************/
		function widget($args, $instance) {
			extract($args);								
			extract($instance);							

			echo $before_widget;

			if (!empty($content)) {
				echo $content;	
			} else {
				echo "<img src='" . get_template_directory_uri() . "/images/default_banner.png' alt='default_banner' />";
			}
					
			echo $after_widget;

		}

	} //END CLASS



