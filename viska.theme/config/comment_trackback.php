<?php


function viska_get_comment_reply_link($args = array(), $comment = null, $post = null) {

    $defaults = array(
        'add_below'  => 'comment',
        'respond_id' => 'respond',
        'reply_text' => __('Reply',LANGUAGE),
        'login_text' => __('Log in to Reply',LANGUAGE),
        'depth'      => 0,
        'before'     => '',
        'after'      => ''
    );

    $args = wp_parse_args($args, $defaults);

    if ( 0 == $args['depth'] || $args['max_depth'] <= $args['depth'] )
        return;

    extract($args, EXTR_SKIP);

    $comment = get_comment($comment);
    if ( empty($post) )
        $post = $comment->comment_post_ID;
    $post = get_post($post);

    if ( !comments_open($post->ID) )
        return false;

    $link = '';

    if ( get_option('comment_registration') && ! is_user_logged_in() )
        $link = '<a rel="nofollow" class="comment-reply-login" href="' . esc_url( wp_login_url( get_permalink() ) ) . '">' . $login_text . '</a>';
    else
        $link = "<a class='comment-reply-link reply-comment' href='" . esc_url( add_query_arg( 'replytocom', $comment->comment_ID ) ) . "#" . $respond_id . "' onclick='return addComment.moveForm(\"$add_below-$comment->comment_ID\", \"$comment->comment_ID\", \"$respond_id\", \"$post->ID\")'><span class=\"icon md-lineart_reply\"></span>$reply_text</a>";

    /**
     * Filter the comment reply link.
     *
     * @since 2.7.0
     *
     * @param string  $link    The HTML markup for the comment reply link.
     * @param array   $args    An array of arguments overriding the defaults.
     * @param object  $comment The object of the comment being replied.
     * @param WP_Post $post    The WP_Post object.
     */
    return apply_filters( 'viska_comment_reply_link', $before . $link . $after, $args, $comment, $post );
}
function viska_comment_reply_link($args = array(), $comment = null, $post = null){
    echo viska_get_comment_reply_link($args,$comment,$post);
}

function list_pings($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    ?>
<li id="comment-<?php comment_ID(); ?>"><i class="icon icon-share-alt"></i>&nbsp;<?php comment_author_link(); ?>
<?php

}

class viska_walker_comment extends Walker_Comment {
    
    // init classwide variables
    var $tree_type = 'comment';
    var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );

    /** CONSTRUCTOR
     * You'll have to use this if you plan to get to the top of the comments list, as
     * start_lvl() only goes as high as 1 deep nested comments */
    function __construct() { ?>
        
        <h2 id="comments-title" class="title-right-blog" ><?php comments_number(__("Comment",LANGUAGE) .'' . __("(0)",LANGUAGE) . '', __("Comment",LANGUAGE) .'' . __("(1)",LANGUAGE) . '', __("Comments",LANGUAGE) .'(%)' );?></h2>
        
    <?php }
    
    /** START_LVL 
     * Starts the list before the CHILD elements are added. Unlike most of the walkers,
     * the start_lvl function means the start of a nested comment. It applies to the first
     * new level under the comments that are not replies. Also, it appear that, by default,
     * WordPress just echos the walk instead of passing it to &$output properly. Go figure.  */
    function start_lvl( &$output, $depth = 0, $args = array() ) {       
        $GLOBALS['comment_depth'] = $depth + 1; ?>
    <?php }

    /** END_LVL 
     * Ends the children list of after the elements are added. */
    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $GLOBALS['comment_depth'] = $depth + 1; ?>
    <?php }
    
    /** START_EL */
    function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
        $depth++;
        $GLOBALS['comment_depth'] = $depth;
        $GLOBALS['comment'] = $comment; 
        $parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' ); ?>
        <div class="comment-item" id="comment-<?php comment_ID() ?>">
            <div class="img-comment">
                <?php echo ( $args['avatar_size'] != 0 ? get_avatar( $comment, $args['avatar_size'] ) :'' ); ?>
            </div><!-- /.comment-author -->
            <span class="user-comment"><?php echo get_comment_author_link(); ?></span>
            <span class="date-comment"><?php comment_time('F j, Y \A\T  g:i A'); ?><?php edit_comment_link( '(Edit)' ); ?></span>
                <div id="comment-content-<?php comment_ID(); ?>" class="detail-comment">
                    <?php if( !$comment->comment_approved ) : ?>
                    <em class="comment-awaiting-moderation">Your comment is awaiting moderation.</em>
                    <?php else: comment_text(); ?>
                    <?php endif; ?>

                </div><!-- /.comment-content -->
            <?php viska_comment_reply_link( array_merge( $args, array( 'add_below' => 'comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            <div class="clear"></div>

    <?php }

    function end_el(&$output, $comment, $depth = 0, $args = array() ) { ?>
        
        </div><!-- /#comment-' . get_comment_ID() . ' -->
        
    <?php }
    
    /** DESTRUCTOR
     * I just using this since we needed to use the constructor to reach the top 
     * of the comments list, just seems to balance out :) */
    function __destruct() { ?>
    
    <!-- /#comment-list -->

    <?php }
}