<?php
/* counter */
add_action( 'widgets_init', 'widget_counter_widget' );
function widget_counter_widget() {
	register_widget( 'Widget_Counter' );
}
class Widget_Counter extends WP_Widget {

	function Widget_Counter() {
		$widget_ops = array( 'classname' => 'counter-widget'  );
		$control_ops = array( 'id_base' => 'counter-widget' );
		parent::__construct( 'counter-widget','Ask me - social counter', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title					  = apply_filters('widget_title', $instance['title'] );
		$rss					  = esc_attr($instance['rss']);
		$facebook				  = esc_attr($instance['facebook']);
		$twitter				  = esc_attr($instance['twitter']);
		$gplus					  = esc_attr($instance['gplus']);
		$youtube				  = esc_attr($instance['youtube']);
		$social_count_twitter	  = formatMoney((int)get_twitter_count( $twitter ));
		$social_count_facebook	  = formatMoney((int)vpanel_counter_facebook( $facebook ));
		$social_count_gplus 	  = formatMoney((int)vpanel_counter_googleplus( $gplus ));
		$social_count_youtube 	  = formatMoney((int)vpanel_counter_youtube( $youtube ));

		echo $before_widget;
			if ( $title )
				echo $before_title.esc_attr($title).$after_title;?>
	
			<ul class="widget_social">
				<?php if ($rss == "on") {?>
				<li class="rss-subscribers">
					<a href="<?php bloginfo('rss2_url');?>" target="_blank">
					<strong>
						<i class="icon-rss"></i>
						<span><?php _e('Subscribe','vbegy')?></span><br>
						<small><?php _e('To RSS Feed','vbegy')?></small>
					</strong>
					</a>
				</li>
				<?php }
				if ($facebook != "") {?>
				<li class="facebook-fans">
					<a href="<?php echo vpanel_counter_facebook($facebook, 'link')?>" target="_blank">
					<strong>
						<i class="social_icon-facebook"></i>
						<span><?php echo $social_count_facebook;?></span><br>
						<small><?php _e('People like it','vbegy')?></small>
					</strong>
					</a>
				</li>
				<?php }
				if ($gplus != "") {?>
				<li class="gplus-subs">
					<a href="<?php echo vpanel_counter_googleplus($gplus, 'link');?>" target="_blank">
					<strong>
						<i class="icon-google-plus"></i>
						<span><?php echo $social_count_gplus;?></span><br>
						<small><?php _e('Followers','vbegy')?></small>
					</strong>
					</a>
				</li>
				<?php }
				if ($twitter != "") {?>
				<li class="twitter-followers">
					<a href="http://twitter.com/<?php echo $twitter;?>" target="_blank">
					<strong>
						<i class="social_icon-twitter"></i>
						<span><?php echo $social_count_twitter;?></span><br>
						<small><?php _e('Followers','vbegy')?></small>
					</strong>
					</a>
				</li>
				<?php }
				if ($youtube != "") {?>
				<li class="youtube-subs">
					<a href="<?php echo "http://www.youtube.com/channel/".$youtube?>" target="_blank">
					<strong>
						<i class="icon-play"></i>
						<span><?php echo $social_count_youtube?></span><br>
						<small><?php _e('Subscribers','vbegy')?></small>
					</strong>
					</a>
				</li>
				<?php }?>
			</ul>
		<?php echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance			         = $old_instance;
		$instance['title']	         = strip_tags( $new_instance['title'] );
		$instance['rss']	         = $new_instance['rss'];
		$instance['twitter']         = $new_instance['twitter'];
		$instance['facebook']        = $new_instance['facebook'];
		$instance['gplus']	         = $new_instance['gplus'];
		$instance['youtube']         = $new_instance['youtube'];
		
		delete_transient('vpanel_facebook_followers');
		delete_transient('vpanel_facebook_page_url');
		delete_transient('vpanel_twitter_followers');
		delete_transient('vpanel_googleplus_followers');
		delete_transient('vpanel_googleplus_page_url');
		delete_transient('vpanel_youtube_followers');
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => 'SOCIAL COUNTER','rss' => 'on','facebook' => '2code.info','twitter' => 'envato','gplus' => '+envato','youtube' => 'UCht9cayN2rRaXk5VgMJtAsA');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo (isset($instance['title'])?$instance['title']:"");?>" class="widefat" type="text">
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo (isset($instance['rss']) && $instance['rss'] == "on"?' checked="checked"':"");?> id="<?php echo $this->get_field_id( 'rss' ); ?>" name="<?php echo $this->get_field_name( 'rss' ); ?>">
			<label for="<?php echo $this->get_field_id( 'rss' ); ?>">Display rss?</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'facebook' ); ?>">Facebook Page ID/Name : </label>
			<input id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo (isset($instance['facebook'])?esc_attr($instance['facebook']):"");?>" class="widefat" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'twitter' ); ?>">Twitter : </label>
			<input id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php echo (isset($instance['twitter'])?esc_attr($instance['twitter']):"");?>" class="widefat" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'gplus' ); ?>">Google plus Page ID/Name : </label>
			<input id="<?php echo $this->get_field_id( 'gplus' ); ?>" name="<?php echo $this->get_field_name( 'gplus' ); ?>" value="<?php echo (isset($instance['gplus'])?esc_attr($instance['gplus']):"");?>" class="widefat" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'youtube' ); ?>">Channel id : </label>
			<input id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" value="<?php echo (isset($instance['youtube'])?esc_attr($instance['youtube']):"");?>" class="widefat" type="text">
		</p>
	<?php
	}
}
?>