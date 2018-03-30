<?php
/**
 * The template display comment form
 *
 */
	 
	 // protect password protected comments
	if ( post_password_required() ) : ?>		
	<div id="comments">		
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', THEMENAME ); ?></p>
	</div><!-- #comments -->
	
<?php	return;	endif; ?>

<?php if ( have_comments() ) : ?>
	<div class="comments-container clearfix">
		<h2 class="title"><i class="icon-comment icon-4x"></i><?php comments_number(__('No Comments', THEMENAME), __('One Comment', THEMENAME), __('% Comments', THEMENAME));?></h2>		
		<ul class="comment-list">
			<?php wp_list_comments('type=comment&callback=unik_theme_comment'); ?>
		</ul>		
		<div class="comments-navigation">
		    <div class="alignleft"><?php previous_comments_link(); ?></div>
		    <div class="alignright"><?php next_comments_link(); ?></div>
		</div>
	</div>

<?php else : // there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		
	<?php endif; ?>

<?php endif; ?>


<?php
global $translator_leave_reply;
$comment_form = array(
		'fields' => apply_filters( 'comment_form_default_fields', array(
			
			'author' => '<div class="form-group"><div class="comment-input-single col-sm-6 comment-form-author">' .
						'<input id="author" class="form-control" name="author" type="text" placeholder="'.__('Name (required)').'" value="' .
						esc_attr( $commenter['comment_author'] ) . '" size="30" tabindex="1" />' .		
						'</div><!-- #form-section-author .form-section -->',
						
			'email'  => '<div class="comment-input-single  col-sm-6 comment-form-email">' .
						'<input  class="form-control" id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" tabindex="2" placeholder="'.__('Email (required)').'">' .
						'</div></div><!-- #form-section-email .form-section -->',
						
			'url'    => '<div class="form-group"><div class="comment-form-url omment-input-single col-sm-12">' .
						'<input id="url" class="form-control" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" tabindex="3" placeholder="'.__('Website').'" />' .
						'</div></div><!-- #form-section-url .form-section -->' ) ),
						
		'comment_field' => '<div class="form-group"><div class="col-sm-12 comment-form-comment">' .
					'<textarea id="comment" class="form-control" name="comment" placeholder="'.__('Comment..').'" aria-required="true"></textarea>' .
					'</div></div><!-- #form-section-comment .form-section -->',
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'title_reply' => $translator_leave_reply,
	);

comment_form($comment_form, $post->ID); 