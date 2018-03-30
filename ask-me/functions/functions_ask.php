<?php
ob_start();
function ask_members_only() {
	if (!is_user_logged_in()) ask_redirect_login();
}
/* vpanel_media_library */
add_action('pre_get_posts','vpanel_media_library');
function vpanel_media_library($wp_query_obj) {
	global $current_user,$pagenow;
	if (!is_a($current_user,'WP_User') || is_super_admin($current_user->ID))
		return;
	if ('admin-ajax.php' != $pagenow || $_REQUEST['action'] != 'query-attachments')
		return;
	if (!current_user_can('manage_media_library'))
		$wp_query_obj->set('author',$current_user->ID);
	return;
}
/* question_poll */
function question_poll() {
	$poll_id = (int)$_POST['poll_id'];
	$poll_title = stripslashes($_POST['poll_title']);
	$post_id = (int)$_POST['post_id'];

	$custom = get_post_custom($post_id);
	$asks = unserialize($custom["ask"][0]);
	
	$question_poll_num = get_post_meta($post_id,'question_poll_num',true);
	$question_poll_num++;
	update_post_meta($post_id,'question_poll_num',$question_poll_num);
	
	$needle = $asks[$poll_id];
	$value = $needle["value"];
	$user_ids = $needle["user_ids"];
	
	if ($value == "") {
		$value_end = 1;
	}else {
		$value_end = $value+1;
	}
	
	if ($user_ids == "") {
		$user_ids_end = array((get_current_user_id() != 0?get_current_user_id():0));
	}else {
		$user_ids_end = array_merge($user_ids,array((get_current_user_id() != 0?get_current_user_id():0)));
	}
	
	$replacement = array("title" => $poll_title,"value" => $value_end,"id" => $poll_id,"user_ids" => $user_ids_end);
	
	foreach ($asks as $key => $value) {
		if($value == $needle) {
			$asks[$key] = $replacement;
		}
	}
	
	$update = update_post_meta($post_id,'ask',$asks);

	if($update) {
		setcookie('question_poll'.$post_id,"ask_yes_poll",time()+3600*24*365,'/');
	}
	die();
}
add_action('wp_ajax_question_poll','question_poll');
add_action('wp_ajax_nopriv_question_poll','question_poll');
/* question_vote_up */
function question_vote_up() {
	$id = (int)$_POST['id'];
	$get_post = get_post($id);
	$user_id = $get_post->post_author;
	$point_rating_question = vpanel_options("point_rating_question");
	$active_points = vpanel_options("active_points");
	
	$count = get_post_meta($id,'question_vote',true);
	if(!$count)
		$count = 0;
	
	if ($user_id != get_current_user_id()) {
		if ($user_id > 0 && $point_rating_question > 0 && $active_points == 1){
			$add_votes = get_user_meta($user_id,"add_votes_all",true);
			if ($add_votes == "" or $add_votes == 0) {
				update_user_meta($user_id,"add_votes_all",1);
			}else {
				update_user_meta($user_id,"add_votes_all",$add_votes+1);
			}
		
			$user_vote = get_user_by("id",$user_id);
			$_points = get_user_meta($user_id,$user_vote->user_login."_points",true);
			$_points++;
		
			update_user_meta($user_id,$user_vote->user_login."_points",$_points);
			add_user_meta($user_id,$user_vote->user_login."_points_".$_points,array(date_i18n('Y/m/d',current_time('timestamp')),date_i18n('g:i a',current_time('timestamp')),($point_rating_question != ""?$point_rating_question:1),"+","rating_question",$id));
		
			$points_user = get_user_meta($user_id,"points",true);
			update_user_meta($user_id,"points",$points_user+($point_rating_question != ""?$point_rating_question:1));
		}
		
		$count++;
		$update = update_post_meta($id,'question_vote',$count);
		if($update) {
			setcookie('question_vote'.$id,"ask_yes",time()+3600*24*365,'/');
		}
	}
	echo $count;
	die();
}
add_action('wp_ajax_question_vote_up','question_vote_up');
add_action('wp_ajax_nopriv_question_vote_up','question_vote_up');
/* question_vote_down */
function question_vote_down() {
	$id = (int)$_POST['id'];
	
	$get_post = get_post($id);
	$user_id = $get_post->post_author;
	$point_rating_question = vpanel_options("point_rating_question");
	$active_points = vpanel_options("active_points");
	
	$count = get_post_meta($id,'question_vote',true);
	if(!$count)
		$count = 0;
	
	if ($user_id != get_current_user_id()) {
		if ($user_id > 0 && $point_rating_question > 0 && $active_points == 1){
			$add_votes = get_user_meta($user_id,"add_votes_all",true);
			if ($add_votes == "" or $add_votes == 0) {
				update_user_meta($user_id,"add_votes_all",1);
			}else {
				update_user_meta($user_id,"add_votes_all",$add_votes+1);
			}
			
			$user_vote = get_user_by("id",$user_id);
			$_points = get_user_meta($user_id,$user_vote->user_login."_points",true);
			$_points++;
		
			update_user_meta($user_id,$user_vote->user_login."_points",$_points);
			add_user_meta($user_id,$user_vote->user_login."_points_".$_points,array(date_i18n('Y/m/d',current_time('timestamp')),date_i18n('g:i a',current_time('timestamp')),($point_rating_question != ""?$point_rating_question:1),"-","rating_question",$id));
		
			$points_user = get_user_meta($user_id,"points",true);
			update_user_meta($user_id,"points",$points_user-($point_rating_question != ""?$point_rating_question:1));
		}
		
		$count--;
		$update = update_post_meta($id,'question_vote',$count);
		if($update) {
			setcookie('question_vote'.$id,"ask_yes",time()+3600*24*365,'/');
		}
	}
	echo $count;
	die();
}
add_action('wp_ajax_question_vote_down','question_vote_down');
add_action('wp_ajax_nopriv_question_vote_down','question_vote_down');
/* comment_vote_up */
function comment_vote_up() {
	$id = (int)$_POST['id'];
	$get_comment = get_comment($id);
	$post_id = $get_comment->comment_post_ID;
	$active_points = vpanel_options("active_points");
	
	if ($get_comment->user_id != 0 && $active_points == 1){
		$user_votes_id = $get_comment->user_id;
		$add_votes = get_user_meta($user_votes_id,"add_votes_all",true);
		if ($add_votes == "" or $add_votes == 0) {
			update_user_meta($user_votes_id,"add_votes_all",1);
		}else {
			update_user_meta($user_votes_id,"add_votes_all",$add_votes+1);
		}
	
		$current_user = $get_comment->user_id;
		$user_vote = get_user_by("id",$get_comment->user_id);
		$_points = get_user_meta($get_comment->user_id,$user_vote->user_login."_points",true);
		$_points++;
	
		update_user_meta($get_comment->user_id,$user_vote->user_login."_points",$_points);
		add_user_meta($get_comment->user_id,$user_vote->user_login."_points_".$_points,array(date_i18n('Y/m/d',current_time('timestamp')),date_i18n('g:i a',current_time('timestamp')),(vpanel_options("point_rating_answer") != ""?vpanel_options("point_rating_answer"):1),"+","rating_answer",$post_id,$id));
	
		$points_user = get_user_meta($get_comment->user_id,"points",true);
		update_user_meta($get_comment->user_id,"points",$points_user+(vpanel_options("point_rating_answer") != ""?vpanel_options("point_rating_answer"):1));
	}
	
	$count = get_comment_meta($id,'comment_vote');
	$count = (!empty($count[0]["vote"])?$count[0]["vote"]:0);
	if(!$count)
		$count = 0;
	$count++;
	$update = update_comment_meta($id,'comment_vote',array("vote" => $count,"post_id" => $post_id));
	if($update) {
		setcookie('comment_vote'.$id,"ask_yes_comment",time()+3600*24*365,'/');
	}
	echo $count;
	die();
}
add_action('wp_ajax_comment_vote_up','comment_vote_up');
add_action('wp_ajax_nopriv_comment_vote_up','comment_vote_up');
/* comment_vote_down */
function comment_vote_down() {
	$id = (int)$_POST['id'];
	$get_comment = get_comment($id);
	$post_id = $get_comment->comment_post_ID;
	$active_points = vpanel_options("active_points");
	
	if ($get_comment->user_id != 0 && $active_points == 1){
		$user_votes_id = $get_comment->user_id;
		$add_votes = get_user_meta($user_votes_id,"add_votes_all",true);
		if ($add_votes == "" or $add_votes == 0) {
			update_user_meta($user_votes_id,"add_votes_all",1);
		}else {
			update_user_meta($user_votes_id,"add_votes_all",$add_votes+1);
		}
		
		$current_user = $get_comment->user_id;
		$user_vote = get_user_by("id",$get_comment->user_id);
		$_points = get_user_meta($get_comment->user_id,$user_vote->user_login."_points",true);
		$_points++;
		
		update_user_meta($get_comment->user_id,$user_vote->user_login."_points",$_points);
		add_user_meta($get_comment->user_id,$user_vote->user_login."_points_".$_points,array(date_i18n('Y/m/d',current_time('timestamp')),date_i18n('g:i a',current_time('timestamp')),(vpanel_options("point_rating_answer") != ""?vpanel_options("point_rating_answer"):1),"-","rating_answer",$post_id,$id));
	
		$points_user = get_user_meta($get_comment->user_id,"points",true);
		update_user_meta($get_comment->user_id,"points",$points_user-(vpanel_options("point_rating_answer") != ""?vpanel_options("point_rating_answer"):1));
	}
	
	$count = get_comment_meta($id,'comment_vote');
	$count = (!empty($count[0]["vote"])?$count[0]["vote"]:0);
	if(!$count)
		$count = 0;
	$count--;
	$update = update_comment_meta($id,'comment_vote',array("vote" => $count,"post_id" => $post_id));
	if($update) {
		setcookie('comment_vote'.$id,"ask_yes_comment",time()+3600*24*365,'/');
	}
	echo $count;
	die();
}
add_action('wp_ajax_comment_vote_down','comment_vote_down');
add_action('wp_ajax_nopriv_comment_vote_down','comment_vote_down');
/* following_not */
function following_not () {
	$following_not_id = (int)$_POST["following_not_id"];
	$get_user_by_following_not_id = get_user_by("id",$following_not_id);
	$active_points = vpanel_options("active_points");
	
	$following_me = get_user_meta(get_current_user_id(),"following_me");
	$get_user_by_following_not_id = get_user_by("id",$following_not_id);
	$remove_following_me = remove_item_by_value($following_me[0],$get_user_by_following_not_id->ID);
	update_user_meta(get_current_user_id(),"following_me",$remove_following_me);
	if ($active_points == 1) {
		$points = get_user_meta($get_user_by_following_not_id->ID,"points",true);
		$new_points = $points-1;
		if ($new_points < 0) {
			$new_points = 0;
		}
		update_user_meta($get_user_by_following_not_id->ID,"points",$new_points);
		
		$_points = get_user_meta($get_user_by_following_not_id->ID,$get_user_by_following_not_id->user_login."_points",true);
		$_points++;
		
		update_user_meta($get_user_by_following_not_id->ID,$get_user_by_following_not_id->user_login."_points",$_points);
		add_user_meta($get_user_by_following_not_id->ID,$get_user_by_following_not_id->user_login."_points_".$_points,array(date_i18n('Y/m/d',current_time('timestamp')),date_i18n('g:i a',current_time('timestamp')),(vpanel_options("point_following_me") != ""?vpanel_options("point_following_me"):1),"-","user_unfollow","",""));
	}
	$following_you = get_user_meta($following_not_id,"following_you");
	$get_user_by_following_not_id2 = get_user_by("id",get_current_user_id());
	$remove_following_you = remove_item_by_value($following_you[0],$get_user_by_following_not_id2->ID);
	update_user_meta($following_not_id,"following_you",$remove_following_you);
	
	$echo_following_you = get_user_meta($following_not_id,"following_you");
	echo (isset($echo_following_you[0]) && is_array($echo_following_you[0])?count($echo_following_you[0]):0);
	die();
}
add_action('wp_ajax_following_not','following_not');
add_action('wp_ajax_nopriv_following_not','following_not');
/* following_me */
function following_me () {
	$following_you_id = (int)$_POST["following_you_id"];
	$get_user_by_following_id = get_user_by("id",$following_you_id);
	$get_user_by_following_id2 = get_user_by("id",get_current_user_id());
	$active_points = vpanel_options("active_points");

	$following_me_get = get_user_meta(get_current_user_id(),"following_me");
	if (empty($following_me_get)) {
		update_user_meta(get_current_user_id(),"following_me",array($get_user_by_following_id->ID));
	}else {
		update_user_meta(get_current_user_id(),"following_me",array_merge($following_me_get[0],array($get_user_by_following_id->ID)));
	}
	if ($active_points == 1) {
		$points_get = get_user_meta($get_user_by_following_id->ID,"points",true);
		if ($points_get == "" or $points_get == 0) {
			update_user_meta($get_user_by_following_id->ID,"points",1);
		}else {
			$new_points = $points_get+1;
			update_user_meta($get_user_by_following_id->ID,"points",$new_points);
		}
		
		$_points = get_user_meta($get_user_by_following_id->ID,$get_user_by_following_id->user_login."_points",true);
		$_points++;
		
		update_user_meta($get_user_by_following_id->ID,$get_user_by_following_id->user_login."_points",$_points);
		add_user_meta($get_user_by_following_id->ID,$get_user_by_following_id->user_login."_points_".$_points,array(date_i18n('Y/m/d',current_time('timestamp')),date_i18n('g:i a',current_time('timestamp')),(vpanel_options("point_following_me") != ""?vpanel_options("point_following_me"):1),"+","user_follow","",""));
	}

	$following_you_get = get_user_meta($following_you_id,"following_you");
	if (empty($following_you_get)) {
		update_user_meta($following_you_id,"following_you",array($get_user_by_following_id2->ID));
	}else {
		update_user_meta($following_you_id,"following_you",array_merge($following_you_get[0],array($get_user_by_following_id2->ID)));
	}
	
	$echo_following_you = get_user_meta($following_you_id,"following_you");
	echo (isset($echo_following_you[0]) && is_array($echo_following_you[0])?count($echo_following_you[0]):0);
	die();
}
add_action('wp_ajax_following_me','following_me');
add_action('wp_ajax_nopriv_following_me','following_me');
/* add_point */
function add_point () {
	$input_add_point = (int)$_POST["input_add_point"];
	$post_id = (int)$_POST["post_id"];
	$user_id = get_current_user_id();
	$user_name = get_user_by("id",$user_id);
	$points_user = get_user_meta($user_id,"points",true);
	$get_post = get_post($post_id);
	if (get_current_user_id() != $get_post->post_author) {
		_e("Sorry no mistake, this is not a question asked.","vbegy");
	}else if ($points_user >= $input_add_point) {
		if ($input_add_point == "") {
			_e("You must enter a numeric value and a value greater than zero.","vbegy");
		}else if ($input_add_point <= 0) {
			_e("You must enter a numeric value and a value greater than zero.","vbegy");
		}else {
			$question_points = get_post_meta($post_id,"question_points",true);
			if ($question_points == 0) {
				$question_points = $input_add_point;
			}else {
				$question_points = $input_add_point+$question_points;
			}
			update_post_meta($post_id,"question_points",$question_points);
			
			$_points = get_user_meta($user_id,$user_name->user_login."_points",true);
			$_points++;
			update_user_meta($user_id,$user_name->user_login."_points",$_points);
			add_user_meta($user_id,$user_name->user_login."_points_".$_points,array(date_i18n('Y/m/d',current_time('timestamp')),date_i18n('g:i a',current_time('timestamp')),$input_add_point,"-","bump_question",$post_id));
			$points_user = get_user_meta($user_id,"points",true);
			update_user_meta($user_id,"points",$points_user-$input_add_point);
			_e("You bump your question now.","vbegy");
		}
	}else {
		_e("Your points are insufficient.","vbegy");
	}
	die();
}
add_action('wp_ajax_add_point','add_point');
add_action('wp_ajax_nopriv_add_point','add_point');
/* ask_redirect_login */
function ask_redirect_login() {
	if (vpanel_options("login_page") != "") {
		wp_redirect(get_permalink(vpanel_options("login_page")));
	}else {
		wp_redirect(wp_login_url(home_url()));
	}
	exit;
}
/* ask_get_filesize */
if (!function_exists('ask_get_filesize')) {
	function ask_get_filesize( $file ) { 
		$bytes = filesize($file);
		$s = array('b', 'Kb', 'Mb', 'Gb');
		$e = floor(log($bytes)/log(1024));
		return sprintf('%.2f '.$s[$e], ($bytes/pow(1024, floor($e))));
	}
}
/* ask_human_time_diff */
if (!function_exists('ask_human_time_diff')) {
	function ask_human_time_diff( $date ) { 
		if (strtotime($date)<strtotime('NOW -7 day')) return date('jS F Y', strtotime($date));
		else return human_time_diff(strtotime($date), current_time('timestamp')) . __(' ago ','vbegy');
	}
}
/* sendEmail */
function sendEmail($fromEmail,$fromEmailName,$toEmail,$toEmailName,$subject,$message,$extra='') {
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
	$headers .= 'To: '.$toEmailName.' <'.$toEmail.'>' . "\r\n";
	$headers .= 'From: '.$fromEmailName.' <'.$fromEmail.'>' . "\r\n";
	if(wp_mail( $toEmail, $subject, $message, $headers )) {
		
	}else {
		@mail($toEmail, $subject, $message, $headers);
	}
}
/* report_q */
function report_q () {
	global $vpanel_emails,$vpanel_emails_2,$vpanel_emails_3;
	$post_id = (int)$_POST['post_id'];
	$explain = esc_attr($_POST['explain']);
	$get_post = get_post($post_id);
	
	/* option */
	$ask_option = get_option("ask_option");
	$ask_option_array = get_option("ask_option_array");
	if ($ask_option_array == "") {
		$ask_option_array = array();
	}
	if ($ask_option != "") {
		$ask_option++;
		update_option("ask_option",$ask_option);
		array_push($ask_option_array,$ask_option);
		update_option("ask_option_array",$ask_option_array);
	}else {
		$ask_option = 1;
		add_option("ask_option",$ask_option);
		add_option("ask_option_array",array($ask_option));
	}
	$ask_time = current_time('timestamp');
	/* option */
	if (get_current_user_id() > 0 && is_user_logged_in()) {
		$name_last = "";
	}else {
		$name_last = 1;
	}
	/* add option */
	add_option("ask_option_".$ask_option,array("post_id" => $post_id,"the_date" => $ask_time,"report_new" => 1,"user_id" => (get_current_user_id() != "" or get_current_user_id() != 0?get_current_user_id():""),"the_author" => $name_last,"item_id_option" => $ask_option,"value" => $explain));
	
	$post_mail = "
	".__("Hi there","vbegy")."<br />
	
	".__("Abuse have been reported on the use of the following question","vbegy")."<br />
	
	<a href=".$get_post->guid.">".$get_post->post_title."</a><br />
	
	";
	
	$last_message_email = $vpanel_emails.'<img src="'.vpanel_options("logo_email_template").'" alt="">'.$vpanel_emails_2.$post_mail.$vpanel_emails_3;
	sendEmail(get_bloginfo("admin_email"),get_bloginfo('name'),vpanel_options("email_template"),get_bloginfo('name'),__("Question report","vbegy"),$last_message_email);
	die();
}
add_action('wp_ajax_report_q','report_q');
add_action('wp_ajax_nopriv_report_q','report_q');
/* report_c */
function report_c () {
	global $vpanel_emails,$vpanel_emails_2,$vpanel_emails_3;
	$comment_id = (int)$_POST['comment_id'];
	$explain = esc_attr($_POST['explain']);
	$get_comment = get_comment($comment_id);
	
	$get_post = get_post($get_comment->comment_post_ID);
	
	/* option */
	$ask_option_answer = get_option("ask_option_answer");
	$ask_option_answer_array = get_option("ask_option_answer_array");
	if ($ask_option_answer_array == "") {
		$ask_option_answer_array = array();
	}
	if ($ask_option_answer != "") {
		$ask_option_answer++;
		update_option("ask_option_answer",$ask_option_answer);
		array_push($ask_option_answer_array,$ask_option_answer);
		update_option("ask_option_answer_array",$ask_option_answer_array);
	}else {
		$ask_option_answer = 1;
		add_option("ask_option_answer",$ask_option_answer);
		add_option("ask_option_answer_array",array($ask_option_answer));
	}
	$ask_time = current_time('timestamp');
	/* option */
	if (get_current_user_id() > 0 && is_user_logged_in()) {
		$name_last = "";
	}else {
		$name_last = 1;
	}
	/* add option */
	add_option("ask_option_answer_".$ask_option_answer,array("post_id" => $get_comment->comment_post_ID,"comment_id" => $comment_id,"the_date" => $ask_time,"report_new" => 1,"user_id" => (get_current_user_id() != "" or get_current_user_id() != 0?get_current_user_id():""),"the_author" => $name_last,"item_id_option" => $ask_option_answer,"value" => $explain));
	$post_mail = "
	".__("Hi there","vbegy")."<br />
	
	".__("Abuse have been reported on the use of the following comment","vbegy")."<br />
	
	<a href=".$get_post->guid.'#comment_'.$comment_id.">".$get_post->post_title."</a><br />
	
	";
	$last_message_email = $vpanel_emails.'<img src="'.vpanel_options("logo_email_template").'" alt="">'.$vpanel_emails_2.$post_mail.$vpanel_emails_3;
	sendEmail(get_bloginfo("admin_email"),get_bloginfo('name'),vpanel_options("email_template"),get_bloginfo('name'),__("Answer report","vbegy"),$last_message_email);
	die();
}
add_action('wp_ajax_report_c','report_c');
add_action('wp_ajax_nopriv_report_c','report_c');
/* best_answer */
function best_answer() {
	$comment_id = (int)$_POST['comment_id'];
	$get_comment = get_comment($comment_id);
	$user_id = $get_comment->user_id;
	$post_id = $get_comment->comment_post_ID;
	$post_author = get_post($post_id);
	$user_author = $post_author->post_author;
	update_post_meta($post_id,"the_best_answer",$comment_id);
	$active_points = vpanel_options("active_points");
	if ($user_id != 0 && $active_points == 1) {
		$user_name = get_user_by("id",$user_id);
		if ($user_id != $user_author) {
			$_points = get_user_meta($user_id,$user_name->user_login."_points",true);
			$_points++;
			update_user_meta($user_id,$user_name->user_login."_points",$_points);
			add_user_meta($user_id,$user_name->user_login."_points_".$_points,array(date_i18n('Y/m/d',current_time('timestamp')),date_i18n('g:i a',current_time('timestamp')),(vpanel_options("point_best_answer") != ""?vpanel_options("point_best_answer"):5),"+","select_best_answer",$post_id,$get_comment->comment_ID));
			$points_user = get_user_meta($user_id,"points",true);
			update_user_meta($user_id,"points",$points_user+(vpanel_options("point_best_answer") != ""?vpanel_options("point_best_answer"):5));
		}
		$the_best_answer_u = get_user_meta($user_id,"the_best_answer",true);
		$the_best_answer_u++;
		update_user_meta($user_id,"the_best_answer",$the_best_answer_u);
	}
	update_comment_meta($comment_id,"best_answer_comment","best_answer_comment");
	$option_name = "best_answer_option";
	$best_answer_option = get_option($option_name);
	if(!$best_answer_option)
		$best_answer_option = 0;
	$best_answer_option++;
	update_option($option_name,$best_answer_option);
	
	$point_back_option = vpanel_options("point_back");
	if ($point_back_option == 1 && $active_points == 1 && $user_id != $user_author) {
		$point_back_number = vpanel_options("point_back_number");
		$point_back = get_post_meta($post_id,"point_back",true);
		$what_point = get_post_meta($post_id,"what_point",true);
		
		if ($point_back_number > 0) {
			$what_point = $point_back_number;
		}
		
		if ($point_back == "yes" && $user_author > 0) {
			$user_name2 = get_user_by("id",$user_author);
			$_points = get_user_meta($user_author,$user_name2->user_login."_points",true);
			$_points++;
			update_user_meta($user_author,$user_name2->user_login."_points",$_points);
			add_user_meta($user_author,$user_name2->user_login."_points_".$_points,array(date_i18n('Y/m/d',current_time('timestamp')),date_i18n('g:i a',current_time('timestamp')),($what_point != ""?$what_point:vpanel_options("question_points")),"+","point_back",$post_id));
			$points_user = get_user_meta($user_author,"points",true);
			update_user_meta($user_author,"points",$points_user+($what_point != ""?$what_point:vpanel_options("question_points")));
		}
	}
	die();
}
add_action('wp_ajax_best_answer','best_answer');
add_action('wp_ajax_nopriv_best_answer','best_answer');
/* best_answer_remove */
function best_answer_re() {
	$comment_id = (int)$_POST['comment_id'];
	$get_comment = get_comment($comment_id);
	$user_id = $get_comment->user_id;
	$post_id = $get_comment->comment_post_ID;
	$post_author = get_post($post_id);
	$user_author = $post_author->post_author;
	delete_post_meta($post_id,"the_best_answer",$comment_id);
	$active_points = vpanel_options("active_points");
	if ($user_id != 0 && $active_points == 1) {
		$user_name = get_user_by("id",$user_id);
		if ($user_id != $user_author) {
			$_points = get_user_meta($user_id,$user_name->user_login."_points",true);
			$_points++;
			update_user_meta($user_id,$user_name->user_login."_points",$_points);
			add_user_meta($user_id,$user_name->user_login."_points_".$_points,array(date_i18n('Y/m/d',current_time('timestamp')),date_i18n('g:i a',current_time('timestamp')),(vpanel_options("point_best_answer") != ""?vpanel_options("point_best_answer"):5),"-","cancel_best_answer",$post_id,$get_comment->comment_ID));
			$points_user = get_user_meta($user_id,"points",true);
			update_user_meta($user_id,"points",$points_user-(vpanel_options("point_best_answer") != ""?vpanel_options("point_best_answer"):5));
		}
		$the_best_answer_u = get_user_meta($user_id,"the_best_answer",true);
		$the_best_answer_u--;
		update_user_meta($user_id,"the_best_answer",$the_best_answer_u);
	}
	delete_comment_meta($comment_id,"best_answer_comment");
	$option_name = "best_answer_option";
	$best_answer_option = get_option($option_name);
	if(!$best_answer_option)
		$best_answer_option = 0;
	$best_answer_option--;
	if($best_answer_option < 0)
		$best_answer_option = 0;
	update_option($option_name,$best_answer_option);
	
	$point_back_option = vpanel_options("point_back");
	if ($point_back_option == 1 && $active_points == 1 && $user_id != $user_author) {
		$point_back_number = vpanel_options("point_back_number");
		$point_back = get_post_meta($post_id,"point_back",true);
		$what_point = get_post_meta($post_id,"what_point",true);
		
		if ($point_back_number > 0) {
			$what_point = $point_back_number;
		}
		
		if ($point_back == "yes" && $user_author > 0) {
			$user_name2 = get_user_by("id",$user_author);
			$_points = get_user_meta($user_author,$user_name2->user_login."_points",true);
			$_points++;
			update_user_meta($user_author,$user_name2->user_login."_points",$_points);
			add_user_meta($user_author,$user_name2->user_login."_points_".$_points,array(date_i18n('Y/m/d',current_time('timestamp')),date_i18n('g:i a',current_time('timestamp')),($what_point != ""?$what_point:vpanel_options("question_points")),"-","point_removed",$post_id));
			$points_user = get_user_meta($user_author,"points",true);
			update_user_meta($user_author,"points",$points_user-($what_point != ""?$what_point:vpanel_options("question_points")));
		}
	}
	die();
}
add_action('wp_ajax_best_answer_re','best_answer_re');
add_action('wp_ajax_nopriv_best_answer_re','best_answer_re');
/* question_close */
function question_close() {
	$post_id = (int)$_POST['post_id'];
	$post_author = get_post($post_id);
	$user_author = $post_author->post_author;
	if (($user_author != 0 && $user_author == get_current_user_id()) || is_super_admin(get_current_user_id())) {
		echo $post_id." ".$user_author;
		update_post_meta($post_id,'closed_question',1);
	}
	die();
}
add_action('wp_ajax_question_close','question_close');
add_action('wp_ajax_nopriv_question_close','question_close');
/* question_open */
function question_open() {
	$post_id = (int)$_POST['post_id'];
	$post_author = get_post($post_id);
	$user_author = $post_author->post_author;
	if (($user_author != 0 && $user_author == get_current_user_id()) || is_super_admin(get_current_user_id())) {
		echo $post_id." ".$user_author;
		delete_post_meta($post_id,'closed_question');
	}
	die();
}
add_action('wp_ajax_question_open','question_open');
add_action('wp_ajax_nopriv_question_open','question_open');
/* question_follow */
function question_follow() {
	$post_id = (int)$_POST['post_id'];
	$user_id = get_current_user_id();
	
	$following_questions_user = get_user_meta(get_current_user_id(),"following_questions");
	if (empty($following_questions_user)) {
		update_user_meta(get_current_user_id(),"following_questions",array($post_id));
	}else {
		if (is_array($following_questions_user[0]) && !in_array($post_id,$following_questions_user[0])) {
			update_user_meta(get_current_user_id(),"following_questions",array_merge($following_questions_user[0],array($post_id)));
		}
	}
	
	$following_questions = get_post_meta($post_id,"following_questions");
	if (empty($following_questions)) {
		update_post_meta($post_id,"following_questions",array($user_id));
	}else {
		if (is_array($following_questions[0]) && !in_array($user_id,$following_questions[0])) {
			update_post_meta($post_id,"following_questions",array_merge($following_questions[0],array($user_id)));
		}
	}
	
	die();
}
add_action('wp_ajax_question_follow','question_follow');
add_action('wp_ajax_nopriv_question_follow','question_follow');
/* question_unfollow */
function question_unfollow() {
	$post_id = (int)$_POST['post_id'];
	$user_id = get_current_user_id();
	
	$following_questions_user = get_user_meta(get_current_user_id(),"following_questions");
	$remove_following_questions_user = remove_item_by_value($following_questions_user[0],$post_id);
	update_user_meta(get_current_user_id(),"following_questions",$remove_following_questions_user);
	
	$following_questions = get_post_meta($post_id,"following_questions");
	$remove_following_questions = remove_item_by_value($following_questions[0],get_current_user_id());
	update_post_meta($post_id,"following_questions",$remove_following_questions);
	
	die();
}
add_action('wp_ajax_question_unfollow','question_unfollow');
add_action('wp_ajax_nopriv_question_unfollow','question_unfollow');
/* comment_question_before */
add_filter ('preprocess_comment', 'comment_question_before');
function comment_question_before($commentdata) {
	$get_post_type_comment = "";
	if (!is_admin() && get_post_type($commentdata["comment_post_ID"]) != "product") {
		$the_captcha = 0;
		if (get_post_type($commentdata["comment_post_ID"]) == "question") {
			$the_captcha = vpanel_options("the_captcha_answer");
		}else {
			$the_captcha = vpanel_options("the_captcha_comment");
		}
		$captcha_style = vpanel_options("captcha_style");
		$captcha_question = vpanel_options("captcha_question");
		$captcha_answer = vpanel_options("captcha_answer");
		$show_captcha_answer = vpanel_options("show_captcha_answer");
		if ($the_captcha == 1) {
			if (empty($_POST["ask_captcha"])) {
				if ( defined( 'DOING_AJAX' ) && DOING_AJAX )
					wp_die(__("<strong>ERROR</strong>: please type a captcha.","vbegy"));
				else
					die(__("<strong>ERROR</strong>: please type a captcha.","vbegy"));
				exit;
			}
			if ($captcha_style == "question_answer") {
				if ($captcha_answer != $_POST["ask_captcha"]) {
					if ( defined( 'DOING_AJAX' ) && DOING_AJAX )
						wp_die(__('The captcha is incorrect, please try again.','vbegy'));
					else
						die(__('The captcha is incorrect, please try again.','vbegy'));
					exit;
				}
			}else {
				if (isset($_SESSION["security_code"]) && $_SESSION["security_code"] != $_POST["ask_captcha"]) {
					if ( defined( 'DOING_AJAX' ) && DOING_AJAX )
						wp_die(__('The captcha is incorrect, please try again.','vbegy'));
					else
						die(__('The captcha is incorrect, please try again.','vbegy'));
					exit;
				}
			}
		}
	}
	return $commentdata;
}
/* comment_question */
add_action ('comment_post', 'comment_question');
function comment_question($comment_id) {
	$get_comment = get_comment($comment_id);
	$get_post = get_post($get_comment->comment_post_ID);
	global $vpanel_emails,$vpanel_emails_2,$vpanel_emails_3;
	if ($get_post->post_type == "question") {
		$user_id = $get_comment->user_id;
		add_comment_meta($comment_id, 'comment_type',"question", true);
		if (isset($_FILES['attachment']) && !empty($_FILES['attachment']['name'])) :
			require_once(ABSPATH . "wp-admin" . '/includes/file.php');					
			require_once(ABSPATH . "wp-admin" . '/includes/image.php');
			$comment_attachment = wp_handle_upload($_FILES['attachment'], array('test_form'=>false), current_time('mysql'));
			if ( isset($comment_attachment['error']) ) :
				wp_die( 'Attachment Error: ' . $comment_attachment['error'] );
				exit;
			endif;
			$comment_attachment_data = array(
				'post_mime_type' => $comment_attachment['type'],
				'post_title'     => preg_replace('/\.[^.]+$/', '', basename($comment_attachment['file'])),
				'post_content'   => '',
				'post_status'    => 'inherit',
				'post_author'    => (get_current_user_id() != "" or get_current_user_id() != 0?get_current_user_id():"")
			);
			$comment_attachment_id = wp_insert_attachment( $comment_attachment_data, $comment_attachment['file'], $get_comment->comment_post_ID );
			$comment_attachment_metadata = wp_generate_attachment_metadata( $comment_attachment_id, $comment_attachment['file'] );
			wp_update_attachment_metadata( $comment_attachment_id,  $comment_attachment_metadata );
			add_comment_meta($comment_id, 'added_file',$comment_attachment_id, true);
		endif;
		
		$remember_answer = get_post_meta($get_comment->comment_post_ID,"remember_answer",true);
		
		$get_the_author = get_user_by("id",$get_post->post_author);
		$the_author = $get_the_author->user_login;
		
		if ($remember_answer == 1 && $get_post->post_author != $user_id) {
			$the_name = $get_comment->comment_author;
			
			$get_the_author = get_user_by("id",$get_post->post_author);
			$the_author = $get_the_author->user_login;
			
			if ($get_post->post_author != 0) {
				$the_mail = $get_the_author->user_email;
				$the_author = $get_the_author->display_name;
			}else {
				$the_mail = get_post_meta($get_comment->comment_post_ID, 'question_email',true);
				$the_author = get_post_meta($get_comment->comment_post_ID, 'question_username',true);
			}
			
			if ($get_comment->comment_approved == 1) {
				$post_mail = "
				".__("Hi there","vbegy")."<br />
			
				".__("We would tell you","vbegy")." ".$the_author." ".__("That the new post was added on a common theme by","vbegy")." ".$the_name." ".__("Entitled","vbegy")." ".$the_name."  ".$get_post->post_title."<br />
				
				".__("Click on the link below to go to the topic","vbegy")."<br />
				
				<a href=".get_permalink($get_comment->comment_post_ID).">".$get_post->post_title."</a><br />
				
				".__("There may be more of Posts and we hope the answer to encourage members and get them to help.","vbegy")."<br />
				
				".__("Accept from us Sincerely","vbegy")."<br />";
			}else {
				$post_mail = "
					".__("Hi there","vbegy")."<br />
				
					".__("We would tell you","vbegy")." ".$the_author." ".__("That the new post was added on a common theme by","vbegy")." ".$the_name." ".__("Entitled","vbegy")." ".$the_name."  ".$get_post->post_title."<br />
					
					".__("Somebody write an answer to your question. It is being moderated. After we found it proper, you will see it on the question page","vbegy")."<br />";
			}
			
			$last_message_email = $vpanel_emails.'<img src="'.vpanel_options("logo_email_template").'" alt="">'.$vpanel_emails_2.$post_mail.$vpanel_emails_3;
			sendEmail(get_bloginfo("admin_email"),get_bloginfo('name'),$the_mail,$the_author,__("Answer to your question","vbegy"),$last_message_email);
		}
		
		$question_follow = vpanel_options("question_follow");
		$following_questions = get_post_meta($get_comment->comment_post_ID,"following_questions");
		if ($question_follow == 1 && isset($following_questions[0]) && is_array($following_questions[0])) {
			if ($get_comment->comment_approved == 1) {
				$answer_mail = "
				".__("Hi there","vbegy")."<br />
				
				".__("There are a new answers in this question","vbegy")."<br />
				
				<a href=".get_permalink($get_comment->comment_post_ID)."#comment-".$get_comment->comment_ID.">".$get_post->post_title."</a><br />";
			}else {
				$answer_mail = "
				".__("Hi there","vbegy")."<br />
				
				".__("There are a new answers in this question","vbegy")."<br />
				
				".__("Somebody write an answer to your question. It is being moderated. After we found it proper, you will see it on the question page","vbegy")."<br />";
			}
			
			$last_message_email = $vpanel_emails.'<img src="'.vpanel_options("logo_email_template").'" alt="">'.$vpanel_emails_2.$post_mail.$vpanel_emails_3;
			foreach ( $following_questions[0] as $user ) {
				$all_meta_for_user = get_user_by('id',$user);
				sendEmail(get_bloginfo("admin_email"),get_bloginfo('name'),esc_attr($all_meta_for_user->user_email),esc_attr($all_meta_for_user->display_name),__("Hi there","vbegy"),$answer_mail);
			}
		}
		
		$active_points = vpanel_options("active_points");
		if ($user_id != 0) {
			$user_vote = get_user_by("id",$user_id);
			if ($user_id != $get_post->post_author && $active_points == 1) {
				$_points = get_user_meta($user_id,$user_vote->user_login."_points",true);
				$_points++;
				
				update_user_meta($user_id,$user_vote->user_login."_points",$_points);
				add_user_meta($user_id,$user_vote->user_login."_points_".$_points,array(date_i18n('Y/m/d',current_time('timestamp')),date_i18n('g:i a',current_time('timestamp')),(vpanel_options("point_add_comment") != ""?vpanel_options("point_add_comment"):2),"+","answer_question",$get_comment->comment_post_ID,$get_comment->comment_ID));
			
				$points_user = get_user_meta($user_id,"points",true);
				update_user_meta($user_id,"points",$points_user+(vpanel_options("point_add_comment") != ""?vpanel_options("point_add_comment"):2));
			}
			
			$add_answer = get_user_meta($user_id,"add_answer_all",true);
			$add_answer_m = get_user_meta($user_id,"add_answer_m_".date_i18n('m_Y',current_time('timestamp')),true);
			$add_answer_d = get_user_meta($user_id,"add_answer_d_".date_i18n('d_m_Y',current_time('timestamp')),true);
			if ($add_answer_d == "" or $add_answer_d == 0) {
				update_user_meta($user_id,"add_answer_d_".date_i18n('d_m_Y',current_time('timestamp')),1);
			}else {
				update_user_meta($user_id,"add_answer_d_".date_i18n('d_m_Y',current_time('timestamp')),$add_answer_d+1);
			}
			
			if ($add_answer_m == "" or $add_answer_m == 0) {
				update_user_meta($user_id,"add_answer_m_".date_i18n('m_Y',current_time('timestamp')),1);
			}else {
				update_user_meta($user_id,"add_answer_m_".date_i18n('m_Y',current_time('timestamp')),$add_answer_m+1);
			}
			
			if ($add_answer == "" or $add_answer == 0) {
				update_user_meta($user_id,"add_answer_all",1);
			}else {
				update_user_meta($user_id,"add_answer_all",$add_answer+1);
			}
	
		}
		if(!session_id()) session_start();
		if ($get_comment->comment_approved == 1) {
			$_SESSION['vbegy_session_answer'] = '<div class="alert-message success"><i class="icon-ok"></i><p><span>'.__("Added been successfully","vbegy").'</span><br>'.__("Has been Added successfully.","vbegy").'</p></div>';
		}else {
			$_SESSION['vbegy_session_answer'] = '<div class="alert-message success"><i class="icon-ok"></i><p><span>'.__("Added been successfully","vbegy").'</span><br>'.__("Has been Added successfully, the answer under review.","vbegy").'</p></div>';
		}
	}
}
/* new_post */
function new_post() {
	global $vpanel_emails,$vpanel_emails_2,$vpanel_emails_3;
	if ($_POST) :
		$return = process_new_posts();
		if ( is_wp_error($return) ) :
   			echo '<div class="ask_error"><span><p>'.$return->get_error_message().'</p></span></div>';
   		else :
   			if (get_post_type($return) == "question") {
	   			$question_publish = vpanel_options("question_publish");
	   			if ($question_publish == "draft" && !is_super_admin(get_current_user_id())) {
					if(!session_id()) session_start();
					$_SESSION['vbegy_session'] = '<div class="alert-message success"><i class="icon-ok"></i><p><span>'.__("Added been successfully","vbegy").'</span><br>'.__("Has been added successfully, the question under review.","vbegy").'</p></div>';
					wp_redirect(esc_url(home_url('/')));
				}else {
					$get_post = get_post($return);
					$send_email_new_question = vpanel_options("send_email_new_question");
					if ($send_email_new_question == 1) {
						$question_category = wp_get_post_terms($get_post->ID,'question-category',array("fields" => "all"));
						$get_question_category = get_option("questions_category_".$question_category[0]->term_id);
						$yes_private = 0;
						if (isset($question_category[0])) {
							if (isset($question_category[0]) && isset($get_question_category['private']) && $get_question_category['private'] == "on") {
								if (isset($authordata->ID) && $authordata->ID > 0 && $authordata->ID == get_current_user_id()) {
									$yes_private = 1;
								}
							}else if (isset($question_category[0]) && !isset($get_question_category['private']) && $question_category[0]->parent == 0) {
								$yes_private = 1;
							}
							
							if (isset($question_category[0]) && $question_category[0]->parent > 0) {
								$get_question_category_parent = get_option("questions_category_".$question_category[0]->parent);
								$yes_private = 0;
								if (isset($get_question_category_parent[0]) && isset($get_question_category_parent['private']) && $get_question_category_parent['private'] == "on") {
									if (isset($authordata->ID) && $authordata->ID > 0 && $authordata->ID == get_current_user_id()) {
										$yes_private = 1;
									}
								}else if (isset($get_question_category_parent[0]) && !isset($get_question_category_parent['private']) && isset($get_question_category_parent[0]->parent) && $get_question_category_parent[0]->parent == 0) {
									$yes_private = 1;
								}
							}
						}else {
							$yes_private = 1;
						}
						if (is_super_admin(get_current_user_id())) {
							$yes_private = 1;
						}
						if ($yes_private == 1) {
							$users = get_users('blog_id=1&orderby=registered');
							$send_email_question_groups = vpanel_options("send_email_question_groups");
							if (isset($send_email_question_groups) && is_array($send_email_question_groups)) {
								foreach ($send_email_question_groups as $key => $value) {
									if ($value == 1) {
										$send_email_question_groups[$key] = $key;
									}else {
										unset($send_email_question_groups[$key]);
									}
								}
							}
							$post_mail = "
							".__("Hi there","vbegy")."<br />
							
							".__("There are a new question","vbegy")."<br />
							
							<a href=".$get_post->guid.">".$get_post->post_title."</a><br />
							
							";
							$last_message_email = $vpanel_emails.'<img src="'.vpanel_options("logo_email_template").'" alt="">'.$vpanel_emails_2.$post_mail.$vpanel_emails_3;
							foreach ( $users as $user ) {
								$received_email = esc_attr( get_the_author_meta( 'received_email', $user->ID ) );
								if (is_array($send_email_question_groups) && in_array($user->roles[0],$send_email_question_groups) && $received_email == 1) {
									sendEmail(get_bloginfo("admin_email"),get_bloginfo('name'),esc_attr($user->user_email),esc_attr($user->display_name),__("New question","vbegy"),$last_message_email);
								}
							}
						}
					}
					wp_redirect(get_permalink($return));
				}
			}else if (get_post_type($return) == "post") {
				$post_publish = vpanel_options("post_publish");
				if ($post_publish == "draft" && !is_super_admin(get_current_user_id())) {
					if(!session_id()) session_start();
					$_SESSION['vbegy_session_post'] = '<div class="alert-message success"><i class="icon-ok"></i><p><span>'.__("Added been successfully","vbegy").'</span><br>'.__("Has been added successfully, the post under review.","vbegy").'</p></div>';
					wp_redirect(esc_url(home_url('/')));
				}else {
					$get_post = get_post($return);
					wp_redirect(get_permalink($return));
				}
			}
			exit;
   		endif;
	endif;
}
add_action('new_post', 'new_post');
/* process_new_posts */
function process_new_posts() {
	global $posted;
	set_time_limit(0);
	$errors = new WP_Error();
	$posted = array();
	
	$post_type = (isset($_POST["post_type"]) && $_POST["post_type"] != ""?$_POST["post_type"]:"");
	if ($post_type == "add_question") {
		$video_desc_active = vpanel_options("video_desc_active");
		$ask_question_no_register = vpanel_options("ask_question_no_register");
		$question_points_active = vpanel_options("question_points_active");
		$question_points = vpanel_options("question_points");
		$points = get_user_meta(get_current_user_id(),"points",true);
		$points = ($points != ""?$points:0);
		
		$fields = array(
			'title','category','comment','question_poll','remember_answer','question_tags','video_type','video_id','video_description','attachment','attachment_m','ask_captcha','username','email','agree_terms'
		);
		
		foreach ($fields as $field) :
			if (isset($_POST[$field])) $posted[$field] = $_POST[$field]; else $posted[$field] = '';
		endforeach;
		
		if ($points < $question_points && $question_points_active == 1) $errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.sprintf(__("Sorry do not have the minimum points Please do answer questions, even gaining points ( The minimum points = %s ).","vbegy"),$question_points));
		
		if (!is_user_logged_in() && $ask_question_no_register == 1 && get_current_user_id() == 0) {
			if (empty($posted['username'])) $errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("There are required fields ( username ).","vbegy"));
			if (empty($posted['email'])) $errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("There are required fields ( email ).","vbegy"));
			if (!is_email($posted['email'])) $errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("Please write correctly email.","vbegy"));
		}
		
		/* Validate Required Fields */
		if (empty($posted['title'])) $errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("There are required fields ( title ).","vbegy"));
		if (empty($posted['category']) || $posted['category'] == '-1') $errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("There are required fields ( category ).","vbegy"));
		if (isset($posted['question_poll']) && $posted['question_poll'] == 1) {
			foreach($_POST['ask'] as $ask) {
				if (empty($ask['ask']) && count($_POST['ask']) < 2) $errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("Please enter at least two values in poll.","vbegy"));
			}
		}
		
		if (vpanel_options("comment_question") == 1) {
			if (empty($posted['comment'])) $errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("There are required fields ( content ).","vbegy"));
		}
		if ($video_desc_active == 1 && $posted['video_description'] == 1 && empty($posted['video_id'])) $errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("There are required fields ( Video ID ).","vbegy"));
		
		$the_captcha = vpanel_options("the_captcha");
		$captcha_style = vpanel_options("captcha_style");
		$captcha_question = vpanel_options("captcha_question");
		$captcha_answer = vpanel_options("captcha_answer");
		$show_captcha_answer = vpanel_options("show_captcha_answer");
		if ($the_captcha == 1) {
			if (empty($posted["ask_captcha"])) {
				$errors->add('required-captcha', __("There are required fields ( captcha ).","vbegy"));
			}
			if ($captcha_style == "question_answer") {
				if ($captcha_answer != $posted["ask_captcha"]) {
					$errors->add('required-captcha-error', __('The captcha is incorrect, please try again.','vbegy'));
				}
			}else {
				if (isset($_SESSION["security_code"]) && $_SESSION["security_code"] != $posted["ask_captcha"]) {
					$errors->add('required-captcha-error', __('The captcha is incorrect, please try again.','vbegy'));
				}
			}
		}
		
		$terms_avtive = vpanel_options("terms_avtive");
		if ($terms_avtive == 1 && $posted['agree_terms'] != 1) {
			$errors->add('required-terms', __("There are required fields ( Agree of the terms ).","vbegy"));
		}
		
		if (sizeof($errors->errors)>0) return $errors;
		
		/* Create question */
		$question_publish = vpanel_options("question_publish");
		$data = array(
			'post_content' => ($posted['comment']),
			'post_title'   => sanitize_text_field($posted['title']),
			'post_status'  => ($question_publish == "draft" && !is_super_admin(get_current_user_id())?"draft":"publish"),
			'post_author'  => (!is_user_logged_in() && $ask_question_no_register == 1?0:get_current_user_id()),
			'post_type'    => 'question',
		);
			
		$post_id = wp_insert_post($data);
			
		if ($post_id==0 || is_wp_error($post_id)) wp_die(__("Error in question.","vbegy"));
		
		$terms = array();
		if ($posted['category']) $terms[] = get_term_by( 'id', $posted['category'], 'question-category')->slug;
		if (sizeof($terms)>0) wp_set_object_terms($post_id, $terms, 'question-category');
	
		if ($posted['question_poll'])  {
			update_post_meta($post_id, 'question_poll', $posted['question_poll']);
		}else {
			update_post_meta($post_id, 'question_poll', 2);
		}
	
		if (isset($_POST['ask'])) 
			update_post_meta($post_id, 'ask', $_POST['ask']);
		
		if ($posted['remember_answer']) 
			update_post_meta($post_id, 'remember_answer', $posted['remember_answer']);
		
		if ($video_desc_active == 1) {
			if ($posted['video_description']) 
				update_post_meta($post_id, 'video_description', $posted['video_description']);
			
			if ($posted['video_type']) 
				update_post_meta($post_id, 'video_type', $posted['video_type']);
				
			if ($posted['video_id']) 
				update_post_meta($post_id, 'video_id', $posted['video_id']);	
		}
		
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		require_once( ABSPATH . 'wp-admin/includes/image.php' );
		
		$files = $_FILES['attachment_m'];
		if (isset($files) && $files) {
			foreach ($files['name'] as $key => $value) {
				if ($files['name'][$key]) {
					$file = array(
						'name'     => $files['name'][$key]["file_url"],
						'type'     => $files['type'][$key]["file_url"],
						'tmp_name' => $files['tmp_name'][$key]["file_url"],
						'error'    => $files['error'][$key]["file_url"],
						'size'     => $files['size'][$key]["file_url"]
					);
					if ($files['error'][$key]["file_url"] != 0) {
						unset($files['name'][$key]);
						unset($files['type'][$key]);
						unset($files['tmp_name'][$key]);
						unset($files['error'][$key]);
						unset($files['size'][$key]);
					}
				}
			}
		}
		
		if (isset($files) && $files) {
			foreach ($files['name'] as $key => $value) {
				if ($files['name'][$key]) {
					$file = array(
						'name'     => $files['name'][$key]["file_url"],
						'type'     => $files['type'][$key]["file_url"],
						'tmp_name' => $files['tmp_name'][$key]["file_url"],
						'error'    => $files['error'][$key]["file_url"],
						'size'     => $files['size'][$key]["file_url"]
					);
					$attachment = wp_handle_upload($file, array('test_form'=>false), current_time('mysql'));
					if ( !isset($attachment['error']) && $attachment ) :
						//$errors->add('upload-error', __("Attachment Error: ","vbegy") . $attachment['error'] );
						$attachment_data = array(
							'post_mime_type' => $attachment['type'],
							'post_title'     => preg_replace('/\.[^.]+$/', '', basename($attachment['file'])),
							'post_content'   => '',
							'post_status'    => 'inherit',
							'post_author'    => (!is_user_logged_in() && $ask_question_no_register == 1?0:get_current_user_id())
						);
						$attachment_id = wp_insert_attachment($attachment_data,$attachment['file'],$post_id);
						$attachment_metadata = wp_generate_attachment_metadata($attachment_id,$attachment['file']);
						wp_update_attachment_metadata($attachment_id,$attachment_metadata);
						$attachment_m_array[] = array("added_file" => $attachment_id);
					endif;
				}
				if (get_post_meta($post_id, 'attachment_m')) {
					delete_post_meta($post_id, 'attachment_m');
					add_post_meta($post_id, 'attachment_m',$attachment_m_array);
				}else {
					add_post_meta($post_id, 'attachment_m',$attachment_m_array);
				}
			}
		}
		
		/* Tags */
		
		if (isset($posted['question_tags']) && $posted['question_tags']) :
					
			$tags = explode(',', trim(stripslashes($posted['question_tags'])));
			$tags = array_map('strtolower', $tags);
			$tags = array_map('trim', $tags);
	
			if (sizeof($tags)>0) :
				wp_set_object_terms($post_id, $tags, 'question_tags');
			endif;
			
		endif;
		
		if (!is_user_logged_in() && $ask_question_no_register == 1 && get_current_user_id() == 0) {
			$question_username = sanitize_text_field($posted['username']);
			$question_email = sanitize_text_field($posted['email']);
			update_post_meta($post_id, 'question_username', $question_username);
			update_post_meta($post_id, 'question_email', $question_email);
		}else {
			$user_id = get_current_user_id();
			
			$pay_ask = vpanel_options("pay_ask");
			if ($pay_ask == 1) {
				$_allow_to_ask = get_user_meta($user_id,$user_id."_allow_to_ask",true);
				if(!$_allow_to_ask)
					$_allow_to_ask = 0;
				$_allow_to_ask--;
				update_user_meta($user_id,$user_id."_allow_to_ask",$_allow_to_ask);
			}
			
			$point_add_question = vpanel_options("point_add_question");
			$active_points = vpanel_options("active_points");
			if ($point_add_question > 0 && $active_points == 1) {
				$current_user = get_user_by("id",$user_id);
				$_points = get_user_meta($user_id,$current_user->user_login."_points",true);
				$_points++;
			
				update_user_meta($user_id,$current_user->user_login."_points",$_points);
				add_user_meta($user_id,$current_user->user_login."_points_".$_points,array(date_i18n('Y/m/d',current_time('timestamp')),date_i18n('g:i a',current_time('timestamp')),$point_add_question,"+","add_question",$post_id));
			
				$points_user = get_user_meta($user_id,"points",true);
				$last_points = $points_user+$point_add_question;
				update_user_meta($user_id,"points",$last_points);
			}
			
			if ($points && $question_points_active == 1) {
				$current_user = get_user_by("id",$user_id);
				$_points = get_user_meta($user_id,$current_user->user_login."_points",true);
				$_points++;
			
				update_user_meta($user_id,$current_user->user_login."_points",$_points);
				add_user_meta($user_id,$current_user->user_login."_points_".$_points,array(date_i18n('Y/m/d',current_time('timestamp')),date_i18n('g:i a',current_time('timestamp')),$question_points,"-","question_point",$post_id));
			
				$points_user = get_user_meta($user_id,"points",true);
				$last_points = $points_user-$question_points;
				update_user_meta($user_id,"points",$last_points);
				
				update_post_meta($post_id, "point_back", "yes");
				update_post_meta($post_id, "what_point", $question_points);
			}
			
			$add_questions = get_user_meta($user_id,"add_questions_all",true);
			$add_questions_m = get_user_meta($user_id,"add_questions_m_".date_i18n('m_Y',current_time('timestamp')),true);
			$add_questions_d = get_user_meta($user_id,"add_questions_d_".date_i18n('d_m_Y',current_time('timestamp')),true);
			if ($add_questions_d == "" or $add_questions_d == 0) {
				update_user_meta($user_id,"add_questions_d_".date_i18n('d_m_Y',current_time('timestamp')),1);
			}else {
				update_user_meta($user_id,"add_questions_d_".date_i18n('d_m_Y',current_time('timestamp')),$add_questions_d+1);
			}
			
			if ($add_questions_m == "" or $add_questions_m == 0) {
				update_user_meta($user_id,"add_questions_m_".date_i18n('m_Y',current_time('timestamp')),1);
			}else {
				update_user_meta($user_id,"add_questions_m_".date_i18n('m_Y',current_time('timestamp')),$add_questions_m+1);
			}
			
			if ($add_questions == "" or $add_questions == 0) {
				update_user_meta($user_id,"add_questions_all",1);
			}else {
				update_user_meta($user_id,"add_questions_all",$add_questions+1);
			}
			
		}
		
		/* The default meta */
		update_post_meta($post_id, "vbegy_layout", "default");
		update_post_meta($post_id, "vbegy_home_template", "default");
		update_post_meta($post_id, "vbegy_site_skin_l", "default");
		update_post_meta($post_id, "vbegy_skin", "default");
		update_post_meta($post_id, "vbegy_sidebar", "default");
	
		do_action('new_questions', $post_id);
	}else if ($post_type == "add_post") {
		$add_post_no_register = vpanel_options("add_post_no_register");
		
		$fields = array(
			'title','comment','category','post_tag','attachment','ask_captcha','username','email'
		);
		
		foreach ($fields as $field) :
			if (isset($_POST[$field])) $posted[$field] = $_POST[$field]; else $posted[$field] = '';
		endforeach;
		
		if (!is_user_logged_in() && $add_post_no_register == 1 && get_current_user_id() == 0) {
			if (empty($posted['username'])) $errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("There are required fields ( username ).","vbegy"));
			if (empty($posted['email'])) $errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("There are required fields ( email ).","vbegy"));
			if (!is_email($posted['email'])) $errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("Please write correctly email.","vbegy"));
		}
		
		/* Validate Required Fields */
		if (empty($posted['title'])) $errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("There are required fields ( title ).","vbegy"));
		if (empty($posted['category']) || $posted['category'] == '-1') $errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("There are required fields ( category ).","vbegy"));
		if (vpanel_options("content_post") == 1) {
			if (empty($posted['comment'])) $errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("There are required fields ( details ).","vbegy"));
		}
		
		$the_captcha_post = vpanel_options("the_captcha_post");
		$captcha_style = vpanel_options("captcha_style");
		$captcha_question = vpanel_options("captcha_question");
		$captcha_answer = vpanel_options("captcha_answer");
		$show_captcha_answer = vpanel_options("show_captcha_answer");
		if ($the_captcha_post == 1) {
			if (empty($posted["ask_captcha"])) {
				$errors->add('required-captcha', __("There are required fields ( captcha ).","vbegy"));
			}
			if ($captcha_style == "question_answer") {
				if ($captcha_answer != $posted["ask_captcha"]) {
					$errors->add('required-captcha-error', __('The captcha is incorrect, please try again.','vbegy'));
				}
			}else {
				if (isset($_SESSION["security_code"]) && $_SESSION["security_code"] != $posted["ask_captcha"]) {
					$errors->add('required-captcha-error', __('The captcha is incorrect, please try again.','vbegy'));
				}
			}
		}
		
		if (sizeof($errors->errors)>0) return $errors;
		
		/* Create post */
		$post_publish = vpanel_options("post_publish");
		$data = array(
			'post_content' => wp_kses_post($posted['comment']),
			'post_title'   => sanitize_text_field($posted['title']),
			'post_status'  => ($post_publish == "draft" && !is_super_admin(get_current_user_id())?"draft":"publish"),
			'post_author'  => (!is_user_logged_in() && $add_post_no_register == 1?0:get_current_user_id()),
			'post_type'    => 'post',
		);
			
		$post_id = wp_insert_post($data);
			
		if ($post_id==0 || is_wp_error($post_id)) wp_die(__("Error in post.","vbegy"));
		
		$terms = array();
		if ($posted['category']) $terms[] = get_term_by( 'id', $posted['category'], 'category')->slug;
		if (sizeof($terms)>0) wp_set_object_terms($post_id, $terms, 'category');
	
		$attachment = '';
	
		require_once(ABSPATH . "wp-admin" . '/includes/image.php');
		require_once(ABSPATH . "wp-admin" . '/includes/file.php');
			
		if(isset($_FILES['attachment']) && !empty($_FILES['attachment']['name'])) :
				
			$attachment = wp_handle_upload($_FILES['attachment'], array('test_form'=>false), current_time('mysql'));
						
			if ( isset($attachment['error']) ) :
				$errors->add('upload-error', __("Attachment Error: ","vbegy") . $attachment['error'] );
				
				return $errors;
			endif;
			
		endif;
		if ($attachment) :
			$attachment_data = array(
				'post_mime_type' => $attachment['type'],
				'post_title'     => preg_replace('/\.[^.]+$/', '', basename($attachment['file'])),
				'post_content'   => '',
				'post_status'    => 'inherit',
				'post_author'    => (!is_user_logged_in() && $add_post_no_register == 1?0:get_current_user_id())
			);
			$attachment_id = wp_insert_attachment( $attachment_data, $attachment['file'], $post_id );
			$attachment_metadata = wp_generate_attachment_metadata( $attachment_id, $attachment['file'] );
			wp_update_attachment_metadata( $attachment_id,  $attachment_metadata );
			$set_post_thumbnail = set_post_thumbnail( $post_id, $attachment_id );
			if (!$set_post_thumbnail) {
				add_post_meta($post_id, 'added_file',$attachment_id, true);
			}
		endif;
		
		/* Tags */
		
		if (isset($posted['post_tag']) && $posted['post_tag']) :
					
			$tags = explode(',', trim(stripslashes($posted['post_tag'])));
			$tags = array_map('strtolower', $tags);
			$tags = array_map('trim', $tags);
	
			if (sizeof($tags)>0) :
				wp_set_object_terms($post_id, $tags, 'post_tag');
			endif;
			
		endif;
		
		if (!is_user_logged_in() && $add_post_no_register == 1 && get_current_user_id() == 0) {
			$post_username = sanitize_text_field($posted['username']);
			$post_email = sanitize_text_field($posted['email']);
			update_post_meta($post_id, 'post_username', $post_username);
			update_post_meta($post_id, 'post_email', $post_email);
		}
		
		/* The default meta */
		update_post_meta($post_id, "vbegy_layout", "default");
		update_post_meta($post_id, "vbegy_home_template", "default");
		update_post_meta($post_id, "vbegy_site_skin_l", "default");
		update_post_meta($post_id, "vbegy_skin", "default");
		update_post_meta($post_id, "vbegy_sidebar", "default");
	
		do_action('new_posts', $post_id);
	}
	if ($post_type == "add_question" || $post_type == "add_post") {
		/* Successful */
		return $post_id;
	}
}
/* run_on_update_post */
function run_on_update_post($post_ID) {
	global $vpanel_emails,$vpanel_emails_2,$vpanel_emails_3;
    $question_username = get_post_meta($post_ID, 'question_username', true);
    $question_email = get_post_meta($post_ID, 'question_email', true);
    $post_username = get_post_meta($post_ID, 'post_username', true);
    $post_email = get_post_meta($post_ID, 'post_email', true);
    
    $post_data = get_post($post_ID);
    $send_email_new_question = vpanel_options("send_email_new_question");
    if ($send_email_new_question == 1 && $post_data->post_status == "draft" && $post_data->post_type == "question" && is_admin()) {
    	$question_category = wp_get_post_terms($post_ID,'question-category',array("fields" => "all"));
    	$get_question_category = get_option("questions_category_".$question_category[0]->term_id);
		$users = get_users('blog_id=1&orderby=registered');
		$send_email_question_groups = vpanel_options("send_email_question_groups");
		if (isset($send_email_question_groups) && is_array($send_email_question_groups)) {
			foreach ($send_email_question_groups as $key => $value) {
				if ($value == 1) {
					$send_email_question_groups[$key] = $key;
				}else {
					unset($send_email_question_groups[$key]);
				}
			}
		}
		$post_mail = "
		".__("Hi there","vbegy")."<br />
		
		".__("There are a new question","vbegy")."<br />
		
		<a href=".$post_data->guid.">".$post_data->post_title."</a><br />
		
		";
		$last_message_email = $vpanel_emails.'<img src="'.vpanel_options("logo_email_template").'" alt="">'.$vpanel_emails_2.$post_mail.$vpanel_emails_3;
		foreach ( $users as $user ) {
			if (is_array($send_email_question_groups) && in_array($user->roles[0],$send_email_question_groups)) {
				$yes_private = 0;
				if (isset($question_category[0])) {
					if (isset($question_category[0]) && isset($get_question_category['private']) && $get_question_category['private'] == "on") {
						if (isset($post_data->post_author) && $post_data->post_author > 0 && $post_data->post_author == $user->ID) {
							$yes_private = 1;
						}
					}else if (isset($question_category[0]) && !isset($get_question_category['private']) && $question_category[0]->parent == 0) {
						$yes_private = 1;
					}
					
					if (isset($question_category[0]) && $question_category[0]->parent > 0) {
						$get_question_category_parent = get_option("questions_category_".$question_category[0]->parent);
						$yes_private = 0;
						if (isset($get_question_category_parent[0]) && isset($get_question_category_parent['private']) && $get_question_category_parent['private'] == "on") {
							if (isset($post_data->post_author) && $post_data->post_author > 0 && $post_data->post_author == $user->ID) {
								$yes_private = 1;
							}
						}else if (isset($get_question_category_parent[0]) && !isset($get_question_category_parent['private']) && isset($get_question_category_parent[0]->parent) && $get_question_category_parent[0]->parent == 0) {
							$yes_private = 1;
						}
					}
				}else {
					$yes_private = 1;
				}
				if (is_super_admin($user->ID)) {
					$yes_private = 1;
				}
				
				if ($yes_private == 1) {
					$received_email = esc_attr( get_the_author_meta( 'received_email', $user->ID ) );
					if ($received_email == 1) {
						sendEmail(get_bloginfo("admin_email"),get_bloginfo('name'),esc_attr($user->user_email),esc_attr($user->display_name),__("New question","vbegy"),$last_message_email);
					}
				}
			}
		}
    }
    
    if ((isset($question_username) && $question_username != "" && isset($question_email) && $question_email != "") || (isset($post_username) && $post_username != "" && isset($post_email) && $post_email != "")) {
        $data = array(
        	'ID' => $post_ID,
        	'post_author' => "No_user",
        );
        remove_action('save_post', 'run_on_update_post');
        remove_action('pre_post_update', 'run_on_update_post');
    	wp_update_post($data);
    	add_action('save_post', 'run_on_update_post');
    	add_action('pre_post_update', 'run_on_update_post');
    }
}
add_action('pre_post_update', 'run_on_update_post');
add_action('save_post', 'run_on_update_post');
/* edit_question */
function edit_question() {
	if ($_POST) :
		$return = process_edit_questions();
		if ( is_wp_error($return) ) :
   			echo '<div class="ask_error"><span><p>'.$return->get_error_message().'</p></span></div>';
   		else :
   			if(!session_id()) session_start();
   			$question_approved = vpanel_options("question_approved");
			if ($question_approved == 1 || is_super_admin(get_current_user_id())) {
				$_SESSION['vbegy_session_e'] = '<div class="alert-message success"><i class="icon-ok"></i><p><span>'.__("Edited been successfully","vbegy").'</span><br>'.__("Has been edited successfully.","vbegy").'</p></div>';
				wp_redirect(get_permalink($return));
			}else {
				$_SESSION['vbegy_session_e'] = '<div class="alert-message success"><i class="icon-ok"></i><p><span>'.__("Edited been successfully","vbegy").'</span><br>'.__("Has been added successfully, the question under review.","vbegy").'</p></div>';
				wp_redirect(esc_url(home_url('/')));
			}
			exit;
   		endif;
	endif;
}
add_action('edit_question', 'edit_question');
/* process_edit_questions */
function process_edit_questions() {
	global $posted;
	set_time_limit(0);
	$errors = new WP_Error();
	$posted = array();
	$video_desc_active = vpanel_options("video_desc_active");
	
	$fields = array(
		'ID','title','comment','category','question_poll','remember_answer','question_tags','video_type','video_id','video_description'
	);
	
	foreach ($fields as $field) :
		if (isset($_POST[$field])) $posted[$field] = $_POST[$field]; else $posted[$field] = '';
	endforeach;
	/* Validate Required Fields */
	
	$get_question = (isset($posted['ID'])?(int)$posted['ID']:0);
	$get_post_q = get_post($get_question);
	if (isset($get_question) && $get_question != 0 && $get_post_q && get_post_type($get_question) == "question") {
		$user_login_id_l = get_user_by("id",$get_post_q->post_author);
		if ($user_login_id_l->ID != get_current_user_id()) {
			$errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("Sorry you can't edit this question.","vbegy"));
		}
	}else {
		$errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("Sorry no question select or not found.","vbegy"));
	}
	if (empty($posted['title'])) $errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("There are required fields ( title ).","vbegy"));
	if (empty($posted['category']) || $posted['category'] == '-1') $errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("There are required fields ( category ).","vbegy"));
	if (isset($posted['question_poll']) && $posted['question_poll'] == 1) {
		foreach($_POST['ask'] as $ask) {
			if (empty($ask['ask']) && count($_POST['ask']) < 2) $errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("Please enter at least two values in poll.","vbegy"));
		}
	}
	if (vpanel_options("comment_question") == 1) {
		if (empty($posted['comment'])) $errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("There are required fields ( content ).","vbegy"));
	}
	if ($video_desc_active == 1 && $posted['video_description'] == 1 && empty($posted['video_id'])) $errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("There are required fields ( Video ID ).","vbegy"));
	if (sizeof($errors->errors)>0) return $errors;
	
	$question_id = $get_question;
	
	$question_approved = vpanel_options("question_approved");
	
	/* Edit question */
	$data = array(
		'ID'           => (int)sanitize_text_field($question_id),
		'post_content' => wp_kses_post($posted['comment']),
		'post_title'   => sanitize_text_field($posted['title']),
		'post_name'    => sanitize_text_field($posted['title']),
		'post_status'  => ($question_approved == 1 || is_super_admin(get_current_user_id())?"publish":"draft"),
	);
	
	wp_update_post($data);
	
	$terms = array();
	if ($posted['category']) $terms[] = get_term_by( 'id', $posted['category'], 'question-category')->slug;
	if (sizeof($terms)>0) wp_set_object_terms($question_id, $terms, 'question-category');

	if ($posted['question_poll'] && $posted['question_poll'] != "")  {
		update_post_meta($question_id, 'question_poll', $posted['question_poll']);
	}else {
		update_post_meta($question_id, 'question_poll', 2);
	}

	if ($_POST['ask']) 
		update_post_meta($question_id, 'ask', $_POST['ask']);
	
	if ($posted['remember_answer'] && $posted['remember_answer'] != "") {
		update_post_meta($question_id, 'remember_answer', $posted['remember_answer']);
	}else {
		delete_post_meta($question_id, 'remember_answer');
	}
	
	if ($video_desc_active == 1) {
		if ($posted['video_description'] && $posted['video_description'] != "") {
			update_post_meta($question_id, 'video_description', $posted['video_description']);
		}else {
			delete_post_meta($question_id, 'video_description');
		}
		
		if ($posted['video_type']) 
			update_post_meta($question_id, 'video_type', $posted['video_type']);
			
		if ($posted['video_id']) 
			update_post_meta($question_id, 'video_id', $posted['video_id']);	
	}
	
	/* Tags */
	
	if (isset($posted['question_tags']) && $posted['question_tags']) :
				
		$tags = explode(',', trim(stripslashes($posted['question_tags'])));
		$tags = array_map('strtolower', $tags);
		$tags = array_map('trim', $tags);

		if (sizeof($tags)>0) :
			wp_set_object_terms($question_id, $tags, 'question_tags');
		endif;
		
	endif;

	do_action('edit_questions', $question_id);
	
	/* Successful */
	return $question_id;
}
/* vpanel_edit_comment */
function vpanel_edit_comment() {
	if ($_POST) :
		$return = process_edit_comments();
		if ( is_wp_error($return) ) :
   			echo '<div class="ask_error"><span><p>'.$return->get_error_message().'</p></span></div>';
   		else :
   			if(!session_id()) session_start();
   			$comment_approved = vpanel_options("comment_approved");
   			if ($comment_approved == 1 || is_super_admin(get_current_user_id())) {
   				$_SESSION['vbegy_session_comment'] = '<div class="alert-message success"><i class="icon-ok"></i><p><span>'.__("Edited been successfully","vbegy").'</span><br>'.__("Has been edited successfully.","vbegy").'</p></div>';
   			}else {
   				$_SESSION['vbegy_session_comment'] = '<div class="alert-message success"><i class="icon-ok"></i><p><span>'.__("Edited been successfully","vbegy").'</span><br>'.__("Has been added successfully, the comment under review.","vbegy").'</p></div>';
   			}
			wp_redirect(get_comment_link($return));
			exit;
   		endif;
	endif;
}
add_action('vpanel_edit_comment', 'vpanel_edit_comment');
/* process_edit_comments */
function process_edit_comments() {
	global $posted;
	set_time_limit(0);
	$errors = new WP_Error();
	$posted = array();
	
	$fields = array(
		'comment_id','comment_content'
	);
	
	foreach ($fields as $field) :
		if (isset($_POST[$field])) $posted[$field] = $_POST[$field]; else $posted[$field] = '';
	endforeach;
	/* Validate Required Fields */
	
	$comment_id = (isset($posted['comment_id'])?(int)$posted['comment_id']:0);
	$comment_content = (isset($posted["comment_content"])?wp_kses_post($posted["comment_content"]):"");
	
	$get_comment = get_comment($comment_id);
	$get_post = array();
	if (isset($comment_id) && $comment_id != 0 && is_object($get_comment)) {
		$get_post = get_post($get_comment->comment_post_ID);
	}
	
	if (isset($comment_id) && $comment_id != 0 && $get_post) {
		$can_edit_comment = vpanel_options("can_edit_comment");
		$comment_approved = vpanel_options("comment_approved");
		if ($can_edit_comment != 1 || $get_comment->user_id != get_current_user_id()) {
			$errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("You are not allowed to edit this comment.","vbegy"));
		}
	}else {
		$errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("Sorry no comment has you select or not found.","vbegy"));
	}
	
	if (empty($comment_content)) $errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("There are required fields ( comment ).","vbegy"));
	if (isset($comment_content) && $comment_content == $get_comment->comment_content) $errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("You don't modify anything this is the same comment!.","vbegy"));
	if (sizeof($errors->errors)>0) return $errors;
	
	/* Edit comment */
	$data['comment_ID'] = $comment_id;
	if (!isset($comment_approved) || $comment_approved == 0) {
		$data['comment_approved'] = 0;
	}
	$data['comment_content']  = $comment_content;
	
	wp_update_comment($data);
	
	update_comment_meta($comment_id,"edit_comment","edited");

	do_action('vpanel_edit_comments', $comment_id);
	
	/* Successful */
	return $comment_id;
}
/* vpanel_session */
function vpanel_session ($message = "",$session = "") {
	if(!session_id())
		session_start();
	if ($message) {
		$_SESSION[$session] = $message;
	}else {
		if (isset($_SESSION[$session])) {
			$last_message = $_SESSION[$session];
			unset($_SESSION[$session]);
			echo $last_message;
		}
	}
}
/* vpanel_edit_post */
function vpanel_edit_post() {
	if ($_POST) :
		$return = process_vpanel_edit_posts();
		if ( is_wp_error($return) ) :
   			echo '<div class="ask_error"><span><p>'.$return->get_error_message().'</p></span></div>';
   		else :
   			if(!session_id()) session_start();
			$post_approved = vpanel_options("post_approved");
   			if ($post_approved == 1 || is_super_admin(get_current_user_id())) {
   				$_SESSION['vbegy_session_e'] = '<div class="alert-message success"><i class="icon-ok"></i><p><span>'.__("Edited been successfully","vbegy").'</span><br>'.__("Has been edited successfully.","vbegy").'</p></div>';
   				wp_redirect(get_permalink($return));
   			}else {
   				$_SESSION['vbegy_session_e'] = '<div class="alert-message success"><i class="icon-ok"></i><p><span>'.__("Edited been successfully","vbegy").'</span><br>'.__("Has been added successfully, the post under review.","vbegy").'</p></div>';
   				wp_redirect(esc_url(home_url('/')));
   			}
			exit;
   		endif;
	endif;
}
add_action('vpanel_edit_post', 'vpanel_edit_post');
/* process_vpanel_edit_posts */
function process_vpanel_edit_posts() {
	global $posted;
	set_time_limit(0);
	$errors = new WP_Error();
	$posted = array();
	
	$fields = array(
		'ID','title','comment','category','attachment','post_tag'
	);
	
	foreach ($fields as $field) :
		if (isset($_POST[$field])) $posted[$field] = $_POST[$field]; else $posted[$field] = '';
	endforeach;
	/* Validate Required Fields */
	
	$get_post = (isset($posted['ID'])?(int)$posted['ID']:0);
	$get_post_q = get_post($get_post);
	if (isset($get_post) && $get_post != 0 && $get_post_q && get_post_type($get_post) == "post") {
		$user_login_id_l = get_user_by("id",$get_post_q->post_author);
		if ($user_login_id_l->ID != get_current_user_id()) {
			$errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("Sorry you can't edit this post.","vbegy"));
		}
	}else {
		$errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("Sorry no post select or not found.","vbegy"));
	}
	if (empty($posted['title'])) $errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("There are required fields ( title ).","vbegy"));
	if (empty($posted['category']) || $posted['category'] == '-1') $errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("There are required fields ( category ).","vbegy"));
	
	if (vpanel_options("content_post") == 1) {
		if (empty($posted['comment'])) $errors->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("There are required fields ( content ).","vbegy"));
	}
	if (sizeof($errors->errors)>0) return $errors;
	
	$post_id = $get_post;
	
	$post_approved = vpanel_options("post_approved");
	
	/* Edit post */
	$data = array(
		'ID'           => sanitize_text_field($post_id),
		'post_content' => wp_kses_post($posted['comment']),
		'post_title'   => sanitize_text_field($posted['title']),
		'post_name'    => sanitize_text_field($posted['title']),
		'post_status'  => ($post_approved == 1 || is_super_admin(get_current_user_id())?"publish":"draft"),
	);
	
	wp_update_post($data);
	
	$terms = array();
	if ($posted['category']) $terms[] = get_term_by( 'id', $posted['category'], 'category')->slug;
	if (sizeof($terms)>0) wp_set_object_terms($post_id, $terms, 'category');
	
	$attachment = '';

	require_once(ABSPATH . "wp-admin" . '/includes/image.php');
	require_once(ABSPATH . "wp-admin" . '/includes/file.php');
		
	if(isset($_FILES['attachment']) && !empty($_FILES['attachment']['name'])) :
			
		$attachment = wp_handle_upload($_FILES['attachment'], array('test_form'=>false), current_time('mysql'));
					
		if ( isset($attachment['error']) ) :
			$errors->add('upload-error', __("Attachment Error: ","vbegy") . $attachment['error'] );
			
			return $errors;
		endif;
		
	endif;
	if ($attachment) :
		$attachment_data = array(
			'post_mime_type' => $attachment['type'],
			'post_title'     => preg_replace('/\.[^.]+$/', '', basename($attachment['file'])),
			'post_content'   => '',
			'post_status'    => 'inherit',
			'post_author'    => (!is_user_logged_in() && $add_post_no_register == 1?0:get_current_user_id())
		);
		$attachment_id = wp_insert_attachment( $attachment_data, $attachment['file'], $post_id );
		$attachment_metadata = wp_generate_attachment_metadata( $attachment_id, $attachment['file'] );
		wp_update_attachment_metadata( $attachment_id,  $attachment_metadata );
		set_post_thumbnail( $post_id, $attachment_id );
	endif;
	
	/* Tags */
	
	if (isset($posted['post_tag']) && $posted['post_tag']) :
				
		$tags = explode(',', trim(stripslashes($posted['post_tag'])));
		$tags = array_map('strtolower', $tags);
		$tags = array_map('trim', $tags);

		if (sizeof($tags)>0) :
			wp_set_object_terms($post_id, $tags, 'post_tag');
		endif;
		
	endif;

	do_action('vpanel_edit_posts', $post_id);
	
	/* Successful */
	return $post_id;
}
/* ask_process_edit_profile_form */
function ask_process_edit_profile_form() {
	global $posted;
	require_once(ABSPATH . 'wp-admin/includes/user.php');
	require_once(ABSPATH . 'wp-admin/includes/image.php');
	require_once(ABSPATH . 'wp-admin/includes/file.php');
	$errors = "";
	$errors_2 = new WP_Error();
	$posted = array(
		'email' => esc_html($_POST['email']),
		'pass1' => esc_html($_POST['pass1']),
		'pass2' => esc_html($_POST['pass2']),
		'display_name' => esc_html($_POST['display_name']),
	);
	
	if (empty($posted['email'])) $errors_2->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("There are required fields.","vbegy"));
	if ($posted['pass1'] !== $posted['pass2']) $errors_2->add('required-field', '<strong>'.__("Error","vbegy").' :&nbsp;</strong> '.__("Password does not match.","vbegy"));
	
	$current_user = wp_get_current_user();
	isset($_POST['admin_bar_front'] ) ? 'true' : 'false';
	$get_you_avatar = get_user_meta(get_current_user_id(),"you_avatar",true);
	$errors_user = edit_user(get_current_user_id());
	if ( is_wp_error( $errors_user ) ) return $errors_user;
	do_action('personal_options_update', get_current_user_id());
	
	if(isset($_FILES['you_avatar']) && !empty($_FILES['you_avatar']['name'])) :
		$mime = $_FILES["you_avatar"]["type"];
		if (($mime != 'image/jpeg') && ($mime != 'image/jpg') && ($mime != 'image/png')) {
			$errors_2->add('upload-error',  __('Error type , please upload: jpg, jpeg, png','vbegy') );
		}else {
			$you_avatar = wp_handle_upload($_FILES['you_avatar'], array('test_form'=>false), current_time('mysql'));
			if ($you_avatar && isset($you_avatar["url"])) :
				update_user_meta(get_current_user_id(),"you_avatar",$you_avatar["url"]);
			endif;
			if ( isset($you_avatar['error']) && $you_avatar ) :
				if (isset($errors_2->add)) {
					$errors_2->add('upload-error',  __('Error in upload the image : ','vbegy') . $you_avatar['error'] );
				}
				return $errors_2;
			endif;
		}
	else:
		update_user_meta(get_current_user_id(),"you_avatar",$get_you_avatar);
	endif;
		if (sizeof($errors_2->errors)>0) return $errors_2;
	return;
}
/* ask_edit_profile_form */
function ask_edit_profile_form() {
	if (isset($_POST["user_action"]) && $_POST["user_action"] == "edit_profile") :
		$return = ask_process_edit_profile_form();
		if ( is_wp_error($return) ) :
			$error_string = $return->get_error_message();
   			echo '<div class="ask_error"><span><p>'.$return->get_error_message().'</p></span></div>';
   		else :
   			echo '<div class="ask_done"><span><p>'.__("Profile has been updated","vbegy").'</p></span></div>';
   		endif;
	endif;
}
add_action('ask_edit_profile_form', 'ask_edit_profile_form');
/* add_favorite */
function add_favorite() {
	$post_id = (int)$_POST['post_id'];
	$user_login_id2 = get_user_by("id",get_current_user_id());
	
	$_favorites = get_user_meta(get_current_user_id(),$user_login_id2->user_login."_favorites");
	if (is_array($_favorites[0])) {
		if (!in_array($post_id,$_favorites[0])) {
			$array_merge = array_merge($_favorites[0],array($post_id));
			update_user_meta(get_current_user_id(),$user_login_id2->user_login."_favorites",$array_merge);
		}
	}else {
		update_user_meta(get_current_user_id(),$user_login_id2->user_login."_favorites",array($post_id));
	}
	
	$count = get_post_meta($post_id,'question_favorites',true);
	if(!$count)
		$count = 0;
	$count++;
	$update = update_post_meta($post_id,'question_favorites',$count);
	die();
}
add_action('wp_ajax_add_favorite','add_favorite');
add_action('wp_ajax_nopriv_add_favorite','add_favorite');
/* remove_favorite */
function remove_favorite() {
	$post_id = (int)$_POST['post_id'];
	$user_login_id2 = get_user_by("id",get_current_user_id());
	
	$_favorites = get_user_meta(get_current_user_id(),$user_login_id2->user_login."_favorites");
	if (is_array($_favorites[0])) {
		if (in_array($post_id,$_favorites[0])) {
			$remove_item = remove_item_by_value($_favorites[0],$post_id);
			update_user_meta(get_current_user_id(),$user_login_id2->user_login."_favorites",$remove_item);
		}
	}
	
	$count = get_post_meta($post_id,'question_favorites',true);
	if(!$count)
		$count = 0;
	$count--;
	if($count < 0)
		$count = 0;
	$update = update_post_meta($post_id,'question_favorites',$count);
	die();
}
add_action('wp_ajax_remove_favorite','remove_favorite');
add_action('wp_ajax_nopriv_remove_favorite','remove_favorite');
/* remove_item_by_value */
function remove_item_by_value($array, $val = '', $preserve_keys = true) {
	if (empty($array) || !is_array($array)) return false;
	if (!in_array($val, $array)) return $array;
	
	foreach($array as $key => $value) {
		if ($value == $val) unset($array[$key]);
	}
	
	return ($preserve_keys === true) ? $array : array_values($array);
}
/* excerpt_row */
function excerpt_row($excerpt_length,$content) {
	global $post;
	$words = explode(' ', $content, $excerpt_length + 1);
	if(count($words) > $excerpt_length) :
		array_pop($words);
		array_push($words, '...');
		$content = implode(' ', $words);
	endif;
		$content = strip_tags($content);
	echo $content;
}
/* excerpt_title_row */
function excerpt_title_row($excerpt_length,$title) {
	global $post;
	$words = explode(' ', $title, $excerpt_length + 1);
	if(count($words) > $excerpt_length) :
		array_pop($words);
		array_push($words, '');
		$title = implode(' ', $words);
	endif;
		$title = strip_tags($title);
	echo $title;
}
$vpanel_emails = '
<div style="word-wrap:break-word">
<div>
<div>
<div style="margin:0px;background-color:#f4f3f4;font-family:Helvetica,Arial,sans-serif;font-size:12px" text="#444444" bgcolor="#F4F3F4" link="#21759B" alink="#21759B" vlink="#21759B" marginheight="0" marginwidth="0">
	<table border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor="#F4F3F4">
		<tbody>
		<tr>
		<td style="padding:15px">
			<center>
				<table width="550" cellspacing="0" cellpadding="0" align="center" bgcolor="#ffffff">
				<tbody>
				<tr>
				<td align="left">
				<div style="border:solid 1px #d9d9d9">
				<table style="line-height:1.6;font-size:12px;font-family:Helvetica,Arial,sans-serif;border:solid 1px #ffffff;color:#444" border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
				<tbody>
				<tr>
				<td style="color:#ffffff" colspan="2" valign="bottom" height="30">.</td>
				</tr>
				<tr>
				<td style="line-height:32px;padding-left:30px" valign="baseline"><a href="'.esc_url(home_url('/')).'" target="_blank">';
				$vpanel_emails_2 = '</a></td>
				<td style="padding-right:30px" align="right" valign="baseline"><span style="font-size:14px;color:#777777">'.get_bloginfo ( 'description' ).'</span></td>
				</tr>
				</tbody>
				</table>
				<table style="margin-top:15px;margin-right:30px;margin-left:30px;color:#444;line-height:1.6;font-size:12px;font-family:Arial,sans-serif" border="0" width="490" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
				<tbody>
				<tr>
				<td style="border-top:solid 1px #d9d9d9" colspan="2">
				<div style="padding:15px 0">';
				$vpanel_emails_3 = '</div>
				</td>
				</tr>
				</tbody>
				</table>
				</div>
				</td>
				</tr>
				</tbody>
				</table>
			</center>
		</td>
		</tr>
		</tbody>
	</table>
</div>
</div>
</div>
</div>';
/* ask_coupon_valid */
function ask_coupon_valid($coupons,$coupon_name,$coupons_not_exist,$pay_ask_payment,$what_return = '') {
	if (isset($coupons) && is_array($coupons)) {
		foreach ($coupons as $coupons_k => $coupons_v) {
			if (is_array($coupons_v) && in_array($coupon_name,$coupons_v)) {
				if ($what_return == "coupons_not_exist") {
					return "yes";
				}
				//echo "yes"." ";
				//echo $coupons_k." ".$coupons_v["coupon_date"];
				if (isset($coupons_v["coupon_date"]) && $coupons_v["coupon_date"] !="" && $coupons_v["coupon_date"] < date_i18n('m/d/Y',current_time('timestamp'))) {
					return '<div class="alert-message error"><p>'.__("This coupon has expired.","vbegy").'</p></div>';
				}else if (isset($coupons_v["coupon_type"]) && $coupons_v["coupon_type"] == "percent") {
					if ((int)$coupons_v["coupon_amount"] > 100) {
						return '<div class="alert-message error"><p>'.__("This coupon is not valid.","vbegy").'</p></div>';
					}else {
						$the_discount = ($pay_ask_payment*$coupons_v["coupon_amount"])/100;
						$last_payment = $pay_ask_payment-$the_discount;
						if ($what_return == "last_payment") {
							return $last_payment;
						}
					}
				}else if (isset($coupons_v["coupon_type"]) && $coupons_v["coupon_type"] == "discount") {
					if ((int)$coupons_v["coupon_amount"] > $pay_ask_payment) {
						return '<div class="alert-message error"><p>'.__("This coupon is not valid.","vbegy").'</p></div>';
					}else {
						$last_payment = $pay_ask_payment-$coupons_v["coupon_amount"];
						if ($what_return == "last_payment") {
							return $last_payment;
						}
					}
				}else {
					return '<div class="alert-message success"><p>'.__("Coupon code applied successfully.","vbegy").'</p></div>';
				}
			}
		}
	}
}
/* send_admin_notification */
function send_admin_notification($post_id,$post_title) {
	$blogname = get_option('blogname');
	$email = get_option('admin_email');
	$headers = "MIME-Version: 1.0\r\n" . "From: ".$blogname." "."<".$email.">\n" . "Content-Type: text/HTML; charset=\"" . get_option('blog_charset') . "\"\r\n";
	$message = __('Hello there,','vbegy').'<br/><br/>'. 
	__('A new post has been submitted in ','vbegy').$blogname.' site.'.__(' Please find details below:','vbegy').'<br/><br/>'.
	
	'Post title: '.$post_title.'<br/><br/>';
	$post_author_name = get_post_meta($post_id,'ap_author_name',true);
	$post_author_email = get_post_meta($post_id,'ap_author_email',true);
	$post_author_url = get_post_meta($post_id,'ap_author_url',true);
	if($post_author_name!=''){
	$message .= 'Post Author Name: '.$post_author_name.'<br/><br/>';
	}
	if($post_author_email!=''){
	$message .= 'Post Author Email: '.$post_author_email.'<br/><br/>';
	}
	if($post_author_url!=''){
	$message .= 'Post Author URL: '.$post_author_url.'<br/><br/>';
	}
	
	
	$message .= '____<br/><br/>
	'.__('To take action (approve/reject)- please go here:','vbegy').'<br/>'
	.admin_url().'post.php?post='.$post_id.'&action=edit <br/><br/>
	
	'.__('Thank You','vbegy');
	$subject = __('New Post Submission','vbegy');
	wp_mail($email,$subject,$message,$headers);
}