// Execute when the page finishes loading, DOM ready
// loading in footer
var tf_new_taxonomy_links = null;
jQuery(document).ready(function($)
{
    jQuery('#post-preview').click(function(){
        var delay=3000;//1 seconds
        setTimeout(function(){
            tfuse_autosave();
        },delay);

        return false;
    });
    // activate framework tabs
    {
        var tf_meta_tabs = $('.tf_meta_tabs');
        if (tf_meta_tabs.length) {
            tf_meta_tabs.tabs().show();
        }

        // add special class to wrappers that contains tfuse options, to be able to apply tfuse styles on it
        $('.postbox .inside .tf-interface-option:first-child').each(function(){
            $(this).closest('.postbox').addClass('tfuse-postbox');
        });

        setTimeout(function(){
            // others can hook into this event to make something after tabs loading finished
            TFE.trigger('tf-tabs-loading-finish');
        }, 100);

        $(".tf_load_meta_tabs").hide();
    }

    // innerdocs
    $("a[rel^='prettyPhoto']").prettyPhoto({
        social_tools:false
    });

    $('#install_btn').click(function(){
        $('.demoinstall, .skipinstall').hide();
        $('.install_loading').show();
    });

    /*********************************************************/

    // disable wpbody-content overflow:hidden
    if(tf_script!=undefined && tf_script.disable_wpbodycontent_overflow)
        $('#wpbody-content').css('overflow','');

    // for home boxes
    $('.how_to_populate .selector').live('change',function()
    {
        $(this).nextAll('span').css({
            display:'none'
        });
        $(this).nextAll('.selected_'+$(this).val()).css({
            display:'block'
        });
    });

    /*********************************************************/

    // News & Promo iframe loading
    $('#newspromo_iframe').load(function()
    {
        $(this).show();

    });

    /*********************************************************/

    $(window).scroll(function()
    {
        $('#tfuse-popup-save').center();
        $('#tfuse-popup-reset').center();
        $('#tfuse-popup-fail').center();
        $('#tfuse-ajax-loading-img').center();
    });

    /*********************************************************/

    // ajax save framework options
    tf_form_bind_ajax_submit(
        $('#tfuse_admin_options_form'),
        {
            action:     'tfuse_ajax_mojax',
            tf_action:  'ajax_admin_save_options'
        }
    );
    // Prepare tabs postboxes
    $('.tfuse_fields form .postbox').removeClass('if-js-closed').addClass('closed');
    $('.tfuse_fields form .tf_meta_tabs .ui-tabs-panel .postbox:first-child', this).removeClass('closed');


    /*********************************************************/

    //When adding a new taxonomy after it has been added with AJAX to the list, go to the edit page of the new taxonomy
    /*
     $('#submit').ajaxComplete(function(evt, request, settings) {
     if (settings.data.match(/action=add\-tag&screen=/gi)) {
     matches=request.responseText.match(/<a href="([^"]+)">Edit<\/a>/gi);
     if(matches[0]!=undefined)
     window.location.href=$(matches[0]).attr('href');
     }
     })*/

    /*
     * Add onchange event to all tfuse options
     */

    $('body').on('click','.option .tfuse-meta-radio-img-img',function(){
        optid=$(this).parents('.option').attr('option');
        old_val=opt_get(optid);
        new_val=$(this).attr('optval');
        opt_set(optid, new_val);
        if(old_val!=new_val)
            $('[name="'+optid+'"][value="'+new_val+'"]').change();
    });

    (function(){
        var init_hidden_children = function(element, hidden_children)
        {
            var first_time = true;
            element.click(function(){
                var open        = element.hasClass('children-hidden');
                var elements    = $( $.map(hidden_children, function(el){ return '.tf-interface-option.'+el; }).join(', ') );

                if (open) {
                    element.removeClass('children-hidden');
                    (first_time ? elements.show() : elements.slideDown());
                } else {
                    element.addClass('children-hidden');
                    (first_time ? elements.hide() : elements.slideUp());
                }
                first_time = false;
            }).trigger('click');
        };

        $('div.tf-interface-option[tf_hidden_children]').each(function()
        {
            try {
                var hidden_children = $.parseJSON( $(this).attr('tf_hidden_children') );
                if (!hidden_children.length) {
                    return;
                }
            } catch (e) {
                console.log ( 'error parsing "tf_hidden_children" attribute on element with class="'+$(this).attr('class')+'"' );
                return;
            }
            init_hidden_children($('.tf-interface-hidden-children', this).first(), hidden_children);
        });
    })();
    
    $('body').on('click', '.tf_checkbox_switch:not(.disabled)', function(){
        var $this = $(this);

        $this.toggleClass('on');

        // "destruct" hidden(default) input above checbox if is checked, because on form serialize to not contain double values [val1,val2]...
        var helement = $("input.checkbox_default_hidden_value", $this.parent());
        if ( helement.length ) {
            if ( (helement.attr('name') !== undefined) && helement.attr('name').length ) {
                helement.attr('hiddenname', helement.attr('name'));
                helement.removeAttr('name');
            } else {
                helement.attr('name', helement.attr('hiddenname'));
                helement.removeAttr('hiddenname');
            }
        }

        var $checkbox   = $this.parent().find('input[type="checkbox"]:last');
        var needChecked = $this.hasClass('on');
        var isIE        = Boolean(document.body.attachEvent);

        if (false) { // fixme: in some IE (newer) version this makes infinite loop
            if (isIE && $checkbox && $checkbox.prop('checked') != needChecked) {
                // in IE click on label does not change checkbox, so do it manually
                $checkbox.prop('checked', needChecked);
                $checkbox.trigger('change');
            }
        }
    });
    tf_optionize();

    $('body').on('change', 'select.tfuse_option.tf_typography_unit', function(){
       if(jQuery(this).val() == 'px'){
           jQuery(this).prev().css('display', 'none');
           jQuery(this).prev().prev().css('display', 'inline-block');
       }else{
           jQuery(this).prev().prev().css('display', 'none');
           jQuery(this).prev().css('display', 'inline-block');
       }
    });
});

function tfuse_autosave()
{
    var tempform = jQuery('form#post');
    var form = tempform.clone();
    var post_ID = form.children('#post_ID').val();
    form.attr('action', 'autosave_post_options');

    var fields = '';
    form.find('[name^=' + tf_script.TF_THEME_PREFIX + ']').each(function()
    {
        fields += jQuery(this).attr('name') + '=' + jQuery(this).val() + '&';
    });

    jQuery.ajax({
        url:ajaxurl,
        type:'post',
        dataType:'json',
        data:'request_owner=tfuse&post_ID=' + post_ID + "&" + fields + 'action=autosave_post_options',
        success: function(response)
        {

        },
        error: function(error)
        {

        }

    });
}

function showLoading() {
    jQuery('#tfuse-ajax-loading-img').fadeIn().center();
}

function hideLoading() {
    jQuery('#tfuse-ajax-loading-img').fadeOut('fast');
}

function showFinishedLoading() {
    var success_msg = jQuery('#tfuse-popup-save' );
    hideLoading();
    success_msg.fadeIn().center();
    window.setTimeout(function(){
        success_msg.fadeOut();
    }, 2000);
}

function showFailLoading() {
    var warning_msg = jQuery('#tfuse-popup-fail' );
    hideLoading();
    warning_msg.fadeIn().center();
    window.setTimeout(function(){
        warning_msg.fadeOut();
    }, 2000);
}

function opt_get(optid,context) {
    var $=jQuery;
    if(context==undefined)
        context=$('body');
    var out='';
    if($('[name="'+optid+'"]',context).length>0) {
        $obj=$('[name="'+optid+'"]',context);
        if($obj.is('input[type="radio"]')) {
            out=$obj.filter(':checked').val();
            if(out==undefined)
                out='';
            return out;
        }
        else if($obj.is('input[type="checkbox"]')) {
                out = ($obj.next('label[for="' + optid + '"]').hasClass('on')) ? 'true' : 'false';
                return out;
        }
        out=$obj.val();
        if(out==undefined)
            out='';
    }
    else if($('[name="'+optid+'[]"]',context).length>0) {
        out=[];
        $('[name="'+optid+'[]"]',context).each(function(){
            val=$(this).val();
            if(val==undefined)
                val='';
            out.push(val);
        });
    }
    return out;
}

function opt_set(optid,val) {
    var $ = jQuery;
    if( $('[name="'+optid+'"]').length>0 ) {
        $obj = $('[name="'+optid+'"]');
        if( $obj.is('input[type="radio"]') ) {
            $obj.filter('[value="'+val+'"]').prop("checked", true).trigger('change');
            curr = $obj.filter(':checked');
            curr.parents('.formcontainer').find('.thumb_radio_over').removeClass('tfuse-meta-radio-img-selected');
            curr.parents('.tfuse-meta-radio-img-box').find('.thumb_radio_over').addClass('tfuse-meta-radio-img-selected');
            return true;
        }

        $obj.val(val);

        if($obj.next().hasClass('tf_checkbox_switch')){
            var $label = $obj.next();
            if( (val == false) || (val == 'false')){
                $label.removeClass('on');
            }else{
                $label.addClass('on');
            }
        }

        if($obj.hasClass('tf-optigen-input-maps')){
            var coordinates = val.split(":");
            $obj.next('div').children('input[id="' + optid + '_x"]').val(coordinates[0]);
            $obj.next('div').next().children('input[id="' + optid + '_y"]').val(coordinates[1]);
        }
        if($obj.hasClass('tfuse_multi_upload2_input')){
           $obj.closest('.formcontainer').find('.multi_upload2_button_div:first').trigger('update-frontend');
        }
        if($obj.is(':hidden')==true)
            $obj.change();
    }
    else if($('[name="'+optid+'[]"]').length>0) {
        $('[name="'+optid+'[]"]').each(function(i){
            $(this).val(val[i]);
        });
    }
    return true;
}

function opt_reset(optid,context) {
    var $=jQuery;
    if(context==undefined)
        context=$('body');
    if($('[name="'+optid+'"]',context).length>0) {
        $obj=$('[name="'+optid+'"]',context);
        if($obj.is('input[type="radio"]')) {
            $('[name="'+optid+'"]').prop("checked",false).attr('checked',false).parents('.formcontainer').find('.thumb_radio_over').removeClass('tfuse-meta-radio-img-selected');
            return true;
        }
        $obj.val('');
    }
    else if($('[name="'+optid+'[]"]',context).length>0) {
        $('[name="'+optid+'[]"]',context).each(function(i){
            $(this).val('');
        });
    }
    return true;
}

// Fix bug with thickbox and jquery ui tabs
function killTheUnloadEvent(e)
{
    e.stopPropagation();
    e.stopImmediatePropagation();
    return false;
}

function tfuse_thumb_load (itemurl,el) {
    var $ = jQuery;
     $(el).html('<div class="thumb_over"></div><img src="'+itemurl+'" width="45" height="45" />').find('div.thumb_over').show();

    // BeautyTips
    $(el).bt({
        contentSelector: function(){
            return '<img src="'+itemurl+'" style="max-width:400px" />'
        },
        padding: '4px',
        positions: ['top','left'],
        fill: 'white',
        width: '400px',
        strokeStyle: '#e0e0e0',
        spikeLength: 10,
        strokeWidth: 1
    });

}

//this function prepares all custom inputs to work properly. Must be called when new options are added to the dom dynamically
function tf_optionize() {
    var $=jQuery;

    /**** Checkbox options ****/
    //$('div.option-checkbox input:checkbox:checked + .tf_checkbox_switch, tr.tfuse-tax-form-field input:checkbox:checked + .tf_checkbox_switch').addClass('on');
    /*$('.tf_checkbox_switch:not(.disabled)').each(function(){
        if($(this).prop('initialized')!==true) {
            $(this).prop('initialized',true);
            $(this).click(function() {
                $(this).toggleClass('on');

                // "destruct" hidden(default) input above checbox if is checked, because on form serialize to not contain double values [val1,val2]...
                var helement = $("input.checkbox_default_hidden_value", $(this).parent());
                if ( helement.length ) {
                    if ( (helement.attr('name') !== undefined) && helement.attr('name').length ) {
                        helement.attr('hiddenname', helement.attr('name'));
                        helement.attr('name', '');
                    } else {
                        helement.attr('name', helement.attr('hiddenname'));
                        helement.attr('hiddenname', '');
                    }
                }
            });
        }
    });*/

    /**** ColorPicker options ****/
    $('.tf_color_select').each(function(){
        if($(this).prop('initialized')!==true) {
            $(this).prop('initialized',true);
            $(this).ColorPicker({
                onSubmit: function(hsb, hex, rgb, el) {
                    $(el).val('#'+hex);
                    $(el).ColorPickerHide();
                },
                onBeforeShow: function () {
                    $(this).ColorPickerSetColor(this.value);
                },
                onChange: function (hsb, hex, rgb) {
                    $('.tf_color_selected').val('#'+hex).change();
                }
            });
            $(this).on('focus','.tf_color_select', function(){
                $('.tf_color_selected').removeClass('tf_color_selected');
                $(this).addClass('tf_color_selected');
            });
        }
    });

    /**** DatePicker options ****/
    $('.tf_date_select').each(function(){
        var formatd = ($(this).attr('rel'));
        $(this).datepicker({
            dateFormat : formatd
        });
    });

    /**** Radio Images options ****/
    $('img.tfuse-meta-radio-img-img').each(function(){
        if($(this).prop('initialized')!==true) {
            $(this).prop('initialized',true);
            $(this).click(function(){
                $(this).parents('div.formcontainer, tr.tfuse-tax-form-field').find('div.thumb_radio_over').removeClass('tfuse-meta-radio-img-selected');
                opt_set($(this).prevAll('.tfuse-meta-radio-img-label').find('input:radio').attr('name'),$(this).attr('optval'));
                $(this).prev('div.thumb_radio_over').addClass('tfuse-meta-radio-img-selected');
            });
        }
    });

    /**** Multi options ****/
    $('.tfuse_suggest_input').each(function(){
        if($(this).prop('initialized')!==true) {
            $(this).prop('initialized',true);
            $(this).one('focus',function() {
                var multiple_box    = $(this).parent('.multiple_box');
                var multiple_box_selected_titles = multiple_box.find('div.multiple_box_selected_titles');
                var li              = multiple_box_selected_titles.find('span:eq(0)');
                var input_id        = $(this).attr('id');
                var name            = $(this).attr('rel');
                var type            = ( $(this).hasClass('tfuse_taxonomy_type') ) ? 'taxonomy' : 'post';

                $('#'+input_id).suggest( 'admin-ajax.php?action=tfuse_get_suggest&type='+type+'&name='+name,
                {
                    resultsClass:   'tfuse_ac_results '+type+input_id,
                    selectClass:    'tfuse_ac_over',
                    matchClass:     'tfuse_ac_match',

                    onSelect: function()
                    {
                        var selected    = $('.tfuse_ac_results.'+type+input_id+' .tfuse_ac_over');
                        var sel_id      = selected.children('a').attr('rel');
                        var saved_val   = multiple_box.children('input:hidden');
                        var arrvals     = saved_val.val().split(',');

                        if ( $.inArray(sel_id, arrvals) == -1 && sel_id != 0 )
                        {
                            var new_li = li.clone().removeAttr('style');
                            new_li.find('a').attr('rel',sel_id);
                            new_li.append(selected.text());
                            new_li.appendTo( multiple_box_selected_titles );
                            new_vals=( saved_val.val() ) ? saved_val.val()+','+sel_id : sel_id;
                            old_vals=saved_val.val();
                            saved_val.val( new_vals );
                            if(new_vals!=old_vals)
                                saved_val.change();
                            $(this).val('');
                            //my custom addition
                            $('#'+input_id).trigger('onselect',[{
                                'value':sel_id
                            }]);
                        //end custom addition
                        }
                        else
                        {
                            $(this).blur().val('Already exists, try another ... ');
                        }
                    }
                });
            })
            .focus(function() {
                $(this).removeClass('tfuse_input_help_text').addClass('edit').val('');
            })
            .blur(function() {
                $(this).addClass('tfuse_input_help_text').removeClass('edit').val('Type here to search');
            });
            jQuery(document).ajaxSend(function(evt, request, settings) {
                if (settings.url.match(/admin-ajax.php\?action=tfuse_get_suggest/gi)) {
                    $('.tfuse_suggest_input.edit').addClass('tfuse_ac_loading');
                }
            });
            jQuery(document).ajaxComplete(function(evt, request, settings) {
                if (settings.url.match(/admin-ajax.php\?action=tfuse_get_suggest/gi)) {
                    $('.tfuse_suggest_input.edit').removeClass('tfuse_ac_loading');
                }
            });
        }
    });
    // also, do some stuff that must be done only once
    if(typeof tf_optionize.one_time=='undefined') {
        //adds functionality to the multi_items delete anchors
        $('body').on('click','a.remove_multi_items',function()
        {
            var multiple_box = $(this).parents('.multiple_box');
            var saved_val = multiple_box.children('input:hidden');
            var arrvals = saved_val.val().split(',');
            var id = $(this).attr('rel');
            arrvals = $.grep( arrvals, function(n,i)
            {
                return n != id;
            });
            var new_vals=arrvals.join(',');
            var old_vals=saved_val.val();
            saved_val.val( new_vals );
            if(new_vals!=old_vals)
                saved_val.change();
            $(this).parent('span').remove();
            return false;
        });
        //works out the upload buttons
        // Wordpress Media Upload
        var formfield,tab, media, formID, tfuse_title = '',button,no_tabs;
        $('.tf-interface-option .upload_button, .tfuse-tax-form-field .upload_button').live('click',function()
        {
            button = $(this);
            formfield = $(this).attr('id').replace('_button','');
            media = 'image';
            media = ($('#'+formfield).length > 0) ? $('#'+formfield).attr('rel') : media;
            formID = $(this).attr('rel');
            tab = $(this).attr('tab') || 'type' ;
            var change = !$(this).hasClass('sliders');

            $.ajax({
                url:ajaxurl,
                type:'post',
                dataType:'json',
                data:'action=change_gallery_id&post_id='+formID+'&input_id='+formfield+'&media='+media+'&change='+change,
                success:function(response){
                    formID = response.id;
                    button.attr('rel',formID);
                    no_tabs = (button.hasClass('multi_upload')) ? '&amp;no_tabs=1' : '' ;
                    if ( tfuse_title = $(this).parents('.option-inner').find('label').text() ) { }
                    else if ( tfuse_title = $(this).parents('.form-field').find('label').text() ) { }
                    tb_show ( tfuse_title, 'media-upload.php?post_id='+formID+'&amp;type='+media+'&amp;formfield='+formfield+'&amp;tab='+tab+no_tabs+'&amp;TB_iframe=1' );
                    $('#TB_window,#TB_overlay,#TB_HideSelect').one('unload',killTheUnloadEvent);
                    if (button.closest('.upload_button_div').find('.attachment_num').length)
                        var _content = $('#TB_window').find('iframe').contents();
                    no_tabs = no_tabs.replace('&amp;','&');
                    $($('#TB_window').find('iframe')).load(function(){
                        var _image_form = $(this).contents().find('#image-form');
                        _image_form.attr('action',_image_form.attr('action')+no_tabs);
                        var _gallery_form = $(this).contents().find('#gallery-form');
                        _gallery_form.attr('action',_gallery_form.attr('action')+no_tabs);
                    });

                    $("#TB_window").bind('tb_unload', function () {
                        var attachments  = $(this).find('iframe').contents().find('#attachments-count');
                        var _placeholder = button.closest('.upload_button_div');

                        if (attachments.length) {
                            _placeholder.find('.attachment_num').html(attachments.html());

                            if (button.hasClass('multi_upload'))
                                button.html(button.closest('.upload_button_div').attr('data-text-multiple'));

                            button.attr('tab','gallery');
                        } else {
                            _placeholder.find('.attachment_num').html(0);

                            if(button.hasClass('multi_upload'))
                                button.html(button.closest('.upload_button_div').attr('data-text-single'));

                            button.attr('tab','type');
                        }
                    });

                }
            });

            return false;
        });

        /**
         * WordPress Media Upload
         * multi_upload2 optigen
         */
        (function(){
            /** prepare loading */
            {
                var $loading = $('<div></div>');
                $loading.css({
                    position: 'fixed',
                    top: '0',
                    left: '0',
                    width: '100%',
                    height: '100%',
                    opacity: '0.5',
                    display: 'none',
                    'z-index': '1000',
                    background: '#FFFFFF'
                });

                var loadingInitialized = false;

                var loading = {
                    show: function(){
                        if (!loadingInitialized) {
                            // lazy init
                            $(document.body).prepend($loading);
                            loadingInitialized = true;
                        }

                        $loading.fadeIn();
                    },
                    hide: function(){
                        $loading.fadeOut();
                    }
                };
            }

            function jsonValIsEmpty(val) {
                return typeof val == 'undefined' || val.length < 3;
            }

            // Update texts depending on data
            $('.postbox .multi_upload2_button_div').on('update-frontend', function(){
                var $this       = $(this);
                var $button     = $this.find('.multi_upload2_button:first');
                var $input      = $this.parent().find('input[type="hidden"]:first');
                var $cr         = $this.find('.multi_upload2_clear_restore:first');
                var $clear      = $this.find('.multi_upload2_clear_restore .tf-cl:first');
                var $restore    = $this.find('.multi_upload2_clear_restore .tf-re:first');

                var val = $input.val();
                if (typeof val == 'undefined') {
                    val = '[]';
                }

                var attachments;
                try {
                    attachments = JSON.parse(val);
                } catch (e) {
                    console.log ('Failed to parse JSON');
                    attachments = [];
                }

                $clear.hide();
                $restore.hide();

                if (attachments.length) {
                    $this.find('.attachment_num').text(attachments.length);
                    $button.text($this.attr('data-text-multiple'));
                    $button.attr('tab','gallery');

                    $cr.removeAttr('data-restore');
                    $clear.show();
                } else {
                    $this.find('.attachment_num').text('0');
                    $button.text($this.attr('data-text-single'));
                    $button.attr('tab', 'type');

                    if (!jsonValIsEmpty($cr.attr('data-restore'))) {
                        $restore.show();
                    }
                }
            });

            /**
             * Init Clear/Restore functionality
             */
            $('.postbox .multi_upload2_button_div .multi_upload2_clear_restore').each(function(){
                var $this    = $(this);
                var $clear   = $this.find('.tf-cl:first');
                var $restore = $this.find('.tf-re:first');
                var $input   = $this.closest('.multi_upload2_button_div').parent().find('input[type="hidden"]:first');

                // clear button/link
                $clear.on('click', function(e){
                    e.preventDefault();

                    var val = $input.val();

                    $clear.hide();

                    if (jsonValIsEmpty(val)) {
                        // empty // "" or "[]"
                        $this.removeAttr('data-restore');
                    } else {
                        // has data
                        $this.attr('data-restore', val);
                        $input.val('[]');
                        $restore.show();
                    }

                    $this.closest('.multi_upload2_button_div').trigger('update-frontend');
                });

                // restore button/link
                $restore.on('click', function(e){
                    e.preventDefault();

                    var val = $input.val();

                    $restore.hide();

                    if (jsonValIsEmpty(val)) {
                        // empty // "" or "[]"
                        var restoreVal = $this.attr('data-restore');
                        $this.removeAttr('data-restore');

                        if (jsonValIsEmpty(restoreVal)) {
                            // restore is empty
                        } else {
                            // has data to restore
                            $input.val(restoreVal);
                            $clear.show();
                        }
                    } else {
                        // has data
                        $this.removeAttr('data-restore');
                        $clear.show();
                    }

                    $this.closest('.multi_upload2_button_div').trigger('update-frontend');
                });

                $this.closest('.multi_upload2_button_div').trigger('update-frontend');
            });

            /**
             * Attach delegated click on every postbox (metabox)
             */
            $('.postbox').on('click', '.multi_upload2_button', function(){
                var $button = $(this);
                var inputId = $button.attr('data-id');
                var tab     = $button.attr('data-tab') || 'type' ;
                var title;
                var $hidden = $button.closest('.tf-interface-option').find('input[type="hidden"]:first');
                var eventsNamespace = '.tfuse_multi_upload2';

                title = (title = $button.closest('.option-inner').find('label').text())
                    ? title
                    : ((title = $button.parents('.form-field').find('label').text())
                        ? title
                        : 'Upload Images');

                loading.show();

                $.ajax({
                    url: ajaxurl,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        action: 'multi_upload2_get_temp_gallery_post_id',
                        value: $hidden.val()
                    },
                    success: function(r){
                        if (!r.status) {
                            loading.hide();
                            console.log ('[Error]', r);
                            alert ('Error');
                            return;
                        }

                        var postId = r.post_id;

                        tb_show(title, 'media-upload.php?'+
                            ['post_id='+postId, 'type=image', 'formfield='+inputId, 'tab='+tab, 'TB_iframe=1'].join('&amp;')
                        );

                        loading.hide();

                        $('#TB_window,#TB_overlay,#TB_HideSelect').one('unload', killTheUnloadEvent);

                        $("#TB_window").on('tb_unload'+ eventsNamespace, function(){
                            var $this = $(this);

                            $this.off(eventsNamespace);
                            $('#TB_window,#TB_overlay,#TB_HideSelect').off(eventsNamespace);

                            loading.show();

                            $.ajax({
                                url: ajaxurl,
                                type: 'post',
                                dataType: 'json',
                                data: {
                                    action: 'multi_upload2_get_temp_gallery_attachments',
                                    post_id: postId
                                },
                                success: function(r){
                                    if (!r.status) {
                                        loading.hide();
                                        console.log ('[Error]', r);
                                        alert ('Error');
                                        return;
                                    }

                                    var attachments = r.attachments;

                                    $hidden.val(JSON.stringify(attachments));

                                    loading.hide();

                                    $button.closest('.multi_upload2_button_div').trigger('update-frontend');
                                },
                                error: function(){
                                    loading.hide();
                                    console.log ('[Ajax Error]');
                                    alert ('Ajax Error');
                                }
                            });
                        });
                    },
                    error: function(){
                        loading.hide();
                        console.log ('[Ajax Error]');
                        alert('Ajax Error');
                    }
                });

                return false;
            });
        })();

        window.original_send_to_editor = window.send_to_editor;
        window.send_to_editor = function(html)
        {
            if (formfield && !((/^\[/).test(html)) )
            {
                var itemurl,el, type = 'image';
                if ( typeof $(html).attr('src') != 'undefined' )
                {
                    itemurl = $(html).attr('src');
                }
                else if ( $(html).html(html).find('img').length > 0 )
                {
                    //var fullimg = $(html).attr('href');
                    itemurl = $('img',html).attr('src');
                } else  { itemurl = $(html).attr('href'); type = 'file'; }

                if (typeof itemurl != 'undefined' && media == 'image' && type == 'image')
                {
                    var upload_el_metabox = $('#'+formfield).parents('div.option-upload').find('div.uploaded_thumb');
                    var upload_el_taxonomy = $('#'+formfield).parents('tr').find('div.uploaded_thumb');
                    if( upload_el_metabox.length > 0 ) {
                        el = upload_el_metabox;
                    }
                    else if ( upload_el_taxonomy.length > 0 ) {
                        el = upload_el_taxonomy;
                    }

                    tfuse_thumb_load (itemurl,el);
                    $obj=$('input[name="'+formfield+'"]');
                    curr_value=$obj.val();
                    $obj.val(itemurl);
                    if(curr_value!=itemurl)
                        $obj.change();
                } else if (typeof itemurl != 'undefined' && media == 'file')
                {
                    $obj=$('input[name="'+formfield+'"]');
                    curr_value=$obj.val();
                    $obj.val(itemurl);
                    if(curr_value!=itemurl)
                        $obj.change();
                }

                tb_remove();
            }
            else
            {
                window.original_send_to_editor(html);
            }
            formfield = itemurl = el = '';
        };

        //initialize the thumbs loaded with the page
        $('div.uploaded_thumb[rel]').each(function()
        {
            tfuse_thumb_load ($(this).attr('rel'),$(this));
        });
        tf_optionize.one_time=true;
    }
}
