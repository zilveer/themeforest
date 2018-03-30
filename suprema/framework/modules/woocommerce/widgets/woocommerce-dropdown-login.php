<?php
class SupremaQodefWoocommerceDropdownLogin extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'qodef_woocommerce_dropdown_login', // Base ID
			'Select Woocommerce My Account Menu', // Name
			array( 'description' => esc_html__( 'Select Woocommerce My Account Menu', 'suprema' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		global $post;
		extract( $args );
		
		global $woocommerce; 
		global $suprema_qodef_options;
		
		
		?>
		<div class="qodef-drop-down qodef-login-widget-holder">
			<ul>
				<li>
					<?php
					if ( is_user_logged_in() ) { ?> 
						<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">
							<?php echo esc_html__('My Account', 'suprema'); ?>
						</a>
						<div class="qodef-account-dropdown second">
							<?php if ( has_nav_menu( 'myaccount-navigation' ) ) {
								wp_nav_menu(
									array(
										'theme_location' => 'myaccount-navigation' ,
										'container'  => '',
										'container_class' => '',
										'menu_class' => '',
										'menu_id' => '',
										'fallback_cb' => 'top_navigation_fallback',
										'link_before' => '<span>',
										'link_after' => '</span>'
									)
								);
							} ?>
						</div>
					<?php } else { ?>
						<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"><?php echo esc_html__('Login', 'suprema'); ?></a>
					<?php } ?>						
				</li>
			</ul>
		</div>
		<?php
	}

}
add_action( 'widgets_init', create_function( '', 'register_widget( "SupremaQodefWoocommerceDropdownLogin" );' ) );
?>
