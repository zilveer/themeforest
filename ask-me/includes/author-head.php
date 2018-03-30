<?php
if (is_author()) {
	$get_query_var = get_query_var("author");
}else {
	$get_query_var = esc_attr($_GET['u']);
}
$user_login = get_userdata($get_query_var);
if (isset($user_login) && is_object($user_login)) {
	$you_avatar = get_the_author_meta('you_avatar',$user_login->ID);
	$url = get_the_author_meta('url',$user_login->ID);
	$country = get_the_author_meta('country',$user_login->ID);
	$city = get_the_author_meta('city',$user_login->ID);
	$phone = get_the_author_meta('phone',$user_login->ID);
	$sex = get_the_author_meta('sex',$user_login->ID);
	$age = get_the_author_meta('age',$user_login->ID);
	$twitter = get_the_author_meta('twitter',$user_login->ID);
	$facebook = get_the_author_meta('facebook',$user_login->ID);
	$google = get_the_author_meta('google',$user_login->ID);
	$linkedin = get_the_author_meta('linkedin',$user_login->ID);
	$follow_email = get_the_author_meta('follow_email',$user_login->ID);
	$youtube = get_the_author_meta('youtube',$user_login->ID);
	$pinterest = get_the_author_meta('pinterest',$user_login->ID);
	$instagram = get_the_author_meta('instagram',$user_login->ID);
	$show_point_favorite = get_the_author_meta('show_point_favorite',$user_login->ID);
}else {
	wp_redirect(home_url());
	die();
}

$owner = false;
if($user_ID == $user_login->ID){
	$owner = true;
}

/* visit */
$visit_profile = get_user_meta($user_login->ID,"visit_profile_all",true);
$visit_profile_m = get_user_meta($user_login->ID,"visit_profile_m_".date_i18n('m_Y',current_time('timestamp')),true);
$visit_profile_d = get_user_meta($user_login->ID,"visit_profile_d_".date_i18n('d_m_Y',current_time('timestamp')),true);

if ($visit_profile_d == "" or $visit_profile_d == 0) {
	add_user_meta($user_login->ID,"visit_profile_d_".date_i18n('d_m_Y',current_time('timestamp')),1);
}else {
	update_user_meta($user_login->ID,"visit_profile_d_".date_i18n('d_m_Y',current_time('timestamp')),$visit_profile_d+1);
}

if ($visit_profile_m == "" or $visit_profile_m == 0) {
	add_user_meta($user_login->ID,"visit_profile_m_".date_i18n('m_Y',current_time('timestamp')),1);
}else {
	update_user_meta($user_login->ID,"visit_profile_m_".date_i18n('m_Y',current_time('timestamp')),$visit_profile_m+1);
}

if ($visit_profile == "" or $visit_profile == 0) {
	add_user_meta($user_login->ID,"visit_profile_all",1);
}else {
	update_user_meta($user_login->ID,"visit_profile_all",$visit_profile+1);
}

/* points */
$points = get_user_meta($user_login->ID,"points",true);

/* favorites */
$_favorites = get_user_meta($user_login->ID,$user_login->user_login."_favorites");

/* the_best_answer */
$the_best_answer = get_user_meta($user_login->ID,"the_best_answer",true);

/* following */
$following_me = get_user_meta($user_login->ID,"following_me");
$following_you = get_user_meta($user_login->ID,"following_you");

/* add_answer */
$add_answer = get_user_meta($user_login->ID,"add_answer_all",true);
$add_answer_m = get_user_meta($user_login->ID,"add_answer_m_".date_i18n('m_Y',current_time('timestamp')),true);
$add_answer_d = get_user_meta($user_login->ID,"add_answer_d_".date_i18n('d_m_Y',current_time('timestamp')),true);
$add_answer = count(get_comments(array("post_type" => "question","status" => "approve","user_id" => $user_login->ID)));

/* add_questions */
$add_questions = get_user_meta($user_login->ID,"add_questions_all",true);
$add_questions_m = get_user_meta($user_login->ID,"add_questions_m_".date_i18n('m_Y',current_time('timestamp')),true);
$add_questions_d = get_user_meta($user_login->ID,"add_questions_d_".date_i18n('d_m_Y',current_time('timestamp')),true);
$add_questions = count_user_posts_by_type($user_login->ID,"question");

/* follow questions - answers - posts - comments */
$follow_questions = 0;
$follow_answers = 0;
$follow_posts = 0;
$follow_comments = 0;
if (isset($following_me) && is_array($following_me) && isset($following_me[0]) && is_array($following_me[0])) {
	$following_me_array = $following_me[0];
	if (is_array($following_me_array)) {
		$following_me_array = array_filter($following_me_array);
	}
}
if (isset($following_me_array) && is_array($following_me_array) && !empty($following_me_array)) {
	foreach ($following_me_array as $key => $value) {
		$follow_questions += count_user_posts_by_type($value,"question");
		$follow_posts += count_user_posts_by_type($value,"post");
		$follow_answers += count(get_comments(array("post_type" => "question","status" => "approve","user_id" => $value)));
		$follow_comments += count(get_comments(array("post_type" => "post","status" => "approve","user_id" => $value)));
	}
}
?>
<div class="row">
	<div class="user-profile">
		<div class="col-md-12">
			<div class="page-content">
				<h2>
					<?php _e("About","vbegy")?> <a href="<?php echo vpanel_get_user_url($user_login->ID);?>"><?php echo $user_login->display_name?></a>
					<?php echo vpanel_get_badge($user_login->ID)?>
				</h2>
				<div class="user-profile-img">
					<a original-title="<?php echo $user_login->display_name?>" class="tooltip-n" href="<?php echo vpanel_get_user_url($user_login->ID);?>">
						<?php
						if ($you_avatar) {
							$you_avatar_img = get_aq_resize_url(esc_attr($you_avatar),"full",65,65);
							echo "<img alt='".$user_login->display_name."' src='".$you_avatar_img."'>";
						}else {
							echo get_avatar($user_login->ID,'65','');
						}?>
					</a>
				</div>
				<div class="ul_list ul_list-icon-ok about-user">
					<?php
					$user_registered = vpanel_options("user_registered");
					$user_country = vpanel_options("user_country");
					$user_city = vpanel_options("user_city");
					$user_phone = vpanel_options("user_phone");
					$user_age = vpanel_options("user_age");
					$user_sex = vpanel_options("user_sex");
					$user_url = vpanel_options("user_url");
					if ($user_registered != 1 || $user_country != 1 || $user_city != 1 || $user_phone != 1 || $user_age != 1 || $user_sex != 1 || $user_url != 1) {?>
						<ul>
							<?php if ($user_registered != 1) {?>
								<li><i class="icon-plus"></i><?php _e("Registered","vbegy")?> : <span><?php echo substr($user_login->user_registered, 0, 10); ?></span></li>
							<?php }
							if ($phone && $user_phone != 1) {?>
								<li><i class="icon-phone"></i><?php _e("Phone","vbegy")?> : <span><?php echo $phone?></span></li>
							<?php }
							$get_countries = vpanel_get_countries();
							if ($country && $user_country != 1 && isset($get_countries[$country])) {?>
								<li><i class="icon-map-marker"></i><?php _e("Country","vbegy")?> : <span><?php echo $get_countries[$country]?></span></li>
							<?php }
							if ($city && $user_city != 1) {?>
								<li><i class="icon-map-marker"></i><?php _e("City","vbegy")?> : <span><?php echo $city?></span></li>
							<?php }
							if ($age && $user_age != 1) {?>
								<li><i class="icon-heart"></i><?php _e("Age","vbegy")?> : <span><?php echo $age?></span></li>
							<?php }
							if (isset($sex) && $user_sex != 1) {?>
								<li><i class="icon-user"></i><?php _e("Sex","vbegy")?> : <span><?php echo ($sex == "male" || $sex == 1?__("Male","vbegy"):__("Female","vbegy"))?></span></li>
							<?php }
							if ($url && $user_url != 1) {?>
								<li><i class="icon-globe"></i><?php _e("Website","vbegy")?> : <a target="_blank" href="<?php echo $url?>"><?php _e("view","vbegy")?></a></li>
							<?php }?>
						</ul>
					<?php }?>
				</div>
				<div class="clearfix"></div>
				<p><?php echo nl2br($user_login->description)?></p>
				<div class="clearfix"></div>
				<?php if($owner == true){
					$get_lang = esc_attr(get_query_var("lang"));
					$get_lang_array = array();
					if (isset($get_lang) && $get_lang != "") {
						$get_lang_array = array("lang" => $get_lang);
					}?>
					<a class="button color small margin_0" href="<?php echo esc_url(add_query_arg(array("u" => esc_attr($user_login->ID),$get_lang_array),get_page_link(vpanel_options('user_edit_profile_page'))))?>"><?php _e("Edit profile","vbegy")?></a>
				<?php }
				if (is_user_logged_in() and $owner == false) {
					$following_me2 = get_user_meta(get_current_user_id(),"following_me");
					if (!empty($following_me2) and in_array($user_login->ID,$following_me2[0])) {?>
						<a href="#" class="following_not button color small margin_0" rel="<?php echo $user_login->ID?>"><?php _e("Unfollow","vbegy")?></a>
					<?php }else {?>
						<a href="#" class="following_you button color small margin_0" rel="<?php echo $user_login->ID?>"><?php _e("Follow","vbegy")?></a>
				<?php
					}
				}?>
				<div class="clearfix"></div>
				<?php if ($facebook || $twitter || $linkedin || $google || $follow_email || $youtube || $pinterest || $instagram) { ?>
					<br>
					<span class="user-follow-me"><?php _e("Follow Me","vbegy")?></span>
					<?php if ($facebook) {?>
					<a href="<?php echo $facebook?>" original-title="<?php _e("Facebook","vbegy")?>" class="tooltip-n">
						<span class="icon_i">
							<span class="icon_square" icon_size="30" span_bg="#3b5997" span_hover="#2f3239">
								<i class="social_icon-facebook"></i>
							</span>
						</span>
					</a>
					<?php }
					if ($twitter) {?>
					<a href="<?php echo $twitter?>" original-title="<?php _e("Twitter","vbegy")?>" class="tooltip-n">
						<span class="icon_i">
							<span class="icon_square" icon_size="30" span_bg="#00baf0" span_hover="#2f3239">
								<i class="social_icon-twitter"></i>
							</span>
						</span>
					</a>
					<?php }
					if ($linkedin) {?>
					<a href="<?php echo $linkedin?>" original-title="<?php _e("Linkedin","vbegy")?>" class="tooltip-n">
						<span class="icon_i">
							<span class="icon_square" icon_size="30" span_bg="#006599" span_hover="#2f3239">
								<i class="social_icon-linkedin"></i>
							</span>
						</span>
					</a>
					<?php }
					if ($google) {?>
					<a href="<?php echo $google?>" original-title="<?php _e("Google plus","vbegy")?>" class="tooltip-n">
						<span class="icon_i">
							<span class="icon_square" icon_size="30" span_bg="#c43c2c" span_hover="#2f3239">
								<i class="social_icon-gplus"></i>
							</span>
						</span>
					</a>
					<?php }
					if ($pinterest) {?>
					<a href="<?php echo $pinterest?>" original-title="<?php _e("Pinterest","vbegy")?>" class="tooltip-n">
						<span class="icon_i">
							<span class="icon_square" icon_size="30" span_bg="#e13138" span_hover="#2f3239">
								<i class="social_icon-pinterest"></i>
							</span>
						</span>
					</a>
					<?php }
					if ($instagram) {?>
					<a href="<?php echo $instagram?>" original-title="<?php _e("Instagram","vbegy")?>" class="tooltip-n">
						<span class="icon_i">
							<span class="icon_square" icon_size="30" span_bg="#548bb6" span_hover="#2f3239">
								<i class="social_icon-instagram"></i>
							</span>
						</span>
					</a>
					<?php }
					if ($follow_email) {?>
					<a href="mailto:<?php echo $follow_email?>" original-title="<?php _e("Email","vbegy")?>" class="tooltip-n">
						<span class="icon_i">
							<span class="icon_square" icon_size="30" span_bg="#000" span_hover="#2f3239">
								<i class="social_icon-email"></i>
							</span>
						</span>
					</a>
					<?php }
				}?>
			</div><!-- End page-content -->
		</div><!-- End col-md-12 -->
		<div class="col-md-12">
			<div class="page-content page-content-user-profile">
				<div class="user-profile-widget">
					<h2><?php _e("User Stats","vbegy")?></h2>
					<div class="ul_list ul_list-icon-ok">
						<ul>
							<li><i class="icon-question-sign"></i><a href="<?php echo esc_url(add_query_arg("u", esc_attr($get_query_var),get_page_link(vpanel_options('question_user_page'))))?>"><?php _e("Questions","vbegy")?><span> ( <span><?php echo ($add_questions == ""?0:$add_questions)?></span> ) </span></a></li>
							<li><i class="icon-comment"></i><a href="<?php echo esc_url(add_query_arg("u", esc_attr($get_query_var),get_page_link(vpanel_options('answer_user_page'))))?>"><?php _e("Answers","vbegy")?><span> ( <span><?php echo ($add_answer == ""?0:$add_answer)?></span> ) </span></a></li>
							<?php if ($show_point_favorite == 1 || $owner == true) {?>
								<li><i class="icon-star"></i><a href="<?php echo esc_url(add_query_arg("u", esc_attr($get_query_var),get_page_link(vpanel_options('favorite_user_page'))))?>"><?php _e("Favorite Questions","vbegy")?><span> ( <span><?php echo (isset($_favorites[0])?count($_favorites[0]):0)?></span> ) </span></a></li>
								<?php $active_points = vpanel_options("active_points");
								if ($active_points == 1) {?>
								<li><i class="icon-heart"></i><a href="<?php echo esc_url(add_query_arg("u", esc_attr($get_query_var),get_page_link(vpanel_options('point_user_page'))))?>"><?php _e("Points","vbegy")?><span> ( <span><?php echo ($points == "" ?0:$points)?></span> ) </span></a></li>
								<?php }
							}?>
							<li><i class="icon-file-alt"></i><a href="<?php echo esc_url(add_query_arg("u", esc_attr($get_query_var),get_page_link(vpanel_options('post_user_page'))))?>"><?php _e("Posts","vbegy")?><span> ( <span><?php echo count_user_posts_by_type($user_login->ID,"post")?></span> ) </span></a></li>
							<li><i class="icon-asterisk"></i><?php _e("Best Answers","vbegy")?><span> ( <span><?php echo ($the_best_answer == ""?0:$the_best_answer)?></span> ) </span></li>
							<?php if ($show_point_favorite == 1 || $owner == true) {?>
								<li class="authors_follow"><i class="icon-user-md"></i><a href="<?php echo esc_url(add_query_arg("u", esc_attr($get_query_var),get_page_link(vpanel_options('i_follow_user_page'))))?>"><?php _e("Authors I Follow","vbegy")?><span> ( <span><?php echo (isset($following_me[0]) && is_array($following_me[0])?count($following_me[0]):0)?></span> ) </span></a></li>
								<li class="followers"><i class="icon-user"></i><a href="<?php echo esc_url(add_query_arg("u", esc_attr($get_query_var),get_page_link(vpanel_options('followers_user_page'))))?>"><?php _e("Followers","vbegy")?><span> ( <span><?php echo (isset($following_you[0]) && is_array($following_you[0])?count($following_you[0]):0)?></span> ) </span></a></li>
								<li class="follow_questions"><i class="icon-question-sign"></i><a href="<?php echo esc_url(add_query_arg("u", esc_attr($get_query_var),get_page_link(vpanel_options('follow_question_page'))))?>"><?php _e("Follow questions","vbegy")?><span> ( <span><?php echo esc_attr($follow_questions)?></span> ) </span></a></li>
								<li class="follow_answers"><i class="icon-comment"></i><a href="<?php echo esc_url(add_query_arg("u", esc_attr($get_query_var),get_page_link(vpanel_options('follow_answer_page'))))?>"><?php _e("Follow answers","vbegy")?><span> ( <span><?php echo esc_attr($follow_answers)?></span> ) </span></a></li>
								<li class="follow_posts"><i class="icon-file-alt"></i><a href="<?php echo esc_url(add_query_arg("u", esc_attr($get_query_var),get_page_link(vpanel_options('follow_post_page'))))?>"><?php _e("Follow posts","vbegy")?><span> ( <span><?php echo esc_attr($follow_posts)?></span> ) </span></a></li>
								<li class="follow_comments"><i class="icon-comments"></i><a href="<?php echo esc_url(add_query_arg("u", esc_attr($get_query_var),get_page_link(vpanel_options('follow_comment_page'))))?>"><?php _e("Follow comments","vbegy")?><span> ( <span><?php echo esc_attr($follow_comments)?></span> ) </span></a></li>
							<?php }?>
						</ul>
					</div>
				</div><!-- End user-profile-widget -->
			</div><!-- End page-content -->
		</div><!-- End col-md-12 -->
	</div><!-- End user-profile -->
</div><!-- End row -->
<div class="clearfix"></div>