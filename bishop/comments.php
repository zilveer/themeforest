<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/*
Template Name: Comments
*/


if( YIT_Request()->is_ajax && isset( $_REQUEST['post_id'] ) ){
    global $post, $wp_query, $wp_the_query, $withcomments;

    $comments = get_comments( array(
        'post_id' => $post->ID,
        'orderby' => 'comment_date_gmt',
        'status' => 'approve',
        )
    );

    $wp_query->comments      = $comments;
    $wp_query->comment_count = count($comments);
}



if ( post_password_required() ) {
    return;
}

if( pings_open() ) {
    yit_get_template( 'comments/trackbacks.php' );
}

?>

<?php if ( have_comments() ) : ?>
    <div id="comments" class="comments-area">

        <h3 class="comments-title">
            <?php
            printf( _n( 'One comment', '%1$s comments', get_comments_number(), 'yit' ), number_format_i18n( get_comments_number() ) );
            ?>
        </h3>

        <ol class="comment-list">
            <?php
            $wp_list_comments = wp_list_comments( array(
                'style'      => 'ol',
                'short_ping' => true,
                'echo'       => true,
                'callback'   => 'yit_list_comments'
            ) );
            ?>

        </ol>

        <?php yit_get_template( 'comments/paginations.php' ) ?>
    </div><!-- #comments -->
<?php endif; // have_comments() ?>

<?php

$fields = array(
      'author' =>
        '<div class="row">' .
        '<p class="comment-form-author col-sm-4"><label for="author">' . __( 'Name', 'yit' ) . ' *</label> ' .
        '<input id="author" name="author" type="text" value="" size="30" required /></p>',

      'email' =>
        '<p class="comment-form-email col-sm-4"><label for="email">' . __( 'Email', 'yit' ) . ' *</label> ' .
        '<input id="email" name="email" type="text" value="" size="30" required /></p>',

      'url' =>
        '<p class="comment-form-url col-sm-4"><label for="url">' . __( 'Website', 'yit' ) . '</label>' .
        '<input id="url" name="url" type="text" value="" size="30" /></p>' .
        '</div>'
    );


$args = array(
    'title_reply'           => __( 'Leave a Reply' ,  'yit' ),
    'title_teply_to'        => __( 'Leave a Reply to %s', 'yit' ),
    'label_submit'          => __( 'Leave a Reply' ,  'yit' ),
    'cancel_reply_link'     => __( 'Cancel Reply', 'yit' ),
    'comment_notes_after'   => '',
    'comment_notes_before'  => '',
    'fields'                => $fields
);
?>

<?php
    comment_form( $args );
    wp_reset_query();
?>


