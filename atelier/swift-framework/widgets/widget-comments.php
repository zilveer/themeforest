<?php

    /*
    *
    *	Custom Comments Widget
    *	------------------------------------------------
    *	Swift Framework
    * 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
    *
    */

    // Register widget
    add_action( 'widgets_init', 'init_sf_recent_comments' );
    function init_sf_recent_comments() {
        return register_widget( 'sf_recent_comments' );
    }

    class sf_recent_comments extends WP_Widget {
        
        function __construct() {
            parent::__construct( 'sf_recent_custom_comments', $name = 'Swift Framework Recent Comments' );
        }

        function widget( $args, $instance ) {
            global $post;
            extract( $args );

            // Widget Options
            $title  = apply_filters( 'widget_title', $instance['title'] ); // Title
            $number = $instance['number']; // Number of posts to show

            echo $before_widget;

            if ( $title ) {
                echo $before_title . $title . $after_title;
            }

            $args = array(
                'number' => $number,
                'status' => 'approve'
            );

            $comments = get_comments( $args );

            if ( $comments ) :

                ?>

                <ul class="recent-comments-list">

                    <?php foreach ( $comments as $comment ) : ?>
                        <li class="comment">
                            <div class="comment-wrap clearfix">
                                <div class="comment-avatar">
                                    <?php if ( function_exists( 'get_avatar' ) ) {
                                        echo get_avatar( $comment, '100' );
                                    } ?>
                                </div>
                                <div class="comment-content">
                                    <div class="comment-meta">
                                        <?php
                                            $comment_date = mysql2date( 'U', $comment->comment_date );

                                            printf( '<span class="comment-author">%1$s</span> <span class="comment-date">%2$s</span>',
                                                $comment->comment_author,
                                                human_time_diff( $comment_date, current_time( 'timestamp' ) ) . ' ' . __( "ago", "swiftframework" )
                                            );
                                        ?>
                                    </div>
                                    <div class="comment-body">
                                        <?php
                                            $length       = 60;
                                            $comment_text = $comment->comment_content;
                                            if ( strlen( $comment_text ) > $length ) {
                                                $comment_text = substr( $comment_text, 0, $length );
                                                $comment_text = $comment_text . ' ...';
                                            }
                                        ?>
                                        <a href="<?php echo get_comments_link( $comment->comment_post_ID ); ?>"><?php echo apply_filters( 'the_content', $comment_text ); ?></a>
                                    </div>
                                </div>
                            </div>
                        </li>

                    <?php endforeach; ?>

                </ul>

            <?php endif; ?>

            <?php

            echo $after_widget;
        }

        /* Widget control update */
        function update( $new_instance, $old_instance ) {
            $instance = $old_instance;

            $instance['title']  = strip_tags( $new_instance['title'] );
            $instance['number'] = strip_tags( $new_instance['number'] );

            return $instance;
        }

        /* Widget settings */
        function form( $instance ) {

            // Set defaults if instance doesn't already exist
            if ( $instance ) {
                $title  = $instance['title'];
                $number = $instance['number'];
            } else {
                // Defaults
                $title  = '';
                $number = '5';
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
                    for="<?php echo $this->get_field_id( 'number' ); ?>"><?php echo __( 'Number of posts to show:', 'swiftframework' ); ?></label>
                <input id="<?php echo $this->get_field_id( 'number' ); ?>"
                       name="<?php echo $this->get_field_name( 'number' ); ?>" type="text"
                       value="<?php echo $number; ?>" size="3"/>
            </p>
        <?php
        }

    }

?>