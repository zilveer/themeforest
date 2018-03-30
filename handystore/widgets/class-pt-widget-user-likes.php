<?php /* User Likes Widget */

if ( ! defined( 'ABSPATH' ) ) exit;

class PT_User_Likes extends WP_Widget {
	
	public function __construct() {
		parent::__construct(
	 		'pt_user_likes_widget', 
			__('PT User Likes', 'plumtree'), 
			array( 'description' => __( 'Plum Tree special widget. If the user is logged in, output a list of posts that the user likes', 'plumtree' ), ) 
		);
	}

	public function form( $instance ) {
		$defaults = array( 
			'title' 		=> 'Favourite Posts',
			'precontent'    => '',
			'postcontent'   => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); 
	?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'plumtree' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id ('precontent'); ?>"><?php _e('Pre-Content', 'plumtree'); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id('precontent'); ?>" name="<?php echo $this->get_field_name('precontent'); ?>" rows="2" cols="25"><?php echo $instance['precontent']; ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id ('postcontent'); ?>"><?php _e('Post-Content', 'plumtree'); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id('postcontent'); ?>" name="<?php echo $this->get_field_name('postcontent'); ?>" rows="2" cols="25"><?php echo $instance['postcontent']; ?></textarea>
		</p>
		<?php 
	}

	public function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;

		$instance['title'] = ( $new_instance['title'] );
		$instance['precontent'] = stripslashes( $new_instance['precontent'] );
		$instance['postcontent'] = stripslashes( $new_instance['postcontent'] );

		return $instance;
	}

	public function widget( $args, $instance ) {

		global $wpdb;

		extract( $args );

		$title = apply_filters( 'widget_title', $instance['title'] );
		$precontent = (isset($instance['precontent']) ? $instance['precontent'] : '' );
		$postcontent = (isset($instance['postcontent']) ? $instance['postcontent'] : '' );

		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
		if ( ! empty( $precontent ) ) {
			echo '<div class="precontent">'.$precontent.'</div>';
		} 
		
		if ( is_user_logged_in() ) { // user is logged in
			$like_list = '';
			$user_id = get_current_user_id(); // current user
			$user_likes = get_user_option( "_liked_posts", $user_id );
			if ( !empty( $user_likes ) && count( $user_likes ) > 0 ) {
				$the_likes = $user_likes;
			} else {
				$the_likes = '';
			}
			if ( !is_array( $the_likes ) )
				$the_likes = array();
			$count = count( $the_likes );
			if ( $count > 0 ) {
				$limited_likes = array_slice( $the_likes, 0, 5 ); // this will limit the number of posts returned to 5
				$like_list .= "<div class='favourite-posts'>\n";
				$like_list .= "<h3>" . __( 'You Like:', 'plumtree' ) . "</h3>\n";
				$like_list .= "<ul>\n";
				foreach ( $limited_likes as $the_like ) {
					$like_list .= "<li><a href='" . esc_url( get_permalink( $the_like ) ) . "' title='" . esc_attr( get_the_title( $the_like ) ) . "'>" . get_the_title( $the_like ) . "</a></li>\n";
				}
				$like_list .= "</ul>\n";
				$like_list .= "</div>\n";
			}
			echo $like_list;
		} else {
			$like_list = '';
			$like_list .= "<div class='favourite-posts'>\n";
			$like_list .= "<h3>" . __( 'Nothing yet', 'plumtree' ) . "</h3>\n";
			$like_list .= "</div>\n";
			echo $like_list;
		}
		
		if ( ! empty( $postcontent ) ) {
			echo '<div class="postcontent">'.$postcontent.'</div>';
		}

		echo $after_widget;
	}
}

add_action( 'widgets_init', create_function( '', 'register_widget( "PT_User_Likes" );' ) );
