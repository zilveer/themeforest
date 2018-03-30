/* global redux_change */
(function($){
	"use strict";

	$.redux = $.redux || {};

	$.redux.group = $.group || {};

	$(document).ready(function () {
		//Group functionality
		$.redux.group();
	});

	/* @from ReduxCore 3.0 */
	var confirmOnPageExit = function(e) {
		//return; // ONLY FOR DEBUGGING
		// If we haven't been passed the event get the window.event
		e = e || window.event;
		var message = redux_opts.save_pending;
		// For IE6-8 and Firefox prior to version 4
		if (e) {
			e.returnValue = message;
		}
		window.onbeforeunload = null;
		// For Chrome, Safari, IE8+ and Opera 12+
		return message;
	};

	/* @from ReduxCore 3.0 */
	function redux_change(variable) {
		//We need this for switch and image select fields , jquery dosn't catch it on fly
		if(variable.is('input[type=hidden]') || jQuery(variable).parents('fieldset:eq(0)').is('.redux-container-image_select') )
			jQuery('body').trigger('check_dependencies' , variable);

		if (variable.hasClass('compiler')) {
			jQuery('#redux-compiler-hook').val(1);
			//console.log('Compiler init');
		}
		if (variable.hasClass('foldParent')) {
			//verify_fold(variable);
		}
		window.onbeforeunload = confirmOnPageExit;
		if (jQuery(variable).hasClass('redux-field-error')) {
			jQuery(variable).removeClass('redux-field-error');
			jQuery(variable).parent().find('.redux-th-error').slideUp();
			var parentID = jQuery(variable).closest('.redux-group-tab').attr('id');
			var hideError = true;
			jQuery('#' + parentID + ' .redux-field-error').each(function() {
				hideError = false;
			});
			if (hideError) {
				jQuery('#' + parentID + '_li .redux-menu-error').hide();
				jQuery('#' + parentID + '_li .redux-group-tab-link-a').removeClass('hasError');
			}
		}
		jQuery('#redux-save-warn').slideDown();

	}

	$.redux.group = function(){
		$('.redux-groups-accordion')
		.accordion({
			  header: '.redux-groups-heading'
			, collapsible: true
			, active: false
			, heightStyle: 'content'
			, icons: {
				  'header': 'ui-icon-triangle-1-s'
				, 'activeHeader': 'ui-icon-triangle-1-s'
			}
		})
		.sortable({
			axis: 'y',
			handle: '.redux-groups-heading',
			placeholder: 'sortable-placeholder',
			start: function(event, ui) {
				ui.placeholder.height( ui.helper.outerHeight() );
			},
			stop: function (event, ui) {

				ui.item.parent().find('li.redux-groups-accordion-group').each(function(index) {
				
					var newSlide = $(this);
					
					$(newSlide).find('input[type="text"], input[type="hidden"], textarea , select').each(function(){
						var attr_name = $(this).attr('name');
						var attr_id = $(this).attr('id');

						// For some browsers, `attr` is undefined; for others,
						// `attr` is false.  Check for both.
						if (typeof attr_id !== 'undefined' && attr_id !== false)
							$(this).attr('id', $(this).attr('id').replace(/\d+(?!.*\d+)/, index) );
						if (typeof attr_name !== 'undefined' && attr_name !== false)
							$(this).attr('name', $(this).attr('name').replace(/\d+(?!.*\d+)/, index) );
		

						if ($(this).hasClass('group-sort')){
							$(this).val(index);
						}
						
					});
				});
				
					
				// IE doesn't register the blur when sorting
				// so trigger focusout handlers to remove .ui-state-focus
				ui.item.children('.redux-groups-heading').triggerHandler('focusout');
				var inputs = $('input.group-sort');
				inputs.each(function(idx) {
					$(this).val(idx);
				});
			}
		});

		$('.redux-groups-accordion-group input[data-is-group-title]').on('keyup',function(event) {
			$(this).parents('.redux-groups-accordion-group:first').find('.redux-groups-title').text(event.target.value);
		});

		$('.redux-groups-remove').live('click', function () {
			redux_change($(this));
			$(this).parent().find('input[type="text"]').val('');
			$(this).parent().find('input[type="hidden"]').val('');
			$(this).parent().parent().slideUp('medium', function () {
				$(this).remove();
			});
		});

		$('.redux-groups-add').click(function () {

			var newSlide = $(this).prev().find('.redux-groups-accordion-group:last').clone(true);
			var slideCount = $(newSlide).find('input[type="text"]').attr('name').match(/\d+(?!.*\d+)/);
			
			var slideCount1 = slideCount[0] * 1 + 1;

			$(newSlide).find('.redux-groups-heading').text('').append('<span class="redux-groups-title">New Group</span><span class="ui-accordion-header-icon ui-icon-triangle-1-s"></span>');
			$(this).prev().append(newSlide);


			$(newSlide).find('.redux-opts-upload-remove,.redux-opts-screenshot').each(function() {
				$(this).hide();
			});
			$(newSlide).find('.redux-opts-upload').each(function() {
				$(this).show();
			});
			
			$(newSlide).find('input[type="text"], input[type="hidden"], textarea , select').each(function(){
				var attr_name = $(this).attr('name');
				var attr_id = $(this).attr('id');
				$(this).val('');
				

				// For some browsers, `attr` is undefined; for others,
				// `attr` is false.  Check for both.
				if (typeof attr_id !== 'undefined' && attr_id !== false)
					$(this).attr('id', $(this).attr('id').replace(/\d+(?!.*\d+)/, slideCount1) );
				if (typeof attr_name !== 'undefined' && attr_name !== false)
					$(this).attr('name', $(this).attr('name').replace(/\d+(?!.*\d+)/, slideCount1) );

				if($(this).prop('tagName') == 'SELECT'){
					//we clean select2 first
					$(newSlide).find('.select2-container').remove();
					$(newSlide).find('select').removeClass('select2-offscreen');

					//we rebind the select2
					//$(newSlide).find('.redux-select-item').addClass('xxxxxxxxxxxxxxxx');

					//$.redux.select();
				}
				//$(this).attr('name', $(this).attr('name').replace(/\d+/, slideCount1) ).attr('id', $(this).attr('id').replace(/\d+/, slideCount1) );
				$(this).val('');
				if ($(this).hasClass('group-sort')){
					$(this).val(slideCount1);
				}
				
			});
			
			var fontAwsomeSelect = $(newSlide).find('.fontawsome-select');
			if(fontAwsomeSelect) {
				fontAwsomeSelect.find('h3').html('');
				fontAwsomeSelect.find('.fa-icons-menu li').removeClass('selected');
			}


		});
	}
})(jQuery);