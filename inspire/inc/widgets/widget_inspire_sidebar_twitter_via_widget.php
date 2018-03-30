<?php

/**************************************
WIDGET: inspire_sidebar_twitter_via_widget
***************************************/

	add_action('widgets_init', 'register_widget_inspire_sidebar_twitter_via_widget' );
	function register_widget_inspire_sidebar_twitter_via_widget () {
		register_widget('inspire_sidebar_twitter_via_widget');	
	}

	class inspire_sidebar_twitter_via_widget extends WP_Widget {

		/**************************************
		1. INIT
		***************************************/
		function __construct () {

				$widget_ops = array(
					'classname' => 'inspire_sidebar_twitter_via_widget', 								
					'description' =>'Tweets via Twitter\'s own widget' 				
				);
				$control_ops = array(
					'width' => 400, 
					'height' => 350, 
					'id_base' => 'inspire_sidebar_twitter_via_widget' 														
				);

				parent::__construct('inspire_sidebar_twitter_via_widget','Inspire: Twitter via widget', $widget_ops, $control_ops );	
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
				'widget_title' 			=> 'Latest tweets',
				'twitter_num_tweets' 	=> 3,
				'twitter_screen_name'	=> 'envato',
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
					<label for='<?php echo $this->get_field_id('twitter_widget_code'); ?>'>Twitter widget code: </label><br>
					<textarea class='widefat' id='<?php echo $this->get_field_id('twitter_widget_code'); ?>' name='<?php echo $this->get_field_name('twitter_widget_code'); ?>' rows='10'><?php if (isset($twitter_widget_code)) echo esc_attr($twitter_widget_code); ?></textarea>
					Generate you own widget code here: <a href='https://twitter.com/settings/widgets' target='_blank'>https://twitter.com/settings/widgets/</a>
				</P>

				<hr>

				<br>


				<p>
					<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'use_inspire_design' ); ?>" name="<?php echo $this->get_field_name( 'use_inspire_design' ); ?>" value="checked" <?php checked(isset($use_inspire_design)) ?>/> 
					<label for="<?php echo $this->get_field_id( 'use_inspire_design' ); ?>">Use Inspire design instead?</label>
				</p>


				<p>
					<label for='<?php echo $this->get_field_id('twitter_num_tweets'); ?>'>Number of tweets: </label>
					<input 
						style='width: 40px;'
						type='number' 
						min='1'
						max='20'
						id='<?php echo $this->get_field_id('twitter_num_tweets'); ?>' 
						name='<?php echo $this->get_field_name('twitter_num_tweets'); ?>' 
						value='<?php if (isset($twitter_num_tweets)) echo esc_attr($twitter_num_tweets); ?>'
					>
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
				$widget_title 			= 'Latest tweets';
				$twitter_num_tweets 	= 3;
				$twitter_screen_name	= 'envato';
			}

			?>

			<?php echo $before_widget; ?>

			<?php echo $before_title . $widget_title . $after_title; ?>

			<div class='twitter_widget'>
				<?php 
					if (!empty($twitter_widget_code)) {
						echo $twitter_widget_code; 
					} else {
						echo "<i>Please insert your Twitter widget code!</i>";
					}
				?>

			</div>

			<div class='twitter_via_widget_inspire_design' data-inspire_design='<?php if(isset($use_inspire_design)) {echo "true";} else {echo "false";} ?>' data-num_tweets='<?php echo $twitter_num_tweets; ?>'>
					<ul class="twitter">
					</ul>
			</div>

			<?php echo $after_widget; ?>


			<?php
		}

	} //END CLASS



