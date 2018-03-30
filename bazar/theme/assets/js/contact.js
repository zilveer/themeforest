jQuery(document).ready(function($){     
    
    // contact                           
    var error = true;      
    
    function addLoading( e )
    {

//		$(e).val( '{wait}'.replace('{wait}', contactForm.wait) ).attr('disabled', true);
	}


    function removeLoading( e )
    {
//		$(e).val(value_submit).attr('disabled', false);

	}
	
	function addError(name, e, effect)
	{
		error = true;           
		$(e).removeClass('icon success');
		$(e).addClass('icon error');
		//$(e).parents('li').find('.msg-error').text(msg);
		$('.contact-form .contact-form-error-messages .contact-form-error-' + name).css('display','block');
		if( effect !== undefined && effect == true )
		{
			$(e).css({position:'relative'}).animate({left:-10}, 100).animate({left:10}, 100).animate({left:-5}, 100).animate({left:5}, 100).animate({left:0}, 100);
		}
	}                 
	
	function addSuccess(e)
	{                                     
		$(e).addClass('icon success');	
	}
	
	function removeError(name, e)
	{
		error = false;
		//$(e).parents('li').find('.msg-error').text('');
		$('.contact-form .contact-form-error-messages .contact-form-error-' + name).css('display','none');
		$(e).removeClass('icon error');
        $(e).removeClass( 'formRed')
		addSuccess(e);
	}           
    	
	$('.contact-form .required').blur(function(){             
		var name = $(this).attr('name').match( /(.*)\[(.*)\]/ );
		
		// var id_form = $(this).parents('.contact-form').find('input[name="id_form"]').val(); 
		// jQuery.globalEval( 'var msg = messages_form_'+id_form+'.'+name[2] );  
		
		if( $(this).val() == '' )
			addError(name[2], this);       
		else               
			removeError(name[2], this);
	});                
	
	$('.contact-form .email-validate').blur(function(){             
		var expr = /^[_a-z0-9+-]+(\.[_a-z0-9+-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)+$/;
		var name = $(this).attr('name').match( /(.*)\[(.*)\]/ );       
		
		//var id_form = $(this).parents('.contact-form').find('input[name="id_form"]').val();
		//jQuery.globalEval( 'var msg = messages_form_'+id_form+'.'+name[2] );
		
		if( ( $(this).val() != '' && !expr.test( $(this).val() ) ) || ( $(this).is('.required') && $(this).val() == '' ) )  
			addError(name[2], this);            
		else 
			removeError(name[2], this);
	});    
    
	$('.contact-form').submit(function(){
		addLoading( '.contact-form input:submit' );  
	});

    if($.fn.placeholder) {
        $('input[placeholder], textarea[placeholder]').placeholder();
    }
	
	
	function orderFields() {
		$('#content-page .contact-form').each(function(){

			var contactForm = $('ul', $(this));
			var submit = contactForm.find('.submit-button');
			var textarea = contactForm.find('li').filter('.textarea-field.span9');

			if( $('body').outerWidth() <= 767 ) {
				textarea.appendTo(contactForm);
				submit.appendTo(contactForm);
			}
		});
	}
	
	$(window).resize(function(){
		orderFields();
	});
	orderFields();
   
});