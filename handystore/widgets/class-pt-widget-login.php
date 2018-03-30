<?php /* Plumtree AJAX Login/Register */

if ( ! defined( 'ABSPATH' ) ) exit;

class pt_login_widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'pt_login_widget', // Base ID
			__('PT Login/Register', 'plumtree'), // Name
			array('description' => __( "Plum Tree special widget. An AJAX Login/Register form for your site.", 'plumtree' ), )
		);
	}

	public function form($instance) {
		$defaults = array(
			'title' => 'Log In',
			'inline' => false,
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title: ', 'plumtree' ) ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
		<p>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("inline"); ?>" name="<?php echo $this->get_field_name("inline"); ?>" <?php checked( (bool) $instance["inline"] ); ?> />
			<label for="<?php echo $this->get_field_id("inline"); ?>"><?php _e( 'Show in line?', 'plumtree' ); ?></label>
		</p>
	<?php
	}

	public function update($new_instance, $old_instance) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['inline'] = $new_instance['inline'];

		return $instance;
	}

	public function widget($args, $instance) {
		extract($args);

		$title = apply_filters('widget_title', $instance['title'] );
		$inline = ( isset($instance['inline']) ? $instance['inline'] : false );

		echo $before_widget;
		if ($title) { echo $before_title . $title . $after_title; }
		?>

		<?php if ( is_user_logged_in() ) { ?>
			<?php if ($inline) { ?>
				<?php if ( class_exists('WooCommerce') ) : ?>
					<a class="login_button inline" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','plumtree'); ?>"><i class="fa fa-home"></i><?php _e('My Account','plumtree'); ?></a>
				<?php endif; ?>
				<a class="login_button inline" href="<?php echo wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ); ?>" title="<?php _e('Log out of this account', 'plumtree');?>"><i class="fa fa-sign-out"></i><?php _e('Log out', 'plumtree');?></a>
			<?php } else { ?>
				<p class="logged-in-as">
					<?php $current_user = wp_get_current_user(); ?>
					<?php printf( __( 'Hello <strong>%1$s</strong>.', 'plumtree' ),
						$current_user->display_name); ?>
				</p>
				<a class="login_button" href="<?php echo wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ); ?>" title="<?php _e('Log out of this account', 'plumtree');?>"><?php _e('Log out', 'plumtree');?><i class="fa fa-angle-right"></i></a>
				<?php if ( class_exists('WooCommerce') ) : ?>
					<a class="login_button" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','plumtree'); ?>"><?php _e('My Account','plumtree'); ?><i class="fa fa-angle-right"></i></a>
				<?php endif; ?>
			<?php } } else { ?>

			<form id="login" class="ajax-auth" method="post">
				<h3><?php _e('New to site? ', 'plumtree');?><a id="pop_signup" href=""><?php _e('Create an Account', 'plumtree');?></a></h3>
				<h1><?php _e('Login', 'plumtree');?></h1>
				<p class="status"></p>
				<?php wp_nonce_field('ajax-login-nonce', 'security'); ?>
				<p>
					<label for="username"><?php _e('Username', 'plumtree');?><span class="required">*</span></label>
					<input id="username" type="text" class="required" name="username">
				</p>
				<p>
					<label for="password"><?php _e('Password', 'plumtree');?><span class="required">*</span></label>
					<input id="password" type="password" class="required" name="password">
				</p>
				<a class="text-link" href="<?php echo wp_lostpassword_url(); ?>"><?php _e('Lost password?', 'plumtree');?></a>
				<input class="submit_button" type="submit" value="LOGIN">
				<a class="close" href=""><?php _e('(close)', 'plumtree');?></a>
			</form>

			<form id="register" class="ajax-auth" method="post">
				<h3><?php _e('Already have an account? ', 'plumtree');?><a id="pop_login"  href=""><?php _e('Login', 'plumtree');?></a></h3>
				<h1><?php _e('Signup', 'plumtree');?></h1>
				<p class="status"></p>
				<?php wp_nonce_field('ajax-register-nonce', 'signonsecurity'); ?>
				<p>
					<label for="signonname"><?php _e('Username', 'plumtree');?><span class="required">*</span></label>
					<input id="signonname" type="text" name="signonname" class="required">
				</p>
				<p>
					<label for="email"><?php _e('Email', 'plumtree');?><span class="required">*</span></label>
					<input id="email" type="text" class="required email" name="email">
				</p>
				<p>
					<label for="signonpassword"><?php _e('Password', 'plumtree');?><span class="required">*</span></label>
					<input id="signonpassword" type="password" class="required" name="signonpassword" >
				</p>
				<p>
					<label for="password2"><?php _e('Confirm Password', 'plumtree');?><span class="required">*</span></label>
					<input type="password" id="password2" class="required" name="password2">
				</p>
				<?php // Apply to become a vendor
				if ( class_exists('WC_Vendors') && class_exists( 'WooCommerce' ) ) :
					if ( WC_Vendors::$pv_options->get_option( 'show_vendor_registration' ) ) :
						$terms_page = WC_Vendors::$pv_options->get_option( 'terms_to_apply_page' ); ?>
						<br />
						<input class="input-checkbox" id="apply_for_vendor_widget" <?php checked( isset( $_POST[ 'apply_for_vendor_widget' ] ), true ) ?> type="checkbox" name="apply_for_vendor_widget" value="1"/>
						<label for="apply_for_vendor_widget">
							<?php echo apply_filters('wcvendors_vendor_registration_checkbox', __( 'Apply to become a vendor? ', 'plumtree' )); ?>
						</label>
					<?php if ( $terms_page && $terms_page !='' ) : ?>
						<p class="agree-to-terms" style="display:none">
							<input class="input-checkbox" id="agree_to_terms_widget" <?php checked( isset( $_POST[ 'agree_to_terms_widget' ] ), true ) ?> type="checkbox" name="agree_to_terms_widget" value="1"/>
							<label for="agree_to_terms_widget">
								<?php printf( __( 'I have read and accepted the <a target="_blank" href="%s">terms and conditions</a>', 'plumtree' ), get_permalink( $terms_page ) ); ?>
							</label>
						</p>
					<?php  endif; ?>
						<script type="text/javascript">
							jQuery(function () {
								if (jQuery('#apply_for_vendor_widget').is(':checked')) {
									jQuery('.agree-to-terms').show();
								}
								jQuery('#apply_for_vendor_widget').on('click', function () {
									jQuery('.agree-to-terms').slideToggle();
								});
							})
						</script>
					<?php endif; ?>
				<?php endif; ?>
				<input class="submit_button" type="submit" value="SIGNUP">
				<a class="close" href=""><?php _e('(close)', 'plumtree');?></a>
			</form>

			<?php if ($inline) { ?>
				<a class="login_button inline" id="show_login" href=""><i class="fa fa-user"></i><?php _e('Login', 'plumtree'); ?></a>
				<a class="login_button inline" id="show_signup" href=""><i class="fa fa-pencil"></i><?php _e('Register', 'plumtree'); ?></a>
			<?php } else { ?>
				<p class="welcome-msg">
					<?php _e( 'Welcome to our store!', 'plumtree' ); ?>
				</p>
				<a class="login_button" id="show_login" href=""><?php _e('Login', 'plumtree'); ?><i class="fa fa-angle-right"></i></a>
				<a class="login_button" id="show_signup" href=""><?php _e('Register', 'plumtree'); ?><i class="fa fa-angle-right"></i></a>

			<?php } } ?>

		<?php
		echo $after_widget;
	}

}

add_action( 'widgets_init', create_function( '', 'register_widget( "pt_login_widget");' ) );
