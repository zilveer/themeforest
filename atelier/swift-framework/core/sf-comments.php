<?php

    /*
    *
    *	Swift Framework Comments Functions
    *	------------------------------------------------
    *	Swift Framework v3.0
    * 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
    *
    *	sf_custom_comments()
    *	custom_pings()
    *
    */

    /* COMMENTS
    ================================================== */
    if ( ! function_exists( 'sf_custom_comments' ) ) {
        function sf_custom_comments( $comment, $args, $depth ) {
            $GLOBALS['comment']       = $comment;
            $GLOBALS['comment_depth'] = $depth;
            ?>
            <li id="comment-<?php comment_ID() ?>" <?php comment_class( 'clearfix' ) ?>>
            <div class="comment-wrap clearfix">
                <div class="comment-avatar">
                    <?php if ( function_exists( 'get_avatar' ) ) {
                        echo get_avatar( $comment, '100' );
                    } ?>
                    <?php if ( $comment->comment_author_email == get_the_author_meta( 'email' ) ) { ?>
                        <span class="tooltip"><?php _e( "Author", "swiftframework" ); ?>
                            <span class="arrow"></span>
                        </span>
                    <?php } ?>
                </div>
                <div class="comment-content">
                    <div class="comment-meta">
                        <?php
                            printf( '<span class="comment-author">%1$s</span> <span class="comment-date">%2$s</span>',
                                get_comment_author_link(),
                                human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) . ' ' . __( "ago", "swiftframework" )
                            );
                        ?>
                        <div class="comment-meta-actions">
                            <?php
                                edit_comment_link( __( 'Edit', 'swiftframework' ), '<span class="edit-link">', '</span><span class="meta-sep"> |</span>' );
                            ?>
                            <?php if ( $args['type'] == 'all' || get_comment_type() == 'comment' ) :
                                comment_reply_link( array_merge( $args, array(
                                    'reply_text' => __( 'Reply', 'swiftframework' ),
                                    'login_text' => __( 'Log in to reply.', 'swiftframework' ),
                                    'depth'      => $depth,
                                    'before'     => '<span class="comment-reply">',
                                    'after'      => '</span>'
                                ) ) );
                            endif; ?>
                        </div>
                    </div>
                    <?php if ( $comment->comment_approved == '0' ) _e( "\t\t\t\t\t<span class='unapproved'>Your comment is awaiting moderation.</span>\n", 'swiftframework' ) ?>
                    <div class="comment-body">
                        <?php comment_text() ?>
                    </div>
                </div>
            </div>
        <?php
        }
    } // end sf_custom_comments

    // Custom callback to list pings
    function custom_pings( $comment, $args, $depth ) {
        $GLOBALS['comment'] = $comment;
        ?>
    <li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
        <div class="comment-author"><?php printf( __( 'By %1$s on %2$s at %3$s', 'swiftframework' ),
                get_comment_author_link(),
                get_comment_date(),
                get_comment_time() );
                edit_comment_link( __( 'Edit', 'swiftframework' ), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?></div>
        <?php if ( $comment->comment_approved == '0' ) _e( '\t\t\t\t\t<span class="unapproved">Your trackback is awaiting moderation.</span>\n', 'swiftframework' ) ?>
        <div class="comment-content">
            <?php comment_text() ?>
        </div>
    <?php
    } // end custom_pings

?>