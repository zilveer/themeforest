<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to unitedthemes_comment() which is
 * located in the inc/template-tags.php file.
 *
 * @package unitedthemes
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>
<div class="grid-100 tablet-grid-100 mobile-grid-100">
<div id="comments" class="comments-area clearfix">
			<?php // You can start editing here -- including this comment! ?>
        
            <?php if ( have_comments() ) : ?>
            
                <h3 class="comments-title">	
				<?php printf( _n( 'Comment <span>(1)</span>', 'Comments <span>(%1$s)</span>', get_comments_number(), 'unitedthemes' ),
        		number_format_i18n( get_comments_number() ), get_the_title() );?>
				</h3>

                <ol class="comment-list">
                    <?php
                        /* Loop through and list the comments. Tell wp_list_comments()
                         * to use unitedthemes_comment() to format the comments.
                         * If you want to overload this in a child theme then you can
                         * define unitedthemes_comment() and that will be used instead.
                         * See unitedthemes_comment() in inc/template-tags.php for more.
                         */
                        wp_list_comments( array( 'callback' => 'unitedthemes_comment' ) );
                    ?>
                </ol><!-- .comment-list -->
        
                <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
                <nav id="comment-nav-below" class="comment-navigation" role="navigation">
                    <?php _e( 'Comment navigation', 'unitedthemes' ); ?>
                    <div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'unitedthemes' ) ); ?></div>
                    <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'unitedthemes' ) ); ?></div>
                </nav><!-- #comment-nav-below -->
                <?php endif; // check for comment navigation ?>
        
            <?php endif; // have_comments() ?>
        
            <?php
                // If comments are closed and there are comments, let's leave a little note, shall we?
                if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
            ?>
                <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'unitedthemes' ); ?></p>
            <?php endif; ?>
        
            <?php comment_form(); ?>
	</div><!-- close #comments -->	
</div><!-- close grid-100 tablet-grid-100 mobile-grid-100 -->