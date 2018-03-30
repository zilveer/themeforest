<div class="mkdf-comment-holder clearfix" id="comments">
	<div class="mkdf-comment-number">
		<h5 class="mkdf-title-pattern-text"><?php comments_number( esc_html__('No comments','hashmag'), esc_html__('Latest comment','hashmag'), esc_html__('Latest comments','hashmag')); ?></h5><div class="mkdf-title-pattern"><div class="mkdf-title-pattern-inner"></div></div>
	</div>
	<div class="mkdf-comments">
<?php if ( post_password_required() ) : ?>
		<p class="mkdf-no-password"><?php esc_html_e( 'This post is password protected. Enter the password to view any comments.', 'hashmag' ); ?></p>
	</div>
</div>
<?php
		return;
	endif;
?>
<?php if ( have_comments() ) : ?>
	<ul class="mkdf-comment-list">
		<?php wp_list_comments(array( 'callback' => 'hashmag_mikado_comment')); ?>
	</ul>
<?php // End Comments ?>

 <?php else : // this is displayed if there are no comments so far 

	if ( ! comments_open() ) :
?>
		<!-- If comments are open, but there are no comments. -->

	 
		<!-- If comments are closed. -->
		<p><?php esc_html_e('Sorry, the comment form is closed at this time.', 'hashmag'); ?></p>

	<?php endif; ?>
<?php endif; ?>
</div></div>
<?php
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );

$args = array(
	'id_form' => 'commentform',
	'id_submit' => 'submit_comment',
	'title_reply'=> esc_html__( 'leave a comment','hashmag' ),
	'title_reply_to' => esc_html__( 'Post a Reply to %s','hashmag' ),
	'cancel_reply_link' => esc_html__( 'Cancel Reply','hashmag' ),
	'label_submit' => esc_html__( 'Post Comment','hashmag' ),
	'comment_field' => '<textarea id="comment" placeholder="'.esc_html__( 'Write your comment here...','hashmag' ).'" name="comment" cols="45" rows="8" aria-required="true"></textarea>',
	'comment_notes_before' => '',
	'comment_notes_after' => '',
	'fields' => apply_filters( 'comment_form_default_fields', array(
		'author' => '<div class="mkdf-two-columns-50-50 clearfix"><div class="mkdf-two-columns-50-50-inner"><div class="mkdf-column"><div class="mkdf-column-inner"><input id="author" name="author" placeholder="'. esc_html__( 'Name','hashmag' ) .'" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' /></div></div>',
		'url' => '<div class="mkdf-column"><div class="mkdf-column-inner"><input id="email" name="email" placeholder="'. esc_html__( 'E-mail','hashmag' ) .'" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $aria_req . ' /></div></div></div></div>',
		'email' => '<input id="url" name="url" type="text" placeholder="'. esc_html__( 'Website','hashmag' ) .'" value="' . esc_attr( $commenter['comment_author_url'] ) . '" />'
		 ) ) 
	);
 ?>
<?php if(get_comment_pages_count() > 1){
	?>
	<div class="mkdf-comment-pager">
		<p><?php paginate_comments_links(); ?></p>
	</div>
<?php } ?>
 <div class="mkdf-comment-form">
	<?php comment_form($args); ?>
</div>