<?php 
	$custom_comment_form = array( 
		'fields' => apply_filters( 'comment_form_default_fields', array(
		    'author' => '<input type="text" id="author" name="author" placeholder="' . __('Name *','ebor_starter') . '" value="' . esc_attr( $commenter['comment_author'] ) . '" />',
		    'email'  => '<input name="email" type="text" id="email" placeholder="' . __('Email *','ebor_starter') . '" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" />',
		    'url'    => '<input name="url" type="text" id="url" placeholder="' . __('Website','ebor_starter') . '" value="' . esc_attr(  $commenter['comment_author_url'] ) . '" />') 
		 ),
	  	'comment_field' => '<textarea name="comment" placeholder="' . __('Enter your comment here...','ebor_starter') . '" id="comment" aria-required="true"></textarea>',
	  	'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a> <a href="%3$s">Log out?</a>','ebor_starter' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</p>',
	  	'cancel_reply_link' => __( 'Cancel' , 'ebor_starter' ),
	  	'comment_notes_before' => '',
	  	'comment_notes_after' => '',
	  	'label_submit' => __( 'Submit' , 'ebor_starter' )
	);
?>

<div id="comments">
	<h3 class="article-title"><?php comments_number( __('0 Comments','ebor_starter'), __('1 Comment','ebor_starter'), __('% Comments','ebor_starter') ); ?></h3>
		
	<?php if( have_comments() ) : ?>
		  <ol id="singlecomments" class="commentlist">
		  		<?php wp_list_comments('type=comment&callback=ebor_themes_custom_comment'); ?>
		  </ol>
	<?php 
		endif;
		
		paginate_comments_links();
		comment_form($custom_comment_form); 
	?>
</div>