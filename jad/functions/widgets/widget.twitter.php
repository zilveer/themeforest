<?php

class SG_Widget_Twitter extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_twitter', 'description' => __('Twitter Widget' , SG_TDN));
		parent::__construct('sg-twitter', __('SG - Twitter', SG_TDN), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __('Twitter Feed', SG_TDN) : __($instance['title']), $instance, $this->id_base );
		$username = empty( $instance['username'] ) ? '' : $instance['username'];
		$count = empty( $instance['count'] ) ? 3 : (int) $instance['count'];
		$interval = empty( $instance['interval'] ) ? 30 : (int) $instance['interval'];

		$mt = microtime(1);

		echo $before_widget;
		echo $before_title . $title . $after_title; ?>
			<div class="tweet1" rel="<?php echo $mt; ?>"></div>
<script type='text/javascript'>
/* <![CDATA[ */
jQuery('.tweet1[rel="<?php echo $mt; ?>"]').tweet({
		modpath: "<?php echo get_template_directory_uri(); ?>/includes/twitter/",
		count: <?php echo $count; ?>,
		avatar_size: 32,
		username: ["<?php echo $username; ?>"],
		loading_text: "<?php _e('Loading tweets...', SG_TDN); ?>",
		refresh_interval: <?php echo $interval; ?>
	}).bind("loaded", function() {
        jQuery(this).find("a").attr("target", "_blank");
    });
/* ]]> */
</script>
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['username'] = strip_tags($new_instance['username']);

		if ( in_array( $new_instance['count'], array( '1', '2', '3', '4', '5', '6' ) ) ) {
			$instance['count'] = $new_instance['count'];
		} else {
			$instance['count'] = '3';
		}

		if ( in_array( $new_instance['interval'], array( '10', '30', '60' ) ) ) {
			$instance['interval'] = $new_instance['interval'];
		} else {
			$instance['interval'] = '30';
		}

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'username' => '', 'count' => '3', 'interval' => '30' ) );
		$title = strip_tags($instance['title']);
		$username = strip_tags($instance['username']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', SG_TDN); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Username:', SG_TDN); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" type="text" value="<?php echo esc_attr($username); ?>" /></p>

		<p>
			<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Twitts Count:', SG_TDN); ?></label>
			<select name="<?php echo $this->get_field_name('count'); ?>" id="<?php echo $this->get_field_id('count'); ?>" class="widefat">
				<option value="1"<?php selected( $instance['count'], '1' ); ?>>1</option>
				<option value="2"<?php selected( $instance['count'], '2' ); ?>>2</option>
				<option value="3"<?php selected( $instance['count'], '3' ); ?>>3</option>
				<option value="4"<?php selected( $instance['count'], '4' ); ?>>4</option>
				<option value="5"<?php selected( $instance['count'], '5' ); ?>>5</option>
				<option value="6"<?php selected( $instance['count'], '6' ); ?>>6</option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('interval'); ?>"><?php _e('Refresh Interval:', SG_TDN); ?></label>
			<select name="<?php echo $this->get_field_name('interval'); ?>" id="<?php echo $this->get_field_id('interval'); ?>" class="widefat">
				<option value="10"<?php selected( $instance['interval'], '10' ); ?>>10</option>
				<option value="30"<?php selected( $instance['interval'], '30' ); ?>>30</option>
				<option value="60"<?php selected( $instance['interval'], '60' ); ?>>60</option>
			</select>
		</p>
<?php
	}
}