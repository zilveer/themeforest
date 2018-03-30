var current_shortcode_editor;
var tf_shc_global_clipboard='';
jQuery(function($){
    if(window.QTags) {
        QTags.addButton( 'tf_qtag_add_shortcode', 'add shortcode', '');
        $('#qt_content_tf_qtag_add_shortcode, #qt_qtrans_textarea_content_tf_qtag_add_shortcode').click(function(){
            current_shortcode_editor='html';
            $('#content').data('selectionStart',$('#content')[0].selectionStart);
            $('#content').data('selectionEnd',$('#content')[0].selectionEnd);
            selectedText=get_editor_selection($('#content')[0]);
            tf_shortcode_dialog(selectedText);
        });
        
        $('body').on('click', '.tf_shortcode_element',function(){
            var shc_type=$(this).attr('rel');
            $('#tf_shortcode_list').hide();
            $('#tf_shortcode_options').show().find('.tf_shortcode_option').hide().andSelf().find('.tf_shortcode_option[rel="'+shc_type+'"]').show();
            $('#tf_shortcode_controls').find('#tf_shortcode_control_buttons').show().andSelf().find('#tf_shortcode_control_filters').hide();
            $option_box=$('.tf_shortcode_option:visible','#tf_shortcode_options');
            height=$option_box.parents('#tf_shortcode_options').height()-74;
            $option_box.height(height);
            if($option_box.prop('has_scrollbar')!==true)
                $option_box.prop('has_scrollbar',true).lionbars();
            if($(this).find('.instant_shc').length>0) {
                $('#tf_shortcode_insert').click();
            }
            if(tf_shc_global_clipboard)
                $('[name^="tf_shc_"]').filter('[name$="_content"]').val(tf_shc_global_clipboard);
            start_auto_preview(true);
        });
        
        $('body').on('click','#tf_shortcode_insert',function(){
            sh_type=$('.tf_shortcode_option:visible').attr('rel');
            sh_options=tf_shc_obtain_options(sh_type);
            if(current_shortcode_editor=='tinymce')
                tinyMCE.activeEditor.execCommand("mceInsertContent",false,generate_shortcode(sh_type,sh_options));
            else {
                $('#content').selectRange($('#content').data('selectionStart'),$('#content').data('selectionEnd'));
                QTags.insertContent(generate_shortcode(sh_type,sh_options));
            }
            start_auto_preview(false);
            tb_remove();
            return false;
        });    
        
        $('body').on('click','#tf_shortcode_back',function(){
            $('#tf_shortcode_controls').find('#tf_shortcode_control_buttons').hide().andSelf().find('#tf_shortcode_control_filters').show();
            $('#tf_shortcode_list').show();
            $('#tf_shortcode_options').hide();
            start_auto_preview(false);
            return false;
        });
        
        $('body').on('mouseover mouseout','.tf_shortcode_preview_div',function(event){
            if(event.type=='mouseout') {
                preview_normal();
            }
            if(event.type=='mouseover') {
                preview_large();
            }
        });
                
        $('body').on('change','#tf_shortcode_categories',function(){
            var cat_id=$(this).val();
            $('.tf_shortcode_element').show();
            if(cat_id=='all') {
                return;
            }
            $('.tf_shortcode_element').each(function(){
                if($(this).attr('category')!=cat_id)
                    $(this).hide();
            });
        });
        
        $('body').on('keyup','#tf_shortcode_text_filter',function(){
            var search=$(this).val();
            $('.tf_shortcode_element').show();
            $('.tf_shortcode_element').each(function(){
                if(stripos($(this).find('h3').html(),search)===false && stripos($(this).find('.description').html(),search)===false)
                    $(this).hide();
            });
        });
        
        $('body').on('click','.tf_shc_addable_add',function(){
            var obj=$('.tf_shc_addable').filter(':visible').first().parents('.option');
            var last_one=$('.tf_shc_addable_last').filter(':visible').last().parents('.option');
            var container=last_one.parents('.tf_shortcode_option');
            var id=uniqid();
            k=true;
            i=0;
            while(k) {
                if(last_one.next('.divider').length>0)
                    last_one.next('.divider').after(obj.clone());
                else
                    last_one.after(obj.clone());
                last_one=last_one.nextAll('.option').eq(0);
                if(last_one.find('.tf_shc_addable_last').length>0) {
                    last_one.after($('.divider:first:visible').clone());
                    k=false;
                }
                last_one.addClass('tf_shc_addable_uniqid_'+id).removeClass('tf_shc_addable_uniqid_a').prop('uniqid',id);
                opt_reset(last_one.attr('option'),last_one);
                i++;
                obj=$('.tf_shc_addable_'+i).filter(':visible').first().parents('.option');
                if(i>2000) {
                    //end while cycle, because surely it's an infinite loop
                    k=false;
                    // console.log('Ended Infinite Loop.');
                }
            }
            container.lionbars_reload();
            container.find('.lb-wrap').scrollTop(container.find('.lb-content').height());
        });
        
        $('body').on('click','.tf_shc_addable_remove',function(){
            container=$(this).parents('.tf_shortcode_option');
            container.find('.tf_shc_addable_uniqid_'+$(this).parents('.option').prop('uniqid')).next('.divider').remove().andSelf().remove();
            container.lionbars_reload();
        });
    }
});

function tf_shc_obtain_options(sh_type) {
    sh_options={};
    pattern=new RegExp('^tf_shc_'+sh_type+'_', 'ig');
    if(sh_type!=undefined)
        for(i in tf_script.shc_ids[sh_type]) {
            sh_options[tf_script.shc_ids[sh_type][i].replace(pattern,'')]=opt_get(tf_script.shc_ids[sh_type][i]);
        }
    if(typeof window['custom_obtainer_'+sh_type]=='function') {
        return window['custom_obtainer_'+sh_type](sh_options);
    }
    return sh_options;
}

function generate_shortcode(type,options) {
    shortcode='['+type;
    for(i in options) {
        if(i=='content')
            continue;
        shortcode+=' '+i+'="'+options[i]+'"';
    }
    shortcode+=']';
    if(options['content']!=undefined) {
        shortcode+=options['content']+"[/"+type+']';
    }
    if(typeof window['custom_generator_'+type]=='function') {
        return window['custom_generator_'+type](type,options);
    }
    return shortcode;
}

function add_addables() {
    var $ = jQuery;
    if($('.tf_shc_addable_0').length>0) {
        $('.tf_shc_addable').parents('.option').addClass('tf_shc_addable_uniqid_a');
        obj=$('.tf_shc_addable_0').parents('.option').nextAll('.option').find('.tf_shc_addable_last:first').parents('.formcontainer');
        if(obj.find('.addable_controls').length==0) {
            obj.parents('.option').prop('uniqid','a');
            obj.append('<div class="addable_controls"><span class="tf_shc_addable_add">Add</span> <span class="tf_shc_addable_remove">Remove</span>');
        }
    }
}

function tf_shortcode_dialog(selection) {
    tf_shc_global_clipboard=selection;
    var $=jQuery;
    if($('#tfuse_shortcode_dialog').length<1)
        $('body').append('<div id="tfuse_shortcode_dialog"></div>');
    $('#tfuse_shortcode_dialog').html('');
    $.post(ajaxurl,{
        action:'tfuse_ajax_shortcodes',
        tf_action:'tfuse_ajax_add_shortcode_page',
        post_id: $('#post_ID').val()
    },function(data){
        if(data.content!=undefined) {
            var w=$(window).width();
            var h=$(window).height();
            w=720<w?720:w;
            w-=80;
            h-=84;
            $('#tfuse_shortcode_dialog').html(data.content).hide();
            tb_show("Insert Shortcode", "#TB_inline?width="+w+"&height="+h+"&inlineId=tfuse_shortcode_dialog");
            curr_height=$('#TB_ajaxContent').height()-20;
            $('.tfuse_shortcode_page').height(curr_height);
            curr_height=$('.tfuse_shortcode_page').height()-50;
            $('#tf_shortcode_options').height(curr_height);
            $('#tf_shortcode_list').height(curr_height-30).lionbars();
            // Disabled, until we decide we need tooltips        
            //            $('.tf_shortcode_element').each(function(){
            //                $(this).bt({
            //                    contentSelector: function(){
            //                        return '<img src="'+$(this).attr('preview')+'" style="max-width:400px" />'
            //                    },
            //                    padding: '4px', 
            //                    positions: ['top','bottom'], 
            //                    fill: 'white', 
            //                    width: '400px', 
            //                    strokeStyle: '#e0e0e0', 
            //                    spikeLength: 10, 
            //                    strokeWidth: 1,
            //                    offsetParent:$('body'),
            //                    hoverIntentOpts:  {
            //                        interval: 50,
            //                        timeout: 50
            //                    }
            //                });
            //            });
            tf_optionize();
            add_addables();
        }
        if(data.shc_ids!=undefined) {
            tf_script.shc_ids=data.shc_ids;
        }
    },'json');
}

function preview_large() {
    var $=jQuery;
    $('#tf_shortcode_preview_iframe').stop().animate({
        'width':'638px',
        'height':'300px'
    },200);
}

function preview_normal() {
    var $=jQuery;
    $('#tf_shortcode_preview_iframe').stop().animate({
        'width':'100%',
        'height':'100%'
    },200);
}

function get_editor_selection(id) {
    start=id.selectionStart;
    end=id.selectionEnd;
    val=id.value;
    ret=val.substr(start, (end - start));
    createSelection(start, end, id);
    return ret;
}

function createSelection(start, end, field) {
    if ( field.createTextRange ) {
        var newend = end - start;
        var selRange = field.createTextRange();
        selRange.collapse(true);
        selRange.moveStart("character", start);
        selRange.moveEnd("character", newend);
        selRange.select();
    } 
    else if( field.setSelectionRange ){
        field.setSelectionRange(start, end);
    }
}

function start_auto_preview(clear) {
    var $ = jQuery;
    if(clear===false) {
        if(typeof this.timer!='undefined') {
            clearTimeout(this.timer);
            this.doing_iframe=false;
            this.timer=null;
            $('#tf_shortcode_preview_iframe').attr('src','');
            return;
        }
    }
    if(clear===10)
        this.doing_iframe=false;
    if(this.doing_iframe===true)
        return;
    this.timer=setTimeout(function(){
        if($('.tfuse_shortcode_page').filter(':visible').length==0) {
            start_auto_preview(false);
            return;
        }
        sh_type=$('.tf_shortcode_option:visible').attr('rel');
        sh_options=tf_shc_obtain_options(sh_type);
        if(this.sh_data && this.sh_data['type']==sh_type) {
            skip=true;
            if(JSON.stringify(sh_options)!=JSON.stringify(this.sh_data['options']))
            {
                skip=false;
            }
            if(skip===true) {
                start_auto_preview(true);
                return;
            }
        }
        this.sh_data={};
        this.sh_data['options']=sh_options;
        this.sh_data['type']=sh_type;
        this.doing_iframe=true;
        $('#tf_shc_form_value').val(generate_shortcode(sh_type, sh_options));
        $('#tf_shc_form_type').val(sh_type);
        $('#tf_shortcode_preview_iframe').attr('src','');
        $('#tf_shc_form').submit();
        start_auto_preview(true);
    },this.timer?3000:10);
}