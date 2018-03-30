// JavaScript Document
jQuery(document).ready(function(){
	/*
	**	Navigation buttons action of rock admin
	*/
	
	jQuery(".nav_holder ul li a.nav_element").on("click",function(e){
		e.preventDefault();
		
	});
	
	/*
	** Opens the live editing : Currently Disabled
	*/
	
	var liveIframe = '<div id="liveIframeID"></div>';
	jQuery(document).on("click",".go_live_button",function(){
		jQuery("#wpwrap").append(liveIframe);
	});
	
	
	jQuery(document).on("click", ".import_new_options", function(){

		var that = jQuery(this);
		that.attr("disabled","disabled");
		
		jQuery.post(ajaxurl, {action:"rockthemes_to_import_new_options"}, function(data){
			location.reload();
		});
	});
	
	if(jQuery("#modal-holder").length < 1){
		jQuery('#wpbody').append('<div id="modal-holder"></div>');
	}
});


