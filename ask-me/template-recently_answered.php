<?php /* Template Name: Recently Answered  */
get_header();
	$rows_per_page  = get_option("posts_per_page");
	$paged          = (get_query_var("paged") != ""?(int)get_query_var("paged"):(get_query_var("page") != ""?(int)get_query_var("page"):1));
	$offset		    = ($paged-1)*$rows_per_page;
	$comments	    = get_comments(array("post_type" => "question","status" => "approve"));
	$query		    = get_comments(array("offset" => $offset,"post_type" => "question","status" => "approve","number" => $rows_per_page));
	$total_comments = count($comments);
	$total_query    = count($query);
	$total_pages    = (int)ceil($total_comments/$rows_per_page);
	if ($query) {?>
		<div id="commentlist" class="page-content">
			<ol class="commentlist clearfix">
				<?php
				foreach ($query as $comment) {
					$comment_vote = get_comment_meta($comment->comment_ID,'comment_vote');
					$comment_vote = (!empty($comment_vote)?$comment_vote[0]["vote"]:"");
					if ($comment->user_id != 0){
						$user_login_id_l = get_user_by("id",$comment->user_id);
					}
					$question_category = wp_get_post_terms($comment->comment_post_ID,'question-category',array("fields" => "all"));
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
							if (isset($get_question_category_parent[0]) && isset($get_question_category_parent['private']) && $get_question_category_parent['private'] == "on" && isset($authordata->ID) && $authordata->ID > 0 && $authordata->ID == get_current_user_id()) {
								$yes_private = 1;
							}else if (isset($question_category[0]) && isset($get_question_category_parent['private']) && $get_question_category_parent['private'] == "on" && !isset($authordata->ID)) {
								$yes_private = 0;
							}
						}
					}else {
						$yes_private = 1;
					}
					if (is_super_admin(get_current_user_id())) {
						$yes_private = 1;
					}
					if ($yes_private == 1) {
						include("includes/answers.php");
					}else {?>
						<li class="comment"><div class="comment-body clearfix"><?php _e("Sorry it a private answer .");?></div></li>
					<?php }
				}?>
			</ol>
		</div>
		<?php if ($total_comments > $total_query) {
			echo '<div class="pagination">';
			$current_page = max(1,$paged);
			echo paginate_links(array(
				'base' => get_pagenum_link(1).'%_%',
				'format' => 'page/%#%/',
				'current' => $current_page,
				'show_all' => false,
				'total' => $total_pages,
				'prev_text' => '<i class="icon-angle-left"></i>',
				'next_text' => '<i class="icon-angle-right"></i>',
			));
			echo '</div><div class="clearfix"></div>';
		}
	}else {?>
		<div class="error_404">
			<div>
				<h2><?php _e("No answers","vbegy")?></h2>
				<h3><?php _e("No answers yet .","vbegy")?></h3>
			</div>
			<div class="clearfix"></div><br>
			<a href="<?php echo esc_url(home_url('/'));?>" class="button large color margin_0"><?php _e("Home Page","vbegy")?></a>
		</div>
	<?php }
get_footer();?>