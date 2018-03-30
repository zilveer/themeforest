jQuery.noConflict();
jQuery(document).ready(function($) {
    "use strict";
    var preset1 = new Array();
    preset1['primary_color']='#a0ce4e';
    preset1['secondary_color']='#c69653';
    preset1['button_gradient_top_color']='#c6b08f';
    preset1['button_gradient_bottom_color']='#c69c61';
    preset1['button_gradient_top_color_hover']='#c6b08f';
    preset1['button_border_color']='#a37b44';
    preset1['menu_first_color']='#c79c60';
    preset1['header_top_bg_color']='#c79c60';
    preset1['form_text_color']='#c67f1b';
    var preset2 = new Array();
    preset2['primary_color']='#353535';
    preset2['secondary_color']='#353535';

    $('#preset_color_scheme').change(function() {
        colorscheme = $(this).val();
        if (colorscheme == 'preset1') { colorscheme = preset1; }
        if (colorscheme == 'preset2') { colorscheme = preset2; }

        for (id in colorscheme) {
            of_update_color(id,colorscheme[id]);
        }
    });
    //This does the heavy lifting of updating all the colorpickers and text
    function of_update_color(id,hex) {
        $('#section-' + id).find('.of-color').val(hex).change();
    }
    onLoadFontBody($('#body_font_options').val());
    onLoadFontMainMenu($('#main_menu_font_options').val());
    onLoadFontHeader($('#header_font_options').val());
    onLoadFontOther($('#other_font_options_0').val());
    onLoadFontOther1($('#other_font_options_1').val());
    onLoadFontOther2($('#other_font_options_2').val());
    onLoadFontOther3($('#other_font_options_3').val());
    onLoadFontOther4($('#other_font_options_4').val());
    onLoadFontOther5($('#other_font_options_5').val());
    onLoadFontOther6($('#other_font_options_6').val());
    onLoadFontOther7($('#other_font_options_7').val());
    onLoadFontOther8($('#other_font_options_8').val());
    onLoadFontOther9($('#other_font_options_9').val());
    onLoadFontOther10($('#other_font_options_10').val());
    setCollumnHeaderWitget($('#header_top_widgets_columns').val());
    setCollumnFooterWitget($('#footer_top_widgets_columns').val());
    setCollumnFooterBottomWitget($('#footer_bottom_widgets_columns').val());
    // changer page title style
    page_title_bar_style();
    $('#page_title_bar_style').change(function() {
        page_title_bar_style();
    });

    $('#body_font_options').change(function() {
        "use strict";
        onLoadFontBody($(this).val());
    });
    $('#main_menu_font_options').change(function() {
        "use strict";
        onLoadFontMainMenu($(this).val());
    });
    $('#header_font_options').change(function() {
        "use strict";
        onLoadFontHeader($(this).val());
    });
    $('#other_font_options_0').change(function() {
        "use strict";
        onLoadFontOther($(this).val());
    });
    $('#other_font_options_1').change(function() {
        "use strict";
        onLoadFontOther1($(this).val());
    });
    $('#other_font_options_2').change(function() {
        "use strict";
        onLoadFontOther2($(this).val());
    });
    $('#other_font_options_3').change(function() {
        "use strict";
        onLoadFontOther3($(this).val());
    });
    $('#other_font_options_4').change(function() {
        "use strict";
        onLoadFontOther4($(this).val());
    });
    $('#other_font_options_5').change(function() {
        "use strict";
        onLoadFontOther5($(this).val());
    });
    $('#other_font_options_6').change(function() {
        "use strict";
        onLoadFontOther6($(this).val());
    });
    $('#other_font_options_7').change(function() {
        "use strict";
        onLoadFontOther7($(this).val());
    });
    $('#other_font_options_8').change(function() {
        "use strict";
        onLoadFontOther8($(this).val());
    });
    $('#other_font_options_9').change(function() {
        "use strict";
        onLoadFontOther9($(this).val());
    });
    $('#other_font_options_10').change(function() {
        "use strict";
        onLoadFontOther10($(this).val());
    });
    $('#header_top_widgets_columns').change(function() {
        setCollumnHeaderWitget($(this).val());
    });
    $('#footer_top_widgets_columns').change(function() {
        setCollumnFooterWitget($(this).val());
    });
    $('#footer_bottom_widgets_columns').change(function() {
        setCollumnFooterBottomWitget($(this).val());
    });

    function page_title_bar_style() {
        switch ($("#page_title_bar_style").val()) {
        case 'corporate':
            $("#section-page_title_image").css("display","block");
            $("#section-page_title_image_height").css("display","block");
            break;
        default:
            $("#section-page_title_image").css("display","none");
            $("#section-page_title_image_height").css("display","none");
            break;
        }
    }

    function onLoadFontBody(body_font_type){
        switch(body_font_type){
        case 'Google Font':
            $('#section-google_body_font_family').css("display","block");
            $('#section-standard_body_font_family').css("display","none");
            $('#section-custom_body_font_family').css("display","none");
            $('#section-body_font_family_selector').css("display","block");
            break;
        case 'Standard Font':
            $('#section-google_body_font_family').css("display","none");
            $('#section-standard_body_font_family').css("display","block");
            $('#section-custom_body_font_family').css("display","none");
            $('#section-body_font_family_selector').css("display","block");
            break;
        case 'Custom Font':
            $('#section-google_body_font_family').css("display","none");
            $('#section-standard_body_font_family').css("display","none");
            $('#section-custom_body_font_family').css("display","block");
            $('#section-body_font_family_selector').css("display","block");
            break;
        default:
            $('#section-google_body_font_family').css("display","none");
            $('#section-standard_body_font_family').css("display","none");
            $('#section-custom_body_font_family').css("display","none");
            $('#section-body_font_family_selector').css("display","none");
        }
    }
    function onLoadFontMainMenu(main_menu_font_type){
        switch(main_menu_font_type){
        case 'Google Font':
            $('#section-google_main_menu_font_family').css("display","block");
            $('#section-standard_main_menu_font_family').css("display","none");
            $('#section-custom_main_menu_font_family').css("display","none");
            $('#section-main_menu_font_family_selector').css("display","block");
            break;
        case 'Standard Font':
            $('#section-google_main_menu_font_family').css("display","none");
            $('#section-standard_main_menu_font_family').css("display","block");
            $('#section-custom_main_menu_font_family').css("display","none");
            $('#section-main_menu_font_family_selector').css("display","block");
            break;
        case 'Custom Font':
            $('#section-google_main_menu_font_family').css("display","none");
            $('#section-standard_main_menu_font_family').css("display","none");
            $('#section-custom_main_menu_font_family').css("display","block");
            $('#section-main_menu_font_family_selector').css("display","block");
            break;
        default:
            $('#section-google_main_menu_font_family').css("display","none");
            $('#section-standard_main_menu_font_family').css("display","none");
            $('#section-custom_main_menu_font_family').css("display","none");
            $('#section-main_menu_font_family_selector').css("display","none");
        }
    }
    function onLoadFontHeader(body_font_type){
        switch(body_font_type){
        case 'Google Font':
            $('#section-google_header_font_family').css("display","block");
            $('#section-standard_header_font_family').css("display","none");
            $('#section-custom_header_font_family').css("display","none");
            $('#section-header_font_family_selector').css("display","block");
            break;
        case 'Standard Font':
            $('#section-google_header_font_family').css("display","none");
            $('#section-standard_header_font_family').css("display","block");
            $('#section-custom_header_font_family').css("display","none");
            $('#section-header_font_family_selector').css("display","block");
            break;
        case 'Custom Font':
            $('#section-google_header_font_family').css("display","none");
            $('#section-standard_header_font_family').css("display","none");
            $('#section-custom_header_font_family').css("display","block");
            $('#section-header_font_family_selector').css("display","block");
            break;
        default:
            $('#section-google_header_font_family').css("display","none");
            $('#section-standard_header_font_family').css("display","none");
            $('#section-custom_header_font_family').css("display","none");
            $('#section-header_font_family_selector').css("display","none");
        }
    }
    function onLoadFontOther(body_font_type){
        switch(body_font_type){
        case 'Google Font':
            $('#section-google_other_font_family_0').css("display","block");
            $('#section-standard_other_font_family_0').css("display","none");
            $('#section-custom_other_font_family_0').css("display","none");
            $('#section-other_font_family_selector_0').css("display","block");
            break;
        case 'Standard Font':
            $('#section-google_other_font_family_0').css("display","none");
            $('#section-standard_other_font_family_0').css("display","block");
            $('#section-custom_other_font_family_0').css("display","none");
            $('#section-other_font_family_selector_0').css("display","block");
            break;
        case 'Custom Font':
            $('#section-google_other_font_family_0').css("display","none");
            $('#section-standard_other_font_family_0').css("display","none");
            $('#section-custom_other_font_family_0').css("display","block");
            $('#section-other_font_family_selector_0').css("display","block");
            break;
        default:
            $('#section-google_other_font_family_0').css("display","none");
            $('#section-standard_other_font_family_0').css("display","none");
            $('#section-custom_other_font_family_0').css("display","none");
            $('#section-other_font_family_selector_0').css("display","none");
        }
    }
    function onLoadFontOther1(body_font_type){
        switch(body_font_type){
        case 'Google Font':
            $('#section-google_other_font_family_1').css("display","block");
            $('#section-standard_other_font_family_1').css("display","none");
            $('#section-custom_other_font_family_1').css("display","none");
            $('#section-other_font_family_selector_1').css("display","block");
            break;
        case 'Standard Font':
            $('#section-google_other_font_family_1').css("display","none");
            $('#section-standard_other_font_family_1').css("display","block");
            $('#section-custom_other_font_family_1').css("display","none");
            $('#section-other_font_family_selector_1').css("display","block");
            break;
        case 'Custom Font':
            $('#section-google_other_font_family_1').css("display","none");
            $('#section-standard_other_font_family_1').css("display","none");
            $('#section-custom_other_font_family_1').css("display","block");
            $('#section-other_font_family_selector_1').css("display","block");
            break;
        default:
            $('#section-google_other_font_family_1').css("display","none");
            $('#section-standard_other_font_family_1').css("display","none");
            $('#section-custom_other_font_family_1').css("display","none");
            $('#section-other_font_family_selector_1').css("display","none");
        }
    }
    function onLoadFontOther2(body_font_type){
        switch(body_font_type){
        case 'Google Font':
            $('#section-google_other_font_family_2').css("display","block");
            $('#section-standard_other_font_family_2').css("display","none");
            $('#section-custom_other_font_family_2').css("display","none");
            $('#section-other_font_family_selector_2').css("display","block");
            break;
        case 'Standard Font':
            $('#section-google_other_font_family_2').css("display","none");
            $('#section-standard_other_font_family_2').css("display","block");
            $('#section-custom_other_font_family_2').css("display","none");
            $('#section-other_font_family_selector_2').css("display","block");
            break;
        case 'Custom Font':
            $('#section-google_other_font_family_2').css("display","none");
            $('#section-standard_other_font_family_2').css("display","none");
            $('#section-custom_other_font_family_2').css("display","block");
            $('#section-other_font_family_selector_2').css("display","block");
            break;
        default:
            $('#section-google_other_font_family_2').css("display","none");
            $('#section-standard_other_font_family_2').css("display","none");
            $('#section-custom_other_font_family_2').css("display","none");
            $('#section-other_font_family_selector_2').css("display","none");
        }
    }
    function onLoadFontOther3(body_font_type){
        switch(body_font_type){
        case 'Google Font':
            $('#section-google_other_font_family_3').css("display","block");
            $('#section-standard_other_font_family_3').css("display","none");
            $('#section-custom_other_font_family_3').css("display","none");
            $('#section-other_font_family_selector_3').css("display","block");
            break;
        case 'Standard Font':
            $('#section-google_other_font_family_3').css("display","none");
            $('#section-standard_other_font_family_3').css("display","block");
            $('#section-custom_other_font_family_3').css("display","none");
            $('#section-other_font_family_selector_3').css("display","block");
            break;
        case 'Custom Font':
            $('#section-google_other_font_family_3').css("display","none");
            $('#section-standard_other_font_family_3').css("display","none");
            $('#section-custom_other_font_family_3').css("display","block");
            $('#section-other_font_family_selector_3').css("display","block");
            break;
        default:
            $('#section-google_other_font_family_3').css("display","none");
            $('#section-standard_other_font_family_3').css("display","none");
            $('#section-custom_other_font_family_3').css("display","none");
            $('#section-other_font_family_selector_3').css("display","none");
        }
    }
    function onLoadFontOther4(body_font_type){
        switch(body_font_type){
        case 'Google Font':
            $('#section-google_other_font_family_4').css("display","block");
            $('#section-standard_other_font_family_4').css("display","none");
            $('#section-custom_other_font_family_4').css("display","none");
            $('#section-other_font_family_selector_4').css("display","block");
            break;
        case 'Standard Font':
            $('#section-google_other_font_family_4').css("display","none");
            $('#section-standard_other_font_family_4').css("display","block");
            $('#section-custom_other_font_family_4').css("display","none");
            $('#section-other_font_family_selector_4').css("display","block");
            break;
        case 'Custom Font':
            $('#section-google_other_font_family_4').css("display","none");
            $('#section-standard_other_font_family_4').css("display","none");
            $('#section-custom_other_font_family_4').css("display","block");
            $('#section-other_font_family_selector_4').css("display","block");
            break;
        default:
            $('#section-google_other_font_family_4').css("display","none");
            $('#section-standard_other_font_family_4').css("display","none");
            $('#section-custom_other_font_family_4').css("display","none");
            $('#section-other_font_family_selector_4').css("display","none");
        }
    }
    function onLoadFontOther5(body_font_type){
        switch(body_font_type){
        case 'Google Font':
            $('#section-google_other_font_family_5').css("display","block");
            $('#section-standard_other_font_family_5').css("display","none");
            $('#section-custom_other_font_family_5').css("display","none");
            $('#section-other_font_family_selector_5').css("display","block");
            break;
        case 'Standard Font':
            $('#section-google_other_font_family_5').css("display","none");
            $('#section-standard_other_font_family_5').css("display","block");
            $('#section-custom_other_font_family_5').css("display","none");
            $('#section-other_font_family_selector_5').css("display","block");
            break;
        case 'Custom Font':
            $('#section-google_other_font_family_5').css("display","none");
            $('#section-standard_other_font_family_5').css("display","none");
            $('#section-custom_other_font_family_5').css("display","block");
            $('#section-other_font_family_selector_5').css("display","block");
            break;
        default:
            $('#section-google_other_font_family_5').css("display","none");
            $('#section-standard_other_font_family_5').css("display","none");
            $('#section-custom_other_font_family_5').css("display","none");
            $('#section-other_font_family_selector_5').css("display","none");
        }
    }
    function onLoadFontOther6(body_font_type){
        switch(body_font_type){
        case 'Google Font':
            $('#section-google_other_font_family_6').css("display","block");
            $('#section-standard_other_font_family_6').css("display","none");
            $('#section-custom_other_font_family_6').css("display","none");
            $('#section-other_font_family_selector_6').css("display","block");
            break;
        case 'Standard Font':
            $('#section-google_other_font_family_6').css("display","none");
            $('#section-standard_other_font_family_6').css("display","block");
            $('#section-custom_other_font_family_6').css("display","none");
            $('#section-other_font_family_selector_6').css("display","block");
            break;
        case 'Custom Font':
            $('#section-google_other_font_family_6').css("display","none");
            $('#section-standard_other_font_family_6').css("display","none");
            $('#section-custom_other_font_family_6').css("display","block");
            $('#section-other_font_family_selector_6').css("display","block");
            break;
        default:
            $('#section-google_other_font_family_6').css("display","none");
            $('#section-standard_other_font_family_6').css("display","none");
            $('#section-custom_other_font_family_6').css("display","none");
            $('#section-other_font_family_selector_6').css("display","none");
        }
    }
    function onLoadFontOther7(body_font_type){
        switch(body_font_type){
        case 'Google Font':
            $('#section-google_other_font_family_7').css("display","block");
            $('#section-standard_other_font_family_7').css("display","none");
            $('#section-custom_other_font_family_7').css("display","none");
            $('#section-other_font_family_selector_7').css("display","block");
            break;
        case 'Standard Font':
            $('#section-google_other_font_family_7').css("display","none");
            $('#section-standard_other_font_family_7').css("display","block");
            $('#section-custom_other_font_family_7').css("display","none");
            $('#section-other_font_family_selector_7').css("display","block");
            break;
        case 'Custom Font':
            $('#section-google_other_font_family_7').css("display","none");
            $('#section-standard_other_font_family_7').css("display","none");
            $('#section-custom_other_font_family_7').css("display","block");
            $('#section-other_font_family_selector_7').css("display","block");
            break;
        default:
            $('#section-google_other_font_family_7').css("display","none");
            $('#section-standard_other_font_family_7').css("display","none");
            $('#section-custom_other_font_family_7').css("display","none");
            $('#section-other_font_family_selector_7').css("display","none");
        }
    }
    function onLoadFontOther8(body_font_type){
        switch(body_font_type){
        case 'Google Font':
            $('#section-google_other_font_family_8').css("display","block");
            $('#section-standard_other_font_family_8').css("display","none");
            $('#section-custom_other_font_family_8').css("display","none");
            $('#section-other_font_family_selector_8').css("display","block");
            break;
        case 'Standard Font':
            $('#section-google_other_font_family_8').css("display","none");
            $('#section-standard_other_font_family_8').css("display","block");
            $('#section-custom_other_font_family_8').css("display","none");
            $('#section-other_font_family_selector_8').css("display","block");
            break;
        case 'Custom Font':
            $('#section-google_other_font_family_8').css("display","none");
            $('#section-standard_other_font_family_8').css("display","none");
            $('#section-custom_other_font_family_8').css("display","block");
            $('#section-other_font_family_selector_8').css("display","block");
            break;
        default:
            $('#section-google_other_font_family_8').css("display","none");
            $('#section-standard_other_font_family_8').css("display","none");
            $('#section-custom_other_font_family_8').css("display","none");
            $('#section-other_font_family_selector_8').css("display","none");
        }
    }
    function onLoadFontOther9(body_font_type){
        switch(body_font_type){
        case 'Google Font':
            $('#section-google_other_font_family_5').css("display","block");
            $('#section-standard_other_font_family_9').css("display","none");
            $('#section-custom_other_font_family_9').css("display","none");
            $('#section-other_font_family_selector_9').css("display","block");
            break;
        case 'Standard Font':
            $('#section-google_other_font_family_9').css("display","none");
            $('#section-standard_other_font_family_9').css("display","block");
            $('#section-custom_other_font_family_9').css("display","none");
            $('#section-other_font_family_selector_9').css("display","block");
            break;
        case 'Custom Font':
            $('#section-google_other_font_family_9').css("display","none");
            $('#section-standard_other_font_family_9').css("display","none");
            $('#section-custom_other_font_family_9').css("display","block");
            $('#section-other_font_family_selector_9').css("display","block");
            break;
        default:
            $('#section-google_other_font_family_9').css("display","none");
            $('#section-standard_other_font_family_9').css("display","none");
            $('#section-custom_other_font_family_9').css("display","none");
            $('#section-other_font_family_selector_9').css("display","none");
        }
    }
    function onLoadFontOther10(body_font_type){
        switch(body_font_type){
        case 'Google Font':
            $('#section-google_other_font_family_10').css("display","block");
            $('#section-standard_other_font_family_10').css("display","none");
            $('#section-custom_other_font_family_10').css("display","none");
            $('#section-other_font_family_selector_10').css("display","block");
            break;
        case 'Standard Font':
            $('#section-google_other_font_family_10').css("display","none");
            $('#section-standard_other_font_family_10').css("display","block");
            $('#section-custom_other_font_family_10').css("display","none");
            $('#section-other_font_family_selector_10').css("display","block");
            break;
        case 'Custom Font':
            $('#section-google_other_font_family_10').css("display","none");
            $('#section-standard_other_font_family_10').css("display","none");
            $('#section-custom_other_font_family_10').css("display","block");
            $('#section-other_font_family_selector_10').css("display","block");
            break;
        default:
            $('#section-google_other_font_family_10').css("display","none");
            $('#section-standard_other_font_family_10').css("display","none");
            $('#section-custom_other_font_family_10').css("display","none");
            $('#section-other_font_family_selector_10').css("display","none");
        }
    }
    function setCollumnHeaderWitget(collumn) {
        switch (collumn) {
        case '1':
            $('#section-header_top_widgets_1').css("display","block");
            $('#section-header_top_widgets_2').css("display","none");
            $('#section-header_top_widgets_3').css("display","none");
            break;
        case '2':
            $('#section-header_top_widgets_1').css("display","block");
            $('#section-header_top_widgets_2').css("display","block");
            $('#section-header_top_widgets_3').css("display","none");
            break;
        case '3':
        	$('#section-header_top_widgets_1').css("display","block");
            $('#section-header_top_widgets_2').css("display","block");
            $('#section-header_top_widgets_3').css("display","block");
        	break;
        }
    }
    function setCollumnFooterWitget(collumn) {
        switch (collumn) {
        case '1':
            $('#section-footer_top_widgets_1').css("display","block");
            $('#section-footer_top_widgets_2').css("display","none");
            $('#section-footer_top_widgets_3').css("display","none");
            $('#section-footer_top_widgets_4').css("display","none");
            break;
        case '2':
            $('#section-footer_top_widgets_1').css("display","block");
            $('#section-footer_top_widgets_2').css("display","block");
            $('#section-footer_top_widgets_3').css("display","none");
            $('#section-footer_top_widgets_4').css("display","none");
            break;
        case '3':
            $('#section-footer_top_widgets_1').css("display","block");
            $('#section-footer_top_widgets_2').css("display","block");
            $('#section-footer_top_widgets_3').css("display","block");
            $('#section-footer_top_widgets_4').css("display","none");
            break;
        case '4':
            $('#section-footer_top_widgets_1').css("display","block");
            $('#section-footer_top_widgets_2').css("display","block");
            $('#section-footer_top_widgets_3').css("display","block");
            $('#section-footer_top_widgets_4').css("display","block");
            break;
        }
    }
    function setCollumnFooterBottomWitget(collumn) {
        switch (collumn) {
        case '1':
            $('#section-footer_bottom_widgets_1').css("display","block");
            $('#section-footer_bottom_widgets_2').css("display","none");
            break;
        case '2':
            $('#section-footer_bottom_widgets_1').css("display","block");
            $('#section-footer_bottom_widgets_2').css("display","block");
            break;
        }
    }
    function runNow(select_data,p,theme){
        jQuery.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                'action': 'sample',
                'select_data':  select_data,
                'theme' : theme
            },
            success: function(data, textStatus, XMLHttpRequest){
                jQuery('.cs_process_width').css({
                    'width':p+'%',
                    '-webkit-transition':'width 1s',
                    'transition':'width 1s'
                });
                jQuery('#msg .status').text(' Loading '+p+'%');
                if(isNaN(select_data)){
                    jQuery('#msg').parent().css('width','100%');
                    jQuery('#msg').append(data);
                }
                if(select_data=='grid'){
                    p+=5;
                    runNow(15,p,theme);
                }
                if(select_data>1 && select_data<16){
                    runNow(select_data-1,p+5,theme);
                }
                if(select_data==1){
                    runNow(16,100,theme);
                }
                if(select_data==16){
                    jQuery('#msg').parent().css('width','100%');
                    jQuery('#msg .status').html('');
                    jQuery('#msg').append(data);
                }
            }
        });
    }
    jQuery('#sample').click(function(){
        var r = confirm("Are you want import the demo data?");
        if (r == true) {
            jQuery('.cs_process').show();
            var theme = jQuery("#theme").val();
            jQuery(this).attr('disabled','true');
            jQuery('#msg .status').html('&nbsp;Loading&nbsp;');
            var p = 0;
            var arr = ["widget","slider","grid"];
            arr.forEach(function(entry){
                p+=5;
                runNow(entry,p,theme);
            });
        }
    });

});


