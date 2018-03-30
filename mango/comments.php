<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage mango
 * @since Mango 1.0
 */

?>
<?php
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="no-comments"><?php echo __('This post is password protected. Enter the password to view comments.', 'mango'); ?></p>
	<?php
		return;
	}
?>
<!-- You can start editing here. -->
<?php if ( have_comments() ) { ?>
	<div class="comments">
		<h3><?php comments_number(__('Comments Posted(%)', 'mango'));?></h3>
		<ul class="comments-list media-list">
			<?php wp_list_comments('callback=mango_comment'); ?>
		</ul>
		<div class="comments-navigation">
		    <div class="alignleft"><?php previous_comments_link(); ?></div>
		    <div class="alignright"><?php next_comments_link(); ?></div>
		</div>
	</div> 
<?php }?>
<?php if ( comments_open() ) : ?>
	<?php
	function modify_comment_form_fields($fields){
		$commenter = wp_get_current_commenter();
		$req       = get_option( 'require_name_email' );

		$fields['author'] = ' <div class="row"><div class="col-sm-6"><div class="form-group">
                                            <label for="author" class="input-desc">'.__("Your Name",'mango').' '.( $req ? '<span class="required-field">*</span>' : '' ).'</label>
                                             <input type="text" value="'. esc_attr( $commenter['comment_author'] ) .'" class="form-control" id="author" name="author" placeholder="'.__("Your name (Required)",'mango').'"'.($req ? ' required':'').'>
                                            </div>';
		$fields['email'] = '<div class="form-group">
                                            <label for="email" class="input-desc">'.__("Your Email (Required)",'mango').' '.( $req ? '<span class="required-field">*</span>' : '' ).'</label>
                                            <input type="email" class="form-control" value="'. esc_attr( $commenter['comment_author_email'] ) .'" id="email" name="email" placeholder="'.__("Your email address (Required)",'mango').'"'.($req ? ' required':'').'>
                                            </div>';
        $fields['url'] = '<div class="form-group">
                                            <label for="url" class="input-desc">'.__("Website",'mango').'</label>
                                            <input type="url" class="form-control" value="'. esc_attr( $commenter['comment_author_url'] ) .'" id="url" name="url" placeholder="'.__("Your URL",'mango').'">
                                            </div></div></div>';
		return $fields;
	}
	add_filter('comment_form_default_fields','modify_comment_form_fields');
	
	$comments_args = array(
		'title_reply' => ''. __("Leave a Comment", "mango").'',
		'title_reply_to' => ''. __("Leave a Comment", "mango").'',
		'must_log_in' => '<p class="must-log-in">' .  sprintf( __( "You must be %slogged in%s to post a comment.", "mango" ), '<a href="'.wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ).'">', '</a>' ) . '</p>',
		'logged_in_as' => '<p class="logged-in-as">' . __( "Logged in as","mango" ).' <a href="' .admin_url( "profile.php" ).'">'.$user_identity.'</a>. <a href="' .wp_logout_url(get_permalink()).'" title="' . __("Log out of this account", "mango").'">'. __("Log out &raquo;", "mango").'</a></p>',
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'comment_field' => '<div class="form-group last">
                                    <label for="comment" class="input-desc">'.__("Your Message",'mango').'<span class="required-field"> *</span></label>
                                    <textarea class="form-control" rows="7" id="comment" name="comment" tabindex="4"  placeholder="'.__("Your message content (required)",'mango').'" required="required"></textarea>
                                </div>',
		'class_submit' => 'btn btn-custom2 min-width',
		'label_submit'=> __("Post Comment", "mango"),
	);
	comment_form($comments_args);
	?>
<?php endif; // if you delete this the sky will fall on your head ?>