<?php

/* ---------------------------------------------------------------------- */
/*	Widget Areas
/* ---------------------------------------------------------------------- */

function ss_framework_widgets_init() {

	// Blog Widget Area
	register_sidebar(array(
		'name'          => __('Blog Widget Area', 'ss_framework'),
		'id'            => 'blog-widget-area',
		'description'   => __('Only for blog pages and posts.', 'ss_framework'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	));

	// General Widget Area
	register_sidebar(array(
		'name'          => __('General Widget Area', 'ss_framework'),
		'id'            => 'general-widget-area',
		'description'   => __('For all pages and posts.', 'ss_framework'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	));

	// Left Footer Widget Area
	register_sidebar(array(
		'name'          => __('Left Footer Widget Area', 'ss_framework'),
		'id'            => 'left-footer-widget-area',
		'description'   => __('Left side of footer.', 'ss_framework'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<span class="widget-title">',
		'after_title'   => '</span>',
	));
	
	// Right Footer Widget Area
	register_sidebar(array(
		'name'          => __('Right Footer Widget Area', 'ss_framework'),
		'id'            => 'right-footer-widget-area',
		'description'   => __('Right side of footer', 'ss_framework'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<span class="widget-title">',
		'after_title'   => '</span>',
	));

}
add_action('widgets_init', 'ss_framework_widgets_init');

/* ---------------------------------------------------------------------- */
/*	Custom Widgets
/* ---------------------------------------------------------------------- */

/* ---------------------------------------------------- */
/*	Twitter Feed
/* ---------------------------------------------------- */

class SS_Twitter_Feed_Widget extends WP_Widget {

	function SS_Twitter_Feed_Widget() {
		$widget_ops = array( 'classname' => 'ss-twitter-feed', 'description' => __('Display the most recent tweets.', 'ss_framework') );
		$this->WP_Widget( 'ss-twitter-feed', __('Smart Twitter Feed', 'ss_framework'), $widget_ops );
	}

	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array('title'          => __('Twitter Feed', 'ss_framework'),
															'username'       => '',
															'tweet_count'    => '2',
															'ignore_replies' => 'checked="checked"'
															) );

		$title = esc_attr( $instance['title'] );
		$username = esc_attr( $instance['username'] );
		$tweet_count = absint( $instance['tweet_count'] );
		$ignore_replies = absint( $instance['ignore_replies'] );

		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ss_framework'); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Username:', 'ss_framework'); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" value="<?php echo $username; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('tweet_count'); ?>"><?php _e('Tweet count:', 'ss_framework'); ?></label>
			<input size="2" type="text" id="<?php echo $this->get_field_id('tweet_count'); ?>" name="<?php echo $this->get_field_name('tweet_count'); ?>" value="<?php echo $tweet_count; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('ignore_replies'); ?>"><?php _e('Ignore replies:', 'ss_framework'); ?></label>
			<input type="checkbox" id="<?php echo $this->get_field_id('ignore_replies'); ?>" name="<?php echo $this->get_field_name('ignore_replies'); ?>" <?php checked( $ignore_replies, 1 ); ?> />
		</p>

		<?php

	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = strip_tags( $new_instance['username'] );
		$instance['tweet_count'] = strip_tags( $new_instance['tweet_count'] );
		$instance['ignore_replies'] = isset( $new_instance['ignore_replies'] ) ? 1 : 0;
		$instance['widget_id'] = strip_tags( uniqid( $instance['username'] ) );

		// Refresh Cache
		delete_transient( 'ss_framework_twitter_feed-' . $instance['widget_id'] );

		return $instance;
	}

	function widget( $args, $instance ) {

		extract( $args );

		$title = esc_attr( $instance['title'] );
		$username = esc_attr( $instance['username'] );
		$tweet_count = absint( $instance['tweet_count'] );
		$ignore_replies = absint( $instance['ignore_replies'] );
		$widget_id = esc_attr( $instance['widget_id'] );

		echo $before_widget;

		if( $title )
			echo $before_title . $title . $after_title;

		// Display tweets
		echo ss_framework_twitter_feed( $username, $tweet_count, $ignore_replies, $widget_id );

		echo $after_widget;
	}

}

add_action( 'widgets_init', create_function('', "register_widget('SS_Twitter_Feed_Widget');") );

/* ---------------------------------------------------- */
/*	Flickr Feed
/* ---------------------------------------------------- */

class SS_Flickr_Feed_Widget extends WP_Widget {

	function SS_Flickr_Feed_Widget() {
		$widget_ops = array( 'classname' => 'ss-flickr-feed', 'description' => __('Display the most recent flickr images.', 'ss_framework') );
		$this->WP_Widget( 'ss-flickr-feed', __('Smart Flickr Feed', 'ss_framework'), $widget_ops );
	}

	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array('title'       => __('Flickr Feed', 'ss_framework'),
															'flickr_id'   => '',
															'image_count' => '6'
															) );

		$title = esc_attr( $instance['title'] );
		$flickr_id = esc_attr( $instance['flickr_id'] );
		$image_count = absint( $instance['image_count'] );

		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ss_framework'); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('flickr_id'); ?>"><?php _e('Flickr ID:', 'ss_framework'); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('flickr_id'); ?>" name="<?php echo $this->get_field_name('flickr_id'); ?>" value="<?php echo $flickr_id; ?>" />
			<small>Get your Flickr ID at <a href="http://idgettr.com/" title="idGettr &mdash; Find your Flickr ID" target="_blank">http://idgettr.com/</a></small>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('image_count'); ?>"><?php _e('Image count:', 'ss_framework'); ?></label>
			<input size="2" type="text" id="<?php echo $this->get_field_id('image_count'); ?>" name="<?php echo $this->get_field_name('image_count'); ?>" value="<?php echo $image_count; ?>" />
		</p>

		<?php

	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['flickr_id'] = strip_tags( $new_instance['flickr_id'] );
		$instance['image_count'] = strip_tags( $new_instance['image_count'] );
		$instance['widget_id'] = strip_tags( uniqid( $instance['flickr_id'] ) );

		// Refresh Cache
		delete_transient( 'ss_framework_flickr_feed-' . $instance['widget_id'] );

		return $instance;
	}

	function widget( $args, $instance ) {

		extract( $args );

		$title = esc_attr( $instance['title'] );
		$flickr_id = esc_attr( $instance['flickr_id'] );
		$image_count = absint( $instance['image_count'] );
		$widget_id = esc_attr( $instance['widget_id'] );

		echo $before_widget;

		if( $title )
			echo $before_title . $title . $after_title;

		// Display images
		echo ss_framework_flickr_feed( $flickr_id, $image_count, $widget_id );

		echo $after_widget;
	}

}

add_action( 'widgets_init', create_function('', "register_widget('SS_Flickr_Feed_Widget');") );

/* ---------------------------------------------------- */
/*	Social Links
/* ---------------------------------------------------- */

class SS_Social_Links_Widget extends WP_Widget {

	function SS_Social_Links_Widget() {
		$widget_ops = array( 'classname' => 'ss-social-links', 'description' => __('Display social links. Settings can be found from Theme Options page.', 'ss_framework') );
		$this->WP_Widget( 'ss-social-links', __('Smart Social Links', 'ss_framework'), $widget_ops );
	}

	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array( 'title' => __('Stay Connected', 'ss_framework') ) );

		$title = esc_attr( $instance['title'] );

		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ss_framework'); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>

		<?php

	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}

	function widget( $args, $instance ) {

		extract( $args );

		$title = esc_attr( $instance['title'] );

		echo $before_widget;

		if( $title )
			echo $before_title . $title . $after_title;

		$social_links = of_get_option('ss_social_links_widget');

		echo '<ul class="social-links">';

		if( $social_links ) {

			foreach( $social_links as $link => $status ) {
				
				if( $status && of_get_option( 'ss_social_links_' . $link ) ) {

					if( $link == 'twitter' ) {

						echo '<li class="' . $link . '"><a href="http://twitter.com/' . of_get_option( 'ss_social_links_' . $link ) . '" target="_blank">' . ucfirst( $link ) . '</a></li>';

					} else {

						echo '<li class="' . $link . '"><a href="' . of_get_option( 'ss_social_links_' . $link ) . '" target="_blank">' . ucfirst( $link ) . '</a></li>';

					}

				}

			}

		}

		echo '</ul><!-- end .social-links -->';				


		echo $after_widget;
	}

}

add_action( 'widgets_init', create_function('', "register_widget('SS_Social_Links_Widget');") );


/* ---------------------------------------------------- */
/*	Contact Info
/* ---------------------------------------------------- */

class SS_Contact_Info_Widget extends WP_Widget {

	function SS_Contact_Info_Widget() {
		$widget_ops = array( 'classname' => 'ss-contact-info', 'description' => __('Display your contact info.', 'ss_framework') );
		$this->WP_Widget( 'ss-contact-info', __('Smart Contact Info', 'ss_framework'), $widget_ops );
	}

	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );

		$title = esc_attr( $instance['title'] );

		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ss_framework'); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>

		<?php

	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}

	function widget( $args, $instance ) {

		extract( $args );

		$title = esc_attr( $instance['title'] );

		echo $before_widget;

		if($title)
			echo $before_title . $title . $after_title;

		echo '<ul class="contact-info">';

			if( of_get_option('ss_contact_info_address') )
				echo '<li class="address">' . of_get_option('ss_contact_info_address') . '</li>';

			if( of_get_option('ss_contact_info_phone') )
				echo '<li class="phone">' . of_get_option('ss_contact_info_phone') . '</li>';

			if( of_get_option('ss_contact_info_email') )
				echo '<li class="email"><a href="mailto:' . of_get_option('ss_contact_info_email') . '">' . of_get_option('ss_contact_info_email') . '</a></li>';

		echo '</ul><!-- end .contact-info -->';

		echo $after_widget;
	}

}

add_action( 'widgets_init', create_function('', "register_widget('SS_Contact_Info_Widget');") );