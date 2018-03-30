<?php

/*
	CONTACT FORM WIDGET
*/

class Artbees_Widget_Login_Form extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'widget_login_form', 'description' => 'Ajax Login Form.' );
		WP_Widget::__construct( 'login_form', THEME_SLUG.' - '.'Login Form', $widget_ops );
	}



	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		$skin= $instance['skin'];

		echo $before_widget;

		if ( $title )
			echo $before_title . $title . $after_title;

		if ( !is_user_logged_in() ) {
?>

	<form class="mk-login-form <?php echo $skin; ?>-skin" action="login" method="post">
        <div class="form-row"><i class="mk-icon-user"></i><input id="username" type="text" name="username" placeholder="<?php _e( 'Username', 'mk_framework' ); ?>"></div>
        <div class="form-row"><i class="mk-icon-lock"></i><input id="password" type="password" name="password" placeholder="<?php _e( 'Password', 'mk_framework' ); ?>"></div>
        <input class="submit_button" type="submit" value="Login" name="submit">
        <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
        <p class="mk-login-status"></p>
    </form>

<?php
	} else {
	$current_user = wp_get_current_user();
	echo '<div class="user-login '.$skin.'">';
		echo get_avatar( $current_user->ID, 65 ); 
		echo '<ul class="">';
			echo '<li><span class="username">';		
			if (!empty($current_user->user_firstname) && !empty($current_user->user_lastname)) {
				echo $current_user->user_firstname . ' ' . $current_user->user_lastname;
			} else {
				echo $current_user->user_login;
			}
			echo '</li>';
			echo '<li>';
				$woo_my_account = get_option('woocommerce_myaccount_page_id');
				if(class_exists('woocommerce') && !empty($woo_my_account)) {
					$account_link = get_permalink( get_option('woocommerce_myaccount_page_id') );	
				} else {
					$account_link = get_edit_user_link();
				}
				echo '<a href="'.$account_link.'">';
					echo '<span>'.__('My Account', 'mk_framework').'</span>';
				echo '</a>';
			echo '</li>';
			echo '<li>';
				echo '<a href="'.wp_logout_url( get_permalink() ).'" class="logout">';
					echo '<span>'.__('Log Out', 'mk_framework').'</span>';
				echo '</a>';
			echo '</li>';
		echo '</ul>';
	echo '<div class="user-login">';
	}
		echo $after_widget;

	}




	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['skin'] = $new_instance['skin'];
		return $instance;
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$skin = isset( $instance['skin'] ) ? $instance['skin'] : 'dark';
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p><label for="<?php echo $this->get_field_id( 'skin' ); ?>">Skin</label>
		<select id="<?php echo $this->get_field_id( 'skin' ); ?>" name="<?php echo $this->get_field_name( 'skin' ); ?>">
			<option<?php if ( $skin == 'dark' ) echo ' selected="selected"'?> value="dark">Dark</option>
			<option<?php if ( $skin == 'light' ) echo ' selected="selected"'?> value="light">Light</option>
		</select>
		</p>

<?php

	}

}
/***************************************************/


