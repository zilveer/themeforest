<?php $posts_meta = vpanel_options("post_meta");
$question_vote_show = vpanel_options("question_vote_show");
$question_vote = get_post_meta($post->ID,"question_vote",true);
$question_category = wp_get_post_terms($post->ID,'question-category',array("fields" => "all"));
$vbegy_what_post = rwmb_meta('vbegy_what_post','select',$post->ID);
$vbegy_sidebar_all = rwmb_meta('vbegy_sidebar','select',$post->ID);
$question_poll = get_post_meta($post->ID,'question_poll',true);
$question_type = ($question_poll == 1?" question-type-poll":" question-type-normal");
$the_best_answer = get_post_meta($post->ID,"the_best_answer",true);
$closed_question = get_post_meta($post->ID,"closed_question",true);
$question_favorites = get_post_meta($id,'question_favorites',true);
$user_get_current_user_id = get_current_user_id();
$the_author = get_user_by("login",get_the_author());
$user_login_id_l = get_user_by("id",$post->post_author);
if ($post->post_author != 0) {
	$user_profile_page = esc_url(add_query_arg("u", $user_login_id_l->user_login,get_page_link(vpanel_options('user_profile_page'))));
}else {
	$question_username = get_post_meta($post->ID, 'question_username',true);
	$question_email = get_post_meta($post->ID, 'question_email',true);
}
if (isset($question_category[0])) {
	$get_question_category = get_option("questions_category_".$question_category[0]->term_id);
	$yes_private = 0;
	if (isset($question_category[0]) && isset($get_question_category['private']) && $get_question_category['private'] == "on") {
		if (isset($authordata->ID) && $authordata->ID > 0 && $authordata->ID == $user_get_current_user_id) {
			$yes_private = 1;
		}
	}else if (isset($question_category[0]) && !isset($get_question_category['private'])) {
		$yes_private = 1;
	}
}else {
	$yes_private = 1;
}

if (is_super_admin($user_get_current_user_id)) {
	$yes_private = 1;
}
$active_reports = vpanel_options("active_reports");
$excerpt_questions = vpanel_options("excerpt_questions");
$question_author = vpanel_options("question_author");
$question_type = ($active_reports == 1?$question_type:$question_type." no_reports");
$question_author_class = (!isset($question_author) || $question_author == 1?" question_author_yes":" question_author_no");
if (isset($k) && $k == vpanel_options("between_questions_position")) {
	$between_adv_type = vpanel_options("between_adv_type");
	$between_adv_code = vpanel_options("between_adv_code");
	$between_adv_href = vpanel_options("between_adv_href");
	$between_adv_img = vpanel_options("between_adv_img");
	if (($between_adv_type == "display_code" && $between_adv_code != "") || ($between_adv_type == "custom_image" && $between_adv_img != "")) {
		echo '<div class="clearfix"></div>
		<div class="advertising">';
		if ($between_adv_type == "display_code") {
			echo stripcslashes($between_adv_code);
		}else {
			if ($between_adv_href != "") {
				echo '<a target="_blank" href="'.$between_adv_href.'">';
			}
			echo '<img alt="" src="'.$between_adv_img.'">';
			if ($between_adv_href != "") {
				echo '</a>';
			}
		}
		echo '</div><!-- End advertising -->
		<div class="clearfix"></div>';
	}
}
if ($yes_private == 1) {?>
	<article <?php post_class('question'.$question_type.$question_author_class);?> id="post-<?php the_ID();?>" role="article" itemtype="http://schema.org/Article">
		<h2 itemprop="name"><a itemprop="url" href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title();?></a></h2>
		<?php if ($active_reports == 1) {?>
			<a class="question-report report_q" href="#"><?php _e("Report","vbegy")?></a>
		<?php }
		if ($question_poll == 1) {?>
			<div class="question-type-main"><i class="icon-signal"></i><?php _e("Poll","vbegy")?></div>
		<?php }else {?>
			<div class="question-type-main"><i class="icon-question-sign"></i><?php _e("Question","vbegy")?></div>
		<?php }
		if (!isset($question_author) || $question_author == 1) {?>
			<div class="question-author">
				<?php if ($post->post_author != 0) {?>
					<a href="<?php echo vpanel_get_user_url($authordata->ID);?>" original-title="<?php the_author();?>" class="question-author-img tooltip-n">
				<?php }else {?>
					<div class="question-author-img">
				<?php }?>
					<span></span>
					<?php 
					if (get_the_author_meta('you_avatar', get_the_author_meta('ID'))) {
						$you_avatar_img = get_aq_resize_url(esc_attr(get_the_author_meta('you_avatar', get_the_author_meta('ID'))),"full",65,65);
						echo "<img alt='".$authordata->display_name."' src='".$you_avatar_img."'>";
					}else {
						if ($post->post_author != 0) {
							echo get_avatar($authordata->ID,'65','');
						}else {
							echo get_avatar($question_email,'65','');
						}
					}
				if ($post->post_author != 0) {?>
					</a>
				<?php }else {?>
					</div>
				<?php }?>
			</div>
		<?php }?>
		<div class="question-inner">
			<div class="clearfix"></div>
			<div class="question-desc<?php echo ($excerpt_questions == 1?" question-desc-no-padding":"")?>">
				<?php $custom_permission = vpanel_options("custom_permission");
				$show_question = vpanel_options("show_question");
				if (is_user_logged_in()) {
					$user_is_login = get_userdata($user_get_current_user_id);
					$user_login_group = key($user_is_login->caps);
					$roles = $user_is_login->allcaps;
				}
				if ($custom_permission != 1 || (is_user_logged_in() && isset($roles["show_question"]) && $roles["show_question"] == 1) || (!is_user_logged_in() && $show_question == 1) || $user_get_current_user_id == $post->post_author) {
					if ($excerpt_questions != 1) {
						excerpt(40);
					}
				}else {
					echo '<div class="note_error"><strong>'.__("Sorry, you do not have a permission to show this question .","vbegy").'</strong></div>';
				}
				if ($active_reports == 1) {?>
					<div class="explain-reported">
						<h3><?php _e("Please briefly explain why you feel this question should be reported .","vbegy")?></h3>
						<textarea name="explain-reported"></textarea>
						<div class="clearfix"></div>
						<div class="loader_3"></div>
						<div class="color button small report"><?php _e("Report","vbegy")?></div>
						<div class="color button small dark_button cancel"><?php _e("Cancel","vbegy")?></div>
					</div><!-- End reported -->
				<?php }?>
				<div class="no_vote_more"></div>
			</div>
			<div class="question-details">
				<?php $comments = get_comments('post_id='.$post->ID);
				if (isset($the_best_answer) && $the_best_answer != "" && $comments) {?>
					<span class="question-answered question-answered-done"><i class="icon-ok"></i><?php _e("solved","vbegy")?></span>
				<?php }else if (isset($closed_question) && $closed_question == 1) {?>
					<span class="question-answered question-closed"><i class="icon-lock"></i><?php _e("closed","vbegy")?></span>
				<?php }else if ($the_best_answer == "" && $comments) {?>
					<span class="question-answered"><i class="icon-ok"></i><?php _e("in progress","vbegy")?></span>
				<?php }?>
				<span class="question-favorite"><i class="<?php echo ($question_favorites > 0?"icon-star":"icon-star-empty");?>"></i><?php echo ($question_favorites != ""?$question_favorites:0);?></span>
			</div>
			<?php if (isset($question_category[0])) {?>
				<span class="question-category"><a href="<?php echo get_term_link($question_category[0]->slug, "question-category");?>"><i class="fa fa-folder-o"></i><?php echo $question_category[0]->name?></a></span>
			<?php }
			if ($post->post_author == 0) {
				$question_username = get_post_meta($post->ID, 'question_username',true);
				$question_email = get_post_meta($post->ID, 'question_email',true);
				?>
				<span class="question-author-meta"><i class="icon-user"></i><?php echo $question_username?></span>
			<?php }else if ($post->post_author > 0 && isset($question_author) && $question_author == 0) {?>
				<span class="question-author-meta"><a href="<?php echo vpanel_get_user_url($authordata->ID);?>" title="<?php the_author();?>"><i class="icon-user"></i><?php the_author();?></a></span>
			<?php }?>
			<span class="question-date" datetime="<?php echo get_the_date(); ?>"><i class="fa fa-calendar"></i><?php echo human_time_diff(get_the_time('U'), current_time('timestamp'));?></span>
			<span class="question-comment"><a href="<?php echo comments_link()?>"><i class="fa fa-comments-o"></i><?php echo get_comments_number()?> <?php _e("Answer","vbegy");?></a></span>
			<meta itemprop="interactionCount" content="<?php comments_number( 'UserAnswers: 0', 'UserAnswers: 1', 'UserAnswers: %' ); ?>">
			<span class="question-view"><i class="icon-eye-open"></i><?php $post_stats = get_post_meta($post->ID, 'post_stats', true);echo ($post_stats != ""?$post_stats:0);?> <?php _e("views","vbegy");?></span>
			<?php $question_bump = vpanel_options("question_bump");
			if ($question_bump == 1 && isset($question_bump_template) && $question_bump_template == true) {?>
				<span class="question-points"><i class="icon-heart"></i><?php $question_points = get_post_meta($post->ID, 'question_points', true);echo ($question_points != ""?$question_points:0);?> <?php _e("points","vbegy");?></span>
			<?php }
			if (isset($authordata->ID) && $authordata->ID > 0) {
				echo vpanel_get_badge($authordata->ID);
			}
			$active_vote = vpanel_options("active_vote");
			$show_dislike_questions = vpanel_options("show_dislike_questions");
			if ($question_vote_show == 1 && $active_vote == 1) {?>
				<span class="single-question-vote-result question_vote_result"><?php echo ($question_vote != ""?$question_vote:0)?></span>
				<ul class="single-question-vote">
					<?php if (is_user_logged_in() && $post->post_author != get_current_user_id()){
						if ($show_dislike_questions != 1) {?>
							<li><a href="#" id="question_vote_down-<?php echo $post->ID?>" class="ask_vote_down question_vote_down vote_allow<?php echo (isset($_COOKIE['question_vote'.$post->ID])?" ".$_COOKIE['question_vote'.$post->ID]."-".$post->ID:"")?> tooltip_s" title="<?php _e("Dislike","vbegy");?>"><i class="icon-thumbs-down"></i></a></li>
						<?php }?>
						<li><a href="#" id="question_vote_up-<?php echo $post->ID?>" class="ask_vote_up question_vote_up vote_allow<?php echo (isset($_COOKIE['question_vote'.$post->ID])?" ".$_COOKIE['question_vote'.$post->ID]."-".$post->ID:"")?> tooltip_s" title="<?php _e("Like","vbegy");?>"><i class="icon-thumbs-up"></i></a></li>
					<?php }else {
						if ($show_dislike_questions != 1) {?>
							<li><a href="#" class="ask_vote_down question_vote_down <?php echo (is_user_logged_in() && $post->post_author == get_current_user_id()?"vote_not_allow":"vote_not_user")?> tooltip_s" original-title="<?php _e("Dislike","vbegy");?>"><i class="icon-thumbs-down"></i></a></li>
						<?php }?>
						<li><a href="#" class="ask_vote_up question_vote_up <?php echo (is_user_logged_in() && $post->post_author == get_current_user_id()?"vote_not_allow":"vote_not_user")?> tooltip_s" original-title="<?php _e("Like","vbegy");?>"><i class="icon-thumbs-up"></i></a></li>
					<?php }?>
				</ul>
			<?php }?>
			<div class="clearfix"></div>
		</div>
	</article>
<?php }else {?>
	<article class="question private-question">
		<p class="question-desc"><?php _e("Sorry it private question .");?></p>
	</article>
<?php }?>