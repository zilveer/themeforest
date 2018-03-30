<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_media_box_Widget extends WP_Widget {

	function __construct() {
		parent::__construct( /* Base ID */'crazyblog-media-box', /* Name */ esc_html__( 'CrazyBlog Media Box', 'crazyblog' ), array( 'description' => esc_html__( 'This widget is used to show social media.', 'crazyblog' ) ) );
	}

	public function widget( $args, $instance ) {

		extract( $args );
		$title = apply_filters( 'widget_title', crazyblog_set( $instance, 'title' ) );
		echo wp_kses( $before_widget, true );
		if ( $title )
			echo wp_kses( $before_title, true ) . html_entity_decode( $title ) . wp_kses( $after_title, true );
		$settings = crazyblog_opt();
		$social = crazyblog_set( crazyblog_set( $settings, 'crazyblog_social_icons' ), 'crazyblog_social_icons' );
		array_pop( $social );
		if ( !empty( $social ) && count( $social ) > 0 ) {
			echo '<div class="social-footer"><ul>';
			foreach ( $social as $s ) {
				echo '<li><a href="' . esc_url( crazyblog_set( $s, 'link' ) ) . '" title=""><i class="' . esc_attr( crazyblog_set( $s, 'icon' ) ) . '"></i></a></li>';
			}
			echo '</div></ul>';
		}
		echo wp_kses( $after_widget, true );
	}

	/* Store */

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}

	/* Settings */

	public function form( $instance ) {
		$title = crazyblog_set( $instance, 'title' );
		?>
		<p>    
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'crazyblog' ); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"><?php echo esc_attr( $title ); ?> </textarea>
		</p>
		<?php
	}

}
