<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */


if( !class_exists( 'recent_comments' ) ) :
class recent_comments extends WP_Widget {

    function __construct(){

        unregister_widget( 'WP_Widget_Recent_Comments' );

        $widget_ops = array(
            'classname' => 'recent-comments',
            'description' => __( 'The most recent comments.', 'yit' )
        );

        $control_ops = array( 'id_base' => 'recent-comments' );

        WP_Widget::__construct( 'recent-comments', __( 'Recent Comments', 'yit' ), $widget_ops, $control_ops );
    }

    function form( $instance ) {

        $defaults = array(
            'title' => __( 'Recent Comments', 'yit' ),
            'number' => 5,
            'show_avatar' => 'yes',
            'show_author' => 'yes',
            'show_content' => 'yes',
            'excerpt_length' => 12
        );

        $instance = wp_parse_args( ( array ) $instance, $defaults ); ?>

		<p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'yit'); ?></label>
		    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of comments to show:', 'yit'); ?></label>
		    <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $instance['number']; ?>" size="3" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('show_avatar'); ?>"><?php _e('Show avatar:', 'yit'); ?></label>
		    <select id="<?php echo $this->get_field_id('show_avatar'); ?>" name="<?php echo $this->get_field_name('show_avatar'); ?>">
                <option value="yes"<?php selected( $instance['show_avatar'], 'yes' ) ?>><?php _e( 'Yes', 'yit' ) ?></option>
                <option value="no"<?php selected( $instance['show_avatar'], 'no' ) ?>><?php _e( 'No', 'yit' ) ?></option>
            </select>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('show_author'); ?>"><?php _e('Show author:', 'yit'); ?></label>
		    <select id="<?php echo $this->get_field_id('show_author'); ?>" name="<?php echo $this->get_field_name('show_author'); ?>">
                <option value="yes"<?php selected( $instance['show_author'], 'yes' ) ?>><?php _e( 'Yes', 'yit' ) ?></option>
                <option value="no"<?php selected( $instance['show_author'], 'no' ) ?>><?php _e( 'No', 'yit' ) ?></option>
            </select>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('show_content'); ?>"><?php _e('Show comment text:', 'yit'); ?></label>
		    <select id="<?php echo $this->get_field_id('show_content'); ?>" name="<?php echo $this->get_field_name('show_content'); ?>">
                <option value="yes"<?php selected( $instance['show_content'], 'yes' ) ?>><?php _e( 'Yes', 'yit' ) ?></option>
                <option value="no"<?php selected( $instance['show_content'], 'no' ) ?>><?php _e( 'No', 'yit' ) ?></option>
            </select>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('excerpt_length'); ?>"><?php _e('Comments text length:', 'yit'); ?></label>
		    <input id="<?php echo $this->get_field_id('excerpt_length'); ?>" name="<?php echo $this->get_field_name('excerpt_length'); ?>" type="text" value="<?php echo $instance['excerpt_length']; ?>" size="3" />
        </p>

		<?php
    }

    function widget( $args, $instance ) {

        extract( $args );

        $title = apply_filters( 'widget_title' , apply_filters( 'yit_recent_comments_widget_title', empty( $instance['title'] ) ? __( 'Recent comments', 'yit' ) : $instance['title'] ) );

        echo $before_widget;

        if ( $title ) echo $before_title . $title . $after_title;

        $defaults = array(
            'title' => __( 'Recent Comments', 'yit' ),
            'number' => 5,
            'show_avatar' => 'yes',
            'show_author' => 'yes',
            'show_content' => 'yes',
            'excerpt_length' => 12
        );

        $instance = wp_parse_args( (array) $instance, $defaults );

        $items  = $instance['number'];
        $avatar = $instance['show_avatar'];
        $author = $instance['show_author'];
        $content = $instance['show_content'];
        $excerpt_length = $instance['excerpt_length'];

        $comments = get_comments( array(
            'number' => $items,
            'type' => 'comment',
            'status' => 'approve',
        ) );



        ?><div class="recent-comments-list group"><?php

        foreach( $comments as $comment ) :

            $user = get_userdata( $comment->user_id );
            $comment_author_gravatar_mail = ( is_object( $user ) ) ? $user->data->user_email : $comment->comment_author_email; ?>

            <div class="comment-container">
                <div class="the-post group">

                <?php if ( $avatar == 'yes' ) : ?>
                    <div class="gravatar-wrapper">
                        <?php echo get_avatar( $comment, 46 ); ?>
                    </div>
                <?php endif ?>

                <div class="comments-info-wrapper">
                    <?php if ( $author == 'yes' ) : ?>
                        <span class="author">
                            <?php if ( ! empty( $comment->comment_author_url ) ) : ?>
                                <a class="url" href="<?php echo $comment->comment_author_url ?>">
                            <?php elseif ( ! empty( $comment_author_gravatar_mail ) ) : ?>
                                <a class="email" href="mailto:<?php echo $comment_author_gravatar_mail ?>">
                            <?php endif; ?>

                            <?php echo $comment->comment_author ?>
                                <?php if ( (! empty( $comment->comment_author_url ) && $comment->comment_author_url != '') || (! empty( $comment_author_gravatar_mail ) && $comment_author_gravatar_mail != '') ) : ?>
                                </a>
                            <?php endif; ?>
                            <?php _e( 'on', 'yit' ) ?>
                        </span>
                    <?php endif ?>
                    <a class="title" href="<?php echo get_permalink( $comment->comment_post_ID ) . '#comment-' . $comment->comment_ID ?>"><?php echo get_the_title( $comment->comment_post_ID ) ?></a>
                </div>
            </div>

            <?php if ( $content == 'yes' ) : ?>

                <p class="comment arrow">
                    <?php yit_excerpt_text( strip_tags( $comment->comment_content ), $excerpt_length, '...' ) ?>
                </p>

            <?php endif ?>
        </div>
        <?php endforeach;

        ?>
    </div>
        <?php

        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title'] );

		$instance['number'] = absint( $new_instance['number'] );

		$instance['show_avatar'] = $new_instance['show_avatar'];

		$instance['show_author'] = $new_instance['show_author'];

		$instance['show_content'] = $new_instance['show_content'];

		$instance['excerpt_length'] = absint( $new_instance['excerpt_length'] );

        return $instance;
    }

}
endif;