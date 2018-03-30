<?php
add_action('widgets_init', create_function('', 'return register_widget("stag_widget_latest_post");'));

class stag_widget_latest_post extends WP_Widget{
  function __construct(){
    $widget_ops = array('classname' => 'latest-posts', 'description' => __('Display latest posts from blog.', 'stag'));
    $control_ops = array('width' => 300, 'height' => 350, 'id_base' => 'stag_widget_latest_post');
    parent::__construct('stag_widget_latest_post', __('Homepage: Latest Blog Posts', 'stag'), $widget_ops, $control_ops);
  }

  function widget($args, $instance){
    extract($args);

    // VARS FROM WIDGET SETTINGS
    $title       = apply_filters('widget_title', $instance['title'] );
    $subtitle    = $instance['subtitle'];
    $button_text = $instance['button_text'];
    $post_count  = $instance['post_count'];

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
        <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="button big"><?php echo $button_text; ?></a>
      </div>
    </div>

    <div class="posts-wrapper">

        <div class="featured-post">
            <?php

            query_posts(array(
                'posts_per_page' => 1
            ));

            if(have_posts()): while(have_posts()): the_post();

            ?>

            <?php stag_post_before(); ?>
            <!--BEGIN .hentry-->
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php stag_post_start(); ?>

            <?php
                $format = get_post_format();
                global $more;
                $more = false;
                get_template_part('content', $format);
            ?>

            <?php stag_post_end(); ?>
            <!--END .hentry-->

            <?php

            endwhile;

            endif;

            wp_reset_query();

            ?>
        </div>

        <div class="regular-posts">
            <?php

            query_posts(array(
                'posts_per_page'      => $post_count,
                'offset'              => 1,
                'ignore_sticky_posts' => true
            ));

            if(have_posts()): while(have_posts()): the_post();

            ?>

            <article <?php post_class(); ?>>
                <div class="post-meta">
                    <span class="published"><?php the_time('M d Y'); ?></span>
                </div>
                <h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'stag'), get_the_title()); ?>"> <?php the_title(); ?></a></h2>
            </article>

            <?php

            endwhile;

            endif;

            wp_reset_query();

            ?>
        </div>

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
    $instance['post_count'] = strip_tags($new_instance['post_count']);

    return $instance;
  }

  function form($instance){
    $defaults = array(
      /* Deafult options goes here */
      'title' => 'Latest Blog Posts',
      'subtitle' => '',
      'button_text' => 'Go to Blog',
      'post_count' => 5,
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
      <label for="<?php echo $this->get_field_id('button_text'); ?>"><?php _e('Button Text:', 'stag'); ?></label>
      <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'button_text' ); ?>" name="<?php echo $this->get_field_name( 'button_text' ); ?>" value="<?php echo $instance['button_text']; ?>" />
      <span class="description"><?php _e('Enter the text for go to blog button.', 'stag'); ?></span>
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('post_count'); ?>"><?php _e('Post Count:', 'stag'); ?></label>
      <input type="number" class="widefat" id="<?php echo $this->get_field_id( 'post_count' ); ?>" name="<?php echo $this->get_field_name( 'post_count' ); ?>" value="<?php echo $instance['post_count']; ?>" />
      <span class="description"><?php _e('Enter the number of posts to display in right side.', 'stag'); ?></span>
    </p>

    <?php
  }
}

?>
