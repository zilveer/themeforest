<?php

if ( ! function_exists('suprema_qodef_fullscreen_menu_options_map')) {

	function suprema_qodef_fullscreen_menu_options_map() {

		suprema_qodef_add_admin_page(
			array(
				'slug' => '_fullscreen_menu_page',
				'title' => 'Fullscreen Menu',
				'icon' => 'fa fa-arrows-alt'
			)
		);

		$fullscreen_panel = suprema_qodef_add_admin_panel(
			array(
				'title' => 'Fullscreen Menu',
				'name' => 'fullscreen_menu',
				'page' => '_fullscreen_menu_page'
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $fullscreen_panel,
				'type' => 'select',
				'name' => 'fullscreen_menu_animation_style',
				'default_value' => 'fade-push-text-right',
				'label' => 'Fullscreen Menu Overlay Animation',
				'description' => 'Choose animation type for fullscreen menu overlay',
				'options' => array(
					'fade-push-text-right' => 'Fade Push Text Right',
					'fade-push-text-top' => 'Fade Push Text Top',
					'fade-text-scaledown' => 'Fade Text Scaledown'
				)
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $fullscreen_panel,
				'type' => 'image',
				'name' => 'fullscreen_logo',
				'default_value' => '',
				'label' => 'Logo in Fullscreen Menu Overlay',
				'description' => 'Place logo in top left corner of fullscreen menu overlay',
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $fullscreen_panel,
				'type' => 'yesno',
				'name' => 'fullscreen_in_grid',
				'default_value' => 'no',
				'label' => 'Fullscreen Menu in Grid',
				'description' => 'Enabling this option will put fullscreen menu content in grid',
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $fullscreen_panel,
				'type' => 'selectblank',
				'name' => 'fullscreen_alignment',
				'default_value' => '',
				'label' => 'Fullscreen Menu Alignment',
				'description' => 'Choose alignment for fullscreen menu content',
				'options' => array(
					"left" => "Left",
					"center" => "Center",
					"right" => "Right"
				)
			)
		);

		$background_group = suprema_qodef_add_admin_group(
			array(
				'parent' => $fullscreen_panel,
				'name' => 'background_group',
				'title' => 'Background',
				'description' => 'Select a background color and transparency for Fullscreen Menu (0 = fully transparent, 1 = opaque)'

			)
		);

		$background_group_row = suprema_qodef_add_admin_row(
			array(
				'parent' => $background_group,
				'name' => 'background_group_row'
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $background_group_row,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_background_color',
				'default_value' => '',
				'label' => 'Background Color'
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $background_group_row,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_background_transparency',
				'default_value' => '',
				'label' => 'Transparency (values:0-1)'
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $fullscreen_panel,
				'type' => 'image',
				'name' => 'fullscreen_menu_background_image',
				'default_value' => '',
				'label' => 'Background Image',
				'description' => 'Choose a background image for Fullscreen Menu background'
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $fullscreen_panel,
				'type' => 'image',
				'name' => 'fullscreen_menu_pattern_image',
				'default_value' => '',
				'label' => 'Pattern Background Image',
				'description' => 'Choose a pattern image for Fullscreen Menu background'
			)
		);

//1st level style group
		$first_level_style_group = suprema_qodef_add_admin_group(
			array(
				'parent' => $fullscreen_panel,
				'name' => 'first_level_style_group',
				'title' => '1st Level Style',
				'description' => 'Define styles for 1st level in Fullscreen Menu'
			)
		);

		$first_level_style_row1 = suprema_qodef_add_admin_row(
			array(
				'parent' => $first_level_style_group,
				'name' => 'first_level_style_row1'
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $first_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_color',
				'default_value' => '',
				'label' => 'Text Color',
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $first_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_hover_color',
				'default_value' => '',
				'label' => 'Hover Text Color',
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $first_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_active_color',
				'default_value' => '',
				'label' => 'Active Text Color',
			)
		);

		$first_level_style_row2 = suprema_qodef_add_admin_row(
			array(
				'parent' => $first_level_style_group,
				'name' => 'first_level_style_row2'
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $first_level_style_row2,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_hover_background_color',
				'default_value' => '',
				'label' => 'Background Hover Color',
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $first_level_style_row2,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_active_background_color',
				'default_value' => '',
				'label' => 'Background Active Color',
			)
		);

		$first_level_style_row3 = suprema_qodef_add_admin_row(
			array(
				'parent' => $first_level_style_group,
				'name' => 'first_level_style_row3'
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $first_level_style_row3,
				'type' => 'fontsimple',
				'name' => 'fullscreen_menu_google_fonts',
				'default_value' => '-1',
				'label' => 'Font Family',
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $first_level_style_row3,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_fontsize',
				'default_value' => '',
				'label' => 'Font Size',
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $first_level_style_row3,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_lineheight',
				'default_value' => '',
				'label' => 'Line Height',
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		$first_level_style_row4 = suprema_qodef_add_admin_row(
			array(
				'parent' => $first_level_style_group,
				'name' => 'first_level_style_row4'
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $first_level_style_row4,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_fontstyle',
				'default_value' => '',
				'label' => 'Font Style',
				'options' => suprema_qodef_get_font_style_array()
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $first_level_style_row4,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_fontweight',
				'default_value' => '',
				'label' => 'Font Weight',
				'options' => suprema_qodef_get_font_weight_array()
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $first_level_style_row4,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_letterspacing',
				'default_value' => '',
				'label' => 'Letter Spacing',
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $first_level_style_row4,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_texttransform',
				'default_value' => '',
				'label' => 'Text Transform',
				'options' => suprema_qodef_get_text_transform_array()
			)
		);

//2nd level style group
		$second_level_style_group = suprema_qodef_add_admin_group(
			array(
				'parent' => $fullscreen_panel,
				'name' => 'second_level_style_group',
				'title' => '2nd Level Style',
				'description' => 'Define styles for 2nd level in Fullscreen Menu'
			)
		);

		$second_level_style_row1 = suprema_qodef_add_admin_row(
			array(
				'parent' => $second_level_style_group,
				'name' => 'second_level_style_row1'
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $second_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_color_2nd',
				'default_value' => '',
				'label' => 'Text Color',
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $second_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_hover_color_2nd',
				'default_value' => '',
				'label' => 'Hover Text Color',
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $second_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_hover_background_color_2nd',
				'default_value' => '',
				'label' => 'Background Hover Color',
			)
		);

		$second_level_style_row2 = suprema_qodef_add_admin_row(
			array(
				'parent' => $second_level_style_group,
				'name' => 'second_level_style_row2'
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $second_level_style_row2,
				'type' => 'fontsimple',
				'name' => 'fullscreen_menu_google_fonts_2nd',
				'default_value' => '-1',
				'label' => 'Font Family',
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $second_level_style_row2,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_fontsize_2nd',
				'default_value' => '',
				'label' => 'Font Size',
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $second_level_style_row2,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_lineheight_2nd',
				'default_value' => '',
				'label' => 'Line Height',
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		$second_level_style_row3 = suprema_qodef_add_admin_row(
			array(
				'parent' => $second_level_style_group,
				'name' => 'second_level_style_row3'
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $second_level_style_row3,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_fontstyle_2nd',
				'default_value' => '',
				'label' => 'Font Style',
				'options' => suprema_qodef_get_font_style_array()
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $second_level_style_row3,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_fontweight_2nd',
				'default_value' => '',
				'label' => 'Font Weight',
				'options' => suprema_qodef_get_font_weight_array()
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $second_level_style_row3,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_letterspacing_2nd',
				'default_value' => '',
				'label' => 'Letter Spacing',
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $second_level_style_row3,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_texttransform_2nd',
				'default_value' => '',
				'label' => 'Text Transform',
				'options' => suprema_qodef_get_text_transform_array()
			)
		);

		$third_level_style_group = suprema_qodef_add_admin_group(
			array(
				'parent' => $fullscreen_panel,
				'name' => 'third_level_style_group',
				'title' => '3rd Level Style',
				'description' => 'Define styles for 3rd level in Fullscreen Menu'
			)
		);

		$third_level_style_row1 = suprema_qodef_add_admin_row(
			array(
				'parent' => $third_level_style_group,
				'name' => 'third_level_style_row1'
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $third_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_color_3rd',
				'default_value' => '',
				'label' => 'Text Color',
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $third_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_hover_color_3rd',
				'default_value' => '',
				'label' => 'Hover Text Color',
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $third_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_hover_background_color_3rd',
				'default_value' => '',
				'label' => 'Background Hover Color',
			)
		);

		$third_level_style_row2 = suprema_qodef_add_admin_row(
			array(
				'parent' => $third_level_style_group,
				'name' => 'second_level_style_row2'
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $third_level_style_row2,
				'type' => 'fontsimple',
				'name' => 'fullscreen_menu_google_fonts_3rd',
				'default_value' => '-1',
				'label' => 'Font Family',
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $third_level_style_row2,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_fontsize_3rd',
				'default_value' => '',
				'label' => 'Font Size',
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $third_level_style_row2,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_lineheight_3rd',
				'default_value' => '',
				'label' => 'Line Height',
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		$third_level_style_row3 = suprema_qodef_add_admin_row(
			array(
				'parent' => $third_level_style_group,
				'name' => 'second_level_style_row3'
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $third_level_style_row3,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_fontstyle_3rd',
				'default_value' => '',
				'label' => 'Font Style',
				'options' => suprema_qodef_get_font_style_array()
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $third_level_style_row3,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_fontweight_3rd',
				'default_value' => '',
				'label' => 'Font Weight',
				'options' => suprema_qodef_get_font_weight_array()
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $third_level_style_row3,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_letterspacing_3rd',
				'default_value' => '',
				'label' => 'Letter Spacing',
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $third_level_style_row3,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_texttransform_3rd',
				'default_value' => '',
				'label' => 'Text Transform',
				'options' => suprema_qodef_get_text_transform_array()
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $fullscreen_panel,
				'type' => 'select',
				'name' => 'fullscreen_menu_icon_size',
				'label' => 'Fullscreen Menu Icon Size',
				'description' => 'Choose predefined size for Fullscreen Menu icon',
				'default_value' => 'normal',
				'options' => array(
					'normal' => 'Normal',
					'medium' => 'Medium',
					'large' => 'Large'
				)

			)
		);

		$icon_colors_group = suprema_qodef_add_admin_group(
			array(
				'parent' => $fullscreen_panel,
				'name' => 'fullscreen_menu_icon_colors_group',
				'title' => 'Full Screen Menu Icon Style',
				'description' => 'Define styles for Fullscreen Menu Icon'
			)
		);

		$icon_colors_row1 = suprema_qodef_add_admin_row(
			array(
				'parent' => $icon_colors_group,
				'name' => 'icon_colors_row1'
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $icon_colors_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_icon_color',
				'label' => 'Color',
			)
		);
		suprema_qodef_add_admin_field(
			array(
				'parent' => $icon_colors_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_icon_hover_color',
				'label' => 'Hover Color',
			)
		);
		$icon_colors_row2 = suprema_qodef_add_admin_row(
			array(
				'parent' => $icon_colors_group,
				'name' => 'icon_colors_row2',
				'next' => true
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $icon_colors_row2,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_light_icon_color',
				'label' => 'Light Menu Icon Color',
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $icon_colors_row2,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_light_icon_hover_color',
				'label' => 'Light Menu Icon Hover Color',
			)
		);

		$icon_colors_row3 = suprema_qodef_add_admin_row(
			array(
				'parent' => $icon_colors_group,
				'name' => 'icon_colors_row3',
				'next' => true
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $icon_colors_row3,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_dark_icon_color',
				'label' => 'Dark Menu Icon Color',
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $icon_colors_row3,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_dark_icon_hover_color',
				'label' => 'Dark Menu Icon Hover Color',
			)
		);

		$icon_colors_row4 = suprema_qodef_add_admin_row(
			array(
				'parent' => $icon_colors_group,
				'name' => 'icon_colors_row4',
				'next' => true
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $icon_colors_row4,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_icon_background_color',
				'label' => 'Background Color',
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $icon_colors_row4,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_icon_background_hover_color',
				'label' => 'Background Hover Color',
			)
		);

		$icon_spacing_group = suprema_qodef_add_admin_group(
			array(
				'parent' => $fullscreen_panel,
				'name' => 'icon_spacing_group',
				'title' => 'Full Screen Menu Icon Spacing',
				'description' => 'Define padding and margin for full screen menu icon'
			)
		);

		$icon_spacing_row = suprema_qodef_add_admin_row(
			array(
				'parent' => $icon_spacing_group,
				'name' => 'icon_spacing_row'
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $icon_spacing_row,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_icon_padding_left',
				'default_value' => '',
				'label' => 'Padding Left',
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $icon_spacing_row,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_icon_padding_right',
				'default_value' => '',
				'label' => 'Padding Right',
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $icon_spacing_row,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_icon_margin_left',
				'default_value' => '',
				'label' => 'Margin Left',
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		suprema_qodef_add_admin_field(
			array(
				'parent' => $icon_spacing_row,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_icon_margin_right',
				'default_value' => '',
				'label' => 'Margin Right',
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

	}

	add_action('suprema_qodef_options_map', 'suprema_qodef_fullscreen_menu_options_map', 15);

}