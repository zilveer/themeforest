<?php

/* DOCUMENTATION: Fonts
CATEGORY: Customizing
In Appearance > Customize > Typography you can change the various font styles and sizes. The list of fonts comes from Google Fonts. You can see what all the different fonts look like from here: https://www.google.com/fonts
This feature is provided by the Easy Google Fonts plugin. This plugin is recommended and should be installed.
ADVANCED: Custom selectors can be added in Settings > Google Fonts
FILES: dtbaker.theme_options.php
*/

if ( ! defined( 'ABSPATH' ) ) exit;


add_filter( 'tt_font_get_option_parameters', 'boutique_google_fonts', 100 );
function boutique_google_fonts( $options ) {

	//    update_option('tt_font_theme_options',array());
	//    print_r(get_option('tt_font_theme_options'));exit;
	array_unshift_assoc( $options, 'boutique_buttons', array(
		'name'        => 'boutique_buttons',
		'title'       => __( 'Buttons', 'boutique-kids' ),
		'description' => __( 'Please select a font the buttons', 'boutique-kids' ),
		'properties'  => array( 'selector' => '.dtbaker_button_light, .woocommerce-page .woocommerce-breadcrumb, .post-type-archive-product .woocommerce-breadcrumb, .boutique_button, .boutique_button:link, .boutique_button:visited, .wpcf7 .wpcf7-submit, a.boutique_blog_more,a.boutique_blog_more:link,a.boutique_blog_more:hover, #submit, .woocommerce a.button, .woocommerce a.button:hover, .woocommerce button.button, .woocommerce button.button.alt.single_add_to_cart_button, .widget.woocommerce .button,.widget.woocommerce .button:hover' ),
		'default'     => array(
			'font_id'           => 'lobster',
			'font_name'         => 'Lobster',
			'font_weight'       => '400',
			'font_style'        => 'normal',
			'font_weight_style' => 'regular',
			'stylesheet_url'    => 'https://fonts.googleapis.com/css?family=Lobster:regular',
			'font_color'        => '#4c4638',
			'font_size'         => array(
				'amount' => '14',
				'unit'   => 'px',
			),
			'padding_left'      => array(
				'amount' => '5',
				'unit'   => 'px',
			),
			'padding_right'     => array(
				'amount' => '5',
				'unit'   => 'px',
			),
			'padding_top'       => array(
				'amount' => '4',
				'unit'   => 'px',
			),
			'padding_bottom'    => array(
				'amount' => '4',
				'unit'   => 'px',
			),
		),
	) );
	array_unshift_assoc( $options, 'boutique_widget_headers', array(
		'name'        => 'boutique_widget_headers',
		'title'       => __( 'Widget Header', 'boutique-kids' ),
		'description' => __( "Please select settings for the theme's widget header", 'boutique-kids' ),
		'properties'  => array( 'selector' => '.widget-title, .widget_box_style .textwidget, .sidebar .widget_search .widget_content .searchform .searchsubmit, .widget .widget_content h4' ),
		'default'     => array(
			'font_id'           => 'lobster',
			'font_name'         => 'Lobster',
			'font_weight'       => '400',
			'font_style'        => 'normal',
			'font_weight_style' => 'regular',
			'stylesheet_url'    => 'https://fonts.googleapis.com/css?family=Lobster:regular',
			'font_size'         => array(
				'amount' => '18',
				'unit'   => 'px',
			),
			'font_color'        => '#4a4339',
		),
	) );
	array_unshift_assoc( $options, 'boutique_header_buttons', array(
		'name'        => 'boutique_header_buttons',
		'title'       => __( 'Header Buttons', 'boutique-kids' ),
		'description' => __( "Please select settings for the theme's header button text", 'boutique-kids' ),
		'properties'  => array( 'selector' => '.header_button_wrap span.title' ),
		'default'     => array(
			'font_id'           => 'lobster',
			'font_name'         => 'Lobster',
			'font_weight'       => '400',
			'font_style'        => 'normal',
			'font_weight_style' => 'regular',
			'stylesheet_url'    => 'https://fonts.googleapis.com/css?family=Lobster:regular',
			'font_size'         => array(
				'amount' => '24',
				'unit'   => 'px',
			),
			'font_color'        => '#ffffff',
		),
	) );
	array_unshift_assoc( $options, 'boutique_widgets', array(
		'name'        => 'boutique_widgets',
		'title'       => __( 'Widget Content', 'boutique-kids' ),
		'description' => __( "Please select settings for the theme's widget areas", 'boutique-kids' ),
		'properties'  => array( 'selector' => '.sidebar .widget .widget_content, #footer_widgets .widget_content, .widget a, .widget a:link' ),
		'default'     => array(
			'font_style'     => 'normal',
			'font_color'     => '#4a4339',
			'font_size'      => array(
				'amount' => '13',
				'unit'   => 'px',
			),
			'border_left_color' => '#FFFFFF',
		),
	) );

	array_unshift_assoc( $options, 'boutique_blog', array(
		'name'        => 'boutique_blog',
		'title'       => __( 'Blog Headings', 'boutique-kids' ),
		'description' => __( "Please select settings for the theme's blog posts", 'boutique-kids' ),
		'properties'  => array( 'selector' => '.blog.post h2 a' ),
		'default'     => array(
			'font_id'           => 'lobster',
			'font_name'         => 'Lobster',
			'font_weight'       => '400',
			'font_style'        => 'normal',
			'font_weight_style' => 'regular',
			'stylesheet_url'    => 'https://fonts.googleapis.com/css?family=Lobster:regular',
			'font_color'        => '#4a4339',
			'font_size'         => array(
				'amount' => '24',
				'unit'   => 'px',
			),
		),
	) );
	array_unshift_assoc( $options, 'boutique_body_all', array(
		'name'        => 'boutique_body_all',
		'title'       => __( 'Body Font', 'boutique-kids' ),
		'description' => __( "Please select settings for the theme's body area", 'boutique-kids' ),
		'properties'  => array( 'selector' => 'body' ),
		'default'     => array(
			'font_id'           => 'lora',
			'font_name'         => 'Lora',
			'font_weight'       => '400',
			'font_style'        => 'normal',
			'font_weight_style' => 'regular',
			'stylesheet_url'    => 'https://fonts.googleapis.com/css?family=Lora:regular',
			'font_color'        => '#4a4339',
			'font_size'         => array(
				'amount' => '13',
				'unit'   => 'px',
			),
		),
	) );
	array_unshift_assoc( $options, 'boutique_slideshow', array(
		'name'        => 'boutique_slideshow',
		'title'       => __( 'Slideshow', 'boutique-kids' ),
		'description' => __( 'Please select a font for the diagonal slideshow text', 'boutique-kids' ),
		'properties'  => array( 'selector' => '.flex-caption, a.flex-caption' ),
		'default'     => array(
			'font_id'           => 'lora',
			'font_name'         => 'Lora',
			'font_weight'       => '400',
			'font_style'        => 'italic',
			'font_weight_style' => 'italic',
			'stylesheet_url'    => 'https://fonts.googleapis.com/css?family=Lora:regular',
			'font_color'        => '#4a4339'
		),
	) );
	array_unshift_assoc( $options, 'boutique_gallery_buttons', array(
		'name'        => 'boutique_gallery_buttons',
		'title'       => __( 'Gallery Pretty Text', 'boutique-kids' ),
		'description' => __( 'Please select a font for the diagonal slideshow text', 'boutique-kids' ),
		'properties'  => array( 'selector' => '.gallery-dtbaker-pretty .dtbaker-pretty-title, .gallery-dtbaker-pretty .gallery-caption.wp-caption-text' ),
		'default'     => array(
			'font_id'           => 'lobster',
			'font_name'         => 'Lobster',
			'font_weight'       => '400',
			'font_style'        => 'normal',
			'font_weight_style' => 'regular',
			'stylesheet_url'    => 'https://fonts.googleapis.com/css?family=Lobster:regular',
			'font_color'        => '#4a4339'
		),
	) );
	array_unshift_assoc( $options, 'boutique_menu', array(
		'name'        => 'boutique_menu',
		'title'       => __( 'Menu', 'boutique-kids' ),
		'description' => __( "Please select a font for the theme's menu text", 'boutique-kids' ),
		'properties'  => array( 'selector' => '#menu_container, #menu_container a, .dtbaker_icon_text h3' ),
		'default'     => array(
			'font_id'           => 'lora',
			'font_name'         => 'Lora',
			'font_weight'       => '400',
			'font_style'        => 'italic',
			'font_weight_style' => 'italic',
			'stylesheet_url'    => 'https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic',
			'font_color'        => '#4b4239',
			'font_size'         => array(
				'amount' => '16',
				'unit'   => 'px',
			),
			/*'border_right_color' => '#EDEDED',
			'border_right_style' => 'solid',
				'border_right_width' => array(
					'amount' => '1',
					'unit' => 'px',
				)*/
		),
	) );
	array_unshift_assoc( $options, 'boutique_logo', array(
		'name'        => 'boutique_logo',
		'title'       => __( 'Logo', 'boutique-kids' ),
		'description' => __( "Please select a font for the theme's logo text", 'boutique-kids' ),
		'properties'  => array( 'selector' => '#logo a span' ),
		'default'     => array(
			'font_id'           => 'lobster',
			'font_name'         => 'Lobster',
			'font_weight'       => '400',
			'font_style'        => 'normal',
			'font_weight_style' => 'regular',
			'stylesheet_url'    => 'https://fonts.googleapis.com/css?family=Lobster:regular',
			'font_color'        => '#4b4239',
			'font_size'         => array(
				'amount' => '60',
				'unit'   => 'px',
			),
			'padding_top'       => array(
				'amount' => '12',
				'unit'   => 'px',
			),
		),
	) );

	array_unshift_assoc( $options, 'dtbaker_banner', array(
		'name'        => 'dtbaker_banner',
		'title'       => __( 'Banner Text', 'boutique-kids' ),
		'description' => __( 'Please select a font for the banner text', 'boutique-kids' ),
		'properties'  => array( 'selector' => '.dtbaker_banner' ),
		'default'     => array(
			'font_id'           => 'lobster',
			'font_name'         => 'Lobster',
			'font_weight'       => '400',
			'font_style'        => 'normal',
			'font_weight_style' => 'regular',
			'stylesheet_url'    => 'https://fonts.googleapis.com/css?family=Lobster:regular',
		),
	) );

	$options['tt_default_heading_1'] = wp_parse_args( $options['tt_default_heading_1'], array(
		'default' => array(
			'font_id'           => 'lobster',
			'font_name'         => 'Lobster',
			'font_weight'       => '400',
			'font_style'        => 'normal',
			'font_weight_style' => 'regular',
			'stylesheet_url'    => 'https://fonts.googleapis.com/css?family=Lobster:regular',
			'font_color'        => '#4a4339',
			'font_size'         => array(
				'amount' => '34',
				'unit'   => 'px',
			),
			'margin_bottom'       => array(
				'amount' => '15',
				'unit'   => 'px',
			),
		),
	) );
	$options['tt_default_heading_2'] = wp_parse_args( $options['tt_default_heading_2'], array(
		'default' => array(
			'font_id'           => 'lobster',
			'font_name'         => 'Lobster',
			'font_weight'       => '400',
			'font_style'        => 'normal',
			'font_weight_style' => 'regular',
			'stylesheet_url'    => 'https://fonts.googleapis.com/css?family=Lobster:regular',
			'font_color'        => '#4a4339',
			'font_size'         => array(
				'amount' => '28',
				'unit'   => 'px',
			),
			'padding_top'       => array(
				'amount' => '15',
				'unit'   => 'px',
			),
		),
	) );

	$options['tt_default_heading_3'] = wp_parse_args( $options['tt_default_heading_3'], array(
		'default' => array(
			'font_id'           => 'lora',
			'font_name'         => 'Lora',
			'font_weight'       => '400',
			'font_style'        => 'normal',
			'font_weight_style' => 'regular',
			'stylesheet_url'    => 'https://fonts.googleapis.com/css?family=Lora:regular',
			'font_color'        => '#4a4339',
		),
	) );


	unset( $options['tt_default_heading_4'] );
	unset( $options['tt_default_heading_5'] );
	unset( $options['tt_default_heading_6'] );

	/*Array
	(
    [title] => Logo
    [type] => font
    [description] => Please select a font for the theme's logo text
    [section] => default
    [tab] => typography
    [transport] => postMessage
    [since] => 1.2
    [properties] => Array
        (
            [selector] => #logo span
            [force_styles] =>
            [font_size_min_range] => 10
            [font_size_max_range] => 100
            [font_size_step] => 1
            [line_height_min_range] => 0.8
            [line_height_max_range] => 4
            [line_height_step] => 0.1
            [letter_spacing_min_range] => -5
            [letter_spacing_max_range] => 20
            [letter_spacing_step] => 1
            [margin_min_range] => 0
            [margin_max_range] => 400
            [margin_step] => 1
            [padding_min_range] => 0
            [padding_max_range] => 400
            [padding_step] => 1
            [border_min_range] => 0
            [border_max_range] => 100
            [border_step] => 1
            [border_radius_min_range] => 0
            [border_radius_max_range] => 100
            [border_radius_step] => 1
        )

    [default] => Array
        (
            [subset] => latin,all
            [font_id] =>
            [font_name] =>
            [font_color] => #26a0a3
            [font_weight] =>
            [font_style] =>
            [font_weight_style] =>
            [background_color] =>
            [stylesheet_url] =>
            [text_decoration] =>
            [text_transform] =>
            [line_height] =>
            [display] =>
            [font_size] => Array
                (
                    [amount] =>
                    [unit] => px
                )

            [letter_spacing] => Array
                (
                    [amount] =>
                    [unit] => px
                )

            [margin_top] => Array
                (
                    [amount] =>
                    [unit] => px
                )

            [margin_right] => Array
                (
                    [amount] =>
                    [unit] => px
                )

            [margin_bottom] => Array
                (
                    [amount] =>
                    [unit] => px
                )

            [margin_left] => Array
                (
                    [amount] =>
                    [unit] => px
                )

            [padding_top] => Array
                (
                    [amount] =>
                    [unit] => px
                )

            [padding_right] => Array
                (
                    [amount] =>
                    [unit] => px
                )

            [padding_bottom] => Array
                (
                    [amount] =>
                    [unit] => px
                )

            [padding_left] => Array
                (
                    [amount] =>
                    [unit] => px
                )

            [border_radius_top_left] => Array
                (
                    [amount] =>
                    [unit] => px
                )

            [border_radius_top_right] => Array
                (
                    [amount] =>
                    [unit] => px
                )

            [border_radius_bottom_right] => Array
                (
                    [amount] =>
                    [unit] => px
                )

            [border_radius_bottom_left] => Array
                (
                    [amount] =>
                    [unit] => px
                )

            [border_top_color] =>
            [border_top_style] =>
            [border_top_width] => Array
                (
                    [amount] =>
                    [unit] => px
                )

            [border_bottom_color] =>
            [border_bottom_style] =>
            [border_bottom_width] => Array
                (
                    [amount] =>
                    [unit] => px
                )

            [border_left_color] =>
            [border_left_style] =>
            [border_left_width] => Array
                (
                    [amount] =>
                    [unit] => px
                )

            [border_right_color] =>
            [border_right_style] =>
            [border_right_width] => Array
                (
                    [amount] =>
                    [unit] => px
                )

        )

    [name] => boutique_logo
	)*/

	return $options;
}


