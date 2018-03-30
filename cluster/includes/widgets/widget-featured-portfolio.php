<?php
add_action('widgets_init', create_function('', 'return register_widget("stag_featured_portfolio");'));

class stag_featured_portfolio extends WP_Widget{
  function __construct(){
    $widget_ops = array(
      'classname' => 'featured-portfolio',
      'description' => __('Display a featured portfolio', 'stag')
    );
    $control_ops = array('width' => 300, 'height' => 350, 'id_base' => 'stag_featured_portfolio');
    parent::__construct('stag_featured_portfolio', __('Featured Portfolio', 'stag'), $widget_ops, $control_ops);
  }

  function widget($args, $instance){
    extract($args);

    // VARS FROM WIDGET SETTINGS
    $title = apply_filters('widget_title', $instance['title'] );
    $postid = absint( $instance['postid'] );

    echo $before_widget;

    if ( $title ) { echo $before_title . $title . $after_title; }

    // Widget contents starts here
    $post_obj = get_post( $postid );

    if ( is_object( $post_obj ) ) :
      $project_images = explode( ',', get_post_meta( $post_obj->ID, '_stag_portfolio_images', true ) );

    ?>

    <div id="feature-portfolio-slider-<?php echo $post_obj->ID; ?>" class="flexslider">
      <ul class="slides">
      <?php foreach ( $project_images as $image ) : ?>
        <li>
          <a href="<?php echo get_permalink( $post_obj->ID ); ?>">
            <img src="<?php echo esc_url( $image ) ?>" alt="<?php echo get_the_title(); ?>">
          </a>
        </li>
      <?php endforeach; ?>
      </ul>
    </div>

    <?php endif;

    echo $after_widget;
  }

  function update($new_instance, $old_instance){
    $instance = $old_instance;

    // STRIP TAGS TO REMOVE HTML
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['postid'] = strip_tags($new_instance['postid']);

    return $instance;
  }

  function form($instance){
    $defaults = array(
      'title' => 'Featured Portfolio',
      'postid' => ''
      );

    $instance = wp_parse_args((array) $instance, $defaults);

    /* HERE GOES THE FORM */
    ?>

    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'stag'); ?></label>
      <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('postid'); ?>"><?php _e('Post ID:', 'stag'); ?></label>
      <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'postid' ); ?>" name="<?php echo $this->get_field_name( 'postid' ); ?>" value="<?php echo $instance['postid']; ?>" />
      <span class="description"><?php _e('Enter the Portfolio post ID', 'stag'); ?></span>
    </p>

    <?php
  }
}

?>
