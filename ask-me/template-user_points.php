<?php /* Template name: User Points */
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
	$active_points = vpanel_options("active_points");
	if ($active_points == 1) {
		include (get_template_directory() . '/includes/author-head.php');
		?>
		<div class="page-content page-content-user">
			<div class="user-questions">
				<?php $rows_per_page = get_option("posts_per_page");
				$_points = get_user_meta($user_login->ID,$user_login->user_login."_points",true);
				$paged = (get_query_var("paged") != ""?(int)get_query_var("paged"):(get_query_var("page") != ""?(int)get_query_var("page"):1));
				
				for ($points = 1; $points <= $_points; $points++) {
					$point_one[] = get_user_meta($user_login->ID,$user_login->user_login."_points_".$points);
				}
				if (isset($point_one) and is_array($point_one)) {
					$point = array_reverse($point_one);
					
					$current = max(1,$paged);
					$pagination_args = array(
						'base' => @esc_url(add_query_arg('paged','%#%')),
						'format' => 'page/%#%/?u='.$_GET['u'],
						'total' => ceil(sizeof($point)/$rows_per_page),
						'current' => $current,
						'show_all' => false,
						'prev_text' => '<i class="icon-angle-left"></i>',
						'next_text' => '<i class="icon-angle-right"></i>',
					);
					
					if( !empty($wp_query->query_vars['s']) )
						$pagination_args['add_args'] = array('s'=>get_query_var('s'));
						
					$start = ($current - 1) * $rows_per_page;
					$end = $start + $rows_per_page;
					$end = (sizeof($point) < $end) ? sizeof($point) : $end;
					for ($i=$start;$i < $end ;++$i ) {
						$point_result = $point[$i];?>
						<article class="question user-question user-points">
							<div class="question-content">
								<div class="question-bottom">
									<h3>
									<?php if (!empty($point_result[0][5]) && !empty($point_result[0][6])) {?>
										<a href="<?php echo get_the_permalink($point_result[0][5]).(isset($point_result[0][6])?"#comment-".$point_result[0][6]:"")?>">
									<?php }else if (!empty($point_result[0][5]) && empty($point_result[0][6])) {?>
										<a href="<?php echo get_the_permalink($point_result[0][5])?>">
									<?php }
										if ($point_result[0][4] != "rating_question" && $point_result[0][4] != "rating_answer" && $point_result[0][4] != "user_unfollow" && $point_result[0][4] != "user_follow" && $point_result[0][4] != "bump_question" && $point_result[0][4] != "select_best_answer" && $point_result[0][4] != "cancel_best_answer" && $point_result[0][4] != "answer_question" && $point_result[0][4] != "add_question" && $point_result[0][4] != "question_point" && $point_result[0][4] != "gift_site" && $point_result[0][4] != "admin_add_points" && $point_result[0][4] != "admin_remove_points" && $point_result[0][4] != "point_back" && $point_result[0][4] != "point_removed") {
											echo $point_result[0][4];
										}else if ($point_result[0][4] == "rating_question") {
											_e("Rating your question","vbegy");
										}else if ($point_result[0][4] == "rating_answer") {
											_e("Rating your answer","vbegy");
										}else if ($point_result[0][4] == "user_unfollow") {
											_e("User unfollow You","vbegy");
										}else if ($point_result[0][4] == "user_follow") {
											_e("User follow You","vbegy");
										}else if ($point_result[0][4] == "bump_question") {
											_e("Discount points to bump question","vbegy");
										}else if ($point_result[0][4] == "select_best_answer") {
											_e("Choose your answer Best Answer","vbegy");
										}else if ($point_result[0][4] == "cancel_best_answer") {
											_e("Cancel your answer Best Answer","vbegy");
										}else if ($point_result[0][4] == "answer_question") {
											_e("You answer the question","vbegy");
										}else if ($point_result[0][4] == "add_question") {
											_e("Add a new question","vbegy");
										}else if ($point_result[0][4] == "gift_site") {
											_e("Gift of the site","vbegy");
										}else if ($point_result[0][4] == "question_point") {
											_e("You charged points for Add a question","vbegy");
										}else if ($point_result[0][4] == "admin_add_points") {
											_e("The administrator add points for you","vbegy");
										}else if ($point_result[0][4] == "admin_remove_points") {
											_e("The administrator remove points from you","vbegy");
										}else if ($point_result[0][4] == "point_back") {
											_e("Your point back because you choose the best answer","vbegy");
										}else if ($point_result[0][4] == "point_removed") {
											_e("Your point removed because you cancel the best answer","vbegy");
										}
									if ((!empty($point_result[0][5]) && !empty($point_result[0][6])) || !empty($point_result[0][5])) {?>
										</a>
									<?php }?>
									</h3>
									<div class="question-user-vote"><i class="icon-thumbs-up"></i></div>
									<div class="question-vote-result"><?php echo $point_result[0][3]?><?php echo $point_result[0][2]?></div>
									<span class="question-date"><i class="fa fa-calendar"></i><?php echo $point_result[0][0]."&nbsp;&nbsp;-&nbsp;&nbsp;".$point_result[0][1]?></span>
								</div>
							</div>
						</article>
					<?php }
				}else {echo "<p class='no-item'>".__("There are no points yet .","vbegy")."</p>";}?>
			</div>
		</div>
		<?php if (isset($point_one) &&is_array($point_one) && $pagination_args["total"] > 1) {?>
			<div class='pagination'><?php echo (paginate_links($pagination_args) != ""?paginate_links($pagination_args):"")?></div>
		<?php }
	}else {
		echo "<div class='page-content page-content-user'><p class='no-item'>".__("This page is not active .","vbegy")."</p></div>";
	}
get_footer();?>