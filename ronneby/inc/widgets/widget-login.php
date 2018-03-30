<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
require_once(dirname(__FILE__).'/widget.php');

class crum_login_widget extends SB_WP_Widget {
	
	protected $widget_base_id = 'crum_login';
	protected $widget_name = 'Widget: Login';
	
	protected $options;
	
	function __construct() {
		$this->widget_params = array(
			'description' => __('Displays login form', 'dfd')
		);
		
		$this->options = array(
			array(
				'title', 'text', '', 
				'label' => __('Title', 'dfd'), 
				'input'=>'text', 
				'filters'=>'widget_title', 
				'on_update'=>'esc_attr',
			),

			array(
				'description', 'text', '', 
				'label' => __('Description', 'dfd'), 
				'input'=>'textarea', 
				'on_update'=>'esc_attr',
			),
/*
			array(
				'remember', 'text', '', 
				'label' => __('Hide "Remember me"', 'dfd'), 
				'input'=>'checkbox',
			),

			array(
				'lost_password', 'text', '', 
				'label' => __('Hide "Lost password"', 'dfd'), 
				'input'=>'checkbox',
			),*/
		);

		parent::__construct();
	}
	
	function widget($args, $instance) {
		extract( $args );
		$this->setInstances($instance, 'filter');
		
		$title = $this->getInstance('title');
		$description = $this->getInstance('description');
		//$hide_remember = $this->getInstance('remember');
		//$hide_lost_password = $this->getInstance('lost_password');
		
		$login_form_args = array(
			//'remember' => !(bool) $hide_remember,
			//'lost_password' => !(bool) $hide_lost_password,
			'label_log_in' => __('Login on site', 'dfd'),
			'label_lost_password' => __('Lost password', 'dfd'),
		);
		/*
		if (!$hide_lost_password) {
			add_filter('login_form_middle', array($this, 'lost_password'));
		}
		*/
		echo $before_widget;
		
        if ( ! empty( $title ) ) {
            echo $before_title . $title . $after_title;
		}
		
        if ( ! empty( $description ) ) {
            echo '<p>' . $description . '</p>';
		}
		
		if (is_user_logged_in()/* && false*/) {
			$this->logout_form();
		} else {
			$this->wp_login_form($login_form_args);
		}
		
		echo $after_widget;
	}
	
	function lost_password( $args ) {
		
		return '<p class="login-lost-password"><label>&nbsp;&nbsp;'
			. '<a href="' . wp_lostpassword_url() . '">'.__('I lost my password', 'dfd').'</a>'
			. '</label></p>';
	}
	
	function wp_login_form( $args = array() ) {
		$defaults = array(
			'redirect' => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], // Default redirect is back to the current page
			'form_id' => uniqid('loginform_'),
			'label_username' => __( 'Username', 'dfd' ),
			'placeholder_username' => __( 'Login', 'dfd' ),
			'label_password' => __( 'Password', 'dfd' ),
			'placeholder_password' => __( 'Password', 'dfd' ),
			'label_remember' => __( 'Remember Me', 'dfd' ),
			'label_lost_password' => __( 'Remind the password', 'dfd' ),
			'label_log_in' => __( 'Log In', 'dfd' ),
			'id_username' => uniqid('user_login_'),
			'id_password' => uniqid('user_pass_'),
			'id_remember' => uniqid('rememberme_'),
			'id_lost_password' => uniqid('rememberme_'),
			'id_submit' => uniqid('wp-submit_'),
			'remember' => true,
			'lost_password' => true,
			'value_username' => '',
			'value_remember' => false, // Set this to true to default the "Remember me" checkbox to checked
		);
		$args = wp_parse_args( $args, apply_filters( 'login_form_defaults', $defaults ) );

		$registration_link = '';

		if (get_option('users_can_register')) {
			$registration_link = '
				<a href="'.wp_registration_url() .'">'. __('Register', 'dfd') .'</a>
			';
		}

		$form = '
			<form name="' . $args['form_id'] . '" id="' . $args['form_id'] . '" action="' . esc_url( site_url( 'wp-login.php', 'login_post' ) ) . '" method="post">
				' . apply_filters( 'login_form_top', '', $args ) . '
				<p class="login-username">
					<label for="' . esc_attr( $args['id_username'] ) . '">' . esc_html( $args['label_username'] ) . '</label>
					<input type="text" name="log" id="' . esc_attr( $args['id_username'] ) . '" class="input" value="' . esc_attr( $args['value_username'] ) . '" size="20" placeholder="' . esc_html( $args['placeholder_username'] ) . '" />
				</p>
				<p class="login-password">
					<label for="' . esc_attr( $args['id_password'] ) . '">' . esc_html( $args['label_password'] ) . '</label>
					<input type="password" name="pwd" id="' . esc_attr( $args['id_password'] ) . '" class="input" value="" size="20" placeholder="' . esc_html( $args['placeholder_password'] ) . '"  />
				</p>
				<p class="login-submit">
					<button type="submit" name="wp-submit" id="' . esc_attr( $args['id_submit'] ) . '" class="button"><i class="outlinedicon-lock-closed"></i>' .esc_attr( $args['label_log_in'] ). '</button>
					<input type="hidden" name="redirect_to" value="' . esc_url( $args['redirect'] ) . '" />
				</p>
				'. ( $args['remember'] ? '<p class="login-remember"><label><input name="rememberme" type="checkbox" id="' . esc_attr( $args['id_remember'] ) . '" value="forever"' . ( $args['value_remember'] ? ' checked="checked"' : '' ) . ' /> ' . esc_html( $args['label_remember'] ) . '</label></p>' : '' )
				 . ( $args['lost_password'] ? '<p class="login-lost-password"><label>'
						. '<a href="' . wp_lostpassword_url() . '">' . $args['label_lost_password'] . '</a></label></p>' : '' )
				. '<p class="clear"></p><p class="login-registration">
					'. $registration_link .'
				</p>'
				.apply_filters( 'login_form_bottom', '', $args ) . '
			</form>';

		echo $form;
	}
	
	function logout_form() {
		echo '<p class="login-logout"><a class="button" href="'.wp_logout_url().'"><i class="outlinedicon-lock-open"></i>'.__('Logout','dfd').'</a></p>';
	}
	
}
