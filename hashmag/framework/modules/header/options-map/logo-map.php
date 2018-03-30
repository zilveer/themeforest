<?php

if ( ! function_exists('hashmag_mikado_logo_options_map') ) {

	function hashmag_mikado_logo_options_map() {

		$panel_logo = hashmag_mikado_add_admin_panel(
			array(
				'page' => '',
				'name' => 'panel_logo',
				'title' => 'Branding'
			)
		);

		hashmag_mikado_add_admin_field(
			array(
				'parent' => $panel_logo,
				'type' => 'yesno',
				'name' => 'hide_logo',
				'default_value' => 'no',
				'label' => 'Hide Logo',
				'description' => 'Enabling this option will hide logo image',
				'args' => array(
					"dependence" => true,
					"dependence_hide_on_yes" => "#mkdf_hide_logo_container",
					"dependence_show_on_yes" => ""
				)
			)
		);

        $hide_logo_container = hashmag_mikado_add_admin_container(
			array(
				'parent' => $panel_logo,
				'name' => 'hide_logo_container',
				'hidden_property' => 'hide_logo',
				'hidden_value' => 'yes'
			)
		);

        hashmag_mikado_add_admin_field(
            array(
                'parent' => $hide_logo_container,
                'name' => 'logo_position',
                'type' => 'select',
                'default_value' => 'left',
                'label' => 'Logo position',
                'description' => 'Choose a logo position',
                'options' => array(
                    'center' => 'Center',
                    'left' => 'Left'
                )
            )
        );

		hashmag_mikado_add_admin_field(
			array(
				'name' => 'logo_image',
				'type' => 'image',
				'default_value' => MIKADO_ASSETS_ROOT."/img/logo.png",
				'label' => 'Logo Image - Default',
				'description' => 'Choose a default logo image to display ',
				'parent' => $hide_logo_container
			)
		);

        hashmag_mikado_add_admin_field(
            array(
                'name' => 'logo_image_dark',
                'type' => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo.png",
                'label' => 'Logo Image - Dark',
                'description' => 'Choose a default logo image to display ',
                'parent' => $hide_logo_container
            )
        );

        hashmag_mikado_add_admin_field(
            array(
                'name' => 'logo_image_light',
                'type' => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo.png",
                'label' => 'Logo Image - Light',
                'description' => 'Choose a default logo image to display ',
                'parent' => $hide_logo_container
            )
        );

        hashmag_mikado_add_admin_field(
            array(
                'name' => 'logo_image_transparent',
                'type' => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo-transparent.png",
                'label' => 'Logo Image - Transparent',
                'description' => 'Choose a default logo image to display ',
                'parent' => $hide_logo_container
            )
        );

		hashmag_mikado_add_admin_field(
			array(
				'name' => 'logo_image_sticky',
				'type' => 'image',
				'default_value' => MIKADO_ASSETS_ROOT."/img/logo-sticky.png",
				'label' => 'Logo Image - Sticky',
				'description' => 'Choose a default logo image to display',
				'parent' => $hide_logo_container
			)
		);

		hashmag_mikado_add_admin_field(
			array(
				'name' => 'logo_image_mobile',
				'type' => 'image',
				'default_value' => MIKADO_ASSETS_ROOT."/img/logo-mobile.png",
				'label' => 'Logo Image - Mobile',
				'description' => 'Choose a default logo image to display ',
				'parent' => $hide_logo_container
			)
		);
	}

    add_action('hashmag_mikado_before_general_options_map', 'hashmag_mikado_logo_options_map');

}