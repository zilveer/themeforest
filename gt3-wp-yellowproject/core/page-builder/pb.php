<?php

#LOAD FILES
require_once ("pb-config.php");
require_once ("pb-functions.php");
require_once ("pb-ajax-handlers.php");
require_once ("pb-modules.php");
require_once ("pb-parser.php");

#REGISTER SOME CSS/JS
add_action('admin_init', 'pb_init');
function pb_init()
{
    #CSS
    wp_enqueue_style('admin', get_template_directory_uri() . '/core/page-builder/css/pb.css');
    wp_enqueue_style('jscrollpane', get_template_directory_uri() . '/core/page-builder/css/jquery.jscrollpane.css');
    #JS
    wp_enqueue_script('admin', get_template_directory_uri() . '/core/page-builder/js/pb.js');
    wp_enqueue_script('mousewheel', get_template_directory_uri() . '/core/page-builder/js/jquery.mousewheel.js');
    wp_enqueue_script('jscrollpane', get_template_directory_uri() . '/core/page-builder/js/jquery.jscrollpane.min.js');
}

#SAVE
add_action('save_post', 'save_postdata');

#REGISTER PAGE BUILDER
add_action('add_meta_boxes', 'add_custom_box');
function add_custom_box()
{
    global $gt3_pbconfig;
    if (is_array($gt3_pbconfig['page_builder_enable_for_posts'])) {
        foreach ($gt3_pbconfig['page_builder_enable_for_posts'] as $post_type) {
            add_meta_box(
                'pb_section',
                'Work with page',
                'pagebuilder_inner_custom_box',
                $post_type
            );
        }
    }
}


function pagebuilder_inner_custom_box($post)
{
    $now_post_type = get_post_type();

    wp_nonce_field(plugin_basename(__FILE__), 'pagebuilder_noncename');
    $gt3_pagebuilder = get_post_meta($post->ID, "pagebuilder", true);
    if (!is_array($gt3_pagebuilder)) {
        $gt3_pagebuilder = array();
    }
    array_walk_recursive($gt3_pagebuilder, 'replace_br_to_rn_in_multiarray');

    global $gt3_pbconfig, $modules;

#get all sidebars
    $all_sidebars = get_theme_sidebars_for_admin();
    array_push($all_sidebars, "Default");
    $media_for_this_post = get_media_for_this_post(get_the_ID());
    $js_for_pb = "
    <script>
        var post_id = " . get_the_ID() . ";
        var show_img_media_library_page = 1;
    </script>";

    echo $js_for_pb;
    echo "
<!-- popup background -->
<div class='popup-bg'></div>
<div class='waiting-bg'><div class='waiting-bg-img'></div></div>
";
#START BUILDER AREA
    if (in_array($now_post_type, $gt3_pbconfig['pb_modules_enabled_for'])) {
        echo "
<div class='pb-cont page-builder-container'>
    <div class='heading-cont bg_type1'>
        <div class='head-text'>Page Builder</div>
        <div class='show-hide-container'></div>
    </div>
    <div class='pb10'>
        <div class='hideable-content'>
            <div class='padding-cont'>
                <div class='available-modules-cont'>
                    <div class='just-caption'>
                        <img src='" . PBIMGURL . "/add_new_module.png' alt=''>
                    </div>
                    " . get_html_all_available_pb_modules($modules) . "
                </div>
                <div class='clear'></div>
            </div>
            <div class='pb-list-active-modules'>
                <div class='padding-cont'>
                    <ul class='sortable-modules'>
                    ";

        if (isset($gt3_pagebuilder['modules']) && is_array($gt3_pagebuilder['modules'])) {
            foreach ($gt3_pagebuilder['modules'] as $moduleid => $module) {
                if ($module['size'] == "block_1_4") {
                    $size_caption = "1/4";
                }
                if ($module['size'] == "block_1_3") {
                    $size_caption = "1/3";
                }
                if ($module['size'] == "block_1_2") {
                    $size_caption = "1/2";
                }
                if ($module['size'] == "block_2_3") {
                    $size_caption = "2/3";
                }
                if ($module['size'] == "block_3_4") {
                    $size_caption = "3/4";
                }
                if ($module['size'] == "block_1_1") {
                    $size_caption = "1/1";
                }
                echo get_pb_module($module['name'], $module['caption'], $moduleid, $gt3_pagebuilder, $module['size'], $size_caption);
            }
        }

        echo "
                    </ul>
                    <div class='clear'></div>
                </div>
            </div>
            <div class='dbg'></div>
        </div>
    </div>
</div>
";
    }
#END BUILDER AREA


#START PAGE SETTINGS AREA
    if (in_array($now_post_type, $gt3_pbconfig['page_settings_enabled_for'])) {

        if (!isset($gt3_pagebuilder['post-formats']['videourl'])) {$gt3_pagebuilder['post-formats']['videourl'] = '';}
        if (!isset($gt3_pagebuilder['settings']['layout-sidebars'])) {$gt3_pagebuilder['settings']['layout-sidebars'] = '';}
        if (!isset($gt3_pagebuilder['post-formats']['video_height'])) {$gt3_pagebuilder['post-formats']['video_height'] = $gt3_pbconfig['default_video_height'];}

        echo "
<div class='pb-cont page-settings-container'>
    <div class='heading-cont bg_type1'>
        <div class='head-text'>Page settings</div>
        <div class='show-hide-container'></div>
    </div>
    <div class='pb10'>
        <div class='hideable-content'>

            <div class='post-formats-container'>
                <!-- Audio post format -->
                <div id='audio_sectionid_inner'>
                    <h2>MP3: <a class='upload_and_insert button-secondary' href='#'>Upload</a></h2>
                    <input type='text' class='mp3audiourl medium textoption type1' name='pagebuilder[post-formats][mp3]' value='" . (isset($gt3_pagebuilder['post-formats']['mp3']) ? $gt3_pagebuilder['post-formats']['mp3'] : '') . "'>
                    <h2 style='margin-top:10px;'>OGG: <a class='upload_and_insert button-secondary' href='#'>Upload</a></h2>
                    <input type='text' class='oggaudiourl medium textoption type1' name='pagebuilder[post-formats][ogg]' value='" . (isset($gt3_pagebuilder['post-formats']['ogg']) ? $gt3_pagebuilder['post-formats']['ogg'] : '') . "'>
                </div>
                <!-- Video post format -->
                <div id='video_sectionid_inner'>
                    <h2>Post format video URL:</h2>
                    <input type='text' class='medium textoption type1' name='pagebuilder[post-formats][videourl]' value='" . $gt3_pagebuilder['post-formats']['videourl'] . "'>
                    <div class='example'>Examples:<br>Youtube - http://www.youtube.com/watch?v=YW8p8JO2hQw<br>Vimeo - http://vimeo.com/47989207</div>
                    <div class='video_height' style='margin-top:15px;'>
                        <div class='enter_option_row'>
                            <h2>Video height</h2>
                            <input type='text' class='medium textoption type1' name='pagebuilder[post-formats][video_height]' value='" . $gt3_pagebuilder['post-formats']['video_height'] . "' style='width:70px;text-align:center;'>
                        </div>
                    </div>
                </div>
                <!-- Image post format -->
                <div id='portslides_sectionid_inner'>
                    <h2>Selected images (for post format slider)</h2>
                    <div class='selected-images-for-pf'>
                        " . get_selected_pf_images_for_admin($gt3_pagebuilder) . "
                    </div>
                    <h2>Available images (for post format slider)</h2>
                    <div class='available-images-for-pf available_media'>
                        <div class='ajax_cont'>
                            " . get_media_html($media_for_this_post, "small") . "
                        </div>
                        <div class='img-item style_small add_image_to_sliders_available_media cboxElement'>
                            <div class='img-preview'>
                                <img alt='' src='" . PBIMGURL . "/add_image.png'>
                            </div>
                        </div><!-- .img-item -->
                    </div>
                </div>
            </div>
            <div class='clear'></div>

            <div class='padding-cont'>
                <div class='select-layout-container'>
                    <h2>Select layout</h2>
                    <div class='choose-sidebar left-sidebar-cont' data-sidebar='left-sidebar'>
                        <div class='img-preview'>
                            <img src='" . PBIMGURL . "/left-sidebar.png' alt='Left sidebar' class='left-sidebar'>
                        </div>
                        <div class='sidebar-caption text-shadow1'>Page with left sidebar</div>
                    </div>
                    <div class='choose-sidebar right-sidebar-cont' data-sidebar='right-sidebar'>
                        <div class='img-preview'>
                            <img src='" . PBIMGURL . "/right-sidebar.png' alt='Right sidebar' class='right-sidebar'>
                        </div>
                        <div class='sidebar-caption text-shadow1'>Page with right sidebar</div>
                    </div>
                    <div class='choose-sidebar no-sidebar-cont' data-sidebar='no-sidebar'>
                        <div class='img-preview'>
                            <img src='" . PBIMGURL . "/no-sidebar.png' alt='No sidebar' class='no-sidebar'>
                        </div>
                        <div class='sidebar-caption text-shadow1'>Page without sidebars</div>
                    </div>
                    <input type='hidden' class='layout-sidebars' name='pagebuilder[settings][layout-sidebars]' value='" . $gt3_pagebuilder['settings']['layout-sidebars'] . "'>
                    <input type='hidden' class='default_sidebar_layout' name='default_sidebar_layout' value='" . get_theme_option("default_sidebar_layout") . "'>
                </div>
                <div class='clear'></div>
                <div class='sidebar-chooser for-left mt20'>
                    <h2>choose left sidebar</h2>
                    <select class='newselect' name='pagebuilder[settings][left-sidebar]' style='width:350px;'>";
        the_select_options($all_sidebars, $gt3_pagebuilder['settings']['left-sidebar']);
        echo "  </select>
                </div>
                <div class='sidebar-chooser for-right mt20'>
                    <h2>choose right sidebar</h2>
                    <select class='newselect' name='pagebuilder[settings][right-sidebar]' style='width:350px;'>";
        the_select_options($all_sidebars, $gt3_pagebuilder['settings']['right-sidebar']);
        echo "  </select>
                </div>
                <div class='clear'></div>
            </div>
            <div class='clear'></div>
            <div class='hr_double' style='margin-top: 10px;'></div>
            <div class='padding-cont'>
                <div class='radio_block'>
                    <div class='caption' style='width: 200px;'><h2>show page title</h2></div>
                    <div class='radio_selector'>
                        " . toggle_radio_yes_no('pagebuilder[settings][show_page_title]', $gt3_pagebuilder['settings']['show_page_title'], 'yes') . "
                    </div>
                    <div class='help_here text-shadow1'></div>
                    <div class='clear'></div>
                </div>
                <!--div class='radio_block' style='padding-top:15px;'>
                    <div class='caption' style='width: 200px;'><h2>show content area</h2></div>
                    <div class='radio_selector'>
                        " . toggle_radio_yes_no('pagebuilder[settings][show_content_area]', $gt3_pagebuilder['settings']['show_content_area'], 'yes') . "
                    </div>
                    <div class='help_here text-shadow1'></div>
                    <div class='clear'></div>
                </div-->
                <div class='radio_block' style='padding-top:15px;'>
                    <div class='caption' style='width: 200px;'><h2>show breadcrumb</h2></div>
                    <div class='radio_selector'>
                        " . toggle_radio_yes_no('pagebuilder[settings][show_breadcrumb]', $gt3_pagebuilder['settings']['show_breadcrumb'], 'no') . "
                    </div>
                    <div class='help_here text-shadow1'></div>
                    <div class='clear'></div>
                </div>";

        if ($now_post_type == "port") {
                echo "
                <div class='text_block' style='padding-top:15px;'>
                    <div class='caption' style='width: 200px;'><h2>External link</h2></div>
                    " . pb_setting_input('pagebuilder[settings][external_link]', (isset($gt3_pagebuilder['settings']['external_link']) ? $gt3_pagebuilder['settings']['external_link'] : ''), '') . "
                    <div class='help_here text-shadow1'></div>
                    <div class='clear'></div>
                </div>
                ";
        }

        echo "</div>
        </div>
    </div>
</div>
";
    }
#END PAGE SETTINGS AREA


#START SLIDERS & BACKGROUND AREA
if ($gt3_pbconfig['slider_and_bg_area'] == true && in_array($now_post_type, $gt3_pbconfig['slider_and_bg_area_enable_for'])) {
    echo "
<div class='pb-cont hided-state sliders-and-bgs-container'>
    <div class='heading-cont bg_type1'>
        <div class='head-text'>Custom settings</div>
        <div class='show-hide-container'></div>
    </div>
    <div class='pb10'>
        <div class='hideable-content'>";


    if ($gt3_pbconfig['enable_fullscreen_slider'] == true && in_array($now_post_type, $gt3_pbconfig['fullcreen_slider_enabled_for'])) {
        echo "
            <!-- FULLSCREEN SLIDER SETTINGS -->
            <div class='padding-cont  stand-s pt_" . $now_post_type . "' style='padding-top:20px;padding-bottom:0px;'>
                <div class='bg_or_slider_option slider_type active'>
                    <input type='hidden' name='settings_type' value='fullscreen' class='settings_type'>
                    <div class='heading line_option visual_style1'>
                        <div class='option_title'>Gallery</div>
                        <div class='toggler'>" . toggle_radio_on_off('pagebuilder[sliders][fullscreen][status]', (isset($gt3_pagebuilder['sliders']['fullscreen']['status']) ? $gt3_pagebuilder['sliders']['fullscreen']['status'] : ''), 'off', 'fullscreen_toggler bg_slide_sett') . "</div>
                        <div class='pre_toggler'></div>
                    </div>
                    <div class='hideable-area'>
                        <div class='padding-cont help text-shadow2'></div>
                        <div class='padding-cont' style='padding-bottom:11px;'>
                            <div class='selected_media'>
                                <div class='append_block'>
                                     <ul class='sortable-img-items'>
                                       " . get_slider_items("fullscreen", (isset($gt3_pagebuilder['sliders']['fullscreen']['slides']) ? $gt3_pagebuilder['sliders']['fullscreen']['slides'] : '')) . "
                                     </ul>
                                </div>
                                <div class='clear'></div>
                            </div>
                        </div>
                        <div style='' class='hr_double style2'></div>
                        <div class='padding-cont' style='padding-top:12px;'>
                            <h2 class='dark_bg' style='margin-bottom:0px;'>select media</h2>
                            <div class='available_media'>
                                <div class='ajax_cont'>
                                    " . get_media_html($media_for_this_post, "small") . "
                                </div>
                                <div class='img-item style_small add_image_to_sliders_available_media cboxElement'>
                                    <div class='img-preview'>
                                        <img alt='' src='" . PBIMGURL . "/add_image.png'>
                                    </div>
                                </div><!-- .img-item -->
                                <div class='img-item style_small add_video_slider'>
                                    <div class='img-preview'>
                                        <img alt='' class='previmg' data-full-url='" . PBIMGURL . "/video_item.png' src='" . PBIMGURL . "/add_video.png'>
                                    </div>
                                </div><!-- .img-item -->
                                <div class='clear'></div>
                            </div>
                        </div>
                        <div class='hr_double style2'></div>
                        <div class='padding-cont'>
                            <div class='radio_block'>
                                <div style='width: 190px;' class='caption'><h2 style='color:#A1A1A1;' class='text-shadow2'>show thumbnails</h2></div>
                                <div class='radio_selector'>
                                    " . toggle_radio_on_off('pagebuilder[sliders][fullscreen][thumbnails]', (isset($gt3_pagebuilder['sliders']['fullscreen']['thumbnails']) ? $gt3_pagebuilder['sliders']['fullscreen']['thumbnails'] : ''), 'on') . "
                                </div>
                                <div class='help_here help text-shadow2'>
                                    &nbsp;
                                </div>
                                <div class='clear'></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END FULLSCREEN SLIDER SETTINGS -->";
    }


    if ($gt3_pbconfig['enable_fullwidth_slider'] == true && in_array($now_post_type, $gt3_pbconfig['fullwidth_slider_enabled_for'])) {
        echo "
            <!-- FULLWIDTH SLIDER SETTINGS -->
            <div class='padding-cont  stand-s pt_" . $now_post_type . "' style='padding-top:20px;padding-bottom:0px;'>
                <div class='bg_or_slider_option slider_type active'>
                    <input type='hidden' name='settings_type' value='fullwidth' class='settings_type'>
                    <div class='heading line_option visual_style1'>
                        <div class='option_title'>Full width</div>
                        <div class='toggler'>" . toggle_radio_on_off('pagebuilder[sliders][fullwidth][status]', $gt3_pagebuilder['sliders']['fullwidth']['status'], 'off', 'fullwidth_toggler bg_slide_sett') . "</div>
                        <div class='pre_toggler'></div>
                    </div>
                    <div class='hideable-area'>
                        <div class='padding-cont help text-shadow2'>Fullwidth slider description</div>
                        <div class='padding-cont' style='padding-bottom:11px;'>
                            <div class='selected_media'>
                                <div class='append_block'>
                                     <ul class='sortable-img-items'>
                                       " . get_slider_items("fullwidth", $gt3_pagebuilder['sliders']['fullwidth']['slides']) . "
                                     </ul>
                                </div>
                                <div class='clear'></div>
                            </div>
                        </div>
                        <div style='' class='hr_double style2'></div>
                        <div class='padding-cont' style='padding-top:12px;'>
                            <h2 class='dark_bg' style='margin-bottom:0px;'>select media</h2>
                            <div class='available_media'>
                                <div class='ajax_cont'>
                                    " . get_media_html($media_for_this_post, "small") . "
                                </div>
                                <div class='img-item style_small add_image_to_sliders_available_media cboxElement'>
                                    <div class='img-preview'>
                                        <img alt='' src='" . PBIMGURL . "/add_image.png'>
                                    </div>
                                </div><!-- .img-item -->
                                <div class='img-item style_small add_video_slider'>
                                    <div class='img-preview'>
                                        <img alt='' class='previmg' data-full-url='" . PBIMGURL . "/video_item.png' src='" . PBIMGURL . "/add_video.png'>
                                    </div>
                                </div><!-- .img-item -->
                                <div class='clear'></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END FULLWIDTH SLIDER SETTINGS -->";
    }


    if ($gt3_pbconfig['enable_background_image'] == true && in_array($now_post_type, $gt3_pbconfig['bg_image_enabled_for'])) {

        if (get_theme_option("show_bg_img_by_default") == "yes") {
            if (strlen($gt3_pagebuilder['settings']['bg_image']['src']) < 1) {
                $gt3_pagebuilder['settings']['bg_image']['src'] = get_theme_option("bg_img");
            }
        }

        /* Default value for page bg */
        if (!isset($gt3_pagebuilder['settings']['bg_image']['src'])) {$gt3_pagebuilder['settings']['bg_image']['src']="";}
        if (strlen($gt3_pagebuilder['settings']['bg_image']['src']) < 1) {
            $gt3_pagebuilder['settings']['bg_image']['src'] = get_theme_option("bg_img");
        }

        if (get_theme_option("show_bg_img_by_default") == "on") {
            $bg_img_open_state = "on";
        } else {
            $bg_img_open_state = "off";
        }

        if (!isset($gt3_pagebuilder['settings']['bg_image']['type'])) {$gt3_pagebuilder['settings']['bg_image']['type']="";}
        if (strlen($gt3_pagebuilder['settings']['bg_image']['type']) < 1) {
            $gt3_pagebuilder['settings']['bg_image']['type'] = get_theme_option("default_bg_img_position");
        }

        echo "
            <!-- BACKGROUND IMAGE SETTINGS -->
            <div class='padding-cont  stand-s' style='padding-top:20px;padding-bottom:0px;'>
                <div class='bg_or_slider_option bg_type active'>
                    <input type='hidden' name='settings_type' value='background_image' class='settings_type'>
                    <div class='heading line_option visual_style1'>
                        <div class='option_title'>Background image</div>
                        <div class='toggler'>" . toggle_radio_on_off('pagebuilder[settings][bg_image][status]', (isset($gt3_pagebuilder['settings']['bg_image']['status']) ? $gt3_pagebuilder['settings']['bg_image']['status'] : ''), $bg_img_open_state, 'bgimage_toggler bg_slide_sett') . "</div>
                        <div class='pre_toggler'></div>
                    </div>
                    <div class='hideable-area'>
                        <div class='padding-cont' style='padding-bottom:11px;'>
                            <div class='bg_for_this_page w2 fl'>
                                <div class='img-item'>
                                    <input type='hidden' class='bg_image_src' value='{$gt3_pagebuilder['settings']['bg_image']['src']}' name='pagebuilder[settings][bg_image][src]'>
                                    <input type='hidden' class='bg_image_type' value='{$gt3_pagebuilder['settings']['bg_image']['type']}' name='pagebuilder[settings][bg_image][type]'>
                                    <div class='img-preview'>
                                        <img class='preview_bg_image' src='" . aq_resize($gt3_pagebuilder['settings']['bg_image']['src'], 156, 106, true, true, true) . "' alt=''>
                                    </div>
                                </div>
                            </div>
                            <div class='w8 fl right_block'>
                                <h2 class='dark_bg' style='margin-bottom:10px;line-height: 15px !important;'>choose image position</h2>
                                <select class='newselect type_on_dark_bg' name='pagebuilder[settings][bg_image][type]' style='width:350px;'>";
        the_select_options($gt3_pbconfig['page_bg_available_types'], $gt3_pagebuilder['settings']['bg_image']['type']);
        echo "  </select>
                                <div class='help'>

                                </div>
                            </div>
                            <div class='clear'></div>
                        </div>
                        <div style='' class='hr_double style2'></div>
                        <div class='padding-cont' style='padding-top:12px;'>
                            <h2 class='dark_bg' style='margin-bottom:0px;'>select image</h2>
                            <div class='available_media'>
                                <div class='ajax_cont'>
                                    " . get_media_html($media_for_this_post, "small") . "
                                </div>
                                <div class='img-item style_small add_image_to_sliders_available_media cboxElement'>
                                    <div class='img-preview'>
                                        <img alt='' src='" . PBIMGURL . "/add_image.png'>
                                    </div>
                                </div><!-- .img-item -->
                                <div class='clear'></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END BACKGROUND IMAGE SETTINGS -->";
    }


    if ($gt3_pbconfig['enable_background_color'] == true && in_array($now_post_type, $gt3_pbconfig['bg_color_enabled_for'])) {

        if (get_theme_option("show_bg_color_by_default") == "on") {
            $show_color_by_default = "on";
        } else {
            $show_color_by_default = "off";
        }

        if (!isset($gt3_pagebuilder['settings']['custom_color']['value'])) {
            $gt3_pagebuilder['settings']['custom_color']['value'] = get_theme_option("default_bg_color");
        }

        echo "
            <!-- BACKGROUND COLOR SETTINGS -->
            <div class='padding-cont stand-s' style='padding-top:20px;'>
                <div class='bg_or_slider_option custom_color_type active'>
                    <input type='hidden' name='settings_type' value='custom_color' class='settings_type'>
                    <div class='heading line_option visual_style1'>
                        <div class='option_title'>Background color</div>
                        <div class='toggler'>" . toggle_radio_on_off('pagebuilder[settings][custom_color][status]', (isset($gt3_pagebuilder['settings']['custom_color']['status']) ? $gt3_pagebuilder['settings']['custom_color']['status'] : ''), $show_color_by_default, 'bgcolor_toggler bg_slide_sett') . "</div>
                        <div class='pre_toggler'></div>
                    </div>
                    <div class='hideable-area'>
                        <div class='padding-cont' style='padding-bottom:20px;'>
                            <h2 style='margin-bottom:10px;line-height: 15px !important;' class='dark_bg'>choose background color</h2>
                            <div class='left_block'>
                                " . colorpicker_block("pagebuilder[settings][custom_color][value]", (isset($gt3_pagebuilder['settings']['custom_color']['value']) ? $gt3_pagebuilder['settings']['custom_color']['value'] : ''), "background_color") . "
                            </div>
                            <div class='right_block help' style='padding-left:12px;padding-top:2px;'>

                            </div>
                            <div class='clear'></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END BACKGROUND COLOR SETTINGS -->";
    }


    echo "
        </div>
    </div>
</div>
";
}
#END SLIDERS & BACKGROUND AREA


#JS FOR AJAX UPLOADER
    ?>
<script type="text/javascript">

    function reactivate_ajax_image_upload() {
        var admin_ajax = '<?php echo admin_url("admin-ajax.php"); ?>';
        $('.btn_upload_image').each(function () {
            var clickedObject = jQuery(this);
            var clickedID = jQuery(this).attr('id');
            new AjaxUpload(clickedID, {
                action:'<?php echo admin_url("admin-ajax.php"); ?>',
                name:clickedID, // File upload name
                data:{ // Additional data to send
                    action:'mix_ajax_post_action',
                    type:'upload',
                    data:clickedID },
                autoSubmit:true, // Submit file after selection
                responseType:false,
                onChange:function (file, extension) {
                },
                onSubmit:function (file, extension) {
                    clickedObject.text('Uploading'); // change button text, when user selects file
                    this.disable(); // If you want to allow uploading only 1 file at time, you can disable upload button
                    interval = window.setInterval(function () {
                        var text = clickedObject.text();
                        if (text.length < 13) {
                            clickedObject.text(text + '.');
                        }
                        else {
                            clickedObject.text('Uploading');
                        }
                    }, 200);
                },
                onComplete:function (file, response) {

                    window.clearInterval(interval);
                    clickedObject.text('Upload Image');
                    this.enable(); // enable upload button

                    // If there was an error
                    if (response.search('Upload Error') > -1) {
                        var buildReturn = '<span class="upload-error">' + response + '</span>';
                        jQuery(".upload-error").remove();
                        clickedObject.parent().after(buildReturn);

                    }
                    else {
                        var buildReturn = '<a href="' + response + '" class="uploaded-image" target="_blank"><img class="hide option-image" id="image_' + clickedID + '" src="' + response + '" alt="" /></a>';

                        jQuery(".upload-error").remove();
                        jQuery("#image_" + clickedID).remove();
                        clickedObject.parent().next().after(buildReturn);
                        jQuery('img#image_' + clickedID).fadeIn();
                        clickedObject.next('span').fadeIn();
                        clickedObject.parent().prev('input').val(response);
                    }
                }
            });
        });
    }


    $(document).ready(function () {
        reactivate_ajax_image_upload();
    });
</script>
<?php #END JS FOR AJAX UPLOADER ?>

<?php
#DEVELOPER CONSOLE
    if ($gt3_pbconfig['dev_console'] == true || get_theme_option("dev_console") == "true") {
        echo "<pre style='color:#000000;'>";
        print_r($gt3_pagebuilder);
        echo "</pre>";
    }

}

#START SAVE MODULE
function save_postdata($post_id)
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    #if (!wp_verify_nonce($_POST['pagebuilder_noncename'], plugin_basename(__FILE__)))
    #    return;

    #CHECK PERMISSIONS
    if (!current_user_can('edit_post', $post_id))
        return;

    #START SAVING
    if (isset($_POST['pagebuilder'])) {
        update_theme_pagebuilder($post_id, "pagebuilder", $_POST['pagebuilder']);
    }
}

?>