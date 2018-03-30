/**
 * This file contains the functionality for initializing all the scripts in the
 * site and also there are some main initial settings included here, such as
 * setting rounded corners automatically, setting the Twitter functionality,
 * etc.
 * 
 * @author Pexeto
 */

var pexetoSite;

(function($){
pexetoSite = {
	initSite : function() {
	
		jQuery(".gallery a").each(function(){
			var lightbox=jQuery(this).parents('.preview-item').length?'lightbox':'lightbox[group]';
			jQuery(this).attr("rel", lightbox).find('img:first').css({borderWidth:0}).addClass('shadow-frame');
		});
	
		// sets the PrettyPhoto lightbox
		this.setLightbox(jQuery("a[rel^='lightbox']"));
		
		this.setTestimonialFunc();
		
		//set the tabs functionality
		jQuery("ul.tabs").tabs("div.panes > div");
		
		//set the accordion functionality
		jQuery("#accordion").tabs("#accordion div.pane", {tabs: 'h2', effect: 'slide', initialIndex: 0});
		
		this.set_submit_comment();
		
		//SET THE SEARCH BUTTON CLICK HANDLER
		jQuery('#search_button').click(function(event){
			event.preventDefault();
			jQuery('#searchform').submit();
		});
		
		//set the hover animation of the images within anchors
		jQuery('a img').hover(function(){
			jQuery(this).stop().animate({opacity:0.85}, 300);
		},function(){
			jQuery(this).stop().animate({opacity:1}, 300);
		});
		
		this.setColumns();
		
		this.setDropDown();
		
	},
	
	
	setScrollable:function(){
		return jQuery('#slider-navigation').scrollable();
	},
		
	setPortfolioLightbox:function(){
		this.setLightbox(jQuery('a[rel="lightbox"]'));
	},
	
	setLightbox:function(elem){
		elem.prettyPhoto({animation_speed:'normal', theme:'light_rounded', overlay_gallery: false,  social_tools: ''});
	},
	
	setDropDown:function(){
		var padding=jQuery.browser.msie?5:12;
		
		jQuery("#menu ul li").each(function(){
			if(jQuery(this).children('ul').length>0){
				jQuery(this).find('a:first').append(' &raquo;');
			}
		});
		
		jQuery("#menu ul ul").data('padding', 15);
		jQuery("#menu ul ul ul").data('padding', 0);
		
		jQuery("#menu ul li").hover(function(){
			if(jQuery(this).children('ul.sub-menu').length>0){
				var ul = jQuery(this).find('ul:first');
				ul.stop().css({paddingTop:ul.data('padding'), height:'auto'}).slideDown(300, function()
				{
					ul.css({overflow:"visible", visibility:'visible'});
				});
			}
		}, function(){
			if(jQuery(this).children('ul.sub-menu').length>0){
				var ul = jQuery(this).find('ul:first');
				ul.stop().slideUp(300, function()
				{	
					ul.css({overflow:"hidden", display:"none"});
				});
			}
		});
		
		if(jQuery.browser.opera){
			jQuery("#menu ul li").mouseover(function(e){
				jQuery(this).css({backgroundColor:'#fff'});
			});
		}
		
		if(jQuery.browser.safari){
		var hiddenul=jQuery('<ul><li></li></ul>').css({visibility:'hidden',display:'block'});
		jQuery('#menu ul:first').find('li').not('#menu ul li li').eq(-1).append(hiddenul);
		}
	},
	
	setTestimonialFunc:function(){
		jQuery('#testimonials div:first').addClass('first');
		jQuery('#testimonials').tabs("#testimonials div", {
			tabs: 'img', 
			effect: 'horizontal'
		});
	},
	
	setColumns:function(){
		jQuery('.columns-wrapper').each(function(){
			jQuery(this).find('.two-columns').eq(-1).addClass('nomargin');
			jQuery(this).find('.three-columns').not('.services-box').eq(-1).addClass('nomargin');
			jQuery(this).find('.four-columns').eq(-1).addClass('nomargin');
		});
	},
	
	/**
	 * Loads the Nivo image slider.
	 */
	loadNivoSlider : function(obj, effect, showButtons, showArrows, slices, speed, interval, pauseOnHover, autoplay,columns, rows) {
		obj.find('img:first').css({zIndex:10000});
		
		// load the Nivo slider	
		jQuery(window)
				.load(function() {
					obj.nivoSlider( {
						effect : effect, // Specify sets like:
						// 'fold,fade,sliceDown'
						slices : slices,
						boxCols: columns, // For box animations
					    boxRows: rows, // For box animations
						animSpeed : speed,
						pauseTime : interval,
						startSlide : 0, // Set starting Slide (0 index)
						directionNav : showArrows, // Next & Prev
						directionNavHide : true, // Only show on hover
						controlNav : showButtons, // 1,2,3...
						controlNavThumbs : false, // Use thumbnails for
						// Control
						// Nav
						controlNavThumbsFromRel : false, // Use image rel for
						// thumbs
						keyboardNav : true, // Use left & right arrows
						pauseOnHover : pauseOnHover, // Stop animation while hovering
						manualAdvance : autoplay, // Force manual transitions
						captionOpacity : 0.8, // Universal caption opacity
						beforeChange : function() {
						},
						afterChange : function() {
						},
						slideshowEnd : function() {
						} // Triggers after all slides have been shown
					});

					// remove numbers from navigation
						jQuery('.nivo-controlNav a').html('');
						jQuery('.nivo-directionNav a').html('');

						// center the slider navigation
						var slideNumber = jQuery('.nivo-controlNav a').length;
						var slideLeft = 960 / 2 - slideNumber * 21 / 2;
						jQuery('.nivo-controlNav:first').css( {
							left : slideLeft
						});
		    });
	},
	
	set_submit_comment:function(){
		jQuery('#submit_comment_button').click(function(event){
			event.preventDefault();
			jQuery('#commentform').submit();
		});
	}

};

/**
 * Contains the functionality of the send email form. Makes the validation and
 * sends the message.
 */
pexetoContactForm = {
	emptyNameMessage : 'Please fill in your name',
	invalidEmailMessage : 'Please insert a valid email address',
	emptyQuestionMessage : 'Please write your question',
	sentMessage : 'Message Sent',
	actionPath:'',
	set : function(actionPath, sentMessage, nameError, emailError, questionError) {
		this.emptyNameMessage=nameError;
		this.invalidEmailMessage=emailError;
		this.emptyQuestionMessage=questionError;
		this.actionPath=actionPath;
		this.sentMessage=sentMessage;
		this.setSendButtonClickHandler();
		this.setInputClickHandler();
	},

	/**
	 * Sets the send button click event handler. Validates the inputs and if they are
	 * not valid, displays error messages. If they are valid- makes an AJAX request to the
	 * PHP script to send the message.
	 */
	setSendButtonClickHandler : function() {
		jQuery("#send_button")
				.click(function(event) {
					
					event.preventDefault();
					valid = true;

						// remove previous validation error messages and warning styles
						jQuery("#name_text_box").removeClass('invalid');
						jQuery("#email_text_box").removeClass('invalid');
						jQuery("#question_text_area").removeClass('invalid');
						jQuery('#invalid_input').hide();
						jQuery('#sent_successful').hide();
						jQuery('.question_icon').remove();
						jQuery('.contact_message').remove();

						// verify whether the name text box is empty
						var nameTextBox = jQuery("#name_text_box");
						var name = nameTextBox.val();
						if (name == '' || name == null) {
							nameTextBox.addClass('invalid');
							valid = false;
							jQuery(
									'<div class="question_icon"></div><div class="contact_message"><p>' + pexetoContactForm.emptyNameMessage + '</p></div>')
									.insertAfter(nameTextBox);
						}

						// verify whether the inserted email address is valid
						var emailTextBox = jQuery("#email_text_box");
						var email = emailTextBox.val();
						if (!pexetoContactForm.isValidEmailAddress(email)) {
							emailTextBox.addClass('invalid');
							valid = false;
							jQuery(
									'<div class="question_icon"></div><div class="contact_message"><p>' + pexetoContactForm.invalidEmailMessage + '</p></div>')
									.insertAfter(emailTextBox);
						}

						// verify whether the question text area is empty
						var questionTextArea = jQuery("#question_text_area");
						var question = questionTextArea.val();
						if (question == '' || question == null) {
							questionTextArea.addClass('invalid');
							valid = false;
							jQuery(
									'<div class="question_icon"></div><div class="contact_message"><p>' + pexetoContactForm.emptyQuestionMessage + '</p></div>')
									.insertAfter(questionTextArea);
						}

						if (!valid) {
							//the form inputs are not valid
							jQuery('.contact_message').animate( {
								opacity : 0
							}, 0).hide();
							jQuery('.question_icon').hover(
									function() {
										jQuery(this).css( {
											cursor : 'pointer'
										});
										jQuery(this).siblings('.contact_message')
												.stop().show().animate( {
													opacity : 1
												}, 200);
									},
									function() {
										jQuery(this).siblings('.contact_message')
												.stop().animate( {
													opacity : 0
												}).hide();
									});
						} else {
							//the form inputs are valid
							
							// show the loading icon
							jQuery('#contact_status').html(
									'<div class="contact_loader"></div>');

							var dataString = 'name=' + escape(name) + '&question='
									+ escape(question) + '&email=' + email;

							jQuery
									.ajax( {
										type : "POST",
										url : pexetoContactForm.actionPath,
										data : dataString,
										success : function() {
											jQuery("#submit_form").each(function() {
												this.reset();
											});
											jQuery('#contact_status')
													.html(
															'<div class="check"></div><span>' + pexetoContactForm.sentMessage + '</span>');
											setTimeout(function() {
												jQuery('#contact_status').fadeOut(
														500,
														function() {
															jQuery(this).html('')
																	.show();
														});
											}, 3000);
										}
									});
						}
					});
	},

	setInputClickHandler : function() {
		jQuery('.form_input').click(function() {
			jQuery(this).removeClass('invalid');
		});

		jQuery('.form_input').on('keydown', function(e) {
			var keyCode = e.keyCode || e.which;

			if (keyCode == 9) {
				var index = jQuery('.form_input').index(jQuery(this));
				jQuery('.form_input').eq(index + 1).removeClass('invalid');
			}
		});
	},

	/**
	 * Checks if an email address is a valid one.
	 * 
	 * @param emailAddress
	 *            the email address to validate
	 * @return true if the address is a valid one
	 */
	isValidEmailAddress : function(emailAddress) {
		var pattern = new RegExp(
				/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
		return pattern.test(emailAddress);
	}		
};
}(jQuery));









