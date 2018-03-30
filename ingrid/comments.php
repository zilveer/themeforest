<?php
/*
	Template for displaying Comments.
*/

// if the current post is protected by a password and the visitor has not yet entered the password we will return early without loading the comments. */
	if ( post_password_required() ){
		return;
	}

	print '<h3>'.__('COMMENTS','ingrid').'</h3>';
	

if ( have_comments() ){

	print '
	<ul class="commentlist">
	'; 
	
	//list comments
		wp_list_comments( array( 'callback' => 'tp_comments' ) ); 
			
	print '
	</ul>
	';
	
	//comment nav
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {
		print '<nav id="comment-nav-below" class="navigation" role="navigation">			
			<div class="nav-previous">' . previous_comments_link( __( '&larr; Older Comments', 'ingrid' ) ) . '</div>
			<div class="nav-next">'. next_comments_link( __( 'Newer Comments &rarr;', 'ingrid' ) ) .'</div>
		</nav>';
	}
	
	if ( ! comments_open() ){
		print '<p><strong>'.__('Comments are closed.','ingrid').'</strong></p>';
	}else{
		
		print '<div class="vspace"></div>';

		
		
		comment_form( array( 
			'title_reply' => __('LEAVE A REPLY','ingrid'),
			'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="4" aria-required="true"></textarea></p>',
			'comment_notes_after' => '',
			 'label_submit' => __('POST COMMENT','ingrid')
		) );
	}
}else{
	print '<p>'.__('There aren\'t any comments yet.','ingrid').'</p>';
	
	if ( ! comments_open() ){
		print '<p><strong>'.__('Comments are closed.','ingrid').'</strong></p>';
	}else{
		
		print '<div class="vspace"></div>';

		
		
		comment_form( array( 
			'title_reply' => __('LEAVE A REPLY','ingrid'),
			'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="4" aria-required="true"></textarea></p>',
			'comment_notes_after' => '',
			 'label_submit' => __('POST COMMENT','ingrid')
		) );
	}
	
}

	
?>
