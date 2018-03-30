<?php

// Social Widget
class Theme_Widget_Social extends WP_Widget {

	public $sites = array();

	function Theme_Widget_Social()
	{
		$this->sites = array(
			
			'facebook' => array(
				'icon' => 'icon-facebook-square',
				'title' => __('Facebook URL', 'theme_admin'),
			),
			'twitter' => array(
				'icon' => 'icon-twitter-square',
				'title' => __('Twitter URL', 'theme_admin'),
			),
			'googleplus' => array(
				'icon' => 'icon-google-plus-square',
				'title' => __('Google+ URL', 'theme_admin'),
			),
			'linkedin' => array(
				'icon' => 'icon-linkedin-square',
				'title' => __('LinkedIn URL', 'theme_admin'),
			),
			'pinterest' => array(
				'icon' => 'icon-pinterest',
				'title' => __('Pinterest URL', 'theme_admin'),
			),
			'email' => array(
				'icon' => 'icon-envelope',
				'title' => __('Email Address', 'theme_admin'),
			),
			'rss' => array(
				'icon' => 'icon-rss',
				'title' => __('RSS URL', 'theme_admin'),
			),
		);

		$widget_ops = array('classname' => 'widget_social', 'description' => __( 'Displays a list of Social Icon icons', 'theme_admin') );
		$this->WP_Widget('widget-social', THEME_NAME . ' - ' . __('Social', 'theme_admin'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
	
		$output = '';
		if( !empty($instance['enable_sites']) ){
			foreach($instance['enable_sites'] as $key){
				$link = isset($instance[$key]) ? $instance[$key] : '#';
				
				switch ($key) {
					case 'email':
						$output .= '<a href="mailto:' . $link . '" rel="nofollow" target="_blank"><i class="icon '.$this->sites[$key]['icon'].'"></i></a>';
						break;
					
					default:
						$output .= '<a href="' . $link . '" rel="nofollow" target="_blank"><i class="icon '.$this->sites[$key]['icon'].'"></i></a>';
						break;
				}
			}
		}
		
		echo $before_widget;
		if ( $title ) echo $before_title . $title . $after_title;
		echo $output;
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['enable_sites'] = $new_instance['enable_sites'];
		
		if(!empty($instance['enable_sites'])){
			foreach($instance['enable_sites'] as $key){
				$instance[$key] = isset($new_instance[$key])?strip_tags($new_instance[$key]):'';
			}
		}
		
		return $instance;
	}

	function form( $instance ) {
		//Defaults
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$enable_sites = isset($instance['enable_sites']) ? $instance['enable_sites'] : array();
		
		foreach($this->sites as $key => $value){
			$$key = isset($instance[$key]) ? esc_attr($instance[$key]) : '';
		}

	?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'theme_admin'); ?>:</label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p>
			<label for="<?php echo $this->get_field_id('enable_sites'); ?>"><?php _e( 'Enable Social Icon', 'theme_admin' ); ?>:</label>
			<select name="<?php echo $this->get_field_name('enable_sites'); ?>[]" style="height:10em" id="<?php echo $this->get_field_id('enable_sites'); ?>" class="social-icon-sites widefat" multiple="multiple">
				<?php foreach($this->sites as $key => $value):?>
				<option value="<?php echo $key;?>"<?php echo in_array($key, $enable_sites)? 'selected="selected"':'';?>><?php echo $value['title'];?></option>
				<?php endforeach;?>
			</select>
		</p>
		
		<p>
			<em><?php _e("Note: Please input FULL URL <br/>(e.g. <code>http://www.example.com</code>)", 'theme_admin');?></em>
		</p>
		
		<div class="social-icon-wrap">
		<?php foreach($this->sites as $key => $value):?>
		<p class="social-icon-config" id="social-icon-<?php echo $key;?>" <?php if(!in_array($key, $enable_sites)):?>style="display:none"<?php endif;?>>
			<label for="<?php echo $this->get_field_id( $key ); ?>"><?php echo $value['title']; ?>:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( $key ); ?>" name="<?php echo $this->get_field_name( $key ); ?>" type="text" value="<?php echo $$key; ?>" />
		</p>
		<?php endforeach;?>
		</div>

<?php
	}
}
register_widget('Theme_Widget_Social');