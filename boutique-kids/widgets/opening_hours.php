<?php


/**
 * This is the "contact details" sidebar widget.
 */

class dtbaker_opening_hours extends WP_Widget {


    /** constructor */
    public function __construct() {
        $widget_ops = array(
            'description' => __('Use this widget to display your opening hours on the sidebar.', 'boutique-kids')
        );

	    parent::__construct(false, __('Opening Hours', 'boutique-kids'), $widget_ops );
    }


    /** @see WP_Widget::widget */
    function widget($args, $instance) {

        extract( $args );
        $title = $instance['title'];

        echo $before_widget;
        echo $title ? ($before_title . $title . $after_title) : '';


        ?>
    <ul class="opening_hours">
        <?php if(isset($instance['monday'])&&$instance['monday']){ ?>
        <li><strong><?php _e('Monday','boutique-kids');?></strong>
            <span class="contact_detail"><?php echo esc_html($instance['monday']);?></span> </li>
        <?php } ?>
        <?php if(isset($instance['tuesday'])&&$instance['tuesday']){ ?>
        <li><strong><?php _e('Tuesday','boutique-kids');?></strong>
            <span class="contact_detail"><?php echo esc_html($instance['tuesday']);?></span> </li>
        <?php } ?>
        <?php if(isset($instance['wednesday'])&&$instance['wednesday']){ ?>
        <li><strong><?php _e('Wednesday','boutique-kids');?></strong>
            <span class="contact_detail"><?php echo esc_html($instance['wednesday']);?></span> </li>
        <?php } ?>
        <?php if(isset($instance['thursday'])&&$instance['thursday']){ ?>
        <li><strong><?php _e('Thursday','boutique-kids');?></strong>
            <span class="contact_detail"><?php echo esc_html($instance['thursday']);?></span> </li>
        <?php } ?>
        <?php if(isset($instance['friday'])&&$instance['friday']){ ?>
        <li><strong><?php _e('Friday','boutique-kids');?></strong>
            <span class="contact_detail"><?php echo esc_html($instance['friday']);?></span> </li>
        <?php } ?>
        <?php if(isset($instance['saturday'])&&$instance['saturday']){ ?>
        <li><strong><?php _e('Saturday','boutique-kids');?></strong>
            <span class="contact_detail"><?php echo esc_html($instance['saturday']);?></span> </li>
        <?php } ?>
        <?php if(isset($instance['sunday'])&&$instance['sunday']){ ?>
        <li><strong><?php _e('Sunday','boutique-kids');?></strong>
            <span class="contact_detail"><?php echo esc_html($instance['sunday']);?></span> </li>
        <?php } ?>
    </ul>
    <?php
        echo $after_widget;
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['monday'] = strip_tags($new_instance['monday']);
        $instance['tuesday'] = strip_tags($new_instance['tuesday']);
        $instance['wednesday'] = strip_tags($new_instance['wednesday']);
        $instance['thursday'] = strip_tags($new_instance['thursday']);
        $instance['friday'] = strip_tags($new_instance['friday']);
        $instance['saturday'] = strip_tags($new_instance['saturday']);
        $instance['sunday'] = strip_tags($new_instance['sunday']);
        return $instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {
        $title = esc_attr(isset($instance['title']) ? $instance['title'] : '');
        ?>

    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'boutique-kids'); ?>
        <input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title;?>">
    </label></p>


    <p><label for="<?php echo $this->get_field_id('monday'); ?>"><?php _e('Monday:', 'boutique-kids'); ?>
        <input type="text" name="<?php echo $this->get_field_name('monday'); ?>" value="<?php echo esc_attr(isset($instance['monday'])?$instance['monday']:'');?>">
    </label></p>
    <p><label for="<?php echo $this->get_field_id('tuesday'); ?>"><?php _e('Tuesday', 'boutique-kids'); ?>
        <input type="text" name="<?php echo $this->get_field_name('tuesday'); ?>" value="<?php echo esc_attr(isset($instance['tuesday'])?$instance['tuesday']:'');?>">
    </label></p>
    <p><label for="<?php echo $this->get_field_id('wednesday'); ?>"><?php _e('Wednesday:', 'boutique-kids'); ?>
        <input type="text" name="<?php echo $this->get_field_name('wednesday'); ?>" value="<?php echo esc_attr(isset($instance['wednesday'])?$instance['wednesday']:'');?>">
    </label></p>
    <p><label for="<?php echo $this->get_field_id('thursday'); ?>"><?php _e('Thursday:', 'boutique-kids'); ?>
        <input type="text" name="<?php echo $this->get_field_name('thursday'); ?>" value="<?php echo esc_attr(isset($instance['thursday'])?$instance['thursday']:'');?>">
    </label></p>
    <p><label for="<?php echo $this->get_field_id('friday'); ?>"><?php _e('Friday:', 'boutique-kids'); ?>
        <input type="text" name="<?php echo $this->get_field_name('friday'); ?>" value="<?php echo esc_attr(isset($instance['friday'])?$instance['friday']:'');?>">
    </label></p>
    <p><label for="<?php echo $this->get_field_id('saturday'); ?>"><?php _e('Saturday:', 'boutique-kids'); ?>
        <input type="text" name="<?php echo $this->get_field_name('saturday'); ?>" value="<?php echo esc_attr(isset($instance['saturday'])?$instance['saturday']:'');?>">
    </label></p>
    <p><label for="<?php echo $this->get_field_id('sunday'); ?>"><?php _e('Sunday:', 'boutique-kids'); ?>
        <input type="text" name="<?php echo $this->get_field_name('sunday'); ?>" value="<?php echo esc_attr(isset($instance['sunday'])?$instance['sunday']:'');?>">
    </label></p>


    <?php
    }

} // class boutiquewidget_latest

add_action('widgets_init', create_function('', 'return register_widget("dtbaker_opening_hours");'));

