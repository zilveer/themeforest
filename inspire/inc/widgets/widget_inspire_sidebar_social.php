<?php

/**************************************
WIDGET: inspire_sidebar_social
***************************************/

	add_action('widgets_init', 'register_widget_inspire_sidebar_social' );
	function register_widget_inspire_sidebar_social () {
		register_widget('inspire_sidebar_social');	
	}

	class inspire_sidebar_social extends WP_Widget {

		/**************************************
		1. INIT
		***************************************/
		function __construct () {

				$widget_ops = array(
					'classname' => 'inspire_sidebar_social', 								
					'description' =>'Links to your social sites' 				
				);
				$control_ops = array(
					'id_base' => 'inspire_sidebar_social' 														
				);

				parent::__construct('inspire_sidebar_social','Inspire: Social links', $widget_ops, $control_ops );	
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
					'open_new' => 'checked'
				);	
			}

			//defaults
			$defaults = array( 
				'widget_title' => 'Subscribe and follow',
				'soc_facebook' => 'http://www.facebook.com/envato', 
				'soc_twitter' => 'https://twitter.com/boostdevelopers', 
				'soc_pinterest' => 'http://pinterest.com/boostdevelopers/', 
				'soc_flickr' => 'http://www.flickr.com/people/91667881@N02/', 
				'soc_tumblr' => 'http://boostdevelopers.tumblr.com/', 
				'soc_vimeo' => 'https://vimeo.com/user15546275', 
				'soc_rss' => home_url() . "/feed/"
			);

			//merge default
			if (!empty($defaults_checkboxes)) $defaults = array_merge($defaults, $defaults_checkboxes);
			
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			?>

				<p>
					<label for="<?php echo $this->get_field_id('widget_title'); ?> ">Title: </label><br>
					<input class='widefat' type='text' id='<?php echo $this->get_field_id('widget_title'); ?>' name='<?php echo $this->get_field_name('widget_title'); ?>' value='<?php if(isset($widget_title)) echo $widget_title; ?>'>
				</p>

				<p>
					<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id('open_new'); ?>" name="<?php echo $this->get_field_name('open_new'); ?>" value="checked" <?php checked(isset($open_new)); ?>/> 
					<label for="<?php echo $this->get_field_id('open_new'); ?>">Open link in new window?</label>
				</p>

				<hr>

				<p>Social links - full URLs. e.g.: <br> <i>http://www.facebook.com/envato</i></p>

				<p>
					<label for="<?php echo $this->get_field_id('soc_facebook'); ?> ">Facebook: </label><br>
					<input class='widefat' type='text' id='<?php echo $this->get_field_id('soc_facebook'); ?>' name='<?php echo $this->get_field_name('soc_facebook'); ?>' value='<?php if(isset($soc_facebook)) echo $soc_facebook; ?>'>
				</p>

				<p>
					<label for="<?php echo $this->get_field_id('soc_twitter'); ?> ">Twitter: </label><br>
					<input class='widefat' type='text' id='<?php echo $this->get_field_id('soc_twitter'); ?>' name='<?php echo $this->get_field_name('soc_twitter'); ?>' value='<?php if(isset($soc_twitter)) echo $soc_twitter; ?>'>
				</p>

				<p>
					<label for="<?php echo $this->get_field_id('soc_pinterest'); ?> ">Pinterest: </label><br>
					<input class='widefat' type='text' id='<?php echo $this->get_field_id('soc_pinterest'); ?>' name='<?php echo $this->get_field_name('soc_pinterest'); ?>' value='<?php if(isset($soc_pinterest)) echo $soc_pinterest; ?>'>
				</p>

				<p>
					<label for="<?php echo $this->get_field_id('soc_flickr'); ?> ">Flickr: </label><br>
					<input class='widefat' type='text' id='<?php echo $this->get_field_id('soc_flickr'); ?>' name='<?php echo $this->get_field_name('soc_flickr'); ?>' value='<?php if(isset($soc_flickr)) echo $soc_flickr; ?>'>
				</p>

				<p>
					<label for="<?php echo $this->get_field_id('soc_tumblr'); ?> ">Tumblr: </label><br>
					<input class='widefat' type='text' id='<?php echo $this->get_field_id('soc_tumblr'); ?>' name='<?php echo $this->get_field_name('soc_tumblr'); ?>' value='<?php if(isset($soc_tumblr)) echo $soc_tumblr; ?>'>
				</p>

				<p>
					<label for="<?php echo $this->get_field_id('soc_vimeo'); ?> ">Vimeo: </label><br>
					<input class='widefat' type='text' id='<?php echo $this->get_field_id('soc_vimeo'); ?>' name='<?php echo $this->get_field_name('soc_vimeo'); ?>' value='<?php if(isset($soc_vimeo)) echo $soc_vimeo; ?>'>
				</p>

				<p>
					<label for="<?php echo $this->get_field_id('soc_rss'); ?> ">RSS: </label><br>
					<input class='widefat' type='text' id='<?php echo $this->get_field_id('soc_rss'); ?>' name='<?php echo $this->get_field_name('soc_rss'); ?>' value='<?php if(isset($soc_rss)) echo $soc_rss; ?>'>
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
				$open_new 		= 'checked';
				$widget_title 	= 'Subscribe and follow';
				$soc_facebook 	= 'http://www.facebook.com/envato'; 
				$soc_twitter 	= 'https://twitter.com/boostdevelopers'; 
				$soc_pinterest 	= 'http://pinterest.com/boostdevelopers/'; 
				$soc_flickr 	= 'http://www.flickr.com/people/91667881@N02/'; 
				$soc_tumblr 	= 'http://boostdevelopers.tumblr.com/'; 
				$soc_vimeo 		= 'https://vimeo.com/user15546275'; 
				$soc_rss 		= home_url() . "/feed/";
			}

			?>

			<?php echo $before_widget; ?>
			<?php echo $before_title . $widget_title . $after_title; ?>

				<?php 
					$open_add = (!empty($open_new)) ? " target='_blank'" : "";

					if (!empty($soc_facebook)) {printf("<a href='%s' %s class='sidebar-social facebook'></a>",esc_url($soc_facebook), esc_attr($open_add));}
					if (!empty($soc_twitter)) {printf("<a href='%s' %s class='sidebar-social twitter'></a>",esc_url($soc_twitter), esc_attr($open_add));}
					if (!empty($soc_pinterest)) {printf("<a href='%s' %s class='sidebar-social pinterest'></a>",esc_url($soc_pinterest), esc_attr($open_add));}
					if (!empty($soc_flickr)) {printf("<a href='%s' %s class='sidebar-social flickr'></a>",esc_url($soc_flickr), esc_attr($open_add));}
					if (!empty($soc_tumblr)) {printf("<a href='%s' %s class='sidebar-social tumblr'></a>",esc_url($soc_tumblr), esc_attr($open_add));}
					if (!empty($soc_vimeo)) {printf("<a href='%s' %s class='sidebar-social vimeo'></a>",esc_url($soc_vimeo), esc_attr($open_add));}
					if (!empty($soc_rss)) {printf("<a href='%s' %s class='sidebar-social rss'></a>",esc_url($soc_rss), esc_attr($open_add));}



				?>
					<!-- DE 2 NYE ICONS
					<a href="#" class="sidebar-social instagram"></a>
					<a href="#" class="sidebar-social google"></a>
					-->

			<?php echo $after_widget; ?>

			<?php
		}

	} //END CLASS