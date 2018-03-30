<?php $mvp_click_id = get_the_ID(); ?>
<div id="comments" class="com-click-id-<?php echo esc_html($mvp_click_id); ?> com-click-main">
	<?php if ( post_password_required() ) : ?>
	<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'mvp-text' ); ?></p>
</div><!--comments-->
	<?php
	/* Stop the rest of comments.php from being processed,
	 * but don't kill the script entirely -- we still have
	 * to fully load the template.
	 */
	return;
	endif;

		// You can start editing here -- including this comment!
	?>
	<?php if ( have_comments() ) : ?>
		<h4 class="post-header"><span class="post-header">
			<?php
			printf( _n( '1 Comment', '%1$s Comments', get_comments_number(), 'mvp-text' ),
			number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' );
			?>
		</span></h4>
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
	<div class="navigation">
		<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'mvp-text' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'mvp-text' ) ); ?></div>
	</div> <!--navigation-->
	<?php endif; // check for comment navigation ?>
	<ol class="commentlist">
		<?php
		wp_list_comments( array( 'callback' => 'mvp_comment' ) );
		?>
	</ol>
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
	<div class="navigation">
		<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'mvp-text' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'mvp-text' ) ); ?></div>
	</div> <!--navigation-->
	<?php endif; // check for comment navigation ?>
	<?php else : // or, if we don't have comments:

		/* If there are no comments and comments are closed,
		 * let's leave a little note, shall we?
		 */
		if ( ! comments_open() ) :
			/* <p class="nocomments"><?php _e( 'Comments are closed.', 'mvp-text' ); ?></p> */
		endif; // end ! comments_open() ?>
	<?php endif; // end have_comments() ?>
	<?php if (get_option('comment_registration') && !$user_ID) : ?>
		<p>
			<?php _e('You must be logged in to post a comment' , 'mvp-text'); ?>
			<a href="<?php echo esc_url(get_option('siteurl')); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">
				<?php _e('Login', 'mvp-text'); ?>
			</a>
		</p>
	<?php else : ?>

	<?php endif; ?>

<?php comment_form(
	array(
		'title_reply' => '<h4 class="post-header"><span class="post-header">' . __( 'Leave a Reply', 'mvp-text' ) . '</span></h4>',
		'title_reply_to' => '<h4 class="post-header"><span class="post-header">' . __( 'Leave a Reply', 'mvp-text' ) . '</span></h4>',
	)
); ?>

</div><!--comments-->