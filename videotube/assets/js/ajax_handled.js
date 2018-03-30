(function($) {
  "use strict";
	jQuery(document).ready(function(){
		
		$('form#edituser input[type=text]').addClass('form-control');
		$('form#edituser input[type=password]').addClass('form-control');
		$('form#edituser select').addClass('form-control');
		$('form#edituser textarea').addClass('form-control');
		// Video Type radio
		$('input[name="chb_video_type"]').click(function(){
			var chb_video_type_value = $(this).val();
			$('div.video-type').slideUp();
			$('div.'+chb_video_type_value).slideDown();
		});
		$(".multi-select-categories").multiselect({
			checkboxName: 'video_category[]'
		});
		$(".switch-button").click(function(){	
		    $('html, body').animate({
		        scrollTop: $("#navigation-wrapper").offset().top
		    }, 1000);			
			
			$("#lightoff").fadeToggle();
		});	
		
		$('#lightoff').click(function(){
			$('#lightoff').hide();
		});			
		$('.social-share-buttons').css('display','none');
		$('a.share-button').on( "click", function() {
			var id = $(this).attr('id');
			if( id == 'off' ){
				$('.social-share-buttons').slideDown(200);
				$(this).attr('id','on');
			}
			else{
				$('.social-share-buttons').slideUp(200);
				$(this).attr('id','off');
			}
		});
		$('table#wp-calendar').addClass('table');
		$('form#vt_loginform > p > input.input').addClass('form-control');
		
		$(".comments-scrolling").click(function() {
		    $('html, body').animate({
		        scrollTop: $("div.comments").offset().top
		    }, 1000);
		});	

	    $('form#mars-submit-video-form').submit(function(){ 	
	        var options = {
                beforeSubmit:  mars_show_request,  // pre-submit callback 
                success:       mars_show_response,  // post-submit callback 
                url:       mars_ajax_url,         // override for form's 'action' attribute 
                type:      'post',        // 'get' or 'post', override for form's 'method' attribute 
                dataType:  'json'        // 'xml', 'script', or 'json' (expected server response type) 
               // clearForm: true,    // clear all form fields after successful submit 
                //resetForm: true        // reset the form after successful submit 
	        };
	        $('form#mars-submit-video-form').ajaxSubmit(options); 
	        // !!! Important !!! 
	        // always return false to prevent standard browser submit and page navigation 
	        return false; 
	    });
		$('a.likes-dislikes').click(function(){
			var act = $(this).attr('action');
			var id = $(this).attr('id');
			var me = $(this);
			jQuery.ajax({
				type:'POST',
				data:'id='+id+'&action=actionlikedislikes&act='+act,
				url:mars_ajax_url,
				beforeSend:function(){
					$('div.alert').remove();
					$('a.likes-dislikes i').removeClass('fa-thumbs-up');
					$('a.likes-dislikes i').addClass('fa-spinner');
				},
				success:function(data){
					var data = $.parseJSON(data);
					if( data.resp =='error' ){
						$('div.video-options').before('<div class="alert alert-success alert-info">'+data.message+'</div>');
					}
					if( data.resp =='success' ){
						if (typeof(data.like) != "undefined"){
							$('label.likevideo'+id).text(data.like);
						}
					}
					$('a.likes-dislikes i').removeClass('fa-spinner');
					$('a.likes-dislikes i').addClass('fa-thumbs-up');
				}
			});
			return false;		
		});		
		$('form#mars-subscribe-form').submit(function(){
			var name = $('form#mars-subscribe-form input#name').val();
			var email = $('form#mars-subscribe-form input#email').val();
			var referer = $('form#mars-subscribe-form input[name="referer"]').val();
			var agree = $('form#mars-subscribe-form input#agree').is(':checked');
			jQuery.ajax({
				type:'POST',
				data:'action=mars_subscrib_act&name='+name+'&email='+email+'&agree='+agree+'&referer='+referer,
				url:mars_ajax_url,
				beforeSend:function(){
					$('form#mars-subscribe-form button[type="submit"]').text('...');
					$('div.alert').remove();
				},
				success:function(data){
					var data = $.parseJSON(data);
					if( data.resp == 'error' ){
						$('form#mars-subscribe-form div.name').before('<div class="alert alert-warning">'+data.message+'</div>');
						$('form#mars-subscribe-form input#'+data.id).focus();
					}
					else{
						$('form#mars-subscribe-form div.name').before('<div class="alert alert-success">'+data.message+'</div>');
						window.location.href = data.redirect_to;
					}
					$('form#mars-subscribe-form button[type="submit"]').text( $('form#mars-subscribe-form input[name="submit-label"]').val());
				}				
			});
			return false;
		});
		$('form#vt_loginform').submit(function(){
			var data_form = $(this).serialize();
			jQuery.ajax({
				type:'POST',
				data: data_form,
				url: mars_ajax_url,
				beforeSend:function(){
					$('.alert').slideUp('slow');
					$('.alert').html('');
					$('form#vt_loginform input[type="submit"]').val('...');
				},				
				success: function(data){
					var data = $.parseJSON(data);
					if( data.resp == 'error' ){
						$('.alert').removeClass('alert-success');
						$('.alert').addClass('alert-danger');
						$('.alert').html(data.message);
						$('.alert').slideDown('slow');
					}
					else if( data.resp =='success' ){
						window.location.href = data.redirect_to;
					}
					$('form#vt_loginform input[type="submit"]').val( $('input[name="button_label"]').val() );
				}
			});
			return false;
		});
		$('form#registerform').submit(function(){
			var data_form = $(this).serialize();
			jQuery.ajax({
				type:'POST',
				data: data_form,
				url: mars_ajax_url,
				beforeSend:function(){
					$('.alert').slideUp('slow');
					$('.alert').html('');
					$('form#registerform input[type="submit"]').val('...');
				},				
				success: function(data){
					var data = $.parseJSON(data);
					if( data.resp == 'error' ){
						$('.alert').removeClass('alert-success');
						$('.alert').addClass('alert-danger');
						$('.alert').html(data.message);
						$('.alert').slideDown('slow');
					}
					else if( data.resp =='success' ){
						$('.alert').addClass('alert-success');
						$('.alert').removeClass('alert-danger');
						$('.alert').html(data.message);
						$('.alert').slideDown('slow');
					}
					$('form#registerform input[type="submit"]').val( $('form#registerform input[name="button_label"]').val() );
				}
			});
			return false;
		});		
		$('form#lostpasswordform').submit(function(){
			var data_form = $(this).serialize();
			jQuery.ajax({
				type:'POST',
				data: data_form,
				url: mars_ajax_url,
				beforeSend:function(){
					$('.alert-danger').slideUp('slow');
					$('form#lostpasswordform button[type="submit"]').text('...');
				},				
				success: function(data){
					var data = $.parseJSON(data);
					if( data.resp == 'error' ){
						$('.alert-danger').html(data.message);
						$('.alert-danger').slideDown('slow');
					}
					else if( data.resp =='success' ){
						window.location.href = data.redirect_to;
					}
					$('form#lostpasswordform button[type="submit"]').text( $('form#lostpasswordform input[name="button_label"]').val() );
				}
			});
			return false;			
		});		
	});
})(jQuery);


function mars_show_request(formData, jqForm, options) {
	jQuery('form#mars-submit-video-form #loading').show();
	jQuery('form#mars-submit-video-form .help-block').empty();
	jQuery('form#mars-submit-video-form button[type="submit"]').hide();
    return true; 
} 
function mars_show_response(responseText, statusText, xhr, $form){ 
	if( responseText.resp == 'error' ){
		if(typeof responseText.element_id != 'undefined'){
			jQuery('div.'+responseText.element_id).addClass('has-error');
			jQuery('#'+responseText.element_id).focus();
			jQuery('div.'+responseText.element_id+' > span.help-block').text('*'+responseText.message);
		}
	}
	else if( responseText.resp == 'publish' ){
		window.location.href = responseText.redirect_to;
	}
	else if ( responseText.resp == 'success' ){
		if (typeof responseText.redirect_to !== 'undefined'){
			window.location.href = responseText.redirect_to;
		}
		else{
			jQuery('form#mars-submit-video-form').remove();
			jQuery('form#mars-submit-video-form').slideUp("slow", function() { jQuery('form#mars-submit-video-form').remove();});
			jQuery('div.post-entry').append('<div class="alert alert-success">'+responseText.message+'</div>');						
		}
	}
	jQuery('form#mars-submit-video-form #loading').hide();
	jQuery('form#mars-submit-video-form button[type="submit"]').show();
}