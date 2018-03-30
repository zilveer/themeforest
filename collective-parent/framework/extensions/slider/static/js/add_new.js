jQuery(function($){
    $('#slider_add_new_cancel').click(function(){
        window.location.href='admin.php?page=tf_slider_list';
        return false;
    });
    
    $('.selectable_option').click(function(){
        $(this).siblings('.selectable_option').each(function(){
            $(this).find('.over_thumb').removeClass('selected');
        });
        $(this).find('.over_thumb').addClass('selected');
        $('#slider_design_type').val($(this).attr('value'));
    });
    
    $('#slider_add_new_create').click(function(){
        datao={};
        datao.design=$('#slider_design_type').val();
        datao.type=$('#slider_type').val();
        datao.title=$('#slider_title').val();
        if(!datao.design) {
            $curr_obj=$('#slider_design_type');
            return $curr_obj.reddit();
        }
        if(!datao.type) {
            $curr_obj=$('#slider_type');
            return $curr_obj.reddit();
        }
        if(!datao.title) {
            $curr_obj=$('#slider_title');
            return $curr_obj.reddit();
        }
        $.post(ajaxurl,{
            action:'tfuse_ajax_slider',
            tf_action: 'tfuse_ajax_slider_title_exists',
            slider_title:datao.title
        },function(data){
            if(data.status==-1) {
                alert(data.message);
            }
            else {
                $('#add_new_form, input[name="slider_design"]').val(datao.design);
                $('#add_new_form, input[name="slider_type"]').val(datao.type);
                $('#add_new_form, input[name="slider_title"]').val(datao.title);
                has_changes=false;
                $('#add_new_form').submit();
            }
        },'json');        
        return false;
    });
});