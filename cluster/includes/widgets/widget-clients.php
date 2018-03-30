<?php
add_action('widgets_init', create_function('', 'return register_widget("stag_widget_clients");'));

class stag_widget_clients extends WP_Widget{
    function __construct(){
        $widget_ops = array('classname' => 'section-clients', 'description' => __('Displays multiple images as a showcase.', 'stag'));
        $control_ops = array('width' => 300, 'height' => 350, 'id_base' => 'stag_widget_clients');
        parent::__construct('stag_widget_clients', __('Homepage: Clients', 'stag'), $widget_ops, $control_ops);
    }

    function widget($args, $instance){
        extract($args);

        // VARS FROM WIDGET SETTINGS
        $title = apply_filters('widget_title', $instance['title'] );
        $subtitle = $instance['subtitle'];
        $urls = $instance['urls'];

        echo $before_widget;

        if($title != '') echo $before_title. $title . $after_title;
        if(!empty($subtitle)) echo "\n\t<p class='subtitle'>{$subtitle}</p>";

        $urls = explode("\n", $urls);
    ?>

      <div class="grids">
      <?php foreach( $urls as $url ): ?>
      <figure class="grid-3">
        <img src="<?php echo esc_url($url); ?>" alt="">
      </figure>
      <?php endforeach; ?>
      </div>



        <?php

        echo $after_widget;

    }

    function update($new_instance, $old_instance){
        $instance = $old_instance;

        // STRIP TAGS TO REMOVE HTML
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['subtitle'] = strip_tags($new_instance['subtitle']);
        $instance['urls'] = strip_tags($new_instance['urls']);

        return $instance;
    }

    function form($instance){
        $defaults = array(
            /* Deafult options goes here */
            'page' => 0,
            'urls' => ''
        );

        $instance = wp_parse_args((array) $instance, $defaults);

    /* HERE GOES THE FORM */
    ?>

    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'stag'); ?></label>
      <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo @$instance['title']; ?>" />
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('subtitle'); ?>"><?php _e('Sub Title:', 'stag'); ?></label>
      <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'subtitle' ); ?>" name="<?php echo $this->get_field_name( 'subtitle' ); ?>" value="<?php echo @$instance['subtitle']; ?>" />
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('urls'); ?>"><?php _e('Image URLs:', 'stag'); ?></label>
        <textarea rows="16" cols="20" class="widefat" id="<?php echo $this->get_field_id( 'urls' ); ?>" name="<?php echo $this->get_field_name( 'urls' ); ?>"><?php echo @$instance['urls']; ?></textarea>
    </p>

    <?php
  }
}

?>
