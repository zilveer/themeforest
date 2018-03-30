<?php
require_once(ABSPATH . WPINC. '/default-widgets.php');

function Artbees_recent_comments() {
    unregister_widget("WP_Widget_Recent_Comments");
    register_widget("Artbees_WP_Widget_Recent_Comments");
}
add_action("widgets_init", "Artbees_recent_comments");

class Artbees_WP_Widget_Recent_Comments extends WP_Widget_Recent_Comments {


    function widget( $args, $instance ) {
        global $comments, $comment;

        $cache = wp_cache_get('widget_recent_comments', 'widget');

        if ( ! is_array( $cache ) )
            $cache = array();

        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;

        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo $cache[ $args['widget_id'] ];
            return;
        }

         extract($args, EXTR_SKIP);
         $output = '';
        $title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );

        if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
             $number = 5;

        $comments = get_comments( apply_filters( 'widget_comments_args', array( 'number' => $number, 'status' => 'approve', 'post_status' => 'publish', 'type' => 'comment' ) ) );
        $output .= $before_widget;
        if ( $title )
            $output .= $before_title . $title . $after_title;

        $output .= '<ul class="mk-recent-comments" id="recentcomments">';
        if ( $comments ) {
            // Prime cache for associated posts. (Prime post term cache if we need it for permalinks.)
            $post_ids = array_unique( wp_list_pluck( $comments, 'comment_post_ID' ) );
            _prime_post_caches( $post_ids, strpos( get_option( 'permalink_structure' ), '%category%' ), false );

            foreach ( (array) $comments as $comment) {
                $output .= '<li class="recentcomments">';
                $output .= '<span class="comment-avatar">'. get_avatar($comment->comment_author_email, 50). '</span>';
                $output .= '<div class="comment-detail"><div class="comment-author">'. get_comment_author_link(). '</div>';
                $output .= '<p class="comment-content">'.trim(mb_substr(strip_tags($comment->comment_content), 0, 50)). '.</p>';
                $output .= '</div></li>';

            }
         }
        $output .= '</ul>';
        $output .= $after_widget;

        echo $output;
        $cache[$args['widget_id']] = $output;
        wp_cache_set('widget_recent_comments', $cache, 'widget');
    }

}
?>