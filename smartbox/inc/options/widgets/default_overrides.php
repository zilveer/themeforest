<?php
/**
 * Default Widget Overrides
 *
 * @package Smartbox
 * @subpackage Frontend
 * @since 1.3
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license **LICENSE**
 * @version 1.5.8
 */

/* ------------------- OVERRIDE DEFAULT RECENT POSTS WIDGET ------------------*/

Class Custom_Recent_Posts_Widget extends WP_Widget_Recent_Posts {

    function widget($args, $instance) {

        extract( $args );

        $title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts', THEME_FRONT_TD) : $instance['title'], $instance, $this->id_base);

        if( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
            $number = 10;

        $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

        $r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
        if( $r->have_posts() ) :

            echo $before_widget;
            if( $title ) echo $before_title . $title . $after_title; ?>
            <ul>
                <?php while( $r->have_posts() ) : $r->the_post(); ?>
                <?php   if('link' == get_post_format()){
                            $post_link = oxy_get_external_link();
                        }
                        else{
                            $post_link = get_permalink();
                        }
                ?>
                <li><div class="row-fluid">
                        <div class="span3">
                            <div class="round-box box-mini box-colored">
                                <a class="box-inner" href="<?php echo $post_link ?>">
                                <?php
                                    if( has_post_thumbnail( get_the_ID() ) ) {
                                        the_post_thumbnail( 'portfolio-thumb', array( 'class' => 'img-circle' ) );
                                    }
                                    else {
                                        echo '<img class="img-circle" src="'.IMAGES_URI.'box-empty.gif">';
                                    }
                                    oxy_post_icon( get_the_ID() );
                                ?>
                                </a>
                            </div>
                        </div>
                        <div class="span9">
                            <h4>
                                <a href="<?php echo $post_link; ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                            </h4>
                            <h5 class="light">
                                <?php if($show_date) the_time( 'd F Y'); ?>
                            </h5>
                        </div>
                    </div>
                </li>
                <?php endwhile; ?>
            </ul>

            <?php
            echo $after_widget;

        wp_reset_postdata();

        endif;
    }
}

class Custom_Archives_Widget extends WP_Widget_Archives{

    function widget($args, $instance) {

        extract( $args );
        $c = ! empty( $instance['count'] ) ? '1' : '0';
        $d = ! empty( $instance['dropdown'] ) ? '1' : '0';
        $title = apply_filters('widget_title', empty($instance['title']) ? __('Archives', THEME_FRONT_TD) : $instance['title'], $instance, $this->id_base);

        echo $before_widget;
        if ( $title )
            echo $before_title . $title . $after_title;

        if ( $d ) {
?>
        <select name="archive-dropdown" onchange='document.location.href=this.options[this.selectedIndex].value;'> <option value=""><?php echo esc_attr(__('Select Month', THEME_FRONT_TD)); ?></option> <?php wp_get_archives(apply_filters('widget_archives_dropdown_args', array('type' => 'monthly', 'format' => 'option', 'show_post_count' => $c))); ?> </select>
<?php
        } else {
?>
        <ul>
        <?php wp_get_archives(apply_filters('widget_archives_args', array('type' => 'monthly', 'show_post_count' => $c , 'before'=> '<h4>' , 'after' => '</h4>'))); ?>
        </ul>
<?php
        }

        echo $after_widget;

    }
}


// replace default widgets
unregister_widget('WP_Widget_Recent_Posts');
register_widget('Custom_Recent_Posts_Widget');
unregister_widget('WP_Widget_Archives');
register_widget('Custom_Archives_Widget');