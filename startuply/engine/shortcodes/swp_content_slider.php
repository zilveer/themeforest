<?php

/*-----------------------------------------------------------------------------------*/
/*	Content Slider VC Mapping (Backend)
/*-----------------------------------------------------------------------------------*/
			$tab_id_1 = 'slide' . time() . '-1-' . rand( 0, 100 );
			$tab_id_2 = 'slide' . time() . '-2-' . rand( 0, 100 );

			vc_map( array(
				"name" => __("Content Slider", "vivaco"),
				"base" => "vsc_content_slider",
				"weight" => 25,
				'show_settings_on_create' => true,
				'is_container' => true,
				'container_not_allowed' => true,
				'icon' => 'icon-wpb-ui-tab-content-vertical',
				'category' => __( 'Content', 'vivaco' ),
				'wrapper_class' => 'vc_clearfix',
				'description' => __( 'Simple content slider', 'js_composer' ),
				"params" => array(
					array(
						"type" => "checkbox",
						"heading" => __( "Slider Options", "vivaco" ),
						"param_name" => "slider_options",
						"value" => array(
							__( "Autoplay", "vivaco" ) => "autoplay",
							__( "Show pagination", "vivaco" ) => "pagination",
							__( "Show arrows", "vivaco" ) => "arrows",
							__( "Infinite loop", "vivaco" ) => "loop"
						)
					),
					array(
						"type" => "textfield",
						"heading" => "Speed",
						"param_name" => "speed",
						"description" => "Slide transition duration (in ms)"
					),
					array(
						"type" => "textfield",
						"heading" => "Autoplay delay",
						"param_name" => "autoplay_delay",
						"description" => "The amount of time (in ms) between each auto transition"
					),
					array(
						"type" => "textfield",
						"heading" => __("Extra class name", "vivaco"),
						"param_name" => "el_class",
						"description" => __("Some simple params.", "vivaco")
					),
					array(
						'type' => 'css_editor',
						'heading' => __( 'Css', 'js_composer' ),
						'param_name' => 'css',
						'group' => __( 'Padding & Margins', 'js_composer' )
					)
				),
				'custom_markup' => '
				<div class="wpb_tabs_holder wpb_holder vc_clearfix vc_container_for_children">
				<ul class="tabs_controls"></ul>
				%content%
				</div>'
				,
				'default_content' => '
				[vc_tab title="' . __( 'Slide 1', 'vivaco' ) . '" tab_id="' . $tab_id_1 . '"][/vc_tab]
				[vc_tab title="' . __( 'Slide 2', 'vivaco' ) . '" tab_id="' . $tab_id_2 . '"][/vc_tab]
				',
					'js_view' => 'VcTabsView'
			));





/*-----------------------------------------------------------------------------------*/
/*	Content Slider Render (Front-end)
/*-----------------------------------------------------------------------------------*/
/* Note. Render Frontend in vc_templates/vsc_content_slider.php */
