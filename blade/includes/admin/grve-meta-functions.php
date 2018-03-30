<?php
/*
*	Helper Functions for meta options ( Post / Page / Portfolio / Product )
*
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/


/**
 * Functions to print global metaboxes
 */
add_action( 'add_meta_boxes', 'blade_grve_generic_options_add_custom_boxes' );
add_action( 'save_post', 'blade_grve_generic_options_save_postdata', 10, 2 );

function blade_grve_generic_options_add_custom_boxes() {

	if ( function_exists( 'vc_is_inline' ) && vc_is_inline() ) {
		return;
	}

	//General Page Options
	add_meta_box(
		'grve-page-options',
		esc_html__( 'Page Options', 'blade' ),
		'blade_grve_page_options_box',
		'page'
	);
	add_meta_box(
		'grve-page-options',
		esc_html__( 'Portfolio Options', 'blade' ),
		'blade_grve_page_options_box',
		'portfolio'
	);
	add_meta_box(
		'grve-page-options',
		esc_html__( 'Post Options', 'blade' ),
		'blade_grve_page_options_box',
		'post'
	);
	add_meta_box(
		'grve-page-options',
		esc_html__( 'Product Options', 'blade' ),
		'blade_grve_page_options_box',
		'product'
	);

	$feature_section_post_types = blade_grve_option( 'feature_section_post_types');

	if ( !empty( $feature_section_post_types ) ) {

		foreach ( $feature_section_post_types as $key => $value ) {

			if ( 'attachment' != $value ) {

				add_meta_box(
					'grve_page_feature_section',
					esc_html__( 'Feature Section', 'blade' ),
					'blade_grve_page_feature_section_box',
					$value,
					'advanced',
					'low'
				);

			}

		}
	}

}

/**
 * Page Options Metabox
 */
function blade_grve_page_options_box( $post ) {

	$post_type = get_post_type( $post->ID );

	switch( $post_type ) {
		case 'portfolio':
			$grve_theme_options_info = esc_html__( 'Inherit : Theme Options - Portfolio Options.', 'blade' );
			$grve_theme_options_info_text_empty =  esc_html__('If empty, text is configured from: Theme Options - Portfolio Options.', 'blade' );
		break;
		case 'post':
			$grve_theme_options_info = esc_html__( 'Inherit : Theme Options - Blog Options - Single Post.', 'blade' );
			$grve_theme_options_info_text_empty =  esc_html__('If empty, text is configured from: Theme Options - Blog Options - Single Post.', 'blade' );
		break;
		case 'product':
			$grve_theme_options_info = esc_html__( 'Inherit : Theme Options - WooCommerce Options - Single Product.', 'blade' );
			$grve_theme_options_info_text_empty =  esc_html__('If empty, text is configured from: Theme Options - WooCommerce Options - Single Product.', 'blade' );
		break;
		case 'page':
		default:
			$grve_theme_options_info = esc_html__( 'Inherit : Theme Options - Page Options.', 'blade' );
			$grve_theme_options_info_text_empty =  esc_html__('If empty, text is configured from: Theme Options - Page Options.', 'blade' );
		break;
	}

	wp_nonce_field( 'grve_nonce_save', 'grve_page_save_nonce' );


	$grve_custom_title_options = get_post_meta( $post->ID, 'grve_custom_title_options', true );
	$grve_description = get_post_meta( $post->ID, 'grve_description', true );

	//Layout Fields
	$grve_layout = get_post_meta( $post->ID, 'grve_layout', true );
	$grve_sidebar = get_post_meta( $post->ID, 'grve_sidebar', true );
	$grve_fixed_sidebar = get_post_meta( $post->ID, 'grve_fixed_sidebar', true );
	$grve_post_content_width = get_post_meta( $post->ID, 'grve_post_content_width', true ); //Post Only

	//Sliding Area
	$grve_sidearea_visibility = get_post_meta( $post->ID, 'grve_sidearea_visibility', true );
	$grve_sidearea_sidebar = get_post_meta( $post->ID, 'grve_sidearea_sidebar', true );

	//Header - Main Menu Fields
	$grve_header_overlapping = get_post_meta( $post->ID, 'grve_header_overlapping', true );
	$grve_header_style = get_post_meta( $post->ID, 'grve_header_style', true );
	$grve_main_navigation_menu = get_post_meta( $post->ID, 'grve_main_navigation_menu', true );
	$grve_sticky_header_type = get_post_meta( $post->ID, 'grve_sticky_header_type', true );
	$grve_menu_type = get_post_meta( $post->ID, 'grve_menu_type', true );

	//Extras
	$grve_details_title = get_post_meta( $post->ID, 'grve_details_title', true ); //Portfolio Only
	$grve_details = get_post_meta( $post->ID, 'grve_details', true ); //Portfolio Only
	$grve_backlink_id = get_post_meta( $post->ID, 'grve_backlink_id', true ); //Portfolio Only

	$grve_anchor_navigation_menu = get_post_meta( $post->ID, 'grve_anchor_navigation_menu', true );
	$grve_theme_loader = get_post_meta( $post->ID, 'grve_theme_loader', true );

	//Visibility Fields
	$grve_disable_top_bar = get_post_meta( $post->ID, 'grve_disable_top_bar', true );
	$grve_disable_sticky = get_post_meta( $post->ID, 'grve_disable_sticky', true );
	$grve_disable_logo = get_post_meta( $post->ID, 'grve_disable_logo', true );
	$grve_disable_menu = get_post_meta( $post->ID, 'grve_disable_menu', true );
	$grve_disable_menu_items = get_post_meta( $post->ID, 'grve_disable_menu_items', true );
	$grve_disable_breadcrumbs = get_post_meta( $post->ID, 'grve_disable_breadcrumbs', true );
	$grve_disable_title = get_post_meta( $post->ID, 'grve_disable_title', true );
	$grve_disable_media = get_post_meta( $post->ID, 'grve_disable_media', true ); //Post Only
	$grve_disable_content = get_post_meta( $post->ID, 'grve_disable_content', true ); //Page Only
	$grve_disable_recent_entries = get_post_meta( $post->ID, 'grve_disable_recent_entries', true );//Portfolio Only
	$grve_disable_footer = get_post_meta( $post->ID, 'grve_disable_footer', true );
	$grve_disable_copyright = get_post_meta( $post->ID, 'grve_disable_copyright', true );
	$grve_disable_back_to_top = get_post_meta( $post->ID, 'grve_disable_back_to_top', true );

?>

	<!-- GRVE METABOXES -->
	<div class="grve-metabox-content">

		<!-- TABS -->
		<div class="grve-tabs">

			<ul class="grve-tab-links">
				<li class="active"><a href="#grve-page-option-tab-header"><?php esc_html_e( 'Header / Main Menu', 'blade' ); ?></a></li>
				<li><a href="#grve-page-option-tab-title"><?php esc_html_e( 'Title / Description', 'blade' ); ?></a></li>
				<li><a href="#grve-page-option-tab-layout"><?php esc_html_e( 'Layout / Sidebars', 'blade' ); ?></a></li>
				<li><a href="#grve-page-option-tab-sliding-area"><?php esc_html_e( 'Sliding Area', 'blade' ); ?></a></li>
				<li><a href="#grve-page-option-tab-extras"><?php esc_html_e( 'Extras', 'blade' ); ?></a></li>
				<li><a href="#grve-page-option-tab-visibility"><?php esc_html_e( 'Visibility', 'blade' ); ?></a></li>
			</ul>
			<div class="grve-tab-content">

				<div id="grve-page-option-tab-header" class="grve-tab-item active">
					<?php

						//Header Overlapping Option
						blade_grve_print_admin_option(
							array(
								'type' => 'select',
								'name' => 'grve_header_overlapping',
								'id' => 'grve_header_overlapping',
								'value' => $grve_header_overlapping,
								'options' => array(
									'' => esc_html__( '-- Inherit --', 'blade' ),
									'yes' => esc_html__( 'Yes', 'blade' ),
									'no' => esc_html__( 'No', 'blade' ),
								),
								'label' => array(
									"title" => esc_html__( 'Header Overlapping', 'blade' ),
									"desc" => esc_html__( 'Select if you want to overlap your page header', 'blade' ),
									"info" => $grve_theme_options_info,
								),
							)
						);

						//Header Style Option
						blade_grve_print_admin_option(
							array(
								'type' => 'select',
								'name' => 'grve_header_style',
								'id' => 'grve_header_style',
								'value' => $grve_header_style,
								'options' => array(
									'' => esc_html__( '-- Inherit --', 'blade' ),
									'default' => esc_html__( 'Default', 'blade' ),
									'dark' => esc_html__( 'Dark', 'blade' ),
									'light' => esc_html__( 'Light', 'blade' ),
								),
								'label' => array(
									"title" => esc_html__( 'Header Style', 'blade' ),
									"desc" => esc_html__( 'With this option you can change the coloring of your header. In case that you use Slider in Feature Section, select the header style per slide/image.', 'blade' ),
									"info" => $grve_theme_options_info,
								),
							)
						);

						//Main Navigation Menu Option
						blade_grve_print_admin_option_wrapper_start(
							array(
								'type' => 'select',
								'label' => array(
									"title" => esc_html__( 'Main Navigation Menu', 'blade' ),
									"desc" => esc_html__( 'Select alternative main navigation menu.', 'blade' ),
									"info" => esc_html__( 'Inherit : Menus - Theme Locations - Header Menu.', 'blade' ),
								),
							)
						);
						blade_grve_print_menu_selection( $grve_main_navigation_menu, 'grve-main-navigation-menu', 'grve_main_navigation_menu', 'default' );
						blade_grve_print_admin_option_wrapper_end();

						//Menu Type
						blade_grve_print_admin_option(
							array(
								'type' => 'select',
								'name' => 'grve_menu_type',
								'id' => 'grve_menu_type',
								'value' => $grve_menu_type,
								'options' => array(
									'' => esc_html__( '-- Inherit --', 'blade' ),
									'classic' => esc_html__( 'Classic', 'blade' ),
									'button' => esc_html__( 'Button Style', 'blade' ),
									'underline' => esc_html__( 'Underline', 'blade' ),
									'hidden' => esc_html__( 'Hidden', 'blade' ),
								),
								'label' => array(
									"title" => esc_html__( 'Menu Type', 'blade' ),
									"desc" => esc_html__( 'With this option you can select the type of the menu ( Not available for Side Header Mode ).', 'blade' ),
									"info" => esc_html__( 'Inherit : Theme Options - Header Options.', 'blade' ),
								),
							)
						);

						//Sticky Header Type
						blade_grve_print_admin_option(
							array(
								'type' => 'select',
								'name' => 'grve_sticky_header_type',
								'id' => 'grve_sticky_header_type',
								'value' => $grve_sticky_header_type,
								'options' => array(
									'' => esc_html__( '-- Inherit --', 'blade' ),
									'simple' => esc_html__( 'Simple', 'blade' ),
									'shrink' => esc_html__( 'Shrink', 'blade' ),
									'advanced' => esc_html__( 'Advanced Shrink', 'blade' ),
								),
								'label' => array(
									"title" => esc_html__( 'Sticky Header Type', 'blade' ),
									"desc" => esc_html__( 'With this option you can select the type of sticky header.', 'blade' ),
									"info" => esc_html__( 'Inherit : Theme Options - Header Options - Sticky Header Options.', 'blade' ),
								),
							)
						);
					?>
				</div>
				<div id="grve-page-option-tab-title" class="grve-tab-item">
					<?php

						echo '<div id="grve_page_title">';

						blade_grve_print_admin_option(
							array(
								'type' => 'select',
								'name' => 'grve_disable_title',
								'id' => 'grve_disable_title',
								'value' => $grve_disable_title,
								'options' => array(
									'' => esc_html__( 'Visible', 'blade' ),
									'yes' => esc_html__( 'Hidden', 'blade' ),

								),
								'label' => array(
									"title" => esc_html__( 'Title/Description Visibility', 'blade' ),
									"desc" => esc_html__( 'Select if you want to hide your title and decription .', 'blade' ),
								),
								'group_id' => 'grve_page_title',
							)
						);

						//Description Option
						blade_grve_print_admin_option(
							array(
								'type' => 'textfield',
								'name' => 'grve_description',
								'id' => 'grve_description',
								'value' => $grve_description,
								'label' => array(
									'title' => esc_html__( 'Description', 'blade' ),
									'desc' => esc_html__( 'Enter your page description.', 'blade' ),
								),
								'dependency' =>
								'[
									{ "id" : "grve_disable_title", "values" : [""] }
								]',
							)
						);

						//Custom Title Option
						blade_grve_print_admin_option(
							array(
								'type' => 'select',
								'name' => 'grve_page_title_custom',
								'id' => 'grve_page_title_custom',
								'value' => blade_grve_array_value( $grve_custom_title_options, 'custom' ),
								'options' => array(
									'' => esc_html__( '-- Inherit --', 'blade' ),
									'custom' => esc_html__( 'Custom', 'blade' ),

								),
								'label' => array(
									"title" => esc_html__( 'Title Options', 'blade' ),
									"info" => $grve_theme_options_info,
								),
								'group_id' => 'grve_page_title',
								'highlight' => 'highlight',
								'dependency' =>
								'[
									{ "id" : "grve_disable_title", "values" : [""] }
								]',
							)
						);
						blade_grve_print_admin_option(
							array(
								'type' => 'textfield',
								'name' => 'grve_page_title_height',
								'id' => 'grve_page_title_height',
								'value' => blade_grve_array_value( $grve_custom_title_options, 'height', '350' ),
								'label' => array(
									"title" => esc_html__( 'Title Area Height', 'blade' ),
								),
								'dependency' =>
								'[
									{ "id" : "grve_page_title_custom", "values" : ["custom"] },
									{ "id" : "grve_disable_title", "values" : [""] }
								]',
							)
						);
						blade_grve_print_admin_option(
							array(
								'type' => 'textfield',
								'name' => 'grve_page_title_min_height',
								'id' => 'grve_page_title_min_height',
								'value' => blade_grve_array_value( $grve_custom_title_options, 'min_height', '320' ),
								'label' => array(
									"title" => esc_html__( 'Title Area Minimum Height in px', 'blade' ),
								),
								'dependency' =>
								'[
									{ "id" : "grve_page_title_custom", "values" : ["custom"] },
									{ "id" : "grve_disable_title", "values" : [""] }
								]',
							)
						);
						blade_grve_print_admin_option(
							array(
								'type' => 'select-colorpicker',
								'name' => 'grve_page_title_bg_color',
								'id' => 'grve_page_title_bg_color',
								'value' => blade_grve_array_value( $grve_custom_title_options, 'bg_color', 'light' ),
								'value2' => blade_grve_array_value( $grve_custom_title_options, 'bg_color_custom', '#ffffff' ),
								'label' => array(
									"title" => esc_html__( 'Background Color', 'blade' ),
								),
								'dependency' =>
								'[
									{ "id" : "grve_page_title_custom", "values" : ["custom"] },
									{ "id" : "grve_disable_title", "values" : [""] }
								]',
								'multiple' => 'multi',
							)
						);
						blade_grve_print_admin_option(
							array(
								'type' => 'select-colorpicker',
								'name' => 'grve_page_title_title_color',
								'id' => 'grve_page_title_title_color',
								'value' => blade_grve_array_value( $grve_custom_title_options, 'title_color', 'dark' ),
								'value2' => blade_grve_array_value( $grve_custom_title_options, 'title_color_custom', '#000000' ),
								'label' => array(
									"title" => esc_html__( 'Title Color', 'blade' ),
								),
								'dependency' =>
								'[
									{ "id" : "grve_page_title_custom", "values" : ["custom"] },
									{ "id" : "grve_disable_title", "values" : [""] }
								]',
								'multiple' => 'multi',
							)
						);

						blade_grve_print_admin_option(
							array(
								'type' => 'select-colorpicker',
								'name' => 'grve_page_title_caption_color',
								'id' => 'grve_page_title_caption_color',
								'value' => blade_grve_array_value( $grve_custom_title_options, 'caption_color', 'dark' ),
								'value2' => blade_grve_array_value( $grve_custom_title_options, 'caption_color_custom', '#000000' ),
								'label' => array(
									"title" => esc_html__( 'Description Color', 'blade' ),
								),
								'dependency' =>
								'[
									{ "id" : "grve_page_title_custom", "values" : ["custom"] },
									{ "id" : "grve_disable_title", "values" : [""] }
								]',
								'multiple' => 'multi',
							)
						);

						global $blade_grve_media_bg_position_selection;
						blade_grve_print_admin_option(
							array(
								'type' => 'select',
								'name' => 'grve_page_title_content_position',
								'id' => 'grve_page_title_content_position',
								'value' => blade_grve_array_value( $grve_custom_title_options, 'content_position', 'center-center' ),
								'options' => $blade_grve_media_bg_position_selection,
								'label' => array(
									"title" => esc_html__( 'Content Position', 'blade' ),
								),
								'dependency' =>
								'[
									{ "id" : "grve_page_title_custom", "values" : ["custom"] },
									{ "id" : "grve_disable_title", "values" : [""] }
								]',
							)
						);

						blade_grve_print_admin_option(
							array(
								'type' => 'select-text-animation',
								'name' => 'grve_page_title_content_animation',
								'value' => blade_grve_array_value( $grve_custom_title_options, 'content_animation', 'fade-in' ),
								'label' => esc_html__( 'Content Animation', 'blade' ),
								'dependency' =>
								'[
									{ "id" : "grve_page_title_custom", "values" : ["custom"] },
									{ "id" : "grve_disable_title", "values" : [""] }
								]',
							)
						);


						blade_grve_print_admin_option(
							array(
								'type' => 'select',
								'name' => 'grve_page_title_bg_mode',
								'id' => 'grve_page_title_bg_mode',
								'value' => blade_grve_array_value( $grve_custom_title_options, 'bg_mode'),
								'options' => array(
									'' => esc_html__( 'Color Only', 'blade' ),
									'featured' => esc_html__( 'Featured Image', 'blade' ),
									'custom' => esc_html__( 'Custom Image', 'blade' ),

								),
								'label' => array(
									"title" => esc_html__( 'Background', 'blade' ),
								),
								'group_id' => 'grve_page_title',
								'dependency' =>
								'[
									{ "id" : "grve_page_title_custom", "values" : ["custom"] },
									{ "id" : "grve_disable_title", "values" : [""] }

								]',
							)
						);
						blade_grve_print_admin_option(
							array(
								'type' => 'select-image',
								'name' => 'grve_page_title_bg_image_id',
								'id' => 'grve_page_title_bg_image_id',
								'value' => blade_grve_array_value( $grve_custom_title_options, 'bg_image_id'),
								'label' => array(
									"title" => esc_html__( 'Background Image', 'blade' ),
								),
								'width' => 'fullwidth',
								'dependency' =>
								'[
									{ "id" : "grve_page_title_custom", "values" : ["custom"] },
									{ "id" : "grve_page_title_bg_mode", "values" : ["custom"] },
									{ "id" : "grve_disable_title", "values" : [""] }

								]',
							)
						);
						blade_grve_print_admin_option(
							array(
								'type' => 'select-bg-position',
								'name' => 'grve_page_title_bg_position',
								'id' => 'grve_page_title_bg_position',
								'value' => blade_grve_array_value( $grve_custom_title_options, 'bg_position', 'center-center'),
								'label' => array(
									"title" => esc_html__( 'Background Position', 'blade' ),
								),
								'dependency' =>
								'[
									{ "id" : "grve_page_title_custom", "values" : ["custom"] },
									{ "id" : "grve_page_title_bg_mode", "values" : ["featured","custom"] },
									{ "id" : "grve_disable_title", "values" : [""] }
								]',
							)
						);

						blade_grve_print_admin_option(
							array(
								'type' => 'select-pattern-overlay',
								'name' => 'grve_page_title_pattern_overlay',
								'value' => blade_grve_array_value( $grve_custom_title_options, 'pattern_overlay'),
								'label' => esc_html__( 'Pattern Overlay', 'blade' ),
								'dependency' =>
								'[
									{ "id" : "grve_page_title_custom", "values" : ["custom"] },
									{ "id" : "grve_page_title_bg_mode", "values" : ["featured","custom"] },
									{ "id" : "grve_disable_title", "values" : [""] }
								]',
							)
						);
						blade_grve_print_admin_option(
							array(
								'type' => 'select-colorpicker',
								'name' => 'grve_page_title_color_overlay',
								'value' => blade_grve_array_value( $grve_custom_title_options, 'color_overlay', 'dark' ),
								'value2' => blade_grve_array_value( $grve_custom_title_options, 'color_overlay_custom', '#000000' ),
								'label' => esc_html__( 'Color Overlay', 'blade' ),
								'multiple' => 'multi',
								'dependency' =>
								'[
									{ "id" : "grve_page_title_custom", "values" : ["custom"] },
									{ "id" : "grve_page_title_bg_mode", "values" : ["featured","custom"] },
									{ "id" : "grve_disable_title", "values" : [""] }
								]',
							)
						);
						blade_grve_print_admin_option(
							array(
								'type' => 'select-opacity',
								'name' => 'grve_page_title_opacity_overlay',
								'value' => blade_grve_array_value( $grve_custom_title_options, 'opacity_overlay', '0' ),
								'label' => esc_html__( 'Opacity Overlay', 'blade' ),
								'dependency' =>
								'[
									{ "id" : "grve_page_title_custom", "values" : ["custom"] },
									{ "id" : "grve_page_title_bg_mode", "values" : ["featured","custom"] },
									{ "id" : "grve_disable_title", "values" : [""] }
								]',
							)
						);

						echo '</div>';
					?>
				</div>
				<div id="grve-page-option-tab-layout" class="grve-tab-item">
					<?php

						//Layout Option
						blade_grve_print_admin_option(
							array(
								'type' => 'select',
								'name' => 'grve_layout',
								'id' => 'grve_layout',
								'value' => $grve_layout,
								'options' => array(
									'' => esc_html__( '-- Inherit --', 'blade' ),
									'none' => esc_html__( 'Full Width', 'blade' ),
									'left' => esc_html__( 'Left Sidebar', 'blade' ),
									'right' => esc_html__( 'Right Sidebar', 'blade' ),
								),
								'label' => array(
									"title" => esc_html__( 'Layout', 'blade' ),
									"desc" => esc_html__( 'Select page content and sidebar alignment.', 'blade' ),
									"info" => $grve_theme_options_info,
								),
							)
						);

						//Sidebar Option
						blade_grve_print_admin_option_wrapper_start(
							array(
								'type' => 'select',
								'label' => array(
									"title" => esc_html__( 'Sidebar', 'blade' ),
									"desc" => esc_html__( 'Select page sidebar.', 'blade' ),
									"info" => $grve_theme_options_info,
								),
							)
						);
						blade_grve_print_sidebar_selection( $grve_sidebar, 'grve_sidebar', 'grve_sidebar' );
						blade_grve_print_admin_option_wrapper_end();

						//Fixed Sidebar Option
						blade_grve_print_admin_option(
							array(
								'type' => 'select',
								'name' => 'grve_fixed_sidebar',
								'id' => 'grve_fixed_sidebar',
								'value' => $grve_fixed_sidebar,
								'options' => array(
									'no' => esc_html__( 'No', 'blade' ),
									'yes' => esc_html__( 'Yes', 'blade' ),
								),
								'label' => array(
									"title" => esc_html__( 'Fixed Sidebar', 'blade' ),
									"desc" => esc_html__( 'If selected, sidebar will be fixed.', 'blade' ),
								),
							)
						);

						//Posts Content Width
						if ( 'post' == $post_type ) {
							blade_grve_print_admin_option(
								array(
									'type' => 'select',
									'name' => 'grve_post_content_width',
									'id' => 'grve_post_content_width',
									'value' => $grve_post_content_width,
									'options' => array(
										'' => esc_html__( '-- Inherit --', 'blade' ),
										'1170' => esc_html__( 'Large' , 'blade' ),
										'990' => esc_html__( 'Medium' , 'blade' ),
										'600' => esc_html__( 'Small' , 'blade' ),
									),
									'label' => array(
										"title" => esc_html__( 'Post Content Width', 'blade' ),
										"desc" => esc_html__( 'Select the Single Post Content width (only for Full Width Post Layout)', 'blade' ),
										"info" => $grve_theme_options_info,
									),
								)
							);
						}

					?>
				</div>
				<div id="grve-page-option-tab-sliding-area" class="grve-tab-item">
					<?php
						//Sidearea Visibility
						blade_grve_print_admin_option(
							array(
								'type' => 'select',
								'name' => 'grve_sidearea_visibility',
								'id' => 'grve_sidearea_visibility',
								'value' => $grve_sidearea_visibility,
								'options' => array(
									'' => esc_html__( '-- Inherit --', 'blade' ),
									'no' => esc_html__( 'No', 'blade' ),
									'yes' => esc_html__( 'Yes', 'blade' ),
								),
								'label' => array(
									"title" => esc_html__( 'Sliding Area Visibility', 'blade' ),
									"info" => $grve_theme_options_info,
								),
							)
						);

						//Sidearea Sidebar Option
						blade_grve_print_admin_option_wrapper_start(
							array(
								'type' => 'select',
								'label' => array(
									"title" => esc_html__( 'Sliding Area Sidebar', 'blade' ),
									"desc" => esc_html__( 'Select sliding area sidebar.', 'blade' ),
									"info" => $grve_theme_options_info,
								),
							)
						);
						blade_grve_print_sidebar_selection( $grve_sidearea_sidebar, 'grve_sidearea_sidebar', 'grve_sidearea_sidebar' );
						blade_grve_print_admin_option_wrapper_end();
					?>
				</div>
				<div id="grve-page-option-tab-extras" class="grve-tab-item">
					<?php

						//Details Option
						if ( 'portfolio' == $post_type) {
							blade_grve_print_admin_option(
								array(
									'type' => 'textfield',
									'name' => 'grve_details_title',
									'id' => 'grve_details_title',
									'value' => $grve_details_title,
									'label' => array(
										'title' => esc_html__( 'Details Title', 'blade' ),
										'desc' => esc_html__( 'Enter your details title.', 'blade' ),
										'info' => $grve_theme_options_info_text_empty,
									),
									'width' => 'fullwidth',
								)
							);
							blade_grve_print_admin_option(
								array(
									'type' => 'textarea',
									'name' => 'grve_details',
									'id' => 'grve_details',
									'value' => $grve_details,
									'label' => array(
										'title' => esc_html__( 'Details Area', 'blade' ),
										'desc' => esc_html__( 'Enter your details area.', 'blade' ),
									),
									'width' => 'fullwidth',
								)
							);

							//Backlink page
							blade_grve_print_admin_option_wrapper_start(
								array(
									'type' => 'select',
									'label' => array(
										"title" => esc_html__( 'Backlink', 'blade' ),
										"desc" => esc_html__( 'Select your backlink page.', 'blade' ),
										"info" => $grve_theme_options_info,
									),
								)
							);
							blade_grve_print_page_selection( $grve_backlink_id, 'grve-backlink-id', 'grve_backlink_id' );
							blade_grve_print_admin_option_wrapper_end();


						}

						//Anchor Navigation Menu Option

						blade_grve_print_admin_option_wrapper_start(
							array(
								'type' => 'select',
								'label' => array(
									"title" => esc_html__( 'Anchor Navigation Menu', 'blade' ),
									"desc" => esc_html__( 'Select page anchor navigation menu.', 'blade' ),
								),
							)
						);
						blade_grve_print_menu_selection( $grve_anchor_navigation_menu, 'grve-page-navigation-menu', 'grve_anchor_navigation_menu' );
						blade_grve_print_admin_option_wrapper_end();

						//Sidearea Visibility
						blade_grve_print_admin_option(
							array(
								'type' => 'select',
								'name' => 'grve_theme_loader',
								'id' => 'grve_theme_loader',
								'value' => $grve_theme_loader,
								'options' => array(
									'' => esc_html__( '-- Inherit --', 'blade' ),
									'no' => esc_html__( 'No', 'blade' ),
									'yes' => esc_html__( 'Yes', 'blade' ),
								),
								'label' => array(
									"title" => esc_html__( 'Theme Loader Visibility', 'blade' ),
									"info" => esc_html__( 'Inherit : Theme Options - General Settings.', 'blade' ),
								),
							)
						);

					?>
				</div>
				<div id="grve-page-option-tab-visibility" class="grve-tab-item">
					<?php

						blade_grve_print_admin_option(
							array(
								'type' => 'checkbox',
								'name' => 'grve_disable_top_bar',
								'id' => 'grve_disable_top_bar',
								'value' => $grve_disable_top_bar,
								'label' => array(
									"title" => esc_html__( 'Disable Top Bar', 'blade' ),
									"desc" => esc_html__( 'If selected, top bar will be hidden.', 'blade' ),
								),
							)
						);

						blade_grve_print_admin_option(
							array(
								'type' => 'checkbox',
								'name' => 'grve_disable_sticky',
								'id' => 'grve_disable_sticky',
								'value' => $grve_disable_sticky,
								'label' => array(
									"title" => esc_html__( 'Disable Sticky Header', 'blade' ),
									"desc" => esc_html__( 'If selected, sticky header will be disabled.', 'blade' ),
								),
							)
						);

						blade_grve_print_admin_option(
							array(
								'type' => 'checkbox',
								'name' => 'grve_disable_logo',
								'id' => 'grve_disable_logo',
								'value' => $grve_disable_logo,
								'label' => array(
									"title" => esc_html__( 'Disable Logo', 'blade' ),
									"desc" => esc_html__( 'If selected, logo will be disabled.', 'blade' ),
								),
							)
						);
						blade_grve_print_admin_option(
							array(
								'type' => 'checkbox',
								'name' => 'grve_disable_menu',
								'id' => 'grve_disable_menu',
								'value' => $grve_disable_menu,
								'label' => array(
									"title" => esc_html__( 'Disable Main Menu', 'blade' ),
									"desc" => esc_html__( 'If selected, main menu will be hidden.', 'blade' ),
								),
							)
						);

						blade_grve_print_admin_option(
							array(
								'type' => 'checkbox',
								'name' => 'grve_disable_menu_item_search',
								'id' => 'grve_disable_menu_item_search',
								'value' => blade_grve_array_value( $grve_disable_menu_items, 'search'),
								'label' => array(
									"title" => esc_html__( 'Disable Main Menu Item Search', 'blade' ),
									"desc" => esc_html__( 'If selected, main menu item will be hidden.', 'blade' ),
								),
							)
						);
						blade_grve_print_admin_option(
							array(
								'type' => 'checkbox',
								'name' => 'grve_disable_menu_item_form',
								'id' => 'grve_disable_menu_item_form',
								'value' => blade_grve_array_value( $grve_disable_menu_items, 'form'),
								'label' => array(
									"title" => esc_html__( 'Disable Main Menu Item Contact Form', 'blade' ),
									"desc" => esc_html__( 'If selected, main menu item will be hidden.', 'blade' ),
								),
							)
						);
						blade_grve_print_admin_option(
							array(
								'type' => 'checkbox',
								'name' => 'grve_disable_menu_item_language',
								'id' => 'grve_disable_menu_item_language',
								'value' => blade_grve_array_value( $grve_disable_menu_items, 'language'),
								'label' => array(
									"title" => esc_html__( 'Disable Main Menu Item Language Selector', 'blade' ),
									"desc" => esc_html__( 'If selected, main menu item will be hidden.', 'blade' ),
								),
							)
						);
						blade_grve_print_admin_option(
							array(
								'type' => 'checkbox',
								'name' => 'grve_disable_menu_item_cart',
								'id' => 'grve_disable_menu_item_cart',
								'value' => blade_grve_array_value( $grve_disable_menu_items, 'cart'),
								'label' => array(
									"title" => esc_html__( 'Disable Main Menu Item Shopping Cart', 'blade' ),
									"desc" => esc_html__( 'If selected, main menu item will be hidden.', 'blade' ),
								),
							)
						);
						blade_grve_print_admin_option(
							array(
								'type' => 'checkbox',
								'name' => 'grve_disable_menu_item_social',
								'id' => 'grve_disable_menu_item_social',
								'value' => blade_grve_array_value( $grve_disable_menu_items, 'social'),
								'label' => array(
									"title" => esc_html__( 'Disable Main Menu Item Social Icons', 'blade' ),
									"desc" => esc_html__( 'If selected, main menu item will be hidden.', 'blade' ),
								),
							)
						);

						blade_grve_print_admin_option(
							array(
								'type' => 'checkbox',
								'name' => 'grve_disable_breadcrumbs',
								'id' => 'grve_disable_breadcrumbs',
								'value' => $grve_disable_breadcrumbs,
								'label' => array(
									"title" => esc_html__( 'Disable Breadcrumbs', 'blade' ),
									"desc" => esc_html__( 'If selected, breadcrumbs items will be hidden.', 'blade' ),
								),
							)
						);

						if ( 'page' == $post_type ) {
							if ( blade_grve_woocommerce_enabled() && $post->ID == wc_get_page_id( 'shop' ) ) {
								//Skip
							} else {
								blade_grve_print_admin_option(
									array(
										'type' => 'checkbox',
										'name' => 'grve_disable_content',
										'id' => 'grve_disable_content',
										'value' => $grve_disable_content,
										'label' => array(
											"title" => esc_html__( 'Disable Content Area', 'blade' ),
											"desc" => esc_html__( 'If selected, content area will be hidden (including sidebar and comments).', 'blade' ),
										),
									)
								);
							}
						}

						if ( 'post' == $post_type ) {
							blade_grve_print_admin_option(
								array(
									'type' => 'checkbox',
									'name' => 'grve_disable_media',
									'id' => 'grve_disable_media',
									'value' => $grve_disable_media,
									'label' => array(
										"title" => esc_html__( 'Disable Media Area', 'blade' ),
										"desc" => esc_html__( 'If selected, media area will be hidden.', 'blade' ),
									),
								)
							);
						}
						if ( 'portfolio' == $post_type ) {
							blade_grve_print_admin_option(
								array(
									'type' => 'checkbox',
									'name' => 'grve_disable_recent_entries',
									'id' => 'grve_disable_recent_entries',
									'value' => $grve_disable_recent_entries,
									'label' => array(
										"title" => esc_html__( 'Disable Recent Entries', 'blade' ),
										"desc" => esc_html__( 'If selected, recent entries area will be hidden.', 'blade' ),
									),
								)
							);
						}

						blade_grve_print_admin_option(
							array(
								'type' => 'checkbox',
								'name' => 'grve_disable_footer',
								'id' => 'grve_disable_footer',
								'value' => $grve_disable_footer,
								'label' => array(
									"title" => esc_html__( 'Disable Footer Widgets', 'blade' ),
									"desc" => esc_html__( 'If selected, footer widgets will be hidden.', 'blade' ),
								),
							)
						);

						blade_grve_print_admin_option(
							array(
								'type' => 'checkbox',
								'name' => 'grve_disable_copyright',
								'id' => 'grve_disable_copyright',
								'value' => $grve_disable_copyright,
								'label' => array(
									"title" => esc_html__( 'Disable Footer Copyright', 'blade' ),
									"desc" => esc_html__( 'If selected, footer copyright area will be hidden.', 'blade' ),
								),
							)
						);
						
						blade_grve_print_admin_option(
							array(
								'type' => 'checkbox',
								'name' => 'grve_disable_back_to_top',
								'id' => 'grve_disable_back_to_top',
								'value' => $grve_disable_back_to_top,
								'label' => array(
									"title" => esc_html__( 'Disable Back to Top', 'blade' ),
									"desc" => esc_html__( 'If selected, Back to Top button will be hidden.', 'blade' ),
								),
							)
						);

					?>
				</div>
			</div>
		</div>
	</div>

<?php
}

function blade_grve_page_feature_section_box( $post ) {

	wp_nonce_field( 'grve_nonce_save', 'grve_page_feature_save_nonce' );

	$post_id = $post->ID;
	blade_grve_admin_get_feature_section( $post_id );

}

function blade_grve_generic_options_save_postdata( $post_id , $post ) {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( isset( $_POST['grve_page_feature_save_nonce'] ) && wp_verify_nonce( $_POST['grve_page_feature_save_nonce'], 'grve_nonce_save' ) ) {

		if ( blade_grve_check_permissions( $post_id ) ) {
			blade_grve_admin_save_feature_section( $post_id );
		}

	}

	if ( isset( $_POST['grve_page_save_nonce'] ) && wp_verify_nonce( $_POST['grve_page_save_nonce'], 'grve_nonce_save' ) ) {

		if ( blade_grve_check_permissions( $post_id ) ) {

			$grve_page_options = array (
				array(
					'name' => 'Description',
					'id' => 'grve_description',
				),
				array(
					'name' => 'Details Title',
					'id' => 'grve_details_title',
				),
				array(
					'name' => 'Details',
					'id' => 'grve_details',
				),
				array(
					'name' => 'Backlink',
					'id' => 'grve_backlink_id',
				),
				array(
					'name' => 'Layout',
					'id' => 'grve_layout',
				),
				array(
					'name' => 'Sidebar',
					'id' => 'grve_sidebar',
				),
				array(
					'name' => 'Post Content width',
					'id' => 'grve_post_content_width',
				),
				array(
					'name' => 'Sidearea Area Visibility',
					'id' => 'grve_sidearea_visibility',
				),
				array(
					'name' => 'Sidearea Sidebar',
					'id' => 'grve_sidearea_sidebar',
				),
				array(
					'name' => 'Fixed Sidebar',
					'id' => 'grve_fixed_sidebar',
				),
				array(
					'name' => 'Header Overlapping',
					'id' => 'grve_header_overlapping',
				),
				array(
					'name' => 'Header Style',
					'id' => 'grve_header_style',
				),
				array(
					'name' => 'Navigation Anchor Menu',
					'id' => 'grve_anchor_navigation_menu',
				),
				array(
					'name' => 'Theme Loader',
					'id' => 'grve_theme_loader',
				),
				array(
					'name' => 'Main Navigation Menu',
					'id' => 'grve_main_navigation_menu',
				),
				array(
					'name' => 'Menu Type',
					'id' => 'grve_menu_type',
				),
				array(
					'name' => 'Sticky Header Type',
					'id' => 'grve_sticky_header_type',
				),
				array(
					'name' => 'Disable Sticky',
					'id' => 'grve_disable_sticky',
				),
				array(
					'name' => 'Disable Top Bar',
					'id' => 'grve_disable_top_bar',
				),
				array(
					'name' => 'Disable Logo',
					'id' => 'grve_disable_logo',
				),
				array(
					'name' => 'Disable Menu',
					'id' => 'grve_disable_menu',
				),
				array(
					'name' => 'Disable Menu Items',
					'id' => 'grve_disable_menu_items',
				),
				array(
					'name' => 'disable Breadcrumbs',
					'id' => 'grve_disable_breadcrumbs',
				),
				array(
					'name' => 'Disable Title',
					'id' => 'grve_disable_title',
				),
				array(
					'name' => 'Disable Media',
					'id' => 'grve_disable_media',
				),
				array(
					'name' => 'Disable Content',
					'id' => 'grve_disable_content',
				),
				array(
					'name' => 'Disable Recent Entries',
					'id' => 'grve_disable_recent_entries',
				),
				array(
					'name' => 'Disable Footer',
					'id' => 'grve_disable_footer',
				),
				array(
					'name' => 'Disable Copyright',
					'id' => 'grve_disable_copyright',
				),
				array(
					'name' => 'Disable Back to Top',
					'id' => 'grve_disable_back_to_top',
				),			
			);

			$grve_disable_menu_items_options = array (
				array(
					'param_id' => 'search',
					'id' => 'grve_disable_menu_item_search',
					'default' => '',
				),
				array(
					'param_id' => 'form',
					'id' => 'grve_disable_menu_item_form',
					'default' => '',
				),
				array(
					'param_id' => 'language',
					'id' => 'grve_disable_menu_item_language',
					'default' => '',
				),
				array(
					'param_id' => 'cart',
					'id' => 'grve_disable_menu_item_cart',
					'default' => '',
				),
				array(
					'param_id' => 'social',
					'id' => 'grve_disable_menu_item_social',
					'default' => '',
				),
			);

			$grve_page_title_options = array (
				array(
					'param_id' => 'custom',
					'id' => 'grve_page_title_custom',
					'default' => '',
				),
				array(
					'param_id' => 'height',
					'id' => 'grve_page_title_height',
					'default' => '350',
				),
				array(
					'param_id' => 'min_height',
					'id' => 'grve_page_title_min_height',
					'default' => '320',
				),
				array(
					'param_id' => 'bg_color',
					'id' => 'grve_page_title_bg_color',
					'default' => 'light',
				),
				array(
					'param_id' => 'bg_color_custom',
					'id' => 'grve_page_title_bg_color_custom',
					'default' => '#ffffff',
				),
				array(
					'param_id' => 'title_color',
					'id' => 'grve_page_title_title_color',
					'default' => 'dark',
				),
				array(
					'param_id' => 'title_color_custom',
					'id' => 'grve_page_title_title_color_custom',
					'default' => '#000000',
				),
				array(
					'param_id' => 'caption_color',
					'id' => 'grve_page_title_caption_color',
					'default' => 'dark',
				),
				array(
					'param_id' => 'caption_color_custom',
					'id' => 'grve_page_title_caption_color_custom',
					'default' => '#000000',
				),
				array(
					'param_id' => 'content_position',
					'id' => 'grve_page_title_content_position',
					'default' => 'center-center',
				),
				array(
					'param_id' => 'content_animation',
					'id' => 'grve_page_title_content_animation',
					'default' => 'fade-in',
				),
				array(
					'param_id' => 'bg_mode',
					'id' => 'grve_page_title_bg_mode',
					'default' => '',
				),
				array(
					'param_id' => 'bg_image_id',
					'id' => 'grve_page_title_bg_image_id',
					'default' => '0',
				),
				array(
					'param_id' => 'bg_position',
					'id' => 'grve_page_title_bg_position',
					'default' => 'center-center',
				),
				array(
					'param_id' => 'pattern_overlay',
					'id' => 'grve_page_title_pattern_overlay',
					'default' => '',
				),
				array(
					'param_id' => 'color_overlay',
					'id' => 'grve_page_title_color_overlay',
					'default' => 'dark',
				),
				array(
					'param_id' => 'color_overlay_custom',
					'id' => 'grve_page_title_color_overlay_custom',
					'default' => '#000000',
				),
				array(
					'param_id' => 'opacity_overlay',
					'id' => 'grve_page_title_opacity_overlay',
					'default' => '0',
				),
			);

			//Update Single custom fields
			foreach ( $grve_page_options as $value ) {
				$new_meta_value = ( isset( $_POST[$value['id']] ) ? $_POST[$value['id']] : '' );
				$meta_key = $value['id'];


				$meta_value = get_post_meta( $post_id, $meta_key, true );

				if ( $new_meta_value && '' == $meta_value ) {
					add_post_meta( $post_id, $meta_key, $new_meta_value, true );
				} elseif ( $new_meta_value && $new_meta_value != $meta_value ) {
					update_post_meta( $post_id, $meta_key, $new_meta_value );
				} elseif ( '' == $new_meta_value && $meta_value ) {
					delete_post_meta( $post_id, $meta_key );
				}
			}

			//Update Menu Items Visibility array
			blade_grve_update_meta_array( $post_id, 'grve_disable_menu_items', $grve_disable_menu_items_options );
			//Update Title Options array
			blade_grve_update_meta_array( $post_id, 'grve_custom_title_options', $grve_page_title_options );
		}
	}

}

/**
 * Function update meta array
 */
function blade_grve_update_meta_array( $post_id, $param_id, $param_array_options ) {

	$array_options = array();

	if( !empty( $param_array_options ) ) {

		foreach ( $param_array_options as $value ) {

			$meta_key = $value['param_id'];
			$meta_default = $value['default'];

			$new_meta_value = ( isset( $_POST[$value['id']] ) ? $_POST[$value['id']] : $meta_default );

			if( !empty( $new_meta_value ) ) {
				$array_options[$meta_key] = $new_meta_value;
			}
		}

	}

	if( !empty( $array_options ) ) {
		update_post_meta( $post_id, $param_id, $array_options );
	} else {
		delete_post_meta( $post_id, $param_id );
	}
}

/**
 * Function to check post type permissions
 */

function blade_grve_check_permissions( $post_id ) {

	if ( 'post' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_post', $post_id ) ) {
			return false;
		}
	} else {
		if ( !current_user_can( 'edit_page', $post_id ) ) {
			return false;
		}
	}
	return true;
}

/**
 * Function to print menu selector
 */
function blade_grve_print_menu_selection( $menu_id, $id, $name, $default = 'none' ) {

	?>
	<select id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>">
		<option value="" <?php selected( '', $menu_id ); ?>>
			<?php
				if ( 'none' == $default ){
					esc_html_e( 'None', 'blade' );
				} else {
					esc_html_e( '-- Inherit --', 'blade' );
				}
			?>
		</option>
	<?php
		$menus = wp_get_nav_menus();
		if ( ! empty( $menus ) ) {
			foreach ( $menus as $item ) {
	?>
				<option value="<?php echo esc_attr( $item->term_id ); ?>" <?php selected( $item->term_id, $menu_id ); ?>>
					<?php echo esc_html( $item->name ); ?>
				</option>
	<?php
			}
		}
	?>
	</select>
	<?php
}

/**
 * Function to print layout selector
 */
function blade_grve_print_layout_selection( $layout, $id, $name ) {

	$layouts = array(
		'' => esc_html__( '-- Inherit --', 'blade' ),
		'none' => esc_html__( 'Full Width', 'blade' ),
		'left' => esc_html__( 'Left Sidebar', 'blade' ),
		'right' => esc_html__( 'Right Sidebar', 'blade' ),
	);

	?>
	<select id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>">
	<?php
		foreach ( $layouts as $key => $value ) {
			if ( $value ) {
	?>
				<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $key, $layout ); ?>><?php echo esc_html( $value ); ?></option>
	<?php
			}
		}
	?>
	</select>
	<?php
}

/**
 * Function to print sidebar selector
 */
function blade_grve_print_sidebar_selection( $sidebar, $id, $name ) {
	global $wp_registered_sidebars;

	?>
	<select id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>">
		<option value="" <?php selected( '', $sidebar ); ?>><?php echo esc_html__( '-- Inherit --', 'blade' ); ?></option>
	<?php
	foreach ( $wp_registered_sidebars as $key => $value ) {
		?>
		<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $key, $sidebar ); ?>><?php echo esc_html( $value['name'] ); ?></option>
		<?php
	}
	?>
	</select>
	<?php
}

/**
 * Function to print page selector
 */
function blade_grve_print_page_selection( $page_id, $id, $name ) {

?>
	<select id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>">
		<option value="" <?php selected( '', $page_id ); ?>>
			<?php esc_html_e( '-- Inherit --', 'blade' ); ?>
		</option>
<?php
		$pages = get_pages();
		foreach ( $pages as $page ) {
?>
			<option value="<?php echo esc_attr( $page->ID ); ?>" <?php selected( $page->ID, $page_id ); ?>>
				<?php echo esc_html( $page->post_title ); ?>
			</option>
<?php
		}
?>
	</select>
<?php

}

//Omit closing PHP tag to avoid accidental whitespace output errors.
