<?php
/**
* Posts Widget
*
* @author : VanThemes ( http://www.vanthemes.com )
* 
*/

add_action( 'widgets_init', 'van_posts_widget_init' );
function van_posts_widget_init() {
	register_widget( 'van_posts_widget' );
}

class van_posts_widget extends WP_Widget {

	function van_posts_widget() {
		$option = array( 'classname' => 'post-widget','description' => 'Posts Widget ( Recent, Popular, Random, Must Voted... )'  );
		$control = array( 'width' => 250, 'height' => 350, 'id_base' => 'post-widget' );
		$this->WP_Widget( 'post-widget','( '.THEME_NAME .' ) - Posts widget', $option, $control );
	}

	function widget( $args, $instance ) {

		extract( $args );
		$title       = apply_filters('widget_title', $instance['title'] );
		$number   = $instance['number'];
		$orderby  = $instance['orderby'];
		$layout     = $instance['layout'];
		$thumb     = ( $instance['thumb'] ) ? true : false;
		$meta_key= "";

		if ( $orderby == "views" ) {
			$meta_key = "van_post_view_count";
			$orderby   = "meta_value_num";
		}elseif ( $orderby == "likes" ) {
			$meta_key = "van_votes_count";
			$orderby   = "meta_value_num";
		}

		echo $before_widget;

			if ( $layout == "box" ) {
				echo "<div class=\"skip-content box-posts-widget\">";
			}
			echo $before_title . $title . $after_title;

			van_posts_query( $number , $thumb, $orderby, $meta_key, $layout );

			if ( $layout == "box" ) {
				echo "</div><!--.skip-content-->";
			}
	
		echo $after_widget; 
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title']     = strip_tags( $new_instance['title'] );
		$instance['number'] = strip_tags( $new_instance['number'] );
		$instance['orderby']= strip_tags( $new_instance['orderby'] );
		$instance['layout']   = strip_tags( $new_instance['layout'] );
		$instance['thumb']   = strip_tags( $new_instance['thumb'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' =>__('Recent Posts' , 'van') , 'number' => '3' ,'thumb' => 'true', 'orderby' => 'date', 'layout' => 'list' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e("Title : ","van"); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>"  />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'orderby' ); ?>">Order by: </label>
			<select name="<?php echo $this->get_field_name( 'orderby' ); ?>" id="<?php echo $this->get_field_id( 'orderby' ); ?>">
				<option value="date" <?php if( $instance['orderby'] == "date") {echo 'selected="selected"'; }?>>Recent</option>
				<option value="rand" <?php if( $instance['orderby'] == "rand") {echo 'selected="selected"'; }?>>Random</option>
				<option value="comment_count" <?php if( $instance['orderby'] == "comment_count" ) {echo 'selected="selected"'; }?>>Popular by comments</option>
				<option value="views" <?php if( $instance['orderby'] == "views" ) {echo 'selected="selected"'; }?>>Popular by views</option>
				<option value="likes"  <?php if( $instance['orderby'] == "likes" ) {echo 'selected="selected"'; }?>>Popular by likes</option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'layout' ); ?>">Posts Layout: </label>
			<select name="<?php echo $this->get_field_name( 'layout' ); ?>" id="<?php echo $this->get_field_id( 'layout' ); ?>">
				<option value="list" <?php if( $instance['layout'] == "list") {echo 'selected="selected"'; }?>>List</option>
				<option value="box" <?php if( $instance['layout'] == "box") {echo 'selected="selected"'; }?>>Box</option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>">Number of posts : </label>
			<input type="text" width="35px;" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo esc_attr( $instance['number'] ); ?>"  />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'thumb' ); ?>">Display posts Thumbinals : </label>
			<input id="<?php echo $this->get_field_id( 'thumb' ); ?>" name="<?php echo $this->get_field_name( 'thumb' ); ?>" value="true" <?php if( $instance['thumb'] ) {echo 'checked="checked"'; }?> type="checkbox" />
		</p>

	<?php
	}
}