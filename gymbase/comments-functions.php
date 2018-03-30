<?php
//comment form submit
function theme_comment_form()
{
	global $themename;
	
	$result = array();
	$result["isOk"] = true;
	if($_POST["name"]!="" && $_POST["name"]!=__("Your name", 'gymbase') && $_POST["email"]!="" && $_POST["email"]!=__("Your email", 'gymbase') && preg_match("#^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$#", $_POST["email"]) && $_POST["message"]!="" && $_POST["message"]!=__("Message", 'gymbase'))
	{
		$values = array(
			"name" => $_POST["name"],
			"email" => $_POST["email"],
			"website" => $_POST["website"],
			"message" => $_POST["message"]
		);
		if((bool)ini_get("magic_quotes_gpc")) 
			$values = array_map("stripslashes", $values);
		$values = array_map("htmlspecialchars", $values);
	
		$time = current_time('mysql');

		$data = array(
			'comment_post_ID' => (int)$_POST['post_id'],
			'comment_author' => $values['name'],
			'comment_author_email' => $values['email'],
			'comment_author_url' => ($values['website']!=__("Website (optional)", 'gymbase') ? $values['website'] : ""),
			'comment_content' => $values['message'],
			'comment_date' => $time,
			'comment_approved' => ((int)get_option('comment_moderation') ? 0 : 1),
			'comment_parent' => (!empty($_POST['comment_parent_id']) ? (int)$_POST['comment_parent_id'] : 0)
		);

		if($comment_id = wp_insert_comment($data))
		{
			$result["submit_message"] = __("Your comment has been added", 'gymbase');
			if(get_option('comments_notify'))
				wp_notify_postauthor($comment_id);
			//get post comments
			//post
			query_posts("p=" . (int)$_POST['post_id'] . "&post_type=post");
			if(have_posts()) : the_post(); 
				ob_start();
				$result['comment_id'] = $comment_id;
				if((int)$_POST['comment_parent_id']==0)
				{
					global $wpdb;
					$query = "SELECT COUNT(*) AS count FROM $wpdb->comments WHERE comment_approved = 1 AND comment_post_ID = " . get_the_ID() . " AND comment_parent = 0";
					$parents = $wpdb->get_row($query);
					$_GET["paged"] = ceil($parents->count/5);
					$result["change_url"] = "#page-" . $_GET["paged"] . "/";
				}
				else
					$_GET["paged"] = (int)$_POST["paged"];
				comments_template();
				$result['html'] = ob_get_contents();
				ob_end_clean();
			endif;
		}
		else 
		{
			$result["isOk"] = false;
			$result["submit_message"] = __("Error while adding comment", 'gymbase');
		}
	}
	else
	{
		$result["isOk"] = false;
		if($_POST["name"]=="" || $_POST["name"]==__("Your name", 'gymbase'))
			$result["error_name"] = __("Please enter your name", 'gymbase');
		if($_POST["email"]=="" || $_POST["email"]==__("Your email", 'gymbase') || !preg_match("#^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$#", $_POST["email"]))
			$result["error_email"] = __("Please enter valid e-mail", 'gymbase');
		if($_POST["message"]=="" || $_POST["message"]==__("Message", 'gymbase'))
			$result["error_message"] = __("Please enter your message", 'gymbase');
	}
	echo @json_encode($result);
	exit();
}
add_action("wp_ajax_theme_comment_form", "theme_comment_form");
add_action("wp_ajax_nopriv_theme_comment_form", "theme_comment_form");

//get comments list
function theme_get_comments()
{
	$result = array();
	query_posts("p=" . $_GET["post_id"] . "&post_type=post");
	if(have_posts()) : the_post();
	ob_start();
	comments_template();
	$result["html"] = ob_get_contents();
	ob_end_clean();
	endif;
	echo @json_encode($result);
	exit();
}
add_action("wp_ajax_theme_get_comments", "theme_get_comments");
add_action("wp_ajax_nopriv_theme_get_comments", "theme_get_comments");
?>