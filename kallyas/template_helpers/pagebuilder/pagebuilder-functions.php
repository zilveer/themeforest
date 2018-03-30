<?php if(! defined('ABSPATH')){ return; }

function znpb_get_helptab( $data ){

	$help_tab = array(
		'title' => '<span class="dashicons dashicons-editor-help"></span> HELP',
		'options' => array(),
	);

	// Video tutorials
	if( ! empty( $data['video'] ) ){
		$help_tab['options'][] = array (
			"name"        => __( 'Video Tutorial', 'zn_framework' ),
			"description" => '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="'. esc_url( $data['video'] ) .'" target="_blank">'. __( 'Click here to access video tutorial for this element.', 'zn_framework' ).'</a>',
			"id"          => "video_link",
			"std"         => "",
			"type"        => "zn_title",
			"class"       => "zn_full zn_nomargin"
		);
	}

	// Written documentation
	if( ! empty( $data['docs'] ) ){
		$help_tab['options'][] = array (
			"name"        => __( 'Written Documentation', 'zn_framework' ),
			"description" => '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="'. esc_url( $data['docs'] ) .'" target="_blank">'. __( 'Click here to access documentation for this element.', 'zn_framework' ).'</a>',
			"id"          => "docs_link",
			"std"         => "",
			"type"        => "zn_title",
			"class"       => "zn_full zn_nomargin"
		);
	}

	// Copy link
	if( ! empty( $data['copy'] ) ){
		$copy_text  = __( 'Click to copy ID to clipboard', 'zn_framework' );
		$copy_text2 = __( 'Unique ID:', 'zn_framework' );
		$desc_text1 = __( 'In case you need some custom styling use as a css class selector', 'zn_framework' );
		$desc_text2 = __( 'Click to copy CSS class to clipboard', 'zn_framework' );

		$help_tab['options'][] = array (
			"name"        => '<span data-clipboard-text="'.$data['copy'].'" data-tooltip="'.$copy_text.'">'.$copy_text2.' '.$data['copy'].'</span> ',
			"description" => $desc_text1.' <span class="u-code" data-clipboard-text=".'.$data['copy'].' {  }" data-tooltip="'.$desc_text2.'">.'.$data['copy'].'</span> .',
			"id"          => "id_element",
			"std"         => "",
			"type"        => "zn_title",
			"class"       => "zn_full zn_nomargin"
		);
	}

	if( isset( $data['custom_id'] ) && $data['custom_id'] == true ){
		$help_tab['options'][] = array (
			'id'          => 'custom_id',
			'name'        => 'Custom ID',
			'description' => 'You can change this sections ID if you want a more generic one.',
			'std'         => $data['copy'],
			'type'        => 'text'
		);
	}

	if( ! empty( $data['general'] ) ){
		$help_tab['options'][] = znpb_general_help_option();
	}


	return $help_tab;
}

function znpb_general_help_option( $css_class = null ){
	return array (
		"name"        => '<a href="'. esc_url( 'http://support.hogash.com/support/forum/wordpress-themes/kallyas-wordpress-theme/') .'" target="_blank"  class="zn-helplink zn-helplink-support">'.__( 'Support Forums', 'zn_framework').'</a> &nbsp; | &nbsp; <a href="'.esc_url('http://support.hogash.com/kallyas-help/').'" target="_blank" class="zn-helplink zn-helplink-docs">'.__( 'Kallyas Video Tutorials & Documentation', 'zn_framework').'</a> &nbsp; | &nbsp; <a href="'.esc_url('https://themeforest.net/item/kallyas-responsive-multipurpose-wordpress-theme/4091658').'" target="_blank" class="zn-helplink zn-helplink-rate stars-yellow">'.__( 'Rate Kallyas', 'zn_framework').' <span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></a> <a class="zn-helplink zn-helplink-ratehelp" href="http://hogash.d.pr/11vC3" target="_blank" data-tooltip="How to rate?"><span class="dashicons dashicons-editor-help"></span></a>',
		"id"          => "otherlinks",
		"std"         => "",
		"type"        => "zn_title",
		"class"       => "zn_full zn-custom-title-sm zn_nomargin $css_class"
	);
}

function zn_options_doc_link_option( $url, $default_args = array() ){
	$option = array (
		"name" => '<span class="dashicons dashicons-format-aside u-v-mid"></span> '.__( 'Written Documentation:', 'zn_framework' ).' <a href="'. esc_url( $url ) .'" target="_blank">'. __( 'Click here to access documentation for this options section.', 'zn_framework' ).'</a>',
		"id"          => "docs_link",
		"std"         => "",
		"type"        => "zn_title",
		"class"       => "zn_full zn-admin-helplink zn_nomargin"
	);

	return wp_parse_args( $option, $default_args );
}

function zn_options_video_link_option( $url, $desc = false, $default_args = array() ){
	$option = array (
		"name" => '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> '.__( 'Video Tutorials:', 'zn_framework' ).' <a href="'. esc_url( $url ) .'" target="_blank">'. $desc .'</a>',
		"id"          => "video_link",
		"std"         => "",
		"type"        => "zn_title",
		"class"       => "zn_full zn-admin-helplink zn_nomargin"
	);

	return wp_parse_args( $option, $default_args );
}

/* Load PB templates for different areas */
add_action( 'template_redirect', 'znpb_load_theme_templates', 999 );

/**
 * Prepares the pagebuilder templates based on theme options
 */
function znpb_load_theme_templates(){

	// Support panel
	$show_panel = zget_option( 'head_show_support_pnl', 'general_options', false, 'yes' ) === 'yes';
	$show_pb_template = zget_option( 'hidden_panel_content_type', 'general_options', false, 'widget' ) === 'pb_template';

	if( $show_panel && $show_pb_template ){

		$pb_template = zget_option( 'hidden_panel_pb_template', 'general_options');
		$pb_data = get_post_meta( $pb_template, 'zn_page_builder_els', true );

		if( ! empty( $pb_data ) ){
			ZNPB()->get_all_modules();
			// Notify that we're using a smart area
			ZNPB()->register_smart_area( $pb_template );
			ZNPB()->load_page_modules( $pb_data );
		}

	}

	// 404 page
	$show_404_pb_template = zget_option( '404_content_type', 'zn_404_options', false, '' ) === 'pb_template';
	if( is_404() && $show_404_pb_template ){
		$pb_template = zget_option( '404_smart_area', 'zn_404_options');
		$pb_data = get_post_meta( $pb_template, 'zn_page_builder_els', true );

		if( ! empty( $pb_data ) ){
			ZNPB()->get_all_modules();
			// Notify that we're using a smart area
			ZNPB()->register_smart_area( $pb_template );
			ZNPB()->load_page_modules( $pb_data );
		}

	}

	// General templates - We can extend this in the future
	$template_configs   = array();
	$template_configs[] = zn_get_pb_template_config( 'subheader' );
	$template_configs[] = zn_get_pb_template_config( 'footer' );

	foreach ($template_configs as $key => $value) {
		if( ! empty( $value['template'] ) ){
			// We have a subheader template... let's get it's possition
			// FIlter the smart area post id so that WPML can change it
			$wpml_post_id = apply_filters( 'wpml_object_id', $value['template'], 'znpb_template_mngr' );
			$pb_data = get_post_meta( $wpml_post_id, 'zn_page_builder_els', true );

			if( ! empty( $pb_data ) ){
				ZNPB()->get_all_modules();
				// Notify that we're using a smart area
				ZNPB()->register_smart_area( $wpml_post_id );
				ZNPB()->load_page_modules( $pb_data );
			}

		}
	}

}

/**
 *	Returns a template configuration based on theme options
 */
function zn_get_pb_template_config( $location = 'subheader' ){
	// Get the default config for all pages
	$pb_setup = zget_option( 'pbtmpl_general', 'pb_layouts', false, array(
		'footer_template' => 'no_template',
		'footer_location' => '',
		'subheader_template' => 'no_template',
		'subheader_location' => ''
	));

	// Check if we have an override for the current post type/archive
	if( is_singular() ){
		$post_type = get_post_type();
		$pb_tmpl_override  = zget_option( 'pbtmpl_'.$post_type, 'pb_layouts');
	}
	elseif( znfw_is_woocommerce_active() && ( is_shop() || is_product_category() ) ){
		$pb_tmpl_override  = zget_option( 'pbtmpl_product_cat', 'pb_layouts');

		// Do overrides
		if( is_product_category() ){

			global $wp_query;
			$product_cat = $wp_query->get_queried_object()->term_id;

			$saved_taxonomy_option = get_term_meta( $product_cat, 'pbtmpl_general', true );

			if( ! empty( $saved_taxonomy_option ) ){
				$should_override = ! empty( $saved_taxonomy_option[$location . '_template'] ) ? true : false;
				if( $should_override ){
					$pb_tmpl_override = $saved_taxonomy_option;
				}
			}
		}

	}
	elseif( is_home() || is_category() || is_tag() ){
		$pb_tmpl_override  = zget_option( 'pbtmpl_category', 'pb_layouts');
	}

	// Set the template and location
	$postID = ! empty( $pb_tmpl_override[$location . '_template'] ) ? $pb_tmpl_override[$location . '_template'] : $pb_setup[$location . '_template'];
	$pb_setup_location = ! empty( $pb_tmpl_override[$location . '_location'] ) ? $pb_tmpl_override[$location . '_location'] : $pb_setup[$location . '_location'];

	if ( 'trash' == get_post_status( $postID )){
		$postID = 'no_template';
	}

	return array(
		'location' => $pb_setup_location,
		'template' => $postID,
	);

}

function znpb_hide_header_footer_on_template(){
	global $saved_options;
	// Hide custom templates
	if( isset( $saved_options['pb_layouts'] ) ) { $saved_options['pb_layouts'] = array(); }
}
add_action( 'znpb:templates:edit', 'znpb_hide_header_footer_on_template' );
