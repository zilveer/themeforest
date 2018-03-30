<?php get_header();
	if ( have_posts() ) : while ( have_posts() ) : the_post();
		$question_vote = get_post_meta($post->ID,"question_vote",true);
		$question_category = wp_get_post_terms($post->ID,'question-category',array("fields" => "all"));
		$vbegy_what_post = rwmb_meta('vbegy_what_post','select',$post->ID);
		$vbegy_sidebar_all = rwmb_meta('vbegy_sidebar','select',$post->ID);
		$video_id = rwmb_meta('video_id',"text",$post->ID);
		$video_type = rwmb_meta('video_type',"select",$post->ID);
		if ($video_type == 'youtube') {
			$type = "http://www.youtube.com/embed/".$video_id;
		}else if ($video_type == 'vimeo') {
			$type = "http://player.vimeo.com/video/".$video_id;
		}else if ($video_type == 'daily') {
			$type = "http://www.dailymotion.com/swf/video/".$video_id;
		}
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
		}
		$get_question_category = get_option("questions_category_".$question_category[0]->term_id);
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
		if ($yes_private != 1) {?>
			<article class="question private-question">
				<p class="question-desc"><?php _e("Sorry it a private question .");?></p>
			</article>
		<?php }else {
			$custom_page_setting = rwmb_meta('vbegy_custom_page_setting','checkbox',$post->ID);
			$post_share_s = rwmb_meta('vbegy_post_share_s','checkbox',$post->ID);
			$post_author_box_s = rwmb_meta('vbegy_post_author_box_s','checkbox',$post->ID);
			$related_post_s = rwmb_meta('vbegy_related_post_s','checkbox',$post->ID);
			$post_comments_s = rwmb_meta('vbegy_post_comments_s','checkbox',$post->ID);
			$post_navigation_s = rwmb_meta('vbegy_post_navigation_s','checkbox',$post->ID);
			$active_reports = vpanel_options("active_reports");
			$question_type = ($active_reports == 1?$question_type:$question_type." no_reports");?>
			<article <?php post_class('question single-question'.$question_type);?> id="post-<?php the_ID();?>" role="article" itemtype="http://schema.org/Article">
				<?php $question_follow = vpanel_options("question_follow");
				$question_control_style = vpanel_options("question_control_style");
				$following_questions_user = get_user_meta(get_current_user_id(),"following_questions");
				$following_questions = get_post_meta($post->ID,"following_questions");
				if ($question_control_style == "style_1" && (($post->post_author != 0 && $user_login_id_l->ID == $user_get_current_user_id) || ($question_follow == 1 && is_user_logged_in()) || (($post->post_author != 0 && $user_login_id_l->ID == $user_get_current_user_id) || is_super_admin($user_get_current_user_id)))) {?>
					<div class="edit-delete-follow-close">
						<h2>
							<?php $question_edit = vpanel_options("question_edit");
							if (($post->post_author != 0 && $user_login_id_l->ID == $user_get_current_user_id)) {
								if ($question_edit == 1) {?>
									<span class="question-edit">
										<a href="<?php echo esc_url(add_query_arg("q", $post->ID,get_page_link(vpanel_options('edit_question'))))?>" original-title="<?php _e("Edit the question","vbegy")?>" class="tooltip-n"><i class="icon-edit"></i></a>
									</span>
								<?php }
								$question_delete = vpanel_options("question_delete");
								if ($question_delete == 1) {
									if (isset($_GET) && isset($_GET["delete"]) && $_GET["delete"] == $post->ID) {
										wp_delete_post($post->ID);
										$protocol = is_ssl() ? 'https' : 'http';
										$redirect_to = wp_unslash( $protocol.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
										if ( is_ssl() && force_ssl_login() && !force_ssl_admin() && ( 0 !== strpos($redirect_to, 'https') ) && ( 0 === strpos($redirect_to, 'http') ) )$secure_cookie = false; else $secure_cookie = '';
										wp_redirect((is_page()?$redirect_to:home_url()));
									}?>
									<span class="question-delete">
										<a href="<?php echo esc_url(add_query_arg("delete", $post->ID,get_permalink($post->ID)))?>" original-title="<?php _e("Delete the question","vbegy")?>" class="tooltip-n"><i class="icon-remove"></i></a>
									</span>
								<?php }
							}
							
							if ($question_follow == 1 && is_user_logged_in()) {?>
								<span class="question-follow">
									<?php if (isset($following_questions) && isset($following_questions[0]) && is_array($following_questions[0]) && in_array(get_current_user_id(),$following_questions[0])) {?>
										<a href="#" original-title="<?php _e("Unfollow the question","vbegy")?>" class="tooltip-n unfollow-question"><i class="icon-circle-arrow-down"></i></a>
									<?php }else {?>
										<a href="#" original-title="<?php _e("Follow the question","vbegy")?>" class="tooltip-n"><i class="icon-circle-arrow-up"></i></a>
									<?php }?>
								</span>
							<?php }
							if (($post->post_author != 0 && $user_login_id_l->ID == $user_get_current_user_id) || is_super_admin($user_get_current_user_id)) {
								$question_close = vpanel_options("question_close");
								if (isset($question_close) && $question_close == 1) {
									if (isset($closed_question) && $closed_question == 1) {?>
										<span class="question-open">
											<a href="#" original-title="<?php _e("Open the question","vbegy")?>" class="tooltip-n"><i class="icon-unlock"></i></a>
										</span>
									<?php }else {?>
										<span class="question-close">
											<a href="#" original-title="<?php _e("Close the question","vbegy")?>" class="tooltip-n"><i class="icon-lock"></i></a>
										</span>
									<?php }
								}
							}?>
						</h2>
					</div>
				<?php }?>
				<h2 itemprop="name"><?php the_title();?></h2>
				<?php if ($active_reports == 1) {?>
					<a class="question-report report_q" href="#"><?php _e("Report","vbegy")?></a>
				<?php }
				if ($question_poll == 1) {?>
					<div class="question-type-main"><i class="icon-signal"></i><?php _e("Poll","vbegy")?></div>
				<?php }else {?>
					<div class="question-type-main"><i class="icon-question-sign"></i><?php _e("Question","vbegy")?></div>
				<?php }?>
				<div class="question-inner">
					<div class="clearfix"></div>
					<div class="question-desc" itemprop="mainContentOfPage">
						<?php
						$comments = get_comments('post_id='.$post->ID);
						$custom_permission = vpanel_options("custom_permission");
						$show_question = vpanel_options("show_question");
						if (is_user_logged_in()) {
							$user_is_login = get_userdata($user_get_current_user_id);
							$user_login_group = key($user_is_login->caps);
							$roles = $user_is_login->allcaps;
						}
						if ($custom_permission != 1 || (is_user_logged_in() && isset($roles["show_question"]) && $roles["show_question"] == 1) || (!is_user_logged_in() && $show_question == 1) || $user_get_current_user_id == $post->post_author) {
							if ($active_reports == 1) {?>
								<div class="explain-reported">
									<h3><?php _e("Please briefly explain why you feel this question should be reported .","vbegy")?></h3>
									<textarea name="explain-reported"></textarea>
									<div class="clearfix"></div>
									<div class="loader_3"></div>
									<div class="color button small report"><?php _e("Report","vbegy")?></div>
									<div class="color button small dark_button cancel"><?php _e("Cancel","vbegy")?></div>
								</div><!-- End reported -->
							<?php }
							if ($question_poll == 1) {?>
								<div class='question_poll_end'>
									<?php
									$poll_user_only = vpanel_options("poll_user_only");
									$question_poll_num = get_post_meta($post->ID,'question_poll_num',true);
									$custom = get_post_custom($post->ID);
									$asks = unserialize($custom["ask"][0]);
									if ($asks) {
										$i = 0;?>
										<div class="poll_1" <?php if ($poll_user_only == 1 && $user_get_current_user_id == 0) {echo ' style="display:block"';}else if (!isset($_COOKIE['question_poll'.$post->ID])) {echo ' style="display:none"';}?>>
											<div class="progressbar-warp">
												<?php foreach($asks as $ask):$i++;
													if ($question_poll_num != "" or $question_poll_num != 0) {
														$value_poll = round(($ask['value']/$question_poll_num)*100,2);
													}?>
													<span class="progressbar-title"><?php echo stripslashes($ask['title'])?> <?php echo ($question_poll_num == 0?0:$value_poll)?>%<span><?php echo ($ask['value'] != ""?"( ".stripslashes($ask['value'])." ".__("voter","vbegy")." )":"")?></span></span>
													<div class="progressbar">
													    <div class="progressbar-percent <?php echo ($ask['value'] == 0?"poll-result":"")?>" <?php echo ($ask['value'] == 0?"":"style='background-color: #3498db;'")?> attr-percent="<?php echo ($ask['value'] == 0?100:$value_poll)?>"></div>
													</div>
												<?php endforeach;?>
											</div><!-- End progressbar-warp -->
											<?php
											if (empty($poll_user_only) || ($poll_user_only == 1 && $user_get_current_user_id != 0)) {
												if (!isset($_COOKIE['question_poll'.$post->ID])) { ?><a href='#' class='color button small poll_polls margin_0'><?php _e("Rating","vbegy")?></a><?php }
											}?>
										</div>
										<div class="clear"></div>
										<?php if (empty($poll_user_only) || ($poll_user_only == 1 && $user_get_current_user_id != 0)) {?>
											<div class="poll_2"><div class="loader_3"></div>
												<div class="form-style form-style-3">
													<div class="form-inputs clearfix">
														<?php if (!isset($_COOKIE['question_poll'.$post->ID])) {
															foreach($asks as $ask):$i++;
																?>
																<p>
																	<input id="ask[<?php echo $i?>][title]" name="ask_radio" type="radio" value="poll_<?php echo (int)$ask['id']?>" rel="poll_<?php echo stripslashes($ask['title'])?>">
																	<label for="ask[<?php echo $i?>][title]"><?php echo stripslashes($ask['title'])?></label>
																</p>
															<?php endforeach;
														}?>
													</div>
												</div>
												<?php if (!isset($_COOKIE['question_poll'.$post->ID])) { ?><a href='#' class='color button small poll_results margin_0'><?php _e("Results","vbegy")?></a><?php }?>
											</div>
										<?php }
									}?>
								</div><!-- End question_poll_end -->
								<div class="clearfix height_20"></div>
								<?php
							}
							$video_description = get_post_meta($post->ID,'video_description',true);
							if (vpanel_options("video_desc_active") == 1 && $video_description == 1) {
								$video_desc = get_post_meta($post->ID,'video_desc',true);
								$video_id = get_post_meta($post->ID,'video_id',true);
								$video_type = get_post_meta($post->ID,'video_type',true);
								if ($video_id != "") {
									if ($video_type == 'youtube') {
										$type = "http://www.youtube.com/embed/".$video_id;
									}else if ($video_type == 'vimeo') {
										$type = "http://player.vimeo.com/video/".$video_id;
									}else if ($video_type == 'daily') {
										$type = "http://www.dailymotion.com/swf/video/".$video_id;
									}
									if ($vbegy_sidebar_all == "full") {
								    	$las_video = '<div class="question-video"><iframe height="600" src="'.$type.'"></iframe></div>';
									}else {
								    	$las_video = '<div class="question-video"><iframe height="450" src="'.$type.'"></iframe></div>';
									}
									if (vpanel_options("video_desc") == "before") {
										echo $las_video;
									}
								}
							}
							the_content();
							if (vpanel_options("video_desc") == "after" && vpanel_options("video_desc_active") == 1 && $video_id != "" && $video_description == 1) {
								echo $las_video;
							}
							if (is_user_logged_in()) {
								$user_login_id2 = get_user_by("id",$user_get_current_user_id);
								$_favorites = get_user_meta($user_get_current_user_id,$user_login_id2->user_login."_favorites");
								if (isset($_favorites[0])) {
									if (in_array($post->ID,$_favorites[0])) {?>
										<a class="remove_favorite add_favorite_in color button small margin_0" title="<?php _e("Remove the question of my favorites","vbegy")?>" href="#"><?php _e("Remove the question of my favorites","vbegy")?></a>
									<?php }else {?>
										<a class="add_favorite add_favorite_in color button small margin_0" title="<?php _e("Add a question to Favorites","vbegy")?>" href="#"><?php _e("Add a question to Favorites","vbegy")?></a>
									<?php
									}
								}else {echo '<a class="add_favorite add_favorite_in color button small margin_0" title="'.__("Add a question to Favorites","vbegy").'" href="#">'.__("Add a question to Favorites","vbegy").'</a>';}
								$question_bump = vpanel_options("question_bump");
								$active_points = vpanel_options("active_points");
								if (empty($comments) && $user_get_current_user_id == $post->post_author && $post->post_author != 0 && $question_bump == 1 && $active_points == 1) {?>
									<div class="form-style form-style-2 form-add-point">
										<p class="clearfix">
											<input id="input-add-point" name="" type="text" placeholder="<?php _e("Question bump points","vbegy")?>">
											<a class="color button small margin_0 f_left" href="#"><?php _e("Bump","vbegy")?></a>
										</p>
									</div>
								<?php }
							}?>
							<div class="loader_2"></div>
							<?php
							$added_file = get_post_meta($post->ID, 'added_file', true);
							if ($added_file != "") {
								echo "<div class='clear'></div><br><a class='attachment-link' href='".wp_get_attachment_url($added_file)."'><i class='icon-link'></i>".__("Attachment","vbegy")."</a>";
							}
							$attachment_m = get_post_meta($post->ID, 'attachment_m');
							if (isset($attachment_m) && is_array($attachment_m) && !empty($attachment_m)) {
								$attachment_m = $attachment_m[0];
								if (isset($attachment_m) && is_array($attachment_m)) {
									foreach ($attachment_m as $key => $value) {
										echo "<div class='clear'></div><br><a class='attachment-link' href='".wp_get_attachment_url($value["added_file"])."'><i class='icon-link'></i>".__("Attachment","vbegy")."</a>";
									}
								}
							}
							if ($question_control_style == "style_2" && (($post->post_author != 0 && $user_login_id_l->ID == $user_get_current_user_id) || ($question_follow == 1 && is_user_logged_in()) || (($post->post_author != 0 && $user_login_id_l->ID == $user_get_current_user_id) || is_super_admin($user_get_current_user_id)))) {?>
								<div class="edit-delete-follow-close-2">
									<?php $question_edit = vpanel_options("question_edit");
									if (($post->post_author != 0 && $user_login_id_l->ID == $user_get_current_user_id)) {
										if ($question_edit == 1) {?>
											<div class="question-edit">
												<a href="<?php echo esc_url(add_query_arg("q", $post->ID,get_page_link(vpanel_options('edit_question'))))?>" original-title="<?php _e("Edit the question","vbegy")?>" class="tooltip-n color button small margin_0 f_left"><?php _e("Edit","vbegy")?></a>
											</div>
										<?php }
										$question_delete = vpanel_options("question_delete");
										if ($question_delete == 1) {
											if (isset($_GET) && isset($_GET["delete"]) && $_GET["delete"] == $post->ID) {
												wp_delete_post($post->ID);
												$protocol = is_ssl() ? 'https' : 'http';
												$redirect_to = wp_unslash( $protocol.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
												if ( is_ssl() && force_ssl_login() && !force_ssl_admin() && ( 0 !== strpos($redirect_to, 'https') ) && ( 0 === strpos($redirect_to, 'http') ) )$secure_cookie = false; else $secure_cookie = '';
												wp_redirect((is_page()?$redirect_to:home_url()));
											}?>
											<div class="question-delete">
												<a href="<?php echo esc_url(add_query_arg("delete", $post->ID,get_permalink($post->ID)))?>" original-title="<?php _e("Delete the question","vbegy")?>" class="tooltip-n color button small margin_0 f_left"><?php _e("Delete","vbegy")?></a>
											</div>
										<?php }
									}
									
									if ($question_follow == 1 && is_user_logged_in()) {?>
										<div class="question-follow">
											<?php if (isset($following_questions) && isset($following_questions[0]) && is_array($following_questions[0]) && in_array(get_current_user_id(),$following_questions[0])) {?>
												<a href="#" original-title="<?php _e("Unfollow the question","vbegy")?>" class="tooltip-n unfollow-question color button small margin_0 f_left"><?php _e("Unfollow","vbegy")?></a>
											<?php }else {?>
												<a href="#" original-title="<?php _e("Follow the question","vbegy")?>" class="tooltip-n color button small margin_0 f_left"><?php _e("Follow","vbegy")?></a>
											<?php }?>
										</div>
									<?php }
									if (($post->post_author != 0 && $user_login_id_l->ID == $user_get_current_user_id) || is_super_admin($user_get_current_user_id)) {
										$question_close = vpanel_options("question_close");
										if (isset($question_close) && $question_close == 1) {
											if (isset($closed_question) && $closed_question == 1) {?>
												<div class="question-open">
													<a href="#" original-title="<?php _e("Open the question","vbegy")?>" class="tooltip-n color button small margin_0 f_left"><?php _e("Open","vbegy")?></a>
												</div>
											<?php }else {?>
												<div class="question-close">
													<a href="#" original-title="<?php _e("Close the question","vbegy")?>" class="tooltip-n color button small margin_0 f_left"><?php _e("Close","vbegy")?></a>
												</div>
											<?php }
										}
									}?>
									<div class="clearfix"></div>
								</div>
							<?php }
							?>
							<div class="no_vote_more"></div>
						<?php }else {
							echo '<div class="note_error"><strong>'.__("Sorry do not have permission to show the questions !","vbegy").'</strong></div>';
						}?>
					</div>
					<div class="question-details">
						<?php if (isset($the_best_answer) && $the_best_answer != "" && $comments) {?>
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
						$question_email = get_post_meta($post->ID, 'question_email',true);?>
						<span class="question-author-meta"><i class="icon-user"></i><?php echo $question_username?></span>
					<?php }?>
					<span class="question-date" datetime="<?php echo get_the_date(); ?>"><i class="fa fa-calendar"></i>
					<?php echo human_time_diff(get_the_time('U'), current_time('timestamp'));?></span>
					<span class="question-comment"><a href="<?php echo comments_link()?>"><i class="fa fa-comments-o"></i><?php echo get_comments_number()?> <?php _e("Answer","vbegy");?></a></span>
					<meta itemprop="interactionCount" content="<?php comments_number( 'UserAnswers: 0', 'UserAnswers: 1', 'UserAnswers: %' ); ?>">
					<span class="question-view"><i class="icon-eye-open"></i><?php echo get_post_meta($post->ID, 'post_stats', true);?> <?php _e("views","vbegy");?></span>
					<?php if (isset($authordata->ID) && $authordata->ID > 0) {
						echo vpanel_get_badge($authordata->ID);
					}
					$active_vote = vpanel_options("active_vote");
					$show_dislike_questions = vpanel_options("show_dislike_questions");
					if ($active_vote == 1) {?>
						<span class="single-question-vote-result question_vote_result"><?php echo ($question_vote != ""?$question_vote:0)?></span>
						<ul class="single-question-vote">
							<?php if (is_user_logged_in() && $post->post_author != get_current_user_id()){
								if ($show_dislike_questions != 1) {?>
									<li><a href="#" id="question_vote_down-<?php echo $post->ID?>" class="single-question-vote-down ask_vote_down question_vote_down vote_allow<?php echo (isset($_COOKIE['question_vote'.$post->ID])?" ".$_COOKIE['question_vote'.$post->ID]."-".$post->ID:"")?> tooltip_s" title="<?php _e("Dislike","vbegy");?>"><i class="icon-thumbs-down"></i></a></li>
								<?php }?>
								<li><a href="#" id="question_vote_up-<?php echo $post->ID?>" class="single-question-vote-up ask_vote_up question_vote_up vote_allow<?php echo (isset($_COOKIE['question_vote'.$post->ID])?" ".$_COOKIE['question_vote'.$post->ID]."-".$post->ID:"")?> tooltip_s" title="<?php _e("Like","vbegy");?>"><i class="icon-thumbs-up"></i></a></li>
							<?php }else {
								if ($show_dislike_questions != 1) {?>
									<li><a href="#" class="single-question-vote-down ask_vote_down question_vote_down <?php echo (is_user_logged_in() && $post->post_author == get_current_user_id()?"vote_not_allow":"vote_not_user")?> tooltip_s" original-title="<?php _e("Dislike","vbegy");?>"><i class="icon-thumbs-down"></i></a></li>
								<?php }?>
								<li><a href="#" class="single-question-vote-up ask_vote_up question_vote_up <?php echo (is_user_logged_in() && $post->post_author == get_current_user_id()?"vote_not_allow":"vote_not_user")?> tooltip_s" original-title="<?php _e("Like","vbegy");?>"><i class="icon-thumbs-up"></i></a></li>
							<?php }?>
						</ul>
					<?php }?>
					<div class="clearfix"></div>
				</div>
			</article>
			
			<?php $terms = wp_get_object_terms( $post->ID, 'question_tags' );
			$post_share = vpanel_options("post_share");
			if ($terms || (($post_share == 1 && $post_share_s == "") || ($post_share == 1 && isset($custom_page_setting) && $custom_page_setting == 0) || ($post_share == 1 && isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_share_s) && $post_share_s != 0) || (isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_share_s) && $post_share_s == 1))) {?>
				<div class="share-tags page-content">
					<?php
					if ($terms) :
						echo '<div class="question-tags"><i class="icon-tags"></i>';
							$terms_array = array();
							foreach ($terms as $term) :
								$terms_array[] = '<a href="'.get_term_link($term->slug, 'question_tags').'">'.$term->name.'</a>';
							endforeach;
							echo implode(' , ', $terms_array);
						echo '</div>';
					endif;
					
					if (($post_share == 1 && $post_share_s == "") || ($post_share == 1 && isset($custom_page_setting) && $custom_page_setting == 0) || ($post_share == 1 && isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_share_s) && $post_share_s != 0) || (isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_share_s) && $post_share_s == 1)) {?>
						<div class="share-inside-warp">
							<ul>
								<li>
									<a href="http://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank">
										<span class="icon_i">
											<span class="icon_square" icon_size="20" span_bg="#3b5997" span_hover="#666">
												<i i_color="#FFF" class="social_icon-facebook"></i>
											</span>
										</span>
									</a>
									<a href="http://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank"><?php _e("Facebook","vbegy");?></a>
								</li>
								<li>
									<a href="http://twitter.com/home?status=<?php echo urlencode(get_permalink());?>" target="_blank">
										<span class="icon_i">
											<span class="icon_square" icon_size="20" span_bg="#00baf0" span_hover="#666">
												<i i_color="#FFF" class="social_icon-twitter"></i>
											</span>
										</span>
									</a>
									<a target="_blank" href="http://twitter.com/home?status=<?php echo urlencode(get_permalink());?>"><?php _e("Twitter","vbegy");?></a>
								</li>
								<li>
									<a href="http://plus.google.com/share?url=<?php echo urlencode(get_permalink());?>" target="_blank">
										<span class="icon_i">
											<span class="icon_square" icon_size="20" span_bg="#ca2c24" span_hover="#666">
												<i i_color="#FFF" class="social_icon-gplus"></i>
											</span>
										</span>
									</a>
									<a href="http://plus.google.com/share?url=<?php echo urlencode(get_permalink());?>" target="_blank"><?php _e("Google plus","vbegy");?></a>
								</li>
								<li>
									<a href="http://www.tumblr.com/share/link?url=<?php echo urlencode(get_permalink()) ?>&amp;name=<?php echo urlencode(get_the_title()) ?>" target="_blank">
										<span class="icon_i">
											<span class="icon_square" icon_size="20" span_bg="#44546b" span_hover="#666">
												<i i_color="#FFF" class="social_icon-tumblr"></i>
											</span>
										</span>
									</a>
									<a href="http://www.tumblr.com/share/link?url=<?php echo urlencode(get_permalink()) ?>&amp;name=<?php echo urlencode(get_the_title()) ?>" target="_blank"><?php _e("Tumblr","vbegy");?></a>
								</li>
								<li>
									<a target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php 
										echo urlencode(get_permalink());?>&amp;media=<?php echo urlencode(wp_get_attachment_url(get_post_thumbnail_id($post->ID)));?>">
										<span class="icon_i">
											<span class="icon_square" icon_size="20" span_bg="#c7151a" span_hover="#666">
												<i i_color="#FFF" class="icon-pinterest"></i>
											</span>
										</span>
									</a>
									<a href="http://pinterest.com/pin/create/button/?url=<?php 
										echo urlencode(get_permalink());?>&amp;media=<?php echo urlencode(wp_get_attachment_url(get_post_thumbnail_id($post->ID)));?>" target="_blank"><?php _e("Pinterest","vbegy");?></a>
								</li>
								<li>
									<a target="_blank" onClick="popup = window.open('mailto:?subject=<?php the_title(); ?>&amp;body=<?php the_permalink(); ?>', 'PopupPage', 'height=450,width=500,scrollbars=yes,resizable=yes'); return false" href="#">
										<span class="icon_i">
											<span class="icon_square" icon_size="20" span_bg="#000" span_hover="#666">
												<i i_color="#FFF" class="social_icon-email"></i>
											</span>
										</span>
									</a>
									<a target="_blank" onClick="popup = window.open('mailto:?subject=<?php the_title(); ?>&amp;body=<?php the_permalink(); ?>', 'PopupPage', 'height=450,width=500,scrollbars=yes,resizable=yes'); return false" href="#"><?php _e("Email","vbegy");?></a>
								</li>
							</ul>
							<span class="share-inside-f-arrow"></span>
							<span class="share-inside-l-arrow"></span>
						</div><!-- End share-inside-warp -->
						<div class="share-inside"><i class="icon-share-alt"></i><?php _e("Share","vbegy");?></div>
					<?php }?>
					<div class="clearfix"></div>
				</div><!-- End share-tags -->
			<?php }
		}
	endwhile; endif;
	
	if ($yes_private == 1) {
		$vbegy_custom_sections = get_post_meta($post->ID,"vbegy_custom_sections",true);
		if (isset($vbegy_custom_sections) && $vbegy_custom_sections == 1) {
			$order_sections_li = get_post_meta($post->ID,"order_sections_li");
			if (empty($order_sections_li)) {
				$order_sections_li = array(0 => array(1 => "advertising",2 => "author",3 => "related",4 => "advertising_2",5 => "comments",6 => "next_previous"));
			}
			$order_sections = $order_sections_li[0];
		}else {
			$order_sections_li = vpanel_options("order_sections_li");
			if (empty($order_sections_li)) {
				$order_sections_li = array(1 => "advertising",2 => "author",3 => "related",4 => "advertising_2",5 => "comments",6 => "next_previous");
			}
			$order_sections = $order_sections_li;
		}
		foreach ($order_sections as $key_r => $value_r) {
			if ($value_r == "") {
				unset($order_sections[$key_r]);
			}else {
				if ($value_r == "advertising") {
					$vbegy_share_adv_type = rwmb_meta('vbegy_share_adv_type','radio',$post->ID);
					$vbegy_share_adv_code = rwmb_meta('vbegy_share_adv_code','textarea',$post->ID);
					$vbegy_share_adv_href = rwmb_meta('vbegy_share_adv_href','text',$post->ID);
					$vbegy_share_adv_img = rwmb_meta('vbegy_share_adv_img','upload',$post->ID);
					
					if ((is_single() || is_page()) && (($vbegy_share_adv_type == "display_code" && $vbegy_share_adv_code != "") || ($vbegy_share_adv_type == "custom_image" && $vbegy_share_adv_img != ""))) {
						$share_adv_type = $vbegy_share_adv_type;
						$share_adv_code = $vbegy_share_adv_code;
						$share_adv_href = $vbegy_share_adv_href;
						$share_adv_img = $vbegy_share_adv_img;
					}else {
						$share_adv_type = vpanel_options("share_adv_type");
						$share_adv_code = vpanel_options("share_adv_code");
						$share_adv_href = vpanel_options("share_adv_href");
						$share_adv_img = vpanel_options("share_adv_img");
					}
					if (($share_adv_type == "display_code" && $share_adv_code != "") || ($share_adv_type == "custom_image" && $share_adv_img != "")) {
						echo '<div class="clearfix"></div>
						<div class="advertising">';
						if ($share_adv_type == "display_code") {
							echo stripcslashes($share_adv_code);
						}else {
							if ($share_adv_href != "") {
								echo '<a target="_blank" href="'.$share_adv_href.'">';
							}
							echo '<img alt="" src="'.$share_adv_img.'">';
							if ($share_adv_href != "") {
								echo '</a>';
							}
						}
						echo '</div><!-- End advertising -->
						<div class="clearfix"></div>';
					}
				}else if ($value_r == "advertising_2") {
					$vbegy_related_adv_type = rwmb_meta('vbegy_related_adv_type','radio',$post->ID);
					$vbegy_related_adv_code = rwmb_meta('vbegy_related_adv_code','textarea',$post->ID);
					$vbegy_related_adv_href = rwmb_meta('vbegy_related_adv_href','text',$post->ID);
					$vbegy_related_adv_img = rwmb_meta('vbegy_related_adv_img','upload',$post->ID);
					
					if ((is_single() || is_page()) && (($vbegy_related_adv_type == "display_code" && $vbegy_related_adv_code != "") || ($vbegy_related_adv_type == "custom_image" && $vbegy_related_adv_img != ""))) {
						$related_adv_type = $vbegy_related_adv_type;
						$related_adv_code = $vbegy_related_adv_code;
						$related_adv_href = $vbegy_related_adv_href;
						$related_adv_img = $vbegy_related_adv_img;
					}else {
						$related_adv_type = vpanel_options("related_adv_type");
						$related_adv_code = vpanel_options("related_adv_code");
						$related_adv_href = vpanel_options("related_adv_href");
						$related_adv_img = vpanel_options("related_adv_img");
					}
					if (($related_adv_type == "display_code" && $related_adv_code != "") || ($related_adv_type == "custom_image" && $related_adv_img != "")) {
						echo '<div class="clearfix"></div>
						<div class="advertising">';
						if ($related_adv_type == "display_code") {
							echo stripcslashes($related_adv_code);
						}else {
							if ($related_adv_href != "") {
								echo '<a target="_blank" href="'.$related_adv_href.'">';
							}
							echo '<img alt="" src="'.$related_adv_img.'">';
							if ($related_adv_href != "") {
								echo '</a>';
							}
						}
						echo '</div><!-- End advertising -->
						<div class="clearfix"></div>';
					}
				}else if ($value_r == "author") {
					$post_author_box = vpanel_options("post_author_box");
					if (($post_author_box == 1 && $post_author_box_s == "") || ($post_author_box == 1 && isset($custom_page_setting) && $custom_page_setting == 0) || ($post_author_box == 1 && isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_author_box_s) && $post_author_box_s != 0) || (isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_author_box_s) && $post_author_box_s == 1)) {
						if ($post->post_author != 0) {
							$twitter = get_the_author_meta('twitter',$post->post_author);
							$facebook = get_the_author_meta('facebook',$post->post_author);
							$google = get_the_author_meta('google',$post->post_author);
							$linkedin = get_the_author_meta('linkedin',$post->post_author);
							$follow_email = get_the_author_meta('follow_email',$post->post_author);
							$youtube = get_the_author_meta('youtube',$post->post_author);
							$pinterest = get_the_author_meta('pinterest',$post->post_author);
							$instagram = get_the_author_meta('instagram',$post->post_author);?>
							<div class="about-author clearfix">
							    <div class="author-image">
							    	<a href="<?php echo vpanel_get_user_url($post->post_author,$authordata->user_nicename);?>" original-title="<?php the_author();?>" class="tooltip-n">
							    		<?php 
							    		if (get_the_author_meta('you_avatar', $post->post_author)) {
							    			$you_avatar_img = get_aq_resize_url(esc_attr(get_the_author_meta('you_avatar', $post->post_author)),"full",65,65);
							    			echo "<img alt='".$authordata->display_name."' src='".$you_avatar_img."'>";
							    		}else {
							    			echo get_avatar($post->post_author,'65');
							    		}?>
							    	</a>
							    </div>
							    <div class="author-bio">
							        <h4>
							        	<?php _e("About the Author","vbegy");
							        	if (isset($post->post_author) && $post->post_author > 0) {
							        		echo vpanel_get_badge($post->post_author);
							        	}?>
							        </h4>
							        <?php the_author_meta('description');?>
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
							    </div>
							</div><!-- End about-author -->
						<?php }
					}
				}else if ($value_r == "related") {
					$related_post = vpanel_options("related_post");
					if (($related_post == 1 && $related_post_s == "") || ($related_post == 1 && isset($custom_page_setting) && $custom_page_setting == 0) || ($related_post == 1 && isset($custom_page_setting) && $custom_page_setting == 1 && isset($related_post_s) && $related_post_s != 0) || (isset($custom_page_setting) && $custom_page_setting == 1 && isset($related_post_s) && $related_post_s == 1)) {
						$related_no = vpanel_options('related_number') ? vpanel_options('related_number') : 5;
						global $post;
						$orig_post = $post;
						$related_query_ = array();
						$related_cat_tag = vpanel_options("related_query");
						
						if ($related_cat_tag == "tags") {
							$term_list = wp_get_post_terms($post->ID, 'question_tags', array("fields" => "ids"));
							$related_query_ = array('tax_query' => array(array('taxonomy' => 'question_tags','field' => 'id','terms' => $term_list,'operator' => 'IN')));
						}else {
							$categories = wp_get_post_terms($post->ID,'question-category',array("fields" => "ids"));
							$related_query_ = array('tax_query' => array(array('taxonomy' => 'question-category','field' => 'id','terms' => $categories,'operator' => 'IN')));
						}
						
						$args = array_merge($related_query_,array('post_type' => 'question','post__not_in' => array($post->ID),'posts_per_page'=> $related_no));
						$related_query = new wp_query( $args );
						if ($related_query->have_posts()) : ;?>
							<div id="related-posts">
								<h2><?php _e("Related questions","vbegy");?></h2>
								<ul class="related-posts">
									<?php while ( $related_query->have_posts() ) : $related_query->the_post()?>
										<li class="related-item"><h3><a  href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>"><i class="icon-double-angle-right"></i><?php the_title();?></a></h3></li>
									<?php endwhile;?>
								</ul>
							</div><!-- End related-posts -->
						<?php endif;
						$post = $orig_post;
						wp_reset_query();
					}
				}else if ($value_r == "comments") {
					$post_comments = vpanel_options("post_comments");
					if (($post_comments == 1 && $post_comments_s == "") || ($post_comments == 1 && isset($custom_page_setting) && $custom_page_setting == 0) || ($post_comments == 1 && isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_comments_s) && $post_comments_s != 0) || (isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_comments_s) && $post_comments_s == 1)) {
						comments_template("/question-comments.php");
					}
				}else if ($value_r == "next_previous") {
					$post_navigation = vpanel_options("post_navigation");
					if (($post_navigation == 1 && $post_navigation_s == "") || ($post_navigation == 1 && isset($custom_page_setting) && $custom_page_setting == 0) || ($post_navigation == 1 && isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_navigation_s) && $post_navigation_s != 0) || (isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_navigation_s) && $post_navigation_s == 1)) {?>
						<div class="post-next-prev clearfix">
						    <p class="prev-post">
						        <?php previous_post_link('%link','<i class="icon-double-angle-left"></i>'.__('&nbsp;Previous question','vbegy')); ?>
						    </p>
						    <p class="next-post">
						    	<?php next_post_link('%link',__('Next question&nbsp;','vbegy').'<i class="icon-double-angle-right"></i>'); ?>
						    </p>
						</div><!-- End post-next-prev -->
					<?php }
				}
			}
		}
	}
get_footer();?>