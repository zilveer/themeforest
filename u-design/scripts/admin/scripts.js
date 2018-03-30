
jQuery.noConflict();

// fixes the firefox radio button bug on refresh (http://www.ryancramer.com/journal/entries/radio_buttons_firefox/)
//jQuery(document).ready(function($) {
//    if($.browser.mozilla)
//         $("#udesign-metaboxes-general form").attr("autocomplete", "off");
//});

jQuery(document).ready(function($) {
        
        // Logo Image Upload
        $('#upload_logo_button').click(function(event) {
            chooseImageWithMediaUploader(event, '#custom_logo_img');
        });
        // "Stay-On-Top" Main Menu Logo Image Upload
        $('#upload_fixed_menu_logo_button').click(function(event) {
            chooseImageWithMediaUploader(event, '#fixed_menu_logo');
        });
        // Responsive Logo Image Upload
        $('#upload_responsive_logo_button').click(function(event) {
            chooseImageWithMediaUploader(event, '#responsive_logo_img');
        });
        // Top Background Image
        $('#upload_top_bg_img_button').click(function(event) {
            chooseImageWithMediaUploader(event, '#top_bg_img');
        });
        // Header Background Image
        $('#upload_header_bg_img_button').click(function(event) {
            chooseImageWithMediaUploader(event, '#header_bg_img');
        });
        // Main Content Area Background Image
        $('#upload_home_page_before_content_bg_img_button').click(function(event) {
            chooseImageWithMediaUploader(event, '#home_page_before_content_bg_img');
        });
        // Header Background Image
        $('#upload_page_title_bg_img_button').click(function(event) {
            chooseImageWithMediaUploader(event, '#page_title_bg_img');
        });
        // Main Content Area Background Image
        $('#upload_main_bg_img_button').click(function(event) {
            chooseImageWithMediaUploader(event, '#main_content_bg_img');
        });
        // Main Content Area Background Image
        $('#upload_bottom_bg_img_button').click(function(event) {
            chooseImageWithMediaUploader(event, '#bottom_bg_img');
        });
        // Main Content Area Background Image
        $('#upload_footer_bg_img_button').click(function(event) {
            chooseImageWithMediaUploader(event, '#footer_bg_img');
        });
        // One Continuous Background Image
        $('#upload_one_continuous_bg_img_button').click(function(event) {
            chooseImageWithMediaUploader(event, '#one_continuous_bg_img');
        });
        
        var udesign_custom_uploader;
        
	function chooseImageWithMediaUploader(event, inputTxtFieldID) {
            
            event.preventDefault();
         
            //Extend the wp.media object
            udesign_custom_uploader = wp.media.frames.file_frame = wp.media({
                title: 'Choose Image',
                button: {
                    text: 'Choose Image'
                },
                multiple: false // Set to true to allow multiple files to be selected
            });
            //When a file is selected, grab the URL and set it as the text field's value
            udesign_custom_uploader.on('select', function() {
                attachment = udesign_custom_uploader.state().get('selection').first().toJSON();
                // set the image URL to the input text field
                $(inputTxtFieldID).val(attachment.url);
                return false;
            });
            //Open the uploader dialog
            udesign_custom_uploader.open();
            
	}
        
});

// color picker script
jQuery(document).ready(function($) {
    if ( $('#bodyTextColor').length ) { // if element found
	addColPicker('#body_text_color', '#bodyTextColor', rgb2hex( $('#bodyTextColor div').css('background-color') ));
    }
    if ( $('#mainLinkColor').length ) { // if element found
	addColPicker('#main_link_color', '#mainLinkColor', rgb2hex( $('#mainLinkColor div').css('background-color') ));
    }
    if ( $('#mainLinkColorHover').length ) { // if element found
	addColPicker('#main_link_color_hover', '#mainLinkColorHover', rgb2hex( $('#mainLinkColorHover div').css('background-color') ));
    }
    if ( $('#mainHeadingsColor').length ) { // if element found
	addColPicker('#main_headings_color', '#mainHeadingsColor', rgb2hex( $('#mainHeadingsColor div').css('background-color') ));
    }
    if ( $('#topBGcolorSelector').length ) { // if element found
	addColPicker('#top_bg_color', '#topBGcolorSelector', rgb2hex( $('#topBGcolorSelector div').css('background-color') ));
    }
    if ( $('#topTextcolorSelector').length ) { // if element found
	addColPicker('#top_text_color', '#topTextcolorSelector', rgb2hex( $('#topTextcolorSelector div').css('background-color') ));
    }
    if ( $('#topNavBackgroundColor').length ) { // if element found
	addColPicker('#top_nav_background_color', '#topNavBackgroundColor', rgb2hex( $('#topNavBackgroundColor div').css('background-color') ));
    }
    if ( $('#topNavLinkColor').length ) { // if element found
	addColPicker('#top_nav_link_color', '#topNavLinkColor', rgb2hex( $('#topNavLinkColor div').css('background-color') ));
    }
    if ( $('#topNavActiveLinkColor').length ) { // if element found
	addColPicker('#top_nav_active_link_color', '#topNavActiveLinkColor', rgb2hex( $('#topNavActiveLinkColor div').css('background-color') ));
    }
    if ( $('#topNavHoverLinkColor').length ) { // if element found
	addColPicker('#top_nav_hover_link_color', '#topNavHoverLinkColor', rgb2hex( $('#topNavHoverLinkColor div').css('background-color') ));
    }
    if ( $('#dropdownNavLinkColor').length ) { // if element found
	addColPicker('#dropdown_nav_link_color', '#dropdownNavLinkColor', rgb2hex( $('#dropdownNavLinkColor div').css('background-color') ));
    }
    if ( $('#dropdownNavHoverLinkColor').length ) { // if element found
	addColPicker('#dropdown_nav_hover_link_color', '#dropdownNavHoverLinkColor', rgb2hex( $('#dropdownNavHoverLinkColor div').css('background-color') ));
    }
    if ( $('#dropdownNavBackgroundColor').length ) { // if element found
	addColPicker('#dropdown_nav_background_color', '#dropdownNavBackgroundColor', rgb2hex( $('#dropdownNavBackgroundColor div').css('background-color') ));
    }
    if ( $('#secMenuBGColorSelector').length ) { // if element found
	addColPicker('#sec_menu_bg_color', '#secMenuBGColorSelector', rgb2hex( $('#secMenuBGColorSelector div').css('background-color') ));
    }
    if ( $('#secMenuTextColorSelector').length ) { // if element found
	addColPicker('#sec_menu_text_color', '#secMenuTextColorSelector', rgb2hex( $('#secMenuTextColorSelector div').css('background-color') ));
    }
    if ( $('#secMenuLinkColorSelector').length ) { // if element found
	addColPicker('#sec_menu_link_color', '#secMenuLinkColorSelector', rgb2hex( $('#secMenuLinkColorSelector div').css('background-color') ));
    }
    if ( $('#secMenuLinkHoverColorSelector').length ) { // if element found
	addColPicker('#sec_menu_link_hover_color', '#secMenuLinkHoverColorSelector', rgb2hex( $('#secMenuLinkHoverColorSelector div').css('background-color') ));
    }
    if ( $('#pageTitleColor').length ) { // if element found
	addColPicker('#page_title_color', '#pageTitleColor', rgb2hex( $('#pageTitleColor div').css('background-color') ));
    }
    if ( $('#pageTitleBGcolorSelector').length ) { // if element found
	addColPicker('#page_title_bg_color', '#pageTitleBGcolorSelector', rgb2hex( $('#pageTitleBGcolorSelector div').css('background-color') ));
    }
    if ( $('#headerBGcolorSelector').length ) { // if element found
	addColPicker('#header_bg_color', '#headerBGcolorSelector', rgb2hex( $('#headerBGcolorSelector div').css('background-color') ));
    }
    if ( $('#mainContentBG').length ) { // if element found
	addColPicker('#main_content_bg', '#mainContentBG', rgb2hex( $('#mainContentBG div').css('background-color') ));
    }
    if ( $('#widgetTitleColor').length ) { // if element found
	addColPicker('#widget_title_color', '#widgetTitleColor', rgb2hex( $('#widgetTitleColor div').css('background-color') ));
    }
    if ( $('#widgetTextColor').length ) { // if element found
	addColPicker('#widget_text_color', '#widgetTextColor', rgb2hex( $('#widgetTextColor div').css('background-color') ));
    }
    if ( $('#widgetBGColor').length ) { // if element found
	addColPicker('#widget_bg_color', '#widgetBGColor', rgb2hex( $('#widgetBGColor div').css('background-color') ));
    }
    if ( $('#bottomBGColor').length ) { // if element found
	addColPicker('#bottom_bg_color', '#bottomBGColor', rgb2hex( $('#bottomBGColor div').css('background-color') ));
    }
    if ( $('#bottomTitleColor').length ) { // if element found
	addColPicker('#bottom_title_color', '#bottomTitleColor', rgb2hex( $('#bottomTitleColor div').css('background-color') ));
    }
    if ( $('#bottomTextColor').length ) { // if element found
	addColPicker('#bottom_text_color', '#bottomTextColor', rgb2hex( $('#bottomTextColor div').css('background-color') ));
    }
    if ( $('#bottomLinkColor').length ) { // if element found
	addColPicker('#bottom_link_color', '#bottomLinkColor', rgb2hex( $('#bottomLinkColor div').css('background-color') ));
    }
    if ( $('#bottomHoverLinkColor').length ) { // if element found
	addColPicker('#bottom_hover_link_color', '#bottomHoverLinkColor', rgb2hex( $('#bottomHoverLinkColor div').css('background-color') ));
    }
    if ( $('#footerBGColor').length ) { // if element found
	addColPicker('#footer_bg_color', '#footerBGColor', rgb2hex( $('#footerBGColor div').css('background-color') ));
    }
    if ( $('#footerTextColor').length ) { // if element found
	addColPicker('#footer_text_color', '#footerTextColor', rgb2hex( $('#footerTextColor div').css('background-color') ));
    }
    if ( $('#footerLinkColor').length ) { // if element found
	addColPicker('#footer_link_color', '#footerLinkColor', rgb2hex( $('#footerLinkColor div').css('background-color') ));
    }
    if ( $('#footerHoverLinkColor').length ) { // if element found
	addColPicker('#footer_hover_link_color', '#footerHoverLinkColor', rgb2hex( $('#footerHoverLinkColor div').css('background-color') ));
    }
    if ( $('#colorSelector1').length ) { // if element found
	addColPicker('#pm_text_background', '#colorSelector1', rgb2hex( $('#colorSelector1 div').css('background-color') ));
    }
    if ( $('#colorSelector2').length ) { // if element found
	addColPicker('#pm_inner_color', '#colorSelector2', rgb2hex( $('#colorSelector2 div').css('background-color') ));
    }
    if ( $('#pm2LoaderColor').length ) { // if element found
	addColPicker('#pm2_loader_color', '#pm2LoaderColor', rgb2hex( $('#pm2LoaderColor div').css('background-color') ));
    }
    if ( $('#pm2InnerSideColor').length ) { // if element found
	addColPicker('#pm2_inner_side_color', '#pm2InnerSideColor', rgb2hex( $('#pm2InnerSideColor div').css('background-color') ));
    }
    if ( $('#pm2MenuColor1').length ) { // if element found
	addColPicker('#pm2_menu_color_1', '#pm2MenuColor1', rgb2hex( $('#pm2MenuColor1 div').css('background-color') ));
    }
    if ( $('#pm2MenuColor2').length ) { // if element found
	addColPicker('#pm2_menu_color_2', '#pm2MenuColor2', rgb2hex( $('#pm2MenuColor2 div').css('background-color') ));
    }
    if ( $('#pm2MenuColor3').length ) { // if element found
	addColPicker('#pm2_menu_color_3', '#pm2MenuColor3', rgb2hex( $('#pm2MenuColor3 div').css('background-color') ));
    }
    if ( $('#pm2ControlColor1').length ) { // if element found
	addColPicker('#pm2_control_color_1', '#pm2ControlColor1', rgb2hex( $('#pm2ControlColor1 div').css('background-color') ));
    }
    if ( $('#pm2ControlColor2').length ) { // if element found
	addColPicker('#pm2_control_color_2', '#pm2ControlColor2', rgb2hex( $('#pm2ControlColor2 div').css('background-color') ));
    }
    if ( $('#pm2TooltipColor').length ) { // if element found
	addColPicker('#pm2_tooltip_color', '#pm2TooltipColor', rgb2hex( $('#pm2TooltipColor div').css('background-color') ));
    }
    if ( $('#pm2TooltipTextColor').length ) { // if element found
	addColPicker('#pm2_tooltip_text_color', '#pm2TooltipTextColor', rgb2hex( $('#pm2TooltipTextColor div').css('background-color') ));
    }
    if ( $('#pm2InfoBackground').length ) { // if element found
	addColPicker('#pm2_info_background', '#pm2InfoBackground', rgb2hex( $('#pm2InfoBackground div').css('background-color') ));
    }
    if ( $('#c2-colorSelector1').length ) { // if element found
	addColPicker('#c2_text_color', '#c2-colorSelector1', rgb2hex( $('#c2-colorSelector1 div').css('background-color') ));
    }
    if ( $('#c3-colorSelector1').length ) { // if element found
	addColPicker('#c3_text_color', '#c3-colorSelector1', rgb2hex( $('#c3-colorSelector1 div').css('background-color') ));
    }
    function addColPicker(inputField, colorSelector, defaultColor) {
	$(colorSelector).ColorPicker({
		color: '#'+defaultColor,
		onShow: function (colpkr) {
			$(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) {
			$(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			$(colorSelector+' div').css('backgroundColor', '#' + hex);
			$('input'+inputField).attr("value", hex);
		},
		onSubmit: function(hsb, hex, rgb, el) {
			$(el).val(hex);
			$(el).ColorPickerHide();
		}
	});
        // Update the ColorPicker from the text field input value when changed
        $(inputField).on('input propertychange', function() {
            $(colorSelector+' div').css('backgroundColor', '#' + this.value);
            $(colorSelector).ColorPickerSetColor(this.value);
        });
    }
    // convert rgb to hex color string
    function rgb2hex(rgb) {
	if (  rgb.search("rgb") == -1 ) {
	    return rgb;
	} else {
	    rgb = rgb.match(/^rgba?\((\d+),\s*(\d+),\s*(\d+)(?:,\s*(\d+))?\)$/);
	    function hex(x) {
		return ("0" + parseInt(x).toString(16)).slice(-2);
	    }
	    return hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
	}
    }
});


jQuery(document).ready(function($) {
    
    // Replace default tooltips in the "U-Design Options form" with the jQuery UI Tooltip for links only
    $( "#udesign_options_submit_form a, a.info-help" ).tooltip();
    

    // Slide bar for the "Global Theme Width" option
    var globalThemeWidthTxtField = $( "#global_theme_width" );
    var globalThemeWidthSlideBar = $( "#global_theme_width_slide_bar" );
    globalThemeWidthSlideBar.slider({
        range: "max",
        min: 960,
        max: 1600,
        step: 10,
        value: [ globalThemeWidthTxtField.val() ],
        slide: function( event, ui ) {
            globalThemeWidthTxtField.val( ui.value );
            if ( ui.value == 960 ) { // When slide bar value has chagned to 960 disable the 'Global Sidebar Width' option.
                globalSidebarWidthSlideBar.slider( "disable" );
                globalSidebarWidthTxtField.prop( "disabled", true );
            } else { //  Enable it otherwise.
                globalSidebarWidthSlideBar.slider( "enable" );
                globalSidebarWidthTxtField.prop( "disabled", false );
            }
        },
        start: function( event, ui ) {
            if ( globalThemeWidthTxtField.hasClass('udesign-error') ) {
                globalThemeWidthTxtField.removeClass('udesign-error').addClass('udesign-valid').removeAttr('title').tooltip("disable");
            }
        }
    });
    // When 'Global Theme Width' text field input has changed
    globalThemeWidthTxtField.on('input propertychange', function() {
        // Update the Global Theme Width slide-bar
        globalThemeWidthSlideBar.slider( 'value', $( this ).val() );
        if ( $( this ).val() == 960 ) { // When input value has chagned to 960 disable the 'Global Sidebar Width' option.
            globalSidebarWidthSlideBar.slider( "disable" );
            globalSidebarWidthTxtField.prop( "disabled", true );
        } else { // Enable it otherwise.
            globalSidebarWidthSlideBar.slider( "enable" );
            globalSidebarWidthTxtField.prop( "disabled", false );
        }
    });
    
    // Slide bar for the "Global Sidebar Width" option
    var globalSidebarWidthTxtField = $( "#global_sidebar_width" );
    var globalSidebarWidthSlideBar = $( "#global_sidebar_width_slide_bar" );
    globalSidebarWidthSlideBar.slider({
        range: "max",
        min: 20,
        max: 50,
        value: [ globalSidebarWidthTxtField.val() ],
        slide: function( event, ui ) {
            globalSidebarWidthTxtField.val( ui.value );
        },
        start: function( event, ui ) {
            if ( globalSidebarWidthTxtField.hasClass('udesign-error') ) {
                globalSidebarWidthTxtField.removeClass('udesign-error').addClass('udesign-valid').removeAttr('title').tooltip("disable");
            }
        }
    });
    // When 'Global Sidebar Width' text field input has changed
    globalSidebarWidthTxtField.on('input propertychange', function() {
        // Update the 'Global Sidebar Width' slide-bar
        globalSidebarWidthSlideBar.slider( 'value', $( this ).val() );
    });
    
    // When Max Width enabled disable the Theme Width slide and text field 
    if ( $("#max_theme_width").is(':checked')  ) {
        globalThemeWidthSlideBar.slider( "disable" );
        globalThemeWidthTxtField.prop( "disabled", true );
    }
    $( "#max_theme_width" ).click(function() {
        if ( $("#max_theme_width").is(':checked')  ) {
            globalThemeWidthSlideBar.slider( "disable" );
            globalThemeWidthTxtField.prop( "disabled", true );
        } else {
            globalThemeWidthSlideBar.slider( "enable" );
            globalThemeWidthTxtField.prop( "disabled", false );
        }
    });
    
    
    
    // When 'Global Theme Width' is set to 960 (default) then disable the 'Global Sidebar Width' option
    if ( $("#max_theme_width").is(':checked')  ) {
        globalSidebarWidthSlideBar.slider( "enable" );
        globalSidebarWidthTxtField.prop( "disabled", false );
    } else if ( globalThemeWidthTxtField.val() == 960 ) {
        globalSidebarWidthSlideBar.slider( "disable" );
        globalSidebarWidthTxtField.prop( "disabled", true );
    }
    $( "#max_theme_width" ).click(function() {
        if ( $("#max_theme_width").is(':checked')  ) {
            globalSidebarWidthSlideBar.slider( "enable" );
            globalSidebarWidthTxtField.prop( "disabled", false );
        } else if ( globalThemeWidthTxtField.val() == 960 ) {
            globalSidebarWidthSlideBar.slider( "disable" );
            globalSidebarWidthTxtField.prop( "disabled", true );
        }
    });
    
    
    
    // Slide bar for the Responsive Section "Disable prettyPhoto" option
    var disablePPTxtField = $( "#responsive_disable_pretty_photo_at_width" );
    var disablePPSlideBar = $( "#disable_pp_at_width_slide_bar" );
    disablePPSlideBar.slider({
        range: "max",
        min: 0,
        max: 1600,
        step: 10,
        value: [ disablePPTxtField.val() ],
        slide: function( event, ui ) {
            disablePPTxtField.val( ui.value );
        }
    });
    disablePPTxtField.keyup(function() {
        disablePPSlideBar.slider( 'value', $( this ).val() );
    });
    
    // Handle the "Exclude Portfolio(s) from Blog" option checkboxes
    var $exclude_portfolio_from_blog = $("#exclude_portfolio_from_blog");
    function exclude_portfolio_option( option ){
        if ( option === 'checked' ) {
            $("#exclude_portfolio_from_recent_posts_widget").prop( "disabled", false );
            $("#exclude_portfolio_from_archives_widget").prop( "disabled", false );
            $("#exclude_portfolio_from_main_query").prop( "disabled", false );
        } else {
            $("#exclude_portfolio_from_recent_posts_widget").prop( "disabled", true );
            $("#exclude_portfolio_from_archives_widget").prop( "disabled", true );
            $("#exclude_portfolio_from_main_query").prop( "disabled", true );
        }
    }
    if ( ! $exclude_portfolio_from_blog.is(':checked')  ) {
        exclude_portfolio_option( 'unchecked' );
    }
    $exclude_portfolio_from_blog.click(function() {
        if ( $exclude_portfolio_from_blog.is(':checked')  ) {
            exclude_portfolio_option( 'checked' );
        } else {
            exclude_portfolio_option( 'unchecked' );
        }
    });
    
});




// Save theme's options with AJAX
jQuery(document).ready(function($){
    
    // Validate the form first with jQuery Validation plugin
    $("#udesign_options_submit_form").validate({
        debug: false,
        errorClass:'udesign-error',
        validClass:'udesign-valid',
        rules: {
            "udesign_options[global_sidebar_width]": {
                required: true,
                range: [20, 50]
            },
            "udesign_options[global_theme_width]": {
                required: true,
                range: [960, 1600]
            },
            "udesign_options[top_nav_background_opacity]": {
                required: true,
                range: [0, 1]
            },
            "udesign_options[dropdown_nav_background_opacity]": {
                required: true,
                range: [0, 1]
            },
            "udesign_options[sec_menu_bg_opacity]": {
                required: true,
                range: [0, 1]
            },
            "udesign_options[main_menu_vertical_positioning]": {
                required: true,
                min: 0
            },
            "udesign_options[headings_font_line_height]": {
                required: true,
                range: [0.2, 5.0]
            },
            "udesign_options[heading1_font_line_height]": {
                required: true,
                range: [0.2, 5.0]
            },
            "udesign_options[heading2_font_line_height]": {
                required: true,
                range: [0.2, 5.0]
            },
            "udesign_options[heading3_font_line_height]": {
                required: true,
                range: [0.2, 5.0]
            },
            "udesign_options[heading4_font_line_height]": {
                required: true,
                range: [0.2, 5.0]
            },
            "udesign_options[heading5_font_line_height]": {
                required: true,
                range: [0.2, 5.0]
            },
            "udesign_options[heading6_font_line_height]": {
                required: true,
                range: [0.2, 5.0]
            },
            "udesign_options[general_font_line_height]": {
                required: true,
                range: [0.2, 5.0]
            }
        },
        errorPlacement: function(error, element) {
                element.attr('title', error.text());
                $(".udesign-error").tooltip( { 
                    position: 
                    {
                        my: "left+5 center",
                        at: "right center"
                    },
                    tooltipClass: "udesign-ttError"
                });
                // Open Tooltip on error
                $(".udesign-error").tooltip("open");
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass(errorClass).addClass(validClass);
            $(element).removeAttr('title');
        },
        submitHandler: function(form) {
            save_udesign_options_ajax(form);
        }
    });
    
    // show "spinner" next to button while settings are being saved
    $( '#udesign_options_submit_form .submit input[type="submit"]' ).click(function() {
        $( this ).next( ".spinner" ).addClass("is-active");
    });
    
    function save_udesign_options_ajax(form) {
        //$('#udesign_options_submit_form').submit( function() {
            
            var enableGoogleFontsOption = admin_scripts_params.enable_google_web_fonts;
            var enableGoogleFontsCheckbox = ( $("#enable_google_web_fonts").is(':checked') ) ? "yes" : "";
            var customColorsSwitch = admin_scripts_params.custom_colors_switch;
            var currentSlider = admin_scripts_params.current_slider;
            
            if ( $("#reset_to_defaults").is(':checked') || // don't use ajax on options reset
                 enableGoogleFontsCheckbox != enableGoogleFontsOption || // or the Google Fonts option has been changed
                    $("#save_current_colors_as_array").is(':checked') || // or Administrative Tasks when "Save the current custom colors" is selected
                        $("#chosen_custom_colors_admin_task").val() == 'load' || // or Administrative Tasks when 'load' is selected
                            $("#current_slider").val() == 'load'  || // or Administrative Tasks when 'load' is selected
                                !$("#custom_colors_switch_"+customColorsSwitch ).is(':checked') || // or "Custom Colors" switch has been toggled
                                    $('#current_slider option:selected').val() != currentSlider  // or if "Current Slider" has been changed
                        ) { 
                form.submit();
            } else {
                var data = $(form).serialize();
                $.post( 'options.php', data, function(response) {
                            //alert( response );
                            // remove the "spinner"
                            $(".spinner").removeClass("is-active");
                            
                        }).error( 
                        function() {
                            alert('There was an error!');
                            
                        }).success( function() {
                            // alert('success');
                            // 
                            // Take care of the "Administrative Tasks" when 'delete' is selected
                            if ( $("#chosen_custom_colors_admin_task").val() == 'delete' && $("#chosen_custom_colors").val() != 'default' ) {
                                var deletedVar = $("#chosen_custom_colors").val();
                                $("#chosen_custom_colors option[value='"+deletedVar+"']").remove();
                                $("#chosen_custom_colors_admin_task").val(""); // reset the admin task dropdown
                            }
                });
                return false;
            }
        //});
    }
    
});


// Secondary Menu Bar script
jQuery(document).ready(function ($) {
    
    var $secNavBarItemsList      = $("#sec-nav-bar-items-list"),
        $secNavBarSimulatorList  = $("#sec-nav-bar-items-simulator-list");
    // add thickbox modal for editing options
    var textArea1TBOptions = '<a title="Secondary Menu Text Area 1 Options" href="#TB_inline?width=600&height=550&inlineId=sec_nav_text_area_1_options" class="thickbox sec-nav-txt-area-1-tb-opts"><span class="dashicons dashicons-edit"></span></a>';
    var textArea2TBOptions = '<a title="Secondary Menu Text Area 2 Options" href="#TB_inline?width=600&height=550&inlineId=sec_nav_text_area_2_options" class="thickbox sec-nav-txt-area-2-tb-opts"><span class="dashicons dashicons-edit"></span></a>';
    var menuTBOptions = '<a title="Secondary Menu Options" href="#TB_inline?width=600&height=550&inlineId=sec_nav_menu_options" class="thickbox sec-nav-menu-tb-opts"><span class="dashicons dashicons-edit"></span></a>';
    var secNavBarTextArea1ListItemHTML  = '<li id="sec-nav-bar-item-txt1" class="ui-widget-content ui-corner-tr">Text Area 1'+textArea1TBOptions+'</li>',
        secNavBarTextArea2ListItemHTML  = '<li id="sec-nav-bar-item-txt2" class="ui-widget-content ui-corner-tr">Text Area 2'+textArea2TBOptions+'</li>',
        secNavBarMenuListItemHTML       = '<li id="sec-nav-bar-item-menu" class="ui-widget-content ui-corner-tr">Menu'+menuTBOptions+'</li>';
    var $secondaryMenuTextArea1Width = $('#secondary_menu_text_area_1_width'),
        $secondaryMenuTextArea2Width = $('#secondary_menu_text_area_2_width'),
        $secondaryMenuWidth          = $('#secondary_menu_width');
    var $secondaryMenuItemsOrder = $('#secondary_menu_items_order');


    switch ( $secondaryMenuItemsOrder.val() ) {
            case "txt1|menu|txt2":
                $secNavBarSimulatorList.append(secNavBarTextArea1ListItemHTML).append(secNavBarMenuListItemHTML).append(secNavBarTextArea2ListItemHTML);
                break;
            case "txt1|txt2|menu":
                $secNavBarSimulatorList.append(secNavBarTextArea1ListItemHTML).append(secNavBarTextArea2ListItemHTML).append(secNavBarMenuListItemHTML);
                break;
            case "menu|txt1|txt2":
                $secNavBarSimulatorList.append(secNavBarMenuListItemHTML).append(secNavBarTextArea1ListItemHTML).append(secNavBarTextArea2ListItemHTML);
                break;
            case "menu|txt2|txt1":
                $secNavBarSimulatorList.append(secNavBarMenuListItemHTML).append(secNavBarTextArea2ListItemHTML).append(secNavBarTextArea1ListItemHTML);
                break;
            case "txt2|menu|txt1":
                $secNavBarSimulatorList.append(secNavBarTextArea2ListItemHTML).append(secNavBarMenuListItemHTML).append(secNavBarTextArea1ListItemHTML);
                break;
            case "txt2|txt1|menu":
                $secNavBarSimulatorList.append(secNavBarTextArea2ListItemHTML).append(secNavBarTextArea1ListItemHTML).append(secNavBarMenuListItemHTML);
                break;
            case "txt1|menu":
                $secNavBarItemsList.append(secNavBarTextArea2ListItemHTML);
                $secNavBarSimulatorList.append(secNavBarTextArea1ListItemHTML).append(secNavBarMenuListItemHTML);
                break;
            case "menu|txt1":
                $secNavBarItemsList.append(secNavBarTextArea2ListItemHTML);
                $secNavBarSimulatorList.append(secNavBarMenuListItemHTML).append(secNavBarTextArea1ListItemHTML);
                break;
            case "txt2|menu":
                $secNavBarItemsList.append(secNavBarTextArea1ListItemHTML);
                $secNavBarSimulatorList.append(secNavBarTextArea2ListItemHTML).append(secNavBarMenuListItemHTML);
                break;
            case "menu|txt2":
                $secNavBarItemsList.append(secNavBarTextArea1ListItemHTML);
                $secNavBarSimulatorList.append(secNavBarMenuListItemHTML).append(secNavBarTextArea2ListItemHTML);
                break;
            case "txt1|txt2":
                $secNavBarItemsList.append(secNavBarMenuListItemHTML);
                $secNavBarSimulatorList.append(secNavBarTextArea1ListItemHTML).append(secNavBarTextArea2ListItemHTML);
                break;
            case "txt2|txt1":
                $secNavBarItemsList.append(secNavBarMenuListItemHTML);
                $secNavBarSimulatorList.append(secNavBarTextArea2ListItemHTML).append(secNavBarTextArea1ListItemHTML);
                break;
            case "txt1":
                $secNavBarItemsList.append(secNavBarTextArea2ListItemHTML);
                $secNavBarItemsList.append(secNavBarMenuListItemHTML);
                $secNavBarSimulatorList.append(secNavBarTextArea1ListItemHTML);
                break;
            case "txt2":
                $secNavBarItemsList.append(secNavBarTextArea1ListItemHTML);
                $secNavBarItemsList.append(secNavBarMenuListItemHTML);
                $secNavBarSimulatorList.append(secNavBarTextArea2ListItemHTML);
                break;
            case "menu":
                $secNavBarItemsList.append(secNavBarTextArea1ListItemHTML);
                $secNavBarItemsList.append(secNavBarTextArea2ListItemHTML);
                $secNavBarSimulatorList.append(secNavBarMenuListItemHTML);
                break;
            default:
                $secNavBarItemsList.append(secNavBarTextArea1ListItemHTML);
                $secNavBarItemsList.append(secNavBarTextArea2ListItemHTML);
                $secNavBarItemsList.append(secNavBarMenuListItemHTML);
    }

    // determine which list is empty and toggle 'list-is-empty' class respectively
    function updateListsOccupancyStatus() {
        var secNavBarItemsListLength = $secNavBarItemsList.children('li').length;
        if( secNavBarItemsListLength === 0 ) {
            $secNavBarItemsList.toggleClass('list-is-empty');
        } else if( secNavBarItemsListLength === 3 ) {
            $secNavBarSimulatorList.toggleClass('list-is-empty');
        } else {
            $secNavBarSimulatorList.removeClass('list-is-empty');
            $secNavBarItemsList.removeClass('list-is-empty');
        }
    }
    updateListsOccupancyStatus();
    

    $("#sec-nav-bar-items-list, #sec-nav-bar-items-simulator-list").sortable({
        connectWith: ".sec-nav-bar-connected-sortable",
        revert: true,
        scroll: false,
        placeholder: "sortable-placeholder",
        helper: "clone",
        cursor: "move",
        
        start: function( event, ui ) {
            ui.placeholder.width(ui.item.width()*.9);
            // remove resize handes when start sorting
            $('#sec-nav-bar-items-simulator-list li div.ui-resizable-handle').each(function (index, value) {
                $(value).removeClass('dashicons dashicons-arrow-left dashicons-arrow-right');
            });
        },
        
        stop: function(event, ui) {
            // add resize handes when an element sorted
            $('#sec-nav-bar-items-simulator-list li div.ui-resizable-handle').each(function (index, value) {
                $(value).addClass('dashicons dashicons-arrow-left dashicons-arrow-right');
            });
        },
        
        over: function(e, ui){ 
            if (ui.sender !== null){
                    
                var regex = /\bsec-nav-grid-.+?\b/g; // regex to match class name in the form 'sec-nav-grid-XX'
                if( ui.sender.attr('id') === "sec-nav-bar-items-list") {
                    
                    var numberOfItemsInList = $secNavBarSimulatorList.children('li').length;

                    // set items' widths
                    var itemWidth = 8;
                    if (numberOfItemsInList === 1) {
                        itemWidth = 24;
                    } else if (numberOfItemsInList === 2){
                        itemWidth = 12;
                    }

                    ui.placeholder.addClass("sec-nav-grid-"+itemWidth);
                    $secNavBarSimulatorList.find('li').each(function(){
                        $(this)[0].className = $(this)[0].className.replace(regex, "sec-nav-grid-"+itemWidth);
                    });
                } else {
                    ui.placeholder.addClass("sec-nav-grid-8"); 
                    $secNavBarItemsList.find('li').each(function(){
                        $(this)[0].className = $(this)[0].className.replace(regex, "sec-nav-grid-8");
                    });
                }
                
            }
        },
        

        receive: function( event, ui ) {
            
            var itemID = ui.item.attr('id');
            var $receivedItem = $('#' + itemID);
            var regex = /\bsec-nav-grid-.+?\b/g; // regex to match class name in the form 'sec-nav-grid-XX'
            
            updateListsOccupancyStatus();
                
            // when items are activated
            if( ui.sender.attr('id') === "sec-nav-bar-items-list") {
                
                
                var order = $(this).sortable('toArray'),
                    numberOfItemsInList = order.length;

                // set items' widths
                var itemWidth = 8;
                if (numberOfItemsInList === 1) {
                    itemWidth = 24;
                } else if (numberOfItemsInList === 2){
                    itemWidth = 12;
                }
                
                // when item is activated update all items widths respectively
                $.each(order, function( index, value ) {
                    $('#'+value)[0].className = $('#'+value)[0].className.replace(regex, "sec-nav-grid-"+itemWidth);
                    if( value === "sec-nav-bar-item-txt1" ) {
                        $secondaryMenuTextArea1Width.val(itemWidth).prop('selected', true);
                    } else if( value === "sec-nav-bar-item-txt2" ) {
                        $secondaryMenuTextArea2Width.val(itemWidth).prop('selected', true);
                    } else { // when "menu"
                        $secondaryMenuWidth.val(itemWidth).prop('selected', true);
                    };
                });
                
                // add the 'ui-resizable' class to re-enable resizable feature
                $secNavBarSimulatorList.find('li').addClass('ui-resizable');
                
            } else { // when items are disabled
                
                /* Sending list updates: */
                var senderList = '#'+ui.sender.attr('id'),
                    order = $(senderList).sortable('toArray'),
                    numberOfItemsInList = order.length;
            
                // set items' widths
                var itemWidth = 12;
                if (numberOfItemsInList === 1){ 
                    itemWidth = 24;
                }
                // when item is disabled update all remainign items from sender widths respectively
                $.each(order, function( index, value ) {
                    $('#'+value)[0].className = $('#'+value)[0].className.replace(regex, "sec-nav-grid-"+itemWidth);
                    if( value === "sec-nav-bar-item-txt1" ) {
                        $secondaryMenuTextArea1Width.val(itemWidth).prop('selected', true);
                    } else if( value === "sec-nav-bar-item-txt2" ) {
                        $secondaryMenuTextArea2Width.val(itemWidth).prop('selected', true);
                    } else { // when "menu"
                        $secondaryMenuWidth.val(itemWidth).prop('selected', true);
                    };
                });
                
                /* Receiving list updates: */
                // remove the 'ui-resizable' class to disaable resizable feature
                $secNavBarItemsList.find('li').removeClass('ui-resizable');
                
                // set item's width class to default "sec-nav-grid-8"
                $receivedItem[0].className = $receivedItem[0].className.replace(regex, "sec-nav-grid-8");
                
                // when items deactivated update their widths to "0" respectively
                if( itemID === "sec-nav-bar-item-txt1" ) {
                    $secondaryMenuTextArea1Width.val(0).prop('selected', true);
                } else if( itemID === "sec-nav-bar-item-txt2" ) {
                    $secondaryMenuTextArea2Width.val(0).prop('selected', true);
                } else { // when "sec-nav-bar-item-menu"
                    $secondaryMenuWidth.val(0).prop('selected', true);
                };
            }
        },
        
        update: function(event, ui) {
            var changedList = this.id;
            var order = $(this).sortable('toArray'),
                numberOfItemsInList = order.length;
            // trim the original IDs to "txt1", "txt1" and "menu"
            $.each(order, function( index, value ) {
                order[index] = value.replace(/sec-nav-bar-item-/gi, '');
            });
            var positions = order.join('|');
            
            // when "sec-nav-bar-items-simulator-list" list udpated 
            if (changedList === "sec-nav-bar-items-simulator-list") {
                // Items Order
                $secondaryMenuItemsOrder.val(positions).prop('selected', true);
            } else { // when "sec-nav-bar-items-list" list udpated
                // disable item order option when all items are deactivated
                if (numberOfItemsInList === 3) { $secondaryMenuItemsOrder.val("not_applicable").prop('selected', true); }
            }
        }
        
    });
    $("#sec-nav-bar-items-list, #sec-nav-bar-items-simulator-list").disableSelection();
    
    
    
    //detect the width
    var secNavBarSimulatorListWidth = $secNavBarSimulatorList.width();
    var gridWidth = secNavBarSimulatorListWidth / 24;
    gridWidth = Math.round(gridWidth);
    
    // update the width value when browser is resized
    $(window).resize(function(){
        secNavBarSimulatorListWidth = $secNavBarSimulatorList.width();
        gridWidth = secNavBarSimulatorListWidth / 24;
        gridWidth = Math.round(gridWidth);
        setMenuItemWidth();
    });
    
    function setMenuItemWidth() {
        
        var $secNavBarItemTxt1 = $("#sec-nav-bar-item-txt1"),
            $secNavBarItemTxt2 = $("#sec-nav-bar-item-txt2"),
            $secNavBarItemMenu = $("#sec-nav-bar-item-menu");
    
        // if widths are "0" it belongs to innactive items list so default it to "8" to get 'sec-nav-grid-8' class
        var secondaryMenuTextArea1Width = ($secondaryMenuTextArea1Width.val() === '0') ? 8 : $secondaryMenuTextArea1Width.val();
        var secondaryMenuTextArea2Width = ($secondaryMenuTextArea2Width.val() === '0') ? 8 : $secondaryMenuTextArea2Width.val();
        var secondaryMenuWidth = ($secondaryMenuWidth.val() === '0') ? 8 : $secondaryMenuWidth.val();
        $secNavBarItemTxt1.addClass('sec-nav-grid-' + secondaryMenuTextArea1Width);
        $secNavBarItemTxt2.addClass('sec-nav-grid-' + secondaryMenuTextArea2Width);
        $secNavBarItemMenu.addClass('sec-nav-grid-' + secondaryMenuWidth);
    
        
        $("#sec-nav-bar-item-txt1, #sec-nav-bar-item-txt2, #sec-nav-bar-item-menu").resizable({
            minWidth: gridWidth,
            maxWidth: secNavBarSimulatorListWidth+10,
            handles: 'e',
            grid: gridWidth,

            create: function( event, ui ) {
                // add resize handes when an element is received
                $('#'+this.id+' div.ui-resizable-handle').addClass('dashicons dashicons-arrow-left dashicons-arrow-right');
            },

            resize: function( event, ui ) {
                var gridSize = Math.round(ui.size.width / gridWidth);
        
                
                var regex = /\bsec-nav-grid-.+?\b/g;
                switch ( $secondaryMenuItemsOrder.val() ) {
                        case "txt1|menu|txt2":
                            if( ui.originalElement.attr("id") === "sec-nav-bar-item-txt1" ) {
                                var availableWidth = 24 - $secondaryMenuTextArea2Width.val();
                                alsoResizeReverse($secNavBarItemTxt1, $secNavBarItemMenu, $secondaryMenuWidth, availableWidth);
                            } else { // when "menu"
                                var availableWidth = 24 - $secondaryMenuTextArea1Width.val();
                                alsoResizeReverse($secNavBarItemMenu, $secNavBarItemTxt2, $secondaryMenuTextArea2Width, availableWidth );
                            }
                            break;
                        case "txt1|txt2|menu":
                            if( ui.originalElement.attr("id") === "sec-nav-bar-item-txt1" ) {
                                var availableWidth = 24 - $secondaryMenuWidth.val();
                                alsoResizeReverse($secNavBarItemTxt1, $secNavBarItemTxt2, $secondaryMenuTextArea2Width, availableWidth);
                            } else { // when "txt2"
                                var availableWidth = 24 - $secondaryMenuTextArea1Width.val();
                                alsoResizeReverse($secNavBarItemTxt2, $secNavBarItemMenu, $secondaryMenuWidth, availableWidth);
                            }
                            break;
                        case "menu|txt1|txt2":
                            if( ui.originalElement.attr("id") === "sec-nav-bar-item-menu" ) {
                                var availableWidth = 24 - $secondaryMenuTextArea2Width.val();
                                alsoResizeReverse($secNavBarItemMenu, $secNavBarItemTxt1, $secondaryMenuTextArea1Width, availableWidth);
                            } else { // when "txt1"
                                var availableWidth = 24 - $secondaryMenuWidth.val();
                                alsoResizeReverse($secNavBarItemTxt1, $secNavBarItemTxt2, $secondaryMenuTextArea2Width, availableWidth );
                            }
                            break;
                        case "menu|txt2|txt1":
                            if( ui.originalElement.attr("id") === "sec-nav-bar-item-menu" ) {
                                var availableWidth = 24 - $secondaryMenuTextArea1Width.val();
                                alsoResizeReverse($secNavBarItemMenu, $secNavBarItemTxt2, $secondaryMenuTextArea2Width, availableWidth);
                            } else { // when "txt2"
                                var availableWidth = 24 - $secondaryMenuWidth.val();
                                alsoResizeReverse($secNavBarItemTxt2, $secNavBarItemTxt1, $secondaryMenuTextArea1Width, availableWidth );
                            }
                            break;
                        case "txt2|menu|txt1":
                            if( ui.originalElement.attr("id") === "sec-nav-bar-item-txt2" ) {
                                var availableWidth = 24 - $secondaryMenuTextArea1Width.val();
                                alsoResizeReverse($secNavBarItemTxt2, $secNavBarItemMenu, $secondaryMenuWidth, availableWidth);
                            } else { // when "menu"
                                var availableWidth = 24 - $secondaryMenuTextArea2Width.val();
                                alsoResizeReverse($secNavBarItemMenu, $secNavBarItemTxt1, $secondaryMenuTextArea1Width, availableWidth );
                            }
                            break;
                        case "txt2|txt1|menu": 
                            if( ui.originalElement.attr("id") === "sec-nav-bar-item-txt2" ) {
                                var availableWidth = 24 - $secondaryMenuWidth.val();
                                alsoResizeReverse($secNavBarItemTxt2, $secNavBarItemTxt1, $secondaryMenuTextArea1Width, availableWidth );
                            } else { // when "txt1"
                                var availableWidth = 24 - $secondaryMenuTextArea2Width.val();
                                alsoResizeReverse($secNavBarItemTxt1, $secNavBarItemMenu, $secondaryMenuWidth, availableWidth);
                            }
                            break;
                        case "txt1|menu":
                        case "menu|txt1":
                            if( ui.originalElement.attr("id") === "sec-nav-bar-item-txt1" ) {
                                alsoResizeReverse($secNavBarItemTxt1, $secNavBarItemMenu, $secondaryMenuWidth, 24);
                            } else {
                                alsoResizeReverse( $secNavBarItemMenu, $secNavBarItemTxt1, $secondaryMenuTextArea1Width, 24);
                            }
                            break;
                        case "txt2|menu":
                        case "menu|txt2":
                            if( ui.originalElement.attr("id") === "sec-nav-bar-item-txt2" ) {
                                alsoResizeReverse($secNavBarItemTxt2, $secNavBarItemMenu, $secondaryMenuWidth, 24);
                            } else {
                                alsoResizeReverse($secNavBarItemMenu, $secNavBarItemTxt2, $secondaryMenuTextArea2Width, 24);
                            }
                            break;
                        case "txt1|txt2":
                        case "txt2|txt1":
                            if( ui.originalElement.attr("id") === "sec-nav-bar-item-txt1" ) {
                                alsoResizeReverse($secNavBarItemTxt1, $secNavBarItemTxt2, $secondaryMenuTextArea2Width, 24);
                            } else {
                                alsoResizeReverse($secNavBarItemTxt2, $secNavBarItemTxt1, $secondaryMenuTextArea1Width, 24);
                            }
                            break;
                        case "txt1":
                            $secNavBarItemTxt1[0].className = $secNavBarItemTxt1[0].className.replace(regex, "sec-nav-grid-" + gridSize);
                            break;
                        case "txt2":
                            $secNavBarItemTxt2[0].className = $secNavBarItemTxt2[0].className.replace(regex, "sec-nav-grid-" + gridSize);
                            break;
                        case "menu":
                            $secNavBarItemMenu[0].className = $secNavBarItemMenu[0].className.replace(regex, "sec-nav-grid-" + gridSize);
                            break;
                }
                
                function alsoResizeReverse ( resizedElement, ReverseResizedElement, ReverseResizedElementWidth, totalGridWidthAvail ) {
                    var reversedGridWidth = totalGridWidthAvail - gridSize;
                    if ( reversedGridWidth > 1 ) { // don't allow shrinking element get smaller than 2 grid units
                        resizedElement[0].className = resizedElement[0].className.replace(regex, "sec-nav-grid-" + gridSize);
                        ReverseResizedElementWidth.val(reversedGridWidth).prop('selected', true);
                        ReverseResizedElement[0].className = ReverseResizedElement[0].className.replace(regex, "sec-nav-grid-" + reversedGridWidth);
                        // Update elements respective widths 
                        if( ui.originalElement.attr("id") === "sec-nav-bar-item-txt1" ) {
                            $secondaryMenuTextArea1Width.val(gridSize).prop('selected', true);
                        } else if( ui.originalElement.attr("id") === "sec-nav-bar-item-txt2" ) {
                            $secondaryMenuTextArea2Width.val(gridSize).prop('selected', true);
                        } else { // when "menu"
                            $secondaryMenuWidth.val(gridSize).prop('selected', true);
                        };
                    }
                }

                
            }
        }).on('resize', function (e) {
            e.stopPropagation(); 
        });
    }
    setMenuItemWidth();
    
    // dummy content links
    $("#insert_text_area_1_dummy_content").on('click', function(event){
        var content = $("#text_area_1_dummy_content").html();
        $("#secondary_menu_text_area_1").val(content);
        event.preventDefault();
    });
    $("#insert_text_area_2_dummy_content").on('click', function(event){
        var content = $("#text_area_2_dummy_content").html();
        $("#secondary_menu_text_area_2").val(content);
        event.preventDefault();
    });
    
    
});



// Handle Select2 dropdowns for the "Fonts Settings" section
jQuery(document).ready(function ($) {

    // the following three arrays arrive as json encoded
    var dataVariants = admin_scripts_params.google_webfonts_variants;
    var dataVariantsDesc = admin_scripts_params.google_fonts_variants_descriptions;
    var dataSubsets = admin_scripts_params.google_webfonts_subsets;
    
    // Handle Individual Headings Overwrites (checkboxes)
    togle_individual_heading_overwrite_option("heading1");
    togle_individual_heading_overwrite_option("heading2");
    togle_individual_heading_overwrite_option("heading3");
    togle_individual_heading_overwrite_option("heading4");
    togle_individual_heading_overwrite_option("heading5");
    togle_individual_heading_overwrite_option("heading6");
    
    function togle_individual_heading_overwrite_option(headingPrefix){
        if ( $("input#"+headingPrefix+"_font_settings_enabled").is(':checked')  ) {
            $("#"+headingPrefix+"_font_settings_option").show( 250, 'linear').trigger("change");
        } else {
            $("#"+headingPrefix+"_font_settings_option").hide( 350, 'linear').trigger("change");
        }
        $( "input#"+headingPrefix+"_font_settings_enabled" ).click(function() {
            if ( $("input#"+headingPrefix+"_font_settings_enabled").is(':checked')  ) {
                $("#"+headingPrefix+"_font_settings_option").show( 250, 'linear').trigger("change");
            } else {
                $("#"+headingPrefix+"_font_settings_option").hide( 350, 'linear').trigger("change");
            }
        });
    }


    // General Fonts. Use labelPrefix: "general" and classPrefix: "general". Reference classes ".general-font-family" and ".general-font-subsets"
    transformFontsOptionsWithSelect2("general", "general");
    
    // Top Nav Fonts. Use labelPrefix: "top_nav" and classPrefix: "top-nav". Reference classes ".top-nav-font-family" and ".top-nav-font-subsets"
    transformFontsOptionsWithSelect2("top_nav", "top-nav");

    // Headings Fonts. Use labelPrefix: "headings" and classPrefix: "headings". Reference classes ".headings-font-family" and ".headings-font-subsets"
    transformFontsOptionsWithSelect2("headings", "headings");

    // Heading 1 Fonts. Use labelPrefix: "heading1" and classPrefix: "heading1". Reference classes ".heading1-font-family" and ".heading1-font-subsets"
    transformFontsOptionsWithSelect2("heading1", "heading1");

    // Heading 2 Fonts. Use labelPrefix: "heading2" and classPrefix: "heading2". Reference classes ".heading2-font-family" and ".heading2-font-subsets"
    transformFontsOptionsWithSelect2("heading2", "heading2");

    // Heading 3 Fonts. Use labelPrefix: "heading3" and classPrefix: "heading3". Reference classes ".heading3-font-family" and ".heading3-font-subsets"
    transformFontsOptionsWithSelect2("heading3", "heading3");

    // Heading 4 Fonts. Use labelPrefix: "heading4" and classPrefix: "heading4". Reference classes ".heading4-font-family" and ".heading4-font-subsets"
    transformFontsOptionsWithSelect2("heading4", "heading4");

    // Heading 5 Fonts. Use labelPrefix: "heading5" and classPrefix: "heading5". Reference classes ".heading5-font-family" and ".heading5-font-subsets"
    transformFontsOptionsWithSelect2("heading5", "heading5");

    // Heading 6 Fonts. Use labelPrefix: "heading6" and classPrefix: "heading6". Reference classes ".heading6-font-family" and ".heading6-font-subsets"
    transformFontsOptionsWithSelect2("heading6", "heading6");
    
    
    
    function transformFontsOptionsWithSelect2(labelPrefix, classPrefix) {
        $("."+classPrefix+"-font-family").select2({
                theme: "classic",
                placeholder: admin_scripts_params.font_family_select2_placeholder,
                //allowClear: true
        })
        .on("change", function(e) {
                var selectedId = $("."+classPrefix+"-font-family option:selected").data('font-id');

                var $fontVariants = $("."+classPrefix+"-font-variants");
                var $fontSubsets = $("."+classPrefix+"-font-subsets");

                // Check if selected ID is numeric, meaning it belongs to the Google Fonts OptionGroup
                if ( $.isNumeric(selectedId) ) {

                        // BEGIN: Variants Dropdown
                        var dataVariantsNew = [],
                            defaultSelectedVariant = "";
                        dataVariants.forEach(function(obj) {
                            if( obj.id == selectedId ){
                                var textObj = obj.text;
                                textObj.forEach(function(el, index) {
                                    dataVariantsNew.push({id:el, text:dataVariantsDesc[el]});
                                    if(el === "regular") { defaultSelectedVariant = el; } // set default selected to "regular" if available
                                });
                            }
                        });

                        // before loading the "variants" dropdown, reset it
                        $fontVariants.html('');
                        // Load "variants" dropdown
                        $fontVariants.select2({
                            data: dataVariantsNew,
                            minimumResultsForSearch: Infinity, // hide the search box
                            theme: "classic",
                            placeholder: "Choose a Variant"
                        });
                        // assign default selected value
                        $fontVariants.val(defaultSelectedVariant).trigger("change");
                        $("label."+labelPrefix+"_font_variants").show( 250, 'linear').trigger("change");
                        $("label."+labelPrefix+"_font_subsets").show( 250, 'linear').trigger("change");
                        // END: Variants Dropdown

                        // BEGIN: Subsets Dropdown
                        var dataSubsetsNew = [],
                            latinFound = "", 
                            firstVal = "";
                        dataSubsets.forEach(function(obj) {
                            if( obj.id == selectedId ){
                                var textObj = obj.text;
                                textObj.forEach(function(el, index) {
                                    dataSubsetsNew.push({id:el, text:el});
                                    firstVal = textObj[0];
                                    if (el === "latin") { latinFound = true; }
                                });
                            }
                        });
                        // before loading the "subsets" dropdown, reset it
                        $fontSubsets.html('');
                        // Load "subsets" dropdown
                        $fontSubsets.select2({
                            data: dataSubsetsNew,
                            minimumResultsForSearch: Infinity, // hide the search box
                            theme: "classic",
                            placeholder: "Choose a Subset"
                        });
                        // assign default selected value
                        var defaultSelectedSubset = (latinFound) ? "latin" : firstVal; // set default selected to "latin" if available else pick the first element
                        $fontSubsets.val(defaultSelectedSubset).trigger("change");
                        // END: Subsets Dropdown
                } else {
                        // hide Google Varians and Subsets dropdowns if Generic font selected
                        $("label."+labelPrefix+"_font_variants").hide( 350, 'linear').trigger("change");
                        $("label."+labelPrefix+"_font_subsets").hide( 350, 'linear').trigger("change");
                }
        });


        // Grab the "variants" select with select2 on initial page load
        $("."+classPrefix+"-font-variants").select2({
            minimumResultsForSearch: Infinity, // hide the search box
            theme: "classic"
        });
        // Grab the "subsets" select with select2 on initial page load
        $("."+classPrefix+"-font-subsets").select2({
            minimumResultsForSearch: Infinity, // hide the search box
            theme: "classic"
        });
        // Grab the "subsets" select with select2 on initial page load
        $("."+classPrefix+"-font-size").select2({
            theme: "classic"
        });
    }

});


// Toggle "Responsive Menu 2" checkbox for Breakpoint 1 option
jQuery(document).ready(function ($) {
    var $responsiveMenu = $("select#responsive_menu");
    var $menu2ScreenWidthOpt = $("fieldset.menu_2_screen_width");

    if ( $responsiveMenu.val() === "responsive_menu_2"  ) {
        $menu2ScreenWidthOpt.show( 250, 'linear').trigger("change");
    } else {
        $menu2ScreenWidthOpt.hide( 350, 'linear').trigger("change");
    }
    $responsiveMenu.click(function() {
        if ( $responsiveMenu.val() === "responsive_menu_2" ) {
            $menu2ScreenWidthOpt.show( 250, 'linear').trigger("change");
        } else {
            $menu2ScreenWidthOpt.hide( 350, 'linear').trigger("change");
        }
    });
});

