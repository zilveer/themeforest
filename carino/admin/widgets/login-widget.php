<?php

/**
  * Login Widget
  *
  * @author : VanThemes ( http://www.vanthemes.com )
  * 
  */

add_action( 'widgets_init', 'van_login_widget_init' );

function van_login_widget_init() {
	register_widget( 'van_login_widget' );
}

class van_login_widget extends WP_Widget {

	function van_login_widget() {
		$widget_ops = array( 'classname' => 'login-widget','description' => 'Login Widget' );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'login-widget' );
		$this->WP_Widget( 'login-widget','( '.THEME_NAME .' ) - Login', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args ); 

		$user = wp_get_current_user();

		$title     = ( $user->ID != 0 ) ?  __( 'Welcome ' , 'van' ) . $user->user_login : __("login","van");

		$matches = null;
		$id          = null;
		if( preg_match('/id="[a-zA-Z0-9-]+"/', $before_widget, $matches) ){
			$id = $matches[0];
		}
		?>
		<div <?php echo $id; ?>class="widget login-widget">
			<h3 class="widget-title"><?php echo $title; ?></h3>
			<div class="content widget-container">
				<?php van_login_form(); ?>
			</div>
		</div>
		<?php
	}
}