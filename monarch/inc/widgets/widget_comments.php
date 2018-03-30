<?php
/**
 * Monarch Widget Comments
 *
 * @package WordPress
 * @subpackage Monarch
 * @since Monarch 1.0
 */

class widget_comments extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'comments', // Base ID
			esc_html__( 'Monarch Comments', 'monarch' ), // Name
			array( 'description' => esc_html__( 'A widget that displays your latest comments', 'monarch' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract($args);
		//Our variables from the widget settings.
		$title  = apply_filters('widget_title', $instance['title']);
		$number = $instance['number'];
		$query = array(
			'nopaging' => 0
		);
		$comments = get_comments(
		array(
			'status' => 'approve',
			'post_status' => 'publish',
			'number' => $number
		)
	);

	$loop = new WP_Query($query);

	if ($loop->have_posts()):
		echo $args['before_widget'];

	// Display the widget title 
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
	?>

	<ul>
		<?php foreach ($comments as $comment) { ?>
		<li>
			<a href="<?php echo get_permalink($comment->comment_post_ID); ?>#comments" data-title="<?php $title = get_the_title($comment->comment_post_ID); echo $title; ?>" data-toggle="tooltip" data-placement="left" data-animation="true">
				<div class="clearfix">
					<div class="image">
						<?php echo get_avatar( $comment, '60' ); ?>
					</div>
					<div class="text">
						<span class="commauth">
						<?php echo ($comment->comment_author); ?>
						</span>
						<span class="time">
						<?php echo date_i18n( get_option('date_format'), strtotime($comment->comment_date_gmt) ); ?> 
						</span>
					</div>
				</div>
				<div class="post">
					<?php echo strip_tags( substr( apply_filters( 'get_comment_text', $comment->comment_content ), 0, 80 ) . '...'); ?>
				</div>
			</a>
		</li>
		<?php }  ?>
	</ul>

	<?php wp_reset_query(); ?>
	<?php endif; ?>
	<?php
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
			//Set up some default widget settings.
			$defaults = array(
				'title'  => esc_html__('Thoughts', 'monarch'),
				'number' => 3
			);
			$instance = wp_parse_args((array) $instance, $defaults);
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e('Title:', 'monarch'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e('Number of comments to show:', 'monarch'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" size="3" />
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';

		return $instance;
	}

} // class widget_comments
?>