jQuery(function ($) {

    /* SIDEBAR MANAGER */
    $('.create_new_sidebar_btn').live('click', function () {
        var sidebar_name = $(this).parents('.add_new_sidebar').find('.create_new_sidebar').val();
        if (sidebar_name == "") {
            alert("Sidebar must be named");
            return false;
        }
        $(this).parents('.mix-tab-control').find('.sidebars_list').append('<div class="sidebar_item"><input type="hidden" name="theme_sidebars[]" value="' + sidebar_name + '"><span class="sidebar_name visual_style1">' + sidebar_name + '</span><input type="button" class="delete_this_sidebar img_button cross" name="delete_this_sidebar" value="X"></div>');
        $(this).parents('.add_new_sidebar').find('.create_new_sidebar').val("");
    });
    $('.delete_this_sidebar').live('click', function () {
        var agree = confirm("Are you sure?");
        if (!agree)
            return false;
        $(this).parents('.sidebar_item').remove();
    });
    /* END SIDEBAR MANAGER */


    /*
     Hide/Show tabs
     */
    jQuery('.l-mix-tabs-item').click(function () {
        jQuery('.l-mix-tabs-item').removeClass('active');
        jQuery('.mix-tab').hide();

        var data_tabname = jQuery(this).find('.l-mix-tab-title').attr('data-tabname');

        jQuery(this).addClass('active');
        jQuery('.' + data_tabname).show();
        jQuery('#form-tab-id').val(data_tabname);

        return false;
    });

    /*
     Hide/Show tabs
     */
    jQuery('.l-mix-tabs-list li').first().addClass('active');
    jQuery('.mix-tabs .mix-tab').first().show();

    /*
     Autoopen tab in admin
     */
    var admin_tab_now_open = jQuery('#form-tab-id').val();
    if (admin_tab_now_open !== "") {
        jQuery('.l-mix-tabs-item').removeClass('active');
        jQuery('#' + admin_tab_now_open).addClass('active');
        jQuery('.mix-tab').hide();
        jQuery('.' + admin_tab_now_open).show();
    }

    jQuery('.fadeout').delay(2000).fadeOut("slow");

    jQuery('body').append("<div class='shortcodesContainer'></div>");


    // ajax button
    $('.mix_ajax_button').click(function () {

        var $this = $(this),
            $loader = $this.next(),
            $msgs = $loader.next(),
            id = $this.data('id'),
            _confirm = $this.data('confirm') || true,
            data = window.ajaxButtonData[id];

        if (_confirm) {
            if (!confirm('Are you sure?')) {
                return false;
            }
            ;
        }
        ;

        $loader.show();
        $.post(admin_ajax, data, function (data) {
            $loader.hide();
        }, 'json');

        return false;
    });


    /* SLIDER */
    function resetSliderAtts(li_for_this_slider) {

        $(li_for_this_slider).each(function (index) {
            $(this).find(".itemorder").val(index);
        });
    }

    $(".sortable").sortable({
        out:function (event, ui) {
            var li_for_this_slider = $(this).find("li");
            resetSliderAtts(li_for_this_slider);
        },
        create:function (event, ui) {
            var li_for_this_slider = $(this).find("li");
            resetSliderAtts(li_for_this_slider);
        },
        delay:200
    });


    $('.itemTitle').live('keyup', function () {
        var thistitle = $(this).val();
        $(this).parents(".thisitem").find(".echotitle").html(thistitle);
    });

    $('.price_feature .expanded_text1').live('keyup', function () {
        var thistitle = $(this).val();
        $(this).parents(".price_feature").find(".option_title").html(thistitle);
    });

    $(".deleteThisSlide").live("click", function () {

        var temp = $(this).parents(".mainPageSliderItem").find("li");

        $(this).parents("li").remove();

        var tempi = -1;
        temp.each(function (index) {
            $(this).find(".itemorder").val(tempi);
            tempi = tempi + 1;
        });

    });

    $(".editThisSlide").live("click", function () {
        $(this).parents(".thisitem").find(".hiddenArea").fadeToggle();
    });

    $(".addnewslide").live("click", function(){
        var data = {
            action: 'get_unused_slideid'
        };

        var thisButton = $(this);

        $.post(ajaxurl, data, function(response) {
            var newslide = '<li slideid="test_'+response+'"><input class="itemorder" type="hidden" name="mainSlider['+response+'][itemorder]"><div class="thisitem"><span class="echotitle"></span><span class="deleteThisSlide"></span><span class="editThisSlide"></span><div class="hiddenArea"><div class="fl">MP3</div><div class="fr"><input class="itemImage" type="text" name="mainSlider['+response+'][mp3]" value=""><input type="button" name="upload_image" class="audioUpload button" value="Upload"></div><div class="fl" style="clear:both;">OGG</div><div class="fr"><input class="itemImage" type="text" name="mainSlider['+response+'][ogg]" value=""><input type="button" name="upload_image" class="audioUpload button" value="Upload"></div></div></div></li>';

            $(thisButton).parents(".mainPageSliderItem").find(".sortable").append(newslide);

            var tempi = 0;
            $(thisButton).parents(".mainPageSliderItem").find("li").each(function(index) {
                $(this).find(".itemorder").val(tempi);
                tempi = tempi+1;
            });
        });
    });


    $(".uploadImg").live("click", function () {
        formfield = jQuery('.uploadImg').attr('name');
        tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
        window.thisUploadButton = $(this);

        window.send_to_editor = function (html) {
            imgurl = jQuery('img', html).attr('src');
            thisUploadButton.parents(".fr").find(".itemImage").val(imgurl);
            tb_remove();
        }

        return false;
    });

    $(".audioUpload").live("click", function () {
        formfield = jQuery('.audioUpload').attr('name');
        tb_show('', 'media-upload.php?type=audio&amp;TB_iframe=true');
        window.thisUploadButton = $(this);

        window.send_to_editor = function (html) {
            imgurl = $(html).attr('href');
            thisUploadButton.parents(".fr").find(".itemImage").val(imgurl);
            tb_remove();
        }

        return false;
    });


    $(window).load(function () {
        $(".addnewslideforport").live("click", function () {
            $(this).parents(".append_items").append("<div class='thisline thisitem'><label class='label_type2'>Slide:</label> <input type='text' value='' name='portslides[]' class='itemImage portslides itt_type2'> <span class='addnewslideforport'></span> <span class='delthisslideforport'></span> <input type='button' value='Upload' class='uploadImg button' name='upload_image'></div>");
        });
        $(".delthisslideforport").live("click", function () {
            $(this).parents(".thisline").remove();
        });

        /* COLOR PICKER */
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


        /* POST FORMATS */
        /* list of all containers: #portslides_sectionid_inner, #audio_sectionid_inner, #video_sectionid_inner, #default_sectionid_inner */
        var nowpostformat = $('#post-formats-select input:checked').val();

        if (nowpostformat == 'image') {
            $('#portslides_sectionid_inner').show();
        }
        if (nowpostformat == 'audio') {
            $('#audio_sectionid_inner').show();
        }
        if (nowpostformat == 'video') {
            $('#video_sectionid_inner').show();
        }
        if (nowpostformat == '0') {
            $('#default_sectionid_inner').show();
        }

        /* ON CHANGE */
        $('#post-formats-select input').click(function () {
            $('#portslides_sectionid_inner, #audio_sectionid_inner, #video_sectionid_inner, #default_sectionid_inner').hide();
            var nowclickformat = $(this).val();
            if (nowclickformat == 'image') {
                $('#portslides_sectionid_inner').show();
            }
            if (nowclickformat == 'audio') {
                $('#audio_sectionid_inner').show();
            }
            if (nowclickformat == 'video') {
                $('#video_sectionid_inner').show();
            }
            if (nowclickformat == '0') {
                $('#default_sectionid_inner').show();
            }
        });

        /* Show tab on start */
        if ($("#form-tab-id").val() == "") {
            $("#form-tab-id").val($(".l-mix-tabs-list li.active a").attr("data-tabname"))
        }

        $(".cpicker.textoption").each(function (index) {
            var already_selected_color = $(this).val();
            $(this).next().css("background-color", "#" + already_selected_color);
        });

        $('.cpicker.textoption').keyup(function (event) {
            var now_enter_color = $(this).val();
            $(this).next().css("background-color", "#" + now_enter_color);
        });

    });

    $('.cpicker').focus(function () {
        $(this).addClass("focused");
    });

    /* SELECT BOX */
    $(".mix-container select, .newselect").selectBox();
    /* END SELECT BOX */

    $(document).ready(function () {
        $('select.fontselector').change(function () {
            var newval = $(this).val();

            var customfontstatus = "disabled";

            if(fontsarray.length>0){
                for ( keyVar in fontsarray ) {
                    if (newval==fontsarray[keyVar]) {
                        customfontstatus = "enabled";
                    }
                }
            }

            if (customfontstatus!=="enabled") {
                newval_font = newval.replace(new RegExp(" ", 'g'), "+");
                $("head").append("<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=" + newval_font + "'>");
                $(this).parents(".input").find(".font_preview").css("font-family", newval);
            } else {
                $(this).parents(".input").find(".font_preview").css("font-family", newval);
            }
        });

        $("select.fontselector").each(function(){
            $(this).triggerHandler("change");
        })
    });

});

function remove_responce_message () {
    $("#wpwrap").css("opacity", "1");
    $(".result_message").remove();
}

/* SAVING ADMIN SETTINGS WITH AJAX */
$("document").ready(function() {
    $(".admin_save_all").click(function() {
        $("#wpwrap").css("opacity", "0.5");
        var data = $(".admin_page_settings").serialize();
        $.post(ajaxurl, { action:'save_admin_settings', json_string:data }, function(response) {
            $("body").append("<div class='result_message'>"+response+"</div>");
            setTimeout(remove_responce_message , 2000);
        });
        return false;
    });
    $(".reset_settings").click(function() {
        var agree = confirm("Are you sure?");
        if (!agree)
            return false;
        $("#wpwrap").css("opacity", "0.5");
        $.post(ajaxurl, { action:'reset_admin_settings' }, function(response) {
            $("body").append("<div class='result_message'>"+response+"</div>");
            setTimeout(remove_responce_message , 2000);
            window.location.reload();
        });
        return false;
    });
});