<?php
class mTheme_Twitter extends WP_Widget {
	function mTheme_Twitter() {
		$widget_ops = array('classname' => 'widget_mtheme_twitter', 'description' => 'Displays Twitter feeds' );
		$this->WP_Widget('mtheme_twitter', MTHEME_NAME . '- Twitter', $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		
		echo $before_widget;
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		global $mtheme_twitter_username,$mtheme_twitter_feed_qty,$mtheme_avatar_status,$stamp;
		//$mtheme_twitter_username="mondrey";
		//$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
				
		if ( $instance['twitter_username']<>"" ) { $mtheme_twitter_username = $instance['twitter_username']; }
		if ( $instance['feed_qty']<>"" ) { $mtheme_twitter_feed_qty = $instance['feed_qty']; }
		if ( $instance['avatar_status']<>"" ) { $mtheme_avatar_status = $instance['avatar_status']; }
		
		$mtheme_twitter_data['username']=$mtheme_twitter_username;
		$mtheme_twitter_data['feeds']=$mtheme_twitter_feed_qty;
		$mtheme_twitter_data['avatar']=$mtheme_avatar_status;
		
		//if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		$stamp = uniqid('unique');
		?>

<script type='text/javascript'>
jQuery(document).ready(function(){
	jQuery(".tweet-catch-<?php echo $stamp; ?>").tweet({
		username: "<?php echo $mtheme_twitter_username; ?>",
		<?php if ($mtheme_avatar_status=="on") { echo 'avatar_size: 32,'; } ?>
		count: <?php echo $mtheme_twitter_feed_qty; ?>,
		loading_text: "loading tweets..."
	});
});
</script>

		<?php		
		if ($title<>"") {
			echo '<h3>' . $title . '</h3>';
		}
		?>
		<div class="mtheme-tweets tweet-catch-<?php echo $stamp; ?>"></div> 
		<?php
		
		?>
		<?php
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		//$instance = $old_instance;
		//$instance['title'] = strip_tags($new_instance['title']);
		//$instance['clickaction'] = strip_tags($new_instance['clickaction']);
		return $new_instance;

		//return $instance;
	}

	function form($instance) {
	
		$instance = wp_parse_args( (array) $instance, array( 'title' => 'Twitter Feeds' ) );
		$title = strip_tags($instance['title']);
		$avatar_status="";
		$feed_qty="";
		
		if (isset($instance['twitter_username'])) { $twitter_username=esc_attr($instance['twitter_username']); }
		if (isset($instance['feed_qty'])) { $feed_qty=esc_attr($instance['feed_qty']); }
		if (isset($instance['avatar_status'])) { $avatar_status=esc_attr($instance['avatar_status']); }

	?>
	
	<?php// logo and Link Field ?>

		<p>

	<label for="<?php echo $this->get_field_id('title'); ?>"><small><?php _e('Title:','mthemelocal'); ?></small></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		
		<label for="<?php echo $this->get_field_id( 'twitter_username' ); ?>"><small><?php _e('Username','mthemelocal'); ?></small></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'twitter_username' ); ?>" name="<?php echo $this->get_field_name( 'twitter_username' ); ?>" type="text" value="<?php if ( isset($instance['twitter_username']) ) { echo esc_attr($instance['twitter_username']); } ?>" />
		
		<label for="<?php echo $this->get_field_id('avatar_status'); ?>">
			<small><?php _e('Avatar Status:','mthemelocal'); ?></small>
		</label>
		<select id="<?php echo $this->get_field_id('avatar_status'); ?>" class="widefat" name="<?php echo $this->get_field_name('avatar_status'); ?>">
			<option value="on"<?php echo ($avatar_status === 'on' ? ' selected="selected"' : ''); ?>>On</option>
			<option value="off"<?php echo ($avatar_status === 'off' ? ' selected="selected"' : ''); ?>>off</option>
		</select>
		
		<label for="<?php echo $this->get_field_id('feed_qty'); ?>">
			<small><?php _e('No. of Feeds:','mthemelocal'); ?></small>
		</label>
		<select id="<?php echo $this->get_field_id('feed_qty'); ?>" class="widefat" name="<?php echo $this->get_field_name('feed_qty'); ?>">
			<option value="1"<?php echo ($feed_qty === '1' ? ' selected="selected"' : ''); ?>>1</option>
			<option value="2"<?php echo ($feed_qty === '2' ? ' selected="selected"' : ''); ?>>2</option>
			<option value="3"<?php echo ($feed_qty === '3' ? ' selected="selected"' : ''); ?>>3</option>
			<option value="4"<?php echo ($feed_qty === '4' ? ' selected="selected"' : ''); ?>>4</option>
			<option value="5"<?php echo ($feed_qty === '5' ? ' selected="selected"' : ''); ?>>5</option>
			<option value="6"<?php echo ($feed_qty === '6' ? ' selected="selected"' : ''); ?>>6</option>
			<option value="7"<?php echo ($feed_qty === '7' ? ' selected="selected"' : ''); ?>>7</option>
			<option value="8"<?php echo ($feed_qty === '8' ? ' selected="selected"' : ''); ?>>8</option>
			<option value="9"<?php echo ($feed_qty === '9' ? ' selected="selected"' : ''); ?>>9</option>
			<option value="10"<?php echo ($feed_qty === '10' ? ' selected="selected"' : ''); ?>>10</option>
		</select>
		
		</p>
<?php
	}
}
register_widget('mTheme_Twitter');
?>