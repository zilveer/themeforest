<?php
/**
 * The template for displaying Comments.
 *
 */
?>

<?php if ( post_password_required() ) : ?>
		<p><?php _e( 'This post is password protected. Enter the password to view any comments.', 'homeshop' ); ?></p>
<?php
		return;
	endif;
?>

<?php if ( have_comments() ) : ?>
		<?php
            /* Loop through and list the comments. Tell wp_list_comments()
             */
            wp_list_comments( array( 'callback' => 'homeshop_comment', 'per_page' => 15) );
        ?>
        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
                        <?php previous_comments_link( __( ' Older Comments', 'homeshop' ) ); ?>
                        <?php next_comments_link( __( 'Newer Comments ', 'homeshop' ) ); ?>
        <?php endif; // check for comment navigation ?>
<?php else : // or, if we don't have comments:
	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
	  ?>
	<p><?php _e( 'No Comments', 'homeshop' ); ?></p> 
	 
	<?php if ( ! comments_open() ) : ?>
		<p><?php _e( 'Close Comments', 'homeshop' ); ?></p>
	<?php endif; // end ! comments_open() ?>
<?php endif; // end have_comments() ?>



