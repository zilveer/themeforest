<?php
/**
 * Plugin Name: Greatives Latest Comments
 * Description: A widget that displays latest comments.
 * @author		Greatives Team
 * @URI			http://greatives.eu
 */


add_action( 'widgets_init', 'blade_grve_widget_latest_comments' );

function blade_grve_widget_latest_comments() {
	register_widget( 'Blade_GRVE_Widget_Latest_Comments' );
}

class Blade_GRVE_Widget_Latest_Comments extends WP_Widget {

	function __construct() {
		$widget_ops = array(
			'classname' => 'grve-comments',
			'description' => esc_html__( 'A widget that displays latest comments', 'blade' ),
		);
		$control_ops = array(
			'width' => 300,
			'height' => 400,
			'id_base' => 'grve-widget-latest-comments',
		);
		parent::__construct( 'grve-widget-latest-comments', '(Greatives) ' . esc_html__('Latest Comments', 'blade' ), $widget_ops, $control_ops );
	}

	function Blade_GRVE_Widget_Latest_Comments() {
		$this->__construct();
	}

	function widget( $args, $instance ) {

		//Our variables from the widget settings.
		extract( $args );

		$num_of_comments = $instance['num_of_comments'];
		$show_avatar = $instance['show_avatar'];
		if ( empty( $num_of_comments ) ) {
			$num_of_comments = 5;
		}

		echo $before_widget; // XSS OK

		// Display the widget title
		$title = apply_filters( 'widget_title', $instance['title'] );
		if ( $title ) {
			echo $before_title . esc_html( $title ) . $after_title; // XSS OK
		}

		$comments = get_comments(
			array(
				'number' => $num_of_comments,
				'status' =>
				'approve',
				'post_status' => 'publish',
			)
		);
		$avatar = "";
		//Loop comments
		if ( $comments ) {
		?>
			<ul>
		<?php
			foreach ( (array) $comments as $comment ) {
		?>
				<li>
					<?php if( $show_avatar && '1' == $show_avatar ) { ?>
					<?php echo get_avatar( $comment, 30 ); ?>
					<?php } ?>
					<div class="grve-comment-content">
						<div class="grve-author">
							<?php echo sprintf( _x('%1$s on %2$s', 'Author *on* Post Title', 'blade'), get_comment_author_link( $comment->comment_ID ), '<a href="' . esc_url( get_comment_link( $comment->comment_ID ) ) . '">' . get_the_title( $comment->comment_post_ID ) . '</a>'); ?>
						</div>
						<div class="grve-comment-date"><?php echo esc_html( get_comment_date( '', $comment->comment_ID ) ); ?></div>

					</div>
				</li>
		<?php

			}
		?>
			</ul>
		<?php
 		} else {
			echo esc_html__( 'No Comments Found!', 'blade' );
		}

		echo $after_widget; // XSS OK
	}

	//Update the widget

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['num_of_comments'] = strip_tags( $new_instance['num_of_comments'] );
		$instance['show_avatar'] = strip_tags( $new_instance['show_avatar'] );

		return $instance;
	}


	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array(
			'title' => '',
			'num_of_comments' => '5',
			'show_avatar' => '1',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>


		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title:', 'blade' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'num_of_comments' ) ); ?>"><?php echo esc_html__( 'Number of comments:', 'blade' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'num_of_comments' ) ); ?>" style="width:100%;">
				<?php
				for ( $i = 1; $i <= 20; $i++ ) {
				?>
				    <option value="<?php echo esc_attr($i); ?>" <?php selected( $instance['num_of_comments'], $i ); ?>><?php echo esc_html($i) ; ?></option>
				<?php
				}
				?>
			</select>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_avatar' ) ); ?>"><?php echo esc_html__( 'Show Avatar:', 'blade' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id('show_avatar') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_avatar') ); ?>" type="checkbox" value="1" <?php checked( $instance['show_avatar'], 1 ); ?> />
		</p>

	<?php
	}
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
