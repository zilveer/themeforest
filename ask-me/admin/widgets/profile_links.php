<?php
/* Profile */
add_action( 'widgets_init', 'widget_profile_widget' );
function widget_profile_widget() {
	register_widget( 'Widget_Profile' );
}

class Widget_Profile extends WP_Widget {

	function Widget_Profile() {
		$widget_ops = array( 'classname' => 'profile-widget'  );
		$control_ops = array( 'id_base' => 'profile-widget' );
		parent::__construct( 'profile-widget','Ask me - profile', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title     = apply_filters('widget_title', $instance['title'] );
		if (is_user_logged_in()) {
			echo $before_widget;
				if ( $title )
					echo $before_title.esc_attr($title).$after_title;?>
				<div class="widget_profile">
					<?php $out = '';
					$user_login = get_userdata(get_current_user_id());
					$active_points = vpanel_options("active_points");
					$out .= '
						<ul class="user_quick_links">
							<li><a href="'.vpanel_get_user_url($user_login->ID).'"><i class="icon-home"></i>'.__("Profile page","vbegy").'</a></li>
							<li><a href="'.esc_url(add_query_arg("u", esc_attr($user_login->ID),get_page_link(vpanel_options('question_user_page')))).'"><i class="icon-question-sign"></i>'.__("Questions","vbegy").'</a></li>
							<li><a href="'.esc_url(add_query_arg("u", esc_attr($user_login->ID),get_page_link(vpanel_options('answer_user_page')))).'"><i class="fa fa-comments-o"></i>'.__("Answers","vbegy").'</a></li>
							<li><a href="'.esc_url(add_query_arg("u", esc_attr($user_login->ID),get_page_link(vpanel_options('favorite_user_page')))).'"><i class="icon-star"></i>'.__("Favorite Questions","vbegy").'</a></li>
							<li><a href="'.esc_url(add_query_arg("u", esc_attr($user_login->ID),get_page_link(vpanel_options('i_follow_user_page')))).'"><i class="icon-user-md"></i>'.__("Authors I Follow","vbegy").'</a></li>
							<li><a href="'.esc_url(add_query_arg("u", esc_attr($user_login->ID),get_page_link(vpanel_options('followers_user_page')))).'"><i class="icon-user"></i>'.__("Followers","vbegy").'</a></li>';
							if ($active_points == 1) {
								$out .= '<li><a href="'.esc_url(add_query_arg("u", esc_attr($user_login->ID),get_page_link(vpanel_options('point_user_page')))).'"><i class="icon-heart"></i>'.__("Points","vbegy").'</a></li>';
							}
							$out .= '<li><a href="'.esc_url(add_query_arg("u", esc_attr($user_login->ID),get_page_link(vpanel_options('follow_question_page')))).'"><i class="icon-question-sign"></i>'.__("Follow questions","vbegy").'</a></li>
							<li><a href="'.esc_url(add_query_arg("u", esc_attr($user_login->ID),get_page_link(vpanel_options('follow_answer_page')))).'"><i class="fa fa-comments-o"></i>'.__("Follow answers","vbegy").'</a></li>
							<li><a href="'.esc_url(add_query_arg("u", esc_attr($user_login->ID),get_page_link(vpanel_options('post_user_page')))).'"><i class="icon-file-alt"></i>'.__("Posts","vbegy").'</a></li>
							<li><a href="'.esc_url(add_query_arg("u", esc_attr($user_login->ID),get_page_link(vpanel_options('follow_post_page')))).'"><i class="icon-file-alt"></i>'.__("Follow posts","vbegy").'</a></li>
							<li><a href="'.esc_url(add_query_arg("u", esc_attr($user_login->ID),get_page_link(vpanel_options('follow_comment_page')))).'"><i class="fa fa-comments-o"></i>'.__("Follow comments","vbegy").'</a></li>
							<li><a href="'.get_page_link(vpanel_options('user_edit_profile_page')).'"><i class="icon-pencil"></i>'.__("Edit profile","vbegy").'</a></li>
							<li><a href="'.wp_logout_url(home_url()).'"><i class="icon-signout"></i>'.__("Logout","vbegy").'</a></li>
						</ul>';?>
				</div>
				<?php
				echo ($out);
			echo $after_widget;
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance		   = $old_instance;
		$instance['title']     = strip_tags( $new_instance['title'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => __('Profile','vbegy') );
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo (isset($instance['title'])?esc_attr($instance['title']):""); ?>" class="widefat" type="text">
		</p>
	<?php
	}
}
?>