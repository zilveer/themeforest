<?php
/**
 * Add function to widgets_init that will load our widget.
 */
add_action( 'widgets_init', 'wpspace_twitter_load_widgets' );

/**
 * Register our widget.
 * 'Twitter_Widget' is the widget class used below.
 */
function wpspace_twitter_load_widgets() {
	register_widget( 'wpspace_twitter_widget' );
}

/**
 * Twitter Widget class.
 */
class wpspace_twitter_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function wpspace_twitter_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'wpspace_twitter', 'description' => 'Last Twitter Updates' );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 250, 'id_base' => 'wpspace-twitter-widget' );

		/* Create the widget. */
		parent::__construct( 'wpspace-twitter-widget', 'WP Space - Twitter timeline', $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', isset($instance['title']) ? $instance['title'] : '' );
		$twitter_username = isset($instance['twitter_username']) ? $instance['twitter_username'] : '';
		$twitter_widget_id = isset($instance['twitter_widget_id']) ? $instance['twitter_widget_id'] : '';
		$twitter_count = isset($instance['twitter_count']) ? $instance['twitter_count'] : '';	
		$twitter_code = isset($instance['twitter_code']) ? $instance['twitter_code'] : '';

		/* Before widget (defined by themes). */			
		echo $before_widget;		

		if ($title) echo $before_title . $title . $after_title;
?>			
		<div class="tweet widget_iframe_outer">
			<?php
			if ($twitter_code!='') {
				echo $twitter_code;
			} else {
			?>
				<a class="twitter-timeline" 
					href="https://twitter.com/<?php echo $twitter_username; ?>"
					data-widget-id="<?php echo $twitter_widget_id; ?>"
					data-link-color="#e50700"
					data-border-color="#ffffff"
					data-chrome="noavatars noheader nofooter noborders noscrollbar transparent"
					data-tweet-limit="<?php echo $twitter_count; ?>"
				>@<?php echo $twitter_username; ?></a>
				<script type="text/javascript">
					!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
				</script>
			<?php } ?>
			<script type="text/jscript">
				formatTwitter();
				function formatTwitter() {
					var theme_style = jQuery('body').hasClass('dark') ? 'dark' : 'light';
					var iframe_outer = jQuery('.widget.wpspace_twitter .widget_iframe_outer');
					var alink = iframe_outer.find('>a');
					if (alink.length > 0) {
						alink.attr( {
							<?php if ($twitter_widget_id!='') echo "'data-widget-id': '{$twitter_widget_id}',"; ?>
							'data-tweet-limit': '<?php echo $twitter_count > 0 ? $twitter_count : 4; ?>',
							'data-link-color': theme_style=='light' ? '#019875' : '#019875',
							'data-border-color': theme_style=='light' ? '#ffffff' : '#282828',
							'data-chrome': 'noavatars noheader nofooter noborders noscrollbar transparent'
						} );
						<?php if ($twitter_username!='') echo "alink.html('@{$twitter_username}');"; ?>
					}
					var iframe = iframe_outer.find('iframe');
					var twitter = iframe.length > 0 ? jQuery(iframe.get(0).contentDocument).find('div.stream') : [];
					if (twitter.length > 0) {
						twitter.find('.h-feed > li').each(function(idx) {
							var author = jQuery(this).find('.header .p-nickname').text();
							var author_link = jQuery(this).find('.header a.u-url').attr('href');
							var dt = jQuery(this).find('a[data-datetime]').attr('data-datetime');
							var diff = dateDifference(dt) + ' ago';
							jQuery(this)
								.css({
									'paddingLeft': 0,
									'paddingTop': 0,
									'paddingBottom': 0,
									'marginTop': (idx==0 ? '3px' : '24px'),
									'borderTop': 'none',
									})
								.find('a[data-datetime]').hide().end()
								.find('.header').hide().end()
								.find('.footer').hide().end()
								.find('.e-entry-title').css({
									'color': theme_style=='light' ? '#646464' : '#878787'
									}).prepend('<a href="' + author_link + '" target="_blank">' + author + '</a> ').end()
								.find('.e-entry-content').append('<p style="color:' + (theme_style=='light' ? '#b1b1b1' : '#646464') + '">' + diff + '</p> ').end()
								.find('a').css({'color': theme_style=='light' ? '#4ca5d0' : '#4ca5d0'}).end()
								.find('.inline-media img').css({'height':'auto'});
						});
						iframe_outer.show();
					} else {
						iframe_outer.hide();
						setTimeout("formatTwitter();", 200);
					}
				}
			</script>
		</div>
		
<?php
		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['twitter_username'] = strip_tags( $new_instance['twitter_username'] );
		$instance['twitter_widget_id'] = strip_tags( $new_instance['twitter_widget_id'] );
		$instance['twitter_count'] = strip_tags( $new_instance['twitter_count'] );
		$instance['twitter_code'] = $new_instance['twitter_code'];

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => '', 'description' => 'Last Twitter Updates' );
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		$title = isset($instance['title']) ? $instance['title'] : '';
		$twitter_username = isset($instance['twitter_username']) ? $instance['twitter_username'] : '';
		$twitter_widget_id = isset($instance['twitter_widget_id']) ? $instance['twitter_widget_id'] : '';
		$twitter_count = isset($instance['twitter_count']) ? $instance['twitter_count'] : '';
		$twitter_code = isset($instance['twitter_code']) ? $instance['twitter_code'] : '';
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo 'Title:'; ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $title; ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'twitter_count' ); ?>"><?php echo 'Tweets count:'; ?></label>
			<input id="<?php echo $this->get_field_id( 'twitter_count' ); ?>" name="<?php echo $this->get_field_name( 'twitter_count' ); ?>" value="<?php echo $twitter_count; ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'twitter_username' ); ?>"><?php echo 'Twitter Username:<br />(leave empty if you paste widget code)'; ?></label>
			<input id="<?php echo $this->get_field_id( 'twitter_username' ); ?>" name="<?php echo $this->get_field_name( 'twitter_username' ); ?>" value="<?php echo $twitter_username; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'twitter_widget_id' ); ?>"><?php echo 'Twitter Widget ID:<br />(leave empty if you paste widget code)'; ?></label>
			<input id="<?php echo $this->get_field_id( 'twitter_widget_id' ); ?>" name="<?php echo $this->get_field_name( 'twitter_widget_id' ); ?>" value="<?php echo $twitter_widget_id; ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'twitter_code' ); ?>"><?php echo 'or paste Twitter Widget Code:<br />(created in your profile on twitter.com)'; ?></label>
			<textarea id="<?php echo $this->get_field_id( 'twitter_code' ); ?>" name="<?php echo $this->get_field_name( 'twitter_code' ); ?>" rows="5" style="width:100%;"><?php echo htmlspecialchars($twitter_code); ?></textarea>
		</p>

	<?php
	}
}
?>