<?php
if (!class_exists('Twitter_Widget')) :

	class Twitter_Widget extends WP_Widget {

		function Twitter_Widget() {

			// Widget settings
			$widget_ops = array('classname' => 'twitter-widget', 'description' =>__('Display your latest tweets.', 'okthemes'));

			// Create the widget
			$this->WP_Widget('twitter-widget', 'Twitter Widget', $widget_ops);
		}


		function widget($args, $instance) {

			extract($args);

			// User-selected settings
			$title = apply_filters('widget_title', $instance['title']);
			$username = $instance['username'];
			$posts = $instance['posts'];

			// Before widget (defined by themes)
			echo $before_widget;

			// Title of widget (before and after defined by themes)
			if (!empty($title)) echo $before_title . $title . $after_title;

			echo su_get_tweets( $username, $posts );

			// After widget (defined by themes)
			echo $after_widget;
		}


		function update($new_instance, $old_instance) {

			$instance = $old_instance;

			$instance['title'] = $new_instance['title'];
			$instance['username'] = $new_instance['username'];
			$instance['posts'] = $new_instance['posts'];

			return $instance;
		}


		function form($instance) {

			// Set up some default widget settings
			$defaults = array('title' => __('Latest tweets', 'okthemes'), 'username' => '', 'posts' => 5);
			$instance = wp_parse_args((array) $instance, $defaults);
?>
				
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>">
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('username'); ?>">Your Twitter username:</label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" value="<?php echo $instance['username']; ?>">
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('posts'); ?>">Number of posts to display</label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('posts'); ?>" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>">
			</p>

<?php
		}
	}	
endif;

// Register the plugin/widget
if (class_exists('Twitter_Widget')) :

	function loadTwitterWidget() {

		register_widget('Twitter_Widget');
	}

	add_action('widgets_init', 'loadTwitterWidget');

endif;


/**
 * Adds gg_Contact_Widget widget.
 */
class gg_Flickr_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'gg_flickr_widget', // Base ID
			__('Flickr Widget', 'okthemes'), // Name
			array( 'description' => __( 'Display up to 20 of your latest Flickr submissions', 'okthemes' ), 'classname' => 'flickr-widget', ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 */
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );

		$username = ! empty( $instance['username'] ) ? $instance['username'] : '';
		$count = ! empty( $instance['count'] ) ? $instance['count'] : '';

		echo $args['before_widget'];

		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];
				

		echo '<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count='. $count . '&amp;display=latest&amp;size=t&amp;layout=x&amp;source=user&amp;user='. $username .'"></script>';
		echo '<p class="flickr_stream_wrap"><a class="wpb_follow_btn wpb_flickr_stream" href="http://www.flickr.com/photos/'. $username .'">'.__("View stream on flickr", "okthemes").'</a></p>';

		echo $args['after_widget'];
	}
	

	/**
	 * Back-end widget form.
	 */
	public function form( $instance ) {
		
		$title = isset( $instance['title'] ) ? $instance['title'] : __( 'Photostream', 'okthemes' );
		$username = isset( $instance['username'] ) ? $instance['username'] : '';
		$count = isset( $instance['count'] ) ? absint( $instance['count'] ) : 10;

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','okthemes' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e( 'Flickr ID (To find your flickID visit <a href="http://idgettr.com/" target="_blank">idGettr</a>)' ); ?> </label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" type="text" value="<?php echo esc_attr( $username ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Count:','okthemes' ); ?></label><br />
			<input type="number" min="1" max="20" value="<?php echo esc_attr( $count ); ?>" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" />
		</p>
		<?php 
	}


	/**
	 * Sanitize widget form values as they are saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();

		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['username'] = ( ! empty( $new_instance['username'] ) ) ? strip_tags( $new_instance['username'] ) : '';
		$instance['count'] = ( ! empty( $new_instance['count'] ) ) ? absint( $new_instance['count'] ) : '';
		
		return $instance;
	}


} // class gg_Flickr_Widget

// register gg_Flickr_Widget 
function register_gg_flickr_widget() {
    register_widget( 'gg_Flickr_Widget' );
}
add_action( 'widgets_init', 'register_gg_flickr_widget' );

/*
Plugin Name: Recent Posts Dated Widget
Plugin URI: http://wordpress.org/support/topic/389933
Description: Displays recent posts including the post date. Beta version.
Version: 0.1
Author: J. Michael Ambrosio
Author URI: http://www.ambrosite.com
License: GPL2
*/

/**
 * recent_posts_custom_widget
 * Displays recent posts including the post date.
 *
 * Based on WP_Widget_Recent_Posts from wp-includes/default-widgets.php
 *
 * @since 0.1
 */
class recent_posts_custom_widget extends WP_Widget {

	function recent_posts_custom_widget() {
		$widget_ops = array('classname' => 'recent_posts_custom_widget', 'description' => __( "The most recent posts on your blog, including post dates.", 'okthemes') );
		$this->WP_Widget('recent-posts-dated', __('Custom Recent Posts', 'okthemes'), $widget_ops);
		$this->alt_option_name = 'recent_posts_custom_widget';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance) {
		$cache = wp_cache_get('recent_posts_custom_widget', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( isset($cache[$args['widget_id']]) ) {
			echo $cache[$args['widget_id']];
			return;
		}

		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts', 'okthemes') : $instance['title']);
		if ( !$number = (int) $instance['number'] )
			$number = 10;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;

		$r = new WP_Query(array('showposts' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1));
		if ($r->have_posts()) :
?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<ul>
		<?php  while ($r->have_posts()) : $r->the_post(); ?>
		<li>
        <div class="date_comments_holder">
        	<span class="date_circle">
            	<?php the_time('j'); ?>
                <span class="clear"></span>
				<?php the_time('M'); ?>
            </span>
            <span class="comments_circle">
            	<?php comments_number( '0', '1', '%' ); ?>
            </span>
        </div>
        <a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a>
        <?php the_excerpt(); ?>
        </li>
		<?php endwhile; ?>
		</ul>
		<?php echo $after_widget; ?>
<?php
			wp_reset_query();  // Restore global post data stomped by the_post().
		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_add('recent_posts_custom_widget', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['recent_entries_dated_widget']) )
			delete_option('recent_entries_dated_widget');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('recent_posts_custom_widget', 'widget');
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 5;
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'okthemes'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:', 'okthemes'); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /><br />
		<small><?php _e('(at most 15)', 'okthemes'); ?></small></p>
<?php
	}
}

/**
 * @since 0.1
 */
function Recent_Posts_Dated_init() {
	register_widget('recent_posts_custom_widget');
}

/**
 * @since 0.1
 */
add_action('widgets_init', 'Recent_Posts_Dated_init');


/**
 * Most viewed widget
 * Displays recent posts including the post date.
 *
 * Based on WP_Widget_Recent_Posts from wp-includes/default-widgets.php
 *
 * @since 0.1
 */
class most_viewed_posts_widget extends WP_Widget {

	function most_viewed_posts_widget() {
		$widget_ops = array('classname' => 'most_viewed_posts_widget', 'description' => __( "The most viewed posts on your blog.", 'okthemes') );
		$this->WP_Widget('most-viewed-posts', __('Most Viewed Posts', 'okthemes'), $widget_ops);
		$this->alt_option_name = 'most_viewed_posts_widget';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance) {
		$cache = wp_cache_get('most_viewed_posts_widget', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( isset($cache[$args['widget_id']]) ) {
			echo $cache[$args['widget_id']];
			return;
		}

		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Most Viewed Posts', 'okthemes') : $instance['title']);
		if ( !$number = (int) $instance['number'] )
			$number = 10;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;

		$r = new WP_Query(array('showposts' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1, 'meta_key' => 'wpb_post_views_count', 'orderby'=> 'wpb_post_views_count'));
		if ($r->have_posts()) :
?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<ul>
		<?php  while ($r->have_posts()) : $r->the_post(); ?>
		<li><a href="<?php the_permalink() ?>" title="Permanent Link to: <?php the_title_attribute(); ?>"><?php the_title(); ?></a> <?php echo '(' . wpb_get_post_views(get_the_ID()) .')'; ?></li>
		<?php endwhile; ?>
		</ul>
		<?php echo $after_widget; ?>
		
		<?php
		wp_reset_query();  // Restore global post data stomped by the_post().
		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_add('most_viewed_posts_widget', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['most_viewed_posts_widget']) )
			delete_option('most_viewed_posts_widget');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('most_viewed_posts_widget', 'widget');
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 5;
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'okthemes'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:', 'okthemes'); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /><br />
		<small><?php _e('(at most 15)', 'okthemes'); ?></small></p>
<?php
	}
}

/**
 * @since 0.1
 */
function most_viewed_posts_widget_init() {
	register_widget('most_viewed_posts_widget');
}

/**
 * @since 0.1
 */
add_action('widgets_init', 'most_viewed_posts_widget_init');


/**
 * Plugin Name: Social Icons Widget
 * 
 */

add_action('widgets_init', 'socialicons_load_widgets');

function socialicons_load_widgets()
{
	register_widget('Socialicons_Widget');
}

class Socialicons_Widget extends WP_Widget {
	
	function Socialicons_Widget()
	{
		$widget_ops = array('classname' => 'social-icons', 'description' => '');

		$control_ops = array('id_base' => 'social-icons-widget');

		$this->WP_Widget('social-icons-widget', 'Social Icons Widget', $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);

		echo $before_widget;

		if($title) {
			echo  $before_title.$title.$after_title;
		} ?>
		<div class="social-icons-widget">
		<ul>
		<?php if(of_get_option('rss_link')): ?>
		<li><a class="social-rss" href="<?php echo of_get_option('rss_link'); ?>" target="_blank"></a></li>
		<?php endif; ?>
		<?php if(of_get_option('facebook_link')): ?>
		<li><a class="social-facebook" href="<?php echo of_get_option('facebook_link'); ?>" target="_blank"></a></li>
		<?php endif; ?>
		<?php if(of_get_option('twitter_link')): ?>
		<li><a class="social-twitter" href="<?php echo of_get_option('twitter_link'); ?>" target="_blank"></a></li>
		<?php endif; ?>
		<?php if(of_get_option('skype_link')): ?>
		<li><a class="social-skype" href="<?php echo of_get_option('skype_link'); ?>" target="_blank"></a></li>
		<?php endif; ?>
		<?php if(of_get_option('vimeo_link')): ?>
		<li><a class="social-vimeo" href="<?php echo of_get_option('vimeo_link'); ?>" target="_blank"></a></li>
		<?php endif; ?>
		<?php if(of_get_option('linkedin_link')): ?>
		<li><a class="social-linkedin" href="<?php echo of_get_option('linkedin_link'); ?>" target="_blank"></a></li>
		<?php endif; ?>
		<?php if(of_get_option('dribble_link')): ?>
		<li><a class="social-dribble" href="<?php echo of_get_option('dribble_link'); ?>" target="_blank"></a></li>
		<?php endif; ?>
		<?php if(of_get_option('forrst_link')): ?>
		<li><a class="social-forrst" href="<?php echo of_get_option('forrst_link'); ?>" target="_blank"></a></li>
		<?php endif; ?>
		<?php if(of_get_option('flickr_link')): ?>
		<li><a class="social-flickr" href="<?php echo of_get_option('flickr_link'); ?>" target="_blank"></a></li>
		<?php endif; ?>
		<?php if(of_get_option('google_link')): ?>
		<li><a class="social-google" href="<?php echo of_get_option('google_link'); ?>" target="_blank"></a></li>
		<?php endif; ?>
		<?php if(of_get_option('youtube_link')): ?>
		<li><a href="<?php echo of_get_option('youtube_link'); ?>" target="_blank" class="social-youtube"></a></li>
		<?php endif; ?>
		</ul>
		
		<div class="clearfix"></div>
		</div>
		<?php echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => 'Social Icons');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
	<?php
	}
}

/**
 * Plugin Name: CodeDecoded - Contact Widget
 * Description: A plugin containing a Contact us widget example by CodeDecoded.
 * Version: 0.1
 * Author: CodeDecoded
 * Author URI: http://www.facebook.com/pages/Code-Decoded/203711979669931
 *
 * 
 */

/**
 * Add function to widgets_init that'll load our widget.
 * @since 0.1
 */
add_action( 'widgets_init', 'example_load_widgets' );

/**
 * Register our widget.
 *
 * @since 0.1
 */
function example_load_widgets() {
	register_widget( 'Contact_Widget' );
}

/**
 * Example Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 * @since 0.1
 */
class Contact_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function Contact_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'contact', 'description' => __('Contact us Widget', 'okthemes') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'contact-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'contact-widget', __('Contact Widget', 'okthemes'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$address = $instance['address'];
		$phone =  $instance['phone'];
		$fax = $instance['fax'];
		$email = $instance['email'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
			echo '<ul>';
		/* Display name from widget settings if one was input. */
		if ( $address )
			printf( '<li class="address"><span>Address</span>' . __('%1$s', 'okthemes') . '</li>', $address );
		if ( $phone )
			printf( '<li class="phone"><span>Phone</span>' . __('%1$s', 'okthemes') . '</li>', $phone );
		if ( $fax )
			printf( '<li class="fax"><span>Fax</span>' . __('%1$s', 'okthemes') . '</li>', $fax );
		if ( $email )
			printf( '<li class="email"><span>Email</span>' . __('%1$s', 'okthemes') . '</li>', $email );
		echo '</ul>';	
		
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
		$instance['address'] = strip_tags( $new_instance['address'] );
		$instance['phone'] = strip_tags( $new_instance['phone'] );
		$instance['fax'] = strip_tags( $new_instance['fax'] );
		$instance['email'] = strip_tags( $new_instance['email'] );

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Contact Us', 'example'), 'address' => __('New York, NY, Usa', 'okthemes'), 'phone' => __('(40) - 555 555 5555 ', 'okthemes'), 'fax' => __('(40) - 555 555 5556', 'okthemes'), 'email' => __('email@email.com', 'okthemes') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'okthemes'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		<!-- Your Address: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'address' ); ?>"><?php _e('Your Address:', 'okthemes'); ?></label>
			<input id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>" value="<?php echo $instance['address']; ?>" style="width:100%;" />
		</p>
		<!-- Your Phone: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'phone' ); ?>"><?php _e('Your Phone:', 'okthemes'); ?></label>
			<input id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" value="<?php echo $instance['phone']; ?>" style="width:100%;" />
		</p>
		<!-- Your Fax: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'fax' ); ?>"><?php _e('Your Fax:', 'okthemes'); ?></label>
			<input id="<?php echo $this->get_field_id( 'fax' ); ?>" name="<?php echo $this->get_field_name( 'fax' ); ?>" value="<?php echo $instance['fax']; ?>" style="width:100%;" />
		</p>
		<!-- Your E-mail: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e('Your Email:', 'okthemes'); ?></label>
			<input id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" value="<?php echo $instance['email']; ?>" style="width:100%;" />
		</p>
		<!-- Your Google Maps link: Text Input -->

	<?php
	}
}

?>