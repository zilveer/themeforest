/*
*
*	Category display
*
*/	
jQuery(function($){
	 
		$("#rttheme18_category_display").on("change",function(){
			var selectedValue = $('option:selected', this).val();
			
 		 	if( selectedValue  ==  "products_only"){
 		 		$("#category_display").hide();
 		 	}else{
 		 		$("#category_display").show().effect("highlight", 700);
 		 	}
		}).trigger("change");
});



/*
*
*	PRODCT TABS
*
*/	
jQuery(function($){
	$( "#rttheme_product_tabs, #styling_options_tabs" ).tabs();
}); 

/*
*
*	SHOW HIDE HELP TEXTS
*
*/	

jQuery(function($){
	$(document.body).on('click', '.tooltip_icon', function(event) { 
		var help_text= $(this).parents('.table-row:eq(0)').find(".desc:eq(0)"); 
		help_text.slideToggle('fast').toggleClass("active");
 		
 		$(this).toggleClass("clicked");
	});
});

/*
*
*	SHORTCODE HELPER
*
*/	

jQuery(function($){  

	function rt_shortcode_helper( event ) { 

	 
 			if ( $("#rttheme_shortcode_helper").length == 0 ){

				$('<div class="rt_loading_bar"></div>').appendTo("body");//create loading bar
				data = 'action=my_action&shortcode_helper=true';
				$.post(ajaxurl, data, function(response) {			   
						$('.rt_loading_bar').remove();  
						$(response).appendTo("#wpwrap").fadeIn(500);   
						start_helper();
				});	

			}else{
				$( "#rttheme_shortcode_helper").show('fade', { duration: 300, easing: 'swing' });
			}


			function start_helper(){


					//start tabs
					$( "#rttheme_shortcode_helper .vertical_tabs" ).tabs();

					//scroll top on tab clik
					$( "#rttheme_shortcode_helper .ui-tabs-anchor" ).on('click', function() { 
						$( ".modal_content").stop().animate({ scrollTop: 0 }, 300);
					});

					//open the modal	 
					$( "#rttheme_shortcode_helper").show('fade', { duration: 300, easing: 'swing' });


					//reset & remove body scroll
					$('html, body').css({"overflow":"hidden"}).scrollTop(0);

					//make insert buttons visible if there is an active editor
					if( "undefined" != typeof tinyMCE ){ 


						if( null != window.tinyMCE.activeEditor ){  


							if( "" != window.tinyMCE.activeEditor.editorId && "rt_hidden_rich_editor" != window.tinyMCE.activeEditor.editorId ){  			
								$( "#rttheme_shortcode_helper .insert_to_editor").css({display:"block"});
							}else{
								$( "#rttheme_shortcode_helper .insert_to_editor").css({display:"none"});
							}
						}

					}else{
						$( "#rttheme_shortcode_helper .insert_to_editor").css({display:"none"});
					} 


					//insert to editor
					$( ".insert_to_editor" ).on('click', function() { 
						
				 		//the shortcode
				 		var shortcode = $(this).prev("textarea").val();
				 		var new_shortcode = "";


				 		if( $( "#" + tinymce.activeEditor.id ).parents("#wp-content-wrap").hasClass("html-active") === false ){//check if html tab is not active
							// replace new lines with <br /> if the line ends with a bracket ]
							
							shortcode_lines = shortcode.split(/\n/);
							for (i = 0, l = shortcode_lines.length; i < l; i++ ) {
								
								new_shortcode = new_shortcode + shortcode_lines[i];
								this_line = $.trim(	shortcode_lines[i] );
								this_last_char = this_line.substr(this_line.length - 1);

								if ( this_last_char != ">" ){
									new_shortcode = new_shortcode + "<br />"
								}
							}

						}else{
							new_shortcode = shortcode;
						}
				 
						wp.media.editor.insert(new_shortcode); 
						
						$( "#rttheme_shortcode_helper .rt_modal_close" ).trigger("click");

					});

					//add editor shortcut button
					if( "undefined" !=typeof tinymce ){  
					
						if( "undefined" !=typeof tinymce.create ){ 
							tinymce.create('tinymce.plugins.rt_theme_shortcodes', {
								init : function(ed, url) {

									ed.addButton('rt_themeshortcode', {
										title : 'Theme Shortcodes',
										image : url+'/../images/theme-shorcodes.png', 
										onclick : function() {
												jQuery( "#wp-admin-bar-rt_shortcode_helper_button" ).trigger("click");
										}
									});				
								},
								createControl : function(n, cm) {
									return null;
								},
								getInfo : function() {
									return {
										longname : "Shortcodes",
										author : 'RT-Theme',
										version : "1.0"
									};
								}
							});
							tinymce.PluginManager.add('rt_themeshortcode', tinymce.plugins.rt_theme_shortcodes);
						}
					}	

					//add editor shortcut button
					//scroll top on tab clik
					$( ".rt_clean_copy" ).on('click', function() { 

						if( $(this).hasClass("clicked") ){
							return ;
						}

						var the_text = $(this).html();
						var text_field = $('<input type="text" value="'+the_text+'" style="width:100px;">');

						$(this).html("");
						$(this).addClass( "clicked" );
						text_field.appendTo( $(this) );

						text_field.select();

				 
					});

			}



	} 
 
	$("#wp-admin-bar-rt_shortcode_helper_button").on('click', { purpose: "admin_bar" }, rt_shortcode_helper ) ;
});

/*
*
*	ADMIN TOOL-TIPS
*
*/	

jQuery(function($){

	$(".style_parts > div").on('mouseenter mouseleave', function(event) { 
		var tooltip_text= $(this).attr('data-desc'); 
		var tooltip_div  = $('<div class="rt_tooltip_message">'+ tooltip_text +'</div>');
		$(".rt_tooltip_message").remove();

		if(event.type == "mouseenter"){
			$("body").append(tooltip_div);
			tooltip_div.css({"top":$(this).offset().top - ( tooltip_div.height() / 2 ) ,"left":$(this).offset().left-240});
		}
		 		
	});
});

/*
*
*	CLOSE MODAL WINDOW
*
*/	
jQuery(function($){
	
	$(document.body).on("click",'.rt_modal_close',function(){


		//the template form
		parent_template_form =  $(this).parents(".template_builder_form:eq(0)");

		//save control  
		if ( parent_template_form.length > 0 ){
			// prepare tinMCE textareas to save
			if( "undefined"!=typeof tinyMCE ) tinyMCE.triggerSave(); 

			if ( window.save_control != parent_template_form.serialize() ){

				var save_control_confirm = confirm(save_control_message);
	 
				if( ! save_control_confirm){ 
				  return false; 
				}
			}
		}
 
		$(this).parents(".rt_modal:eq(0)").css({"display":"none"});

		//remove active template class 
		if ( parent_template_form.length > 0 ){
			parent_template_form.removeClass("active_template");
		}

		//reset & remove body scroll
		$('html, body').css({"overflow":"auto"});

		//close active module
		$(".active_module .icon_close").trigger("click");		

		//trigger resize window
		$(window).trigger("resize");
	});

});



/*
*
*	MULTI COLUMNS CHECKBOX FOR WP-MENUS
*
*/	
jQuery(function($){
	
 	if( $("body").hasClass("nav-menus-php") ){

		var form = (' \
			<p class="field-xfn description description-wide"> \
			<label>Multi-Column Menu \
			<input class="rt-multi-column-menu widefat code" type="checkbox"></label></p> \
		');

		var form_checked = (' \
			<p class="field-xfn description description-wide"> \
			<label>Multi-Column Menu \
			<input class="rt-multi-column-menu widefat code" checked type="checkbox"></label></p> \
		');

		var column_count = (' \
			<p class="field-xfn description description-wide hidden-field"> \
			<label>Column Item Size \
			<input class="rt-multi-column-item-size widefat code" value="column-item-size-value" type="text" /></label></p> \
		');

		var column_heading_unchecked = (' \
			<p class="field-xfn description description-wide"> \
			<label>Column Heading \
			<input class="rt-multi-column-heading widefat code" type="checkbox"></label></p> \
		');

		var column_heading_checked = (' \
			<p class="field-xfn description description-wide"> \
			<label>Column Heading \
			<input class="rt-multi-column-heading widefat code" checked type="checkbox"></label></p> \
		');


		$(".menu-item-settings").each(function(){
			
			classNames = $(this).find(".edit-menu-item-classes").val();

			if( classNames.search(/multicolumn-/i) > -1 ){
				$(this).find(".field-move").before(form_checked);

				//find the stored column size 
				classNames_split = classNames.split(" ");
				stored_column_count = ""; 

				for (i = 0; i < classNames_split.length; i++ ) { 
					if( classNames_split[i].search(/multicolumn-/i) > -1 ){ 
						stored_column_count_array = classNames_split[i].split("-");
						stored_column_count = stored_column_count_array[stored_column_count_array.length-1];
					} 				
				}

				$(this).find(".field-move").before(column_count.replace(/column-item-size-value/i, stored_column_count).replace(/hidden-field/i, ""));  

			}else{
				$(this).find(".field-move").before(form);
				$(this).find(".field-move").before(column_count.replace(/column-item-size-value/i, "5")); 
			}
 

			//column heading checked from string  
			classNames_split = classNames.split(" "); 
			column_heading = false;

			for (i = 0; i < classNames_split.length; i++ ) {   
				if( classNames_split[i].search(/column-heading/i) > -1 ){  
					column_heading = true; 
				}					
			}  
			if( column_heading === true ){
				$(this).find(".field-move").before(column_heading_checked); 
			}else{
				$(this).find(".field-move").before(column_heading_unchecked); 
			}
		}); 


		$('.submit-add-to-menu').on('click', function() {  
			$(document).ajaxStop(function() {

				$(".menu-item.pending").each(function(){
					if( $(this).find(".rt-multi-column-menu").length < 1 ){
						$(this).find(".field-move").before(form);
						$(this).find(".field-move").before(column_count.replace(/column-item-size-value/i, "5"));
						$(this).find(".field-move").before(column_heading_unchecked);
					} 
				});				

			});
		});

		$(document.body).on('click', '.rt-multi-column-menu', function() {   

			var css_field = $(this).parents(".menu-item-settings").find(".edit-menu-item-classes");
			var css_class_value = css_field.val();

			var column_count_holder = $(this).parents(".field-xfn:eq(0)").next(".field-xfn"); 
			var column_count = column_count_holder.find(".rt-multi-column-item-size");


			if( $(this).attr("checked") ){

				css_field.val( $.trim(css_class_value) + " multicolumn-" + column_count.val() ); 
				column_count_holder.removeClass("hidden-field");

			}else{
				var classNames = css_class_value.split(" ");
				var newclassNames = "";

				for (i = 0; i < classNames.length; i++ ) { 

					if( classNames[i].search(/multicolumn-/i) > -1 ) { //found & deleted
						newclassNames += "";
					}else{
						newclassNames += classNames[i];
					}

				}		
				column_count_holder.addClass("hidden-field");
				css_field.val( $.trim(newclassNames) );  
			} 

		});


		$(document.body).on('keyup mouseleave', '.rt-multi-column-item-size', function() {   
 
			var css_field = $(this).parents(".menu-item-settings").find(".edit-menu-item-classes");
			var css_class_value = css_field.val();
			var new_classNames = "";

			//find the stored column size from string  
			classNames_split = css_class_value.split(" "); 

			for (i = 0; i < classNames_split.length; i++ ) { 
				if( classNames_split[i].search(/multicolumn-/i) > -1 ){ 

					new_classNames += " " + "multicolumn-" + $(this).val();
				}else{

					new_classNames += " " + classNames_split[i];
				}
			}

			css_field.val($.trim(new_classNames));
		});		


		$(document.body).on('click', '.rt-multi-column-heading', function() {   

			var css_field = $(this).parents(".menu-item-settings").find(".edit-menu-item-classes");
			var css_class_value = css_field.val();
  
			if( $(this).attr("checked") ){

				css_field.val( $.trim(css_class_value) + " column-heading"  );  

			}else{
				var classNames = css_class_value.split(" ");
				var newclassNames = "";

				for (i = 0; i < classNames.length; i++ ) { 

					if( classNames[i].search(/column-heading/i) > -1 ) { //found & deleted
						newclassNames += "";
					}else{
						newclassNames += classNames[i];
					}

				}		
				css_field.val( $.trim(newclassNames) );  
			} 

		});		
 	}

});



/*
*
*	DELETE COLUMNS
*
*/	

jQuery(function($){
	$(document.body).on('click', '.column_delete', function() { 

		var confirm_message = confirm(column_delete_confirm);

		if(confirm_message){
		  var thisBox  	= $(this).parents(".rt-ui-sortable.column:eq(0)"); 
		  thisBox.remove();


		  return true;
		}

		return false;
	});
 
});


/*
*
*	DELETE ROWS
*
*/	

jQuery(function($){
	$(document.body).on('click', '.row_delete', function() { 

		var this_row = $(this).parents(".grid_holder:eq(0)"); 
		var this_row_title = this_row.prev("table.seperator"); 
		var row_count = this_row.parents("form:eq(0)").find(".grid_holder").length; //find how many rows we have

		if (row_count === 3 ) {
			alert(row_count_error);	
			return false;
		}

		var confirm_message = confirm(row_delete_confirm);

		if( row_count > 1 && confirm_message ){ 
		  this_row.remove(); 
		  this_row_title.remove();
		  return true;
		}

		return false;
	});
 
}); 

 
/*
*
*	ROW WIDTH SELECTOR
*
*/	

jQuery(function($){
	$(document.body).on('change', '.row_width', function(event) { 

		var selectedValue = $('option:selected', this).val();

		var thisRowHolder = $(this).parents(".grid_holder:eq(0)").find(".layout_selector .radio_full");
	 
	 	if (selectedValue == "full" ){
	 		thisRowHolder.trigger("click");
	 	}

		event.preventDefault();  
	});
});

/*
*
*	SHOW HIDE ROW OPTIONS
*
*/	

jQuery(function($){
	$(document.body).on('click', '.grid_options_button', function(event) { 
		var thisGrid	= $(this).parents('.grid_holder:eq(0)').find(".grid_options_hidden:eq(0)"); 

		thisGrid.slideToggle('fast');

		$(this).parents('div:eq(0)').find('.grid_options_button').each(function(){
			$(this).toggleClass('hidden'); 
			$(this).toggleClass('active'); 
		});

		//disable parallax option from header and footer
		if( $(this).hasClass("header") || $(this).hasClass("footer") ){
			thisGrid.find(".parallax_effect").val("disabled_parallax").trigger("change").attr("disabled","true");
		}
		
	});
});

/*
*
*	LAYOUT SELECTOR
*
*/	

jQuery(function($){
	$(document.body).on('click', '.radio_cover', function() { 

		$(this).parents('.image_radio').find('.radio_cover').each(function () {
			$(this).removeClass("checked");
		});

		$(this).children("input:radio").attr("checked","checked"); 
		$(this).addClass("checked"); 
 
		//show hide widget area selection list
		var selected_option = $(this).children("input:radio").val();
		var the_options = $(this).parents(".grid_options_hidden:eq(0)").find(".sidebar_selection_list");  

		if( selected_option === "full" ){
			the_options.slideUp("fast");
		}else{
			the_options.slideDown("fast");

			//row width fix
			var thisRowWidthSelector = $(this).parents(".grid_holder:eq(0)").find(".row_width:eq(0)");
				var thisRowWidthSelectorValue = $('option:selected', thisRowWidthSelector).val(); 

			if( thisRowWidthSelectorValue == "full" ){
				thisRowWidthSelector.val("default"); 
			} 
		}  
	}); 
});


/*
*
*	SORTABLE ITEMS
*
*/	

(function($){
	$.fn.start_sortables = function() {
 
 
 		var $tabs = $( "ul.rt-ui-sortable" );  

 		//columns
		var $column_items = $( "li.rt-ui-sortable.column" ).droppable({
		
			accept: ".ui-state-default",
			hoverClass: "ui-state-hover",
			tolerance: "pointer",  
				
				over: function( event, ui ) { 
					$row_items.droppable( {disabled: true } ).removeClass("ui-state-hover"); 
				},

				out: function( event, ui ) { 
					$row_items.droppable( "enable" ); 
				},

				drop: function( event, ui ) {

					var $list_holder = $(this).find("ul.rt-ui-sortable:eq(0)"); // dropped list

					$list_holder.addClass("dropped");//add class & remove 50ms later to capture item 
					setTimeout(function(){ $list_holder.removeClass("dropped"); },50);


					if ( $list_holder.find("> .placeholder").length == 0 ){
					ui.draggable.hide( "fade", { duration: 100, easing: 'swing' }, function() {
						
						var $ui = $(this);//dropped element

							$ui.appendTo( $list_holder ).show('fade', { duration: 200, easing: 'swing' }, function() { $(this).removeAttr("style") }); 

							return false;
					});

					$row_items.droppable( "enable" );
				} 
			}

		});

		//rows
		var $row_items = $( ".grid_holder" ).droppable({
		
			accept: "ul.rt-ui-sortable > li",
			hoverClass: "ui-state-hover",
			tolerance: "pointer", 
				drop: function( event, ui ) { 

					var $list_holder = $(this).find("ul:eq(0)"); // dropped list 
					
					if ( $list_holder.find("> .placeholder").length == 0 &&  $list_holder.find(".dropped").length == 0 ){
					ui.draggable.hide( "fade", { duration: 100, easing: 'swing' }, function() {
						
						var $ui = $(this);//dropped element 

							$ui.appendTo( $list_holder ).show('fade', { duration: 200, easing: 'swing' }, function() { $(this).removeAttr("style") });  
							return false;
					});
				} 
			}

		});  
		

		//start sortables 

		$(".start_content_rows").sortable({ 

			handle: ".grid_options", 
			items: ".content_row",  
			revert: true,
			scrollSensitivity: 100, 
			opacity: 0.5, 
			scrollSpeed: 30, 
			scroll: true, 
			axis: "y", 
			placeholder : 'row-placeholder', 
			tolerance : "pointer", 
			start: function(e, ui){  

					 
					ui.placeholder.height(ui.item.height()); 						 

			},	

			update: function(e, ui){ 
 
				var item = ui.item; 
				item.removeAttr("style");
			},

			}) ;



		$("ul.rt-ui-sortable").sortable({ 
			connectWith: "ul.rt-ui-sortable.column", 
			handle:'.Itemheader, .columnheader',  
			revert: false, 
			forceHelperSize: false,  
			opacity: 0.5,
			scroll: true, 
			scrollSensitivity: 100,  
			scrollSpeed: 30, 
			cursor: "move", 
			distance: 20, 
			placeholder : 'rt-ui-sortable column placeholder',  
			tolerance : "pointer", 
			cursorAt: { bottom: 0, left: 0}, 

			start: function(e, ui){ 
				var item = ui.item;  

				if( item.hasClass("column") ) {   
					ui.placeholder.width(ui.item.width()-5); 
				}  

			},

			update: function(e, ui){  
				var item = ui.item;     
				$(".modal_content").off('mousewheel').removeClass("dragging"); 
				item.removeAttr("style");
			},


			stop: function(e, ui){  
				$(".modal_content").off('mousewheel').removeClass("dragging");	
				$row_items.droppable( "enable" );	 
			},

			sort: function(e, ui){ 
 				
 				$(".modal_content").addClass("dragging");
				$(".modal_content").on('mousewheel', function(e) { 

					return false;

				});	  
			} 			 

		}); 	 
 	}; 
})(jQuery);

/*
*
*	CREATE ICON LISTS
*
*/	
 
(function($){
	$.fn.icon_list = function() {
 
		//start sortables
		$(this).find("ul.icon_list").sortable({handle:'.form_element', 
			start: function(e, ui){  
				$(".list_item").css("listStyleType","square");   
				ui.item.toggleClass('arrows'); 
			},
			stop: function(e, ui){ 
				$(".list_item").css("listStyleType","decimal"); 
				ui.item.toggleClass('arrows'); 
			},			 
		}); 			
 
		//add new slide
		$(this).find(".rt_add_new_list_line").on("click",function(){

			var hidden_line = $(this).parents("li:eq(0)").find(".hidden_line");
			var list_holder = $(this).parents("li:eq(0)").find(".icon_list:eq(0)"); 
			var clonedForm = hidden_line.clone('true','true');
			clonedForm.appendTo(list_holder).removeClass("hidden_line").css({"display":"list-item"}); 			 
		});

		//delete a line
		$(this).find("span.s_delete").on("click",function(){

			var this_line = $(this).parents(".list_item:eq(0)");
			var confirm_message = confirm(line_delete_confirm);

			if(confirm_message){ 
			  this_line.remove(); 
			  return true;
			}

			return false;
		}); 

	}; 	
 
})(jQuery);


/*
*
*	CREATE MAP LISTS
*
*/	
 
(function($){
	$.fn.map_list = function() {
 
		//start sortables
		$(this).find("ul.google_map_list").sortable({handle:'.form_element', 
			start: function(e, ui){  
				$(".list_item").css("listStyleType","square");   
				ui.item.toggleClass('arrows'); 
			},
			stop: function(e, ui){ 
				$(".list_item").css("listStyleType","decimal"); 
				ui.item.toggleClass('arrows'); 
			},			 
		}); 			
 
		//add new slide
		$(this).find(".rt_add_new_map_location").on("click",function(){

			var hidden_line = $(this).parents("li:eq(0)").find(".hidden_line:eq(0)");
			var list_holder = $(this).parents("li:eq(0)").find(".google_map_list:eq(0)"); 
			var clonedForm = hidden_line.clone('true','true');
			clonedForm.appendTo(list_holder).removeClass("hidden_line").css({"display":"list-item"}); 			 
		});

		//delete a line
		$(this).find("span.s_delete").on("click",function(){

			var this_line = $(this).parents(".list_item:eq(0)");
			var confirm_message = confirm(line_delete_confirm);

			if(confirm_message){ 
			  this_line.remove(); 
			  return true;
			}

			return false;
		});


		var gllpLatlonPicker = $(".gllpLatlonPicker");

		//geo location select
		$(this).find(".geo_selection").on("click",function(){
			gllpLatlonPicker.removeClass("hide"); 
			gllpLatlonPicker.appendTo( $(this).parents(".list_item:eq(0)") );
 
			if( $(this).val() !== "" ){
				var getcoords = $(this).val().split(",");	
				var lat = $(".gllpLatitude").val(getcoords[0]);
				var lon = $(".gllpLongitude").val(getcoords[1]);					
				var lon = $(".gllpZoom").val(16);							
				$(".gllpUpdateButton").trigger('click');
			} 

		});

		//geo location hide
		gllpLatlonPicker.find(".close").on("click",function(){
			gllpLatlonPicker.addClass("hide"); 
		});


		//select cords
		gllpLatlonPicker.find(".select_map").on("click",function(){

			var lat = $(".gllpLatitude").val();
			var lon = $(".gllpLongitude").val();

			var fieldtocopy = $(this).parents(".list_item").find(".geo_selection").val(lat+","+lon);

			gllpLatlonPicker.addClass("hide");
		}); 
	}; 	
 
})(jQuery); 		 

/*
*
*	CREATE SLIDERS
*
*/	
 
(function($){
	$.fn.create_sliders = function() {
 
		//start sortables
		$(this).find("ul.slides_holder").sortable({handle:'.title', 
			start: function(e, ui){  
				$(".slides_holder").css("listStyleType","square");   
				ui.item.toggleClass('arrows'); 
				$.fn.close_active_slides(ui.item); //close active slides, tabs, accordions
			},
			stop: function(e, ui){ 
				ui.item.toggleClass('arrows'); 
				$(".slides_holder").css("listStyleType","decimal"); 
			},			 
		}); 		


		//open close slide options
		$(this).find("span.s_edit").on("click",function(){

			var allOptions = $(this).parents(".slides_holder:eq(0)").find(".options");
			var clickedOptions = $(this).parents(".slide_options:eq(0)").find(".options");
			var holder = $(this).parents(".slider_creator:eq(0)");
 
 			var purpose;

			if(holder.hasClass("for_slider")){
				purpose = "slider";			
			}else if(holder.hasClass("for_tabs")){
				purpose = "tabs";		
			}else{
				purpose = "accordion";	
			}

			$(this).parents(".slides_holder:eq(0)").find(".active").each(function(){
				$(this).stop().animate({height: "toggle", opacity: "toggle"}, { duration: "fast" }).toggleClass("active"); 
				if(purpose!=="slider"){
					$.fn.rt_destroy_rich_editor($(this));  
				}  
			});

			if (clickedOptions.css("display") == "none" ){
				clickedOptions.stop().animate({height: "toggle", opacity: "toggle"}, { duration: "fast" }).toggleClass("active");

				if(purpose!=="slider"){
					$.fn.rt_load_rich_editor(clickedOptions);  
				}  

			}else{
				clickedOptions.removeClass("active");
			}
		});

		$(this).find(".title").on("dblclick",function(){ 
			$(this).find("span:eq(0)").trigger('click');   
		});

		//delete a slide
		$(this).find("span.s_delete").on("click",function(){

			var thisSlide = $(this).parents(".slide_options:eq(0)");
			var confirm_message = confirm(box_delete_confirm);

			if(confirm_message){ 
			  thisSlide.remove(); 
			  return true;
			}

			return false;
		});
 
		//add new slide
		$(this).find(".rt_add_new_slide").on("click",function(){
			var hidden_slide_form = $(this).parents(".slider_creator:eq(0)").find(".new_slide:eq(0)");
			var slides_holder = $(this).parents(".slider_creator:eq(0)").find(".slides_holder:eq(0)");   
			var oldID = hidden_slide_form.find(".wp-editor-area").attr("id");
			var newID = 'random_ID_'+Math.floor(Math.random()*182701);
			var clonedForm = hidden_slide_form.clone('true','true');
			var module_height = slides_holder.parents(".Itemholder:eq(0)").height() + slides_holder.height() - 400 ;

			//check if hidden field exists
			var first_form_item = clonedForm.find("input:eq(0)"); 

			if( first_form_item.attr("type") == "hidden"){
				first_form_item.attr("value","1");
			}			 

			clonedForm.find(".hidden_slide_item").each(function(){ 
				$(this).removeClass("hidden_slide_item"); 
			});


			clonedForm.appendTo(slides_holder).removeClass("new_slide").css({"display":"list-item"}); 
			clonedForm.find("textarea:eq(0)").attr("id",newID); 

			$.fn.close_active_slides(slides_holder);
			clonedForm.find(".s_edit").trigger("click");
			clonedForm.effect("highlight", 700); 

			slides_holder.parents(".ItemData:eq(0)").stop().animate({
				scrollTop: -1 * ( slides_holder.parents(".ItemData:eq(0)").offset().top - slides_holder.height() - clonedForm.offset().top + 100 ) 
			}, 600);  


			$.fn.start_scripts(slides_holder);

		});
	
	}; 	

	$.fn.close_active_slides = function(container) {    
		$(container).find(".options.active").each(function(){ 
			$(this).parents(".slide_options:eq(0)").find(".s_edit").trigger("click");
		}); 

		$(container).find(".options").each(function(){ 
			$(this).css("display","none");
		}); 		
	}; 	 
})(jQuery);
 

/*
*
*	CHEKBOXES
*
*/	

(function($){ 

	$.fn.rt_checkbox = function() { 
		$(this).on('click', function() { 
 
				checkbox = $(this).find(".checkbox"); 

				if ( checkbox.is(":checked") == true ) {
					checkbox.attr('checked',false); 
					checkbox.next('div').removeClass("icon-check").addClass("icon-check-empty");  				
				}else{ 
					checkbox.attr('checked',true); 
					checkbox.next('div').removeClass("icon-check-empty").addClass("icon-check");  
				} 

				return false;
		});
	}  
})(jQuery);

/*
*
*	START PLUGINS FOR AJAX LOADED ELEMENTS
*
*/	

(function($){
	$.fn.start_scripts = function(container,randomClass,purpose) {
 
		//multi selection script
		if(randomClass) randomClass = "."+randomClass;

		$(container).find(".multiple"+randomClass).asmSelect({
			addItemTarget	: 'bottom',
			animate			: true,
			highlight		: true,
			removeLabel		:'x'
		});	  

		//checkboxes
		$(container).find(".rt_checkbox").rt_checkbox();  

		//range inputs
		if( purpose == "open_template" ){
			$(container).find(".grid_options_hidden .range"+randomClass).rangeinput();   	
		}else{
			$(container).find(".range"+randomClass).rangeinput();  
		}
		
		//hidden options
	 	$(container).find(".div_controller").trigger("change");
 
		$(container).find(".color_field input").each(function(){

			if( $(this).hasClass("hidden_slide_item") == false ){
				$(this).spectrum({ 
					flat: false,
					showInput: true,
					showButtons: false,
					showAlpha: true, 
					move: function(color) {
 						 
 						var value; 
						if( color.getAlpha() < 1 ){
							value = color.toRgbString();
						}else{
							value = color.toHexString();
						}
 						
 						$(this).val( value );
 						$(this).attr("value", value );
 

					},

					change: function(color) { 
						
 						var value; 
						if( color.getAlpha() < 1 ){
							value = color.toRgbString();
						}else{
							value = color.toHexString();
						}
 						
 						$(this).val( value );
 						$(this).attr("value", value );

					},

					hide: function(color) {

						if ( $(this).val() == "" &&  color.toHexString() == "#ffffff" ){

	 						var value; 
							if( color.getAlpha() < 1 ){
								value = color.toRgbString();
							}else{
								value = color.toHexString();
							}
	 						
	 						$(this).val( value );
	 						$(this).attr("value", value );

						}
					}					
				}); 


				$(this).show(function(){
					if( $(this).val() == "" ){
						$(this).spectrum("set", "#ffffff" );
						$(this).attr("value", "" );
					}
				});				
			}
	    }); 
	}; 

	$.fn.start_scripts("body .right-col, .widgets-holder-wrap","","page_load");
})(jQuery);


/*
*
*	COLOR SELECTOR FIELD FIX
*
*/	 
(function($){  

	$(document.body).on('keyup', '.color_field input', function(event) { 

		var thecolor = $(this).val();

		//check the hex code
		var hexcode = thecolor.search(/#/i);

		if( hexcode != 0 && thecolor != "" ){
			thecolor = "#"+thecolor;
		}
		
		$(this).spectrum("set", thecolor );
		$(this).attr("value", thecolor );

		if( $(this).val() == "" ){
			$(this).spectrum("set", "#ffffff" );
			$(this).attr("value", "" );
		}
 
	}); 


})(jQuery);

/*
*
*	ACTIVATE TINYMCE EDITOR FOR TEXTAREAS IN POPUPS
*
*/	 
(function($){  

	$(window).load(function() { //acitave the html view of hidden editor
		$("#rt_hidden_rich_editor-tmce").trigger('click'); 
	});

	$.fn.rt_load_rich_editor = function(container) {
 
		if( "undefined"!=typeof tinyMCE ){  
			if( "undefined" !=typeof tinymce.execCommand ){ 

				container.find(".wp-editor-area").each(function () {
					textareaID = $(this).attr("id");   
					start_mce = tinymce.execCommand('mceAddEditor',false, textareaID );

					if ( "undefined"!=typeof start_mce ) {
						wpActiveEditor = textareaID 
					}else{
						$(this).parents(".tmce-active:eq(0)").find(".wp-editor-tools").remove(); 
						$(this).parents(".tmce-active:eq(0)").removeClass("tmce-active");  
					}

				});

			}else{ 

				container.find(".tmce-active").each(function () {
					$(this).removeClass("tmce-active"); 
					$(this).find(".wp-editor-tools").remove(); 
				}); 
			}
		}
	};  

	$.fn.rt_destroy_rich_editor = function(container) {
 
		if( "undefined"!=typeof tinyMCE ){  
			if( "undefined" !=typeof tinymce.execCommand ){ 
				
				container.find(".wp-editor-area").each(function () {
					tinymce.execCommand('mceRemoveEditor',true, $(this).attr("id")); 
				}); 
			}    
		}
	}; 		

	//switch tabs
	$(document.body).on('click', '.rt_switchEditors', function(event) { 

		var switchto = $(this).attr("data-switchto");
		var this_wrap = $(this).parents(".wp-editor-wrap");
		var this_editor = this_wrap.find("textarea:eq(0)");
		var this_editor_id = this_editor.attr("id"); 

 		if( switchto == "text" ){ 
 			tinymce.execCommand('mceRemoveEditor',true, this_editor_id );  
 			this_wrap.removeClass('tmce-active').addClass('html-active'); 
 		}else{ 
 			tinymce.execCommand('mceAddEditor',false, this_editor_id );
 			wpActiveEditor = textareaID;
			this_wrap.removeClass('html-active').addClass('tmce-active'); 
 		}

	});

})(jQuery);
 

/*
*
*	TEMPLATE MODULE WIDHTS
*
*/	

jQuery(function($){
	$(document.body).on('click', '.incr, .decr', function(event) { 


		var layoutList = [];
			layoutList[1]= {"value" : "one", "name" : "1:1" };
			layoutList[2]= {"value" : "four-five", "name": "4:5" };
			layoutList[3]= {"value" : "three-four", "name": "3:4" };
			layoutList[4]= {"value" : "two-three", "name": "2:3" };
			layoutList[5]= {"value" : "two", "name": "1:2" };
			layoutList[6]= {"value" : "three", "name": "1:3" };
			layoutList[7]= {"value" : "four", "name": "1:4" };			
			layoutList[8]= {"value" : "five", "name": "1:5" };


		var thisItemHolder  = $(this).parents("li:eq(0)");
		var thisLayout  	 = thisItemHolder.find(".layout_value:eq(0)");
		var thisLayoutValue  = thisLayout.val();
		var nextValue =  parseInt(thisLayoutValue) + 1;
		var prevValue =  parseInt(thisLayoutValue) - 1;


		if( nextValue > layoutList.length - 1 ) nextValue = 1;
		if( prevValue < 1 ) prevValue = 8;


		if($(this).hasClass("incr")){			
			thisLayout.val(prevValue); 
			thisItemHolder.attr('class',"rt-ui-sortable column "+ layoutList[ prevValue ]["value"]);		
		}

		if($(this).hasClass("decr")){ 
			thisLayout.val(nextValue); 
			thisItemHolder.attr('class',"rt-ui-sortable column "+ layoutList[ nextValue ]["value"]);
		} 

		var thisLayoutNewValue  = thisLayout.val();
		
		$(this).parents(".columnheader:eq(0)").find("span.text").text(layoutList[ thisLayoutNewValue ]["name"]);

		return false;

	});


	$(document.body).on('dblclick', '.incr, .decr', function(event) { 
		return false;
	});	     
}); 



/*
*
*	SELECTED ROW
*
*/	

jQuery(function($){
	$(document.body).on('click', '.page-template-grid-table', function(event) { 
		$(".page-template-grid-table").removeClass("selected_row");
		$(this).toggleClass("selected_row");
	});
});


/*
*
*	UPLOAD MEDIA
*
*/	
 
(function($){
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
					this_image_holder.find("img").attr("src",attachment.url);  
					this_image_holder.addClass("visible"); 						
				}else{
					this_image_holder.find("img").attr("src","");  
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
		this_image_holder.find("img").attr("src",""); 
		$(this).parent(".uploaded_file").removeClass("visible");
  
	});         

	//auto select
	$('.upload_field').focus(function() {
		$(this).select();
	});

		 
})(jQuery);




/*
*
*	UPLOAD MEDIA FOR ID 
*
*/	
 
(function($){
	
	$(document).on('click', '.rttheme_image_upload_button', function(e) { 

		var url_field = $(this).prev(); 
			this_image_holder = $('[data-holderid="'+ $(this).data("inputid") +'"]');   	

			e.preventDefault();

			//If the uploader object has already been created, reopen the dialog
			if (custom_uploader) {
				custom_uploader.open();
				return;
			}

			//Extend the wp.media object
			var custom_uploader = wp.media.frames.downloadable_file = wp.media({
				title: wp.media.view.l10n.addMedia, 
				multiple: false
			});

			//When a file is selected, grab the URL and set it as the text field's value
			custom_uploader.on('select', function() {
				var attachment = custom_uploader.state().get('selection').first().toJSON(); 

				url_field.val(attachment.id);

				if( attachment.type == "image" ){
					this_image_holder.find("img").attr("src",attachment.url);  
					this_image_holder.addClass("visible"); 						
				}else{
					this_image_holder.find("img").attr("src","");  
					this_image_holder.removeClass("visible"); 											
				}

			});

			//Open the uploader dialog
			custom_uploader.open(); 

	}); 		

})(jQuery);


/*
*
*	UPLOAD MULTIPLE IMAGES
*
*/	
 
(function($){
	$(document).on('click', '.rt_gallery_add_button', function(e) { 

		var custom_uploader;
		var $this = $(this);

			e.preventDefault();

			//If the uploader object has already been created, reopen the dialog
			if (custom_uploader) {
				custom_uploader.open();
				return;
			}

			//Extend the wp.media object
			custom_uploader = wp.media.frames.file_frame = wp.media({
				title: wp.media.view.l10n.addMedia, 
				multiple: true
			});


			//When a file is selected, grab the URL and set it as the text field's value
			custom_uploader.on('select', function() {
				
				var selection = custom_uploader.state().get('selection');
				var list = $("#rt-gallery-images");				
				var new_list =  list.val(); 	
					 				  
					selection.map( function( attachment ) {
						 
						attachment = attachment.toJSON();
						
						//update the image list values
						if(new_list == ""){
							new_list = attachment.url;
						}else{
							new_list = new_list +","+ attachment.url;
						}
						
						//update visible images
						$(".rt-gallery-uploaded-photos").append('<li><img src="'+attachment.url+'" data-rel="'+attachment.url+'"></li>');

					});

				list.val(new_list);

			}); 

			//Open the uploader dialog
			custom_uploader.open(); 
	}); 		 

})(jQuery);


			 
/*
*
*	FEATTURED IMAGE GALLERY
*
*/	
 
jQuery(document).ready(function($) {	
	 
 
		//start sortables
		$("ul.rt-gallery-uploaded-photos").sortable({handle:'img',forceHelperSize: true,  opacity: 0.5,scroll: true, scrollSpeed: 20, cursor: "move", distance: 10, placeholder : 'ui-sortable-placeholder', tolerance: 'pointer',

			start: function(e, ui){ 
				var item = ui.item;  

				ui.placeholder.width(ui.item.width()); 						 
				ui.placeholder.height(ui.item.height()); 						 
 
			},

			update: function(e, ui){ //save new order
  
				var list = $("#rt-gallery-images");
				var new_list = "";

				$(this).find("li").each(function(){

					var img_url = $(this).find("img").attr("data-rel") ;

					if ( new_list == "" ){
						new_list = img_url;	
					}else{
						new_list = new_list + "," + img_url;
					}
					
					
				});	

				list.val(new_list); 
				
			},			

		}); 		 
 
 		//delete button
	 	$(document.body).on('mouseenter', '.rt-gallery-uploaded-photos li', function() { 
	 		var delete_image = '<div class="gallery_delete"></div>';
	 		var old_delete_image = $(this).find(".gallery_delete");
			
 
	 		if( old_delete_image.length ){
				old_delete_image.show();
	 			return false;	 			
	 		}else{
	 			$(this).append(delete_image);
	 		}			

		});


	 	$(document.body).on('mouseleave', '.rt-gallery-uploaded-photos li', function() { 
 			$(this).find(".gallery_delete").hide();
		});
 

		//delete an image
	 	$(document.body).on('click', '.rt-gallery-uploaded-photos li .gallery_delete', function() { 

			var confirm_message = confirm(delete_confirm);		
			var $this = $(this) ;

	 			var list = $("#rt-gallery-images");
	 			var list_array = list.val().split(",");
	 			var this_image_holder = $this.parent("li");
	 			var item_to_delete = this_image_holder.find("img:eq(0)").attr("data-rel");
	 			 
 					if(confirm_message){

						//delete the url from the input
						list_array = jQuery.grep(list_array, function(value) {
						  return value != item_to_delete;
						});

						//update the list
						var new_list = list_array.join();
						list.val(new_list);

						//remove the holder		 			  
						$this.parent("li").remove();
						return true;
					}					   

			return false;    

		});

});
 		 

/*
*
*	SHOW / HIDE HIDDEN OPTIONS
*
*/	
 
(function($){

	//color sets and backgrounds
	$(document).on('change', '.div_controller' ,function() { 

		var selected_option = $('option:selected', this).val();
		var options_set = $(this).parents(".options_set_holder:eq(0)").find(".hidden_options_set:eq(0)");

		if( selected_option === "new" || selected_option === "boxed-body" || selected_option === "half-boxed" || selected_option === "disabled_parallax" ){
			options_set.slideDown("fast");
		}else{
			options_set.slideUp("fast");
		}
	});
 
	$(".div_controller").trigger("change");

})(jQuery);


/*
*
*	SHOW / HIDE CUSTOM HEADER BACKGROUND OPTIONS
*
*/	
 
(function($){
	$(document.body).on('change', '.header_select_option', function() { 

		var selected_option = $('option:selected', this).val();
		var background_option = $(this).parents(".grid_holder:eq(0)").find(".header_background_options");


		if( selected_option === "default" ){
			background_option.slideUp("fast");
		}

		if( selected_option !== "default" ){
			background_option.slideDown("fast");
		}		
	});
})(jQuery);
 

/*
*
*	SHOW / HIDE RELATED OPTIONS ON THE HEADER OPTIONS PAGE
*
*/	
 
(function($){
	
	$(document).on('change', '#rt_header_options .div_controller' ,function() { 

		var selected_option = $('option:selected', this).val();
		var options_set = $(this).parents(".options_set_holder:eq(0)").find(".hidden_options_set");

		options_set.each(function(){
			if( $(this).hasClass( selected_option ) ){

				$(this).slideDown("fast");
			}else{
				$(this).slideUp("fast");
			}
		});

	});
 
	$("#rt_header_options .div_controller").trigger("change");

})(jQuery);
 

/*
*
*	TEMPLATE SEARCH
*
*/	

(function($){

	$(document.body).on('keyup', '#rt_template_search', function() {  
		// Retrieve the input field text and reset the count to zero
		var filter = $(this).val(), count = 0;

		// Loop through the comment list
		$(".list_templates > li").each(function(){
			var templatename = $(this).attr("data-templatename");
			var templateid = $(this).attr("data-templateid");


			// If the list item does not contain the text phrase fade it out
			if (  templatename.search(new RegExp(filter, "i")) < 0 && templateid.search(new RegExp(filter, "i")) < 0 ) {
				$(this).fadeOut();

			// Show the list item if the phrase matches and increase the count by 1
			} else {
				$(this).show();
				count++;
			}
		});

		// Update the count
		var numberItems = count;
		$("#rt_template_search_result").text(count + " templates found");
	});
})(jQuery);

/*
*
*	ICON SELECTION FOR THEME OPTIONS
*
*/	

jQuery(function($){  

	$(document.body).on('keyup', '#rt_icon_search', function() {  
		// Retrieve the input field text and reset the count to zero
		var filter = $(this).val(), count = 0;

		// Loop through the comment list
		$(".list-icons li").each(function(){

			// If the list item does not contain the text phrase fade it out
			if ($(this).find("span").text().search(new RegExp(filter, "i")) < 0) {
				$(this).fadeOut();

			// Show the list item if the phrase matches and increase the count by 1
			} else {
				$(this).show();
				count++;
			}
		});

		// Update the count
		var numberItems = count;
		$("#rt_icon_search_result").text(count + " icons found");
	});

	function rt_icon_selection( event ) { 
 
	  	purpose = event.data.purpose;
	  	thisField = $(event.target); 
		iconSelector = $(".icon-selection");

		if( purpose == "item" ){ 
			$(".icon-selection").removeClass("admin_bar"); 
		}else{ 
			$(".icon-selection").addClass("admin_bar"); 
		}

		if (iconSelector.length == 0){ 
 
			$('<div class="rt_loading_bar"></div>').appendTo("body");//create loading bar

			data = 'action=my_action&iconSelector=true';
			$.post(ajaxurl, data, function(response) {			   
				$('.rt_loading_bar').remove();  

					if( purpose == "item" ){
						$(response).appendTo("body").fadeIn(500);  
						$(".icon-selection .blank").show();
					}else{
						$(response).addClass("admin_bar").appendTo("body").fadeIn(500); 
						$(".icon-selection .blank").hide();
					} ;

			});		
		} else{
			$(iconSelector).fadeIn(500);  

			if( purpose == "item" ){ 
				$(".icon-selection .blank").show();
			}else{ 
				$(".icon-selection .blank").hide();
			}			
		}	


		$(document.body).on('click', '.icon_selection_close', function() {  	
			$(".icon-selection").hide();
			thisField.focus();
		}); 


		$(document.body).on('click', '.list-icons li', function() {  

			if( purpose == "item" ){
				var selectted_icon_name = $.trim($(this).attr('class')); 
				var thisField 	= $(event.target); 
				var thisFieldVal  = $(thisField).val();

				var classNames = thisFieldVal.split(" ");
				var newclassNames = "";
				var jump = 1;

 
				for (i = 0; i < classNames.length; i++ ) { 

						if( classNames[i].search(/icon-/i) == 0 && selectted_icon_name == "blank" ) { //found & deleted
							newclassNames += "";  
						}else if( classNames[i].search(/icon-/i) == 0 && selectted_icon_name != "blank" && jump == 1) { //found & replaced
							newclassNames += selectted_icon_name;	 
							jump = jump+1; 

						}else if( classNames[i].search(/icon-/i) < 0 && selectted_icon_name != "blank" && jump == 1) { // not found & added
							newclassNames += " " + classNames[i] + " " + selectted_icon_name;	 

							jump = jump+1;		
						}else{
							newclassNames += " " + classNames[i]; 	
						}

				}
 
				$(thisField).val( $.trim(newclassNames) );  
			 
					
				$(".icon-selection").hide(); 

				$(document.body).off('click', '.list-icons li');
			}

		});


	} 
 
	$(document.body).on('click', '.icon_selection,.edit-menu-item-classes', { purpose: "item" }, rt_icon_selection ) ;
	$("#wp-admin-bar-rt_icons .ab-item div").on('click', { purpose: "admin_bar" }, rt_icon_selection ) ;

});


/*
*
*	SAVE TEMPLATES
*
*/	

jQuery(function($){   
	$( ".rt_options_ajax_save, #footer_submit").on("click", function(){


		$('<div class="rt_loading_bar"></div>').appendTo("body");//create loading bar

		var template_builder_page = $("#rt_template_options");

		if( template_builder_page.length > 0 ){
			thisForm = template_builder_page.find("form.active_template:eq(0)");
			thisFormID = thisForm.attr("id");
		}else{
			thisForm = $(this).parents("form:eq(0)");
			thisFormID = $(this).parents("form:eq(0)").attr("id");					
		}

		if( ! thisFormID ) {
			alert( select_a_template );
			return false; 
		}

		// prepare tinMCE textareas to save
		if( "undefined"!=typeof tinyMCE ) tinyMCE.triggerSave(); 

		//searialize the form
		serialize_form = $(thisForm).serialize();
 
		//ajax form data 
		data = serialize_form +'&action=my_action&saveoptions=true&formid='+thisFormID+'';

		//count & check input vars
		var count_input_vars = data.split("&").length;
		if( max_input_vars > 0 &&  max_input_vars < count_input_vars ){ 
			alert( err_max_input_vars ); 
			$('.rt_loading_bar').remove();
			return false;
		}
			 
		//ajax action 
		$.post(ajaxurl, data, function(response) {		 
			$('.rt_loading_bar').remove();
			$('<div class="rt-save-message success_response">'+response+'</div>').css({'margin':'0','position':'fixed','top':jQuery(window).height()/2-100,'left':jQuery(window).width()/2-100}).appendTo("body").fadeIn(500).delay(1500).fadeOut(300); 		

			//save control
			window.save_control = serialize_form;

			return true;  
		}); 
	 
	}); 

}); 


/*
*
*	ADD NEW MODULE
*
*/	

jQuery(function($){  

	//add
	$(document.body).on('click', '.module_add_button', function() {   


		var thisContainer   = $(this).parent(".form_element"); 
		var thisTemplate    = $(this).parents('form:eq(0)');
		var theTemplateID   = thisTemplate.attr("id"); 
		var selectedItem    = $('#'+theTemplateID+' .module_select_box option:selected').val();  

		if ( selectedItem == "0" ) {	
			thisTemplate.find(".module_select_box").effect("highlight", {color:"#AF1313"}, 1000);
			return false; 
		}else{ 
			//close open modules before add 
			$(".active_module .module_close").trigger('click');  
		}


		var numRand         = Math.floor(Math.random()*182701);
		var randomClass     = numRand+'_class'; 
		var theGroupID      = numRand; 
		var headerRow       = $('#'+theTemplateID+' ul.header_purpose');
		var footerRow       = $('#'+theTemplateID+' ul.footer_purpose'); 
		var firstContentRow = $('#'+theTemplateID+' ul.content_purpose:eq(0)');
		var selectedContentRow = $('#'+theTemplateID+' .selected_row:eq(0) ul.rt-ui-sortable:eq(0) ');
		var lastGrid_table  = $('#'+theTemplateID+' .page-template-grid-table:eq(-1)');
		var lastGrid_div    = $('#'+theTemplateID+' div.content_row:eq(-1)'); 


 		if( selectedContentRow.length < 1 ){
 			selectedContentRow = firstContentRow;
 		}else{
 			headerRow = selectedContentRow;
 		}

		$('<div class="rt_loading_bar"></div>').appendTo("body");//create loading bar

		var data = {
			action: 'my_action',
			selectedItem: selectedItem,
			theTemplateID : theTemplateID,
			theGroupID: theGroupID,
			randomClass : randomClass
		};  
				  
		$.post(ajaxurl, data, function(response) {	 

			response = $(response); 

			response.addClass("new_module");

			if( selectedItem === "grid" ){ 
				$(lastGrid_div).after(response) 
				.hide().show('fade', { duration: 700, easing: 'swing' });   
				$.fn.start_scripts( response , "","new_module");   	
			}else if( selectedItem === "column" ){ 
				$(response).appendTo(selectedContentRow)
				.hide({duration: 300}).show('highlight', { duration: 700, easing: 'swing' });  
			}else if( selectedItem === "slider_box" ){  
				$(response).appendTo(headerRow);
			}else{ 
				$(response).appendTo(selectedContentRow); 
			}  

			//scroll to view
			thisTemplate.find(".modal_content").stop().animate({
				scrollTop: -1 * ( thisTemplate.find(".modules_holder").offset().top - $(response).offset().top ) 
			}, 600);

			response.find(".Itemheader").delay(600).effect("highlight", {color:"#DDF5C7"}, 1000, function(){ });			
			
			$.fn.start_sortables();
			$('.rt_loading_bar').remove(); 	 

		});


	});
 
});


/*
*
*	OPEN / CLOSE MODULES
*
*/	

jQuery(function($){  

	//close
	$(document.body).on('click', '.module_close', function() {   
 

 		var this_template = $(this).parents("form:eq(0)"); 
 		var this_module = $(this).parents("li:eq(0)"); 
 		var itemHeader = this_module.find(".Itemheader"); 
 		var ItemData = this_module.find(".ItemData"); 
 
  		//close active slides, tabs, accordions 
		$.fn.close_active_slides(this_module); 

 	 	this_module.removeClass("expanded active_module"); 
 	 	this_module.addClass("passive_module"); 

 	 	ItemData.hide();  

		this_module.hide('fade', { duration: 300, easing: 'swing' }).show('highlight', { duration: 300, easing: 'swing' });

		//destroy rich editors when dialog closed
		if( "undefined"!=typeof tinyMCE ){ 
			$.fn.rt_destroy_rich_editor(this_module); 
		}

		//scroll to view
		this_template.find(".modal_content").stop().animate({
			scrollTop: -1 * ( this_template.find(".modules_holder").offset().top - itemHeader.offset().top ) 
		}, 600); 

		//close icon selection
		$(".icon_close").trigger("click");
	});
	
	//close dbl click
	$(document.body).on('dblclick', '.rt-admin-wrapper .active_module .Itemheader', function() {  
		$(this).find(".module_close").trigger('click');   
	});

 
	//edit - open module
	$(document.body).on('click', '.module_edit', function() {  
 
 		var this_template = $(this).parents("form:eq(0)"); 
 		var this_module = $(this).parents("li:eq(0)"); 
 		var itemHeader = this_module.find(".Itemheader"); 
 		var ItemData = this_module.find(".ItemData");  

 	 	this_module.addClass("expanded"); 
 	 	this_module.addClass("active_module"); 
 	 	this_module.toggleClass("passive_module"); 

 	 	ItemData.show('fade', { duration: 300, easing: 'swing' }); 

 	 	//activate editor for content boxes 
		if( "undefined"!=typeof tinyMCE ){
			$.fn.rt_load_rich_editor($(this).parents("li.expanded.for_content_boxes:eq(0)"));
		}
		
		//start range inputs
		this_module.find(".range").rangeinput();  

		if(this_module.hasClass("new_module")){
			$.fn.start_scripts( this_module , "","new_module");   	
			this_module.removeClass("new_module"); 
			this_module.find('.slider_creator').create_sliders();
			this_module.find('.icon_list_holder').icon_list();
			this_module.find('.google_map_holder').map_list(); 
		}
		

	});

	//edit dbl click
	$(document.body).on('dblclick', '.rt-admin-wrapper .passive_module .Itemheader', function() {  
		$(this).find(".module_edit").trigger('click');   
	});
 
});



/*
*
*	COPY MODULES
*
*/	

jQuery(function($){  

	$(document.body).on('click', '.module_copy', function() {   
 
		var this_template = $(this).parents("form:eq(0)"); 
 		var this_template_id = this_template.attr("id");  
		var this_module = $(this).parents("li:eq(0)");  
		var itemHeader = this_module.find(".Itemheader"); 
 		var ItemData = this_module.find(".ItemData");   
 		var this_group_id = ItemData.find("[name^='theGroupID_']:eq(0)").val(); 
 

 		itemHeader.find(".module_close").trigger('click');  //close the module

 		//create form field values as html value
		this_module.find('input').each(function() { //text input
			$(this).attr("value",$(this).val());
		});

		this_module.find('textarea').each(function() { //textarea
			$(this).text( $(this).val() ) ; 
		}); 

		this_module.find('select').each(function() { //selectbox
			the_slected_one = $(this).find('option:selected'); 
			$(this).find("option").removeAttr('selected').removeAttr('id');  
			$(this).val( the_slected_one.val() );	 

			the_slected_one.each(function(){
				$(this).attr('selected','selected'); 
			});

			if( $(this).hasClass("multiple") ){
				$(this).removeAttr('style');  
				$(this).removeAttr('class');
				$(this).addClass('multiple').addClass( this_group_id+'_class' );
			}
		});
 
 		//create the cloned module 
 		$("#copied_module").html( this_module.clone() ); 

		//add datas
		$("#copied_module").find("li:eq(0)").attr("data-groupID", this_group_id).attr("data-template_id", this_template_id).addClass("cloned_module");

		//show paste button
		this_template.find(".module_paste_button").css({"display":"inline-block"}).effect("highlight", {color:"#67C228"}, 1400);
 
	}); 
 
});



/*
*
*	PASTE MODULES
*
*/	

jQuery(function($){  


	$(document.body).on('click', '.module_paste_button', function() {   
 	
 		var this_template = $(this).parents("form:eq(0)"); 
 		var this_template_id = this_template.attr("id");  
 		var new_module = $("#copied_module").find("li:eq(0)").clone();
		var firstContentRow = this_template.find('ul.content_purpose:eq(0)');
		var new_group_id =   Math.floor(Math.random()*1182701);

		var selectedContentRow = this_template.find('.selected_row:eq(0) ul.rt-ui-sortable:eq(0) ');
 		if( selectedContentRow.length < 1 ){
 			selectedContentRow = firstContentRow;
 		}

		$(".active_module").find(".module_close").trigger('click');  //close the active module

		var cloned_group_id = new_module.attr('data-groupID');
		var cloned_template_id = new_module.attr('data-template_id');


 		//create the cloned module	
		var regexExpression = new RegExp(cloned_group_id, 'ig'); 
		var regexExpression2 = new RegExp(cloned_template_id, 'ig'); 

		var newhtml = $("#copied_module").clone().html().replace(regexExpression,new_group_id); 
		newhtml = newhtml.replace(regexExpression2,this_template_id); 
  
		$(newhtml).appendTo(selectedContentRow); 


		//scroll to view
		this_template.find(".modal_content").stop().animate({
			scrollTop: -1 * ( this_template.find(".modules_holder").offset().top - $(this_template).find(".cloned_module").offset().top ) 
		}, 600);

 		$(this_template).find(".cloned_module").hide().show('fade', { duration: 1500, easing: 'swing' }, function(){ 
			$(this).removeClass("cloned_module").removeAttr("style"); 
 
				$(this).find(".rangeinput .slider").remove(); //remove range sliders  
				$(this).find(".range").removeAttr("class").addClass("range").addClass(new_group_id);


				$(this).find(".asmContainer").each(function(){ //correct multiselects 
					$(this).find(".multiple").appendTo( $(this).parent(".form_element") ); 
					$(this).remove(); 
				});  
				$(this).addClass("new_module");

		});
 
	}); 

});

/*
*
*	CLONE MODULES
*
*/	

jQuery(function($){  

	$(document.body).on('click', '.module_clone', function() {   
 
 		var this_template = $(this).parents("form:eq(0)"); 
 		var this_template_id = this_template.attr("id");  
		var this_module = $(this).parents("li:eq(0)");  
		var itemHeader = this_module.find(".Itemheader"); 
 		var ItemData = this_module.find(".ItemData");   
 		var this_group_id = ItemData.find("[name^='theGroupID_']:eq(0)").val(); 
 		var new_group_id =   Math.floor(Math.random()*182701);
		 
		var randomClass  = new_group_id+'_class'; 

 		itemHeader.find(".module_close").trigger('click');  //close the module

 		//create form field values as html value
		this_module.find('input').each(function() { //text input
			$(this).attr("value",$(this).val());
		});

		this_module.find('textarea').each(function() { //textarea
			$(this).text( $(this).val() ) ; 
		}); 

		this_module.find('select').each(function() { //selectbox
			the_slected_one = $(this).find('option:selected'); 
			$(this).find("option").removeAttr('selected').removeAttr('id');  
			$(this).val( the_slected_one.val() );	 

			the_slected_one.each(function(){
				$(this).attr('selected','selected'); 
			});

			if( $(this).hasClass("multiple") ){
				$(this).removeAttr('style');  
				$(this).removeAttr('class');
				$(this).addClass('multiple').addClass(randomClass);
			}
		});


 		//create the cloned module	
		var regexExpression = new RegExp(this_group_id, 'ig'); 
		var newhtml = this_module.clone().html().replace(regexExpression,new_group_id);  
		var new_module = '<li class="cloned_module '+ this_module.attr("class") +' '+ randomClass +' " style="display:none;">' + newhtml + '</li>' ; 
 	
		this_module.after(new_module); 

		$(this_template).find(".cloned_module").show('fade', { duration: 1000, easing: 'swing' }, function(){ 
			$(this).removeClass("cloned_module").removeAttr("style"); 
 
				$(this).find(".rangeinput .slider").remove(); //remove range sliders  
				$(this).find(".range").removeAttr("class").addClass("range").addClass(randomClass);


				$(this).find(".asmContainer").each(function(){ //correct multiselects 
					$(this).find(".multiple").appendTo( $(this).parent(".form_element") ); 
					$(this).remove(); 
				});  
				$(this).addClass("new_module");

		});
 
	});
 
 
});

/*
*
*	DELETE MODULES
*
*/	

jQuery(function($){  

	//close
	$(document.body).on('click', '.module_delete', function() {   

		var delete_confirm_message = confirm(delete_confirm);

		if( ! delete_confirm_message ){ 
			return false; 
		} 	
 
		var this_module = $(this).parents("li:eq(0)");   
		 
		this_module.find(".module_close").trigger('click');  

		this_module.find(".Itemheader").effect("highlight", {color:"#AF1313"}, 1000, function(){
			this_module.remove();
		});

	});
 
 
});
 

/*
*
*	START MULTIPLE SELECTION FOR WIDGETS
*
*/	
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


/*
*
*	FONT SELECTOR
*
*/	

jQuery(function($){

	//load samples
	$(document.body).on('load', '.fontlist', function() {

		var sind =jQuery(this).val();
		if(sind){
			jQuery(this).parents("table").find("iframe").show();
		}else{
			jQuery(this).parents("table").find("iframe").hide();
		} 
	}); 

	//change samples
	$(document.body).on('change', '.fontlist', function() {
		 
		var system = $('option:selected', this).attr('data-font-type');
		var family_name = $('option:selected', this).attr('data-font-family');
		var font_face 	= $('option:selected', this).val(); 
 
		$(this).parents("table:eq(0)").find("iframe").attr('src',frameworkurl+'?font_face='+font_face+'&system='+system+'&family_name='+family_name+'');
		
		if(font_face){
			$(this).parents("table:eq(0)").find("iframe").show();
		}else{
		 	$(this).parents("table:eq(0)").find("iframe").hide();
		}
	}); 

});


/*
*
*	DELETE TEMPALTE
*
*/	

jQuery(function($){

	$(document.body).on('click', "#rt_template_options .template_controls [data-scope='delete']", function() { 

		var confirm_message = confirm(template_delete_confirm);

		if(confirm_message){ 

			var TemplateID = $(this).attr("data-templateid"); 
			var TemplateForm = $( "#"+TemplateID );

			//delete from db
			$('<div class="rt_loading_bar"></div>').appendTo("body");//create loading bar
 
			data = 'action=my_action&saveoptions=true&delete_template=true&templateID='+TemplateID+'&formid='+TemplateID+'';
			$.post(ajaxurl, data, function(response) {			   
				$('.rt_loading_bar').remove(); 
				$('<div class="rt-save-message success_response">'+response+'</div>').css({'margin':'0','position':'fixed','top':$(window).height()/2-100,'left':$(window).width()/2-100}).appendTo("body").fadeIn(500).delay(1500).fadeOut(300); 
			});			  
 
			//delete visually
			$(".list_templates ."+TemplateID).remove();		    		
			$("#"+TemplateID).remove();		    		

			return true;
		}

		return false;

	});
});

/*
*
*	CLONE TEMPLATE
*
*/	
 
(function($){
	$(document.body).on('click', "#rt_template_options .template_controls [data-scope='clone']", function() { 

		var TemplateID = $(this).attr("data-templateid"); 
		var TemplateForm = $( "#"+TemplateID );

		$('<div class="rt_loading_bar"></div>').appendTo("body");//create loading bar 
		 

		var data = {
			action: 'my_action',
			thisTemplateID: TemplateID,
			clone:'true'
		};
				  
		$.post(ajaxurl, data, function(response) {	 
			$('.rt_loading_bar').remove();
			$('<div class="rt-save-message success_response">'+response+'</div>').css({'margin':'0','position':'fixed','top':jQuery(window).height()/2-100,'left':jQuery(window).width()/2-100}).appendTo("body").fadeIn(500); 
			$('body').css({"overflow":"hidden"});	

			//refresh without other atts
			url = $(location).attr('protocol') + "//"+  $(location).attr('hostname') + $(location).attr('pathname') + "?page=rt_template_options";			
			window.location= url;							
		});

	}); 		
})(jQuery);


/*
*
*	EXPORT SINGLE TEMPLATE
*
*/	
 
(function($){
	$(document.body).on('click', "#rt_template_options .template_controls [data-scope='export-single-template']", function() {  
		var thisForm = $(this).find("form:eq(0)");   
		thisForm.submit();  
	}); 		
})(jQuery);


/*
*
*	CREATE TEMPLATE
*
*/	
 
(function($){
	$(document.body).on('click', "#rt_template_options [data-scope='create-template']", function() { 
 

		var TemplateID = $(this).attr("data-templateid"); 
		var TemplateForm = $( "#"+TemplateID ); 


		$('<div class="rt_loading_bar"></div>').appendTo("body");//create loading bar

		var template_builder_page = $("#rt_template_options"); 

		// prepare tinMCE textareas to save
		if( "undefined"!=typeof tinyMCE ) tinyMCE.triggerSave(); 

		//searialize the form
		serialize_form = TemplateForm.serialize();

		//ajax form data 
		data = serialize_form +'&action=my_action&templateBuilder=true&new_template=true&saveoptions=true&formid='+TemplateID+'';
		 
		//ajax action 
		$.post(ajaxurl, data, function(response) {			   
			$('.rt_loading_bar').remove();
			$('<div class="rt-save-message success_response">'+response+'</div>').css({'margin':'0','position':'fixed','top':jQuery(window).height()/2-100,'left':jQuery(window).width()/2-100}).appendTo("body").fadeIn(500); 		
			$('body').css({"overflow":"hidden"});
			
			//refresh without other atts
			url = $(location).attr('protocol') + "//"+  $(location).attr('hostname') + $(location).attr('pathname') + "?page=rt_template_options";			
			window.location= url;

		}); 
	  

	}); 		
})(jQuery);


/*
*
*	SELECT SUB MENUS - STYLING OPTIONS
*
*/	
(function($){
	"use strict";
	
	$(".admin_sub_menu li").on("click",function() {

		$(".admin_sub_menu li").removeClass("active");
		$(this).addClass("active");
		$('#styling_options_parts > div').hide().removeClass("active"); 
		var target = $('#styling_options_parts').find("#"+$(this).attr("data-scope"));   
		$(target).stop().animate({height: "toggle", opacity: "toggle"}, { duration: 500 }).toggleClass("active"); 

	}); 
	   
})(jQuery); 


/*
*
*	IMPORT TEMPLATES
*
*/	
 
(function($){
	$("#import_templates_submit").on('click', function() { 
		$('<div class="rt_loading_bar"></div>').appendTo("body");//create loading bar
	}); 	

	$("#rt_template_options [data-scope='import-template']").on('click', function() { 
		$('.import_tempalte').effect("highlight", 700); 
	}); 				
})(jQuery);

/*
*
*	RESET TEMPLATES
*
*/	
 
(function($){
	$("#rt_template_options [data-scope='reset-template']").on('click', function() { 
		var reset_template_builder_message = confirm(reset_template_builder);
		if( ! reset_template_builder_message){ 
		  return false; 
		}
	}); 				
})(jQuery);



/*
*
*	CREATE SIDEBAR
*
*/	
 
(function($){
	$(document.body).on('click', "#create_new_sidebar", function() {  

		var sidebarID = $(this).attr("data-sidebarid"); 
		var sidebarName = $('#new_sidebar_name').val(); 

 		$('<div class="rt_loading_bar"></div>').appendTo("body");//create loading bar 

		//ajax form data 
		data = '&action=my_action&sidebarCreator=true&new_sidebar=true&sidebarID='+sidebarID+'&sidebarName='+sidebarName+'';
		 
		//ajax action 
		$.post(ajaxurl, data, function(response) {			   
			$('.rt_loading_bar').remove();
			$('<div class="rt-save-message success_response">'+response+'</div>').css({'margin':'0','position':'fixed','top':jQuery(window).height()/2-100,'left':jQuery(window).width()/2-100}).appendTo("body").fadeIn(500); 		
			$('body').css({"overflow":"hidden"});
			location.reload();	
		}); 
	  

	}); 		
})(jQuery);

/*
*
*	UPDATE SIDEBAR
*
*/	
 
(function($){
	$(document.body).on('click', ".update_sidebar", function() { 
 	 
		var sidebarID = $(this).attr("data-sidebarid"); 
		var sidebarName = $('#'+ sidebarID +'').val(); 

 		$('<div class="rt_loading_bar"></div>').appendTo("body");//create loading bar 

		//ajax form data 
		data = '&action=my_action&sidebarCreator=true&update_sidebar=true&sidebarID='+sidebarID+'&sidebarName='+sidebarName+'';
		 
		//ajax action 
		$.post(ajaxurl, data, function(response) {			   
			$('.rt_loading_bar').remove();
			$('<div class="rt-save-message success_response">'+response+'</div>').css({'margin':'0','position':'fixed','top':jQuery(window).height()/2-100,'left':jQuery(window).width()/2-100}).appendTo("body").fadeIn(500).delay(1500).fadeOut(300); ; 		
		}); 

	}); 
})(jQuery);


/*
*
*	DELETE SIDEBAR
*
*/	
 
(function($){
	$(document.body).on('click', "[data-scope='delete-sidebar']", function() { 
 	 
		var sidebarID = $(this).attr("data-sidebarid");  

 		$('<div class="rt_loading_bar"></div>').appendTo("body");//create loading bar 

		//ajax form data 
		data = '&action=my_action&sidebarCreator=true&delete_sidebar=true&sidebarID='+sidebarID+'';
		 
		//ajax action 
		$.post(ajaxurl, data, function(response) {			   
			$('.rt_loading_bar').remove();
			$('<div class="rt-save-message success_response">'+response+'</div>').css({'margin':'0','position':'fixed','top':jQuery(window).height()/2-100,'left':jQuery(window).width()/2-100}).appendTo("body").fadeIn(500).delay(1500).fadeOut(300); ; 		
			$('li.'+sidebarID+'').remove();//remove sidebar
		}); 

	}); 
})(jQuery);

/*
*
*	ENABLE SIDEBAR
*
*/	
 
(function($){
	$(document.body).on('click', ".sidebar_visibility", function() { 
 	 
		var sidebarID = $(this).attr("data-sidebarid");  

 		$('<div class="rt_loading_bar"></div>').appendTo("body");//create loading bar 
 
 		//visibility
 		var visibility = $(this).attr("data-scope");  

 		var action;

 		//update the visibility 
 		if ( visibility == "enable" ){
 			$(this).attr("data-visibility","disabled");
 			$(this).attr("data-scope","disable");
 			$(this).find("span").removeAttr("class").addClass("icon-thumbs-down-1");
 			$(this).toggleClass("enable_sidebar");
 			action = "disable";
 		}else{
 			$(this).attr("data-visibility","enabled");
 			$(this).attr("data-scope","enable");
 			$(this).find("span").removeAttr("class").addClass("icon-thumbs-up-1");
 			$(this).toggleClass("enable_sidebar");
 			action = "enable";	
 		}

		//ajax form data 
		data = '&action=my_action&sidebarCreator=true&enable_sidebar=true&sidebarID='+sidebarID+'&visibility='+action+'';
		 
		//ajax action 
		$.post(ajaxurl, data, function(response) {			   
			$('.rt_loading_bar').remove();
			$('<div class="rt-save-message success_response">'+response+'</div>').css({'margin':'0','position':'fixed','top':jQuery(window).height()/2-100,'left':jQuery(window).width()/2-100}).appendTo("body").fadeIn(500).delay(1500).fadeOut(300); ; 		
		}); 
		
	}); 
})(jQuery);

/*
*
*	OPEN / CLOSE / CREATE TEMPLATE CONTENT FORMS
*	edit template 
*/	

jQuery(function($){
	$(document.body).on('click', "#rt_template_options [data-scope='edit-template']", function(event) { 
 
		var TemplateID = $(this).attr("data-templateid"); 
		var TemplateForm = $( "#"+TemplateID );

		//reset & remove body scroll
		$('html, body').css({"overflow":"hidden"}).scrollTop(0);

		//open the modal
		$( TemplateForm ).find(".rt_modal").show('fade', { duration: 300, easing: 'swing' });


		TemplateForm.addClass("active_template");

		//load the forms
		if( TemplateForm.hasClass('loaded') == false ){


			$('<div class="rt_loading_bar"></div>').appendTo("body");//create loading bar

			var data = {
				action: 'my_action',
				thisTemplateID: TemplateID,
				generateForms:'true'
			};
		
			//fix ajax url for WPML
			if ( "undefined"!=typeof icl_this_lang ){
				ajaxurl = ajaxurl + "?lang="+icl_this_lang+"";
			}

			$.post(ajaxurl, data, function(response) {	  

				$("#"+TemplateID+" .modules_holder").prepend(response);	  
				

				TemplateForm.addClass("loaded");				

				$.fn.start_scripts("#"+TemplateID,"","open_template");				 

				$('#'+TemplateID+' .slider_creator').create_sliders();
				$('#'+TemplateID+' .icon_list_holder').icon_list();
				$('#'+TemplateID+' .google_map_holder').map_list();

				$.fn.start_sortables();					

				//save control
				window.save_control = TemplateForm.serialize();

				//module select
				$("#"+TemplateID+" .module_select_box .module_list").customSelect( { customClass: "module_select" } );

				//remove loading bar
				$(".rt_loading_bar").remove();
			});
			
		}else{
			//open the modal
			$( TemplateForm ).find(".rt_modal").css({"display":"block"});

			//save control
			window.save_control = TemplateForm.serialize();
		}	
 

		//make paste button visible if clioboard is not empty
		if ( $("#copied_module").find("li:eq(0)").length > 0 ){
			TemplateForm.find(".module_paste_button").css({"display":"inline-block"});
		}	
	});   
 	
 	//open template if clicked from front-end
	var templateID = getParameterByName("templateID");
	if ( getParameterByName("templateID") ){
		$(" #rt_template_options [data-templateid='"+templateID+"'][data-scope='edit-template'] ").trigger("click");
	}
 

}); 


/*
*
*	GET URL PARAMATERS BY NAME
*
*/	

function getParameterByName(name) {
	name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
		results = regex.exec(location.search);
	return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

 
/*
*
*	SIDEBAR CREATOR
*
*/	

jQuery(function($){
	$(document.body).on('click', '#rt_sidebar_options .sidebar_div .sidebar_title', function(event) { 

		var thisTemplate = $(this).parents('form:eq(0)'); 
		var thisTemplateID = thisTemplate.attr("id"); 
		var close_button = jQuery(this).find('.openclose');

		

		//active template
		$("#rt_sidebar_options form").each(function(){

			if( $(this).attr("id") == thisTemplateID ) {
				thisTemplate.toggleClass("active_sidebar");
			}else{
				$(this).removeClass("active_sidebar");
			}			
		});
		
	 
		$.fn.openclose_sidebars(close_button);
	 

	});

	//delete
	$("#rt_sidebar_options .deleteButton").click(function(){
 
		var confirm_message = confirm(sidebar_delete_confirm);

		if(confirm_message){ 
			jQuery(this).parents('.sidebar_div').remove();
			jQuery(".rt_options_ajax_save").trigger('click'); 
			return true;
		}

		return false;

	});	

	$.fn.openclose_sidebars = function(close_button) {
 
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
					jQuery('html, body').stop().animate({
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
	};   
}); 


//rttheme media upload script
jQuery(document).ready(function() {
	jQuery('.upload_field').focus(function() {
		jQuery(this).select();
	}); 
});


//rttheme media upload script
jQuery(document).ready(function() {
  
  jQuery('.rt-message').on("click", function() {
	jQuery(this).parent('div').fadeOut("slow"); 
  });
	
  jQuery('.rt-message-contact-form').on("each",function() {
	jQuery(this).hide();
  });
	
});

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


jQuery(document).ready(function() {  

	jQuery.fn.extend({
		ShowPostFormats: function () {
			  
			$this = jQuery(this);
			var theSelectedFormat  = $this.attr("id");


			//post formats / option pairs
			var post_formats = {};
			post_formats['post-format-0'] = "#rt_standart_post_custom_fields";
			post_formats['post-format-gallery'] = "#rt_gallery_post_custom_fields";
			post_formats['post-format-link'] = "#rt_link_post_custom_fields";
			post_formats['post-format-video'] = "#rt_video_post_custom_fields";
			post_formats['post-format-audio'] = "#rt_audio_post_custom_fields";
	
				for (var key in post_formats) {
					jQuery(post_formats[key]).css({"display":"none"});
				}
	
			jQuery(post_formats[theSelectedFormat]).css({"display":"block"});
	
	 
		}
	});

	jQuery("#post-formats-select input:checked").ShowPostFormats();
	
		jQuery("#post-formats-select").on("change", function(event){
			jQuery("#post-formats-select input:checked").ShowPostFormats();
		});
});


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
 