<?php
$target_arr = array(__("Same window", "js_composer") => "_self", __("New window", "js_composer") => "_blank");
$align_arr  = array(__('Align center', "js_composer") => "align_center", __('Align left', "js_composer") => "align_left", __('Align right', "js_composer") => "align_right");
$align_arr_v2  = array( __('Align left', "js_composer") => "left", __('Align center', "js_composer") => "center", __('Align right', "js_composer") => "right");
$add_css_animation = array(
    "type" => "dropdown",
    "heading" => __("CSS Animation", "js_composer"),
    "param_name" => "css_animation",
    "admin_label" => true,
    "value" => array(__("No", "js_composer") => '', __("Top to bottom", "js_composer") => "top-to-bottom", __("Bottom to top", "js_composer") => "bottom-to-top", __("Left to right", "js_composer") => "left-to-right", __("Right to left", "js_composer") => "right-to-left", __("Appear from center", "js_composer") => "appear"),
    "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", "js_composer")
);

function a13_get_image_sizes_for_builder() {
    global $_wp_additional_image_sizes;

    $sizes = array();

    foreach ( get_intermediate_image_sizes() as $size ) {
        $temp = array();

        //width
        if ( isset( $_wp_additional_image_sizes[$size]['width'] ) ){
            $temp['width'] = intval( $_wp_additional_image_sizes[$size]['width'] );
        }
        else{
            $temp['width'] = get_option( "{$size}_size_w" );
        }
        $temp['width'] = intval($temp['width']) === 0? 'auto' : $temp['width'];

        //height
        if ( isset( $_wp_additional_image_sizes[$size]['height'] ) ){
            $temp['height'] = intval( $_wp_additional_image_sizes[$size]['height'] );
        }
        else{
            $temp['height'] = get_option( "{$size}_size_h" );
        }
        $temp['height'] = intval($temp['height']) === 0? 'auto' : $temp['height'];

        //crop
        if ( isset( $_wp_additional_image_sizes[$size]['crop'] ) ){
            $temp['crop'] = intval( $_wp_additional_image_sizes[$size]['crop'] );
        }
        else{
            $temp['crop'] = get_option( "{$size}_crop" );
        }

//        $sizes[$size] = $size.'('.$temp['width'].'x'.$temp['height'].($temp['crop']? ' cropped' : '').')';
        $sizes[$size.' ('.$temp['width'].'x'.$temp['height'].($temp['crop']? ' cropped' : '').')'] = $size;
    }

    $sizes['full'] = 'full';

    return $sizes;
}


/* REMOVE WP WIDGETS FROM BUILDER
---------------------------------------------------------- */
vc_remove_element("vc_wp_search");
vc_remove_element("vc_wp_meta");
vc_remove_element("vc_wp_recentcomments");
vc_remove_element("vc_wp_calendar");
vc_remove_element("vc_wp_pages");
vc_remove_element("vc_wp_tagcloud");
vc_remove_element("vc_wp_custommenu");
vc_remove_element("vc_wp_text");
vc_remove_element("vc_wp_posts");
vc_remove_element("vc_wp_links");
vc_remove_element("vc_wp_categories");
vc_remove_element("vc_wp_archives");
vc_remove_element("vc_wp_rss");

/* REMOVE OLD BUILDER ELEMENTS
---------------------------------------------------------- */
vc_remove_element("vc_cta_button");
vc_remove_element("vc_button");


/* REMOVE SHITTY CAROUSEL FROM BUILDER
---------------------------------------------------------- */
vc_remove_element("vc_images_carousel");



/* VC ROW EXTENSION
---------------------------------------------------------- */
//remove useless in the end "design options"
vc_remove_param("vc_row", 'css');
/* new from VC 4.6 - we remove it as it conflicts with what we already have in theme */
vc_remove_param("vc_row", 'full_width');
vc_remove_param("vc_row", 'full_height');
vc_remove_param("vc_row", 'content_placement');
vc_remove_param("vc_row", 'video_bg');
vc_remove_param("vc_row", 'video_bg_url');
vc_remove_param("vc_row", 'video_bg_parallax');
vc_remove_param("vc_row", 'parallax');
vc_remove_param("vc_row", 'parallax_image');

//Full width
vc_add_param("vc_row", array(
    "type" => "checkbox",
    "heading" =>  a13__be("Full width?"),
    "param_name" => "full_width",
    "value" => Array(__("Yes, please", "js_composer") => true),
));

//Full width content
vc_add_param("vc_row", array(
    "type" => "checkbox",
    "heading" =>  a13__be("Full width content?"),
    "param_name" => "full_width_content",
    "value" => Array(__("Yes, please", "js_composer") => true),
    "dependency" => array(
        "element" => "full_width",
        'not_empty' => true,
    )
));

//background color
vc_add_param("vc_row", array(
    "type" => "colorpicker",
    "heading" =>  a13__be("Background color"),
    "param_name" => "bg_color",
    "description" =>  a13__be("Select background color for your row."),
    "value" => "",
));

//background image
vc_add_param("vc_row", array(
    "type" => "attach_image",
    "heading" =>  a13__be("Background image"),
    "param_name" => "bg_image",
    "description" =>  a13__be("Select background image for your row")
));

//background position
vc_add_param("vc_row", array(
    "type" => "dropdown",
    "heading" =>  a13__be("Background position"),
    "param_name" => "bg_position",
    "value" => array(
         a13__be("Top left")        => "tl",
         a13__be("Top center")      => "tc",
         a13__be("Top right")       => "tr",
         a13__be("Middle left")     => "cl",
         a13__be("Middle center")   => "cc",
         a13__be("Middle right")    => "cr",
         a13__be("Bottom left")     => "bl",
         a13__be("Bottom center")   => "bc",
         a13__be("Bottom right")    => "br",
    ),
    "dependency" => array(
        "element" => "bg_image",
        "not_empty" => true
    )
));

//background repeat
vc_add_param("vc_row", array(
    "type" => "dropdown",
    "heading" =>  a13__be("Background repeat"),
    "param_name" => "bg_repeat",
    "value" => array(
         a13__be("No repeat")           => "no-repeat",
         a13__be("Repeat in both axes") => "repeat",
         a13__be("Repeat X axe")        => "repeat-x",
         a13__be("Repeat Y axe")        => "repeat-y"
    ),
    "dependency" => array(
        "element" => "bg_image",
        "not_empty" => true
    )
));

//background cover
vc_add_param("vc_row", array(
    "type" => "checkbox",
    "heading" =>  a13__be("Cover background with image?"),
    "param_name" => "bg_cover",
    "value" => Array(__("Yes, please", "js_composer") => true),
    "description" =>  a13__be("This is good if you use single not repeated image for background. If you want to use repeated pattern then uncheck this."),
    "dependency" => array(
        "element" => "bg_image",
        "not_empty" => true
    )
));

//Parallax
vc_add_param("vc_row", array(
    "type" => "checkbox",
    "heading" =>  a13__be("Enable parallax?"),
    "param_name" => "parallax",
    "value" => Array(__("Yes, please", "js_composer") => true),
    "dependency" => array(
        "element" => "bg_image",
        "not_empty" => true
    ),
));

//Parallax type
vc_add_param("vc_row", array(
    "type" => "dropdown",
    "heading" =>  a13__be("Parallax type"),
    "param_name" => "parallax_type",
    "description" =>  a13__be("It defines how image will scroll in background while page is scrolled down."),
    "value" => array(
         a13__be("top to bottom")               => "tb",
         a13__be("bottom to top")               => "bt",
         a13__be("left to right")               => "lr",
         a13__be("right to left")               => "rl",
         a13__be("top-left to bottom-right")    => "tlbr",
         a13__be("top-right to bottom-left")    => "trbl",
         a13__be("bottom-left to top-right")    => "bltr",
         a13__be("bottom-right to top-left")    => "brtl",
    ),
    "dependency" => array(
        "element" => "parallax",
        "not_empty" => true
    ),
));

//Parallax speed
vc_add_param("vc_row", array(
    "type" => "textfield",
    "heading" =>  a13__be("Parallax speed"),
    "param_name" => "parallax_speed",
    "value" => "1",
    "description" =>  a13__be("You can insert here floats like 0.65,2.34, etc. It will be only used for background that are repeated. If background is set to not repeat this value will be ignored."),
    "dependency" => array(
        "element" => "parallax",
        "not_empty" => true
    ),
));


//padding top bottom
vc_add_param("vc_row", array(
    "type" => "textfield",
    "heading" =>  a13__be("Padding"),
    "param_name" => "padding",
    "value" => "",
    "description" =>  a13__be("It will add padding in top and bottom. Value in pixels."),
));

//padding left right
vc_add_param("vc_row", array(
    "type" => "textfield",
    "heading" =>  a13__be("Side padding"),
    "param_name" => "side_padding",
    "value" => "",
    "description" =>  a13__be("It will add padding in left and right. Value in pixels."),
));

//bottom margin
vc_add_param("vc_row", array(
    "type" => "textfield",
    "heading" =>  a13__be('Bottom margin'),
    "param_name" => "margin_bottom",
    "value" => "",
    "description" =>  a13__be("Value in pixels."),
));


//add css animation
vc_add_param("vc_row", $add_css_animation);

//move extra class to end of params
$param = WPBMap::getParam('vc_row', 'el_class');
vc_remove_param('vc_row', 'el_class');
vc_add_param('vc_row', $param);


// video background group
vc_add_param("vc_row", array(
    "type" => "textfield",
    "class" => "",
    "heading" =>  a13__be("Video background in mp4 format"),
    "param_name" => "bg_video_mp4",
    "value" => "",
    "description" =>  a13__be("Enter here link to file"),
    'group' =>  a13__be( 'Video background' )
));
vc_add_param("vc_row", array(
    "type" => "textfield",
    "class" => "",
    "heading" =>  a13__be("Video background in ogv format"),
    "param_name" => "bg_video_ogv",
    "value" => "",
    "description" =>  a13__be("Enter here link to file"),
    'group' =>  a13__be( 'Video background' )
));
vc_add_param("vc_row", array(
    "type" => "textfield",
    "class" => "",
    "heading" =>  a13__be("Video background in webm format"),
    "param_name" => "bg_video_webm",
    "value" => "",
    "description" =>  a13__be("Enter here link to file"),
    'group' =>  a13__be( 'Video background' )
));


$overlays = array('none' => "" );
$dir = A13_TPL_GFX_DIR.'/video_overlays';
if( is_dir( $dir ) ) {
    //The GLOB_BRACE flag is not available on some non GNU systems, like Solaris. So we use merge:-)
    foreach ( (array)glob($dir.'/*.png') as $file ){
        $overlays[ basename($file) ] = A13_TPL_GFX.'/video_overlays/'.basename($file);
    }
}
vc_add_param("vc_row", array(
    "type" => "dropdown",
    "heading" =>  a13__be("Video overlay"),
    "param_name" => "bg_video_overlay",
    "description" =>  a13__be("It will be displayed above video, but below content layer."),
    "value" => $overlays,
    'group' =>  a13__be( 'Video background' )
));
vc_add_param("vc_row", array(
    "type" => "dropdown",
    "heading" =>  a13__be("Video position"),
    "param_name" => "bg_video_position",
    "value" => array(
         a13__be("top")        => "top",
         a13__be("bottom")     => "bottom",
    ),
    'group' =>  a13__be( 'Video background' )
));

vc_add_param("vc_row", array(
    "type" => "dropdown",
    "heading" =>  a13__be("Video parallax"),
    "param_name" => "bg_video_parallax",
    "value" => array(
         a13__be("none")            => "none",
         a13__be("top to bottom")   => "tb",
         a13__be("bottom to top")   => "bt",
    ),
    "description" =>  a13__be("It defines how video will scroll in background while page is scrolled down. If set to any other option than none, then video position is ignored."),
    'group' =>  a13__be( 'Video background' )
));




/* Inner row
---------------------------------------------------------- */
//add css animation
vc_add_param("vc_row_inner", $add_css_animation);

//move extra class to end of params
$param = WPBMap::getParam('vc_row_inner', 'el_class');
vc_remove_param('vc_row_inner', 'el_class');
vc_add_param('vc_row_inner', $param);

//move design options to end
$param = WPBMap::getParam('vc_row_inner', 'css');
vc_remove_param("vc_row_inner", 'css');
vc_add_param('vc_row_inner', $param);



/* Recent post/work/gallery
---------------------------------------------------------- */

/* add work and gallery to list "post_type" list */
$param = WPBMap::getParam('vc_masonry_grid', 'post_type');
$param['value'][] = array( A13_CUSTOM_POST_TYPE_WORK_SLUG, 'Work' );
$param['value'][] = array( A13_CUSTOM_POST_TYPE_GALLERY_SLUG, 'Gallery' );
WPBMap::mutateParam('vc_masonry_grid', $param);
WPBMap::mutateParam('vc_basic_grid', $param);



/* add work and gallery taxonomies for filtering */
$param = WPBMap::getParam('vc_masonry_grid', 'taxonomies');

$temp = get_taxonomies( array( 'public' => true, 'name' => A13_CPT_WORK_TAXONOMY), 'objects' );
$vc_taxonomies_types[A13_CPT_WORK_TAXONOMY] = $temp[A13_CPT_WORK_TAXONOMY];
$temp = get_taxonomies( array( 'public' => true, 'name' => A13_CPT_GALLERY_TAXONOMY), 'objects' );
$vc_taxonomies_types[A13_CPT_GALLERY_TAXONOMY] = $temp[A13_CPT_GALLERY_TAXONOMY];
$vc_taxonomies = get_terms( array_keys( $vc_taxonomies_types ), array( 'hide_empty' => false ) );

if ( is_array( $vc_taxonomies ) && ! empty( $vc_taxonomies ) ) {
	foreach ( $vc_taxonomies as $t ) {
		if ( is_object( $t ) ) {
			$param['settings']['values'][] = array(
				'label' => $t->name,
				'value' => $t->term_id,
				'group_id' => $t->taxonomy,
				'group' =>
					isset( $vc_taxonomies_types[ $t->taxonomy ], $vc_taxonomies_types[ $t->taxonomy ]->labels, $vc_taxonomies_types[ $t->taxonomy ]->labels->name )
						? $vc_taxonomies_types[ $t->taxonomy ]->labels->name
						: __( 'Taxonomies', 'js_composer' )
			);
		}
	}
}
WPBMap::mutateParam('vc_masonry_grid', $param);
WPBMap::mutateParam('vc_basic_grid', $param);


$copy_param = WPBMap::getParam('vc_masonry_grid', 'exclude_filter');
//checks if we have any values to overwrite
if(isset($copy_param['settings']['values']) && isset($param['settings']['values'])){
    $copy_param['settings']['values'] = $param['settings']['values'];
    WPBMap::mutateParam('vc_masonry_grid', $copy_param);
    WPBMap::mutateParam('vc_basic_grid', $copy_param);
}



$param = WPBMap::getParam('vc_masonry_grid', 'filter_source');
$taxonomies_for_filter = array();
if ( is_array( $vc_taxonomies_types ) && ! empty( $vc_taxonomies_types ) ) {
	foreach ( $vc_taxonomies_types as $t => $data ) {
		if ( $t !== 'post_format' && is_object( $data ) ) {
			$param['value'][ $data->labels->name ] = $t;
		}
	}
}
WPBMap::mutateParam('vc_masonry_grid', $param);
WPBMap::mutateParam('vc_basic_grid', $param);



/* Column icon
---------------------------------------------------------- */
vc_add_param("vc_column",array(
    "type" => "textfield",
    "heading" => __("Icon", "js_composer"),
    "param_name" => "a13_fa_icon",
    "value" => '',
    "description" =>  a13__be('Select icon by clicking on input.'),
    "admin_label" => true,
));
vc_add_param("vc_column", array(
    "type" => "colorpicker",
    "heading" =>  a13__be("Icon color"),
    "param_name" => "icon_color",
    "description" =>  a13__be("Select custom icon color."),
));
vc_add_param("vc_column", array(
    "type" => "dropdown",
    "heading" =>  a13__be("Icon position"),
    "param_name" => "icon_position",
    "value" => array(
         a13__be("left")   => "left",
         a13__be("right")   => "right",
    ),
));

vc_add_param("vc_column_inner",array(
    "type" => "textfield",
    "heading" => __("Icon", "js_composer"),
    "param_name" => "a13_fa_icon",
    "value" => '',
    "description" =>  a13__be('Select icon by clicking on input.'),
    "admin_label" => true,
));
vc_add_param("vc_column_inner", array(
    "type" => "colorpicker",
    "heading" =>  a13__be("Icon color"),
    "param_name" => "icon_color",
    "description" =>  a13__be("Select custom icon color."),
));
vc_add_param("vc_column_inner", array(
    "type" => "dropdown",
    "heading" =>  a13__be("Icon position"),
    "param_name" => "icon_position",
    "value" => array(
         a13__be("left")   => "left",
         a13__be("right")   => "right",
    ),
));

//move extra class to end of params
$param = WPBMap::getParam('vc_column', 'el_class');
vc_remove_param('vc_column', 'el_class');
vc_add_param('vc_column', $param);

//move design options to end
$param = WPBMap::getParam('vc_column', 'css');
vc_remove_param("vc_column", 'css');
vc_add_param('vc_column', $param);

//move extra class to end of params
$param = WPBMap::getParam('vc_column_inner', 'el_class');
vc_remove_param('vc_column_inner', 'el_class');
vc_add_param('vc_column_inner', $param);

//move design options to end
$param = WPBMap::getParam('vc_column_inner', 'css');
vc_remove_param("vc_column_inner", 'css');
vc_add_param('vc_column_inner', $param);


/* Separator
---------------------------------------------------------- */
//show settings on create
vc_map_update('vc_separator', array("show_settings_on_create" => true));

//add line top margin
vc_add_param("vc_separator", array(
    "type" => "textfield",
    "heading" =>  a13__be("Margin top"),
    "param_name" => "margin_top",
    "value" => "",
    "description" =>  a13__be("It will add margin in top. Type number. Value in pixels."),
));

//add line bottom margin
vc_add_param("vc_separator", array(
    "type" => "textfield",
    "heading" =>  a13__be("Margin bottom"),
    "param_name" => "margin_bottom",
    "value" => "",
    "description" =>  a13__be("It will add margin at bottom. Type number. Value in pixels."),
));

//add empty line type(style)
$param = WPBMap::getParam('vc_separator', 'style');
$param['value']['Border'] = 'border'; //fix empty value of this style
$param['value'] = array_merge(array( a13__be("Empty Line") => 'empty'), $param['value']);//put it on top
WPBMap::mutateParam('vc_separator', $param);

//move extra class to end of params
$param = WPBMap::getParam('vc_separator', 'el_class');
vc_remove_param('vc_separator', 'el_class');
vc_add_param('vc_separator', $param);





/* Separator with text
---------------------------------------------------------- */
//add bold font
vc_add_param("vc_text_separator", array(
    "type" => 'checkbox',
    "heading" =>  a13__be("Bold?"),
    "param_name" => "bold",
    "value" => Array(__("Yes, please", "js_composer") => true)
));

//add uppercase
vc_add_param("vc_text_separator", array(
    "type" => 'checkbox',
    "heading" =>  a13__be("Uppercase?"),
    "param_name" => "uppercase",
    "value" => Array(__("Yes, please", "js_composer") => true)
));

//add font size
vc_add_param("vc_text_separator", array(
    "type" => "textfield",
    "heading" =>  a13__be("Font size"),
    "param_name" => "font_size",
    "value" => "",
    "description" =>  a13__be("Type number. Value in pixels."),
));

//text color
vc_add_param("vc_text_separator", array(
    "type" => "colorpicker",
    "heading" =>  a13__be("Title color"),
    "param_name" => "text_color",
    "description" =>  a13__be("Select custom text color."),
));

//icon
vc_add_param("vc_text_separator", array(
    "type" => "textfield",
    "heading" => __("Icon", "js_composer"),
    "param_name" => "a13_fa_icon",
    "value" => '',
    "description" =>  a13__be('Select icon by clicking on input. It will be displayed at beginning of text.'),
));

//add line top margin
vc_add_param("vc_text_separator", array(
    "type" => "textfield",
    "heading" =>  a13__be("Margin top"),
    "param_name" => "margin_top",
    "value" => "",
    "description" =>  a13__be("It will add margin in top. Type number. Value in pixels."),
));

//add line bottom margin
vc_add_param("vc_text_separator", array(
    "type" => "textfield",
    "heading" =>  a13__be("Margin bottom"),
    "param_name" => "margin_bottom",
    "value" => "",
    "description" =>  a13__be("It will add margin at bottom. Type number. Value in pixels."),
));

//add empty line type(style)
$param = WPBMap::getParam('vc_text_separator', 'style');
$param['value'] = array_merge($param['value'], array( a13__be("Empty Line") => 'empty'));
WPBMap::mutateParam('vc_text_separator', $param);

//move extra class to end of params
$param = WPBMap::getParam('vc_text_separator', 'el_class');
vc_remove_param('vc_text_separator', 'el_class');
vc_add_param('vc_text_separator', $param);

//remove default title that is added when filed is left empty
$param = WPBMap::getParam('vc_text_separator', 'title');
$param['value'] = '';
WPBMap::mutateParam('vc_text_separator', $param);




/* Button 2
---------------------------------------------------------- */
//icon
vc_add_param("vc_button2", array(
    "type" => "textfield",
    "heading" => __("Icon", "js_composer"),
    "param_name" => "a13_fa_icon",
    "value" => '',
    "description" =>  a13__be('Select icon by clicking on input.'),
));

//add bold font
vc_add_param("vc_button2", array(
    "type" => 'checkbox',
    "heading" =>  a13__be("Bold?"),
    "param_name" => "bold",
    "value" => Array(__("Yes, please", "js_composer") => true)
));

//add uppercase
vc_add_param("vc_button2", array(
    "type" => 'checkbox',
    "heading" =>  a13__be("Uppercase?"),
    "param_name" => "uppercase",
    "value" => Array(__("Yes, please", "js_composer") => true)
));

//add button position
vc_add_param("vc_button2", array(
    "type" => "dropdown",
    "heading" =>  a13__be("Button position"),
    "param_name" => "position",
    "value" => $align_arr_v2,
    "description" => ''
));

//move extra class to end of params
$param = WPBMap::getParam('vc_button2', 'el_class');
vc_remove_param('vc_button2', 'el_class');
vc_add_param('vc_button2', $param);



/* Post grid enhancements
---------------------------------------------------------- */
//add better image size selector
$dropdown_image_sizes = array(
    "type" => "dropdown",
    "heading" => __("Thumbnail size", "js_composer"),
    "param_name" => "grid_thumb_size",
    "value" => a13_get_image_sizes_for_builder(),
);
WPBMap::mutateParam("vc_posts_grid", $dropdown_image_sizes);
//below shortcodes use other name
$dropdown_image_sizes['param_name'] = 'thumb_size';
WPBMap::mutateParam("vc_carousel", $dropdown_image_sizes);
WPBMap::mutateParam("vc_posts_slider", $dropdown_image_sizes);

//mutate "Teaser layout" option
$param = WPBMap::getParam('vc_posts_grid', 'grid_layout');
unset($param['options'][3]); //remove link read more from options
//add post meta
WPBMap::mutateParam('vc_posts_grid', $param);
//below shortcodes use other name
$param['param_name'] = 'layout';
WPBMap::mutateParam('vc_carousel', $param);





/* Hello text
---------------------------------------------------------- */
vc_map( array(
    "name" =>  a13__be("Hello text"),
    "base" => "a13_hellotext",
    "icon" => "icon-a13_hellotext",
    "category" => __('Content', 'js_composer'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Title", "js_composer"),
            "param_name" => "upper_text",
            "holder" => "div",
            "value" => __("Title", "js_composer"),
            "description" => __("Title", "js_composer")
        ),
        array(
            "type" => "textfield",
            "heading" =>  a13__be("Subtitle"),
            "param_name" => "lower_text",
            "holder" => "div",
            "value" =>  a13__be("Subtitle"),
            "description" =>  a13__be("Subtitle"),
        ),
        array(
            "type" => "dropdown",
            "heading" =>  a13__be("Texts position"),
            "param_name" => "title_align",
            "value" => $align_arr,
            "description" => '',
            "admin_label" => true,
        ),
        array(
            "type" => "dropdown",
            "heading" =>  a13__be("Texts size"),
            "param_name" => "title_size",
            "value" => array( a13__be('Big') => "size_big",  a13__be('Medium') => "size_medium",  a13__be('Small') => "size_small"),
            "description" => '',
            "admin_label" => true,
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "js_composer"),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
        )
    ),
) );



/* Title with color
---------------------------------------------------------- */
vc_map( array(
    "name" =>  a13__be("Title with color"),
    "base" => "a13_title_with_color",
    "icon" => "icon-wpb-layer-shape-text",
    "category" => __('Content', 'js_composer'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Title", "js_composer"),
            "param_name" => "title",
            "holder" => "div",
            "value" => __("Title", "js_composer"),
            "description" => ''
        ),
        array(
            "type" => "dropdown",
            "heading" =>  a13__be("Title size"),
            "param_name" => "title_size",
            "value" => array(
                'h1' => 'h1',
                'h2' => 'h2',
                'h3' => 'h3',
                'h4' => 'h4',
                'h5' => 'h5',
                'h6' => 'h6',
            ),
            "description" =>  a13__be("Select size"),
        ),
        array(
            "type" => 'checkbox',
            "heading" =>  a13__be("Bold?"),
            "param_name" => "bold",
            "value" => Array(__("Yes, please", "js_composer") => true)
        ),
        array(
            "type" => 'checkbox',
            "heading" =>  a13__be("Uppercase?"),
            "param_name" => "uppercase",
            "value" => Array(__("Yes, please", "js_composer") => true)
        ),
        array(
            "type" => "colorpicker",
            "heading" =>  a13__be("Title color"),
            "param_name" => "text_color",
            "description" =>  a13__be("Select custom text color."),
        ),
        array(
            "type" => "colorpicker",
            "heading" =>  a13__be("Title background color"),
            "param_name" => "bg_color",
            "description" =>  a13__be("Select custom background color"),
        ),
        array(
            "type" => "dropdown",
            "heading" =>  a13__be("Text position"),
            "param_name" => "title_align",
            "value" => $align_arr,
            "description" => '',
            "admin_label" => true,
        ),
    ),
) );



/* Title with icon
---------------------------------------------------------- */

vc_map( array(
    "name" =>  a13__be("Title with icon"),
    "base" => "a13_title_with_icon",
    "icon" => "icon-a13_title_with_icon",
    "category" => __('Content', 'js_composer'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Title", "js_composer"),
            "param_name" => "title",
            "holder" => "div",
            "value" => __("Title", "js_composer"),
        ),
	    array(
		    'type' => 'href',
		    'heading' => a13__be( 'URL (Link)' ),
		    'param_name' => 'href',
		    'description' => ''
	    ),
        array(
            "type" => "dropdown",
            "heading" =>  a13__be("Title size"),
            "param_name" => "title_size",
            "value" => array(
                'h1' => 'h1',
                'h2' => 'h2',
                'h3' => 'h3',
                'h4' => 'h4',
                'h5' => 'h5',
                'h6' => 'h6',
            ),
            "description" =>  a13__be("Select size"),
        ),
        array(
            "type" => 'checkbox',
            "heading" =>  a13__be("Bold?"),
            "param_name" => "bold",
            "value" => Array(__("Yes, please", "js_composer") => true)
        ),
        array(
            "type" => 'checkbox',
            "heading" =>  a13__be("Uppercase?"),
            "param_name" => "uppercase",
            "value" => Array(__("Yes, please", "js_composer") => true)
        ),
        array(
            "type" => "colorpicker",
            "heading" =>  a13__be("Title color"),
            "param_name" => "text_color",
            "description" =>  a13__be("Select custom text color."),
        ),
        array(
            "type" => "textfield",
            "heading" => __("Icon", "js_composer"),
            "param_name" => "a13_fa_icon",
            "value" => '',
            "description" =>  a13__be('Select icon by clicking on input.'),
        ),
        array(
            "type" => "dropdown",
            "heading" =>  a13__be("Icon color"),
            "param_name" => "icon_color",
            "value" => getVcShared("colors"),
            "description" => '',
            "param_holder_class" => 'vc-colored-dropdown'
        ),
	    array(
		    "type" => 'checkbox',
		    "heading" =>  a13__be("Deactivate hover?"),
		    "param_name" => "hover_off",
		    "value" => Array(__("Yes, please", "js_composer") => true)
	    ),
        array(
            "type" => "dropdown",
            "heading" =>  a13__be("Text position"),
            "param_name" => "title_align",
            "value" => $align_arr_v2,
            "description" => '',
            "admin_label" => true,
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "js_composer"),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
        )
    ),
) );



/* Big icon
---------------------------------------------------------- */

vc_map( array(
    "name" =>  a13__be("Big icon"),
    "base" => "a13_big_icon",
    "icon" => "icon-a13_big_icon",
    "category" => __('Content', 'js_composer'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Icon", "js_composer"),
            "param_name" => "a13_fa_icon",
            "value" => '',
            "description" =>  a13__be('Select icon by clicking on input.'),
            "admin_label" => true,
        ),
	    array(
		    'type' => 'href',
		    'heading' => a13__be( 'URL (Link)' ),
		    'param_name' => 'href',
		    'description' => ''
	    ),
        array(
            "type" => "dropdown",
            "heading" =>  a13__be("Icon color"),
            "param_name" => "icon_color",
            "value" => getVcShared("colors"),
            "description" => '',
            "param_holder_class" => 'vc-colored-dropdown'
        ),
        array(
            "type" => "dropdown",
            "heading" =>  a13__be("Icon position"),
            "param_name" => "icon_align",
            "value" => $align_arr_v2,
            "description" => '',
            "admin_label" => true,
        ),
	    array(
		    "type" => 'checkbox',
		    "heading" =>  a13__be("Deactivate hover?"),
		    "param_name" => "hover_off",
		    "value" => Array(__("Yes, please", "js_composer") => true)
	    ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "js_composer"),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
        )
    ),
) );



/* Counter
---------------------------------------------------------- */

vc_map( array(
    "name" =>  a13__be("Counter"),
    "base" => "a13_counter",
    "icon" => "icon-a13_counter",
    "category" => __('Content', 'js_composer'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" =>  a13__be("Count from"),
            "param_name" => "from",
            "value" => '',
            "description" =>  a13__be("Starting value of counter."),
            "admin_label" => true,
        ),
        array(
            "type" => "textfield",
            "heading" =>  a13__be("Count to"),
            "param_name" => "to",
            "value" => '',
            "description" =>  a13__be("Finish value of counter."),
            "admin_label" => true,
        ),
        array(
            "type" => "textfield",
            "heading" =>  a13__be("Duration(ms)"),
            "param_name" => "speed",
            "value" => '3000',
            "description" =>  a13__be("How long it should take to count to end value. Eneter value in milliseconds."),
        ),
        array(
            "type" => "textfield",
            "heading" =>  a13__be("Refreshing time(ms)"),
            "param_name" => "refresh_interval",
            "value" => '100',
            "description" =>  a13__be("The number of milliseconds to wait between refreshing the counter."),
        ),
        array(
            "type" => "textfield",
            "heading" =>  a13__be("Finish text"),
            "param_name" => "finish_text",
            "value" => '',
            "description" =>  a13__be("This text will be displayed when counter will end counting. Optional."),
            "admin_label" => true,
        ),
        array(
            "type" => "textfield",
            "heading" =>  a13__be("Counter font size"),
            "param_name" => "font_size",
            "value" => "",
            "description" =>  a13__be("Type number. Value in pixels."),
        ),
        array(
            "type" => 'checkbox',
            "heading" =>  a13__be("Bold?"),
            "param_name" => "bold",
            "value" => Array(__("Yes, please", "js_composer") => true)
        ),
        array(
            "type" => 'checkbox',
            "heading" =>  a13__be("Uppercase?"),
            "param_name" => "uppercase",
            "value" => Array(__("Yes, please", "js_composer") => true)
        ),
        array(
            "type" => "colorpicker",
            "heading" =>  a13__be("Text color"),
            "param_name" => "text_color",
            "description" =>  a13__be("Select custom text color."),
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "js_composer"),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
        )
    ),
) );




/* Testimonials by WooThemes
---------------------------------------------------------- */
if (is_plugin_active('testimonials-by-woothemes/woothemes-testimonials.php')) {
    vc_map( array(
        "name" => __("Testimonials", "js_composer"),
        "base" => "woothemes_testimonials",
        "icon" => "icon-testimonials",
        "category" => __('Content', 'js_composer'),
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => __("Title", "js_composer"),
                "param_name" => "title",
                "value" => '',
                "description" =>  a13__be("an optional title")
            ),
            array(
                "type" => "textfield",
                "heading" =>  a13__be("Limit"),
                "param_name" => "limit",
                "value" => 5,
                "description" =>  a13__be("the maximum number of items to display"),
                "admin_label" => true,
            ),
            array(
                "type" => "dropdown",
                "heading" =>  a13__be("Per row"),
                "param_name" => "per_row",
                "value" => array(1,2,3),
                "description" =>  a13__be("when creating rows, how many items display in a single row?"),
                "admin_label" => true,
            ),
            array(
                "type" => "dropdown",
                "heading" =>  a13__be("Order by"),
                "param_name" => "orderby",
                "value" => array(
                     a13__be("Menu order") => 'menu_order',
                     a13__be("ID") => 'ID',
                     a13__be("title") => 'title',
                     a13__be("date") => 'date',
                     a13__be("none") => 'none',
                ),
                "description" =>  a13__be("how to order the items - accepts all default WordPress ordering options")
            ),
            array(
                "type" => "dropdown",
                "heading" =>  a13__be("Order"),
                "param_name" => "order",
                "value" => array(
                     a13__be("descending") => 'DESC',
                     a13__be("ascending") => 'ASC',
                ),
                "description" =>  a13__be("the order direction")
            ),
            array(
                "type" => "dropdown",
                "heading" =>  a13__be("Display author"),
                "param_name" => "display_author",
                "value" => array(
                     a13__be("True") => 'true',
                     a13__be("False") => 'false',
                ),
                "description" =>  a13__be("whether or not to display the author information")
            ),
            array(
                "type" => "dropdown",
                "heading" =>  a13__be("Display avatar"),
                "param_name" => "display_avatar",
                "value" => array(
                     a13__be("True") => 'true',
                     a13__be("False") => 'false',
                ),
                "description" =>  a13__be("whether or not to display the author avatar")
            ),
            array(
                "type" => "dropdown",
                "heading" =>  a13__be("Display URL"),
                "param_name" => "display_url",
                "value" => array(
                     a13__be("True") => 'true',
                     a13__be("False") => 'false',
                ),
                "description" =>  a13__be("whether or not to display the URL information")
            ),
            array(
                "type" => "textfield",
                "heading" =>  a13__be("ID"),
                "param_name" => "id",
                "value" => '0',
                "description" =>  a13__be("display a specific item")
            ),
            array(
                "type" => "textfield",
                "heading" =>  a13__be("Category"),
                "param_name" => "category",
                "value" => '0',
                "description" =>  a13__be("the ID/slug of the category to filter by")
            ),
        ),
    ) );
}


/* Pricing tables via Go - Responsive Pricing & Compare Tables
---------------------------------------------------------- */
if (is_plugin_active('go_pricing/go_pricing.php')) {

    $tables = array();

	if(class_exists('GW_GoPricing_Data')){
		$pricing_tables = GW_GoPricing_Data::get_table_posts();
		if ( $pricing_tables !== false && sizeof($pricing_tables) ) {
			foreach ( (array) $pricing_tables as $table ) {
				$tables[ $table->post_title ] = $table->post_excerpt;
			}
		}
    }

    vc_map( array(
        "name" =>  a13__be("Go pricing tables", "js_composer"),
        "base" => "go_pricing",
        "icon" => "icon-go_pricing",
        "category" => __('Content', 'js_composer'),
        "params" => array(
            array(
                "type" => "dropdown",
                "heading" =>  a13__be("Table"),
                "param_name" => "id",
                "value" => $tables,
                "description" =>  a13__be("Select pricing table to display"),
                "admin_label" => true,
            ),
            array(
                "type" => "textfield",
                "heading" =>  a13__be("Margin bottom"),
                "param_name" => "margin_bottom",
                "value" => '20px',
                "description" =>  a13__be("It will add margin at bottom. Value can be any valid CSS unit."),
                "admin_label" => true,
            ),
        ),
    ) );
}



/* Woocommerce
---------------------------------------------------------- */
if (is_plugin_active('woocommerce/woocommerce.php')) {
    function a13_wc_categories(){
        $r = array();
        $r['pad_counts'] 	= 1;
        $r['hierarchical'] 	= 0;
        $r['hide_empty'] 	= 1;
        $r['show_count'] 	= 1;
        $r['menu_order'] = false;

        $terms = get_terms( 'product_cat', $r );

        if (!$terms) return array();

        $categories = array();
        foreach($terms as $category){
            $categories[$category->name] = $category->slug;
        }
        return $categories;
    }

    $order_by_options = array(
         a13__be( 'Date' )      => "date",
         a13__be( 'Title' )     => "title",
         a13__be( 'Post slug' ) => "name",
         a13__be( 'ID' )        => "ID",
         a13__be( 'Random' )    => "rand",
    );


    $list_of_products_params = array(
        array(
            "type" => "textfield",
            "heading" =>  a13__be("Number of items"),
            "param_name" => "per_page",
            "value" => '12',
            "admin_label" => true,
        ),
        array(
            "type" => "dropdown",
            "heading" =>  a13__be("Columns"),
            "param_name" => "columns",
            "value" => array(3,4),
            "description" =>  a13__be("If you use sidebar then you should use 3 columns."),
            "admin_label" => true,
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Order by", "js_composer"),
            "param_name" => "orderby",
            "value" => $order_by_options,
            "admin_label" => true,
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Order way", "js_composer"),
            "param_name" => "order",
            "value" => array( __("Ascending", "js_composer") => "ASC", __("Descending", "js_composer") => "DESC" ),
        ),
    );

    $product_categories = array(
        "type" => "dropdown",
        "heading" =>  a13__be("Category"),
        "param_name" => "category",
        "value" => a13_wc_categories(),
        "description" =>  a13__be("If you use sidebar then you should use 3 columns."),
        "admin_label" => true,
    );

    vc_map( array(
        "name" =>  a13__be("Woocommerce Recent Products"),
        "base" => "recent_products",
        "icon" => "icon-woocommerce",
        "category" => __('Content', 'js_composer'),
        "params" => $list_of_products_params
    ) );
    vc_map( array(
        "name" =>  a13__be("Woocommerce Featured Products"),
        "base" => "featured_products",
        "icon" => "icon-woocommerce",
        "category" => __('Content', 'js_composer'),
        "params" => $list_of_products_params
    ) );
    vc_map( array(
        "name" =>  a13__be("Woocommerce Sale Products"),
        "base" => "sale_products",
        "icon" => "icon-woocommerce",
        "category" => __('Content', 'js_composer'),
        "params" => $list_of_products_params
    ) );
    vc_map( array(
        "name" =>  a13__be("Woocommerce Best Selling Products"),
        "base" => "best_selling_products",
        "icon" => "icon-woocommerce",
        "category" => __('Content', 'js_composer'),
        "params" => array(
            array(
                "type" => "textfield",
                "heading" =>  a13__be("Number of items"),
                "param_name" => "per_page",
                "value" => '12',
                "admin_label" => true,
            ),
            array(
                "type" => "dropdown",
                "heading" =>  a13__be("Columns"),
                "param_name" => "columns",
                "value" => array(3,4),
                "description" =>  a13__be("If you use sidebar then you should use 3 columns."),
                "admin_label" => true,
            ),
        )
    ) );
    vc_map( array(
        "name" =>  a13__be("Woocommerce Top Rated Products"),
        "base" => "top_rated_products",
        "icon" => "icon-woocommerce",
        "category" => __('Content', 'js_composer'),
        "params" => $list_of_products_params
    ) );
    vc_map( array(
        "name" =>  a13__be("Woocommerce Product Category"),
        "base" => "product_category",
        "icon" => "icon-woocommerce",
        "category" => __('Content', 'js_composer'),
        "params" => array_merge(array($product_categories), $list_of_products_params)
    ) );


}



