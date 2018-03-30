<?php 
if(!class_exists('WP_Widget_EmAds')){
	/**
	 * Ads Widget class
	 *
	 */
	class WP_Widget_EmAds extends WP_Widget {

		function __construct() {
			$widget_ops = array('classname' => 'widget_emads', 'description' => __('Advertisment  Widget','wpdance'));
			$control_ops = array('width' => 400, 'height' => 350);
			parent::__construct('emads', __('WD - Ads','wpdance'), $widget_ops, $control_ops);
		}

		function widget( $args, $instance ) {
			extract($args);
			$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
			$img = strlen($instance['img']) > 0 ? esc_url( $instance['img'] ) : "";
			$url = strlen($instance['url']) > 0 ? esc_url( $instance['url'] ) : "";
			$img_title = esc_attr($instance['img_title']);
			$img_height = (int)$instance['img_height'];
			$img_width = (int)$instance['img_width'];
			//we progress split youtube links and titles here
			
			$subHtml = ' ';
			if($img_height > 0 ){
				$subHtml = $subHtml."height = '$img_height' ";
			}
			if($img_width > 0 ){
				$subHtml = $subHtml."width = '$img_width' ";
			}
					
			echo $before_widget;
			if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } ?>
			<div class="em-ads-widget"><?php //echo $instance['filter'] ? wpautop($text) : $text; ?>
				<a href="<?php echo $url ?>"><img src="<?php echo $img?>"  alt="<?php echo $img_title ?>" title="<?php echo $img_title ?>" <?php echo $subHtml?>/></a>
			</div>
			<?php
			echo $after_widget;
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = esc_attr($new_instance['title']);
			$instance['img'] = esc_url($new_instance['img']);
			$instance['url'] = esc_url($new_instance['url']);
			$instance['img_title'] = esc_attr($new_instance['img_title']);
			$instance['img_height'] = absint($new_instance['img_height']);
			$instance['img_width'] = absint($new_instance['img_width']);

			return $instance;
		}

		function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
			$title = strip_tags($instance['title']);
			$img = isset($instance['img']) ? esc_attr($instance['img']) : '';
			$url = isset($instance['url']) ? esc_attr($instance['url']) : '';
			$imageTitle = isset($instance['img_title']) ? esc_attr($instance['img_title']) : '';
			$imgHeight = isset($instance['img_height']) ? absint($instance['img_height']) : '';
			$imgWidth = isset($instance['img_width']) ? absint($instance['img_width']) : '';
	?>
			<p><label for="<?php echo $this->get_field_id('img'); ?>"><?php _e('Image Url','wpdance'); ?> : </label>
			<input class="widefat" id="<?php echo $this->get_field_id('img'); ?>" name="<?php echo $this->get_field_name('img'); ?>" type="text" value="<?php echo esc_attr($img); ?>" /></p>
			<p><label for="<?php echo $this->get_field_id('url'); ?>"><?php _e('Ads Url','wpdance'); ?> : </label>
			<input class="widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" type="text" value="<?php echo esc_attr($url); ?>" /></p>
			<p><label for="<?php echo $this->get_field_id('img_title'); ?>"><?php _e('Image title','wpdance'); ?> : </label>
			<input class="widefat" id="<?php echo $this->get_field_id('img_title'); ?>" name="<?php echo $this->get_field_name('img_title'); ?>" type="text" value="<?php echo esc_attr($imageTitle); ?>" /></p>
			<p><label for="<?php echo $this->get_field_id('img_width'); ?>"><?php _e('Image Width','wpdance'); ?> : </label>
			<input id="<?php echo $this->get_field_id('img_width'); ?>" name="<?php echo $this->get_field_name('img_width'); ?>" type="text" value="<?php echo esc_attr($imgHeight); ?>" /> px</p>
			<p><label for="<?php echo $this->get_field_id('img_height'); ?>"><?php _e('Image Height','wpdance'); ?> : </label>
			<input id="<?php echo $this->get_field_id('img_height'); ?>" name="<?php echo $this->get_field_name('img_height'); ?>" type="text" value="<?php echo esc_attr($imgWidth); ?>" /> px</p>

			<p><?php _e("If you dont special the image width and height,system will use image size","wpdance"); ?></p>
	<?php
		}
	}
}
?>