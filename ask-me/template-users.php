<?php /* Template Name: Users */
get_header();
	global $wpdb,$wp_roles;
	$all_role_name  = rwmb_meta('vbegy_user_group','type=checkbox_list',$post->ID);
	$user_order     = rwmb_meta('vbegy_user_order','select',$post->ID);
	$meta_key_array = array();
	$implode_array  = "";
	$capabilities   = $wpdb->get_blog_prefix($blog_id) . 'capabilities';
	$rows_per_page  = get_option("posts_per_page");
	$paged          = (get_query_var("paged") != ""?(int)get_query_var("paged"):(get_query_var("page") != ""?(int)get_query_var("page"):1));
	$offset         = ($paged -1) * $rows_per_page;
	
	if (!empty($all_role_name)) {
		foreach ($all_role_name as $role => $name) {
			$all_role_array[] = $name;
			$meta_key_array[] = "( $wpdb->usermeta.meta_key = '$capabilities'
			AND CAST($wpdb->usermeta.meta_value AS CHAR) RLIKE '$name' )";
		}
		$implode_array = "AND (".implode(" OR ",$meta_key_array).")";
	}
	
	$user_order = (isset($user_order) && $user_order != ""?$user_order:"user_registered");
	
	if ($user_order == "post_count" || $user_order == "question_count") {
		$query = $wpdb->prepare("SELECT DISTINCT SQL_CALC_FOUND_ROWS $wpdb->users.ID FROM $wpdb->users INNER JOIN $wpdb->usermeta ON ( $wpdb->users.ID = $wpdb->usermeta.user_id ) LEFT OUTER JOIN ( SELECT post_author, COUNT(*) as post_count  FROM wp_posts  WHERE ( ( post_type = '".($user_order == "question_count"?"question":"post")."' AND ( post_status = 'publish' OR post_status = 'private' ) ) ) GROUP BY post_author ) p ON ($wpdb->users.ID = p.post_author) WHERE %s=1 ".$implode_array,1);
		$users = $wpdb->get_results($query);
		
		$total_users = $wpdb->num_rows;
		$total_pages = ceil($total_users/$rows_per_page);
		
		$query = $wpdb->prepare("SELECT DISTINCT SQL_CALC_FOUND_ROWS $wpdb->users.* FROM $wpdb->users INNER JOIN $wpdb->usermeta ON ( $wpdb->users.ID = $wpdb->usermeta.user_id ) LEFT OUTER JOIN ( SELECT post_author, COUNT(*) as post_count  FROM wp_posts WHERE ( ( post_type = '".($user_order == "question_count"?"question":"post")."' AND ( post_status = 'publish' OR post_status = 'private' ) ) ) GROUP BY post_author ) p ON ($wpdb->users.ID = p.post_author) WHERE %s=1 ".$implode_array." ORDER BY post_count DESC limit $offset,$rows_per_page",1);
		$query = $wpdb->get_results($query);
	}else if ($user_order == "points") {
		function cmps($a, $b) {
			if ($a->meta_value == $b->meta_value) {
				return 0;
			}
			return ($a->meta_value > $b->meta_value) ? -1 : 1;
		}
	
		$query = $wpdb->prepare("SELECT DISTINCT SQL_CALC_FOUND_ROWS $wpdb->users.ID,$wpdb->usermeta.meta_key,$wpdb->usermeta.meta_value FROM $wpdb->users INNER JOIN $wpdb->usermeta ON ($wpdb->users.ID = $wpdb->usermeta.user_id) WHERE %s=1 AND ( ( $wpdb->usermeta.meta_key = 'points' AND CAST($wpdb->usermeta.meta_value AS CHAR) >= '1' ) )",1);
		$users = $wpdb->get_results($query);
		usort($users, 'cmps');
		
		foreach ($users as $key => $value) {
			$get_capabilities = get_user_meta($value->ID,$capabilities,true);
			if (empty($all_role_name) || (is_array($all_role_name) && is_array($get_capabilities) && in_array(key($get_capabilities),$all_role_name))) {
				$users_ids[] = $value->ID;
			}else {
				if (!empty($all_role_name)) {
					unset($users[$key]);
				}
			}
		}
	}else {
		$query = $wpdb->prepare("SELECT DISTINCT SQL_CALC_FOUND_ROWS $wpdb->users.ID FROM $wpdb->users INNER JOIN $wpdb->usermeta ON ($wpdb->users.ID = $wpdb->usermeta.user_id) WHERE %s=1 ".$implode_array,1);
		$users = $wpdb->get_results($query);
		
		$total_users = $wpdb->num_rows;
		$total_pages = ceil($total_users/$rows_per_page);
		
		$query = $wpdb->prepare("SELECT DISTINCT SQL_CALC_FOUND_ROWS $wpdb->users.* FROM $wpdb->users INNER JOIN $wpdb->usermeta ON ($wpdb->users.ID = $wpdb->usermeta.user_id) WHERE %s=1 ".$implode_array." ORDER BY ".$user_order." ASC limit $offset,$rows_per_page",1);
		$query = $wpdb->get_results($query);
	}
	
	if ($user_order == "points") {
		if ($query && isset($users_ids) && is_array($users_ids)) {
			$current = max(1,$paged);
			$pagination_args = array(
				'base' => @esc_url(add_query_arg('paged','%#%')),
				'format' => 'page/%#%/',
				'total' => ceil(sizeof($users_ids)/$rows_per_page),
				'current' => $current,
				'show_all' => false,
				'prev_text' => '<i class="icon-angle-left"></i>',
				'next_text' => '<i class="icon-angle-right"></i>',
			);
			
			if( !empty($wp_query->query_vars['s']) )
				$pagination_args['add_args'] = array('s'=>get_query_var('s'));
				
			$start = ($current - 1) * $rows_per_page;
			$end = $start + $rows_per_page;
			$end = (sizeof($users_ids) < $end) ? sizeof($users_ids) : $end;
			for ($i=$start;$i < $end ;++$i ) {
				$user = $users_ids[$i];
				$you_avatar = get_the_author_meta('you_avatar',$user);
				$country = get_the_author_meta('country',$user);
				$url = get_the_author_meta('url',$user);
				$twitter = get_the_author_meta('twitter',$user);
				$facebook = get_the_author_meta('facebook',$user);
				$google = get_the_author_meta('google',$user);
				$linkedin = get_the_author_meta('linkedin',$user);
				$follow_email = get_the_author_meta('follow_email',$user);
				$youtube = get_the_author_meta('youtube',$user);
				$pinterest = get_the_author_meta('pinterest',$user);
				$instagram = get_the_author_meta('instagram',$user);
				$the_author_meta_description = get_the_author_meta("description",$user);
				$the_author_display_name = get_the_author_meta("display_name",$user);
				$points_u = get_the_author_meta('points',$user);?>  
				<div class="about-author clearfix">
					<div class="author-image">
					<a href="<?php echo vpanel_get_user_url($user);?>" original-title="<?php echo $the_author_display_name?>" class="tooltip-n">
						<?php if ($you_avatar) {
							$you_avatar_img = get_aq_resize_url(esc_attr(get_the_author_meta('you_avatar', $user)),"full",65,65);
							echo "<img alt='".$the_author_display_name."' src='".$you_avatar_img."'>";
						}else {
							echo get_avatar($user,'65','');
						}?>
					</a>
					</div>
					<?php if ($user_order == "points") {?>
					<span class="comment"><?php echo ($points_u != ""?$points_u:"0")?> <?php _e("Points","vbegy")?></span><br>
					<?php }else if ($user_order == "question_count" || $user_order == "post_count") {
						if ($user_order == "question_count") {?>
							<span class="comment"><?php echo count_user_posts_by_type($user,"question")?> <?php _e("Questions","vbegy")?></span>
						<?php }else {?>
							<span class="comment"><?php echo count_user_posts_by_type($user,"post")?> <?php _e("Posts","vbegy")?></span>
						<?php }
					}?>
					<div class="author-bio">
						<h4><a href="<?php echo vpanel_get_user_url($user);?>"><?php echo $the_author_display_name?></a><?php echo vpanel_get_badge($user)?></h4>
						<?php echo $the_author_meta_description?>
						<div class="clearfix"></div>
						<br>
						<?php if ($facebook || $twitter || $linkedin || $google || $follow_email || $youtube || $pinterest || $instagram) { ?>
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
							if ($youtube) {?>
							<a href="<?php echo $youtube?>" original-title="<?php _e("Youtube","vbegy")?>" class="tooltip-n">
								<span class="icon_i">
									<span class="icon_square" icon_size="30" span_bg="#ef4e41" span_hover="#2f3239">
										<i class="social_icon-youtube"></i>
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
							<a href="<?php echo $follow_email?>" original-title="<?php _e("Email","vbegy")?>" class="tooltip-n">
								<span class="icon_i">
									<span class="icon_square" icon_size="30" span_bg="#000" span_hover="#2f3239">
										<i class="social_icon-email"></i>
									</span>
								</span>
							</a>
							<?php }
						}?>
					</div>
				</div>
			<?php }
		}
		
		if (isset($users_ids) &&is_array($users_ids) && $pagination_args["total"] > 1) {?>
			<div class='pagination'><?php echo (paginate_links($pagination_args) != ""?paginate_links($pagination_args):"")?></div>
		<?php }
		
	}else {
		$total_query = $wpdb->num_rows;
		if ($query) {
			foreach ($query as $user) {
				$you_avatar = get_the_author_meta('you_avatar',$user->ID);
				$country = get_the_author_meta('country',$user->ID);
				$url = get_the_author_meta('url',$user->ID);
				$twitter = get_the_author_meta('twitter',$user->ID);
				$facebook = get_the_author_meta('facebook',$user->ID);
				$google = get_the_author_meta('google',$user->ID);
				$linkedin = get_the_author_meta('linkedin',$user->ID);
				$follow_email = get_the_author_meta('follow_email',$user->ID);
				$youtube = get_the_author_meta('youtube',$user->ID);
				$pinterest = get_the_author_meta('pinterest',$user->ID);
				$instagram = get_the_author_meta('instagram',$user->ID);
				$the_author_meta_description = get_the_author_meta("description",$user->ID);
				$points_u = get_the_author_meta('points',$user->ID);?>  
				<div class="about-author clearfix">
					<div class="author-image">
					<a href="<?php echo vpanel_get_user_url($user->ID);?>" original-title="<?php echo $user->display_name?>" class="tooltip-n">
						<?php if ($you_avatar) {
							$you_avatar_img = get_aq_resize_url(esc_attr(get_the_author_meta('you_avatar', $user->ID)),"full",65,65);
							echo "<img alt='".$user->display_name."' src='".$you_avatar_img."'>";
						}else {
							echo get_avatar($user->ID,'65','');
						}?>
					</a>
					</div>
					<?php if ($user_order == "points") {?>
					<span class="comment"><?php echo ($points_u != ""?$points_u:"0")?> <?php _e("Points","vbegy")?></span><br>
					<?php }else if ($user_order == "question_count" || $user_order == "post_count") {
						if ($user_order == "question_count") {?>
							<span class="comment"><?php echo count_user_posts_by_type($user->ID,"question")?> <?php _e("Questions","vbegy")?></span>
						<?php }else {?>
							<span class="comment"><?php echo count_user_posts_by_type($user->ID,"post")?> <?php _e("Posts","vbegy")?></span>
						<?php }
					}?>
					<div class="author-bio">
						<h4><a href="<?php echo vpanel_get_user_url($user->ID);?>"><?php echo $user->display_name?></a><?php echo vpanel_get_badge($user->ID)?></h4>
						<?php echo $the_author_meta_description?>
						<div class="clearfix"></div>
						<br>
						<?php if ($facebook || $twitter || $linkedin || $google || $follow_email || $youtube || $pinterest || $instagram) { ?>
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
							if ($youtube) {?>
							<a href="<?php echo $youtube?>" original-title="<?php _e("Youtube","vbegy")?>" class="tooltip-n">
								<span class="icon_i">
									<span class="icon_square" icon_size="30" span_bg="#ef4e41" span_hover="#2f3239">
										<i class="social_icon-youtube"></i>
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
							<a href="<?php echo $follow_email?>" original-title="<?php _e("Email","vbegy")?>" class="tooltip-n">
								<span class="icon_i">
									<span class="icon_square" icon_size="30" span_bg="#000" span_hover="#2f3239">
										<i class="social_icon-email"></i>
									</span>
								</span>
							</a>
							<?php }
						}?>
					</div>
				</div>
			<?php }
		}
		
		if ($total_users > $total_query) {
			echo '<div class="pagination">';
			$current_page = max(1,$paged);
			echo paginate_links(array(
				'base' => esc_url(add_query_arg( 'paged', '%#%' )),
				'format' => '',
				'current' => $current_page,
				'total' => $total_pages,
				'prev_text' => '<i class="fa fa-angle-left"></i>',
				'next_text' => '<i class="fa fa-angle-right"></i>',
			));
			echo '</div><div class="clearfix"></div>';
		}
	}
get_footer();?>