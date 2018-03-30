<?php
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>

<p class="nocomments">
			<?php _e('This post is password protected. Enter the password to view comments.','epic');?>
</p>
<?php
		return;
	}
?>

<!-- You can start editing here. -->

			<?php if ( have_comments() ) : ?>
			<div id="comments">
			<h2> <?php printf( _n( 'One comment to %2$s', '%1$s comments to %2$s', get_comments_number(), 'epic' ),
			number_format_i18n( get_comments_number() ),  get_the_title() );?> </h2>
			<ul class="commentlist">
						<?php wp_list_comments("callback=epic_comments"); ?>
			</ul>
			<div class="commentnavigation">
			
						<div class="alignleft ">
									<?php previous_comments_link( __('Older Comments','epic')); ?>
						</div>
						<div class="alignright">
									<?php next_comments_link( __('Newer Comments','epic') ); ?> 
						</div>
			</div>
			</div>
			<?php else : // this is displayed if there are no comments so far ?>
			<?php endif; ?>

<?php if ( comments_open() ) : ?>
<div class="cancel-comment-reply"> <small>
			<?php //cancel_comment_reply_link(); ?>
			</small>
			<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
			<p> <a href="<?php echo wp_login_url( get_permalink() ); ?>">
						<?php _e('You must be logged in to post a comment.','epic');?>
						</a> </p>
			<?php else : ?>
<div class="comment-form">
<?php $fields =  array(
	'author' => '<p class="comment-form-author"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . ' /><label for="author">' . __( 'Name','epic' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '</p>',
	'email'  => '<p class="comment-form-email">' .
	            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . ' />' . '<label for="email">' . __( 'Email','epic'  ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . ' </p>',
	'url'    => '<p class="comment-form-url">' .
	            '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" />' . '<label for="url">' . __( 'Website','epic'  ) . '</label>' . '</p>',
);

$defaults = array(

'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
'comment_field'        => '<p class="comment-form-comment"><textarea name="comment" id="comment" cols="58" rows="10" tabindex="4"></textarea></p>',
'title_reply'          => __( 'Leave a Reply' , 'epic'),
'title_reply_to'       => __( 'Leave a Reply to %s', 'epic' ),
'cancel_reply_link'    => __( 'Cancel reply', 'epic' ),
'label_submit'         => __( 'Post Comment', 'epic' ),
'comment_notes_after'  => '<p class="form-allowed-tags">'.__('You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:','epic').'  <code>&lt;a href=&quot;&quot; title=&quot;&quot;&gt; &lt;abbr title=&quot;&quot;&gt; &lt;acronym title=&quot;&quot;&gt; &lt;b&gt; &lt;blockquote cite=&quot;&quot;&gt; &lt;cite&gt; &lt;code&gt; &lt;del datetime=&quot;&quot;&gt; &lt;em&gt; &lt;i&gt; &lt;q cite=&quot;&quot;&gt; &lt;strike&gt; &lt;strong&gt; </code></p>'
);

comment_form($defaults);  ?>
</div>
<?php endif; // If registration required and not logged in ?>
</div>
<?php endif; // if you delete this the sky will fall on your head ?>
