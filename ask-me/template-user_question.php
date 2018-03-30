<?php /* Template name: User Questions */
global $user_ID;
if(empty($_GET['u'])){
	wp_redirect(home_url());
}
$user_login = get_userdata($_GET['u']);
if(empty($user_login)){
	wp_redirect(home_url());
}
$owner = false;
if($user_ID == $user_login->ID){
	$owner = true;
}
get_header();
	include (get_template_directory() . '/includes/author-head.php');
	?>
	<div class="page-content page-content-user">
		<div class="user-questions">
			<?php
			$user_get_current_user_id = get_current_user_id();
			$paged = (get_query_var("paged") != ""?(int)get_query_var("paged"):(get_query_var("page") != ""?(int)get_query_var("page"):1));
			$args = array('post_type' => 'question','paged' => $paged,'author' => $user_login->ID);
			query_posts($args);
			if (have_posts()) : while ( have_posts() ) : the_post();
				$question_poll = get_post_meta($post->ID,'question_poll',true);
				$the_best_answer = get_post_meta($post->ID,"the_best_answer",true);
				$closed_question = get_post_meta($post->ID,"closed_question",true);
				$question_favorites = get_post_meta($id,'question_favorites',true);
				$question_category = wp_get_post_terms($post->ID,'question-category',array("fields" => "all"));
				$comments = get_comments('post_id='.$post->ID);
				$get_question_category = get_option("questions_category_".$question_category[0]->term_id);
				$yes_private = 0;
				if (isset($question_category[0])) {
					if (isset($question_category[0]) && isset($get_question_category['private']) && $get_question_category['private'] == "on") {
						if (isset($authordata->ID) && $authordata->ID > 0 && $authordata->ID == $user_get_current_user_id) {
							$yes_private = 1;
						}
					}else if (isset($question_category[0]) && !isset($get_question_category['private']) && $question_category[0]->parent == 0) {
						$yes_private = 1;
					}
					
					if (isset($question_category[0]) && $question_category[0]->parent > 0) {
						$get_question_category_parent = get_option("questions_category_".$question_category[0]->parent);
						if (isset($get_question_category_parent[0]) && isset($get_question_category_parent['private']) && $get_question_category_parent['private'] == "on" && isset($authordata->ID) && $authordata->ID > 0 && $authordata->ID == $user_get_current_user_id) {
							$yes_private = 1;
						}else if (isset($question_category[0]) && isset($get_question_category_parent['private']) && $get_question_category_parent['private'] == "on" && !isset($authordata->ID)) {
							$yes_private = 0;
						}
					}
				}else {
					$yes_private = 1;
				}
				if (is_super_admin($user_get_current_user_id)) {
					$yes_private = 1;
				}
				if ($yes_private == 1) {?>
					<article <?php post_class('question user-question');?> id="post-<?php the_ID();?>">
						<h3>
							<?php $question_edit = vpanel_options("question_edit");
							if ($user_ID == $user_login->ID) {
								if ($question_edit == 1) {?>
									<span class="question-edit">
										<a href="<?php echo esc_url(add_query_arg("q", $post->ID,get_page_link(vpanel_options('edit_question'))))?>" original-title="<?php _e("Edit the question","vbegy")?>" class="tooltip-n"><i class="icon-edit"></i></a>
									</span>
								<?php }
								$question_delete = vpanel_options("question_delete");
								if ($question_delete == 1) {?>
									<span class="question-delete">
										<a href="<?php echo esc_url(add_query_arg("delete", $post->ID,get_permalink($post->ID)))?>" original-title="<?php _e("Delete the question","vbegy")?>" class="tooltip-n"><i class="icon-remove"></i></a>
									</span>
								<?php }
							}?>
							<a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title()?></a>
						</h3>
						<?php if ($question_poll == 1) {?>
							<div class="question-type-main"><i class="icon-signal"></i><?php _e("Poll","vbegy")?></div>
						<?php }else {?>
							<div class="question-type-main"><i class="icon-question-sign"></i><?php _e("Question","vbegy")?></div>
						<?php }?>
						<div class="question-content">
							<div class="question-bottom">
								<?php if (isset($the_best_answer) && $the_best_answer != "" && $comments) {?>
									<span class="question-answered question-answered-done"><i class="icon-ok"></i><?php _e("solved","vbegy")?></span>
								<?php }else if (isset($closed_question) && $closed_question == 1) {?>
									<span class="question-answered question-closed"><i class="icon-lock"></i><?php _e("closed","vbegy")?></span>
								<?php }else if ($the_best_answer == "" && $comments) {?>
									<span class="question-answered"><i class="icon-ok"></i><?php _e("in progress","vbegy")?></span>
								<?php }?>
								<span class="question-favorite"><i class="<?php echo ($question_favorites > 0?"icon-star":"icon-star-empty");?>"></i><?php echo ($question_favorites != ""?$question_favorites:0);?></span>
								<?php if (isset($question_category[0])) {?>
									<span class="question-category"><a href="<?php echo get_term_link($question_category[0]->slug, "question-category");?>"><i class="fa fa-folder-o"></i><?php echo $question_category[0]->name?></a></span>
								<?php }?>
								<span class="question-date"><i class="fa fa-calendar"></i><?php echo human_time_diff(get_the_time('U'), current_time('timestamp'));?></span>
								<span class="question-comment"><a href="<?php echo comments_link()?>"><i class="fa fa-comments-o"></i><?php echo get_comments_number()?> <?php _e("Answer","vbegy");?></a></span>
								<a class="question-reply" href="<?php the_permalink();?>#commentform"><i class="icon-reply"></i><?php _e("Reply","vbegy")?></a>
								<span class="question-view"><i class="icon-eye-open"></i><?php echo get_post_meta($post->ID, 'post_stats', true);?> <?php _e("views","vbegy");?></span>
							</div>
						</div>
					</article>
				<?php }else {?>
					<article class="question private-question user-question">
						<p class="question-desc"><?php _e("Sorry it a private question .");?></p>
					</article>
				<?php }
			endwhile;else:echo "<p class='no-item'>".__("No questions yet .","vbegy")."</p>";endif;?>
		</div>
	</div>
	
	<?php if ($wp_query->max_num_pages > 1 ) : ?>
		<?php vpanel_pagination(); ?>
	<?php endif;
get_footer();?>