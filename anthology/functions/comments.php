<?php

/*-------------------- COMMENTS  --------------------*/

function is_admin_comment($currentAuthor){

	//Automatically pull admin accounts

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

	$admin_comment = false;
	foreach ($admin_emails as $admin_email){
		//If comment was made from an admin email
		if($currentAuthor == $admin_email){
			$admin_comment = true;
			break;
		}
	};

	return $admin_comment;

}


/**
 * Displays a single comment.
 */
function mytheme_comment($comment, $args, $depth) {

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

	$admin_comment = false;
	foreach ($admin_emails as $admin_email){
		//If comment was made from an admin email
		if($comment->comment_author_email == $admin_email){
			$admin_comment = true;
			break;
		}
	};

	$GLOBALS['comment'] = $comment;

	?>
<li>
<div class="commentContainer">
<div class="comentBox">
<div class="commentAutor"><?php echo get_avatar($comment,$size='80',$default='' ); ?>
<p class="ComentAutorName"><?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?></p>
</div>
	<?php if($admin_comment==true && get_option('highlight_admin_comments')!='off') echo('<div class="adminRibbon"></div>'); ?>
<div class="commentText"><?php comment_text(); ?></div>
<div class="commentDate">
<div class="alignleft"><?php printf(__('%1$s'), get_comment_date()) ?></div>
	<?php if($depth==1){?>
<div class="reply">
<div class="reply_icon"></div>
	<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => 2, reply_text=>get_opt('_reply_text'))));
	?></div>
	<?php
	}?></div>

</div>
</div>
</li>
	<?php
}