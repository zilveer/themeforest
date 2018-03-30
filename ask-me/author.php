<?php get_header();
	global $vbegy_sidebar_all;
	include (get_template_directory() . '/includes/author-head.php');
	$owner = false;
	if($user_ID == $user_login->ID){
		$owner = true;
	}?>
	<div class="page-content">
		<div class="user-stats">
			<div class="user-stats-head">
				<div class="block-stats-1 stats-head"><?php _e("#","vbegy")?></div>
				<div class="block-stats-2 stats-head"><?php _e("Today","vbegy")?></div>
				<div class="block-stats-3 stats-head"><?php _e("Month","vbegy")?></div>
				<div class="block-stats-4 stats-head"><?php _e("Total","vbegy")?></div>
			</div>
			<div class="user-stats-item">
				<div class="block-stats-1"><?php _e("Questions","vbegy")?></div>
				<div class="block-stats-2"><?php echo ($add_questions_d == ""?0:$add_questions_d)?></div>
				<div class="block-stats-3"><?php echo ($add_questions_m == ""?0:$add_questions_m)?></div>
				<div class="block-stats-4"><?php echo ($add_questions == ""?0:$add_questions)?></div>
			</div>
			<div class="user-stats-item">
				<div class="block-stats-1"><?php _e("Answers","vbegy")?></div>
				<div class="block-stats-2"><?php echo ($add_answer_d == ""?0:$add_answer_d)?></div>
				<div class="block-stats-3"><?php echo ($add_answer_m == ""?0:$add_answer_m)?></div>
				<div class="block-stats-4"><?php echo ($add_answer == ""?0:$add_answer)?></div>
			</div>
			<div class="user-stats-item user-stats-item-last">
				<div class="block-stats-1"><?php _e("Visitors","vbegy")?></div>
				<div class="block-stats-2"><?php echo ($visit_profile_d == ""?0:$visit_profile_d)?></div>
				<div class="block-stats-3"><?php echo ($visit_profile_m == ""?0:$visit_profile_m)?></div>
				<div class="block-stats-4"><?php echo ($visit_profile == ""?0:$visit_profile)?></div>
			</div>
		</div><!-- End user-stats -->
	</div><!-- End page-content -->
<?php get_footer();?>