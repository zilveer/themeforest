var fireEvent;
(function(jQuery){
    jQuery(document).ready(function(){		//when DOM is ready
        admin.init();
    });
    jQuery(window).resize(function() {
        clearTimeout(fireEvent);
        fireEvent = setTimeout(admin.resize_event, 200);
	});
})(jQuery);

jQuery(window).load(function() {
	
});

var admin = {
	init: function() {
        admin.init_drop_kick();
        admin.toggle_dependant_selects();
        admin.init_form_nosubmit();
        admin.init_switches();
        admin.init_uniform();
        admin.init_dependency_checkboxes();
        admin.init_file_upload();
        admin.resize_panel();
        admin.init_disabled_add_items();
        admin.init_save_display();
        admin.init_fixed_menu();
        admin.init_preset_save_close();
    },
    resize_event: function() {
        admin.resize_panel();
    },
    init_drop_kick: function() {
        jQuery('.default:visible').dropkick({
            change: function (value, label) {

                //find all data about the select that was changed
                var form = jQuery(this).parents('form');
                var name = jQuery(this).eq(0)[0].name;

                if(form.length > 0)
                {
                    admin.perform_toggle_dependant_selects(name, form, value)
                    jQuery('.section-save').fadeIn(500);
                    admin.reset_preset_value();
                }
                
                if(jQuery(this).parents('#style_presets').length > 0)
                {
                    if(value == 'custom')
                    {
                        jQuery('.preset-save').fadeOut(500);
                    }
                    else
                    {
                        jQuery('.section-save').fadeOut(500);
                        jQuery('.preset-save').fadeIn(500);
                    }
                }
            }
        });
    },
    init_form_nosubmit: function() {
        //prevent submit of forms
        jQuery('.no-submit').submit(function(){
            return false;
        });
    },
    init_switches: function() {
        var switches = document.querySelectorAll('input[type="checkbox"].switch');
        for (var i=0, sw; sw = switches[i++]; ) 
        {
            var div = document.createElement('div');
            div.className = 'switch';
            sw.parentNode.insertBefore(div, sw.nextSibling);
        }
    },
    init_uniform: function() {
        jQuery(function(){
            jQuery('.styled:visible').uniform();
        });
    },
    init_dependency_checkboxes: function() {
        jQuery('.main-content form:not(".no-dependency-checkboxes")').on('change', 'input[type=checkbox]', function()
        {
            var thisCheck = jQuery(this);
            var id = jQuery(this).attr('id');
            var depend = 'depend_' + id;

            if (thisCheck.is(':checked')) {
                jQuery('.' + depend).fadeIn('fast');
                admin.init_drop_kick();
                admin.toggle_dependant_selects();
            } else {
                jQuery('.' + depend).fadeOut('fast');
            }
        });
    },
    resize_panel: function(){
        var w_h = jQuery(window).height();
        var p_h = jQuery('.main-control-panel-wrapper').height();
        var p_w = jQuery('.main-content-wrapper').width();
        if(w_h > p_h)
        {
            jQuery('.main-control-panel-wrapper').css('height', w_h - 210);
            jQuery('.support-iframe').css('height', w_h - 210);  
        }
        jQuery('.support-iframe').css('width', p_w);  
    },
    init_file_upload: function(){
        'use strict';
        jQuery('.fileupload').fileupload({
            dataType: 'json',
            add: function(e, data) {
                var field = jQuery(this).attr('name')
                data.url = global_image_url + '&field=' + field;
                var jqXHR = data.submit()
                .success(function (result, textStatus, jqXHR) {
                    var responseObj =  jQuery.parseJSON( jqXHR.responseText );
                    var response = responseObj[Object.keys(responseObj)[0]];
                    if(typeof response[0].error !== "undefined")
                    {
                        admin.show_save_result({status: 'fail', msg: 'Image upload failed'});
                    }
                    else
                    {
                        var url = response[0].url;
                        var valueField = jQuery('#' + escapeJQuerySelector(field));
                        
                        valueField.val(url);
                        var filename = valueField.parents('.form-item').children('.filename');
                        if(filename.length > 0)
                        {
                            filename.html(''); //remove current content
                        }

                        var name_parts = url.split('/');
                        var name = name_parts[name_parts.length - 1];
                        
                        if(jQuery('.ad-items').length > 0) //if this is ads section
                        {
                            var ad_show = valueField.parents('.ad-item').find('.form-item.ad');
                            if(ad_show.length > 0)
                            {
                                if(ad_show.parents('form').length > 0 && ad_show.parents('form').attr('name') === '150x125')
                                {
                                    var id = valueField.attr('id');
                                    var number = parseInt(id.substring(id.length-6, id.length-5));
                                    ad_show.find('img').eq(number).attr('src', url);
                                    if(ad_show.is(':hidden'))
                                    {
                                        ad_show.fadeIn(500);
                                    }
                                }
                                else
                                {
                                    ad_show.find('img').eq(0).attr('src', url);
                                    if(ad_show.is(':hidden'))
                                    {
                                        ad_show.fadeIn(500);
                                    }   
                                }
                            }
                            
                            filename.html('<a href="' + url + '" target="_blank">' + decodeURIComponent(name) +'</a>');
                        }
                        else
                        {
                            filename.html('<a href="' + url + '" target="_blank">' + decodeURIComponent(name) +'</a>');
                        }
                    }
                    
                })
                .error(function (jqXHR, textStatus, errorThrown) {
                    admin.show_save_result({status: 'fail', msg: 'Image upload failed'});
                });
            }
        });
    },
    toggle_dependant_selects: function() {
        jQuery('.main-content select').each(function(){
            //find all data about the select that was changed
            var form = jQuery(this).parents('form');
            var name = jQuery(this).eq(0)[0].name;
            var value = jQuery(this).val();
                        
            admin.perform_toggle_dependant_selects(name, form, value);
        });
    },
    perform_toggle_dependant_selects: function(name, form, value) {

        var container = form;
        
        if(jQuery('.main-content').hasClass('view-ads_manager'))
        {
            container = jQuery('select[name=' + name + ']').parents('.ad-item');
            
            var form_name = form.attr('name');
        
            //for banner section
            if(name.search('__') > -1)
            {
                name = name.substring((form_name +'__').length) //remove prefix from item name (like "header_ad__")
            }

            //for banner section
            var divider = name.search('--');
            if(divider > -1)
            {
                name = name.substring(divider+2);
            }
        }
        
        //hide all of the dependats
        container.find('.depend_'+name ).fadeOut('fast').promise().done(function(){
            var selector = '.depend_' + name + '\\=\\[' + value + '\\]';
            container.find(selector).fadeIn('fast');
            admin.init_uniform();
            admin.init_drop_kick();
        }); 
    },
    show_save_result: function(msg) {
        if(msg.status === 'ok')
        {
            var element = jQuery('.save-message-1'); 
        }
        else
        {
            var element = jQuery('.error-message-1'); 
        }

        element.children('span').eq(0).html(msg.msg);

        element.slideDown(500);

        var timeout = setTimeout(admin.hide_save_result, 2000);

        element.children('.close').click(function() {
            window.clearTimeout(timeout);
            admin.hide_save_result();
            return false;
        });
    },
    hide_save_result: function()
    {
        jQuery('.save-message-1, .error-message-1').slideUp(500).promise().done(
        function(){
            jQuery('.section-save').slideUp(500);
            jQuery('.preset-save').slideUp(500);
        });
        
    },
    add_sidebar_option: function()
    {
        //get last item from sidebar list
        var item = jQuery('.sidebar-list li').last();
        var id = item.children('a').attr('id'); 
        var name = item.children('span').text();

        //add the item to select boxes    
        jQuery('#manage_sidebars select')
            .append(jQuery("<option></option>")
            .attr("value",id)
            .text(name));

        jQuery('.dk_options_inner')
            .append(jQuery('<li><a data-dk-dropdown-value="' + id + '">' + name + '</a></li>'));

    },
    remove_sidebar_option: function(id)
    {
        //remove item from select boxes
        jQuery('#manage_sidebars select').each(function() {
            if(jQuery(this).val() == id)
            {
                admin.dropkick_select_first(jQuery(this));
            }
        });
        
        jQuery('#manage_sidebars select option[value=' + id + ']').remove();
        jQuery('.dk_options_inner a[data-dk-dropdown-value=' + id + ']').remove();
    },
    init_disabled_add_items: function()
    {
        jQuery('.section-item.ad').find('.ad-item').each(function(){
            var checkbox = jQuery(this).find('input[type=checkbox]');
            admin.toggle_disabled_ad_item(checkbox);
        });

        jQuery('.section-item.ad').on('change', 'input[type=checkbox]', function(){
            admin.toggle_disabled_ad_item(jQuery(this));
        });
    },
    toggle_disabled_ad_item: function(obj)
    {
        var item = obj.parents('.ad-item');

        if (obj.is(':checked'))
        {
            item.removeClass('disabled');
            item.find('input, select').not('input[type=checkbox]').prop( "disabled", false );
        } 
        else
        {
            item.addClass('disabled');
            item.find('input, select').not('input[type=checkbox]').prop( "disabled", true );
        }
    },
    init_save_display: function()
    {
        jQuery('.main-control-panel-wrapper form:not([name=add-new]) :input').each(function() {
            var elem = jQuery(this);
            
            // Save current value of element
            elem.data('oldVal', elem.val());

            // Look for changes in the value
            elem.bind("propertychange change click keyup input paste", function(event){
                                                
                // If value has changed...
                if (elem.data('oldVal') != elem.val() || elem.attr('type') == 'checkbox')
                {
                    elem.data('oldVal', elem.val());
                    jQuery('.section-save').fadeIn(500);
                    admin.reset_preset_value();
                }
            });
        });
    },
    init_fixed_menu: function()
    {
        var sidebar_height = jQuery('.sidebar .logo').outerHeight(true) + jQuery('.sidebar .menu').outerHeight(true);
        
        if((jQuery(window).height()+33) > sidebar_height)
        {
            jQuery(document).scroll(function() {
                var scrollPosition = jQuery(document).scrollTop();
                var scrollReference = 110;
                if (scrollPosition >= scrollReference) {      
                    jQuery('.sidebar .menu').addClass('fixed');   
                } else {
                    jQuery('.sidebar .menu').removeClass('fixed');
                };
            });
        }
    },
    init_preset_save_close: function() 
    {
        jQuery('.preset-save .close').click(function(){
            
            admin.reset_preset_value();
            return false;
        });
    },
    reset_preset_value: function()
    {
        var preset_select = jQuery('#style_presets select');
        if(preset_select.length > 0)
        {   
            admin.dropkick_select_first(preset_select);
            jQuery('.preset-save').fadeOut(500);
        }
    },
    dropkick_select_first: function(item)
    {
        var first_val = item.find('option').first().val();
        var first_name = item.find('option').first().text();
        item.val(first_val);
        item.parent().find('.dk_label').text(first_name);
    }
};

function escapeJQuerySelector(str) 
{
    if (str)
        return str.replace(/([ #;?%&,.+*~\':"!^$[\]()=>|\/@])/g,'\\$1');      

    return str;
}