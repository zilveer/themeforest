<?php

/**************************************
WIDGET: inspire_sidebar_template
***************************************/

	add_action('widgets_init', 'register_widget_inspire_sidebar_template' );
	function register_widget_inspire_sidebar_template () {
		register_widget('inspire_sidebar_template');	
	}

	class inspire_sidebar_template extends WP_Widget {

		/**************************************
		1. INIT
		***************************************/
		function __construct () {

				$widget_ops = array(
					'classname' => 'inspire_sidebar_template', 								//this will be added to the before_widget class
					'description' =>'A widget that displays the authors name' 				//description
				);
				$control_ops = array(
					'width' => 300, 
					'height' => 350, 
					'id_base' => 'inspire_sidebar_template' 														
				);

				//first param this will be added to the before_widget id (an increments auto: inspire_sidebar_template-1 etc)
				//second param is name as it appears in widget menu
				parent::__construct('inspire_sidebar_template','Doodle', $widget_ops, $control_ops );	
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
				'widget_title' => 'DEBUG TITLE',
				'name' => 'Jack Bauer', 
				'show_info' => true 
			);
			$instance = wp_parse_args($instance, $defaults);
			var_dump($instance);
			extract($instance);
			?>

			<?php boost_widget_form_field('text', 'widget_title', $widget_title, 'Title',''); ?>

				<p>
					<label for="<?php echo $this->get_field_id('widget_title'); ?> ">Title: </label> 
					<input type='text' id='<?php echo $this->get_field_id('widget_title'); ?>' name='<?php echo $this->get_field_name('widget_title'); ?>' value='<?php if(isset($widget_title)) echo $widget_title; ?>'>
				</p>

				<p>
					<label for='<?php echo $this->get_field_id('tab_num_comments'); ?>'>Number of comments: </label>
					<input 
						style='width: 40px;'
						type='number' 
						min='1'
						max='20'
						id='<?php echo $this->get_field_id('tab_num_comments'); ?>' 
						name='<?php echo $this->get_field_name('tab_num_comments'); ?>' 
						value='<?php if (isset($tab_num_comments)) echo esc_attr($tab_num_comments); ?>'
					>
				</p>

				<p>
					<label for="<?php echo $this->get_field_id('tags_as'); ?> "></label> 
					<select id="<?php echo $this->get_field_id('tags_as'); ?>" name="<?php echo $this->get_field_name('tags_as'); ?>"> 
	     			<option value="list_alphabetically" <?php if (isset($tags_as)) {if ($tags_as == "list_alphabetically") echo "selected='selected'";} ?>>View tags as list (alphabetically)</option> 
	     			<option value="list_popular" <?php if (isset($tags_as)) {if ($tags_as == "list_popular") echo "selected='selected'";} ?>>View tags as list (most popular)</option> 
	     			<option value="cloud" <?php if (isset($tags_as)) {if ($tags_as == "cloud") echo "selected='selected'";} ?>>View tags as cloud</option> 
					</select> 
				</p>

			<?php
		}

		/**************************************
		4. DISPLAY
		***************************************/
		function widget($args, $instance) {
			extract($args);								//widget setup args like $args[before_widget] etc.
			extract($instance);							//the variables passed from our form
			?>

			<?php echo $before_widget; ?>

			<?php echo $before_title . $widget_title . $after_title; ?>

			<?php var_dump($instance); ?>

			<?php echo $after_widget; ?>


			<?php
		}

	} //END CLASS



