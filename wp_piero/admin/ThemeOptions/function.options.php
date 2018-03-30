<?php
/** header layout support */
global $header_layout, $revsliders;
$header_layout = array(
                'v1' => get_template_directory_uri().'/images/header/header1.jpg',
                'v2' => get_template_directory_uri().'/images/header/header2.jpg',
                'v3' => get_template_directory_uri().'/images/header/header3.jpg',
                'v4' => get_template_directory_uri().'/images/header/header4.jpg',
                'v5' => get_template_directory_uri().'/images/header/header5.jpg'
                );
$border_style = array('none'=>'None','solid'=>'Solid','dotted'=>'Dotted','dashed'=>'Dashed','double'=>'Double','groove'=>'Groove','inset'=>'Inset','outset'=>'Outset','ridge'=>'Ridge');
/** General Options */
$this->sections[] = array(
    'title' => __('General Options', THEMENAME),
    'icon' => 'el-icon-dashboard',
    'fields' => array(
        array(
            'subtitle' => 'Set layout boxed default(Wide).',
            'id' => 'layout',
            'type' => 'switch',
            'title' => 'Boxed Layout',
            'default' => false
        ),
        array(
            'subtitle' => 'Set content width',
            'id' => 'layout_width',
            'type' => 'text',
            'title' => 'Boxed Width',
            'default' => '1200px',
            'required' => array(
                0 => 'layout',
                1 => '=',
                2 => 1
            )
        ),
		 array(
            'subtitle' => 'Set Container width',
            'id' => 'container_width',         
            'title' => 'Container max width',
			'type' => 'select',
            'options' => array(
                '940px' => '940px',
                '980px' => '980px',
                '1024px' => '1024px',
                '1200px' => '1200px'
            ),
            'default' => '1200px',
            'required' => array(
                0 => 'layout',
                1 => '=',
                2 => 2
            )
        ),

        array(
            'subtitle' => 'Enable Page Loading Animations',
            'id' => 'page_loader',
            'type' => 'switch',
            'title' => 'Page Loading',
            'default' => false
        ),
        array(
            'subtitle' => 'Choose how the page loading animation work',
            'id' => 'page_loader_style',         
            'title' => 'Page Loading Animations',
            'type' => 'select',
            'options' => array(
                'simple' => 'Simple',
                'jump' => 'Jump',
                'flipbox' => 'Flip Box',
                'creeper' => 'Creeper',
                'squashbox' => 'Squash Box',
                'veggie' => 'Veggie',
                'infinity' => 'Infinity',
                'goo' => 'Goo'
            ),
            'default' => 'simple',
            'required' => array(
                0 => 'page_loader',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Choose background color for page loading.',
            'id' => 'page_loader_bg',
            'type' => 'color_rgba',
            'title' => 'Page loading background color',
            'default'  => array( 'color' => '#ffffff', 'alpha' => '1.0' ),
            'required' => array(
                0 => 'page_loader',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Choose color for icon loading.',
            'id' => 'page_loader_color',
            'type' => 'color_rgba',
            'title' => 'Page loading Icon color',
            'default'  => array( 'color' => '#59d7c5', 'alpha' => '1.0' ),
            'required' => array(
                0 => 'page_loader',
                1 => '=',
                2 =>  1
            )
        ),
        array(
            'subtitle' => 'Choose color for icon loading.',
            'id' => 'page_loader_color2',
            'type' => 'color_rgba',
            'title' => 'Page loading Icon color (2)',
            'default'  => array( 'color' => '#59d7c5', 'alpha' => '1.0' ),
            'required' => array(
                0 => 'page_loader',
                1 => '=',
                2 =>  1
            )
        ),
        array(
            'subtitle' => 'Enable Smooth Scroll Animations',
            'id' => 'smooth_scroll',
            'type' => 'switch',
            'title' => 'Smooth Scroll',
            'default' => false
        ),
        array(
            'subtitle' => 'Auto Generate Dynamic Css (not recommended)',
            'id' => 'dev_mode',
            'type' => 'switch',
            'title' => 'Dev Mode',
            'default' => true
        ),
        array(
            'subtitle' => 'Favicon for your website (16px x 16px).',
            'id' => 'favicon',
            'type' => 'media',
            'title' => 'Favicon',
            'url' => true,
            'default' => array(
                'url' => get_template_directory_uri().'/images/logo/favicon.ico'
            ),
        ),
        array(
            'subtitle' => 'Add code before the head tag.',
            'id' => 'space_head',
            'type' => 'textarea',
            'title' => 'Extra before Head',
            'default' => ''
        ),
        array(
            'subtitle' => 'Add code before the body tag.',
            'id' => 'space_body',
            'type' => 'textarea',
            'title' => 'Extra before Body',
            'default' => ''
        ),
    )
);
$disable ='';

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
$msg = '';
if (!class_exists('WPBakeryVisualComposerAbstract') or !class_exists('CSCORE_Base')){
    $disable = ' disabled ';
    $msg='You should be install visual composer and Cmssuperheroes plugins to import';
}
$this->sections[] = array(
    'icon' => 'el-icon-briefcase',
    'title' => __('Demo Content', THEMENAME),
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => '<input type=\'button\' name=\'sample\' id=\'sample\' '.$disable.' value=\'Import Now\' /><div class=\'cs_process\'><div  class=\'cs_process_width\'></div></div><span id=\'msg\'>'.$msg.'</span>',
            'id' => 'theme',
            'icon' => true,
            'default' => 'wp-piero',
            'options' => array(
                'wp-piero' => 'piero',
            ),
            'type' => 'select',
            'title' => 'Select Theme'
        )
    )
);
$this->sections[] = array(
    'icon' => 'el-icon-screen',
    'title' => __('Body', THEMENAME),
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'background-body',
            'type'     => 'background',
            'title'    => __( 'Background', THEMENAME ),
            'subtitle' => __( 'Body background with image, color, etc.', THEMENAME ),
            'default'   => array(
                'background-color'=>'#FFFFFF',
                'background-image'=>'',
                'background-repeat'=>'',
                'background-size'=>'',
                'background-attachment'=>'',
                'background-position'=>''
            ),
        )
    )
);
/**
 * Logo
 */
$this->sections[] = array(
    'title' => __('Logo', THEMENAME),
    'icon' => 'el-icon-globe',
    'fields' => array(
        array(
            'subtitle' => 'Select an image file for your logo.',
            'id' => 'logo',
            'type' => 'media',
            'title' => 'Logo',
            'default' => array(
                'url'=>get_template_directory_uri().'/images/logo/logo.png'
            ),
            'url' => true
        ),
        array(
            'subtitle' => 'Enter logo height, In pixels, ex: 40px',
            'id' => 'logo_width',
            'type' => 'text',
            'title' => 'Logo Height',
            'default' => '24px'
        ),
        array(
            'subtitle' => 'Logo Alignment.',
            'id' => 'logo_alignment',
            'type' => 'select',
            'options' => array(
                'left' => 'Left',
                'center' => 'Center',
                'right' => 'Right'
            ),
            'title' => 'Logo Alignment',
            'default' => 'left'
        ),
        array(
            'subtitle' => 'In pixels, top right bottom left, ex: 10px 10px 10px 10px',
            'id' => 'margin_logo',
            'type' => 'text',
            'title' => 'Logo Margin',
            'default' => '0'
        ),
        array(
            'subtitle' => 'In pixels, top right bottom left, ex: 10px 10px 10px 10px',
            'id' => 'padding_logo',
            'type' => 'text',
            'title' => 'Logo Padding',
            'default' => '0'
        )
    )
);
$this->sections[] = array(
    'icon' => 'el-icon-screen-alt',
    'title' => __('Logo Sticky ', THEMENAME),
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => 'Select an image file for your logo.',
            'id' => 'logo_header_sticky',
            'type' => 'media',
            'title' => 'Logo Header Sticky',
            'default' => array(
                'url' => get_template_directory_uri().'/images/logo/logo-sticky.png'
            ),
            'url' => true
        ),
        array(
            'subtitle' => 'Controls the height of the sticky header logo. In pixels, ex: 40px',
            'id' => 'header_sticky_logo_max_height',
            'type' => 'text',
            'title' => 'Sticky Header Logo Height',
            'default' => '24px'
        ),
        array(
            'subtitle' => 'Sticky Logo Alignment.',
            'id' => 'sticky_logo_alignment',
            'type' => 'select',
            'options' => array(
                'left' => 'Left',
                'center' => 'Center',
                'right' => 'Right'
            ),
            'title' => 'Sticky Logo Alignment',
            'default' => 'left'
        ),
        array(
            'subtitle' => 'In pixels, top right bottom left, ex: 10px 10px 10px 10px',
            'id' => 'sticky_margin_logo',
            'type' => 'text',
            'title' => 'Sticky Logo Margin',
            'default' => ''
        ),
        array(
            'subtitle' => 'In pixels, top right bottom left, ex: 10px 10px 10px 10px',
            'id' => 'sticky_padding_logo',
            'type' => 'text',
            'title' => 'Sticky Logo Padding',
            'default' => ''
        )
    )
);
/**
 * Header
 */
$header_layout['custom'] = get_template_directory_uri().'/images/header/custom.jpg';
$this->sections[] = array(
    'title' => __('Header', THEMENAME),
    'icon' => 'el-icon-credit-card',
    'fields' => array(
        array(
            'id' => 'header_layout',
            'type' => 'image_select',
            'options' => $header_layout,
            'title' => 'Select a Header Layout',
            'default' => 'v1'
        ),
        array(
            'id' => 'cs-header-id',
            'type' => 'select',
            'title' => 'Select Custom Header'
        ),
        array(
            'subtitle' => 'Enable Header Full Width.',
            'id' => 'header_full_width',
            'type' => 'switch',
            'title' => 'Header Full Width',
            'default' => false
        ),
        array(
            'subtitle' => 'Enable a fixed header.',
            'id' => 'header_fixed_top',
            'type' => 'switch',
            'title' => 'Enable Header Fixed',
            'default' => false
        ),
        array(
            'subtitle' => 'Check the box to display header content widgets',
            'id' => 'header_content_widgets',
            'type' => 'switch',
            'title' => 'Header Content Widgets',
            'default' => true
        ),
        
        array(
            'subtitle' => 'Controls the text color of the header heading font.',
            'id' => 'header_headings_color',
            'type' => 'color',
            'title' => 'Header Headings Color',
            'default' => ''
        ),
        array(
            'subtitle' => 'Controls the text color of the header font.',
            'id' => 'header_text_color',
            'type' => 'color',
            'title' => 'Header Font Color',
            'default' => ''
        ),
        array(
            'subtitle' => 'Controls the text color of the header link font.',
            'id' => 'header_link_color',
            'type' => 'color',
            'title' => 'Header Link Color',
            'default' => ''
        ),
        array(
            'subtitle' => 'Header Link Hover Color.',
            'id' => 'header_link_hover_color',
            'type' => 'color',
            'title' => 'Header Link Hover Color',
            'default' => ''
        ),
        array(
            'id'       => 'background-header',
            'type'     => 'background',
            'title'    => __( 'Background', THEMENAME ),
            'subtitle' => __( 'Header background with image, color, etc.', THEMENAME ),
            'default'   => array(
                'background-color'=>'#FFFFFF',
                'background-image'=>'',
                'background-repeat'=>'',
                'background-size'=>'',
                'background-attachment'=>'',
                'background-position'=>''
            ),
        ),
        array(
            'subtitle' => 'Transparent Header.<br /> Min: 0, max: 100, step: 1, default value: 45',
            'id' => 'header_transparent',
            'min'           => 0,
            'step'          => .1,
            'max'           => 1,
            'resolution'    => 0.1,
            'type' => 'slider',
            'title' => 'Transparent Header',
            'default' => '1'
        ),
        array(
            'subtitle' => 'Enable parallax background image when scrolling.',
            'id' => 'header_bg_parallax',
            'type' => 'switch',
            'title' => 'Parallax Background Image',
            'default' => false
        ),
        array(
            'subtitle' => 'Enable a border on Header.',
            'id' => 'header_border_bottom',
            'type' => 'switch',
            'title' => 'Header Border',
            'default' => false
        ),
        array(
            'subtitle' => 'Header Border Style.',
            'id' => 'header_border_bottom_style',
            'type' => 'select',
            'title' => 'Choose border style',
            'options' => $border_style,
            'default' => 'none',
            'required' => array(
                0 => 'header_border_bottom',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Header Border Width. In px, ex: 2px.',
            'id' => 'header_border_bottom_height',
            'type' => 'text',
            'title' => 'Enter border width for top-right-bottom-left',
            'default' => '0',
            'required' => array(
                0 => 'header_border_bottom',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Header Border Color.',
            'id' => 'header_border_bottom_color',
            'type' => 'color_rgba',
            'title' => 'Choose border color',
            'default'  => array( 'color' => '', 'alpha' => '1.0' ),
            'required' => array(
                0 => 'header_border_bottom',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Header Margin, In pixels, top left botton right, ex: 10px 10px 10px 10px',
            'id' => 'header_margin',
            'type' => 'text',
            'title' => 'Header Margin',
            'default' => '0'
        ),
        array(
            'subtitle' => 'Header Padding, In pixels, top left botton right, ex: 10px 10px 10px 10px',
            'id' => 'header_padding',
            'type' => 'text',
            'title' => 'Header Padding',
            'default' => '0'
        )
    )
);
$this->sections[] = array(
    'icon' => 'el-icon-minus',
    'title' => __('Header Top', THEMENAME),
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => 'Display header top widgets.',
            'id' => 'header_top_widgets',
            'type' => 'switch',
            'title' => 'Header Top Widgets',
            'default' => false
        ),
        array(
            'subtitle' => 'Controls the background color of the top header.',
            'id' => 'header_top_bg_color',
            'type' => 'color',
            'title' => 'Header Top Background Color',
            'default' => '#333333',
            'required' => array(
                0 => 'header_top_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Controls the text color of the header heading font.',
            'id' => 'header_top_headings_color',
            'type' => 'color',
            'title' => 'Header Top Headings Color',
            'default' => '#fff',
            'required' => array(
                0 => 'header_top_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Controls the text color of the header font.',
            'id' => 'header_top_text_color',
            'type' => 'color',
            'title' => 'Header Top Font Color',
            'default' => '#fff',
            'required' => array(
                0 => 'header_top_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Controls the text color of the header link font.',
            'id' => 'header_top_link_color',
            'type' => 'color',
            'title' => 'Header Top Link Color',
            'default' => '#888888',
            'required' => array(
                0 => 'header_top_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Header Link Hover Color.',
            'id' => 'header_top_link_hover_color',
            'type' => 'color',
            'title' => 'Header Link Hover Color',
            'default' => '#fff',
            'required' => array(
                0 => 'header_top_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Select the number of columns to display in the header top.',
            'id' => 'header_top_widgets_columns',
            'options' => array(
                1 => '1',
                2 => '2'
            ),
            'type' => 'select',
            'title' => 'Number of Header Top Columns',
            'default' => '2',
            'required' => array(
                0 => 'header_top_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Class follow the Bootstrap 3',
            'id' => 'header_top_widgets_1',
            'type' => 'text',
            'title' => 'Class Header Top Widget 1',
            'default' => 'col-xs-12 col-sm-6 col-md-6 col-lg-6',
            'required' => array(
                0 => 'header_top_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Class follow the Bootstrap 3',
            'id' => 'header_top_widgets_2',
            'type' => 'text',
            'title' => 'Class Header Top Widget 2',
            'default' => 'col-xs-12 col-sm-6 col-md-6 col-lg-6 text-right',
            'required' => array(
                0 => 'header_top_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Header Top Padding, In pixels, top left botton right, ex: 10px 10px 10px 10px',
            'id' => 'header_top_padding',
            'type' => 'text',
            'title' => 'Header Top Padding',
            'default' => '12px 0',
            'required' => array(
                0 => 'header_top_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Display header top widgets in section 2.',
            'id' => 'header_top2_widgets',
            'type' => 'switch',
            'title' => 'Header Top 2 Widgets',
            'default' => false
        ),
        array(
            'subtitle' => 'Controls the background color of the top header 2.',
            'id' => 'header_top2_bg_color',
            'type' => 'color',
            'title' => 'Header Top 2 Background Color',
            'default' => '#ffffff',
            'required' => array(
                0 => 'header_top2_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Controls the text color of the header 2 heading font.',
            'id' => 'header_top2_headings_color',
            'type' => 'color',
            'title' => 'Header Top 2 Headings Color',
            'default' => '#aaaaaa',
            'required' => array(
                0 => 'header_top2_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Controls the text color of the header font.',
            'id' => 'header_top2_text_color',
            'type' => 'color',
            'title' => 'Header Top 2 Font Color',
            'default' => '#aaaaaa',
            'required' => array(
                0 => 'header_top2_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Controls the text color of the header link font.',
            'id' => 'header_top2_link_color',
            'type' => 'color',
            'title' => 'Header Top 2 Link Color',
            'default' => '#aaaaaa',
            'required' => array(
                0 => 'header_top2_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Header Link Hover Color.',
            'id' => 'header_top2_link_hover_color',
            'type' => 'color',
            'title' => 'Header Top 2 Link Hover Color',
            'default' => '#333333',
            'required' => array(
                0 => 'header_top2_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Select the number of columns to display in the header top.',
            'id' => 'header_top2_widgets_columns',
            'options' => array(
                1 => '1',
                2 => '2'
            ),
            'type' => 'select',
            'title' => 'Number of Header Top Columns',
            'default' => '2',
            'required' => array(
                0 => 'header_top2_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Class follow the Bootstrap 3',
            'id' => 'header_top2_widgets_1',
            'type' => 'text',
            'title' => 'Class Header Top 2 Widget 1',
            'default' => 'col-xs-12 col-sm-6 col-md-6 col-lg-6',
            'required' => array(
                0 => 'header_top2_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Class follow the Bootstrap 3',
            'id' => 'header_top2_widgets_2',
            'type' => 'text',
            'title' => 'Class Header 2 Top Widget 2',
            'default' => 'col-xs-12 col-sm-6 col-md-6 col-lg-6 text-right',
            'required' => array(
                0 => 'header_top2_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Header Top Padding, In pixels, top left botton right, ex: 10px 10px 10px 10px',
            'id' => 'header_top2_padding',
            'type' => 'text',
            'title' => 'Header Top 2 Padding',
            'default' => '12px 0',
            'required' => array(
                0 => 'header_top2_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Controls the border bottom color of the top header 2.',
            'id' => 'header_top2_widgets_border_color',
            'type' => 'color_rgba',
            'title' => 'Header Top 2 Border Bottom Color',
            'default'  => array( 'color' => '#eee', 'alpha' => '1.0' ),
            'required' => array(
                0 => 'header_top2_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Default search menu icon Padding, In pixels, top left botton right, ex: 10px 10px 10px 10px',
            'id' => 'default_search_padding',
            'type' => 'text',
            'title' => 'Default search menu icon padding',
            'default' => '0px 10px 0px 10px'
        ),
        array(
            'subtitle' => 'Default hidden sidebar icon Padding, In pixels, top left botton right, ex: 10px 10px 10px 10px',
            'id' => 'default_hidden_sidebar_padding',
            'type' => 'text',
            'title' => 'Default hidden sidebar icon padding',
            'default' => '0px 10px 0px 10px'
        )
    )
);
$this->sections[] = array(
    'icon' => 'el-icon-resize-vertical',
    'title' => __('Sticky Header', THEMENAME),
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => 'Enable a fixed header when scrolling.',
            'id' => 'header_sticky',
            'type' => 'switch',
            'title' => 'Enable Sticky Header',
            'default' => true
        ),
        array(
            'subtitle' => 'Enable Sticky Header Full Width.',
            'id' => 'sticky_header_full_width',
            'type' => 'switch',
            'title' => 'Sticky Header Full Width',
            'default' => false
        ),
        array(
            'subtitle' => 'Enable a fixed header when scrolling on tablets.',
            'id' => 'header_sticky_tablet',
            'type' => 'switch',
            'title' => 'Enable Sticky Header on Tablets',
            'default' => false
        ),
        array(
            'subtitle' => 'Enable a fixed header when scrolling on mobiles.',
            'id' => 'header_sticky_mobile',
            'type' => 'switch',
            'title' => 'Enable Sticky Header on Mobiles',
            'default' => false
        ),
        array(
            'subtitle' => 'Controls the background color of the sticky header.',
            'id' => 'header_sticky_bg_color',
            'type' => 'color_rgba',
            'title' => 'Sticky Header Background Color',
            'default'  => array( 'color' => '#ffffff', 'alpha' => '1.0' ),
            'required' => array(
                0 => 'header_sticky',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Controls the color of the Header border bottom color.',
            'id' => 'header_sticky_border_color',
            'type' => 'color_rgba',
            'title' => 'Sticky Header border bottom color',
            'default'  => array( 'color' => '#eee', 'alpha' => '1.0' ),
            'required' => array(
                0 => 'header_sticky',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Sticky Header Height.Use a number without \'px\', default is 60. ex: 60',
            'id' => 'header_sticky_height',
            'type' => 'text',
            'title' => 'Sticky Header Height',
            'default' => '60px',
            'required' => array(
                0 => 'header_sticky',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Sticky search menu icon Padding, In pixels, top left botton right, ex: 10px 10px 10px 10px',
            'id' => 'sticky_search_padding',
            'type' => 'text',
            'title' => 'Sticky search menu icon padding',
            'default' => '0px 10px 0px 10px'
        ),
        array(
            'subtitle' => 'Sticky hidden sidebar icon Padding, In pixels, top left botton right, ex: 10px 10px 10px 10px',
            'id' => 'sticky_hidden_sidebar_padding',
            'type' => 'text',
            'title' => 'Sticky hidden sidebar icon padding',
            'default' => '0px 10px 0px 10px'
        )
    )
);
$this->sections[] = array(
    'icon' => 'el-icon-resize-vertical',
    'title' => __('Header Fixed Left or Right', THEMENAME),
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => 'Header width will be up on the site with the header left or header right',
            'id' => 'header_width',
            'type' => 'text',
            'title' => 'Header Fixed Width',
            'default' => '300px'
        ),
        array(
            'subtitle' => 'Select Position for header left & header right',
            'id' => 'header_position',
            'type' => 'select',
            'options' => array(
                'top' => 'Top',
                'left' => 'Left',
                'right' => 'Right'
            ),
            'title' => 'Header Fixed Position', 
            'default' => 'left'
        ),
        array(
            'title' => 'Menu Appear style',
            'subtitle' => 'Select Sub menu appear style',
            'id' => 'header_fixed_menu_appear',
            'type' => 'select',
            'options' => array(
                'flyout' => 'Fly Out',
                'scrolldown' => 'Scroll Down'
                
            ),
            'default' => 'flyout'
        ),
        array(
            'subtitle' => 'Select the number of columns to display in the header content.',
            'id' => 'header_content_widgets_columns',
            'options' => array(
                1 => '1',
                2 => '2'
            ),
            'type' => 'select',
            'title' => 'Number of Header Content Columns',
            'default' => '2',
            'required' => array(
                0 => 'header_layout',
                1 => '=',
                2 => 'v4'
            )
        ),
        array(
            'subtitle' => 'Class follow the Bootstrap 3',
            'id' => 'header_content_widgets_1',
            'type' => 'text',
            'title' => 'Class Header Content Widget 1',
            'default' => 'col-xs-12 col-sm-6 col-md-6 col-lg-6',
            'required' => array(
                0 => 'header_layout',
                1 => '=',
                2 => 'v4'
            )
        ),
        array(
            'subtitle' => 'Class follow the Bootstrap 3',
            'id' => 'header_content_widgets_2',
            'type' => 'text',
            'title' => 'Class Header Content Widget 2',
            'default' => 'col-xs-12 col-sm-6 col-md-6 col-lg-6',
            'required' => array(
                0 => 'header_layout',
                1 => '=',
                2 => 'v4'
            )
        )
    )
);
/**
 * Main Menu
 */
$this->sections[] = array(
    'title' => __('Main Menu', THEMENAME),
    'icon' => 'el-icon-th-list',
    'fields' => array(
        array(
            'subtitle' => 'Use a number with \'px\', ex: 100px',
            'id' => 'nav_height',
            'type' => 'text',
            'title' => 'Main Nav Height',
            'default' => '100px'
        ),
        array(
            'subtitle' => 'Select Position for menu',
            'id' => 'menu_position',
            'type' => 'select',
            'options' => array(
                'left' => 'Left',
                'center' => 'Center',
                'right' => 'Right'
            ),
            'title' => 'Menu Position',
            'default' => 'right'
        ),
        array(
            'id' => 'menu_item_button',
            'type' => 'switch',
            'title' => 'Make menu item as button',
            'default' => false
        ),
        
        array(
            'subtitle' => 'Use a number with \'px\', ex: 160px',
            'id' => 'dropdown_menu_width',
            'type' => 'text',
            'title' => 'Dropdown Menu Width',
            'default' => '210px'
        ),
        
        array(
            'subtitle' => 'Menu first level text uppercase.',
            'id' => 'menu_first_level_text_uppecase',
            'type' => 'switch',
            'title' => 'Menu First Level Text Uppercase',
            'default' => true
        ),
        array(
            'id' => 'enable_menu_border',
            'type' => 'switch',
            'title' => 'Enable Border bettwen menu items',
            'default' => false
        ),
        
        array(
            'subtitle' => 'Controls the border color of first level menu items.',
            'id' => 'menu_border_color',
            'type' => 'color',
            'title' => 'Main Menu border Color - First Level',
            'default' => '#111111',
            'required' => array(
                0 => 'enable_menu_border',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Menu second level text uppercase.',
            'id' => 'menu_second_level_text_uppecase',
            'type' => 'switch',
            'title' => 'Menu Second Level Text Uppercase',
            'default' => true
        ),
        array(
            'subtitle' => 'Menu second level line height.',
            'id' => 'menu_second_level_line_height',
            'type' => 'text',
            'title' => 'Menu Second Level Line Height',
            'default' => 'normal'
        ),
        array(
            'subtitle' => 'Only Theme Header Left & Header Right',
            'id' => 'arrow_parents_item_menu',
            'type' => 'switch',
            'title' => 'Show/Hidden Arrow Parents Item',
            'default' => false,
            'required' => array(
                0 => 'header_layout',
                1 => '=',
                2 => 'v4'
            )
        )     
    )
);
$this->sections[] = array(
    'icon' => 'el-icon-magic',
    'title' => __('Default Menu', THEMENAME),
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => 'Controls the background color of the menu.',
            'id' => 'menu_bg_color',
            'type' => 'color',
            'title' => 'Main Menu Background Color',
            'default' => 'transparent'
        ),
        array(
            'subtitle' => 'Use a number with \'px\', ex: 14px',
            'id' => 'menu_fontsize_first_level',
            'type' => 'text',
            'title' => 'Menu Font Size - First Level',
            'default' => '12px'
        ),
        
        array(
            'subtitle' => 'Controls the text color of first level menu items.',
            'id' => 'menu_first_color',
            'type' => 'color',
            'title' => 'Main Menu Font Color - First Level',
            'default' => '#111111'
        ),
        array(
            'subtitle' => 'Controls the main menu hover, hover border & dropdown border color.',
            'id' => 'menu_hover_first_color',
            'type' => 'color',
            'title' => 'Main Menu Font Hover Color - First Level',
            'default' => '#59d7c5'
        ),
        array(
            'subtitle' => 'Controls the main menu active, active border.',
            'id' => 'menu_active_first_color',
            'type' => 'color',
            'title' => 'Main Menu Font Active Color - First Level',
            'default' => '#59d7c5'
        ),
        array(
            'subtitle' => 'Controls the hover color of the menu first level background.',
            'id' => 'menu_bg_hover_color_first',
            'type' => 'color_rgba',
            'title' => 'Main Menu Background Hover Color - First Levels',
            'default'  => array( 'color' => '', 'alpha' => '1.0' )
        ),
        array(
            'subtitle' => 'Controls the actived color of the menu first level background.',
            'id' => 'menu_bg_actived_color_first',
            'type' => 'color_rgba',
            'title' => 'Main Menu actived Background  Color - First Levels',
            'default'  => array( 'color' => '', 'alpha' => '1' )
        ),

        array(
            'subtitle' => 'enter the padding space (top-right-bottom-left) for menu item',
            'id' => 'nav_padding',
            'type' => 'text',
            'title' => 'Menu Item Padding',
            'default' => '0 19px'
        ),
        
        array(
            'subtitle' => 'Use a number with \'px\', ex: 10px 10px',
            'id' => 'nav_margin',
            'type' => 'text',
            'title' => 'Menu Item Margin',
            'default' => '0px'
        ),

        array(
            'subtitle' => 'Controls the color of the menu sublevel background.',
            'id' => 'menu_sub_bg_color',
            'type' => 'color',
            'title' => 'Main Menu Background Color - Sublevels',
            'default' => '#ffffff'
        ),
        array(
            'subtitle' => 'Use a number with \'px\', ex: 12px',
            'id' => 'menu_fontsize_sub_level',
            'type' => 'text',
            'title' => 'Menu Font Size First Sublevel',
            'default' => '13px'
        ),
        array(
            'subtitle' => 'Controls the color of the menu font sublevels.',
            'id' => 'menu_sub_color',
            'type' => 'color',
            'title' => 'Main Menu Font Color - Sublevels',
            'default' => '#878787'
        ),
        
        array(
            'subtitle' => 'Controls the hover color of the menu sublevel background.',
            'id' => 'menu_bg_hover_color',
            'type' => 'color',
            'title' => 'Main Menu Item Background Hover & Active Color - Sublevels',
            'default' => 'transparent'
        ),

        array(
            'subtitle' => 'Controls the hover color of the menu font sublevels.',
            'id' => 'menu_sub_hover_color',
            'type' => 'color',
            'title' => 'Main Menu Font Hover Color - Sublevels',
            'default' => '#59d7c5'
        ),
        array(
            'subtitle' => 'Controls the active color of the menu font sublevels.',
            'id' => 'menu_sub_active_color',
            'type' => 'color',
            'title' => 'Main Menu Font Active Color - Sublevels',
            'default' => '#59d7c5'
        ),
        array(
            'subtitle' => 'Controls the color of the menu border separator sublevels.',
            'id' => 'menu_sub_sep_color',
            'type' => 'color',
            'title' => 'Main Menu border separator - Sublevels',
            'default' => '#eeeeee'
        )
    )
);
$this->sections[] = array(
    'icon' => 'el-icon-magic',
    'title' => __('Sticky Menu', THEMENAME),
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => 'Controls the background color of the menu.',
            'id' => 'sticky_menu_bg_color',
            'type' => 'color',
            'title' => 'Main Menu Background Color',
            'default' => 'transparent'
        ),
        array(
            'subtitle' => 'Use a number with \'px\', ex: 14px',
            'id' => 'sticky_menu_fontsize_first_level',
            'type' => 'text',
            'title' => 'Menu Font Size - First Level',
            'default' => '12px'
        ),
        
        array(
            'subtitle' => 'Controls the text color of first level menu items.',
            'id' => 'sticky_menu_first_color',
            'type' => 'color',
            'title' => 'Main Menu Font Color - First Level',
            'default' => '#111'
        ),
        array(
            'subtitle' => 'Controls the main menu hover, hover border & dropdown border color.',
            'id' => 'sticky_menu_hover_first_color',
            'type' => 'color',
            'title' => 'Main Menu Font Hover Color - First Level',
            'default' => '#59d7c5'
        ),
        array(
            'subtitle' => 'Controls the main menu active, active border.',
            'id' => 'sticky_menu_active_first_color',
            'type' => 'color',
            'title' => 'Main Menu Font Active Color - First Level',
            'default' => '#59d7c5'
        ),
        array(
            'subtitle' => 'Controls the hover color of the menu first level background.',
            'id' => 'sticky_menu_bg_hover_color_first',
            'type' => 'color_rgba',
            'title' => 'Main Menu Background Hover Color - First Levels',
            'default'  => array( 'color' => '', 'alpha' => '1.0' )
        ),
        array(
            'subtitle' => 'Controls the actived color of the menu first level background.',
            'id' => 'sticky_menu_bg_actived_color_first',
            'type' => 'color_rgba',
            'title' => 'Main Menu actived Background  Color - First Levels',
            'default'  => array( 'color' => '', 'alpha' => '1' )
        ),
        array(
            'subtitle' => 'enter the padding space (top-right-bottom-left) for menu item',
            'id' => 'sticky_nav_padding',
            'type' => 'text',
            'title' => 'Menu Item Padding',
            'default' => '0 19px'
        ),
        array(
            'subtitle' => 'Use a number with \'px\', ex: 10px 10px',
            'id' => 'sticky_nav_margin',
            'type' => 'text',
            'title' => 'Menu Item Margin',
            'default' => '0px'
        ),
        array(
            'subtitle' => 'Controls the color of the menu sublevel background.',
            'id' => 'sticky_menu_sub_bg_color',
            'type' => 'color',
            'title' => 'Main Menu Background Color - Sublevels',
            'default' => '#ffffff'
        ),
        array(
            'subtitle' => 'Use a number with \'px\', ex: 12px',
            'id' => 'sticky_menu_fontsize_sub_level',
            'type' => 'text',
            'title' => 'Menu Font Size First Sublevel',
            'default' => '13px'
        ),
        array(
            'subtitle' => 'Controls the color of the menu font sublevels.',
            'id' => 'sticky_menu_sub_color',
            'type' => 'color',
            'title' => 'Main Menu Font Color - Sublevels',
            'default' => '#878787'
        ),
        
        array(
            'subtitle' => 'Controls the hover color of the menu sublevel background.',
            'id' => 'sticky_menu_bg_hover_color',
            'type' => 'color',
            'title' => 'Main Menu Item Background Hover & Active Color - Sublevels',
            'default' => 'transparent'
        ),

        array(
            'subtitle' => 'Controls the hover color of the menu font sublevels.',
            'id' => 'sticky_menu_sub_hover_color',
            'type' => 'color',
            'title' => 'Main Menu Font Hover Color - Sublevels',
            'default' => '#59d7c5'
        ),
        array(
            'subtitle' => 'Controls the active color of the menu font sublevels.',
            'id' => 'sticky_menu_sub_active_color',
            'type' => 'color',
            'title' => 'Main Menu Font Active Color - Sublevels',
            'default' => '#59d7c5'
        ),
        array(
            'subtitle' => 'Controls the color of the menu border separator sublevels.',
            'id' => 'sticky_menu_sub_sep_color',
            'type' => 'color',
            'title' => 'Main Menu border separator - Sublevels',
            'default' => '#eeeeee'
        )
    )
);
$this->sections[] = array(
    'icon' => 'el-icon-website-alt',
    'title' => __('Mobile Colors', THEMENAME),
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => 'Controls the background color of the mobile menu.',
            'id' => 'mobile_menu_bg_color',
            'type' => 'color',
            'title' => 'Mobile Menu Background Color',
            'default' => '#ffffff'
        ),
        array(
            'subtitle' => 'Controls the text color of first level menu items.',
            'id' => 'mobile_menu_first_color',
            'type' => 'color',
            'title' => 'Mobile Menu Font Color - First Level',
            'default' => '#111111'
        ),
        array(
            'subtitle' => 'Controls the main menu hover.',
            'id' => 'mobile_menu_hover_first_color',
            'type' => 'color',
            'title' => 'Mobile Menu Font Hover Color - First Level',
            'default' => '#5ad7c5'
        ),
        array(
            'subtitle' => 'Controls the color of the menu font sublevels.',
            'id' => 'mobile_menu_sub_color',
            'type' => 'color',
            'title' => 'Mobile Menu Font Color - Sublevels',
            'default' => '#333333'
        ),
        array(
            'subtitle' => 'Controls the color hover of the menu font sublevels.',
            'id' => 'mobile_menu_sub_hover_color',
            'type' => 'color',
            'title' => 'Mobile Menu Font Hover Color - Sublevels',
            'default' => '#5ad7c5'
        ),
        array(
            'subtitle' => 'Controls the color of the menu separator sublevels.',
            'id' => 'mobile_menu_sub_sep_color',
            'type' => 'color',
            'title' => 'Mobile Menu Separator - Sublevels',
            'default' => '#eeeeee'
        )
    )
);

/**
 * Hidden Sidebar
 */
$this->sections[] = array(
    'title' => __('Hidden Sidebar', THEMENAME),
    'icon' => 'el-icon-eye-open',
    'fields' => array(
        array(
            'id' => 'enable_hidden_sidebar',
            'type' => 'switch',
            'title' => 'Enable Hidden Sidebar',
            'default' => false
        ),
        array(
            'subtitle' => 'Select position display hidden sidebar.',
            'id' => 'hidden_sidebar_position',
            'type' => 'select',
            'options' => array(
                'top' => 'Top',
                'right' => 'Right',
                'left' => 'Left'
            ),
            'title' => 'Position',
            'default' => 'right'
        ),
        array(
            'subtitle' => 'The width of the menu (when using left/right position)',
            'id' => 'hidden_sidebar_width',
            'type' => 'text',
            'title' => 'Width',
            'default' => '220px'
        ),
        array(
            'subtitle' => 'The height of the menu (when using top/bottom position)',
            'id' => 'hidden_sidebar_height',
            'type' => 'text',
            'title' => 'Height',
            'default' => '320px'
        )
    )
);
/**
 * Bottom Widget
 */
$this->sections[] = array(
    'title' => __('Bottom Widget', THEMENAME),
    'icon' => 'el-icon-graph',
    'fields' => array(
        array(
            'subtitle' => 'Display bottom widgets.',
            'id' => 'bottom_1_widgets',

            'type' => 'switch',
            'title' => 'Bottom Widgets',
            'default' => false
        ),
        array(
            'subtitle' => 'Select the number of columns to display in the bottom.',
            'id' => 'bottom_1_widgets_columns',
            'options' => array(
                1 => '1',
                2 => '2',
                3 => '3',
                4 => '4'
            ),
            'type' => 'select',
            'title' => 'Number of Bottom Columns',
            'default' => '2',
            'required' => array(
                0 => 'bottom_1_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Class follow the Bootstrap 3',
            'id' => 'bottom_1_widgets_1',
            'type' => 'text',
            'title' => 'Class Bottom Widget 1',
            'default' => 'col-xs-12 col-sm-6 col-md-3 col-lg-3',
            'required' => array(
                0 => 'bottom_1_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Class follow the Bootstrap 3',
            'id' => 'bottom_1_widgets_2',
            'type' => 'text',
            'title' => 'Class Bottom Widget 2',
            'default' => 'col-xs-12 col-sm-6 col-md-3 col-lg-3',
            'required' => array(
                0 => 'bottom_1_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Class follow the Bootstrap 3',
            'id' => 'bottom_1_widgets_3',
            'type' => 'text',
            'title' => 'Class Bottom Widget 3',
            'default' => 'col-xs-12 col-sm-6 col-md-3 col-lg-3',
            'required' => array(
                0 => 'bottom_1_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Class follow the Bootstrap 3',
            'id' => 'bottom_1_widgets_4',
            'type' => 'text',
            'title' => 'Class Bottom Widget 4',
            'default' => 'col-xs-12 col-sm-6 col-md-3 col-lg-3',
            'required' => array(
                0 => 'bottom_1_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'id'       => 'background-bottom',
            'type'     => 'background',
            'title'    => __( 'Background', THEMENAME ),
            'subtitle' => __( 'Bottom background with image, color, etc.', THEMENAME ),
            'default'   => array(
                'background-color'=>'#FFFFFF',
                'background-image'=>'',
                'background-repeat'=>'',
                'background-size'=>'',
                'background-attachment'=>'',
                'background-position'=>''
            ),
            'required' => array(
                0 => 'bottom_1_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Enable parallax background image when scrolling.',
            'id' => 'bottom_1_bg_parallax',
            'type' => 'switch',
            'title' => 'Background Parallax',
            'default' => false
        ),
        array(
            'subtitle' => 'In pixels, top left botton right, ex: 10px 10px 10px 10px',
            'id' => 'bottom_1_padding',
            'type' => 'text',
            'title' => 'Bottom Padding',
            'default' => '',
            'required' => array(
                0 => 'bottom_1_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'In pixels, top left botton right, ex: 10px 10px 10px 10px',
            'id' => 'bottom_1_margin',
            'type' => 'text',
            'title' => 'Bottom Margin',
            'default' => '',
            'required' => array(
                0 => 'bottom_1_widgets',
                1 => '=',
                2 => 1
            )
        )
    )
);
$this->sections[] = array(
    'icon' => 'el-icon-magic',
    'title' => __('Color', THEMENAME),
    'subsection' => true,
    'fields' => array(
       
        array(
            'subtitle' => 'Controls the text color of the bottom heading font.',
            'id' => 'bottom_1_headings_color',
            'type' => 'color',
            'title' => 'Bottom Headings Color',
            'default' => ''
        ),
        array(
            'subtitle' => 'Controls the text color of the bottom font.',
            'id' => 'bottom_1_text_color',
            'type' => 'color',
            'title' => 'Bottom Font Color',
            'default' => ''
        ),
        array(
            'subtitle' => 'Controls the text color of the bottom link font.',
            'id' => 'bottom_1_link_color',
            'type' => 'color',
            'title' => 'Bottom Link Color',
            'default' => ''
        ),
        array(
            'subtitle' => 'Bottom Link Hover Color.',
            'id' => 'bottom_1_link_hover_color',
            'type' => 'color',
            'title' => 'Bottom Link Hover Color',
            'default' => ''
        )
    )
);
/**
 * Footer
 */
$this->sections[] = array(
    'title' => __('Footer', THEMENAME),
    'icon' => 'el-icon-minus',
    'fields' => array(
        array(
            'id' => 'footer_layout',
            'type' => 'image_select',
            'options' => array(
                'f1' => get_template_directory_uri().'/images/footer/footer1.jpg'
            ),
            'title' => 'Select a Footer Layout',
            'default' => 'f1'
        ),
        array(
            'subtitle' => 'Enable Footer Full Width.',
            'id' => 'footer_full_width',

            'type' => 'switch',
            'title' => 'Full Width',
            'default' => false
        ),
        array(
            'subtitle' => 'Enable back to top.',
            'id' => 'footer_to_top',

            'type' => 'switch',
            'title' => 'Back To Top',
            'default' => true
        )
    )
);
$this->sections[] = array(
    'icon' => 'el-icon-chevron-up',
    'title' => __('Top', THEMENAME),
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => 'Display footer top widgets.',
            'id' => 'footer_top_widgets',

            'type' => 'switch',
            'title' => 'Footer Top Widgets',
            'default' => true
        ),
        array(
            'subtitle' => 'Select the number of columns to display in the footer top.',
            'id' => 'footer_top_widgets_columns',
            'options' => array(
                1 => '1',
                2 => '2',
                3 => '3',
                4 => '4'
            ),
            'type' => 'select',
            'title' => 'Number of Footer Top Columns',
            'default' => '4',
            'required' => array(
                0 => 'footer_top_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Class follow the Bootstrap 3',
            'id' => 'footer_top_widgets_1',
            'type' => 'text',
            'title' => 'Class Footer Widget 1',
            'default' => 'col-xs-12 col-sm-6 col-md-3 col-lg-3',
            'required' => array(
                0 => 'footer_top_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Class follow the Bootstrap 3',
            'id' => 'footer_top_widgets_2',
            'type' => 'text',
            'title' => 'Class Footer Widget 2',
            'default' => 'col-xs-12 col-sm-6 col-md-3 col-lg-3',
            'required' => array(
                0 => 'footer_top_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Class follow the Bootstrap 3',
            'id' => 'footer_top_widgets_3',
            'type' => 'text',
            'title' => 'Class Footer Widget 3',
            'default' => 'col-xs-12 col-sm-6 col-md-3 col-lg-3',
            'required' => array(
                0 => 'footer_top_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Class follow the Bootstrap 3',
            'id' => 'footer_top_widgets_4',
            'type' => 'text',
            'title' => 'Class Footer Widget 4',
            'default' => 'col-xs-12 col-sm-6 col-md-3 col-lg-3',
            'required' => array(
                0 => 'footer_top_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Controls the text color of the footer top heading font.',
            'id' => 'footer_headings_color',
            'type' => 'color',
            'title' => 'Footer Top Headings Color',
            'default' => '#fff'
        ),
        array(
            'subtitle' => 'Insert the number of words you want to show in the footer heading size',
            'id' => 'footer_top_heading_font_size',
            'type' => 'text',
            'title' => 'Footer Top Headings Font Size',
            'default' => '14px',
            'required' => array(
                0 => 'footer_top_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Display footer top headings uppercase.',
            'id' => 'footer_top_heading_uppercase',

            'type' => 'switch',
            'title' => 'Footer Top Headings Uppercase',
            'default' => true
        ),
        array(
            'subtitle' => 'Footer top heading sytle.',
            'id' => 'footer_top_heading_style',
            'options' => array(
                1 => 'Default'
            ),
            'type' => 'select',
            'title' => 'Footer Top Headings Style',
            'default' => 'default',
            'required' => array(
                0 => 'footer_top_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Controls the text color of the footer top font.',
            'id' => 'footer_text_color',
            'type' => 'color',
            'title' => 'Footer Top Font Color',
            'default' => '#fff',
            'required' => array(
                0 => 'footer_top_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Controls the text color of the footer top link font.',
            'id' => 'footer_link_color',
            'type' => 'color',
            'title' => 'Footer Top Link Color',
            'default' => '#fff',
            'required' => array(
                0 => 'footer_top_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Footer Top Link Hover Color.',
            'id' => 'footer_link_hover_color',
            'type' => 'color',
            'title' => 'Footer Top Link Hover Color',
            'default' => '#5bd7c5'
        ),
        array(
            'subtitle' => 'Footer Top social Color.',
            'id' => 'footer_social_color',
            'type' => 'color',
            'title' => 'Footer Top social Color',
            'default' => '#fff',
            'required' => array(
                0 => 'footer_top_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Footer Top social hover Color.',
            'id' => 'footer_social_hover_color',
            'type' => 'color',
            'title' => 'Footer Top social Hover Color',
            'default' => '#5bd7c5',
            'required' => array(
                0 => 'footer_top_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Select border style.',
            'id' => 'footer_top_border_style',
            'type' => 'select',
            'options' => $border_style,
            'title' => 'Border Style',
            'default' => 'none',
            'required' => array(
                0 => 'footer_top_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Footer Top Border Color.',
            'id' => 'footer_top_border_color',
            'type' => 'color',
            'title' => 'Border Color',
            'default' => '',
            'required' => array(
                0 => 'footer_top_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'In pixels/em..., top right botton left, ex: 1px 1px 1px 1px',
            'id' => 'footer_top_border_width',
            'type' => 'text',
            'title' => 'Footer Top Border Width',
            'default' => '',
            'required' => array(
                0 => 'footer_top_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'id'       => 'background-footer-top',
            'type'     => 'background',
            'title'    => __( 'Background', THEMENAME ),
            'subtitle' => __( 'Footer Top background with image, color, etc.', THEMENAME ),
            'default'   => array(
                'background-color'=>'#111111',
                'background-image'=>'',
                'background-repeat'=>'',
                'background-size'=>'',
                'background-attachment'=>'',
                'background-position'=>''
            ),
            'required' => array(
                0 => 'footer_top_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Enable parallax background image when scrolling.',
            'id' => 'footer_top_bg_parallax',

            'type' => 'switch',
            'title' => 'Background Parallax',
            'default' => false,
            'required' => array(
                0 => 'footer_top_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'In pixels, top left botton right, ex: 10px 10px 10px 10px',
            'id' => 'footer_top_padding',
            'type' => 'text',
            'title' => 'Footer Top Padding',
            'default' => '80px 0px',
            'required' => array(
                0 => 'footer_top_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'In pixels, top left botton right, ex: 10px 10px 10px 10px',
            'id' => 'footer_top_margin',
            'type' => 'text',
            'title' => 'Footer Top Margin',
            'default' => '0',
            'required' => array(
                0 => 'footer_top_widgets',
                1 => '=',
                2 => 1
            )
        )
    )
);
$this->sections[] = array(
    'icon' => 'el-icon-chevron-down',
    'title' => __('Bottom', THEMENAME),
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => 'Check the box to display footer bottom widgets.',
            'id' => 'footer_bottom_widgets',
            'type' => 'switch',
            'title' => 'Footer Bottom Widgets',
            'default' => true
        ),
        array(
            'subtitle' => 'Select the number of columns to display in the footer bottom.',
            'id' => 'footer_bottom_widgets_columns',
            'options' => array(
                1 => '1',
                2 => '2'
            ),
            'type' => 'select',
            'title' => 'Number of Footer Bottom Columns',
            'default' => '1',
            'required' => array(
                0 => 'footer_bottom_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Class follow the Bootstrap 3',
            'id' => 'footer_bottom_widgets_1',
            'type' => 'text',
            'title' => 'Class Footer Bottom Widget 1',
            'default' => 'col-xs-12 col-sm-12 col-md-12 col-lg-12',
            'required' => array(
                0 => 'footer_bottom_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Class follow the Bootstrap 3',
            'id' => 'footer_bottom_widgets_2',
            'type' => 'text',
            'title' => 'Class Footer Bottom Widget 2',
            'default' => 'col-xs-12 col-sm-6 col-md-6 col-lg-6',
            'required' => array(
                0 => 'footer_bottom_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Text Align For Footer Bottom Widget 1.',
            'id' => 'text_align_footer_bottom_widgets_1',
            'options' => array(
                'none' => 'Default',
                'left' => 'Left',
                'center' => 'Center',
                'right' => 'Right'
            ),
            'type' => 'select',
            'title' => 'Text Align For Footer Bottom Widget 1',
            'default' => 'center',
            'required' => array(
                0 => 'footer_bottom_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Text Align For Footer Bottom Widget 2.',
            'id' => 'text_align_footer_bottom_widgets_2',
            'options' => array(
                'none' => 'Default',
                'left' => 'Left',
                'center' => 'Center',
                'right' => 'Right'
            ),
            'type' => 'select',
            'title' => 'Text Align For Footer Bottom Widget 2',
            'default' => 'center',
            'required' => array(
                0 => 'footer_bottom_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Footer Bottom Background Color.',
            'id' => 'footer_bottom_bg_color',
            'type' => 'color',
            'title' => 'Footer Bottom Background Color',
            'default' => '#000000',
            'required' => array(
                0 => 'footer_bottom_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Controls the text color of the footer bottom heading font.',
            'id' => 'footer_bottom_headings_color',
            'type' => 'color',
            'title' => 'Footer Bottom Headings Color',
            'default' => '#ffffff',
            'required' => array(
                0 => 'footer_bottom_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Controls the text color of the footer bottom font.',
            'id' => 'footer_bottom_text_color',
            'type' => 'color',
            'title' => 'Footer Bottom Font Color',
            'default' => '#FFFFFF',
            'required' => array(
                0 => 'footer_bottom_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Controls the text color of the footer bottom link font.',
            'id' => 'footer_bottom_link_color',
            'type' => 'color',
            'title' => 'Footer Bottom Link Color',
            'default' => '#FFFFFF',
            'required' => array(
                0 => 'footer_bottom_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Footer Bottom Link Hover Color.',
            'id' => 'footer_bottom_link_hover_color',
            'type' => 'color',
            'title' => 'Footer Bottom Link Hover Color',
            'default' => '#FFFFFF',
            'required' => array(
                0 => 'footer_bottom_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Select border style.',
            'id' => 'footer_bottom_border_style',
            'type' => 'select',
            'options' => $border_style,
            'title' => 'Footer Bottom Border Style',
            'default' => 'none',
            'required' => array(
                0 => 'footer_bottom_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Footer Bottom Border Color.',
            'id' => 'footer_bottom_border_color',
            'type' => 'color',
            'title' => 'Footer Bottom Border Color',
            'default' => '',
            'required' => array(
                0 => 'footer_bottom_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'In pixels/em..., top right botton left, ex: 1px 1px 1px 1px',
            'id' => 'footer_bottom_border_width',
            'type' => 'text',
            'title' => 'Footer Bottom Border Width',
            'default' => '',
            'required' => array(
                0 => 'footer_bottom_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'In pixels, top right botton left, ex: 10px 10px 10px 10px',
            'id' => 'footer_bottom_padding',
            'type' => 'text',
            'title' => 'Footer Bottom Padding',
            'default' => '37px 0',
            'required' => array(
                0 => 'footer_bottom_widgets',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'In pixels, top right botton left, ex: 10px 10px 10px 10px',
            'id' => 'footer_bottom_margin',
            'type' => 'text',
            'title' => 'Footer Bottom Margin',
            'default' => '0',
            'required' => array(
                0 => 'footer_bottom_widgets',
                1 => '=',
                2 => 1
            )
        )
    )
);
/**
 * Button Options
 */
$this->sections[] = array(
    'title' => __('Button Options', THEMENAME),
    'icon' => 'el-icon-play',
    'fields' => array(

        array(
            'subtitle' => 'Make the text in button is uppercase or not',
            'id' => 'button_uppercase',
            'type' => 'switch',
            'title' => 'Button Text Uppercase',
            'default' => true
        ),
        array(
            'subtitle' => 'Default is 12px',
            'id' => 'button_font_size',
            'type' => 'text',
            'title' => 'Font Size',
            'default' => '12px'
        ),
        array(
            'subtitle' => 'Choose a style for text.',
            'id' => 'button_font_style',
            'type' => 'select',
            'options' => array(
                '400normal' => 'Normal 400',
                '100normal' => 'Thin 100',
                '200normal' => 'Light 200',
                '300normal' => 'Book 300',
                '600normal' => 'Semi-Bold 600',
                '700normal' => 'Bold 700',
                '800normal' => 'Extra-Bold 800',
                '400italic' => 'Normal 400 Italic',
                '100italic' => 'Thin 100 Italic',
                '200italic' => 'Light 200 Italic',
                '300italic' => 'Book 300 Italic',
                '400italic' => 'Normal 400 Italic',
                '600italic' => 'Semi-Bold 600 Italic',
                '700italic' => 'Bold 700 Italic',
                '800italic' => 'Extra-Bold 800 Italic'
            ),
            'title' => 'Border Text Style',
            'default' => '400normal'
        ),
        array(
            'subtitle' => 'Enter letter spacing',
            'id' => 'button_letter_spacing',
            'type' => 'text',
            'title' => 'Letter Spacing',
            'default' => '1px'
        ),
        array(
            'subtitle' => 'In pixels, top, ex: 10px',
            'id' => 'button_padding_top',
            'type' => 'text',
            'title' => 'Button Padding Top',
            'default' => '15px'
        ),
        array(
            'subtitle' => 'In pixels, right, ex: 10px',
            'id' => 'button_padding_right',
            'type' => 'text',
            'title' => 'Button Padding Right',
            'default' => '28px'
        ),
        array(
            'subtitle' => 'In pixels, botton, ex: 10px',
            'id' => 'button_padding_bottom',
            'type' => 'text',
            'title' => 'Button Padding Bottom',
            'default' => '15px'
        ),
        array(
            'subtitle' => 'In pixels,left, ex: 10px',
            'id' => 'button_padding_left',
            'type' => 'text',
            'title' => 'Button Padding Left',
            'default' => '28px'
        ),
        array(
            'subtitle' => 'In pixels, top left botton right, ex: 10px 10px 10px 10px',
            'id' => 'button_margin',
            'type' => 'text',
            'title' => 'Button Margin',
            'default' => '0'
        )
    )
);
/* Default Button */
$this->sections[] = array(
    'title' => __('Default Button', THEMENAME),
    'icon' => 'el-icon-forward-alt',
    'subsection' => true,
    'fields' => array(    
        array(
            'subtitle' => 'Button Border Style.',
            'id' => 'button_border_style',
            'type' => 'select',
            'options' => $border_style,
            'title' => 'Border Style',
            'default' => 'solid'
        ),
        array(
            'subtitle' => 'Controls the border color of the buttons.',
            'id' => 'button_border_color',
            'type' => 'color',
            'title' => 'Border Color',
            'default' => '#111111'
        ),
        array(
            'subtitle' => 'Controls the border color hover of the buttons.',
            'id' => 'button_border_color_hover',
            'type' => 'color',
            'title' => 'Border Color Hover',
            'default' => '#59d7c5'
        ),
        array(
            'subtitle' => 'Button Border Width for: Top, Right, Bottom, Left',
            'id' => 'button_border_width',
            'type' => 'text',
            'title' => 'Border Width',
            'default' => '2px 2px 2px 2px'
        ),
        
        array(
            'subtitle' => 'Border Radius. In pixels ex: 3px',
            'id' => 'button_border_radius',
            'type' => 'text',
            'title' => 'Border Radius',
            'default' => '30px'
        ),
        array(
            'subtitle' => 'Controls the text color of buttons.',
            'id' => 'button_gradient_text_color',
            'type' => 'color',
            'title' => 'Default Text Color',
            'default' => '#FFFFFF'
        ),
        array(
            'subtitle' => 'Controls the text color hover of buttons.',
            'id' => 'button_gradient_text_color_hover',
            'type' => 'color',
            'title' => 'Default Text Color Hover',
            'default' => '#FFFFFF'
        ),
        array(
            'subtitle' => 'Controls the button background color.',
            'id' => 'button_gradient_top_color',
            'type' => 'color_rgba',
            'title' => 'Default Background Color',
            'default'  => array( 'color' => '#111111', 'alpha' => '1' )
        ),
        array(
            'subtitle' => 'Controls the button background color hover.',
            'id' => 'button_gradient_top_color_hover',
            'type' => 'color_rgba',
            'title' => 'Default Background Hover Color',
            'default'  => array( 'color' => '#59d7c5', 'alpha' => '1' )
        )
    )
);

/**
 * Button Primary
 */
$this->sections[] = array(
    'icon' => 'el-icon-forward-alt',
    'title' => __('Primary Button', THEMENAME),
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => ' Font Size. Default is: 12px',
            'id' => 'button_primary_font_size',
            'type' => 'text',
            'title' => 'Button Font Size',
            'default' => '12px'
        ),
        
        array(
            'subtitle' => 'Border Style.',
            'id' => 'button_primary_border_style',
            'type' => 'select',
            'options' => $border_style,
            'title' => 'Border Style',
            'default' => 'solid'
        ),
        array(
            'subtitle' => 'Controls the border color of the buttons.',
            'id' => 'button_primary_border_color',
            'type' => 'color',
            'title' => 'Border Color',
            'default' => '#59d7c5'
        ),
        array(
            'subtitle' => 'Controls the border color hover of the buttons.',
            'id' => 'button_primary_border_color_hover',
            'type' => 'color',
            'title' => 'Border Color Hover',
            'default' => '#111111'
        ),
        array(
            'subtitle' => 'Button Primary Border Width for : Top, Right, Bottom, Left',
            'id' => 'button_primary_border_width',
            'type' => 'text',
            'title' => 'Border Width',
            'default' => '2px 2px 2px 2px',
        ),
        array(
            'subtitle' => 'Ex: 3px',
            'id' => 'button_primary_border_radius',
            'type' => 'text',
            'title' => 'Border Radius',
            'default' => '30px'
        ),
        array(
            'subtitle' => 'Controls the text color of buttons.',
            'id' => 'button_primary_text_color',
            'type' => 'color',
            'title' => 'Text Color',
            'default' => '#FFFFFF'
        ),
        array(
            'subtitle' => 'Controls the text color hover of buttons.',
            'id' => 'button_primary_text_color_hover',
            'type' => 'color',
            'title' => 'Text Color Hover',
            'default' => '#FFFFFF'
        ),
        array(
            'subtitle' => 'Controls the button background color.',
            'id' => 'button_primary_background_color',
            'type' => 'color_rgba',
            'title' => 'Background Color',
            'default'  => array( 'color' => '#59d7c5', 'alpha' => '1' )
        ),
        array(
            'subtitle' => 'Controls the button background color hover.',
            'id' => 'button_primary_background_color_hover',
            'type' => 'color_rgba',
            'title' => 'Background Color Hover',
            'default'  => array( 'color' => '#111111', 'alpha' => '1' )
        ),
        
    )
);
/**
 * Page Title Bar
 */
$this->sections[] = array(
    'title' => __('Page Title Bar', THEMENAME),
    'icon' => 'el-icon-folder-open',
    'fields' => array(
        array(
            'subtitle' => 'Set Page Title boxed',
            'id' => 'page_title_boxed',
            'type' => 'switch',
            'title' => 'Page Title boxed',
            'default' => false
        ),
        array(
            'subtitle' => 'Text align for title bar',
            'id' => 'page_title_bar_align',
            'options' => array(
                'left' => 'Left',
                'center' => 'Center',
                'right' => 'Right'
            ),
            'type' => 'select',
            'title' => 'Title Align',
            'default' => 'left'
        ),
        array(
            'subtitle' => 'Insert the number of words you want to show in the page title bar.',
            'id' => 'title_bar_length',
            'type' => 'text',
            'title' => 'Title Bar Length',
            'default' => '20'
        ),
        array(
            'subtitle' => 'Insert the number of size you want to show in the page title bar.',
            'id' => 'title_bar_size',
            'type' => 'text',
            'title' => 'Title Size',
            'default' => '16px'
        ),
        array(
            'subtitle' => 'In pixels, default 50px',
            'id' => 'page_title_image_height',
            'type' => 'text',
            'title' => 'Image Height',
            'default' => '50px'
        ),
        array(
            'subtitle' => 'Controls the text color of the page title font.',
            'id' => 'page_title_color',
            'type' => 'color',
            'title' => 'Page Title Font Color',
            'default' => '#111111'
        ),
        array(
            'subtitle' => 'Select a color for the page title bar borders.',
            'id' => 'page_title_border_color',
            'type' => 'color',
            'title' => 'Page Title Bar Borders Color',
            'default' => ''
        ),
        array(
            'subtitle' => 'Page Title Bar Borders Top.',
            'id' => 'page_title_border_top',
            'type' => 'switch',
            'title' => 'Page Title Bar Borders Top',
            'default' => false
        ),
        array(
            'subtitle' => 'Page Title Bar Borders Top.',
            'id' => 'page_title_border_bottom',
            'type' => 'switch',
            'title' => 'Page Title Bar Borders Bottom',
            'default' => false
        ),
        array(
            'id'       => 'background-page-title',
            'type'     => 'background',
            'title'    => __( 'Background', THEMENAME ),
            'subtitle' => __( 'Page Title background with image, color, etc.', THEMENAME ),
            'default'   => array(
                'background-color'=>'#f7f7f7',
                'background-image'=> 'none',
                'background-repeat'=>'inherit',
                'background-size'=>'inherit',
                'background-attachment'=>'inherit',
                'background-position'=>'inherit'
            ),
        ),
        array(
            'subtitle' => 'Enable parallax background image when scrolling.',
            'id' => 'page_title_bg_parallax',

            'type' => 'switch',
            'title' => 'Parallax Background Image',
            'default' => false
        ),
        array(
            'subtitle' => 'In pixels, top left botton right, ex: 10px 10px 10px 10px',
            'id' => 'page_title_padding',
            'type' => 'text',
            'title' => 'Page Title Bar Padding',
            'default' => '60px 0'
        ),
        array(
            'subtitle' => 'In pixels, top left botton right, ex: 10px 10px 10px 10px',
            'id' => 'page_title_margin',
            'type' => 'text',
            'title' => 'Page Title Bar Margin',
            'default' => '0 0 100px'
        )
    )
);
$this->sections[] = array(
    'icon' => 'el-icon-bookmark',
    'title' => __('Breadcrumb', THEMENAME),
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => 'Show breadcrumbs.',
            'id' => 'breadcrumb_show',
            'type' => 'switch',
            'title' => 'Show Breadcrumb',
            'default' => false
        ),
        array(
            'subtitle' => 'Display breadcrumbs on mobile devices.',
            'id' => 'breadcrumb_mobile',

            'type' => 'switch',
            'title' => 'Breadcrumb on Mobile Devices',
            'default' => false
        ),
        array(
            'subtitle' => 'Select style for Page Title',
            'id' => 'breadcrumb_text_align',
            'options' => array(
                'left' => 'left',
                'center' => 'center',
                'right' => 'right'
            ),
            'type' => 'select',
            'title' => 'Breadcrumb Text Align',
            'default' => 'right'
        ),
        array(
            'subtitle' => 'The text before the breadcrumb home.',
            'id' => 'breacrumb_home_prefix',
            'type' => 'text',
            'title' => 'Breadcrumb Home Prefix',
            'default' => 'Home'
        ),
        array(
            'subtitle' => 'Controls the text color of the breadcrumb font.',
            'id' => 'breadcrumbs_text_color',
            'type' => 'color',
            'title' => 'Breadcrumbs Text Color',
            'default' => '#858585'
        ),
        array(
            'subtitle' => 'Controls the space between each breadcrumbs item.',
            'id' => 'breadcrumbs_item_padding',
            'type' => 'text',
            'title' => 'Breadcrumbs item space',
            'default' => '0 10px 0 0'
        ),
        array(
            'subtitle' => 'Controls the separator style between each item, example / or a AweSome icon, Default is f0da for arrow-right icon. <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_blank">Click here</a> for get AweSome icon.',
            'id' => 'breadcrumbs_separator',
            'type' => 'text',
            'title' => 'Breadcrumbs separator',
            'default' => '/'
        )
    )
);
/**
 * Styling Options
 */
$this->sections[] = array(
    'title' => __('Styling Options', THEMENAME),
    'icon' => 'el-icon-adjust',
    'fields' => array(
        array(
            'subtitle' => 'Select a scheme, all color options will automatically change to the defined scheme.',
            'id' => 'preset_color_scheme',
            'type' => 'select',
            'options' => array(
                'Preset1' => 'preset1',
                'Preset2' => 'preset2'
            ),
            'title' => 'Preset Color Scheme',
            'default' => 'preset1'
        ),
        array(
            'subtitle' => 'Controls several items, ex: link hovers, highlights, and more.',
            'id' => 'primary_color',
            'type' => 'color',
            'title' => 'Primary Color',
            'default' => '#111111'
        ),
        array(
            'subtitle' => 'Secondary color.',
            'id' => 'secondary_color',
            'type' => 'color',
            'title' => 'Secondary Color',
            'default' => '#59d7c5'
        )
    )
);
$this->sections[] = array(
    'icon' => 'el-icon-check',
    'title' => __('Form Styles', THEMENAME),
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => 'Controls the background color of form fields.',
            'id' => 'form_bg_color',
            'type' => 'color',
            'title' => 'Form Background Color',
            'default' => 'transparent'
        ),
        array(
            'subtitle' => 'Controls the text color for forms.',
            'id' => 'form_text_color',
            'type' => 'color',
            'title' => 'Form Text Color',
            'default' => '#868686'
        ),
        array(
            'subtitle' => 'Controls the text color for forms.',
            'id' => 'form_text_color_hover',
            'type' => 'color',
            'title' => 'Form Text Color Hover',
            'default' => '#111111'
        ),
        array(
            'subtitle' => 'Controls the background color for each field. Default is #ffffff',
            'id' => 'form_field_bg_color',
            'type' => 'color',
            'title' => 'Form Fields background color',
            'default' => '#FFFFFF'
        ),
        array(
            'subtitle' => 'Controls the background color hover, focus, active state for each field. Default is #eeeeee',
            'id' => 'form_field_bg_color_hover',
            'type' => 'color',
            'title' => 'Form Fields background hover color',
            'default' => '#FFFFFF'
        ),
        array(
            'subtitle' => 'Controls the border style of form fields. Default is Solid',
            'id' => 'form_border_style',
            'type' => 'select',
            'options' => $border_style,
            'title' => 'Form Fields Border style',
            'default' => 'solid'
        ),
        array(
            'subtitle' => 'Controls the border width of form fields. Top, Right, Bottom, Left. Ex: 1px 1px 1px 1px. Default is 1px',
            'id' => 'form_border_width',
            'type' => 'text',
            'title' => 'Form Fields Border Width',
            'default' => '1px'
        ),
        array(
            'subtitle' => 'Controls the border color of form fields. Default is #dddddd',
            'id' => 'form_border_color',
            'type' => 'color',
            'title' => 'Form Fields Border Color',
            'default' => '#eeeeee'
        ),
        array(
            'subtitle' => 'Controls the border color hover, active, focus state of form fields. Default is #cccccc',
            'id' => 'form_border_color_hover',
            'type' => 'color',
            'title' => 'Form Fields Border Color Hover',
            'default' => '#59d7c5'
        ),
        array(
            'subtitle' => 'Controls the shadow of form fields. Ex: 0px 0px 10px 4px rgba(119, 119, 119, 0.75).	<a href="http://www.webestools.com/css3-box-shadow-generator-css-property-easy-shadows-div-html5-drop-shadow-moz-webkit-shadow-maker.html#generatorForm" target="_blank">Click here</a> to make your shadow style!',
            'id' => 'form_shadow',
            'type' => 'text',
            'title' => 'Form Fields Shadow style',
            'default' => 'none'
        ),
        array(
            'subtitle' => 'Controls the shadow of form fields in hover, active, focus state. Ex: 0px 0px 10px 4px rgba(119, 119, 119, 0.75).	<a href="http://www.webestools.com/css3-box-shadow-generator-css-property-easy-shadows-div-html5-drop-shadow-moz-webkit-shadow-maker.html#generatorForm" target="_blank">Click here</a> to make your shadow style!',
            'id' => 'form_shadow_hover',
            'type' => 'text',
            'title' => 'Form Fields Shadow Hover style',
            'default' => 'none'
        ),
        array(
            'subtitle' => 'Controls the border radius style for form fields.Top, Right, Bottom, Left Ex: 5px 5px 5px 5px for rounded style or 50% for circle style. Default is 0',
            'id' => 'form_border_radius',
            'type' => 'text',
            'title' => 'Form Fields Border Radius Style',
            'default' => '0'
        )
    )
);
$this->sections[] = array(
    'icon' => 'el-icon-fontsize',
    'title' => __('Content Area', THEMENAME),
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => 'Controls the background color of the main content area.',
            'id' => 'content_bg_color',
            'type' => 'color',
            'title' => 'Content Background Color',
            'default' => 'transparent'
        ),
        array(
            'subtitle' => 'Select an image or insert an image url to use for the Content backgroud.',
            'id' => 'bg_content_image',
            'type' => 'media',
            'title' => 'Content Background Image',
            'url' => true,
            'default' => array(
                'url' => ''
            ),
        ),
        array(
            'subtitle' => 'The Content background image display at 100% in width and height and scale according to the browser size.',
            'id' => 'bg_content_full',
            'type' => 'switch',
            'title' => 'Cover and fixed Content Background Image',
            'default' => true
        ),
        array(
            'subtitle' => 'Select how the Content background image repeats.',
            'id' => 'bg_content_repeat',
            'type' => 'select',
            'options' => array(
                'repeat' => 'repeat',
                'repeat-x' => 'repeat-x',
                'repeat-y' => 'repeat-y',
                'no-repeat' => 'no-repeat'
            ),
            'title' => 'Content Background Repeat',
            'default' => 'repeat'
        ),
        array(
            'subtitle' => '(In pixels, top left botton right, ex: 10px 10px 10px 10px)',
            'id' => 'main_content_padding',
            'type' => 'text',
            'title' => 'Page Content Padding',
            'default' => '0'
        ),
        array(
            'subtitle' => '(In pixels, top left botton right, ex: 10px)',
            'id' => 'main_content_margin_top',
            'type' => 'text',
            'title' => 'Page Content Margin Top',
            'default' => '0'
        ),
        array(
            'subtitle' => '(In pixels, top left botton right, ex: 10px)',
            'id' => 'main_content_margin_bottom',
            'type' => 'text',
            'title' => 'Page Content Margin Bottom',
            'default' => '0'
        )
    )
);
$this->sections[] = array(
    'icon' => 'el-icon-font',
    'title' => __('Font Colors', THEMENAME),
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => 'Controls the color of all text links.',
            'id' => 'link_color',
            'type' => 'color',
            'title' => 'Link Color',
            'default' => '#111111'
        ),
        array(
            'subtitle' => 'Link Color Hover.',
            'id' => 'link_color_hover',
            'type' => 'color',
            'title' => 'Link Color Hover',
            'default' => '#59d7c5'
        )
    )
);
/**
 * Typography
 */
$this->sections[] = array(
    'title' => __('Typography', THEMENAME),
    'icon' => 'el-icon-text-width',
    'fields' => array(
        array(
            'id' => 'typography_0',
            'type' => 'typography',
            'title' => __('Body Font', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body'),
            'units' => 'px',
            'subtitle' => __('Typography option with each property can be called individually.', 'redux-framework-demo'),
            'default' => array(
                'color' => '#888',
                'font-weight' => '300',
                'font-style' => '',
                'font-family' => 'Open Sans',
                'google' => true,
                'font-size' => '14px',
                'line-height' => '26px',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'typography_2',
            'type' => 'typography',
            'title' => __('Other Font', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'units' => 'px',
            'subtitle' => __('Typography option with each property can be called individually.', 'redux-framework-demo'),
            'default' => array(
                'color' => '#111',
                'font-weight' => '400',
                'font-style' => '',
                'font-family' => 'Montserrat',
                'google' => true,
                'font-size' => '13px',
                'line-height' => '13px',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'typography_selector_2',
            'type' => 'textarea',
            'title' => __('Other Font Selector', THEMENAME),
            'subtitle' => __('Add tag html ID or class (body,a,.class,#id)', THEMENAME),
            'validate' => 'no_html',
            'default' => '.cshero-dropdown > li > a, .btn, button, .button,.readmore ,.nav-label, .cshero-product-price, .add_to_cart_button, .wpb_tabs.style1 ul.wpb_tabs_nav li a,
.primary-sidebar ul > li > a'
        )
    )
);
$this->sections[] = array(
    'title' => __('Heading', THEMENAME),
    'icon' => 'el-icon-font',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'typography_h1',
            'type' => 'typography',
            'title' => __('H1', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('h1'),
            'units' => 'px',
            'subtitle' => __('Typography option with H1.', THEMENAME),
            'default' => array(
                'color' => '#111',
                'font-weight' => '400',
                'font-style' => '',
                'font-family' => 'Montserrat',
                'google' => true,
                'font-size' => '36px',
                'line-height' => '36px',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'typography_h2',
            'type' => 'typography',
            'title' => __('H2', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('h2'),
            'units' => 'px',
            'subtitle' => __('Typography option with H2.', THEMENAME),
            'default' => array(
                'color' => '#111',
                'font-weight' => '400',
                'font-style' => '',
                'font-family' => 'Montserrat',
                'google' => true,
                'font-size' => '30px',
                'line-height' => '30px',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'typography_h3',
            'type' => 'typography',
            'title' => __('H3', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('h3'),
            'units' => 'px',
            'subtitle' => __('Typography option with H3.', THEMENAME),
            'default' => array(
                'color' => '#111',
                'font-weight' => '400',
                'font-style' => '',
                'font-family' => 'Montserrat',
                'google' => true,
                'font-size' => '24px',
                'line-height' => '24px',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'typography_h4',
            'type' => 'typography',
            'title' => __('H4', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('h4'),
            'units' => 'px',
            'subtitle' => __('Typography option with H4.', THEMENAME),
            'default' => array(
                'color' => '#111',
                'font-weight' => '400',
                'font-style' => '',
                'font-family' => 'Montserrat',
                'google' => true,
                'font-size' => '20px',
                'line-height' => '20px',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'typography_h5',
            'type' => 'typography',
            'title' => __('H5', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('h5'),
            'units' => 'px',
            'subtitle' => __('Typography option with H5.', THEMENAME),
            'default' => array(
                'color' => '#111',
                'font-weight' => '400',
                'font-style' => '',
                'font-family' => 'Montserrat',
                'google' => true,
                'font-size' => '14px',
                'line-height' => '14px',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'typography_h6',
            'type' => 'typography',
            'title' => __('H6', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('h6'),
            'units' => 'px',
            'subtitle' => __('Typography option with H6.', THEMENAME),
            'default' => array(
                'color' => '#111',
                'font-weight' => '400',
                'font-style' => '',
                'font-family' => 'Montserrat',
                'google' => true,
                'font-size' => '13px',
                'line-height' => '13px',
                'text-align' => ''
            )
        )
    )
);
$this->sections[] = array(
    'title' => __('Extra', THEMENAME),
    'icon' => 'el-icon-puzzle',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'typography_3',
            'type' => 'typography',
            'title' => __('Other Font 1', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'units' => 'px',
            'subtitle' => __('Typography option with each property can be called individually.', 'redux-framework-demo'),
            'default' => array(
                'color' => '',
                'font-weight' => '',
                'font-family' => '',
                'font-style' => '',
                'google' => true,
                'font-size' => '',
                'line-height' => '',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'typography_selector_3',
            'type' => 'textarea',
            'title' => __('Other Font Selector 1', THEMENAME),
            'subtitle' => __('Add tag html ID or class (body,a,.class,#id)', THEMENAME),
            'validate' => 'no_html',
            'default' => '',
        ),
        array(
            'id' => 'typography_4',
            'type' => 'typography',
            'title' => __('Other Font 2', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'units' => 'px',
            'subtitle' => __('Typography option with each property can be called individually.', 'redux-framework-demo'),
            'default' => array(
                'color' => '',
                'font-weight' => '',
                'font-style' => '',
                'font-family' => '',
                'google' => true,
                'font-size' => '',
                'line-height' => '',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'typography_selector_4',
            'type' => 'textarea',
            'title' => __('Other Font Selector 2', THEMENAME),
            'subtitle' => __('Add tag html ID or class (body,a,.class,#id)', THEMENAME),
            'validate' => 'no_html',
            'default' => '',
        ),
        array(
            'id' => 'typography_5',
            'type' => 'typography',
            'title' => __('Other Font 3', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'units' => 'px',
            'subtitle' => __('Typography option with each property can be called individually.', 'redux-framework-demo'),
            'default' => array(
                'color' => '',
                'font-weight' => '',
                'font-style' => '',
                'font-family' => '',
                'google' => true,
                'font-size' => '',
                'line-height' => '',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'typography_selector_5',
            'type' => 'textarea',
            'title' => __('Other Font Selector 3', THEMENAME),
            'subtitle' => __('Add tag html ID or class (body,a,.class,#id)', THEMENAME),
            'validate' => 'no_html',
            'default' => '',
        ),
        array(
            'id' => 'typography_6',
            'type' => 'typography',
            'title' => __('Other Font 4', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'units' => 'px',
            'subtitle' => __('Typography option with each property can be called individually.', 'redux-framework-demo'),
            'default' => array(
                'color' => '',
                'font-weight' => '',
                'font-style' => '',
                'font-family' => '',
                'google' => true,
                'font-size' => '',
                'line-height' => '',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'typography_selector_6',
            'type' => 'textarea',
            'title' => __('Other Font Selector 4', THEMENAME),
            'subtitle' => __('Add tag html ID or class (body,a,.class,#id)', THEMENAME),
            'validate' => 'no_html',
            'default' => '',
        ),
        array(
            'id' => 'typography_7',
            'type' => 'typography',
            'title' => __('Other Font 5', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'units' => 'px',
            'subtitle' => __('Typography option with each property can be called individually.', 'redux-framework-demo'),
            'default' => array(
                'color' => '',
                'font-weight' => '',
                'font-style' => '',
                'font-family' => '',
                'google' => true,
                'font-size' => '',
                'line-height' => '',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'typography_selector_7',
            'type' => 'textarea',
            'title' => __('Other Font Selector 5', THEMENAME),
            'subtitle' => __('Add tag html ID or class (body,a,.class,#id)', THEMENAME),
            'validate' => 'no_html',
            'default' => '',
        ),
        array(
            'id' => 'typography_8',
            'type' => 'typography',
            'title' => __('Other Font 6', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'units' => 'px',
            'subtitle' => __('Typography option with each property can be called individually.', 'redux-framework-demo'),
            'default' => array(
                'color' => '',
                'font-weight' => '',
                'font-style' => '',
                'font-family' => '',
                'google' => true,
                'font-size' => '',
                'line-height' => '',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'typography_selector_8',
            'type' => 'textarea',
            'title' => __('Other Font Selector 6', THEMENAME),
            'subtitle' => __('Add tag html ID or class (body,a,.class,#id)', THEMENAME),
            'validate' => 'no_html',
            'default' => '',
        ),
        array(
            'id' => 'typography_9',
            'type' => 'typography',
            'title' => __('Other Font 7', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'units' => 'px',
            'subtitle' => __('Typography option with each property can be called individually.', 'redux-framework-demo'),
            'default' => array(
                'color' => '',
                'font-weight' => '',
                'font-style' => '',
                'font-family' => '',
                'google' => true,
                'font-size' => '',
                'line-height' => '',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'typography_selector_9',
            'type' => 'textarea',
            'title' => __('Other Font Selector 7', THEMENAME),
            'subtitle' => __('Add tag html ID or class (body,a,.class,#id)', THEMENAME),
            'validate' => 'no_html',
            'default' => '',
        ),
        array(
            'id' => 'typography_10',
            'type' => 'typography',
            'title' => __('Other Font 8', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'units' => 'px',
            'subtitle' => __('Typography option with each property can be called individually.', 'redux-framework-demo'),
            'default' => array(
                'color' => '',
                'font-weight' => '',
                'font-style' => '',
                'font-family' => '',
                'google' => true,
                'font-size' => '',
                'line-height' => '',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'typography_selector_10',
            'type' => 'textarea',
            'title' => __('Other Font Selector 8', THEMENAME),
            'subtitle' => __('Add tag html ID or class (body,a,.class,#id)', THEMENAME),
            'validate' => 'no_html',
            'default' => '',
        ),
        array(
            'id' => 'typography_11',
            'type' => 'typography',
            'title' => __('Other Font 9', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'units' => 'px',
            'subtitle' => __('Typography option with each property can be called individually.', 'redux-framework-demo'),
            'default' => array(
                'color' => '',
                'font-weight' => '',
                'font-style' => '',
                'font-family' => '',
                'google' => true,
                'font-size' => '',
                'line-height' => '',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'typography_selector_11',
            'type' => 'textarea',
            'title' => __('Other Font Selector 9', THEMENAME),
            'subtitle' => __('Add tag html ID or class (body,a,.class,#id)', THEMENAME),
            'validate' => 'no_html',
            'default' => '',
        ),
        array(
            'id' => 'typography_12',
            'type' => 'typography',
            'title' => __('Other Font 10', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'units' => 'px',
            'subtitle' => __('Typography option with each property can be called individually.', 'redux-framework-demo'),
            'default' => array(
                'color' => '',
                'font-weight' => '',
                'font-style' => '',
                'font-family' => '',
                'google' => true,
                'font-size' => '',
                'line-height' => '',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'typography_selector_12',
            'type' => 'textarea',
            'title' => __('Other Font Selector 10', THEMENAME),
            'subtitle' => __('Add tag html ID or class (body,a,.class,#id)', THEMENAME),
            'validate' => 'no_html',
            'default' => '',
        )
    )
);
/**
 * Blog
 */
$this->sections[] = array(
    'title' => __('Blog', THEMENAME),
    'icon' => 'el-icon-website',
    'fields' => array(
        array(
            'subtitle' => 'Select main content and sidebar alignment.',
            'id' => 'blog_layout',
            'type' => 'image_select',
            'options' => array(
                'full-fixed' => ADMIN_DIR.'assets/images/1col.png',
                'right-fixed' => ADMIN_DIR.'assets/images/2cr.png',
                'left-fixed' => ADMIN_DIR.'assets/images/2cl.png'
            ),
            'title' => 'Blog Layout',
            'default' => 'right-fixed'
        ),
        array(
            'subtitle' => 'Select heading of title',
            'id' => 'blog_title_heading',
            'type' => 'select',
            'options' => array(
                'h1' => 'h1',
                'h2' => 'h2',
                'h3' => 'h3',
                'h4' => 'h4',
                'h5' => 'h5',
                'h6' => 'h6'
            ),
            'title' => 'Title Heading',
            'default' => 'h4'
        ),
        array(
            'subtitle' => 'Show read more in posts (Default show Full Content).',
            'id' => 'blog_full_content',
            'type' => 'switch',
            'title' => 'Read More',
            'default' => true
        ),
        array(
            'subtitle' => 'Introtext Length',
            'id' => 'introtext_length',
            'type' => 'text',
            'title' => 'Limit Words',
            'default' => '45',
            'required' => array(
                0 => 'blog_full_content',
                1 => '=',
                2 => 1
            )
        )
    )
);
$this->sections[] = array(
    'icon' => 'el-icon-search',
    'title' => __('Search', THEMENAME),
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => 'Show Heading For Search',
            'id' => 'search_heading',

            'type' => 'switch',
            'title' => 'Show Heading',
            'default' => false
        ),
        array(
            'subtitle' => 'Show page title on Search',
            'id' => 'search_page_title',

            'type' => 'switch',
            'title' => 'Show Page Title',
            'default' => true
        ),
        array(
            'subtitle' => 'Fade out page title on scroll',
            'id' => 'search_page_title_animation',

            'type' => 'switch',
            'title' => 'Page Title Animation',
            'default' => false
        ),
        array(
            'subtitle' => 'Show Breadcrumbs on Search',
            'id' => 'search_breadcrumbs',

            'type' => 'switch',
            'title' => 'Show Breadcrumbs',
            'default' => false
        ),
        array(
            'subtitle' => 'Select view type for Search Results.',
            'id' => 'search_view',
            'type' => 'select',
            'options' => array(
                'Excerpt' => 'No',
                'Read More' => 'Yes'
            ),
            'title' => 'Show Readmore Button',
            'default' => 'Excerpt'
        )
    )
);
$this->sections[] = array(
    'icon' => 'el-icon-th-list',
    'title' => __('Archive', THEMENAME),
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => 'Show Heading For Archive',
            'id' => 'archive_heading',

            'type' => 'switch',
            'title' => 'Show Heading',
            'default' => false
        ),
        array(
            'subtitle' => 'Show Page Title On Archive',
            'id' => 'archive_page_title',

            'type' => 'switch',
            'title' => 'Show Page Title',
            'default' => true
        ),
        array(
            'subtitle' => 'Fade out page title on scroll',
            'id' => 'archive_page_title_animation',

            'type' => 'switch',
            'title' => 'Page Title Animation',
            'default' => false
        ),
        array(
            'subtitle' => 'Show Archive Breadcrumbs',
            'id' => 'archive_breadcrumbs',

            'type' => 'switch',
            'title' => 'Show Breadcrumbs',
            'default' => false
        ),
        array(
            'subtitle' => 'Show Posts Title',
            'id' => 'archive_posts_title',

            'type' => 'switch',
            'title' => 'Show Posts Title',
            'default' => true
        ),
        array(
            'subtitle' => 'Display featured images on archive post.',
            'id' => 'post_featured_images',
            'type' => 'switch',
            'title' => 'Featured Image On Archive Post',
            'default' => true
        ),
        array(
            'subtitle' => 'Show read more in posts (Defualt show Full Content).',
            'id' => 'show_full_content',

            'type' => 'switch',
            'title' => 'Read More',
            'default' => true
        ),
        array(
            'subtitle' => '<a href=\'http://codex.wordpress.org/Formatting_Date_and_Time\'>Formatting Date and Time</a>',
            'id' => 'archive_date_format',
            'type' => 'text',
            'title' => 'Blog Date Format',
            'default' => 'M d Y'
        ),
        array(
            'subtitle' => 'Select Style for Archive list post',
            'id' => 'archive_post',
            'type' => 'select',
            'options' => array(
                '1' => '1 Column',
                '2' => '2 Columns',
                '3' => '3 Columns',
                '4' => '4 Columns',
                '6' => '6 Columns',
            ),
            'title' => 'Archive Style',
            'default' => '1'
        )
    )
);
$this->sections[] = array(
    'icon' => 'el-icon-livejournal',
    'title' => __('Post', THEMENAME),
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => 'Show Page Title On Post',
            'id' => 'post_page_title',

            'type' => 'switch',
            'title' => 'Show Page Title',
            'default' => true
        ),
        array(
            'subtitle' => 'Fade out page title on scroll',
            'id' => 'post_page_title_animation',
            'type' => 'switch',
            'title' => 'Page Title Animation',
            'default' => false
        ),
        array(
            'subtitle' => 'Show post Breadcrumbs',
            'id' => 'post_breadcrumbs',
            'type' => 'switch',
            'title' => 'Show Breadcrumbs',
            'default' => false
        ),
        array(
            'subtitle' => 'Show Post Title',
            'id' => 'show_post_title',
            'type' => 'switch',
            'title' => 'Show Post Title',
            'default' => true
        ),
        array(
            'subtitle' => 'Show Comments Post',
            'id' => 'show_comments_post',
            'type' => 'switch',
            'title' => 'Show Comments Post',
            'default' => true
        ),
        array(
            'subtitle' => 'Show Tags Post',
            'id' => 'show_tags_post',
            'type' => 'switch',
            'title' => 'Show Tags',
            'default' => false
        ),
        array(
            'subtitle' => 'Show Socials Icon at bottom of single post',
            'id' => 'show_social_post',
            'type' => 'switch',
            'title' => 'Show Socials Icon',
            'default' => true
        ),
        array(
            'subtitle' => 'Previous/Next Pagination',
            'id' => 'show_navigation_post',
            'type' => 'switch',
            'title' => 'Previous/Next Pagination',
            'default' => true
        ),
        array(
            'subtitle' => 'Select main content and sidebar alignment.',
            'id' => 'post_layout',
            'type' => 'image_select',
            'options' => array(
                'full-fixed' => ADMIN_DIR.'assets/images/1col.png',
                'right-fixed' => ADMIN_DIR.'assets/images/2cr.png',
                'left-fixed' => ADMIN_DIR.'assets/images/2cl.png'
            ),
            'title' => 'Post Layout',
            'default' => 'right-fixed'
        ),
        array(
            'subtitle' => 'Select Style for Post Items',
            'id' => 'post_style',
            'type' => 'select',
            'options' => array(
                'base' => 'Base',
            ),
            'title' => 'Post Style',
            'default' => 'base'
        ),
        
        array(
            'subtitle' => '<a href=\'http://codex.wordpress.org/Formatting_Date_and_Time\'>Formatting Date and Time</a>',
            'id' => 'post_date_format',
            'type' => 'text',
            'title' => 'Post Date Format',
            'default' => 'M d Y'
        ),
        array(
            'subtitle' => 'Display related posts on detail post.',
            'id' => 'related_posts',
            'type' => 'switch',
            'title' => 'Related Posts',
            'default' => false
        )
    )
);
$this->sections[] = array(
    'icon' => 'el-icon-edit',
    'title' => __('Page', THEMENAME),
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => 'Show page heading',
            'id' => 'page_heading',

            'type' => 'switch',
            'title' => 'Show Heading',
            'default' => false
        ),
        array(
            'subtitle' => 'Show Page Title On Page',
            'id' => 'page_page_title',

            'type' => 'switch',
            'title' => 'Show Page Title',
            'default' => true
        ),
        array(
            'subtitle' => 'Fade out page title on scroll',
            'id' => 'page_page_title_animation',

            'type' => 'switch',
            'title' => 'Page Title Animation',
            'default' => true
        ),
        array(
            'subtitle' => 'Show page breadcrumbs',
            'id' => 'page_breadcrumbs',

            'type' => 'switch',
            'title' => 'Show Breadcrumbs',
            'default' => true
        ),
        array(
            'subtitle' => 'Show Comments Page',
            'id' => 'show_comments_page',

            'type' => 'switch',
            'title' => 'Show Comments Page',
            'default' => false
        ),
        array(
            'subtitle' => 'Select main content and sidebar alignment.',
            'id' => 'page_layout',
            'type' => 'image_select',
            'options' => array(
                'full-fixed' => ADMIN_DIR.'assets/images/1col.png',
                'right-fixed' => ADMIN_DIR.'assets/images/2cr.png',
                'left-fixed' => ADMIN_DIR.'assets/images/2cl.png'
            ),
            'title' => 'Page Layout',
            'default' => 'full-fixed'
        ),
        array(
            'subtitle' => 'Display featured images on archive page.',
            'id' => 'page_featured_images',
            'type' => 'switch',
            'title' => 'Featured Image On Archive Page',
            'default' => true
        )
    )
);
$this->sections[] = array(
    'icon' => 'el-icon-tags',
    'title' => __('Detail', THEMENAME),
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => 'Select heading of title',
            'id' => 'detail_title_heading',
            'type' => 'select',
            'options' => array(
                'h1' => 'h1',
                'h2' => 'h2',
                'h3' => 'h3',
                'h4' => 'h4',
                'h5' => 'h5',
                'h6' => 'h6'
            ),
            'title' => 'Title Heading',
            'default' => 'h3'
        ),
        array(
            'subtitle' => 'Display detail bar on archive post and single.',
            'id' => 'detail_detail',

            'type' => 'switch',
            'title' => 'Show Detail',
            'default' => true
        ),
        array(
            'subtitle' => 'Display date on archive post and single.',
            'id' => 'detail_date',

            'type' => 'switch',
            'title' => 'Show Date',
            'default' => true,
            'required' => array(
                0 => 'detail_detail',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Display Author on archive post and single.',
            'id' => 'detail_author',

            'type' => 'switch',
            'title' => 'Show Author',
            'default' => true,
            'required' => array(
                0 => 'detail_detail',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Display Category on archive post and single.',
            'id' => 'detail_category',

            'type' => 'switch',
            'title' => 'Show Category',
            'default' => true,
            'required' => array(
                0 => 'detail_detail',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Display Tags on archive post and single.',
            'id' => 'detail_tags',

            'type' => 'switch',
            'title' => 'Show Tags',
            'default' => false,
            'required' => array(
                0 => 'detail_detail',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Display Comments on archive post and single.',
            'id' => 'detail_comments',

            'type' => 'switch',
            'title' => 'Show Comments',
            'default' => true,
            'required' => array(
                0 => 'detail_detail',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Display Like on archive post and single.',
            'id' => 'detail_like',

            'type' => 'switch',
            'title' => 'Show Like',
            'default' => true,
            'required' => array(
                0 => 'detail_detail',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Display social sharing on archive post and single.',
            'id' => 'detail_social',

            'type' => 'switch',
            'title' => 'Show Sharing',
            'default' => true,
            'required' => array(
                0 => 'detail_detail',
                1 => '=',
                2 => 1
            )
        )
    )
);
$cats = get_categories();
foreach ($cats as $key => $cat) {
    $categories[$cat->term_id] =  $cat->name;
}
$this->sections[] = array(
    'icon' => 'el-icon-rate',
    'title' => __('Rate', THEMENAME),
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => 'Display Rating On Single Post',
            'id' => 'show_rating',
            'type' => 'switch',
            'title' => 'Show Rating',
            'default' => false
        ),
        array(
            'subtitle' => 'Choose categories you want use rating.',
            'id' => 'rating_categories',
            'type' => 'select',
            'title' => 'Categories',
            'multi' => true,
            'options' => $categories,
            'required' => array(
                0 => 'show_rating',
                1 => '=',
                2 => true
            )
        )
    )
);
$this->sections[] = array(
    'title' => __('Portfolio', THEMENAME),
    'icon' => 'el-icon-website',
    'fields' => array(
        array(
            'id' => 'details_portfolio_layout',
            'title' => 'Single Portfolio layout',
            'subtitle' => 'Select Style for portfolio Items',   
            'type' => 'select',
            'options' => array(
                'vertical-floating-sidebar' => 'Vertical Floating Sidebar',
                'vertical-wide' => 'Vertical Wide', 
                'big-slider' => 'Big slider',
                'small-slider' => 'Small Slider',
                'gallery'=>'Gallery',
                'video'=>'Video'
            ),
            'default' => 'vertical-floating-sidebar'
        ),
        array(
            'id' => 'details_portfolio_gallery_layout',
            'title' => 'Portfolio Gallery Style',
            'subtitle' => 'Select Style for image gallery. If Grid, you can control the columns in gallery config',
            'type' => 'select',
            'options' => array(
                'grid' => 'Grid',
                'carousel' => 'Carousel'
            ),
            'default' => 'grid'
        )  
    )
);

/**
 * One Page
 */
$this->sections[] = array(
    'title' => __('One Page', THEMENAME),
    'icon' => 'el-icon-stackoverflow',
    'fields' => array(
        array(
            'subtitle' => 'Use One Page',
            'id' => 'enable_one_page',

            'type' => 'switch',
            'title' => 'One Page Enable',
            'default' => false
        ),
        array(
            'subtitle' => 'Scroll Speed (default 750)',
            'id' => 'page_scroll_speed',
            'type' => 'text',
            'title' => 'Scroll Speed',
            'default' => '750',
            'required' => array(
                0 => 'enable_one_page',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Scroll Offset (Defualt 0)',
            'id' => 'page_scroll_offset',
            'type' => 'text',
            'title' => 'Scroll Offset',
            'default' => '0',
            'required' => array(
                0 => 'enable_one_page',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Scroll animation (Defualt swing).',
            'id' => 'page_scroll_easing',
            'type' => 'select',
            'options' => array(
                'jswing' => 'jswing',
                'def' => 'def',
                'easeInQuad' => 'easeInQuad',
                'easeOutQuad' => 'easeOutQuad',
                'easeInOutQuad' => 'easeInOutQuad',
                'easeInCubic' => 'easeInCubic',
                'easeOutCubic' => 'easeOutCubic',
                'easeInOutCubic' => 'easeInOutCubic',
                'easeInQuart' => 'easeInQuart',
                'easeOutQuart' => 'easeOutQuart',
                'easeInOutQuart' => 'easeInOutQuart',
                'easeInQuint' => 'easeInQuint',
                'easeOutQuint' => 'easeOutQuint',
                'easeInOutQuint' => 'easeInOutQuint',
                'easeInSine' => 'easeInSine',
                'easeOutSine' => 'easeOutSine',
                'easeInOutSine' => 'easeInOutSine',
                'easeInExpo' => 'easeInExpo',
                'easeOutExpo' => 'easeOutExpo',
                'easeInOutExpo' => 'easeInOutExpo',
                'easeInCirc' => 'easeInCirc',
                'easeOutCirc' => 'easeOutCirc',
                'easeInOutCirc' => 'easeInOutCirc',
                'easeInElastic' => 'easeInElastic',
                'easeOutElastic' => 'easeOutElastic',
                'easeInOutElastic' => 'easeInOutElastic',
                'easeInBack' => 'easeInBack',
                'easeOutBack' => 'easeOutBack',
                'easeInOutBack' => 'easeInOutBack',
                'easeInBounce' => 'easeInBounce',
                'easeOutBounce' => 'easeOutBounce',
                'easeInOutBounce' => 'easeInOutBounce'
            ),
            'title' => 'Easing Plugin',
            'default' => 'jswing',
            'required' => array(
                0 => 'enable_one_page',
                1 => '=',
                2 => 1
            )
        )
    )
);
/**
 * Custom Posts
 */
$this->sections[] = array(
    'title' => __('Custom Posts', THEMENAME),
    'icon' => 'el-icon-comment-alt'
);
/**
 * Teams
 */
$this->sections[] = array(
    'title' => __('Teams', THEMENAME),
    'icon' => 'el-icon-group',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => 'Please enter about title of post team detail.',
            'id' => 'team_about_title',
            'type' => 'text',
            'title' => 'About title',
            'default' => 'A little about me...'
        ),
        array(
            'subtitle' => 'Show or hide description of post team detail.',
            'id' => 'team_show_subtitleription',

            'type' => 'switch',
            'title' => 'Show description',
            'default' => true
        ),
        array(
            'subtitle' => 'Insert the number of words you want to show in the post excerpts.',
            'id' => 'team_excerpt_length',
            'type' => 'text',
            'title' => 'Excerpt Length',
            'default' => '100',
            'required' => array(
                0 => 'team_show_subtitleription',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Show or hide socials of post team detail.',
            'id' => 'team_show_socials',

            'type' => 'switch',
            'title' => 'Show Socials',
            'default' => true
        )
    )
);
/**
 * Portfolio
 */
$this->sections[] = array(
    'title' => __('Portfolio', THEMENAME),
    'icon' => 'el-icon-th-large',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => 'Please enter about title of post portfolio detail.',
            'id' => 'portfolio_about_title',
            'type' => 'text',
            'title' => 'About title',
            'default' => 'About the Project'
        ),
        array(
            'subtitle' => 'Show or hide description of post portfolio detail.',
            'id' => 'portfolio_show_subtitleription',

            'type' => 'switch',
            'title' => 'Show description',
            'default' => true
        ),
        array(
            'subtitle' => 'Insert the number of words you want to show in the post excerpts.',
            'id' => 'portfolio_excerpt_length',
            'type' => 'text',
            'title' => 'Excerpt Length',
            'default' => '100',
            'required' => array(
                0 => 'portfolio_show_subtitleription',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Show or hide custom field of post portfolio detail.',
            'id' => 'portfolio_show_custom_field',

            'type' => 'switch',
            'title' => 'Show Custom Field',
            'default' => true
        ),
        array(
            'subtitle' => 'Please enter the class icon from http://fortawesome.github.io/Font-Awesome/icons/. Ex: fa fa-bookmark-o.',
            'id' => 'portfolio_custom_field_icon',
            'type' => 'text',
            'title' => 'Custom Field Icon',
            'default' => 'fa fa-bookmark-o',
            'required' => array(
                0 => 'portfolio_show_custom_field',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Please enter the title custom field of post portfolio detail.',
            'id' => 'portfolio_custom_field_title',
            'type' => 'text',
            'title' => 'Custom Field Title',
            'default' => 'Custom Field',
            'required' => array(
                0 => 'portfolio_show_custom_field',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Show or hide date of post portfolio detail.',
            'id' => 'portfolio_show_date',

            'type' => 'switch',
            'title' => 'Show Date',
            'default' => true
        ),
        array(
            'subtitle' => 'Please enter the class icon from http://fortawesome.github.io/Font-Awesome/icons/. Ex: fa fa-clock-o.',
            'id' => 'portfolio_date_icon',
            'type' => 'text',
            'title' => 'Date Icon',
            'default' => 'fa fa-clock-o',
            'required' => array(
                0 => 'portfolio_show_date',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Please enter the title date of post portfolio detail.',
            'id' => 'portfolio_date_title',
            'type' => 'text',
            'title' => 'Date Title',
            'default' => 'Date',
            'required' => array(
                0 => 'portfolio_show_date',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Show or hide category of post portfolio detail.',
            'id' => 'portfolio_show_category',

            'type' => 'switch',
            'title' => 'Show Category',
            'default' => true
        ),
        array(
            'subtitle' => 'Please enter the class icon from http://fortawesome.github.io/Font-Awesome/icons/. Ex: fa fa-tags.',
            'id' => 'portfolio_category_icon',
            'type' => 'text',
            'title' => 'Category Icon',
            'default' => 'fa fa-tags',
            'required' => array(
                0 => 'portfolio_show_category',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Please enter the title category of post portfolio detail.',
            'id' => 'portfolio_category_title',
            'type' => 'text',
            'title' => 'Category Title',
            'default' => 'Category',
            'required' => array(
                0 => 'portfolio_show_category',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Show or hide Likes of post portfolio detail.',
            'id' => 'portfolio_show_like',

            'type' => 'switch',
            'title' => 'Show Likes',
            'default' => true
        ),
        array(
            'subtitle' => 'Please enter the class icon from http://fortawesome.github.io/Font-Awesome/icons/. Ex: fa fa-heart-o.',
            'id' => 'portfolio_like_icon',
            'type' => 'text',
            'title' => 'Like Icon',
            'default' => 'fa fa-heart-o',
            'required' => array(
                0 => 'portfolio_show_like',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Please enter the title likes of post portfolio detail.',
            'id' => 'portfolio_like_title',
            'type' => 'text',
            'title' => 'Likes Title',
            'default' => 'Likes',
            'required' => array(
                0 => 'portfolio_show_like',
                1 => '=',
                2 => 1
            )
        ),
        array(
            'subtitle' => 'Show or hide shares of post portfolio detail.',
            'id' => 'portfolio_show_share',

            'type' => 'switch',
            'title' => 'Show Shares',
            'default' => true
        ),
        array(
            'subtitle' => 'Please enter the title shares of post portfolio detail.',
            'id' => 'portfolio_share_title',
            'type' => 'text',
            'title' => 'Shares Title',
            'default' => 'Shares',
            'required' => array(
                0 => 'portfolio_show_share',
                1 => '=',
                2 => 1
            )
        )
    )
);

/**
 * Library
 */
$this->sections[] = array(
    'title' => __('Library', THEMENAME),
    'icon' => 'el-icon-adjust-alt',
    'fields' => array(
        array(
            'subtitle' => 'Use Font Awesome.',
            'id' => 'use_font_awesome',

            'type' => 'switch',
            'title' => 'Use Font Awesome',
            'default' => true
        ),
        array(
            'subtitle' => 'Use Font Ionicons.',
            'id' => 'use_font_ionicons',

            'type' => 'switch',
            'title' => 'Use Font Ionicons',
            'default' => true
        ),array(
            'subtitle' => 'Use Font Pe-icon-7-stroke.',
            'id' => 'use_font_pestroke',

            'type' => 'switch',
            'title' => 'Use Font Pe icon 7 stroke',
            'default' => true
        )
    )
);
/**
 * 404 Page
 */
$this->sections[] = array(
    'title' => __('404 Page', THEMENAME),
    'icon' => 'el-icon-error-alt',
    'fields' => array(
        array(
            'subtitle' => 'Show heading for 404',
            'id' => '404_heading',

            'type' => 'switch',
            'title' => 'Show Heading',
            'default' => false
        ),
        array(
            'subtitle' => 'Show page title on page 404',
            'id' => '404_page_title',

            'type' => 'switch',
            'title' => 'Show Page Title',
            'default' => false
        ),
        array(
            'subtitle' => 'Fade out page title on scroll',
            'id' => '404_page_title_animation',

            'type' => 'switch',
            'title' => 'Page Title Animation',
            'default' => false
        ),
        array(
            'subtitle' => 'Show Breadcrumbs on page 404',
            'id' => '404_breadcrumbs',

            'type' => 'switch',
            'title' => 'Show Breadcrumbs',
            'default' => false
        ),
        array(
            'id' => '404_type',
            'type' => 'select',
            'options' => array(
                'Default' => 'Default',
                'From Page' => 'From Page',
                'Redirect Home' => 'Redirect Home'
            ),
            'title' => '404 Page',
            'default' => 'Default'
        ),
        array(
            'subtitle' => 'Select an image file for your 404 (for default 404).',
            'id' => '404_image',
            'type' => 'media',
            'title' => '404 Image',
            'default' => array(
                'url' => get_template_directory_uri().'/images/404/spman.jpg'
            ),
            'url' => true
        ),
        array(
            'subtitle' => 'Insert page 404 id (for 404 from page).',
            'id' => '404_page_id',
            'type' => 'text',
            'title' => 'Page ID',
            'default' => ''
        )
    )
);
/**
 * Woo Commerce
 */
$this->sections[] = array(
    'title' => __('Woo Commerce Settings', THEMENAME),
    'icon' => 'el-icon-magic',
    'fields' => array(
        array("title" => "Woo Layout",
            "desc" => "",
            "id" => "woo_full_width",
            "default" => "boxed",
            "type" => "select",
            "options" => array('fullwidth'=>'Full Width','boxed'=>'Boxed')
        ),
        array("title" => "Number Products Per Page",
            "desc" => "",
            "id" => "woo_number_products",
            "default" => "9",
            "type" => "text"
        )
    )
);
/**
 * Custom CSS
 */
$this->sections[] = array(
    'title' => __('Custom CSS', THEMENAME),
    'icon' => 'el-icon-magic',
    'fields' => array(
        array(
            'id' => 'custom_css',
            'type' => 'ace_editor',
            'title' => __('CSS Code', THEMENAME),
            'subtitle' => __('Paste your CSS code here.', THEMENAME),
            'mode' => 'css',
            'theme' => 'monokai',
            'default' => ''
        )
    )
);