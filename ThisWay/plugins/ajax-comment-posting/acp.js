// Ajax Comment Posting
// WordPress plugin
// version 2.0
// Edited for Ghost Template by RenkliBeyaz

var form, err, reply;
function acp_initialise() {
	if($('#error').length==0)
	{
		$('#commentform').after('<div id="error"></div>');
		//$('#submit').after('<img src="'+acp_path+'loading.gif" id="loading" alt="'+acp_lang[0]+'" />');
	}
	$('#loading').hide();
	form = $('#commentform');
	err = $('#error');
	reply = false;

	//$.noConflict();

	/* acp_lang[]:
	   [0]: 'Loading...'
	   [1]: 'Please enter your name.'
	   [2]: 'Please enter your email address.'
	   [3]: 'Please enter a valid email address.'
	   [4]: 'Please enter your comment'
	   [5]: 'Your comment has been added.'
	   [6]: 'ACP error!'
	*/

	// initialise
	//acp_initialise();
	
	$('#contentBox .comment-reply-link').unbind('click');
	$('#contentBox .comment-reply-link').addClass('nolink').bind('click', function() {
		// checks if it's a reply to a comment
	        reply = $(this).parents('.depth-1').attr('id');
			err.empty();
	    });
	
	$('#contentBox #cancel-comment-reply-link').unbind('click');
	$('#contentBox #cancel-comment-reply-link').addClass('nolink').bind('click', function() {
		reply = false;
	    });	

		$('#commentform').unbind('submit');
        $('#commentform').bind('submit', function(evt) {
		err.empty();
    
		if(form.find('#author')[0]) {
		    // if not logged in, validate name and email
		    if(form.find('#author').val() == '') {
			err.html('<span class="error">'+acp_lang[1]+'</span>');
			return false;
		    }
		    if(form.find('#email').val() == '') {
			err.html('<span class="error">'+acp_lang[2]+'</span>');
			return false;
		    }
		    var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		    if(!filter.test(form.find('#email').val())) {
			err.html('<span class="error">'+acp_lang[3]+'</span>');
			if (evt.preventDefault) {evt.preventDefault();}
			return false;
		    }
		} // end if

		if(form.find('#comment').val() == '') {
		    err.html('<span class="error">'+acp_lang[4]+'</span>');
		    return false;
		}
		
		$(this).unbind('ajaxSubmit');
		$(this).ajaxSubmit({
			
			beforeSubmit: function() {
				//alert("before"); 
			    $('#loading').show();
			    $('#submit').attr('disabled','disabled');
			}, // end beforeSubmit
		    
			error: function(request){
			    err.empty();
			    var data = request.responseText.match(/<p>(.*)<\/p>/);
			    err.html('<span class="error">'+ data[1] +'</span>');
			    $('#loading').hide();
			    $('#submit').removeAttr("disabled");
			    return false;
			}, // end error()
		    
			success: function(data) {
			    try {
				// if the comments is a reply, replace the parent comment's div with it
				// if not, append the new comment at the bottom
				data = data.replace(/<script[^>]*?>[\s\S]*?<\/script>/gi, '');
				var response = $("<ol>").html(data);
				if(reply != false) {
				    $('#'+reply).replaceWith(response.find('#'+reply));
				    $('.commentlist').after(response.find('#respond'));
				    //acp_initialise();
				} else {			 
				    if ($(document).find('.commentlist')[0]) {
					response.find('.commentlist li:last').hide().appendTo($('.commentlist')).slideDown('slow');
				    } else {
					$('#respond').before(response.find('.commentlist'));
				    }
					
				    if ($(document).find('#comments')[0]) {
						$('#comments').html(response.find('#comments'));
				    } else {
						$('.commentlist').before(response.find('#comments'));
				    }
					//acp_initialise();
				}
				form.find('#comment').val('');
				err.html('<span class="success">'+acp_lang[5]+'</span>');
				$('#submit').removeAttr("disabled");
				$('#loading').hide();
				 acp_initialise();
			    } catch (e) {
				$('#loading').hide();
				$('#submit').removeAttr("disabled");
				alert(acp_lang[6]+'\n\n'+e);
				 acp_initialise();
			    } // end try
			} // end success()
			
		    }); // end ajaxSubmit()
			
		
		return false; 
		
	    }); // end form.submit()
		
} //); // end document.ready()
										
