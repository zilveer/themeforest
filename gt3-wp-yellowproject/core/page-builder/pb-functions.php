<?php

#GET UNUSED ID FOR ALL MODULES
function get_unused_id()
{
    $lastid = get_theme_option("last_slide_id");
    if ($lastid < 3) {
        $lastid = 2;
    }
    $lastid++;

    update_theme_option("last_slide_id", $lastid);

    return $lastid;
}


function the_select_options($option_array, $selected_value = "")
{
    if (is_array($option_array)) {
        foreach ($option_array as $key => $value) {
            if ($value == $selected_value) {
                echo "<option value='{$value}' selected='selected'>{$value}</option>";
            } else {
                echo "<option value='{$value}'>{$value}</option>";
            }
        }
    }
}

function get_select_options($option_array, $selected_value = "")
{
    if (!isset($compile)) {$compile='';}
    if (is_array($option_array)) {
        foreach ($option_array as $key => $value) {
            if ($value == $selected_value) {
                $compile .= "<option value='{$value}' selected='selected'>{$value}</option>";
            } else {
                $compile .= "<option value='{$value}'>{$value}</option>";
            }
        }
    }

    return $compile;
}

function get_select_options_with_caption($option_array, $selected_value = "")
{
    if (!isset($compile)) {$compile='';}
    if (is_array($option_array)) {
        foreach ($option_array as $key => $value) {
            if ($key == $selected_value) {
                $compile .= "<option value='{$key}' selected='selected'>{$value}</option>";
            } else {
                $compile .= "<option value='{$key}'>{$value}</option>";
            }
        }
    }

    return $compile;
}


function get_media_for_this_post($postid, $page="1")
{
    global $gt3_pbconfig;
    $args = array(
        'post_type' => 'attachment',
        'numberposts' => $gt3_pbconfig['images_from_media_library'],
        'post_status' => null,
        'order' => 'DESC',
        'paged' => $page
        /*'post_parent' => $postid*/
    );
    $images = get_posts($args);
    if (is_array($images) && $images) {
        foreach ($images as $image) {
            $meta = wp_get_attachment_metadata($image->ID);
            if (isset($meta['width']) && $meta['width'] > 0) {
                $imgpack[] = $image->guid;
            }
        }
        return $imgpack;
    }
    return false;
}


function get_selected_pf_images_for_admin($gt3_pagebuilder)
{
    if (!isset($compile)) {$compile='';}
    if (isset($gt3_pagebuilder['post-formats']['images']) && is_array($gt3_pagebuilder['post-formats']['images'])) {
        foreach ($gt3_pagebuilder['post-formats']['images'] as $imgid => $img) {
            $compile .= "<div class='img-item style_small'><div class='img-preview'><img src='" . aq_resize($img['src'], 62, 62, true, true, true) . "' data-full-url='{$img['src']}' data-thumb-url='" . aq_resize($img['src'], 156, 106, true, true, true) . "' alt='' class='previmg'><div class='hover-container'></div><div class='deldel-container'></div></div><input type='hidden' name='pagebuilder[post-formats][images][" . $imgid . "][src]' value='{$img['src']}'></div>";
        }
    }
    return $compile;
}


function get_selected_pf_images($gt3_pagebuilder)
{
    if (is_array($gt3_pagebuilder['post-formats']['images'])) {
        if (!isset($compile)) {$compile='';}
        if (count($gt3_pagebuilder['post-formats']['images'])==1) {$onlyOneImage = "oneImage";} else {$onlyOneImage = "";}
        $compile .= '
            <div class="slider-wrapper theme-default">
                <div class="nivoSlider '.$onlyOneImage.'">
        ';

        if (is_array($gt3_pagebuilder['post-formats']['images'])) {
            foreach ($gt3_pagebuilder['post-formats']['images'] as $imgid => $img) {
                $compile .= '
                    <img src="'.aq_resize($img{'src'}, 1170, 563, true, true, true).'" data-thumb="'.aq_resize($img{'src'}, 1170, 563, true, true, true).'" alt="" />
                ';
            }
        }

        $compile .= '
                </div>
            </div>
        ';

    }
    return $compile;
}


function get_media_html($media_array, $style = "small")
{
    if (is_array($media_array) && count($media_array)>0) {

        $compile = "<span class='available_media_arrow left_arrow'></span><span class='available_media_arrow right_arrow'></span><div class='clear'></div>";

        foreach ($media_array as $media_url) {
            #style 1
            if ($style == "small") {
                $compile .= "
                <div class='img-item style_small available_media_item'>
                    <div class='img-preview'>
                        <img class='previmg' alt='' data-thumb-url='" . aq_resize($media_url, 156, 106, true, true, true) . "' data-full-url='" . $media_url . "' src='" . aq_resize($media_url, 62, 62, true, true, true) . "'>
                        <div class='hover-container'>
                        </div>
                    </div>
                </div><!-- .img-item -->
                ";
            }
        }

        return $compile;
    }

    return false;
}

#GET ITEMS FOR SLIDER (ADMIN)
function get_slider_items($slider_type, $array)
{
    if (is_array($array)) {

        $compile = "";

        foreach ($array as $key => $slide) {

            #fullscreen slider
            if ($slider_type == "fullscreen") {
                $compile .= "<li>";
                #IF SLIDE IS IMAGE
                if ($slide['slide_type'] == "image") {
                    $compile .= "
                    <div class='img-item item-with-settings'>
                        <input type='hidden' name='pagebuilder[sliders][fullscreen][slides][{$key}][src]' value='{$slide['src']}'>
                        <input type='hidden' name='pagebuilder[sliders][fullscreen][slides][{$key}][slide_type]' value='image'>
                        <div class='img-preview'>
                            <img alt='' src='" . aq_resize($slide['src'], 156, 106, true, true, true) . "'>
                            <div class='hover-container'>
                                <div class='inter_x'></div>
                                <div class='inter_drag'></div>
                                <div class='inter_edit'></div>
                            </div>
                        </div>
                        <div class='edit_popup'>
                            <h2>Slide Settings</h2>
                            <div class='this-option img-in-slider'>
                                <div class='padding-cont'>
                                    <div class='fl w9'>
                                        <h4>slide title</h4>
                                        <input name='pagebuilder[sliders][fullscreen][slides][{$key}][title][value]' type='text' value='{$slide['title']['value']}' class='textoption type1'>
                                    </div>
                                    <div class='right_block fl w1'>
                                        <h4>color</h4>
                                        " . colorpicker_block("pagebuilder[sliders][fullscreen][slides][{$key}][title][color]", $slide['title']['color']) . "
                                    </div>
                                    <div class='clear'></div>
                                </div>
                                <div class='hr_double'></div>
                                <div class='padding-cont'>
                                    <div class='fl w9'>
                                        <h4>Caption</h4>
                                        <textarea name='pagebuilder[sliders][fullscreen][slides][{$key}][caption][value]' type='text' class='textoption type1 big'>{$slide['caption']['value']}</textarea>
                                    </div>
                                    <div class='right_block fl w1'>
                                        <h4>color</h4>
                                        " . colorpicker_block("pagebuilder[sliders][fullscreen][slides][{$key}][caption][color]", $slide['caption']['color']) . "
                                    </div>
                                    <div class='clear'></div>
                                </div>
                            </div>
                            <div class='padding-cont'>
                                <input type='button' value='Done' class='done-btn green-btn' name='ignore_this_button'>
                                <div class='clear'></div>
                            </div>
                        </div>
                    </div><!-- .img-item -->
                    ";
                }
                #IF SLIDE IS VIDEO
                if ($slide['slide_type'] == "video") {
                    $compile .= "
                    <div class='img-item item-with-settings'>
                        <input type='hidden' name='pagebuilder[sliders][fullscreen][slides][{$key}][src]' value='{$slide['src']}'>
                        <input type='hidden' name='pagebuilder[sliders][fullscreen][slides][{$key}][slide_type]' value='video'>
                        <div class='img-preview'>
                            <img alt='' src='" . PBIMGURL . "/video_item.png'>
                            <div class='hover-container'>
                                <div class='inter_x'></div>
                                <div class='inter_drag'></div>
                                <div class='inter_edit'></div>
                            </div>
                            " . show_video_preview($slide['src']) . "
                        </div>
                        <div class='edit_popup'>
                            <h2>Settings</h2>
                            <div class='this-option'>
                                <div class='padding-cont'>
                                    <h4>Video URL (YouTube or Vimeo)</h4>
                                    <input name='pagebuilder[sliders][fullscreen][slides][{$key}][src]' type='text' value='{$slide['src']}' class='textoption type1'>
                                    <div class='example'>
                                        Examples:<br>
                                        Youtube - http://www.youtube.com/watch?v=YW8p8JO2hQw<br>
                                        Vimeo - http://vimeo.com/47989207
                                    </div>
                                </div>
                                <div class='padding-cont' style='padding-top:0;'>
                                    <div class='fl w9' style='width:601px;'>
                                        <h4>slide title and slide thumbnail</h4>
                                        <input name='pagebuilder[sliders][fullscreen][slides][{$key}][title][value]' type='text' value='{$slide['title']['value']}' class='textoption type1'>
                                    </div>
                                    <div class='right_block fl w1' style='width:115px;'>
                                        <h4>color</h4>
                                        " . colorpicker_block("pagebuilder[sliders][fullscreen][slides][{$key}][title][color]", $slide['title']['color']) . "
                                    </div>
                                   <div class='preview_img_video_cont'>
			                            <input type='text' value='{$slide['thumbnail']['value']}' id='slide_{$key}_upload' name='pagebuilder[sliders][fullscreen][slides][{$key}][thumbnail][value]' class='textoption type1' style='width:601px;float:left;'>
			                            <div class='up_btns'>
			                                <span id='slide_{$key}' class='button btn_upload_image style2 but_slide_{$key}'>Upload Image</span>
                                        </div>
                                        <div class='clear'></div>
		                            </div>
                                    <div class='clear'></div>
                                </div>
                                <div class='hr_double'></div>
                                <div class='padding-cont'>
                                    <div class='fl w9' style='width:601px;'>
                                        <h4>Caption</h4>
                                        <textarea name='pagebuilder[sliders][fullscreen][slides][{$key}][caption][value]' type='text' class='textoption type1 big' style='height:70px;'>{$slide['caption']['value']}</textarea>
                                    </div>
                                    <div class='right_block fl w1' style='width:115px;'>
                                        <h4>color</h4>
                                        " . colorpicker_block("pagebuilder[sliders][fullscreen][slides][{$key}][caption][color]", $slide['caption']['color']) . "
                                    </div>
                                    <div class='clear'></div>
                                </div>
                            </div>
                            <div class='hr_double'></div>
                            <div class='padding-cont'>
                                <input type='button' value='Done' class='done-btn green-btn' name='ignore_this_button'>
                                <div class='clear'></div>
                            </div>
                        </div>
                    </div><!-- .img-item -->
                    ";
                }
                $compile .= "</li>";
            }

            #fullwidth slider
            if ($slider_type == "fullwidth") {
                $compile .= "<li>";
                #IF SLIDE IS IMAGE
                if ($slide['slide_type'] == "image") {
                    $compile .= "
                    <div class='img-item item-with-settings'>
                        <input type='hidden' name='pagebuilder[sliders][fullwidth][slides][{$key}][src]' value='{$slide['src']}'>
                        <input type='hidden' name='pagebuilder[sliders][fullwidth][slides][{$key}][slide_type]' value='image'>
                        <div class='img-preview'>
                            <img alt='' src='" . aq_resize($slide['src'], 156, 106, true, true, true) . "'>
                            <div class='hover-container'>
                                <div class='inter_x'></div>
                                <div class='inter_drag'></div>
                                <div class='inter_edit'></div>
                            </div>
                        </div>
                        <div class='edit_popup'>
                            <h2>Slide Settings</h2>
                            <div class='this-option img-in-slider'>
                                <div class='padding-cont'>
                                    <div class='fl w9'>
                                        <h4>slide title</h4>
                                        <input name='pagebuilder[sliders][fullwidth][slides][{$key}][title][value]' type='text' value='{$slide['title']['value']}' class='textoption type1'>
                                    </div>
                                    <div class='right_block fl w1'>
                                        <h4>color</h4>
                                        " . colorpicker_block("pagebuilder[sliders][fullwidth][slides][{$key}][title][color]", $slide['title']['color']) . "
                                    </div>
                                    <div class='clear'></div>
                                </div>
                                <div class='hr_double'></div>
                                <div class='padding-cont'>
                                    <div class='fl w9'>
                                        <h4>Caption</h4>
                                        <textarea name='pagebuilder[sliders][fullwidth][slides][{$key}][caption][value]' type='text' class='textoption type1 big'>{$slide['caption']['value']}</textarea>
                                    </div>
                                    <div class='right_block fl w1'>
                                        <h4>color</h4>
                                        " . colorpicker_block("pagebuilder[sliders][fullwidth][slides][{$key}][caption][color]", $slide['caption']['color']) . "
                                    </div>
                                    <div class='clear'></div>
                                </div>
                            </div>
                            <div class='padding-cont'>
                                <input type='button' value='Done' class='done-btn green-btn' name='ignore_this_button'>
                                <div class='clear'></div>
                            </div>
                        </div>
                    </div><!-- .img-item -->
                    ";
                }
                #IF SLIDE IS VIDEO
                if ($slide['slide_type'] == "video") {
                    $compile .= "
                    <div class='img-item item-with-settings'>
                        <input type='hidden' name='pagebuilder[sliders][fullwidth][slides][{$key}][src]' value='{$slide['src']}'>
                        <input type='hidden' name='pagebuilder[sliders][fullwidth][slides][{$key}][slide_type]' value='video'>
                        <div class='img-preview'>
                            <img alt='' src='" . PBIMGURL . "/video_item.png'>
                            <div class='hover-container'>
                                <div class='inter_x'></div>
                                <div class='inter_drag'></div>
                                <div class='inter_edit'></div>
                            </div>
                            " . show_video_preview($slide['src']) . "
                        </div>
                        <div class='edit_popup'>
                            <h2>Settings</h2>
                            <div class='this-option'>
                                <div class='padding-cont'>
                                    <h4>Video URL (YouTube or Vimeo)</h4>
                                    <input name='pagebuilder[sliders][fullwidth][slides][{$key}][src]' type='text' value='{$slide['src']}' class='textoption type1'>
                                    <div class='example'>
                                        Examples:<br>
                                        Youtube - http://www.youtube.com/watch?v=YW8p8JO2hQw<br>
                                        Vimeo - http://vimeo.com/47989207
                                    </div>
                                </div>
                                <div class='padding-cont' style='padding-top:0;'>
                                    <div class='fl w9' style='width:601px;'>
                                        <h4>slide title and slide thumbnail</h4>
                                        <input name='pagebuilder[sliders][fullwidth][slides][{$key}][title][value]' type='text' value='{$slide['title']['value']}' class='textoption type1'>
                                    </div>
                                    <div class='right_block fl w1' style='width:115px;'>
                                        <h4>color</h4>
                                        " . colorpicker_block("pagebuilder[sliders][fullwidth][slides][{$key}][title][color]", $slide['title']['color']) . "
                                    </div>
                                   <div class='preview_img_video_cont'>
                                        <input type='text' value='{$slide['thumbnail']['value']}' id='slide_{$key}_upload' name='pagebuilder[sliders][fullwidth][slides][{$key}][thumbnail][value]' class='textoption type1' style='width:601px;float:left;'>
                                        <div class='up_btns'>
                                            <span id='slide_{$key}' class='button btn_upload_image style2 but_slide_{$key}'>Upload Image</span>
                                        </div>
                                        <div class='clear'></div>
                                    </div>
                                    <div class='clear'></div>
                                </div>
                                <div class='hr_double'></div>
                                <div class='padding-cont'>
                                    <div class='fl w9' style='width:601px;'>
                                        <h4>Caption</h4>
                                        <textarea name='pagebuilder[sliders][fullwidth][slides][{$key}][caption][value]' type='text' class='textoption type1 big' style='height:70px;'>{$slide['caption']['value']}</textarea>
                                    </div>
                                    <div class='right_block fl w1' style='width:115px;'>
                                        <h4>color</h4>
                                        " . colorpicker_block("pagebuilder[sliders][fullwidth][slides][{$key}][caption][color]", $slide['caption']['color']) . "
                                    </div>
                                    <div class='clear'></div>
                                </div>
                            </div>
                            <div class='hr_double'></div>
                            <div class='padding-cont'>
                                <input type='button' value='Done' class='done-btn green-btn' name='ignore_this_button'>
                                <div class='clear'></div>
                            </div>
                        </div>
                    </div><!-- .img-item -->
                    ";
                }
                $compile .= "</li>";
            }


        }

        return $compile;
    }

    return false;
}


/* SHOW VIDEO PREVIEW IN POPUP (admin area) */
function show_video_preview($videourl)
{
    #YOUTUBE
    $is_youtube = substr_count($videourl, "youtu");
    if ($is_youtube > 0) {
        $videoid = substr(strstr($videourl, "="), 1);
        $compile_inner = "
            <iframe width=\"395\" height=\"295\" src=\"http://www.youtube.com/embed/" . $videoid . "\" frameborder=\"0\" allowfullscreen></iframe>
        ";
    }

    #VIMEO
    $is_vimeo = substr_count($videourl, "vimeo");
    if ($is_vimeo > 0) {
        $videoid = substr(strstr($videourl, "m/"), 2);
        $compile_inner = "
            <iframe src=\"http://player.vimeo.com/video/" . $videoid . "\" width=\"395\" height=\"295\" frameborder=\"0\" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
        ";
    }

    $compile = "
        <div class='video_preview'>
            <div class='video_inner'>
                {$compile_inner}
            </div>
        </div>
    ";

    return $compile;
}


function colorpicker_block($name, $value, $additional_class = "")
{
    return "
    <div class='color_picker_block {$additional_class}'>
        <span class='sharp'>#</span>
        <input type='text' value='{$value}' name='{$name}' maxlength='25' class='medium cpicker textoption type1'>
        <input type='text' value='' class='textoption type1 cpicker_preview' disabled='disabled'>
    </div>
    ";
}


function toggle_radio_yes_no($settingsname, $settingstate, $default_state = "yes", $additional_class = "")
{

    if (!isset($checked_state_yes)) {$checked_state_yes='';}
    if (!isset($checked_state_no)) {$checked_state_no='';}

    if ($default_state == "yes") {
        $checked_state_yes = "checked='checked'";
    }
    if ($default_state == "no") {
        $checked_state_no = "checked='checked'";
    }

    if ($settingstate == "yes") {
        $checked_state_yes = "checked='checked'";
        $checked_state_no = "";
    }
    if ($settingstate == "no") {
        $checked_state_no = "checked='checked'";
        $checked_state_yes = "";
    }
    return "
<div class='radio_toggle_cont {$additional_class}'>
    <input type='radio' class='checkbox_slide yes_state' {$checked_state_yes} value='yes' name='{$settingsname}'>
    <input type='radio' class='checkbox_slide no_state' {$checked_state_no} value='no' name='{$settingsname}'>
    <div class='radio_toggle_mirage'></div>
</div>
";
}


function pb_setting_input($settingsname, $settingstate, $default_state = "yes", $additional_class = "")
{
    if ($settingstate == "") {$settingstate = $default_state;}
    return "
    <input type='text' class='textoption type1 settings_input {$additional_class}' value='{$settingstate}' name='{$settingsname}'>
";
}

function toggle_radio_on_off($settingsname, $settingstate, $default_state = "on", $additional_class = "")
{
    if (!isset($checked_state_on)) {$checked_state_on='';}
    if (!isset($checked_state_off)) {$checked_state_off='';}

    if ($default_state == "on") {
        $checked_state_on = "checked='checked'";
    }
    if ($default_state == "off") {
        $checked_state_off = "checked='checked'";
    }

    if ($settingstate == "on") {
        $checked_state_on = "checked='checked'";
        $checked_state_off = "";
    }
    if ($settingstate == "off") {
        $checked_state_off = "checked='checked'";
        $checked_state_on = "";
    }
    return "
<div class='radio_toggle_cont on_off_style {$additional_class}'>
    <input type='radio' class='checkbox_slide yes_state' {$checked_state_on} value='on' name='{$settingsname}'>
    <input type='radio' class='checkbox_slide no_state' {$checked_state_off} value='off' name='{$settingsname}'>
    <div class='radio_toggle_mirage'></div>
</div>
";
}


function get_html_all_available_pb_modules($modules)
{
    if (!isset($compile)) {$compile = "";}
    if (is_array($modules)) {
        foreach ($modules as $module_key) {
            $compile .= "
            <div class='pb-module text-shadow1 visual_style1' data-module-name='" . $module_key['name'] . "'>
                <span class='module-name'>" . $module_key['caption'] . "</span>
            </div>
            ";
        }
    }

    return $compile;
}


/* create array with default bg position for admin options */
function get_def_bg_pos_admin_options_style()
{
    global $gt3_pbconfig;

    if (is_array($gt3_pbconfig['page_bg_available_types'])) {
        foreach ($gt3_pbconfig['page_bg_available_types'] as $bg_position) {
            $array[$bg_position] = $bg_position;
        }
    }

    return $array;
}


function replace_br_to_rn_in_multiarray(&$item, $key){
    $item = str_replace(array("<br>", "<br />"), "\n", $item);
}
function get_theme_pagebuilder($postid)
{
    $gt3_pagebuilder = get_post_meta($postid, "pagebuilder", true);
    if (!is_array($gt3_pagebuilder)) {
        $gt3_pagebuilder = array();
    }

    if (!isset($gt3_pagebuilder['settings']['show_content_area'])) {$gt3_pagebuilder['settings']['show_content_area'] = "yes";}
    if (!isset($gt3_pagebuilder['settings']['show_page_title'])) {$gt3_pagebuilder['settings']['show_page_title'] = "yes";}
    if (!isset($gt3_pagebuilder['settings']['layout-sidebars'])) {$gt3_pagebuilder['settings']['layout-sidebars'] = get_theme_option("default_sidebar_layout");}

    return $gt3_pagebuilder;
}


function replace_rn_to_br_in_multiarray(&$item, $key){
    if ($key!=="html") {
        $item = nl2br($item);
        $item = str_replace(array("\r\n", "\r", "\n"), '', $item);
    }
}
function update_theme_pagebuilder($post_id, $variableName, $gt3_pagebuilderArray)
{
    array_walk_recursive($gt3_pagebuilderArray, 'replace_rn_to_br_in_multiarray');
    update_post_meta($post_id, $variableName, $gt3_pagebuilderArray);
    return true;
}


function get_default_sidebars()
{
    $sidebars['layout-sidebars'] = get_theme_option("default_sidebar_layout");

    return $sidebars;
}


function get_default_pb_settings()
{
    $gt3_pagebuilder['settings']['layout-sidebars'] = get_theme_option("default_sidebar_layout");
    $gt3_pagebuilder['settings']['left-sidebar'] = "Default";
    $gt3_pagebuilder['settings']['right-sidebar'] = "Default";
    $gt3_pagebuilder['settings']['bg_image']['status'] = get_theme_option("show_bg_img_by_default");
    $gt3_pagebuilder['settings']['bg_image']['src'] = get_theme_option("bg_img");
    $gt3_pagebuilder['settings']['custom_color']['status'] = get_theme_option("show_bg_color_by_default");
    $gt3_pagebuilder['settings']['custom_color']['value'] = get_theme_option("default_bg_color");
    $gt3_pagebuilder['settings']['bg_image']['type'] = get_theme_option("default_bg_img_position");

    if (get_theme_option("show_breadcrumb")=="on") {
        $gt3_pagebuilder['settings']['show_breadcrumb'] = "yes";
    } else {
        $gt3_pagebuilder['settings']['show_breadcrumb'] = "no";
    }


    return $gt3_pagebuilder;
}


function get_shortcodes_selector ($class) {

        global $gt3_pbconfig;

        $compile = "<div class='".$class."'>";
        $compile .= "<h4>Shortcodes</h4><div class='qshorct_cont'>";

        $shortcodes_array = array(
            "custom_button" => array(
                "icon" => THEMEROOTURL."/core/page-builder/img/shortcode_icons/button.png",
                "title" => "Custom Button",
                "options" =>
                    get_empty_input("Address url", "custom_button_sc_address", "100%", "left").
                    get_empty_input("Button text", "custom_button_sc_text", "100%", "left").
                    get_empty_select("Type", "custom_button_sc_type", $gt3_pbconfig['all_available_custom_buttons'], $width="250px").
                    get_empty_select("Target", "custom_button_target", $gt3_pbconfig['all_available_target_for_custom_buttons'], $width="250px").

                    '<input type="button" value="Insert" class="green-btn qsc_insert custom_button_inserter" name="">',
            ),
            "blockquote" => array(
                "icon" => THEMEROOTURL."/core/page-builder/img/shortcode_icons/quote.png",
                "title" => "Blockquote",
                "options" =>
                    get_empty_input("Width", "blockquote_sc_width", "60px", "left", "50%").
                    get_empty_input("Author", "blockquote_sc_author", "100%", "left", "").
                    get_empty_select("Float", "blockquote_sc_float", array("left"=>"Left", "right"=>"Right", "none"=>"None"), $width="150px").
                    get_empty_select("Type", "quote_type", $gt3_pbconfig['all_available_quote_types'], $width="150px").
                    get_empty_textarea("Quote", "blockquote_sc_text", "100%", "left", "").
                    '<input type="button" value="Insert" class="green-btn qsc_insert blockquote_inserter" name="">',
            ),
            "dropcaps" => array(
                "icon" => THEMEROOTURL."/core/page-builder/img/shortcode_icons/dropcaps.png",
                "title" => "Dropcaps",
                "options" =>
                    get_empty_input("Letter", "dropcaps_sc_text", "60px", "center", "").
                    get_empty_select("Type", "dropcaps_sc_type", $gt3_pbconfig['all_available_dropcaps'], $width="150px").
                    '<input type="button" value="Insert" class="green-btn qsc_insert dropcaps_inserter" name="">',
            ),
            "frame" => array(
                "icon" => THEMEROOTURL."/core/page-builder/img/shortcode_icons/frame.png",
                "title" => "Frame",
                "options" =>
                    get_empty_input("Preview width", "frame_sc_width", "60px", "left", "150").
                    get_empty_input("Preview height", "frame_sc_height", "60px", "left", "150").
                    get_empty_input("Title", "frame_sc_title", "100%", "left", "").
                    get_empty_input("Image src", "frame_sc_src", "100%", "left", "").
                    get_empty_select("Float", "frame_sc_float", array("alignleft"=>"Left", "alignright"=>"Right", "alignnone"=>"None"), $width="150px").
                    '<input type="button" value="Insert" class="green-btn qsc_insert frame_inserter" name="">',
            ),
            "video" => array(
                "icon" => THEMEROOTURL."/core/page-builder/img/shortcode_icons/video.png",
                "title" => "Video",
                "options" =>
                    get_empty_input("Width", "video_sc_width", "80px", "center", "150px").
                    get_empty_input("Height", "video_sc_height", "80px", "center", "150px").
                    get_empty_input("Video", "video_sc_src", "100%", "left", "").
                    get_empty_select("Float", "video_sc_float", array("left"=>"Left", "right"=>"Right", "none"=>"None"), $width="150px").
                    '<input type="button" value="Insert" class="green-btn qsc_insert video_inserter" name="">',
            ),
            "highlighter" => array(
                "icon" => THEMEROOTURL."/core/page-builder/img/shortcode_icons/highlighter.png",
                "title" => "Highlighter",
                "options" =>
                    get_empty_textarea("Text", "highlighter_sc_text", "100%", "left", "").
                    get_empty_select("Type", "highlighter_sc_type", $gt3_pbconfig['all_available_highlighters'], $width="150px").
                    '<input type="button" value="Insert" class="green-btn qsc_insert highlighter_inserter" name="">',
            ),
            "divider" => array(
                "icon" => THEMEROOTURL."/core/page-builder/img/shortcode_icons/divider.png",
                "title" => "Divider",
                "options" =>
                    get_empty_select("Type", "dividers_sc_type", $gt3_pbconfig['all_available_dividers'], $width="200px").
                    '<input type="button" value="Insert" class="green-btn qsc_insert dividers_inserter" name="">',
            ),
            "social" => array(
                "icon" => THEMEROOTURL."/core/page-builder/img/shortcode_icons/social.png",
                "title" => "Social buttons",
                "options" =>
                    get_empty_input("Address url", "social_sc_url", "100%", "left", "").
                    get_empty_select("Type", "social_sc_type", $gt3_pbconfig['all_available_social_icons_type'], $width="150px").
                    get_empty_select("Style", "social_sc_style", $gt3_pbconfig['all_available_social_icons'], $width="150px").
                    '<input type="button" value="Insert" class="green-btn qsc_insert social_inserter" name="">',
            ),
        );

        $compile .= "<div class='quick_shortcodes_icons'>";
        if (is_array($shortcodes_array)) {
            foreach ($shortcodes_array as $shortcode_tech_name => $shortcode) {
                $compile .= "<img src='".$shortcode['icon']."' alt='".$shortcode['title']."' title='".$shortcode['title']."' class='qshortcode_icon' data-shortcode_tech_name='".$shortcode_tech_name."'>";
            }
        }
        $compile .= "</div>";

        $compile .= "<div class='quick_shortcodes_options'>";
        if (is_array($shortcodes_array)) {
            foreach ($shortcodes_array as $shortcode_tech_name => $shortcode) {
                $compile .= "<div class='quick_shortcodes_option ".$shortcode_tech_name."'>
                <h4>".$shortcode['title']."</h4>".$shortcode['options']."</div>";
            }
        }
        $compile .= "</div>";

    $compile .= "<div class='clear'></div></div>";
    $compile .= "</div>";


    return $compile;
}

function the_pb_custom_bg_and_color($gt3_pagebuilder) {
    $cover = '';
    $bgcolor = '';
    $bgimg = '';
    $repeat = '';
    $fullcolor = '';
    $fullimg  = '';
    $classimg  = '';


    /* BG IMAGE */
    if (isset($gt3_pagebuilder['settings']['bg_image']['status']) && $gt3_pagebuilder['settings']['bg_image']['status'] == "on") {
        $bgimg = $gt3_pagebuilder['settings']['bg_image']['src'];
        if ($gt3_pagebuilder['settings']['bg_image']['type'] == 'center') {
            $repeat = 'no-repeat';
            $cover = '';
        }
        if ($gt3_pagebuilder['settings']['bg_image']['type'] == 'repeat') {
            $repeat = 'repeat';
            $cover = '';
        }
        if ($gt3_pagebuilder['settings']['bg_image']['type'] == 'stretched') {
            $repeat = 'no-repeat';
            $cover = 'covered';
        }

        $fullimg = 'background-image:url('.$bgimg.'); background-repeat:'.$repeat.'; background-position:center;';
        $classimg = 'bg_pic';
    }

    /* BG COLOR */
    if (isset($gt3_pagebuilder['settings']['custom_color']['status']) && $gt3_pagebuilder['settings']['custom_color']['status'] == "on") {
        $fullcolor = 'background-color:#'.$gt3_pagebuilder['settings']['custom_color']['value'].';';
    }

    #START ECHO
    if ((isset($gt3_pagebuilder['settings']['custom_color']['status']) && $gt3_pagebuilder['settings']['custom_color']['status'] == "on") || (isset($gt3_pagebuilder['settings']['bg_image']['status']) && $gt3_pagebuilder['settings']['bg_image']['status'] == "on"))
    {
        echo '<div class="custom_bg_cont '.$cover.' '.$classimg.'" style="'.$fullcolor.' '.$fullimg.' "></div>';
    }

}

?>