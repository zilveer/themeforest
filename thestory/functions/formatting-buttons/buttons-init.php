<?php
/**
 * This file contains the initialization functionality for the additional TinyMCE Editor buttons.
 */

add_action( 'admin_init', 'pexeto_init_buttons' );

if ( !isset( $pexeto->styling_buttons ) ) {
	$pexeto->styling_buttons = array( 'pexetotitle', 'pexetohighlight1',
		'pexetohighlight2', 'pexetodropcaps', '|', 'pexetolistcheck', 'pexetoliststar',
		'pexetolistarrow', 'pexetolistarrow2', 'pexetolistarrow4', 'pexetolistplus',
		'|', 'pexetolinebreak', 'pexetoframe', 'pexetolightbox', '|', 'pexetobutton',
		'pexetoinfoboxes' );
}

if ( !isset( $pexeto->content_buttons ) ) {
	$pexeto->content_buttons = array( 'pexetotwocolumns', 'pexetothreecolumns',
		'pexetofourcolumns', '|', 'pexetoyoutube', 'pexetovimeo', 'pexetoflash',
		'|', 'pexetotestimonials', 'pexetoservices', 'pexetocarousel', 'pexetoboxedsection',
		'pexcirclecta', 'pexetonivoslider', 'pexetocontentslider', 'pexetopricing', 'pexetoposts', 'pexetobgsection' );
}



/**
 * Inits the buttons functionality - adds the CSS style for the editor and the needed filters.
 */
if ( !function_exists( 'pexeto_init_buttons' ) ) {
	function pexeto_init_buttons() {
		add_editor_style( 'functions/formatting-buttons/custom-editor-style.css' );

		if ( get_user_option( 'rich_editing' ) == 'true' ) {
			add_filter( 'mce_external_plugins', 'pexeto_add_btn_tinymce_plugin' );
			add_filter( 'mce_buttons_3', 'pexeto_register_styling_buttons' );
			add_filter( 'mce_buttons_4', 'pexeto_register_content_buttons' );
		}
	}
}


add_action( 'admin_footer', 'pexeto_load_tinymce_styles', 20 );

if(!function_exists('pexeto_load_tinymce_styles')){

	/**
	 * Loads the CSS files that are required for the custom TinyMCE buttons 
	 * design.
	 */
	function pexeto_load_tinymce_styles(){
		global $current_screen;
		
		if ( $current_screen->base=='post' || (isset($_GET['vc_action']) && $_GET['vc_action']=='vc_inline')) {
			wp_enqueue_style('pexeto-buttons', PEXETO_FUNCTIONS_URL.'formatting-buttons/buttons.css');
		}
	}
}

/**
 * Registers the buttons. Adds the custom defined buttons to the default
 * WordPress buttons.
 *
 * @param $buttons the full array of buttons containing both WordPress buttons
 * and the custom theme buttons.
 */
if ( !function_exists( 'pexeto_register_styling_buttons' ) ) {
	function pexeto_register_styling_buttons( $buttons ) {
		global $pexeto;

		array_push( $buttons, implode( ',', $pexeto->styling_buttons ) );
		return $buttons;
	}
}

/**
 * Registers a JavaScript file that will handle the functionality from the
 * custom buttons.
 *
 * @param $plugin_array
 */
if ( !function_exists( 'pexeto_add_btn_tinymce_plugin' ) ) {
	function pexeto_add_btn_tinymce_plugin( $plugin_array ) {
		global $pexeto;
		$merged_buttons=array_merge( $pexeto->styling_buttons, $pexeto->content_buttons );
		foreach ( $merged_buttons as $btn ) {
			$plugin_array[$btn] = PEXETO_FUNCTIONS_URL.'formatting-buttons/editor-plugin.js?ver='.PEXETO_VERSION;
		}
		return $plugin_array;
	}
}

/**
 * Registers the buttons.
 *
 * @param $buttons the full array of buttons containing both WordPress buttons
 * and the custom theme buttons.
 */
if ( !function_exists( 'pexeto_register_content_buttons' ) ) {
	function pexeto_register_content_buttons( $buttons ) {
		global $pexeto;

		array_push( $buttons, implode( ',', $pexeto->content_buttons ) );
		return $buttons;
	}
}


add_action( 'admin_print_scripts', 'pexeto_load_button_data_sets' );

if ( !function_exists( 'pexeto_load_button_data_sets' ) ) {

	/**
	 * Loads some of the data sets that will be used from the formatting buttons
	 * to allow the user to select from them when inserting the element. Prints
	 * some initialization JavaScript code.
	 */
	function pexeto_load_button_data_sets() {
		global $current_screen;

		if ( $current_screen->base=='post' || (isset($_GET['vc_action']) && $_GET['vc_action']=='vc_inline')) {

			//load the services boxes
			$service_sets = PexetoCustomPageHelper::get_created_sets(PEXETO_SERVICES_POSTTYPE);

			//load the Nivo sliders
			$nivo_sliders = PexetoCustomPageHelper::get_created_sets(PEXETO_NIVOSLIDER_POSTTYPE, 'id');

			//load the Content sliders
			$content_sliders = PexetoCustomPageHelper::get_created_sets(PEXETO_CONTENTSLIDER_POSTTYPE, 'id');

			//load the testimonials
			$testimonial_sets = PexetoCustomPageHelper::get_created_sets(PEXETO_TESTIMONIALS_POSTTYPE);

			//load the pricing sets
			$pricing_sets = PexetoCustomPageHelper::get_created_sets(PEXETO_PRICING_POSTTYPE);

			//load the portfolio categories
			$portfolio_cats = pexeto_get_portfolio_categories();
			array_unshift( $portfolio_cats, array( 'id'=>'-1', 'name'=>'All categories' ) );

			//load the post categories
			$cats = pexeto_get_categories();
			array_unshift( $cats, array( 'id'=>'-1', 'name'=>'All categories' ) );



			echo '<script type="text/javascript">'
				.'var PEXETO = PEXETO || {};'
				.'PEXETO.themeName = "'.PEXETO_THEMENAME.'";'
				.'PEXETO.servicesBoxes = '.json_encode( $service_sets ).';'
				.'PEXETO.portfolioCategories = '.json_encode( $portfolio_cats ).';'
				.'PEXETO.categories = '.json_encode( $cats ).';'
				.'PEXETO.nivoSliders = '.json_encode( $nivo_sliders ).';'
				.'PEXETO.contentSliders = '.json_encode( $content_sliders ).';'
				.'PEXETO.testimonials = '.json_encode( $testimonial_sets ).';'
				.'PEXETO.pricing = '.json_encode( $pricing_sets ).';'
				.'</script>';
		}
	}
}


add_action( 'wp_ajax_pexeto_print_wp_editor', 'pexeto_print_wp_editor' );

if(!function_exists('pexeto_print_wp_editor')){
	function pexeto_print_wp_editor(){
		$editor_id = isset($_GET['id']) ? $_GET['id'] : 'pexeto_editor';
		$content = isset($_GET['content']) ? $_GET['content'] : '';
		wp_editor( $content, $editor_id, array('media_buttons' => false));
		exit();
	}
}







