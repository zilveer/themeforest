/* RUN */
window.jQuery = window.$ = jQuery;

/* FIX FOR ALL OTHER ADMIN PAGES */
if (post_id < 1) {
    var post_id = 0;
}

function waiting_state_start() {
    $(".waiting-bg").show();
}

function waiting_state_end() {
    $(".waiting-bg").hide();
}

/* AUTO HEIGHT FOR POPUP */
function popupAutoH() {
    nowWinH = $(window).height();
    popupH = nowWinH - 150;
    $(".pop_scrollable_area").height(popupH);
}

function reactivate_color_picker() {
    /* REACTIVATE COLOR PICKER */
    $('.cpicker').ColorPicker({
        onSubmit:function (hsb, hex, rgb, el) {
            $(el).val(hex);
            $(el).ColorPickerHide();
            $(".cpicker.focused").next().css("background-color", "#" + hex);
        },
        onBeforeShow:function () {
            $(this).ColorPickerSetColor(this.value);
        },
        onHide:function () {
            $("input").removeClass("focused");
        },
        onChange:function (hsb, hex, rgb) {
            $(".cpicker.focused").val(hex);
            $(".cpicker.focused").next().css("background-color", "#" + hex);
        }
    })
        .bind('keyup', function () {
            $(this).ColorPickerSetColor(this.value);
        });

    $('.cpicker').focus(function () {
        $(this).addClass("focused");
    });
}


function reactivate_sortable() {
    $('.sections').sortable({ placeholder:'ui-state-highlight-sections', handle:'.some-element.move' });
    $('.feature-list').sortable({ placeholder:'ui-state-highlight-sections', handle:'.some-element2.move' });
}

function reactivate_custom_scroll() {
    $('.pop_scrollable_area').jScrollPane({showArrows:true, autoReinitialise:true});
}


function reactivate_selectbox() {
    $(".mix-container select, .newselect").selectBox('destroy');
    $(".selectBox-dropdown").remove();
    $(".newselect.selectBox").show();
    $(".newselect.selectBox").removeClass(".selectBox");
    $(".mix-container select, .newselect").selectBox();
}


/* CLICK SELECT SIDEBAR */
function showSidebarChooser() {
    var now_selected_sidebar = $('.img-preview .active').parents('.choose-sidebar').attr('data-sidebar');
    if (now_selected_sidebar == "left-sidebar") {
        $('.sidebar-chooser.for-left').show('fast');
        $('.sidebar-chooser.for-right').hide('fast');
    }
    if (now_selected_sidebar == "right-sidebar") {
        $('.sidebar-chooser.for-left').hide('fast');
        $('.sidebar-chooser.for-right').show('fast');
    }
    if (now_selected_sidebar == "both-sidebars") {
        $('.sidebar-chooser.for-left').show('fast');
        $('.sidebar-chooser.for-right').show('fast');
    }
    if (now_selected_sidebar == "no-sidebar") {
        $('.sidebar-chooser.for-left').hide('fast');
        $('.sidebar-chooser.for-right').hide('fast');
    }
}
$('.choose-sidebar').live('click', function () {
    var selected_sidebar = $(this).attr("data-sidebar");
    $('.choose-sidebar img').removeClass('active');
    $('.layout-sidebars').val(selected_sidebar);
    $('.page-settings-container').find('.' + selected_sidebar + '').addClass('active');
    showSidebarChooser();
});


/* SHOW / HIDE content */
$(document).ready(function () {
    $('.show-hide-container').live('click', function () {
        $(this).parents('.pb-cont').find('.hideable-content').toggle('fast');
    });
});


/* COLORBOX */
$(document).ready(function () {
    /* ADD IMAGE TO AVAILABLE MEDIA */
    $('.add_image_to_sliders_available_media').colorbox({
        href:'media-upload.php?post_id=' + post_id + '&type=image&pg=gallery',
        iframe:true,
        innerWidth:660,
        innerHeight:500,
        onClosed:function () {
            $.post(ajaxurl, {
                action:'get_media_for_postid',
                post_id:post_id,
                page:1
            }, function (data) {
                $('.available_media .ajax_cont').html(data);
            }, 'text');
        }
    });
});

$(document).ready(function () {
    $(".available_media_arrow").live('click', function(){
        if ($(this).hasClass("left_arrow")) {
            show_img_media_library_page = show_img_media_library_page-1;
        }
        if ($(this).hasClass("right_arrow")) {
            show_img_media_library_page = show_img_media_library_page+1;
        }

        if (show_img_media_library_page<1) {show_img_media_library_page=1;}

        $.post(ajaxurl, {
            action:'get_media_for_postid',
            post_id:post_id,
            page:show_img_media_library_page
        }, function (data) {
            if (data!=="no_items") {
                $('.available_media .ajax_cont').html(data);
            } else {
                show_img_media_library_page = show_img_media_library_page-1;
            }
        }, 'text');

    });
});


function check_visual_part_for_toggles() {
    $(".radio_toggle_cont").each(function (index) {
        var yes_state = $(this).find('.yes_state').attr('checked');
        var no_state = $(this).find('.no_state').attr('checked');

        if (yes_state == 'checked') {
            //alert("yes");
            $(this).find(".no_state").removeAttr("checked");
            $(this).find(".radio_toggle_mirage").removeClass("not_checked").addClass("checked");
            $(this).find(".radio_toggle_mirage").stop().animate({backgroundPosition:'0% 0%'}, {duration:'fast'});
        } else {
            //alert("no");
            $(this).find(".yes_state").removeAttr("checked");
            $(this).find(".radio_toggle_mirage").removeClass("checked").addClass("not_checked");
            $(this).find(".radio_toggle_mirage").stop().animate({backgroundPosition:'100% 0%'}, {duration:'fast'});
        }

    });
}


/* Document ready for all elements */
$(document).ready(function () {

    $('.img-item .inter_x').live('click', function () {
        $(this).parents(".img-item").hide('fast', function () {
            $(this).remove();
        });
    });


    /* add image in slider */
    $('.slider_type .available_media_item').live('click', function () {
        var available_media_item_this_url = $(this).find('.previmg').attr('data-full-url');
        var available_media_item_this_thumburl = $(this).find('.previmg').attr('data-thumb-url');
        var parent_root = $(this).parents('.bg_or_slider_option');
        var settings_type = $(this).parents('.bg_or_slider_option').find('.settings_type').val();


        var data = {
            action:'get_unused_id_ajax'
        };

        waiting_state_start();

        $.post(ajaxurl, data, function (response) {
            parent_root.find(".selected_media .append_block .sortable-img-items").append('<li><div class="img-item item-with-settings append_animation"><input type="hidden" name="pagebuilder[sliders][' + settings_type + '][slides][' + response + '][src]" value="' + available_media_item_this_url + '"><input type="hidden" name="pagebuilder[sliders][' + settings_type + '][slides][' + response + '][slide_type]" value="image"><div class="img-preview"><img src="' + available_media_item_this_thumburl + '" alt=""><div class="hover-container"><div class="inter_x"></div><div class="inter_drag"></div><div class="inter_edit"></div></div></div><div class="edit_popup"><h2>Slide Settings</h2><div class="this-option img-in-slider"><div class="padding-cont"><div class="fl w9"><h4>slide title</h4><input name="pagebuilder[sliders][' + settings_type + '][slides][' + response + '][title][value]" type="text" value="" class="textoption type1"></div><div class="right_block fl w1"><h4>color</h4><div class="color_picker_block"><span class="sharp">#</span><input type="text" value="" name="pagebuilder[sliders][' + settings_type + '][slides][' + response + '][title][color]" maxlength="25" class="medium cpicker textoption type1"><input type="text" value="" class="textoption type1 cpicker_preview" disabled="disabled"></div></div><div class="clear"></div></div><div class="hr_double"></div><div class="padding-cont"><div class="fl w9"><h4>Caption</h4><textarea name="pagebuilder[sliders][' + settings_type + '][slides][' + response + '][caption][value]" type="text" class="textoption type1 big"></textarea></div><div class="right_block fl w1"><h4>color</h4><div class="color_picker_block"><span class="sharp">#</span><input type="text" value="" name="pagebuilder[sliders][' + settings_type + '][slides][' + response + '][caption][color]" maxlength="25" class="medium cpicker textoption type1"><input type="text" value="" class="textoption type1 cpicker_preview" disabled="disabled"></div></div><div class="clear"></div></div></div><div class="padding-cont"><input type="button" value="Done" class="done-btn green-btn" name="ignore_this_button"><div class="clear"></div></div></div></div></li>');
            $('.img-item.append_animation').fadeIn('fast');
            setTimeout("$('.img-item.append_animation').removeClass('append_animation')", 200);

            /* REACTIVATE COLOR PICKER */
            $('.cpicker').ColorPicker({
                onSubmit:function (hsb, hex, rgb, el) {
                    $(el).val(hex);
                    $(el).ColorPickerHide();
                    $(".cpicker.focused").next().css("background-color", "#" + hex);
                },
                onBeforeShow:function () {
                    $(this).ColorPickerSetColor(this.value);
                },
                onHide:function () {
                    $("input").removeClass("focused");
                },
                onChange:function (hsb, hex, rgb) {
                    $(".cpicker.focused").val(hex);
                    $(".cpicker.focused").next().css("background-color", "#" + hex);
                }
            })
                .bind('keyup', function () {
                    $(this).ColorPickerSetColor(this.value);
                });

            $('.cpicker').focus(function () {
                $(this).addClass("focused");
            });

            waiting_state_end();
        });
    });


    /* add video in slider */
    $('.slider_type .add_video_slider').live('click', function () {
        var available_media_item_this_url = $(this).find('.previmg').attr('data-full-url');
        var parent_root = $(this).parents('.bg_or_slider_option');
        var settings_type = $(this).parents('.bg_or_slider_option').find('.settings_type').val();

        var data = {
            action:'get_unused_id_ajax'
        };

        waiting_state_start();

        $.post(ajaxurl, data, function (response) {
            parent_root.find(".selected_media .append_block .sortable-img-items").append('<li><div class="img-item item-with-settings append_animation"><input type="hidden" name="pagebuilder[sliders][' + settings_type + '][slides][' + response + '][src]" value=""><input type="hidden" name="pagebuilder[sliders][' + settings_type + '][slides][' + response + '][slide_type]" value="video"><div class="img-preview"><img src="' + available_media_item_this_url + '" alt=""><div class="hover-container"><div class="inter_x"></div><div class="inter_drag"></div><div class="inter_edit"></div></div></div><div class="edit_popup"><h2>Settings</h2><div class="this-option"><div class="padding-cont"><h4>Video URL (Vimeo or YouTube)</h4><input name="pagebuilder[sliders][' + settings_type + '][slides][' + response + '][src]" type="text" value="" class="textoption type1"><div class="example">Examples:<br>Youtube - http://www.youtube.com/watch?v=YW8p8JO2hQw<br>Vimeo - http://vimeo.com/47989207</div></div><div class="padding-cont" style="padding-top:0;"><div class="fl w9" style="width:601px;"><h4>slide title and slide thumbnail</h4><input name="pagebuilder[sliders][' + settings_type + '][slides][' + response + '][title][value]" type="text" value="" class="textoption type1"></div><div class="right_block fl w1" style="width:115px;"><h4>color</h4><div class="color_picker_block"><span class="sharp">#</span><input type="text" value="" name="pagebuilder[sliders][' + settings_type + '][slides][' + response + '][title][color]" maxlength="25" class="medium cpicker textoption type1"><input type="text" value="" class="textoption type1 cpicker_preview" disabled="disabled"></div></div><div class="preview_img_video_cont"><input type="text" value="" id="slide_' + response + '_upload" name="pagebuilder[sliders][' + settings_type + '][slides][' + response + '][thumbnail][value]" class="textoption type1" style="width:601px;float:left;"><div class="up_btns"><span id="slide_' + response + '" class="button btn_upload_image style2 but_slide_' + response + '">Upload Image</span></div><div class="clear"></div></div><div class="clear"></div></div><div class="hr_double"></div><div class="padding-cont"><div class="fl w9" style="width:601px;"><h4>Caption</h4><textarea name="pagebuilder[sliders][' + settings_type + '][slides][' + response + '][caption][value]" type="text" class="textoption type1 big" style="height:70px;"></textarea></div><div class="right_block fl w1" style="width:115px;"><h4>color</h4><div class="color_picker_block"><span class="sharp">#</span><input type="text" value="" name="pagebuilder[sliders][' + settings_type + '][slides][' + response + '][caption][color]" maxlength="25" class="medium cpicker textoption type1"><input type="text" value="" class="textoption type1 cpicker_preview" disabled="disabled"></div></div><div class="clear"></div></div></div><div class="hr_double"></div><div class="padding-cont"><input type="button" value="Done" class="done-btn green-btn" name="ignore_this_button"><div class="clear"></div></div></div></div></li>');
            reactivate_color_picker();
            reactivate_ajax_image_upload();
            $('.img-item.append_animation').fadeIn('fast');
            setTimeout("$('.img-item.append_animation').removeClass('append_animation')", 200);
            waiting_state_end();
        });
    });


    /* SHOW/HIDE CONTAINER (SLIDER TYPE) */
    $(".pb-cont .line_option .toggler .radio_toggle_mirage").live('click', function () {
        $(this).parents('.bg_or_slider_option').find('.hideable-area').toggle('fast');
    });


    /* OPEN POPUP EDIT */
    function show_settings_popup(thisTrigger, popupContainerClass) {
        popupAutoH();
        var edit_popup_area = thisTrigger.parents('.item-with-settings').find('.edit_popup');
        edit_popup_area.fadeToggle('fast').addClass('nowOpen');
        $('.popup-bg').fadeIn('fast');
        var pop_width = $('.edit_popup.nowOpen').width();
        var pop_height = $('.edit_popup.nowOpen').height();
        var offset_width = pop_width / 2;
        var offset_height = pop_height / 2;
        $('.edit_popup.nowOpen').css('marginLeft', '-' + offset_width + 'px');
        $('.edit_popup.nowOpen').css('marginTop', '-' + offset_height + 'px');
    }

    /* CLOSE POPUP EDIT */
    function close_settings_popup() {
        $('.edit_popup.nowOpen').fadeOut('fast');
        $('.popup-bg').fadeOut('fast');
        setTimeout("$('.edit_popup.nowOpen').css('marginLeft', '0px').css('marginTop', '0px').removeClass('nowOpen')", 300);
    }

    $('.inter_edit, .module-cont .edit.box-with-icon .control-element').live('click', function () {
        show_settings_popup($(this));
    });

    $('.popup-bg, .done-btn').live('click', function () {
        close_settings_popup();
    });

    $('.sortable-img-items').sortable({ placeholder:'ui-state-highlight', handle:'.inter_drag' });
    $('.sortable-modules').sortable({ placeholder:'ui-state-highlight', handle:'.dragger' });
    $('.sections').sortable({ placeholder:'ui-state-highlight-sections', handle:'.some-element.move' });
    $('.feature-list').sortable({ placeholder:'ui-state-highlight-sections', handle:'.some-element2.move' });

    /* Click & add img to background container */
    $('.bg_or_slider_option.bg_type .available_media_item').live('click', function () {
        var for_bg_data_full_url = jQuery(this).find('.previmg').attr('data-full-url');
        var for_bg_data_preview_bg_image = jQuery(this).find('.previmg').attr('data-thumb-url');
        $('.bg_or_slider_option.bg_type .preview_bg_image').fadeOut('fast', function () {
            $('.bg_or_slider_option.bg_type .preview_bg_image').delay(200).attr('src', for_bg_data_preview_bg_image).fadeIn('fast');
        });
        $('.bg_or_slider_option.bg_type .bg_image_src').val(for_bg_data_full_url);
    });


    /* VISIBLE BLOCKS LOGIC FOR BG & SLIDER SETTINGS */
    function closeToggles(toggleClass) {
        $.each(toggleClass, function () {
            $('.radio_toggle_cont.' + this + '').find('.yes_state').removeAttr('checked');
            $('.radio_toggle_cont.' + this + '').find('.no_state').attr('checked', 'checked');
            $('.radio_toggle_cont.' + this + '').find('.radio_toggle_mirage').removeClass('checked').addClass('not_checked');
            $('.radio_toggle_cont.' + this + '').parents('.bg_or_slider_option').find('.hideable-area').hide('fast');
            $('.radio_toggle_cont.' + this + '').find('.radio_toggle_mirage').removeClass("checked").addClass("not_checked");
            $('.radio_toggle_cont.' + this + '').find('.radio_toggle_mirage').stop().animate({backgroundPosition:'100% 0%'}, {duration:'fast'});
        });
    }

    $('.bg_slide_sett').live('click', function () {
        /* WORK ONLY IF WE OPEN SOME TOGGLER */
        if ($(this).find('.yes_state').attr('checked')) {
            /* fullscreen_toggler */
            if ($(this).hasClass('fullscreen_toggler')) {
                var click_on = 'fullscreen_toggler';
                hide_items = new Array("fullwidth_toggler", "bgimage_toggler", "bgcolor_toggler");
                closeToggles(hide_items);
            }
            /* fullwidth_toggler */
            if ($(this).hasClass('fullwidth_toggler')) {
                var click_on = 'fullwidth_toggler';
                hide_items = new Array("fullscreen_toggler");
                closeToggles(hide_items);
            }
            /* bgimage_toggler */
            if ($(this).hasClass('bgimage_toggler')) {
                var click_on = 'bgimage_toggler';
                hide_items = new Array("fullscreen_toggler");
                closeToggles(hide_items);
            }
            /* bgcolor_toggler */
            if ($(this).hasClass('bgcolor_toggler')) {
                var click_on = 'bgcolor_toggler';
                hide_items = new Array("fullscreen_toggler");
                closeToggles(hide_items);
            }
        }
    });


    /* SLIDE CHECK BOX */

    /* START STATE */
    check_visual_part_for_toggles();
    /* END START STATE */


    $(".radio_toggle_cont .radio_toggle_mirage").live('click', function () {

        var this_click_btn = $(this);
        var radio_toggle_cont = this_click_btn.parents(".radio_toggle_cont");

        if (this_click_btn.hasClass("checked")) {
            this_click_btn.stop().animate({backgroundPosition:'100% 0%'}, {duration:'fast'});
            this_click_btn.removeClass("checked").addClass("not_checked");
            radio_toggle_cont.find('.yes_state').removeAttr("checked");
            radio_toggle_cont.find('.no_state').attr("checked", "checked");
        } else {

            /* only one accordion can be expanded */
            this_click_btn.parents('.edit_popup').find('.accordion_expanded_toggle').find('.radio_toggle_mirage').each(function (index) {
                if ($(this).not(".checked")) {
                    var radio_toggle_cont2 = $(this).parents(".radio_toggle_cont");
                    $(this).stop().animate({backgroundPosition:'100% 0%'}, {duration:'fast'});
                    $(this).removeClass("checked").addClass("not_checked");
                    radio_toggle_cont2.find('.yes_state').removeAttr("checked");
                    radio_toggle_cont2.find('.no_state').attr("checked", "checked");
                }
            });

            this_click_btn.stop().animate({backgroundPosition:'0% 0%'}, {duration:'fast'});
            this_click_btn.removeClass("not_checked").addClass("checked");
            radio_toggle_cont.find('.no_state').removeAttr("checked");
            radio_toggle_cont.find('.yes_state').attr("checked", "checked");
        }
    });
    /* END SLIDE CHECK BOX */

    /* PAGE BUILDER MODULE SIZER */
    function change_size_pb(parent_module_cont, new_size) {
        parent_module_cont.removeClass('block_1_4');
        parent_module_cont.removeClass('block_1_3');
        parent_module_cont.removeClass('block_1_2');
        parent_module_cont.removeClass('block_2_3');
        parent_module_cont.removeClass('block_3_4');
        parent_module_cont.removeClass('block_1_1');
        parent_module_cont.find('.current_size').val(new_size);
    }

    /* MORE */
    $('.right.box-with-icon .control-element').live('click', function () {
        parent_module_cont = $(this).parents('.module-cont');
        var now_size = parent_module_cont.find('.current_size').val();

        if (now_size == "block_1_4") {
            change_size_pb(parent_module_cont, "block_1_3");
            parent_module_cont.addClass("block_1_3");
            parent_module_cont.find(".control-element span").html("1/3");
        }
        if (now_size == "block_1_3") {
            change_size_pb(parent_module_cont, "block_1_2");
            parent_module_cont.addClass("block_1_2");
            parent_module_cont.find(".control-element span").html("1/2");
        }
        if (now_size == "block_1_2") {
            change_size_pb(parent_module_cont, "block_2_3");
            parent_module_cont.addClass("block_2_3");
            parent_module_cont.find(".control-element span").html("2/3");
        }
        if (now_size == "block_2_3") {
            change_size_pb(parent_module_cont, "block_3_4");
            parent_module_cont.addClass("block_3_4");
            parent_module_cont.find(".control-element span").html("3/4");
        }
        if (now_size == "block_3_4") {
            change_size_pb(parent_module_cont, "block_1_1");
            parent_module_cont.addClass("block_1_1");
            parent_module_cont.find(".control-element span").html("1/1");
        }
    });
    /* LESS */
    $('.left.box-with-icon .control-element').live('click', function () {
        parent_module_cont = $(this).parents('.module-cont');
        var now_size = parent_module_cont.find('.current_size').val();

        if (now_size == "block_1_1") {
            change_size_pb(parent_module_cont, "block_3_4");
            parent_module_cont.addClass("block_3_4");
            parent_module_cont.find(".control-element span").html("3/4");
        }
        if (now_size == "block_3_4") {
            change_size_pb(parent_module_cont, "block_2_3");
            parent_module_cont.addClass("block_2_3");
            parent_module_cont.find(".control-element span").html("2/3");
        }
        if (now_size == "block_2_3") {
            change_size_pb(parent_module_cont, "block_1_2");
            parent_module_cont.addClass("block_1_2");
            parent_module_cont.find(".control-element span").html("1/2");
        }
        if (now_size == "block_1_2") {
            change_size_pb(parent_module_cont, "block_1_3");
            parent_module_cont.addClass("block_1_3");
            parent_module_cont.find(".control-element span").html("1/3");
        }
        if (now_size == "block_1_3") {
            change_size_pb(parent_module_cont, "block_1_4");
            parent_module_cont.addClass("block_1_4");
            parent_module_cont.find(".control-element span").html("1/4");
        }
    });
    /* END PAGE BUILDER MODULE SIZER */


    /* ADD MODULE */
    $(".pb-module").live('click', function () {
        var add_module_name = $(this).attr('data-module-name');
        var add_module_caption = $(this).find('span.module-name').text();
        //var add_module_popup = $(this).find('.hided_popup').html();

        waiting_state_start();

        var data = {
            action:'get_module_html',
            module_name:add_module_name,
            module_caption:add_module_caption,
            postid_for_module:post_id
        };

        $.post(ajaxurl, data, function (response) {
            $('.pb-list-active-modules .sortable-modules').append(response);
            reactivate_color_picker();
            reactivate_sortable();
            reactivate_selectbox();
            reactivate_custom_scroll();
            waiting_state_end();
            check_visual_part_for_toggles();
        });

    });
    /* END ADD MODULE */

    $(".module-cont .delete .control-element").live('click', function () {
        $(this).parents(".module-cont").remove();
    });

    $(".delete.some-element2").live('click', function () {
        $(this).parents(".price_feature").remove();
    });

    $(".section .some-element.delete").live('click', function () {
        $(this).parents(".section").remove();
    });

    $(".section .some-element.edit").live('click', function () {
        $(this).parents(".section").find(".hide_area").toggle("fast");
    });

    $(".some-element2.edit2").live('click', function () {
        $(this).parents(".price_feature").find(".hide_area2").toggle("fast");
    });

    /* add new section accordion */
    $(".add_new_accordion_section").live('click', function () {
        var target1 = $(this).parents(".edit_popup").find(".sections");
        var this_key1 = $(this).parents(".module-cont").find(".module_key").val();
        var data = {
            action:'get_unused_id_ajax'
        };

        waiting_state_start();

        $.post(ajaxurl, data, function (response) {

            var this_append = "<li class='section'><div class='heading line_option visual_style1 big_type'><div class='option_title text-shadow1'>Section</div><div class='some-element clickable edit hovered'></div><div class='pre_toggler'></div><div class='some-element movable move hovered'></div><div class='pre_toggler'></div><div class='some-element clickable delete hovered'></div><div class='pre_toggler'></div></div><div class='clear'></div><div class='hide_area'><div class='some-padding'><input type='text' class='expanded_text1 type1 section_name' name='pagebuilder[modules][module_id][module_items][section_id][title]' value=''><textarea class='expanded_text1 type2 mt' name='pagebuilder[modules][module_id][module_items][section_id][description]'></textarea></div><div class='expanded_state_cont'><span class='text-shadow1'>Expanded</span><div class='radio_toggle_cont accordion_expanded_toggle'><input type='radio' class='checkbox_slide yes_state' value='yes' name='pagebuilder[modules][module_id][module_items][section_id][expanded_state]'><input type='radio' class='checkbox_slide no_state' value='no' checked='checked' name='pagebuilder[modules][module_id][module_items][section_id][expanded_state]'><div class='radio_toggle_mirage' style='background-position: 100% 0%;'></div></div></div></div></li>";

            this_append = this_append.replace(new RegExp("section_id", 'g'), response);
            this_append = this_append.replace(new RegExp("module_id", 'g'), this_key1);

            target1.append(this_append);

            reactivate_sortable();
            waiting_state_end();

        });
    });

    /* add new section diagramm */
    $(".add_new_diagramm_section").live('click', function () {
        var target1 = $(this).parents(".edit_popup").find(".sections");
        var this_key1 = $(this).parents(".module-cont").find(".module_key").val();
        var data = {
            action:'get_unused_id_ajax'
        };

        waiting_state_start();

        $.post(ajaxurl, data, function (response) {

            var this_append = "<li class='section'><div class='heading line_option visual_style1 big_type'><div class='option_title text-shadow1'>Section</div><div class='some-element clickable edit hovered'></div><div class='pre_toggler'></div><div class='some-element movable move hovered'></div><div class='pre_toggler'></div><div class='some-element clickable delete hovered'></div><div class='pre_toggler'></div></div><div class='clear'></div><div class='hide_area'><div class='some-padding'><input type='text' class='expanded_text1 type1 section_name' name='pagebuilder[modules][module_id][module_items][section_id][title]' value=''> Percent: <input type='text' value='' style='width:88px; text-align: center; margin-right: 2px; float: right;' name='pagebuilder[modules][module_id][module_items][section_id][percent]' class='expanded_text1 type1 section_name'></div></div></li>";

            this_append = this_append.replace(new RegExp("section_id", 'g'), response);
            this_append = this_append.replace(new RegExp("module_id", 'g'), this_key1);

            target1.append(this_append);

            reactivate_sortable();
            waiting_state_end();

        });
    });

    /* add new toggle section */
    $(".add_new_toggle_section").live('click', function () {
        var target1 = $(this).parents(".edit_popup").find(".sections");
        var this_key1 = $(this).parents(".module-cont").find(".module_key").val();
        var data = {
            action:'get_unused_id_ajax'
        };

        waiting_state_start();

        $.post(ajaxurl, data, function (response) {

            var this_append = "<li class='section'><div class='heading line_option visual_style1 big_type'><div class='option_title text-shadow1'>Section</div><div class='some-element clickable edit hovered'></div><div class='pre_toggler'></div><div class='some-element movable move hovered'></div><div class='pre_toggler'></div><div class='some-element clickable delete hovered'></div><div class='pre_toggler'></div></div><div class='clear'></div><div class='hide_area'><div class='some-padding'><input type='text' class='expanded_text1 type1 section_name' name='pagebuilder[modules][module_id][module_items][section_id][title]' value=''><textarea class='expanded_text1 type2 mt' name='pagebuilder[modules][module_id][module_items][section_id][description]'></textarea></div><div class='expanded_state_cont'><span class='text-shadow1'>Expanded</span><div class='radio_toggle_cont toggles_expanded_toggle'><input type='radio' class='checkbox_slide yes_state' value='yes' name='pagebuilder[modules][module_id][module_items][section_id][expanded_state]'><input type='radio' class='checkbox_slide no_state' value='no' checked='checked' name='pagebuilder[modules][module_id][module_items][section_id][expanded_state]'><div class='radio_toggle_mirage' style='background-position: 100% 0%;'></div></div></div></div></li>";

            this_append = this_append.replace(new RegExp("section_id", 'g'), response);
            this_append = this_append.replace(new RegExp("module_id", 'g'), this_key1);

            target1.append(this_append);

            reactivate_sortable();
            waiting_state_end();

        });
    });

    /* add new row */
    $(".add_new_row_section").live('click', function () {
        var target3 = $(this).parents(".rows_must_be_here").find(".row-list");
        var this_key3 = $(this).parents(".rows_must_be_here").find(".moduleid").val();
        var data = {
            action:'get_unused_id_ajax'
        };

        waiting_state_start();

        $.post(ajaxurl, data, function (response) {

            var this_append = "<li class='section'><div class='heading line_option visual_style1 big_type'><div class='option_title text-shadow1'>&nbsp;</div><div class='some-element clickable edit hovered'></div><div class='pre_toggler'></div><div class='some-element movable move hovered'></div><div class='pre_toggler'></div><div class='some-element clickable delete hovered'></div><div class='pre_toggler'></div></div><div class='clear'></div><div class='hide_area'><div class='some-padding'><textarea class='expanded_text1 type2 mt' name='pagebuilder[modules][module_id][module_items][section_id][text]'></textarea></div></div></li>";

            this_append = this_append.replace(new RegExp("section_id", 'g'), response);
            this_append = this_append.replace(new RegExp("module_id", 'g'), this_key3);

            target3.append(this_append);

            reactivate_sortable();
            waiting_state_end();

        });
    });

    /* add new price feature */
    $(".add_new_price_feature").live('click', function () {
        var target3 = $(this).parent().find(".feature-list");
        var this_key3 = $(this).parent().find(".moduleid").val();
        var this_sectionid = $(this).parent().find(".sectionid").val();
        var data = {
            action:'get_unused_id_ajax'
        };

        waiting_state_start();

        $.post(ajaxurl, data, function (response) {

            var this_append3 = "<li class='price_feature'><div class='heading line_option visual_style1 big_type'><div class='option_title text-shadow1'>&nbsp;</div><div class='some-element2 clickable edit2 hovered'></div><div class='pre_toggler'></div><div class='some-element2 movable move hovered'></div><div class='pre_toggler'></div><div class='some-element2 clickable delete hovered'></div><div class='pre_toggler'></div></div><div class='clear'></div><div class='hide_area2'><div class='some-padding'><textarea class='expanded_text1 type2 mt' name='pagebuilder[modules][module_id][module_items][" + this_sectionid + "][price_features][" + response + "]'></textarea></div></div></li>";

            this_append3 = this_append3.replace(new RegExp("module_id", 'g'), this_key3);

            target3.append(this_append3);

            reactivate_sortable();
            waiting_state_end();

        });
    });


    /* add new price block */
    $(".add_new_price_block").live('click', function () {
        var target3 = $(this).parents(".rows_must_be_here").find(".row-list");
        var this_key3 = $(this).parents(".rows_must_be_here").find(".moduleid").val();
        var data = {
            action:'get_unused_id_ajax'
        };

        waiting_state_start();

        $.post(ajaxurl, data, function (response) {

            var this_append = "<li class='section'><div class='heading line_option visual_style1 big_type'><div class='option_title text-shadow1'>&nbsp;</div><div class='some-element clickable edit hovered'></div><div class='pre_toggler'></div><div class='some-element movable move hovered'></div><div class='pre_toggler'></div><div class='some-element clickable delete hovered'></div><div class='pre_toggler'></div></div><div class='clear'></div><div class='hide_area'><div class='some-padding'><div class='caption'>Name</div><input class='expanded_text type3' name='pagebuilder[modules][module_id][module_items][section_id][block_name]'><div class='caption'>Price</div><input class='expanded_text type3' name='pagebuilder[modules][module_id][module_items][section_id][block_price]'><div class='caption'>Period</div><input class='expanded_text type3' name='pagebuilder[modules][module_id][module_items][section_id][block_period]'><div class='rows_must_be_here dark_lined'><input type='hidden' name='moduleid' class='moduleid' value='module_id'><input type='hidden' name='sectionid' class='sectionid' value='" + response + "'><div class='heading line_option visual_style1 small_type hovered clickable add_new_price_feature'><div class='option_title text-shadow1'>Add feature</div><div class='some-element cross'></div><div class='pre_toggler'></div></div><ul class='feature-list'></ul></div><div class='caption'>\"Get it now\" Link</div><input class='expanded_text type3' name='pagebuilder[modules][module_id][module_items][section_id][block_link]'><div class='caption'>\"Get it now\" caption</div><input class='expanded_text type3' name='pagebuilder[modules][module_id][module_items][section_id][get_it_now_caption]'><div class='caption' style='float:left; margin-top: 13px; margin-right: 15px;'>Most popular</div><div class='radio_toggle_cont toggles_expanded_toggle most_popular'><input type='radio' class='checkbox_slide yes_state' value='yes' name='pagebuilder[modules][module_id][module_items][section_id][most_popular]'><input type='radio' class='checkbox_slide no_state' value='no' checked='checked' name='pagebuilder[modules][module_id][module_items][section_id][most_popular]'><div class='radio_toggle_mirage' style='background-position: 100% 0%;'></div></div><div class='clear'></div></div></div></li>";

            this_append = this_append.replace(new RegExp("section_id", 'g'), response);
            this_append = this_append.replace(new RegExp("module_id", 'g'), this_key3);

            target3.append(this_append);

            reactivate_sortable();
            waiting_state_end();

        });
    });


    /* jsroll activate */
    $('.pop_scrollable_area').jScrollPane({showArrows:true, autoReinitialise:true});

    $('.section_name').live('keyup', function () {
        var thistitle = $(this).val();
        $(this).parents(".section").find(".option_title").text(thistitle);
    });


    /* ADD IMAGE FOR POST FORMAT */
    $(".available-images-for-pf .ajax_cont .img-item").live('click', function(){
        //$(this).removeClass("available_media_item").clone().appendTo(".selected-images-for-pf");
        var pffullurl = $(this).find(".previmg").attr("data-full-url");
        var previewurl = jQuery(this).find(".previmg").attr("src");

        var data = {
            action:'get_unused_id_ajax'
        };

        waiting_state_start();

        $.post(ajaxurl, data, function (response) {
            $(".selected-images-for-pf").append("<div class='img-item append_animation style_small'><div class='img-preview'><img src='"+previewurl+"' data-full-url='"+pffullurl+"' data-thumb-url='"+previewurl+"' alt='' class='previmg'><div class='hover-container'></div></div><input type='hidden' name='pagebuilder[post-formats][images]["+response+"][src]' value='"+pffullurl+"'></div>");

            $('.img-item.append_animation').fadeIn('fast');
            setTimeout("$('.img-item.append_animation').removeClass('append_animation')", 200);
            waiting_state_end();
        });

    });

    /* DELETE IMAGE FOR POST FORMAT */
    $(".selected-images-for-pf .img-item").live('click', function(){
        $(this).fadeOut('fast');
        var tmpthis = $(this);
        setTimeout(function() {
            tmpthis.remove();
        }, 1000);
    });

    popupAutoH();

    /* SHORTCODES QUICK PANEL */
    $(".qshortcode_icon").live("click", function(){
        var data_shortcode_tech_name = $(this).attr("data-shortcode_tech_name");
        //alert(data_shortcode_tech_name);
        $(".quick_shortcodes_option").hide("fast");
        $(this).parents(".qshorct_cont").find("."+data_shortcode_tech_name+"").show("fast");
    });
    $(".qsc_insert").live("click", function(){
        $(".quick_shortcodes_option").hide("fast");
    });

        /* CUSTOM BUTTON */
        $(".custom_button_inserter").live("click", function(){
            var custom_button_sc_address = $(this).parents(".quick_shortcodes_option").find(".custom_button_sc_address").val();
            var custom_button_sc_type = $(this).parents(".quick_shortcodes_option").find(".custom_button_sc_type").val();
            var custom_button_sc_text = $(this).parents(".quick_shortcodes_option").find(".custom_button_sc_text").val();
            var custom_button_target = $(this).parents(".quick_shortcodes_option").find(".custom_button_target").val();

            var tmp_txt_val = $(this).parents(".edit_popup").find(".sc_inserted_here .enter_text1").val();
            $(this).parents(".edit_popup").find(".sc_inserted_here .enter_text1").val(tmp_txt_val + " " + "[custom_button target='"+custom_button_target+"' style='"+custom_button_sc_type+"' href='"+custom_button_sc_address+"']"+custom_button_sc_text+"[/custom_button]");
        });

        /* BLOCKQUOTE */
        $(".blockquote_inserter").live("click", function(){
            var blockquote_sc_width = $(this).parents(".quick_shortcodes_option").find(".blockquote_sc_width").val();
            var blockquote_sc_author = $(this).parents(".quick_shortcodes_option").find(".blockquote_sc_author").val();
            var blockquote_sc_float = $(this).parents(".quick_shortcodes_option").find(".blockquote_sc_float").val();
            var blockquote_sc_text = $(this).parents(".quick_shortcodes_option").find(".blockquote_sc_text").val();
            var quote_type = $(this).parents(".quick_shortcodes_option").find(".quote_type").val();

            var tmp_txt_val = $(this).parents(".edit_popup").find(".sc_inserted_here .enter_text1").val();
            $(this).parents(".edit_popup").find(".sc_inserted_here .enter_text1").val(tmp_txt_val + " " + "[blockquote author_name='"+blockquote_sc_author+"' width='"+blockquote_sc_width+"' float='"+blockquote_sc_float+"'  quote_type='"+quote_type+"']"+blockquote_sc_text+"[/blockquote]");
        });

        /* Dropcaps */
        $(".dropcaps_inserter").live("click", function(){
            var dropcaps_sc_type = $(this).parents(".quick_shortcodes_option").find(".dropcaps_sc_type").val();
            var dropcaps_sc_text = $(this).parents(".quick_shortcodes_option").find(".dropcaps_sc_text").val();

            var tmp_txt_val = $(this).parents(".edit_popup").find(".sc_inserted_here .enter_text1").val();
            $(this).parents(".edit_popup").find(".sc_inserted_here .enter_text1").val(tmp_txt_val + " " + "[dropcaps type='"+dropcaps_sc_type+"']"+dropcaps_sc_text+"[/dropcaps]");
        });

        /* Frame */
        $(".frame_inserter").live("click", function(){
            var frame_sc_width = $(this).parents(".quick_shortcodes_option").find(".frame_sc_width").val();
            var frame_sc_height = $(this).parents(".quick_shortcodes_option").find(".frame_sc_height").val();
            var frame_sc_title = $(this).parents(".quick_shortcodes_option").find(".frame_sc_title").val();
            var frame_sc_src = $(this).parents(".quick_shortcodes_option").find(".frame_sc_src").val();
            var frame_sc_float = $(this).parents(".quick_shortcodes_option").find(".frame_sc_float").val();

            var tmp_txt_val = $(this).parents(".edit_popup").find(".sc_inserted_here .enter_text1").val();
            $(this).parents(".edit_popup").find(".sc_inserted_here .enter_text1").val(tmp_txt_val + " " + "[frame style='"+frame_sc_float+"' title='"+frame_sc_title+"' width='"+frame_sc_width+"' height='"+frame_sc_height+"' url='"+frame_sc_src+"'][/frame]");
        });

        /* Video */
        $(".video_inserter").live("click", function(){
            var video_sc_width = $(this).parents(".quick_shortcodes_option").find(".video_sc_width").val();
            var video_sc_height = $(this).parents(".quick_shortcodes_option").find(".video_sc_height").val();
            var video_sc_src = $(this).parents(".quick_shortcodes_option").find(".video_sc_src").val();
            var video_sc_float = $(this).parents(".quick_shortcodes_option").find(".video_sc_float").val();

            var tmp_txt_val = $(this).parents(".edit_popup").find(".sc_inserted_here .enter_text1").val();
            $(this).parents(".edit_popup").find(".sc_inserted_here .enter_text1").val(tmp_txt_val + " " + "[video float='"+video_sc_float+"' w='"+video_sc_width+"' h='"+video_sc_height+"' video_url='"+video_sc_src+"'][/video]");
        });

        /* Highlighter */
        $(".highlighter_inserter").live("click", function(){
            var highlighter_sc_type = $(this).parents(".quick_shortcodes_option").find(".highlighter_sc_type").val();
            var highlighter_sc_text = $(this).parents(".quick_shortcodes_option").find(".highlighter_sc_text").val();

            var tmp_txt_val = $(this).parents(".edit_popup").find(".sc_inserted_here .enter_text1").val();
            $(this).parents(".edit_popup").find(".sc_inserted_here .enter_text1").val(tmp_txt_val + " " + "[highlighter type='"+highlighter_sc_type+"']"+highlighter_sc_text+"[/highlighter]");
        });

        /* Dividers */
        $(".dividers_inserter").live("click", function(){
            var dividers_sc_type = $(this).parents(".quick_shortcodes_option").find(".dividers_sc_type").val();

            var tmp_txt_val = $(this).parents(".edit_popup").find(".sc_inserted_here .enter_text1").val();
            $(this).parents(".edit_popup").find(".sc_inserted_here .enter_text1").val(tmp_txt_val + " " + "[divider divider_type='"+dividers_sc_type+"'][/divider]");
        });

        /* Social */
        $(".social_inserter").live("click", function(){
            var social_sc_url = $(this).parents(".quick_shortcodes_option").find(".social_sc_url").val();
            var social_sc_type = $(this).parents(".quick_shortcodes_option").find(".social_sc_type").val();
            var social_sc_style = $(this).parents(".quick_shortcodes_option").find(".social_sc_style").val();

            var tmp_txt_val = $(this).parents(".edit_popup").find(".sc_inserted_here .enter_text1").val();
            $(this).parents(".edit_popup").find(".sc_inserted_here .enter_text1").val(tmp_txt_val + " " + "[social_icon style='"+social_sc_style+"' href='"+social_sc_url+"' type='"+social_sc_type+"'][/social_icon]");
        });

    /* END SHORTCODES QUICK PANEL */


    $(".upload_and_insert").live("click", function () {
        tb_show('', 'media-upload.php?type=audio&amp;TB_iframe=true');
        window.thisUploadButton = $(this);

        window.send_to_editor = function (html) {
            audiourl = $(html).attr('href');
            thisUploadButton.parent().next().val(audiourl);
            tb_remove();
        }

        return false;
    });

});


/* WORK ON LOAD */
$(document).ready(function () {
    /* SET DEFAULT SIDEBAR */
    var default_sidebar_layout = $('.default_sidebar_layout').val();
    var selected_sidebar = $(".layout-sidebars").val();
    if (selected_sidebar == '') {
        $('.layout-sidebars').val(default_sidebar_layout);
    }
    /* SET SELECTED SIDEBAR */
    var onload_selected_sidebar = $('.layout-sidebars').val();
    if (onload_selected_sidebar !== "") {
        $('.' + onload_selected_sidebar + '').addClass('active');
    }
    /* SIDEBAR CHOOSER */
    showSidebarChooser();

    /* OPEN ALL PARENT CONTAINERS IF TOGGLER ON */
    $(".pb-cont .line_option .toggler .yes_state").each(function (index) {
        var yes_state = $(this).attr('checked');
        if (yes_state == 'checked') {
            $(this).parents('.bg_or_slider_option').find('.hideable-area').show('fast');
        }
    });

    /* OPEN ALL PARENT CONTAINERS IF TOGGLER ON */
    $(".pb-cont .line_option .toggler .yes_state").each(function (index) {
        var yes_state = $(this).attr('checked');
        if (yes_state == 'checked') {
            $(this).parents('.bg_or_slider_option').find('.hideable-area').show('fast');
        }
    });

});