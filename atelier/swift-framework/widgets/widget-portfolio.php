<?php

    /*
    *
    *	Custom Portfolio Widget
    *	------------------------------------------------
    *	Swift Framework
    * 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
    *
    */

    // Register widget
    add_action( 'widgets_init', 'init_sf_recent_portfolio' );
    function init_sf_recent_portfolio() {
        return register_widget( 'sf_recent_portfolio' );
    }

    class sf_recent_portfolio extends WP_Widget {
    
        function __construct() {
            parent::__construct( 'sf_recent_custom_portfolio', $name = 'Swift Framework Recent Portfolio' );
        }

        function widget( $args, $instance ) {
            global $post;
            extract( $args );

            // Widget Options
            $title    = apply_filters( 'widget_title', $instance['title'] ); // Title
            $number   = $instance['number']; // Number of posts to show
            $category = $instance['category']; // Category to show

            if ( $category == "All" ) {
                $category = "all";
            }
            if ( $category == "all" ) {
                $category = '';
            }
            $category_slug = str_replace( '_', '-', $category );

            echo $before_widget;

            if ( $title ) {
                echo $before_title . $title . $after_title;
            }

            $video_icon = apply_filters( 'sf_video_icon' , '<i class="ss-video"></i>' );
            $audio_icon = apply_filters( 'sf_audio_icon' , '<i class="ss-music"></i>' );
            $picture_icon = apply_filters( 'sf_picture_icon' , '<i class="ss-picture"></i>' );

            $recent_portfolio = new WP_Query(
                array(
                    'post_type'          => 'portfolio',
                    'posts_per_page'     => $number,
                    'portfolio-category' => $category_slug,
                )
            );

            $thumb_width = apply_filters('sf_widget_portfolio_thumb_width', 94);
            $thumb_height = apply_filters('sf_widget_portfolio_thumb_height', 75);

            if ( $recent_portfolio->have_posts() ) :

                ?>

                <ul class="recent-posts-list">

                    <?php while ( $recent_portfolio->have_posts() ) : $recent_portfolio->the_post();

                        $thumb_type     = sf_get_post_meta( $post->ID, 'sf_thumbnail_type', true );
                        $post_title     = get_the_title();
                        $post_permalink = get_permalink();
                        $thumb_image    = get_post_thumbnail_id();
                        $thumb_img_url  = wp_get_attachment_url( $thumb_image, 'full' );
                        $image          = sf_aq_resize( $thumb_img_url, $thumb_width, $thumb_height, true, false );
                        $image_alt      = esc_attr( sf_get_post_meta( $thumb_image, '_wp_attachment_image_alt', true ) );
                        ?>
                        <li>
                            <a href="<?php echo esc_url($post_permalink); ?>" class="recent-post-image">
                                <?php if ( $image ) { ?>
                                    <img src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>"
                                         height="<?php echo esc_attr($image[2]); ?>" alt="<?php echo esc_attr($image_alt); ?>"/>
                                <?php } else if ( $thumb_type == "video" ) { ?>
                                    <?php echo $video_icon; ?>
                                <?php } else if ( $thumb_type == "audio" ) { ?>
                                    <?php echo $audio_icon; ?>
                                <?php } else { ?>
                                    <?php echo $picture_icon; ?>
                                <?php } ?>
                            </a>

                            <div class="recent-post-details">
                                <a class="recent-post-title" href="<?php echo esc_url($post_permalink); ?>"
                                   title="<?php echo esc_attr($post_title); ?>"><?php echo $post_title; ?></a>
                            </div>
                        </li>

                        <?php 
                        	endwhile;
                        	wp_reset_postdata();
                        ?>
                </ul>

            <?php endif; ?>

            <?php

            echo $after_widget;
        }

        /* Widget control update */
        function update( $new_instance, $old_instance ) {
            $instance = $old_instance;

            $instance['title']    = strip_tags( $new_instance['title'] );
            $instance['number']   = strip_tags( $new_instance['number'] );
            $instance['category'] = strip_tags( $new_instance['category'] );

            return $instance;
        }

        /* Widget settings */
        function form( $instance ) {

            // Set defaults if instance doesn't already exist
            if ( $instance ) {
                $title    = $instance['title'];
                $number   = $instance['number'];
                $category = $instance['category'];
            } else {
                // Defaults
                $title    = '';
                $number   = '5';
                $category = '';
            }

            // The widget form
            ?>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php echo __( 'Title:', 'swiftframework' ); ?></label>
                <input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"
                       name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>"
                       class="widefat"/>
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php echo __( 'Number of items to show:', 'swiftframework' ); ?></label>
                <input id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"
                       name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="text"
                       value="<?php echo esc_attr($number); ?>" size="3"/>
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'category' )); ?>"><?php _e( 'Category', 'swiftframework' ); ?></label>
                <select name="<?php echo esc_attr($this->get_field_name( 'category' )); ?>"
                        id="<?php echo esc_attr($this->get_field_id( 'category' )); ?>" class="">
                    <?php
                        $options = sf_get_category_list( 'portfolio-category' );
                        foreach ( $options as $option ) {
                            echo '<option value="' . $option . '" id="' . $option . '"', $category == $option ? ' selected="selected"' : '', '>', $option, '</option>';
                        }
                    ?>
                </select>
            </p>
            </p>
        <?php
        }

    }

?>