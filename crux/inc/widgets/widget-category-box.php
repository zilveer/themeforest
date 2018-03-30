<?php
add_action('widgets_init', create_function('', 'return register_widget("stag_widget_category_box");'));

class stag_widget_category_box extends WP_Widget{
    function __construct(){
        $widget_ops = array('classname' => 'widget-category-box', 'description' => __('Display Category boxes, should be used only in &ldquo;Category Boxes Sidebar&rdquo; Area.', 'stag'));
        $control_ops = array('width' => 300, 'height' => 350, 'id_base' => 'stag_widget_category_box');
        parent::__construct('stag_widget_category_box', __('Category Box', 'stag'), $widget_ops, $control_ops);
    }

    function widget($args, $instance){
        extract($args);

        // VARS FROM WIDGET SETTINGS
		$title       = apply_filters('widget_title', $instance['title'] );
		$bg_image    = $instance['bg_image'];
		$button_link = $instance['button_link'];
		$button_text = $instance['button_text'];

        echo $before_widget;

        ?>

		<div class="category" style="background-image:url(<?php echo esc_url($bg_image); ?>);">
			<div class="category-content">
				<h3 class="category-title"><?php echo htmlspecialchars_decode($title); ?></h3>
				<?php if ( $button_link != '' ) : ?>
				<a class="button button-stroked" href="<?php echo $button_link; ?>"><?php echo $button_text; ?></a>
				<?php endif; ?>
			</div>
		</div>

        <?php

        echo $after_widget;
    }

    function update($new_instance, $old_instance){
        $instance = $old_instance;

        // STRIP TAGS TO REMOVE HTML
		$instance['title']       = $new_instance['title'];
		$instance['bg_image']    = esc_url( $new_instance['bg_image'] );
		$instance['button_link'] = esc_url( $new_instance['button_link'] );
		$instance['button_text'] = strip_tags($new_instance['button_text']);

        return $instance;
    }

    function form($instance){
        $defaults = array(
            /* Deafult options goes here */
			'title'       => '',
			'bg_image'    => '',
			'button_link' => '',
			'button_text' => __( 'Browse', 'stag' ),
        );

        $instance = wp_parse_args((array) $instance, $defaults);

    /* HERE GOES THE FORM */
    ?>

    <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'stag'); ?></label>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
    </p>

    <p>
        <label for="<?php echo $this->get_field_id('bg_image'); ?>"><?php _e('Background Image URL:', 'stag'); ?></label>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'bg_image' ); ?>" name="<?php echo $this->get_field_name( 'bg_image' ); ?>" value="<?php echo @$instance['bg_image']; ?>" />
    </p>

    <p>
        <label for="<?php echo $this->get_field_id('button_link'); ?>"><?php _e('Button Link:', 'stag'); ?></label>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'button_link' ); ?>" name="<?php echo $this->get_field_name( 'button_link' ); ?>" value="<?php echo $instance['button_link']; ?>" />
    </p>

    <p>
        <label for="<?php echo $this->get_field_id('button_text'); ?>"><?php _e('Button Text:', 'stag'); ?></label>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'button_text' ); ?>" name="<?php echo $this->get_field_name( 'button_text' ); ?>" value="<?php echo $instance['button_text']; ?>" />
    </p>

    <?php
  }
}
