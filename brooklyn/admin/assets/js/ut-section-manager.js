/* <![CDATA[ */
(function ($) {

    "use strict";
        
    $(document).ready(function(){
        
        $('#ut-option-switch-wrap').insertBefore('#ut-panel-tabs');
        $('#setting_ut_page_type').appendTo('#ut-option-switch');
        $('.ut-modal-option-tree').insertAfter('#ut-metapanel .inside');
                        
        var ut_hero_type = $(),
            ut_hero_settings = $(),
            ut_hero_styling = $(),
            ut_page_header_settings = $(),
            ut_navigation_section = $(),
            ut_section_settings = $(),
            ut_page_settings = $(),
            ut_color_settings = $(),
            ut_section_parallax_settings = $(),
            ut_section_video_settings = $(),
            ut_section_overlay_settings = $(),
            ut_manage_team = $(),
            ut_contact_section = $(),
            ut_portfolio_details = $(),
            ut_hero_content_color_settings = $(),
            ut_hero_content_custom_html_settings = $(),
            ut_hero_content_caption_slogan_settings = $(),
            ut_hero_content_caption_title_settings = $(),
            ut_hero_content_caption_description_settings = $(),
            ut_hero_content_button_settings = $();            
        
        $('.format-settings').each(function() {
            
            var $this = $(this);
            
            if($this.data("panel") === 'ut-page-header-settings') {
                ut_page_header_settings = ut_page_header_settings.add($this);
            } else if($this.data("panel") === 'ut-section-settings') {
                ut_section_settings = ut_section_settings.add($this);
            } else if($this.data("panel") === 'ut-page-settings') {
                ut_page_settings = ut_page_settings.add($this);
            } else if($this.data("panel") === 'ut-color-settings') {
                ut_color_settings = ut_color_settings.add($this);
            } else if($this.data("panel") === 'ut-section-parallax-settings') {
                ut_section_parallax_settings = ut_section_parallax_settings.add($this);
            } else if($this.data("panel") === 'ut-section-video-settings') {
                ut_section_video_settings = ut_section_video_settings.add($this);    
            } else if($this.data("panel") === 'ut-section-overlay-settings') {
                ut_section_overlay_settings = ut_section_overlay_settings.add($this);
            } else if($this.data("panel") === 'ut-manage-team') {
                ut_manage_team = ut_manage_team.add($this);
            } else if($this.data("panel") === 'ut-contact-section') {
                ut_contact_section = ut_contact_section.add($this);
            } else if($this.data("panel") === 'ut-navigation-section') {
                ut_navigation_section = ut_navigation_section.add($this);
            } else if($this.data("panel") === 'ut-hero-type') {
                ut_hero_type = ut_hero_type.add($this);
            } else if($this.data("panel") === 'ut-hero-settings') {
                ut_hero_settings = ut_hero_settings.add($this);
            } else if($this.data("panel") === 'ut-hero-styling') {
                ut_hero_styling = ut_hero_styling.add($this);
            } else if($this.data("panel") === 'ut-portfolio-details') {
                ut_portfolio_details = ut_portfolio_details.add($this);
            } else if($this.data("panel") === 'ut-hero-content-color-settings') {
                ut_hero_content_color_settings = ut_hero_content_color_settings.add($this);
            } else if($this.data("panel") === 'ut-hero-content-custom-html-settings') {
                ut_hero_content_custom_html_settings = ut_hero_content_custom_html_settings.add($this);
            } else if($this.data("panel") === 'ut-hero-content-caption-slogan-settings') {
                ut_hero_content_caption_slogan_settings = ut_hero_content_caption_slogan_settings.add($this);
            } else if($this.data("panel") === 'ut-hero-content-caption-title-settings') {
                ut_hero_content_caption_title_settings = ut_hero_content_caption_title_settings.add($this);
            } else if($this.data("panel") === 'ut-hero-content-caption-description-settings') {
                ut_hero_content_caption_description_settings = ut_hero_content_caption_description_settings.add($this);
            } else if($this.data("panel") === 'ut-hero-content-button-settings') {
                ut_hero_content_button_settings = ut_hero_content_button_settings.add($this);
            }              
            
        });        
        
        /* fill tabs */
        $('#ut-hero-type').append(ut_hero_type);
        $('#ut-hero-settings').append(ut_hero_settings);
        $('#ut-hero-styling').append(ut_hero_styling);
        $('#ut-page-header-settings').append(ut_page_header_settings);
        $('#ut-section-settings').append(ut_section_settings);
        $('#ut-page-settings').append(ut_page_settings);
        $('#ut-color-settings').append(ut_color_settings);
        $('#ut-section-parallax-settings').append(ut_section_parallax_settings);
        $('#ut-section-video-settings').append(ut_section_video_settings);
        $('#ut-section-overlay-settings').append(ut_section_overlay_settings);
        $('#ut-manage-team').append(ut_manage_team);
        $('#ut-contact-section').append(ut_contact_section);
        $('#ut-navigation-section').append(ut_navigation_section);
        $('#ut-portfolio-details').append(ut_portfolio_details);
        $('#ut-hero-content-color-settings').append(ut_hero_content_color_settings);
        $('#ut-hero-content-custom-html-settings').append(ut_hero_content_custom_html_settings);
        $('#ut-hero-content-caption-slogan-settings').append(ut_hero_content_caption_slogan_settings);
        $('#ut-hero-content-caption-title-settings').append(ut_hero_content_caption_title_settings);
        $('#ut-hero-content-caption-description-settings').append(ut_hero_content_caption_description_settings);
        $('#ut-hero-content-button-settings').append(ut_hero_content_button_settings);
               
        
        /* remove post formats visually and reset them - since Version 2.6 */        
        if( ut_meta_panel_vars.post_type === "portfolio" ) {
            
            /* reset post format - we do not need it anymore */
            $('#post-format-0').attr('checked' , 'checked');
            
            /* disable options */
            $('#setting_ut_section_header_align').addClass('ut-disabled-for-user');            
            
        }
        
        /* create tabs */
        $("#ut-panel-tabs").tabs();
        $("#ut-hero-sub-settings").tabs();
        
        
        /* */
        $("#ut-panel-tabs a").click( function( event ) {
            event.preventDefault();            
        });
        
        
        
        /*
        |--------------------------------------------------------------------------
        | Portfolio Settings
        |--------------------------------------------------------------------------
        */
        var limit_settings      = false;
        var restricted_settings = [];
        var portfolio_link_type = '';
        
        if( ut_meta_panel_vars.post_type === "portfolio" ) {            
            
            var show_hide_portfolio_slider_settings = function( state ) {
    
                var $slider_settings = $('#setting_ut_page_hero_slider');
                
                if( state==='show' ) {
                   
                    $slider_settings.find('.option-tree-setting-body').each(function() {
            
                        $(this).children('.format-settings').show();
                        
                    }); 
                    
                    
                } else {
                    
                    $slider_settings.find('.option-tree-setting-body').each(function() {
            
                        $(this).children('.format-settings').hide();
                        $(this).children('.format-settings').eq(0).show();
                        $(this).children('.format-settings').eq(1).show();
                        
                    });        
                    
                }
                
            }
                
            var show_hide_portfolio_tabs = function( type ) {
                                
                if( type === 'internal' ) {
                    
                    $('.ut-hero-styling').show();
                    $('.ut-hero-settings').show();
                    $('.ut-page-header-settings').show();        
                    $('.ut-contact-section').show();
                    $('.ut-page-settings').show();
                                        
                    $('#setting_ut_activate_page_hero').show();
                    $('#setting_ut_page_hero_type .description').show();
                    
                    limit_settings = false;
                    restricted_settings = [];
                    
                    show_hide_portfolio_slider_settings('show');                    
                     
                } else {
                
                    $('.ut-hero-styling').hide();
                    $('.ut-hero-settings').hide();
                    $('.ut-page-header-settings').hide();
                    $('.ut-contact-section').hide();
                    $('.ut-page-settings').hide();
                    
                    $('#setting_ut_activate_page_hero').hide();                    
                    $('#setting_ut_page_hero_type .description').hide();
                    
                    limit_settings = true;
                    restricted_settings = [
                        'ut_page_hero_parallax',
                        'ut_page_hero_rain_effect',
                        'ut_page_hero_rain_sound',
                        'ut_page_hero_slider_animation_speed',
                        'ut_page_hero_slider_slideshow_speed',
                        'ut_page_video_sound',
                        'ut_page_video_volume',
                        'ut_page_video_mute_button',
                        'ut_page_video_poster'
                    ];
                    
                    show_hide_portfolio_slider_settings('hide');
                    
                    
                }
                
            }
            
            
            if( $('#ut_portfolio_link_type').val() === 'global' ) {
                
                portfolio_link_type =  $('#ut-portfolio-settings-info').data('detailstyle');
                
            } else {
            
                portfolio_link_type = $('#ut_portfolio_link_type').val();
            
            }
                        
            show_hide_portfolio_tabs( portfolio_link_type );
            
            $('#ut_portfolio_link_type').change(function() {
                
                var _portfolio_link_type = '';
                
                if( $(this).val() === 'global' ) {
                
                    _portfolio_link_type =  $('#ut-portfolio-settings-info').data('detailstyle');
                    
                } else {
                
                    _portfolio_link_type = $(this).val();
                
                }
                
                show_hide_portfolio_tabs( _portfolio_link_type );
                
                if( _portfolio_link_type === 'internal' ) {
                    
                    $('.ut-hero-type a').text( $('.ut-hero-type a').data('page') );
                    $('#setting_ut-hero-settings h2').text( $('.ut-hero-type a').data('page') );
                    
                    /* switch name */
                    $("#ut_page_hero_type").each(function(){
                        
                        $(this).children("option").each(function() {
                            
                            if( $(this).data('orglabel') ) {
                                $(this).text( $(this).data('orglabel') );
                            }
                                
                        });
                     
                    });
                    
                    $('#ut_page_hero_type .select-group-option-animatedimage').show();
                    $('#ut_page_hero_type .select-group-option-splithero').show();
                    $('#ut_page_hero_type .select-group-option-transition').show();
                    $('#ut_page_hero_type .select-group-option-tabs').show();
                    $('#ut_page_hero_type .select-group-option-custom').show();
                    $('#ut_page_hero_type .select-group-option-dynamic').show();                    
                   
                    $('#ut_page_hero_type').trigger('change');
                    
                    
                } else {
                    
                    $('.ut-hero-type a').text( $('.ut-hero-type a').data('portfolio') );
                    $('#setting_ut-hero-settings h2').text( $('.ut-hero-type a').data('portfolio') );
                    
                    /* switch name */
                    $("#ut_page_hero_type").each(function(){
                        
                        $(this).children("option").each(function() {
                            
                            if( $(this).data('altlabel') ) {
                                $(this).text( $(this).data('altlabel') );
                            }
                                 
                        });
                     
                    });
                    
                    $('#ut_page_hero_type .select-group-option-animatedimage').hide();
                    $('#ut_page_hero_type .select-group-option-splithero').hide();
                    $('#ut_page_hero_type .select-group-option-transition').hide();
                    $('#ut_page_hero_type .select-group-option-tabs').hide();
                    $('#ut_page_hero_type .select-group-option-custom').hide();
                    $('#ut_page_hero_type .select-group-option-dynamic').hide();
                   
                    $('#ut_page_hero_type').trigger('change');                    
                                    
                }
                
            });
            
            $('#ut_portfolio_link_type').trigger('change');
            
        }
        
        /*
        |--------------------------------------------------------------------------
        | Icon Modal
        |--------------------------------------------------------------------------
        */
        
        var iconbutton = '',
            iconpreview = '',
            iconinput = '';        
        
        $('.ut-choose-icon').click( function(event) {
           
            iconbutton = $(this),
            iconinput  = iconbutton.siblings('input:text').first();
            iconpreview = iconbutton.siblings('.ut-icon-preview');
            
            $(".ut-modal-option-tree").fadeIn(); 
            
            event.preventDefault();
            
        });
        
        $(document).on("click", ".close-ut-modal-option-tree", function(event){ 
                    
            $(".ut-modal-option-tree").fadeOut();
            
            event.preventDefault();
            
        });
        
        
        $(document).on("click", ".ut-icon-option-tree", function(event){ 
                    
            var icon = $(this).data('icon');
            
            $(iconinput).val(icon);
            $(iconpreview).children('.ut-preview-icon').attr('class' , '').addClass('ut-preview-icon fa ' + icon);
            $(".ut-modal-option-tree").fadeOut();
        
        });        
        
        $(document).on("click", ".ut-delete-icon", function(event){ 
           
           $(this).parent().children('.ut-preview-icon').attr('class' , '').addClass('ut-preview-icon fa');
           $(this).parent().next('input').val('');
           
           event.preventDefault();         
            
        });
        
        /*
        |--------------------------------------------------------------------------
        | radio buttons
        |--------------------------------------------------------------------------
        */
        
        $(document).on("click", ".ut-radio-button", function(event){
            
            var $this = $(this);
            
            /* deactivate buttons first */
            $this.parent().find('.ut-radio-button').removeClass('selected');
            
            /* now apply selected state to current button */
            $this.addClass('selected');
            
            /* change state of connected radio button */            
            $('#' +  $(this).data('for') ).attr('checked', true).trigger("change");
                        
            event.preventDefault();  
             
        });
        
        
        /*
        |--------------------------------------------------------------------------
        | show / hide available section / page options 
        |--------------------------------------------------------------------------
        */
        var section_settings_active = false;
            
        var show_hide_tabs = function( type ) {                        
            
            if(type==='section') {                
                
                /* switch to first section settings tab */
                $("#ut-panel-tabs").tabs("option", "active", 3);
                /* show tab menu items */
                $('.ut-section-settings').show();
                $('.ut-section-parallax-settings').show();
                $('.ut-section-video-settings').show();
                $('.ut-section-overlay-settings').show();
                /* single options */
                $('#setting_ut_section_header_align').removeClass('ut-disabled-for-user');                
                /* hide tab menu items */
                $('.ut-hero-type').hide();
                $('.ut-hero-settings').hide();
                $('.ut-hero-styling').hide();
                $('.ut-page-settings').hide();                
                $('.ut-contact-section').hide();
                $('.ut-navigation-section').hide();
                $('#ut_sidebar_settings').hide();
                section_settings_active = true; 
                               
            } else {                
                
                /* show tab menu items */
                $('.ut-hero-type').show();
                $('.ut-hero-settings').show();
                $('.ut-hero-styling').show();
                $('.ut-contact-section').show();
                $('.ut-page-settings').show();
                $('.ut-navigation-section').show();
                $('#ut_sidebar_settings').show();
                /* single options */
                $('#setting_ut_section_header_align').addClass('ut-disabled-for-user');                                
                /* hide tab menu items */
                $('.ut-section-settings').hide();
                $('.ut-section-parallax-settings').hide();
                $('.ut-section-video-settings').hide();
                $('.ut-section-overlay-settings').hide();                
                /* switch to first page settings tab */
                $("#ut-panel-tabs").tabs( "option", "active", 0 );
                section_settings_active = false;
                
            }
        
        }        
        
        $("#setting_ut_page_type .ut-radio-button").each(function(){
            
            if( $(this).hasClass('selected') ) {                
                show_hide_tabs( $('#' +  $(this).data('for') ).val() );                
            } 
        
        });
        
        
        $(document).on("click", "#setting_ut_page_type .ut-radio-button", function(){            
            
            $('#publish').trigger('click');
            
        });       
        
                
        /*
        |--------------------------------------------------------------------------
        | ui select groups
        |--------------------------------------------------------------------------
        */
        
        var adjust_second_level_options = function($options) {
            
            if ( $options instanceof Array ) {
                    
                for (var i = 0; i < $options.length; i++) {
                  
                    $("#"+$options[i]).trigger('change');                                       
                    
                }
              
            } else {
                  
                $("#"+$options).trigger('change');
              
            }
            
        }
        
        var show_hide_option_set = function( current_for ) {
            
            $("#setting_"+ current_for ).show( 1 , function() {                        
                
                var $this = $(this);                
                
                $this.find(".option-tree-ui-group-radio").filter(":checked").trigger("change");
                $this.find(".option-tree-ui-group-select").find(":selected").trigger("change");                
                
            }); 
        
        }
        
        $(".option-tree-ui-group-select").each(function(){
            
            var $this                 = $(this),
                group                 = $this.data('group'),
                current_for           = $this.find(':selected').data('for');
            
            $this.children("option").each(function() {
                
                /* hide other elements */
                if( $(this).data("for") !== 'current_for') {
                    
                    var hide_options = $(this).data("for").split(',');
                    
                    if ( hide_options instanceof Array ) {
                        
                        for (var i = 0; i < hide_options.length; i++) {
                                                        
                            $("#setting_"+ hide_options[i] ).hide();                            
                        
                        }
                    
                    } else {
                                               
                        $("#setting_"+ $(this).data("for") ).hide();                        
                    
                    }
                    
                }
                
            });
            
            var show_options = current_for.split(',');
            
            if ( show_options instanceof Array ) {
                    
                for (var i = 0; i < show_options.length; i++) {
                    
                    if( $.inArray( show_options[i], restricted_settings ) === -1 ) {
                        
                        $("#setting_"+ show_options[i] ).show();
                        
                    } else {
                    
                        $("#setting_"+ show_options[i] ).hide();
                    
                    }
                    
                }
              
            } else {
                
                if( $.inArray( current_for, restricted_settings ) === -1 ) {
                
                    $("#setting_"+ current_for ).show();
                
                } else {
                    
                    $("#setting_"+ current_for ).hide();
                    
                }
                
            }
            
        });
        
        $(".option-tree-ui-group-select").change(function(){
            
            var current_for = $(this).find(':selected').data('for');
                        
            $(this).children("option").each(function() {
                                
                /* hide other elements */
                if( $(this).data("for") !== 'current_for') {
                    
                    var hide_options = $(this).data("for").split(',');
                    
                    if ( hide_options instanceof Array ) {
                        
                        for (var i = 0; i < hide_options.length; i++) {
                                                        
                            $("#setting_"+ hide_options[i] ).hide();
                        
                        }
                    
                    } else {
                                                
                        $("#setting_"+ $(this).data("for") ).hide();
                    
                    }                    
                    
                }
                
            });
            
            if( current_for ) {
            
                var show_options = current_for.split(',');
                
                if ( show_options instanceof Array ) {
                        
                    for (var i = 0; i < show_options.length; i++) {
                        
                        if( $.inArray( show_options[i], restricted_settings ) === -1 ) {
                        
                            show_hide_option_set( show_options[i] );
                        
                        }
                        
                    }
                  
                } else {
                    
                    if( $.inArray(current_for, restricted_settings ) === -1 ) {
                    
                        show_hide_option_set( current_for );                  
                    
                    }
                    
                }
            
            }
            
        });
        
        $('.ut-toplevel-select-option').trigger('change');
        
        /*
        |--------------------------------------------------------------------------
        | ui radio groups
        |--------------------------------------------------------------------------
        */
                
        $(".ot-type-radio-group").each(function(){
            
            var group                 = $(this).data('group'),
                current_for           = $("input:radio[name ='"+group+"']:checked").data('for');
            
            /* loop through */
            $(this).parent().parent().find('input').each(function(){
                
                /* hide other elements */
                if( $(this).data("for") !== current_for ) {
                    
                    var hide_options = $(this).data("for").split(',');
                    
                    if ( hide_options instanceof Array ) {
                        
                        for (var i = 0; i < hide_options.length; i++) {
                            
                            $("#setting_"+ hide_options[i] ).hide();
                        
                        }
                    
                    } else {
                        
                        $("#setting_"+ $(this).data("for") ).hide();
                    
                    }
                    
                }
            
            });            
            
            if( current_for ) {
            
                var show_options = current_for.split(',');
                
                if ( show_options instanceof Array ) {
                        
                    for (var i = 0; i < show_options.length; i++) {
                        
                        if( $.inArray( show_options[i], restricted_settings ) === -1 ) {
                        
                            $("#setting_"+ show_options[i] ).show();
                        
                        } else {
                            
                            $("#setting_"+ show_options[i] ).hide();
                        
                        }
                        
                    }
                  
                } else {
                    
                    if( $.inArray( current_for, restricted_settings ) === -1 ) {
                    
                        $("#setting_"+ current_for ).show();                        
                    
                    } else {
                        
                        $("#setting_"+ current_for ).hide();
                    
                    }
                    
                }
            }
            
        });                      
        
        $(".option-tree-ui-group-radio").change(function(){
            
            var current_for = $(this).filter(':checked').data('for');
            
            /* loop through */
            $(this).parent().parent().find('input').each(function(){
            
                /* hide other elements */
                if( $(this).data("for") !== current_for ) {
                    
                    var hide_options = $(this).data("for").split(',');
                    
                    if ( hide_options instanceof Array ) {
                        
                        for (var i = 0; i < hide_options.length; i++) {
                            
                            $("#setting_"+ hide_options[i] ).hide();
                        
                        }
                    
                    } else {
                        
                        $("#setting_"+ $(this).data("for") ).hide();
                    
                    }
                    
                }
            
            });            
            
            if( current_for ) {
            
                var show_options = current_for.split(',');
                
                if ( show_options instanceof Array ) {
                                        
                    for (var i = 0; i < show_options.length; i++) {                    
                        
                        if( $.inArray( show_options[i], restricted_settings ) === -1 ) {
                        
                            show_hide_option_set( show_options[i] );                                   
                        
                        }
                        
                    }
                  
                } else {
                    
                    if( $.inArray( current_for, restricted_settings ) === -1 ) {
                    
                        show_hide_option_set( current_for );                
                    
                    }
                    
                }
            
            }
                 
        });
        
        $('.ut-toplevel-radio-option').trigger('change');
        
        
        /*
        |--------------------------------------------------------------------------
        | Hide complete tabs depending on hero type 
        |--------------------------------------------------------------------------
        */                
        if(!section_settings_active) {
            
            if( !limit_settings ) {
                
                if($("#ut_page_hero_type").val()==='slider'||$("#ut_page_hero_type").val()==='transition'||$("#ut_page_hero_type").val()==='custom'){
                    $(".ut-hero-settings").hide();
                    $("#ut-hero-settings").hide();            
                    if($("#ut_page_hero_type").val()==='custom'){
                        $(".ut-hero-styling").hide();
                        $("#ut-hero-styling").hide();
                    }            
                    $("#ut-panel-tabs").tabs("refresh");            
                
                } else {            
                    $(".ut-hero-settings").show();
                    $("#ut-hero-settings").show();
                    $(".ut-hero-styling").show();
                    $("#ut-hero-styling").show();            
                    $("#ut-panel-tabs").tabs("refresh");        
                }
            
            }
            
        }
        $("#ut_page_hero_type").change(function(){            
            
            if( !limit_settings ) {
            
                if(!section_settings_active) {
                    if($(this).val()==='slider'||$(this).val()==='transition'||$(this).val()==='custom'){
                        $(".ut-hero-settings").hide();
                        $("#ut-hero-settings").hide();                
                        if($(this).val()==='custom'){
                            $(".ut-hero-styling").hide();
                            $("#ut-hero-styling").hide();
                        }                
                    } else {
                        $(".ut-hero-settings").show();
                        $("#ut-hero-settings").show();
                        $(".ut-hero-styling").show();
                        $("#ut-hero-styling").show();
                    }
                    $("#ut-panel-tabs").tabs("refresh");
                }
            
            }
            
        });
        
        /*
        |--------------------------------------------------------------------------
        | Team Template Switcher and Notification
        |--------------------------------------------------------------------------
        */
                
        var current_template = $("#page_template").val();
        
        /* display or hide team manager */        
        if(current_template == 'templates/template-team.php') {
            
            $('.ut-team-section').show();
            $('.ut-manage-team-info').hide();
            
        } else {
            
            $('.ut-team-section').hide();
            $('.ut-manage-team-info').show();
            
        }
        
        /* display or hide team manager on template change */    
        $("#page_template").change(function() { 
            
            var chosen_template = $(this).val();
            
            /* display or hide team manager */        
            if(chosen_template == 'templates/template-team.php') {
                
                $('.ut-team-section').show();
                $('.ut-manage-team-info').hide();
                
            } else {
                
                $('.ut-team-section').hide();
                $('.ut-manage-team-info').show();
                
            }            
        
        });
        
        
        /*
        |--------------------------------------------------------------------------
        | Header Styles Preview Boxes
        |--------------------------------------------------------------------------
        */      
        
        /* show font style */
        $('.ut-font-preview').click( function() {
            
            tb_show('', ut_meta_panel_vars.pop_url + 'fontpreview.html?TB_iframe=true');
            return false;            
            
        });
                
        /* show header style */
        $('.ut-header-preview').click( function() {
            
            tb_show('', ut_meta_panel_vars.pop_url + 'headerpreview.html?TB_iframe=true');
            return false;
            
        });
        
        /* show header style */
        $('.ut-hero-preview').click( function() {
            
            tb_show('', ut_meta_panel_vars.pop_url + 'heropreview.html?TB_iframe=true');
            return false;
            
        });    
        
        
        /*
        |--------------------------------------------------------------------------
        | Section Background Video
        |--------------------------------------------------------------------------
        */
        
        /* disable parallax settings if video background is active */
        var video_status = $("#ut_section_video_state").val();
               
        if(video_status === 'on') {
            $("#ut_parallax_section").prop('selectedIndex', 1);
            $("#ut_parallax_section").attr("disabled", true ).wrap('<div class="disabled" />');            
        }
        
        $("#ut_section_video_state").change(function() { 
        
            if($(this).val() === 'on') {
                
                $("#ut_parallax_section").prop('selectedIndex', 1).trigger("change");
                $("#ut_parallax_section").attr("disabled", true ).parent().wrap('<div class="disabled" />');
                            
            } else {
                
                $("#ut_parallax_section").attr("disabled", false ).parent().unwrap();                
            
            }            
            
        });
        
        
        /*
        |--------------------------------------------------------------------------
        | Parallax 
        |--------------------------------------------------------------------------
        */
        
        /* disable background settings if parallax is active */
        var parallax_status = $("#ut_page_hero_parallax").val();
                
        if( parallax_status === 'on' ) {
            
            $("#ut_page_hero_image-attachment").prop('selectedIndex', 0);
            $("#ut_page_hero_image-attachment").attr("disabled", true ).wrap('<div class="disabled" />');
            
            $("#ut_page_hero_image-position").prop('selectedIndex', 0);
            $("#ut_page_hero_image-position").attr("disabled", true ).wrap('<div class="disabled" />');
        
        }
        
        $("#ut_page_hero_parallax").change(function() { 
        
            parallax_status = $(this).val();
            
            if( parallax_status === 'on' ) {
                
                $("#ut_page_hero_image-attachment").prop('selectedIndex', 0).trigger("change");
                $("#ut_page_hero_image-attachment").attr("disabled", true ).parent().wrap('<div class="disabled" />');
                
                $("#ut_page_hero_image-position").prop('selectedIndex', 0).trigger("change");
                $("#ut_page_hero_image-position").attr("disabled", true ).parent().wrap('<div class="disabled" />');
                            
            } else {
                
                $("#ut_page_hero_image-attachment").attr("disabled", false ).parent().unwrap();                
                $("#ut_page_hero_image-position").attr("disabled", false ).parent().unwrap();            
            
            }            
        
        });
        
        /* disable background settings of parallax is active */
        parallax_status = $("#ut_parallax_section").val();
                
        if( parallax_status === 'on' ) {
            
            $("#ut_parallax_image-attachment").prop('selectedIndex', 0);
            $("#ut_parallax_image-attachment").attr("disabled", true ).wrap('<div class="disabled" />');
            
            $("#ut_parallax_image-position").prop('selectedIndex', 0);
            $("#ut_parallax_image-position").attr("disabled", true ).wrap('<div class="disabled" />');
        
        }
        
        $("#ut_parallax_section").change(function() { 
        
            parallax_status = $(this).val();
            
            if( parallax_status === 'on' ) {
                
                $("#ut_parallax_image-attachment").prop('selectedIndex', 0).trigger("change");
                $("#ut_parallax_image-attachment").attr("disabled", true ).parent().wrap('<div class="disabled" />');
                
                $("#ut_parallax_image-position").prop('selectedIndex', 0).trigger("change");
                $("#ut_parallax_image-position").attr("disabled", true ).parent().wrap('<div class="disabled" />');
                            
            } else {
                
                $("#ut_parallax_image-attachment").attr("disabled", false ).parent().unwrap();                
                $("#ut_parallax_image-position").attr("disabled", false ).parent().unwrap();            
            
            }            
        
        });        
        
        $('#ut_portfolio_link_type').trigger('change');       
        
        /*
        |--------------------------------------------------------------------------
        | Section Loader
        |--------------------------------------------------------------------------
        */
            
        $(document).on('click', '#ut-section-loader', function() {
            
            $("#ut-section-loader-modal").fadeIn();
            
            
            $('#ut-available-sections').accordion();
            
            return false;
        
        });
        
        
        
        
        
    });

})(jQuery);
 /* ]]> */    