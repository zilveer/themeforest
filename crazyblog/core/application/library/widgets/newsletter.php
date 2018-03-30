<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_newsletter_Widget extends WP_Widget {

	function __construct() {
		parent::__construct( /* Base ID */'crazyblog-newsletter', /* Name */ esc_html__( 'CrazyBlog Newsletter', 'crazyblog' ), array( 'description' => esc_html__( 'This widget is used to subscribe visitor to your site.', 'crazyblog' ) ) );
	}

	public function widget( $args, $instance ) {
		extract( $args );
		echo wp_kses( $before_widget, true );
		?>
		<div class="subscribe-widget">
			<div class="widget-notify"></div>
			<form id="widget-newsletter">
				<input type="text" class="subscribe-email" placeholder="<?php esc_html_e( "Subscribe Your Email", "crazyblog" ); ?>">
				<button type="submit" class="subscribe-submit"><i class="fa fa-envelope"></i></button>
			</form>
		</div>

		<?php
		echo wp_kses( $after_widget, true );
	}

	/* Store */

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		return $instance;
	}

	/* Settings */

	public function form( $instance ) {
		
	}

}
