<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class WP_Widget_Video extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'ut_widget_video', 'description' => __( 'Insert your embedded code in here!', 'unitedthemes') );
		parent::__construct('ut_video', __('United Themes - Embedded Video', 'unitedthemes'), $widget_ops);
		$this->alt_option_name = 'ut_video_widget';

	}
	function form($instance) {
	
	$title = ( isset($instance['title']) && !empty($instance['title']) ) ? esc_attr($instance['title']) : '';
	$text = ( isset($instance['text']) && !empty($instance['text']) ) ? esc_attr($instance['text']) : '';
	
	?>

    <label><?php _e('Title', 'unitedthemes'); ?>: <input type="text" style="width:100%;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" /></label>
    <label><?php _e('Text', 'unitedthemes'); ?>: <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea></label>
    
	<?php

    }

    function update($new_instance, $old_instance) {
        return $new_instance;
    }

    function widget( $args, $instance ){

	extract( $args );
	extract( $instance );

	if( $title )
	    $title = $before_title.do_shortcode($title).$after_title;

	$text = do_shortcode( $text );
	$text = $title.'<div class="ut-video">'.$text.'</div>';

	echo "$before_widget
	    	$text
		  $after_widget";
    }

}

add_action( 'widgets_init', create_function( '', 'return register_widget("wp_widget_video");' ) );

?>
