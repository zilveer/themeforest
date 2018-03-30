<?php
add_action('widgets_init', 'cs_recent_post_widgets'); 

function cs_recent_post_widgets() {
    register_widget('CS_Recent_Post_Widget_V2');
}

class CS_Recent_Post_Widget_V2 extends WP_Widget {

    function CS_Recent_Post_Widget_V2() {
        parent::__construct(
                'cs_recent_post_v2', __('CS Recent Posts V2',THEMENAME), array('description' => __('Recent Posts Widget.', THEMENAME),)
        );
    }

    function widget($args, $instance) {
        extract($args);

        $title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts', THEMENAME ) : $instance['title'], $instance, $this->id_base);
        $show_image = (int) $instance['show_image'];
        $show_date = (int) $instance['show_date'];
        $show_author = (int) $instance['show_author'];
        $number = (int) $instance['number'];

        $sticky = get_option('sticky_posts');
        $args = array(
            'posts_per_page' => $number,
            'post_type' => 'post',
            'post_status' => 'publish',
            'post__not_in'  => $sticky,
            'orderby' => 'date',
            'order' => 'DESC',
            'paged' => 1
        );
        $wp_query = new WP_Query($args);
        $extra_class = !empty($instance['extra_class']) ? $instance['extra_class'] : "";

        // no 'class' attribute - add one with the value of width
        if( strpos($before_widget, 'class') === false ) {
            $before_widget = str_replace('>', 'class="'. $extra_class . '"', $before_widget);
        }
        // there is 'class' attribute - append width value to it
        else {
            $before_widget = str_replace('class="', 'class="'. $extra_class . ' ', $before_widget);
        }

        echo $before_widget;
        ?>
        <div class="heading">
        <?php echo $before_title . cshero_custom_title_widget($title) . $after_title; ?>
        </div>
        <?php if ($wp_query->have_posts()){ ?>
                <div class="cs-recent-post">
                    <ul class="list-unstyled">
                        <?php while ($wp_query->have_posts()): $wp_query->the_post(); $cls1 = $cls2 ='';?>
                            <li <?php echo ($show_image) ? 'class="has-thumb row"' : '' ?>>
                                <?php if ($show_image) : 
                                    $cls1 .= 'col-xs-3 col-sm-3 col-md-3 col-lg-3 nopaddingright';
                                    $cls2 .= 'col-xs-9 col-sm-9 col-md-9 col-lg-9';
                                ?>
                                <div class="cs-media <?php echo $cls1;?>">  
                                   <div class="image">
                                    <?php if(has_post_thumbnail() && wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false)) {?>
                                       <a class="post-featured-img" href="<?php the_permalink(); ?>">
                                          <?php the_post_thumbnail('thumbnail'); ?>
                                       </a>
                                   <?php } else {
                                        echo '<a class="post-featured-img" href="'.get_the_permalink().'">';
                                        echo '<img alt="" src="'.get_template_directory_uri().'/assets/images/no-image.jpg" />';
                                        echo '</a>';
                                    } ?>
                                    </div>     
                                 </div>
                                <?php endif; ?> 
                                <div class="cs-details <?php echo $cls2;?>">
                                    <h6 style="margin-bottom:0;"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
                                    <div class="cs-recent-post-meta">
                                        <?php if ($show_date) { ?>
                                        <small class="date">  
                                           <?php echo get_the_date('M d Y'); ?>
                                        </small>
                                        <?php }?>
                                        <?php if ($show_author) { ?>
                                            <small class="author">
                                                <?php _e('| By', THEMENAME); ?> <?php the_author(); ?>
                                            </small>
                                        <?php  } ?>    
                                    </div>
                                </div>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            <?php } else { ?>
                <span class="notfound">No post found!</span>
            <?php
            }
        echo $after_widget;
        wp_reset_postdata();
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['title'] = $new_instance['title'];
        $instance['show_image'] = $new_instance['show_image'];
        $instance['show_date'] = $new_instance['show_date'];
        $instance['show_author'] = $new_instance['show_author'];
        $instance['number'] = (int) $new_instance['number'];
        $instance['extra_class'] = $new_instance['extra_class'];

        return $instance;
    }

    function form($instance) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $show_image = isset($instance['show_image']) ? esc_attr($instance['show_image']) : '';
        $show_date = isset($instance['show_date']) ? esc_attr($instance['show_date']) : '';
        $show_author = isset($instance['show_author']) ? esc_attr($instance['show_author']) : '';
        if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
                     $number = 5;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'woocommerce' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('show_image'); ?>"><?php _e( 'Show Image:', THEMENAME ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('show_image') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_image') ); ?>" <?php if($show_image!='') echo 'checked="checked";' ?> type="checkbox" value="1"  />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('show_date'); ?>"><?php _e( 'Show date:', THEMENAME ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('show_date') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_date') ); ?>" <?php if($show_date!='') echo 'checked="checked";' ?> type="checkbox" value="1"  />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('show_author'); ?>"><?php _e( 'Show Author:', THEMENAME ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('show_author') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_author') ); ?>" <?php if($show_author!='') echo 'checked="checked";' ?> type="checkbox" value="1" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of products to show:', 'woocommerce' ); ?></label>
            <input id="<?php echo esc_attr( $this->get_field_id('number') ); ?>" name="<?php echo esc_attr( $this->get_field_name('number') ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="3" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('extra_class'); ?>">Extra Class:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('extra_class'); ?>" name="<?php echo esc_attr($this->get_field_name('extra_class')); ?>" value="<?php if(isset($instance['extra_class'])){echo esc_attr($instance['extra_class']);} ?>" />
        </p>
        <?php
    }
}
?>