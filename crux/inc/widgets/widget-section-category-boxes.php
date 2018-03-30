<?php
add_action('widgets_init', create_function('', 'return register_widget("stag_widget_category_boxes");'));

class stag_widget_category_boxes extends WP_Widget{
    function __construct(){
        $widget_ops = array('classname' => 'widget-category-boxes', 'description' => __('Displays all contents under &ldquo;Category Boxes Sidebar&rdquo; Area.', 'stag'));
        $control_ops = array('width' => 300, 'height' => 350, 'id_base' => 'stag_widget_category_boxes');
        parent::__construct('stag_widget_category_boxes', __('Section: Category Boxes', 'stag'), $widget_ops, $control_ops);
    }

    function widget($args, $instance){
        extract($args);

        $background_color = $instance['background_color'];

        ?>

		<div class="category-boxes-wrapper" style="background-color: <?php echo $background_color; ?>">
			<div class="inside">
				<div class="grids category-boxes">
				    <?php dynamic_sidebar('sidebar-3'); ?>
				</div>
			</div>
		</div>

        <?php

        echo $after_widget;
    }

    function update($new_instance, $old_instance){
        $instance = $old_instance;

		$instance['background_color'] = strip_tags($new_instance['background_color']);

        return $instance;
    }

    function form($instance){
        $defaults = array(
            /* Deafult options goes here */
            'background_color' => '#2f322b'
        );

        $instance = wp_parse_args((array) $instance, $defaults);

    wp_enqueue_script('wp-color-picker');
    wp_enqueue_style('wp-color-picker');
    /* HERE GOES THE FORM */
    ?>

    <script type='text/javascript'>
        jQuery(document).ready(function($) {
            $('.colorpicker').wpColorPicker();

            $('.widget').find('.wp-picker-container').each(function(){
                var len = $(this).find('.wp-color-result').length;
                if ( len > 1){
                    $(this).find('.wp-color-result').first().hide();
                }
            });
        });
    </script>


    <p>
        <label for="<?php echo $this->get_field_id('background_color'); ?>"><?php _e('Background Color:', 'stag'); ?></label><br>
        <input type="text" data-default-color="<?php echo $defaults['background_color'] ?>" class="colorpicker" name="<?php echo $this->get_field_name( 'background_color' ); ?>" id="<?php echo $this->get_field_id( 'background_color' ); ?>" value="<?php echo $instance['background_color']; ?>" />
    </p>

    <?php
  }
}
