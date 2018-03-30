<?php
if ( post_password_required() ) {
    return;
}
?>
<div id="comments" class="comments-area">

    <?php if ( have_comments() ) { ?>
    <div class="centered gap fade-down section-heading no-display animated fadeInDown appear">
        <h2 class="main-title">Leave A Comment</h2>
        <hr>
        <p><?php
        printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'bold' ),
            number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
            ?></p>
    </div>

        <ul class="comment-list gap">
            <?php
            wp_list_comments( 
                array(
                    'style'       => 'li',
                    'short_ping'  => true,
                    'avatar_size' => 128,
                    'callback'    => 'distinctivethemes_comments_list'
                    ) );
                    ?>
                </ul><!-- .comment-list -->


                <?php
        } // have_comments()

            // Are there comments to navigate through?
        if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
        <nav class="navigation comment-navigation" role="navigation">
            <h3 class="screen-reader-text section-heading"><?php _e( 'Comment navigation', 'bold' ); ?></h3>
            <ul class="pager  comment-navigation">
                <li class="previous"><?php previous_comments_link( __( '&larr; Older Comments', 'bold' ) ); ?></li>
                <li class="next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'bold' ) ); ?></li>
            </ul>

        </nav><!-- .comment-navigation -->

        <?php } // Check for comment navigation ?>

        <?php if ( ! comments_open() && get_comments_number() ) { ?>
        <?php _e( 'Comments are closed.' , 'bold' ); ?>
        <?php } else { 

            distinctivethemes_comment_form();
        }

        ?>
</div><!-- #comments -->