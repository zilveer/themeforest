<?php
$meta_boxes[ ] = array (
// Meta box id, UNIQUE per meta box. Optional since 4.1.5
    'id' => 'geenral_options',
// Meta box title - Will appear at the drag and drop handle bar. Required.
    'title' => __ ( 'General Options', 'mango' ),
// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
    'pages' => array ( 'page', 'post', 'portfolio', 'clients', 'product','faq','testimonial','member' ),
// Where the meta box appear: normal (default), advanced, side. Optional.
    'context' => 'normal',
// Order of meta box: high (default), low. Optional.
    'priority' => 'high',
// Auto save: true, false (default). Optional.
    'autosave' => true,
// List of meta fields
// List of meta fields
    'fields' => array (
        array (
            'type' => 'heading',
            'name' => __ ( 'Page Header Options ', 'mango' ),
            'id' => 'page_header_heading',
        ),
        array (
            'name' => __ ( 'Select Header Type', 'mango' ),
            'id' => "{$prefix}page_header",
            'type' => 'select_advanced',
            'options' => array (
                '1' => 'Header 1',
                '2' => 'Header 2',
                '3' => 'Header 3',
                '4' => 'Header 4',
                '5' => 'Header 5',
                '6' => 'Header 6',
                '7' => 'Header 7',
                '8' => 'Header 8',
                '9' => 'Header 9',
                '10' => 'Header 10',
                '11' => 'Header 11',
                '12' => 'Header 12',
                '13' => 'Header 13',
                '14' => 'Header 14',
                '15' => 'Header 15',
                '16' => 'Header 16',
                '17' => 'Header 17',
                '18' => 'Header 18',
                '19' => 'Header 19',
                '20' => 'Header 20',
                '21' => 'Header 21',
                '22' => 'Header 22',
            ),
            'multiple' => false,
            'placeholder' => __ ( 'Select', 'mango' ),
            'desc' => 'Go to Appearance -> Theme Options to check headers previews'
        ),
		
		array (
            'name' => __ ( 'Hide Header', 'mango' ),
            'id' => "{$prefix}header_hide",
            'type' => 'select_advanced',
            'desc' => 'Used in Hide Header',
            'options' => array(
                '' => __("Default",'mango'),
                '' => __("Show",'mango'),
                '1' => __("Hide",'mango'),
            ),
        ),
        array (
            'name' => __ ( 'Side Headers Large', 'mango' ),
            'id' => "{$prefix}side_header_large",
            'type' => 'select_advanced',
            'options' => array (
                '' => __ ( 'Default', 'mango' ),
                'large' => __ ( 'Large', 'mango' ),
                'normal' => __ ( 'Normal', 'mango' ),
            ),
            'multiple' => false,
            'placeholder' => __ ( 'Select', 'mango' ),
            'desc' => __('Used With Side Headers(12,18,19,20,21)','mango')
        ),
        array (
            'name' => __ ( 'Headers Background Image', 'mango' ),
            'id' => "{$prefix}side_header_bg",
            'type' => 'image_advanced',
            'max_file_uploads' => 1,
            'desc' => __('Only if you want to have a specific background image on this page','mango')
        ),
        array (
            'name' => __ ( 'Logo', 'mango' ),
            'id' => "{$prefix}logo",
            'type' => 'image_advanced',
            'max_file_uploads' => 1,
            'desc' => 'If not selected default image of theme options will be used'
        ),
        array (
            'type' => 'heading',
            'name' => __ ( 'Banner Settings', 'mango' ),
            'id' => 'banner_settings',
        ),
        array (
            'name' => __ ( 'Banner Type', 'mango' ),
            'id' => "{$prefix}banner_type",
            'type' => 'select_advanced',
            'options' => array (
                '' => __ ( 'No Banner', 'mango' ),
                'video' => __ ( 'Video', 'mango' ),
                'image' => __ ( 'Image', 'mango' ),
                'rev_slider' => __ ( 'Revolution Slider', 'mango' ),
                /*'layer_slider' => __ ( 'Layer Slider', 'mango' ), @todo: remove layer slider */
            ),
            'multiple' => false,
            'placeholder' => __ ( 'Select', 'mango' ),
        ),
        array(
            'name' => __( 'Banner Video URL', 'mango' ),
            'id'   => "{$prefix}banner_video_embed",
            'type' => 'oembed',
            'desc' => 'Paste the URL of the Flash (YouTube or Vimeo etc). Only necessary when the banner type is video',
            //class="embed-responsive-item"
        ),
        array(
            'name'             => __( 'Banner Image', 'mango' ),
            'id'               => "{$prefix}banner_image",
            'type'             => 'image_advanced',
            'max_file_uploads' => 1,
            'desc' => __('Only necessary when the banner type is Image','mango'),
        ),
        array (
            'name' => __ ( 'Revolution Slider', 'mango' ),
            'id' => "{$prefix}banner_rev_slider",
            'type' => 'select_advanced',
            'options' => mango_get_rev_sliders(),
            'multiple' => false,
            'placeholder' => __ ( 'Select', 'mango' ),
            'desc' => 'Only necessary when the banner type is Revolution Slider',
        ),
        /*@todo: remove layer slider
          array (
            'name' => __ ( 'layer Slider', 'mango' ),
            'id' => "{$prefix}banner_layer_slider",
            'type' => 'select_advanced',
            'options' => mango_get_layer_sliders(),
            'multiple' => false,
            'placeholder' => __ ( 'Select', 'mango' ),
            'desc' => 'Only necessary when the banner type is Layer Slider',
        ), */
        array (
            'type' => 'heading',
            'name' => __ ( 'Breadcrumb and Title', 'mango' ),
            'id' => 'breadcrumb_title',
        ),
        array (
            'name' => __ ( 'Page Title', 'mango' ),
            'id' => "{$prefix}hide_page_title",
            'type' => 'select_advanced',
            'options' => array(
                '' => __("Default",'mango'),
                '2' => __("Show",'mango'),
                '1' => __("Hide",'mango'),
            ),
        ),
        array (
            'name' => __ ( 'Breadcrumb', 'mango' ),
            'id' => "{$prefix}hide_breadcrumb",
            'type' => 'select_advanced',
              'options' => array(
                '' => __("Default",'mango'),
                '2' => __("Show",'mango'),
                '1' => __("Hide",'mango'),
            ),
        ),
        array (
            'name' => __ ( 'Breadcrumb And Title Position', 'mango' ),
            'id' => "{$prefix}breadcrumb_title_position",
            'type' => 'select_advanced',
            'options' => array (
				'' => __ ( 'Default', 'mango' ),
                'text-left' => __ ( 'Left', 'mango' ),
                'text-center' => __ ( 'Center', 'mango' ),
                'text-right' => __ ( 'Right', 'mango' ),
            ),
            'multiple' => false,
            'placeholder' => __ ( 'Select', 'mango' ),
        ),
        array (
            'name' => __ ( 'Use 2 Column', 'mango' ),
            'id' => "{$prefix}breadcrumb_use_full",
            'type' => 'select_advanced',
            'options' => array (
                '' => __ ( 'Use Default', 'mango' ),
                'yes' => __ ( 'Yes', 'mango' ),
                'no' => __ ( 'No', 'mango' ),
            ),
            'multiple' => false,
        ),
        array (
            'name' => __ ( 'Breadcrumb And Title Size', 'mango' ),
            'id' => "{$prefix}bread_title_size",
            'type' => 'select_advanced',
            'options' => array(''=>'Default','small'=>'Small', 'larger'=>'Medium', 'largest'=>'Large'),
            'multiple' => false,
            'placeholder' => __ ( 'Select', 'mango' ),
        ),
        array (
            'name' => __ ( 'Breadcrumb And Title Background', 'mango' ),
            'id' => "{$prefix}bread_title_bg",
            'type' => 'select_advanced',
            'options' => array (
				'' => 'Default',
                'bg-img' => 'Background Image',
                'bg-color' => 'Background Color'
            ),
            'multiple' => false,
            'placeholder' => __ ( 'Select', 'mango' ),
            //'std' => 'bg-img',
        ),
        array (
            'name' => __ ( 'Background Image', 'mango' ),
            'id' => "{$prefix}bread_title_image",
            'type' => 'image_advanced',
            'max_file_uploads' => 1,
        ),
        array (
            'name' => __ ( 'Use Parallax', 'mango' ),
            'id' => "{$prefix}use_parallax",
            'type' => 'checkbox_list',
            'options' => array (
                '1' => __ ( 'Use Parallax', 'mango' ),
            ),
        ),
        array (
            'name' => __ ( 'Background Color', 'mango' ),
            'id' => "{$prefix}bread_title_bg_color",
            'type' => 'color',
        //    'std' => '#3483c0'
        ),
        array (
            'name' => __ ( 'Text Color', 'mango' ),
            'id' => "{$prefix}bread_title_color",
            'type' => 'color',
            //    'std' => '#3483c0'
        ),
        array (
            'name' => __ ( 'Border Color', 'mango' ),
            'id' => "{$prefix}bread_title_border_color",
            'type' => 'color',
         //   'std' => '#4f94c8'
        ),
        array (
            'type' => 'heading',
            'name' => __ ( 'Page Body Options', 'mango' ),
            'id' => 'page_body_options',
        ),
        array (
            'name' => __ ( 'Use Full Width Body Size', 'mango' ),
            'id' => "{$prefix}container_size",
            'type' => 'select_advanced',
            'options' => array (
                ''    => __('Use Default',"mango"),
                'yes' => __('Yes',"mango"),
                'no'  => __('No',"mango"),
            ),
            'std' => ''
        ),
        array (
            'name' => __ ( 'Page Wrapper', 'mango' ),
            'id' => "{$prefix}theme_wrapper",
            'type' => 'select_advanced',
            'options' => array (
                ''  => __('Use Default',"mango"),
                'wide'  => __('Wide',"mango"),
                'boxed'  => __('Boxed',"mango"),
                'boxed-long'  => __('Boxed From Sides',"mango"),
            ),
               'std' => ''
        ),
        array (
            'name' => __ ( 'Background Mode', 'mango' ),
            'id' => "{$prefix}bg_mode",
            'type' => 'select_advanced',
            'options' => array (
				''  => __('Default',"mango"),
                'image'  => __('Image',"mango"),
                'custom-image'  => __('Custom Image',"mango"),
            ),
            'placeholder' => __('Select Background Mode','mango'),
            'desc' => __("Select Background mode if Page wrapper is set to boxed or boxed from sides","mango")
        ),
        array (
            'name' => __ ( 'Select Image', 'mango' ),
            'id' => "{$prefix}bg_select",
            'type' => 'image_select',
            'class' => 'select_lg_img',
            'options' => array (
                 mango_uri.'/images/bg-images/bg.jpg'  => mango_uri.'/images/bg-images/bg.jpg',
                 mango_uri.'/images/bg-images/bg1.jpg' => mango_uri.'/images/bg-images/bg1.jpg',
                 mango_uri.'/images/bg-images/bg2.jpg' => mango_uri.'/images/bg-images/bg2.jpg',
            ),
            'std' => '',
            'desc' => __('Select If background Mode is selected to Image','mango'),
            'multiple' => false,
        ),
        array (
            'name' => __ ( 'Select Image', 'mango' ),
            'id' => "{$prefix}bg_custom_select",
            'type' => 'image_advanced',
            'max_file_uploads' => 1,
            'desc' => __('Select If background Mode is selected to Custom Image','mango'),
        ),
        array (
            'name' => __ ( 'Background Color', 'mango' ),
            'id' => "{$prefix}bg_color",
            'type' => 'color',
            //   'std' => '#4f94c8'
        ),
        array(
            'id' => "{$prefix}bg_repeat",
            'type'     => 'select_advanced',
            'name'    => __('Background Repeat', 'mango'),
            'options'  => array(
				'' => __("Default","mango"),
                'no-repeat' => __("No Repeat","mango"),
                'repeat'    => __("Repeat All","mango"),
                'repeat-x'  => __("Repeat Horizontally","mango"),
                'repeat-y'  => __("Repeat Vertically","mango"),
                'inherit'   => __("Inherit","mango"),
            ),
            'placeholder'  => __('Background Repeat','mango'),
        ),
        array(
            'id' => "{$prefix}bg_position",
            'type'     => 'select_advanced',
            'name'    => __('Background Position', 'mango'),
            'options'  => array(
				'' => __("Default","mango"),
                "left top"      =>  __("Left Top",'mango'),
                "left center"   =>  __("Left center",'mango'),
                "left bottom"   =>  __("Left Bottom",'mango'),
                "center top"    =>  __("Center Top",'mango'),
                "center center" =>  __("Center Center",'mango'),
                "center bottom" =>  __("Center Bottom",'mango'),
                "right top"     =>  __("Right Top",'mango'),
                "right center"  =>  __("Right center",'mango'),
                "right bottom"  =>  __("Right Bottom",'mango'),
            ),
            'placeholder'  => __('Background Position','mango'),
        ),
        array(
            'id'        => "{$prefix}bg_size",
            'type'      => 'select_advanced',
            'name'      => __('Background Size', 'mango'),
            'options'   => array(
				'' => __("Default","mango"),
                "cover"      =>  __("Cover",'mango'),
                "inherit"   =>  __("Inherit",'mango'),
                "contain"   =>  __("Contain",'mango'),
            ),
            'placeholder'  => __('Background Size','mango'),
        ),
        array (
            'name' => __ ( 'Page Layout', 'mango' ),
            'id' => "{$prefix}page_layout",
            'type' => 'image_select',
            'options' => array (
				'' => mango_uri . '/images/default/default.png',
                'no' => mango_uri . '/images/default/1col.png',
                'left' => mango_uri . '/images/default/2cl.png',
                'right' => mango_uri . '/images/default/2cr.png',
                'both' => mango_uri . '/images/default/3cm.png',
            ),
            'multiple' => false,
        ),
        array (
            'name' => __ ( 'Select Left Sidebar', 'mango' ),
            'id' => "{$prefix}page_sidebar_left",
            'type' => 'select_advanced',
            'options' => $mango_sidebar,
            'multiple' => false,
            'placeholder' => __ ( 'Select', 'mango' ),
        ),
        array (
            'name' => __ ( 'Select Right Sidebar', 'mango' ),
            'id' => "{$prefix}page_sidebar_right",
            'type' => 'select_advanced',
            'options' => $mango_sidebar,
            'multiple' => false,
            'placeholder' => __ ( 'Select', 'mango' ),
        ),

        array (
            'name' => __ ( 'Social Share Icons', 'mango' ),
            'id' => "{$prefix}page_social_share",
            'type' => 'select_advanced',
            'options' => array(
                '' => __("Default",'mango'),
                'show' => __("Show",'mango'),
                'hide' => __("Hide",'mango'),
            ),
            'multiple' => false,
            'placeholder' => __ ( 'Select', 'mango' ),
        ),

//Page Footer Options
        array (
            'type' => 'heading',
            'name' => __ ( 'Page Footer Options ', 'mango' ),
            'id' => 'page_footer_heading',
        ),
        array (
            'name' => __ ( 'Select Footer Type', 'mango' ),
            'id' => "{$prefix}footer_type",
            'type' => 'select_advanced',
            'desc' => __('Go to Theme Options> Footer to check footer preview','mango'),
            'options' => array (
				'' => __("Default","mango"),
                '1' => __ ( 'Footer 1', 'mango' ),
                '2' => __ ( 'Footer 2', 'mango' ),
                '3' => __ ( 'Footer 3', 'mango' ),
                '4' => __ ( 'Footer 4', 'mango' ),
                '5' => __ ( 'Footer 5', 'mango' ),
                '6' => __ ( 'Footer 6', 'mango' ),
                '7' => __ ( 'Footer 7', 'mango' ),
                '8' => __ ( 'Footer 8', 'mango' ),
                '9' => __ ( 'Footer 9', 'mango' ),
                '10' => __ ( 'Footer 10', 'mango' ),
                '11' => __ ( 'Footer 11', 'mango' ),
            ),
            'multiple' => false,
            'placeholder' => __ ( 'Select', 'mango' ),
        ),
        array (
            'name' => __ ( 'Hide Top Footer Widgets', 'mango' ),
            'id' => "{$prefix}top_footer_widget_hide",
            'type' => 'select_advanced',
            'desc' => 'Used in Top Footer Widgets and Top Footer Widgets v2',
            'options' => array(
                '' => __("Default",'mango'),
                '2' => __("Show",'mango'),
                '1' => __("Hide",'mango'),
            ),
        ),
		array (
            'name' => __ ( 'Hide Bottom Footer Widgets', 'mango' ),
            'id' => "{$prefix}bottom_footer_widget_hide",
            'type' => 'select_advanced',
            'desc' => 'Used in Bottom Footer Widgets and Bottom Footer Widgets v2',
            'options' => array(
                '' => __("Default",'mango'),
                '2' => __("Show",'mango'),
                '1' => __("Hide",'mango'),
            ),
        ),
        array (
            'name' => __ ( 'Top Footer Widgets Columns', 'mango' ),
            'id' => "{$prefix}top_footer_widget_columns",
            'type' => 'image_select',
            'desc' => 'Used in footer 1,2,6 and 7.',
            'options' => array (
				'' => mango_uri . '/images/default/default.png',
                '1' => mango_uri.'/images/default/1col.png',
                '2' => mango_uri.'/images/default/2col.png',
                '3' => mango_uri.'/images/default/3col.png',
                '4' => mango_uri.'/images/default/4col.png',
            ),
            'multiple' => false,
        ),
        array (
            'name' => __ ( 'Top Footer Widgets v2 Columns', 'mango' ),
            'id' => "{$prefix}top_footer_widget_v2_columns",
            'type' => 'image_select',
            'desc' => 'Used in footer 9,10 and 11.',
            'options' => array (
				'' => mango_uri . '/images/default/default.png',
                '1' => mango_uri.'/images/default/1col.png',
                '2' => mango_uri.'/images/default/2col.png',
                '3' => mango_uri.'/images/default/3col.png',
                '4' => mango_uri.'/images/default/4col.png',
            ),
            'multiple' => false,
        ),
        array (
            'name' => __ ( 'Footer Widget Columns', 'mango' ),
            'id' => "{$prefix}footer_widget_columns",
            'type' => 'image_select',
            'desc' => 'Used in footer 1,2,6,7 and 8.',
            'options' => array (
				'' => mango_uri . '/images/default/default.png',
                '1' => mango_uri.'/images/default/1col.png',
                '2' => mango_uri.'/images/default/2col.png',
                '3' => mango_uri.'/images/default/3col.png',
                '4' => mango_uri.'/images/default/4col.png',
                '5'=> mango_uri.'/images/default/5col.png',
            ),
            'multiple' => false,
        ),
        array (
            'name' => __ ( 'Footer Menu', 'mango' ),
            'id' => "{$prefix}hide_footer_menu",
            'type' => 'select_advanced',
            'options' => array (
                '' => __ ( 'Use Default', 'mango' ),
                '1' => __ ( 'Show', 'mango' ),
                '2' => __ ( 'Hide', 'mango' ),

            ),
        ),
        array (
            'name' => __ ( 'Footer Logo', 'mango' ),
            'id' => "{$prefix}footer_logo",
            'type' => 'image_advanced',
            'max_file_uploads' => 1,
            'desc' => 'If not selected default image of theme options will be used'
        ),
    )
);
?>