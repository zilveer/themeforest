<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );

class Widget_Fw_Info extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => __( 'Info Widget (works only in footers sidebar).', 'fw' ) );

		parent::__construct( false, __( 'Apital Info', 'fw' ), $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$params = array();
        $before_title = '';
        $after_title = '';

		foreach ( $instance as $key => $value ) {
			$params[ $key ] = $value;
		}

		$filepath = dirname( __FILE__ ) . '/views/widget.php';

		$data = array(
			'instance' => $params,
			'before_widget' => '',
			'after_widget'  => '',
		);

        if(defined('FW'))
        echo fw_render_view( $filepath, $data );
    }

	function update( $new_instance, $old_instance ) {
		$instance = wp_parse_args( (array) $new_instance, $old_instance );
        $instance['text'] = $new_instance['text'];
        $instance['image'] = $new_instance['image'];
        $instance['short'] = $new_instance['short'];

		return $instance;
	}

	function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'text' => '', 'image' => '', 'short' => '') );
        $text = format_to_edit($instance['text']);
        $image = esc_url($instance['image']);
        $short = $instance['short'];
        ?>

        <p><label for="<?php echo esc_attr($this->get_field_id('image')); ?>"><?php _e('Image link:','fw'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('image')); ?>" name="<?php echo esc_attr($this->get_field_name('image')); ?>" type="text" value="<?php echo esc_attr($image); ?>" /></p>

        <p><label for="<?php echo esc_attr($this->get_field_id('text')); ?>"><?php _e('Add short description:','fw'); ?></label>
        <textarea class="widefat" rows="5" cols="10" id="<?php echo esc_attr($this->get_field_id('text')); ?>" name="<?php echo esc_attr($this->get_field_name('text')); ?>"><?php echo ($text); ?></textarea></p>

        <p><label for="<?php echo esc_attr($this->get_field_id('short')); ?>"><?php _e('Add short text:','fw'); ?></label>
            <textarea class="widefat" rows="5" cols="10" id="<?php echo esc_attr($this->get_field_id('short')); ?>" name="<?php echo esc_attr($this->get_field_name('short')); ?>"><?php echo ($short); ?></textarea></p>
<?php
	}
}


