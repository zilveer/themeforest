<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'kickstart' ); ?></p>
	<?php
		return;
	}
?>

<?php if ( have_comments() ) : ?>
	<div id="comments" class="heading-wrapper"><h6><span class="heading-line-left"></span><strong><?php comments_number( __( 'No comments', 'kickstart' ), __( 'One comment', 'kickstart' ), __( '% Comments', 'kickstart' ) );?></strong><span class="heading-line-right"></span></h6></div>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<div class="navigation">
			<div class="next-posts"><?php previous_comments_link( __('Older Comments', 'kickstart') ); ?></div>
			<div class="prev-posts"><?php next_comments_link( __('Newer Comments', 'kickstart') ); ?></div>
		</div>
	<?php endif; ?>

	<ol class="commentlist">
		<?php wp_list_comments( array( 'callback' => 'mnky_comment' ) );?>
	</ol>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<div class="navigation">
			<div class="next-posts"><?php previous_comments_link( __('Older Comments', 'kickstart') ); ?></div>
			<div class="prev-posts"><?php next_comments_link( __('Newer Comments', 'kickstart') ); ?></div>
		</div>
	<?php endif; ?>
<?php endif; // end have_comments() ?>

<?php if ( comments_open() ) : ?>
		<?php 
		$defaults = array(
			'comment_notes_before' => '',
			'comment_notes_after'  => '',
			'id_form'              => 'commentform',
			'id_submit'            => 'submit',
			'title_reply'          => '<span class="reply-title-wrapper"><span class="heading-line-left"></span><strong>'. __( 'Leave a Comment', 'kickstart' ) .'</strong><span class="heading-line-right"></span></span>',
			'title_reply_to'       => '<span class="reply-title-wrapper"><span class="heading-line-left"></span><strong>'. __( 'Leave a Comment to %s', 'kickstart' ) .'</strong><span class="heading-line-right"></span></span>',
			'cancel_reply_link'    => '<i class="moon-close-3"></i>'. __( 'Click here to cancel reply.', 'kickstart' ),
			'label_submit'         => __( 'Post Comment', 'kickstart' ),
		);
		
		comment_form($defaults); 
		?>
<?php endif; ?>