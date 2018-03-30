<?php if(! defined('ABSPATH')){ return; }


function zn_get_header_layout(){
	return apply_filters('zn_custom_header_style', zget_option( 'zn_header_layout' , 'general_options', false, 'style2' ));
}

function zn_check_components( $component ){

	if(isset($component) && !empty($component)){
		$topTextVal = zget_option( 'zn_head_s7_toptext', 'general_options', false, '' );
		// Header Components - V1
		if($component == 'search_box') return zget_option( 'head_show_search', 'general_options', false, 'yes' ) == 'yes' ? true : false;
		elseif($component == 'flags') return zget_option( 'head_show_flags', 'general_options', false, 1 ) == 1 ? true : false;
		elseif($component == 'login') return zget_option( 'head_show_login', 'general_options', false, 1 ) == 1 ? true : false;
		elseif($component == 'register') return zget_option( 'head_show_register', 'general_options', false, 2 ) == 1 ? true : false;
		elseif($component == 'custom_text') return !empty($topTextVal) ? true : false;
		elseif($component == 'hidden_panel') return zget_option( 'head_show_support_pnl', 'general_options', false, 'yes' ) == 'yes' ? true : false;
		elseif($component == 'social_icons') return zget_option( 'social_icons_visibility_status', 'general_options', false, 'yes' ) == 'yes' ? true : false;
		elseif($component == 'header_nav') return has_nav_menu( 'header_navigation' ) ? true : false;
		elseif($component == 'cta') return zget_option( 'head_show_cta', 'general_options', false, 'no' ) == 'yes' ? true : false;
		elseif($component == 'cart') return znfw_is_woocommerce_active() && zget_option( 'woo_show_cart', 'zn_woocommerce_options', false, 1 ) == 1 ? true : false;
		elseif($component == 'logo') return zn_get_layout_option( 'head_show_logo', 'general_options', false, 'yes' ) == 'yes' ? true : false;
		elseif($component == 'mainmenu') return has_nav_menu( 'main_navigation' ) ? true : false;

	}
}

/**
 * =======================================
 * HEADER COMPONENTS
 * =======================================
 */


/**
 * HEADER HIDDEN "SUPPORT" PANEL
 */

/**
 * Display the Hidden panel Sidebar
 */
if ( ! function_exists( 'zn_hidden_pannel' ) ) {
	/**
	 * Display the Hidden panel Sidebar
	 */
	function zn_hidden_pannel(){
		// Don't proceed if we don't need to show the hidden panel
		if ( zget_option( 'head_show_support_pnl', 'general_options', false, 'yes' ) == 'no' ){
			return false;
		}

		$close_btn = '<div class="support-panel-close js-toggle-class" data-targets="#sliding_panel,#open_sliding_panel" data-target-classes="is-opened,is-toggled" data-multiple-targets="">&times;</div>';

		$show_widgets = zget_option( 'hidden_panel_content_type', 'general_options', false, 'widget' ) === 'widget';
		if ( $show_widgets && is_active_sidebar( 'hiddenpannelsidebar' ) ) {
			?>
			<div class="support_panel support-panel" id="sliding_panel">
				<?php echo $close_btn; ?>
				<div class="container support-panel-container">
					<?php dynamic_sidebar( 'hiddenpannelsidebar' ); ?>
				</div>
			</div><!--// end #sliding_panel.support_panel -->
			<?php
		}
		else{
			$pb_template = zget_option( 'hidden_panel_pb_template', 'general_options');
			if( ! empty( $pb_template ) ){
				?>
				<div class="support_panel support-panel" id="sliding_panel">
					<?php echo $close_btn; ?>
					<?php
						$pb_data = get_post_meta( $pb_template, 'zn_page_builder_els', true );
						ZNPB()->zn_render_uneditable_content( $pb_data, $pb_template );
					?>
				</div><!--// end #sliding_panel.support_panel -->
				<?php
			}
		}
	}
}

/**
 * Add Right content to action
 */
if ( ! function_exists( 'zn_hidden_pannel_link' ) ) {
	/**
	 * Add Right content to action
	 * @hooked to zn_head_right_area
	 * @see functions.php
	 */
	function zn_hidden_pannel_link(){
		if ( is_active_sidebar( 'hiddenpannelsidebar' ) && zget_option( 'head_show_support_pnl', 'general_options', false, 'yes' ) == 'yes' ) {

			$title = zget_option( 'hidden_panel_title', 'general_options', false, __( 'SUPPORT', 'zn_framework' ) );

			?>
			<ul class="sh-component topnav navRight topnav--sliding-panel topnav-no-sc topnav-no-hdnav">
				<li class="topnav-li">
					<a href="#" id="open_sliding_panel" class="topnav-item open-sliding-panel js-toggle-class" data-target="#sliding_panel" data-target-class="is-opened">
						<i class="glyphicon glyphicon-remove-circle kl-icon-white"></i>
						<i class="glyphicon glyphicon-info-sign kl-icon-white visible-xs xs-icon"></i>
						<span class="hidden-xs"><?php echo $title; ?></span>
					</a>
				</li>
			</ul>
		<?php
		}
	}
}

/**
 * Add the Support Panel
 */
if ( ! function_exists( 'zn_add_hidden_panel' ) ) {
	/**
	 * Add the Support Panel
	 * @hooked to zn_after_body
	 * @see functions.php
	 */
	function zn_add_hidden_panel(){
		zn_hidden_pannel();
	}
}


/**
 * HEADER LOGIN / REGISTER FORMS
 */


/**
 * Display the LOGIN form
 */
if ( ! function_exists( 'zn_login_form_markup' ) ) {
	function zn_login_form_markup($current_url){
		?>
		<!-- Login/Register Modal forms - hidden by default to be opened through modal -->
			<div id="login_panel" class="loginbox-popup auth-popup mfp-hide">
				<div class="inner-container login-panel auth-popup-panel">
					<h3 class="m_title_ext auth-popup-title" <?php echo WpkPageHelper::zn_schema_markup('subtitle'); ?>><?php _e( "SIGN IN YOUR ACCOUNT TO HAVE ACCESS TO DIFFERENT FEATURES", 'zn_framework' ); ?></h3>
					<form id="login_form" name="login_form" method="post" class="zn_form_login" action="<?php echo site_url( 'wp-login.php', 'login_post' ) ?>">

						<div class="zn_form_login-result"></div>

						<div class="form-group kl-fancy-form">
							<input type="text" id="kl-username" name="log" class="form-control inputbox kl-fancy-form-input kl-fw-input"
								   placeholder="<?php _e( "eg: james_smith", 'zn_framework' ); ?>"/>
							<label class="kl-font-alt kl-fancy-form-label"><?php _e( "USERNAME", 'zn_framework' ); ?></label>
						</div>

						<div class="form-group kl-fancy-form">
							<input type="password" id="kl-password" name="pwd" class="form-control inputbox kl-fancy-form-input kl-fw-input"
								   placeholder="<?php _e( "type password", 'zn_framework' ); ?>"/>
							<label class="kl-font-alt kl-fancy-form-label"><?php _e( "PASSWORD", 'zn_framework' ); ?></label>
						</div>

						<?php do_action( 'login_form' ); ?>

						<label class="zn_remember auth-popup-remember" for="kl-rememberme">
							<input type="checkbox" name="rememberme" id="kl-rememberme" value="forever" class="auth-popup-remember-chb"/>
							<?php _e( " Remember Me", 'zn_framework' ); ?>
						</label>

						<input type="submit" id="login" name="submit_button" class="btn zn_sub_button btn-fullcolor btn-md"
							   value="<?php _e( "LOG IN", 'zn_framework' ); ?>"/>

						<input type="hidden" value="login" class="" name="zn_form_action"/>
						<input type="hidden" value="zn_do_login" class="" name="action"/>
						<input type="hidden" value="<?php echo $current_url; ?>" class="zn_login_redirect" name="submit"/>

						<div class="links auth-popup-links">
							<?php if ( (bool) get_option( 'users_can_register' ) && zget_option( 'head_show_register', 'general_options', false, 2 ) != 0 ) { ?>
							<a href="#register_panel" class="create_account auth-popup-createacc kl-login-box auth-popup-link"><?php _e( "CREATE AN ACCOUNT", 'zn_framework' ); ?></a> <span class="sep auth-popup-sep"></span>
							<?php } ?>
							<a href="#forgot_panel" class="kl-login-box auth-popup-link"><?php _e( "FORGOT YOUR PASSWORD?", 'zn_framework' ); ?></a>
						</div>
					</form>
				</div>
			</div>
		<!-- end login panel -->
		<?php
	}
}

/**
 * Display the REGISTER / SIGN UP form
 */
if ( ! function_exists( 'zn_register_form_markup' ) ) {
	function zn_register_form_markup($current_url){

		if ( (bool) get_option( 'users_can_register' ) ) {
		?>

		<div id="register_panel" class="loginbox-popup auth-popup register-popup mfp-hide">
			<div class="inner-container register-panel auth-popup-panel">
				<h3 class="m_title m_title_ext text-custom auth-popup-title" <?php echo WpkPageHelper::zn_schema_markup('subtitle'); ?>><?php _e( "CREATE ACCOUNT", 'zn_framework' ); ?></h3>

				<form id="register_form" name="login_form" method="post" class="zn_form_login" action="<?php echo wp_registration_url(); ?>">
					<div class="zn_form_login-result"></div>
					<div class="form-group kl-fancy-form ">
						<input type="text" id="reg-username" name="user_login" class="form-control inputbox kl-fancy-form-input kl-fw-input" placeholder="<?php _e( "type desired username", 'zn_framework' ); ?>"/>
						<label class="kl-font-alt kl-fancy-form-label"><?php _e( "USERNAME", 'zn_framework' ); ?></label>
					</div>
					<div class="form-group kl-fancy-form">
						<input type="text" id="reg-email" name="user_email" class="form-control inputbox kl-fancy-form-input kl-fw-input" placeholder="<?php _e( "your-email@website.com", 'zn_framework' ); ?>"/>
						<label class="kl-font-alt kl-fancy-form-label"><?php _e( "EMAIL", 'zn_framework' ); ?></label>
					</div>
						<div class="form-group kl-fancy-form">
						<input type="password" id="reg-pass" name="user_password" class="form-control inputbox kl-fancy-form-input kl-fw-input" placeholder="<?php _e( "*****", 'zn_framework' ); ?>"/>
						<label class="kl-font-alt kl-fancy-form-label"><?php _e( "PASSWORD", 'zn_framework' ); ?></label>
					</div>
					<div class="form-group kl-fancy-form">
						<input type="password" id="reg-pass2" name="user_password2" class="form-control inputbox kl-fancy-form-input kl-fw-input" placeholder="<?php _e( "*****", 'zn_framework' ); ?>"/>
						<label class="kl-font-alt kl-fancy-form-label"><?php _e( "CONFIRM PASSWORD", 'zn_framework' ); ?></label>
					</div>
					<div class="form-group">
						<input type="submit" id="signup" name="submit" class="btn zn_sub_button btn-block btn-fullcolor btn-md" value="<?php _e( "CREATE MY ACCOUNT", 'zn_framework' ); ?>"/>
					</div>

					<input type="hidden" value="register" name="zn_form_action"/>
					<input type="hidden" value="zn_do_login" name="action"/>
					<input type="hidden" value="<?php echo $current_url; ?>"
						   class="zn_login_redirect" name="submit"/>

					<div class="links auth-popup-links">
						<?php if ( zget_option( 'head_show_login', 'general_options', false, 1 ) != 0 ) { ?>
						<a href="#login_panel" class="kl-login-box auth-popup-link"><?php _e( "ALREADY HAVE AN ACCOUNT?", 'zn_framework' ); ?></a>
						<?php } ?>
					</div>
				</form>
			</div>
		</div><!-- end register panel -->
		<?php
		}
	}
}

/**
 * Display the FORGOT PASSWORD form
 */
if ( ! function_exists( 'zn_forgotpwd_form_markup' ) ) {
	function zn_forgotpwd_form_markup(){
		?>
		<div id="forgot_panel" class="loginbox-popup auth-popup forgot-popup mfp-hide">
			<div class="inner-container forgot-panel auth-popup-panel">
				<h3 class="m_title m_title_ext text-custom auth-popup-title" <?php echo WpkPageHelper::zn_schema_markup('subtitle'); ?>><?php _e( "FORGOT YOUR DETAILS?", 'zn_framework' ); ?></h3>
				<form id="forgot_form" name="login_form" method="post" class="zn_form_lost_pass" action="<?php echo wp_lostpassword_url(); ?>">
					<div class="zn_form_login-result"></div>
					<div class="form-group kl-fancy-form">
						<input type="text" id="forgot-email" name="user_login" class="form-control inputbox kl-fancy-form-input kl-fw-input" placeholder="<?php _e( "...", 'zn_framework' ); ?>"/>
						<label class="kl-font-alt kl-fancy-form-label"><?php _e( "USERNAME OR EMAIL", 'zn_framework' ); ?></label>
					</div>
					<input type="hidden" name="wc_reset_password" value="true">
					<?php wp_nonce_field( 'lost_password' ); ?>
					<div class="form-group">
						<input type="submit" id="recover" name="submit" class="btn btn-block zn_sub_button btn-fullcolor btn-md" value="<?php _e( "SEND MY DETAILS!", 'zn_framework' ); ?>"/>
					</div>
					<div class="links auth-popup-links">
						<a href="#login_panel" class="kl-login-box auth-popup-link"><?php _e( "AAH, WAIT, I REMEMBER NOW!", 'zn_framework' ); ?></a>
					</div>
				</form>
			</div>
		</div><!-- end forgot pwd. panel -->
		<?php
	}
}


/**
 * Login Form - Login/logout text
 */
if ( ! function_exists( 'zn_login_text' ) ) {
	/**
	 * Login Form - Login/logout text
	 * @hooked to zn_head_right_area
	 * @see functions.php
	 */
	function zn_login_text(){

		// CHECK IF OPTION IS ENABLED
		if ( zget_option( 'head_show_login', 'general_options', false, 1 ) == 1 ) {

			if ( is_user_logged_in() ) {

				echo '<ul class="sh-component topnav navRight topnav--log topnav-no-sc topnav-no-hdnav"><li class="topnav-li"><a class="topnav-item" href="' . wp_logout_url( home_url( '/' ) ) . '">';
				echo '<i class="glyphicon glyphicon-log-out visible-xs xs-icon"></i>';
				echo '<span class="hidden-xs">' . __( "LOGOUT", 'zn_framework' ) . '</span>';
				echo '</a></li></ul>';

				return;
			}
			echo '<ul class="sh-component topnav navRight topnav--log topnav-no-sc topnav-no-hdnav"><li class="topnav-li"><a href="#login_panel" class="kl-login-box topnav-item">';
			echo '<i class="glyphicon glyphicon-log-in visible-xs xs-icon"></i>';
			echo '<span class="hidden-xs">'. __( "LOGIN", 'zn_framework' ) . '</span>';
			echo '</a></li></ul>';

		}
	}
}

/**
 * Register Form - Register link
 */
if ( ! function_exists( 'zn_register_text' ) ) {
	/**
	 * Register Form - Register link
	 * @hooked to zn_head_right_area
	 * @see functions.php
	 */
	function zn_register_text(){

		// CHECK IF OPTION IS ENABLED
		if ( zget_option( 'head_show_register', 'general_options', false, 2 ) == 1 ) {

			if ( ! is_user_logged_in() && (bool) get_option( 'users_can_register' ) ) {
				echo '<ul class="sh-component topnav navRight topnav--reg topnav-no-sc topnav-no-hdnav"><li class="topnav-li"><a href="#register_panel" class="kl-login-box topnav-item">';
				echo '<i class="glyphicon glyphicon-user visible-xs xs-icon"></i>';
				echo '<span class="hidden-xs">'. __( "SIGN UP", 'zn_framework' ) . '</span>';
				echo '</a></li></ul>';
			}

		}
	}
}


/**
 * Display the login form
 */
if ( ! function_exists( 'zn_login_form' ) ) {
	/**
	 * Display the login form
	 */
	function zn_login_form(){
		//@since v4.0.12
		global $wp;
		$current_url = apply_filters( 'kallyas_login_redirect_url', home_url( $wp->request ) );

		if ( ! is_user_logged_in() ) {
			echo '<div class="login_register_stuff">';

				if ( ! is_user_logged_in() && zget_option( 'head_show_login', 'general_options', false, 1 ) != 0 ) {
					zn_login_form_markup($current_url);
					zn_forgotpwd_form_markup();
				}
				if ( ! is_user_logged_in() && zget_option( 'head_show_register', 'general_options', false, 1 ) != 0 ) {
					zn_register_form_markup($current_url);
				}

			echo '</div><!-- end login register stuff -->';
		}

	}
}


/**
 * Display the login form
 */
if ( ! function_exists( 'zn_add_login_form' ) ) {
	/**
	 * Display the login form
	 * @hooked to zn_after_body
	 * @see functions.php
	 */
	function zn_add_login_form(){
		zn_login_form();
	}
}


/**
 * HEADER NAVIGATION
 */

if ( ! function_exists( 'zn_add_navigation' ) ) {
	/**
	 * Add navigation menu to the Top Area
	 * @hooked to zn_head_right_area
	 * @see functions.php
	 */
	function zn_add_navigation(){
		if ( has_nav_menu( 'header_navigation' ) ) {
			$header_topnav_dd = zget_option( 'header_topnav_dd' , 'general_options', false, 'yes' );
			if( $header_topnav_dd == 'yes' ) {
				echo '<div class="sh-component zn_header_top_nav-wrapper ">';
					echo '<span class="headernav-trigger js-toggle-class" data-target=".zn_header_top_nav-wrapper" data-target-class="is-opened"></span>';
					zn_show_nav( 'header_navigation', 'zn_header_top_nav topnav topnav-no-sc clearfix' );
				echo '</div>';
			} else {
				zn_show_nav( 'header_navigation', ' topnav topnav-no-sc' );
			}
		}
	}
}



/**
 * HEADER SOCIAL ICONS
 */

if ( ! function_exists( 'zn_header_social_icons' ) ) {
	/**
	 * Show header social icons
	 * @hooked to zn_head_right_area
	 * @see functions.php
	 */
	function zn_header_social_icons(){

		if(zn_check_components('social_icons'))
		{
			if ( $header_social_icons = zget_option( 'header_social_icons', 'general_options', false, array() ) )
			{

				$icon_class = zget_option( 'header_which_icons_set', 'general_options', false, 'normal' );

				echo '<ul class="sh-component social-icons sc--' . $icon_class . ' topnav navRight topnav-no-hdnav">';

				foreach ( $header_social_icons as $key => $icon ) {
					// print_r($icon);
					$link = '';
					$target = '';
					if ( isset ( $icon['header_social_link'] ) && is_array( $icon['header_social_link'] ) ) {
						$link = $icon['header_social_link']['url'];
						$target = 'target="' . $icon['header_social_link']['target'] . '"';
					}
					$icon_color = '';
					if($icon_class != 'normal' && $icon_class != 'clean'){
						$icon_color = isset($icon['header_social_color']) && !empty($icon['header_social_color']) ? $icon['header_social_icon']['unicode'] : 'nocolor';
					}
					$social_icon = !empty( $icon['header_social_icon'] )  ? '<a href="' . $link . '" '.zn_generate_icon( $icon['header_social_icon'] ).' ' . $target . ' class="topnav-item social-icons-item scheader-icon-'.$icon_color.'" title="' . $icon['header_social_title'] . '"></a>' : '';
					echo '<li class="topnav-li social-icons-li">'.$social_icon.'</li>';
					// echo '<li><a href="' . $link . '" class="sc-icon-' . str_replace('social-', '', $icon['header_social_icon']) . '" ' . $target . ' title="' . $icon['header_social_title'] . '"></a></li>';
				}
				echo '</ul>';
			}
		}
	}
}


/**
 * HEADER LOGO
 */

if ( ! function_exists( 'zn_kl_logo' ) ) {
	function zn_kl_logo( $logo = null , $use_transparent = false , $tag = null , $class = null ) {

		if ( !$tag ) {
			if ( is_front_page() ) {
				$tag = 'h1';
			}
			else{
				$tag = 'h3';
			}
		}

		// Apply filter if you want a custom logo tag.
		$tag = apply_filters('zn_logo_tag', $tag);

		if ( $logo || $logo = zn_get_layout_option( 'logo_upload', 'general_options' ) ) {
			$hwstring = '';
			// Check if logo size has Custom size
			if( ( $logo_size = zn_get_layout_option( 'logo_size', 'general_options' ) ) == 'no' ){
				$logo_size = zget_option( 'logo_manual_size', 'general_options' );
				$hwstring = image_hwstring( $logo_size['width'], $logo_size['height'] );
			}
			$logoimg = '';
			// Sticky logom only when available and Sticky Header is selected in MenuFollow option (General options)
			if($logoSticky = zget_option('logo_sticky', 'general_options')){
				if ( zn_get_layout_option( 'menu_follow', 'general_options' , false, 'no' ) == 'sticky' ) {
					$logoimg .= '<img class="logo-img-sticky site-logo-img-sticky" src="'.set_url_scheme( $logoSticky ).'"  alt="'.get_bloginfo('name').'" title="'.get_bloginfo('description').'" />';
				}
			}

			// Mobile logo
			$logo_upload_mobile = zget_option('logo_upload_mobile', 'general_options');
			$mobile_logo = $logo_upload_mobile ? 'data-mobile-logo="'. esc_attr($logo_upload_mobile) .'"':'';

			// Logo
			$logoimg .= '<img class="logo-img site-logo-img" src="'.set_url_scheme( $logo ).'" '.$hwstring.' alt="'.get_bloginfo('name').'" title="'.get_bloginfo('description').'" '. $mobile_logo .' />';
			$logo = "<$tag class='site-logo logo $class' id='logo'><a href='".home_url('/')."' class='site-logo-anch'>".$logoimg."</a></$tag>";
		}
		else{
			// THIS IS JUST FOR TEXT
			$logo = '<'.$tag.' id="logo" class="site-logo logo"><a href="' . esc_url( home_url( '/' ) ) . '" class="site-logo-anch">' . get_bloginfo( 'name' ) . '</a></'.$tag.'>';
		}
		return $logo;
	}
}


if ( ! function_exists( 'zn_header_display_logo' ) ) {
	/**
	* Function to display the logo markup in header
	* @return html
	* @since  4.0.10
	*/
	function zn_header_display_logo(){

		if( zn_get_layout_option( 'head_show_logo', 'general_options', false, 'yes' ) == 'no' ){ return; }

		$hasInfoCard = zget_option( 'infocard_display_status', 'general_options', false, 'no' ) == 'yes' ? 'hasInfoCard' : '';
		?>
		<div id="logo-container" class="logo-container <?php echo $hasInfoCard; ?> logosize--<?php echo zget_option( 'logo_size', 'general_options', false, 'yes' ); ?>">
			<!-- Logo -->
			<?php
				echo zn_kl_logo();
			?>
			<!-- InfoCard -->
			<?php do_action( 'zn_show_infocard' ); ?>
		</div>

		<?php

	}
}


/**
 * LOGO - INFO CARD
 * Display the Info Card when you hover over the logo.
 * This function is also available as an action: zn_show_infocard
 */
if ( ! function_exists( 'kfn_showInfoCard' ) ) {
	/**
	 * Display the Info Card when you hover over the logo.
	 * This function is also available as an action: zn_show_infocard
	 * @hooked to zn_show_infocard
	 * @see functions.php
	 */
	function kfn_showInfoCard(){
		global $get_stylesheet_directory_uri;

		if ( zget_option( 'infocard_display_status', 'general_options', false, 'no' ) == 'no' ) {
			return;
		}
		$logoUrl        = zget_option( 'infocard_logo_url', 'general_options' );
		$cpyDesc        = zget_option( 'infocard_company_description', 'general_options', false, '' );
		$phone          = zget_option( 'infocard_company_phone', 'general_options', false, '' );
		$email          = zget_option( 'infocard_company_email', 'general_options', false, '' );
		$cpyName          = zget_option( 'infocard_company_name', 'general_options', false, '' );
		$address          = zget_option( 'infocard_company_address', 'general_options', false, '' );
		$mapLink          = zget_option( 'infocard_gmap_link', 'general_options', false, '' );
		$socialIcons          = zget_option( 'header_social_icons', 'general_options', false, null );

		?>

		<div id="infocard" class="logo-infocard">
			<div class="custom ">
				<div class="row">
					<div class="col-sm-5">
						<div class="infocard-wrapper text-center">
							<?php if( !empty( $logoUrl ) ): ?>
								<p><img src="<?php echo $logoUrl;?>" alt="<?php echo get_bloginfo('name'); ?>"></p>
							<?php endif; ?>
							<?php if( !empty($cpyDesc) ): ?>
								<p><?php echo $cpyDesc;?></p>
							<?php endif; ?>
						</div>
					</div>

					<div class="col-sm-7">
						<div class="custom contact-details">

							<?php if( !empty($phone) && !empty($email) ): ?>
							<p>
								<?php if(!empty($phone)): ?>
									<strong><?php echo $phone;?></strong><br>
								<?php endif; ?>

								<?php if(!empty($email)): ?>
									<?php _e( 'Email:', 'zn_framework' );?>&nbsp;<a href="mailto:<?php echo $email;?>"><?php echo $email;?></a>
								<?php endif; ?>
							</p>
							<?php endif; ?>

							<?php if( !empty($cpyName) && !empty($address) ): ?>
								<p>
								<?php
									echo !empty($cpyName) ? $cpyName . '<br/>' : '';
									echo $address;
								?>
								</p>
							<?php endif; ?>

							<?php if(!empty($mapLink)): ?>
								<a href="<?php echo $mapLink;?>" target="_blank" class="map-link">
									<span class="glyphicon glyphicon-map-marker kl-icon-white"></span>
									<span><?php _e( 'Open in Google Maps', 'zn_framework' );?></span>
								</a>
							<?php endif; ?>

						</div>

						<div style="height:20px;"></div>

						<?php
						if ( ! empty( $socialIcons ) ) {
							echo '<ul class="social-icons sc--clean">';
							foreach ( $socialIcons as $i => $entry ) {
								$titleAttr  = esc_attr( $entry['header_social_title'] );
								$url        = $entry['header_social_link']['url'];
								$targetAttr = esc_attr( $entry['header_social_link']['target'] );
								$icon       = $entry['header_social_icon'];
								$social_icon = '<a href="' . $url . '" '.zn_generate_icon( $icon ).' target="' . $targetAttr . '" title="' . $titleAttr . '"></a>';
								echo '<li class="social-icons-li">'.$social_icon.'</li>';
							}
							echo '</ul>';
						}
						?>
					</div>
				</div>
			</div>
		</div>
	<?php }
}


/**
 * HEADER - CALL TO ACTION BUTTON
 */

if ( ! function_exists( 'zn_header_calltoaction' ) ) {
	/**
	* Function to display the call to action button markup in header
	* @return html
	* @since  4.0.10
	*/
	function zn_header_calltoaction(){

		$head_show_cta = zget_option( 'head_show_cta', 'general_options', false, 'no' );

		if ( $head_show_cta == 'yes' ) {

			$calltoaction_style = zget_option( 'head_show_cta_style', 'general_options', false, 'ribbon' );

			if( $calltoaction_style == 'ribbon' || $calltoaction_style == 'lined' ){

				// Form button classes
				$btn_classes = array();
				$btn_classes[] = 'sh-component ctabutton';
				$cta_link_class = $calltoaction_style == 'lined' ? 'lined btn btn-lined' : 'ribbon';
				$btn_classes[] = 'kl-cta-'.$cta_link_class;
				$btn_classes[] = zget_option( 'cta_hide_xs', 'general_options', false, '' ) == 1 ? 'hidden-xs' : '';

				// Get button link, create link markup
				$head_add_cta_link = zget_option( 'head_add_cta_link', 'general_options' );

				$cta_link_ext = zn_extract_link(
					$head_add_cta_link,
					implode(' ', $btn_classes),
					' id="ctabutton" ',
					'<span id="ctabutton" class="'. implode(' ', $btn_classes) .'">',
					'</span>'
				);

				// show button
				if ( $head_set_text_cta = zget_option( 'head_set_text_cta', 'general_options' ) ) {
					echo $cta_link_ext['start'];
					echo $head_set_text_cta;
					// Show bottom triangle for Ribbon type button
					if( $calltoaction_style == 'ribbon') {
						echo '<svg version="1.1" class="trisvg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" preserveAspectRatio="none" width="14px" height="5px" viewBox="0 0 14.017 5.006" enable-background="new 0 0 14.017 5.006" xml:space="preserve"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.016,0L7.008,5.006L0,0H14.016z"></path></svg>';
					}
					echo $cta_link_ext['end'];
				}
			}
			else if($calltoaction_style == 'custom'){

				$btn_custom = zget_option( 'cta_custom', 'general_options', false, false );

				if( isset($btn_custom) && !empty($btn_custom) ):
					foreach($btn_custom as $i => $btn):

						//Class
						$classes = array();
						$classes[] = 'sh-component ctabutton cta-button-'.$i.' kl-cta-custom btn';
						$classes[] = $btn['cta_style'];
						$classes[] = $btn['cta_size'];
						$classes[] = $btn['cta_hide_xs'];
						$classes[] = 'cta-icon--'.$btn['cta_icon_pos'];
						$classes[] = $btn['cta_corners'];

						// Icon
						$icon = isset($btn['cta_icon_enable']) && $btn['cta_icon_enable'] == 1 ? '<span '.zn_generate_icon( $btn['cta_icon'] ).'></span>':'';

						if( isset($btn['cta_text']) && !empty($btn['cta_text']) ){

							$text = '<span>'.$btn['cta_text'].'</span>';

							// Icon position
							if( $btn['cta_icon_pos'] == 'before' ){
								$text = $icon.$text;
							} else{
								$text = $text.$icon;
							}

							$cta_link_ext = zn_extract_link( $btn['cta_link'], implode(' ', $classes) );

							echo $cta_link_ext['start'] . $text . $cta_link_ext['end'];
						}

					endforeach;
				endif;

			}
		}
	}
}


/**
 * HEADER - MAIN MENU NAVIGATION
 */

/**
 * Function to switch main menu's active item style
 * @return string
 */
function zn_mainmenu_active_text(){
	return zn_header_main_menu('active-text');
}

/**
 * Function to switch main menu's - parent menu items style
 * @return string
 */
function zn_mainmenu_pointer_arr(){
	return 'mainnav--pointer-arr';
}
/**
 * Function to switch main menu's - parent menu items style
 * @return string
 */
function zn_mainmenu_pointer_none(){
	return 'mainnav--pointer-none';
}

if ( ! function_exists( 'zn_resmenu_wrapper' ) ) {
	/**
	* Function to display the main menu responsive markup
	* @return html
	* @since  4.1.1
	*/
	function zn_resmenu_wrapper(){
		?>
		<div class="zn-res-menuwrapper">
			<a href="#" class="zn-res-trigger zn-header-icon"></a>
		</div><!-- end responsive menu -->
		<?php
	}
}

if ( ! function_exists( 'zn_header_main_menu' ) ) {
	/**
	* Function to display the main menu markup in header
	* @return html
	* @since  4.0.10
	*/
	function zn_header_main_menu( $mm_style = 'active-bg' ){

		if(!zn_check_components('mainmenu')) return;

		$mm_style = !empty($mm_style) ? $mm_style : 'active-bg';

		// TODO: Add new option to disable main menu for Kallyas
		// In case users want to add their own custom menu (or mega-menu)plugin
		?>
		<div class="sh-component main-menu-wrapper" <?php echo WpkPageHelper::zn_schema_markup('nav'); ?>>

			<?php
			// Load responsive trigger button
			zn_resmenu_wrapper();

			$classes = array();

			// Mainmenu 1st level active item style
			$menu_style = zget_option('menu_style', 'general_options', false, '');
			if($menu_style == ''){
				$menu_style = $mm_style;
			}
			$classes[] = 'mainnav--' . $menu_style;

			// 1st level submenu pointer
			$classes[] = apply_filters( 'kallyas_mainmenu_pointer_style', 'mainnav--pointer-dash' );
			// Main Menu dropdown color scheme
			$classes[] = 'nav-mm--'.( zget_option( 'navmain_color_theme', 'general_options', false, '' ) == '' ? zget_option( 'zn_main_style', 'color_options', false, 'light' ) : zget_option( 'navmain_color_theme', 'general_options', false, '' ) );

			$args = array(
				'container' => 'div',
				'container_id' => 'main-menu',
				'container_class' => 'main-nav '.implode(' ', $classes),
				'walker' => 'znmegamenu',
				'link_before' => '<span>',
				'link_after' => '</span>',
			);
			zn_show_nav( 'main_navigation','main-menu main-menu-nav', $args );

			?>
		</div>
		<!-- end main_menu -->
		<?php
	}
}


/**
 * HEADER - SEARCH BOX
 */

if ( ! function_exists( 'zn_header_searchbox' ) ) {
	/**
	* Function to display the search box markup in header
	* @return html
	* @since  4.0.10
	*/
	function zn_header_searchbox( $sb_style = 'def' ){

		if ( zget_option( 'head_show_search', 'general_options', false, 'yes' ) == 'yes' ) {

			$search_style = zget_option('head_search_style', 'general_options', false, '');
			if($search_style == ''){
				$search_style = $sb_style;
			}

		?>

		<div id="search" class="sh-component header-search headsearch--<?php echo $search_style; ?>">

			<a href="#" class="searchBtn header-search-button">
				<span class="glyphicon glyphicon-search kl-icon-white"></span>
			</a>

			<div class="search-container header-search-container">
				<?php get_search_form(); ?>
			</div>
		</div>

		<?php
		}
	}
}
/**
 * Force default style for SearchBox component
 */
// Default
if(!function_exists('zn_header_searchbox_def')){
	function zn_header_searchbox_def(){
		zn_header_searchbox('def');
	}
}
// Input Layout
if(!function_exists('zn_header_searchbox_inp')){
	function zn_header_searchbox_inp(){
		zn_header_searchbox('inp');
	}
}
// Bordered layout
if(!function_exists('zn_header_searchbox_bord')){
	function zn_header_searchbox_bord(){
		zn_header_searchbox('bord');
	}
}
// Minimal layout
if(!function_exists('zn_header_searchbox_min')){
	function zn_header_searchbox_min(){
		zn_header_searchbox('min');
	}
}


/**
 * HEADER - CUSTOM TEXT
 */

if(!function_exists('zn_header_head_text')){
	/**
	 * Function to display Header text defined in header options
	 */
	function zn_header_head_text(){
		if ( $zn_head_s7_toptext = zget_option( 'zn_head_s7_toptext', 'general_options' ) ) {
			echo '<div class="sh-component kl-header-toptext kl-font-alt">' . do_shortcode( $zn_head_s7_toptext ) . '</div>';
		}
	}
}


/**
 * HEADER SEPARATOR
 */

if(!function_exists('zn_header_separator')){
	/**
	 * Function to display Header separator
	 */
	function zn_header_separator( $custom_class = '' ){
		echo '<div class="separator site-header-separator '.$custom_class.'"></div>';
	}
}

if(!function_exists('zn_header_separator_xs')){
	/**
	 * Extend separator, display visible-xs class to be shown only on small viewports
	 */
	function zn_header_separator_xs(){
		zn_header_separator('visible-xs');
	}
}


/**
 * HEADER GRADIENT BG
 */

if(!function_exists('zn_header_gradient_bg')){
	/**
	 * Function to display Header gradient background
	 */
	function zn_header_gradient_bg($custom_class = ''){
		echo '<div class="kl-header-bg '.$custom_class.'"></div>';

	}
}


/**
 * HEADER - LANGUAGE SWITCHER (WPML)
 */

if ( ! function_exists( 'zn_wpml_language_switcher' ) ) {
	/**
	 * WPML language switcher
	 * @hooked to zn_head_right_area
	 * @see functions.php
	 */
	function zn_wpml_language_switcher( $lg_style = 'def' ){

		$lg_style = !empty($lg_style) ? $lg_style : 'def';

		$languages = array();

		if( function_exists('zn_language_demo_data') ){
			// For demo displaying flags
			$languages = zn_language_demo_data();
		}
		else if ( defined( 'ICL_SITEPRESS_VERSION' ) ) {

			if( ICL_SITEPRESS_VERSION < '3.2' ){
				$languages = icl_get_languages( 'skip_missing=0' );
			}
			else{
				$languages = apply_filters( 'wpml_active_languages', NULL, 'skip_missing=0' );
			}
		}
		else {
			return;
		}

		if ( zget_option( 'head_show_flags', 'general_options', false, 1 ) && !empty($languages) ) {

			$lang_style = zget_option('head_flags_style', 'general_options', false, '');

			if($lang_style == ''){
				$lang_style = $lg_style;
			}

			echo '<ul class="sh-component topnav navLeft topnav--lang topnav-no-sc topnav-no-hdnav toplang--'.$lang_style.'">';

			// Just flags
			if($lang_style == 'flags'){
				if ( 1 < count( $languages ) ) {
					foreach ( $languages as $l ) {
						echo '<li class="languages topnav-li '.($l['active'] ? 'active' : '').'">';
							echo '<a href="' . $l['url'] . '" class="topnav-item">';
							echo '<img src="' . $l['country_flag_url'] . '" alt="' . $l['native_name'] . '" class="toplang-flag" />';
							echo '</a>';
						echo '</li>';
					}
				}
			}

			// Style default or alternative
			if( $lang_style == 'def' || $lang_style == 'alt') {

				echo '<li class="languages drop topnav-drop topnav-li">';

					echo '<a href="#" class="topnav-item">';
						// DEFAULT STYLE
						if( $lang_style == 'def' ) {
							echo '<i class="glyphicon glyphicon-globe kl-icon-white xs-icon"></i> ';
							echo '<span class="hidden-xs">'. __( "LANGUAGES", 'zn_framework' ) . '</span>';
						}
						// ALTERNATIVE STYLE
						else if( $lang_style == 'alt' ) {
							if ( 1 < count( $languages ) ) {
								foreach ( $languages as $l ) {
									if ( $l['active'] ) {
										echo '<span class="toplang-flag-wrapper"><img src="' . $l['country_flag_url'] . '" alt="' . $l['native_name'] . '" class="toplang-flag" /></span>';
										echo '<span class="toplang-flag-code">'. $l['code'] . '</span>';
										echo '<i class="glyphicon glyphicon-menu-down kl-icon-white"></i> ';
									}
								}
							}
						}
					echo '</a>';

					echo '<div class="pPanel topnav-drop-panel u-trans-all-2s">';
					echo '<ul class="inner topnav-drop-panel-inner">';

				if ( 1 < count( $languages ) ) {
					foreach ( $languages as $l ) {
						$active = '';
						$icon = '</a></li>';

						$litem = '<li class="toplang-item ' . $active . '"><a href="' . $l['url'] . '" class="toplang-anchor"><img src="' . $l['country_flag_url'] . '" alt="' . $l['native_name'] . '" class="toplang-flag" /> '. $l['native_name'] . ' ' . $icon . '';

						// Default
						if ( $lang_style == 'def' ) {
							if($l['active']){
								$active = 'active';
								$icon = '<span class="glyphicon glyphicon-ok"></span></a></li>';
							}
							echo $litem;
						}
						// Alternative
						if ( $lang_style == 'alt' ) {
							if(!$l['active']){
								echo $litem;
							}
						}

					}
				}
					echo '</ul>';
					echo '</div>';
				echo '</li>';
			}

			echo '</ul>';
		}
	}
}
/**
 * Force styles for Language switcher component
 */
// Default
if(!function_exists('zn_wpml_language_switcher_def')){
	function zn_wpml_language_switcher_def(){
		zn_wpml_language_switcher('def');
	}
}
// Input Layout
if(!function_exists('zn_wpml_language_switcher_alt')){
	function zn_wpml_language_switcher_alt(){
		zn_wpml_language_switcher('alt');
	}
}
// Bordered layout
if(!function_exists('zn_wpml_language_switcher_flags')){
	function zn_wpml_language_switcher_flags(){
		zn_wpml_language_switcher('flags');
	}
}

/**
 * Return zn_woocommerce_cart function
 * Just check the function to see if it exists
 */
function zn_woocomerce_cart_init(){
	if(function_exists('zn_woocomerce_cart')){
		return zn_woocomerce_cart();
	}
}


/**
 * =======================================
 * HEADER HELPERS
 * =======================================
 */


/**
 * Used for Site header flexbox scheme
 * @param  aray $f get flexbox scheme
 * @param  string $x horizontal
 * @param  string $y vertical
 * @return string All classes with spaces between
 */
function zn_getFlexboxScheme($f, $x, $y){
	$alignment_x = isset($f[$x][$y]['alignment_x']) && !empty($f[$x][$y]['alignment_x']) ? $f[$x][$y]['alignment_x'] : '';
	$alignment_y = isset($f[$x][$y]['alignment_y']) && !empty($f[$x][$y]['alignment_y']) ? $f[$x][$y]['alignment_y'] : '';
	$stretch = isset($f[$x][$y]['stretch']) && !empty($f[$x][$y]['stretch']) ? $f[$x][$y]['stretch'] : '';
	echo implode(' ', array($alignment_x, $alignment_y, $stretch));
}

/**
 * Function to determine wether to resize the header when "sticked" mode;
 * To disable, override in child theme with return false;
 */
if(!function_exists('zn_resize_sticky_header')){
	function zn_resize_sticky_header(){
		return true;
	}
}

/**
 * Header Custom Height
 * @return array list of all header schemes
 */
function zn_header_height_general(){

	$classic_headers = array(
		'logo' => '100',
		'top' => '54',
		'main' => '46',
		'bottom' => '0',
		'others' => '0'
	);

	// Height Scheme
	$zn_header_height_scheme = array(

		// Example:
		// 'style_name' => array(
		//  'logo' => '100',    // Logo Height (For classic headers only)
		//  'top' => '54',      // Top Height
		//  'main' => '46',     // Main Height
		//  'bottom' => '0',    // Bottom Height
		//  'others' => '0'     // Others Height (separators etc.)
		// ),

		'style1' => $classic_headers,
		'style2' => $classic_headers,
		'style3' => $classic_headers,
		'style4' => $classic_headers,
		'style5' => $classic_headers,
		'style6' => $classic_headers,

		'style7' => array(
			'top' => '46',
			'main' => '70',
			'bottom' => '0',
			'others' => '7'
		),
		'style8' => array(
			'top' => '0',
			'main' => '80',
			'bottom' => '42',
			'others' => '3' // bottom border
		),
		'style9' => array(
			'top' => '36',
			'main' => '64',
			'bottom' => '46',
			'others' => '14' // 2 x separators
		)
	);

	$zn_header_height_scheme = apply_filters('zn_header_height_indv', $zn_header_height_scheme );

	return $zn_header_height_scheme;
}

/**
 * Add height scheme for Header style 10
 * hooked to zn_header_height_general
 */
function zn_header_height_style10( $heights ){
	$style10 = array(
		'style10' => array(
			'top' => '50',
			'main' => '70',
			'bottom' => '50',
		)
	);
	$heights = array_merge($heights, $style10);
	return $heights;
}
add_filter('zn_header_height_indv', 'zn_header_height_style10');

/**
 * Add height scheme for Header style 11
 * hooked to zn_header_height_general
 */
function zn_header_height_style11( $heights ){
	$style11 = array(
		'style11' => array(
			'top' => '50',
			'main' => '70',
		)
	);
	$heights = array_merge($heights, $style11);
	return $heights;
}
add_filter('zn_header_height_indv', 'zn_header_height_style11');

/**
 * Add height scheme for Header style 12
 * hooked to zn_header_height_general
 */
function zn_header_height_style12( $heights ){
	$style12 = array(
		'style12' => array(
			'top' => '50',
			'main' => '100',
		)
	);
	$heights = array_merge($heights, $style12);
	return $heights;
}
add_filter('zn_header_height_indv', 'zn_header_height_style12');

/**
 * Add height scheme for Header style 13
 * hooked to zn_header_height_general
 */
function zn_header_height_style13( $heights ){
	$style13 = array(
		'style13' => array(
			'top' => '50',
			'main' => '70',
		)
	);
	$heights = array_merge($heights, $style13);
	return $heights;
}
add_filter('zn_header_height_indv', 'zn_header_height_style13');



/**
 * Get Custom Height height
 */
function zn_header_height( $css ){

	$zn_header_layout = zn_get_header_layout();

	$zn_head_height_enb = zget_option( 'zn_head_height_enb' , 'general_options', false, 'default' );

	if($zn_head_height_enb != 'default'){

		$header_height = '';

		/* CUSTOM HEADER HEIGHT */
		$zn_header_height_scheme = zn_header_height_general();
		$zn_head_height = (int)zget_option( 'zn_head_height' , 'general_options', false, false );

		// On rows
		$hr = zget_option( 'zn_head_height_rows' , 'general_options', false, false );

		if(isset($zn_header_height_scheme[$zn_header_layout]) && !empty($zn_header_height_scheme[$zn_header_layout])){

			$hdef = $zn_header_height_scheme[$zn_header_layout];

			$hs_top = isset($hdef['top']) ? $hdef['top'] : '';
			$hs_main = isset($hdef['main']) ? $hdef['main'] : '';
			$hs_bottom = isset($hdef['bottom']) ? $hdef['bottom'] : '';
			$hs_others = isset($hdef['others']) ? $hdef['others'] : '';

			// Custom Height
			if( !empty($zn_head_height ) && $zn_head_height_enb == 'custom' ){
				$header_height = $zn_head_height;
			}
			elseif( !empty($hr) && $zn_head_height_enb == 'custom_rows'){

				$hs_top = isset($hr['top']) && $hr['top'] != '' ? (int)$hr['top'] : $hdef['top'];
				$hs_main = isset($hr['main']) && $hr['main'] != '' ? (int)$hr['main'] : $hdef['main'];
				$hs_bottom = isset($hr['bottom']) && $hr['bottom'] != '' ? (int)$hr['bottom'] : $hdef['bottom'];
				$hs_others = isset($hr['others']) && $hr['others'] != '' ? (int)$hr['others'] : $hdef['others'];

				$header_height = $hs_top + $hs_main + $hs_bottom + $hs_others;

			}

			$hs_logo = isset($hdef['logo']) ? $hdef['logo'] : $hs_main;

			$css .= '@media (min-width:768px){';

			$default_height = $hs_top + $hs_main + $hs_bottom;
			$final_head_height = $header_height - $hs_others;

			// Get logo height
			$logo_height = ($hs_logo / $default_height) * $final_head_height;
			$logo_height = round( $logo_height );
			$css .= '.site-header.'.$zn_header_layout.' {height:'.$header_height.'px; }';
			$css .= '.site-header.'.$zn_header_layout.' .logosize--contain .site-logo-anch { height:'.$logo_height.'px; }';
			$css .= '.site-header.'.$zn_header_layout.' .logosize--contain .site-logo-img,';
			$css .= '.site-header.'.$zn_header_layout.' .logosize--contain .site-logo-img-sticky { max-height:'.$logo_height.'px;}';
			$css .= '.site-header.'.$zn_header_layout.' .logosize--yes .site-logo {min-height: '.$logo_height.'px;}';
			$css .= '.site-header.'.$zn_header_layout.'.kl-center-menu .main-nav > ul > li > a {line-height: '.$logo_height.'px;}';

			// Top
			$top_height = 0;
			if( $hs_top != '' ){
				$top_height = ($hs_top / $default_height) * $final_head_height;
				$top_height = round($top_height);
				$css .= '.site-header.'.$zn_header_layout.' .site-header-top{height:'.$top_height.'px}';
			}
			// Bottom
			$bottom_height = 0;
			if( $hs_bottom != '' ){
				$bottom_height = ($hs_bottom / $default_height) * $final_head_height;
				$bottom_height = round($bottom_height);
				$css .= '.site-header.'.$zn_header_layout.' .site-header-bottom{height:'.$bottom_height.'px}';
			}
			// Main
			if( $hs_main != '' ){
				$main_height = ($hs_main / $default_height) * $final_head_height;
				$main_height = round($main_height);
				$css .= '.site-header.'.$zn_header_layout.' .site-header-main{height:'.$main_height.'px}';
				$css .= '.site-header.'.$zn_header_layout.' .header-no-top .site-header-main{height:'.($main_height+$top_height).'px}';
				$css .= '.site-header.'.$zn_header_layout.' .header-no-bottom .site-header-main{height:'.($main_height+$bottom_height).'px}';
				$css .= '.site-header.'.$zn_header_layout.' .header-no-top.header-no-bottom .site-header-main{height:'.($main_height+$top_height+$bottom_height).'px}';
			}

			$css .= '}';
		}
	}

	return $css;
	// return print_z($css);
}
add_filter( 'zn_dynamic_css', 'zn_header_height' );
