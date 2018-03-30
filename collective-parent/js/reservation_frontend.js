var _theme_index=tf_script.TF_THEME_PREFIX;
var dates = [];
var picker_in=false;
var picker_out = false;
var _form;
var _captcha_arr = [];
jQuery(document).ready(function(){
    repeat = ['Do not repeat','Every week','Every month','Every year'];
    to_replace = [' to ',' Repeat '];
    var $=jQuery;
    $('.reservationForm').each(function(){
        if($(this).find('.tfuse_captcha_input').length > 0)
            _captcha_arr.push($(this).find('#this_form_id').val());
    });

    $('.reservationForm .btn-submit').click(function(){
        _form = $(this).closest('form');

    })
    $.ajax({
        url:'',
        type:'POST',
        dataType:'json',
        data:{tf_form_id:$('#this_form_id').val(), tf_action:'get_excluded_dates', action:'tfuse_ajax_reservationform'},
        async:false,
        success:function (response, textStatus, XMLHttpRequest) {
            for(i in response){
                    response[i] = response[i].replace(' to ','&');
                    response[i] = response[i].replace(' | Repeat ','&');
                response[i] = response[i].replace(' | ','&');
                response[i] = response[i].replace('From ','');
                for(l in repeat)
                    response[i] = response[i].replace(repeat[l],l);
                dates[i]=response[i].split('&');
                if(dates[i].length < 3){
                    temp = dates[i][1];
                    dates[i][1] = dates[i][0];
                    dates[i][2] = temp;
                }
                row=dates[i];
                for(j in row){
                    if(j<2){
                        data = row[j].split('-');
                        dates[i][j] = new Date(data[0],data[1]-1,data[2]);
                    }
                }
            }
        },
        error:function (jqXHR, textStatus, errorThrown) {

        }
    });

    $('.tfuse_rf_post_datepicker_in').datepicker({
        minDate: new Date(),
        dateFormat:"yy-mm-dd",
        altField:$('#tfuse_rf_post_datepicker_in_input'),
        onSelect:function(date,inst){
            picker_in = date;
                $('.tfuse_rf_post_datepicker_out').datepicker('refresh');
                },
        beforeShowDay:day_statuses,
        beforeShow: function(input, inst)
        {
            inst.dpDiv.css({marginTop: -input.offsetHeight+40 + 'px'});
        }

    });
    $('.tfuse_rf_post_datepicker_out').datepicker({
        minDate: new Date(),
        dateFormat:"yy-mm-dd",
        altField:$('#tfuse_rf_post_datepicker_out_input'),
        onSelect:function(date,inst){
            picker_out = date;
            $('.tfuse_rf_post_datepicker_in').datepicker('refresh');
        },
        beforeShowDay:day_statuses,
        beforeShow: function(input, inst)
        {
            inst.dpDiv.css({marginTop: -input.offsetHeight+40 + 'px'});
        }

    });


    $('.tfuse_captcha_reload').live('click', function (event) {
        _form = $(this).closest('form');
        _captcha = _form.find('.tfuse_captcha_img');
        _captcha_src = _captcha.attr('src');
        _url = _captcha_src.split('&');
        _r=_url[_url.length-1].split('=');
        if(_r[0]=='time')
            _url.pop(_url[_url.length-1]);
        _url=_url.join('&');
        _captcha.attr('src', _url + '&time=' + event.timeStamp);
    });
    $('.reservationForm').each(function(){
        var _id = $(this).find('#this_form_id').val();
    $(this).ajaxForm({
        dataType:'json',
        data:{action:'tfuse_ajax_reservationform',tf_action:'submitFrontendForm',form_id:_id},
        beforeSubmit:check_fields,
        success:function(responseText, statusText, xhr){
            if(responseText.error){
                showErrorMessage(responseText.mess);
            } else {
                showSuccessMessage(responseText.mess);
            }
        }
    });
    });
});
function showErrorMessage(textMessage){
    var $=jQuery;
    _message= _form.closest('.contact_form').find('#form_messages').html('<h2>'+textMessage+'</h2>').addClass('error_submiting_form').show();
    _form.hide();
}
function day_statuses(date){
    var $=jQuery;
    if($(this).hasClass('tfuse_rf_post_datepicker_out') && picker_in !==false){
        date_from = picker_in.split('-');
        date_from = new Date(date_from[0], date_from[1] - 1, date_from[2]);
        if(date < date_from) return [false]
    } else if($(this).hasClass('tfuse_rf_post_datepicker_in') && picker_out !==false){
        date_to = picker_out.split('-');
        date_to = new Date(date_to[0], date_to[1] - 1, date_to[2]);
        if(date > date_to) return [false]
    }

    for(i in dates){
        if(dates[i][2] == 0)
            if(date >= dates[i][0] && date <= dates[i][1]) return [false,'']
        if(dates[i][2] == 1){
            if(dates[i][0].getDay() > dates[i][1].getDay()){
                if(date.getDay() >= dates[i][0].getDay() && date.getDay() <= 7) return [false,'']
                if(date.getDay() >= 0 && date.getDay() <= dates[i][1].getDay()) return [false,'']
            } else
            if(date.getDay() >= dates[i][0].getDay() && date.getDay() <= dates[i][1].getDay()) return [false,'']
            }

        if(dates[i][2] == 2)
            if(date.getDate() >= dates[i][0].getDate() && date.getDate() <= dates[i][1].getDate() ) return [false,'']
        if(dates[i][2] == 3)
            if(date.getDate() >= dates[i][0].getDate() && date.getDate() <= dates[i][1].getDate() && date.getMonth() <= dates[i][1].getMonth() && date.getMonth() >= dates[i][0].getMonth()) return [false,''];

    }
    return [true,''];
}
function showSuccessMessage(textMessage){
    var $=jQuery;
    _message=  _form.closest('.contact_form').find('#form_messages').html('<h2>'+textMessage+'</h2>').addClass('success_submited_form').show();
    _form.hide();
}
function check_fields() {
    var $=jQuery;
    _captcha = _form.find('.tfuse_captcha_img');
    _captcha_resp = true;
    if($.inArray(_form.find('#this_form_id').val(),_captcha_arr) != -1) {
        if(_captcha.length == 0) _captcha_resp = false;}
	if (_captcha.length > 0) {
        _captcha_src = _captcha.attr('src');
        _url = _captcha_src.split('?');
        _ww = _url[0].substring(0, _url[0].lastIndexOf('/'));
        _captcha_input = _form.find('.tfuse_captcha_input');
        $.ajax({
            url:_ww + '/check_captcha.php',
            dataType:'json',
            type:'POST',
            async:false,
            data : {form_id:_captcha_input.attr('name'),captcha:_captcha_input.val()},
            success:function (response, textStatus, XMLHttpRequest) {
                if (!response) {
                    _captcha_input.css('background', '#FF6666');
                    _captcha_resp = false;
                }
                else _captcha_input.css('background', '#ebf4eb');
            }

        });
    }
		

    _return_val = true;
    _required_inputs = _form.find('.tf_rf_required_input');
    _required_inputs.each(function () {
        if(jQuery(this).hasClass('hasDatepicker') && !jQuery(this).parent().is(':visible')){
            if(jQuery.trim(jQuery(this).val()) == ''){
                jQuery(this).val(new Date());
            }
        }
        if(jQuery(this).attr('type')=='checkbox'){
            if(!jQuery(this).is(':checked')){
                jQuery(this).next('label').css('color', 'red');
            } else {
                jQuery(this).next('label').css('color','#12A0A9');
            }
        } else {
            if (jQuery.trim(jQuery(this).val()) == '') {
                _return_val = false;
                jQuery(this).css('background', '#FF6666');
            } else {
                jQuery(this).css('background', '#ebf4eb');
            }

        }
    });
    if (_form.find('.'+_theme_index + '_email').length>0) {
        var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
        _form.find('.'+_theme_index + '_email').each(function(){
            if(!pattern.test(jQuery(this).val())){
                _return_val = false;
                jQuery(this).css('background', '#FF6666');
            } else {
                jQuery(this).css('background', '#ebf4eb');
            }
        });
    }
		if( _captcha_resp && _return_val )
        {
            _form.find('#send_reservation').parent('.button').hide();
            _form.closest('.contact_form').find('#header_message').hide();
            _form.find('#sending,#sending_img').css('display','inline-block');
		}
    return  _captcha_resp &&_return_val;
	
}
function resetFields(obj,evt){
    evt.preventDefault();
    _form = jQuery(obj).closest('form');
    _form.get(0).reset();
    return false;
}