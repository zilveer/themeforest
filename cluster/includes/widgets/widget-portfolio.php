<?php
add_action('widgets_init', create_function('', 'return register_widget("stag_widget_portfolio");'));

class stag_widget_portfolio extends WP_Widget{
  function __construct(){
    $widget_ops = array('classname' => 'portfolio-items', 'description' => __('Display portfolio items.', 'stag'));
    $control_ops = array('width' => 300, 'height' => 350, 'id_base' => 'stag_widget_portfolio');
    parent::__construct('stag_widget_portfolio', __('Homepage: Portfolio', 'stag'), $widget_ops, $control_ops);
  }

  function widget($args, $instance){
    extract($args);

    // VARS FROM WIDGET SETTINGS
    $title = apply_filters('widget_title', $instance['title'] );
    $subtitle = $instance['subtitle'];
    $button_text = $instance['button_text'];
    $button_link = $instance['button_link'];
    $post_count = $instance['post_count'];

    echo $before_widget;
    ?>



    <div class="grids">
      <div class="grid-8">
        <?php
        echo "\n\t".$before_title. $title . $after_title;
        if(!empty($subtitle)) echo "\n\t<p class='subtitle'>{$subtitle}</p>";
        ?>
      </div>
      <div class="grid-4">
        <?php if($button_link != ''): ?>
        <a href="<?php echo $button_link; ?>" class="button big"><?php echo $button_text; ?></a>
        <?php endif; ?>
      </div>
    </div>

    <div class="grids portfolios clearfix" id="gateway-portfolio">

      <?php

      query_posts(array(
        'post_type' => 'portfolio',
        'posts_per_page' => $post_count,
      ));

      if(have_posts()): while(have_posts()): the_post();

      if(!has_post_thumbnail()) continue;
      ?>

        <div id="post-<?php the_ID(); ?>" <?php post_class('grid-4'); ?>>
          <div class="overlay">
            <h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'stag'), get_the_title()); ?>"> <?php the_title(); ?></a></h3>
            <div class="portfolio-navigation">
              <a href="<?php the_permalink(); ?>" class="accent-background portfolio-trigger" data-id="<?php the_ID(); ?>"><i class="icon-eye"></i></a>
              <a href="<?php the_permalink(); ?>" class="accent-background" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'stag'), get_the_title()); ?>"><i class="icon-post-link"></i></a>
            </div>
          </div>
          <?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?>
        </div>

      <?php
      endwhile;
      endif;
      wp_reset_query();
      ?>

    </div>

    <?php
    echo $after_widget;
  }

  function update($new_instance, $old_instance){
    $instance = $old_instance;

    // STRIP TAGS TO REMOVE HTML
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['subtitle'] = strip_tags($new_instance['subtitle']);
    $instance['button_text'] = strip_tags($new_instance['button_text']);
    $instance['button_link'] = strip_tags($new_instance['button_link']);
    $instance['post_count'] = strip_tags($new_instance['post_count']);

    return $instance;
  }

  function form($instance){
    $defaults = array(
      /* Deafult options goes here */
      'title' => 'Featured Work',
      'subtitle' => '',
      'button_text' => 'Go to Portfolio',
      'button_link' => '',
      'post_count' => 9,
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

    <p>
      <label for="<?php echo $this->get_field_id('button_link'); ?>"><?php _e('Portfolio Link:', 'stag'); ?></label>
      <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'button_link' ); ?>" name="<?php echo $this->get_field_name( 'button_link' ); ?>" value="<?php echo $instance['button_link']; ?>" />
      <span class="description"><?php _e('Enter the portfolio URL.', 'stag'); ?></span>
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('button_text'); ?>"><?php _e('Button Text:', 'stag'); ?></label>
      <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'button_text' ); ?>" name="<?php echo $this->get_field_name( 'button_text' ); ?>" value="<?php echo $instance['button_text']; ?>" />
      <span class="description"><?php _e('Enter the text for go to blog button.', 'stag'); ?></span>
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('post_count'); ?>"><?php _e('Post Count:', 'stag'); ?></label>
      <input type="number" step="3" class="widefat" id="<?php echo $this->get_field_id( 'post_count' ); ?>" name="<?php echo $this->get_field_name( 'post_count' ); ?>" value="<?php echo $instance['post_count']; ?>" />
      <span class="description"><?php _e('Enter the number of posts to display in right side.', 'stag'); ?></span>
    </p>

    <?php
  }
}

?>
