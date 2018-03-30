<?php /* Template name: Follow answer */
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
$show_point_favorite = get_user_meta($user_login->ID,"show_point_favorite",true);
if($show_point_favorite != 1 && $owner == false){
	wp_redirect(home_url());
}
get_header();
	include (get_template_directory() . '/includes/author-head.php');
	$following_me = get_user_meta($user_login->ID,"following_me");
	
	$following_me_0 = array();
	if (isset($following_me[0])) {
		$following_me_0 = $following_me[0];
	}
	$following_me_array = $following_me_0;
	if (is_array($following_me_array)) {
		$following_me_array = array_filter($following_me_array);
	}
	if (isset($following_me_array) && is_array($following_me_array) && !empty($following_me_array)) {
		$rows_per_page = get_option("posts_per_page");
		$paged         = (get_query_var("paged") != ""?(int)get_query_var("paged"):(get_query_var("page") != ""?(int)get_query_var("page"):1));
		$offset		   = ($paged-1)*$rows_per_page;
		
		$comments_all = $wpdb->get_results("SELECT * FROM {$wpdb->comments} JOIN {$wpdb->posts} ON {$wpdb->posts}.ID = {$wpdb->comments}.comment_post_ID WHERE {$wpdb->posts}.post_type = 'question' AND {$wpdb->comments}.comment_approved = '1' AND {$wpdb->comments}.user_id IN ('" . join("', '", $following_me_array) . "') ORDER BY {$wpdb->comments}.comment_date_gmt DESC");
		
		$comments_all_q = $wpdb->get_results("SELECT * FROM {$wpdb->comments} JOIN {$wpdb->posts} ON {$wpdb->posts}.ID = {$wpdb->comments}.comment_post_ID WHERE {$wpdb->posts}.post_type = 'question' AND {$wpdb->comments}.comment_approved = '1' AND {$wpdb->comments}.user_id IN ('" . join("', '", $following_me_array) . "') ORDER BY {$wpdb->comments}.comment_date_gmt DESC LIMIT {$offset} , {$rows_per_page}");
		
		if ($comments_all) {
			$current = max( 1, get_query_var('page') );
			$pagination_args = array(
				'base' => @esc_url(add_query_arg('page','%#%')),
				'format' => 'page/%#%/?u='.$_GET['u'],
				'total' => (int)ceil(count($comments_all)/$rows_per_page),
				'current' => $current,
				'show_all' => false,
				'prev_text' => '<i class="icon-angle-left"></i>',
				'next_text' => '<i class="icon-angle-right"></i>',
			);
			
			if( !empty($wp_query->query_vars['s']) )
				$pagination_args['add_args'] = array('s'=>get_query_var('s'));?>
			
			<div id="commentlist" class="page-content">
				<ol class="commentlist clearfix">
					<?php foreach ($comments_all_q as $comment) {
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
	}else {
		echo "<div class='page-content page-content-user'><div class='user-questions'><p class='no-item'>".__("There are no user follow yet .","vbegy")."</p></div></div>";
	}
	if (isset($following_me_array) && is_array($following_me_array) && !empty($following_me_array) && count($comments_all) > count($comments_all_q) ) : ?>
		<div class='pagination'><?php echo (paginate_links($pagination_args) != ""?paginate_links($pagination_args):"")?></div>
	<?php endif;
get_footer();?>