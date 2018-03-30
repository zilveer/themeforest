<?php
	if ( !empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) )
		die ( __( 'Please do not load this page directly. Thanks!', 'onioneye' ) );

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e( 'This post is password protected. Enter the password to view comments.', 'onioneye' ); ?></p>
	<?php
		return;
	}
?>

<?php if ( have_comments() ) : ?>
	<h2 id="comments"><?php comments_number( __( 'No Comments', 'onioneye' ), __( '1 Comment', 'onioneye' ), _n( '% comment', '% comments', get_comments_number(), 'onioneye' ) ); ?></h2>

	<!-- START .comment-list -->
	<ul class="comment-list">
		
		<?php wp_list_comments( 'type=comment&callback=mytheme_comment' ); ?>
		
	</ul>
	<!-- END .comment-list -->
	
	<div class="comments_navigation">
    	<?php paginate_comments_links(); ?> 
    </div>
	
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		
		<!-- If comments are closed. -->
		<p class="nocomments"><?php _e( 'Comments are closed.', 'onioneye' ); ?></p>

	<?php endif; ?>
<?php endif; ?>


<?php if ( comments_open() ) : ?>
	<?php comment_form(); ?>
<?php endif; // if you delete this the sky will fall on your head ?>