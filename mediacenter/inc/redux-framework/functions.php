<?php
/**
 * All functions related to Redux Framework
 */

/**
 * Font Awesome for Redux Framework
 * 
 * @return void
 */
if( ! function_exists( 'mc_set_redux_icon_font' ) ) {
	function mc_set_redux_icon_font() {
		wp_register_style(
	        'redux-font-awesome',
	        get_template_directory_uri() . '/assets/css/font-awesome.min.css',
	        array(),
	        time(),
	        'all'
	    );  
	    wp_enqueue_style( 'redux-font-awesome' );
	}
}

/**
 * Remove redux framework demo mode
 *
 * @return void
 */
if( ! function_exists( 'mc_remove_redux_demo_mode' ) ) {
	function mc_remove_redux_demo_mode() {
    	remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
    	remove_action( 'admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );
	}
}

if( ! function_exists( 'redux_get_social_media_fields' ) ) {
	/**
	 * Gets list of all fields that will be used in Social Media Tab
	 */
	function redux_get_social_media_fields() {
		$social_networks = mc_get_social_networks();
		foreach( $social_networks as $key => $social_network ) {
			$social_networks[ $key ][ 'type' ] 	= 'text';
			$social_networks[ $key ][ 'title' ]	= $social_network[ 'label' ];
		}
		return $social_networks;
	}
}

if ( ! function_exists( 'rx_set_social_networks_profile' ) ) {
	/**
	 * Sets the link of the social networks profile
	 */
	function rx_set_social_networks_profile( $social_networks ) {
		global $media_center_theme_options;

		foreach ( $social_networks as $key => $social_network ) {
			if ( isset( $media_center_theme_options[ $social_network[ 'id' ] ] ) && ! empty ( $media_center_theme_options[ $social_network[ 'id' ] ] ) ) {
				$social_networks[ $key ][ 'link' ] = $media_center_theme_options[ $social_network[ 'id' ] ];
			}
		}

		return $social_networks;
	}
}

if( ! function_exists( 'rx_apply_blog_layout' ) ) {
	/**
	 * Blog Layout
	 */
	function rx_apply_blog_layout( $layout ) {
		global $media_center_theme_options;
		
		if( isset( $media_center_theme_options['blog_layout'] ) ) {
			$layout = $media_center_theme_options['blog_layout'];
		}

		return $layout;
	}
}

if( ! function_exists( 'rx_apply_blog_fw_density' ) ) {
	/**
	 * Blog Full Width Density
	 */
	function rx_apply_blog_fw_density( $density ) {
		global $media_center_theme_options;
		
		if( isset( $media_center_theme_options['full_width_density'] ) ) {
			$density = $media_center_theme_options['full_width_density'];
		}

		return $density;
	}
}

if( ! function_exists( 'rx_apply_blog_style' ) ) {
	/**
	 * Blog Style
	 */
	function rx_apply_blog_style( $style ) {
		global $media_center_theme_options;
		
		if( isset( $media_center_theme_options['blog_style'] ) ) {
			$style = $media_center_theme_options['blog_style'];
		}

		return $style;
	}
}

if( ! function_exists( 'rx_apply_force_excerpt' ) ) {
	/**
	 * Force Excerpt
	 */
	function rx_apply_force_excerpt( $excerpt ) {
		global $media_center_theme_options;
		
		if( isset( $media_center_theme_options['force_excerpt'] ) ) {
			$excerpt = $media_center_theme_options['force_excerpt'];
		}

		return $excerpt;
	}
}

if( ! function_exists( 'rx_apply_excerpt_length' ) ) {
	/**
	 * Blog Excerpt Length
	 */
	function rx_apply_excerpt_length( $length ) {
		global $media_center_theme_options;
		
		if( isset( $media_center_theme_options['excerpt_length'] ) ) {
			$length = $media_center_theme_options['excerpt_length'];
		}

		return $length;
	}
}

if( ! function_exists( 'rx_apply_dropdown_trigger' ) ) {
	function rx_apply_dropdown_trigger( $trigger, $theme_location ) {
		global $media_center_theme_options;

		switch ( $theme_location ) {
			case 'top-left':
				$options_id = 'top_bar_left_menu_dropdown_trigger';
				break;

			case 'top-right':
				$options_id = 'top_bar_right_menu_dropdown_trigger';
				break;
			
			case 'primary':
				$options_id = 'main_navigation_menu_dropdown_trigger';
				break;

			case 'departments':
				$options_id = 'shop_by_departments_menu_dropdown_trigger';
				break;

			default:
				$options_id = '';
				break;
		}

		if( isset( $media_center_theme_options[$options_id] ) ) {
			$trigger = $media_center_theme_options[$options_id];
		}

		return $trigger;
	}
}

if( ! function_exists( 'rx_apply_dropdown_animation' ) ) {
	function rx_apply_dropdown_animation( $animation, $theme_location ) {
		global $media_center_theme_options;

		switch ( $theme_location ) {
			case 'top-left':
				$options_id = 'top_bar_left_menu_dropdown_animation';
				break;

			case 'top-right':
				$options_id = 'top_bar_right_menu_dropdown_animation';
				break;
			
			case 'primary':
				$options_id = 'main_navigation_menu_dropdown_animation';
				break;

			case 'departments':
				$options_id = 'shop_by_departments_menu_dropdown_animation';
				break;

			default:
				$options_id = '';
				break;
		}

		if( isset( $media_center_theme_options[$options_id] ) ) {
			$animation = $media_center_theme_options[$options_id];
		}

		return $animation;
	}
}

if( ! function_exists( 'rx_apply_main_theme_color' ) ) {
	/**
	 * Main Theme Color
	 */
	function rx_apply_main_theme_color( $color ) {
		global $media_center_theme_options;
		
		if( isset( $media_center_theme_options['use_predefined_color'] ) && $media_center_theme_options['use_predefined_color'] ){
			$color = isset( $media_center_theme_options['main_color'] ) ? $media_center_theme_options['main_color'] : 'green';
		} else {
			$color = 'custom-color';
		}

		return $color;
	}
}

if( ! function_exists( 'rx_apply_default_fonts' ) ) {
	/**
	 * Default Font
	 */
	function rx_apply_default_fonts( $load_default ) {
		global $media_center_theme_options;

		if( isset( $media_center_theme_options['use_default_font'] ) ) {
			$load_default = $media_center_theme_options['use_default_font'];
		}

		return $load_default;
	}
}

if( ! function_exists( 'rx_apply_custom_fonts' ) ) {
	/**
	 * Custom Font
	 */
	function rx_apply_custom_fonts() {
		
		global $media_center_theme_options;

		if ( isset( $media_center_theme_options['use_default_font'] ) && $media_center_theme_options['use_default_font'] == '0' ) {

			$default_font_family 	= isset( $media_center_theme_options['default_font']['font-family'] ) ? $media_center_theme_options[ 'default_font' ]['font-family'] : '\'Open Sans\', sans-serif;';
			$title_font_family 		= isset( $media_center_theme_options['title_font']['font-family'] ) ? $media_center_theme_options[ 'title_font' ]['font-family'] : '\'Open Sans\', sans-serif;';
		
		} else {

			$default_font_family 	= '\'Open Sans\', sans-serif';
			$title_font_family 		= '\'Open Sans\', sans-serif';

		}
		
		?>
		<style type="text/css">

			h1, .h1,
			h2, .h2,
			h3, .h3,
			h4, .h4,
			h5, .h5,
			h6, .h6{
				font-family: <?php echo wp_kses_post( $title_font_family );?>;
			}

			body {
				font-family: <?php echo wp_kses_post( $default_font_family );?>;
			}

		</style>
		<?php
	}
}

if( ! function_exists( 'rx_apply_animation_css' ) ) {
	/**
	 * Animation CSS
	 */
	function rx_apply_animation_css() {
		global $media_center_theme_options;
		
		?>
		<style type="text/css">
			<?php if ( $media_center_theme_options['top_bar_left_menu_dropdown_animation'] != 'none' ): ?>
			.top-left .open > .dropdown-menu,
			.top-left .open > .dropdown-menu > .dropdown-submenu > .dropdown-menu {
			  animation-name: <?php echo $media_center_theme_options['top_bar_left_menu_dropdown_animation']; ?>;
			}
			<?php endif; ?>

			<?php if ( $media_center_theme_options['top_bar_right_menu_dropdown_animation'] != 'none' ): ?>
			.top-right .open > .dropdown-menu,
			.top-right .open > .dropdown-menu > .dropdown-submenu > .dropdown-menu {
			  animation-name: <?php echo $media_center_theme_options['top_bar_right_menu_dropdown_animation']; ?>;
			}
			<?php endif; ?>

			<?php if ( $media_center_theme_options['main_navigation_menu_dropdown_animation'] != 'none' ): ?>
			#top-megamenu-nav .open > .dropdown-menu,
			#top-megamenu-nav .open > .dropdown-menu > .dropdown-submenu > .dropdown-menu {
			  animation-name: <?php echo $media_center_theme_options['main_navigation_menu_dropdown_animation']; ?>;
			}
			<?php endif; ?>

			<?php if ( $media_center_theme_options['shop_by_departments_menu_dropdown_animation'] != 'none' ): ?>
			#top-mega-nav .open > .dropdown-menu,
			#top-mega-nav .open > .dropdown-menu > .dropdown-submenu > .dropdown-menu {
			  animation-name: <?php echo $media_center_theme_options['shop_by_departments_menu_dropdown_animation']; ?>;
			}
			<?php endif; ?>
		</style>
		<?php
	}
}

if( ! function_exists( 'rx_apply_custom_css' ) ) {
	/**
	 * Custom CSS
	 */
	function rx_apply_custom_css() {
		global $media_center_theme_options;

		if( isset( $media_center_theme_options['custom_css'] ) && trim( $media_center_theme_options['custom_css'] ) != '' ) :
		?>
		<style type="text/css">
		<?php echo $media_center_theme_options['custom_css']; ?>
		</style>
		<?php
		endif;
	}
}

if( ! function_exists( 'rx_apply_custom_header_js' ) ) {
	/**
	 * Custom Header JS
	 */
	function rx_apply_custom_header_js() {
		global $media_center_theme_options;

		if( ! empty( $media_center_theme_options['header_js'] ) ) :
		?>
		<script type="text/javascript"><?php echo $media_center_theme_options['header_js']; ?></script>
		<?php
		endif;
	}
}

if( ! function_exists( 'rx_apply_custom_footer_js' ) ) {
	/**
	 * Custom Footer JS
	 */
	function rx_apply_custom_footer_js() {
		global $media_center_theme_options;

		if( ! empty( $media_center_theme_options['footer_js'] ) ) :
		?>
		<script type="text/javascript"><?php echo $media_center_theme_options['footer_js']; ?></script>
		<?php
		endif;
	}
}