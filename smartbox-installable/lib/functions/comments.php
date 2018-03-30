<?php
/**
 * This file contains the comments functionality.
 */

/**
 * Displays a single comment.
 */
function designaretheme_comment($comment, $args, $depth) {

	global $wpdb;
	$user_level = 8; //Default user level (1-10)
	$admin_emails = array(); //Hold Admin Emails

	//Search for the ID numbers of all accounts at specified user level and up
	$admin_accounts = $wpdb->get_results("SELECT * FROM $wpdb->usermeta WHERE meta_key = 'wp_user_level' AND meta_value >= $user_level ");

	//Get the email address for each administrator via ID number
	foreach ($admin_accounts as $admin_account){

		//Get database row for current user id
		$admin_info = $wpdb->get_row("SELECT * FROM $wpdb->users WHERE ID = $admin_account->user_id");

		//Add current user's email to array
		$admin_emails[$admin_account->user_id] = $admin_info->user_email;
	}

	$GLOBALS['comment'] = $comment;

	?>
<li <?php comment_class(); ?>>
	
	<div class="comment-container">
		<div class="comment-box">
			<div class="comment-autor two columns alpha omega" style="clear: none; position: absolute;">
				<div class="avatar_wrapper">
					<div class="avatar_frame"></div>
					<?php echo get_avatar($comment,$size='70',$default='' ); ?>
					<p class="coment-autor-name"><?php printf('%s', get_comment_author_link()) ?></p>
					<div class="date"><?php printf('%1$s', get_comment_date(get_option('date_format'))); ?> </div>
				</div>
			</div>
			<div class="comment-reply" style="margin-left: 100px">
				<div class="comment-pointer"></div>
				<div class="comment-text"><?php comment_text(); ?></div>
				<div class="comment-date post-info">
					
			
					<div class="reply">
						<?php if (!function_exists('icl_object_id')) comment_reply_link(array_merge( $args, array('depth' => $depth, 'reply_text'=> get_option(DESIGNARE_SHORTNAME.'_reply_text')))); else comment_reply_link(array_merge( $args, array('depth' => $depth, 'reply_text'=> __("Reply", "smartbox")))); ?>
					
						<div class="reply-container"></div>
					</div>
						
				</div>
			</div>
		</div>
	</div>

	<?php
} ?>