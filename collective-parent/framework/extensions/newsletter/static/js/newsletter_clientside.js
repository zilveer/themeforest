jQuery(document).ready(function($){
    $('.newsletter_subscription_submit').live('click',function(){
        var $parent=$(this).parents('.newsletter_subscription_box');
        if(!validateEmail($parent.find('.newsletter_subscription_email').val())) {
            $parent.find('.newsletter_subscription_messages *').hide();
            $parent.find('.newsletter_subscription_messages .newsletter_subscription_message_wrong_email').show();
            return false;
        }
        var current_name='';
        if($parent.find('.newsletter_subscription_name').length>0) {
            current_name=$parent.find('.newsletter_subscription_name').val();
        }
        $parent.find('.newsletter_subscription_form').hide();
        $parent.find('.newsletter_subscription_ajax').show();
        $.post(tf_script.ajaxurl, {
            action:'tfuse_ajax_newsletter',
            tf_action:'tfuse_ajax_newsletter_save_email',
            email:$parent.find('.newsletter_subscription_email').val(),
            name:current_name
        },function(data){
            $parent.find('.newsletter_subscription_ajax').hide();
            $parent.find('.newsletter_subscription_form').show();
            if(data.status==-2) {
                $parent.find('.newsletter_subscription_messages *').hide();
                $parent.find('.newsletter_subscription_messages .newsletter_subscription_message_wrong_email').show();
            }
            else if(data.status==-1) {
                $parent.find('.newsletter_subscription_messages *').hide();
                $parent.find('.newsletter_subscription_messages .newsletter_subscription_message_failed').show();
                setTimeout(function(){
                    $parent.find('.newsletter_subscription_messages *').hide();
                    $parent.find('.newsletter_subscription_messages .newsletter_subscription_message_initial').show();
                }, 3000);
            }
            else if(data.status==1) {
                $parent.find('.newsletter_subscription_messages *').hide();
                $parent.find('.newsletter_subscription_messages .newsletter_subscription_message_success').show();
            }
        },'json');
        return false;
    });

    function validateEmail(email) {
        if(!email)
            return false;
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if( !emailReg.test( email ) ) {
            return false;
        } else {
            return true;
        }
    }
});