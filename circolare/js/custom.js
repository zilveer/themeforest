/*global jQuery:false */

jQuery(document).ready(function($) {
	"use strict";
	// Image mouse hover effect
	$('.circle').mosaic({
		opacity		:	0.8
	});
	$('.fade').mosaic();
	$('.bar').mosaic({
		animation	:	'slide'
	});
	
	
	// Navigation menu
	$('ul.sf-menu').superfish({ 
		hoverClass:    'sfHover', 
		delay: 100
	});
	
	
	// Mouseover effect for thumbnails
	$("a.grouped-elements").hover(function() {
		$(this).find(".imagehover").toggleClass("mouseon");
	});
	
	
	// Mobile Menu
	$('#main-menu').mobileMenu();
	
	$( ".tabs-product" ).tabs({
		collapsible: true
	});		
	$( ".custom-accordion" ).accordion();
	
	
	// Equal Heights in Gallery
	$('.gallery').equalHeights();
	
	
	// Contact Form
	$('#send_message').click(function(e){
		e.preventDefault();
		var error = false;
		var name = $('#contact_name').val();
		var email = $('#contact_email').val();
		var message = $('#contact_message').val();

		if(name.length === 0){
			error = true;
			$('#name_error').fadeIn(500);
		}else{
			$('#name_error').fadeOut(500);
		}
		if(email.length === 0 || email.indexOf('@') === '-1'){
			error = true;
			$('#email_error').fadeIn(500);
		}else{
			$('#email_error').fadeOut(500);
		}
		if(message.length === 0){
			error = true;
			$('#message_error').fadeIn(500);
		}else{
			$('#message_error').fadeOut(500);
		}

		if(error === false){
			$('#send_message').attr({'disabled' : 'true', 'value' : 'Sending..' });

			var contactformurl = mysiteurl+"/js/send_email.php";
			$.post(contactformurl, $("#contactform").serialize(),function(result){
				if(result === 'sent'){
					$('#cf_submit_p').remove();
					$('#mail_success').fadeIn(500);
				}else{
					$('#mail_fail').fadeIn(500);
					$('#send_message').removeAttr('disabled').attr('value', 'Send');
				}
			});
		}
	});
	
	
});