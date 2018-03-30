<?php

// http://shinraholdings.com/621/custom-walker-to-extend-the-walker_comment-class/

class lsvr_walker_comment extends Walker_Comment {

    // init classwide variables
    var $tree_type = 'comment';
    var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );

    /** START_LVL
     * Starts the list before the CHILD elements are added. */
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $GLOBALS['comment_depth'] = $depth + 1; ?>

        <ul class="comment-list children">

    <?php }

    /** END_LVL
     * Ends the children list of after the elements are added. */
    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $GLOBALS['comment_depth'] = $depth + 1; ?>

        </ul><!-- /.children -->

    <?php }

    /** START_EL */

    function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
        $depth++;
        $GLOBALS['comment_depth'] = $depth;
        $GLOBALS['comment'] = $comment;
        $parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' );
        if ( (bool) get_option( 'show_avatars' ) ) { $parent_class .= ' has-avatar'; } ?>

        <li <?php comment_class( $parent_class ); ?> id="comment-<?php comment_ID() ?>">

			<div class="comment-inner<?php if ( get_avatar( 'show_avatars' ) ){ echo ' has-portrait'; } ?>">
				<div class="comment-portrait"><?php echo ( $args['avatar_size'] != 0 ? get_avatar( $comment, $args['avatar_size'] ) :'' ); ?></div>
				<h4 class="comment-author m-secondary-font"><?php echo get_comment_author_link(); ?></h4>
				<div id="comment-content-<?php comment_ID(); ?>" class="comment-content various-content">
					<?php if( !$comment->comment_approved ) : ?>
						<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation', 'beautyspot' ); ?> </em>
					<?php else: wpautop( comment_text() ); ?>
					<?php endif; ?>
				</div>
				<div class="comment-info">
					<div class="comment-date"><a href="<?php echo htmlspecialchars( get_comment_link( get_comment_ID() ) ) ?>"><?php comment_date( 'M j, Y' ); ?></a></div>
					<?php $reply_args = array(
						'depth' => $depth,
						'before' => '<div class="comment-reply">',
						'after' => '</div>',
						'reply_text' => $args['reply_text'],
						'max_depth' => $args['max_depth'] );
					comment_reply_link( $reply_args ); ?>
					<?php edit_comment_link( __( 'Edit', 'beautyspot' ), '<div class="comment-edit">', '</div>' ); ?>
				</div>
			</div>

    <?php }

    function end_el(&$output, $comment, $depth = 0, $args = array() ) { ?>

        </li>

    <?php }

}