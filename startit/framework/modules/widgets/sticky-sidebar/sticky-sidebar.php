<?php
class QodeStartitStickySidebar extends QodeStartitWidget {
	protected $params;
	public function __construct() {
		parent::__construct(
			'qodef_sticky_sidebar', // Base ID
			'Select Sticky Sidebar', // Name
			array( 'description' => esc_html__( 'Use this widget to make the sidebar sticky. Drag it into the sidebar above the widget which you want to be the first element in the sticky sidebar.', 'startit' ), ) // Args
		);
		$this->setParams();
	}
	protected function setParams() {
		
	}
	public function widget( $args, $instance ) {
		echo '<div class="widget qodef-widget-sticky-sidebar"></div>';
	}

}
add_action( 'widgets_init', create_function( '', 'register_widget( "QodeStartitStickySidebar" );' ) );
