/**
 * SMOF js modified / AllAround
 *
 * contains the core functionalities to be used
 * SMOF AllAround
 */

jQuery.noConflict();

/** Fire up jQuery - let's dance! 
 */
jQuery(document).ready(function($){
	
	//(un)fold options in a checkbox-group
  	jQuery('.fld').click(function() {
    	var $fold='.f_'+this.id;
    	$($fold).slideToggle('normal', "swing");
  	});
	
	//delays until AjaxUpload is finished loading
	//fixes bug in Safari and Mac Chrome
	if (typeof AjaxUpload != 'function') { 
			return ++counter < 6 && window.setTimeout(init, counter * 500);
	}
	
	//hides warning if js is enabled			
	$('#js-warning').hide();
	
	//Tabify Options			
	$('.group').hide();
	$('.group:first').fadeIn('fast');
	$('#of-nav li:first').addClass('current');

	//Current Menu Class
	$('#of-nav li a').click(function(evt){
	// event.preventDefault();
				
		$('#of-nav li').removeClass('current');
		$(this).parent().addClass('current');
							
		var clicked_group = $(this).attr('href');
		
		$.cookie('of_current_opt', clicked_group, { expires: 7, path: '/' });
			
		$('.group').hide();
							
		$(clicked_group).fadeIn('fast');
		return false;
						
	});

	//Expand Options 
	var flip = 0;
				
	$('#expand_options').click(function(){
		if(flip == 0){
			flip = 1;
			$('#of_container #of-nav').hide();
			$('#of_container #content').width(755);
			$('#of_container .group').add('#of_container .group h2').show();
	
			$(this).removeClass('expand');
			$(this).addClass('close');
			$(this).text('Close');
					
		} else {
			flip = 0;
			$('#of_container #of-nav').show();
			$('#of_container #content').width(595);
			$('#of_container .group').add('#of_container .group h2').hide();
			$('#of_container .group:first').show();
			$('#of_container #of-nav li').removeClass('current');
			$('#of_container #of-nav li:first').addClass('current');
					
			$(this).removeClass('close');
			$(this).addClass('expand');
			$(this).text('Expand');
				
		}
			
	});


	// Prevent Bad Characters & Pastes Slider
	function disableSubmitSlider() {

		function transformTypedChar(charStr) {
			return '"' ? "'" : charStr;
		}
		
		$("#of-option-slideroptions").find('input').keypress(function(evt) {
			if ( evt.which == 13 ) return false;
		});
		
		$("#of-option-slideroptions").find('input, textarea').keypress(function(evt) {

			var val = this.value;
			evt = evt || window.event;
			var ctrlDown = evt.ctrlKey||evt.metaKey // Mac support

		
			// Ensure we only handle printable keys, excluding enter and space
			var charCode = typeof evt.which == "number" ? evt.which : evt.keyCode;
			if (charCode && charCode == 34) {
				var keyChar = String.fromCharCode(34);
		
				// Transform typed character
				var mappedChar = transformTypedChar(keyChar);
		
				var start, end;
				if (typeof this.selectionStart == "number" && typeof this.selectionEnd == "number") {
					// Non-IE browsers and IE 9
					start = this.selectionStart;
					end = this.selectionEnd;
					this.value = val.slice(0, start) + mappedChar + val.slice(end);
		
					// Move the caret
					this.selectionStart = this.selectionEnd = start + 1;
				} else if (document.selection && document.selection.createRange) {
					// For IE up to version 8
					var selectionRange = document.selection.createRange();
					var textInputRange = this.createTextRange();
					var precedingRange = this.createTextRange();
					var bookmark = selectionRange.getBookmark();
					textInputRange.moveToBookmark(bookmark);
					precedingRange.setEndPoint("EndToStart", textInputRange);
					start = precedingRange.text.length;
					end = start + selectionRange.text.length;
		
					this.value = val.slice(0, start) + mappedChar + val.slice(end);
					start++;
		
					// Move the caret
					textInputRange = this.createTextRange();
					textInputRange.collapse(true);
					textInputRange.move("character", start - (this.value.slice(0, start).split("\r\n").length - 1));
					textInputRange.select();
				}
		
				return false;
			}
		});
	
		// Prevent Bad Pastes
		$("#of-option-slideroptions").find('input, textarea').bind('paste', function () {
			var element = this;
			  setTimeout(function () {
				var text = $(element).val();
				var fixedText = text.replace(/"/g, "'");
				$(element).val(fixedText);
				// do something with text
			}, 100);
		});
	}
	disableSubmitSlider();
	
	// Prevent Bad Characters, Submit & Pastes Builder
	function disableSubmit() {
		function transformTypedChar(charStr) {
			return '"' ? "'" : charStr;
		}

		$("#of-option-shortcodegenerator").find('input').keypress(function(evt) {
			if ( evt.which == 13 ) return false;
		});
		
		$("#of-option-shortcodegenerator").find('input, textarea').keypress(function(evt) {

			var val = this.value;
			evt = evt || window.event;
			var ctrlDown = evt.ctrlKey||evt.metaKey // Mac support

		
			// Ensure we only handle printable keys, excluding enter and space
			var charCode = typeof evt.which == "number" ? evt.which : evt.keyCode;
			if (charCode && charCode == 34) {
				var keyChar = String.fromCharCode(34);
		
				// Transform typed character
				var mappedChar = transformTypedChar(keyChar);
		
				var start, end;
				if (typeof this.selectionStart == "number" && typeof this.selectionEnd == "number") {
					// Non-IE browsers and IE 9
					start = this.selectionStart;
					end = this.selectionEnd;
					this.value = val.slice(0, start) + mappedChar + val.slice(end);
		
					// Move the caret
					this.selectionStart = this.selectionEnd = start + 1;
				} else if (document.selection && document.selection.createRange) {
					// For IE up to version 8
					var selectionRange = document.selection.createRange();
					var textInputRange = this.createTextRange();
					var precedingRange = this.createTextRange();
					var bookmark = selectionRange.getBookmark();
					textInputRange.moveToBookmark(bookmark);
					precedingRange.setEndPoint("EndToStart", textInputRange);
					start = precedingRange.text.length;
					end = start + selectionRange.text.length;
		
					this.value = val.slice(0, start) + mappedChar + val.slice(end);
					start++;
		
					// Move the caret
					textInputRange = this.createTextRange();
					textInputRange.collapse(true);
					textInputRange.move("character", start - (this.value.slice(0, start).split("\r\n").length - 1));
					textInputRange.select();
				}
		
				return false;
			}
		});

		// Prevent Bad Pastes
		$("#of-option-shortcodegenerator").find('input, textarea').bind('paste', function () {
			var element = this;
			  setTimeout(function () {
				var text = $(element).val();
				var fixedText = text.replace(/"/g, "'");
				$(element).val(fixedText);
				// do something with text
			}, 100);
		});
	}
	
	//Update Message popup
	$.fn.center = function () {
		this.animate({"top":( $(window).height() - this.height() - 200 ) / 2+$(window).scrollTop() + "px"},100);
		this.css("left", 250 );
		return this;
	}
		
			
	$('#of-popup-save').center();
	$('#of-popup-reset').center();
	$('#of-popup-fail').center();
			
	$(window).scroll(function() { 
		$('#of-popup-save').center();
		$('#of-popup-reset').center();
		$('#of-popup-fail').center();
	});
			

	//Masked Inputs (images as radio buttons)
	$('.of-radio-img-img').click(function(){
		$(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
		$(this).addClass('of-radio-img-selected');
	});
	$('.of-radio-img-label').hide();
	$('.of-radio-img-img').show();
	$('.of-radio-img-radio').hide();
	
	//Masked Inputs (background images as radio buttons)
	$('.of-radio-tile-img').click(function(){
		$(this).parent().parent().find('.of-radio-tile-img').removeClass('of-radio-tile-selected');
		$(this).addClass('of-radio-tile-selected');
	});
	$('.of-radio-tile-label').hide();
	$('.of-radio-tile-img').show();
	$('.of-radio-tile-radio').hide();

	//AJAX Upload
	function of_image_upload() {
	$('.image_upload_button').each(function(){
			
	var clickedObject = $(this);
	var clickedID = $(this).attr('id');	
			
	var nonce = $('#security').val();
			
	new AjaxUpload(clickedID, {
		action: ajaxurl,
		name: clickedID, // File upload name
		data: { // Additional data to send
			action: 'of_ajax_post_action',
			type: 'upload',
			security: nonce,
			data: clickedID },
		autoSubmit: true, // Submit file after selection
		responseType: false,
		onChange: function(file, extension){},
		onSubmit: function(file, extension){
			clickedObject.text('Uploading'); // change button text, when user selects file	
			this.disable(); // If you want to allow uploading only 1 file at time, you can disable upload button
			interval = window.setInterval(function(){
				var text = clickedObject.text();
				if (text.length < 13){	clickedObject.text(text + '.'); }
				else { clickedObject.text('Uploading'); } 
				}, 200);
		},
		onComplete: function(file, response) {
			window.clearInterval(interval);
			clickedObject.text('Upload Image');	
			this.enable(); // enable upload button
				
	
			// If nonce fails
			if(response==-1){
				var fail_popup = $('#of-popup-fail');
				fail_popup.fadeIn();
				window.setTimeout(function(){
				fail_popup.fadeOut();                        
				}, 2000);
			}				
					
			// If there was an error
			else if(response.search('Upload Error') > -1){
				var buildReturn = '<span class="upload-error">' + response + '</span>';
				$(".upload-error").remove();
				clickedObject.parent().after(buildReturn);
				
				}
			else{
				var buildReturn = '<img class="hide of-option-image" id="image_'+clickedID+'" src="'+response+'" alt="" />';

				$(".upload-error").remove();
				$("#image_" + clickedID).remove();	
				clickedObject.parent().after(buildReturn);
				$('img#image_'+clickedID).fadeIn();
				clickedObject.next('span').fadeIn();
				clickedObject.parent().prev('input').val(response);
			}
		}
	});
			
	});
	
	}
	
	of_image_upload();
			
	//AJAX Remove Image (clear option value)
	$('.image_reset_button').live('click', function(){
	
		var clickedObject = $(this);
		var clickedID = $(this).attr('id');
		var theID = $(this).attr('title');	
				
		var nonce = $('#security').val();
	
		var data = {
			action: 'of_ajax_post_action',
			type: 'image_reset',
			security: nonce,
			data: theID
		};
					
		$.post(ajaxurl, data, function(response) {
						
			//check nonce
			if(response==-1){ //failed
							
				var fail_popup = $('#of-popup-fail');
				fail_popup.fadeIn();
				window.setTimeout(function(){
					fail_popup.fadeOut();                        
				}, 2000);
			}
						
			else {
						
				var image_to_remove = $('#image_' + theID);
				var button_to_hide = $('#reset_' + theID);
				image_to_remove.fadeOut(500,function(){ $(this).remove(); });
				button_to_hide.fadeOut();
				clickedObject.parent().prev('input').val('');
			}
						
						
		});
					
	}); 

	// Style Select
	(function ($) {
	styleSelect = {
		init: function () {
		$('.select_wrapper').each(function () {
			$(this).prepend('<span>' + $(this).find('.select option:selected').text() + '</span>');
		});
		$('.select').live('change', function () {
			$(this).prev('span').replaceWith('<span>' + $(this).find('option:selected').text() + '</span>');
		});
		$('.select').bind($.browser.msie ? 'click' : 'change', function(event) {
			$(this).prev('span').replaceWith('<span>' + $(this).find('option:selected').text() + '</span>');
		}); 
		}
	};
	$(document).ready(function () {
		styleSelect.init()
	})
	})(jQuery);
	
	
	/** Aquagraphite Slider MOD */
	
	//Hide (Collapse) the toggle containers on load
	$(".slide_body").hide(); 

	//Switch the "Open" and "Close" state per click then slide up/down (depending on open/close state)
	$(".slide_edit_button").live( 'click', function(){
		$(this).parent().toggleClass("active").next().slideToggle("fast");
		return false; //Prevent the browser jump to the link anchor
	});	
	
	// Update slide title upon typing		
	function update_slider_title(e) {
		var element = e;
		if ( this.timer ) {
			clearTimeout( element.timer );
		}
		this.timer = setTimeout( function() {
			$(element).parent().prev().find('strong').text( element.value );
		}, 100);
		return true;
	}
	
	$('.of-slider-title').live('keyup', function(){
		update_slider_title(this);
	});
		
	
	//Remove individual slide
	$('.slide_delete_button').live('click', function(){
	// event.preventDefault();
	var agree = confirm("Are you sure you wish to delete this slide?");
		if (agree) {
			var $trash = $(this).parents('li');
			//$trash.slideUp('slow', function(){ $trash.remove(); }); //chrome + confirm bug made slideUp not working...
			$trash.animate({
					opacity: 0.25,
					height: 0,
				}, 500, function() {
					$(this).remove();
			});
			return false; //Prevent the browser jump to the link anchor
		} else {
		return false;
		}	
	});
	
	//Init Columns
	function initColumns(columnContainer) {
		columnContainer.find(".columns").change( function(){
			var columnText = [];
			$(this).parent().parent().find('textarea.of-input').each(function() {
				columnText.push($(this).val());
			});
			columnText.push('');
			columnText.push('');
			var choosedColumns = $(this).parent().find(":selected").val();
			if (choosedColumns == '1' || choosedColumns == '3' || choosedColumns == '4' || choosedColumns == '9' || choosedColumns == '10') {
				var choosedColumns = '<div class="columnsinput"><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input" rows="8">'+columnText[0]+'</textarea><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input" rows="8">'+columnText[1]+'</textarea></div>';
			} else if (choosedColumns == '2' || choosedColumns == '6' || choosedColumns == '7' || choosedColumns == '8') {
				var choosedColumns = '<div class="columnsinput"><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input" rows="8">'+columnText[0]+'</textarea><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input" rows="8">'+columnText[1]+'</textarea><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input" rows="8">'+columnText[2]+'</textarea></div>';
			} else {
				var choosedColumns = '<div class="columnsinput"><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input" rows="8">'+columnText[0]+'</textarea><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input" rows="8">'+columnText[1]+'</textarea><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input" rows="8">'+columnText[2]+'</textarea><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input" rows="8">'+columnText[3]+'</textarea></div>';
			};
			columnContainer.find(".columnsinput").replaceWith(choosedColumns);
		});	
	}
	

	//Element edit
	function initChange() {
	$("#of-option-shortcodegenerator").find(".of-slider-title").change( function(){
		var check = $(this).closest('.slide_body').find(".editcontent").remove();
		var selectedContent = $(this).parent().find(":selected").text();

		var editContent = $('<div class="editcontent"></div>');
		$(this).closest('.slide_body').append(editContent);
		var editContentContainer = $(this).parent().parent().find(".editcontent");
		switch(selectedContent){
			
			case 'Columns':
				editContentFields = '<h4>Columns</h4><div class="select_wrapper"><span>50%, 50%</span><select class="select of-input columns"><option value="1">50%, 50%</option><option value="2">33%, 33%, 33%</option><option value="3">33%, 66%</option><option value="4">66%, 33%</option><option value="5">25%, 25%, 25%, 25%</option><option value="6">25%, 50%, 25%</option><option value="7">25%, 25%, 50%</option><option value="8">50%, 25%, 25%</option><option value="9">25%, 75%</option><option value="10">75%, 25%</option></select></div><div class="columnsinput"><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input" rows="8"></textarea><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input" rows="8"></textarea></div>';
				editContentContainer.append(editContentFields);
				initColumns(editContentContainer);
			break;
			
			case 'Products Fancy List':
				var dropdown = $('#allaround_hidden_products').html();
				editContentFields = '<h4>Rows</h4><input class="of-input rows" /><h4>Category</h4><div class="select_wrapper"><span>All</span>'+ dropdown +'</div><h4>Order</h4><div class="select_wrapper"><span>Date</span><select class="select of-input"><option value="date">Date</option><option value="comment_count">Popular</option><option value="rand">Random</option><option value="author">Author</option><option value="title">Title</option></select></div><h4>Ajax Load</h4><input class="select of-input ajaxcheckbox" type="checkbox" value="1"/><h4>Show Pagination</h4><input class="select of-input paginationcheckbox" type="checkbox" value="1"/><h4>Reverse posts order</h4><input class="select of-input reversecheckbox" type="checkbox" value="1"/>';
				editContentContainer.append(editContentFields);
			break;
			
			case 'Blog':
				var dropdown = $('#allaround_hidden_posts').html();
				editContentFields = '<h4>Type</h4><div class="select_wrapper"><span>1</span><select class="select of-input"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option></select></div><h4>Rows</h4><input class="of-input rows" /><h4>Category</h4><div class="select_wrapper"><span>All</span>'+ dropdown +'</div><h4>Order</h4><div class="select_wrapper"><span>Date</span><select class="select of-input"><option value="date">Date</option><option value="comment_count">Popular</option><option value="rand">Random</option><option value="author">Author</option><option value="title">Title</option></select></div><h4>Ajax Load</h4><input class="select of-input ajaxcheckbox" type="checkbox" value="1"/><h4>Show Pagination</h4><input class="select of-input paginationcheckbox" type="checkbox" value="1"/><h4>Reverse posts order</h4><input class="select of-input reversecheckbox" type="checkbox" value="1"/>';
				$(this).parent().parent().find(".editcontent").append(editContentFields);
			break;
			
			case 'Accordion':
				editContentFields = '<div class="duplicateelement"><h4>Title</h4><input class="of-input accordion" /><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input accordion" rows="2"></textarea></div><a href="#" class="button duplicate_content_button">Add Section</a>';
				editContentContainer.append(editContentFields);
			break;
			
			case 'Tabs':
				editContentFields = '<div class="duplicateelement"><h4>Title</h4><input class="of-input tabs" /><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input tabs" rows="2"></textarea></div><a href="#" class="button duplicate_content_button">Add Tab</a>';
				editContentContainer.append(editContentFields);
			break;	
					
			case 'Featured Circles':
				editContentFields = '<h4>Circle Title</h4><input class="of-input circles" /><h4>Text Title</h4><input class="of-input circles" /><h4>Text</h4><textarea class="of-input circles" rows="2"></textarea><hr><h4>Circle Title</h4><input class="of-input circles" /><h4>Text Title</h4><input class="of-input circles" /><h4>Text</h4><textarea class="of-input circles" rows="2"></textarea><hr><h4>Circle Title</h4><input class="of-input circles" /><h4>Text Title</h4><input class="of-input circles" /><h4>Text</h4><textarea class="of-input circles" rows="2"></textarea>';
				editContentContainer.append(editContentFields);
			break;
			
			case 'Divider':
				editContentFields = '<h4>Margin</h4><input class="of-input rows" />';
				editContentContainer.append(editContentFields);
			break;
			
			case 'Divider (Transparent)':
				editContentFields = '<h4>Margin</h4><input class="of-input rows" />';
				editContentContainer.append(editContentFields);
			break;
			
			case 'Team':
				var checkboxes = $('#allaround_hidden_contacts').html();
				editContentFields = '<h4>Check to include</h4>'+ checkboxes +'';
				editContentContainer.append(editContentFields);
			break;
			
			case 'Contact Form':
				var checkboxes = $('#allaround_hidden_contacts').html();
				editContentFields = '<h4>Check to include</h4>'+ checkboxes +'';
				editContentContainer.append(editContentFields);
			break;
			
			case 'Box':
				editContentFields = '<h4>Type</h4><div class="select_wrapper"><span>Plain Box</span><select class="select of-input box"><option value="blue">Blue Box</option><option value="green">Green Box</option><option value="redbox">Red Box</option><option value="yellow">Yellow Box</option></select></div><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input box" rows="2">';
				$(this).parent().parent().find(".editcontent").append(editContentFields);			
			break;
			
			case 'Progress Bar':
				editContentFields = '<h4>How Much</h4><input class="of-input progressbar" value="" /><h4>Out Of</h4><input class="of-input progressbar" value="" /><h4>Title</h4><input class="of-input progressbar" value="" />';
				editContentContainer.append(editContentFields);
			break;
			
			case 'Text/HTML':
				editContentFields = '<h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input"></textarea>';
				editContentContainer.append(editContentFields);
			break;
			
			case 'Title':
				editContentFields = '<h4>Title</h4><input class="of-input" value="" />';
				editContentContainer.append(editContentFields);
			break;
			
			case 'Client Slider':
				editContentFields = '<div class="duplicateelement"><h4>Image Code</h4><textarea class="of-input minislider" rows="2"></textarea></div><a href="#" class="button duplicate_content_button">Add Client Image</a>';
				editContentContainer.append(editContentFields);
			break;
			case 'Full-Width Box':
				var sliderRel = $('#contents').attr('rel');
				editContentFields = '<h4>Image URL</h4><input class="slide of-input fw-box" id="fw-box_slide_url" value=""><div class="upload_button_div"><span class="button media_upload_button" id="fw-box" rel="'+sliderRel+'">Upload</span><span class="button mlu_remove_button hide" id="reset_fw-box">Remove</span></div><h4>Text</h4><input class="of-input fw-box" />';
				editContentContainer.append(editContentFields);
			break;

			case 'Full-Width Link':
				editContentFields = '<h4>Title</h4><input class="of-input fw-link" value="" /><h4>Link</h4><input class="of-input fw-link" value="" />';
				editContentContainer.append(editContentFields);
			break;			
		}
		var editContentFields = undefined;
		var editContent = undefined;
		$(this).parent().parent().prev().find('strong').text( selectedContent );
		disableSubmit();		
	});
	}
	initChange();

	//Insert Content
	$(".insert_content").live('click', function() {
		var readyContent = [];
		$(this).parent().find('li').each(function() {
			var content = $(this).find('.of-slider-title').find(":selected").val();
			switch(content) {
				
				case 'columns':
					var columnText = [];
					$(this).find('textarea.of-input').each(function() {
						columnText.push($(this).val());
					});
					var columnType = $(this).find(".columns").find(":selected").val();;
					switch(columnType) {
						case '1':
						readyContent.push('[aa_one_half last="no"]'+ columnText[0] +'[/aa_one_half]\n[aa_one_half last="yes"]'+ columnText[1] +'[/aa_one_half]');
						break;
						case '2':
						readyContent.push('[aa_one_third last="no"]'+ columnText[0] +'[/aa_one_third]\n[aa_one_third last="no"]'+ columnText[1] +'[/aa_one_third]\n[aa_one_third last="yes"]'+ columnText[2] +'[/aa_one_third]');
						break;
						case '3':
						readyContent.push('[aa_one_third last="no"]'+ columnText[0] +'[/aa_one_third]\n[aa_two_third last="yes"]'+ columnText[1] +'[/aa_two_third]');
						break;
						case '4':
						readyContent.push('[aa_two_third last="no"]'+ columnText[0] +'[/aa_two_third]\n[aa_one_third last="yes"]'+ columnText[1] +'[/aa_one_third]');
						break;
						case '5':
						readyContent.push('[aa_one_fourth last="no"]'+ columnText[0] +'[/aa_one_fourth]\n[aa_one_fourth last="no"]'+ columnText[1] +'[/aa_one_fourth]\n[aa_one_fourth last="no"]'+ columnText[2] +'[/aa_one_fourth]\n[aa_one_fourth last="yes"]'+ columnText[3] +'[/aa_one_fourth]');			
						break;
						case '6':
						readyContent.push('[aa_one_fourth last="no"]'+ columnText[0] +'[/aa_one_fourth]\n[aa_one_half last="no"]'+ columnText[1] +'[/aa_one_half]\n[aa_one_fourth last="yes"]'+ columnText[2] +'[/aa_one_fourth]');
						break;
						case '7':
						readyContent.push('[aa_one_fourth last="no"]'+ columnText[0] +'[/aa_one_fourth]\n[aa_one_fourth last="no"]'+ columnText[1] +'[/aa_one_fourth]\n[aa_one_half last="yes"]'+ columnText[2] +'[/aa_one_half]');
						break;
						case '8':
						readyContent.push('[aa_one_half last="no"]'+ columnText[0] +'[/aa_one_half]\n[aa_one_fourth last="no"]'+ columnText[1] +'[/aa_one_fourth]\n[aa_one_fourth last="yes"]'+ columnText[2] +'[/aa_one_fourth]');
						break;
						case '9':
						readyContent.push('[aa_one_fourth last="no"]'+ columnText[0] +'[/aa_one_fourth]\n[aa_three_fourth last="yes"]'+ columnText[1] +'[/aa_three_fourth]');
						break;
						case '10':
						readyContent.push('[aa_three_fourth last="no"]'+ columnText[0] +'[/aa_three_fourth]\n[aa_one_fourth last="yes]'+ columnText[1] +'[/aa_one_fourth]');			
						break;																																					
					}
				break;
				
				case 'products':
					var blogOptions = [];
					$(this).find('.editcontent .of-input').each(function() {
						blogOptions.push($(this).val());
					});
					var checked = $(this).find('.editcontent .ajaxcheckbox').is(':checked') ? ' ajax="yes"' : ' ajax="no"';
					var checked1 = $(this).find('.editcontent .paginationcheckbox').is(':checked') ? ' pagination="yes"' : ' pagination="no"';
					var checked2 = $(this).find('.editcontent .reversecheckbox').is(':checked') ? ' values="ASC"' : ' values="DESC"';
					readyContent.push('[aa_products rows="'+ blogOptions[0] +'" category="'+ blogOptions[1] +'" order="'+ blogOptions[2] +'"'+ checked +''+ checked1 +''+ checked2 +']');
				break;
				
				case 'blog':
					var blogOptions = [];
					$(this).find('.editcontent .of-input').each(function() {
						blogOptions.push($(this).val());
					});
					var checked = $(this).find('.editcontent .ajaxcheckbox').is(':checked') ? ' ajax="yes"' : ' ajax="no"';
					var checked1 = $(this).find('.editcontent .paginationcheckbox').is(':checked') ? ' pagination="yes"' : ' pagination="no"';
					var checked2 = $(this).find('.editcontent .reversecheckbox').is(':checked') ? ' values="ASC"' : ' values="DESC"';
					readyContent.push('[aa_blog type="'+ blogOptions[0] +'" rows="'+ blogOptions[1] +'" category="'+ blogOptions[2] +'" order="'+ blogOptions[3] +'"'+ checked +''+ checked1 +''+ checked2 +']');
				break;
				
				case 'accordion':
					var accordionOptions = [];
					var count = 0;
					var tempContent = '';
					$(this).find('.accordion').each(function() {
						accordionOptions.push($(this).val());
						count++;
					});
					tempContent += '[aa_accordion]\n';
					for (i = 0; i < count; i = i + 2) {
						tempContent += '[aa_accordion_section title="'+ accordionOptions[i]+'"]\n'+ accordionOptions[i+1]+'\n[/aa_accordion_section]\n';
					}
					tempContent += '[/aa_accordion]';
					readyContent.push(tempContent);
				break;
				
				case 'tabs':
					var tabsOptions = [];
					var count = 0;
					var tempContent = '';
					$(this).find('.tabs').each(function() {
						tabsOptions.push($(this).val());
						count++;
					});
					tempContent += '[aa_tabs]\n';
					for (i = 0; i < count; i = i + 2) {
						tempContent += '[aa_tab title="'+ tabsOptions[i]+'"]\n'+ tabsOptions[i+1]+'\n[/aa_tab]\n';
					}
					tempContent += '[/aa_tabs]';
					readyContent.push(tempContent);
				break;
				
				case 'circles':
					var circlesOptions = [];
					var tempContent = '';
					$(this).find('.circles').each(function() {
						circlesOptions.push($(this).val());
					});
					tempContent += '[aa_circles title="'+ circlesOptions[0] +'" texttitle="'+ circlesOptions[1] +'" text="'+ circlesOptions[2] +'"]';
					tempContent += '[aa_circles title="'+ circlesOptions[3] +'" texttitle="'+ circlesOptions[4] +'" text="'+ circlesOptions[5] +'"]';
					tempContent += '[aa_circles title="'+ circlesOptions[6] +'" texttitle="'+ circlesOptions[7] +'" text="'+ circlesOptions[8] +'" last="yes"]';
	
					readyContent.push(tempContent);
				break;
				
				case 'divider':
					var tempContent = '';
					var dividerMargin = $(this).find('.editcontent input.of-input').val();
					tempContent += '[aa_divider margin="'+ dividerMargin +'"]';
					readyContent.push(tempContent);
				break;
				
				case 'tdivider':
					var tempContent = '';
					var dividerMargin = $(this).find('.editcontent input.of-input').val();
					tempContent += '[aa_clear margin="'+ dividerMargin +'"]';
					readyContent.push(tempContent);
				break;
				
				case 'team':
					var teamOptions = [];
					var tempContent = '';
					$(this).find('.checkbox').each(function() {
						if (this.checked) teamOptions.push($(this).val());
					});
					tempContent += '[aa_team users="'+ teamOptions +'"]';
					readyContent.push(tempContent);
				break;
				
				case 'contactform':
					var contactOptions = [];
					var tempContent = '';
					$(this).find('.checkbox').each(function() {
						if (this.checked) contactOptions.push($(this).val());
					});
					tempContent += '[aa_contactform users="'+ contactOptions +'"]';
					readyContent.push(tempContent);
				break;
				
				case 'box':
				var boxText = [];
				$(this).find('.box').each(function() {
					boxText.push($(this).val());
				});
				var boxType = boxText[0];
					switch(boxType) {
						case 'blue':
						readyContent.push('[aa_bluebox]'+ boxText[1] +'[/aa_bluebox]');
						break;
						case 'green':
						readyContent.push('[aa_greenbox]'+ boxText[1] +'[/aa_greenbox]');
						break;
						case 'red':
						readyContent.push('[aa_redbox]'+ boxText[1] +'[/aa_redbox]');
						break;
						case 'yellow':
						readyContent.push('[aa_yellowbox]'+ boxText[1] +'[/aa_yellowbox]');
						break;
																																					
					}
				break;
			
				case 'progress':
					var progressOptions = [];
					var tempContent = '';
					$(this).find('.progressbar').each(function() {
						progressOptions.push($(this).val());
					});
					tempContent += '[aa_progressbar howmuch="'+ progressOptions[0] +'" outof="'+ progressOptions[1] +'" title="'+ progressOptions[2] +'"]';
					readyContent.push(tempContent);
				break;
				
				case 'texthtml':
					texthtml = $(this).find('.editcontent textarea').val();
					readyContent.push(texthtml);
				break;
				
				case 'title':
					var tempContent = '';
					title = $(this).find('.editcontent input').val();
					tempContent += '[aa_title]'+ title +'[/aa_title]'
					readyContent.push(tempContent);
				break;
				
				case 'minislider':
					var minisliderOptions = [];
					var count = 0;
					var tempContent = '';
					$(this).find('.editcontent textarea.minislider').each(function() {
						minisliderOptions.push($(this).val());
						count++;
					});
					tempContent += '[aa_clientsslider]';
					for (i = 0; i < count; ++i) {
						tempContent += minisliderOptions[i];
					}
					tempContent += '[/aa_clientsslider]';
					readyContent.push(tempContent);
				break;
				
				case 'fullbox':
					var fullboxOptions = [];
					var tempContent = '';
					$(this).find('.fw-box').each(function() {
						fullboxOptions.push($(this).val());
					});
					tempContent += '[aa_fw_box image="'+ fullboxOptions[0] +'" text="'+ fullboxOptions[1] +'"]';
					readyContent.push(tempContent);
				break;

				case 'fulllink':
					var fulllinkOptions = [];
					var tempContent = '';
					$(this).find('.fw-link').each(function() {
						fulllinkOptions.push($(this).val());
					});
					tempContent += '[aa_fw_link title="'+ fulllinkOptions[0] +'" link="'+ fulllinkOptions[1] +'"]';
					readyContent.push(tempContent);
				break;
			}
			var content = undefined;	
		});
		if($('#wp-content-editor-container textarea').is(":hidden")){
			var joinedContent = readyContent.join('<br />');
			var changedContent = joinedContent.replace(/\n/g, "<br />")			
			tinyMCE.activeEditor.selection.setContent(changedContent);
		}
		else {
			var joinedContent = readyContent.join('\n');
			$('#wp-content-editor-container textarea').insertAtCaret(joinedContent);
		}
	});

$.fn.extend({
	insertAtCaret: function(myValue){
		var obj;
		if( typeof this[0].name !='undefined' ) obj = this[0];
		else obj = this;
		
		if ($.browser.msie) {
			obj.focus();
			sel = document.selection.createRange();
			sel.text = myValue;
			obj.focus();
		}
		else if ($.browser.mozilla || $.browser.webkit) {
			var startPos = obj.selectionStart;
			var endPos = obj.selectionEnd;
			var scrollTop = obj.scrollTop;
			obj.value = obj.value.substring(0, startPos)+myValue+obj.value.substring(endPos,obj.value.length);
			obj.focus();
			obj.selectionStart = startPos + myValue.length;
			obj.selectionEnd = startPos + myValue.length;
			obj.scrollTop = scrollTop;
		} else {
			obj.value += myValue;
			obj.focus();
		}
	}
});

	//Duplicate content
	$(".duplicate_content_button").live('click', function() {
		var duplicateContent = '<div class="clonedelement">';
		duplicateContent += $(this).parent().find('.duplicateelement').html();
		duplicateContent += '<a href="#" class="remove_item" title="Delete">!!Remove</a>'
		duplicateContent += '</div>';
		$(this).before(duplicateContent);
		var removeCloned = $(this).prev().find('.remove_item');
		removeCloned.on('click', function() {$(this).parent().remove(); return false;});
		$(this).parent().children('input:last, textarea:last').text('');
		return false;
	});
	
	//Remove all slides
	$(".slide_remove_all").live('click', function(){
		var agree = confirm("Remove all slides?");
		if (agree) {
			var slidesContainer = $(this).prev().prev();
			slidesContainer.find('li').each(function() {
				$(this).remove();
			});
			return false;

		}
		else {
			return false;
		}
	});
	
	//Add new slide
	$(".slide_add_button").live('click', function(){		
		var slidesContainer = $(this).prev();
		var sliderId = slidesContainer.attr('id');
		var sliderInt = $('#'+sliderId).attr('rel');
		var newSlide = '';
		
		var numArr = $('#'+sliderId +' li').find('.order').map(function() { 
			var str = this.id; 
			str = str.replace(/\D/g,'');
			str = parseFloat(str);
			return str;			
		}).get();
		
		var maxNum = Math.max.apply(Math, numArr);
		if (maxNum < 1 ) { maxNum = 0};
		var newNum = maxNum + 1;
			
		if ( sliderId == 'slides' ) {
			newSlide = '<li class="temphide"><div class="slide_header"><strong>Slide ' + newNum + '</strong><input type="hidden" class="slide of-input order" name="' + SmofPage.name + '[' + sliderId + '][' + newNum + '][order]" id="' + sliderId + '_slide_order-' + newNum + '" value="' + newNum + '"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><label>Title</label><input class="slide of-input of-slider-title" name="' + SmofPage.name + '[' + sliderId + '][' + newNum + '][title]" id="' + sliderId + '_' + newNum + '_slide_title" value=""><label>Image URL</label><input class="slide of-input" name="' + SmofPage.name + '[' + sliderId + '][' + newNum + '][url]" id="' + sliderId + '_' + newNum + '_slide_url" value=""><div class="upload_button_div"><span class="button media_upload_button" id="' + sliderId + '_' + newNum + '" rel="'+sliderInt+'">Upload</span><span class="button mlu_remove_button hide" id="reset_' + sliderId + '_' + newNum + '" title="' + sliderId + '_' + newNum + '">Remove</span></div><div class="screenshot"></div><a class="slide_delete_button" title="Delete Slide" href="#">Delete</a><div class="clear"></div></div></li>';
		}
		else if ( sliderId == 'contents' ) {
			newSlide = '<li class="temphide"><div class="slide_header"><strong>Element</strong><input type="hidden" class="slide of-input order"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><h4>Element</h4><div class="select_wrapper"><span> </span><select class="select of-input of-slider-title"><option value="0"> </option><option value="accordion">Accordion</option><option value="blog">Blog</option><option value="box">Box</option><option value="minislider">Client Slider</option><option value="columns">Columns</option><option value="contactform">Contact Form</option><option value="divider">Divider</option><option value="tdivider">Divider (Transparent)</option><option value="circles">Featured Circles</option><option value="fullbox">Full-Width Box</option><option value="fulllink">Full-Width Link</option><option value="products">Products Fancy List</option><option value="progress">Progress Bar</option><option value="tabs">Tabs</option><option value="team">Team</option><option value="texthtml">Text/HTML</option><option value="title">Title</option></select></div><a class="slide_delete_button" title="Delete Element" href="#">Delete</a><div class="clear"></div></div></li>';
		}		
		slidesContainer.append(newSlide);
		$('.temphide').fadeIn('fast', function() {
			$(this).removeClass('temphide');
		});
		of_image_upload(); // re-initialise upload image..
		if ( sliderId == 'contents' ) initChange();
		if ( sliderId == 'slides' ) disableSubmitSlider();
		return false; //prevent jumps, as always..
	});	
	
	//Sort slides
	jQuery('.slider').find('ul').each( function() {
		var id = jQuery(this).attr('id');
		$('#'+ id).sortable({
			placeholder: "placeholder",
			opacity: 0.6
		});	
	});
	
	
	/**	Sorter (Layout Manager) */
	jQuery('.sorter').each( function() {
		var id = jQuery(this).attr('id');
		$('#'+ id).find('ul').sortable({
			items: 'li',
			placeholder: "placeholder",
			connectWith: '.sortlist_' + id,
			opacity: 0.6,
			update: function() {
				$(this).find('.position').each( function() {
				
					var listID = $(this).parent().attr('id');
					var parentID = $(this).parent().parent().attr('id');
					parentID = parentID.replace(id + '_', '')
					var optionID = $(this).parent().parent().parent().attr('id');
					$(this).prop("name", optionID + '[' + parentID + '][' + listID + ']');
					
				});
			}
		});	
	});
	
	
// Slides manager
// **************
	
	// Save Slides Template
	$('.save_slide_template').live('click', function() {

		var readyContent = [];
		var number = 0;
		$(this).parent().find('li').each(function() {
			var content = $(this).find('.of-slider-title').find(":selected").val();
			var slideOptions = [];
			$(this).find('.of-input').each(function() {
				slideOptions.push($(this).val() +',%#');
			});
			slideOptions.splice(0,1)
			readyContent.push(slideOptions);	
			readyContent.push('%_%');
			number++;
		});
		var saveIcon = '<div class="template-icon"><h4>Template Name</h3><input class="of-input template template-visible" name="template" /><input class="template template-string" type="hidden" name="template" value="'+ readyContent +'"/><a href="#" class="save-slides-template-item" title="Save Slides Template">!!Save</a><a href="#" class="load-slides-template-item" title="Insert Slides">!!Load</a><a href="#" class="delete-slides-template-item" title="Delete Slides Template">!!Delete</a></div>';
		clearTemplates = $(this).next();
		clearTemplates.after(saveIcon);
		clearTemplates.next().children('.template-visible').focus().on('keyup', function() { $(this).attr('name', $(this).val() +'[]'); $(this).next().attr('name', $(this).val() +'[]') });
		clearTemplates.next().children('.save-slides-template-item').on('click', function() {
			if ( $(this).parent().find('.template-visible').val() == '' ) { alert('Enter template name!'); return false; }
			var agree = confirm("Save template?");
			if (agree) {
				saveSlidesTemplate($(this));
				$(this).parent().find('h4').hide();
				$(this).after( '<h4>'+ $(this).parent().find('.template-visible').val() +'</h4>' );
				$(this).parent().find('.template-visible').hide();
				$(this).hide();
				return false;
			}
			else {
				return false;
			}
		});
		return false;
	});

	// Delete Template Function
	removeSlidesTemplate();
	function removeSlidesTemplate() {
		$('.delete-slides-template-item').live('click', function() {
			var agree = confirm("Delete template?");
			if (agree) {
				$(this).parent().remove();
				deleteSlidesTemplate($(this));
			}
			return false;
		});
	}

	// Load Template Function
	loadSlidesTemplate();
	function loadSlidesTemplate() {
	$('.load-slides-template-item').live('click', function() {
		var agree = confirm("Load template?");
		if ( agree == false ) { return false; }

		var sliderInt = $('#slides').attr('rel');
		var elementContainer = $('#of-option-slideroptions').find('.slider ul');
		var newElement = '';	
		
		var currentSlides = elementContainer.find('li').size();
		var elementAdd = $(this).parent().find('.template-string').val();
		var elementAddArray = [];
		elementAddArray = elementAdd.split('%_%');
		newNum = currentSlides + 1;
		for(var i = 0; i < (Object.keys(elementAddArray).length) - 1; i++) {
			var elementSplitOptions = elementAddArray[i].split(',%#,');
			if ( elementSplitOptions[0] == ''  ) { elementSplitOptions.splice(0,1) }
			if ( i != 0 ) { elementSplitOptions[0] = elementSplitOptions[0].replace(',','')}
			if ( elementSplitOptions[1] == '' ) { slideTitle = 'Slide ' + newNum; } else { slideTitle = elementSplitOptions[0]; }
			newElement = '<li><div class="slide_header"><strong>' + slideTitle + '</strong><input type="hidden" class="slide of-input order" name="' + SmofPage.name + '[slides][' + newNum + '][order]" id="slides_slide_order-' + newNum + '" value="' + newNum + '"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><label>Title</label><input class="slide of-input of-slider-title" name="' + SmofPage.name + '[slides][' + newNum + '][title]" id="slides_' + newNum + '_slide_title" value="' + elementSplitOptions[0] + '"><label>Image URL</label><input class="slide of-input" name="' + SmofPage.name + '[slides][' + newNum + '][url]" id="slides_' + newNum + '_slide_url" value="' + elementSplitOptions[1] + '"><div class="upload_button_div"><span class="button media_upload_button" id="slides_' + newNum + '" rel="' + sliderInt + '">Upload</span><span class="button mlu_remove_button hide" id="reset_slides_' + newNum + '" title="slides_' + newNum + '">Remove</span></div><div class="screenshot"><a class="of-uploaded-image" href="' + elementSplitOptions[2] + '"><img id="image_slides_' + newNum + '" class="of-option-image" src="' + elementSplitOptions[1] + '" alt=""></a></div><a class="slide_delete_button" title="Delete Slide" href="#">Delete</a><div class="clear"></div></div></li>';
			if ( elementContainer.find('li:last').length ) { elementContainer.find('li:last').after(newElement); } else { elementContainer.append(newElement); }
			elementContainer.find('.remove_item').on('click', function() {$(this).parent().remove(); return false;});
			disableSubmit();
			newNum++;
		};
		return false;
	});
	}

	
// Content Builder
// ***************

	// Save Template
	$('.save_template').live('click', function() {

		var readyContent = [];
		var number = 0;
		$(this).parent().find('li').each(function() {
			var content = $(this).find('.of-slider-title').find(":selected").val();
			switch(content) {
				
				case 'columns':
					var columnText = [];
					$(this).find('textarea.of-input').each(function() {
						columnText.push($(this).val());
						columnText.push('%#');
					});
					var columnType = $(this).find(".columns").find(":selected").val();
					readyContent.push(content +',%#');
					readyContent.push(columnType +',%#');	
					readyContent.push(columnText);	
					readyContent.push('%_%');					
				break;
				
				case 'products':
					var blogOptions = [];
					$(this).find('.editcontent .of-input').each(function() {
						blogOptions.push($(this).val() +',%#');
					});
					blogOptions[3] = $(this).find('.editcontent .ajaxcheckbox').is(':checked') ? '1,%#' : '0,%#';
					blogOptions[4] = $(this).find('.editcontent .paginationcheckbox').is(':checked') ? '1,%#' : '0,%#';
					blogOptions[5] = $(this).find('.editcontent .reversecheckbox').is(':checked') ? '1,%#' : '0,%#';
					readyContent.push(content +',%#');
					readyContent.push(blogOptions);	
					readyContent.push('%_%');					
				break;
				
				case 'blog':
					var blogOptions = [];
					$(this).find('.editcontent .of-input').each(function() {
						blogOptions.push($(this).val() +',%#');
					});
					blogOptions[4] = $(this).find('.editcontent .ajaxcheckbox').is(':checked') ? '1,%#' : '0,%#';
					blogOptions[5] = $(this).find('.editcontent .paginationcheckbox').is(':checked') ? '1,%#' : '0,%#';
					blogOptions[6] = $(this).find('.editcontent .reversecheckbox').is(':checked') ? '1,%#' : '0,%#';
					readyContent.push(content +',%#');
					readyContent.push(blogOptions);
					readyContent.push('%_%');					
				break;
				
				case 'accordion':
					var accordionOptions = [];
					var count = 0;
					readyContent.push(content +',%#');
					$(this).find('.accordion').each(function() {
						accordionOptions.push($(this).val());
						count++;
					});
					for (i = 0; i < count; i = i + 2) {
						readyContent.push(accordionOptions[i] +',%#,'+ accordionOptions[i+1]);
						readyContent.push('%#');
					}
					readyContent.push('%_%');					
				break;
				
				case 'tabs':
					var tabsOptions = [];
					var count = 0;
					readyContent.push(content +',%#');
					$(this).find('.tabs').each(function() {
						tabsOptions.push($(this).val());
						count++;
					});
					for (i = 0; i < count; i = i + 2) {
						readyContent.push(tabsOptions[i] +',%#,'+ tabsOptions[i+1]);
						readyContent.push('%#');
					}
					readyContent.push('%_%');					
				break;
				
				case 'divider':
					readyContent.push(content +',%#');
					var dividerMargin = $(this).find('.editcontent input.of-input').val();
					readyContent.push(dividerMargin +',%#');
					readyContent.push('%_%');					
				break;
				
				case 'tdivider':
					readyContent.push(content +',%#');
					var dividerMargin = $(this).find('.editcontent input.of-input').val();
					readyContent.push(dividerMargin +',%#');
					readyContent.push('%_%');					
				break;

				case 'team':
					var teamOptions = [];
					readyContent.push(content +',%#');
					$(this).find('.checkbox').each(function() {
						if (this.checked) teamOptions.push($(this).val() +',%#');
					});
					readyContent.push(teamOptions);
					readyContent.push('%_%');
				break;
				
				case 'contactform':
					var contactOptions = [];
					readyContent.push(content +',%#');
					$(this).find('.checkbox').each(function() {
						if (this.checked) contactOptions.push($(this).val() +',%#');
						
					});
					readyContent.push(contactOptions);
					readyContent.push('%_%');
				break;
				
				case 'box':
					var boxOptions = [];
					$(this).find('.box').each(function() {
						boxOptions.push($(this).val());
					});
					readyContent.push(content +',%#');
					readyContent.push(boxOptions);
					readyContent.push('%_%');					
				break;
				
				case 'progress':
					var progressOptions = [];
					readyContent.push(content +',%#');
					$(this).find('.progressbar').each(function() {
						progressOptions.push($(this).val());
					});
					readyContent.push(progressOptions[0] +',%#,'+ progressOptions[1] +',%#,'+ progressOptions[2] +',%#');
					readyContent.push('%_%');					
				break;
				
				case 'texthtml':
					readyContent.push(content +',%#');
					var texthtml = $(this).find('.editcontent textarea').val();
					readyContent.push(texthtml);
					readyContent.push('%#');
					readyContent.push('%_%');					
				break;
				
				case 'title':
					readyContent.push(content +',%#');
					var title = $(this).find('.editcontent input').val();
					readyContent.push(title);
					readyContent.push('%#');
					readyContent.push('%_%');					
				break;
				
				case 'minislider':
					var minisliderOptions = [];
					var count = 0;
					readyContent.push(content +',%#');
					$(this).find('.editcontent textarea.minislider').each(function() {
						minisliderOptions.push($(this).val());
						count++;
					});
					for (i = 0; i < count; ++i) {
						readyContent.push(minisliderOptions[i]);
						readyContent.push('%#');
					}
					readyContent.push('%_%');					
				break;

				case 'circles':
					var circlesOptions = [];
					var count = 0;
					readyContent.push(content +',%#');
					$(this).find('.circles').each(function() {
						circlesOptions.push($(this).val());
						count++;
					});
					for (i = 0; i < count; ++i) {
						readyContent.push(circlesOptions[i]);
						readyContent.push('%#');
					}
					readyContent.push('%_%');	
				break;
				
				case 'fullbox':
				var fullboxOptions = [];
				readyContent.push(content +',%#');
				$(this).find('.fw-box').each(function() {
					fullboxOptions.push($(this).val());
				});
				readyContent.push(fullboxOptions[0] +',%#,'+ fullboxOptions[1] +',%#');
				readyContent.push('%_%');					
				break;
				
				case 'fulllink':
					var fulllinkOptions = [];
					readyContent.push(content +',%#');
					$(this).find('.fw-link').each(function() {
						fulllinkOptions.push($(this).val());
					});
					readyContent.push(fulllinkOptions[0] +',%#,'+ fulllinkOptions[1] +',%#');
					readyContent.push('%_%');					
				break;				
			}
			var content = undefined;
		});
	var saveIcon = '<div class="template-icon"><h4>Template Name</h3><input class="of-input template template-visible" name="template" /><input class="template template-string" type="hidden" name="template" value="'+ readyContent +'"/><a href="#" class="save-template-item" title="Save Template">!!Save</a><a href="#" class="load-template-item" title="Load Template">!!Load</a><a href="#" class="delete-template-item" title="Delete Template">!!Delete</a></div>';
	clearTemplates = $(this).next();
	clearTemplates.after(saveIcon);
	clearTemplates.next().children('.template-visible').focus().on('keyup', function() { $(this).attr('name', $(this).val() +'[]'); $(this).next().attr('name', $(this).val() +'[]') });
	clearTemplates.next().children('.save-template-item').on('click', function() {
		if ( $(this).parent().find('.template-visible').val() == '' ) { alert('Enter template name!'); return false; }
		var agree = confirm("Save template?");
		if (agree) {
			saveTemplate($(this));
			$(this).parent().find('h4').hide();
			$(this).after( '<h4>'+ $(this).parent().find('.template-visible').val() +'</h4>' );
			$(this).parent().find('.template-visible').hide();
			$(this).hide();
			return false;
		}
		else {
			return false;
		}
	});
	return false;
	});
	
	// Delete Template Function
	removeTemplate();
	function removeTemplate() {
		$('.delete-template-item').live('click', function() {
			var agree = confirm("Delete template?");
			if (agree) {
				$(this).parent().remove();
				deleteTemplate($(this));
			}
			return false;
		});
	}

	// Load Template Function
	loadTemplate();
	function loadTemplate() {
	$('.load-template-item').live('click', function() {
		var agree = confirm("Load template?");
		if ( agree == false ) { return false; }

		var elementContainer = $('#of-option-shortcodegenerator').find('.slider ul');
		var newElement = '';	
		var selectBoxed = '<select class="select of-input of-slider-title"><option value="0"> </option><option value="accordion">Accordion</option><option value="blog">Blog</option><option value="box">Box</option><option value="minislider">Client Slider</option><option value="columns">Columns</option><option value="contactform">Contact Form</option><option value="divider">Divider</option><option value="tdivider">Divider (Transparent)</option><option value="circles">Featured Circles</option><option value="fullbox">Full-Width Box</option><option value="fulllink">Full-Width Link</option><option value="products">Products Fancy List</option><option value="progress">Progress Bar</option><option value="tabs">Tabs</option><option value="team">Team</option><option value="texthtml">Text/HTML</option><option value="title">Title</option></select>';
		elementContainer.find('li').each(function() {
			$(this).remove();
		});
		var elementAdd = $(this).parent().find('.template-string').val();
		var elementAddArray = [];
		elementAddArray = elementAdd.split('%_%');
		for(var i = 0; i < (Object.keys(elementAddArray).length) - 1; i++) {
			var elementSplitOptions = elementAddArray[i].split(',%#,');
			if ( elementSplitOptions[0] == ''  ) { elementSplitOptions.splice(0,1) }
			if ( i != 0 ) { elementSplitOptions[0] = elementSplitOptions[0].replace(',','')}
			var selectBox = selectBoxed.replace('value="'+ elementSplitOptions[0] +'"', 'value="'+ elementSplitOptions[0] +'" selected');

			switch(elementSplitOptions[0]) {
				
				case 'accordion':
					newElement = '<li><div class="slide_header"><strong>Accordion</strong><input type="hidden" class="slide of-input order"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><h4>Element</h4><div class="select_wrapper"><span>Accordion</span>'+ selectBox +'</div><a class="slide_delete_button" title="Delete Element" href="#">Delete</a><div class="clear"></div><div class="editcontent"><div class="duplicateelement"><h4>Title</h4><input class="of-input accordion" value="'+ elementSplitOptions[1] +'" /><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input accordion" rows="2">'+ elementSplitOptions[2] +'</textarea></div>';
					elementSplitOptions.splice(0,3);
					for(n=0; n < (Object.keys(elementSplitOptions).length-1)/2; n = n +2){
						newElement += '<div class="clonedelement"><h4>Title</h4><input class="of-input accordion" value="'+ elementSplitOptions[n] +'" /><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input accordion" rows="2">'+ elementSplitOptions[n+1] +'</textarea><a href="#" class="remove_item" title="Delete">!!Remove</a></div>'
					}
					newElement += '<a href="#" class="button duplicate_content_button">Add Section</a></div></div></li>';
				break;
				
				case 'tabs':
					newElement = '<li><div class="slide_header"><strong>Tabs</strong><input type="hidden" class="slide of-input order"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><h4>Element</h4><div class="select_wrapper"><span>Tabs</span>'+ selectBox +'</div><a class="slide_delete_button" title="Delete Element" href="#">Delete</a><div class="clear"></div><div class="editcontent"><div class="duplicateelement"><h4>Title</h4><input class="of-input tabs" value="'+ elementSplitOptions[1] +'" /><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input tabs" rows="2">'+ elementSplitOptions[2] +'</textarea></div>';
					elementSplitOptions.splice(0,3);
					for(n=0; n < (Object.keys(elementSplitOptions).length-1)/2; n = n +2){
						newElement += '<div class="clonedelement"><h4>Title</h4><input class="of-input tabs" value="'+ elementSplitOptions[n] +'" /><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input tabs" rows="2">'+ elementSplitOptions[n+1] +'</textarea><a href="#" class="remove_item" title="Delete">!!Remove</a></div>'
					}
					newElement += '<a href="#" class="button duplicate_content_button">Add Tab</a></div></div></li>';
				break;
				
				case 'divider':
				newElement = '<li><div class="slide_header"><strong>Divider</strong><input type="hidden" class="slide of-input order"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><h4>Element</h4><div class="select_wrapper"><span>Divider</span>'+ selectBox +'</div><a class="slide_delete_button" title="Delete Element" href="#">Delete</a><div class="clear"></div><div class="editcontent"><h4>Margin</h4><input class="of-input rows" value="'+ elementSplitOptions[1] +'"/>';
				newElement += '</div></div></li>';
				break;
				case 'tdivider':
				newElement = '<li><div class="slide_header"><strong>Divider (Transparent)</strong><input type="hidden" class="slide of-input order"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><h4>Element</h4><div class="select_wrapper"><span>Divider (Transparent)</span>'+ selectBox +'</div><a class="slide_delete_button" title="Delete Element" href="#">Delete</a><div class="clear"></div><div class="editcontent"><h4>Margin</h4><input class="of-input rows" value="'+ elementSplitOptions[1] +'"/>';
				newElement += '</div></div></li>';
				break;
				case 'columns':
				newElement = '<li><div class="slide_header"><strong>Columns</strong><input type="hidden" class="slide of-input order"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><h4>Element</h4><div class="select_wrapper"><span>Columns</span>'+ selectBox +'</div><a class="slide_delete_button" title="Delete Element" href="#">Delete</a><div class="clear"></div><div class="editcontent"><h4>Columns</h4><div class="select_wrapper"><span> </span><select class="select of-input columns"><option value="1">50%, 50%</option><option value="2">33%, 33%, 33%</option><option value="3">33%, 66%</option><option value="4">66%, 33%</option><option value="5">25%, 25%, 25%, 25%</option><option value="6">25%, 50%, 25%</option><option value="7">25%, 25%, 50%</option><option value="8">50%, 25%, 25%</option><option value="9">25%, 75%</option><option value="10">75%, 25%</option></select></div>';
				switch(elementSplitOptions[1]) {
					case '1':
					newElement += '<div class="columnsinput"><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input" rows="8">'+ elementSplitOptions[2] +'</textarea><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input" rows="8">'+ elementSplitOptions[3] +'</textarea></div>'
					var columnString = '50% 50%';
					break;
					case '3':
					newElement += '<div class="columnsinput"><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input" rows="8">'+ elementSplitOptions[2] +'</textarea><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input" rows="8">'+ elementSplitOptions[3] +'</textarea></div>'
					var columnString = '33% 66%';
					break;
					case '4':
					newElement += '<div class="columnsinput"><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input" rows="8">'+ elementSplitOptions[2] +'</textarea><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input" rows="8">'+ elementSplitOptions[3] +'</textarea></div>'
					var columnString = '66% 33%';
					break;
					case '9':
					newElement += '<div class="columnsinput"><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input" rows="8">'+ elementSplitOptions[2] +'</textarea><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input" rows="8">'+ elementSplitOptions[3] +'</textarea></div>'
					var columnString = '25% 75%';
					break;
					case '10':
					newElement += '<div class="columnsinput"><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input" rows="8">'+ elementSplitOptions[2] +'</textarea><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input" rows="8">'+ elementSplitOptions[3] +'</textarea></div>'
					var columnString = '75% 25%';
					break;
					case '2':
					newElement += '<div class="columnsinput"><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input" rows="8">'+ elementSplitOptions[2] +'</textarea><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input" rows="8">'+ elementSplitOptions[3] +'</textarea><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input" rows="8">'+ elementSplitOptions[4] +'</textarea></div>';
					var columnString = '33% 33% 33%';
					break;
					case '6':
					newElement += '<div class="columnsinput"><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input" rows="8">'+ elementSplitOptions[2] +'</textarea><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input" rows="8">'+ elementSplitOptions[3] +'</textarea><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input" rows="8">'+ elementSplitOptions[4] +'</textarea></div>';
					var columnString = '25% 50% 25%';
					break;
					case '7':
					newElement += '<div class="columnsinput"><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input" rows="8">'+ elementSplitOptions[2] +'</textarea><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input" rows="8">'+ elementSplitOptions[3] +'</textarea><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input" rows="8">'+ elementSplitOptions[4] +'</textarea></div>';
					var columnString = '25% 25% 50%';
					break;
					case '8':
					newElement += '<div class="columnsinput"><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input" rows="8">'+ elementSplitOptions[2] +'</textarea><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input" rows="8">'+ elementSplitOptions[3] +'</textarea><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input" rows="8">'+ elementSplitOptions[4] +'</textarea></div>';
					var columnString = '50% 25% 25%';					
					break;
					case '5':
					newElement += '<div class="columnsinput"><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input" rows="8">'+ elementSplitOptions[2] +'</textarea><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input" rows="8">'+ elementSplitOptions[3] +'</textarea><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input" rows="8">'+ elementSplitOptions[4] +'</textarea><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input" rows="8">'+ elementSplitOptions[5] +'</textarea></div>';
					var columnString = '25% 25% 25% 25%';
					break;
				}
				newElement = newElement.replace('<span> </span>', '<span>'+ columnString +'</span>');
				newElement = newElement.replace('value="'+ elementSplitOptions[1] +'"', 'value="'+ elementSplitOptions[1] +'" selected');
				newElement += '</div></div></li>';
				break;
				case 'blog':
				
					var dropdown = $('#allaround_hidden_posts').html();
					
					newElement = '<li><div class="slide_header"><strong>Blog</strong><input type="hidden" class="slide of-input order"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><h4>Element</h4><div class="select_wrapper"><span>Blog</span>'+ selectBox +'</div><a class="slide_delete_button" title="Delete Element" href="#">Delete</a><div class="clear"></div><div class="editcontent">';
					
					select_1 = '<h4>Columns</h4><div class="select_wrapper"><span> </span><select class="select of-input"><option value="1">1</option><option value="2"></option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option></select></div>';
					select_1 = select_1.replace('<span> </span>', '<span>'+ elementSplitOptions[1] +'</span>');
					select_1 = select_1.replace('value="'+ elementSplitOptions[1] +'"', 'value="'+ elementSplitOptions[1] +'" selected');
					select_2 = '<h4>Category</h4><div class="select_wrapper"><span> </span>'+ dropdown +'</div>';
					select_2 = select_2.replace('<span> </span>', '<span>'+ elementSplitOptions[3] +'</span>');
					select_2 = select_2.replace('value="'+ elementSplitOptions[3] +'"', 'value="'+ elementSplitOptions[3] +'" selected');
					select_3 = '<h4>Order</h4><div class="select_wrapper"><span> </span><select class="select of-input"><option value="date">Date</option><option value="comment_count">Popular</option><option value="rand">Random</option><option value="author">Author</option><option value="title">Title</option></select></div>';
					select_3 = select_3.replace('<span> </span>', '<span>'+ elementSplitOptions[4] +'</span>');
					select_3 = select_3.replace('value="'+ elementSplitOptions[4] +'"', 'value="'+ elementSplitOptions[4] +'" selected');
					
					newElement += select_1;
					newElement += '<h4>Rows</h4><input class="of-input rows" value="'+ elementSplitOptions[2] +'"/>';
					newElement += select_2;
					newElement += select_3;
					
					if ( elementSplitOptions[5] == 1 ) checked ='checked="checked"'; else checked ='';
					newElement += '<h4>Ajax Load</h4><input class="select of-input ajaxcheckbox" type="checkbox" value="1" '+ checked +'/>';
					
					if ( elementSplitOptions[6] == 1 ) checked ='checked="checked"'; else checked ='';
					newElement += '<h4>Show Pagination</h4><input class="select of-input paginationcheckbox" type="checkbox" value="1" '+ checked +'/>';
							
					if ( elementSplitOptions[7] == 1 ) checked ='checked="checked"'; else checked ='';
					newElement += '<h4>Reverse Order</h4><input class="select of-input reversecheckbox" type="checkbox" value="1" '+ checked +'/>';		
										
					newElement += '</div></div></li>';
					
				break;
				case 'products':

					var dropdown = $('#allaround_hidden_products').html();
					
					newElement = '<li><div class="slide_header"><strong>Products Fancy List</strong><input type="hidden" class="slide of-input order"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><h4>Element</h4><div class="select_wrapper"><span>Products Fancy List</span>'+ selectBox +'</div><a class="slide_delete_button" title="Delete Element" href="#">Delete</a><div class="clear"></div><div class="editcontent"><h4>Rows</h4><input class="of-input rows" value="'+ elementSplitOptions[1] +'"/>';
	
					select_2 = '<h4>Category</h4><div class="select_wrapper"><span> </span>'+ dropdown +'</div>';
					select_2 = select_2.replace('<span> </span>', '<span>'+ elementSplitOptions[2] +'</span>');
					select_2 = select_2.replace('value="'+ elementSplitOptions[2] +'"', 'value="'+ elementSplitOptions[2] +'" selected');
	
					select_3 = '<h4>Order</h4><div class="select_wrapper"><span> </span><select class="select of-input"><option value="date">Date</option><option value="comment_count">Popular</option><option value="rand">Random</option><option value="author">Author</option><option value="title">Title</option></select></div>';
					select_3 = select_3.replace('<span> </span>', '<span>'+ elementSplitOptions[3] +'</span>');
					select_3 = select_3.replace('value="'+ elementSplitOptions[3] +'"', 'value="'+ elementSplitOptions[3] +'" selected');
	
					newElement += select_2;
					newElement += select_3;	
						
					if ( elementSplitOptions[4] == 1 ) checked ='checked="checked"'; else checked ='';
					newElement += '<h4>Ajax Load</h4><input class="select of-input ajaxcheckbox" type="checkbox" value="1" '+ checked +'/>';
					
					if ( elementSplitOptions[5] == 1 ) checked ='checked="checked"'; else checked ='';
					newElement += '<h4>Show Pagination</h4><input class="select of-input paginationcheckbox" type="checkbox" value="1" '+ checked +'/>';	
						
					if ( elementSplitOptions[6] == 1 ) checked ='checked="checked"'; else checked ='';
					newElement += '<h4>Reverse Order</h4><input class="select of-input reversecheckbox" type="checkbox" value="1" '+ checked +'/>';	
					
					newElement += '</div></div></li>';
					
				break;
				
				case 'team':
					newElement = '<li><div class="slide_header"><strong>Team</strong><input type="hidden" class="slide of-input order"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><h4>Element</h4><div class="select_wrapper"><span>Team</span>'+ selectBox +'</div><a class="slide_delete_button" title="Delete Element" href="#">Delete</a><div class="clear"></div><div class="editcontent">';
					var checkboxes = $('#allaround_hidden_contacts').html();
					elementSplitOptions.splice(0,1);
					checkboxesElement = '<h4>Check to include</h4>'+ checkboxes +'';
					for(n=0; n < Object.keys(elementSplitOptions).length; n++){
						checkboxesElement = checkboxesElement.replace('value="'+ elementSplitOptions[n] +'"', 'value="'+ elementSplitOptions[n] +'" checked="checked"');
					}				
					newElement += checkboxesElement;
					newElement += '</div></div></li>';
				break;
				
				case 'contactform':
					newElement = '<li><div class="slide_header"><strong>Contact Form</strong><input type="hidden" class="slide of-input order"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><h4>Element</h4><div class="select_wrapper"><span>Contact Form</span>'+ selectBox +'</div><a class="slide_delete_button" title="Delete Element" href="#">Delete</a><div class="clear"></div><div class="editcontent">';
					var checkboxes = $('#allaround_hidden_contacts').html();
					elementSplitOptions.splice(0,1);
					checkboxesElement = '<h4>Check to include</h4>'+ checkboxes +'';
					for(n=0; n < Object.keys(elementSplitOptions).length; n++){
						checkboxesElement = checkboxesElement.replace('value="'+ elementSplitOptions[n] +'"', 'value="'+ elementSplitOptions[n] +'" checked="checked"');
					}				
					newElement += checkboxesElement;
					newElement += '</div></div></li>';
				break;
				
				case 'box':
					newElement = '<li><div class="slide_header"><strong>Box</strong><input type="hidden" class="slide of-input order"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><h4>Element</h4><div class="select_wrapper"><span>Box</span>'+ selectBox +'</div><a class="slide_delete_button" title="Delete Element" href="#">Delete</a><div class="clear"></div><div class="editcontent">';
					select_1 = '<h4>Type</h4><div class="select_wrapper"><span>Plain Box</span><select class="select of-input box"><option value="blue">Blue Box</option><option value="green">Green Box</option><option value="plain" selected>Plain Box</option><option value="redbox">Red Box</option><option value="yellow">Yellow Box</option></select></div><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input box" rows="2">';
					select_1 = select_1.replace('value="'+ elementSplitOptions[0] +'"', 'value="'+ elementSplitOptions[0] +'" selected');
					newElement += select_1;
					newElement += elementSplitOptions[1] +'</textarea>';
					newElement += '</div></div></li>';
				break;
				
				case 'progress':
					newElement = '<li><div class="slide_header"><strong>Progress Bar</strong><input type="hidden" class="slide of-input order"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><h4>Element</h4><div class="select_wrapper"><span>Progress Bar</span>'+ selectBox +'</div><a class="slide_delete_button" title="Delete Element" href="#">Delete</a><div class="clear"></div><div class="editcontent"><h4>How Much</h4><input class="of-input progressbar" value="'+elementSplitOptions[1]+'" /><h4>Out Of</h4><input class="of-input progressbar" value="'+elementSplitOptions[2]+'" /><h4>Title</h4><input class="of-input progressbar" value="'+elementSplitOptions[3]+'" />';
					newElement += '</div></div></li>';
				break;
				
				case 'texthtml':
					newElement = '<li><div class="slide_header"><strong>Text/HTML</strong><input type="hidden" class="slide of-input order"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><h4>Element</h4><div class="select_wrapper"><span>Text/HTML</span>'+ selectBox +'</div><a class="slide_delete_button" title="Delete Element" href="#">Delete</a><div class="clear"></div><div class="editcontent"><h4>Text/HTML/Shortcodes/Embeds</h4><textarea class="of-input">'+elementSplitOptions[1]+'</textarea>';
					newElement += '</div></div></li>';
				break;
				
				case 'title':
					newElement = '<li><div class="slide_header"><strong>Title</strong><input type="hidden" class="slide of-input order"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><h4>Element</h4><div class="select_wrapper"><span>Title</span>'+ selectBox +'</div><a class="slide_delete_button" title="Delete Element" href="#">Delete</a><div class="clear"></div><div class="editcontent"><h4>Title</h4><input class="of-input" value="'+elementSplitOptions[1]+'" />';
					newElement += '</div></div></li>';
				break;
				
				case 'minislider':
					newElement = '<li><div class="slide_header"><strong>Mini Slider</strong><input type="hidden" class="slide of-input order"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><h4>Element</h4><div class="select_wrapper"><span>Mini Slider</span>'+ selectBox +'</div><a class="slide_delete_button" title="Delete Element" href="#">Delete</a><div class="clear"></div><div class="editcontent">';
						newElement += '<div class="duplicateelement"><h4>Image Code</h4><textarea class="of-input minislider" rows="2">'+ elementSplitOptions[1] +'</textarea></div>';
					elementSplitOptions.splice(0,2);
					for(n=0; n < Object.keys(elementSplitOptions).length - 1; n++){
						newElement += '<div class="clonedelement"><h4>Image Code</h4><textarea class="of-input minislider" rows="2">'+ elementSplitOptions[n] +'</textarea><a href="#" class="remove_item" title="Delete">!!Remove</a></div>'
					}
					newElement += '<a href="#" class="button duplicate_content_button">Add Client Image</a></div></div></li>';
				break;
				
				case 'circles':
					newElement = '<li><div class="slide_header"><strong>Featured Circles</strong><input type="hidden" class="slide of-input order"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><h4>Element</h4><div class="select_wrapper"><span>Featured Circles</span>'+ selectBox +'</div><a class="slide_delete_button" title="Delete Element" href="#">Delete</a><div class="clear"></div><div class="editcontent"><h4>Circle Title</h4><input class="of-input circles" value="'+ elementSplitOptions[1] +'"/><h4>Text Title</h4><input class="of-input circles" value="'+ elementSplitOptions[2] +'"/><h4>Text</h4><textarea class="of-input circles" rows="2">'+ elementSplitOptions[3] +'</textarea><hr><h4>Circle Title</h4><input class="of-input circles" value="'+ elementSplitOptions[4] +'"/><h4>Text Title</h4><input class="of-input circles" value="'+ elementSplitOptions[5] +'"/><h4>Text</h4><textarea class="of-input circles" rows="2">'+ elementSplitOptions[6] +'</textarea><hr><h4>Circle Title</h4><input class="of-input circles" value="'+ elementSplitOptions[7] +'"/><h4>Text Title</h4><input class="of-input circles" value="'+ elementSplitOptions[8] +'"/><h4>Text</h4><textarea class="of-input circles" rows="2">'+ elementSplitOptions[9] +'</textarea>';
					newElement += '</div></div></li>';
				break;

				case 'fullbox':
					var sliderRel = $('#contents').attr('rel');
					newElement = '<li><div class="slide_header"><strong>Full-Width Box</strong><input type="hidden" class="slide of-input order"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><h4>Element</h4><div class="select_wrapper"><span>Full-Width Box</span>'+ selectBox +'</div><a class="slide_delete_button" title="Delete Element" href="#">Delete</a><div class="clear"></div><div class="editcontent"><h4>Image URL</h4><input class="slide of-input fw-box" id="fw-box_slide_url" value="'+ elementSplitOptions[1] +'"><div class="upload_button_div"><span class="button media_upload_button" id="fw-box" rel="'+sliderRel+'">Upload</span><span class="button mlu_remove_button hide" id="reset_fw-box">Remove</span></div><h4>Text</h4><input class="of-input fw-link" value="'+ elementSplitOptions[2] +'" />';
					newElement += '</div></div></li>';
				break;

				case 'fulllink':
					newElement = '<li><div class="slide_header"><strong>Full-Width Link</strong><input type="hidden" class="slide of-input order"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><h4>Element</h4><div class="select_wrapper"><span>Full-Width Link</span>'+ selectBox +'</div><a class="slide_delete_button" title="Delete Element" href="#">Delete</a><div class="clear"></div><div class="editcontent"><h4>Title</h4><input class="of-input fw-link" value="'+elementSplitOptions[1]+'" /><h4>Link</h4><input class="of-input fw-link" value="'+elementSplitOptions[2]+'" />';
					newElement += '</div></div></li>';
				break;


			}

			elementContainer.append(newElement);
			elementContainer.find('.remove_item').on('click', function() {$(this).parent().remove(); return false;});
			initColumns(elementContainer);
			initChange();
			disableSubmit();
		};
		return false;
	});
	}

// AJAX Slides and template Delete/Save
// ************************************

	/** AJAX Save Slides */
	function saveSlidesTemplate(selectedTemplate) {
			
		var nonce = $('#security').val();

		$('.ajax-loading-img').fadeIn();
		
		//get serialized data from all our option fields			
		var serializedReturn = selectedTemplate.parent().find('.template:input[name][name!="security"][name!="of_reset"]').serialize();
		var data = {
			type: 'save',
			action: 'slides_ajax_post_action',
			security: nonce,
			data: serializedReturn
		};
					
		$.post(ajaxurl, data, function(response) {
			var success = $('#of-popup-save');
			var fail = $('#of-popup-fail');
			var loading = $('.ajax-loading-img');
			loading.fadeOut();  
						
			if (response==1) {
				success.fadeIn();
			} else { 
				fail.fadeIn();
			}
						
			window.setTimeout(function(){
				success.fadeOut(); 
				fail.fadeOut();				
			}, 2000);
		});
			
	return false; 
					
	}

	/** AJAX Delete Slides */
	function deleteSlidesTemplate(selectedTemplate) {
			
		var nonce = $('#security').val();

		$('.ajax-loading-img').fadeIn();
		
		//get serialized data from all our option fields			
		var serializedReturn = selectedTemplate.parent().find('.template:input[name][name!="security"][name!="of_reset"]').serialize();
		var data = {
			type: 'delete',
			action: 'slides_ajax_post_action',
			security: nonce,
			data: serializedReturn
		};
					
		$.post(ajaxurl, data, function(response) {
			var success = $('#of-popup-save');
			var fail = $('#of-popup-fail');
			var loading = $('.ajax-loading-img');
			loading.fadeOut();  
						
			if (response==1) {
				success.fadeIn();
			} else { 
				fail.fadeIn();
			}
						
			window.setTimeout(function(){
				success.fadeOut(); 
				fail.fadeOut();				
			}, 2000);
		});
			
	return false; 
					
	}  	 

	/** AJAX Save Templates */
	function saveTemplate(selectedTemplate) {
			
		var nonce = $('#security').val();

		$('.ajax-loading-img').fadeIn();
		
		//get serialized data from all our option fields			
		var serializedReturn = selectedTemplate.parent().find('.template:input[name][name!="security"][name!="of_reset"]').serialize();
		var data = {
			type: 'save',
			action: 'page_ajax_post_action',
			security: nonce,
			data: serializedReturn
		};
					
		$.post(ajaxurl, data, function(response) {
			var success = $('#of-popup-save');
			var fail = $('#of-popup-fail');
			var loading = $('.ajax-loading-img');
			loading.fadeOut();  
						
			if (response==1) {
				success.fadeIn();
			} else { 
				fail.fadeIn();
			}
						
			window.setTimeout(function(){
				success.fadeOut(); 
				fail.fadeOut();				
			}, 2000);
		});
			
	return false; 
					
	}  
	
	/** AJAX Delete Templates */
	function deleteTemplate(selectedTemplate) {
			
		var nonce = $('#security').val();

		$('.ajax-loading-img').fadeIn();
		
		//get serialized data from all our option fields			
		var serializedReturn = selectedTemplate.parent().find('.template:input[name][name!="security"][name!="of_reset"]').serialize();
		var data = {
			type: 'delete',
			action: 'page_ajax_post_action',
			security: nonce,
			data: serializedReturn
		};
					
		$.post(ajaxurl, data, function(response) {
			var success = $('#of-popup-save');
			var fail = $('#of-popup-fail');
			var loading = $('.ajax-loading-img');
			loading.fadeOut();  
						
			if (response==1) {
				success.fadeIn();
			} else { 
				fail.fadeIn();
			}
						
			window.setTimeout(function(){
				success.fadeOut(); 
				fail.fadeOut();				
			}, 2000);
		});
			
	return false; 
					
	}  	 
	
	
	/**	Tipsy @since v1.3 */
	if (jQuery().tipsy) {
		$('.typography-size, .typography-height, .typography-face, .typography-style, .of-typography-color').tipsy({
			fade: true,
			gravity: 's',
			opacity: 0.7,
		});
	}
	
	
	/**
	  * JQuery UI Slider function
	  * Dependencies 	 : jquery, jquery-ui-slider
	  * Feature added by : Smartik - http://smartik.ws/
	  * Date 			 : 03.17.2013
	  */
	jQuery('.smof_sliderui').each(function() {
		
		var obj   = jQuery(this);
		var sId   = "#" + obj.data('id');
		var val   = parseInt(obj.data('val'));
		var min   = parseInt(obj.data('min'));
		var max   = parseInt(obj.data('max'));
		var step  = parseInt(obj.data('step'));
		
		//slider init
		obj.slider({
			value: val,
			min: min,
			max: max,
			step: step,
			slide: function( event, ui ) {
				jQuery(sId).val( ui.value );
			}
		});
		
	});
	
	
	/**
	  * Switch
	  * Dependencies 	 : jquery
	  * Feature added by : Smartik - http://smartik.ws/
	  * Date 			 : 03.17.2013
	  */
	jQuery(".cb-enable").click(function(){
		var parent = $(this).parents('.switch-options');
		jQuery('.cb-disable',parent).removeClass('selected');
		jQuery(this).addClass('selected');
		jQuery('.main_checkbox',parent).attr('checked', true);
		
		//fold/unfold related options
		var obj = jQuery(this);
		var $fold='.f_'+obj.data('id');
		jQuery($fold).slideDown('normal', "swing");
	});
	jQuery(".cb-disable").click(function(){
		var parent = $(this).parents('.switch-options');
		jQuery('.cb-enable',parent).removeClass('selected');
		jQuery(this).addClass('selected');
		jQuery('.main_checkbox',parent).attr('checked', false);
		
		//fold/unfold related options
		var obj = jQuery(this);
		var $fold='.f_'+obj.data('id');
		jQuery($fold).slideUp('normal', "swing");
	});
	//disable text select(for modern chrome, safari and firefox is done via CSS)
	if (($.browser.msie && $.browser.version < 10) || $.browser.opera) { 
		$('.cb-enable span, .cb-disable span').find().attr('unselectable', 'on');
	}
	
	
	/**
	  * Google Fonts
	  * Dependencies 	 : google.com, jquery
	  * Feature added by : Smartik - http://smartik.ws/
	  * Date 			 : 03.17.2013
	  */
	function GoogleFontSelect( slctr, mainID ){
		
		var _selected = $(slctr).val(); 						//get current value - selected and saved
		var _linkclass = 'style_link_'+ mainID;
		var _previewer = mainID +'_ggf_previewer';
		
		if( _selected ){ //if var exists and isset
			
			//Check if selected is not equal with "Select a font" and execute the script.
			if ( _selected !== 'none' && _selected !== 'Select a font' ) {
				
				//remove other elements crested in <head>
				$( '.'+ _linkclass ).remove();
				
				//replace spaces with "+" sign
				var the_font = _selected.replace(/\s+/g, '+');
				
				//add reference to google font family
				$('head').append('<link href="http://fonts.googleapis.com/css?family='+ the_font +'" rel="stylesheet" type="text/css" class="'+ _linkclass +'">');
				
				//show in the preview box the font
				$('.'+ _previewer ).css('font-family', _selected +', sans-serif' );
				
			}else{
				
				//if selected is not a font remove style "font-family" at preview box
				$('.'+ _previewer ).css('font-family', '' );
				
			}
		
		}
	
	}
	
	//init for each element
	jQuery( '.google_font_select' ).each(function(){ 
		var mainID = jQuery(this).attr('id');
		GoogleFontSelect( this, mainID );
	});
	
	//init when value is changed
	jQuery( '.google_font_select' ).change(function(){ 
		var mainID = jQuery(this).attr('id');
		GoogleFontSelect( this, mainID );
	});
	
	

}); //end doc ready