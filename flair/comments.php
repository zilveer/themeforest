<?php 
	/**
	 * comments.php
	 * The comments template used in loom
	 * @author TommusRhodus
	 * @package loom
	 * @since 1.0.0
	 */
	$custom_comment_form = array( 
		'title_reply'       => __( 'Leave a Reply', 'flair'  ),
		'title_reply_to'    => __( 'Leave a Reply to %s' , 'flair' ),
		'fields' => apply_filters( 'comment_form_default_fields', array(
		    'author' => '<input type="text" id="author" name="author" placeholder="' . __('Name *','flair') . '" value="' . esc_attr( $commenter['comment_author'] ) . '" />',
		    'email'  => '<input name="email" type="text" id="email" placeholder="' . __('Email *','flair') . '" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" />',
		    'url'    => '<input name="url" type="text" id="url" placeholder="' . __('Website','flair') . '" value="' . esc_attr(  $commenter['comment_author_url'] ) . '" />') 
		),
		'comment_field' => '<textarea name="comment" placeholder="' . __('Enter your comment here...','flair') . '" id="comment" aria-required="true"></textarea>',
		'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a> <a href="%3$s">Log out?</a>','flair' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</p>',
		'cancel_reply_link' => __( 'Cancel' , 'flair' ),
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'label_submit' => __( 'Submit' , 'flair' )
	);
?>

<div class="comments">

	<h5><?php comments_number( __('0 Comments','flair'), __('1 Comment','flair'), __('% Comments','flair') ); ?></h5>
	
	<?php 
		if( have_comments() ){
		  echo '<ul class="comments">';
		  	wp_list_comments('type=comment&callback=ebor_custom_comment');
		  echo '</ul>';
		}
		
		paginate_comments_links(); 
	?>
	
</div>
	
<h5 class="pad60"><?php echo get_option('comments_title','Would you like to share your thoughts?'); ?></h5>

<div id="ajax-contact-form2" class="contact_form pad15">  
	<?php comment_form($custom_comment_form); ?>
</div>