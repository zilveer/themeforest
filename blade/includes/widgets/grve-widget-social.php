<?php
/**
 * Plugin Name: Greatives Social Networking
 * Description: A widget that displays social networking links.
 * @author		Greatives Team
 * @URI			http://greatives.eu
 */

add_action( 'widgets_init', 'blade_grve_widget_social' );

function blade_grve_widget_social() {
	register_widget( 'Blade_GRVE_Widget_Social' );
}

class Blade_GRVE_Widget_Social extends WP_Widget {

	function __construct() {
		$widget_ops = array(
			'classname' => 'grve-element grve-social',
			'description' => esc_html__( 'A widget that displays social networking links', 'blade' ),
		);
		$control_ops = array(
			'width' => 400,
			'height' => 600,
			'id_base' => 'grve-widget-social',
		);
		parent::__construct( 'grve-widget-social', '(Greatives) ' . esc_html__( 'Social Networking', 'blade' ), $widget_ops, $control_ops );
	}

	function Blade_GRVE_Widget_Social() {
		$this->__construct();
	}

	function widget( $args, $instance ) {

		global $blade_grve_social_list_extended;

		//Our variables from the widget settings.
		extract( $args );

		echo $before_widget; // XSS OK

		// Display the widget title
		$title = apply_filters( 'widget_title', $instance['title'] );
		if ( $title ) {
			echo $before_title . esc_html( $title ) . $after_title; // XSS OK
		}

		$icon_size = blade_grve_array_value( $instance, 'icon_size', 'extrasmall' );
		$icon_shape = blade_grve_array_value( $instance, 'shape', 'square' );
		$shape_type = blade_grve_array_value( $instance, 'shape_type', 'outline' );

		$icon_color = blade_grve_array_value( $instance, 'icon_color', 'primary-1' );
		$shape_color = blade_grve_array_value( $instance, 'shape_color', 'black' );


		$social_shape_classes = array();
		$social_shape_classes[] = 'grve-' . $icon_size;
		$social_shape_classes[] = 'grve-' . $icon_shape;

		if ( 'no-shape' != $icon_shape ) {
			$social_shape_classes[] = 'grve-with-shape';
			$social_shape_classes[] = 'grve-' . $shape_type;
			if ( 'outline' != $shape_type ) {
				$social_shape_classes[] = 'grve-bg-' . $shape_color;
			} else {
				$social_shape_classes[] = 'grve-text-' . $shape_color;
				$social_shape_classes[] = 'grve-text-hover-' . $shape_color;
			}
		}

		$social_shape_class_string = implode( ' ', $social_shape_classes );

	?>

		<ul>
		<?php
		foreach ( $blade_grve_social_list_extended as $social_item ) {

			$social_item_url = blade_grve_array_value( $instance, $social_item['url'] );

			if ( ! empty( $social_item_url ) ) {

				if ( 'skype' == $social_item['id'] ) {
		?>
					<li>
						<a href="<?php echo esc_url( $social_item_url, array( 'skype', 'http', 'https' ) ); ?>" class="<?php echo esc_attr( $social_shape_class_string ); ?>">
							<i class="grve-text-<?php echo esc_attr( $icon_color ); ?> <?php echo esc_attr( $social_item['class'] ); ?>"></i>
						</a>
					</li>
		<?php
				} else {
		?>
					<li>
						<a href="<?php echo esc_url( $social_item_url ); ?>" class="<?php echo esc_attr( $social_shape_class_string ); ?>" target="_blank">
							<i class="grve-text-<?php echo esc_attr( $icon_color ); ?> <?php echo esc_attr( $social_item['class'] ); ?>"></i>
						</a>
					</li>
		<?php
				}
			}
		}
		?>
		</ul>


	<?php

		echo $after_widget; // XSS OK
	}

	//Update the widget

	function update( $new_instance, $old_instance ) {

		global $blade_grve_social_list_extended;
		$instance = $old_instance;

		//Strip tags from title to remove HTML
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['icon_size'] = strip_tags( $new_instance['icon_size'] );
		$instance['icon_color'] = strip_tags( $new_instance['icon_color'] );
		$instance['shape'] = strip_tags( $new_instance['shape'] );
		$instance['shape_type'] = strip_tags( $new_instance['shape_type'] );
		$instance['shape_color'] = strip_tags( $new_instance['shape_color'] );


		foreach ( $blade_grve_social_list_extended as $social_item ) {
			$instance[ $social_item['url'] ] = strip_tags( $new_instance[ $social_item['url'] ] );
		}


		return $instance;
	}

	function form( $instance ) {

		global $blade_grve_social_list_extended;

		//Set up some default widget settings.
		$defaults = array(
			'title' => '',
			'icon_size' => 'extrasmall',
			'icon_color' => 'primary-1',
			'shape' => 'square',
			'shape_type' => 'outline',
			'shape_color' => 'black',
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		$icon_size = blade_grve_array_value( $instance, 'icon_size');
		$icon_shape = blade_grve_array_value( $instance, 'shape');
		$icon_shape_type = blade_grve_array_value( $instance, 'shape_type');
		$icon_color = blade_grve_array_value( $instance, 'icon_color' );
		$shape_color = blade_grve_array_value( $instance, 'shape_color' );

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title:', 'blade' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'icon_size' ) ); ?>"><?php echo esc_html__( 'Icon Size:', 'blade' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'icon_size' ) ); ?>" style="width:100%;">
				<option value="large" <?php selected( "large", $icon_size ); ?>><?php echo esc_html__( 'Large', 'blade' ); ?></option>
				<option value="medium" <?php selected( "medium", $icon_size ); ?>><?php echo esc_html__( 'Medium', 'blade' ); ?></option>
				<option value="small" <?php selected( "small", $icon_size ); ?>><?php echo esc_html__( 'Small', 'blade' ); ?></option>
				<option value="extrasmall" <?php selected( "extrasmall", $icon_size ); ?>><?php echo esc_html__( 'Extra Small', 'blade' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'icon_color' ) ); ?>"><?php echo esc_html__( 'Icon Color:', 'blade' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'icon_color' ) ); ?>" style="width:100%;">
				<?php blade_grve_print_media_button_color_selection( $icon_color ); ?>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'shape' ) ); ?>"><?php echo esc_html__( 'Shape:', 'blade' ); ?></label>
			<select  name="<?php echo esc_attr( $this->get_field_name( 'shape' ) ); ?>" style="width:100%;">
				<option value="square" <?php selected( "square", $icon_shape ); ?>><?php echo esc_html__( 'Square', 'blade' ); ?></option>
				<option value="round" <?php selected( "round", $icon_shape ); ?>><?php echo esc_html__( 'Round', 'blade' ); ?></option>
				<option value="circle" <?php selected( "circle", $icon_shape ); ?>><?php echo esc_html__( 'Circle', 'blade' ); ?></option>
				<option value="no-shape" <?php selected( "no-shape", $icon_shape ); ?>><?php echo esc_html__( 'None', 'blade' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'shape_type' ) ); ?>"><?php echo esc_html__( 'Shape Type:', 'blade' ); ?></label>
			<select  name="<?php echo esc_attr( $this->get_field_name( 'shape_type' ) ); ?>" style="width:100%;">
				<?php blade_grve_print_media_button_type_selection( $icon_shape_type ); ?>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'shape_color' ) ); ?>"><?php echo esc_html__( 'Shape Color:', 'blade' ); ?></label>
			<select  name="<?php echo esc_attr( $this->get_field_name( 'shape_color' ) ); ?>" style="width:100%;">
				<?php blade_grve_print_media_button_color_selection( $shape_color ); ?>
			</select>
		</p>

		<p>
				<em><?php echo esc_html__( 'Note: Make sure you include the full URL (i.e. http://www.samplesite.com)', 'blade' ); ?></em>
				<br>
				 <?php echo esc_html__( 'If you do not want a social to be visible, simply delete the supplied URL.', 'blade' ); ?>
		</p>

		<?php
		foreach ( $blade_grve_social_list_extended as $social_item ) {

			$social_item_url = blade_grve_array_value( $instance, $social_item['url'] );
		?>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( $social_item['url'] ) ); ?>"><?php echo esc_html( $social_item['title'] ); ?>:</label>
					<input style="width: 100%;" id="<?php echo esc_attr( $this->get_field_id( $social_item['url'] ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $social_item['url'] ) ); ?>" value="<?php echo esc_attr( $social_item_url ); ?>" />
				</p>

		<?php
		}
		?>

	<?php
	}
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
