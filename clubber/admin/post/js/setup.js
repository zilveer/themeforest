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
	  jQuery('.wz-page-layout')
	    .click(function () {
	    var layout = jQuery(this)
	      .attr('id');

	    jQuery('#wz-page-layout')
	      .attr('value', layout);

	    jQuery('.wz-page-layout.active')
	      .removeClass('active');
	    jQuery(this)
	      .addClass('active');
	  });


	  //*** Event Date
	  jQuery("#event-date")
	    .datepicker({
	    dateFormat: 'yy/mm/dd'
	  });
	  
	  jQuery("#event-date-finish")
	    .datepicker({
	    dateFormat: 'yy/mm/dd'
	  });


	  //*** Timepicker
	  jQuery('#time-start')
	    .timepicker({
	    timeFormat: "hh:mm tt",
		controlType: "select"
	  });

	  jQuery('#time-end')
	    .timepicker({
	    timeFormat: "hh:mm tt",
		controlType: "select"
	  });

	});