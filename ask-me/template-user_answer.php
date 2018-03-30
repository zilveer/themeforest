<?php /* Template name: User Answer */
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
	
	$rows_per_page = get_option("posts_per_page");
	$comments_all = get_comments(array('user_id' => $user_login->ID,"status" => "approve",'post_type' => 'question'));
	if ($comments_all) {
		$current = max( 1, get_query_var('page') );
		$pagination_args = array(
			'base' => @esc_url(add_query_arg('page','%#%')),
			'format' => 'page/%#%/?u='.$_GET['u'],
			'total' => ceil(sizeof($comments_all)/$rows_per_page),
			'current' => $current,
			'show_all' => false,
			'prev_text' => '<i class="icon-angle-left"></i>',
			'next_text' => '<i class="icon-angle-right"></i>',
		);
		
		if( !empty($wp_query->query_vars['s']) )
			$pagination_args['add_args'] = array('s'=>get_query_var('s'));
		
		$start = ($current - 1) * $rows_per_page;
		$end = $start + $rows_per_page;
		?>
		<div id="commentlist" class="page-content">
			<ol class="commentlist clearfix">
				<?php $end = (sizeof($comments_all) < $end) ? sizeof($comments_all) : $end;
				for ($k = $start;$k < $end ;++$k ) {
					$comment = $comments_all[$k];
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
	<?php }else {echo "<div class='page-content page-content-user'><div class='user-questions'><p class='no-item'>".__("No answers yet .","vbegy")."</p></div></div>";}
		
	if ($comments_all && $pagination_args["total"] > 1) {?>
		<div class='pagination'><?php echo (paginate_links($pagination_args) != ""?paginate_links($pagination_args):"")?></div>
	<?php }
get_footer();?>