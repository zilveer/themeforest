// JavaScript Document
jQuery(document).ready(function(){
	
	$ = jQuery;
	
	//social navigation hover effect for twitter,facebook etc
	$('.social-nav li a').hover(function(){					
		$(this).stop(true, true).animate({backgroundPosition: '0px -34px'},200);			
	}, function(){
		$(this).stop(true, true).animate({backgroundPosition: '0px 0px'},300);
	});				
	
	// CSS Fixes
	$('.nav li:last-child').css("border-right","none");
	$('#twitter_update_list p:last-child').css("margin-right","0").css("padding-right","0").css("border-right","none");
	$('#twitter_update_list p a:last-child').attr("target","_blank");
	$('.news-list li:last-child').css("margin-right","0").css("padding-right","0").css("border-right","none");
	$('.pagination li:last-child').css("background","none");
	$('.contacts li:last-child').css("margin-right","0");
    $('.widgetGuts #frm-email').parent('td').addClass('email_input_bg');
    $('.widgetGuts table tr:last-child').addClass('last_dd_child');
		
		
	
	// Main Slider
	$('.slider').cycle({
		fx: 'scrollHorz',
		timeout: 0,
		speed:700,
		easing: "easeInOutCubic",
		prev:   '.prev-slide', 
		next:   '.next-slide',
		pager:  '.nav',
		pagerAnchorBuilder: function(idx, slide) {
            return '.slider-nave  li:eq(' + idx + ') a';
							}
	});
		
		
	//Subscribe Form Validation
	$("#email-subscribe").validate();
	
	// Contact Form Validation and ajax submition
	var contact_options = { 
       				 	target: '#message-sent',
        				beforeSubmit: function(){
												$('#contact-loader').fadeIn('fast');
												$('#message-sent').fadeOut('fast');
										}, 
       					success: function(){
											$('#contact-loader').fadeOut('fast');
											$('#message-sent').fadeIn('fast');
											$('#contact-form-fields').resetForm();
										}
    	}; 

	$('#contact-form-fields').validate({
		submitHandler: function(form) {
	   		$(form).ajaxSubmit(contact_options);
	   }
	});
		
	//Display Related Post
	$(".single-on-click").click(function(e) {
		var $this = $(this);
		var target_class = $this.attr('rel');

		$("#dark").fadeIn('fast',function(){
				$('.'+target_class).slideDown('slow');
			});
		e.preventDefault();
	});
			
	$(".close").click(function(e){		
		var parent_post = $(this).closest('.post');
		parent_post.fadeOut('fast',function(){
				$("#dark").fadeOut('fast');
			});
		e.preventDefault();
	});
	
	$('.post').click(function(e) {
		e.stopPropagation();
	});
	
	$('#dark').click(function(e) {
		$('.post').fadeOut('fast',function(){
				$("#dark").fadeOut('fast');
			});
	});
		
		
		
	//News Slider
	$('#news-list').cycle({
		fx: 'scrollHorz',  	
		speed: 600,
		timeout: 0,
		easing: "easeInOutCubic",
		pager: '.pagination',
		pause: true
	});
		
	// More CSS Fixes
	$('.news-slides .news:first-child').css("margin-left","0");
	$('.news-slides .news:last-child').css("border-right","none");


    // More CSS Fixes
    $('#frm-email').attr('placeholder', 'Your email');
					
});