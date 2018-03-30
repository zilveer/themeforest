<?php
add_action('init', 'of_options');
if (!function_exists('of_options')) {
    function of_options()
    {
        //Access the WordPress Categories via an Array
        $of_categories = array();
        $of_categories_obj = get_categories('hide_empty=0');
        foreach ($of_categories_obj as $of_cat) {
            $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;
        }
        $categories_tmp = array_unshift($of_categories, "Select a category:");

        //Access the WordPress Pages via an Array
        $of_pages = array();
        $of_pages_obj = get_pages('sort_column=post_parent,menu_order');
        foreach ($of_pages_obj as $of_page) {
            $of_pages[$of_page->ID] = $of_page->post_name;
        }
        $of_pages_tmp = array_unshift($of_pages, "Select a page:");

        //Testing
        $of_options_select = array("one", "two", "three", "four", "five");
        $of_options_radio = array("one" => "One", "two" => "Two", "three" => "Three", "four" => "Four", "five" => "Five");
        $of_options_fontsize = array("8px" => "8px", "9px" => "9px", "10px" => "10px", "11px" => "11px", "12px" => "12px", "13px" => "13px", "14px" => "14px", "15px" => "15px", "16px" => "16px", "17px" => "17px", "18px" => "18px", "19px" => "19px", "20px" => "20px", "21px" => "21px", "22px" => "22px", "23px" => "23px", "24px" => "24px", "25px" => "25px", "26px" => "26px", "27px" => "27px", "28px" => "28px", "29px" => "29px", "30px" => "30px", "31px" => "31px", "32px" => "32px", "33px" => "33px", "34px" => "34px", "35px" => "35px", "36px" => "36px", "37px" => "37px", "38px" => "38px", "39px" => "39px", "40px" => "40px", "41px" => "41px","42px" => "42px","43px" => "43px","44px" => "44px","45px" => "45px","46px" => "46px","47px" => "47px","48px" => "48px","49px" => "49px","50px" => "50px","51px" => "51px","52px" => "52px","53px" => "53px","54px" => "54px","55px" => "55px","56px" => "56px","57px" => "57px","58px" => "58px","59px" => "59px","60px" => "60px","61px" => "61px","62px" => "62px","63px" => "63px","64px" => "64px","65px" => "65px","66px" => "66px","67px" => "67px","68px" => "68px","69px" => "69px","70px" => "70px","76px" => "76px","80px" => "80px","86px" => "86px","90px" => "90px","96px" => "96px");
        $of_options_font = array("" => "None", "1" => "Google Font", "2" => "Standard Font", "3" => "Custom Font");
        //Sample Homepage blocks for the layout manager (sorter)
        $of_options_homepage_blocks = array
        (
            "disabled" => array(
                "placebo" => "placebo", //REQUIRED!
                "block_one" => "Block One",
                "block_two" => "Block Two",
                "block_three" => "Block Three",
            ),
            "enabled" => array(
                "placebo" => "placebo", //REQUIRED!
                "block_four" => "Block Four",
            ),
        );


        //Stylesheets Reader
        $alt_stylesheet_path = LAYOUT_PATH;
        $alt_stylesheets = array();

        if (is_dir($alt_stylesheet_path)) {
            if ($alt_stylesheet_dir = opendir($alt_stylesheet_path)) {
                while (($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false) {
                    if (stristr($alt_stylesheet_file, ".css") !== false) {
                        $alt_stylesheets[] = $alt_stylesheet_file;
                    }
                }
            }
        }


        //Background Images Reader
        $bg_images_path = get_stylesheet_directory() . '/images/bg/'; // change this to where you store your bg images
        $bg_images_url = get_template_directory_uri() . '/images/bg/'; // change this to where you store your bg images
        $bg_images = array();

        if ( is_dir($bg_images_path) ) {
            if ($bg_images_dir = opendir($bg_images_path) ) {
                while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
                    if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
                        natsort($bg_images); //Sorts the array into a natural order
                        $bg_images[] = $bg_images_url . $bg_images_file;
                    }
                }
            }
        }


        /*-----------------------------------------------------------------------------------*/
        /* TO DO: Add options/functions that use these */
        /*-----------------------------------------------------------------------------------*/

        //More Options
        $uploads_arr = wp_upload_dir();
        $all_uploads_path = $uploads_arr['path'];
        $all_uploads = get_option('of_uploads');
        $other_entries = array("Select a number:", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19");
        $body_repeat = array("no-repeat", "repeat-x", "repeat-y", "repeat");
        $body_pos = array("top left", "top center", "top right", "center left", "center center", "center right", "bottom left", "bottom center", "bottom right");

        // Image Alignment radio box
        $of_options_thumb_align = array("alignleft" => "Left", "alignright" => "Right", "aligncenter" => "Center");

        // Image Links to Options
        $of_options_image_link_to = array("image" => "The Image", "post" => "The Post");

        //Get Id Template
        $template = 'base';
        switch (getCSSite()){
             case '-corporate':
                $template = 'corporate';
                break;
             default:
                $template = 'base';
                break;
        }

        //Google font API
        $of_options_google_font = array();
        $google_fonts = new GoogleFontRender;
        foreach ($google_fonts->json() as $font){
            $of_options_google_font[$font->family] = $font->family;
        }

        //Standard Fonts
        $of_options_standard_fonts = array(
            '0' => 'Select Font',
            'Arial, Helvetica, sans-serif' => 'Arial, Helvetica, sans-serif',
            "'Arial Black', Gadget, sans-serif" => "'Arial Black', Gadget, sans-serif",
            "'Bookman Old Style', serif" => "'Bookman Old Style', serif",
            "'Comic Sans MS', cursive" => "'Comic Sans MS', cursive",
            "Courier, monospace" => "Courier, monospace",
            "Garamond, serif" => "Garamond, serif",
            "Georgia, serif" => "Georgia, serif",
            "Impact, Charcoal, sans-serif" => "Impact, Charcoal, sans-serif",
            "'Lucida Console', Monaco, monospace" => "'Lucida Console', Monaco, monospace",
            "'Lucida Sans Unicode', 'Lucida Grande', sans-serif" => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
            "'MS Sans Serif', Geneva, sans-serif" => "'MS Sans Serif', Geneva, sans-serif",
            "'MS Serif', 'New York', sans-serif" => "'MS Serif', 'New York', sans-serif",
            "'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
            "Tahoma, Geneva, sans-serif" => "Tahoma, Geneva, sans-serif",
            "'Times New Roman', Times, serif" => "'Times New Roman', Times, serif",
            "'Trebuchet MS', Helvetica, sans-serif" => "'Trebuchet MS', Helvetica, sans-serif",
            "Verdana, Geneva, sans-serif" => "Verdana, Geneva, sans-serif"
        );
        // Custom Font
        $fonts = array();
        $of_options_custom_fonts = array();
        $of_options_custom_fonts[''] = 'Select Font';
        $font_path = get_template_directory() . "/fonts";
        if (!$handle = opendir($font_path)) {
            $fonts = array();
        } else {
            while (false !== ($file = readdir($handle))) {
                if (strpos($file, ".ttf") !== false ||
                    strpos($file, ".eot") !== false ||
                    strpos($file, ".svg") !== false ||
                    strpos($file, ".woff") !== false
                ) {
                    $fonts[] = $file;
                }
            }
        }
        closedir($handle);

        foreach ($fonts as $font) {
            $font_name = str_replace(array('.ttf', '.eot', '.svg', '.woff'), '', $font);
            $of_options_custom_fonts[$font_name] = $font_name;
        }
        /* remove dup item */
        $of_options_custom_fonts = array_unique($of_options_custom_fonts);

        /** Bg data */
        $css_attachment = array(''=>'None', 'scroll' => 'scroll', 'fixed' => 'fixed', 'local' => 'local','initial' => 'initial','inherit' => 'inherit');
        /*-----------------------------------------------------------------------------------*/
        /* The Options Array */
        /*-----------------------------------------------------------------------------------*/

        /* rev slider. */
        $revsliders = array();
        
        if(class_exists('RevSlider')){
            $slider = new RevSlider();
            $arrSliders = $slider->getArrSliders();
        
            if ( $arrSliders ) {
                foreach ( $arrSliders as $slider ) {
                    /** @var $slider RevSlider */
                    $revsliders[$slider->getAlias()] = $slider->getTitle();
                }
            } else {
                $revsliders[ __( 'No sliders found', 'js_composer' ) ] = 0;
            }
        }
        
        // Set the Options Array
        global $of_options;
        $of_options = array();

        $of_options[] = array("name" => "General Settings",
            "type" => "heading"
        );

        $of_options[] = array("name" => "Demo Content",
            "desc" => "",
            "id" => "code",
            "std" => "<h3 style='margin: 0;'>Demo Content</h3>",
            "icon" => true,
            "type" => "info");
        $of_options[] = array("name" => "Select Theme",
            "desc" => "<input type='button' name='sample' id='sample' value='Import Now' /><span id='msg'></span>",
            "id" => "theme",
            "std" => "",
            "type" => "select",
            "options" => array(
                '' => 'WP Nuvo',
                'cafe' => 'WP Nuvo Cafe',
                'onepage' => 'WP Nuvo One Page',
                'modern' => 'WP Nuvo Modern',
                'boxed' => 'WP Nuvo Boxed',
                'rustic' => 'WP Nuvo Rustic',

            ));
        // begin Layout
        $of_options[] = array("name" => "Layout",
            "desc" => "",
            "id" => "layout",
            "std" => "<h3 style='margin: 0;'>Layout Options</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array("name" => "Layout",
            "desc" => "Select boxed or wide layout.",
            "id" => "layout",
            "std" => "2",
            "type" => "select",
            "options" => array(
                '2' => 'Wide',
                '1' => 'Boxed'
            ));
        $of_options[] = array("name" => "Container Width",
            "desc" => "Only for Boxed Layout (px %...)",
            "id" => "layout_width",
            "std" => "1000px",
            "type" => "text"
        );
        // end Layout

        $of_options[] = array("name" => "Boxed Mode Only",
            "desc" => "",
            "id" => "boxed_mode_only",
            "std" => "<h3 style='margin: 0;'>Body options</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array("name" => "Background Color",
            "desc" => "Select a background color.",
            "id" => "bg_color",
            "std" => "#fff",
            "type" => "color");
        $of_options[] = array("name" => "Body Text Color",
            "desc" => "Controls the text color of body font.",
            "id" => "body_text_color",
            "std" => "#888",
            "type" => "color");

        $of_options[] = array("name" => "Background Image",
            "desc" => "Select an image or insert an image url to use for the backgroud.",
            "id" => "bg_image",
            "std" => "",
            "mod" => "",
            "type" => "media");

        $of_options[] = array("name" => "100% Background Image",
            "desc" => "The background image display at 100% in width and height and scale according to the browser size.",
            "id" => "bg_full",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");

        $of_options[] = array("name" => "Background Repeat",
            "desc" => "Select how the background image repeats.",
            "id" => "bg_repeat",
            "std" => "",
            "type" => "select",
            "options" => array('repeat' => 'repeat', 'repeat-x' => 'repeat-x', 'repeat-y' => 'repeat-y', 'no-repeat' => 'no-repeat'));

        $of_options[] = array("name" => "Background Attachment",
            "desc" => "Select how the background image attachment.",
            "id" => "bg_attachment",
            "std" => "",
            "type" => "select",
            "options" =>  $css_attachment);
        
        $of_options[] = array("name" => "Background Pattern",
            "desc" => "Display a pattern in the background. If Yes, select the pattern from below.",
            "id" => "bg_pattern_option",
            "std" => 0,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");

        $of_options[] = array("name" => "Select a Background Pattern",
            "desc" => "Select a background pattern.",
            "id" => "bg_pattern",
            "std" => $bg_images_url . "bg0.png",
            "type" => "tiles",
            "fold" => "bg_pattern_option",
            "options" => $bg_images,
        );

        $of_options[] = array("name" => "Code",
            "desc" => "",
            "id" => "code",
            "std" => "<h3 style='margin: 0;'>Tracking / Space Before Head / Space Before Body Code</h3>",
            "icon" => true,
            "type" => "info");

// begin Google Analytic
        $of_options[] = array("name" => "Google Analytic",
            "desc" => "Google Analytic",
            "id" => "google_analytic",
            "std" => 0,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch"
        );
        $of_options[] = array("name" => "Tracking ID",
            "desc" => "Tracking ID",
            "id" => "hidden_tracking_id",
            "std" => "",
            "fold" => "google_analytic", /* the switch hook */
            "type" => "text"
        );
// end Google Analytic

        $of_options[] = array("name" => "Space before &lt;/head&gt;",
            "desc" => "Add code before the &lt;/head&gt; tag.",
            "id" => "space_head",
            "std" => "",
            "type" => "textarea");

        $of_options[] = array("name" => "Space before &lt;/body&gt;",
            "desc" => "Add code before the &lt;/body&gt; tag.",
            "id" => "space_body",
            "std" => "",
            "type" => "textarea");
// Advanced
        $of_options[] = array("name" => "Advanced",
            "desc" => "",
            "id" => "advanced",
            "std" => "<h3 style='margin: 0;'>Advanced Options</h3>",
            "icon" => true,
            "type" => "info");
        $of_options[] = array("name" => "Page Loading",
            "desc" => "Enable Page Loading Animations",
            "id" => "page_loader",
            "std" => 0,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array("name" => "Smooth Scroll",
            "desc" => "Enable Smooth Scroll Animations",
            "id" => "smooth_scroll",
            "std" => 0,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");

// begin logo
        $of_options[] = array("name" => "Logo",
            "type" => "heading");

        $of_options[] = array("name" => "Logo Info",
            "desc" => "",
            "id" => "header_info",
            "std" => "<h3 style='margin: 0;'>Logo Options</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array("name" => "Logo",
            "desc" => "Select an image file for your logo.",
            "id" => "logo",
            "std" => get_template_directory_uri() . "/images/logo/nuvo_logo.png",
            "mod" => "",
            "type" => "media");
        $of_options[] = array("name" => "Logo Height",
            "desc" => "Enter logo width, In pixels, ex: 40px",
            "id" => "logo_width",
            "std" => "55px",
            "type" => "text");
        $of_options[] = array("name" => "Logo Alignment",
            "desc" => "Logo Alignment.",
            "id" => "logo_alignment",
            "std" => "Left",
            "type" => "select",
            "options" => array('left' => 'left', 'center' => 'center', 'right' => 'right',));

        $of_options[] = array("name" => "Logo Margin",
            "desc" => "In pixels, top right bottom left, ex: 10px 10px 10px 10px",
            "id" => "margin_logo",
            "std" => "0px",
            "type" => "text");

        $of_options[] = array("name" => "Logo Padding",
            "desc" => "In pixels, top right bottom left, ex: 10px 10px 10px 10px",
            "id" => "padding_logo",
            "std" => "22px 0",
            "type" => "text");

        $of_options[] = array("name" => "Logo Header Sticky Info",
            "desc" => "",
            "id" => "logo_header_sticky_info",
            "std" => "<h3 style='margin: 0;'>Logo Header Sticky Options</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array("name" => "Logo Header Sticky",
            "desc" => "Select an image file for your logo.",
            "id" => "logo_header_sticky",
            "std" => get_template_directory_uri() . "/images/logo/sticky_nuvo_logo.png",
            "mod" => "",
            "type" => "media");

        $of_options[] = array("name" => "Sticky Header Logo Height",
            "desc" => "Controls the height of the sticky header logo. In pixels, ex: 40px",
            "id" => "header_sticky_logo_max_height",
            "std" => "35px",
            "type" => "text");

        $of_options[] = array("name" => "Sticky Logo Alignment",
            "desc" => "Sticky Logo Alignment.",
            "id" => "sticky_logo_alignment",
            "std" => "Left",
            "type" => "select",
            "options" => array('left' => 'left', 'center' => 'center', 'right' => 'right',));

        $of_options[] = array("name" => "Sticky Logo Margin",
            "desc" => "In pixels, top right bottom left, ex: 10px 10px 10px 10px",
            "id" => "sticky_margin_logo",
            "std" => "",
            "type" => "text");

        $of_options[] = array("name" => "Sticky Logo Padding",
            "desc" => "In pixels, top right bottom left, ex: 10px 10px 10px 10px",
            "id" => "sticky_padding_logo",
            "std" => "",
            "type" => "text");

        $of_options[] = array("name" => "Favicon Options",
            "desc" => "",
            "id" => "favicons",
            "std" => "<h3 style='margin: 0;'>Favicon Options</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array("name" => "Favicon",
            "desc" => "Favicon for your website (16px x 16px).",
            "id" => "favicon",
            "std" => "",
            "type" => "upload");
// end logo

// begin header
        $of_options[] = array("name" => "Header",
            "type" => "heading");

        $of_options[] = array("name" => "Header Info",
            "desc" => "",
            "id" => "header_info",
            "std" => "<h3 style='margin: 0;'>Header Content Options</h3>",
            "icon" => true,
            "type" => "info");
        $header_arr = array(
            "v1" => get_template_directory_uri() . "/images/header/header1.jpg",
            "v2" => get_template_directory_uri() . "/images/header/header2.jpg"
        );
        $header_arr["custom"] = get_template_directory_uri() . "/images/header/custom.jpg";
        $of_options[] = array("name" => "Select a Header Layout",
            "desc" => "",
            "id" => "header_layout",
            "std" => "v1",
            "type" => "images",
            "options" => $header_arr
            );
        $args = array('posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'title', 'post_type' => 'header');
        $header_layout = get_posts($args);
        $custom_header = array();
        foreach ($header_layout as $header) {
            $custom_header["cs-header-".$header->ID] = $header->post_title;
        }
        $of_options[] = array("name" => "Select Custom Header",
            "id" => "cs-header-id",
            "type" => "select",
            "options" => $custom_header
            );
        $of_options[] = array(
            "name" => "Select Sliders",
            "id" => "cs-header-revsliders",
            "type" => "select",
            "options" => $revsliders
        );
        $of_options[] = array("name" => "Menu Position",
            "desc" => "Select Position for menu",
            "id" => "menu_position",
            "std" => "right",
            "type" => "select",
            "options" => array(
                "left" => "left",
                "center" => "center",
                "right" => "right"
            ));

        $of_options[] = array("name" => "Transparent Header",
            "desc" => "Transparent Header.<br /> Min: 0, max: 100, step: 1, default value: 45",
            "id" => "header_transparent",
            "std" => "100",
            "min" => "0",
            "step" => "1",
            "max" => "100",
            "type" => "sliderui"
        );

        $of_options[] = array("name" => "Header Top Widgets",
            "desc" => "Display header top widgets.",
            "id" => "header_top_widgets",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array("name" => "Number of Header Top Columns",
            "desc" => "Select the number of columns to display in the header top.",
            "id" => "header_top_widgets_columns",
            "std" => "3",
            "options" => array('1' => '1', '2' => '2', '3' => '3'),
            "fold" => "header_top_widgets",
            "type" => "select");
        $of_options[] = array("name" => "Class Header Top Widget 1",
            "desc" => "Class follow the Bootstrap 3",
            "id" => "header_top_widgets_1",
            "std" => "col-xs-12 col-sm-4 col-md-4 col-lg-4",
            "fold" => "header_top_widgets",
            "type" => "text");
        $of_options[] = array("name" => "Class Header Top Widget 2",
            "desc" => "Class follow the Bootstrap 3",
            "id" => "header_top_widgets_2",
            "std" => "col-xs-12 col-sm-4 col-md-4 col-lg-4",
            "fold" => "header_top_widgets",
            "type" => "text");
        $of_options[] = array("name" => "Class Header Top Widget 3",
            "desc" => "Class follow the Bootstrap 3",
            "id" => "header_top_widgets_3",
            "std" => "col-xs-12 col-sm-4 col-md-4 col-lg-4",
            "fold" => "header_top_widgets",
            "type" => "text");
        $of_options[] = array("name" => "Header Top Background Color",
            "desc" => "Controls the background color of the top header.",
            "id" => "header_top_bg_color",
            "std" => "#c79c60",
            "fold" => "header_top_widgets",
            "type" => "color");
        $of_options[] = array("name" => "Header Content Widgets",
            "desc" => "Check the box to display header content widgets, only support for header v4.",
            "id" => "header_content_widgets",
            "std" => 0,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array("name" => "Number of Header Content Columns",
            "desc" => "Select the number of columns to display in the header content.",
            "id" => "header_content_widgets_columns",
            "std" => "2",
            "options" => array('1' => '1', '2' => '2'),
            "fold" => "header_content_widgets",
            "type" => "select");
        $of_options[] = array("name" => "Class Header Content Widget 1",
            "desc" => "Class follow the Bootstrap 3",
            "id" => "header_content_widgets_1",
            "std" => "col-xs-12 col-sm-6 col-md-6 col-lg-6",
            "fold" => "header_content_widgets",
            "type" => "text");
        $of_options[] = array("name" => "Class Header Content Widget 2",
            "desc" => "Class follow the Bootstrap 3",
            "id" => "header_content_widgets_2",
            "std" => "col-xs-12 col-sm-6 col-md-6 col-lg-6",
            "fold" => "header_content_widgets",
            "type" => "text");

        $of_options[] = array("name" => "Header Background Color",
            "desc" => "Controls the background color for the header.",
            "id" => "header_bg_color",
            "std" => "#ffffff",
            "fold" => "header_top_widgets",
            "type" => "color");

        $of_options[] = array("name" => "Background Image For Header Area",
            "desc" => "Select an image or insert an image url to use for the header background.",
            "id" => "header_bg_image",
            "std" => "",
            "mod" => "",
            "type" => "media");

        $of_options[] = array("name" => "100% Background Image",
            "desc" => "The header background image display at 100% in width and height and scale according to the browser size.",
            "id" => "header_bg_full",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");

        $of_options[] = array("name" => "Parallax Background Image",
            "desc" => "Enable parallax background image when scrolling.",
            "id" => "header_bg_parallax",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");

        $of_options[] = array("name" => "Background Repeat",
            "desc" => "Select how the background image repeats.",
            "id" => "header_bg_repeat",
            "std" => "",
            "type" => "select",
            "options" => array('repeat' => 'repeat', 'repeat-x' => 'repeat-x', 'repeat-y' => 'repeat-y', 'no-repeat' => 'no-repeat'));


        $of_options[] = array("name" => "Header Margin",
            "desc" => "Header Margin, In pixels, top left botton right, ex: 10px 10px 10px 10px",
            "id" => "header_margin",
            "std" => "",
            "type" => "text");
        $of_options[] = array("name" => "Header Padding",
            "desc" => "Header Padding, In pixels, top left botton right, ex: 10px 10px 10px 10px",
            "id" => "header_padding",
            "std" => "",
            "type" => "text");
        $of_options[] = array("name" => "Header Top Padding",
            "desc" => "Header Top Padding, In pixels, top left botton right, ex: 10px 10px 10px 10px",
            "id" => "header_top_padding",
            "std" => "9px 0",
            "type" => "text");

        $of_options[] = array("name" => "Header Top Font Color",
            "desc" => "The font color of the header top.",
            "id" => "header_top_font_color",
            "std" => "#fff",
            "fold" => "header_sticky",
            "type" => "color");

        $of_options[] = array("name" => "Header Top Link Color",
            "desc" => "The link color of the header top.",
            "id" => "header_top_link_color",
            "std" => "#fff",
            "fold" => "header_sticky",
            "type" => "color");

        $of_options[] = array("name" => "Header Top Link Color Hover",
            "desc" => "The link color hover of the header top.",
            "id" => "header_top_link_hover_color",
            "std" => "#fff",
            "fold" => "header_sticky",
            "type" => "color");

        $of_options[] = array("name" => "Header Fixed",
                "desc" => "",
                "id" => "header_fixed_info",
                "std" => "<h3 style='margin: 0;'>Header Fixed Options</h3>",
                "icon" => true,
                "type" => "info");
        $of_options[] = array("name" => "Enable Header Fixed",
                "desc" => "Enable a fixed header.",
                "id" => "header_fixed_top",
                "std" => 0,
                "on" => "Yes",
                "off" => "No",
                "type" => "switch");
        $of_options[] = array("name" => "Menu Fixed Color",
                "desc" => "Set color for menu fixed",
                "id" => "header_fixed_menu_color",
                "std" => "",
                "type" => "color");
        $of_options[] = array("name" => "Menu Fixed Hover Color",
                "desc" => "Set color for menu fixed when hover",
                "id" => "header_fixed_menu_color_hover",
                "std" => "",
                "type" => "color");
        $of_options[] = array("name" => "Header Border Bottom",
                "desc" => "Enable a border bottom on Header.",
                "id" => "header_border_bottom",
                "std" => 0,
                "on" => "Yes",
                "off" => "No",
                "fold" => "header_fixed_top",
                "type" => "switch");

        $of_options[] = array("name" => "Sticky Header Info",
            "desc" => "",
            "id" => "sticky_header_info",
            "std" => "<h3 style='margin: 0;'>Sticky Header Options</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array("name" => "Enable Sticky Header",
            "desc" => "Enable a fixed header when scrolling.",
            "id" => "header_sticky",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");

        $of_options[] = array("name" => "Enable Sticky Header on Tablets",
            "desc" => "Enable a fixed header when scrolling on tablets.",
            "id" => "header_sticky_tablet",
            "std" => 0,
            "on" => "Yes",
            "off" => "No",
            "fold" => "header_sticky",
            "type" => "switch");

        $of_options[] = array("name" => "Enable Sticky Header on Mobiles",
            "desc" => "Enable a fixed header when scrolling on mobiles.",
            "id" => "header_sticky_mobile",
            "std" => 0,
            "on" => "Yes",
            "off" => "No",
            "fold" => "header_sticky",
            "type" => "switch");

        $of_options[] = array("name" => "Sticky Header Background Color",
            "desc" => "Controls the background color of the sticky header.",
            "id" => "header_sticky_bg_color",
            "std" => "#ffffff",
            "fold" => "header_sticky",
            "type" => "color");

        $of_options[] = array("name" => "Sticky Header Opacity",
            "desc" => "Set the opacity of background.<br /> Min: 0, max: 100, step: 1, default value: 45",
            "id" => "header_sticky_opacity",
            "std" => "100",
            "min" => "0",
            "step" => "1",
            "max" => "100",
            "fold" => "header_sticky",
            "type" => "sliderui"
        );
        $of_options[] = array("name" => "Sticky Header Height",
            "desc" => "Sticky Header Height.Use a number without 'px', default is 60. ex: 60",
            "id" => "header_sticky_height",
            "std" => "55px",
            "fold" => "header_sticky",
            "type" => "text");

        $of_options[] = array("name" => "Sticky Header Menu Item Padding",
            "desc" => "Controls the space between each menu item in the sticky header. Use a number without 'px', default is 35. ex: 35",
            "id" => "header_sticky_nav_padding",
            "std" => "",
            "fold" => "header_sticky",
            "type" => "text");
        $of_options[] = array("name" => "Sticky Header Navigation Font Size",
            "desc" => "Controls the font size of the menu items in the sticky header.",
            "id" => "header_sticky_nav_font_size",
            "std" => "13px",
            "fold" => "header_sticky",
            "type" => "text");
// end header

// begin menu
        $of_options[] = array("name" => "Main Menu",
            "type" => "heading");

        $of_options[] = array("name" => "Menu Info",
            "desc" => "",
            "id" => "header_info",
            "std" => "<h3 style='margin: 0;'>Menu Options</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array("name" => "Main Nav Height",
            "desc" => "Use a number with 'px', ex: 100px",
            "id" => "nav_height",
            "std" => "100px",
            "type" => "text");

        $of_options[] = array("name" => "Menu Item Padding",
            "desc" => "Use a number with 'px', ex: 10px 10px",
            "id" => "nav_padding",
            "std" => "0 19px",
            "type" => "text");
        $of_options[] = array("name" => "Menu Font Size First Level",
            "desc" => "Use a number with 'px', ex: 14px",
            "id" => "menu_fontsize_first_level",
            "std" => "13px",
            "type" => "text");
        $of_options[] = array("name" => "Menu Font Size First Sublevel",
            "desc" => "Use a number with 'px', ex: 12px",
            "id" => "menu_fontsize_sub_level",
            "std" => "13px",
            "type" => "text");

        $of_options[] = array("name" => "Menu Item Uppercase First Level",
            "desc" => "Menu item uppercase first level.",
            "id" => "menu_uppercase_first_level",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");

        $of_options[] = array("name" => "Main Menu Colors",
            "desc" => "",
            "id" => "main_menu_colors",
            "std" => "<h3 style='margin: 0;'>Main Menu Colors</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array("name" => "Main Menu Background Color",
            "desc" => "Controls the background color of the menu.",
            "id" => "menu_bg_color",
            "std" => "#FFFFFF",
            "type" => "color");

        $of_options[] = array("name" => "Main Menu Font Color - First Level",
            "desc" => "Controls the text color of first level menu items.",
            "id" => "menu_first_color",
            "std" => "#656565",
            "type" => "color");

        $of_options[] = array("name" => "Main Menu Font Hover Color - First Level",
            "desc" => "Controls the main menu hover, hover border & dropdown border color.",
            "id" => "menu_hover_first_color",
            "std" => "#c79c60",
            "type" => "color");

        $of_options[] = array("name" => "Main Menu Background Hover Color - First Levels",
            "desc" => "Controls the hover color of the menu sublevel background.",
            "id" => "menu_bg_hover_color_first",
            "std" => "#f5f5f5",
            "type" => "color");
        $of_options[] = array("name" => "Main Menu Background Color - Sublevels",
            "desc" => "Controls the color of the menu sublevel background.",
            "id" => "menu_sub_bg_color",
            "std" => "#f5f5f5",
            "type" => "color");

        $of_options[] = array("name" => "Main Menu Background Hover Color - Sublevels",
            "desc" => "Controls the hover color of the menu sublevel background.",
            "id" => "menu_bg_hover_color",
            "std" => "#f5f5f5",
            "type" => "color");

        $of_options[] = array("name" => "Main Menu Font Color - Sublevels",
            "desc" => "Controls the color of the menu font sublevels.",
            "id" => "menu_sub_color",
            "std" => "#999",
            "type" => "color");

        $of_options[] = array("name" => "Main Menu Font Hover Color - Sublevels",
            "desc" => "Controls the color of the menu font sublevels.",
            "id" => "menu_sub_hover_color",
            "std" => "#999",
            "type" => "color");

        $of_options[] = array("name" => "Main Menu Separator - Sublevels",
            "desc" => "Controls the color of the menu separator sublevels.",
            "id" => "menu_sub_sep_color",
            "std" => "#eeeeee",
            "type" => "color");

        $of_options[] = array("name" => "Sticky Header Colors",
            "desc" => "",
            "id" => "sticky_header_colors",
            "std" => "<h3 style='margin: 0;'>Sticky Menu Colors</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array("name" => "Sticky Menu Font Color - First Level",
            "desc" => "Controls the text color of first level menu items.",
            "id" => "sticky_menu_first_color",
            "std" => "#656565",
            "type" => "color");

        $of_options[] = array("name" => "Sticky Menu Font Hover Color - First Level",
            "desc" => "Controls the main menu hover.",
            "id" => "sticky_menu_hover_first_color",
            "std" => "#c79c60",
            "type" => "color");

        $of_options[] = array("name" => "Sticky Menu Background Hover Color - First Levels",
            "desc" => "Controls the hover color of the menu sublevel background.",
            "id" => "sticky_menu_bg_hover_color_first",
            "std" => "#f5f5f5",
            "type" => "color");
        $of_options[] = array("name" => "Sticky Menu Background Color - Sublevels",
            "desc" => "Controls the color of the menu sublevel background.",
            "id" => "sticky_menu_sub_bg_color",
            "std" => "#f5f5f5",
            "type" => "color");

        $of_options[] = array("name" => "Sticky Menu Background Hover Color - Sublevels",
            "desc" => "Controls the hover color of the menu sublevel background.",
            "id" => "sticky_menu_bg_hover_color",
            "std" => "#f5f5f5",
            "type" => "color");

        $of_options[] = array("name" => "Sticky Menu Font Color - Sublevels",
            "desc" => "Controls the color of the menu font sublevels.",
            "id" => "sticky_menu_sub_color",
            "std" => "#999",
            "type" => "color");

        $of_options[] = array("name" => "Sticky Menu Font Hover Color - Sublevels",
            "desc" => "Controls the color hover of the menu font sublevels.",
            "id" => "sticky_menu_sub-hover_color",
            "std" => "#999",
            "type" => "color");

        $of_options[] = array("name" => "Sticky Menu Separator - Sublevels",
            "desc" => "Controls the color of the menu separator sublevels.",
            "id" => "sticky_menu_sub_sep_color",
            "std" => "#eeeeee",
            "type" => "color");

        $of_options[] = array("name" => "Mobile Menu Colors",
            "desc" => "",
            "id" => "mobile_menu_colors",
            "std" => "<h3 style='margin: 0;'>Mobile Menu Colors</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array("name" => "Mobile Menu Background Color",
            "desc" => "Controls the background color of the mobile menu.",
            "id" => "mobile_menu_bg_color",
            "std" => "#333333",
            "type" => "color");

        $of_options[] = array("name" => "Mobile Menu Font Color - First Level",
            "desc" => "Controls the text color of first level menu items.",
            "id" => "mobile_menu_first_color",
            "std" => "#999999",
            "type" => "color");

        $of_options[] = array("name" => "Mobile Menu Font Hover Color - First Level",
            "desc" => "Controls the main menu hover.",
            "id" => "mobile_menu_hover_first_color",
            "std" => "#ffffff",
            "type" => "color");

        $of_options[] = array("name" => "Mobile Menu Font Color - Sublevels",
            "desc" => "Controls the color of the menu font sublevels.",
            "id" => "mobile_menu_sub_color",
            "std" => "#999999",
            "type" => "color");

        $of_options[] = array("name" => "Mobile Menu Font Hover Color - Sublevels",
            "desc" => "Controls the color hover of the menu font sublevels.",
            "id" => "mobile_menu_sub_hover_color",
            "std" => "#ffffff",
            "type" => "color");

        $of_options[] = array("name" => "Mobile Menu Separator - Sublevels",
            "desc" => "Controls the color of the menu separator sublevels.",
            "id" => "mobile_menu_sub_sep_color",
            "std" => "",
            "type" => "color");
// end menu
// begin footer
        $of_options[] = array("name" => "Footer",
            "type" => "heading");

        $of_options[] = array("name" => "Footer Info",
            "desc" => "",
            "id" => "footer_info",
            "std" => "<h3 style='margin: 0;'>Footer Content Options</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array("name" => "Select a Footer Layout",
            "desc" => "",
            "id" => "footer_layout",
            "std" => "f1",
            "type" => "images",
            "options" => array(
                "f1" => get_template_directory_uri() . "/images/footer/footer1.jpg",
            ));
        $of_options[] = array("name" => "Back To Top",
                "desc" => "Enable back to top.",
                "id" => "footer_to_top",
                "std" => 1,
                "on" => "Yes",
                "off" => "No",
                "type" => "switch");

        $of_options[] = array("name" => "Footer Top Info",
            "desc" => "",
            "id" => "footer_top_info",
            "std" => "<h3 style='margin: 0;'>Footer Top Options</h3>",
            "icon" => true,
            "type" => "info");
        $of_options[] = array("name" => "Footer Top Widgets",
            "desc" => "Display footer top widgets.",
            "id" => "footer_top_widgets",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");

        $of_options[] = array("name" => "Number of Footer Top Columns",
            "desc" => "Select the number of columns to display in the footer top.",
            "id" => "footer_top_widgets_columns",
            "std" => "4",
            "options" => array('1' => '1', '2' => '2', '3' => '3', '4' => '4'),
            "fold" => "footer_top_widgets",
            "type" => "select");
        $of_options[] = array("name" => "Class Footer Widget 1",
            "desc" => "Class follow the Bootstrap 3",
            "id" => "footer_top_widgets_1",
            "std" => "col-xs-12 col-sm-6 col-md-3 col-lg-3",
            "fold" => "footer_top_widgets",
            "type" => "text");
        $of_options[] = array("name" => "Class Footer Widget 2",
            "desc" => "Class follow the Bootstrap 3",
            "id" => "footer_top_widgets_2",
            "std" => "col-xs-12 col-sm-6 col-md-3 col-lg-3",
            "fold" => "footer_top_widgets",
            "type" => "text");
        $of_options[] = array("name" => "Class Footer Widget 3",
            "desc" => "Class follow the Bootstrap 3",
            "id" => "footer_top_widgets_3",
            "std" => "col-xs-12 col-sm-6 col-md-3 col-lg-3",
            "fold" => "footer_top_widgets",
            "type" => "text");
        $of_options[] = array("name" => "Class Footer Widget 4",
            "desc" => "Class follow the Bootstrap 3",
            "id" => "footer_top_widgets_4",
            "std" => "col-xs-12 col-sm-6 col-md-3 col-lg-3",
            "fold" => "footer_top_widgets",
            "type" => "text");

        $of_options[] = array("name" => "Footer Top Background Color",
            "desc" => "Footer Top Background Color.",
            "id" => "footer_top_bg_color",
            "std" => "#f5f5f5",
            "type" => "color");
        $of_options[] = array("name" => "Footer Top Headings Color",
            "desc" => "Controls the text color of the footer top heading font.",
            "id" => "footer_headings_color",
            "std" => "#333333",
            "type" => "color");
        $of_options[] = array("name" => "Footer Top Font Color",
            "desc" => "Controls the text color of the footer top font.",
            "id" => "footer_text_color",
            "std" => "#999999",
            "type" => "color");
        $of_options[] = array("name" => "Footer Top Link Color",
            "desc" => "Controls the text color of the footer top link font.",
            "id" => "footer_link_color",
            "std" => "#999999",
            "type" => "color");
        $of_options[] = array("name" => "Footer Top Link Hover Color",
            "desc" => "Footer Top Link Hover Color.",
            "id" => "footer_link_hover_color",
            "std" => "#c79c60",
            "type" => "color");

        $of_options[] = array("name" => "Background Image",
            "desc" => "Select an image or insert an image url to use for the footer top area backgroud.",
            "id" => "footer_top_bg_image",
            "std" => "",
            "mod" => "",
            "fold" => "footer_top_widgets",
            "type" => "media");

        $of_options[] = array("name" => "100% Background Image",
            "desc" => "The footer top background image display at 100% in width and height and scale according to the browser size.",
            "id" => "footer_top_bg_full",
            "std" => 0,
            "on" => "Yes",
            "off" => "No",
            "fold" => "footer_top_widgets",
            "type" => "switch");

        $of_options[] = array("name" => "Parallax Background Image",
            "desc" => "Enable parallax background image when scrolling.",
            "id" => "footer_top_bg_parallax",
            "std" => 0,
            "on" => "Yes",
            "off" => "No",
            "fold" => "footer_top_widgets",
            "type" => "switch");

        $of_options[] = array("name" => "Background Repeat",
            "desc" => "Select how the background image repeats.",
            "id" => "footer_top_bg_repeat",
            "std" => "",
            "type" => "select",
            "fold" => "footer_top_widgets",
            "options" => array('repeat' => 'repeat', 'repeat-x' => 'repeat-x', 'repeat-y' => 'repeat-y', 'no-repeat' => 'no-repeat'));

        $of_options[] = array("name" => "Background Position",
            "desc" => "Select the position from where background image starts.",
            "id" => "footer_top_bg_pos",
            "std" => "center center",
            "type" => "select",
            "fold" => "footer_top_widgets",
            "options" => $body_pos);
        $of_options[] = array("name" => "Footer Top Padding",
            "desc" => "In pixels, top left botton right, ex: 10px 10px 10px 10px",
            "id" => "footer_top_padding",
            "std" => "40px 0px",
            "fold" => "footer_top_widgets",
            "type" => "text");
        $of_options[] = array("name" => "Footer Top Margin",
            "desc" => "In pixels, top left botton right, ex: 10px 10px 10px 10px",
            "id" => "footer_top_margin",
            "std" => "0px",
            "fold" => "footer_top_widgets",
            "type" => "text");
        // Footer Bottom
        $of_options[] = array("name" => "Footer Bottom Info",
            "desc" => "",
            "id" => "footer_bottom_info",
            "std" => "<h3 style='margin: 0;'>Footer Bottom Options</h3>",
            "icon" => true,
            "type" => "info");
        $of_options[] = array("name" => "Footer Bottom Widgets",
            "desc" => "Check the box to display footer bottom widgets.",
            "id" => "footer_bottom_widgets",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");

        $of_options[] = array("name" => "Number of Footer Bottom Columns",
            "desc" => "Select the number of columns to display in the footer bottom.",
            "id" => "footer_bottom_widgets_columns",
            "std" => "2",
            "options" => array('1' => '1', '2' => '2'),
            "fold" => "footer_bottom_widgets",
            "type" => "select");
        $of_options[] = array("name" => "Class Footer Bottom Widget 1",
            "desc" => "Class follow the Bootstrap 3",
            "id" => "footer_bottom_widgets_1",
            "std" => "col-xs-12 col-sm-6 col-md-6 col-lg-6",
            "fold" => "footer_bottom_widgets",
            "type" => "text");
        $of_options[] = array("name" => "Class Footer Bottom Widget 2",
            "desc" => "Class follow the Bootstrap 3",
            "id" => "footer_bottom_widgets_2",
            "std" => "col-xs-12 col-sm-6 col-md-6 col-lg-6",
            "fold" => "footer_bottom_widgets",
            "type" => "text");

        $of_options[] = array("name" => "Footer Bottom Background Color",
            "desc" => "Footer Bottom Background Color.",
            "id" => "footer_bottom_bg_color",
            "std" => "#222222",
            "type" => "color");
        $of_options[] = array("name" => "Footer Bottom Headings Color",
            "desc" => "Controls the text color of the footer bottom heading font.",
            "id" => "footer_bottom_headings_color",
            "std" => "",
            "type" => "color");
        $of_options[] = array("name" => "Footer Bottom Font Color",
            "desc" => "Controls the text color of the footer bottom font.",
            "id" => "footer_bottom_text_color",
            "std" => "#888888",
            "type" => "color");
        $of_options[] = array("name" => "Footer Bottom Link Color",
            "desc" => "Controls the text color of the footer bottom link font.",
            "id" => "footer_bottom_link_color",
            "std" => "#888888",
            "type" => "color");
        $of_options[] = array("name" => "Footer Bottom Link Hover Color",
            "desc" => "Footer Bottom Link Hover Color.",
            "id" => "footer_bottom_link_hover_color",
            "std" => "#c79c60",
            "type" => "color");

        $of_options[] = array("name" => "Footer Bottom Padding",
            "desc" => "In pixels, top left botton right, ex: 10px 10px 10px 10px",
            "id" => "footer_bottom_padding",
            "std" => "14px 0",
            "fold" => "footer_bottom_widgets",
            "type" => "text");
        $of_options[] = array("name" => "Footer Bottom Margin",
            "desc" => "In pixels, top left botton right, ex: 10px 10px 10px 10px",
            "id" => "footer_bottom_margin",
            "std" => "0",
            "fold" => "footer_bottom_widgets",
            "type" => "text");
// end footer

// begin button
        $of_options[] = array("name" => "Button Options",
            "type" => "heading");

        $of_options[] = array("name" => "Button Info",
            "desc" => "",
            "id" => "button_info",
            "std" => "<h3 style='margin: 0;'>Button Options</h3>",
            "icon" => true,
            "type" => "info");
        $of_options[] = array("name" => "Button Border Radius",
            "desc" => "Button Border Radius. In pixels ex: 3px",
            "id" => "button_border_radius",
            "std" => "5px",
            "type" => "text");
        $of_options[] = array("name" => "Button Border Width",
            "desc" => "Button Border Width. In pixels ex: 4px",
            "id" => "button_border_width",
            "std" => "3px",
            "type" => "text");
        $of_options[] = array("name" => "Button Font Size",
            "desc" => "Button Font Size. In pixels ex: 18px",
            "id" => "button_font_size",
            "std" => "13px",
            "type" => "text");
        $of_options[] = array("name" => "Button Border Style",
            "desc" => "Button Border Style.",
            "id" => "button_border_style",
            "std" => "solid",
            "type" => "select",
            "options" => array(
                'solid' => 'solid',
                'dotted' => 'dotted',
                'dashed' => 'dashed',
                'none' => 'none',
                'hidden' => 'hidden',
                'double' => 'double',
                'groove' => 'groove',
                'ridge' => 'ridge',
                'inset' => 'inset',
                'outset' => 'outset',
                'initial' => 'initial',
                'inherit' => 'inherit',
            ));
        $of_options[] = array("name" => "Button Border Top",
            "desc" => "Button Border Width.",
            "id" => "button_border_top",
            "std" => 0,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array("name" => "Button Border Left",
            "desc" => "Button Border Left.",
            "id" => "button_border_left",
            "std" => 0,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array("name" => "Button Border Bottom",
            "desc" => "Button Border Bottom.",
            "id" => "button_border_bottom",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array("name" => "Button Border Right",
            "desc" => "Button Border Right.",
            "id" => "button_border_right",
            "std" => 0,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array("name" => "Button Padding",
            "desc" => "In pixels, top left botton right, ex: 10px 10px 10px 10px",
            "id" => "button_padding",
            "std" => "12px 14px 9px 14px",
            "type" => "text");
        $of_options[] = array("name" => "Button Margin",
            "desc" => "In pixels, top left botton right, ex: 10px 10px 10px 10px",
            "id" => "button_margin",
            "std" => "",
            "type" => "text");

        $of_options[] = array("name" => "Button Colors",
            "desc" => "",
            "id" => "button_colors",
            "std" => "<h3 style='margin: 0;'>Button Colors</h3>",
            "icon" => true,
            "type" => "info");
        $of_options[] = array("name" => "Button Default Text Color",
            "desc" => "Controls the text color of buttons.",
            "id" => "button_gradient_text_color",
            "std" => "#fff",
            "type" => "color");
        $of_options[] = array("name" => "Button Default Text Color Hover",
            "desc" => "Controls the text color hover of buttons.",
            "id" => "button_gradient_text_color_hover",
            "std" => "#fff",
            "type" => "color");
        $of_options[] = array("name" => "Button Default Background Color",
            "desc" => "Controls the default button color.",
            "id" => "button_gradient_top_color",
            "std" => "#c79c60",
            "type" => "color");
        $of_options[] = array("name" => "Button Default Background Hover Color",
            "desc" => "Controls the default button color hover.",
            "id" => "button_gradient_top_color_hover",
            "std" => "#a37b44",
            "type" => "color");
        $of_options[] = array("name" => "Button Default Border Color",
            "desc" => "Controls the border color of the buttons.",
            "id" => "button_border_color",
            "std" => "#a37b44",
            "type" => "color");
        $of_options[] = array("name" => "Button Default Border Color Hover",
            "desc" => "Controls the border color hover of the buttons.",
            "id" => "button_border_color_hover",
            "std" => "#a37b44",
            "type" => "color");
        $of_options[] = array("name" => "Button Primary Text Color",
            "desc" => "Controls the text color of buttons.",
            "id" => "button_primary_text_color",
            "std" => "#fff",
            "type" => "color");
        $of_options[] = array("name" => "Button Primary Text Color Hover",
            "desc" => "Controls the text color hover of buttons.",
            "id" => "button_primary_text_color_hover",
            "std" => "#fff",
            "type" => "color");
        $of_options[] = array("name" => "Button Primary Background Color",
            "desc" => "Controls the default button color.",
            "id" => "button_primary_background_color",
            "std" => "#c79c60",
            "type" => "color");
        $of_options[] = array("name" => "Button Primary Background Color Hover",
            "desc" => "Controls the default button color.",
            "id" => "button_primary_background_color_hover",
            "std" => "#a37b44",
            "type" => "color");
        $of_options[] = array("name" => "Button Primary Border Color",
            "desc" => "Controls the border color of the buttons.",
            "id" => "button_primary_border_color",
            "std" => "#a37b44",
            "type" => "color");
        $of_options[] = array("name" => "Button Primary Border Color Hover",
            "desc" => "Controls the border color hover of the buttons.",
            "id" => "button_primary_border_color_hover",
            "std" => "#a37b44",
            "type" => "color");
// end button

// begin title bar - breadcrumbs
        $of_options[] = array("name" => "Page Title Bar",
            "type" => "heading");

        $of_options[] = array("name" => "Header Info",
            "desc" => "",
            "id" => "header_info",
            "std" => "<h3 style='margin: 0;'>Page Title Bar Options</h3>",
            "icon" => true,
            "type" => "info");
        $of_options[] = array("name" => "Title Align",
            "desc" => "Text align for title bar",
            "id" => "page_title_bar_align",
            "std" => "left",
            "options" => array('left' => 'left', 'center' => 'center','right' => 'right'),
            "type" => "select");
        $of_options[] = array( "name" => "Title Bar Length",
            "desc" => "Insert the number of words you want to show in the page title bar.",
            "id" => "title_bar_length",
            "std" => "20",
            "type" => "text");
        $of_options[] = array( "name" => "Title Size",
            "desc" => "Insert the number of size you want to show in the page title bar.",
            "id" => "title_bar_size",
            "std" => "68px",
            "type" => "text");
        $of_options[] = array("name" => "Page Title Bar Image",
                "desc" => "Select an image or insert an image url to use for the page title bar image.",
                "id" => "page_title_image",
                "std" => "",
                "mod" => "",
                "type" => "media");
        $of_options[] = array("name" => "Image Height",
                "desc" => "In pixels, default 50px",
                "id" => "page_title_image_height",
                "std" => "50px",
                "type" => "text");

        $of_options[] = array("name" => "Page Title Bar Background Color",
            "desc" => "Select a color for the page title bar background.",
            "id" => "page_title_bg_color",
            "std" => "#f5f5f5",
            "type" => "color");

        $of_options[] = array("name" => "Page Title Font Color",
            "desc" => "Controls the text color of the page title font.",
            "id" => "page_title_color",
            "std" => "#fff",
            "type" => "color");

        $of_options[] = array("name" => "Page Title Bar Borders Color",
            "desc" => "Select a color for the page title bar borders.",
            "id" => "page_title_border_color",
            "std" => "#fff",
            "type" => "color");

        $of_options[] = array("name" => "Page Title Bar Background",
            "desc" => "Select an image or insert an image url to use for the page title bar background.",
            "id" => "page_title_bg",
            "std" => "",
            "mod" => "",
            "type" => "media");

        $of_options[] = array("name" => "100% Background Image",
            "desc" => "Show the page title bar background image display at 100% in width and height and scale according to the browser size.",
            "id" => "page_title_bg_full",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");

        $of_options[] = array("name" => "Parallax Background Image",
            "desc" => "Enable parallax background image when scrolling.",
            "id" => "page_title_bg_parallax",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array("name" => "Page Title Bar Padding",
                "desc" => "In pixels, top left botton right, ex: 10px 10px 10px 10px",
                "id" => "page_title_padding",
                "std" => "50px 0",
                "type" => "text");

        $of_options[] = array("name" => "Header Info",
            "desc" => "",
            "id" => "breadcrumbs_info",
            "std" => "<h3 style='margin: 0;'>Breadcrumb Options</h3>",
            "icon" => true,
            "type" => "info");
        $of_options[] = array("name" => "Show Breadcrumb",
            "desc" => "Show breadcrumbs.",
            "id" => "breadcrumb_show",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array("name" => "Breadcrumb on Mobile Devices",
            "desc" => "Display breadcrumbs on mobile devices.",
            "id" => "breadcrumb_mobile",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array("name" => "Breadcrumb Text Align",
                "desc" => "Select style for Page Title",
                "id" => "breadcrumb_text_align",
                "std" => "right",
                "options" => array('left' => 'left', 'center'=> 'center', 'right' => 'right'),
                "type" => "select");

        $of_options[] = array("name" => "Breadcrumb Home Prefix",
            "desc" => "The text before the breadcrumb home.",
            "id" => "breacrumb_home_prefix",
            "std" => "You are here: Home",
            "type" => "text");

        $of_options[] = array("name" => "Breadcrumbs Text Color",
            "desc" => "Controls the text color of the breadcrumb font.",
            "id" => "breadcrumbs_text_color",
            "std" => "#ffffff",
            "type" => "color");
// end title bar - breadcrumbs

// begin styling option
        $of_options[] = array("name" => "Styling Options",
            "type" => "heading"
        );

        $of_options[] = array("name" => "Main Color",
            "desc" => "",
            "id" => "main_color",
            "std" => "<h3 style='margin: 0;'>Main Color</h3>",
            "icon" => true,
            "type" => "info");
        $of_options[] = array("name" => "Preset Color Scheme",
            "desc" => "Select a scheme, all color options will automatically change to the defined scheme.",
            "id" => "preset_color_scheme",
            "std" => "Preset1",
            "type" => "select",
            "options" => array('preset1' => 'preset1', 'preset2' => 'preset2'));
        $of_options[] = array("name" => "Primary Color",
            "desc" => "Controls several items, ex: link hovers, highlights, and more.",
            "id" => "primary_color",
            "std" => "#c79c60",
            "type" => "color");
        $of_options[] = array("name" => "Secondary Color",
            "desc" => "Secondary color.",
            "id" => "secondary_color",
            "std" => "#a37b44",
            "type" => "color");

        $of_options[] = array("name" => "Element Colors",
            "desc" => "",
            "id" => "element_colors",
            "std" => "<h3 style='margin: 0;'>Element Colors</h3>",
            "icon" => true,
            "type" => "info");
        $of_options[] = array("name" => "Form Background Color",
            "desc" => "Controls the background color of form fields.",
            "id" => "form_bg_color",
            "std" => "#ffffff",
            "type" => "color");

        $of_options[] = array("name" => "Form Text Color",
            "desc" => "Controls the text color for forms.",
            "id" => "form_text_color",
            "std" => "#113a52",
            "type" => "color");

        $of_options[] = array("name" => "Form Border Color",
            "desc" => "Controls the border color of form fields.",
            "id" => "form_border_color",
            "std" => "#d2d2d2",
            "type" => "color");


// end menu

// begin content area
        $of_options[] = array("name" => "Content Area",
            "desc" => "",
            "id" => "content_area",
            "std" => "<h3 style='margin: 0;'>Content Area</h3>",
            "icon" => true,
            "type" => "info");
        $of_options[] = array("name" => "Content Background Color",
            "desc" => "Controls the background color of the main content area.",
            "id" => "content_bg_color",
            "std" => "#ffffff",
            "type" => "color");
        $of_options[] = array("name" => "Page Content Padding",
            "desc" => "(In pixels, top left botton right, ex: 10px 10px 10px 10px)",
            "id" => "main_content_padding",
            "std" => "0px 0px 0px 0px",
            "type" => "text");
        $of_options[] = array("name" => "Page Content Margin",
            "desc" => "(In pixels, top left botton right, ex: 10px 10px 10px 10px)",
            "id" => "main_content_margin",
            "std" => "",
            "type" => "text");
// end content area

// end font colors
        $of_options[] = array("name" => "Font Colors Scheme",
            "desc" => "",
            "id" => "font_colors_scheme_font",
            "std" => "<h3 style='margin: 0;'>Font Colors</h3>",
            "icon" => true,
            "type" => "info");

        $of_options[] = array("name" => "Link Color",
            "desc" => "Controls the color of all text links.",
            "id" => "link_color",
            "std" => "#c79c60",
            "type" => "color");
        $of_options[] = array("name" => "Link Color Hover",
            "desc" => "Link Color Hover.",
            "id" => "link_color_hover",
            "std" => "#a37b44",
            "type" => "color");

        $of_options[] = array("name" => "Heading 1 (H1) Font Color",
            "desc" => "Controls the text color of H1 headings.",
            "id" => "h1_color",
            "std" => "#c79c60",
            "type" => "color");

        $of_options[] = array("name" => "Heading 2 (H2) Font Color",
            "desc" => "Controls the text color of H2 headings.",
            "id" => "h2_color",
            "std" => "#333333",
            "type" => "color");

        $of_options[] = array("name" => "Heading 3 (H3) Font Color",
            "desc" => "Controls the text color of H3 headings.",
            "id" => "h3_color",
            "std" => "#333333",
            "type" => "color");

        $of_options[] = array("name" => "Heading 4 (H4) Font Color",
            "desc" => "Controls the text color of H4 headings.",
            "id" => "h4_color",
            "std" => "#333333",
            "type" => "color");

        $of_options[] = array("name" => "Heading 5 (H5) Font Color",
            "desc" => "Controls the text color of H5 headings.",
            "id" => "h5_color",
            "std" => "#333333",
            "type" => "color");

        $of_options[] = array("name" => "Heading 6 (H6) Font Color",
            "desc" => "Controls the text color of H6 headings.",
            "id" => "h6_color",
            "std" => "#333333",
            "type" => "color");
// end font colors

// begin Typography
        $of_options[] = array("name" => "Typography",
            "type" => "heading"
        );

        $of_options[] = array("name" => "Body Options",
            "desc" => "",
            "id" => "body_options",
            "std" => "<h3 style='margin: 0;'>Body Options</h3>",
            "icon" => true,
            "type" => "info");
        $of_options[] = array("name" => "Body Font Options",
            "desc" => "Body Font Options.",
            "id" => "body_font_options",
            "std" => "Google Font",
            "type" => "select",
            "options" => $of_options_font
        );
        $of_options[] = array("name" => "Google Body Font Family",
            "desc" => "Google body font family.",
            "id" => "google_body_font_family",
            "std" => "Open Sans",
            "type" => "select_google_font",
            "options" => $of_options_google_font
        );
        $of_options[] = array("name" => "Standard Body Font Family",
            "desc" => "Standard Body Font Family.",
            "id" => "standard_body_font_family",
            "std" => "",
            "type" => "select",
            "options" => $of_options_standard_fonts
        );
        $of_options[] = array("name" => "Custom Body Font Family",
            "desc" => "Custom Body Font Family.",
            "id" => "custom_body_font_family",
            "std" => "OpenSans-Regular",
            "type" => "select",
            "options" => $of_options_custom_fonts
        );

        $of_options[] = array("name" => "Body Font Family Selector",
            "desc" => "Body Font Family Selector",
            "id" => "body_font_family_selector",
            "std" => "body, .q_counter_holder span.counter, .cs-testimonial-header h3.cs-title, .cs-team .cs-header h3.cs-title, .wpb_accordion_section .wpb_accordion_header a, .q_counter_holder p.counter_text, h3.ww-title, h3.cs-title,  .ww-subtitle, .cs-breadcrumbs a, .cs-breadcrumbs span, .home .ww-fancy-box.fancy-box-style-1 .ww-title-main, .cs-subtitle, .cs-desc, .logo-text, .logo-text strong:nth-child(2), .logo-text i, .cs-carousel-style-3 .cs-carousel-header-feature span,
#primary-sidebar .wg-title, h3.comment-reply-title,  .cs-eventCount-content h3.cs-eventCount-title",
            "type" => "textarea"
        );
        $of_options[] = array("name" => "Body Font Size",
            "desc" => "Body Font Size",
            "id" => "body_font_size",
            "std" => "14px",
            "type" => "select",
            "options" => $of_options_fontsize
        );

        $of_options[] = array("name" => "Header Options",
            "desc" => "",
            "id" => "header_options",
            "std" => "<h3 style='margin: 0;'>Header Options</h3>",
            "icon" => true,
            "type" => "info");
        $of_options[] = array("name" => "Header Font Options",
            "desc" => "Header Font Options.",
            "id" => "header_font_options",
            "std" => "Custom Font",
            "type" => "select",
            "options" => $of_options_font
        );
        $of_options[] = array("name" => "Google Header Font Family",
            "desc" => "Google Header font family.",
            "id" => "google_header_font_family",
            "std" => "",
            "type" => "select_google_font",
            "options" => $of_options_google_font
        );
        $of_options[] = array("name" => "Standard Header Font Family",
            "desc" => "Standard Header Font Family.",
            "id" => "standard_header_font_family",
            "std" => "",
            "type" => "select",
            "options" => $of_options_standard_fonts
        );
        $of_options[] = array("name" => "Custom Header Font Family",
            "desc" => "Custom Header Font Family.",
            "id" => "custom_header_font_family",
            "std" => "Novecentowide-Medium",
            "type" => "select",
            "options" => $of_options_custom_fonts
        );

        $of_options[] = array("name" => "Header Font Family Selector",
            "desc" => "Header Font Family Selector",
            "id" => "header_font_family_selector",
            "std" => "body h2, body h4,  .cs-recent-post-v1 ul li a,   .cs-fancy-box .cs-title-main, h3.cs-team-title, .cs-testimonial-content .cs-testimonial-title,  .woocommerce-breadcrumb, .woocommerce-breadcrumb a, .product_title, cs-shopcarousel-style-1-shop h3.cs-title",
            "type" => "textarea"
        );

        $of_options[] = array("name" => "Other Options",
            "desc" => "",
            "id" => "other_options",
            "std" => "<h3 style='margin: 0;'>Other Options</h3>",
            "icon" => true,
            "type" => "info");
        /* Other Font 0 */
        $of_options[] = array("name" => "Other Font Options",
            "desc" => "Other Font Options.",
            "id" => "other_font_options_0",
            "std" => "Custom Font",
            "type" => "select",
            "options" => $of_options_font
        );
        $of_options[] = array("name" => "Google Other Font Family",
            "desc" => "Google Other font family.",
            "id" => "google_other_font_family_0",
            "std" => "",
            "type" => "select_google_font",
            "options" => $of_options_google_font
        );
        $of_options[] = array("name" => "Standard Other Font Family",
            "desc" => "Standard Other Font Family.",
            "id" => "standard_other_font_family_0",
            "std" => "",
            "type" => "select",
            "options" => $of_options_standard_fonts
        );
        $of_options[] = array("name" => "Custom Other Font Family",
            "desc" => "Custom Other Font Family.",
            "id" => "custom_other_font_family_0",
            "std" => "Novecentowide-Bold",
            "type" => "select",
            "options" => $of_options_custom_fonts
        );
        $of_options[] = array("name" => "Other Font Family Selector",
            "desc" => "Other Font Family Selector",
            "id" => "other_font_family_selector_0",
            "std" => " h3.cs-pricing-title,   th, th a,.widget_calendar #wp-calendar caption, .cs_separator_title h4, .meny-sidebar h3.wg-title, a.shipping-calculator-button, .cart-collaterals .cart_totals > h2, .woocommerce-billing-fields > h3, #ship-to-different-address > label, #order_review_heading",
            "type" => "textarea"
        );
        /* Other Font 1 */
        $of_options[] = array("name" => "Other Font 1",
            "desc" => "Other Font Options.",
            "id" => "other_font_options_1",
            "std" => "Custom Font",
            "type" => "select",
            "options" => $of_options_font
        );
        $of_options[] = array("name" => "Google Other Font 1",
            "desc" => "Google Other font family.",
            "id" => "google_other_font_family_1",
            "std" => "",
            "type" => "select_google_font",
            "options" => $of_options_google_font
        );
        $of_options[] = array("name" => "Standard Other Font 1",
            "desc" => "Standard Other Font Family.",
            "id" => "standard_other_font_family_1",
            "std" => "",
            "type" => "select",
            "options" => $of_options_standard_fonts
        );
        $of_options[] = array("name" => "Custom Other Font 1",
            "desc" => "Custom Other Font Family.",
            "id" => "custom_other_font_family_1",
            "std" => "OpenSans-Bold",
            "type" => "select",
            "options" => $of_options_custom_fonts
        );
        $of_options[] = array("name" => "Other Font Family Selector 1",
            "desc" => "Other Font Family Selector",
            "id" => "other_font_family_selector_1",
            "std" => "body h2, body h3, body h4,a.read-more-link, h3.title-main-body, .tab-holder ul.nav li a, .cs-popular .cs-meta .date, .cs-popular .cs-details > h4, .cs-popular .cs-details .readmore, .getTouchSidebar > li i, .cs-latest-twitter a i, strong, .cs-menuFood-content .price-food span, .cs-blog-quote .cs-blog-content .cs-content-text span.author, ul.textContact li .text-upper, .cs-menuFood-footer .description-icon span, .logo-text strong:nth-child(1), .cs-carousel-container .cs-carousel-header .cs-carousel-post-date, .cs-carousel-events-header .cs-carousel-post-date, .cs-carousel-events-date, .cs-blog .date-box .date span, .widget_categories .heading + ul li.cat-item:hover > a, .widget_categories .heading + ul ul li:hover > a,  .widget_meta .heading + ul > li:hover > a, .comment-body .fn, .categories_list_post .date-box .date span, .cs-booking-form label, #primary-sidebar .wg-title .title-line, h3.comment-reply-title span, .cs-blog-events .cs-blog-eventsBooking a.btn, .cs-blog-events .cs-blog-eventsDate, .widget_categories .wg-title + ul li:hover > a,  .widget_meta .wg-title + ul > li:hover > a",
            "type" => "textarea"
        );
        /* Other Font 2 */
        $of_options[] = array("name" => "Other Font 2",
            "desc" => "Other Font Options.",
            "id" => "other_font_options_2",
            "std" => "Custom Font",
            "type" => "select",
            "options" => $of_options_font
        );
        $of_options[] = array("name" => "Google Other Font 2",
            "desc" => "Google Other font family.",
            "id" => "google_other_font_family_2",
            "std" => "",
            "type" => "select_google_font",
            "options" => $of_options_google_font
        );
        $of_options[] = array("name" => "Standard Other Font 2",
            "desc" => "Standard Other Font Family.",
            "id" => "standard_other_font_family_2",
            "std" => "",
            "type" => "select",
            "options" => $of_options_standard_fonts
        );
        $of_options[] = array("name" => "Custom Other Font 2",
            "desc" => "Custom Other Font Family.",
            "id" => "custom_other_font_family_2",
            "std" => "OpenSans-Light",
            "type" => "select",
            "options" => $of_options_custom_fonts
        );
        $of_options[] = array("name" => "Other Font Family Selector 2",
            "desc" => "Other Font Family Selector",
            "id" => "other_font_family_selector_2",
            "std" => ".cs-eventCount-content #event_countdown span:nth-child(2)",
            "type" => "textarea"
        );
        /* Other Font 3 */
        $of_options[] = array("name" => "Other Font 3",
            "desc" => "Other Font Options.",
            "id" => "other_font_options_3",
            "std" => "Custom Font",
            "type" => "select",
            "options" => $of_options_font
        );
        $of_options[] = array("name" => "Google Other Font 3",
            "desc" => "Google Other font family.",
            "id" => "google_other_font_family_3",
            "std" => "",
            "type" => "select_google_font",
            "options" => $of_options_google_font
        );
        $of_options[] = array("name" => "Standard Other Font 3",
            "desc" => "Standard Other Font Family.",
            "id" => "standard_other_font_family_3",
            "std" => "",
            "type" => "select",
            "options" => $of_options_standard_fonts
        );
        $of_options[] = array("name" => "Custom Other Font 3",
            "desc" => "Custom Other Font Family.",
            "id" => "custom_other_font_family_3",
            "std" => "OpenSans-Semibold",
            "type" => "select",
            "options" => $of_options_custom_fonts
        );
        $of_options[] = array("name" => "Other Font Family Selector 3",
            "desc" => "Other Font Family Selector",
            "id" => "other_font_family_selector_3",
            "std" => "body h5, body h6, .cs-testimonial-content .cs-title.cs-testimonial-category, #footer-top h3.wg-title, .cs-carousel-body .cs-carousel-post-title a, input[type='submit'],  .btn, .button, button, .cs-carousel-events-body .cs-event-title .cs-carousel-event-title a, .cs-latestEvents .cs-eventBody .cs-eventContent > h3, code, kbd",
            "type" => "textarea"
        );
        /* Other Font 4 */
        $of_options[] = array("name" => "Other Font 4",
            "desc" => "Other Font Options.",
            "id" => "other_font_options_4",
            "std" => "Custom Font",
            "type" => "select",
            "options" => $of_options_font
        );
        $of_options[] = array("name" => "Google Other Font 4",
            "desc" => "Google Other font family.",
            "id" => "google_other_font_family_4",
            "std" => "",
            "type" => "select_google_font",
            "options" => $of_options_google_font
        );
        $of_options[] = array("name" => "Standard Other Font 4",
            "desc" => "Standard Other Font Family.",
            "id" => "standard_other_font_family_4",
            "std" => "",
            "type" => "select",
            "options" => $of_options_standard_fonts
        );
        $of_options[] = array("name" => "Custom Other Font 4",
            "desc" => "Custom Other Font Family.",
            "id" => "custom_other_font_family_4",
            "std" => "Novecentowide-Medium",
            "type" => "select",
            "options" => $of_options_custom_fonts
        );
        $of_options[] = array("name" => "Other Font Family Selector 4",
            "desc" => "Other Font Family Selector",
            "id" => "other_font_family_selector_4",
            "std" => ".cs-navigation .page-numbers, .cs_call_to_action .wpb_call_text, a.read-more-link.btn",
            "type" => "textarea"
        );
        /* Other Font 5 */
        $of_options[] = array("name" => "Other Font 5",
            "desc" => "Other Font Options.",
            "id" => "other_font_options_5",
            "std" => "Custom Font",
            "type" => "select",
            "options" => $of_options_font
        );
        $of_options[] = array("name" => "Google Other Font 5",
            "desc" => "Google Other font family.",
            "id" => "google_other_font_family_5",
            "std" => "",
            "type" => "select_google_font",
            "options" => $of_options_google_font
        );
        $of_options[] = array("name" => "Standard Other Font 5",
            "desc" => "Standard Other Font Family.",
            "id" => "standard_other_font_family_5",
            "std" => "",
            "type" => "select",
            "options" => $of_options_standard_fonts
        );
        $of_options[] = array("name" => "Custom Other Font 5",
            "desc" => "Custom Other Font Family.",
            "id" => "custom_other_font_family_5",
            "std" => "Novecentowide-Book",
            "type" => "select",
            "options" => $of_options_custom_fonts
        );
        $of_options[] = array("name" => "Other Font Family Selector 5",
            "desc" => "Other Font Family Selector",
            "id" => "other_font_family_selector_5",
            "std" => "body h6",
            "type" => "textarea"
        );
        /* Other Font 6 */
        $of_options[] = array("name" => "Other Font 6",
                "desc" => "Other Font Options.",
                "id" => "other_font_options_6",
                "std" => "Custom Font",
                "type" => "select",
                "options" => $of_options_font
        );
        $of_options[] = array("name" => "Google Other Font 6",
                "desc" => "Google Other font family.",
                "id" => "google_other_font_family_6",
                "std" => "",
                "type" => "select_google_font",
                "options" => $of_options_google_font
        );
        $of_options[] = array("name" => "Standard Other Font 6",
                "desc" => "Standard Other Font Family.",
                "id" => "standard_other_font_family_6",
                "std" => "",
                "type" => "select",
                "options" => $of_options_standard_fonts
        );
        $of_options[] = array("name" => "Custom Other Font 6",
                "desc" => "Custom Other Font Family.",
                "id" => "custom_other_font_family_6",
                "std" => "Herrvonmuellerhoff-Regular",
                "type" => "select",
                "options" => $of_options_custom_fonts
        );
        $of_options[] = array("name" => "Other Font Family Selector 6",
                "desc" => "Other Font Family Selector",
                "id" => "other_font_family_selector_6",
                "std" => "body h1, .cs-carousel-event-style1 .cs-title, .cs-carousel-style-3 .cs-carousel-header-feature h3",
                "type" => "textarea"
        );
        /* Other Font 7 */
        $of_options[] = array("name" => "Other Font 7",
                "desc" => "Other Font Options.",
                "id" => "other_font_options_7",
                "std" => "",
                "type" => "select",
                "options" => $of_options_font
        );
        $of_options[] = array("name" => "Google Other Font 7",
                "desc" => "Google Other font family.",
                "id" => "google_other_font_family_7",
                "std" => "",
                "type" => "select_google_font",
                "options" => $of_options_google_font
        );
        $of_options[] = array("name" => "Standard Other Font 7",
                "desc" => "Standard Other Font Family.",
                "id" => "standard_other_font_family_7",
                "std" => "",
                "type" => "select",
                "options" => $of_options_standard_fonts
        );
        $of_options[] = array("name" => "Custom Other Font 7",
                "desc" => "Custom Other Font Family.",
                "id" => "custom_other_font_family_7",
                "std" => "",
                "type" => "select",
                "options" => $of_options_custom_fonts
        );
        $of_options[] = array("name" => "Other Font Family Selector 7",
                "desc" => "Other Font Family Selector",
                "id" => "other_font_family_selector_7",
                "std" => "",
                "type" => "textarea"
        );
        /* Other Font 8 */
        $of_options[] = array("name" => "Other Font 8",
                "desc" => "Other Font Options.",
                "id" => "other_font_options_8",
                "std" => "",
                "type" => "select",
                "options" => $of_options_font
        );
        $of_options[] = array("name" => "Google Other Font 8",
                "desc" => "Google Other font family.",
                "id" => "google_other_font_family_8",
                "std" => "",
                "type" => "select_google_font",
                "options" => $of_options_google_font
        );
        $of_options[] = array("name" => "Standard Other Font 8",
                "desc" => "Standard Other Font Family.",
                "id" => "standard_other_font_family_8",
                "std" => "",
                "type" => "select",
                "options" => $of_options_standard_fonts
        );
        $of_options[] = array("name" => "Custom Other Font 8",
                "desc" => "Custom Other Font Family.",
                "id" => "custom_other_font_family_8",
                "std" => "",
                "type" => "select",
                "options" => $of_options_custom_fonts
        );
        $of_options[] = array("name" => "Other Font Family Selector 8",
                "desc" => "Other Font Family Selector",
                "id" => "other_font_family_selector_8",
                "std" => "",
                "type" => "textarea"
        );
        /* Other Font 9 */
        $of_options[] = array("name" => "Other Font 9",
                "desc" => "Other Font Options.",
                "id" => "other_font_options_9",
                "std" => "",
                "type" => "select",
                "options" => $of_options_font
        );
        $of_options[] = array("name" => "Google Other Font 9",
                "desc" => "Google Other font family.",
                "id" => "google_other_font_family_9",
                "std" => "",
                "type" => "select_google_font",
                "options" => $of_options_google_font
        );
        $of_options[] = array("name" => "Standard Other Font 9",
                "desc" => "Standard Other Font Family.",
                "id" => "standard_other_font_family_9",
                "std" => "",
                "type" => "select",
                "options" => $of_options_standard_fonts
        );
        $of_options[] = array("name" => "Custom Other Font 9",
                "desc" => "Custom Other Font Family.",
                "id" => "custom_other_font_family_9",
                "std" => "",
                "type" => "select",
                "options" => $of_options_custom_fonts
        );
        $of_options[] = array("name" => "Other Font Family Selector 9",
                "desc" => "Other Font Family Selector",
                "id" => "other_font_family_selector_9",
                "std" => "",
                "type" => "textarea"
        );
        /* Other Font 10 */
        $of_options[] = array("name" => "Other Font 10",
                "desc" => "Other Font Options.",
                "id" => "other_font_options_10",
                "std" => "",
                "type" => "select",
                "options" => $of_options_font
        );
        $of_options[] = array("name" => "Google Other Font 10",
                "desc" => "Google Other font family.",
                "id" => "google_other_font_family_10",
                "std" => "",
                "type" => "select_google_font",
                "options" => $of_options_google_font
        );
        $of_options[] = array("name" => "Standard Other Font 10",
                "desc" => "Standard Other Font Family.",
                "id" => "standard_other_font_family_10",
                "std" => "",
                "type" => "select",
                "options" => $of_options_standard_fonts
        );
        $of_options[] = array("name" => "Custom Other Font 10",
                "desc" => "Custom Other Font Family.",
                "id" => "custom_other_font_family_10",
                "std" => "",
                "type" => "select",
                "options" => $of_options_custom_fonts
        );
        $of_options[] = array("name" => "Other Font Family Selector 10",
                "desc" => "Other Font Family Selector",
                "id" => "other_font_family_selector_10",
                "std" => "",
                "type" => "textarea"
        );
        /* End Other Font*/

        $of_options[] = array("name" => "Heading Options",
            "desc" => "",
            "id" => "heading_options",
            "std" => "<h3 style='margin: 0;'>Heading Options</h3>",
            "icon" => true,
            "type" => "info");
        $of_options[] = array("name" => "Heading Font Size H1",
            "desc" => "Default is 40px",
            "id" => "heading_font_size_h1",
            "std" => "96px",
            "type" => "select",
            "options" => $of_options_fontsize
        );
        $of_options[] = array("name" => "Heading Font Size H2",
            "desc" => "Default is 32px",
            "id" => "heading_font_size_h2",
            "std" => "32px",
            "type" => "select",
            "options" => $of_options_fontsize
        );
        $of_options[] = array("name" => "Heading Font Size H3",
            "desc" => "Default is 26px",
            "id" => "heading_font_size_h3",
            "std" => "26px",
            "type" => "select",
            "options" => $of_options_fontsize
        );
        $of_options[] = array("name" => "Heading Font Size H4",
            "desc" => "Default is 18px",
            "id" => "heading_font_size_h4",
            "std" => "18px",
            "type" => "select",
            "options" => $of_options_fontsize
        );
        $of_options[] = array("name" => "Heading Font Size H5",
            "desc" => "Default is 12px",
            "id" => "heading_font_size_h5",
            "std" => "12px",
            "type" => "select",
            "options" => $of_options_fontsize
        );
        $of_options[] = array("name" => "Heading Font Size H6",
            "desc" => "Default is 11px",
            "id" => "heading_font_size_h6",
            "std" => "11px",
            "type" => "select",
            "options" => $of_options_fontsize
        );
// end Typography

// begin blog & page
        $of_options[] = array("name" => "Blog",
            "type" => "heading"
        );
        $of_options[] = array("name" => "Blog Options",
            "desc" => "",
            "id" => "blog_options",
            "std" => "<h3 style='margin: 0;'>Blog Options</h3>",
            "icon" => true,
            "type" => "info");
        $url =  ADMIN_DIR . 'assets/images/';
        $of_options[] = array(  "name"      => "Blog Layout",
            "desc"      => "Select main content and sidebar alignment. Choose between 1, 2 or 3 column layout (Left sidebar not support on Consilium-Shop).",
            "id"        => "blog_layout",
            "std"       => "right-fixed",
            "type"      => "images",
            "options"   => array(
                'full-fixed'    => $url . '1col.png',
                'right-fixed'   => $url . '2cr.png',
                'left-fixed'    => $url . '2cl.png'
            )
        );
        $of_options[] = array( "name" => "Read More",
            "desc" => "Show read more in posts (Defualt show Full Content).",
            "id" => "blog_full_content",
            "std" => 0,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");

        $of_options[] = array("name" => "Search Options",
            "desc" => "",
            "id" => "search_options",
            "std" => "<h3 style='margin: 0;'>Search Options</h3>",
            "icon" => true,
            "type" => "info");
        $of_options[] = array( "name" => "Show Heading",
            "desc" => "Show Heading For Search",
            "id" => "search_heading",
            "std" => 0,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array( "name" => "Show Page Title",
            "desc" => "Show page title on Search",
            "id" => "search_page_title",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array( "name" => "Page Title Animation",
            "desc" => "Fade out page title on scroll",
            "id" => "search_page_title_animation",
            "std" => 0,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array( "name" => "Show Breadcrumbs",
            "desc" => "Show Breadcrumbs on Search",
            "id" => "search_breadcrumbs",
            "std" => 0,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array("name" => "View Mode",
            "desc" => "Select view type for Search Results.",
            "id" => "search_view",
            "std" => "Excerpt",
            "type" => "select",
            "options" => array(
                'Excerpt' => 'Excerpt',
                'Read More' => 'Read More'
            ));

        $of_options[] = array("name" => "Archive Options",
            "desc" => "",
            "id" => "archive_options",
            "std" => "<h3 style='margin: 0;'>Archive Options</h3>",
            "icon" => true,
            "type" => "info");
        $of_options[] = array( "name" => "Show Heading",
                "desc" => "Show Heading For Archive",
                "id" => "archive_heading",
                "std" => 0,
                "on" => "Yes",
                "off" => "No",
                "type" => "switch");
        $of_options[] = array( "name" => "Show Page Title",
            "desc" => "Show Page Title On Archive",
            "id" => "archive_page_title",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array( "name" => "Page Title Animation",
            "desc" => "Fade out page title on scroll",
            "id" => "archive_page_title_animation",
            "std" => 0,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array( "name" => "Show Breadcrumbs",
            "desc" => "Show Archive Breadcrumbs",
            "id" => "archive_breadcrumbs",
            "std" => 0,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array( "name" => "Show Posts Title",
            "desc" => "Show Posts Title",
            "id" => "archive_posts_title",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array( "name" => "Read More",
                "desc" => "Show read more in posts (Defualt show Full Content).",
                "id" => "show_full_content",
                "std" => 1,
                "on" => "Yes",
                "off" => "No",
                "type" => "switch");
        $of_options[] = array( "name" => "Blog Date Format",
            "desc" => "<a href='http://codex.wordpress.org/Formatting_Date_and_Time'>Formatting Date and Time</a>",
            "id" => "archive_date_format",
            "std" => "m.d.Y",
            "type" => "text");
        $of_options[] = array("name" => "Post Options",
            "desc" => "",
            "id" => "post_options",
            "std" => "<h3 style='margin: 0;'>Post Options</h3>",
            "icon" => true,
            "type" => "info");
        $of_options[] = array( "name" => "Show Page Title",
            "desc" => "Show Page Title On Post",
            "id" => "post_page_title",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array( "name" => "Page Title Animation",
            "desc" => "Fade out page title on scroll",
            "id" => "post_page_title_animation",
            "std" => 0,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array( "name" => "Show Breadcrumbs",
            "desc" => "Show post Breadcrumbs",
            "id" => "post_breadcrumbs",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array( "name" => "Show Post Title",
            "desc" => "Show Post Title",
            "id" => "show_post_title",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array( "name" => "Show Comments Post",
            "desc" => "Show Comments Post",
            "id" => "show_comments_post",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array( "name" => "Show Tags",
            "desc" => "Show Tags Post",
            "id" => "show_tags_post",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array( "name" => "Previous/Next Pagination",
            "desc" => "Previous/Next Pagination",
            "id" => "show_navigation_post",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array(  "name"      => "Post Layout",
            "desc"      => "Select main content and sidebar alignment. Choose between 1, 2 or 3 column layout (Left sidebar not support on Consilium-Shop) .",
            "id"        => "post_layout",
            "std"       => "right-fixed",
            "type"      => "images",
            "options"   => array(
                'full-fixed'    => $url . '1col.png',
                'right-fixed'   => $url . '2cr.png',
                'left-fixed'    => $url . '2cl.png',
                '3column-fixed'         => $url . '3cm.png',
                '3column-right-fixed'   => $url . '3cr.png'
            )
        );
        $of_options[] = array("name" => "Post Style",
                "desc" => "Select Style for Post Items",
                "id" => "post_style",
                "std" => $template,
                "type" => "select",
                "options" => array(
                        'base' => 'base',
                        'corporate' => 'corporate'
                ));
        $of_options[] = array( "name" => "Featured Image On Archive Post",
            "desc" => "Display featured images on archive port.",
            "id" => "post_featured_images",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");

        $of_options[] = array( "name" => "Post Date Format",
            "desc" => "<a href='http://codex.wordpress.org/Formatting_Date_and_Time'>Formatting Date and Time</a>",
            "id" => "post_date_format",
            "std" => "m.d.Y",
            "type" => "text");

        $of_options[] = array("name" => "Page Options",
            "desc" => "",
            "id" => "page_options",
            "std" => "<h3 style='margin: 0;'>Page Options</h3>",
            "icon" => true,
            "type" => "info");
        $of_options[] = array( "name" => "Show Heading",
            "desc" => "Show page heading",
            "id" => "page_heading",
            "std" => 0,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array( "name" => "Show Page Title",
            "desc" => "Show Page Title On Page",
            "id" => "page_page_title",
            "std" => 0,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array( "name" => "Page Title Animation",
            "desc" => "Fade out page title on scroll",
            "id" => "page_page_title_animation",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array( "name" => "Show Breadcrumbs",
            "desc" => "Show page breadcrumbs",
            "id" => "page_breadcrumbs",
            "std" => 0,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array( "name" => "Show Page Title",
            "desc" => "Show Page Title",
            "id" => "show_page_title",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array( "name" => "Show Comments Page",
            "desc" => "Show Comments Page",
            "id" => "show_comments_page",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $url =  ADMIN_DIR . 'assets/images/';
        $of_options[] = array(  "name"      => "Page Layout",
            "desc"      => "Select main content and sidebar alignment. Choose between 1, 2 or 3 column layout (Left sidebar not support on Consilium-Shop).",
            "id"        => "page_layout",
            "std"       => "full-fixed",
            "type"      => "images",
            "options"   => array(
                'full-fixed'    => $url . '1col.png',
                'right-fixed'   => $url . '2cr.png',
                'left-fixed'    => $url . '2cl.png',
                '3column-fixed'         => $url . '3cm.png',
                '3column-right-fixed'   => $url . '3cr.png'
            )
        );
        $of_options[] = array( "name" => "Featured Image On Archive Page",
            "desc" => "Display featured images on archive page.",
            "id" => "page_featured_images",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");

        $of_options[] = array("name" => "Detail Options",
            "desc" => "",
            "id" => "detail_options",
            "std" => "<h3 style='margin: 0;'>Detail Options</h3>",
            "icon" => true,
            "type" => "info");
        $of_options[] = array( "name" => "Show Detail",
            "desc" => "Display detail bar on archive post and single.",
            "id" => "detail_detail",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array( "name" => "Show Date",
            "desc" => "Display date on archive post and single.",
            "id" => "detail_date",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "fold" => "detail_detail",
            "type" => "switch");
        $of_options[] = array( "name" => "Show Author",
            "desc" => "Display Author on archive post and single.",
            "id" => "detail_author",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "fold" => "detail_detail",
            "type" => "switch");
        $of_options[] = array( "name" => "Show Category",
            "desc" => "Display Category on archive post and single.",
            "id" => "detail_category",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "fold" => "detail_detail",
            "type" => "switch");
        $of_options[] = array( "name" => "Show Tags",
            "desc" => "Display Tags on archive post and single.",
            "id" => "detail_tags",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "fold" => "detail_detail",
            "type" => "switch");
        $of_options[] = array( "name" => "Show Comments",
            "desc" => "Display Comments on archive post and single.",
            "id" => "detail_comments",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "fold" => "detail_detail",
            "type" => "switch");
        $of_options[] = array( "name" => "Show Like",
            "desc" => "Display Like on archive post and single.",
            "id" => "detail_like",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "fold" => "detail_detail",
            "type" => "switch");
        $of_options[] = array( "name" => "Show Sharing",
            "desc" => "Display social sharing on archive post and single.",
            "id" => "detail_social",
            "std" => 0,
            "on" => "Yes",
            "off" => "No",
            "fold" => "detail_detail",
            "type" => "switch");

// end blog & page
        // begin one page
        $of_options[] = array("name" => "One Page",
                "type" => "heading"
        );
        $of_options[] = array("name" => "One Page Options",
                "desc" => "",
                "id" => "one_page_options",
                "std" => "<h3 style='margin: 0;'>One Page Options</h3>",
                "icon" => true,
                "type" => "info"
        );
        $of_options[] = array( "name" => "One Page Enable",
                "desc" => "Use One Page",
                "id" => "enable_one_page",
                "std" => 0,
                "on" => "Yes",
                "off" => "No",
                "type" => "switch"
        );
        $of_options[] = array( "name" => "Scroll Speed",
                "desc" => "Scroll Speed (default 750)",
                "id" => "page_scroll_speed",
                "std" => "750",
                "type" => "text",
                "fold" => "enable_one_page"
        );
        $of_options[] = array( "name" => "Scroll Offset",
                "desc" => "Scroll Offset (Defualt 0)",
                "id" => "page_scroll_offset",
                "std" => "0",
                "type" => "text",
                "fold" => "enable_one_page"
        );
        $of_options[] = array("name" => "Easing Plugin",
                "desc" => "Scroll animation (Defualt swing).",
                "id" => "page_scroll_easing",
                "std" => "jswing",
                "type" => "select",
                "fold" => "enable_one_page",
                "options" => array(
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
                        'easeOutQuad' => 'easeOutQuad',
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
                ));
// begin portfolio
        $of_options[] = array("name" => "Portfolio",
            "type" => "heading"
        );

        $of_options[] = array("name" => "Post Options",
            "desc" => "",
            "id" => "portfolio_post_options",
            "std" => "<h3 style='margin: 0;'>Post Options</h3>",
            "icon" => true,
            "type" => "info");
        $of_options[] = array( "name" => "About title",
            "desc" => "Please enter about title of post portfolio detail.",
            "id" => "portfolio_about_title",
            "std" => "About the Project",
            "type" => "text");
        $of_options[] = array( "name" => "Show Description",
            "desc" => "Show or hide description of post portfolio detail.",
            "id" => "portfolio_show_description",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array( "name" => "Excerpt Length",
            "desc" => "Insert the number of words you want to show in the post excerpts.",
            "id" => "portfolio_excerpt_length",
            "std" => "100",
            "fold" => "portfolio_show_description",
            "type" => "text");
        $of_options[] = array( "name" => "Show Custom Field",
            "desc" => "Show or hide custom field of post portfolio detail.",
            "id" => "portfolio_show_custom_field",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array( "name" => "Custom Field Icon",
            "desc" => "Please enter the class icon from http://fortawesome.github.io/Font-Awesome/icons/. Ex: fa fa-bookmark-o.",
            "id" => "portfolio_custom_field_icon",
            "std" => "fa fa-bookmark-o",
            "fold" => "portfolio_show_custom_field",
            "type" => "text");
        $of_options[] = array( "name" => "Custom Field Title",
            "desc" => "Please enter the title custom field of post portfolio detail.",
            "id" => "portfolio_custom_field_title",
            "std" => "Custom Field",
            "fold" => "portfolio_show_custom_field",
            "type" => "text");
        $of_options[] = array( "name" => "Show Date",
            "desc" => "Show or hide date of post portfolio detail.",
            "id" => "portfolio_show_date",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array( "name" => "Date Icon",
            "desc" => "Please enter the class icon from http://fortawesome.github.io/Font-Awesome/icons/. Ex: fa fa-clock-o.",
            "id" => "portfolio_date_icon",
            "std" => "fa fa-clock-o",
            "fold" => "portfolio_show_date",
            "type" => "text");
        $of_options[] = array( "name" => "Date Title",
            "desc" => "Please enter the title date of post portfolio detail.",
            "id" => "portfolio_date_title",
            "std" => "Date",
            "fold" => "portfolio_show_date",
            "type" => "text");
        $of_options[] = array( "name" => "Show Category",
            "desc" => "Show or hide category of post portfolio detail.",
            "id" => "portfolio_show_category",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array( "name" => "Category Icon",
            "desc" => "Please enter the class icon from http://fortawesome.github.io/Font-Awesome/icons/. Ex: fa fa-tags.",
            "id" => "portfolio_category_icon",
            "std" => "fa fa-tags",
            "fold" => "portfolio_show_category",
            "type" => "text");
        $of_options[] = array( "name" => "Category Title",
            "desc" => "Please enter the title category of post portfolio detail.",
            "id" => "portfolio_category_title",
            "std" => "Category",
            "fold" => "portfolio_show_category",
            "type" => "text");
        $of_options[] = array( "name" => "Show Likes",
            "desc" => "Show or hide Likes of post portfolio detail.",
            "id" => "portfolio_show_like",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array( "name" => "Like Icon",
            "desc" => "Please enter the class icon from http://fortawesome.github.io/Font-Awesome/icons/. Ex: fa fa-heart-o.",
            "id" => "portfolio_like_icon",
            "std" => "fa fa-heart-o",
            "fold" => "portfolio_show_like",
            "type" => "text");
        $of_options[] = array( "name" => "Likes Title",
            "desc" => "Please enter the title likes of post portfolio detail.",
            "id" => "portfolio_like_title",
            "std" => "Likes",
            "fold" => "portfolio_show_like",
            "type" => "text");
        $of_options[] = array( "name" => "Show Shares",
            "desc" => "Show or hide shares of post portfolio detail.",
            "id" => "portfolio_show_share",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array( "name" => "Shares Title",
            "desc" => "Please enter the title shares of post portfolio detail.",
            "id" => "portfolio_share_title",
            "std" => "Shares",
            "fold" => "portfolio_show_share",
            "type" => "text");
        $of_options[] = array("name" => "Carousel Options",
            "desc" => "",
            "id" => "portfolio_carousel_options",
            "std" => "<h3 style='margin: 0;'>Carousel Options</h3>",
            "icon" => true,
            "type" => "info");
        $of_options[] = array( "name" => "Title",
            "desc" => "Please enter title of carousel page portfolio detail.",
            "id" => "portfolio_cr_title",
            "std" => 'Similar Project',
            "type" => "text");
        $of_options[] = array( "name" => "Crop Images",
            "desc" => "Crop or Not image of carousel page portfolio detail.",
            "id" => "portfolio_cr_crop_image",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array( "name" => "Width Image",
            "desc" => "Please enter the width of the image.",
            "id" => "portfolio_cr_width_image",
            "std" => "300",
            "fold" => "portfolio_cr_crop_image",
            "type" => "text");
        $of_options[] = array( "name" => "Height Image",
            "desc" => "Please enter the height of the image.",
            "id" => "portfolio_cr_height_image",
            "std" => "200",
            "fold" => "portfolio_cr_crop_image",
            "type" => "text");
        $of_options[] = array( "name" => "Width Item",
            "desc" => "Please enter the width of the item.",
            "id" => "portfolio_cr_width_item",
            "std" => "150",
            "type" => "text");
        $of_options[] = array( "name" => "Margin Item",
            "desc" => "Please enter the margin of the item.",
            "id" => "portfolio_cr_margin_item",
            "std" => "20",
            "type" => "text");
        $of_options[] = array( "name" => "Auto scroll",
            "desc" => "Auto or Not scroll of carousel page portfolio detail.",
            "id" => "portfolio_cr_auto_scroll",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array( "name" => "Post per page",
            "desc" => "Please enter number the post per page of carousel page portfolio detail.",
            "id" => "portfolio_cr_post_per_page",
            "std" => "12",
            "type" => "text");
// begin Restaurant Menu
        $of_options[] = array("name" => "Restaurant Menu",
            "type" => "heading"
        );
        $of_options[] = array( "name" => "Price Items",
            "desc" => "Set default price for all menu.",
            "id" => "restaurant_menu_price",
            "std" => "$",
            "type" => "text");
        $of_options[] = array( "name" => "Price Before or After",
            "desc" => "(On = $ Price) or (Off = Price $).",
            "id" => "restaurant_menu_price_position",
            "std" => 1,
            "on" => "Before",
            "off" => "After",
            "type" => "switch");
// begin 404
        $of_options[] = array("name" => "404 Page",
            "type" => "heading"
        );
        $of_options[] = array( "name" => "Show Heading",
            "desc" => "Show heading for 404",
            "id" => "404_heading",
            "std" => 0,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array( "name" => "Show Page Title",
            "desc" => "Show page title on page 404",
            "id" => "404_page_title",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array( "name" => "Page Title Animation",
            "desc" => "Fade out page title on scroll",
            "id" => "404_page_title_animation",
            "std" => 0,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array( "name" => "Show Breadcrumbs",
            "desc" => "Show Breadcrumbs on page 404",
            "id" => "404_breadcrumbs",
            "std" => 1,
            "on" => "Yes",
            "off" => "No",
            "type" => "switch");
        $of_options[] = array("name" => "404 Page",
            "desc" => "",
            "id" => "404_type",
            "std" => "",
            "type" => "select",
            "options" => array('Default'=>'Default','From Page'=>'From Page','Redirect Home'=>'Redirect Home')
        );
        $of_options[] = array("name" => "404 Image",
            "desc" => "Select an image file for your 404 (for default 404).",
            "id" => "404_image",
            "std" => get_template_directory_uri() . "/images/404/spman.jpg",
            "type" => "media");
        $of_options[] = array( "name" => "Page ID",
            "desc" => "Insert page 404 id (for 404 from page).",
            "id" => "404_page_id",
            "std" => "",
            "type" => "text");
        // begin custom css
        $of_options[] = array("name" => "Custom CSS",
            "type" => "heading"
        );
        $of_options[] = array("name" => "Custom CSS",
            "desc" => "Quickly add some CSS to your theme by adding it to this block.",
            "id" => "custom_css",
            "std" => "",
            "type" => "textarea"
        );
        // end custom css
// Backup Options
        $of_options[] = array("name" => "Backup Options",
            "type" => "heading",
            "icon" => ADMIN_IMAGES . "icon-slider.png"
        );

        $of_options[] = array("name" => "Backup and Restore Options",
            "id" => "of_backup",
            "std" => "",
            "type" => "backup",
            "desc" => 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
        );

        $of_options[] = array("name" => "Transfer Theme Options Data",
            "id" => "of_transfer",
            "std" => "",
            "type" => "transfer",
            "desc" => 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".',
        );

    }
    //End function: of_options()
}//End chack if function exists: of_options()
?>