(function($){
	
	// create the alert message
	$.fn.gdlr_alert = function(options){
	
        var settings = $.extend({
			text: '',
			status: 'success',
			duration: 5000
        }, options);
		
		$(this).each(function(){
		
			var alert_box = $('<div class="gdlr-alert-wrapper"></div>');
				alert_box.append('<span class="alert-icon ' + settings.status + '"></span>');
				alert_box.append(settings.text);

			$(this).append(alert_box);
			
			// center the alert box position
			alert_box.css({
				'margin-left': -(alert_box.outerWidth() / 2),
				'margin-top': -(alert_box.outerHeight() / 2)
			});
					
			// animate the alert box
			alert_box.animate({opacity:1}, function(){
				$(this).delay(settings.duration).fadeOut(function(){
					$(this).remove();
				});
			});
		});
	};	
	
	// create the alert message
	$.fn.gdlr_confirm = function(options){
	
        var settings = $.extend({
			text: 'Are you sure you want to do this ???',
			success:  function(){}
        }, options);
		
		$(this).each(function(){

			var confirm_button = $('<span class="gdlr-button confirm-yes">Yes</span>');
			var decline_button = $('<span class="gdlr-button confirm-no">No</span>');
		
			var confirm_box = $('<div class="gdlr-confirm-wrapper"></div>');
			
			confirm_box.append('<span class="head">' + settings.text + '</span>');			
			confirm_box.append(confirm_button);
			confirm_box.append(decline_button);

			$(this).append(confirm_box);
			
			// center the alert box position
			confirm_box.css({
				'margin-left': -(confirm_box.outerWidth() / 2),
				'margin-top': -(confirm_box.outerHeight() / 2)
			});
					
			// animate the alert box
			confirm_box.animate({opacity:1});
			
			confirm_button.click(function(){
				if(typeof(settings.success) == 'function'){ 
					settings.success();
				}
				confirm_box.fadeOut(function(){
					$(this).remove();
				});
			});
			decline_button.click(function(){
				confirm_box.fadeOut(function(){
					$(this).remove();
				});
			});
			
		});
	};	
	
})(jQuery);