<?php
add_action('widgets_init', create_function('', 'return register_widget("stag_widget_services_section");'));

class stag_widget_services_section extends WP_Widget{
  function __construct(){
    $widget_ops = array('classname' => 'services-section', 'description' => __('Display widgets from Services Sidebar.', 'stag'));
    $control_ops = array('width' => 300, 'height' => 350, 'id_base' => 'stag_widget_services_section');
    parent::__construct('stag_widget_services_section', __('Homepage: Services Section', 'stag'), $widget_ops, $control_ops);
  }

  function widget($args, $instance){
    extract($args);

    // VARS FROM WIDGET SETTINGS
    $title = apply_filters('widget_title', $instance['title'] );
    $subtitle = $instance['subtitle'];

    echo $before_widget;

    echo "\n\t".$before_title. $title . $after_title;

    if(!empty($subtitle)) echo "\n\t<p class='subtitle'>{$subtitle}</p>";

    echo '<div class="grids all-services">';
    dynamic_sidebar('sidebar-services');
    echo '</div>';

    echo $after_widget;
  }

  function update($new_instance, $old_instance){
    $instance = $old_instance;

    // STRIP TAGS TO REMOVE HTML
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['subtitle'] = strip_tags($new_instance['subtitle']);

    return $instance;
  }

  function form($instance){
    $defaults = array(
      /* Deafult options goes here */
      'title' => '',
      'subtitle' => ''
    );

    $instance = wp_parse_args((array) $instance, $defaults);

    /* HERE GOES THE FORM */
    ?>

    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'stag'); ?></label>
      <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('subtitle'); ?>"><?php _e('Subtitle:', 'stag'); ?></label>
      <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'subtitle' ); ?>" name="<?php echo $this->get_field_name( 'subtitle' ); ?>" value="<?php echo $instance['subtitle']; ?>" />
    </p>

    <?php
  }
}

?>
