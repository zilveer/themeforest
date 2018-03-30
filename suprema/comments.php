<div class="qodef-comment-holder clearfix" id="comments">
	<div class="qodef-comment-number">
		<div class="qodef-comment-number-inner">
			<h5><?php comments_number( esc_html__('No Comments','suprema'), '1'.esc_html__(' Comment ','suprema'), '% '.esc_html__(' Comments ','suprema')); ?></h5>
		</div>
	</div>
<div class="qodef-comments">
<?php if ( post_password_required() ) : ?>
				<p class="qodef-no-password"><?php esc_html_e( 'This post is password protected. Enter the password to view any comments.', 'suprema' ); ?></p>
			</div></div>
<?php
		return;
	endif;
?>
<?php if ( have_comments() ) : ?>

	<ul class="qodef-comment-list">
		<?php wp_list_comments(array( 'callback' => 'suprema_qodef_comment')); ?>
	</ul>


<?php // End Comments ?>

 <?php else : // this is displayed if there are no comments so far 

	if ( ! comments_open() ) :
?>
		<!-- If comments are open, but there are no comments. -->

	 
		<!-- If comments are closed. -->
		<p><?php esc_html_e('Sorry, the comment form is closed at this time.', 'suprema'); ?></p>

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
	'title_reply'=> esc_html__( 'Leave a Comment','suprema' ),
	'title_reply_to' => esc_html__( 'Post a Reply to %s','suprema' ),
	'title_reply_before'   => '<h5 id="reply-title" class="comment-reply-title">',
	'title_reply_after'    => '</h5>',
	'cancel_reply_link' => esc_html__( 'Cancel Reply','suprema' ),
	'label_submit' => esc_html__( 'Submit comment','suprema' ),
	'comment_field' => '<textarea id="comment" placeholder="'.esc_html__( 'Write your comment here...','suprema' ).'" name="comment" cols="45" rows="8" aria-required="true"></textarea>',
	'comment_notes_before' => '',
	'comment_notes_after' => '',
	'fields' => apply_filters( 'comment_form_default_fields', array(
		'author' => '<div class="qodef-three-columns clearfix"><div class="qodef-three-columns-inner"><div class="qodef-column"><div class="qodef-column-inner"><input id="author" name="author" placeholder="'. esc_html__( 'Your full name','suprema' ) .'" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' /></div></div>',
		'url' => '<div class="qodef-column"><div class="qodef-column-inner"><input id="email" name="email" placeholder="'. esc_html__( 'E-mail address','suprema' ) .'" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $aria_req . ' /></div></div>',
		'email' => '<div class="qodef-column"><div class="qodef-column-inner"><input id="url" name="url" type="text" placeholder="'. esc_html__( 'Website','suprema' ) .'" value="' . esc_attr( $commenter['comment_author_url'] ) . '" /></div></div></div></div>'
		 ) ) );
 ?>
<?php if(get_comment_pages_count() > 1){
	?>
	<div class="qodef-comment-pager">
		<p><?php paginate_comments_links(); ?></p>
	</div>
<?php } ?>
 <div class="qodef-comment-form">
	<?php comment_form($args); ?>
</div>
								
							


