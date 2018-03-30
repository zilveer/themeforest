<?php

class Artbees_Widget_Instagram_Feeds extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'widget_instagram', 'description' => 'Displays photos from Instagram' );
		WP_Widget::__construct( 'instagram', THEME_SLUG.' - '.'Instagram', $widget_ops );

	}



	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$instagram_id = $instance['instagram_id'];
		$accessToken = $instance['accessToken'];
		$sort_by = $instance['sort_by'];
		$size = $instance['size'];
		$accessToken = $instance['accessToken'];
		$count = (int)$instance['count'];
		$column = $instance['column'];
		$display = empty( $instance['display'] ) ? 'latest' : $instance['display'];
		$newtab = !empty( $instance['newtab'] ) ? $instance['newtab'] : false;

		if( $count < 1 ) {
			$count = 1;
		}

		$target = ( $newtab ) ? 'blank' : 'self';

		wp_enqueue_script( 'instafeed' );

		if ( !empty( $instagram_id ) ) {
			echo $before_widget;
			if ( $title )
				echo $before_title . $title . $after_title;

			$id = mt_rand( 99, 999 );

			if(!is_numeric($instagram_id)) {
				echo '<p style="color:red">' . __('Your UserId must be digits, review your widget options and resolve the issues!', 'mk_framework') . '</p>';
				return false;
			}
?>
		<div id="instagram-feeds-<?php echo $id; ?>" class="mk-instagram-feeds clearfix" data-options='{
            "get": "user",
            "target": "instagram-feeds-<?php echo $id; ?>",   
            "resolution": "<?php echo $size; ?>",
            "sortBy": "<?php echo $sort_by; ?>",
            "limit": <?php echo $count; ?>,
            "userId": <?php echo $instagram_id; ?>,
            "accessToken": "<?php echo $accessToken; ?>",
            "tmp_col": "<?php echo $column; ?>",
            "tmp_target": "<?php echo $target; ?>"
        }'></div>
		<div class="clearboth"></div>

		<?php
			echo $after_widget;
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['instagram_id'] = strip_tags( $new_instance['instagram_id'] );
		$instance['count'] = (int) $new_instance['count'];
		$instance['column'] = $new_instance['column'];
		$instance['accessToken'] = $new_instance['accessToken'];
		$instance['size'] = $new_instance['size'];
		$instance['sort_by'] = $new_instance['sort_by'];
		$instance['display'] = strip_tags( $new_instance['display'] );
		$instance['newtab'] = !empty( $new_instance['newtab']) ? true : false;

		return $instance;
	}

	

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$instagram_id = isset( $instance['instagram_id'] ) ? esc_attr( $instance['instagram_id'] ) : '';
		$size = isset( $instance['size'] ) ? esc_attr( $instance['size'] ) : 'thumbnail';
		$sort_by = isset( $instance['sort_by'] ) ? esc_attr( $instance['sort_by'] ) : 'most-recent';
		$accessToken = isset( $instance['accessToken'] ) ? esc_attr( $instance['accessToken'] ) : '';
		$count = isset( $instance['count'] ) ? absint( $instance['count'] ) : 3;
		$column = isset( $instance['column'] ) ? $instance['column'] : 'two';
		$newtab = isset( $instance['newtab'] ) ? (bool)$instance['newtab']  : false;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title :</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'instagram_id' ); ?>">Instagram UserId</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'instagram_id' ); ?>" name="<?php echo $this->get_field_name( 'instagram_id' ); ?>" type="text" value="<?php echo $instagram_id; ?>" />
		<em>UserId is not your instagram username! Don't know your user id? <a target="_blank" href="https://instagram.com/oauth/authorize/?client_id=12087cfb5d6b4a639e77bb8438c8e47c&redirect_uri=https://www.artbees.net/instagram-api/&response_type=token">Click here</a> to get your userId.</em>
		</p>

		<p><label for="<?php echo $this->get_field_id( 'accessToken' ); ?>">Access Token</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'accessToken' ); ?>" name="<?php echo $this->get_field_name( 'accessToken' ); ?>" type="text" value="<?php echo $accessToken; ?>" />
		<em>Don't know your token? <a target="_blank" href="https://instagram.com/oauth/authorize/?client_id=12087cfb5d6b4a639e77bb8438c8e47c&redirect_uri=https://www.artbees.net/instagram-api/&response_type=token">Click here</a> to get one.</em>
		</p>


		<p><label for="<?php echo $this->get_field_id( 'count' ); ?>">Number of photos to show :</label>
		<input id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" type="text" value="<?php echo $count; ?>" size="3" /></p>


		<p><label for="<?php echo $this->get_field_id( 'sort_by' ); ?>">Sort by:</label>
		<select id="<?php echo $this->get_field_id( 'sort_by' ); ?>" name="<?php echo $this->get_field_name( 'sort_by' ); ?>" class="widefat">
			<option<?php if ( $sort_by == 'most-recent' ) echo ' selected="selected"'?> value="most-recent">Most Recent</option>
			<option<?php if ( $sort_by == 'least-recent' ) echo ' selected="selected"'?> value="least-recent">Least Recent</option>
			<option<?php if ( $sort_by == 'most-liked' ) echo ' selected="selected"'?> value="most-liked">Most Liked</option>
			<option<?php if ( $sort_by == 'least-liked' ) echo ' selected="selected"'?> value="least-liked">Least Liked</option>
			<option<?php if ( $sort_by == 'most-commented' ) echo ' selected="selected"'?> value="most-commented">Most Commented</option>
			<option<?php if ( $sort_by == 'least-commented' ) echo ' selected="selected"'?> value="least-commented">Least-commented</option>
			<option<?php if ( $sort_by == 'random' ) echo ' selected="selected"'?> value="random">Random</option>
		</select>
		</p>

		<p><label for="<?php echo $this->get_field_id( 'size' ); ?>">Image Size:</label>
		<select id="<?php echo $this->get_field_id( 'size' ); ?>" name="<?php echo $this->get_field_name( 'size' ); ?>" class="widefat">
			<option<?php if ( $size == 'thumbnail' ) echo ' selected="selected"'?> value="thumbnail">Thumbnail (150X150)</option>
			<option<?php if ( $size == 'low_resolution' ) echo ' selected="selected"'?> value="low_resolution">Low Resolution (306X306)</option>
			<option<?php if ( $size == 'standard_resolution' ) echo ' selected="selected"'?> value="standard_resolution">Standard Resolution (612X612)</option>
		</select>
		</p>

		<p><label for="<?php echo $this->get_field_id( 'column' ); ?>">How many Images in One Row:</label>
		<select id="<?php echo $this->get_field_id( 'column' ); ?>" name="<?php echo $this->get_field_name( 'column' ); ?>" class="widefat">
			<option<?php if ( $column == 'one' ) echo ' selected="selected"'?> value="one">1</option>
			<option<?php if ( $column == 'two' ) echo ' selected="selected"'?> value="two">2</option>
			<option<?php if ( $column == 'three' ) echo ' selected="selected"'?> value="three">3</option>
			<option<?php if ( $column == 'four' ) echo ' selected="selected"'?> value="four">4</option>
			<option<?php if ( $column == 'five' ) echo ' selected="selected"'?> value="five">5</option>
			
		</select>
		</p>
		
		<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'newtab' ); ?>" name="<?php echo $this->get_field_name( 'newtab' ); ?>"<?php checked( $newtab ); ?> />
		<label for="<?php echo $this->get_field_id( 'newtab' ); ?>"><?php _e( 'Open links in new tab?', 'mk_framework' ); ?></label></p>

<?php
	}
}

register_widget("Artbees_Widget_Instagram_Feeds");