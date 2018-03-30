<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to ishyoboy_comments() which is
 * located in the functions.php file.
 *
 */

// ##########  Do not delete these lines
if ( isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ('Please do not load this page directly. Thanks!');
}

if ( have_comments() && post_password_required() ) { ?>
    <p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'ishyoboy'); ?></p>
<?php
    return;
}
// ##########  End do not delete section

// Display Comments Section
if ( have_comments() ) { ?>
    <h4 class="lined-section" id="comments"><?php comments_number( __('No comments yet', 'ishyoboy'), __('1 Comment', 'ishyoboy'), __('% Comments', 'ishyoboy') ); ?><span></span></h4>

    <ul class="blog-comments">
        <?php
        wp_list_comments(array(
            // see http://codex.wordpress.org/Function_Reference/wp_list_comments
            'login_text'        => 'Login to reply',
            'callback'          => 'ishyoboy_comments',
            'type'              => 'comment'
        ));
        ?>
    </ul>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
        <!--
        <nav id="comment-nav-below" class="pagination" role="navigation">
            <div class="nav-previous"><?php previous_comments_link( __( '&lt; Previous Page', 'ishyoboy' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Next page &gt;', 'ishyoboy' ) ); ?></div>
        </nav>
        -->

        <?php
        echo '<div class="pagination">';
        paginate_comments_links(array(
            //'base'         => '%_%',
            //'format'       => '?page=%#%',
            //'total'        => 1,
            //'current'      => 0,
            'show_all'     => False,
            'end_size'     => 1,
            'mid_size'     => 2,
            'prev_next'    => True,
            'prev_text'    => __( '&lt; Previous', 'ishyoboy' ),
            'next_text'    => __( 'Next &gt;', 'ishyoboy' ),
            'type'         => 'plain',
            'add_args'     => False,
            'add_fragment' => ''
        ));
        echo '</div>';

        ?>
    <?php endif; // check for comment navigation ?>

    <?php
        if ( ! comments_open() ) : // There are comments but comments are now closed
            echo'<p class="nocomments">' . __('Comments are closed.' , 'ishyoboy') . '</p><div class="space"></div>';

        endif;
    ?>

<?php }else { // I.E. There are no Comments
    if ( comments_open() ) : // Comments are open, but there are none yet
        // echo"<p>Be the first to write a comment.</p>";
    else : // comments are closed
        //echo'<h4 class="lined-section">' . __('Comments' , 'ishyoboy') . '<span></span></h4><p class="nocomments">' . __('Comments are closed.' , 'ishyoboy') . '</p>';
    endif;

}?>

<?php if ( comments_open() ) : ?>
    <div>
        <?php

        // @TODO: WP: Comments pop-up
        ishyoboy_comment_form( array(
            'fields'               => apply_filters( 'comment_form_default_fields', array(
                    'author' => '<p><label><input type="text" placeholder="' . __( 'Your name *', 'ishyoboy') . '" class="required" name="author" id="author"></label></p>',
                    'email'  => '<p><label><input type="text" placeholder="' . __( 'Your email *', 'ishyoboy') . '" class="required email" name="email" id="email"></label></p>',
                    'url'    => '<p><label><input type="text" placeholder="' . __( 'Your web page', 'ishyoboy') . '" name="url" id="url"></label></p>'
                )

            ),
            'comment_field'        => '<p><label><textarea class="required" placeholder="' . __( 'Your comment *', 'ishyoboy') . '" name="comment" id="comment"></textarea></label></p>',
            'comment_notes_before' => '',
            'comment_notes_after'  => '',
            //'comment_notes_after'  => '</div><p class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>',
            'submit_button_before' => '<p class="aright">',
            'submit_button_after'  => '</p>',
            'id_form'              => 'commentform',
            'id_submit'            => 'submit',
            'class_form'           => 'validate clearfix',
            'class_submit'         => 'btn-big',
            'title_reply'          => '<h4 class="lined-section" id="respond">' . __( 'Add comment', 'ishyoboy' ) . '<span></span></h4>',
            'title_reply_to'       => '<h4 class="lined-section" id="respond">' . __( 'Add a reply', 'ishyoboy' ) . '<span></span></h4>',
            'cancel_reply_link'    => __( 'Cancel a reply', 'ishyoboy' ),
            'label_submit'         => __( 'Send', 'ishyoboy' )
        ));
        ?>
        <div class="space"></div>
    </div>

<?php endif; ?>