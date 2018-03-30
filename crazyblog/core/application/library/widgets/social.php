<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_social_Widget extends WP_Widget {

	function __construct() {
		parent::__construct( /* Base ID */'crazyblog-social-media', /* Name */ esc_html__( 'CrazyBlog Social Media', 'crazyblog' ), array( 'description' => esc_html__( 'This widget is used to show social media icons.', 'crazyblog' ) ) );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', crazyblog_set( $instance, 'title' ) );
		echo wp_kses( $before_widget, true );
		if ( $title )
			echo wp_kses( $before_title, true ) . html_entity_decode( $title ) . wp_kses( $after_title, true );
		$settings = crazyblog_opt();
		$social = crazyblog_set( crazyblog_set( $settings, 'crazyblog_social_icons' ), 'crazyblog_social_icons' );
		?>
		<?php if ( !empty( $social ) ) : ?>
			<div class="social-widget">
				<?php
				$counter = 0;
				array_pop( $social );
				foreach ( $social as $s ) :
					if ( crazyblog_set( $instance, 'number' ) == $counter )
						break;
					?>
					<a href="<?php echo esc_url( crazyblog_set( $s, 'link' ) ); ?>" title="" style="background:<?php echo esc_attr( crazyblog_set( $s, 'icon_color' ) ); ?>"><i class="<?php echo esc_attr( crazyblog_set( $s, 'icon' ) ); ?>"></i></a>
					<?php
					$counter++;
				endforeach;
				?>
			</div>
		<?php endif; ?>

		<?php
		echo wp_kses( $after_widget, true );
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = crazyblog_set( $new_instance, 'title' );
		$instance['number'] = crazyblog_set( $new_instance, 'number' );

		return $instance;
	}

	function form( $instance ) {
		$title = ($instance) ? esc_attr( crazyblog_set( $instance, 'title' ) ) : "social media";
		$number = ($instance) ? esc_attr( crazyblog_set( $instance, 'number' ) ) : "4";
		?>
		<p>    
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'crazyblog' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /> 
		</p>
		<p>    
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Show number of Social Icons:', 'crazyblog' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" /> 
		</p>


		<?php
	}

}
