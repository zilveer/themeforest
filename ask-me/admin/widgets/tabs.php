<?php
/* tabs */
add_action( 'widgets_init', 'widget_tabs_widget' );
function widget_tabs_widget() {
	register_widget( 'Widget_Tabs' );
}
class Widget_Tabs extends WP_Widget {

	function Widget_Tabs() {
		$widget_ops = array( 'classname' => 'tabs-widget'  );
		$control_ops = array( 'id_base' => 'tabs-widget' );
		parent::__construct( 'tabs-widget','Ask me - Tabs', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title			   = apply_filters('widget_title', $instance['title'] );
		$excerpts		   = esc_attr($instance['excerpts']);
		$posts_per_page_p  = esc_attr($instance['posts_per_page_p']);
		$posts_per_page_r  = esc_attr($instance['posts_per_page_r']);
		$comments_number   = esc_attr($instance['comments_number']);
		$display_popular   = esc_attr($instance['display_popular']);
		$display_recent    = esc_attr($instance['display_recent']);
		$display_comments  = esc_attr($instance['display_comments']);
		$post_or_question  = esc_attr($instance['post_or_question']);
		$excerpt_title	   = esc_attr($instance['excerpt_title']);
		
		if ($display_popular == "on" || $display_recent == "on" || $display_comments == "on") {
			echo $before_widget."<div class='widget_tabs tabs-warp'>";?>
				<ul class="tabs">
					<?php if ($display_popular == "on") {?>
					<li class="tab"><a href="#"><?php _e('Popular','vbegy')?></a></li>
					<?php }
					if ($display_recent == "on") {?>
					<li class="tab"><a href="#"><?php _e('Recent','vbegy')?></a></li>
					<?php }
					if ($display_comments == "on") {?>
					<li class="tab"><a href="#"><?php _e('Comments','vbegy')?></a></li>
					<?php }?>
				</ul>
				<?php
				if ($display_popular == "on") {
					echo "<div class='tab-inner-warp'><div class='tab-inner'>";
						Vpanel_Questions($posts_per_page_p,"popular","on",$excerpts,$post_or_question,$excerpt_title);
					echo "</div></div>";
				}
				if ($display_recent == "on") {
					echo "<div class='tab-inner-warp'><div class='tab-inner'>";
						Vpanel_Questions($posts_per_page_r,"recent","on",$excerpts,$post_or_question,$excerpt_title);
					echo "</div></div>";
				}
				if ($display_comments == "on") {
					echo "<div class='tab-inner-warp'><div class='tab-inner'>";
						Vpanel_comments($post_or_question,$comments_number,$excerpts);
					echo "</div></div>";
				}
				echo "</div>";
				
			echo $after_widget;
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance					  = $old_instance;
		$instance['title']			  = strip_tags( $new_instance['title'] );
		$instance['excerpts']		  = strip_tags( $new_instance['excerpts'] );
		$instance['posts_per_page_p'] = $new_instance['posts_per_page_p'];
		$instance['posts_per_page_r'] = $new_instance['posts_per_page_r'];
		$instance['comments_number']  = $new_instance['comments_number'];
		$instance['display_popular']  = $new_instance['display_popular'];
		$instance['display_recent']	  = $new_instance['display_recent'];
		$instance['display_comments'] = $new_instance['display_comments'];
		$instance['excerpt_title']	  = $new_instance['excerpt_title'];
		$instance['post_or_question'] = $new_instance['post_or_question'];
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => 'Tabs','posts_per_page_p' => '5','posts_per_page_r' => '5','comments_number' => '5','display_popular' => 'on','display_recent' => 'on','display_comments' => 'on','excerpts' => '20','excerpt_title' => '5' );
		$instance = wp_parse_args( (array) $instance, $defaults );
		
		$categories_obj = get_categories('hide_empty=0');
		$categories = array();
		foreach ($categories_obj as $pn_cat) {
			$categories[$pn_cat->cat_ID] = $pn_cat->cat_name;
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo (isset($instance['title'])?esc_attr($instance['title']):""); ?>" class="widefat" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'post_or_question' ); ?>">Post or question : </label>
			<select id="<?php echo $this->get_field_id( 'post_or_question' ); ?>" name="<?php echo $this->get_field_name( 'post_or_question' ); ?>">
				<option value="post" <?php if( isset($instance['post_or_question']) && $instance['post_or_question'] == 'post' ) echo "selected=\"selected\""; else echo ""; ?>>Post</option>
				<option value="question" <?php if( isset($instance['post_or_question']) && $instance['post_or_question'] == 'question' ) echo "selected=\"selected\""; else echo ""; ?>>Question</option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'posts_per_page_p' ); ?>">Number of popular to show : </label>
			<input id="<?php echo $this->get_field_id( 'posts_per_page_p' ); ?>" name="<?php echo $this->get_field_name( 'posts_per_page_p' ); ?>" value="<?php echo (isset($instance['posts_per_page_p'])?(int)$instance['posts_per_page_p']:""); ?>" size="3" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'posts_per_page_r' ); ?>">Number of recent to show : </label>
			<input id="<?php echo $this->get_field_id( 'posts_per_page_r' ); ?>" name="<?php echo $this->get_field_name( 'posts_per_page_r' ); ?>" value="<?php echo (isset($instance['posts_per_page_r'])?esc_attr($instance['posts_per_page_r']):""); ?>" size="3" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'comments_number' ); ?>">Number of comments to show : </label>
			<input id="<?php echo $this->get_field_id( 'comments_number' ); ?>" name="<?php echo $this->get_field_name( 'comments_number' ); ?>" value="<?php echo (isset($instance['comments_number'])?(int)$instance['comments_number']:""); ?>" size="3" type="text">
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo (isset($instance['display_popular']) && $instance['display_popular'] == "on"?' checked="checked"':"");?> id="<?php echo $this->get_field_id( 'display_popular' ); ?>" name="<?php echo $this->get_field_name( 'display_popular' ); ?>">
			<label for="<?php echo $this->get_field_id( 'display_popular' ); ?>">Display popular?</label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo (isset($instance['display_recent']) && $instance['display_recent'] == "on"?' checked="checked"':"");?> id="<?php echo $this->get_field_id( 'display_recent' ); ?>" name="<?php echo $this->get_field_name( 'display_recent' ); ?>">
			<label for="<?php echo $this->get_field_id( 'display_recent' ); ?>">Display recent?</label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo (isset($instance['display_comments']) && $instance['display_comments'] == "on"?' checked="checked"':"");?> id="<?php echo $this->get_field_id( 'display_comments' ); ?>" name="<?php echo $this->get_field_name( 'display_comments' ); ?>">
			<label for="<?php echo $this->get_field_id( 'display_comments' ); ?>">Display comments?</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'excerpt_title' ); ?>">The number of words excerpt title</label>
			<input id="<?php echo $this->get_field_id( 'excerpt_title' ); ?>" name="<?php echo $this->get_field_name( 'excerpt_title' ); ?>" value="<?php echo (isset($instance['excerpt_title'])?(int)$instance['excerpt_title']:""); ?>" size="3" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'excerpts' ); ?>">The number of words excerpt (If you want an empty type 0 this not work in comments => 0)</label>
			<input id="<?php echo $this->get_field_id( 'excerpts' ); ?>" name="<?php echo $this->get_field_name( 'excerpts' ); ?>" value="<?php echo (isset($instance['excerpts'])?(int)$instance['excerpts']:""); ?>" size="3" type="text">
		</p>
	<?php
	}
}
?>