<?php /* Template Name: Badges & Points */
get_header();
	if ( have_posts() ) : while ( have_posts() ) : the_post();
		$badges = get_option("badges");
		if (isset($badges) && is_array($badges)) {?>
			<div class="page-content page-content-user-profile">
				<div class="user-profile-widget">
					<div class="boxedtitle page-title"><h2><?php _e("Badges","vbegy")?></h2></div>
					<div class="ul_list ul_list-icon-ok">
						<ul>
							<?php foreach ($badges as $badges_k => $badges_v) {?>
								<li style="background-color: <?php echo esc_html($badges_v["badge_color"])?>;color: #FFF;"><?php echo esc_html($badges_v["badge_name"])?><span> ( <span><?php echo esc_html($badges_v["badge_points"])?></span> ) <?php _e("Points","vbegy")?></span></li>
							<?php }?>
						</ul>
					</div>
				</div><!-- End user-profile-widget -->
			</div><!-- End page-content -->
		<?php }
		$active_points = vpanel_options("active_points");
		if ($active_points == 1) {?>
			<div class="page-content page-content-user-profile">
				<div class="user-profile-widget">
					<div class="boxedtitle page-title"><h2><?php _e("Points","vbegy")?></h2></div>
					<div class="ul_list ul_list-icon-ok">
						<ul>
							<li><?php _e("Add a new question","vbegy")?><span> ( <span><?php echo (vpanel_options("point_add_question"))?></span> ) </span></li>
							<li><?php _e("Points choose best answer","vbegy")?><span> ( <span><?php echo (vpanel_options("point_best_answer"))?></span> ) </span></li>
							<li><?php _e("Points Rating question","vbegy")?><span> ( <span><?php echo (vpanel_options("point_rating_question"))?></span> ) </span></li>
							<li><?php _e("Points add comment","vbegy")?><span> ( <span><?php echo (vpanel_options("point_add_comment"))?></span> ) </span></li>
							<li><?php _e("Points Rating answer","vbegy")?><span> ( <span><?php echo (vpanel_options("point_rating_answer"))?></span> ) </span></li>
							<li><?php _e("Points following user","vbegy")?><span> ( <span><?php echo (vpanel_options("point_following_me"))?></span> ) </span></li>
							<li><?php _e("Points for a new user","vbegy")?><span> ( <span><?php echo (vpanel_options("point_new_user"))?></span> ) </span></li>
						</ul>
					</div>
				</div><!-- End user-profile-widget -->
			</div><!-- End page-content -->
		<?php }
	endwhile; endif;
get_footer();?>