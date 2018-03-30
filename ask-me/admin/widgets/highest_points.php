<?php
/* big pic */
add_action( 'widgets_init', 'widget_highest_points_widget' );
function widget_highest_points_widget() {
	register_widget( 'Widget_Highest_Points' );
}

function cmp($a, $b){  
	if ($a->points == $b->points) {
		return 0;  
	}  
	return ($a->points > $b->points) ? -1 : 1;  
} 

class Widget_Highest_Points extends WP_Widget {

	function Widget_Highest_Points() {
		$widget_ops = array( 'classname' => 'highest-points-widget'  );
		$control_ops = array( 'id_base' => 'highest-points-widget' );
		parent::__construct( 'highest-points-widget','Ask me - Highest Points', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title		   = apply_filters('widget_title', $instance['title'] );
		$user_per_page = (int)$instance['user_per_page'];
		
		$active_points = vpanel_options("active_points");
		if ($active_points == 1) {
			echo $before_widget;
				if ( $title )
					echo $before_title.esc_attr($title).$after_title;
				?>
				<div class="widget_highest_points">
					<ul>
						<?php $blogusers = get_users(array('fields' => 'all_with_meta','order' => 'DESC','meta_query' => array(array('key' => 'points','value' => 1,'compare' => '>=','type' => 'number'))));
						usort($blogusers, 'cmp');
						$i = 0;
						foreach ($blogusers as $user) {$i++;
							$points_u = get_user_meta($user->ID,"points",true);
							$user_profile_page = vpanel_get_user_url($user->ID);
							$you_avatar = get_user_meta($user->ID,'you_avatar',true);?>
							<li>
								<div class="author-img">
									<a href="<?php echo $user_profile_page?>">
										<?php
										if ($you_avatar) {
											$you_avatar_img = get_aq_resize_url(esc_attr($you_avatar),"full",65,65);
											echo "<img alt='".$user->display_name."' src='".$you_avatar_img."'>";
										}else {
											echo get_avatar($user->ID,'65','');
										}?>
									</a>
								</div>
								<div class="author-content">
									<h6><a href="<?php echo $user_profile_page?>"><?php echo $user->display_name?></a></h6>
									<?php echo vpanel_get_badge($user->ID)?>
									<span class="comment"><?php echo ($points_u != ""?$points_u:"0")?> <?php _e("Points","vbegy")?></span>
								</div>
								<div class="clearfix"></div>
							</li>
						<?php if ($i == $user_per_page) {break;}
						} ?>
					</ul>
				</div>
				<?php
			echo $after_widget;
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance				   = $old_instance;
		$instance['title']		   = strip_tags( $new_instance['title'] );
		$instance['user_per_page'] = $new_instance['user_per_page'];
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => 'Highest points','user_per_page' => '5' );
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo (isset($instance['title'])?esc_attr($instance['title']):""); ?>" class="widefat" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'user_per_page' ); ?>">Number of users to show : </label>
			<input id="<?php echo $this->get_field_id( 'user_per_page' ); ?>" name="<?php echo $this->get_field_name( 'user_per_page' ); ?>" value="<?php echo (isset($instance['user_per_page'])?(int)$instance['user_per_page']:""); ?>" size="3" type="text">
		</p>
	<?php
	}
}
?>