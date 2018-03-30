<?php

	/*
	*
	*	Swift Framework Theme Functions
	*	------------------------------------------------
	*	Swift Framework v3.0
	* 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
	*
	*	sf_run_migration()
	*	sf_theme_opts_name()
	*	sf_theme_activation()
	*	sf_html5_ie_scripts()
	*	sf_admin_bar_menu()
	*	sf_add_portfolio_category_meta()
	*	sf_edit_portfolio_category_meta()
	*	sf_save_portfolio_category_meta()
	*	sf_fullscreen_search()
	*	sf_nextprev_navigation()
	*
	*
	*	OVERRIDES
	*	sf_get_thumb_type
	*	sf_header_wrap
	*	sf_top_bar
	*	sf_main_menu
	*	sf_get_search
	*	sf_header_aux
	*	sf_ajaxsearch
	*	sf_overlay_menu
	*	sf_mobile_menu
	*	sf_get_post_details
	*	sf_get_masonry_post
	*	sf_product_meta
	*	sf_product_share
	*	sf_woo_help_bar
	*	sf_post_top_author
	*	sf_post_info
	*	sf_post_pagination
	*
	*/
	
	/* CUSTOMIZER COLOUR MIGRATION
	================================================== */
    function sf_run_migration() {
        $GLOBALS['sf_customizer']['design_style_type'] = get_option('design_style_type', 'minimal');
        $GLOBALS['sf_customizer']['accent_color'] = get_option('accent_color', '#fe504f');
        $GLOBALS['sf_customizer']['accent_alt_color'] = get_option('accent_alt_color', '#ffffff');
        $GLOBALS['sf_customizer']['secondary_accent_color'] = get_option('secondary_accent_color', '#222222');
        $GLOBALS['sf_customizer']['secondary_accent_alt_color'] = get_option('secondary_accent_alt_color', '#ffffff');
        $GLOBALS['sf_customizer']['page_bg_color'] = get_option('page_bg_color', '#222222');
        $GLOBALS['sf_customizer']['inner_page_bg_transparent'] = get_option('inner_page_bg_transparent', 'color');
        $GLOBALS['sf_customizer']['inner_page_bg_color'] = get_option('inner_page_bg_color', '#FFFFFF');
        $GLOBALS['sf_customizer']['section_divide_color'] = get_option('section_divide_color', '#e4e4e4');
        $GLOBALS['sf_customizer']['alt_bg_color'] = get_option('alt_bg_color', '#f7f7f7');
        $GLOBALS['sf_customizer']['topbar_bg_color'] = get_option('topbar_bg_color', '#ffffff');
        $GLOBALS['sf_customizer']['topbar_text_color'] = get_option('topbar_text_color', '#222222');
        $GLOBALS['sf_customizer']['topbar_link_color'] = get_option('topbar_link_color', '#666666');
        $GLOBALS['sf_customizer']['topbar_link_hover_color'] = get_option('topbar_link_hover_color', '#fe504f');
        $GLOBALS['sf_customizer']['topbar_divider_color'] = get_option('topbar_divider_color', '#e3e3e3');
        $GLOBALS['sf_customizer']['header_bg_color'] = get_option('header_bg_color', '#ffffff');
        $GLOBALS['sf_customizer']['header_bg_transparent'] = get_option('header_bg_transparent', 'color');
        $GLOBALS['sf_customizer']['header_border_color'] = get_option('header_border_color', '#e4e4e4');
        $GLOBALS['sf_customizer']['header_text_color'] = get_option('header_text_color', '#222');
        $GLOBALS['sf_customizer']['header_link_color'] = get_option('header_link_color', '#222');
        $GLOBALS['sf_customizer']['header_link_hover_color'] = get_option('header_link_hover_color', '#fe504f');
        $GLOBALS['sf_customizer']['header_divider_style'] = get_option('header_divider_style', 'divider');
        $GLOBALS['sf_customizer']['mobile_menu_bg_color'] = get_option('mobile_menu_bg_color', '#222');
        $GLOBALS['sf_customizer']['mobile_menu_divider_color'] = get_option('mobile_menu_divider_color', '#444');
        $GLOBALS['sf_customizer']['mobile_menu_text_color'] = get_option('mobile_menu_text_color', '#e4e4e4');
        $GLOBALS['sf_customizer']['mobile_menu_link_color'] = get_option('mobile_menu_link_color', '#fff');
        $GLOBALS['sf_customizer']['mobile_menu_link_hover_color'] = get_option('mobile_menu_link_hover_color', '#fe504f');
        $GLOBALS['sf_customizer']['nav_hover_style'] = get_option('nav_hover_style', 'standard');
        $GLOBALS['sf_customizer']['nav_bg_color'] = get_option('nav_bg_color', '#fff');
        $GLOBALS['sf_customizer']['nav_text_color'] = get_option('nav_text_color', '#252525');
        $GLOBALS['sf_customizer']['nav_bg_hover_color'] = get_option('nav_bg_hover_color', '#f7f7f7');
        $GLOBALS['sf_customizer']['nav_text_hover_color'] = get_option('nav_text_hover_color', '#fe504f');
        $GLOBALS['sf_customizer']['nav_selected_bg_color'] = get_option('nav_selected_bg_color', '#e3e3e3');
        $GLOBALS['sf_customizer']['nav_selected_text_color'] = get_option('nav_selected_text_color', '#fe504f');
        $GLOBALS['sf_customizer']['nav_pointer_color'] = get_option('nav_pointer_color', '#07c1b6');
        $GLOBALS['sf_customizer']['nav_sm_bg_color'] = get_option('nav_sm_bg_color', '#FFFFFF');
        $GLOBALS['sf_customizer']['nav_sm_text_color'] = get_option('nav_sm_text_color', '#666666');
        $GLOBALS['sf_customizer']['nav_sm_bg_hover_color'] = get_option('nav_sm_bg_hover_color', '#f7f7f7');
        $GLOBALS['sf_customizer']['nav_sm_text_hover_color'] = get_option('nav_sm_text_hover_color', '#000000');
        $GLOBALS['sf_customizer']['nav_sm_selected_text_color'] = get_option('nav_sm_selected_text_color', '#000000');
        $GLOBALS['sf_customizer']['nav_divider'] = get_option('nav_divider', 'solid');
        $GLOBALS['sf_customizer']['nav_divider_color'] = get_option('nav_divider_color', '#f0f0f0');
        $GLOBALS['sf_customizer']['overlay_menu_bg_color'] = get_option('overlay_menu_bg_color', '#fe504f');
        $GLOBALS['sf_customizer']['overlay_menu_link_color'] = get_option('overlay_menu_link_color', '#ffffff');
        $GLOBALS['sf_customizer']['overlay_menu_link_hover_color'] = get_option('overlay_menu_link_hover_color', '#fe504f');
        $GLOBALS['sf_customizer']['overlay_menu_link_hover_bg_color'] = get_option('overlay_menu_link_hover_bg_color', '#ffffff');
        $GLOBALS['sf_customizer']['promo_bar_bg_color'] = get_option('promo_bar_bg_color', '#e4e4e4');
        $GLOBALS['sf_customizer']['promo_bar_text_color'] = get_option('promo_bar_text_color', '#222');
        $GLOBALS['sf_customizer']['breadcrumb_bg_color'] = get_option('breadcrumb_bg_color', '#e4e4e4');
        $GLOBALS['sf_customizer']['breadcrumb_text_color'] = get_option('breadcrumb_text_color', '#666666');
        $GLOBALS['sf_customizer']['breadcrumb_link_color'] = get_option('breadcrumb_link_color', '#999999');
        $GLOBALS['sf_customizer']['page_heading_bg_color'] = get_option('page_heading_bg_color', '#f7f7f7');
        $GLOBALS['sf_customizer']['page_heading_text_color'] = get_option('page_heading_text_color', '#222222');
        $GLOBALS['sf_customizer']['page_heading_text_align'] = get_option('page_heading_text_align', 'left');
        $GLOBALS['sf_customizer']['body_color'] = get_option('body_color', '#222222');
        $GLOBALS['sf_customizer']['body_alt_color'] = get_option('body_alt_color', '#222222');
        $GLOBALS['sf_customizer']['link_color'] = get_option('link_color', '#444444');
        $GLOBALS['sf_customizer']['link_hover_color'] = get_option('link_hover_color', '#999999');
        $GLOBALS['sf_customizer']['h1_color'] = get_option('h1_color', '#222222');
        $GLOBALS['sf_customizer']['h2_color'] = get_option('h2_color', '#222222');
        $GLOBALS['sf_customizer']['h3_color'] = get_option('h3_color', '#222222');
        $GLOBALS['sf_customizer']['h4_color'] = get_option('h4_color', '#222222');
        $GLOBALS['sf_customizer']['h5_color'] = get_option('h5_color', '#222222');
        $GLOBALS['sf_customizer']['h6_color'] = get_option('h6_color', '#222222');
        $GLOBALS['sf_customizer']['overlay_bg_color'] = get_option('overlay_bg_color', '#fe504f');
        $GLOBALS['sf_customizer']['overlay_text_color'] = get_option('overlay_text_color', '#ffffff');
        $GLOBALS['sf_customizer']['article_review_bar_alt_color'] = get_option('article_review_bar_alt_color', '#f7f7f7');
        $GLOBALS['sf_customizer']['article_review_bar_color'] = get_option('article_review_bar_color', '#2e2e36');
        $GLOBALS['sf_customizer']['article_review_bar_text_color'] = get_option('article_review_bar_text_color', '#fff');
        $GLOBALS['sf_customizer']['article_extras_bg_color'] = get_option('article_extras_bg_color', '#f7f7f7');
        $GLOBALS['sf_customizer']['article_np_bg_color'] = get_option('article_np_bg_color', '#444');
        $GLOBALS['sf_customizer']['article_np_text_color'] = get_option('article_np_text_color', '#fff');
        $GLOBALS['sf_customizer']['input_bg_color'] = get_option('input_bg_color', '#f7f7f7');
        $GLOBALS['sf_customizer']['input_text_color'] = get_option('input_text_color', '#222222');
        $GLOBALS['sf_customizer']['icon_container_bg_color'] = get_option('icon_container_bg_color', '#1dc6df');
        $GLOBALS['sf_customizer']['sf_icon_color'] = get_option('sf_icon_color', '#1dc6df');
        $GLOBALS['sf_customizer']['icon_container_hover_bg_color'] = get_option('icon_container_hover_bg_color', '#222');
        $GLOBALS['sf_customizer']['sf_icon_alt_color'] = get_option('sf_icon_alt_color', '#ffffff');
        $GLOBALS['sf_customizer']['boxed_content_color'] = get_option('boxed_content_color', '#07c1b6');
        $GLOBALS['sf_customizer']['share_button_bg'] = get_option('share_button_bg', '#fe504f');
        $GLOBALS['sf_customizer']['share_button_text'] = get_option('share_button_text', '#ffffff');
        $GLOBALS['sf_customizer']['bold_rp_bg'] = get_option('bold_rp_bg', '#e3e3e3');
        $GLOBALS['sf_customizer']['bold_rp_text'] = get_option('bold_rp_text', '#222');
        $GLOBALS['sf_customizer']['bold_rp_hover_bg'] = get_option('bold_rp_hover_bg', '#fe504f');
        $GLOBALS['sf_customizer']['bold_rp_hover_text'] = get_option('bold_rp_hover_text', '#ffffff');
        $GLOBALS['sf_customizer']['tweet_slider_bg'] = get_option('tweet_slider_bg', '#1dc6df');
        $GLOBALS['sf_customizer']['tweet_slider_text'] = get_option('tweet_slider_text', '#ffffff');
        $GLOBALS['sf_customizer']['tweet_slider_link'] = get_option('tweet_slider_link', '#339933');
        $GLOBALS['sf_customizer']['tweet_slider_link_hover'] = get_option('tweet_slider_link_hover', '#ffffff');
        $GLOBALS['sf_customizer']['testimonial_slider_bg'] = get_option('testimonial_slider_bg', '#1dc6df');
        $GLOBALS['sf_customizer']['testimonial_slider_text'] = get_option('testimonial_slider_text', '#ffffff');
        $GLOBALS['sf_customizer']['footer_bg_color'] = get_option('footer_bg_color', '#222222');
        $GLOBALS['sf_customizer']['footer_text_color'] = get_option('footer_text_color', '#cccccc');
        $GLOBALS['sf_customizer']['footer_link_color'] = get_option('footer_link_color', '#ffffff');
        $GLOBALS['sf_customizer']['footer_link_hover_color'] = get_option('footer_link_hover_color', '#cccccc');
        $GLOBALS['sf_customizer']['footer_border_color'] = get_option('footer_border_color', '#333333');
        $GLOBALS['sf_customizer']['copyright_bg_color'] = get_option('copyright_bg_color', '#222222');
        $GLOBALS['sf_customizer']['copyright_text_color'] = get_option('copyright_text_color', '#999999');
        $GLOBALS['sf_customizer']['copyright_link_color'] = get_option('copyright_link_color', '#ffffff');
        $GLOBALS['sf_customizer']['copyright_link_hover_color'] = get_option('copyright_link_hover_color', '#cccccc');
        update_option( 'sf_customizer', $GLOBALS['sf_customizer']);
    }

    if (!isset($GLOBALS['sf_customizer'])) {
        $GLOBALS['sf_customizer'] = get_option('sf_customizer', array());
        if (empty($GLOBALS['sf_customizer'])) {
            sf_run_migration();
        }
    }
	

	/* THEME OPTIONS NAME
	================================================== */
	if (!function_exists('sf_theme_opts_name')) {
		function sf_theme_opts_name() {
			return 'sf_atelier_options';
		}
	}

	/* THEME ACTIVATION
	================================================== */
	if (!function_exists('sf_theme_activation')) {
		function sf_theme_activation() {
			global $pagenow;
			if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
				// Update sf_theme option for framework plugin
				update_option( 'sf_theme', 'atelier' );

				// provide hook so themes can execute theme specific functions on activation
				do_action('sf_theme_activation');

				// flush rewrite rules
				flush_rewrite_rules();

				// redirect to options page
				//header( 'Location: '.admin_url().'admin.php?page=_sf_options&sf_welcome=true' ) ;
				header( 'Location: '.admin_url().'themes.php?page=install-required-plugins' ) ;
			}
		}
		add_action('after_switch_theme', 'sf_theme_activation');
	}

	/* THEME DEACTIVATION
	================================================== */
	if (!function_exists('sf_theme_deactivation')) {
		function sf_theme_deactivation() {
			// Delete sf_theme_option
			delete_option( 'sf_theme' );
		}
		add_action('switch_theme', 'sf_theme_deactivation');
	}


	/* REQUIRED IE8 COMPATIBILITY SCRIPTS
	================================================== */
	if (!function_exists('sf_html5_ie_scripts')) {
	    function sf_html5_ie_scripts() {
	        $theme_url = get_template_directory_uri();
	        $ie_scripts = '';

	        $ie_scripts .= '<!--[if lt IE 9]>';
	        $ie_scripts .= '<script data-cfasync="false" src="'.$theme_url.'/js/respond.js"></script>';
	        $ie_scripts .= '<script data-cfasync="false" src="'.$theme_url.'/js/html5shiv.js"></script>';
	        $ie_scripts .= '<script data-cfasync="false" src="'.$theme_url.'/js/excanvas.compiled.js"></script>';
	        $ie_scripts .= '<![endif]-->';
	        echo $ie_scripts;
	    }
	    add_action('wp_head', 'sf_html5_ie_scripts');
	}

	/* CUSTOM ADMIN MENU ITEMS
	================================================== */
	if(!function_exists('sf_admin_bar_menu')) {
		function sf_admin_bar_menu() {

			global $wp_admin_bar;

			if ( current_user_can( 'manage_options' ) && is_admin() ) {

				$theme_customizer = array(
					'id' => '1',
					'title' => __('Color Customizer', 'swiftframework'),
					'href' => admin_url('/customize.php'),
					'meta' => array('target' => 'blank')
				);

				$wp_admin_bar->add_menu($theme_customizer);

			}

		}
		add_action('admin_bar_menu', 'sf_admin_bar_menu', 99);
	}

	/* PORTFOLIO CATEGORY META
	================================================== */
	function sf_add_portfolio_category_meta() {
		?>
		<div class="form-field">
			<label for="term_meta[icon]"><?php _e( 'Category Icon', 'swiftframework' ); ?></label>
			<input type="text" name="term_meta[icon]" id="term_meta[icon]" value="">
			<p class="description"><?php _e( 'Enter a Font Awesome or Gizmo class name to display an icon next to the category in the portfolio filter.','swiftframework' ); ?></p>
		</div>
	<?php
	}
	add_action( 'portfolio-category_add_form_fields', 'sf_add_portfolio_category_meta', 10, 2 );

	// Edit term page
	function sf_edit_portfolio_category_meta($term) {
		$t_id = $term->term_id;
		$term_meta = get_option( "portfolio-category_$t_id" );
		?>
		<tr class="form-field">
		<th scope="row" valign="top"><label for="term_meta[icon]"><?php _e( 'Category Icon', 'swiftframework' ); ?></label></th>
			<td>
				<input type="text" name="term_meta[icon]" id="term_meta[icon]" value="<?php echo esc_attr( $term_meta['icon'] ) ? esc_attr( $term_meta['icon'] ) : ''; ?>">
				<p class="description"><?php _e( 'Enter a Font Awesome or Gizmo class name to display an icon next to the category in the portfolio filter.','swiftframework' ); ?></p>
			</td>
		</tr>
	<?php
	}
	add_action( 'portfolio-category_edit_form_fields', 'sf_edit_portfolio_category_meta', 10, 2 );

	// Save extra taxonomy fields callback function.
	function sf_save_portfolio_category_meta( $term_id ) {
		if ( isset( $_POST['term_meta'] ) ) {
			$t_id = $term_id;
			$term_meta = get_option( "portfolio-category_$t_id" );
			$cat_keys = array_keys( $_POST['term_meta'] );
			foreach ( $cat_keys as $key ) {
				if ( isset ( $_POST['term_meta'][$key] ) ) {
					$term_meta[$key] = $_POST['term_meta'][$key];
				}
			}
			// Save the option array.
			update_option( "portfolio-category_$t_id", $term_meta );
		}
	}
	add_action( 'edited_portfolio-category', 'sf_save_portfolio_category_meta', 10, 2 );
	add_action( 'create_portfolio-category', 'sf_save_portfolio_category_meta', 10, 2 );


	/* ANIMATIONS LIST
	================================================== */
	if ( ! function_exists( 'sf_get_animations_list' ) ) {
		function sf_get_animations_list($return_array = false) {
		    $anim_array = array(
		        __( "None", "swiftframework" )              	=> "none",
		        __( "Bounce", "swiftframework" )            	=> "bounce",
		        __( "Flash", "swiftframework" )             	=> "flash",
		        __( "Pulse", "swiftframework" )             	=> "pulse",
		        __( "Rubberband", "swiftframework" )        	=> "rubberBand",
		        __( "Shake", "swiftframework" )             	=> "shake",
		        __( "Swing", "swiftframework" )             	=> "swing",
		        __( "TaDa", "swiftframework" )              	=> "tada",
		        __( "Wobble", "swiftframework" )            	=> "wobble",
		        __( "Bounce In", "swiftframework" )         	=> "bounceIn",
		        __( "Bounce In Down", "swiftframework" )     => "bounceInDown",
		        __( "Bounce In Left", "swiftframework" )     => "bounceInLeft",
		        __( "Bounce In Right", "swiftframework" )    => "bounceInRight",
		        __( "Bounce In Up", "swiftframework" )       => "bounceInUp",
		        __( "Fade In", "swiftframework" )            => "fadeIn",
		        __( "Fade In Down", "swiftframework" )       => "fadeInDown",
		        __( "Fade In Down Big", "swiftframework" )   => "fadeInDownBig",
		        __( "Fade In Left", "swiftframework" )       => "fadeInLeft",
		        __( "Fade In Left Big", "swiftframework" )   => "fadeInLeftBig",
		        __( "Fade In Right", "swiftframework" )      => "fadeInRight",
		        __( "Fade In Right Big", "swiftframework" )  => "fadeInRightBig",
		        __( "Fade In Up", "swiftframework" )         => "fadeInUp",
		        __( "Fade In Up Big", "swiftframework" )     => "fadeInUpBig",
		        __( "Flip", "swiftframework" )             	=> "flip",
		        __( "Flip In X", "swiftframework" )          => "flipInX",
		        __( "Flip In Y", "swiftframework" )          => "flipInY",
		        __( "Lightspeed In", "swiftframework" )      => "lightSpeedIn",
		        __( "Rotate In", "swiftframework" )          => "rotateIn",
		        __( "Rotate In Down Left", "swiftframework" ) => "rotateInDownLeft",
		        __( "Rotate In Down Right", "swiftframework" ) => "rotateInDownRight",
		        __( "Rotate In Up Left", "swiftframework" )  => "rotateInUpLeft",
		        __( "Rotate In Up Right", "swiftframework" ) => "rotateInUpRight",
		        __( "Roll In", "swiftframework" )            => "rollIn",
		        __( "Zoom In", "swiftframework" )            => "zoomIn",
		        __( "Zoom In Down", "swiftframework" )       => "zoomInDown",
		        __( "Zoom In Left", "swiftframework" )       => "zoomInLeft",
		        __( "Zoom In Right", "swiftframework" )      => "zoomInRight",
		        __( "Zoom In Up", "swiftframework" )         => "zoomInUp",
		        __( "Slide In Down", "swiftframework" )      => "slideInDown",
		        __( "Slide In Left", "swiftframework" )      => "slideInLeft",
		        __( "Slide In Right", "swiftframework" )     => "slideInRight",
		        __( "Slide In Up", "swiftframework" )        => "slideInUp",
		    );

		    if ( $return_array ) {
		    	return $anim_array;
		    } else {
		        $anim_opts = "";

		        foreach ($anim_array as $anim_name => $anim_class) {
		        	$anim_opts .= '<option value="'.$anim_class.'">'.$anim_name.'</option>';
		        }

		        return $anim_opts;
		    }

		}
	}

	/* HOME PRELOADER
	================================================== */
	if (!function_exists('sf_home_preloader')) {
		function sf_home_preloader() {

			global $sf_options;
			$home_preloader = false;
			if (isset($sf_options['home_preloader'])) {
			$home_preloader = $sf_options['home_preloader'];
			}

			if (!$home_preloader || is_paged() || !(is_home() || is_front_page())) {
				return;
			}

			$logo = $retina_logo = $alt_logo = array();
//			if (isset($sf_options['logo_upload'])) {
//			$logo = $sf_options['logo_upload'];
//			}
//			$logo_alt = get_bloginfo( 'name' );
			{ ?>

				<div id="sf-home-preloader">

					<?php if (isset($logo['url']) && $logo['url'] != "") { ?>
						<div id="preload-logo">
							<img class="standard" src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo_alt); ?>" height="<?php echo esc_attr($logo['height']); ?>" width="<?php echo esc_attr($logo['width']); ?>" />
						</div>
					<?php } ?>

					<?php echo sf_loading_animation('preloader-loading', 'preloader'); ?>

				</div>

			<?php }
		}
		add_action('sf_before_page_container', 'sf_home_preloader', 4);
	}


	/* FULLSCREEN SEARCH
	================================================== */
	if (!function_exists('sf_fullscreen_search')) {
		function sf_fullscreen_search() {

			global $sf_options;
			$header_search_type = $sf_options['header_search_type'];
			$header_search_pt = $sf_options['header_search_pt'];
			$ajax_url = admin_url('admin-ajax.php');
			$fs_close_icon = apply_filters( 'sf_fullscreen_close_icon', '<i class="ss-delete"></i>' );

			// Overlay Search
			if ($header_search_type == "fs-search-on") { ?>

				<div id="fullscreen-search">

					<a href="#" class="fs-overlay-close">
						<?php echo $fs_close_icon; ?>
					</a>

					<div class="search-wrap" data-ajaxurl="<?php echo esc_url($ajax_url); ?>">

						<div class="fs-search-bar">
							<form method="get" class="ajax-search-form" action="<?php echo esc_url(home_url()); ?>/">
								<input id="fs-search-input" type="text" name="s" placeholder="<?php _e('Type to search', 'swiftframework'); ?>" autocomplete="off">
								<?php if ($header_search_pt != "any") { ?>
									<input type="hidden" name="post_type" value="<?php echo $header_search_pt; ?>" />
								<?php } ?>
							</form>
						</div>

						<div class="ajax-loading-wrap">
							<?php echo sf_loading_animation('', 'ajax-loading'); ?>
						</div>

						<div class="ajax-search-results"></div>

					</div>

				</div>

			<?php }
		}
	}

	/* SIDE SLIDEOUT CONFIG
	================================================== */
	if (!function_exists('sf_sideslideout_config')) {
		function sf_sideslideout_config() {

			global $sf_options;
			
			$header_left_config = $sf_options['header_left_config'];
			$header_right_config = $sf_options['header_right_config'];

			// Side Slideout Left
			if (isset($header_left_config) && array_key_exists('side-slideout', $header_left_config['enabled'])) {
				echo sf_sideslideout('left');
			}

			// Side Slideout Right
			if (isset($header_right_config) && array_key_exists('side-slideout', $header_right_config['enabled'])) {
				echo sf_sideslideout('right');
			}

		}
		add_action( 'sf_before_page_container', 'sf_sideslideout_config', 40 );
	}

	/* SIDE SLIDEOUT
	================================================== */
	if (!function_exists('sf_sideslideout')) {
		function sf_sideslideout($side = 'left') {

			global $sf_options;
			$slideout_output = $page_menu = $menu_output = "";
			
			$side_slideout_type = "menu";
			
			if ( isset($sf_options['side_slideout_type']) ) {  
				$side_slideout_type = $sf_options['side_slideout_type'];
			}
			
			if ( $side_slideout_type == "sidebar" ) {
				
				$side_slideout_sidebar = strtolower($sf_options['side_slideout_sidebar']);
				
				// SLIDEOUT OUTPUT
				$slideout_output .= '<div id="side-slideout-'.$side.'-wrap" class="sf-side-slideout">';
				$slideout_output .= '<div class="slideout-sidebar">';
				$slideout_output .= sf_get_dynamic_sidebar( $side_slideout_sidebar );
				$slideout_output .= '</div>';
				$slideout_output .= '</div>';
	
				return $slideout_output;
	
			} else {
				
				if ( !class_exists( 'sf_alt_menu_walker' ) ) {
					return 'Please enable the SwiftFramework plugin';
				}
	
				$slideout_menu_args = array(
					'echo'           => false,
					'theme_location' => 'slideout_menu',
					'walker'         => new sf_alt_menu_walker,
					'fallback_cb' 	 => '',
				);
	
	
				// MENU OUTPUT
				$menu_output .= '<nav class="std-menu clearfix">'. "\n";
	
				if(function_exists('wp_nav_menu')) {
					if (has_nav_menu('slideout_menu')) {
						$menu_output .= wp_nav_menu( $slideout_menu_args );
					}
					else {
						$menu_output .= '<div class="no-menu">'.__("Please assign a menu to the Main Menu in Appearance > Menus", "swiftframework").'</div>';
					}
				}
				$menu_output .= '</nav>'. "\n";
	
	
				// SLIDEOUT OUTPUT
	
				$slideout_output .= '<div id="side-slideout-'.$side.'-wrap" class="sf-side-slideout">';
				$slideout_output .= '<div class="vertical-menu">';
				$slideout_output .= $menu_output;
				$slideout_output .= '</div>';
				$slideout_output .= '</div>';
	
				return $slideout_output;
			}
		}
	}

	/* FULLSCREEN SEARCH
	================================================== */
	if (!function_exists('sf_fullscreen_supersearch')) {
		function sf_fullscreen_supersearch() {
			$fs_close_icon = apply_filters( 'sf_fullscreen_close_icon', '<i class="ss-delete"></i>' );
		?>

			<div id="fullscreen-supersearch">

				<a href="#" class="fs-overlay-close">
					<?php echo $fs_close_icon; ?>
				</a>

				<div class="supersearch-wrap">
					<?php echo sf_super_search(); ?>
				</div>

			</div>

		<?php }
	}

	/* NEXT/PREV NAVIGATION
	================================================== */
	if (!function_exists('sf_nextprev_navigation')) {
		function sf_nextprev_navigation() {

			global $sf_options;

			// Pagiantion style
			$pagination_style = "standard";
			if ( isset( $sf_options['pagination_style'] ) ) {
			    $pagination_style = $sf_options['pagination_style'];
			}

			// Category navigation
			$enable_category_navigation = $sf_options['enable_category_navigation'];

			if (!(is_singular('post') || is_singular('portfolio') || is_singular('product')) || $pagination_style != "fs-arrow" || !sf_theme_supports( 'fullscreen-pagination' ) ) {
				return;
			}

			$taxonomy = "category";

			if ( is_singular('portfolio') ) {
				$taxonomy = "portfolio-category";
			} else if ( is_singular('product') ) {
				$taxonomy = "product_cat";
			}

			// Get next/prev post
			$prev_post = get_next_post($enable_category_navigation, '', $taxonomy);
			$next_post = get_previous_post($enable_category_navigation, '', $taxonomy);

			$sf_prev_icon = apply_filters( 'sf_prev_icon', '<i class="ss-navigateleft"></i>' );
			$sf_next_icon = apply_filters( 'sf_next_icon', '<i class="ss-navigateright"></i>' );

			if (!empty( $prev_post )) {

				$postID = $prev_post->ID;
				$prev_permalink = get_permalink($postID);
				$item_subtitle = sf_get_post_meta($postID, 'sf_portfolio_subtitle', true);
				$use_thumb_content = sf_get_post_meta($postID, 'sf_thumbnail_content_main_detail', true);

				$image = $media_image_url = $image_id = "";

				if ($use_thumb_content) {
				$media_image = rwmb_meta('sf_thumbnail_image', 'type=image&size=full', $postID);
				} else {
				$media_image = rwmb_meta('sf_detail_image', 'type=image&size=full', $postID);
				}

				foreach ($media_image as $detail_image) {
					$image_id = $detail_image['ID'];
					$media_image_url = $detail_image['url'];
					break;
				}

				if (!$media_image) {
					$media_image = get_post_thumbnail_id($postID);
					$image_id = $media_image;
					$media_image_url = wp_get_attachment_url( $media_image, 'full' );
				}

				$detail_image = sf_aq_resize($media_image_url, 80, 80, true, false);
				$image_alt = sf_get_post_meta($image_id, '_wp_attachment_image_alt', true);

				if ($detail_image) {
					$image = '<img itemprop="image" src="'.$detail_image[0].'" width="'.$detail_image[1].'" height="'.$detail_image[2].'" alt="'.$image_alt.'" />';
				}

				?>

				<?php if ($image != "") { ?>
				<div id="prev-article-pagination" class="window-arrow-nav prev-item has-img">
				<?php } else { ?>
				<div id="prev-article-pagination" class="window-arrow-nav prev-item">
				<?php } ?>

					<a href="<?php echo esc_url($prev_permalink); ?>">
						<div class="nav-transition">
							<div class="overlay-wrap">
								<?php echo esc_html($sf_prev_icon); ?>
								<?php if ($image != "") { ?>
								<figure class="pagination-article-image">
									<?php echo esc_html($image); ?>
								</figure>
								<?php } ?>
							</div>
						</div>

						<?php if ($item_subtitle != "") { ?>
						<div class="pagination-article-details has-subtitle">
							<h5><?php echo esc_attr($prev_post->post_title); ?></h5>
							<p><?php echo esc_attr($item_subtitle); ?></p>
						<?php } else { ?>
						<div class="pagination-article-details no-subtitle">
							<h5><?php echo esc_attr($prev_post->post_title); ?></h5>
						<?php } ?>
						</div>
					</a>
				</div>
			<?php }

		 	if (!empty( $next_post )) {

		 		$postID = $next_post->ID;
		 		$next_permalink = get_permalink($postID);
		 		$item_subtitle = sf_get_post_meta($postID, 'sf_portfolio_subtitle', true);
		 		$use_thumb_content = sf_get_post_meta($postID, 'sf_thumbnail_content_main_detail', true);

		 		$image = $media_image_url = $image_id = "";

		 		if ($use_thumb_content) {
		 		$media_image = rwmb_meta('sf_thumbnail_image', 'type=image&size=full', $postID);
		 		} else {
		 		$media_image = rwmb_meta('sf_detail_image', 'type=image&size=full', $postID);
		 		}

		 		foreach ($media_image as $detail_image) {
		 			$image_id = $detail_image['ID'];
		 			$media_image_url = $detail_image['url'];
		 			break;
		 		}

		 		if (!$media_image) {
		 			$media_image = get_post_thumbnail_id($postID);
		 			$image_id = $media_image;
		 			$media_image_url = wp_get_attachment_url( $media_image, 'full' );
		 		}

		 		$detail_image = sf_aq_resize($media_image_url, 80, 80, true, false);
		 		$image_alt = sf_get_post_meta($image_id, '_wp_attachment_image_alt', true);

		 		if ($detail_image) {
		 			$image = '<img itemprop="image" src="'.$detail_image[0].'" width="'.$detail_image[1].'" height="'.$detail_image[2].'" alt="'.$image_alt.'" />';
		 		}

		 		?>

		 		<?php if ($image != "") { ?>
		 		<div id="next-article-pagination" class="window-arrow-nav next-item has-img">
		 		<?php } else { ?>
		 		<div id="next-article-pagination" class="window-arrow-nav next-item">
		 		<?php } ?>

					<a href="<?php echo esc_url($next_permalink); ?>">

						<div class="nav-transition">
							<div class="overlay-wrap">
								<?php echo esc_html($sf_next_icon); ?>
								<?php if ($image != "") { ?>
								<figure class="pagination-article-image">
								<?php echo esc_html($image); ?>
								</figure>
								<?php } ?>
							</div>
						</div>

						<?php if ($item_subtitle != "") { ?>
						<div class="pagination-article-details has-subtitle">
							<h5><?php echo esc_attr($next_post->post_title); ?></h5>
							<p><?php echo esc_attr($item_subtitle); ?></p>
						<?php } else { ?>
						<div class="pagination-article-details no-subtitle">
							<h5><?php echo esc_attr($next_post->post_title); ?></h5>
						<?php } ?>
						</div>
					</a>
				</div>
		 	<?php }
		}
		add_action('sf_main_container_start', 'sf_nextprev_navigation', 50);
	}


	/* GET THUMB TYPE
	================================================== */
	if (!function_exists('sf_get_thumb_type')) {
		function sf_get_thumb_type() {
			global $sf_options;
			$thumbnail_type = "standard";
			if (isset($sf_options['thumbnail_type'])) {
			$thumbnail_type = $sf_options['thumbnail_type'];
			}

			if ($thumbnail_type != "") {
				return 'thumbnail-'.$thumbnail_type;
			}

		}
	}


	/*
	*	HEADER WRAP OVERRIDE
	*	------------------------------------------------
	*	@original - /swift-framework/core/sf-header.php
	*
	================================================== */
	if (!function_exists('sf_header_wrap')) {
		function sf_header_wrap($header_layout) {
			global $post, $sf_options;

			$header_wrap_class = $logo_class = "";
			if ( function_exists( 'sf_page_classes' ) ) {
				$page_classes = sf_page_classes();
				$header_layout = $page_classes['header-layout'];
				$header_wrap_class = $page_classes['header-wrap'];
				$logo_class = $page_classes['logo'];
			}

			$page_header_type = "standard";

			if (is_page() && $post) {
				$page_header_type = sf_get_post_meta($post->ID, 'sf_page_header_type', true);
			} else if (is_singular('post') && $post) {
				$post_header_type = sf_get_post_meta($post->ID, 'sf_page_header_type', true);
				$fw_media_display = sf_get_post_meta($post->ID, 'sf_fw_media_display', true);
				$page_title_style = sf_get_post_meta($post->ID, 'sf_page_title_style', true);
				if ($page_title_style == "fancy" || $fw_media_display == "fw-media-title" || $fw_media_display == "fw-media") {
					$page_header_type = $post_header_type;
				}
			} else if (is_singular('portfolio') && $post) {
				$port_header_type = sf_get_post_meta($post->ID, 'sf_page_header_type', true);
				$fw_media_display = sf_get_post_meta($post->ID, 'sf_fw_media_display', true);
				$page_title = sf_get_post_meta($post->ID, 'sf_page_title', true);
				$page_title_style = sf_get_post_meta($post->ID, 'sf_page_title_style', true);
				if ($page_title_style == "fancy" || !$page_title) {
					$page_header_type = $port_header_type;
				}
			}

			// Shop page check
            $shop_page = false;
            if ( ( function_exists( 'is_shop' ) && is_shop() ) || ( function_exists( 'is_product_category' ) && is_product_category() ) ) {
                $shop_page = true;
            }

            if ( $shop_page ) {
                if ( isset($sf_options['woo_page_header']) ) {
                    $page_header_type = $sf_options['woo_page_header'];
                }
            }

			$fullwidth_header = $sf_options['fullwidth_header'];
			$enable_mini_header = $sf_options['enable_mini_header'];
			$enable_tb = $sf_options['enable_tb'];
			$enable_sticky_tb = false;
			if ( isset( $sf_options['enable_sticky_topbar'] ) ) {
				$enable_sticky_tb = $sf_options['enable_sticky_topbar'];	
			}
			$header_left_config = $sf_options['header_left_config'];
			$header_right_config = $sf_options['header_right_config'];

			if (($page_header_type == "naked-light" || $page_header_type == "naked-dark") && ($header_layout == "header-vert" || $header_layout == "header-vert-right")) {
				$header_layout = "header-4";
				$enable_tb = false;
			}
		?>
			<?php if ( $enable_tb ) { ?>
				<!--// TOP BAR //-->
				<?php echo sf_top_bar( $enable_sticky_tb ); ?>
			<?php } ?>

			<!--// HEADER //-->
			<div class="header-wrap <?php echo esc_attr($header_wrap_class); ?> page-header-<?php echo esc_attr($page_header_type); ?>">

				<div id="header-section" class="<?php echo esc_attr($header_layout); ?> <?php echo esc_attr($logo_class); ?>">
					<?php if ($enable_mini_header) {
							echo sf_header($header_layout);
						} else {
							echo '<div class="sticky-wrapper">'.sf_header($header_layout).'</div>';
						}
					?>
				</div>

				<?php
					// Fullscreen Search
					echo sf_fullscreen_search();
				?>

				<?php
					// Fullscreen Search
					if (isset($header_left_config) && array_key_exists('supersearch', $header_left_config['enabled']) || isset($header_right_config) && array_key_exists('supersearch', $header_right_config['enabled'])) {
					echo sf_fullscreen_supersearch();
					}
				?>

				<?php
					// Overlay Menu
					if (isset($header_left_config) && array_key_exists('overlay-menu', $header_left_config['enabled']) || isset($header_right_config) && array_key_exists('overlay-menu', $header_right_config['enabled'])) {
						echo sf_overlay_menu();
					}
				?>

				<?php
					// Contact Slideout
					if (isset($header_left_config) && array_key_exists('contact', $header_left_config['enabled']) || isset($header_right_config) && array_key_exists('contact', $header_right_config['enabled'])) {
						echo sf_contact_slideout();
					}
				?>

			</div>

		<?php }
		add_action('sf_container_start', 'sf_header_wrap', 20);
	}
	
	if (!function_exists('sf_top_bar')) {
		function sf_top_bar( $sticky = false ) {
			global $sf_options;
			$fullwidth_header = $sf_options['fullwidth_header'];
			$tb_left_config = $sf_options['tb_left_config'];
			$tb_right_config = $sf_options['tb_right_config'];
			$tb_left_text = __($sf_options['tb_left_text'], 'swiftframework');
			$tb_right_text = __($sf_options['tb_right_text'], 'swiftframework');
					
			$tb_left_output = $tb_right_output = "";
			if ($tb_left_config == "social") {
			$tb_left_output .= do_shortcode('[social]'). "\n";
			} else if ($tb_left_config == "account") {
			$tb_left_output .= sf_get_account(). "\n";
			} else if ($tb_left_config == "menu") {
			$tb_left_output .= sf_top_bar_menu(). "\n";
			} else if ($tb_left_config == "cart-wishlist") {
			$tb_left_output .= '<div class="aux-item aux-cart-wishlist"><nav class="std-menu cart-wishlist"><ul class="menu">'. "\n";
			$tb_left_output .= sf_get_cart();
			$tb_left_output .= sf_get_wishlist();
			$tb_left_output .= '</ul></nav></div>'. "\n";
			} else if ($tb_left_config == "currency-switcher") {
			$tb_left_output .= '<div class="aux-item aux-currency"><nav class="std-menu currency"><ul class="menu">'. "\n";
			$tb_left_output .= sf_get_currency_switcher();
			$tb_left_output .= '</ul></nav></div>'. "\n";
			} else {
			$tb_left_output .= '<div class="tb-text">'.do_shortcode($tb_left_text).'</div>'. "\n";
			}
	
			if ($tb_right_config == "social") {
			$tb_right_output .= do_shortcode('[social]'). "\n";
			} else if ($tb_right_config == "account") {
			$tb_right_output .= sf_get_account(). "\n";
			} else if ($tb_right_config == "menu") {
			$tb_right_output .= sf_top_bar_menu(). "\n";
			} else if ($tb_right_config == "cart-wishlist") {
			$tb_right_output .= '<div class="aux-item aux-cart-wishlist"><nav class="std-menu cart-wishlist"><ul class="menu">'. "\n";
			$tb_right_output .= sf_get_cart();
			$tb_right_output .= sf_get_wishlist();
			$tb_right_output .= '</ul></nav></div>'. "\n";
			} else if ($tb_right_config == "currency-switcher") {
			$tb_right_output .= '<div class="aux-item aux-currency"><nav class="std-menu currency"><ul class="menu">'. "\n";
			$tb_right_output .= sf_get_currency_switcher();
			$tb_right_output .= '</ul></nav></div>'. "\n";		
			} else {
			$tb_right_output .= '<div class="tb-text">'.do_shortcode($tb_right_text).'</div>'. "\n";
			}
	
			$top_bar_class = "";
			if ($sticky) {
				$top_bar_class = "sticky-top-bar";
			}
			?>
	
			<div id="top-bar" class="<?php echo $top_bar_class; ?>">
				<?php if ($fullwidth_header) { ?>
				<div class="container fw-header">
				<?php } else { ?>
				<div class="container">
				<?php } ?>
					<div class="col-sm-6 tb-left"><?php echo $tb_left_output; ?></div>
					<div class="col-sm-6 tb-right"><?php echo $tb_right_output; ?></div>
				</div>
			</div>
			<?php
		}
	}
	
	
	/*
	*	HEADER MENU OVERRIDE
	*	------------------------------------------------
	*	@original - /swift-framework/core/sf-header.php
	*
	================================================== */
	if (!function_exists('sf_main_menu')) {
		function sf_main_menu($id, $layout = "") {

			// VARIABLES
			global $sf_options, $post;

			$show_cart = $show_wishlist = false;
			if ( isset($sf_options['show_cart']) ) {
			$show_cart            = $sf_options['show_cart'];
			}
			if ( isset($sf_options['show_wishlist']) ) {
			$show_wishlist            = $sf_options['show_wishlist'];
			}
			$vertical_header_text = __($sf_options['vertical_header_text'], 'swiftframework');
			$page_menu = $menu_output = $menu_full_output = $menu_with_search_output = $menu_float_output = $menu_vert_output = "";

			if ($post) {
			$page_menu = sf_get_post_meta($post->ID, 'sf_page_menu', true);
			}
			$main_menu_args = array(
				'echo'            => false,
				'theme_location' => 'main_navigation',
				'walker' => new sf_mega_menu_walker,
				'fallback_cb' => '',
				'menu' => $page_menu
			);


			// MENU OUTPUT
			$menu_output .= '<nav id="'.$id.'" class="std-menu clearfix">'. "\n";

			if(function_exists('wp_nav_menu')) {
				if (has_nav_menu('main_navigation')) {
					$menu_output .= wp_nav_menu( $main_menu_args );
				}
				else {
					$menu_output .= '<div class="no-menu">'.__("Please assign a menu to the Main Menu in Appearance > Menus", "swiftframework").'</div>';
				}
			}
			$menu_output .= '</nav>'. "\n";


			// FULL WIDTH MENU OUTPUT
			if ($layout == "full") {

				$menu_full_output .= '<div class="container">'. "\n";
				$menu_full_output .= '<div class="row">'. "\n";
				$menu_full_output .= '<div class="menu-left">'. "\n";
				$menu_full_output .= $menu_output . "\n";
				$menu_full_output .= '</div>'. "\n";
				$menu_full_output .= '<div class="menu-right">'. "\n";
				$menu_full_output .= sf_header_aux('right'). "\n";
				$menu_full_output .= '</div>'. "\n";
				$menu_full_output .= '</div>'. "\n";
				$menu_full_output .= '</div>'. "\n";

				$menu_output = $menu_full_output;

			} else if ($layout == "float" || $layout == "float-2") {

				$menu_float_output .= '<div class="float-menu container">'. "\n";
				$menu_float_output .= $menu_output . "\n";
				$menu_float_output .= '</div>'. "\n";

				$menu_output = $menu_float_output;

			} else if ($layout == "vertical") {

				$menu_vert_output .= $menu_output . "\n";
				$menu_vert_output .= '<div class="vertical-menu-bottom">'. "\n";
				$menu_vert_output .= sf_header_aux('right');
				$menu_vert_output .= '<div class="copyright">'.do_shortcode(stripslashes($vertical_header_text)).'</div>'. "\n";
				$menu_vert_output .= '</div>'. "\n";

				$menu_output = $menu_vert_output;
			}

			// MENU RETURN
			return $menu_output;
		}
	}


	/*
	*	HEADER SEARCH OVERRIDE
	*	------------------------------------------------
	*	@original - /swift-framework/core/sf-header.php
	*
	================================================== */
	if (!function_exists('sf_get_search')) {
		function sf_get_search($type) {

			if ($type == "search-off") {
				return;
			}

			global $sf_options;
			$header_search_type = $sf_options['header_search_type'];
			$header_search_pt = $sf_options['header_search_pt'];
			$ajax_url = admin_url('admin-ajax.php');

			if ($type == "aux") {
				$type = $header_search_type;
			}

			$search_output = "";

			if ($type == "fs-search-on") {
				$search_output .= '<li class="menu-search parent"><a href="#" class="header-search-link fs-header-search-link"><i class="sf-icon-search"></i></a></li>'. "\n";
			} else if ($type == "search-on-noajax") {
				$search_output .= '<li class="menu-search parent"><a href="#" class="header-search-link header-search-link-alt header-search-link-noajax"><i class="sf-icon-search"></i></a>'. "\n";
				$search_output .= '<div class="ajax-search-wrap search-wrap" data-ajaxurl=""><form method="get" class="ajax-search-form noajax" action="'.home_url().'/">';
				if ($header_search_pt != "any") {
				$search_output .= '<input type="hidden" name="post_type" value="'.$header_search_pt.'" />';
				}
				$search_output .= '<input type="text" placeholder="'.__("Search", "swiftframework").'" name="s" autocomplete="off" class="noajax" /></form>'. "\n";
				$search_output .= '</li>'. "\n";
			} else {
				$search_output .= '<li class="menu-search parent"><a href="#" class="header-search-link header-search-link-alt"><i class="sf-icon-search"></i></a>'. "\n";
				$search_output .= '<div class="ajax-search-wrap search-wrap" data-ajaxurl="'.$ajax_url.'"><div class="ajax-loading"></div><form method="get" class="ajax-search-form" action="'.home_url().'/">';
				if ($header_search_pt != "any") {
				$search_output .= '<input type="hidden" name="post_type" value="'.$header_search_pt.'" />';
				}
				$search_output .= '<input type="text" placeholder="'.__("Search", "swiftframework").'" name="s" autocomplete="off" /></form><div class="ajax-search-results"></div></div>'. "\n";
				$search_output .= '</li>'. "\n";
			}

			return $search_output;
		}
	}


	/*
	*	HEADER AUX OVERRIDE
	*	------------------------------------------------
	*	@original - /swift-framework/core/sf-header.php
	*
	================================================== */
	if (!function_exists('sf_header_aux')) {
		function sf_header_aux($aux) {

			global $sf_options;

			$config = array();
			$aux_output = "";

			$header_left_text = __($sf_options['header_left_text'], 'swiftframework');
			$header_right_text = __($sf_options['header_right_text'], 'swiftframework');
			
			$contact_icon = apply_filters('sf_header_contact_icon', '<i class="ss-mail"></i>');
			$supersearch_icon = apply_filters('sf_header_supersearch_icon', '<i class="ss-zoomin"></i>');
			$ajax_url = admin_url('admin-ajax.php');

			if ($aux == "left") {
				$config = $sf_options['header_left_config'];
			} else if ($aux == "right") {
				$config = $sf_options['header_right_config'];
			}

			if (!empty($config) && isset($config['enabled'])) {

				foreach ($config['enabled'] as $item_id => $item) {

					if ($item_id == "social") {
						$aux_output .= '<div class="aux-item aux-item-social">' . do_shortcode('[social]'). '</div>'. "\n";
					} else if ($item_id == "aux-links") {
						$aux_output .= '<div class="aux-item">' . sf_aux_links('header-menu', TRUE, "header-1") . '</div>'. "\n";
					} else if ($item_id == "cart-wishlist") {
						$aux_output .= '<div class="aux-item aux-cart-wishlist"><nav class="std-menu cart-wishlist"><ul class="menu">'. "\n";
						$aux_output .= sf_get_cart();
						$aux_output .= sf_get_wishlist();
						$aux_output .= '</ul></nav></div>'. "\n";
					} else if ($item_id == "supersearch") {
						$aux_output .= '<div class="aux-item aux-supersearch"><a href="#" class="fs-supersearch-link">'.$supersearch_icon.'<span>'.__("Super Search", "swiftframework").'</span></a></div>'. "\n";
					} else if ($item_id == "overlay-menu") {
						$aux_output .= '<div class="aux-item aux-overlay-menu"><a href="#" class="overlay-menu-link menu-bars-link"><span>'.__("Menu", "swiftframework").'</span></a></div>'. "\n";
					} else if ($item_id == "side-slideout" && $aux == "left") {
						$aux_output .= '<div class="aux-item"><a href="#" class="side-slideout-link menu-bars-link" data-side="left"><span>'.__("Menu", "swiftframework").'</span></a></div>'. "\n";
					} else if ($item_id == "side-slideout" && $aux == "right") {
						$aux_output .= '<div class="aux-item"><a href="#" class="side-slideout-link menu-bars-link" data-side="right"><span>'.__("Menu", "swiftframework").'</span></a></div>'. "\n";
					} else if ($item_id == "contact") {
						$aux_output .= '<div class="aux-item"><a href="#" class="contact-menu-link">'.$contact_icon.'</a></div>'. "\n";
					} else if ($item_id == "search") {
						$aux_output .= '<div class="aux-item aux-search"><nav class="std-menu">'. "\n";
						$aux_output .= '<ul class="menu">'. "\n";
						$aux_output .= sf_get_search('aux');
						$aux_output .= '</ul>'. "\n";
						$aux_output .= '</nav></div>'. "\n";
					} else if ($item_id == "account") {
						$aux_output .= '<div class="aux-item">'. "\n";
						$aux_output .= sf_get_account('aux');
						$aux_output .= '</div>'. "\n";
					} else if ($item_id == "currency-switcher") {
						$aux_output .= '<div class="aux-item aux-currency"><nav class="std-menu currency"><ul class="menu">'. "\n";
						$aux_output .= sf_get_currency_switcher();
						$aux_output .= '</ul></nav></div>'. "\n";
					} else if ($item_id == "language") {
						$aux_output .= '<div class="aux-item aux-language">'. "\n";
						$aux_output .= '<nav class="std-menu">' . "\n";
						$aux_output .= '<ul class="menu">' . "\n";
						$aux_output .= '<li class="parent aux-languages"><a href="#">' . __( "Language", "swiftframework" ) . '</a>' . "\n";
						$aux_output .= '<ul class="header-languages sub-menu">' . "\n";
						if ( function_exists( 'sf_language_flags' ) ) {
						$aux_output .= sf_language_flags();
						}
						$aux_output .= '</ul>' . "\n";
						$aux_output .= '</li>' . "\n";
						$aux_output .= '</ul>' . "\n";
						$aux_output .= '</nav>' . "\n";
						$aux_output .= '</div>'. "\n";
					} else if ($item_id == "text" && $aux == "left") {
						$aux_output .= '<div class="aux-item text">'.do_shortcode($header_left_text).'</div>'. "\n";
					} else if ($item_id == "text" && $aux == "right") {
						$aux_output .= '<div class="aux-item text">'.do_shortcode($header_right_text).'</div>'. "\n";
					}

				}

			}

			return $aux_output;
		}
	}


	/*
	*	AJAX SEARCH OVERRIDE
	*	------------------------------------------------
	*	@original - /swift-framework/core/sf-header.php
	*
	================================================== */
	if (!function_exists('sf_ajaxsearch')) {
		function sf_ajaxsearch() {
			global $sf_options;
			$page_classes = sf_page_classes();
			$header_layout = $page_classes['header-layout'];
			$header_search_type = $sf_options['header_search_type'];
			$header_search_pt = $sf_options['header_search_pt'];
			$search_term = trim($_POST['s']);
			$search_query_args = array(
				's' => $search_term,
				'post_type' => $header_search_pt,
				'post_status' => 'publish',
				'suppress_filters' => false,
				'numberposts' => -1
			);
			$search_query_args = http_build_query($search_query_args);
			$search_results = get_posts( $search_query_args );
			$count = count($search_results);
			$shown_results = 5;

			if ($header_layout == "header-vert" || $header_layout == "header-vert-right") {
				$shown_results = 2;
			}

			if ($header_search_type == "fs-search-on") {
				$shown_results = 20;
			}

			$search_results_ouput = "";

			if (!empty($search_results)) {

				$sorted_posts = $post_type = array();

				foreach ($search_results as $search_result) {
					$sorted_posts[$search_result->post_type][] = $search_result;
				    // Check we don't already have this post type in the post_type array
				    if (empty($post_type[$search_result->post_type])) {
				    	// Add the post type object to the post_type array
				        $post_type[$search_result->post_type] = get_post_type_object($search_result->post_type);
				    }
				}

				$i = 0;
				foreach ($sorted_posts as $key => $type) {
					$search_results_ouput .= '<div class="search-result-pt">';

					if ($header_search_type == "fs-search-on") {
				        if(isset($post_type[$key]->labels->name)) {
				            $search_results_ouput .= "<h3>".$post_type[$key]->labels->name."</h3>";
				        } else if(isset($key)) {
				            $search_results_ouput .= "<h3>".$key."</h3>";
				        } else {
				            $search_results_ouput .= "<h3>".__("Other", "swiftframework")."</h3>";
				        }
				    }

			        foreach ($type as $post) {
			        
			        	$post_type = get_post_type($post);
			        	$product = array();
			        
			        	if ( $post_type == "product" ) {
			        	    $product = new WC_Product( $post->ID );
			        	    if (!$product->is_visible()) {
			        	    	return;
			        	    }
			        	}

			        	$post_title = get_the_title($post->ID);
			        	$post_date = get_the_time(get_option('date_format'), $post->ID);
			        	$post_permalink = get_permalink($post->ID);

			        	$image = get_the_post_thumbnail( $post->ID, 'thumb-square' );

			        	if ($image) {
			        		$search_results_ouput .= '<div class="search-result has-img">';
			        		$search_results_ouput .= '<div class="search-item-img"><a href="'.$post_permalink.'">'.$image.'</div>';
			        	} else {
			        		$search_results_ouput .= '<div class="search-result">';
			        	}
						
						$search_results_ouput .= '<a href="'.$post_permalink.'" class="search-result-link"></a>';
						
			            $search_results_ouput .= '<div class="search-item-content">';

			            if ($header_search_type == "fs-search-on") {
			            	$search_results_ouput .= '<h4><a href="'.$post_permalink.'">'.$post_title.'</a></h4>';
			            } else {
			            	$search_results_ouput .= '<h5><a href="'.$post_permalink.'">'.$post_title.'</a></h5>';
			            }

			            if ($post_type == "product") {
				            $search_results_ouput .= $product->get_price_html();
			            } else {
			            	$search_results_ouput .= '<time>'.$post_date.'</time>';
			            }

			            $search_results_ouput .= '</div>';

			            $search_results_ouput .= '</div>';

			        	$i++;
			        	if ($i == $shown_results) break;
			        }

			       $search_results_ouput .= '</div>';
			        if ($i == $shown_results) break;
			    }

			    if ($count > 1) {
			    	$search_link = get_search_link( $search_term );
			    	
			    	if (strpos($search_link,'?') !== false) {
			    		$search_link .= '&post_type='. $header_search_pt;
			    	} else {
			    		$search_link .= '?post_type='. $header_search_pt;
			    	}
			    	if ($header_search_type == "fs-search-on") {
				    	$search_results_ouput .= '<a href="'.$search_link.'" class="all-results">'.sprintf(__("View all %d results", "swiftframework"), $count).'</a>';
			    	} else {
			    		$search_results_ouput .= '<a href="'.$search_link.'" class="all-results sf-button black bordered">'.sprintf(__("View all %d results", "swiftframework"), $count).'</a>';
			    	}
			    }

			} else {

				$search_results_ouput .= '<div class="no-search-results">';
				$search_results_ouput .= '<h5>'.__("No results", "swiftframework").'</h5>';
				$search_results_ouput .= '<p>'.__("No search results could be found, please try another query.", "swiftframework").'</p>';
				$search_results_ouput .= '</div>';

			}

			echo $search_results_ouput;
			die();
		}
		add_action('wp_ajax_sf_ajaxsearch', 'sf_ajaxsearch');
		add_action('wp_ajax_nopriv_sf_ajaxsearch', 'sf_ajaxsearch');
	}

	/*
	*	OVERLAY MENU OVERRIDE
	*	------------------------------------------------
	*	@original - /swift-framework/core/sf-header.php
	*
	================================================== */
    if ( ! function_exists( 'sf_overlay_menu' ) ) {
        function sf_overlay_menu() {

            global $post;

            $overlayMenu = $page_menu = "";

            if ( $post && !is_search() ) {
                $page_menu = sf_get_post_meta( $post->ID, 'sf_page_menu', true );
            }

            $fs_close_icon = apply_filters( 'sf_fullscreen_close_icon', '<i class="ss-delete"></i>' );
            $overlay_menu_args = array(
                'echo'           => false,
                'theme_location' => 'overlay_menu',
                'fallback_cb'    => '',
                'menu'			 => $page_menu
            );

            $overlayMenu .= '<div id="overlay-menu">';
            $overlayMenu .= '<a href="#" class="fs-overlay-close">';
            $overlayMenu .= $fs_close_icon;
            $overlayMenu .= '</a>';
            $overlayMenu .= '<nav>';
            if ( function_exists( 'wp_nav_menu' ) ) {
                $overlayMenu .= wp_nav_menu( $overlay_menu_args );
            }
            $overlayMenu .= '</nav>';
            $overlayMenu .= '</div>';


            return $overlayMenu;
        }
    }


    /*
	*	MOBILE MENU OVERRIDE
	*	------------------------------------------------
	*	@original - /swift-framework/content/sf-header.php
	*
	================================================== */
    if ( ! function_exists( 'sf_mobile_menu' ) ) {
        function sf_mobile_menu() {

            global $post, $woocommerce, $sf_options;
			
			$header_search_pt = $sf_options['header_search_pt'];
			$mobile_header_layout = $sf_options['mobile_header_layout'];
            $mobile_show_translation = $sf_options['mobile_show_translation'];
            $mobile_show_search      = $sf_options['mobile_show_search'];
            $mobile_menu_type        = "slideout";
            $fs_close_icon = apply_filters( 'sf_fullscreen_close_icon', '<i class="ss-delete"></i>' );
            if ( isset( $sf_options['mobile_menu_type'] ) ) {
                $mobile_menu_type = $sf_options['mobile_menu_type'];
            }
            $page_menu = "";

            if ( $post && !is_search() ) {
                $page_menu = sf_get_post_meta( $post->ID, 'sf_page_menu', true );
            }

            $mobile_show_cart    = $sf_options['mobile_show_cart'];
            $mobile_show_account = $sf_options['mobile_show_account'];
            $login_url           = wp_login_url();
            $logout_url          = wp_logout_url( home_url() );
            $my_account_link     = get_admin_url();
            $myaccount_page_id   = get_option( 'woocommerce_myaccount_page_id' );
            if ( $myaccount_page_id ) {
                $my_account_link = get_permalink( $myaccount_page_id );
                $logout_url      = wp_logout_url( get_permalink( $myaccount_page_id ) );
                $login_url       = get_permalink( $myaccount_page_id );
                if ( get_option( 'woocommerce_force_ssl_checkout' ) == 'yes' ) {
                    $logout_url = str_replace( 'http:', 'https:', $logout_url );
                    $login_url  = str_replace( 'http:', 'https:', $login_url );
                }
            }
            $login_url        = apply_filters( 'sf_header_login_url', $login_url );
            $register_url	  = apply_filters( 'sf_header_register_url', wp_registration_url() );
            $my_account_link  = apply_filters( 'sf_header_myaccount_url', $my_account_link );

			if ( get_option( 'woocommerce_enable_myaccount_registration' ) && $myaccount_page_id ) {
				$register_url = apply_filters( 'sf_header_register_url', $my_account_link );
			}

            $mobile_menu_args = array(
                'echo'           => false,
                'theme_location' => 'mobile_menu',
                'walker'         => new sf_alt_menu_walker,
                'fallback_cb'    => '',
                'menu'			 => $page_menu
            );

            $mobile_menu_output = "";

            if ( $mobile_header_layout == "left-logo" || $mobile_header_layout == "center-logo-alt" ) {
            	$mobile_menu_output .= '<div id="mobile-menu-wrap" class="menu-is-right">' . "\n";
            } else {
            	$mobile_menu_output .= '<div id="mobile-menu-wrap" class="menu-is-left">' . "\n";
            }

            if ( $mobile_menu_type == "overlay" ) {
                $mobile_menu_output .= '<a href="#" class="mobile-overlay-close">'.$fs_close_icon.'</a>';
            }

            if ( $mobile_show_translation && ( function_exists( 'pll_the_languages' ) || function_exists( 'icl_get_languages' ) ) ) {
                $mobile_menu_output .= '<ul class="mobile-language-select">' . sf_language_flags() . '</ul>' . "\n";
            }
            if ( $mobile_show_search ) {
                $mobile_menu_output .= '<form method="get" class="mobile-search-form" action="' . home_url() . '/">' . "\n";
				$mobile_menu_output .= '<i class="sf-icon-search"></i>' . "\n";
				$mobile_menu_output .= '<input type="text" placeholder="' . __( "Search", "swiftframework" ) . '" name="s" autocomplete="off" />' . "\n";
				
				if ( $header_search_pt != "any" ) {
				    $mobile_menu_output .= '<input type="hidden" name="post_type" value="' . $header_search_pt . '" />';
				}

                $mobile_menu_output .= '</form>' . "\n";
            }
            $mobile_menu_output .= '<nav id="mobile-menu" class="clearfix">' . "\n";

            if ( function_exists( 'wp_nav_menu' ) ) {
                $mobile_menu_output .= wp_nav_menu( $mobile_menu_args );
            }

			$mobile_menu_output .= '<ul class="alt-mobile-menu">' . "\n";

            if ( sf_woocommerce_activated() ) {

				if ( $mobile_show_cart ) {
					$mobile_menu_output .= sf_get_cart();
				}

				$mobile_menu_output .= sf_get_wishlist();

				if ( $mobile_show_account ) {
					if ( is_user_logged_in() ) {
                        $mobile_menu_output .= '<li><a href="' . $my_account_link . '" class="admin-link">' . __( "My Account", "swiftframework" ) . '</a></li>' . "\n";
                        $mobile_menu_output .= '<li><a href="' . $logout_url . '">' . __( "Logout", "swiftframework" ) . '</a></li>' . "\n";
                    } else {
                    	if ( $login_url == $register_url ) {
                    		$mobile_menu_output .= '<li><a href="' . $login_url . '">' . __( "Login / Sign Up", "swiftframework" ) . '</a></li>' . "\n";
                    	} else {
							$mobile_menu_output .= '<li><a href="' . $login_url . '">' . __( "Login", "swiftframework" ) . '</a></li>' . "\n";
							$mobile_menu_output .= '<li><a href="' . $register_url . '">' . __( "Sign Up", "swiftframework" ) . '</a></li>' . "\n";                    	
                    	}
                    }
				}

	        }

			$mobile_menu_output .= '</ul>' . "\n";

            $mobile_menu_output .= '</nav>' . "\n";
            $mobile_menu_output .= '</div>' . "\n";

            echo $mobile_menu_output;
        }

        add_action( 'sf_before_page_container', 'sf_mobile_menu', 10 );
    }


	/*
	*	GET POST DETAILS OVERRIDE
	*	------------------------------------------------
	*	@original - /swift-framework/content/sf-post-formats.php
	*
	================================================== */
	if ( ! function_exists( 'sf_get_post_details' ) ) {
	    function sf_get_post_details( $postID, $recent_post = false ) {

	    	global $sf_options;
	    	$single_author = $sf_options['single_author'];

	   		$post_details = $comments = "";
	    	$post_author  = get_the_author();
	    	$num_comments = get_comments_number();
			if ( $num_comments == 0 ) {
				$comments = __('No Comments', 'swiftframework');
			} elseif ( $num_comments > 1 ) {
				$comments = $num_comments . __(' Comments', 'swiftframework');
			} else {
				$comments = __('1 Comment', 'swiftframework');
			}

	    	if ( !$single_author && comments_open() ) {
	    	    $post_details .= '<div class="blog-item-details"><span class="author">' . sprintf( __( 'By <a href="%2$s" rel="author" itemprop="author">%1$s</a>', 'swiftframework' ), $post_author, get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '</span>';
	    	    if ( $recent_post ) {
	    	    $post_details .= ' / <span>'. $comments .'</span>';
	    	    }
	    	    $post_details .= '</div>';
	    	} else if ( $single_author && comments_open() ) {
	    	    $post_details .= '<div class="blog-item-details"><span>'. $comments .'</span></div>';
	    	} else {
	    	    $post_details .= '<div class="blog-item-details"><span class="author">' . sprintf( __( 'By <a href="%2$s" rel="author" itemprop="author">%1$s</a>', 'swiftframework' ), $post_author, get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '</span></div>';
	    	}

	    	return $post_details;
	    }
	}
	
	/*
	*	GET MASONRY POST OVERRIDE
	*	------------------------------------------------
	*	@original - /swift-framework/content/sf-post-formats.php
	*
	================================================== */
	if ( ! function_exists( 'sf_get_masonry_post' ) ) {
		function sf_get_masonry_post( $postID, $thumb_type, $fullwidth, $show_title, $show_excerpt, $show_details, $show_read_more, $content_output, $excerpt_length ) {
			
			global $sf_options;
			
			// Get Post Object
			$post_object = sf_build_post_object( $postID , $content_output, $excerpt_length );
			
			// Link config			
		    $post_links_match_thumb = false;
		    if ( isset( $sf_options['post_links_match_thumb'] ) ) {
		    	$post_links_match_thumb = $sf_options['post_links_match_thumb'];	
		    }
		
		    $post_permalink_config = 'href="' . $post_object['permalink'] . '" class="link-to-post"';
		    if ( $post_links_match_thumb ) {
		    	$link_config = sf_post_item_link();
		    	$post_permalink_config = $link_config['config'];
		    }
		    
			// Variable setup
			$post_item = "";			
			
			// THUMBNAIL MEDIA TYPE SETUP
			$post_item .= apply_filters( 'sf_before_masonry_post_thumb' , '');
			
			$item_figure = "";
			if ( $thumb_type != "none" ) {
			    $item_figure .= sf_post_thumbnail( "masonry", $fullwidth );
			}
		    if ( $item_figure != "" ) {
		        $post_item .= $item_figure;
		    }
		
			// Start Output
		    $post_item .= '<div class="details-wrap">';
		    $post_item .= '<a ' . $post_permalink_config . '></a>';
			
			// Title
		    if ( $post_object['type'] == "post" ) {
		        if ( $post_object['format'] == "standard" ) {
		            $post_item .= '<h6>' . __( "Article", "swiftframework" ) . '</h6>';
		        } else {
		            $post_item .= '<h6>' . $post_object['format'] . '</h6>';
		        }
		    } else {
		        $post_item .= '<h6>' . $post_object['type'] . '</h6>';
		    }
		    if ( $show_title == "yes" && $post_object['format'] != "quote" && $post_object['format'] != "link" ) {
		        $post_item .= '<h2 itemprop="name headline">' . $post_object['title'] . '</h2>';
		    } else if ( $post_object['format'] == "quote" ) {
		        $post_item .= '<div class="quote-excerpt" itemprop="name headline">' . $post_object['excerpt'] . '</div>';
		    } else if ( $post_object['format'] == "link" ) {
		        $post_item .= '<h3 itemprop="name headline">' . $post_object['title'] . '</h3>';
		    }
		
				
			// Details		
	        if ( $show_details == "yes" ) {
	        	$post_item .= sf_get_post_details($postID);
			}
			
			// Excerpt
	    	if ( $show_excerpt == "yes" && $post_object['format'] != "quote" ) {
	            $post_item .= '<div class="excerpt" itemprop="description">' . $post_object['excerpt'] . '</div>';
	        }
	
			// Read More
			if ( $show_read_more == "yes" ) {
			    if ( $post_object['download_button'] ) {
			        if ( $post_object['download_shortcode'] != "" ) {
			            $post_item .= do_shortcode( $post_object['download_shortcode'] );
			        } else {
			            $post_item .= '<a href="' . wp_get_attachment_url( $post_object['download_file'] ) . '" class="download-button read-more-button">' . $post_object['download_text'] . '</a>';
			        }
			    }
			    $post_item .= '<a class="read-more-button" href="' . $post_object['permalink'] . '">' . __( "Read more", "swiftframework" ) . '</a>';
			}
			
			// Comments / Likes
	        if ( $show_details == "yes" ) {
	            $post_item .= '<div class="comments-likes">';
	            if ( comments_open() ) {
	                $post_item .= '<div class="comments-wrapper"><a href="' . $post_object['permalink'] . '#comment-area">
	                <svg version="1.1" class="comments-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	                	 width="30px" height="30px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve">
	                <path fill="none" class="stroke" stroke="#252525" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="
	                	M13.958,24H2.021C1.458,24,1,23.541,1,22.975V2.025C1,1.459,1.458,1,2.021,1h25.957C28.542,1,29,1.459,29,2.025v20.949
	                	C29,23.541,28.542,24,27.979,24H21v5L13.958,24z"/>
	                </svg>
	                <span>' . $post_object['comments'] . '</span></a></div>';
	            }
	
	            if ( function_exists( 'lip_love_it_link' ) ) {
	                $post_item .= lip_love_it_link( $postID, false );
	            }
	            $post_item .= '</div>';
	        }
				
			// Close Output
		    $post_item .= '</div>';
			
			// Return 
			return $post_item;
		}
    }
    

	/*
	*	PRODUCT META OVERRIDE
	*	------------------------------------------------
	*	@original - /swift-framework/sf-woocommerce.php
	*
	================================================== */
	if ( ! function_exists( 'sf_product_meta' ) ) {
		function sf_product_meta() {
			return;
		}
	}


	/*
	*	PRODUCT SHARE OVERRIDE
	*	------------------------------------------------
	*	@original - /swift-framework/sf-woocommerce.php
	*
	================================================== */
    if ( ! function_exists( 'sf_product_share' ) ) {
        function sf_product_share() {
            ?>
            <?php echo do_shortcode('[sf_social_share]'); ?>
        <?php
        }

        add_action( 'woocommerce_single_product_summary', 'sf_product_share', 45 );
    }


    /*
	*	WOO HELP BAR OVERRIDE
	*	------------------------------------------------
	*	@original - /swift-framework/sf-woocommerce.php
	*
	================================================== */
    if ( ! function_exists( 'sf_woo_help_bar' ) ) {
        function sf_woo_help_bar() {
            global $sf_options;
            
            $disable_help_bar = false;
            
            if ( isset( $sf_options['disable_help_bar'] ) ) {
			$disable_help_bar = $sf_options['disable_help_bar'];
			}
            $help_bar_text  = __( $sf_options['help_bar_text'], 'swiftframework' );
            $email_modal_title    = __( $sf_options['email_modal_title'], 'swiftframework' );
            $email_modal    = __( $sf_options['email_modal'], 'swiftframework' );
            $shipping_modal_title = __( $sf_options['shipping_modal_title'], 'swiftframework' );
            $shipping_modal = __( $sf_options['shipping_modal'], 'swiftframework' );
            $returns_modal_title  = __( $sf_options['returns_modal_title'], 'swiftframework' );
            $returns_modal  = __( $sf_options['returns_modal'], 'swiftframework' );
            $faqs_modal_title     = __( $sf_options['faqs_modal_title'], 'swiftframework' );
            $faqs_modal     = __( $sf_options['faqs_modal'], 'swiftframework' );

            $modal_delete_icon = apply_filters( 'sf_close_icon', '<i class="ss-delete"></i>' );
            ?>
            <?php if ( !$disable_help_bar ) { ?>
	            <div class="help-bar clearfix">
	                <span><?php echo do_shortcode( $help_bar_text ); ?></span>
	                <ul>
	                    <?php if ( $email_modal_title != "" ) { ?>
	                        <li><a href="#email-form" class="inline"
	                               data-toggle="modal"><?php echo esc_attr($email_modal_title); ?></a></li>
	                    <?php } ?>
	                    <?php if ( $shipping_modal_title != "" ) { ?>
	                        <li><a href="#shipping-information" class="inline"
	                               data-toggle="modal"><?php echo esc_attr($shipping_modal_title); ?></a></li>
	                    <?php } ?>
	                    <?php if ( $returns_modal_title != "" ) { ?>
	                        <li><a href="#returns-exchange" class="inline"
	                               data-toggle="modal"><?php echo esc_attr($returns_modal_title); ?></a></li>
	                    <?php } ?>
	                    <?php if ( $faqs_modal_title != "" ) { ?>
	                        <li><a href="#faqs" class="inline"
	                               data-toggle="modal"><?php echo esc_attr($faqs_modal_title); ?></a></li>
	                    <?php } ?>
	                </ul>
	            </div>

	            <?php if ( $email_modal_title != "" ) { ?>
	                <div id="email-form" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="email-form-modal"
	                     aria-hidden="true">
	                    <div class="modal-dialog">
	                        <div class="modal-content">
	                            <div class="modal-header">
	                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><?php echo $modal_delete_icon; ?></button>
	                                <h3 id="email-form-modal"><?php echo esc_attr($email_modal_title); ?></h3>
	                            </div>
	                            <div class="modal-body">
	                                <?php echo do_shortcode( $email_modal ); ?>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            <?php } ?>

	            <?php if ( $shipping_modal_title != "" ) { ?>
	                <div id="shipping-information" class="modal fade" tabindex="-1" role="dialog"
	                     aria-labelledby="shipping-modal" aria-hidden="true">
	                    <div class="modal-dialog">
	                        <div class="modal-content">
	                            <div class="modal-header">
	                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><?php echo $modal_delete_icon; ?></button>
	                                <h3 id="shipping-modal"><?php echo esc_attr($shipping_modal_title); ?></h3>
	                            </div>
	                            <div class="modal-body">
	                                <?php echo do_shortcode( $shipping_modal ); ?>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            <?php } ?>

	            <?php if ( $returns_modal_title != "" ) { ?>
	                <div id="returns-exchange" class="modal fade" tabindex="-1" role="dialog"
	                     aria-labelledby="returns-modal" aria-hidden="true">
	                    <div class="modal-dialog">
	                        <div class="modal-content">
	                            <div class="modal-header">
	                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><?php echo $modal_delete_icon; ?></button>
	                                <h3 id="returns-modal"><?php echo esc_attr($returns_modal_title); ?></h3>
	                            </div>
	                            <div class="modal-body">
	                                <?php echo do_shortcode( $returns_modal ); ?>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            <?php } ?>

	            <?php if ( $faqs_modal_title != "" ) { ?>
	                <div id="faqs" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="faqs-modal"
	                     aria-hidden="true">
	                    <div class="modal-dialog">
	                        <div class="modal-content">
	                            <div class="modal-header">
	                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><?php echo $modal_delete_icon; ?></button>
	                                <h3 id="faqs-modal"><?php echo esc_attr($faqs_modal_title); ?></h3>
	                            </div>
	                            <div class="modal-body">
	                                <?php echo do_shortcode( $faqs_modal ); ?>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            <?php } ?>
			<?php } ?>
        <?php
        }
        add_action( 'woocommerce_before_account_navigation', 'sf_woo_help_bar' );
    }


    /*
    *	POST INFO OVERRIDE
    *	------------------------------------------------
    *	@original - /swift-framework/content/sf-post-detail.php
    *
    ================================================== */
    if ( ! function_exists( 'sf_post_top_author' ) ) {
        function sf_post_top_author() {
            global $post, $sf_options;
            $author_info 	 = sf_get_post_meta( $post->ID, 'sf_author_info', true );
            $fw_media_display = sf_get_post_meta( $post->ID, 'sf_fw_media_display', true );
			$post_date       = get_the_date();
			$single_author    = $sf_options['single_author'];
			$remove_dates     = $sf_options['remove_dates'];
			$author_id       = $post->post_author;
			$author_name     = get_the_author_meta( 'display_name', $author_id );
			$author_url      = get_author_posts_url( $author_id );
			$post_date       = get_the_date();
			$post_date_str  = get_the_date('Y-m-d');

            if ( is_singular( 'directory' ) ) {
                $author_info = false;
            }

            $post_categories = get_the_category_list( ', ' );
            ?>

            <?php if ( $author_info && $fw_media_display != "fw-media-title" ) { ?>
                <div class="top-author-info container clearfix">
                    <div class="author-avatar"><?php if ( function_exists( 'get_avatar' ) ) {
                            echo get_avatar( get_the_author_meta( 'ID' ), '140' );
                        } ?></div>
                    <div class="post-details">
                        <div class="author-name" itemprop="author" itemscope itemtype="http://schema.org/Person">
                        	<h5 class="vcard author"><?php echo sprintf( __( 'By <a href="%2$s" rel="author" itemprop="name" class="fn">%1$s</a>', 'swiftframework' ), $author_name, $author_url ); ?></h5>
                        </div>
                        <?php if ( !$remove_dates ) { ?>
                        	<?php echo sprintf( __( '<time datetime="%1$s">%2$s</time>', 'swiftframework' ), $post_date_str, $post_date ); ?>
                        <?php } ?>
                        <span class="categories"><?php echo sprintf( __( 'In %1$s', 'swiftframework' ), $post_categories ); ?></span>
                    </div>
                </div>
            <?php } ?>

        <?php
        }
    }
    add_action( 'sf_post_content_start', 'sf_post_top_author', 5 );


    /*
    *	POST INFO OVERRIDE
    *	------------------------------------------------
    *	@original - /swift-framework/content/sf-post-detail.php
    *
    ================================================== */
    if ( ! function_exists( 'sf_post_info' ) ) {
        function sf_post_info() {
            global $post, $sf_options;
            $author_info 	 = sf_get_post_meta( $post->ID, 'sf_author_info', true );
            $social_sharing  = sf_get_post_meta( $post->ID, 'sf_social_sharing', true );
			$post_date       = get_the_date();
			$remove_dates    = $sf_options['remove_dates'];
			$author_id       = $post->post_author;
			$author_name     = get_the_author_meta( 'display_name', $author_id );
			$author_url      = get_author_posts_url( $author_id );
			$post_permalink  = get_permalink();
			$post_comments   = get_comments_number();

            if ( is_singular( 'directory' ) ) {
                $author_info = true;
            }

            $post_categories = get_the_category_list( ', ' );
            ?>

            <?php if ( $author_info ) { ?>
                <div class="post-info clearfix">
            <?php } else { ?>
                <div class="post-info post-info-fw clearfix">
            <?php } ?>

                <?php if ( $author_info ) { ?>
                    <div class="author-info-wrap clearfix">
                        <div class="author-avatar"><?php if ( function_exists( 'get_avatar' ) ) {
                                echo get_avatar( get_the_author_meta( 'ID' ), '140' );
                            } ?></div>
                        <div class="author-bio">
                            <div class="author-name" itemprop="author" itemscope itemtype="http://schema.org/Person"><h3
                                    class="vcard author"><span itemprop="name" class="fn"><?php echo esc_attr($author_name); ?></span>
                                </h3></div>
                            <div class="author-bio-text">
                            	<?php the_author_meta( 'description' ); ?>
                            	<?php echo sprintf( __( '<a href="%2$s" class="author-more-link">More by %1$s <i class="fa-long-arrow-right"></i></a>', 'swiftframework' ), $author_name, $author_url ); ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <div class="post-details-wrap">
					
					<?php if ( $social_sharing ) { 
						echo sf_social_share();
					} ?>
					
		        	<?php if ( has_tag() ) { ?>
		                <div class="tags-wrap">
		                	<span class="tags-title"><?php _e( "Tags", "swiftframework" ); ?></span>
		                	<ul class="wp-tag-cloud"><?php the_tags( '<li>', '</li><li>', '</li>' ); ?></ul>
		                </div>
		            <?php } ?>

					<div class="comments-likes">
	                	<?php if ( comments_open() ) { ?>
	                        <div class="comments-wrapper">
		                        <a href="#comment-area" class="smooth-scroll-link">
			                        <svg version="1.1" class="comments-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			                        	 width="30px" height="30px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve">
			                        <path fill="none" class="stroke" stroke="#252525" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="
			                        	M13.958,24H2.021C1.458,24,1,23.541,1,22.975V2.025C1,1.459,1.458,1,2.021,1h25.957C28.542,1,29,1.459,29,2.025v20.949
			                        	C29,23.541,28.542,24,27.979,24H21v5L13.958,24z"/>
			                        </svg>
			                        <span><?php echo $post_comments; ?></span>
		                        </a>
	                        </div>
	                    <?php } ?>

	                    <?php if ( function_exists( 'lip_love_it_link' ) ) {
		                    lip_love_it_link( get_the_ID(), true, 'text' );
		                } ?>
	                </div>

		        </div>

			</div>
        <?php
        }
    }
    add_action( 'sf_post_content_end', 'sf_post_info', 40 );


    /*
    *	POST PAGINATION OVERRIDE
    *	------------------------------------------------
    *	@original - /swift-framework/content/sf-post-detail.php
    *
    ================================================== */
    if ( ! function_exists( 'sf_post_pagination' ) ) {
    	function sf_post_pagination() {
    	    global $post, $sf_options, $sf_sidebar_config;

    		$blog_page   	  = __( $sf_options['blog_page'], 'swiftframework' );
    	    $single_author    = $sf_options['single_author'];
    	    $remove_dates     = $sf_options['remove_dates'];
    	    $enable_category_navigation = $sf_options['enable_category_navigation'];
    	    $pagination_style = "standard";
    	    if ( isset( $sf_options['pagination_style'] ) ) {
    	        $pagination_style = $sf_options['pagination_style'];
    	    }
    	    $remove_next_prev  = sf_get_post_meta( $post->ID, 'sf_remove_next_prev', true );
			
			if ( $remove_next_prev ) {
				return;
			}
			
			$taxonomy = "category";
			
			if ( is_singular('portfolio') ) {
				$taxonomy = "portfolio-category";
			} else if ( is_singular('product') ) {
				$taxonomy = "product_cat";
			}
			
    	    $prev_post = get_next_post($enable_category_navigation, '', $taxonomy);
    	    $next_post = get_previous_post($enable_category_navigation, '', $taxonomy);
    	    $has_both  = false;

    	    if ( sf_theme_opts_name() == "sf_joyn_options" && $pagination_style == "fs-arrow" ) {
    	        return;
    	    }

    	    if ( ! empty( $next_post ) && ! empty( $prev_post ) ) {
    	        $has_both = true;
    	    }
    	    ?>

    	    <?php if ( ! empty( $next_post ) || ! empty( $prev_post )) { ?>
			    <?php if ($has_both) { ?>
			    <div class="post-pagination prev-next clearfix">
			    <?php } else { ?>
			    <div class="post-pagination clearfix">
			        <?php } ?>

					<?php if ( ! empty( $prev_post ) ) {
					    $author_id       = $prev_post->post_author;
					    $author_name     = get_the_author_meta( 'display_name', $author_id );
					    $author_url      = get_author_posts_url( $author_id );
					    $post_date       = get_the_date();
					    $post_date_str  = get_the_date('Y-m-d');
					    $post_categories = get_the_category_list( ', ', '', $prev_post->ID );
					    ?>
					    <a class="prev-article col-sm-4" href="<?php echo get_permalink( $prev_post->ID ); ?>">
					        <h4><?php _e( "Newer", 'swiftframework' ); ?></h4>
					        <h3><?php echo esc_attr($prev_post->post_title); ?></h3>
					    </a>
					<?php } else { ?>
						<div class="pagination-spacer col-sm-4"></div>
					<?php } ?>

					<?php if ( $blog_page != "" ) { ?>
						<div class="blog-button col-sm-4">
					        <a class="sf-button medium rounded black bordered" href="<?php echo get_permalink( $blog_page ); ?>">
					        	<span class="text"><?php _e( "View all posts", "swiftframework" ); ?></span>
					        </a>
					    </div>
					<?php } ?>

					<?php if ( ! empty( $next_post ) ) {
					    $author_id       = $next_post->post_author;
					    $author_name     = get_the_author_meta( 'display_name', $author_id );
					    $author_url      = get_author_posts_url( $author_id );
					    $post_date       = get_the_date();
					    $post_date_str   = get_the_date('Y-m-d');
					    $post_categories = get_the_category_list( ', ', '', $next_post->ID );
					    ?>
					    <a class="next-article col-sm-4" href="<?php echo get_permalink( $next_post->ID ); ?>">
					        <h4><?php _e( "Older", 'swiftframework' ); ?></h4>
					        <h3><?php echo esc_attr($next_post->post_title); ?></h3>
					    </a>
					<?php } ?>

			    </div>
    	    <?php } ?>

    	<?php
    	}
    	add_action( 'sf_post_content_end', 'sf_post_pagination', 50 );
    }
?>
