<?php /* Popular Posts Widget */

if ( ! defined( 'ABSPATH' ) ) exit;

class PT_Popular_Posts extends WP_Widget {
	
	public function __construct() {
		parent::__construct(
	 		'pt_popular_posts_widget',
			__('PT Popular Posts', 'plumtree'),
			array( 'description' => __( 'Plum Tree special widget. Outputs a list of the posts with the most user likes', 'plumtree' ), ) 
		);
	}

	public function form( $instance ) {

		$defaults = array( 
			'title' 		=> 'Popular Posts',
			'range'         => 'all',
			'post-quantity' => 3,
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
            <label for="<?php echo $this->get_field_id("range"); ?>"><?php _e('Time Range:', 'plumtree'); ?></label>
        	<select class="widefat" id="<?php echo $this->get_field_id("range"); ?>" name="<?php echo $this->get_field_name("range"); ?>">
          		<option value="date" <?php selected( $instance["range"], "day" ); ?>><?php _e('Today', 'plumtree'); ?></option>
           		<option value="comment_count" <?php selected( $instance["range"], "week" ); ?>><?php _e('Week', 'plumtree'); ?></option>
         		<option value="title" <?php selected( $instance["range"], "month" ); ?>><?php _e('Month', 'plumtree'); ?></option>
				<option value="author" <?php selected( $instance["range"], "all" ); ?>><?php _e('All Time', 'plumtree'); ?></option>
        	</select>
        </p>
        <p>
			<label for="<?php echo $this->get_field_id('post-quantity'); ?>"><?php _e( 'How many posts to display: ', 'plumtree' ) ?></label>
			<input size="3" id="<?php echo esc_attr( $this->get_field_id('post-quantity') ); ?>" name="<?php echo esc_attr( $this->get_field_name('post-quantity') ); ?>" type="number" value="<?php echo esc_attr( $instance['post-quantity'] ); ?>" />
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
		$instance['range'] = strip_tags( $new_instance['range'] );
		$instance['post-quantity'] = intval( $new_instance['post-quantity'] );
		$instance['precontent'] = stripslashes( $new_instance['precontent'] );
		$instance['postcontent'] = stripslashes( $new_instance['postcontent'] );

		return $instance;
	}

	public function widget( $args, $instance ) {

		global $wpdb, $post;

		extract( $args );

		$title = apply_filters( 'widget_title', $instance['title'] );
		$precontent = (isset($instance['precontent']) ? $instance['precontent'] : '' );
		$postcontent = (isset($instance['postcontent']) ? $instance['postcontent'] : '' );
		$range = (isset($instance['range']) ? $instance['range'] : 'all' );
		$post_qty = ( isset($instance['post-quantity']) ? $instance['post-quantity'] : 3 );

		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
		if ( ! empty( $precontent ) ) {
			echo '<div class="precontent">'.$precontent.'</div>';
		} 

		// Time range variables
		$year = date('Y');
		$today = false;
		$week = false;
		$month = false;
		switch ($range) {
			case 'day':
				$today = date('j');
				$inner_title = __( 'Today\'s Most Popular Posts', 'plumtree' );
			break;
			case 'week':
				$week = date('W');
				$inner_title = __( 'This Month\'s Most Popular Posts', 'plumtree' );
			break;
			case 'month':
				$month = date('m');
				$inner_title = __( 'This Month\'s Most Popular Posts', 'plumtree' );
			break;
			case 'all':
				$year = false;
				$inner_title = __( 'This Month\'s Most Popular Posts', 'plumtree' );
  			break;
			default:
				$year = false;
				$inner_title = __( 'This Month\'s Most Popular Posts', 'plumtree' );
		}

		// New Query
		$args = array(
			'year' => $year,
			'day' => $today,
			'w' => $week,
			'monthnum' => $month,
			'post_type' => 'post',
			'meta_key' => '_post_like_count',
			'orderby' => 'meta_value_num',
			'order' => 'DESC',
			'posts_per_page' => $post_qty
		);
		
		$pop_posts = new WP_Query( $args );
		if ( $pop_posts->have_posts() ) {
			echo "<div class='favourite-posts'>\n";
			echo "<h3>" . $inner_title . "</h3>\n";
			echo "<ul>\n";
			while ( $pop_posts->have_posts() ) {
				$pop_posts->the_post();
				echo "<li><a href='" . get_permalink($post->ID) . "'>" . get_the_title() . "</a></li>\n";
			}
			echo "</ul>\n";
			echo "</div>\n";
		} else {
			$like_list = '';
			$like_list .= "<div class='favourite-posts'>\n";
			$like_list .= "<h3>" . __( 'Nothing yet', 'plumtree' ) . "</h3>\n";
			$like_list .= "</div>\n";
			echo $like_list;
		}
		wp_reset_postdata();

		if ( ! empty( $postcontent ) ) {
			echo '<div class="postcontent">'.$postcontent.'</div>';
		}

		echo $after_widget;
	}
}

add_action( 'widgets_init', create_function( '', 'register_widget( "PT_Popular_Posts" );' ) );

