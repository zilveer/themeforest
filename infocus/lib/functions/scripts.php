<?php
/**
 *
 */
function mysite_register_script() {
	if( is_admin() ) return;
	
	# For Tabs
	wp_register_script( MYSITE_PREFIX . '_jquery_tools_tabs', esc_url ( THEME_JS . '/tabs.min.js' ), array( 'jquery' ), THEME_VERSION );
	
	# For Scrolling Slider
	wp_register_script( MYSITE_PREFIX . '_jquery_tools_scrolling', esc_url ( THEME_JS . '/scrollable.min.js' ), array( 'jquery' ), THEME_VERSION );
	
	# For Nivo Slider
	wp_register_script( MYSITE_PREFIX . '_nivo', esc_url ( THEME_JS . '/jquery.nivo.slider.js' ), array( 'jquery' ), THEME_VERSION );
	
	# For galleria
	wp_register_style( MYSITE_PREFIX . '_galleria', esc_url( THEME_JS . '/galleria/themes/classic/galleria.classic.css' ), false, THEME_VERSION, 'screen' );
	wp_register_script( MYSITE_PREFIX . '_galleria', esc_url ( THEME_JS . '/galleria/galleria-1.2.7.min.js' ), array('jquery'), THEME_VERSION );
	wp_register_script( MYSITE_PREFIX . '_galleria_classic', esc_url ( THEME_JS . '/galleria/themes/classic/galleria.classic.min.js' ), array('jquery'), THEME_VERSION );
	
	# For cluetip
	wp_register_script( MYSITE_PREFIX . '_cluetip', esc_url ( THEME_JS . '/cluetip/jquery.cluetip.js' ), array('jquery'), THEME_VERSION );
	
	# For contact form
	wp_register_script( MYSITE_PREFIX . '_jquery_form', esc_url ( THEME_JS . '/jquery.form.js' ), array('jquery'), THEME_VERSION );
	
	# For jCarousel
	wp_register_script( MYSITE_PREFIX . '_jcarousel', esc_url ( THEME_JS . '/jcarousel/lib/jquery.jcarousel.min.js' ), array('jquery'), THEME_VERSION , true );
	
	# For prettyPhoto
	wp_register_style( MYSITE_PREFIX . '_prettyphoto', esc_url( THEME_JS . '/prettyphoto/css/prettyPhoto.css' ), false, THEME_VERSION, 'screen' );
	wp_register_script( MYSITE_PREFIX . '_prettyphoto', esc_url ( THEME_JS . '/prettyphoto/js/jquery.prettyPhoto.js' ), array('jquery'), THEME_VERSION, true );
	
	# For Flexslider
	wp_register_style( MYSITE_PREFIX . '_flexslider', esc_url( THEME_JS . '/flexslider/flexslider.css' ), false, THEME_VERSION, 'screen' );
	wp_register_script( MYSITE_PREFIX . '_flexslider', esc_url ( THEME_JS . '/flexslider/jquery.flexslider-min.js' ), array('jquery'), THEME_VERSION, true );
	
	# Mysite Custom
	wp_register_script( MYSITE_PREFIX . '_custom', esc_url ( THEME_JS . '/custom.js' ), array( 'jquery' ), THEME_VERSION );
}

/**
 *
 */
function mysite_enqueue_script() {
	global $wp_query;
	
	# Styles array
	$mysite_styles = array(
		'prettyphoto' =>  MYSITE_PREFIX . '_prettyphoto',
		'galleria' => MYSITE_PREFIX . '_galleria',
		'flexslider' => MYSITE_PREFIX . '_flexslider'
	);
	
	# Scripts array
	$mysite_script = array(
		'comments' => 'comment-reply',
		'tabs' => MYSITE_PREFIX . '_jquery_tools_tabs',
		'scrolling' => MYSITE_PREFIX . '_jquery_tools_scrolling',
		'nivo' => MYSITE_PREFIX . '_nivo',
		'galleria' => MYSITE_PREFIX . '_galleria',
		'galleria_classic' => MYSITE_PREFIX . '_galleria_classic',
		'cluetip' => MYSITE_PREFIX . '_cluetip',
		'form' => MYSITE_PREFIX . '_jquery_form',
		'jcarousel' => MYSITE_PREFIX . '_jcarousel',
		'prettyphoto' => MYSITE_PREFIX . '_prettyphoto',
		'flexslider' => MYSITE_PREFIX . '_flexslider',
		'custom' => MYSITE_PREFIX . '_custom'
	);
		
	$options = get_option( MYSITE_SETTINGS );
	$slider_type = apply_filters( 'mysite_slider_type', mysite_get_setting( 'homepage_slider' ) );
	$post_obj = $wp_query->get_queried_object();
	
	

	# Front page 
	if( is_front_page() ) {
		
		# galleria hompage check
		if( strpos( $options['homepage_teaser_text'], '[galleria' ) === false &&
			strpos( $options['extra_header'], '[galleria' ) === false &&
			strpos( $options['teaser_button_text'], '[galleria' ) === false &&
			strpos( $options['content'], '[galleria' ) === false &&
			strpos( $options['homepage_footer_teaser'], '[galleria' ) === false ) { $galleria_unset = true; }

		# cluetip hompage check
		if( strpos( $options['homepage_teaser_text'], '[tooltip' ) === false &&
			strpos( $options['extra_header'], '[tooltip' ) === false &&
			strpos( $options['teaser_button_text'], '[tooltip' ) === false &&
			strpos( $options['content'], '[tooltip' ) === false &&
			strpos( $options['homepage_footer_teaser'], '[tooltip' ) === false ) { $cluetip_unset = true; }
			
		# contactform hompage check
		if( strpos( $options['homepage_teaser_text'], '[contactform' ) === false &&
			strpos( $options['extra_header'], '[contactform' ) === false &&
			strpos( $options['teaser_button_text'], '[contactform' ) === false &&
			strpos( $options['content'], '[contactform' ) === false &&
			strpos( $options['homepage_footer_teaser'], '[contactform' ) === false ) { $contactform_unset = true; }
			
		# jCarousel hompage check
		if( strpos( $options['homepage_teaser_text'], '[jcarousel' ) === false &&
			strpos( $options['extra_header'], '[jcarousel' ) === false &&
			strpos( $options['teaser_button_text'], '[jcarousel' ) === false &&
			strpos( $options['content'], '[jcarousel' ) === false &&
			strpos( $options['homepage_footer_teaser'], '[jcarousel' ) === false ) { $jcarousel_unset = true; }
			
		# nivo hompage check
		if( strpos( $options['homepage_teaser_text'], '[nivo' ) === false &&
			strpos( $options['extra_header'], '[nivo' ) === false &&
			strpos( $options['teaser_button_text'], '[nivo' ) === false &&
			strpos( $options['content'], '[nivo' ) === false &&
			strpos( $options['homepage_footer_teaser'], '[nivo' ) === false && 
			$slider_type != 'nivo_slider' ) { $nivo_unset = true; }
			
		# tabs/fading slider hompage check
		if( strpos( $options['homepage_teaser_text'], '[tab' ) === false &&
			strpos( $options['extra_header'], '[tab' ) === false &&
			strpos( $options['teaser_button_text'], '[tab' ) === false &&
			strpos( $options['content'], '[tab' ) === false &&
			strpos( $options['homepage_footer_teaser'], '[tab' ) === false && 
			$slider_type != 'fading_slider' ) { $tabs_unset = true; }
			
		# scrolling slider check
		if( $slider_type != 'scrolling_slider' )
			$scrolling_unset = true;
			
		# flexslider check
		if( $slider_type != 'responsive_slider' )
			$flexslider_unset = true;
			
		# check widgets for shortcodes
		if( is_active_sidebar( 'home' ) ) {
			$widget_sc = mysite_sc_widget_text();

			if( in_array( 'galleria', $widget_sc ) )
				$galleria_unset = false;

			if( in_array( 'nivo', $widget_sc ) )
				$nivo_unset = false;

			if( in_array( 'tabs', $widget_sc ) )
				$tabs_unset = false;

			if( in_array( 'tooltip', $widget_sc ) )
				$cluetip_unset = false;
				
			if( in_array( 'jcarousel', $widget_sc ) )
				$jcarousel_unset = false;
		}
		
		# contact form widget is active	
		if ( is_active_widget( false, false, 'contact_form', true ) )
			$contactform_unset = false;
	}
	
	
	# Singular post/page
	if( is_singular() ) {
		$dependencies = get_post_meta( $post_obj->ID, '_dependencies', true );
		$dependencies = ( empty( $dependencies ) ) ? get_post_meta( $post_obj->ID, '_' . THEME_SLUG .'_dependencies', true ) : $dependencies;
		
		# check post meta for scripts
		if( strpos( $dependencies, 'all_scripts' ) === false && ( $options['blog_page'] != $post_obj->ID || empty( $options['display_full'] ) ) ) {
			if( strpos( $dependencies, 'galleria' ) === false )
				$galleria_unset = true;

			if( strpos( $dependencies, 'nivo' ) === false )
				$nivo_unset = true;

			if( strpos( $dependencies, 'tabs' ) === false )
				$tabs_unset = true;

			if( strpos( $dependencies, 'tooltip' ) === false )
				$cluetip_unset = true;

			if( strpos( $dependencies, 'contactform' ) === false )
				$contactform_unset = true;
				
			if( strpos( $dependencies, 'jcarousel' ) === false )
				$jcarousel_unset = true;
		
			# setting options
			if( strpos( $options['custom_teaser'], '[galleria' ) !== false ||
				strpos( $options['extra_header'], '[galleria' ) !== false ||
				strpos( $options['footer_teaser'], '[galleria' ) !== false ||
				strpos( $options['footer_text'], '[galleria' ) !== false ) { $galleria_unset = false; }
			
			if( strpos( $options['custom_teaser'], '[nivo' ) !== false ||
				strpos( $options['extra_header'], '[nivo' ) !== false ||
				strpos( $options['footer_teaser'], '[nivo' ) !== false ||
				strpos( $options['footer_text'], '[nivo' ) !== false ) { $nivo_unset = false; }
			
			if( strpos( $options['custom_teaser'], '[tab' ) !== false ||
				strpos( $options['extra_header'], '[tab' ) !== false ||
				strpos( $options['footer_teaser'], '[tab' ) !== false ||
				strpos( $options['footer_text'], '[tab' ) !== false ) { $tabs_unset = false; }
			
			if( strpos( $options['custom_teaser'], '[tooltip' ) !== false ||
				strpos( $options['extra_header'], '[tooltip' ) !== false ||
				strpos( $options['footer_teaser'], '[tooltip' ) !== false ||
				strpos( $options['footer_text'], '[tooltip' ) !== false ) { $cluetip_unset = false; }
			
			if( strpos( $options['custom_teaser'], '[contactform' ) !== false ||
				strpos( $options['extra_header'], '[contactform' ) !== false ||
				strpos( $options['footer_teaser'], '[contactform' ) !== false ||
				strpos( $options['footer_text'], '[contactform' ) !== false ) { $contactform_unset = false; }
				
			if( strpos( $options['custom_teaser'], '[jcarousel' ) !== false ||
				strpos( $options['extra_header'], '[jcarousel' ) !== false ||
				strpos( $options['footer_teaser'], '[jcarousel' ) !== false ||
				strpos( $options['footer_text'], '[jcarousel' ) !== false ) { $jcarousel_unset = false; }
		}
			
		# post comment styles set to tab
		if( apply_atomic( 'post_comment_styles', $options['post_comment_styles'] ) == 'tab' && is_single() )
			$tabs_unset = false;
			
		# post comment styles set to tab & page comments enabled
		if( apply_atomic( 'post_comment_styles', $options['post_comment_styles'] ) == 'tab' && !mysite_get_setting( 'disable_page_comments' ) && is_page() ) 
			$tabs_unset = false;
			
		# popular/related post set to tab
		if( apply_atomic( 'post_like_module', $options['post_like_module'] ) == 'tab' && is_single() )
			$tabs_unset = false;
			
		# scrolling slider check
		if( $slider_type != 'scrolling_slider' )
			$scrolling_unset = true;
			
		# flexslider check
		if( $slider_type != 'responsive_slider' )
			$flexslider_unset = true;
	}
	
	
	# if search, archive or 404 page
	if( is_archive() || is_search() || is_404() ) { 
		$galleria_unset = true;
		$nivo_unset = true;
		$tabs_unset = true;
		$cluetip_unset = true;
		$contactform_unset = true;
		$scrolling_unset = true;
		$jcarousel_unset = true;
	}
	
	
	# check text widgets for shortcodes
	if( !is_front_page() ) {
		$widget_sc = mysite_sc_widget_text();
		
		if( in_array( 'galleria', $widget_sc ) )
			$galleria_unset = false;
			
		if( in_array( 'nivo', $widget_sc ) )
			$nivo_unset = false;
			
		if( in_array( 'tabs', $widget_sc ) )
			$tabs_unset = false;
			
		if( in_array( 'tooltip', $widget_sc ) )
			$cluetip_unset = false;
			
		if( in_array( 'jcarousel', $widget_sc ) )
			$jcarousel_unset = false;
			
		# contact form widget is active
		if ( is_active_widget( false, false, 'contact_form', true ) )
			$contactform_unset = false;
	}
	
	
	# If slider on every page option enabled
	if( apply_filters( 'mysite_slider_page', mysite_get_setting( 'slider_page' ) ) ) {

		if( $slider_type == 'fading_slider' )
			$tabs_unset = false;
			
		if( $slider_type == 'nivo_slider' )
			$nivo_unset = false;
			
		if( $slider_type == 'scrolling_slider' )
			$scrolling_unset = false;
			
		# flexslider check
		if( $slider_type == 'responsive_slider' )
			$flexslider_unset = false;
	}
	
	
	# unset tabs/fading slider
	if( !empty( $tabs_unset ) )
		unset( $mysite_script['tabs'] );
		
	# unset scrolling slider
	if( !empty( $scrolling_unset ) )
		unset( $mysite_script['scrolling'] );
		
	# unset nivo
	if( !empty( $nivo_unset ) )
		unset( $mysite_script['nivo'] );
	
	# unset cluetip
	if( !empty( $cluetip_unset ) )
		unset( $mysite_script['cluetip'] );
		
	# unset form
	if( !empty( $contactform_unset ) )
		unset( $mysite_script['form'] );
		
	# unset form
	if( !empty( $jcarousel_unset ) )
		unset( $mysite_script['jcarousel'] );
		
	# unset galleria
	if( !empty( $galleria_unset ) ) {
		unset( $mysite_styles['galleria'] );
		unset( $mysite_script['galleria'] );
		unset( $mysite_script['galleria_classic'] );
	}
	
	# unset flexslider
	if( !empty( $flexslider_unset ) ) {
		unset( $mysite_script['flexslider'] );
		unset( $mysite_styles['flexslider'] );
	}
		
	# unset WP comment-reply
	if ( !is_singular() || !comments_open() || ( get_option( 'thread_comments' ) != 1 ) )
		unset( $mysite_script['comments'] );
		
		
	# Styles filter	
	$enqueue_styles = apply_atomic( 'styles', $mysite_styles );
	if( !empty( $enqueue_styles ) )
		foreach( $enqueue_styles as $style )
			wp_enqueue_style( $style );
		
		
	# Scripts filter	
	$enqueue_script = apply_atomic( 'scripts', $mysite_script );
	if( !empty( $enqueue_script ) )
		foreach( $enqueue_script as $script )
			wp_enqueue_script( $script );
			

	# Custom Cufon Fonts
	$disable = apply_atomic( 'disable_cufon', mysite_get_setting( 'disable_cufon' ) );
	if( empty( $disable ) ) {
		$active_cufon = apply_filters( 'mysite_active_skin', get_option( MYSITE_ACTIVE_SKIN ) );
		
		if( !empty( $active_cufon['cufon_gradients_fonts'] ) )
			$active_cufon['fonts'] = array_merge( $active_cufon['fonts'], $active_cufon['cufon_gradients_fonts'] );
		
		if( is_array( $active_cufon ) && !empty( $active_cufon ) ) {
			foreach( $active_cufon['fonts'] as $font ) {
				wp_enqueue_script( MYSITE_PREFIX . '_cufon', esc_url ( THEME_JS . '/cufon-yui.js' ), array( 'jquery' ), THEME_VERSION );
				wp_enqueue_script( MYSITE_PREFIX . "_{$font}", esc_url ( THEME_JS . "/fonts/{$font}.js" ), array('jquery'), THEME_VERSION );
			}
		}
	}
	
}

/**
 *
 */
function mysite_sc_widget_text() {
	$text_widgets = get_option( 'widget_text' );
	
	if( empty( $text_widgets ) ) return array();
	
	$widget_sc = array();
	
	foreach ( $text_widgets as $widget ) {
		
		if( !empty( $widget['text'] ) ) {
			if( strpos( $widget['text'], '[galleria' ) !== false )
				$widget_sc['galleria'] = 'galleria';

			if( strpos( $widget['text'], '[nivo' ) !== false )
				$widget_sc['nivo'] = 'nivo';

			if( strpos( $widget['text'], '[tab' ) !== false )
				$widget_sc['tabs'] = 'tabs';

			if( strpos( $widget['text'], '[tooltip' ) !== false )
				$widget_sc['tooltip'] = 'tooltip';
		}
	}
	
	return $widget_sc;
}

?>