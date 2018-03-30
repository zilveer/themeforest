<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.  The actual display of comments is
 * handled by a callback which is
 * located in the loop-comments.php file.
 *
 */
?>

<?php if ( post_password_required() ) : ?>
				<p><?php _e( 'This post is password protected. Enter the password to view any comments.', 'avia_framework' ); ?></p>
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>

<?php
	// You can start editing here -- including this comment!
?>
<div class='hr'></div>
<div class='comment-entry post-entry'>


<?php if ( have_comments() ) : ?>
			<div class='comment_meta_container first'>
			
				<h4 id="comments"><?php
				printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'avia_framework' ),
				number_format_i18n( get_comments_number() ), '<span class="comment_title">' . get_the_title() . '</span>' );
				?></h4>
			
			</div>
			<div class='comment_container'>

<?php 		
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through?
			echo "<span class='comment_page_nav_links comment_page_nav_links_top'>";
			echo "<span class='comment_prev_page'>";
				 previous_comments_link( __( '&laquo; Older Comments', 'avia_framework' ) );
			echo "</span>";
			echo "<span class='comment_next_page'>";
				 next_comments_link( __( 'Newer Comments &raquo;', 'avia_framework' ) );
			echo "</span>";
			echo "</span>";
		endif; // check for comment navigation
		
		 ?>

			<ol class="commentlist">
				<?php
					/* Loop through and list the comments. Tell wp_list_comments()
					 * to use avia_inc_custom_comments() to format the comments.
					 * If you want to overload this in a child theme then you can
					 * define avia_framework_comment() and that will be used instead.
					 * See avia_framework_comment() in includes/loop-comments.php for more.
					 */
					wp_list_comments( array( 'callback' => 'avia_inc_custom_comments' ) );
				?>
			</ol>

<?php 
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through?
			echo "<span class='comment_page_nav_links comment_page_nav_links_bottom'>";
			echo "<span class='comment_prev_page'>";
				 previous_comments_link( __( '&laquo; Older Comments', 'avia_framework' ) );
			echo "</span>";
			echo "<span class='comment_next_page'>";
				 next_comments_link( __( 'Newer Comments &raquo;', 'avia_framework' ) );
			echo "</span>";
			echo "</span>";
		endif; // check for comment navigation
	
	echo "</div> <!-- end grid div-->";
	
	else : // or, if we don't have comments:

	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
	if ( ! comments_open() ) :
?>
	<p><?php _e( 'Comments are closed.', 'avia_framework' ); ?></p>
	
<?php

endif; // end ! comments_open()

endif; // end have_comments()

 

	/* Last but not least the comment_form() wordpress function
	 * renders the comment form as defined by wordpress itself
	 * if you want to modify the submission form check the documentation here:
	 * http://codex.wordpress.org/Function_Reference/comment_form
	 */
	 echo "<div class='comment_meta_container'>";
	 echo "<h3 class='miniheading'>".__('Leave a Reply','avia_framework')."</h3>";
	 echo "<span class='minitext'>".__('Want to join the discussion? <br/>Feel free to contribute!','avia_framework')."</span>";
	 echo "</div>";
	 echo "<div class='comment_container'>";
	 comment_form();
	 echo "</div>";
	  ?>

</div>