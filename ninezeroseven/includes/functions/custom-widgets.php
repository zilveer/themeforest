<?php
// Register Widgets
if ( !function_exists( 'wbc_register_widgets' ) ) {
	function wbc_register_widgets() {
		register_widget( 'WBC_Recent_Posts_Widget' );
		register_widget( 'WBC_Responsive_Video_Widget' );
		register_widget( 'WBC_Recent_Comments_Widget' );
	}
	add_action( 'widgets_init', 'wbc_register_widgets' );
}

/************************************************************************
* Recent Post Widget
*************************************************************************/
class WBC_Recent_Posts_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'wbc_recent_post_widget', // Base ID
			esc_html__( 'WBC Recent Posts', 'ninezeroseven' ), // Name
			array( 'description' => esc_html__( 'Display recent posts with thumbnails', 'ninezeroseven' ),
				'classname' => 'wbc-recent-post-widget' ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array   $args     Widget arguments.
	 * @param array   $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		global $post;

		$temp_post = $post;

		$html = '';

		$html .= $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			$html .= $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}

		$query_args = array(
			'post_type'      => $instance['post_type'],
			'posts_per_page' => $instance['show_posts'],
			'meta_key'       => '_thumbnail_id',
		);

		if( isset( $instance['order_by'] ) && !empty( $instance['order_by'] ) ){
			$query_args['orderby'] = $instance['order_by'];
		}

		$q = new WP_Query( $query_args );

		$html .= '<ul class="wbc-recent-post-list">';

		if ( $q->have_posts() ) {
			
			while ( $q->have_posts() ) {
				$q->the_post();
				$html .='<li>';
				if ( has_post_thumbnail() ) {
					$html .='<div class="wbc-recent-post-img">';
					$html .='	<div class="wbc-image-wrap">';
					$html .='		<a href="'.esc_attr( get_permalink() ).'">';
					$html .=   get_the_post_thumbnail( get_the_id() , 'thumbnail' );
					$html .='		</a>';
					$html .='		<a class="item-link-overlay" href="'.esc_attr( get_permalink() ).'" ></a>';
					$html .='		<div class="wbc-extra-links">';
					$html .='			<a href="'.esc_attr( get_permalink() ).'" class="wbc-go-link"><i class="fa fa-link"></i></a>';
					$html .='		</div>';
					$html .='	</div>';
					$html .='</div>';
				}


				$html .='<div class="widget-content">';
				$html .='<h6><a href="'.get_the_permalink().'">'.get_the_title().'</a></h6>';
				$excerpt = get_the_excerpt();
				if ( !empty( $excerpt ) && strlen( $excerpt ) > 0 ) {
					$html .= '<p>';
					$html .= substr( $excerpt, 0, 50 ).'...';
					$html .= '</p>';
				}elseif( function_exists('wbc_get_excerpt') ){
					$html .= wbc_get_excerpt(50);
				}

				$html .='</div>';

				$html .='</li>';
			}

			
		}else{
			$html .= '<p>'.esc_html__( 'No Posts To Display', 'ninezeroseven' ).'</p>';
		}

		$html .= '</ul>';

		$html .= $args['after_widget'];



		echo wp_kses_post($html);

		$post = $temp_post;
	}
	
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array   $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$defauts = array(
			'title'      => esc_html__( 'Latest Posts', 'ninezeroseven' ),
			'show_posts' => '4',
			'post_type'  => '',
			'order_by'   => 'id',
		);

		$instance = wp_parse_args( (array) $instance, $defauts );

		$post_type_array = array(
			'post'          => 'Post',
			'wbc-portfolio' => 'Portfolio'
		);

		$post_type_array = apply_filters( 'wbc_recent_posts_widget', $post_type_array );

		$post_type_html = '';


		$orber_by_array = array(
			'ID'     => esc_html__( 'ID', 'ninezeroseven' ),
			'author' => esc_html__( 'Author', 'ninezeroseven' ),
			'title'  => esc_html__( 'Title', 'ninezeroseven' ),
			'name'   => esc_html__( 'Name', 'ninezeroseven' ),
			'rand'   => esc_html__( 'Random', 'ninezeroseven' ),
		);

		$orber_by_html = '';

		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'ninezeroseven' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
		</p>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'post_type' ) ); ?>"><?php esc_html_e( 'Post Type', 'ninezeroseven' ); ?></label><br/>
		<select id="<?php echo esc_attr( $this->get_field_id( 'post_type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_type' ) ); ?>">
			<?php 
				foreach ( $post_type_array as $post_type => $name ) {
					echo '<option value="'.esc_attr( $post_type ).'" '.selected( $instance['post_type'], $post_type, false ).'>'.esc_html( $name ).'</option>';
				}
			?>
		</select>
		</p>

		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'order_by' ) ); ?>"><?php esc_html_e( 'Order By', 'ninezeroseven' ); ?></label><br/>
		<select id="<?php echo esc_attr( $this->get_field_id( 'order_by' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'order_by' ) ); ?>">
			<?php 
				foreach ( $orber_by_array as $order_by => $title ) {
					echo '<option value="'.esc_attr( $order_by ).'" '.selected( $instance['order_by'], $order_by, false ).'>'.esc_html( $title ).'</option>';
				}
			?>
		</select>
		</p>

		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'show_posts' ) ); ?>"><?php esc_html_e( 'Post Count:', 'ninezeroseven' ); ?></label><br/>
		<input class="small-text" id="<?php echo esc_attr( $this->get_field_id( 'show_posts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_posts' ) ); ?>" type="number" value="<?php echo esc_attr( $instance['show_posts'] ); ?>">
		</p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array   $new_instance Values just sent to be saved.
	 * @param array   $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title']      = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['post_type']  = ( ! empty( $new_instance['post_type'] ) ) ? strip_tags( $new_instance['post_type'] ) : '';
		$instance['order_by']   = ( ! empty( $new_instance['order_by'] ) ) ? strip_tags( $new_instance['order_by'] ) : '';
		$instance['show_posts'] = ( ! empty( $new_instance['show_posts'] ) && is_numeric( $new_instance['show_posts'] ) ) ? strip_tags( $new_instance['show_posts'] ) : '';
		return $instance;
	}

} // class WBC_Recent_Posts_Widget

/************************************************************************
* Recent Comments
*************************************************************************/
class WBC_Recent_Comments_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'wbc_recent_comments_widget', // Base ID
			esc_html__( 'WBC Recent Comments', 'ninezeroseven' ), // Name
			array( 'description' => esc_html__( 'Display recent comments with thumbnails', 'ninezeroseven' ),
				'classname' => 'wbc-recent-comments-widget' ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array   $args     Widget arguments.
	 * @param array   $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

		$html = '';

		$html .= $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			$html .= $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}

		$comment_count = (!empty($instance['show_comment']) && is_numeric($instance['show_comment'])) ? $instance['show_comment'] : 4;

		$comments = get_comments( apply_filters( 'widget_comments_args', array( 'number' => $comment_count, 'status' => 'approve', 'post_status' => 'publish' ) ) );

		$html .= '<ul class="wbc-recent-comments-list">';

		foreach ( $comments as $comment ) {

			$html .='<li>';
			$html .= '<a href="'.esc_url( get_comment_link( $comment ) ).'" class="wbc-user-avatar">';
			$html .= get_avatar( $comment->comment_author_email, $size = '55', $default = '', $comment->comment_author.'\'s Avatar Image' );
			$html .= '</a>';
			$html .= '<div class="widget-content">';
			$html .= '<h6>'.$comment->comment_author.'<span>'.esc_html__('Says', 'ninezeroseven' ).' <i class="fa fa-comment"></i></span></h6>';
			$html .= '<p><a href="'.esc_url( get_comment_link( $comment ) ).'">'.get_comment_excerpt( $comment->comment_ID ).'</a></p>';

			$html .= '</div>';

			$html .= '</li>';

		}

		$html .= '</ul>';

		$html .= $args['after_widget'];



		echo wp_kses_post( $html );
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array   $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$defauts = array(
			'title' => esc_html__( 'Recent Comments', 'ninezeroseven' ),
			'show_comment' => '4',
		);

		$instance = wp_parse_args( (array) $instance, $defauts );

		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'ninezeroseven' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
		</p>

		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'show_comment' ) ); ?>"><?php esc_html_e( 'Comment Count:', 'ninezeroseven' ); ?></label><br/>
		<input class="small-text" id="<?php echo esc_attr( $this->get_field_id( 'show_comment' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_comment' ) ); ?>" type="number" value="<?php echo esc_attr( $instance['show_comment'] ); ?>">
		</p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array   $new_instance Values just sent to be saved.
	 * @param array   $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['show_comment'] = ( ! empty( $new_instance['show_comment'] ) && is_numeric( $new_instance['show_comment'] ) ) ? strip_tags( $new_instance['show_comment'] ) : '';
		return $instance;
	}

} // class WBC_Recent_Comments_Widget


/************************************************************************
* Responsive video
*************************************************************************/
class WBC_Responsive_Video_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'wbc_responsive_video_widget', // Base ID
			esc_html__( 'WBC Video', 'ninezeroseven' ), // Name
			array( 'description' => esc_html__( 'Display responsive video', 'ninezeroseven' ),
				'classname' => 'wbc-responsive-video-widget' ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array   $args     Widget arguments.
	 * @param array   $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

		$html = '';

		$html .= $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			$html .= $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}

		if(!empty($instance['video_url'])){
			$video_url = esc_url( $instance['video_url'] );
		}else{
			$video_url = 'http://vimeo.com/7449107';
		}

		$html .= '<div class="wbc-video-wrap">';
		$html .= wp_oembed_get( $video_url );
		$html .= '</div>';

		$html .= $args['after_widget'];



		echo do_shortcode( $html );
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array   $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$defauts = array(
			'title' => esc_html__( 'Responsive Video', 'ninezeroseven' ),
			'video_url' => '',
		);

		$instance = wp_parse_args( (array) $instance, $defauts );


		?>
		<p>
          <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:','ninezeroseven' ); ?></label> 
          <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
          </p>

           <p>
          <label for="<?php echo esc_attr( $this->get_field_id( 'video_url' ) ); ?>"><?php esc_html_e( 'Video URL','ninezeroseven' ); ?></label> 
          <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'video_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'video_url' ) ); ?>" type="text" value="<?php echo esc_url( $instance['video_url'] ); ?>" />
          <span><?php esc_html_e('Please include URL, I.E http://vimeo.com/7449107', 'ninezeroseven');?></span>
          </p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array   $new_instance Values just sent to be saved.
	 * @param array   $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['video_url'] = ( ! empty( $new_instance['video_url'] ) ) ? esc_html( $new_instance['video_url'] ) : '';
		return $instance;
	}

} // class WBC_Responsive_Video_Widget
?>