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
    add_action( 'widgets_init', 'init_sf_portfolio_grid' );
    function init_sf_portfolio_grid() {
        return register_widget( 'sf_portfolio_grid' );
    }

    class sf_portfolio_grid extends WP_Widget {
    
        function __construct() {
            parent::__construct( 'sf_custom_portfolio_grid', $name = 'Swift Framework Portfolio Grid' );
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

            $recent_portfolio = new WP_Query(
                array(
                    'post_type'          => 'portfolio',
                    'posts_per_page'     => $number,
                    'portfolio-category' => $category_slug,
                )
            );

            $count = 0;

            if ( $recent_portfolio->have_posts() ) :

                ?>

                <ul class="portfolio-grid">

                    <?php while ( $recent_portfolio->have_posts() ) : $recent_portfolio->the_post();

                        $post_title     = get_the_title();
                        $post_permalink = get_permalink();

                        $thumb_image = rwmb_meta( 'sf_thumbnail_image', 'type=image&size=full' );
                        foreach ( $thumb_image as $detail_image ) {
                            $thumb_img_url = $detail_image['url'];
                            break;
                        }

                        if ( ! $thumb_image ) {
                            $thumb_image   = get_post_thumbnail_id();
                            $thumb_img_url = wp_get_attachment_url( $thumb_image, 'full' );
                        }

                        $image     = sf_aq_resize( $thumb_img_url, 85, 85, true, false );
                        $image_alt = esc_attr( sf_get_post_meta( $thumb_image, '_wp_attachment_image_alt', true ) );
                        ?>
                        <?php if ( $image ) { ?>
                            <li class="grid-item-<?php echo $count; ?>">
                                <a href="<?php echo $post_permalink; ?>" class="grid-image">
                                    <img src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>"
                                         height="<?php echo $image[2]; ?>" alt="<?php echo $image_alt; ?>"/>
                                    <span class="tooltip"><?php echo $post_title; ?><span class="arrow"></span></span>
                                </a>
                            </li>
                        <?php } ?>

                        <?php $count ++;
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
                <label
                    for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo __( 'Title:', 'swiftframework' ); ?></label>
                <input id="<?php echo $this->get_field_id( 'title' ); ?>"
                       name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>"
                       class="widefat"/>
            </p>
            <p>
                <label
                    for="<?php echo $this->get_field_id( 'number' ); ?>"><?php echo __( 'Number of items to show:', 'swiftframework' ); ?></label>
                <input id="<?php echo $this->get_field_id( 'number' ); ?>"
                       name="<?php echo $this->get_field_name( 'number' ); ?>" type="text"
                       value="<?php echo $number; ?>" size="3"/>
            </p>
            <p>
                <label
                    for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category', 'swiftframework' ); ?></label>
                <select name="<?php echo $this->get_field_name( 'category' ); ?>"
                        id="<?php echo $this->get_field_id( 'category' ); ?>" class="">
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