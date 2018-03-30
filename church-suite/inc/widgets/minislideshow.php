<?php class WebnusMiniSlideShowWidget extends WP_Widget{
	function __construct(){
		$params = array('description'=> 'Webnus MiniSlideShow Widget','name'=> 'Webnus-MiniSlideShow');
		parent::__construct('WebnusMiniSlideShowWidget', '', $params);
	}
	public function form($instance){
	extract($instance); ?>
		<p><label for="<?php echo $this->get_field_id('title') ?>">Title:</label><input type="text" class="widefat"	id="<?php echo $this->get_field_id('title') ?>"	name="<?php echo $this->get_field_name('title') ?>" value="<?php if( isset($title) )  echo esc_attr($title); ?>" /></p>
		<?php for($i=1; $i<=10; $i++) {$textboxes = 'slide_'.$i;?>
		<p><label for="<?php echo $this->get_field_id($textboxes) ?>">Slide #<?php echo $i; ?> Image URL: </label><input type="text" class="widefat" id="<?php echo $this->get_field_id($textboxes) ?>" name="<?php echo $this->get_field_name($textboxes) ?>" value="<?php if( isset($$$textboxes) )  echo esc_attr($$textboxes); ?>"/></p>
		<?php }
	}
	public function widget($args, $instance){
		extract($args);
		extract($instance);
		echo $before_widget;
		if(!empty($title))
			echo $before_title.$title.$after_title; 
		?>
			<div class="minislideshow">
			<?php
			$output = '';
			$output .= '<div class="flexslider"><ul class="slides">';
			for($i=1; $i<=10; $i++){
				$textboxes = 'slide_'.$i;
				if(!empty($$textboxes))
					$output .= '<li><img src="'.$$textboxes.'" alt=""></li>';
			}
			$output .= '</ul></div>';
			echo $output;?>
			<div class="clear"></div>
			</div>	 
		  <?php echo $after_widget;
	} 
}
add_action('widgets_init','register_webnus_minislideshow_widget'); 
function register_webnus_minislideshow_widget(){
	register_widget('WebnusMiniSlideShowWidget');
}