var inhibit_subtype_auto_default,dont_do_default=false,inhibit_templates_auto_default=false;
var current_save_state=0,doing_auto_load=false;
var sdb_has_changes=false,last_auto_load_ids=null;
var _unsaved_message='You are about to leave the page without saving the changes.';
jQuery(document).ready(function(){
    var $=jQuery;
    for(i=0;i<tf_script.dynamic_sidebar_ids.length;i++)
    {
        if($('#'+tf_script.dynamic_sidebar_ids[i]).prev('.sidebar-name').length==0)
            $('#'+tf_script.dynamic_sidebar_ids[i]).find('.sidebar-name').find('.sidebar-name-arrow').after($('#multi_delete_icon').html());
        else
            $('#'+tf_script.dynamic_sidebar_ids[i]).prev('.sidebar-name').find('.sidebar-name-arrow').after($('#multi_delete_icon').html());
    }
    if(tf_script.tab_switch!=undefined) {
        setTimeout(function()
        {
            $('.tf_meta_tabs').tabs('option','active',parseInt(tf_script.tab_switch));
        }, 12);
    }
    tmp=$('#add_new_sidebar_mask').html();
    $('#add_new_sidebar_mask').html('');
    $('#show_more_opts').hide();
    $('#widgets-right .widgets-holder-wrap:last').after(tmp);
    //append settings after last sidebar from wordpress
    $('#tfuse_fields').prependTo('#widgets-left');
    $('#widgets-right .sidebar-name .sidebar-name-arrow').after($('#add_to_placeholder_mask').html());
    
    $('#add_new_sidebar_name').live('keyup',function(event){
        if(event.keyCode == 13){
            $(this).next('input[type="button"]').click();
        }
    });
    
    $('#add_new_sidebar_submit').live('click',function(){
        $.post(ajaxurl,{
            sidebar_name:$('#add_new_sidebar_name').val(),
            tf_action:'tfuse_ajax_sidebar_save_new',
            action:'tfuse_ajax_sidebars',
            _ajax_nonce:tf_script.tf_nonce_sidebars
        },function(data){
            if(data.status!=undefined && data.status==1)
                window.location.reload();
            else if(data.message!=undefined)
                alert(data.message); 
        },'json');
    });    
    
    $('.add_to_placeholder').click(function(){
        doing_auto_load=false;
        this_name=$(this).siblings('h3').text();
        this_sdb_id=$(this).parents('.sidebar-name').next('.widgets-sortables').attr('id');
        if(this_sdb_id===undefined){
            this_sdb_id=$(this).parents('.widgets-sortables').attr('id');
        }
        add_to_placeholder($('.sidebars_placeholder_container.selected'), this_name, this_sdb_id);
        return false;
    });
    
    $('.sidebar_delete_button').click(function(){
        if(!confirm('Are you sure you want to delete this sidebar?'))
            return false;
        this_sdb_id=$(this).parents('.sidebar-name').siblings('.widgets-sortables').attr('id');
        if(this_sdb_id===undefined)
            this_sdb_id=$(this).parents('.widgets-sortables').attr('id');

        $.post(ajaxurl,{
            sidebar_id:this_sdb_id,
            tf_action:'tfuse_ajax_sidebar_delete',
            action:'tfuse_ajax_sidebars',
            _ajax_nonce:tf_script.tf_nonce_sidebars
        },function(data){
            if(data.status!=undefined && data.status==1)
                window.location.reload();
        },'json');
        return false;
    });
    
    $('#extra_select').parents('.option').nextAll('.option').hide();
    $('.sidebars_placeholder_container').parents('.formcontainer').find('*').css('vertical-align','top');
    
    $('#extra_select').live('change',function(){
        $('#show_more_opts').hide();
        if($(this).find('option:selected').hasClass('has_id')) {
            $('#show_more_opts').show();
        }
        $(this).parents('.option').nextAll('.option').find('select').val('');
        reset_inputs();
        $(this).parents('.option').nextAll('.option').hide();
        $('.sidebars_subtype').hide().removeClass('is_now_visible');
        $('.multi_options').hide();
        reset_placeholders();
        obj_id=$(this).val();
        if(obj_id=='') {
            do_add_tab();
            return;       
        }
        $('.sidebars_subtype').hide();
        $('.sidebars_choose_subtype').hide();
        $('.sidebar_box_'+obj_id).show().addClass('is_now_visible');
        if(inhibit_subtype_auto_default==true) 
            inhibit_subtype_auto_default=false;
        else
            $('.sidebars_subtype.is_now_visible').val('default_'+$(this).val()).change();
        do_add_tab();
    });
    
    $('.sidebars_subtype').change(function(){
        show_cancel_changes();
        $(this).parents('.option').nextAll('.option').hide();
        $('.multi_options').hide();
        val=$(this).val();
        if(val=='')
            return;
        $('.multi_'+val).show().parents('.option').show();
        $('.sidebars_positions_'+$(this).attr('placeholders')).show();
        $('.sidebars_placeholders_'+$(this).attr('placeholders')).show();
        do_add_tab();
        reset_positions();
        reset_placeholders();
        reset_inputs();
        select_first_position();
        select_first_placeholder();
        if($(this).val().substr(0,8)=='default_') {
            prefill_placeholders($(this).val(), 0);
        }
    });
    
    $('.sidebars_placeholder_container').live('click',function(){
        if(!deselect_placeholder($(this)))
            return;
        select_placeholder($(this));        
        show_add_to_placeholder();
    });
    
    $('.sidebars_placeholder_box li .delete').live('click',function(){
        obj_ul=$(this).parents('.sidebars_placeholder_box');
        $(this).parents('li').remove();
        if(obj_ul.find('li').length<1)
            obj_ul.siblings('img:first').hide().next('img').show();
        sdb_changes_on();
        return false;
    });
    
    $('.sdb_ph_table tr').hover(function(){
        $(this).find('.sidebar_settings_delete').show();
    },function(){
        $(this).find('.sidebar_settings_delete').hide();
    });
    
    $('.sidebars_choose_multi input[type="hidden"]').next('input').bind('onselect',function(event,value){
        if(current_save_state==1)
            prefill_placeholders($('.sidebars_subtype:visible').val(),$(this).prev('input[type="hidden"]').val());
    });
    
    //    $('#sidebar_multi_select_templates').change(function(){
    //        if(inhibit_templates_auto_default) {
    //            inhibit_templates_auto_default=false;
    //            return;
    //        }
    //        if($(this).val()!='')
    //            prefill_placeholders($('.sidebars_subtype.is_now_visible').val(), $(this).val());
    //    });
        
    $('#sidebars_cancel_changes').click(function(){
        $('#extra_select').val('').change();
        return false;
    });
    
    $('#show_more_opts').click(function(){
        $('.sidebars_choose_subtype').show();
        return false;
    });
    
    $('#sidebars_add_sidebar').click(function(){
        verif=null;
        type=$('.sidebars_subtype.is_now_visible').val();
        if(!type || type=='') {
            alert('You have not chosen a subtype.');
            return false;
        }
        sdb_changes_off();
        data={};
        data.sidebars=get_sidebars();
        data.position= opt_get('sidebars_positions_'+$('.sidebars_subtype.is_now_visible').attr('placeholders'));
        if(last_auto_load_ids && last_auto_load_ids!=null) {
            data.last_ids=last_auto_load_ids;
        }
        if(!data.position) {
            alert('You have not chosen the sidebars position.');
            return false;
        }
        if($('div.multiple_box:visible').length==1) {
            data.opt_val=$('div.multiple_box:visible').find('input[type="hidden"]').val();
            verif=true;
        }
        
        if(verif==true && data.opt_val=='') {
            alert('Missing ID. Check that you provided all mandatory data.');
            return false;
        }
        showLoading();
        $.post(ajaxurl,{
            action:'tfuse_ajax_sidebars',
            tf_action:'tfuse_ajax_sidebars_save',
            data:JSON.stringify(data),
            type:type
        },function(data){
            showFinishedLoading();
            setTimeout(function(){
                window.location.href=tf_script.widgets_url+'?tab_switch=1';
            }, 1000);
        },'json');
        return false;
    });
    
    $('.sidebar_settings_delete').click(function(){
        parent=$(this).parents('tr');
        data=$(this).attr('rel');
        showLoading();
        $.post(ajaxurl, {
            action:'tfuse_ajax_sidebars',
            tf_action:'tfuse_ajax_sidebars_delete_settings',
            data:data
        },function(data){
            hideLoading();
            if(data.status!=undefined && data.status==1) {
                if(parent.find('td').length==1)
                    parent.fadeOut(2000,function(){
                        parent.remove();
                    });
                else {
                    img_obj=parent.find('.sidebar_is_set');
                    img_obj.attr('class','sidebar_not_set').attr('src',img_obj.attr('src').replace('sidebar_set', 'sidebar_not_set'))
                }
            }
        },'json');
        return false;
    });
    
    $('.auto_select').click(function(){
        $('.tf_meta_tabs').tabs('option', 'active', 0);
        unsplit_vals=$(this).attr('rel');
        vals=$(this).attr('rel').split('+');
        doing_auto_load=true;
        inhibit_subtype_auto_default=true;
        //inhibit_templates_auto_default=true;
        if(vals.length>0) {
            $('#extra_select').val(vals[0]).change();
        }
        if(vals.length>1) {
            $('.sidebars_subtype.is_now_visible').val(vals[1]).change();
        }
        if(vals.length>2) {
            curr_obj=$(this);
            if($('#tfusetab-sidebar_new_settings .multi_options select:visible').length>0) {
                $('#tfusetab-sidebar_new_settings .multi_options select:visible').val(vals[2]).change();
            }
            else if($('#tfusetab-sidebar_new_settings .multiple_box:visible').length>0) {
                $obj=$('#tfusetab-sidebar_new_settings .multiple_box:visible');
                $obj.find('input[type="hidden"]').val(vals[2]);
                $obj=$obj.find('div.tagchecklist');
                str=vals[2];
                vals_ids=str.split(',');
                for(var i in vals_ids) {
                    $obj.find('span:hidden').clone().appendTo($obj).show().find('a').attr('rel',vals_ids[i]).parent('span').append(tf_script.sidebars_saved_names[unsplit_vals][vals_ids[i]]);
                }
            }
        }
        if(vals[1]!=undefined && vals[1].substr(0,8)=='default_') {
        //nothing
        }
        else
            prefill_placeholders($('#tfusetab-sidebar_new_settings .sidebars_subtype.is_now_visible').val(), vals[2]);
        if(vals[2]) {
            last_auto_load_ids=vals[2];
        }
        return false;
    });
    
    $('.sidebars_placeholder_box').sortable().disableSelection();
    
    if(tf_script && tf_script.current_page && tf_script.current_page=='widgets') {
        $('.tf_meta_tabs').tabs({
            show:function(event,ui){
                if(ui.index==1) {
                    do_add_tab();
                    $('#extra_select').val('').change();
                    hide_add_to_placeholder();
                }
            }
        });
        $('#tfuse_fields .sidebar-name').live('click',function(){
            if($(this).parents('#tfuse_fields').hasClass('closed')) {
                $(this).parents('#tfuse_fields').removeClass('closed');
                return;
            }
            $(this).parents('#tfuse_fields').addClass('closed');
        });
        // prevent user leaving page if changes have been made to slider
        $('#tfusetab-sidebar_new_settings .tfuse-meta-radio-img-img').click(function(){
            sdb_changes_on();
        });
        $('#tfusetab-sidebar_new_settings').on('mousedown','#extra_select',function(event){
            if(sdb_has_changes==true) {
                if(!confirm(_unsaved_message)) {
                    event.preventDefault();
                    return false;
                }
                sdb_changes_off();    
            }
        });
        $('#tfusetab-sidebar_new_settings').on('mousedown','.sidebars_subtype',function(event){
            if(sdb_has_changes==true) {
                if(!confirm(_unsaved_message)) {
                    event.preventDefault();
                    return false;
                }
                sdb_changes_off();    
            }
        });
                
        $('.sidebars_placeholder_box').live('sortstart',function(){
            if($(this).is(':visible'))
                sdb_changes_on();
        });
        $(window).bind('beforeunload', function(){ 
            if(sdb_has_changes==true)
                return _unsaved_message;
        });
    }

});

function get_sidebars() {
    var $ = jQuery;
    var data={};
    $('.sidebars_placeholder_container:visible').each(function(i){
        data[i]=[];
        $(this).find('.sidebars_placeholder_box li').each(function(ii){
            data[i].push($(this).attr('rel'));
        });
    });
    return data;
}

function prefill_placeholders(type,id) {
    var $ = jQuery;
    reset_positions();
    reset_placeholders();
    showLoading();
    $.post(ajaxurl, {
        action:'tfuse_ajax_sidebars',
        tf_action:'tfuse_ajax_sidebars_get',
        data: {
            'id':id
        },
        type:type
    },function(data){
        hideLoading();
        if(data.position!=undefined) {
            $parr=$('#tfusetab-sidebar_new_settings').find('.tfuse-meta-radio-img-box');
            $parr.find('input[type="radio"][value="'+data.position+'"]').attr('checked','checked').parents('.tfuse-meta-radio-img-box').find('.thumb_radio_over').addClass('tfuse-meta-radio-img-selected');
        }
        else
            select_first_position();
        if(data.sidebars!=undefined) {
            for(i=0;i<data.sidebars.length;i++) {
                $curr_ph=$('#tfusetab-sidebar_new_settings .sidebars_placeholder_container:visible').eq(i);
                for(j=0;j<data.sidebars[i].length;j++) {
                    add_to_placeholder($curr_ph,tf_script.sidebar_names[data.sidebars[i][j]],data.sidebars[i][j]);
                }
            }
            sdb_changes_off();
            if(data.sidebars.length>0)
                do_edit_tab();
            else
                do_add_tab();
        }
        select_first_placeholder();
    },'json');
}

function add_to_placeholder($ph_obj,name,id) {
    var $ = jQuery;
    $ph_obj.find('img').hide();
    $ph_obj.find('.sidebars_placeholder_box').append('<li rel="'+id+'"><span class="sdb_box_name">'+$.trim(name)+'</span><a class="delete" href="#"></a></li>');
    if(!doing_auto_load)
        $('#'+id).parents('.widgets-holder-wrap').effect("transfer", {
            to: $ph_obj.find('.sidebars_placeholder_box li').last(),
            className: 'sdb_null_class'
        }, 600);
    sdb_changes_on();
}

function deselect_placeholder($curr_obj) {
    var $ = jQuery;
    $obj=$('.sidebars_placeholder_container.selected');
    if($obj.length>=1) {
        $obj.removeClass('selected');
        hide_add_to_placeholder();
        if(is_empty_phbox($obj)) {
            $obj.find('img:first').show().next('img').hide();
        }
        else
            $obj.find('img').hide();
        if($curr_obj!=undefined) {
            $obj.attr('test',10);
            $curr_obj.attr('test',12);
            booly=$obj.attr('test')==$curr_obj.attr('test')?true:false;
            $obj.removeAttr('test');
            $curr_obj.removeAttr('test');
            if(booly==true) 
                return false;
            else
                return true;
        }
        else
            return true;
    }
    return true;
}

function select_placeholder($obj) {
    $obj.addClass('selected');
    if(is_empty_phbox($obj)) {
        $obj.find('img:first').hide().next('img').show();
    }
    else
        $obj.find('img').hide();
}

function is_empty_phbox($obj) {
    if($obj.find('.sidebars_placeholder_box li').length<1)
        return true;
    return false;
}

function reset_placeholders() {
    var $ = jQuery;
    $('#tfusetab-sidebar_new_settings').find('.sidebars_placeholder_container').find('.sidebars_placeholder_box li').remove().andSelf().removeClass('selected').find('img').hide().andSelf().find('img:first').show();
}

function select_first_placeholder() {
    var $ = jQuery;
    $('#tfusetab-sidebar_new_settings').find('.sidebars_placeholder_container:visible:first').click();
}

function select_first_position() {
    var $ = jQuery;
    $('.tfuse-meta-radio-img-img:visible').eq(0).click();
}

function reset_positions() {
    var $ = jQuery;
    $('#tfusetab-sidebar_new_settings').find('.tfuse-meta-radio-img-box').find('input[type="radio"]').removeAttr('checked').andSelf().find('.thumb_radio_over').removeClass('tfuse-meta-radio-img-selected');
}

function reset_inputs() {
    var $ = jQuery;
    $('#tfusetab-sidebar_new_settings').find('.multi_options input:hidden').val('').andSelf().find('.multiple_box_selected_titles span:visible').remove();
    reset_positions();
    reset_placeholders();
}

function do_edit_tab() {
    var $ = jQuery;
    $('.tf_meta_tabs li:first a').html('Edit Sidebar');
    $('#sidebars_add_sidebar').html('Save Changes');
    show_cancel_changes();
    current_save_state=2;
}

function do_add_tab() {
    var $ = jQuery;
    $('.tf_meta_tabs li:first a').html('Add Sidebar');
    $('#sidebars_add_sidebar').html('Add Sidebar');
    hide_cancel_changes();
    current_save_state=1;
    last_auto_load_ids=null;
    sdb_changes_off();
}

function show_cancel_changes() {
    var $ = jQuery;
    $('#sidebars_cancel_changes').show();
    hide_add_to_placeholder();
}

function hide_add_to_placeholder() {
    var $ = jQuery;
    $('.add_to_placeholder').hide();
    $('.sidebar_delete_button').show();
}

function show_add_to_placeholder() {
    var $ = jQuery;
    $('.add_to_placeholder').show();
    $('.sidebar_delete_button').hide();
}

function hide_cancel_changes() {
    var $ = jQuery;
    $('#sidebars_cancel_changes').hide();
}

function sdb_changes_off() {
    sdb_has_changes=false;
}
function sdb_changes_on() {
    sdb_has_changes=true;
}