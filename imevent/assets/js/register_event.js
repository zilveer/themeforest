'use strict';
(function( $ ){
   
    $(document).ready(function(){

        var check = 'true'; 

        // Define Date Field
        
        $('form input.input-date').each(function(){
                var datepickerid = $(this).attr('data-idunique');            
                $('#'+datepickerid).datepicker({
                    dateFormat : $(this).attr("data-format")
                });        
        });
        
        
        $('form.registration-form').each(function(){
            var idformnew = $(this).attr('data-uni');
            if($(this).find('#'+idformnew+' .form-control').length){
                $(this).find('#'+idformnew+' .form-control').tooltip({placement: 'top', trigger: 'manual'}).tooltip('hide');
            }
            $(this).find('#'+idformnew+' .form-control').on('blur', function(){
                $(this).tooltip({placement: 'top', trigger: 'manual'}).tooltip('hide');
            });
        });
        
        

        // validate and process form
        $('form.registration-form').find('.submit-button').on('click', function (e) {

            var idform = $(this).attr('data-idform');
            var formnew = $('#'+idform);

            formnew.find('.get_data').each(function(){

                // Validate or text and textarea field
                if($(this).attr('type') == 'text' || $(this).attr('type') == 'textarea'){

                    var name = $(this).val();
                    var data_placeholder = $(this).attr('data-placeholder');            

                    // Check is empty
                    if($(this).hasClass('require') && (name == '' || name == data_placeholder)){
                        $(this).tooltip({placement: 'top', trigger: 'manual'}).tooltip('show');
                        $(this).focus();
                        check = 'false';                    
                        return false;                    
                    }else {
                        $(this).tooltip({placement: 'top', trigger: 'manual'}).tooltip('hide');
                        check = 'true';
                    }

                    // Check email syntax
                    if($(this).hasClass('input-email') && name != '' && name != data_placeholder){
                        var email = $(this).val();
                        var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9.-]+.[a-zA-z0-9]{2,4}$/;            
                        if (!filter.test(email)) {
                            $(this).tooltip({placement: 'top', trigger: 'manual'}).tooltip('show');
                            $(this).focus();
                            check = 'false';
                            return false;
                        }else{
                            $(this).tooltip({placement: 'top', trigger: 'manual'}).tooltip('hide');
                            check = 'true';                        
                        }
                    };


                    // Check Url syntax
                    if($(this).hasClass('input-url') && name != '' && name != data_placeholder){
                        var url = $(this).val();
                        var filter_url = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
                        if (!filter_url.test(url)) {
                            $(this).tooltip({placement: 'top', trigger: 'manual'}).tooltip('show');
                            $(this).focus();
                            check = 'false';
                            return false;
                        }else{
                            $(this).tooltip({placement: 'top', trigger: 'manual'}).tooltip('hide');
                            check = 'true';                        
                        }
                    };

                    // Check Number syntax
                    if($(this).hasClass('input-number') && name != '' && name != data_placeholder){
                        var number = $(this).val();
                        var filter_phone = /^[0-9-+]+$/;
                        if (!filter_phone.test(number)) {
                            $(this).tooltip({placement: 'top', trigger: 'manual'}).tooltip('show');
                            $(this).focus();
                            check = 'false';
                            return false;
                        }else{
                            $(this).tooltip({placement: 'top', trigger: 'manual'}).tooltip('hide');
                            check = 'true';                        
                        }
                    };

                }

                // Validate for dropdown field
                if($(this).hasClass('input-price') && $(this).hasClass('require')){
                    if($(this).find('option:selected').val() == '' && $(this).find('option:selected').val() != 'undefine'){
                        $(this).tooltip({placement: 'top', trigger: 'manual'}).tooltip('show');
                        $(this).focus();
                        check = 'false';                    
                        return false;
                    }else{
                        $(this).tooltip({placement: 'top', trigger: 'manual'}).tooltip('hide');
                        check = 'true';
                    }
                }
                

            }); 

        
            if(check == 'false'){
                e.preventDefault();
                return false;
            }
            e.preventDefault();


            var userinfo = '';
            var label_data = '';
            var value_data = '';
            
            
            // Get userinfo that user put in form register
            formnew.find('.get_data').each(function(){
                label_data = '';
                value_data = '';

                if ($(this).attr('type') == 'checkbox'){
                    if($(this).is(":checked")){
                        label_data = $(this).attr('name');
                        value_data = $(this).val();
                    }
                    
                }else if ($(this).attr('type') == 'radio'){
                    if($(this).is(":checked")){
                        label_data = $(this).attr('name');
                        value_data = $(this).val();     
                    }
                }else{
                    label_data = $(this).attr('data-place');
                    value_data = $(this).val();    
                }

                var regex = /(<([^>]+)>)/ig;
                var value_data_new = value_data.replace(regex, "");

                if(label_data != '' && value_data != ''){
                    userinfo = userinfo +'<strong>'+label_data +'</strong>:&nbsp;'+value_data_new+ '<br/><i>|||</i>';     
                }            
               
            });
            var order_id =  formnew.find('input.custom').val();
            var imevent_register_emailclient = formnew.find('input.imevent_register_emailclient').val();
           

            $(this).prop("disabled",true);
            formnew.find('.event_loading').addClass('show');

            // Store register to register list
            $.post(ajax_object.ajaxurl, {
                action: 'ajax_action',
                data: {
                    userinfo:userinfo,                
                    orderid: order_id,
                    register_emailclient: imevent_register_emailclient
                }
            }, function(reponse) {
                if(reponse == 'true'){
                    var paypal_active = formnew.find('input.input-paypal_active').val();
                    if(paypal_active == 1){
                        /* Register with paypal */
                        // Go to Paypal
                        var link_paypal = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
                        var paypal_environment = formnew.find('.input-register_environment').val();
                        if(paypal_environment == 1){
                            link_paypal = "https://www.paypal.com/cgi-bin/webscr";
                        }else{
                            link_paypal = "https://www.sandbox.paypal.com/cgi-bin/webscr";
                        }
                        var paypal_email = formnew.find('.input-paypal').val();
                        var currency_code = formnew.find('.input-currency_code').val();
                        var return_url = formnew.find('.input-return_url').val();
                        var cancel_return = formnew.find('.input-cancel_url').val();
                        var price = formnew.find('.unique_price_paypal').val();
                        var register_title_paypal = formnew.find('.input-register_title_paypal').val();
                        var register_notify_paypal_page = formnew.find('.register_notify_paypal_page').val();
                        var custom = formnew.find('.custom').val();

                        var paypal_url = link_paypal+'?cmd=_xclick&business='+paypal_email+'&item_name='+register_title_paypal+'&amount='+price+'&currency_code='+currency_code+'&return='+return_url+'&cancel_return='+cancel_return+'&notify_url='+register_notify_paypal_page+'&custom='+custom+'&item_number='+custom;
                        window.location = encodeURI(paypal_url);
                        return false;    
                    }else{
                        /* Register free no paypal */
                        formnew.find('.form-alert').append('' +
                        '<div class=\"alert alert-success registration-form-alert fade in\">' +
                        '<button class=\"close\" data-dismiss=\"alert\" type=\"button\">&times;</button>' +
                        formnew.find('.register_success_msg').val() +
                        '</div>' +
                        '');
                        /*
                        formnew.find('.get_data').each(function(){
                            $(this).val('');
                        });                    */
                        formnew[0].reset();
                        formnew.find('.form-control').focus().blur();

                        formnew.find('.submit-button').prop("disabled",false);
                        formnew.find('.event_loading').removeClass('show');
                    }
                    
                        
                }else{
                   formnew.find('.form-alert').append('' +
                        '<div class=\"alert alert-error registration-form-alert fade in\">' +
                        '<button class=\"close\" data-dismiss=\"alert\" type=\"button\">&times;</button>' +
                        '<strong>Registration Form Error!</strong>.' +
                        '</div>' +
                        '');
                   return false;
                }
            });

               
        });

        

    });

})(jQuery); 