<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );

class Widget_Fw_Shortcodes extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => __( 'Add here shortcodes.', 'fw' ) );

		parent::__construct( false, __( 'Apital Shortcodes', 'fw' ), $widget_ops );
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
			'before_widget' => '<div class="space x2">',
			'after_widget'  => '</div>',
		);

        if(defined('FW'))
        echo fw_render_view( $filepath, $data );
    }

	function update( $new_instance, $old_instance ) {
		$instance = wp_parse_args( (array) $new_instance, $old_instance );
        $instance['title'] = $new_instance['title'];

		return $instance;
	}

	function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'text' => '') );
        $text = format_to_edit($instance['text']);
        ?>
        <p><label for="<?php echo esc_attr($this->get_field_id('text')); ?>"><?php _e('Add Shortcodes Here:','fw'); ?></label></p>
        <p><textarea class="widefat" rows="16" cols="20" id="<?php echo esc_attr($this->get_field_id('text')); ?>" name="<?php echo esc_attr($this->get_field_name('text')); ?>"><?php echo ($text); ?></textarea></p>
<?php
	}
}


