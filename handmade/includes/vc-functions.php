<?php
add_action('vc_before_init', 'g5plus_vcSetAsTheme');
function g5plus_vcSetAsTheme()
{
    vc_set_as_theme();
}

function g5plus_vc_remove_frontend_links()
{
    vc_disable_frontend();
}

add_action('vc_after_init', 'g5plus_vc_remove_frontend_links');

function g5plus_number_settings_field($settings, $value)
{
    $param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
    $type = isset($settings['type']) ? $settings['type'] : '';
    $min = isset($settings['min']) ? $settings['min'] : '';
    $max = isset($settings['max']) ? $settings['max'] : '';
    $suffix = isset($settings['suffix']) ? $settings['suffix'] : '';
    $class = isset($settings['class']) ? $settings['class'] : '';
    $output = '<input type="number" min="' . esc_attr($min) . '" max="' . esc_attr($max) . '" class="wpb_vc_param_value ' . esc_attr($param_name) . ' ' . esc_attr($type) . ' ' . esc_attr($class) . '" name="' . esc_attr($param_name) . '" value="' . esc_attr($value) . '" style="max-width:100px; margin-right: 10px;" />' . esc_attr($suffix);
    return $output;
}

function g5plus_icon_text_settings_field($settings, $value)
{
    return '<div class="vc-text-icon">'
    . '<input  name="' . $settings['param_name'] . '" style="width:80%;" class="wpb_vc_param_value wpb-textinput widefat input-icon ' . esc_attr($settings['param_name']) . ' ' . esc_attr($settings['type']) . '_field" type="text" value="' . esc_attr($value) . '"/>'
    . '<input title="' . esc_html__('Click to browse icon', 'g5plus-handmade') . '" style="width:20%; height:34px;" class="browse-icon button-secondary" type="button" value="' . esc_html__('Browse Icon', 'g5plus-handmade') . '" >'
    . '<span class="icon-preview"><i class="' . esc_attr($value) . '"></i></span>'
    . '</div>';
}

function g5plus_multi_select_settings_field_shortcode_param($settings, $value)
{
    $param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
    $param_option = isset($settings['options']) ? $settings['options'] : '';
    $output = '<input type="hidden" name="' . $param_name . '" id="' . $param_name . '" class="wpb_vc_param_value ' . $param_name . '" value="' . $value . '"/>';
    $output .= '<select multiple id="' . $param_name . '_select2" name="' . $param_name . '_select2" class="multi-select">';
    if ($param_option != '' && is_array($param_option)) {
        foreach ($param_option as $text_val => $val) {
            if (is_numeric($text_val) && (is_string($val) || is_numeric($val))) {
                $text_val = $val;
            }
            $output .= '<option id="' . $val . '" value="' . $val . '">' . htmlspecialchars($text_val) . '</option>';
        }
    }

    $output .= '</select><input type="checkbox" id="' . $param_name . '_select_all" >' . esc_html__('Select All', 'g5plus-handmade');
    $output .= '<script type="text/javascript">
		        jQuery(document).ready(function($){

					$("#' . $param_name . '_select2").select2();

					var order = $("#' . $param_name . '").val();
					if (order != "") {
						order = order.split(",");
						var choices = [];
						for (var i = 0; i < order.length; i++) {
							var option = $("#' . $param_name . '_select2 option[value="+ order[i]  + "]");
							if (option.length > 0) {
							    choices[i] = {id:order[i], text:option[0].label, element: option};
							}
						}
						$("#' . $param_name . '_select2").select2("data", choices);
					}

			        $("#' . $param_name . '_select2").on("select2-selecting", function(e) {
			            var ids = $("#' . $param_name . '").val();
			            if (ids != "") {
			                ids +=",";
			            }
			            ids += e.val;
			            $("#' . $param_name . '").val(ids);
                    }).on("select2-removed", function(e) {
				          var ids = $("#' . $param_name . '").val();
				          var arr_ids = ids.split(",");
				          var newIds = "";
				          for(var i = 0 ; i < arr_ids.length; i++) {
				            if (arr_ids[i] != e.val){
				                if (newIds != "") {
			                        newIds +=",";
					            }
					            newIds += arr_ids[i];
				            }
				          }
				          $("#' . $param_name . '").val(newIds);
		             });

		            $("#' . $param_name . '_select_all").click(function(){
		                if($("#' . $param_name . '_select_all").is(":checked") ){
		                    $("#' . $param_name . '_select2 > option").prop("selected","selected");
		                    $("#' . $param_name . '_select2").trigger("change");
		                    var arr_ids =  $("#' . $param_name . '_select2").select2("val");
		                    var ids = "";
                            for (var i = 0; i < arr_ids.length; i++ ) {
                                if (ids != "") {
                                    ids +=",";
                                }
                                ids += arr_ids[i];
                            }
                            $("#' . $param_name . '").val(ids);

		                }else{
		                    $("#' . $param_name . '_select2 > option").removeAttr("selected");
		                    $("#' . $param_name . '_select2").trigger("change");
		                    $("#' . $param_name . '").val("");
		                }
		            });
		        });
		        </script>
		        <style>
		            .multi-select
		            {
		              width: 100%;
		            }
		            .select2-drop
		            {
		                z-index: 100000;
		            }
		        </style>';
    return $output;
}

function g5plus_tags_settings_field_shortcode_param($settings, $value)
{
    $param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
    $output = '<input  name="' . $settings['param_name']
        . '" class="wpb_vc_param_value wpb-textinput '
        . $settings['param_name'] . ' ' . $settings['type']
        . '" type="hidden" value="' . $value . '"/>';
    $output .= '<input type="text" name="' . $param_name . '_tagsinput" id="' . $param_name . '_tagsinput" value="' . $value . '" data-role="tagsinput"/>';
    $output .= '<script type="text/javascript">
							jQuery(document).ready(function($){
								$("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();

								$("#' . $param_name . '_tagsinput").on("itemAdded", function(event) {
		                             $("input[name=' . $param_name . ']").val($(this).val());
								});

								$("#' . $param_name . '_tagsinput").on("itemRemoved", function(event) {
		                             $("input[name=' . $param_name . ']").val($(this).val());
								});
							});
						</script>';
    return $output;
}

if (function_exists('vc_add_shortcode_param')) {
    vc_add_shortcode_param('number', 'g5plus_number_settings_field');
    vc_add_shortcode_param('icon_text', 'g5plus_icon_text_settings_field');
    vc_add_shortcode_param('multi-select', 'g5plus_multi_select_settings_field_shortcode_param');
    vc_add_shortcode_param('tags', 'g5plus_tags_settings_field_shortcode_param');
}
function g5plus_add_vc_param()
{
    if (function_exists('vc_add_param')) {
        $pe_7_stroke_icons = array(
            array('pe-7s-album' => 'pe-7s-album'),
            array('pe-7s-arc' => 'pe-7s-arc'),
            array('pe-7s-back-2' => 'pe-7s-back-2'),
            array('pe-7s-bandaid' => 'pe-7s-bandaid'),
            array('pe-7s-car' => 'pe-7s-car'),
            array('pe-7s-diamond' => 'pe-7s-diamond'),
            array('pe-7s-door-lock' => 'pe-7s-door-lock'),
            array('pe-7s-eyedropper' => 'pe-7s-eyedropper'),
            array('pe-7s-female' => 'pe-7s-female'),
            array('pe-7s-gym' => 'pe-7s-gym'),
            array('pe-7s-hammer' => 'pe-7s-hammer'),
            array('pe-7s-headphones' => 'pe-7s-headphones'),
            array('pe-7s-helm' => 'pe-7s-helm'),
            array('pe-7s-hourglass' => 'pe-7s-hourglass'),
            array('pe-7s-leaf' => 'pe-7s-leaf'),
            array('pe-7s-magic-wand' => 'pe-7s-magic-wand'),
            array('pe-7s-male' => 'pe-7s-male'),
            array('pe-7s-map-2' => 'pe-7s-map-2'),
            array('pe-7s-next-2' => 'pe-7s-next-2'),
            array('pe-7s-paint-bucket' => 'pe-7s-paint-bucket'),
            array('pe-7s-pendrive' => 'pe-7s-pendrive'),
            array('pe-7s-photo' => 'pe-7s-photo'),
            array('pe-7s-piggy' => 'pe-7s-piggy'),
            array('pe-7s-plugin' => 'pe-7s-plugin'),
            array('pe-7s-refresh-2' => 'pe-7s-refresh-2'),
            array('pe-7s-rocket' => 'pe-7s-rocket'),
            array('pe-7s-settings' => 'pe-7s-settings'),
            array('pe-7s-shield' => 'pe-7s-shield'),
            array('pe-7s-smile' => 'pe-7s-smile'),
            array('pe-7s-usb' => 'pe-7s-usb'),
            array('pe-7s-vector' => 'pe-7s-vector'),
            array('pe-7s-wine' => 'pe-7s-wine'),
            array('pe-7s-cloud-upload' => 'pe-7s-cloud-upload'),
            array('pe-7s-cash' => 'pe-7s-cash'),
            array('pe-7s-close' => 'pe-7s-close'),
            array('pe-7s-bluetooth' => 'pe-7s-bluetooth'),
            array('pe-7s-cloud-download' => 'pe-7s-cloud-download'),
            array('pe-7s-way' => 'pe-7s-way'),
            array('pe-7s-close-circle' => 'pe-7s-close-circle'),
            array('pe-7s-id' => 'pe-7s-id'),
            array('pe-7s-angle-up' => 'pe-7s-angle-up'),
            array('pe-7s-wristwatch' => 'pe-7s-wristwatch'),
            array('pe-7s-angle-up-circle' => 'pe-7s-angle-up-circle'),
            array('pe-7s-world' => 'pe-7s-world'),
            array('pe-7s-angle-right' => 'pe-7s-angle-right'),
            array('pe-7s-volume' => 'pe-7s-volume'),
            array('pe-7s-angle-right-circle' => 'pe-7s-angle-right-circle'),
            array('pe-7s-users' => 'pe-7s-users'),
            array('pe-7s-angle-left' => 'pe-7s-angle-left'),
            array('pe-7s-user-female' => 'pe-7s-user-female'),
            array('pe-7s-angle-left-circle' => 'pe-7s-angle-left-circle'),
            array('pe-7s-up-arrow' => 'pe-7s-up-arrow'),
            array('pe-7s-angle-down' => 'pe-7s-angle-down'),
            array('pe-7s-switch' => 'pe-7s-switch'),
            array('pe-7s-angle-down-circle' => 'pe-7s-angle-down-circle'),
            array('pe-7s-scissors' => 'pe-7s-scissors'),
            array('pe-7s-wallet' => 'pe-7s-wallet'),
            array('pe-7s-safe' => 'pe-7s-safe'),
            array('pe-7s-volume2' => 'pe-7s-volume2'),
            array('pe-7s-volume1' => 'pe-7s-volume1'),
            array('pe-7s-voicemail' => 'pe-7s-voicemail'),
            array('pe-7s-video' => 'pe-7s-video'),
            array('pe-7s-user' => 'pe-7s-user'),
            array('pe-7s-upload' => 'pe-7s-upload'),
            array('pe-7s-unlock' => 'pe-7s-unlock'),
            array('pe-7s-umbrella' => 'pe-7s-umbrella'),
            array('pe-7s-trash' => 'pe-7s-trash'),
            array('pe-7s-tools' => 'pe-7s-tools'),
            array('pe-7s-timer' => 'pe-7s-timer'),
            array('pe-7s-ticket' => 'pe-7s-ticket'),
            array('pe-7s-target' => 'pe-7s-target'),
            array('pe-7s-sun' => 'pe-7s-sun'),
            array('pe-7s-study' => 'pe-7s-study'),
            array('pe-7s-stopwatch' => 'pe-7s-stopwatch'),
            array('pe-7s-star' => 'pe-7s-star'),
            array('pe-7s-speaker' => 'pe-7s-speaker'),
            array('pe-7s-signal' => 'pe-7s-signal'),
            array('pe-7s-shuffle' => 'pe-7s-shuffle'),
            array('pe-7s-shopbag' => 'pe-7s-shopbag'),
            array('pe-7s-share' => 'pe-7s-share'),
            array('pe-7s-server' => 'pe-7s-server'),
            array('pe-7s-search' => 'pe-7s-search'),
            array('pe-7s-film' => 'pe-7s-film'),
            array('pe-7s-science' => 'pe-7s-science'),
            array('pe-7s-disk' => 'pe-7s-disk'),
            array('pe-7s-ribbon' => 'pe-7s-ribbon'),
            array('pe-7s-repeat' => 'pe-7s-repeat'),
            array('pe-7s-refresh' => 'pe-7s-refresh'),
            array('pe-7s-add-user' => 'pe-7s-add-user'),
            array('pe-7s-refresh-cloud' => 'pe-7s-refresh-cloud'),
            array('pe-7s-paperclip' => 'pe-7s-paperclip'),
            array('pe-7s-radio' => 'pe-7s-radio'),
            array('pe-7s-note2' => 'pe-7s-note2'),
            array('pe-7s-print' => 'pe-7s-print'),
            array('pe-7s-network' => 'pe-7s-network'),
            array('pe-7s-prev' => 'pe-7s-prev'),
            array('pe-7s-mute' => 'pe-7s-mute'),
            array('pe-7s-power' => 'pe-7s-power'),
            array('pe-7s-medal' => 'pe-7s-medal'),
            array('pe-7s-portfolio' => 'pe-7s-portfolio'),
            array('pe-7s-like2' => 'pe-7s-like2'),
            array('pe-7s-plus' => 'pe-7s-plus'),
            array('pe-7s-left-arrow' => 'pe-7s-left-arrow'),
            array('pe-7s-play' => 'pe-7s-play'),
            array('pe-7s-key' => 'pe-7s-key'),
            array('pe-7s-plane' => 'pe-7s-plane'),
            array('pe-7s-joy' => 'pe-7s-joy'),
            array('pe-7s-photo-gallery' => 'pe-7s-photo-gallery'),
            array('pe-7s-pin' => 'pe-7s-pin'),
            array('pe-7s-phone' => 'pe-7s-phone'),
            array('pe-7s-plug' => 'pe-7s-plug'),
            array('pe-7s-pen' => 'pe-7s-pen'),
            array('pe-7s-right-arrow' => 'pe-7s-right-arrow'),
            array('pe-7s-paper-plane' => 'pe-7s-paper-plane'),
            array('pe-7s-delete-user' => 'pe-7s-delete-user'),
            array('pe-7s-paint' => 'pe-7s-paint'),
            array('pe-7s-bottom-arrow' => 'pe-7s-bottom-arrow'),
            array('pe-7s-notebook' => 'pe-7s-notebook'),
            array('pe-7s-note' => 'pe-7s-note'),
            array('pe-7s-next' => 'pe-7s-next'),
            array('pe-7s-news-paper' => 'pe-7s-news-paper'),
            array('pe-7s-musiclist' => 'pe-7s-musiclist'),
            array('pe-7s-music' => 'pe-7s-music'),
            array('pe-7s-mouse' => 'pe-7s-mouse'),
            array('pe-7s-more' => 'pe-7s-more'),
            array('pe-7s-moon' => 'pe-7s-moon'),
            array('pe-7s-monitor' => 'pe-7s-monitor'),
            array('pe-7s-micro' => 'pe-7s-micro'),
            array('pe-7s-menu' => 'pe-7s-menu'),
            array('pe-7s-map' => 'pe-7s-map'),
            array('pe-7s-map-marker' => 'pe-7s-map-marker'),
            array('pe-7s-mail' => 'pe-7s-mail'),
            array('pe-7s-mail-open' => 'pe-7s-mail-open'),
            array('pe-7s-mail-open-file' => 'pe-7s-mail-open-file'),
            array('pe-7s-magnet' => 'pe-7s-magnet'),
            array('pe-7s-loop' => 'pe-7s-loop'),
            array('pe-7s-look' => 'pe-7s-look'),
            array('pe-7s-lock' => 'pe-7s-lock'),
            array('pe-7s-lintern' => 'pe-7s-lintern'),
            array('pe-7s-link' => 'pe-7s-link'),
            array('pe-7s-like' => 'pe-7s-like'),
            array('pe-7s-light' => 'pe-7s-light'),
            array('pe-7s-less' => 'pe-7s-less'),
            array('pe-7s-keypad' => 'pe-7s-keypad'),
            array('pe-7s-junk' => 'pe-7s-junk'),
            array('pe-7s-info' => 'pe-7s-info'),
            array('pe-7s-home' => 'pe-7s-home'),
            array('pe-7s-help2' => 'pe-7s-help2'),
            array('pe-7s-help1' => 'pe-7s-help1'),
            array('pe-7s-graph3' => 'pe-7s-graph3'),
            array('pe-7s-graph2' => 'pe-7s-graph2'),
            array('pe-7s-graph1' => 'pe-7s-graph1'),
            array('pe-7s-graph' => 'pe-7s-graph'),
            array('pe-7s-global' => 'pe-7s-global'),
            array('pe-7s-gleam' => 'pe-7s-gleam'),
            array('pe-7s-glasses' => 'pe-7s-glasses'),
            array('pe-7s-gift' => 'pe-7s-gift'),
            array('pe-7s-folder' => 'pe-7s-folder'),
            array('pe-7s-flag' => 'pe-7s-flag'),
            array('pe-7s-filter' => 'pe-7s-filter'),
            array('pe-7s-file' => 'pe-7s-file'),
            array('pe-7s-expand1' => 'pe-7s-expand1'),
            array('pe-7s-exapnd2' => 'pe-7s-exapnd2'),
            array('pe-7s-edit' => 'pe-7s-edit'),
            array('pe-7s-drop' => 'pe-7s-drop'),
            array('pe-7s-drawer' => 'pe-7s-drawer'),
            array('pe-7s-download' => 'pe-7s-download'),
            array('pe-7s-display2' => 'pe-7s-display2'),
            array('pe-7s-display1' => 'pe-7s-display1'),
            array('pe-7s-diskette' => 'pe-7s-diskette'),
            array('pe-7s-date' => 'pe-7s-date'),
            array('pe-7s-cup' => 'pe-7s-cup'),
            array('pe-7s-culture' => 'pe-7s-culture'),
            array('pe-7s-crop' => 'pe-7s-crop'),
            array('pe-7s-credit' => 'pe-7s-credit'),
            array('pe-7s-copy-file' => 'pe-7s-copy-file'),
            array('pe-7s-config' => 'pe-7s-config'),
            array('pe-7s-compass' => 'pe-7s-compass'),
            array('pe-7s-comment' => 'pe-7s-comment'),
            array('pe-7s-coffee' => 'pe-7s-coffee'),
            array('pe-7s-cloud' => 'pe-7s-cloud'),
            array('pe-7s-clock' => 'pe-7s-clock'),
            array('pe-7s-check' => 'pe-7s-check'),
            array('pe-7s-chat' => 'pe-7s-chat'),
            array('pe-7s-cart' => 'pe-7s-cart'),
            array('pe-7s-camera' => 'pe-7s-camera'),
            array('pe-7s-call' => 'pe-7s-call'),
            array('pe-7s-calculator' => 'pe-7s-calculator'),
            array('pe-7s-browser' => 'pe-7s-browser'),
            array('pe-7s-box2' => 'pe-7s-box2'),
            array('pe-7s-box1' => 'pe-7s-box1'),
            array('pe-7s-bookmarks' => 'pe-7s-bookmarks'),
            array('pe-7s-bicycle' => 'pe-7s-bicycle'),
            array('pe-7s-bell' => 'pe-7s-bell'),
            array('pe-7s-battery' => 'pe-7s-battery'),
            array('pe-7s-ball' => 'pe-7s-ball'),
            array('pe-7s-back' => 'pe-7s-back'),
            array('pe-7s-attention' => 'pe-7s-attention'),
            array('pe-7s-anchor' => 'pe-7s-anchor'),
            array('pe-7s-albums' => 'pe-7s-albums'),
            array('pe-7s-alarm' => 'pe-7s-alarm'),
            array('pe-7s-airplay' => 'pe-7s-airplay'),
        );

        vc_add_param('vc_tta_accordion', array(
                'type' => 'dropdown',
                'param_name' => 'style',
                'value' => array(
                    esc_html__('Content border', 'g5plus-handmade') => 'accordion_style1',
                    esc_html__('Content background', 'g5plus-handmade') => 'accordion_style2',
                    esc_html__('Classic', 'g5plus-handmade') => 'classic',
                    esc_html__('Modern', 'g5plus-handmade') => 'modern',
                    esc_html__('Flat', 'g5plus-handmade') => 'flat',
                    esc_html__('Outline', 'g5plus-handmade') => 'outline',
                ),
                'heading' => esc_html__('Style', 'g5plus-handmade'),
                'description' => esc_html__('Select accordion display style.', 'g5plus-handmade'),
                'weight' => 1,
            )
        );
        vc_add_param('vc_tta_tabs', array(
                'type' => 'dropdown',
                'param_name' => 'style',
                'value' => array(
                    esc_html__('Handmade', 'js_composer') => 'tab_style1',
                    esc_html__('Classic', 'js_composer') => 'classic',
                    esc_html__('Modern', 'js_composer') => 'modern',
                    esc_html__('Flat', 'js_composer') => 'flat',
                    esc_html__('Outline', 'js_composer') => 'outline',
                ),
                'heading' => esc_html__('Style', 'js_composer'),
                'description' => esc_html__('Select tabs display style.', 'js_composer'),
                'weight' => 1,
            )
        );
        vc_add_param('vc_tta_tour', array(
                'type' => 'dropdown',
                'param_name' => 'style',
                'value' => array(
                    esc_html__('Handmade', 'g5plus-handmade') => 'tour_style1',
                    esc_html__('Classic', 'js_composer') => 'classic',
                    esc_html__('Modern', 'js_composer') => 'modern',
                    esc_html__('Flat', 'js_composer') => 'flat',
                    esc_html__('Outline', 'js_composer') => 'outline',
                ),
                'heading' => esc_html__('Style', 'js_composer'),
                'description' => esc_html__('Select tour display style.', 'g5plus-handmade'),
                'weight' => 1,
            )
        );
        vc_remove_param('vc_icon', 'type');
        vc_add_param('vc_icon', array(
                'type' => 'dropdown',
                'heading' => esc_html__('Icon library', 'g5plus-handmade'),
                'value' => array(
                    esc_html__('Pe Icon 7 Stroke', 'g5plus-handmade') => 'pe_7_stroke',
                    esc_html__('Font Awesome', 'g5plus-handmade') => 'fontawesome',
                    esc_html__('Open Iconic', 'g5plus-handmade') => 'openiconic',
                    esc_html__('Typicons', 'g5plus-handmade') => 'typicons',
                    esc_html__('Entypo', 'g5plus-handmade') => 'entypo',
                    esc_html__('Linecons', 'g5plus-handmade') => 'linecons',
                ),
                'admin_label' => true,
                'weight' => 2,
                'param_name' => 'type',
                'description' => esc_html__('Select icon library.', 'g5plus-handmade'),
            )
        );
        vc_add_param('vc_icon', array(
                'type' => 'iconpicker',
                'heading' => esc_html__('Icon', 'g5plus-handmade'),
                'param_name' => 'icon_pe_7_stroke',
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'iconsPerPage' => 4000,
                    'type' => 'pe_7_stroke',
                    'source' => $pe_7_stroke_icons,
                ),
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'pe_7_stroke',
                ),
                'weight' => 1,
                'description' => esc_html__('Select icon from library.', 'g5plus-handmade'),
            )
        );

        vc_add_param('vc_progress_bar', array(
                'type' => 'dropdown',
                'heading' => esc_html__('Layout Style', 'g5plus-handmade'),
                'param_name' => 'layout_style',
                'admin_label' => true,
                'value' => array(esc_html__('style 1', 'g5plus-handmade') => 'style1', esc_html__('style 2', 'g5plus-handmade') => 'style2', esc_html__('style 3', 'g5plus-handmade') => 'style3'),
                'description' => esc_html__('Select Layout Style.', 'g5plus-handmade'),
                'weight' => 1
            )
        );
        $settings_vc_map = array(
            'category' => array(esc_html__('Content', 'g5plus-handmade'), esc_html__('Handmade Shortcodes', 'g5plus-handmade'))
        );
        vc_map_update('vc_tta_tabs', $settings_vc_map);
        vc_map_update('vc_tta_tour', $settings_vc_map);
        vc_map_update('vc_tta_accordion', $settings_vc_map);
        vc_map_update('vc_progress_bar', $settings_vc_map);
        vc_map_update('vc_message', $settings_vc_map);
    }
}

g5plus_add_vc_param();

function g5plus_get_css_animation($css_animation)
{
    $output = '';
    if ($css_animation != '') {
        wp_enqueue_script('waypoints');
        $output = ' wpb_animate_when_almost_visible g5plus-css-animation ' . $css_animation;
    }
    return $output;
}

function g5plus_get_style_animation($duration, $delay)
{
    $styles = array();
    if ($duration != '0' && !empty($duration)) {
        $duration = (float)trim($duration, "\n\ts");
        $styles[] = "-webkit-animation-duration: {$duration}s";
        $styles[] = "-moz-animation-duration: {$duration}s";
        $styles[] = "-ms-animation-duration: {$duration}s";
        $styles[] = "-o-animation-duration: {$duration}s";
        $styles[] = "animation-duration: {$duration}s";
    }
    if ($delay != '0' && !empty($delay)) {
        $delay = (float)trim($delay, "\n\ts");
        $styles[] = "opacity: 0";
        $styles[] = "-webkit-animation-delay: {$delay}s";
        $styles[] = "-moz-animation-delay: {$delay}s";
        $styles[] = "-ms-animation-delay: {$delay}s";
        $styles[] = "-o-animation-delay: {$delay}s";
        $styles[] = "animation-delay: {$delay}s";
    }
    if (count($styles) > 1) {
        return 'style="' . implode(';', $styles) . '"';
    }
    return implode(';', $styles);
}

function  g5plus_convert_hex_to_rgba($hex, $opacity = 1)
{
    $hex = str_replace("#", "", $hex);
    if (strlen($hex) == 3) {
        $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
        $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
        $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
    } else {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    }
    $rgba = 'rgba(' . $r . ',' . $g . ',' . $b . ',' . $opacity . ')';
    return $rgba;
}


function register_vc_map()
{
    $add_css_animation = array(
        'type' => 'dropdown',
        'heading' => esc_html__('CSS Animation', 'g5plus-handmade'),
        'param_name' => 'css_animation',
        'value' => array(esc_html__('No', 'g5plus-handmade') => '', esc_html__('Fade In', 'g5plus-handmade') => 'wpb_fadeIn', esc_html__('Fade Top to Bottom', 'g5plus-handmade') => 'wpb_fadeInDown', esc_html__('Fade Bottom to Top', 'g5plus-handmade') => 'wpb_fadeInUp', esc_html__('Fade Left to Right', 'g5plus-handmade') => 'wpb_fadeInLeft', esc_html__('Fade Right to Left', 'g5plus-handmade') => 'wpb_fadeInRight', esc_html__('Bounce In', 'g5plus-handmade') => 'wpb_bounceIn', esc_html__('Bounce Top to Bottom', 'g5plus-handmade') => 'wpb_bounceInDown', esc_html__('Bounce Bottom to Top', 'g5plus-handmade') => 'wpb_bounceInUp', esc_html__('Bounce Left to Right', 'g5plus-handmade') => 'wpb_bounceInLeft', esc_html__('Bounce Right to Left', 'g5plus-handmade') => 'wpb_bounceInRight', esc_html__('Zoom In', 'g5plus-handmade') => 'wpb_zoomIn', esc_html__('Flip Vertical', 'g5plus-handmade') => 'wpb_flipInX', esc_html__('Flip Horizontal', 'g5plus-handmade') => 'wpb_flipInY', esc_html__('Bounce', 'g5plus-handmade') => 'wpb_bounce', esc_html__('Flash', 'g5plus-handmade') => 'wpb_flash', esc_html__('Shake', 'g5plus-handmade') => 'wpb_shake', esc_html__('Pulse', 'g5plus-handmade') => 'wpb_pulse', esc_html__('Swing', 'g5plus-handmade') => 'wpb_swing', esc_html__('Rubber band', 'g5plus-handmade') => 'wpb_rubberBand', esc_html__('Wobble', 'g5plus-handmade') => 'wpb_wobble', esc_html__('Tada', 'g5plus-handmade') => 'wpb_tada'),
        'description' => esc_html__('Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'g5plus-handmade'),
        'group' => esc_html__('Animation Settings', 'g5plus-handmade')
    );

    $add_duration_animation = array(
        'type' => 'textfield',
        'heading' => esc_html__('Animation Duration', 'g5plus-handmade'),
        'param_name' => 'duration',
        'value' => '',
        'description' => esc_html__('Duration in seconds. You can use decimal points in the value. Use this field to specify the amount of time the animation plays. <em>The default value depends on the animation, leave blank to use the default.</em>', 'g5plus-handmade'),
        'dependency' => Array('element' => 'css_animation', 'value' => array('wpb_fadeIn', 'wpb_fadeInDown', 'wpb_fadeInUp', 'wpb_fadeInLeft', 'wpb_fadeInRight', 'wpb_bounceIn', 'wpb_bounceInDown', 'wpb_bounceInUp', 'wpb_bounceInLeft', 'wpb_bounceInRight', 'wpb_zoomIn', 'wpb_flipInX', 'wpb_flipInY', 'wpb_bounce', 'wpb_flash', 'wpb_shake', 'wpb_pulse', 'wpb_swing', 'wpb_rubberBand', 'wpb_wobble', 'wpb_tada')),
        'group' => esc_html__('Animation Settings', 'g5plus-handmade')
    );

    $add_delay_animation = array(
        'type' => 'textfield',
        'heading' => esc_html__('Animation Delay', 'g5plus-handmade'),
        'param_name' => 'delay',
        'value' => '',
        'description' => esc_html__('Delay in seconds. You can use decimal points in the value. Use this field to delay the animation for a few seconds, this is helpful if you want to chain different effects one after another above the fold.', 'g5plus-handmade'),
        'dependency' => Array('element' => 'css_animation', 'value' => array('wpb_fadeIn', 'wpb_fadeInDown', 'wpb_fadeInUp', 'wpb_fadeInLeft', 'wpb_fadeInRight', 'wpb_bounceIn', 'wpb_bounceInDown', 'wpb_bounceInUp', 'wpb_bounceInLeft', 'wpb_bounceInRight', 'wpb_zoomIn', 'wpb_flipInX', 'wpb_flipInY', 'wpb_bounce', 'wpb_flash', 'wpb_shake', 'wpb_pulse', 'wpb_swing', 'wpb_rubberBand', 'wpb_wobble', 'wpb_tada')),
        'group' => esc_html__('Animation Settings', 'g5plus-handmade')
    );
    $pe_7_stroke_icons = array(
        array('pe-7s-album' => 'pe-7s-album'),
        array('pe-7s-arc' => 'pe-7s-arc'),
        array('pe-7s-back-2' => 'pe-7s-back-2'),
        array('pe-7s-bandaid' => 'pe-7s-bandaid'),
        array('pe-7s-car' => 'pe-7s-car'),
        array('pe-7s-diamond' => 'pe-7s-diamond'),
        array('pe-7s-door-lock' => 'pe-7s-door-lock'),
        array('pe-7s-eyedropper' => 'pe-7s-eyedropper'),
        array('pe-7s-female' => 'pe-7s-female'),
        array('pe-7s-gym' => 'pe-7s-gym'),
        array('pe-7s-hammer' => 'pe-7s-hammer'),
        array('pe-7s-headphones' => 'pe-7s-headphones'),
        array('pe-7s-helm' => 'pe-7s-helm'),
        array('pe-7s-hourglass' => 'pe-7s-hourglass'),
        array('pe-7s-leaf' => 'pe-7s-leaf'),
        array('pe-7s-magic-wand' => 'pe-7s-magic-wand'),
        array('pe-7s-male' => 'pe-7s-male'),
        array('pe-7s-map-2' => 'pe-7s-map-2'),
        array('pe-7s-next-2' => 'pe-7s-next-2'),
        array('pe-7s-paint-bucket' => 'pe-7s-paint-bucket'),
        array('pe-7s-pendrive' => 'pe-7s-pendrive'),
        array('pe-7s-photo' => 'pe-7s-photo'),
        array('pe-7s-piggy' => 'pe-7s-piggy'),
        array('pe-7s-plugin' => 'pe-7s-plugin'),
        array('pe-7s-refresh-2' => 'pe-7s-refresh-2'),
        array('pe-7s-rocket' => 'pe-7s-rocket'),
        array('pe-7s-settings' => 'pe-7s-settings'),
        array('pe-7s-shield' => 'pe-7s-shield'),
        array('pe-7s-smile' => 'pe-7s-smile'),
        array('pe-7s-usb' => 'pe-7s-usb'),
        array('pe-7s-vector' => 'pe-7s-vector'),
        array('pe-7s-wine' => 'pe-7s-wine'),
        array('pe-7s-cloud-upload' => 'pe-7s-cloud-upload'),
        array('pe-7s-cash' => 'pe-7s-cash'),
        array('pe-7s-close' => 'pe-7s-close'),
        array('pe-7s-bluetooth' => 'pe-7s-bluetooth'),
        array('pe-7s-cloud-download' => 'pe-7s-cloud-download'),
        array('pe-7s-way' => 'pe-7s-way'),
        array('pe-7s-close-circle' => 'pe-7s-close-circle'),
        array('pe-7s-id' => 'pe-7s-id'),
        array('pe-7s-angle-up' => 'pe-7s-angle-up'),
        array('pe-7s-wristwatch' => 'pe-7s-wristwatch'),
        array('pe-7s-angle-up-circle' => 'pe-7s-angle-up-circle'),
        array('pe-7s-world' => 'pe-7s-world'),
        array('pe-7s-angle-right' => 'pe-7s-angle-right'),
        array('pe-7s-volume' => 'pe-7s-volume'),
        array('pe-7s-angle-right-circle' => 'pe-7s-angle-right-circle'),
        array('pe-7s-users' => 'pe-7s-users'),
        array('pe-7s-angle-left' => 'pe-7s-angle-left'),
        array('pe-7s-user-female' => 'pe-7s-user-female'),
        array('pe-7s-angle-left-circle' => 'pe-7s-angle-left-circle'),
        array('pe-7s-up-arrow' => 'pe-7s-up-arrow'),
        array('pe-7s-angle-down' => 'pe-7s-angle-down'),
        array('pe-7s-switch' => 'pe-7s-switch'),
        array('pe-7s-angle-down-circle' => 'pe-7s-angle-down-circle'),
        array('pe-7s-scissors' => 'pe-7s-scissors'),
        array('pe-7s-wallet' => 'pe-7s-wallet'),
        array('pe-7s-safe' => 'pe-7s-safe'),
        array('pe-7s-volume2' => 'pe-7s-volume2'),
        array('pe-7s-volume1' => 'pe-7s-volume1'),
        array('pe-7s-voicemail' => 'pe-7s-voicemail'),
        array('pe-7s-video' => 'pe-7s-video'),
        array('pe-7s-user' => 'pe-7s-user'),
        array('pe-7s-upload' => 'pe-7s-upload'),
        array('pe-7s-unlock' => 'pe-7s-unlock'),
        array('pe-7s-umbrella' => 'pe-7s-umbrella'),
        array('pe-7s-trash' => 'pe-7s-trash'),
        array('pe-7s-tools' => 'pe-7s-tools'),
        array('pe-7s-timer' => 'pe-7s-timer'),
        array('pe-7s-ticket' => 'pe-7s-ticket'),
        array('pe-7s-target' => 'pe-7s-target'),
        array('pe-7s-sun' => 'pe-7s-sun'),
        array('pe-7s-study' => 'pe-7s-study'),
        array('pe-7s-stopwatch' => 'pe-7s-stopwatch'),
        array('pe-7s-star' => 'pe-7s-star'),
        array('pe-7s-speaker' => 'pe-7s-speaker'),
        array('pe-7s-signal' => 'pe-7s-signal'),
        array('pe-7s-shuffle' => 'pe-7s-shuffle'),
        array('pe-7s-shopbag' => 'pe-7s-shopbag'),
        array('pe-7s-share' => 'pe-7s-share'),
        array('pe-7s-server' => 'pe-7s-server'),
        array('pe-7s-search' => 'pe-7s-search'),
        array('pe-7s-film' => 'pe-7s-film'),
        array('pe-7s-science' => 'pe-7s-science'),
        array('pe-7s-disk' => 'pe-7s-disk'),
        array('pe-7s-ribbon' => 'pe-7s-ribbon'),
        array('pe-7s-repeat' => 'pe-7s-repeat'),
        array('pe-7s-refresh' => 'pe-7s-refresh'),
        array('pe-7s-add-user' => 'pe-7s-add-user'),
        array('pe-7s-refresh-cloud' => 'pe-7s-refresh-cloud'),
        array('pe-7s-paperclip' => 'pe-7s-paperclip'),
        array('pe-7s-radio' => 'pe-7s-radio'),
        array('pe-7s-note2' => 'pe-7s-note2'),
        array('pe-7s-print' => 'pe-7s-print'),
        array('pe-7s-network' => 'pe-7s-network'),
        array('pe-7s-prev' => 'pe-7s-prev'),
        array('pe-7s-mute' => 'pe-7s-mute'),
        array('pe-7s-power' => 'pe-7s-power'),
        array('pe-7s-medal' => 'pe-7s-medal'),
        array('pe-7s-portfolio' => 'pe-7s-portfolio'),
        array('pe-7s-like2' => 'pe-7s-like2'),
        array('pe-7s-plus' => 'pe-7s-plus'),
        array('pe-7s-left-arrow' => 'pe-7s-left-arrow'),
        array('pe-7s-play' => 'pe-7s-play'),
        array('pe-7s-key' => 'pe-7s-key'),
        array('pe-7s-plane' => 'pe-7s-plane'),
        array('pe-7s-joy' => 'pe-7s-joy'),
        array('pe-7s-photo-gallery' => 'pe-7s-photo-gallery'),
        array('pe-7s-pin' => 'pe-7s-pin'),
        array('pe-7s-phone' => 'pe-7s-phone'),
        array('pe-7s-plug' => 'pe-7s-plug'),
        array('pe-7s-pen' => 'pe-7s-pen'),
        array('pe-7s-right-arrow' => 'pe-7s-right-arrow'),
        array('pe-7s-paper-plane' => 'pe-7s-paper-plane'),
        array('pe-7s-delete-user' => 'pe-7s-delete-user'),
        array('pe-7s-paint' => 'pe-7s-paint'),
        array('pe-7s-bottom-arrow' => 'pe-7s-bottom-arrow'),
        array('pe-7s-notebook' => 'pe-7s-notebook'),
        array('pe-7s-note' => 'pe-7s-note'),
        array('pe-7s-next' => 'pe-7s-next'),
        array('pe-7s-news-paper' => 'pe-7s-news-paper'),
        array('pe-7s-musiclist' => 'pe-7s-musiclist'),
        array('pe-7s-music' => 'pe-7s-music'),
        array('pe-7s-mouse' => 'pe-7s-mouse'),
        array('pe-7s-more' => 'pe-7s-more'),
        array('pe-7s-moon' => 'pe-7s-moon'),
        array('pe-7s-monitor' => 'pe-7s-monitor'),
        array('pe-7s-micro' => 'pe-7s-micro'),
        array('pe-7s-menu' => 'pe-7s-menu'),
        array('pe-7s-map' => 'pe-7s-map'),
        array('pe-7s-map-marker' => 'pe-7s-map-marker'),
        array('pe-7s-mail' => 'pe-7s-mail'),
        array('pe-7s-mail-open' => 'pe-7s-mail-open'),
        array('pe-7s-mail-open-file' => 'pe-7s-mail-open-file'),
        array('pe-7s-magnet' => 'pe-7s-magnet'),
        array('pe-7s-loop' => 'pe-7s-loop'),
        array('pe-7s-look' => 'pe-7s-look'),
        array('pe-7s-lock' => 'pe-7s-lock'),
        array('pe-7s-lintern' => 'pe-7s-lintern'),
        array('pe-7s-link' => 'pe-7s-link'),
        array('pe-7s-like' => 'pe-7s-like'),
        array('pe-7s-light' => 'pe-7s-light'),
        array('pe-7s-less' => 'pe-7s-less'),
        array('pe-7s-keypad' => 'pe-7s-keypad'),
        array('pe-7s-junk' => 'pe-7s-junk'),
        array('pe-7s-info' => 'pe-7s-info'),
        array('pe-7s-home' => 'pe-7s-home'),
        array('pe-7s-help2' => 'pe-7s-help2'),
        array('pe-7s-help1' => 'pe-7s-help1'),
        array('pe-7s-graph3' => 'pe-7s-graph3'),
        array('pe-7s-graph2' => 'pe-7s-graph2'),
        array('pe-7s-graph1' => 'pe-7s-graph1'),
        array('pe-7s-graph' => 'pe-7s-graph'),
        array('pe-7s-global' => 'pe-7s-global'),
        array('pe-7s-gleam' => 'pe-7s-gleam'),
        array('pe-7s-glasses' => 'pe-7s-glasses'),
        array('pe-7s-gift' => 'pe-7s-gift'),
        array('pe-7s-folder' => 'pe-7s-folder'),
        array('pe-7s-flag' => 'pe-7s-flag'),
        array('pe-7s-filter' => 'pe-7s-filter'),
        array('pe-7s-file' => 'pe-7s-file'),
        array('pe-7s-expand1' => 'pe-7s-expand1'),
        array('pe-7s-exapnd2' => 'pe-7s-exapnd2'),
        array('pe-7s-edit' => 'pe-7s-edit'),
        array('pe-7s-drop' => 'pe-7s-drop'),
        array('pe-7s-drawer' => 'pe-7s-drawer'),
        array('pe-7s-download' => 'pe-7s-download'),
        array('pe-7s-display2' => 'pe-7s-display2'),
        array('pe-7s-display1' => 'pe-7s-display1'),
        array('pe-7s-diskette' => 'pe-7s-diskette'),
        array('pe-7s-date' => 'pe-7s-date'),
        array('pe-7s-cup' => 'pe-7s-cup'),
        array('pe-7s-culture' => 'pe-7s-culture'),
        array('pe-7s-crop' => 'pe-7s-crop'),
        array('pe-7s-credit' => 'pe-7s-credit'),
        array('pe-7s-copy-file' => 'pe-7s-copy-file'),
        array('pe-7s-config' => 'pe-7s-config'),
        array('pe-7s-compass' => 'pe-7s-compass'),
        array('pe-7s-comment' => 'pe-7s-comment'),
        array('pe-7s-coffee' => 'pe-7s-coffee'),
        array('pe-7s-cloud' => 'pe-7s-cloud'),
        array('pe-7s-clock' => 'pe-7s-clock'),
        array('pe-7s-check' => 'pe-7s-check'),
        array('pe-7s-chat' => 'pe-7s-chat'),
        array('pe-7s-cart' => 'pe-7s-cart'),
        array('pe-7s-camera' => 'pe-7s-camera'),
        array('pe-7s-call' => 'pe-7s-call'),
        array('pe-7s-calculator' => 'pe-7s-calculator'),
        array('pe-7s-browser' => 'pe-7s-browser'),
        array('pe-7s-box2' => 'pe-7s-box2'),
        array('pe-7s-box1' => 'pe-7s-box1'),
        array('pe-7s-bookmarks' => 'pe-7s-bookmarks'),
        array('pe-7s-bicycle' => 'pe-7s-bicycle'),
        array('pe-7s-bell' => 'pe-7s-bell'),
        array('pe-7s-battery' => 'pe-7s-battery'),
        array('pe-7s-ball' => 'pe-7s-ball'),
        array('pe-7s-back' => 'pe-7s-back'),
        array('pe-7s-attention' => 'pe-7s-attention'),
        array('pe-7s-anchor' => 'pe-7s-anchor'),
        array('pe-7s-albums' => 'pe-7s-albums'),
        array('pe-7s-alarm' => 'pe-7s-alarm'),
        array('pe-7s-airplay' => 'pe-7s-airplay'),
    );
    $params_row = array(
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Layout', 'g5plus-handmade'),
            'param_name' => 'layout',
            'value' => array(
                esc_html__('Full Width', 'g5plus-handmade') => 'wide',
                esc_html__('Container', 'g5plus-handmade') => 'boxed',
                esc_html__('Container Fluid', 'g5plus-handmade') => 'container-fluid',
            ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Columns gap', 'js_composer'),
            'param_name' => 'gap',
            'value' => array(
                '0px' => '0',
                '1px' => '1',
                '2px' => '2',
                '3px' => '3',
                '4px' => '4',
                '5px' => '5',
                '10px' => '10',
                '15px' => '15',
                '20px' => '20',
                '25px' => '25',
                '30px' => '30',
                '35px' => '35',
            ),
            'std' => '0',
            'description' => esc_html__('Select gap between columns in row.', 'js_composer'),
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Full height row?', 'js_composer'),
            'param_name' => 'full_height',
            'description' => esc_html__('If checked row will be set to full height.', 'js_composer'),
            'value' => array(esc_html__('Yes', 'js_composer') => 'yes'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Columns position', 'js_composer'),
            'param_name' => 'columns_placement',
            'value' => array(
                esc_html__('Middle', 'js_composer') => 'middle',
                esc_html__('Top', 'js_composer') => 'top',
                esc_html__('Bottom', 'js_composer') => 'bottom',
                esc_html__('Stretch', 'js_composer') => 'stretch',
            ),
            'description' => esc_html__('Select columns position within row.', 'js_composer'),
            'dependency' => array(
                'element' => 'full_height',
                'not_empty' => true,
            ),
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Equal height', 'js_composer'),
            'param_name' => 'equal_height',
            'description' => esc_html__('If checked columns will be set to equal height.', 'js_composer'),
            'value' => array(esc_html__('Yes', 'js_composer') => 'yes')
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Content position', 'js_composer'),
            'param_name' => 'content_placement',
            'value' => array(
                esc_html__('Default', 'js_composer') => '',
                esc_html__('Top', 'js_composer') => 'top',
                esc_html__('Middle', 'js_composer') => 'middle',
                esc_html__('Bottom', 'js_composer') => 'bottom',
            ),
            'description' => esc_html__('Select content position within columns.', 'js_composer'),
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Use video background?', 'js_composer'),
            'param_name' => 'video_bg',
            'description' => esc_html__('If checked, video will be used as row background.', 'js_composer'),
            'value' => array(esc_html__('Yes', 'js_composer') => 'yes'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('YouTube link', 'js_composer'),
            'param_name' => 'video_bg_url',
            'value' => 'https://www.youtube.com/watch?v=lMJXxhRFO1k',
            // default video url
            'description' => esc_html__('Add YouTube link.', 'js_composer'),
            'dependency' => array(
                'element' => 'video_bg',
                'not_empty' => true,
            ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Parallax', 'js_composer'),
            'param_name' => 'video_bg_parallax',
            'value' => array(
                esc_html__('None', 'js_composer') => '',
                esc_html__('Simple', 'js_composer') => 'content-moving',
                esc_html__('With fade', 'js_composer') => 'content-moving-fade',
            ),
            'description' => esc_html__('Add parallax type background for row.', 'js_composer'),
            'dependency' => array(
                'element' => 'video_bg',
                'not_empty' => true,
            ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Parallax', 'js_composer'),
            'param_name' => 'parallax',
            'value' => array(
                esc_html__('None', 'js_composer') => '',
                esc_html__('Simple', 'js_composer') => 'content-moving',
                esc_html__('With fade', 'js_composer') => 'content-moving-fade',
            ),
            'description' => esc_html__('Add parallax type background for row (Note: If no image is specified, parallax will use background image from Design Options).', 'js_composer'),
            'dependency' => array(
                'element' => 'video_bg',
                'is_empty' => true,
            ),
        ),
        array(
            'type' => 'attach_image',
            'heading' => esc_html__('Image', 'js_composer'),
            'param_name' => 'parallax_image',
            'value' => '',
            'description' => esc_html__('Select image from media library.', 'js_composer'),
            'dependency' => array(
                'element' => 'parallax',
                'not_empty' => true,
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Parallax speed', 'g5plus-handmade'),
            'param_name' => 'parallax_speed',
            'value' => '1.5',
            'dependency' => Array('element' => 'parallax', 'value' => array('content-moving', 'content-moving-fade')),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Show background overlay', 'g5plus-handmade'),
            'param_name' => 'overlay_set',
            'description' => esc_html__('Hide or Show overlay on background images.', 'g5plus-handmade'),
            'value' => array(
                esc_html__('Hide, please', 'g5plus-handmade') => 'hide_overlay',
                esc_html__('Show Overlay Color', 'g5plus-handmade') => 'show_overlay_color',
                esc_html__('Show Overlay Image', 'g5plus-handmade') => 'show_overlay_image',
            )
        ),
        array(
            'type' => 'attach_image',
            'heading' => esc_html__('Image Overlay:', 'g5plus-handmade'),
            'param_name' => 'overlay_image',
            'value' => '',
            'description' => esc_html__('Upload image overlay.', 'g5plus-handmade'),
            'dependency' => Array('element' => 'overlay_set', 'value' => array('show_overlay_image')),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Overlay color', 'g5plus-handmade'),
            'param_name' => 'overlay_color',
            'description' => esc_html__('Select color for background overlay.', 'g5plus-handmade'),
            'value' => '',
            'dependency' => Array('element' => 'overlay_set', 'value' => array('show_overlay_color')),
        ),
        array(
            'type' => 'number',
            'class' => '',
            'heading' => esc_html__('Overlay opacity', 'g5plus-handmade'),
            'param_name' => 'overlay_opacity',
            'value' => '50',
            'min' => '1',
            'max' => '100',
            'suffix' => '%',
            'description' => esc_html__('Select opacity for overlay.', 'g5plus-handmade'),
            'dependency' => Array('element' => 'overlay_set', 'value' => array('show_overlay_color', 'show_overlay_image')),
        ),
        array(
            'type' => 'el_id',
            'heading' => esc_html__('Row ID', 'js_composer'),
            'param_name' => 'el_id',
            'description' => sprintf(esc_html__('Enter row ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'js_composer'), 'http://www.w3schools.com/tags/att_global_id.asp'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Extra class name', 'js_composer'),
            'param_name' => 'el_class',
            'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer'),
        ),
        array(
            'type' => 'css_editor',
            'heading' => esc_html__('CSS box', 'js_composer'),
            'param_name' => 'css',
            'group' => esc_html__('Design Options', 'js_composer'),
        ),
        $add_css_animation,
        $add_duration_animation,
        $add_delay_animation,
    );
    vc_map(array(
        'name' => esc_html__('Row', 'g5plus-handmade'),
        'base' => 'vc_row',
        'is_container' => true,
        'icon' => 'icon-wpb-row',
        'show_settings_on_create' => false,
        'category' => esc_html__('Content', 'g5plus-handmade'),
        'description' => esc_html__('Place content elements inside the row', 'g5plus-handmade'),
        'params' => $params_row,
        'js_view' => 'VcRowView'
    ));
    vc_map(array(
        'name' => esc_html__('Row', 'g5plus-handmade'), //Inner Row
        'base' => 'vc_row_inner',
        'content_element' => false,
        'is_container' => true,
        'icon' => 'icon-wpb-row',
        'weight' => 1000,
        'show_settings_on_create' => false,
        'description' => esc_html__('Place content elements inside the row', 'g5plus-handmade'),
        'params' => $params_row,
        'js_view' => 'VcRowView'
    ));
    $params_icon = array(
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__('Icon', 'g5plus-handmade'),
            'param_name' => 'i_icon_pe_7_stroke',
            'value' => 'pe-7s-like', // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false, // default true, display an "EMPTY" icon?
                'iconsPerPage' => 4000,
                'type' => 'pe_7_stroke',
                'source' => $pe_7_stroke_icons,
            ),
            'dependency' => array(
                'element' => 'i_type',
                'value' => 'pe_7_stroke',
            ),
            'description' => esc_html__('Select icon from library.', 'g5plus-handmade'),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__('Icon', 'g5plus-handmade'),
            'param_name' => 'i_icon_fontawesome',
            'value' => 'fa fa-adjust', // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false,
                // default true, display an "EMPTY" icon?
                'iconsPerPage' => 4000,
                // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
            ),
            'dependency' => array(
                'element' => 'i_type',
                'value' => 'fontawesome',
            ),
            'description' => esc_html__('Select icon from library.', 'g5plus-handmade'),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__('Icon', 'g5plus-handmade'),
            'param_name' => 'i_icon_openiconic',
            'value' => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false, // default true, display an "EMPTY" icon?
                'type' => 'openiconic',
                'iconsPerPage' => 4000, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'i_type',
                'value' => 'openiconic',
            ),
            'description' => esc_html__('Select icon from library.', 'g5plus-handmade'),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__('Icon', 'g5plus-handmade'),
            'param_name' => 'i_icon_typicons',
            'value' => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false, // default true, display an "EMPTY" icon?
                'type' => 'typicons',
                'iconsPerPage' => 4000, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'i_type',
                'value' => 'typicons',
            ),
            'description' => esc_html__('Select icon from library.', 'g5plus-handmade'),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__('Icon', 'g5plus-handmade'),
            'param_name' => 'i_icon_entypo',
            'value' => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false, // default true, display an "EMPTY" icon?
                'type' => 'entypo',
                'iconsPerPage' => 4000, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'i_type',
                'value' => 'entypo',
            ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__('Icon', 'g5plus-handmade'),
            'param_name' => 'i_icon_linecons',
            'value' => 'vc_li vc_li-heart', // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false, // default true, display an "EMPTY" icon?
                'type' => 'linecons',
                'iconsPerPage' => 4000, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'i_type',
                'value' => 'linecons',
            ),
            'description' => esc_html__('Select icon from library.', 'g5plus-handmade'),
        ),
    );
    $params_section = array_merge(
        array(
            array(
                'type' => 'textfield',
                'param_name' => 'title',
                'heading' => esc_html__('Title', 'g5plus-handmade'),
                'description' => esc_html__('Enter section title (Note: you can leave it empty).', 'g5plus-handmade'),
            ),
            array(
                'type' => 'el_id',
                'param_name' => 'tab_id',
                'settings' => array(
                    'auto_generate' => true,
                ),
                'heading' => esc_html__('Section ID', 'g5plus-handmade'),
                'description' => esc_html__('Enter section ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'g5plus-handmade'),
            ),
            array(
                'type' => 'checkbox',
                'param_name' => 'add_icon',
                'heading' => esc_html__('Add icon?', 'g5plus-handmade'),
                'description' => esc_html__('Add icon next to section title.', 'g5plus-handmade'),
            ),
            array(
                'type' => 'dropdown',
                'param_name' => 'i_position',
                'value' => array(
                    esc_html__('Before title', 'g5plus-handmade') => 'left',
                    esc_html__('After title', 'g5plus-handmade') => 'right',
                ),
                'dependency' => array(
                    'element' => 'add_icon',
                    'value' => 'true',
                ),
                'heading' => esc_html__('Icon position', 'g5plus-handmade'),
                'description' => esc_html__('Select icon position.', 'g5plus-handmade'),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Icon library', 'g5plus-handmade'),
                'value' => array(
                    esc_html__('Pe Icon 7 Stroke', 'g5plus-handmade') => 'pe_7_stroke',
                    esc_html__('Font Awesome', 'g5plus-handmade') => 'fontawesome',
                    esc_html__('Open Iconic', 'g5plus-handmade') => 'openiconic',
                    esc_html__('Typicons', 'g5plus-handmade') => 'typicons',
                    esc_html__('Entypo', 'g5plus-handmade') => 'entypo',
                    esc_html__('Linecons', 'g5plus-handmade') => 'linecons',
                ),
                'admin_label' => true,
                'param_name' => 'i_type',
                'description' => esc_html__('Select icon library.', 'g5plus-handmade'),
                'dependency' => array(
                    'element' => 'add_icon',
                    'value' => 'true',
                ),
            ),

        ),
        $params_icon,
        array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra class name', 'g5plus-handmade'),
                'param_name' => 'el_class',
                'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'g5plus-handmade')
            )
        )
    );
    vc_map(array(
        'name' => esc_html__('Section', 'g5plus-handmade'),
        'base' => 'vc_tta_section',
        'icon' => 'icon-wpb-ui-tta-section',
        'allowed_container_element' => 'vc_row',
        'is_container' => true,
        'show_settings_on_create' => false,
        'as_child' => array(
            'only' => 'vc_tta_tour,vc_tta_tabs,vc_tta_accordion',
        ),
        //'content_element' => false,
        'category' => esc_html__('Content', 'g5plus-handmade'),
        'description' => esc_html__('Section for Tabs, Tours, Accordions.', 'g5plus-handmade'),
        'params' => $params_section,
        'js_view' => 'VcBackendTtaSectionView',
        'custom_markup' => '
<div class="vc_tta-panel-heading">
    <h4 class="vc_tta-panel-title vc_tta-controls-icon-position-left"><a href="javascript:;" data-vc-target="[data-model-id=\'{{ model_id }}\']" data-vc-accordion data-vc-container=".vc_tta-container"><span class="vc_tta-title-text">{{ section_title }}</span><i class="vc_tta-controls-icon vc_tta-controls-icon-plus"></i></a></h4>
</div>
<div class="vc_tta-panel-body">
	{{ editor_controls }}
	<div class="{{ container-class }}">
	{{ content }}
	</div>
</div>',
        'default_content' => '',
    ));
    /**
     * Pie chart
     */
    $params_piechart = array_merge(
        array(
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Layout Style', 'g5plus-handmade'),
                'param_name' => 'layout_style',
                'admin_label' => true,
                'value' => array(esc_html__('Normal', 'g5plus-handmade') => '', esc_html__('Icon', 'g5plus-handmade') => 'pie_icon'),
                'description' => esc_html__('Select Layout Style.', 'g5plus-handmade'),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Value', 'g5plus-handmade'),
                'param_name' => 'value',
                'description' => esc_html__('Enter value for graph (Note: choose range from 0 to 100).', 'g5plus-handmade'),
                'value' => '50',
                'admin_label' => true
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Label value', 'g5plus-handmade'),
                'param_name' => 'label_value',
                'description' => esc_html__('Enter label for pie chart (Note: leaving empty will set value from "Value" field).', 'g5plus-handmade'),
                'value' => ''
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Units', 'g5plus-handmade'),
                'param_name' => 'units',
                'description' => esc_html__('Enter measurement units (Example: %, px, points, etc. Note: graph value and units will be appended to graph title).', 'g5plus-handmade')
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Pie chart color', 'g5plus-handmade'),
                'param_name' => 'color',
                'value' => getVcShared('colors-dashed') + array(esc_html__('Custom', 'g5plus-handmade') => 'custom'),
                'description' => esc_html__('Select pie chart color.', 'g5plus-handmade'),
                'admin_label' => true,
                'param_holder_class' => 'vc_colored-dropdown',
                'std' => 'grey'
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Custom color', 'g5plus-handmade'),
                'param_name' => 'custom_color',
                'description' => esc_html__('Select custom color.', 'g5plus-handmade'),
                'dependency' => array(
                    'element' => 'color',
                    'value' => array('custom')
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Icon library', 'g5plus-handmade'),
                'value' => array(
                    esc_html__('[None]', 'g5plus-handmade') => '',
                    esc_html__('Pe Icon 7 Stroke', 'g5plus-handmade') => 'pe_7_stroke',
                    esc_html__('Font Awesome', 'g5plus-handmade') => 'fontawesome',
                    esc_html__('Open Iconic', 'g5plus-handmade') => 'openiconic',
                    esc_html__('Typicons', 'g5plus-handmade') => 'typicons',
                    esc_html__('Entypo', 'g5plus-handmade') => 'entypo',
                    esc_html__('Linecons', 'g5plus-handmade') => 'linecons',
                    esc_html__('Image', 'g5plus-handmade') => 'image',
                ),
                'admin_label' => true,
                'param_name' => 'i_type',
                'description' => esc_html__('Select icon library.', 'g5plus-handmade'),
                'dependency' => Array('element' => 'layout_style', 'value' => array('pie_icon')),
            ),
        ),
        $params_icon,
        array(
            array(
                'type' => 'attach_image',
                'heading' => esc_html__('Upload Image Icon:', 'g5plus-handmade'),
                'param_name' => 'i_icon_image',
                'value' => '',
                'description' => esc_html__('Upload the custom image icon.', 'g5plus-handmade'),
                'dependency' => Array('element' => 'i_type', 'value' => array('image')),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Value/Icon color', 'g5plus-handmade'),
                'param_name' => 'value_color',
                'description' => esc_html__('Select value/icon color.', 'g5plus-handmade'),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title', 'g5plus-handmade'),
                'param_name' => 'title',
                'value' => '',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra class name', 'g5plus-handmade'),
                'param_name' => 'el_class',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'g5plus-handmade')
            ),
            array(
                'type' => 'css_editor',
                'heading' => esc_html__('CSS box', 'g5plus-handmade'),
                'param_name' => 'css',
                'group' => esc_html__('Design Options', 'g5plus-handmade')
            ),
        )
    );
    vc_map(array(
        'name' => esc_html__('Pie Chart', 'g5plus-handmade'),
        'base' => 'vc_pie',
        'class' => '',
        'icon' => 'icon-wpb-vc_pie',
        'category' => array(esc_html__('Content', 'g5plus-handmade'), esc_html__('Handmade Shortcodes', 'g5plus-handmade')),
        'description' => esc_html__('Animated pie chart', 'g5plus-handmade'),
        'params' => $params_piechart,
    ));
    global $pixel_icons;
    $custom_colors = array(
        esc_html__('Informational', 'js_composer') => 'info',
        esc_html__('Warning', 'js_composer') => 'warning',
        esc_html__('Success', 'js_composer') => 'success',
        esc_html__('Error', 'js_composer') => "danger",
        esc_html__('Informational Classic', 'js_composer') => 'alert-info',
        esc_html__('Warning Classic', 'js_composer') => 'alert-warning',
        esc_html__('Success Classic', 'js_composer') => 'alert-success',
        esc_html__('Error Classic', 'js_composer') => "alert-danger",
        esc_html__('Handmade Informational', 'js_composer') => "hm-info",
        esc_html__('Handmade Warning', 'js_composer') => "hm-warning",
        esc_html__('Handmade Success', 'js_composer') => "hm-success",
        esc_html__('Handmade Error', 'js_composer') => "hm-danger",
    );
    vc_map(array(
        'name' => esc_html__('Message Box', 'js_composer'),
        'base' => 'vc_message',
        'icon' => 'icon-wpb-information-white',
        'category' => esc_html__('Content', 'js_composer'),
        'description' => esc_html__('Notification box', 'js_composer'),
        'params' => array(
            array(
                'type' => 'params_preset',
                'heading' => esc_html__('Message Box Presets', 'js_composer'),
                'param_name' => 'color', // due to backward compatibility, really it is message_box_type
                'value' => '',
                'options' => array(
                    array(
                        'label' => esc_html__('Custom', 'js_composer'),
                        'value' => '',
                        'params' => array(),
                    ),
                    array(
                        'label' => esc_html__('Informational', 'js_composer'),
                        'value' => 'info',
                        'params' => array(
                            'message_box_color' => 'info',
                            'icon_type' => 'fontawesome',
                            'icon_fontawesome' => 'fa fa-info-circle',
                        ),
                    ),
                    array(
                        'label' => esc_html__('Warning', 'js_composer'),
                        'value' => 'warning',
                        'params' => array(
                            'message_box_color' => 'warning',
                            'icon_type' => 'fontawesome',
                            'icon_fontawesome' => 'fa fa-exclamation-triangle',
                        ),
                    ),
                    array(
                        'label' => esc_html__('Success', 'js_composer'),
                        'value' => 'success',
                        'params' => array(
                            'message_box_color' => 'success',
                            'icon_type' => 'fontawesome',
                            'icon_fontawesome' => 'fa fa-check',
                        ),
                    ),
                    array(
                        'label' => esc_html__('Error', 'js_composer'),
                        'value' => 'danger',
                        'params' => array(
                            'message_box_color' => 'danger',
                            'icon_type' => 'fontawesome',
                            'icon_fontawesome' => 'fa fa-times',
                        ),
                    ),
                    array(
                        'label' => esc_html__('Informational Classic', 'js_composer'),
                        'value' => 'alert-info', // due to backward compatibility
                        'params' => array(
                            'message_box_color' => 'alert-info',
                            'icon_type' => 'pixelicons',
                            'icon_pixelicons' => 'vc_pixel_icon vc_pixel_icon-info',
                        ),
                    ),
                    array(
                        'label' => esc_html__('Warning Classic', 'js_composer'),
                        'value' => 'alert-warning', // due to backward compatibility
                        'params' => array(
                            'message_box_color' => 'alert-warning',
                            'icon_type' => 'pixelicons',
                            'icon_pixelicons' => 'vc_pixel_icon vc_pixel_icon-alert',
                        ),
                    ),
                    array(
                        'label' => esc_html__('Success Classic', 'js_composer'),
                        'value' => 'alert-success',  // due to backward compatibility
                        'params' => array(
                            'message_box_color' => 'alert-success',
                            'icon_type' => 'pixelicons',
                            'icon_pixelicons' => 'vc_pixel_icon vc_pixel_icon-tick',
                        ),
                    ),
                    array(
                        'label' => esc_html__('Error Classic', 'js_composer'),
                        'value' => 'alert-danger',  // due to backward compatibility
                        'params' => array(
                            'message_box_color' => 'alert-danger',
                            'icon_type' => 'pixelicons',
                            'icon_pixelicons' => 'vc_pixel_icon vc_pixel_icon-explanation',
                        ),
                    ),
                ),
                'description' => esc_html__('Select predefined message box design or choose "Custom" for custom styling.', 'js_composer'),
                'param_holder_class' => 'vc_message-type vc_colored-dropdown',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Style', 'js_composer'),
                'param_name' => 'message_box_style',
                'value' => getVcShared('message_box_styles'),
                'description' => esc_html__('Select message box design style.', 'js_composer')
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Shape', 'js_composer'),
                'param_name' => 'style', // due to backward compatibility message_box_shape
                'std' => 'rounded',
                'value' => array(
                    esc_html__('Square', 'js_composer') => 'square',
                    esc_html__('Rounded', 'js_composer') => 'rounded',
                    esc_html__('Round', 'js_composer') => 'round',
                ),
                'description' => esc_html__('Select message box shape.', 'js_composer'),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Color', 'js_composer'),
                'param_name' => 'message_box_color',
                'value' => $custom_colors + getVcShared('colors'),
                'description' => esc_html__('Select message box color.', 'js_composer'),
                'param_holder_class' => 'vc_message-type vc_colored-dropdown',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Icon library', 'js_composer'),
                'value' => array(
                    esc_html__('Pe Icon 7 Stroke', 'g5plus-handmade') => 'pe_7_stroke',
                    esc_html__('Font Awesome', 'js_composer') => 'fontawesome',
                    esc_html__('Open Iconic', 'js_composer') => 'openiconic',
                    esc_html__('Typicons', 'js_composer') => 'typicons',
                    esc_html__('Entypo', 'js_composer') => 'entypo',
                    esc_html__('Linecons', 'js_composer') => 'linecons',
                    esc_html__('Pixel', 'js_composer') => 'pixelicons',
                ),
                'param_name' => 'icon_type',
                'description' => esc_html__('Select icon library.', 'js_composer'),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__('Icon', 'g5plus-handmade'),
                'param_name' => 'icon_pe_7_stroke',
                'value' => 'pe-7s-like', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'iconsPerPage' => 4000,
                    'type' => 'pe_7_stroke',
                    'source' => $pe_7_stroke_icons,
                ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'pe_7_stroke',
                ),
                'description' => esc_html__('Select icon from library.', 'g5plus-handmade'),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__('Icon', 'js_composer'),
                'param_name' => 'icon_fontawesome',
                'value' => 'fa fa-info-circle',
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'fontawesome',
                ),
                'description' => esc_html__('Select icon from library.', 'js_composer'),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__('Icon', 'js_composer'),
                'param_name' => 'icon_openiconic',
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'openiconic',
                    'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'openiconic',
                ),
                'description' => esc_html__('Select icon from library.', 'js_composer'),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__('Icon', 'js_composer'),
                'param_name' => 'icon_typicons',
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'typicons',
                    'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'typicons',
                ),
                'description' => esc_html__('Select icon from library.', 'js_composer'),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__('Icon', 'js_composer'),
                'param_name' => 'icon_entypo',
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'entypo',
                    'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'entypo',
                ),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__('Icon', 'js_composer'),
                'param_name' => 'icon_linecons',
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'linecons',
                    'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'linecons',
                ),
                'description' => esc_html__('Select icon from library.', 'js_composer'),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__('Icon', 'js_composer'),
                'param_name' => 'icon_pixelicons',
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'pixelicons',
                    'source' => $pixel_icons,
                ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'pixelicons',
                ),
                'description' => esc_html__('Select icon from library.', 'js_composer'),
            ),
            array(
                'type' => 'textarea_html',
                'holder' => 'div',
                'class' => 'messagebox_text',
                'heading' => esc_html__('Message text', 'js_composer'),
                'param_name' => 'content',
                'value' => esc_html__('<p>I am message box. Click edit button to change this text.</p>', 'js_composer')
            ),
            $add_css_animation,
            $add_duration_animation,
            $add_delay_animation,
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra class name', 'js_composer'),
                'param_name' => 'el_class',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer')
            ),
            array(
                'type' => 'css_editor',
                'heading' => esc_html__('CSS box', 'js_composer'),
                'param_name' => 'css',
                'group' => esc_html__('Design Options', 'js_composer')
            ),
        ),
        'js_view' => 'VcMessageView_Backend'
    ));
}

add_action('vc_after_init', 'register_vc_map');