<?php 
/**
* Comments template.
*/

if ( post_password_required() ){
	return;
}
?>
<div id="comments">
<?php
if(have_comments()){ ?>
<h4 class="comments-titile">
	<?php comments_number(__( 'No comments', 'pexeto' ), __('One comment', 'pexeto'), '% '.__( 'comments', 'pexeto' )); ?>
</h4>
<?php } //end if have comments ?>
<div id="comment-content-container">
<?php if(have_comments()){?>
<ul class="commentlist">
<?php wp_list_comments(array(
		'type'=>'all',
		'callback'=>'pexeto_comments')); ?>
</ul>
<div class="comment-navigation" class="navigation">
	<div class="alignleft">
		<?php next_comments_link('<span>&laquo;</span> '.__('Newer comments', 'pexeto')); ?>
	</div>
	<div class="alignright">
		<?php previous_comments_link(__('Older comments', 'pexeto').' <span>&raquo;</span>') ?>
	</div>
</div>
<?php } //end if have comments 

$fields =  array(
	'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'pexeto' ) . ( $req ? '<span class="mandatory">*</span>'. '</label> '  : '' ) .
		'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" /></p>',
	'email'  => '<p class="comment-form-email"><label for="email">' . __( 'E-mail', 'pexeto' )  . ( $req ? '<span class="mandatory">*</span>' . '</label> ': '' ) .
		'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"/></p>',
	'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website', 'pexeto' ) . '</label>' .
		'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
);
$args=array();
$args['fields']=$fields;
$args['comment_field']='<p class="comment-form-comment"><label for="comment">' . __( 'Your comment', 'pexeto' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>';
$args['comment_notes_before']='<div class="double-line"></div>';
$args['comment_notes_after']='';
$args['title_reply']=__( 'Leave a comment', 'pexeto' );
$args['label_submit']=__( 'Submit comment', 'pexeto' );
$args['logged_in_as']='';
$args['title_reply_to']=__( 'Leave a reply to', 'pexeto' ).' %s';
$args['cancel_reply_link']=__( 'Cancel reply', 'pexeto' );
comment_form( $args ); 
?>
</div>
</div>
