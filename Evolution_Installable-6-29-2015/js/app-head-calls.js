/*jshint jquery:true */
/*global $:true */

var $ = jQuery.noConflict();

jQuery(document).foundation();

// BACK TO TOP
  
jQuery(document).ready(function(){
	"use strict";
	jQuery(window).scroll(function(){
		if (jQuery(this).scrollTop() > 100) {
			jQuery('.scrollup').fadeIn();
		} else {
			jQuery('.scrollup').fadeOut();
		}
	});

	jQuery('.scrollup').click(function(){
		jQuery("html, body").animate({ scrollTop: 0 }, 600);
		return false;
	});
});

/********Contact Widget*********/

function checkemail(emailaddress){
	"use strict";
	var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i); 
	return pattern.test(emailaddress); 
}

jQuery(document).ready(function(){ 
	"use strict";
	jQuery('#registerErrors, .widgetinfo').hide();								
	var $messageshort = false;
	var $emailerror = false;
	var $nameshort = false;
	var $namelong = false;
	
	jQuery('#contactFormWidget input#wformsend').click(function(){
		var $name = jQuery('#wname').val();
		var $email = jQuery('#wemail').val();
		var $message = jQuery('#wmessage').val();
		var $contactemail = jQuery('#wcontactemail').val();
		var $contacturl = jQuery('#wcontacturl').val();
		//var $subject = jQuery('#wsubject').val();
	
		if ($name !== '' && $name.length < 3){ $nameshort = true; } else { $nameshort = false; }
		if ($name !== '' && $name.length > 30){ $namelong = true; } else { $namelong = false; }
		if ($email !== '' && checkemail($email)){ $emailerror = true; } else { $emailerror = false; }
		if ($message !== '' && $message !== 'Message' && $message.length < 3){ $messageshort = true; } else { $messageshort = false; }
		
		jQuery('#contactFormWidget .loading').animate({opacity: 1}, 250);
		
		if ($name !== '' && $nameshort !==true && $namelong !== true && $email !== '' && $emailerror !== false && $message !== '' && $messageshort !== true && $contactemail !== ''){ 
			jQuery.post($contacturl, 
				{type: 'widget', contactemail: $contactemail, name: $name, email: $email, message: $message}, 
				function(/*data*/){
					jQuery('#contactFormWidget .loading').animate({opacity: 0}, 250);
					jQuery('.form').fadeOut();
					jQuery('#bottom #wname, #bottom #wemail, #bottom #wmessage').css({'border':'0'});
					jQuery('.widgeterror').hide();
					jQuery('.widgetinfo').fadeIn('slow');
					jQuery('.widgetinfo').delay(2000).fadeOut(1000, function(){ 
						jQuery('#wname, #wemail, #wmessage').val('');
						jQuery('.form').fadeIn('slow');
							jQuery('input[type="text"], textarea').each(function(){
								jQuery(this).attr({'data-value': jQuery(this).attr('placeholder')});
								jQuery(this).removeAttr('placeholder');
								jQuery(this).attr({'value': jQuery(this).attr('data-value')});
							});

							jQuery('input[type="text"], textarea').focus(function(){
								jQuery(this).removeClass('error');
								if(jQuery(this).val().toLowerCase() === jQuery(this).attr('data-value').toLowerCase()){
									jQuery(this).val('');
								}	
							}).blur( function(){ 
								if(jQuery(this).val() === ''){
									jQuery(this).val($(this).attr('data-value'));
								}
							});
					});
				}
			);
			
		
			
			return false;
		} else {
			jQuery('#contactFormWidget .loading').animate({opacity: 0}, 250);
			jQuery('.widgeterror').hide();
			jQuery('.widgeterror').fadeIn('fast');
			jQuery('.widgeterror').delay(3000).fadeOut(1000);
			
			if ($name === '' || $name === 'Name' || $nameshort === true || $namelong === true){ 
				jQuery('#wname').css({'border-left':'4px solid #red'}); 
			} else { 
				jQuery('#wname').css({'border-left':'4px solid #929DAC'}); 
			}
			
			if ($email === '' || $email === 'Email' || $emailerror === false){ 
				jQuery('#wemail').css({'border-left':'4px solid red'});
			} else { 
				jQuery('#wemail').css({'border-left':'4px solid #929DAC'}); 
			}
			
			if ($message === '' || $message === 'Message' || $messageshort === true){ 
				jQuery('#wmessage').css({'border-left':'4px solid red'}); 
			} else { 
				jQuery('#wmessage').css({'border-left':'4px solid #929DAC'}); 
			}
			
			return false;
		}
	});
});
/**************************************/

//QUICKSAND

jQuery(document).ready(function() {
	"use strict";
	jQuery('a[data-rel]').each(function() {
		jQuery(this).attr('rel', jQuery(this).data('rel'));
	});
	jQuery("a[rel^='prettyPhoto']").prettyPhoto({theme: 'pp_default'});
	// Setting up our variables
	var $filter;
	var $container;
	var $containerClone;
	var $filterLink;
	var $filteredItems;
	
	// Set our filter
	$filter = jQuery('.portfolio-main li.active a').attr('class');
	
	// Set our filter link
	$filterLink = jQuery('.portfolio-main li a');
	
	// Set our container
	$container = jQuery('ul.portfolio-content');
	
	// Clone our container
	$containerClone = $container.clone();
 
	// Apply our Quicksand to work on a click function
	// for each of the filter li link elements
	$filterLink.click(function() 
	{
		// Remove the active class
		jQuery('.portfolio-main li').removeClass('active');
		
		// Split each of the filter elements and override our filter
		$filter = jQuery(this).attr('class').split(' ');
		
		// Apply the 'active' class to the clicked link
		jQuery(this).parent().addClass('active');
		
		// If 'all' is selected, display all elements
		// else output all items referenced by the data-type
		if ($filter === 'all') {
			$filteredItems = $containerClone.find('li'); 
		}
		else {
			$filteredItems = $containerClone.find('li[data-type~=' + $filter + ']'); 
		}
		
		// Finally call the Quicksand function
		$container.quicksand($filteredItems, 
		{
			// The duration for the animation
			duration: 800,
			// The easing effect when animating
			easing: 'easeInOutQuad'

		},
		function() {
			//$("a[data-rel^='prettyPhoto']").prettyPhoto({theme: 'pp_default'});
		});
	});
});

/******************Toggle**********************/
jQuery(document).ready(function(){
      //Toggle
	"use strict";
	jQuery('.toggle-title').on('click', function(e){
		
		e.preventDefault();

		if(jQuery(this).parent('.toggle').hasClass('open')){
			jQuery(this).parent('.toggle').removeClass('open');
		} else {
			jQuery(this).parent('.toggle').addClass('open');
		}

		jQuery(this).parent('.toggle').find('.toggle-content').slideToggle("fast");
	});
});