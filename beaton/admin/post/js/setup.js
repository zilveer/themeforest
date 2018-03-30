	//** on DOM loaded
	jQuery(function () {
		jQuery('.panel .controls')
			.click(function () {
				var panelBody = $(this)
					.closest('.panel');
				var panelContent = $('.panel-content', panelBody);
				if (jQuery(this)
					.hasClass('down')) {
					jQuery(panelContent)
						.slideDown();
					jQuery(this)
						.removeClass('down');
				} else {
					jQuery(panelContent)
						.slideUp();
					jQuery(this)
						.addClass('down');
				}
			});
		var fullPanel = jQuery('.full-panel');
		jQuery('.tabs li', fullPanel)
			.click(function () {
				var tabID = jQuery(this)
					.attr('id');
				jQuery('.tabs li.current', fullPanel)
					.removeClass('current');
				jQuery(this)
					.addClass('current');
				jQuery('.panel:not(.' + tabID + ')', fullPanel)
					.css('display', 'none');
				jQuery('.panel.' + tabID, fullPanel)
					.css('display', 'block');
			});
			
	//*** layout sidebar code
		jQuery('.wz_slider')
			.click(function () {
				var layout = jQuery(this)
					.attr('id');
				jQuery('#wz_slider')
					.attr('value', layout);
				jQuery('.wz_slider.active')
					.removeClass('active');
				jQuery(this)
					.addClass('active');
			});
		jQuery('.wz-sidebar-post')
			.click(function () {
				var layout = jQuery(this)
					.attr('id');
				jQuery('#wz-sidebar-post')
					.attr('value', layout);
				jQuery('.wz-sidebar-post.active')
					.removeClass('active');
				jQuery(this)
					.addClass('active');
			});
			
	//*** event Date
	  jQuery("#event-date")
	    .datepicker({
	    dateFormat: 'yy/mm/dd'
	  });
	  
	  jQuery("#event-date-finish")
	    .datepicker({
	    dateFormat: 'yy/mm/dd'
	  });


	  //*** timepicker
	  jQuery('#time-start')
	    .timepicker({
		controlType: "select"
	  });

	  jQuery('#time-end')
	    .timepicker({
		controlType: "select"
	  });
	
	});
	
