jQuery(document).ready(function() {	
	jQuery('html, body').animate({scrollTop:0},0);	
	jQuery('#duotive-admin-panel img.hint-icon[title]').tooltip({ 'effect':'slide', 'offset':[-9, 0],'layout': '<div><span class="arrow"></span></div>'});								   							   
	jQuery("#duotive-admin-panel").jqTransform();
	jQuery('#duotive-admin-panel div.row-content').toggle();
	jQuery('.frontpage-rows li.frontpage-box .row-content div.table-row:even').addClass('table-row-alternative');
	jQuery('#addfrontpage div.table-row:even').addClass('table-row-alternative');
	jQuery('#addfrontpage .table-row-last').prev('div').addClass('table-row-beforelast');		
	jQuery('.frontpage-rows .table-row-last').prev('div').addClass('table-row-beforelast');
	jQuery('#duotive-admin-panel div.row-header').click(function() {
		jQuery(this).toggleClass('row-header-active');
		jQuery(this).next('.row-content').addClass('row-content-active');
		jQuery(this).next('.row-content').stop(true, true).slideToggle('fast', function(){});
	});
	jQuery("#dialog").dialog({
	  autoOpen: false,
	  modal: true
	});
	
	jQuery(".confirmLink").click(function(e) { 
		e.preventDefault();
		
		var targetUrl = jQuery(this).attr("href");
		jQuery("#dialog").dialog({
		  buttons : {
			"Yes" : function() {
			  window.location.href = targetUrl;
			},
			"No" : function() {
			  jQuery(this).dialog("close");
			}
		  }
		});
	
		jQuery("#dialog").dialog("open");
	});
	
	jQuery('#dt_primaryColor,#dt_secondaryColor').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).val(hex);
			jQuery(el).ColorPickerHide();
		},
			onBeforeShow: function () {
				jQuery(this).ColorPickerSetColor(this.value);
			}
		})
		.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});	
	
});	


jQuery(document).ready(function($) {
	jQuery(window).bind("load", function() {
		if ( window.location.hash ) 
		{
			var target_offset = jQuery(window.location.hash).offset();
			var target_top = target_offset.top;
			jQuery('html, body').animate({scrollTop:target_top}, 500);	
		}
	});
});
	
	