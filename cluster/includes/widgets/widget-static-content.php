<?php
add_action('widgets_init', create_function('', 'return register_widget("stag_widget_static_content");'));

class stag_widget_static_content extends WP_Widget{
    function __construct(){
        $widget_ops = array('classname' => 'static-content', 'description' => __('Displays content from a specific page.', 'stag'));
        $control_ops = array('width' => 300, 'height' => 350, 'id_base' => 'stag_widget_static_content');
        parent::__construct('stag_widget_static_content', __('Homepage: Static Content', 'stag'), $widget_ops, $control_ops);
    }

    function widget($args, $instance){
        extract($args);

        // VARS FROM WIDGET SETTINGS
        $title = apply_filters('widget_title', $instance['title'] );
        $subtitle = $instance['subtitle'];
        $page = $instance['page'];

        echo $before_widget;

        $the_page = get_page($page);

        $query_args = array(
            'page_id' => $page,
            'post_status' => 'any'
        );

        $query = new WP_Query($query_args);

        while ( $query->have_posts() ) : $query->the_post();

    ?>

        <article <?php post_class(); ?>>
            <?php
                if($title != '') echo $before_title. $title . $after_title;
                if(!empty($subtitle)) echo "\n\t<p class='subtitle'>{$subtitle}</p>";
            ?>
            <div class="entry-content">
                <?php
                    global $more;
                    $more = false;
                    the_content( __('Continue Reading', 'stag') );
                    wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'stag').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number'));
                ?>
            </div>
        </article>

        <?php

        endwhile;

        echo $after_widget;

    }

    function update($new_instance, $old_instance){
        $instance = $old_instance;

        // STRIP TAGS TO REMOVE HTML
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['subtitle'] = strip_tags($new_instance['subtitle']);
        $instance['page'] = strip_tags($new_instance['page']);

        return $instance;
    }

    function form($instance){
        $defaults = array(
            /* Deafult options goes here */
            'page' => 0,
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
      <label for="<?php echo $this->get_field_id('page'); ?>"><?php _e('Select Page:', 'stag'); ?></label>

      <select id="<?php echo $this->get_field_id( 'page' ); ?>" name="<?php echo $this->get_field_name( 'page' ); ?>" class="widefat">
      <?php

        $args = array(
          'sort_order' => 'ASC',
          'sort_column' => 'post_title',
          );
        $pages = get_pages($args);

        foreach($pages as $paged){ ?>
          <option value="<?php echo $paged->ID; ?>" <?php if($instance['page'] == $paged->ID) echo "selected"; ?>><?php echo $paged->post_title; ?></option>
        <?php }

       ?>
     </select>
     <span class="description">This page will be used to display static content.</span>
    </p>

    <?php
  }
}

?>
