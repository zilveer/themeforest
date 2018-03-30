jQuery(document).ready(function($){
    var $newsletter_service=$('#'+tf_script.TF_THEME_PREFIX+'_newsletter_service');
    $('.'+$newsletter_service.val()+'_apikey').show();
    $newsletter_service.change(function(){
        $('.newsletter_apikey_holder').hide();
        $('.'+$(this).val()+'_apikey').show();
    });
    $('#tfuse_newsletter_save_api_key').click(function(){
        var api_key_input=$('#tfuse_'+$newsletter_service.val()+'_api_key');
        var api_key=api_key_input.val();
        var service=$('#'+tf_script.TF_THEME_PREFIX+'_newsletter_service').val();
        if(!api_key && service!='none') {
            alert('You must provide your '+$newsletter_service.val()+' API key!');
            return;
        }
        $.post(ajaxurl, {
            action:'tfuse_ajax_newsletter',
            tf_action:'tfuse_ajax_newsletter_save_api_key',
            api_key:api_key,
            service:service
        },function(data){
            if(data.status==-1) {
                alert(data.message);
                api_key_input.val('');
            }
            if(data.status==1)
                window.location.reload();
        },'json');
    });
    
    $('#tfuse_newsletter_save_list').click(function(){
        var list_obj=$('#tfuse_'+tf_script.newsletter_service+'_list');
        var list_id=list_obj.val();
        if(!list_id) {
            alert('You must select a list!');
            return;
        }
        $.post(ajaxurl, {
            action:'tfuse_ajax_newsletter',
            tf_action:'tfuse_ajax_newsletter_save_'+tf_script.newsletter_service+'_list',
            list_id:list_id
        },function(data){
            if(data.status==-1) {
                alert(data.message);
            }
            else if(data.status==1)
                window.location.reload();
        },'json');
    });
    
    $('#tfuse_newsletter_save_client').click(function(){
        var client_obj=$('#tfuse_campaignmonitor_client');
        var client_id=client_obj.val();
        if(!client_id) {
            alert('You must select a client!');
            return;
        }
        $.post(ajaxurl, {
            action:'tfuse_ajax_newsletter',
            tf_action:'tfuse_ajax_newsletter_save_campaignmonitor_client',
            client_id:client_id
        },function(data){
            if(data.status==-1) {
                alert(data.message);
            }
            else if(data.status==1)
                window.location.reload();
        },'json');
    });
    
    $('#tfuse_newsletter_fetch_emails_subscribed').click(function(){
        $.post(ajaxurl, {
            action:'tfuse_ajax_newsletter',
            tf_action:'tfuse_ajax_newsletter_fetch_emails_subscribed_'+tf_script.newsletter_service
        },function(data){
            if(data.status==-1) {
                alert(data.message);
            }
            else if(data.status==1) {
                $('#output_field').val(data.emails);
                $('#tfuse_newsletter_total_emails').show().find('span').html(data.count);
            }
        },'json');
    });
});