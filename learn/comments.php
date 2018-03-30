<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains comments and the comment form.
/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() || is_singular('lesson') )
    return;
?>
<?php if ( have_comments() ) : ?>

<div id="comments">
    <ol class="commentlist">
                <?php wp_list_comments('callback=learn_theme_comment'); ?>
            <?php
                // Are there comments to navigate through?
                if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
            ?>
                <nav class="navigation comment-navigation" role="navigation">          
                    <div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'learn' ) ); ?></div>
                    <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'learn' ) ); ?></div>
                </nav><!-- .comment-navigation -->
            <?php endif; // Check for comment navigation ?>

            <?php if ( ! comments_open() && get_comments_number() ) : ?>
                <p class="no-comments"><?php esc_html_e( 'Comments are closed.' , 'learn' ); ?></p>
            <?php endif; ?> 
    </ol>
</div>     
<?php endif; ?>

<div class="commentsform">
    <div id="addcomments">
        <div id="respond" class="comment-respond">
        <?php
            if( is_singular('course') ) { $title_comment = esc_html__('Add a review','learn'); }else{ $title_comment = esc_html__('Leave a comment','learn'); }
            if ( is_singular() ) wp_enqueue_script( "comment-reply" );

                $aria_req = ( $req ? " aria-required='true'" : '' );
                $comment_args = array(
                    'id_form' => 'commentform',                     
                    'title_reply'=> $title_comment,
                    'fields' => apply_filters( 'comment_form_default_fields', array(
                        'author' => '<p class="comment-form-author"><input id="author" class="form-control" name="author" type="text" value="" placeholder="'.esc_html__('Enter Name', 'learn').'" size="30"/></p>',
                        'email' => '<p class="comment-form-email"><input id="email" class="form-control" name="email" type="email" value="" placeholder="'.esc_html__('Enter Email', 'learn').'" size="30"/></p>', 
                    ) ),                                
                    'comment_field' => '<p class="comment-form-comment"><textarea id="comment" class="form-control" name="comment" placeholder="'.esc_html__('Message...', 'learn').'" cols="45" rows="8"></textarea></p>',                                                   
                    'label_submit' => esc_html__( 'Post Comment', 'learn' ),
                    'comment_notes_before' => '<p class="comment-notes"><span id="email-notes">Your email address will not be published.</span> Required fields are marked <span class="required">*</span></p>',
                    'comment_notes_after' => '',
                )
            ?>
            <?php comment_form($comment_args); ?>
        </div>
    </div>
</div><!-- //LEAVE A COMMENT -->
                