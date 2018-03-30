var tf_last_editable_slide=null;
var curropts;
var has_changes=false;

jQuery(document).ready(function($) {
    //add slide button must appear only on the setup slide tab
    if(tf_script.slider_type=='custom')
        $('.frame_box_buttons').show().appendTo('#add-new-slide .inside');

    if(tf_script.slider_type!=undefined) {
        curropts=tf_script.saveable_options[tf_script.slider_type];
    }

    if(tf_script.slider_title_tmp!=undefined && !$('#slider_title').val()) {
        $('#slider_title').val(tf_script.slider_title_tmp);
        has_changes=true;
    }

    if($('#slider_uniqid').val()!='' && $('#slider_uniqid').val()!=undefined) {
        set_slider_tab_title(format_slider_title(tf_script.general.slider_title));
        for(var i in tf_script.slides) {
            slide_settings=tf_script.slides[i];
            for(prop in slide_settings) {
                opt_set(prop, (typeof slide_settings[prop] === 'object') ? JSON.stringify(slide_settings[prop]) : slide_settings[prop]);
            }
            add_slide();
        }
    }

    if(tf_script.slider_title_tmp!=undefined) {
        set_slider_tab_title(format_slider_title(tf_script.slider_title_tmp));
    }

    $('#slider_title').keyup(function(){
        set_slider_tab_title(format_slider_title($(this).val()));
    });

    function set_slider_tab_title(title) {
        $('#tfusetabheader-slider_settings a').html(title);
    }

    function format_slider_title(title) {
        if(title.length>40)
            return (title.substring(0, 40)+'... Sider Settings');
        return (title + (tf_script.tf_ext_slide_custom_title_js !== undefined ? ' '+tf_script.tf_ext_slide_custom_title_js : ' Slider Settings'));
    }

    function tf_update_slide_img($obj) {
        extra=tf_script.slider_settings.extra;
        if(extra!=undefined && extra.custom!=undefined && (extra.custom.slide_src!=undefined || extra.custom.slide_media!=undefined)) {
            src=((extra.custom.slide_media!=undefined && $('#'+extra.custom.slide_media).length>0 && opt_get(extra.custom.slide_media)!='')?opt_get(extra.custom.slide_media):opt_get(extra.custom.slide_src));
            if(src!='') {
                var image_ext=['jpeg','jpg','png','gif','bmp','tiff'];
                if(-1==$.inArray(src.split('.').pop().toLowerCase(),image_ext)) {
                    $obj.find('img').attr('src',tf_script.media_image).attr('preview',tf_script.media_image);
                }
                else
                    $obj.find('img').attr('src',src).attr('preview',src);
            }
            else {
                $obj.find('img').hide();
            }
        }
    }

    function add_slide(user_triggered) {
        slide_settings={};
        for(var prop in tf_script.slide_ids) {
            $curr_obj=$('#'+tf_script.slide_ids[prop]);
            slide_settings[tf_script.slide_ids[prop]]=opt_get(tf_script.slide_ids[prop]);
            if($curr_obj.attr('required') && opt_get(tf_script.slide_ids[prop])=='') {
                if(can_skip_reddit($curr_obj)==true)
                    continue;
                return $curr_obj.reddit();
            }
        }
        $('#slider_frames').append($('#slide_image_framebox').html());
        obj=$('#slider_frames .image_frame:last');
        obj.data('settings',slide_settings);
        tf_update_slide_img(obj);
        clear_slider_fields();
        return true;
    }

    $('#add_slide').live('click',function(){
        add_slide(true);
    });

    function can_skip_reddit($curr_obj) {
        extra=tf_script.slider_settings.extra;
        if(extra!=undefined && extra.custom!=undefined) {
            if(extra.custom.slide_media!=undefined && $curr_obj.attr('id')==extra.custom.slide_media && extra.custom.slide_src!=undefined && opt_get(extra.custom.slide_src)!='')
                return true;
            if(extra.custom.slide_src!=undefined && $curr_obj.attr('id')==extra.custom.slide_src && extra.custom.slide_media!=undefined && opt_get(extra.custom.slide_media)!='')
                return true;
        }
        return false;
    }

    function clear_slider_fields() {
        for(var prop in tf_script.slide_ids) {
            opt_set(tf_script.slide_ids[prop],'');
        }
    }

    $('.image_frame').live('click',function(){
        if(tf_last_editable_slide!=null)
            $('#cancel_changes_slide').click();
        $('#add-new-slide .hndle span').html('Edit Slide Details');
        $(this).find('.active_edit').show();
        settings=$(this).data('settings');
        tf_last_editable_slide=$(this);
        for(var i in settings) {
            opt_set(i,settings[i]);
        }
        $('#add_slide').hide();
        $('#save_changes_slide').show();
        $('#cancel_changes_slide').show();
    });

    $('#save_changes_slide').live('click',function(){
        slide_settings={};
        for(var prop in tf_script.slide_ids) {
            if($('#'+tf_script.slide_ids[prop]).attr('required') && opt_get(tf_script.slide_ids[prop])=='') {
                if(can_skip_reddit($('#'+tf_script.slide_ids[prop]))==true)
                    continue;
                $('#'+tf_script.slide_ids[prop]).reddit();
                return false;
            }
            slide_settings[tf_script.slide_ids[prop]]=opt_get(tf_script.slide_ids[prop]);
        }
        tf_last_editable_slide.data('settings',slide_settings);
        tf_update_slide_img(tf_last_editable_slide);
        $('#cancel_changes_slide').click();
    });

    $('#cancel_changes_slide').live('click',function(){
        $('#add-new-slide .hndle span').html('Add New Slide');
        tf_last_editable_slide.find('.active_edit').hide();
        $('#add_slide').show();
        $('#save_changes_slide').hide();
        $('#cancel_changes_slide').hide();
        tf_last_editable_slide=null;
        clear_slider_fields();
    });

    $('.remove_frame').live('click',function(){
        if(!confirm('Are you sure you want to delete the selected image?'))
            return false;
        $(this).parents('li').remove();
        return false;
        clear_slider_fields();
        has_changes=true;
    });

    if($('#slider_frames'))
        $('#slider_frames').sortable();

    $('#save_slider').live('click',function(){
        if($('#slider_title').val()==undefined || $('#slider_title').val()=='') {
            alert('Slider title not set. Slider must have title.');
            return;
        }
        var settings_db={};
        settings_db.general={};
        settings_db.slides={};
        for(var prop in curropts) {
            curr=$('#'+curropts[prop]);
            if(curr.attr('type')=='checkbox' || curr.attr('type')=='radio')
                if(curr.attr('checked')==undefined)
                    continue;
            settings_db.general[curropts[prop]]=opt_get(curropts[prop]);
        }
        $('#slider_frames .image_frame').each(function(i){
            settings_db.slides[i]=$(this).data('settings');
        });
        showLoading();
        $.post(ajaxurl,{
            action:'tfuse_ajax_slider',
            tf_action: 'tfuse_ajax_slider_save',
            options: JSON.stringify(settings_db),
            slider_uniqid:$('#slider_uniqid').val(),
            slider_design:$('#slider_design').val(),
            slider_type:$('#slider_type').val(),
            _ajax_nonce: tf_script.tf_slider_save
        },function(data){
            if(data.status==1) {
                has_changes=false;
                showFinishedLoading();
                $('#slider_uniqid').val(data.id);
            }
            else if(data.status==-1) {
                alert(data.message);
                showFailLoading();
            }
        },'json');
    });

    $('#cancel_slider').click(function(){
        has_changes=false;
        window.location.href='admin.php?page=tf_slider_list';
    });

    $('.delete_selected_sliders').click(function(){
        if(!confirm('Are you sure you want to delete selected items?'))
            return;
        var items=new Array;
        $('.checkbox_delete_slider:checked').each(function(i){
            items[i]=$(this).val();
        });
        delete_sliders(items);
    });

    function delete_sliders(items) {
        $.post(ajaxurl,{
            action:'tfuse_ajax_slider',
            tf_action: 'tfuse_ajax_delete_sliders',
            items: JSON.stringify(items),
            _ajax_nonce: $('#tfuse_nonce_slider_delete').val()
        },function(data){
            if(data.status==1)
                window.location.reload();
        },'json');
    }

    $('.tf_delete_slider').live('click',function(){
        if(!confirm('Are you sure you want to delete this item?'))
            return;
        var items=[];
        items[0]=$(this).attr('rel');
        delete_sliders(items);
        return false;
    });

    if($('.checkbox_delete_slider')) {
        $('.checkbox_delete_slider').each(function(){
            $(this).attr('checked',false);
        });
    }

    function return_proper_bt(obj) {
        if(obj.parents('#slider_frames').length>0) {
            return $('#slider_frames');
        }
        else
            return null;
    }
    $('.slider_image_preview').each(function(){
        curr_obj=$(this);
        $(this).bt({
            contentSelector: function(){
                return '<img src="'+$(this).attr('preview')+'" style="max-width:400px" />'
            },
            padding: '4px',
            positions: ['top','bottom'],
            fill: 'white',
            width: '400px',
            strokeStyle: '#e0e0e0',
            spikeLength: 10,
            strokeWidth: 1,
            offsetParent:return_proper_bt(curr_obj)
        });
    });

    $( "#slider_frames" ).bind( "sortstart", function(event, ui) {
        $(this).find('.image_frame img').btOff();
        has_changes=true;
    });
    // switch to tab
    if(tf_script.switch_to_tab)
        setTimeout(function(){
            $('.tf_meta_tabs').tabs('option','active',tf_script.switch_to_tab);
        }, 12);
    if(tf_script && tf_script.current_page && tf_script.current_page=='slider') {
        // prevent user leaving page if changes have been made to slider
        $('.tf_meta_tabs *').change(function(){
            has_changes=true
        });
        $(window).bind('beforeunload', function(){
            if(has_changes==true)
                return 'You are about to leave the page without saving the changes.'
        });
    }
});