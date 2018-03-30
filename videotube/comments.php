<?php if( !defined('ABSPATH') ) exit;?>
<?php
wp_reset_query();
if ( post_password_required() ) {
	return;
}
?>
<div class="comments">
	<div class="section-header">
		<h3><?php comments_number( '', __('1 comment','mars'), __('% comments','mars') ); ?></h3>
	</div>
		<?php
			$args = array(
				'walker'            => null,
				'style'             => 'ul',
				'callback'          => 'mars_theme_comment_style',
				'end-callback'      => null,
				'type'              => 'comment',
				'reply_text'        => 'Reply',
				'avatar_size'       => 60,
				'reverse_top_level' => null,
				'format'            => 'html5', //or xhtml if no HTML5 theme support
				'short_ping'        => false // @since 3.6
			); 		
		?>					
	<ul class="list-unstyled comment-list">
		<?php wp_list_comments( $args );?>
    </ul>
			
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="navigation" role="navigation">
			<h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'mars' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'mars' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'mars' ) ); ?></div>
		</nav>
	<?php endif; // check for comment navigation ?>			

	<?php if ( ! comments_open() ) : ?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'mars' ); ?></p>
	<?php endif; ?>
	
<?php 
	$commenter = wp_get_current_commenter();
	$required_text = null;
	$args = array(
	  'id_form'           => 'commentform',
	  'id_submit'         => 'submit',
	  'class_submit'	=>	'btn-1',
	  'title_reply'       => __( 'Add your comment','mars' ),
	  'title_reply_to'    => __( 'Leave a Reply to %s','mars' ),
	  'cancel_reply_link' => __( 'Cancel Reply','mars' ),
	  'label_submit'      => __( 'Submit','mars' ),
	  'comment_field'	=>	'
		  <div class="form-group">
			<label for="comment">'.__('Comment','mars').'</label>
			<textarea class="form-control" aria-required="true" id="comment" name="comment" rows="6"></textarea>
		  </div>
	  ',
	  'must_log_in' => '<p class="must-log-in">' .
		sprintf(
		  __( 'You must be <a href="%s">logged in</a> to post a comment.','mars' ),
		  wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
		) . '</p>',
	
	  'logged_in_as' => '<p class="logged-in-as">' .
		sprintf(
		__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','mars' ),
		  admin_url( 'profile.php' ),
		  $user_identity,
		  wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
		) . '</p>',
	
	  'comment_notes_before' => '<p class="comment-notes">' .
		__( 'Your email address will not be published.','mars' ) . ( $req ? $required_text : '' ) .
		'</p>',
	
	  'comment_notes_after' => null,
	
	  'fields' => apply_filters( 'comment_form_default_fields', array(
		'author'	=>	'
		  <div class="form-group">
			<label for="author">'.__('Your Name','mars').'</label>
			<input type="text" class="form-control" id="author" name="author" placeholder="'.__('Enter name','mars').'" value="' . esc_attr( $commenter['comment_author'] ) .'">
		  </div>			
		',
		'email'	=>	'
		  <div class="form-group">
			<label for="email">'.__('Your Email','mars').'</label>
			<input type="text" class="form-control" id="email" name="email" placeholder="'.__('Enter Email','mars').'" value="' . esc_attr(  $commenter['comment_author_email'] ) .'">
		  </div>
		',
		'url'	=>	'
		  <div class="form-group">
			<label for="url">'.__('Website','mars').'</label>
			<input type="text" class="form-control" id="url" name="url" placeholder="'.__('Enter Website','mars').'" value="' . esc_attr( $commenter['comment_author_url'] ) .'">
		  </div>
		'
		)
	  ),
	);
	comment_form($args);
	?>
</div>