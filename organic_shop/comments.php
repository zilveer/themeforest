<!-- BEGIN .reply_container -->
<div class="reply_container">

<?php 

/* ------------------------------------------------
	Display Comments
------------------------------------------------ */	
	
if ( have_comments() ) : ?>
		
	<h3 id="comment-number"><?php comments_number(__('No comments', 'qns'), __('1 Comment', 'qns'), __('% Comments', 'qns')); ?></h3>
		
	<ul class="comment-list">
		<?php wp_list_comments( array( 'callback' => 'qns_comments' ) ); ?>
	</ul>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			
		<?php previous_comments_link( __( '&larr; Older Comments', 'qns' ) ); ?>
		<?php next_comments_link( __( 'Newer Comments &rarr;', 'qns' ) ); ?>
			
	<?php endif; ?>

	<?php else : // this is displayed if there are no comments so far ?>
			
	<?php endif;


/* ------------------------------------------------
	Comment Form
------------------------------------------------ */

if ( comments_open() ) : 

	global $aria_req;
	
	comment_form( array(
		
		'comment_field'				=>	'<label for="comment">' . __('Comment', 'qns') . '</label><textarea name="comment" id="comment" class="text_input" tabindex="4" rows="9" cols="60"></textarea>',
		
		'comment_notes_before'		=>	'',
		
		'comment_notes_after'		=>	'',
		
		'logged_in_as'				=>	'<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post->ID ) ) ) ) . '</p>',
		
		'title_reply'				=>	__( 'Leave a Comment', 'qns' ),
		
		'title_reply_to'			=>	__( 'Leave a Comment', 'qns' ),
		
		'cancel_reply_link'			=>	__( 'Cancel Reply To Comment', 'qns' ),
		
		'label_submit'				=>	__( 'Submit Comment', 'qns' ),
		
		'id_submit'					=>	'submit',
		
		'fields'					=>	array(
										
											'author'	=>	( $req ? '<label>' . __('Name', 'qns') .' <span class="required">('.__('required', 'qns').')</span></label>' : '' ) . '<input id="author" class="text_input" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="' . __( 'Name', 'qns' ) . '" ' . $aria_req . ' />',
											
											'email'	    =>	( $req ? '<label>' . __('Email', 'qns') .' <span class="required">('.__('required', 'qns').')</span></label>' : '' ) . '<input id="email" class="text_input" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" placeholder="' . __( 'Email', 'qns' ) . '" ' . $aria_req . ' />',
																
											'url'		=>	'<label>' . __('Website', 'qns') .' </label><input id="url" class="text_input" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="' . __( 'Website', 'qns' ) . '" />'
										)
										
	) );

?>

<?php endif; ?>

<!--END .reply_container -->	
</div>