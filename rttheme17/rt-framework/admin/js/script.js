jQuery.noConflict();

 function sidebarCheck(which) {
  
	 var new_sidebar_name = jQuery("#rt_sidebar_options .new_sidebar .sidebar_name").attr("value"); 
	 var sidebar_name="";
	 var content="";
	 var _Err="";

	 if(which=="saved"){//check all sidebar names 
		jQuery("#rt_sidebar_options .sidebar_name.saved").each(function () {		   
		  if(jQuery(this).attr("value")=="" ){
		    _Err = sidebar_names_confirm;
		  }
		});
	 }

	 if(which=="new"){//check all sidebar names 		 
		  if(new_sidebar_name=="" ){
		    _Err = sidebar_names_confirm;
		  }		 
	 }
    
	 if(_Err){
	    alert(_Err);
	    return false;    
	 }
  
  
  return true; 
}

 function templateCheck(which) {
  
	 var new_template_name = jQuery("#rt_template_options .new_sidebar .sidebar_name").attr("value"); 
	 var template_name="";
	 var content="";
	 var _Err="";

	 if(which=="saved"){//check all template names 
		jQuery("#rt_template_options .sidebar_name.saved").each(function () {		   
		  if(jQuery(this).attr("value")=="" ){
		    _Err = template_names_confirm;
		  }
		});
	 }

	 if(which=="new"){//check all sidebar names 		 
		  if(new_template_name=="" ){
		    _Err = template_names_confirm;
		  }		 
	 }
    
	 if(_Err){
	    alert(_Err);
	    return false;    
	 } 
  
  return true; 
}

jQuery(".radio_cover").live("click", function(event){
	jQuery(this).parents('.image_radio').find('.radio_cover').each(function () {
		jQuery(this).removeClass("checked");
	});

	jQuery(this).children("input:radio").attr("checked","checked"); 
	jQuery(this).addClass("checked");
});
	 
 
jQuery(document).ready(function($) {

	jQuery(".template_box_delete").live("click", function(event){

	var confirm_message = confirm(box_delete_confirm);

	if(confirm_message){
		var thisBox = jQuery(this).parents(".ui-state-default"); 
		thisBox.remove();
		return true;
	}	

	return false;
	});


 	jQuery(".deteleTemplateButton").click(function(){
	   
	     var confirm_message = confirm(template_delete_confirm);
		
		if(confirm_message){ 
		    jQuery(this).parents('.sidebar_div').remove();
		    jQuery(".rt_options_ajax_save").trigger('click'); 
		    return true;
		}
	   
	   return false;

 	});
  



	// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
	jQuery( ".rt_template_item_add_button" ).click(function(){

		  var thisContainer  	= jQuery(this).parent(".form_element");
		  var selectList  		= jQuery(this).prev().attr("id");
		  var selectedItem  	= jQuery('#'+selectList+' option:selected').val();
		  var numRand 			= Math.floor(Math.random()*182701);
		  var randomClass		= numRand+'_class'; 
		  var theGroupID		= numRand;
		  var theTemplateID		= jQuery(this).parents('.sidebar_div').attr("id");
		  var thisGrid			= jQuery('#'+theTemplateID+' .rt-ui-sortable');
		   			 


		  jQuery('.rt-admin-wrapper .Itemheader .expand').removeClass('open');
		  jQuery('.rt-admin-wrapper .Itemheader .expand').removeClass('minus');
		  jQuery('.rt-admin-wrapper .Itemheader .expand').addClass('plus');
		  
		  jQuery('.rt-admin-wrapper .ItemData').each(function () {
			 jQuery(this).slideUp(100);
			 jQuery(this).parents("li").removeClass('expanded');
		  }); 
		
		  jQuery('<img src="'+THEMEADMINURI+'/images/wait.gif" class="rt_loading">').appendTo(thisContainer); 
		  
		  var data = {
			  action: 'my_action',
			  selectedItem: selectedItem,
			  theTemplateID : theTemplateID,
			  theGroupID: theGroupID,
			  randomClass : randomClass
		  };
		   
		  
		  jQuery.post(admin_ajaxurl, data, function(response) {			   
		    jQuery(response).appendTo(thisGrid).animate({opacity:1},300);
		   

				  jQuery('.'+randomClass+'').iphoneStyle({ checkedLabel: 'On', uncheckedLabel: 'Off' });

				  jQuery(".multiple."+randomClass+"").asmSelect({
					  addItemTarget	: 'bottom',
					  animate			: true,
					  highlight		: true,
					  removeLabel		:'x'
				  });
				  
				  jQuery(".range."+randomClass+"").rangeinput(); 
		    
				  jQuery('.rt_loading').remove(); 

				  jQuery('html, body').animate({
					  scrollTop: jQuery('.ui-state-default.full.expanded').offset().top-100
				  }, 600);
		  });
	});



    // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
	jQuery( ".rt_options_ajax_save, #footer_submit").live("click", function(){
    

		  jQuery('<img src="'+THEMEADMINURI+'/images/wait.gif" class="rt_loading">').css({'z-index':'10001','margin':'0','position':'absolute','top':jQuery(this).offset().top-20,'left':jQuery(this).offset().left-185}).appendTo(jQuery(this).parents("form")); 

		  thisFormID = jQuery(this).parents("form").attr("id");
		  
		  if(thisFormID=="rt_sidebar_options"){
			 if(!sidebarCheck("saved")){
			      jQuery('.rt_loading').remove();
				return false; 
			 }
		  }

		  if(thisFormID=="rt_template_options"){
			 if(!templateCheck("saved")){
			      jQuery('.rt_loading').remove();
				return false; 
			 }
		  }				

		  data = jQuery('#'+thisFormID).serialize() +'&action=my_action&saveoptions=true&formid='+thisFormID+'';
		
		  
		  jQuery.post(admin_ajaxurl, data, function(response) {			   
		  
		    
		     jQuery('.rt_loading').remove();
			
		  
		     jQuery('<div class="rt-save-message success_response">'+response+'</div>').css({'margin':'0','position':'fixed','top':jQuery(window).height()/2-100,'left':jQuery(window).width()/2-100}).appendTo("body").fadeIn(500).delay(1500).fadeOut(300); 
 
		    
		  });
		  
		  return true;
	});

});
	
jQuery(function(){
    

	//start sortables
   	jQuery("ul.rt-ui-sortable").sortable({handle:'.Itemheader', placeholder:'highlight', revert: true, distance: 10,  tolerance: 'pointer', start: function(e, ui){ui.placeholder.width(ui.item.width()-5);} }); 
	
	//layout selector
	 jQuery(".layout_selector").live("change", function(event){  
		  var boxHolder		= jQuery(this).parents('li');
		  var selectedClass 	= jQuery('option:selected', this).val();  
		  boxHolder.attr('class',"ui-state-default");
		  boxHolder.addClass(selectedClass);
		  boxHolder.addClass('expanded'); 
		  event.preventDefault(); 
	 });
	 

	 
	//open close the layout boxes    
	jQuery(".template_box_close").live("click", function () {
		jQuery(".rt-admin-wrapper .Itemheader .expand.minus").trigger('click'); 
	}); 

 	jQuery(".rt-admin-wrapper .Itemheader .expand").live("click", function(event){
		 var statusOpen  = jQuery(this).hasClass("open");
		  
		 if(statusOpen){ 
		     jQuery(this).parent('.Itemheader').next('.ItemData').slideUp(100);  
			 jQuery(this).removeClass('open');
			 jQuery(this).removeClass('minus');
			 jQuery(this).addClass('plus');
			 
			 jQuery(this).parents('li').removeClass('expanded');
 
			 var itemHeader = jQuery(this).parent('.Itemheader');
			 
			 jQuery('html, body').animate({
				 scrollTop: itemHeader.offset().top-100 
			 }, 600); 
					
					
			 var count = 0;
			 interval = setInterval(function() {
			  
				if(itemHeader.hasClass('low_opacity')){
				   itemHeader.removeClass('low_opacity');
			 
				}else{						  
				    itemHeader.addClass('low_opacity');
				}
				++count;
				if (count === 7) {
				  clearInterval(interval);
				  itemHeader.removeClass('low_opacity');
				}
			 }, 300);

	
		 }

		 if(statusOpen==false){

		    jQuery('.rt-admin-wrapper .Itemheader .expand').removeClass('open');
		    jQuery('.rt-admin-wrapper .Itemheader .expand').removeClass('minus');
		    jQuery('.rt-admin-wrapper .Itemheader .expand').addClass('plus');				
		    
		    jQuery('.rt-admin-wrapper .ItemData').each(function () {
			   jQuery(this).slideUp(100);
			   jQuery(this).parents('li').removeClass('expanded');
		    });
		    
			 jQuery(this).parent('.Itemheader').next('.ItemData').slideDown(300);
			 jQuery(this).addClass('open');
			 jQuery(this).removeClass('plus');
			 jQuery(this).addClass('minus');
			 
			 jQuery(this).parents('li').addClass('expanded');
			 
			  jQuery(this).parents('li').find(":checkbox").iphoneStyle({ checkedLabel: 'On', uncheckedLabel: 'Off' });


			 jQuery('html, body').animate({
				 scrollTop: jQuery('.ui-state-default.expanded').offset().top-100 
			 }, 600); 
		 }
		 
	 });
	 

});

		
//Checkboxes
jQuery(window).load(function() {
 
  if(jQuery("#rt_template_options").length==0){  
    jQuery('.right-col :checkbox').iphoneStyle({ checkedLabel: 'On', uncheckedLabel: 'Off' });
  }
  
  var rttheme_cufon_fonts = jQuery('#rttheme_cufon_fonts:checkbox').iphoneStyle();
  var rttheme_google_fonts = jQuery('#rttheme_google_fonts:checkbox').iphoneStyle();
   
  
  jQuery('#rttheme_cufon_fonts:checkbox').parents("table").find(".iPhoneCheckContainer").click(function() {
    if(rttheme_google_fonts.attr('value')){
	 jQuery(rttheme_google_fonts).attr("checked", false);
	 jQuery(rttheme_google_fonts).change();
    }
  });

  jQuery('#rttheme_google_fonts:checkbox').parents("table").find(".iPhoneCheckContainer").click(function() {
    if(rttheme_cufon_fonts.attr('value')){
	 jQuery(rttheme_cufon_fonts).attr("checked", false);
	 jQuery(rttheme_cufon_fonts).change();
    }
  });
 
});


//rttheme multi select script
jQuery(document).ready(function() {
    jQuery(".multiple").asmSelect({
	    addItemTarget	: 'bottom',
	    animate		: true,
	    highlight		: true,
	    removeLabel	:'x'
    });
});


jQuery(document).ajaxSuccess(function(e, xhr, settings) {
	var widget_id_base 		= 'latest_posts';   // latest posts plugin
	var widget_id_base_2 	= 'popular_posts';   // popular posts plugin
	var widget_id_base_3 	= 'recent_posts_gallery';   // recent posts gallery plugin
	var widget_id_base_4 	= 'rt_products';   // products plugin

	if(settings.data) {    			
		if(typeof settings.data.search == 'function') {    
			if (settings.data){
				if(settings.data.search('action=save-widget') != -1 && ( settings.data.search('id_base=' + widget_id_base) != -1 || settings.data.search('id_base=' + widget_id_base_2) != -1  || settings.data.search('id_base=' + widget_id_base_3) != -1  || settings.data.search('id_base=' + widget_id_base_4) != -1 ) ) {
					var str 			= settings.data;
					var substr   		= str.split('widget-id=');
					var substr_2 		= substr[1].split('&id_base');
					var thisWidtedID 	= substr_2[0];
					
					jQuery("select[multiple]#widget-"+thisWidtedID+"-categories").asmSelect({
						addItemTarget	: 'bottom',
						animate		: true,
						highlight		: true,
						removeLabel	:'x'
					});
				}
			}
		}
	}
});



//fonts
jQuery(document).ready(function() {   
	      
    jQuery(".sidebar_title").click(function () {
	 	 
	var close_button = jQuery(this).find('.openclose');
	var value=close_button.text();
	var id =close_button.attr('class').split(' ');
	id=id[1];
	 
 	if(value=='+'){
	   //close all
	  jQuery(".sidebar_div").each(function () {
		jQuery(this).find('.openclose').text('+');
		jQuery(this).find('.table_holder').slideUp("fast");
		jQuery(this).closest('.sidebar_div').removeClass("opened");
	  });
	   
	//expand this
	jQuery(this).closest('.sidebar_div').toggleClass("opened");
		close_button.text("-"); 
		jQuery("#"+id+" .table_holder").each(function () {
			jQuery(this).slideDown("fast",function(){
				//scroll
				jQuery('html, body').animate({
					scrollTop: close_button.offset().top-60 
				}, 300);
			});
	  	}); 
	   
 	}else{
	   jQuery(this).closest('.sidebar_div').toggleClass("opened");
	   close_button.text("+");
	   jQuery("#"+id+" .table_holder").each(function () {
		jQuery(this).slideUp("fast");
	   });	   
 	}
	  
	 	 
	//checkbox
	jQuery(this).parents(".sidebar_div").find(".lineUp").iphoneStyle({ checkedLabel: 'On', uncheckedLabel: 'Off' });
	 
});
 

	 //delete
	 jQuery("#rt_sidebar_options .deleteButton").click(function(){ 
		var confirm_message = confirm(sidebar_delete_confirm);

		if(confirm_message){ 
			jQuery(this).parents('.sidebar_div').remove();
			jQuery(".rt_options_ajax_save").trigger('click'); 
			return true;
		}
		return false;

	 });	
	     
  
    
    jQuery("#rt_sidebar_options").submit(function () {
	
	   if(!sidebarCheck("new")){
		return false;
	   }
	   
	   return true;
    });
	

    jQuery("#rt_template_options").submit(function () {
	   var _Err="";
	  
	   if(!templateCheck("new")){
		return false;
	   }

	   if(jQuery('.new_sidebar .rt-ui-sortable li').length==0){
		  _Err = template_contents_confirm; 
	   }

	   if(_Err){
		 alert(_Err);
		 return false;    
	   } 
    
	   return true; 
    });  

 
    jQuery(".fontlist").each(function () {
	 var sind =jQuery(this).val();
		if(sind){
		jQuery(this).parents("table").find("iframe").show();
		}else{
		  jQuery(this).parents("table").find("iframe").hide();
		}
    });	 
	 
	jQuery(".fontlist").change(function () {
		var classList =jQuery(this).attr('class').split(' ');
		var system= classList[1];

		var which_widget = (jQuery(this).attr('id'));
		var sind =jQuery(this).val();
		var font_face =jQuery("#"+which_widget+" option:selected").text();
		var familyName= jQuery("#"+which_widget+" option:selected").attr("class");
			if(familyName){
				familyName = familyName.split('__');
				familyName = familyName[0];
			}else{
				familyName = "";
			}

		jQuery(this).parents("table").find("iframe").attr('src',frameworkurl+'?font='+sind+'&system='+system+'&font_face='+font_face+'&family_name='+familyName+'');
		
		if(sind){
		jQuery(this).parents("table").find("iframe").show();
		}else{
		  jQuery(this).parents("table").find("iframe").hide();
		}
	});
	 
}); 

			 
/*
*
*	FEATTURED IMAGE GALLERY
*
*/	
 
(function($){


	$(document.body).on("click",".rt_photo_holder .delete",function() {    

			var image_id = $(this).attr("data-imageid");   
			var url_field =  $("[data-imageurl="+image_id+"]");   
			var this_image =  $("[data-galimage="+image_id+"]");   
			var this_image_holder = this_image.parents("tr:eq(0)"); 

			$(url_field).val(""); 
			$(this_image).attr("src",""); 
			$(this_image_holder).hide(); 
	});


	$('.rt_gallery_edit_button').click(function() { 
			$(this).hide(); 
			var next_button =  $(this).next();
	        $(this).parents("table").prev().fadeIn('200'); next_button.show(); 
	        $(this).parents("table").prev().prev().toggleClass("passive");   
	});

	$('.rt_gallery_close_button').click(function() {                 		
			$(this).hide(); 
			var prev_button =  $(this).prev();
			prev_button.show(); 
			$(this).parents("table").prev().hide();

			$(this).parents("table").prev().prev().toggleClass("passive");   
	});

	$(document.body).on("click",".rt_photo_holder .rt_gallery_delete_button",function() {   

		    var confirm_message = confirm(delete_confirm);		 
			if(confirm_message){
				
				if(!$(this).hasClass("new-image-delete")){
			 		if(($("div.rt-gallery-uploaded-photos").length) == 1 ){
			 			$(".rt-edit-images-title").remove();
			 		}
				}
			 								 					
			 	$('.'+$(this).attr("id")).parent("div").remove();
				return true;
			}					   
		   return false;                	
	});

	$('.rt_gallery_add_button').click(function() {           
		  
		  $('<img src="'+THEMEADMINURI+'/images/wait.gif" class="rt_loading">').appendTo($('.rt_gallery_add_button'));
		  
		  var data = {
			  action: 'my_action',
			  rt_theme_gallery	: 'new_form'
		  };
		    
		  $.post(admin_ajaxurl, data, function(response) {			 
	 			$(response).appendTo('.rt-gallery-new-photos-holder').animate({opacity:1},300);;
				$('.rt_gallery_add_button .rt_loading').remove(); 
		  }); 
		   		  
			          	
	});

})(jQuery);



/*
*
*	UPLOAD MEDIA
*
*/	
 
(function($){

	//gallery image upload
	$(document).on('click', '.rttheme_gallery_button', function(e) { 

		var custom_uploader; 
		var $this = $(this);

		var image_id = $(this).attr("data-imageid");   
		var url_field =  $("[data-imageurl="+image_id+"]");   
		var this_image =  $("[data-galimage="+image_id+"]");   
		var this_image_holder = this_image.parents("tr:eq(0)"); 

			e.preventDefault();

			//If the uploader object has already been created, reopen the dialog
			if (custom_uploader) {
				custom_uploader.open();
				return;
			}

			//Extend the wp.media object
			custom_uploader = wp.media.frames.file_frame = wp.media({
				title: wp.media.view.l10n.addMedia, 
				multiple: false
			});

			//When a file is selected, grab the URL and set it as the text field's value
			custom_uploader.on('select', function() {
				attachment = custom_uploader.state().get('selection').first().toJSON(); 
				$(url_field).val(attachment.url);  
 		
				if( attachment.type == "image" ){
					this_image.attr("src",attachment.url);  
					this_image_holder.removeAttr("style"); 			 									
				}  

			});

			//Open the uploader dialog
			custom_uploader.open(); 

	}); 		

	//options upload
	$(document).on('click', '.rttheme_upload_button', function(e) { 

		var custom_uploader; 
		var $this = $(this);

		var field_id = $(this).attr("data-inputid");  
		url_field = $(this).parents("td:eq(0)").find(".upload_field");  
		this_image_holder =  $(this).parents("td:eq(0)").find(".uploaded_file");   

			e.preventDefault();

			//If the uploader object has already been created, reopen the dialog
			if (custom_uploader) {
				custom_uploader.open();
				return;
			}

			//Extend the wp.media object
			custom_uploader = wp.media.frames.file_frame = wp.media({
				title: wp.media.view.l10n.addMedia, 
				multiple: false
			});

			//When a file is selected, grab the URL and set it as the text field's value
			custom_uploader.on('select', function() {
				attachment = custom_uploader.state().get('selection').first().toJSON(); 
				$(url_field).val(attachment.url);  
 		
				if( attachment.type == "image" ){
					this_image_holder.find("img:eq(0)").attr("src",attachment.url);  
					this_image_holder.addClass("visible"); 						
				}else{
					this_image_holder.find("img:eq(0)").attr("src","");  
					this_image_holder.removeClass("visible"); 											
				}

			});

			//Open the uploader dialog
			custom_uploader.open(); 

	}); 		

	//delete
	$(document).on('click', '.uploaded_file .delete_single', function() {  
		
		url_field = $(this).parents("td:eq(0)").find(".upload_field");  
		this_image_holder =  $(this).parents("td:eq(0)").find(".uploaded_file");   
		url_field.val("");
		this_image_holder.find("img:eq(0)").attr("src",""); 
		$(this).parent(".uploaded_file").removeClass("visible");
  
	});         

	//auto select
	$('.upload_field').focus(function() {
		$(this).select();
	});

		 
})(jQuery);


//range inputs
(function($){
	$(".range").rangeinput();
})(jQuery);

//clue tips  
(function($){
	$('a.question').cluetip({ 
		hoverClass: 'highlight',width: '250px',sticky: true,
		mouseOutClose: true,
		closePosition: 'title',
		closeText: 'x', cursor: 'help'
	});
})(jQuery);

// close shortcode tips
(function($){

	$(document.body).on("click", '.rt-message', function() {
		$(this).parent('div').remove(); 
	}); 

})(jQuery);

// Setup Assistant
(function($){
    $.fn.rt_setup_assistant= function() { 
		var steps = $(this).find('.rt_step');   
		  $(steps).each(function() {  
		    $(this).click(function() {			 
			   $(this).next('.step_contents').slideToggle();  
			   $('.expand',this).toggleClass('minus');		    
		    });
		});
		
		$('.step_content').click(function() {
		    $(this).next('.step_content_hidden').slideToggle();  
		    $(this).toggleClass('expanded');		    
		});
	}; 
	
})(jQuery);

jQuery(document).ready(function() {
	jQuery('#rt_setup_assistant').rt_setup_assistant();
});
 
// Post Formats
(function($){

	$.fn.extend({
		ShowPostFormats: function () { 

			$this = $(this);
			var theSelectedFormat  = $this.attr("id"); 

			//post formats / option pairs
			var post_formats = {};
			post_formats['post-format-0'] = "#rt_standart_post_custom_fields";
			post_formats['post-format-gallery'] = "#rt_gallery_post_custom_fields";
			post_formats['post-format-link'] = "#rt_link_post_custom_fields";
			post_formats['post-format-video'] = "#rt_video_post_custom_fields";
			post_formats['post-format-audio'] = "#rt_audio_post_custom_fields";
	
				for (var key in post_formats) {
					$(post_formats[key]).css({"display":"none"});
				}
	
			$(post_formats[theSelectedFormat]).css({"display":"block"}); 
	    }
	});

	$("#rttheme_post_format input:checked").ShowPostFormats();
	
	$("#rttheme_post_format").on("change", function(event){
		$("#rttheme_post_format input:checked").ShowPostFormats();
	});
})(jQuery);



// Portfolio Formats
(function($){
    $.fn.rt_portfolio_formats= function() { 
		var groups = {
					"rttheme_portfolio_post_format-1": "rttheme_image_format_options",
					"rttheme_portfolio_post_format-2": "rttheme_video_format_options",
					"rttheme_portfolio_post_format-3": "rttheme_audio_format_options"
				};

		//hide all options
		for (var key in groups) {
			var value = groups[key]; 
			$("#"+value).hide();
		}

		//show selected one
		var selectedContainerID = $("#"+groups[$(this).attr("id")]);
		selectedContainerID.slideDown(400); 
	}; 
	
})(jQuery);



jQuery(window).load(function() {  

	if (jQuery("#rttheme_portfolio_post_format input:checked").length>0){
		jQuery("#rttheme_portfolio_post_format input:checked").rt_portfolio_formats();
	}else{
		jQuery("#rttheme_portfolio_post_format-1").attr('checked',true).rt_portfolio_formats();
	}

	jQuery("#rttheme_portfolio_post_format").on("change", function(event){
		jQuery("#rttheme_portfolio_post_format input:checked").rt_portfolio_formats();
	}); 
});

//rev slider limitations
jQuery(window).load(function() {  
	jQuery("#slider_type_1,#slider_type_2,#slider_type_4,#responsitive_row,#cellWidth,#cellWidthInput,#auto_height_row,#force_full_width_row").css("display","none");
	jQuery("#slider_type_1,#slider_type_2,#slider_type_4").next("label").css("display","none");
	jQuery("#slider_type_3,#auto_height_2,#force_full_width_2").attr('checked', 'checked');
	jQuery("#slider_size_row #width").attr({'value':'940'});
	jQuery("#padding").attr({'value':'0'}); 
});