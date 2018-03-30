var FormSerializer = require('./plugins/jquery.serialize-object.min.js');
// var md5 = require('locutus/php/strings/md5');
import md5 from 'locutus/php/strings/md5';
require('./plugins/isolatedScroll.js');

var klpb = klpb || {};

(function($) {
	"use strict";

	$.ZnFramework = function(){

		this.scope = $('.zn_pb_wrapper');

		// Publish button
		this.publish_button = $('.zn_publish');
		this.columns_widths = 'col-md-12 col-md-11 col-md-10 col-md-9 col-md-8 col-md-7 col-md-6 col-md-5 col-md-4 col-md-3 col-md-2 col-md-1-5 col-sm-12 col-sm-11 col-sm-10 col-sm-9 col-sm-8 col-sm-7 col-sm-6 col-sm-5 col-sm-4 col-sm-3 col-sm-2 col-sm-1-5';
		this.body           = $('body');

		//activate the plugin
		this.zinit();

	};

	$.ZnFramework.prototype = {

		zinit : function()
		{

			var fw = this;

			fw.addactions();
			fw.hide_editor();
			// ISOTOPE RELATED
			fw.launch_isotope( $('.zn_has_isotope') );

			fw.refresh_events( this.body );
			fw.enable_saved_elements_draggable();
			fw.limit_droppable();
			fw.remove_el();
			fw.clear_page_template();
			fw.zn_bind_sortable();
			// Check element content height
			fw.check_element_content();

		},

/**
 * Refresh and start the pagebuilder
 */
		refresh_events : function( content ){

			var fw = this;

			// Save element
			fw.show_element_save(content);

			// LAUNCH SORTABLE
			fw.launch_sortable(content);

			// ??
			fw.check_sortable_content();

			// START CLONING ELEMENT
			fw.clone_el(content);

		},

		refresh_fw_content : function( content ){

			var fw = this;

			// MAKE CSS AND CSS CLASSES LIVE
			fw.do_live_change(content);

			// Enable options tabs
			fw.enable_options_tabs(content);
		},


/**
 * Bind specific actions
 */
		addactions : function() {

			var fw = this;

			// TRIGGER PUBLISH BUTTON
			fw.publish_actions();

			// FIRE UP TEMPLATE SPECIFIC ACTIONS
			fw.save_template();
			fw.export_template();
			fw.import_template();
			fw.delete_template();
			fw.export_indv_template();
			fw.load_template();

			// Show the modal with element options
			fw.show_element_options();

			// START COLUMNS WIDTH SELECTORS
			fw.select_width();

			// SAVED ELEMENTS
			fw.delete_saved_element();

			// Refresh events on new content
			fw.scope.on('ZnNewContent',function(e){
				fw.refresh_events(e.content);
			});

			fw.scope.on('ZnNewFWContent',function(e){
				fw.refresh_fw_content(e.content);
			});

			$('.zn_pb_dragbar').on('mousedown',function(e){
				e.preventDefault();

				var startY = e.pageY,
					startHeight = $('.zn_front_pb_wrap').outerHeight(),
					zn_front_pb_wrap = $('.zn_pb_header').outerHeight(),
					pb_tab_wrapper = $('.zn_pb_tab_wrapper');

				$(document).on('mousemove.zn_pb_dragbar', function(e) {

					pb_tab_wrapper.addClass('zn_in_dragg');

					var newY = e.pageY,
						newHeight = Math.max(0, startHeight + startY - newY );

					$('.zn_pb_placeholder').height( newHeight);
					pb_tab_wrapper.height( newHeight - zn_front_pb_wrap );
					fw.pb_wrapper_height = newHeight - zn_front_pb_wrap;

				});
			});


			$(document).on('mouseup.zn_pb_dragbar', function() {

				var pb_tab_wrapper = $('.zn_pb_tab_wrapper');

				if( pb_tab_wrapper.is('.zn_in_dragg') ) {
					pb_tab_wrapper.removeClass('zn_in_dragg');
				}

				$(document).off('mousemove.zn_pb_dragbar');
			});

			$('.zn_pb_tab_handler').click(function(e){

				e.preventDefault();
				fw.show_editor();

				var el = $(this),
					page = el.data('zn-tab');

				$('.zn_pb_tab_handler').removeClass('zn-pb-active-tab');
				$(this).addClass('zn-pb-active-tab');

				$('.zn_pb_tab').addClass('zn_hide');
				$( '#' + page ).removeClass('zn_hide');


			});

		},




/**
 * Will fire up all the sortables ( columns and elements )
 * @scope : element
 */
		launch_isotope : function( scope ){
			scope.isotope({
				resizesContainer: false,
				layoutMode: 'fitRows',
			});
		},

		check_element_content : function(){

			$( '.zn_pb_wrapper .zn_pb_el_container' ).each( function(e){
				if( $(this).height() < 2 && $(this).is(':visible') ) {
					$(this).append('<div class="zn-pb-notification">Please configure the element options.</div>');
					// $(this).addClass('zn_pb_no_content');
				}
			});

		},

		isolate_scroll : function( scope ){
			$( scope ).find('.zn-modal-form').isolatedScroll();
		},

/**
 * Will fire up all the sortables ( columns and elements )
 */
		launch_sortable: function(scope){

			var fw = this;
			// COLUMNS
			$(scope).find('.zn_columns_container').sortable( fw.sortable_arguments( 'column_element' ) );
			// ELEMENTS
			$(scope).find('.zn_sortable_content').sortable( fw.sortable_arguments( 'content_element' ) );

		},
/**
 * Returns the sortable arguments for each type
 */
		sortable_arguments : function( scope ) {
			// TYPE CAN BE content_element OR column_element
			var fw = this,
				element = ( scope == 'content_element' ) ? '.zn_pb_wrapper .zn_sortable_content, .zn_pb_wrapper' : '.zn_pb_wrapper .zn_columns_container',
				placeholder = ( scope == 'content_element' ) ? 'zn_element_placeholder' : 'zn_columns_placeholder',
				cusorAt = ( scope == 'content_element' ) ? { left: 125 , top : 0} : { left: 0 , top : 0};

			return {
				tolerance: "pointer",
				cursorAt : cusorAt,
				connectWith: element,
				helper: function(){ return '<div class="zn_dragging_placeholder"></div>';},
				handle: '> .zn_el_options_bar > a.zn_pb_group_handle',
				placeholder: placeholder,
				start : function( event, ui ) {

					$('.ui-sortable').sortable('refreshPositions');

					// ADD A CLASS TO BODY
					fw.body.addClass('zn_dragg_enabled');

					// HIDE THE EDITOR
					fw.hide_editor();

					if ( scope == 'content_element' ) {
						// ADD A DROP HERE TEXT INTO THE PLACEHOLDER
						ui.placeholder.html('<div class="znpb-placeholder ZnBounceIn znpb-animated">DROP HERE</div>');
					}
					else{
						// HIGHLIGHT THE DROPPABLE ALLOWED AREAS
						$('.zn_columns_container').addClass('zn_drop_allowed');

						var helper_width = $(ui.helper)[0].getBoundingClientRect().width;

						// MAKE THE PLACEHOLDER NICE
						ui.placeholder.css( 'width', helper_width-1 +'px').html('<div class="znpb-placeholder ZnBounceIn znpb-animated">DROP HERE</div>');
					}

				},
				stop : function( event, ui ) {

					// If this is a new added element ( from droppable )
					if ( ui.item.hasClass("zn_pb_element") ) {
						fw.place_draggable( event, ui );
					}

					// REENABLE ALL SORTABLE
					$('.ui-sortable-disabled').sortable('enable');
					fw.body.removeClass('zn_dragg_enabled');
					$('.zn_drop_allowed').removeClass('zn_drop_allowed');

					fw.check_sortable_content();
					fw.scope.trigger({type: "ZnWidthChanged",content : ui.item});
					$(ui.helper).remove();
				},
				receive : function(){
					fw.check_sortable_content();
				},

			};

		},

		place_draggable : function( event, ui ){

			var fw = this;

			// Cache the current element
			var el = $(ui.item);

			// Don't do anything in case the escape key was canceled
			if( el.hasClass('znpb_cancel_drop') ){
				$( event.target ).sortable('cancel');
				el.remove();
				return false;
			}

			// Remove the no content div
			$( event.target ).removeClass('zn_pb_no_content');

			var saved_element_name = $(el).data('template'),
				widget_id = $(el).data('widget');

			// Perform the ajax call and return the element
			fw.render_element ( el , 'znpb_render_module', false, saved_element_name, widget_id );

		},

		save_template : function() {

			var fw = this;

			// Add behavior for the template saving
			$('.zn_pb_save_template').on('click', function(e){
				e.preventDefault();

				var el 	  = $(this),
					input = el.closest('.zn_pb_sidebar').find('input.znpb-template-name-input');

				// Check if the input is empty
				if ( !input.val() ) {
					input.addClass('zn_error');
					return false;
				}
				input.removeClass('zn_error');

				// Make the ajax call
				fw.hide_editor();
				fw.show_page_loading( true );

				var JsonData = fw.build_map( $('.zn_pb_wrapper > .zn_pb_section'), true );

				var data = {
					action: 'zn_save_template',
					template_name : input.val(),
					template : JSON.stringify(JsonData),
					page_options : $.ZnPbFactory.page_options,
					post_id : $('#zn_post_id').val(),
					security: ZnAjax.security
				};

				// Make the ajax call
				jQuery.post( ZnAjax.ajaxurl, data, function( response ) {

					if ( response.message ) {
						new $.ZnModalMessage( response.message );
						$('.zn_pb_templates_container').isotope( 'insert', $(response.content) );
						fw.hide_page_loading( true );
						input.val('');
					}
					else{
						fw.hide_page_loading( true );
						input.val('');
						new $.ZnModalMessage('There was a problem saving the template !');
					}
					fw.show_editor();
				});

			});
		},

		export_template : function() {

			var fw = this;
			// Add behavior for the template saving
			$('.zn_pb_export_template').on('click', function(e){
				e.preventDefault();

				var el 	  = $(this),
					input = el.closest('.zn_pb_sidebar').find('input.znpb-template-name-input');

				// Check if the input is empty
				if ( !input.val() ) {
					input.addClass('zn_error');
					return false;
				}

				input.removeClass('zn_error');

				// Make the ajax call
				fw.hide_editor();
				fw.show_page_loading( true );

				var JsonData = fw.build_map( $('.zn_pb_wrapper > .zn_pb_section'), true );

				var data = {
					action: 'zn_export_template',
					template_name : input.val(),
					template : JSON.stringify(JsonData),
					page_options : $.ZnPbFactory.page_options,
					security: ZnAjax.security
				};

				// Make the ajax call
				jQuery.post( ZnAjax.ajaxurl, data, function( response ) {

					fw.hide_page_loading( true );
					if ( response.success === true ) {
						// Direct the user to the file location
						window.showed_message = true;
						location.href = ZnAjax.ajaxurl+"?action=znpb_download_export&file="+response.data+"&nonce=" + ZnAjax.security;
					}
					else{
						new $.ZnModalMessage('There was a problem exporting the template !');
						console.error('Error: ', response.data );
					}

					fw.show_editor();
				});

			});
		},

		import_template : function() {

			var fw = this;

			// Add behavior for the template saving
			$('#znpb_upload_input').change(function(e){

				var $this = $(this),
					uploadbtn = $('#znpb_upload_input_label'),
					elements_container = $this.closest('.zn_pb_templates_container'),
					progressLabel = $('#zn_pb_el_uploadicon-progress'),
					cleanupInpt = function() {
						// Fix to cleanup the file input
						$this.replaceWith($this.val('').clone(true));
					};

				uploadbtn.addClass('is-uploading');
				elements_container.addClass('is-disabled');

				var file_data = $this.prop('files')[0];
				var data = new FormData();
				data.append('file', file_data);
				data.append('action', 'zn_import_template');
				data.append('security', ZnAjax.security );

				$.ajax({
					url: ZnAjax.ajaxurl, // point to server-side PHP script
					dataType: 'json',  // what to expect back from the PHP script, if anything
					cache: false,
					contentType: false,
					processData: false,
					data: data,
					type: 'post',
					xhr: function(){
						var xhr = $.ajaxSettings.xhr(),
							hasOnProgress = ("onprogress" in xhr);

						//If not supported, do nothing
						if (!hasOnProgress) {
							return;
						}

						if(xhr instanceof window.XMLHttpRequest) {
							xhr.addEventListener('progress', this.progress, false);
						}

						if(xhr.upload) {
							xhr.upload.addEventListener('progress', this.progress, false);
						}

						return xhr;

					},
					progress: function(e) {
						if(e.lengthComputable) {
							var pct = parseInt( (e.loaded / e.total) * 100 );

							progressLabel.text( pct );

							if(pct == '100'){
								progressLabel.addClass('is-flashing');
							}
						} else {
							console.warn('Content Length not reported!');
						}
					},
					success: function(response){
						progressLabel.text('').removeClass('is-flashing');
						if ( response.message ) {
							new $.ZnModalMessage( response.message );

							// This is used by elements
							var saved_el = $(response.content);

							if( response.isSingle === true ){
								saved_el.draggable(fw.get_draggable_options( saved_el.data('level') ));
								$('.zn_pb_saved_elements_container').isotope( 'insert', saved_el );
								console.log( 'added to saved elements' );
							}
							else{
								$('.zn_pb_templates_container').isotope( 'insert', saved_el );
							}

							fw.hide_page_loading( true );
						}
						else{
							fw.hide_page_loading( true );
							new $.ZnModalMessage('There was a problem importing the template !');
						}
						uploadbtn.removeClass('is-uploading');
						elements_container.removeClass('is-disabled');
						cleanupInpt();
					},
					error: function(response){
						progressLabel.text('').removeClass('is-flashing');
						console.log('ERROR: '+response);
						uploadbtn.removeClass('is-uploading');
						elements_container.removeClass('is-disabled');
						cleanupInpt();
					}
				 });
			});
		},

		set_element_option : function( option_id, option_value, $el ){
			var fw = this,
				el = $el.hasClass('.zn_pb_el_container') ? $el : $el.closest('.zn_pb_el_container'),
				element_uid = el.data('uid');

			if( ! el.length ){
				return;
			}

			// get element options
			var options = fw.get_values(el);
			if( ! $.isEmptyObject( options )  ){
				options[option_id] = option_value;

				$.ZnPbFactory.current_layout[element_uid].options = options;
			}

		},

		delete_template : function() {

			var fw = this;

			// DELETE TEMPLATE
			fw.body.on('click', '.zn_pb_delete_template' , function(e){

				e.preventDefault();

				var el = $(this),
					template_el = el.closest('.zn_pb_template_container'),
					template = template_el.data('template');

				var data = {
					action: 'zn_delete_template',
					template_name : template,
					security: ZnAjax.security,
					post_id : $('#zn_post_id').val()
				};

				var callback = function() {
						fw.hide_editor();
						fw.show_page_loading( true );

						// Make the ajax call
						jQuery.post( ZnAjax.ajaxurl, data, function( response ) {

							if ( response.message ) {
								new $.ZnModalMessage( response.message );
								fw.hide_page_loading( true );
								$('.zn_pb_templates_container').isotope('remove', template_el).isotope('layout');
							}
							else{
								fw.hide_page_loading( true );
								new $.ZnModalMessage('There was a problem saving the template !');
							}
							fw.show_editor();
						});
					};

				new $.ZnModalConfirm( 'Are you sure you want to delete this template ?', 'No', 'Yes', callback );

			});
		},

		export_indv_template : function(){
			var fw = this;

			// LOAD TEMPLATE
			fw.body.on('click', '.zn_pb_export_indv_template' , function(e){
				e.preventDefault();

				var el = $(this),
					container = el.closest('.zn_pb_template_container'),
					template = container.data('template');

				var data = {
					action: 'znpb_export_indv_template',
					template_name : template,
					level : container.data('level'),
					isSingle : container.data('issingle'),
					security: ZnAjax.security
				};

				fw.hide_editor();
				fw.show_page_loading( true );

				// Make the ajax call
				jQuery.post( ZnAjax.ajaxurl, data, function(response) {

					fw.hide_page_loading( true );
					if ( response.success === true ) {
						// Direct the user to the file location
						window.showed_message = true;
						location.href = ZnAjax.ajaxurl+"?action=znpb_download_export&file="+response.data+"&nonce=" + ZnAjax.security;
					}
					else{
						new $.ZnModalMessage('There was a problem exporting the template !');
					}

					fw.show_editor();

				});

			});
		},

		load_template : function(){

			var fw = this;

			// LOAD TEMPLATE
			fw.body.on('click', '.zn_pb_load_template' , function(e){

				e.preventDefault();

				var el = $(this),
					template = el.closest('.zn_pb_template_container').data('template');

				var data = {
					action: 'zn_load_template',
					template_name : template,
					security: ZnAjax.security,
					post_id : $('#zn_post_id').val()
				};

				var callback = function(){
						fw.hide_editor();
						fw.show_page_loading( true );

						// Make the ajax call
						jQuery.post( ZnAjax.ajaxurl, data, function(response) {

							if ( response.template ) {

								var new_content = $( response.template );

								fw.scope.trigger({type: "ZnNewContent_before",content : new_content});
								fw.scope.append(new_content);
								fw.scope.trigger({type: "ZnNewContent",content : new_content});

								fw.add_to_factory( response.current_layout );

								// Add the custom css if it was saved
								if( response.custom_css.length > 0 ){
									$.ZnPbFactory.page_options.zn_page_custom_css += response.custom_css;
								}
								// @since v4.1.4 - Fixes #1428
								if( response.custom_js.length > 0 ){
									$.ZnPbFactory.page_options.zn_page_custom_js += response.custom_js;
								}

								fw.hide_page_loading( true );

								new $.ZnModalMessage('Template loaded succesfully !');

							}
							else{
								fw.hide_page_loading( true );
								new $.ZnModalMessage( response.message );
							}

							fw.show_editor();

						});
					};

				new $.ZnModalConfirm( 'Are you sure you want to load this template ? It will be added at the end of your page.', 'No', 'Yes', callback );

			});
		},

		// GETS SAVED VALUES FROM VAULT
		get_values : function(el){

			var element_uid = $(el).data('uid'),
				values = {};

			// CHECK TO SEE IF WE HAVE SAVED VALUES FOR THIS UID
			if ( element_uid && $.ZnPbFactory.current_layout[element_uid] ) {
				values = $.ZnPbFactory.current_layout[element_uid].options;
			}

			return values;
		},

		build_map : function( scope , removeUIds, widget ) {

			var fw = this,
				JsonData = {};

			scope.each( function( sectionIndex , a ) {

				var el = $(this), // Current element
					contenta = {}, // ELEMENT CONTENT
					zoptions = fw.get_values( el ); // Section options


					var content = el.find('.zn_content').filter(function() {
						return $(this).parentsUntil( el, '.zn_content' ).length === 0;
					});

					// CHECK IF WE HAVE MULTIPLE CONTENTS
					if ( el.data('has_multiple') ) {

						// Check to see if the items were re-ordered
						if( fw.stop_order && fw.stop_order != 'undefined' && ! $.isEmptyObject(fw.stop_order) ) {
							var cached_stop_order = fw.stop_order;
							fw.stop_order = {};
							$.each( cached_stop_order, function( k, v ){
								if( v === 'deleted' ){
									return true;
								}

								contenta[k] = fw.build_map( v, removeUIds );

							});
						}
						else{
							for( var i = 0; i < content.length; i++ ) {
								contenta[i] = fw.build_map( $( content[i] ).children('.zn_pb_section'), removeUIds );
							}
						}

						contenta.has_multiple = true;

					}
					else {
						contenta = fw.build_map( content.children('.zn_pb_section') , removeUIds );
					}

					var sectionconfig = {
						object : el.data('object') || '',
						options : zoptions || '',
						content : contenta || '',
						width : fw.get_col_size(el)[0] || '',
						widget : widget || ''
					};

					if ( !removeUIds ) { sectionconfig.uid = el.data('uid'); }

					JsonData[sectionIndex] = sectionconfig;

			});
			return JsonData;

		},

		render_element : function ( scope , action , clean_uid, saved_element_name, widget ){

			var fw = this,
				JsonData = fw.build_map( scope , clean_uid, widget ),
				placeholder = $( scope ),
				data = {
					action: action,
					template : JSON.stringify(JsonData),
					post_id : $('#zn_post_id').val(),
					security: ZnAjax.security
				};

			if( typeof saved_element_name != 'undefined' && saved_element_name.length > 0 ){
				data.template_name = saved_element_name;
			}

			if ( action == 'znpb_clone_element' ) {
				placeholder = $('<div class="zn_loading_placeholder"></div>').insertAfter( scope );
			}

			// Replace the element with an loading line
			fw.scope.trigger({type: "ZnBeforePlaceholderReplace",content : $(placeholder)});
			$(placeholder).replaceWith('<div class="znpb-loading-bar"> <div class="znpb-loading-bar-inner"><div class="znpb-loading-bar-inner-loading"></div></div></div>');
			fw.show_page_loading( false );

			// ANIMATE THE LOADING BAR
			$('.znpb-loading-bar-inner-loading' ).width((50 + Math.random() * 30) + "%");

			jQuery.post( ZnAjax.ajaxurl, data, function( response ) {

				if ( response ) {
					$(".znpb-loading-bar-inner-loading").width("100%").delay(200).fadeIn(400, function() {

						//response = jQuery.parseJSON(response);

						var new_content = $( response.template ).filter( '.zn_pb_el_container' ).addClass( 'znpb-animated ZnBounceIn' );

						// PROCESS THE CONTENT
						fw.scope.trigger({type: "ZnNewContent_before",content : new_content});
						try {
							$( '.znpb-loading-bar' ).replaceWith( new_content );
							if( new_content.height() < 2 ){
								new_content.append('<div class="zn-pb-notification">Please configure the element options.</div>');
							}
						} catch (e) {
							// invalid json input, set to null
							console.warn( 'ZnTheme Error received: '+e );
						}
						fw.scope.trigger({type: "ZnNewContent",content : new_content});

						fw.add_to_factory( response.current_layout );

						// HIDE THE PAGE LOADING AND RESTORE THE PAGE FUNCTIONALITY
						fw.hide_page_loading( false );
					});
				}
			},'json').fail(function() {
				alert( "There was an error" );
				// HIDE THE PAGE LOADING AND RESTORE THE PAGE FUNCTIONALITY
				fw.hide_page_loading( false );
				//REMOVE THE LOADING BAR -- Just in case
				$('.znpb-loading-bar').remove();
			});
		},

		add_to_factory : function( data ){
			$.each(data,function(){
				$.ZnPbFactory.current_layout[this.uid] = this;
			});

		},

		enable_options_tabs : function(scope){
			var elements = (scope) ? scope.find('.zn-options-tab-header > a') : $('.zn-options-tab-header > a');

				elements.on( 'click', function(e){
					e.preventDefault();
					var tab = $(this).data("zntab");

					// Remove the tabs active class
					$(this).closest( '.zn-tabs-container' ).children('.zn-options-tab-content.zn-tab-active').removeClass('zn-tab-active');
					// Remove the header link active class
					$(this).closest( '.zn-tabs-container' ).find('> .zn-options-tab-header > .zn-tab-active').removeClass('zn-tab-active');
					$(this).closest( '.zn-tabs-container' ).find( '.zn-tab-key-'+tab ).add($(this)).addClass('zn-tab-active');

				});
		},

		do_live_change : function(scope){

			var elements = (scope) ? scope.find('.zn_live_change') : $('.zn_live_change');

			elements.on('change zn_change' , function() {

				var config = $(this).data('live_setup'),
					that = this;

				if( typeof config.multiple != 'undefined' && config.multiple.length > 0 ){
					for (var i = config.multiple.length - 1; i >= 0; i--) {
						zn_apply_live_style( config.multiple[i], that );
					}
				}
				else{
					zn_apply_live_style( config, that );
				}

			});

			function zn_apply_live_style( config, that ){

				var el   = config.css_class,
					type = config.type,
					val_prepend = config.val_prepend,
					input_el  = $(':input' , that ).is('[data-live-input="1"]') ? $('[data-live-input="1"]:input' , that ) :  $(':input' , that ),
					val  = input_el.val(),
					input  = input_el.last();

				// Special case when the options is inside a group of other options
				if( typeof config.is_in_group != 'undefined' ){
					// Get the live option position inside group
					var modal_instanceNr = $.ZnModal.openInstance.length - 1, // The modal open is set after the modal is opened
						opt_form_placeholder = $( '.zn_modal_placeholder_'+modal_instanceNr ).closest( '.zn_group' ),
						position = $(opt_form_placeholder).index();

					// Now change the css live class to mathc this
					el = $( el ).eq( position );

				}

				// Changes a css rule for the specified element
				if ( type == 'css' ) {

					var unit = $(':input' , that ).is('[data-live-unit="1"]') ? $('[data-live-unit="1"]:input' , that ).val() : config.unit;
					var rules = $(':input' , that ).is('[data-live-property]') ? $('[data-live-property]:input' , that ) : config.css_rule.split(',');

					var rules_to_apply = {};
					$(rules).each(function( i, property ){
						var v = val + (val ? unit : '');

						if( $(property).is('[data-live-property]') ){
							if( ! $(property).is(':checked')){
								v = '';
							}
							property = $(property).attr('data-live-property');
						}
						rules_to_apply[property] = v;
					});

					$( el ).css( rules_to_apply );

				}

				// Changes a css rule for the specified element
				else if ( type == 'boxmodel' ) {
					input_el.each(function(index, property) {
						var boxRule = config.css_rule;
						$( el ).css( boxRule +'-'+ $(property).attr('data-side'), $(property).val() );
					});
				}

				// Changes a css rule for the specified element
				else if ( type == 'font' ) {
					input_el.each(function(index, property) {
						$( el ).css( $(property).attr('data-live-font-property'), $(property).val() );
					});
				}

				// Changes the icon for the specified element
				else if ( type == 'font_icon' ) {
					var font_family = $(':input.zn_icon_family' , that ).val(),
						zn_icon_unicode = $(':input.zn_icon_unicode' , that ).val();

					// Convert the icon to unicode format
					var unicode = zn_icon_unicode.split('u').join('0x');
					var converted_unicode = String.fromCharCode(unicode);

					if ( $(el).length === 0 ) {
						$(that).closest('.zn_option_container').removeClass( 'zn_live_change' );
					}
					else{
						$( el ).attr( 'data-zniconfam', font_family ).attr( 'data-zn_icon', converted_unicode );
					}

				}
				// Shows or hides an element
				else if ( type == 'hide' ) {
					if ( input.is(':checked') ) {
						$( el ).show();
					}
					else {
						$( el ).hide();
					}

				}
				// Adds/Removes a css class
				else if( type == 'class' ){

					if ( input.attr('type') == 'checkbox' ) {
						if ( input.is(':checked') ) {
							$( el ).addClass( input.val() );
						}
						else {
							$( el ).removeClass( input.val() );
						}
					}
					else {


						// TODO: make val_prepend compatible with group option
						// Attempt to have live class option for grouped select lists

						// if ( input_el.length > 1 ) {
						// 	val = '';
						// 	input_el.each(function(index, el) {
						// 		var $elv = $(el).val();
						// 		if($elv !== '') val += ' '+ $elv;
						// 	});
						// }

						var values = $.map( $('select option' , that ) ,function(option) {
							return option.value;
						});

						// Allow us to prepend a string to the option value
						if( typeof val_prepend != 'undefined' && val_prepend.length > 0 ){
							values = $.map( values ,function(option) {
								return val_prepend + option;
							});

							val = val_prepend + val;

						}

						$( el ).removeClass( values.join(' ') );
						$( el ).addClass( val );
					}
				}
			}

		},

		select_width : function(){
			var fw = this;
			fw.scope.on( 'click', '.zn_pb_select_width .znpb_sizes_container span', function() {
				// Get current element width
				var section = $(this).closest('.zn_pb_section'), // The affected section
					selected_width = $(this).data('width'); // The user selected width

					//Set new element width
					section.removeClass(fw.columns_widths); // Remove all size classes
					section.addClass( selected_width ); // Add the selected class size

					// create a sm class
					var small_class = selected_width.replace( 'col-md-', 'col-sm-' );
					section.addClass( small_class ); // Add the small size class

					// Add active class
					section.find('.selected_width').first().removeClass('selected_width');
					$(this).addClass('selected_width');

					fw.scope.trigger({type: "ZnWidthChanged",content : section});

				// Save new element width
			});

		},

		get_col_size: function(column) {

			if (column.hasClass("col-md-12"))
				return ["col-md-12", "col-md-12", "col-md-11", "12/12"];

			else if (column.hasClass("col-md-11"))
				return ["col-md-11", "col-md-12", "col-md-10", "11/12"];

			else if (column.hasClass("col-md-10"))
				return ["col-md-10", "col-md-11", "col-md-9", "10/12"];

			else if (column.hasClass("col-md-9"))
				return ["col-md-9", "col-md-10", "col-md-8", "9/12"];

			else if (column.hasClass("col-md-8"))
				return ["col-md-8", "col-md-9", "col-md-7", "8/12"];

			else if (column.hasClass("col-md-7"))
				return ["col-md-7", "col-md-8", "col-md-6", "7/12"];

			else if (column.hasClass("col-md-6"))
				return ["col-md-6", "col-md-7", "col-md-5", "6/12"];

			else if (column.hasClass("col-md-5"))
				return ["col-md-5", "col-md-6", "col-md-4", "5/12"];

			else if (column.hasClass("col-md-4"))
				return ["col-md-4", "col-md-5", "col-md-3", "4/12"];

			else if (column.hasClass("col-md-3"))
				return ["col-md-3", "col-md-4", "col-md-2", "3/12"];

			else if (column.hasClass("col-md-2"))
				return ["col-md-2", "col-md-3", "col-md-2", "2/12"];

			else if (column.hasClass("col-md-1-5"))
				return ["col-md-1-5", "col-md-2", "col-md-1-5", "1/5"];

			else
				return false;

		},

		zn_bind_sortable : function(){

			var fw = this;

			fw.scope.on( 'mousedown', '.zn_pb_group_handle', function(e){

				var that = $(e.target);

				$('.zn_sortable_content').each(function(){

					var $this = $(this);
					if ( $this.data('droplevel') >= $(that).data('level')  ) {
						$this.sortable('disable');
					}
					else {
						$(this).addClass('zn_drop_allowed');
					}
				});
			});

			$(document).on( 'mouseup', '.zn_pb_group_handle', function(){
				fw.body.removeClass('zn_dragg_enabled');
			});

		},

		limit_droppable: function(){

			var fw = this;

			$(document).on('mousedown','.zn_pb_element',function(e){
				var that = $(e.currentTarget);

					// DISABLE THE COLUMNS
					if ( $(that).data('object') == 'ZnColumn'  ) {
						$( '.zn_sortable_content' ).sortable('disable');
					}
					else {
						$( '.zn_columns_container' ).sortable('disable');
					}

					$('.ui-sortable').each(function(){

						if ( $(this).data('droplevel') >= $(that).data('level')  ) {
							$( this ).sortable('disable');
						}
						else {
							$(this).addClass('zn_drop_allowed');
						}
					});
			});

			$(document).on('mouseup','.zn_pb_element',function(){
				fw.body.removeClass('zn_dragg_enabled');
			});

		},

		show_page_loading : function( full ){

			var body = $('body');

			body.addClass('znpb-loading-in-progress');
			this.publish_button.addClass('zn_active');

			if ( full ) {
				body.addClass('zn_pb_loading');
			}

		},

		hide_page_loading : function( full ){

			var body = $('body');

			body.removeClass('znpb-loading-in-progress');
			this.publish_button.removeClass('zn_active');

			if ( full ) {
				body.removeClass('zn_pb_loading');
			}
		},

		/**
		 * Check if the sortable UI's are empty
		 */
		check_sortable_content : function(){
			$('.zn_pb_wrapper, .zn_pb_wrapper .zn_sortable_content , .zn_pb_wrapper .zn_columns_container').each(function(){
				if ( $(this).children().length === 0 ) {
					$(this).addClass('zn_pb_no_content');
				}
				else if ( $(this).children().length > 0 ) {
					$(this).removeClass('zn_pb_no_content');
				}
			});
		},

		enable_saved_elements_draggable: function(){
			var fw = this;
			$('.zn_pb_saved_elements_container .zn_pb_element').each(function(){
				$(this).draggable(fw.get_draggable_options($(this).data('level')));
			});
		},

		get_draggable_options : function( level ){
			var fw = this;
			return {
				revert: true,
				containment: "document",
				iframeFix: true,
				cursorAt : { top : 0 },
				appendTo: 'body',
				connectToSortable: level == '2' ? '.zn_pb_wrapper .zn_columns_container' : '.zn_pb_wrapper .zn_sortable_content, .zn_pb_wrapper',
				helper: "clone",
				start: function() {
					fw.hide_editor();
					fw.body.addClass('zn_dragg_enabled');
				},
				stop: function() {
					fw.show_editor();
					fw.body.removeClass('zn_dragg_enabled');
				},
				zIndex: 1000
			};
		},

		hide_editor : function() {

			var zn_front_pb_wrap = $('.zn_front_pb_wrap');

			if ( zn_front_pb_wrap.is('.znpb-editor-hidden') ) { return; }
			var pb_height = $('.zn_pb_tab_wrapper').outerHeight();
			var pb_header_height = $('.zn_pb_header').outerHeight();

			this.pb_wrapper_height = pb_height;

			$('.zn_pb_placeholder').height(pb_header_height);
			$('.zn_pb_dragbar').hide();
			zn_front_pb_wrap.addClass('znpb-editor-hidden');
		},

		show_editor : function() {

			var zn_pb_tab_wrapper = $('.zn_pb_tab_wrapper'),
				pb_content_height;

			if ( this.pb_wrapper_height ) {
				pb_content_height = this.pb_wrapper_height;
			}
			else {
				pb_content_height = zn_pb_tab_wrapper.outerHeight();
			}

			var pb_header_height = $('.zn_pb_header').outerHeight(),
				margin = parseInt( zn_pb_tab_wrapper.css('margin-bottom') );

			zn_pb_tab_wrapper.height( pb_content_height );
			$('.zn_pb_placeholder').height( pb_header_height + pb_content_height );
			$('.zn_pb_dragbar').show();

			$('.zn_front_pb_wrap').removeClass('znpb-editor-hidden');

		},

		clone_el : function(scope){

			var fw = this,
				element = (scope) ? scope.find('.zn_pb_clone_button') : $('.zn_pb_clone_button');

			$(element).click(function() {
				var el = $(this).closest('.zn_pb_section');
					fw.render_element( el , 'znpb_clone_element' , true );
			});

		},

		remove_el : function(){
			var fw = this;
			// Add behavior for the remove button
			$(document).on('click', '.zn_pb_remove', function(e){

				e.preventDefault();

				var element_to_delete = $(this).closest('.zn_pb_el_container'),
					element_container = element_to_delete.parent(),
					el = this,
					callback = function() {
						fw.scope.trigger({type: "ZnBeforeElementRemove",content : $(element_to_delete)});
						element_to_delete.remove();

						if ( element_container.children().length < 1 ) {
							element_container.addClass('zn_pb_no_content');
						}

						if( element_container.has('.ui-sortable') ){
							element_container.sortable('refreshPositions');
							element_container.sortable('refresh');
						}

						element_to_delete = null;
						element_container = null;
						$(document).off('click', el);

					};

				new $.ZnModalConfirm( 'Are you sure you want to remove this element ?', 'No', 'Yes', callback );
			});

		},

		publish_actions : function(){

			var fw = this;

			// Add behavior for the publish button
			fw.publish_button.click(function(e){
				e.preventDefault();
				fw.do_publish_page();
			});

			// Add functionality for saving using CTRL+S
			jQuery(document).on('keydown', function(event) {
				if (event.ctrlKey || event.metaKey) {
				switch (String.fromCharCode(event.which).toLowerCase()) {
					case 's':
						event.preventDefault();
						fw.do_publish_page();
						break;
					}
				}
			});

		},

		do_publish_page : function(){

			var fw = this;

			// HIDE THE EDITOR WHILE SAVING
			fw.hide_editor();
			//fw.show_page_loading();
			fw.show_page_loading( true );

			var JsonData = fw.build_map( $('.zn_pb_wrapper > .zn_pb_section') );

			var data = {
				action: 'znpb_publish_page',
				template : JSON.stringify(JsonData),
				post_id : $('#zn_post_id').val(),
				security: ZnAjax.security,
				page_options : $.ZnPbFactory.page_options
			};

			// Make the ajax call
			jQuery.post( ZnAjax.ajaxurl, data, function(response) {

				if (response) {
					new $.ZnModalMessage('Page saved succesfully !');
					fw.hide_page_loading( true );

				}
				else{
					fw.hide_page_loading( true );
					new $.ZnModalMessage('There was a problem saving the page !');
				}
			});
		},

		show_element_save :	function(scope) {

			var fw = this,
			element = (scope) ? scope.find('.znpb-element-save-trigger') : $('.znpb-element-save-trigger');

			$(element).on('click', function(e){

				e.preventDefault();

				// Hide the editor
				fw.hide_editor();

				var params = {},
					element_uid = $(this).data('uid'),
					main_element = $(this).closest('.zn_pb_el_container'),
					level = $(this).closest('.zn_pb_el_container').data('level');

				params.modal_ajax_hook = 'znpb_save_module';
				params.modal_backdrop_class = 'zn-modal-transparent';

				params.modal_ajax_params = {
					element_uid : element_uid,
					element_level : level,
					post_id : $('#zn_post_id').val(),
				};

				params.modal_title = 'Save element';
				params.extra_data = main_element;
				params.modal_on_ajax_load = function(e){
					fw.znpb_save_element(e.modal, e);
					fw.export_element(e.modal, e);
				};

				new $.ZnModal(params);
			});

			return false;

		},

		znpb_save_element : function( scope, modal ){
			var fw = this,
			element = (scope) ? scope.find('.zn_button_save_element') : $('.zn_button_save_element');

			// Prevent form submitting
			$( '.zn_save_element_form' ).on('submit', function(e){
				e.preventDefault();
			});

			element.click(function(e){
				e.preventDefault();

				var data = {},
					input = $(this).closest('.zn_save_element_form').find('.zn_input'),
					saved_name = input.val(),
					element_uid = $(this).data('uid'),
					level = $(this).data('level'),
					JsonData = fw.build_map( $(modal.options.extra_data) , true );

				// If the name field is empty
				if( typeof saved_name == 'undefined' || saved_name.length === 0 ){
					// SHOW A MODAL
					alert( 'Please enter a name for this saved element' );
					return;
				}

				// Build the data already
				data = {
					action: 'znpb_do_save_element',
					template : JSON.stringify(JsonData),
					level : level,
					template_name : saved_name,
					post_id : $('#zn_post_id').val(),
					security: ZnAjax.security
				};

				// Show the page loading
				fw.show_page_loading( true );

				jQuery.post( ZnAjax.ajaxurl, data, function( response ) {

					if ( response.message ) {
						new $.ZnModalMessage( response.message );
						var saved_el = $(response.content);
						saved_el.draggable(fw.get_draggable_options( saved_el.data('level') ));

						$('.zn_pb_saved_elements_container').isotope( 'insert', saved_el );
						input.val('');
						modal.close();
					}
					else{
						input.val('');
						modal.close();
						new $.ZnModalMessage('There was a problem saving the template !');
					}
					fw.show_editor();
					$('.znpb_saved_elements').trigger('click');
				});

				fw.hide_page_loading( true );
			});
		},

		delete_saved_element : function() {

			var fw = this;

			// DELETE TEMPLATE
			fw.body.on('click', '.zn_pb_delete_saved_el' , function(e){

				e.preventDefault();

				var el = $(this),
					template_parent = el.closest('.zn_pb_template_container'),
					template = template_parent.data('template');

				var data = {
					action: 'zn_delete_saved_element',
					template_name : template,
					security: ZnAjax.security,
					post_id : $('#zn_post_id').val()
				};

				var callback = function() {
						fw.hide_editor();
						fw.show_page_loading( true );

						// Make the ajax call
						jQuery.post( ZnAjax.ajaxurl, data, function( response ) {

							if ( response.message ) {
								new $.ZnModalMessage( response.message );
								fw.hide_page_loading( true );
								$('.zn_pb_saved_elements_container').isotope('remove', template_parent);
							}
							else{
								fw.hide_page_loading( true );
								new $.ZnModalMessage('There was a problem deleting the saved element !');
							}
							fw.show_editor();
						});
					};

				new $.ZnModalConfirm( 'Are you sure you want to delete this element ?', 'No', 'Yes', callback );

			});
		},

		export_element : function( scope, modal) {
			var fw = this,
			element = (scope) ? scope.find('.zn_button_export_element') : $('.zn_button_export_element');

			// Add behavior for the template saving
			element.click(function(e){
				e.preventDefault();

				var data = {},
					input = $(this).closest('.zn_save_element_form').find('.zn_input'),
					saved_name = input.val(),
					element_uid = $(this).data('uid'),
					level = $(this).data('level'),
					JsonData = fw.build_map( $(modal.options.extra_data) , true );

				// If the name field is empty
				if( typeof saved_name == 'undefined' || saved_name.length === 0 ){
					// SHOW A MODAL
					alert( 'Please enter a name for this saved element' );
					return;
				}

				// Build the data already
				data = {
					action: 'zn_export_template',
					template : JSON.stringify(JsonData),
					level : level,
					template_name : saved_name,
					post_id : $('#zn_post_id').val(),
					security: ZnAjax.security
				};

				// Show the page loading
				fw.show_page_loading( true );

				// Make the ajax call
				jQuery.post( ZnAjax.ajaxurl, data, function( response ) {

					fw.hide_page_loading( true );
					if ( response.success === true ) {
						// Direct the user to the file location
						window.showed_message = true;
						location.href = ZnAjax.ajaxurl+"?action=znpb_download_export&file="+response.data+"&nonce=" + ZnAjax.security;
					}
					else{
						new $.ZnModalMessage('There was a problem exporting the template !');
						console.error('Error: ', response.data );
					}
					modal.close();
					fw.show_editor();
				});

			});
		},

		show_element_options :	function() {
			var fw = this;
			fw.scope.on( 'click', '.znpb-element-options-trigger', function(e){

				e.preventDefault();

				// Hide the editor
				fw.hide_editor();

				var params = {},
					element_uid = $(this).data('uid'),
					main_element = $(this).closest('.zn_pb_el_container'),
					options = $.ZnPbFactory.current_layout[element_uid];

				if ( typeof options === 'undefined' ) {
					$.ZnPbFactory.current_layout[element_uid] = {
						object : 'ZnColumn',
						width : fw.get_col_size(main_element)[0] || '', // GET OPTION CONTAINER
						uid : element_uid,
						options : {},
						content : {}
					};
					options = $.ZnPbFactory.current_layout[element_uid];
				}

				// Don't send the sub-elements to the ajax request. Fixes #1411
				if ( typeof options.content !== 'undefined' && options.content.length > 0 ) {
					options.content = {};
				}

				params.modal_ajax_hook = 'znpb_get_module_option';
				params.modal_class = 'znpb-main-modal';
				params.close_button_title = 'Close without saving';
				params.modal_backdrop_class = 'zn-modal-transparent';
				params.modal_ajax_params = {
					element_options : options,
					post_id : $('#zn_post_id').val()
				};
				params.modal_title = $( this ).closest('.zn_pb_section').data('el-name');
				params.modal_on_close = function(e){

					var colorPickers = e.modal.find( '.wp-color-picker' );
					if( colorPickers.length > 0 ){
						colorPickers.each(function(el){
							if(typeof $(this).data( 'wpWpColorPicker' ) !== 'undefined' ){
								$(this).wpColorPicker('close');
							}
						});
					}

					// Show a warning message if we have unsaved changes
					var form = e.modal.find('.zn-modal-form'),
						new_content_checksum = md5( fw.get_checksum( form ) );

					if ( form.length > 0 && $.page_builder.active_edit_checksum !== null && new_content_checksum !== fw.active_edit_checksum ) {
						var callback = function() {
							e.preventClose = false;
							fw.stop_order = {};
							e.close( true );
						};

						new $.ZnModalConfirm( 'You have unsaved options! Any unsaved options will be lost! <br /><b>Are you sure you want to close the options panel?</b>', 'No', 'Yes', callback );
						e.preventClose = true;
					}

				};
				params.modal_on_ajax_load = function(e){
					var form = e.modal.find('.zn-modal-form');
					form.on('submit', function(e){
						e.preventDefault();
					});

					function save_order(sort_option, initial_setup){
						sort_option.children().each(function( idx, element ){
							// fw.stop_order[idx] = $(element).data('idx');
							var x = initial_setup[$(element).data('idx')];
							if(x && typeof(x) != 'undefined') {
								fw.stop_order[idx] = x;
							}
							else{
								fw.stop_order[idx] = $('<div></div>');
							}
						});

					}

					// This will fix #1152.
					if( main_element.data('has_multiple') ){
						// The current sortable options. This can be extented to only target the actual tabs
						var sort_option = form.find('.zn_group_inner').first();

						// Keep a reference of the current setup
						var elements = sort_option.children();
						var content = main_element.find('.zn_content').filter(function() {
							return jQuery(this).parentsUntil( main_element ,'.zn_content' ).length === 0;
						});

						var initial_setup = {};
						fw.stop_order = {};

						elements.each(function( idx, element ){
							initial_setup[idx] = $( content[idx] ).children('.zn_pb_section');
						});

						// Save the initial order of the elements
						sort_option.children().not('.ui-sortable-placeholder').each(function( idx, element ){
							$(element).data('idx', idx);
						});

						save_order(sort_option, initial_setup);

						// Change the order when an item is removed
						sort_option.find('.zn_remove').click(function(){
							$(document).one('znpb:element:removed', function( event, el ){
								var removed_index = $(el).index();
								fw.stop_order[removed_index] = 'deleted';
							});

						});

						// Save the new order of items based on sorting
						sort_option.on('sortupdate', function( event, ui ){
							save_order(sort_option, initial_setup);
						});
					}

					// Don't allow scroll on entire page
					fw.isolate_scroll(e.modal);
					fw.active_edit_checksum = md5( fw.get_checksum( form ) );

				};

				params.footer = function(modal){
					var footer = '<div class="znpb_modal_options_footer">';
						footer += '<a href="#" class="zn-btn-confirm zn-btn-green zn-attach-save-event">SAVE</a>';
						footer += '<a href="#" class="zn-btn-confirm zn-btn-done zn-attach-saveclose-event">SAVE & CLOSE</a>';
						footer += '</div>';

					var $footer = $(footer);
					$('.zn-attach-save-event', $footer).click(function(e){
						e.preventDefault();
						$(window).trigger('debouncedresize');
						if( typeof tinyMCE !== 'undefined' ){
							tinyMCE.triggerSave();
						}

						var form = modal.modal.find('.zn-modal-form');

						fw.update_el( modal.modal );
						fw.active_edit_checksum = md5( fw.get_checksum( form ) );
					});

					$('.zn-attach-saveclose-event', $footer).click(function(e){
						e.preventDefault();
						$(window).trigger('debouncedresize');
						if( typeof tinyMCE !== 'undefined' ){
							tinyMCE.triggerSave();
						}

						var colorPickers = modal.modal.find( '.wp-color-picker' );
						if( colorPickers.length > 0 ){
							colorPickers.each(function(el){
								if(typeof $(this).data( 'wpWpColorPicker' ) !== 'undefined' ){
									$(this).wpColorPicker('close');
								}
							});
						}

						fw.update_el( modal.modal );
						// fw.show_editor();
						fw.stop_order = {};
						modal.close( true );

					});

					return $footer;
				};

				new $.ZnModal(params);
			});


			return false;

		},
		update_el : function(scope) {
			var fw = this,
				form = scope.find('.zn-modal-form').first(),
				element_uid = form.data('uid'),
				element = $('.zn_pb_el_container[data-uid="'+element_uid+'"]'),
				new_content_checksum = md5( fw.get_checksum( form ) );


			// Don't do anything if we don't have a form
			if( form.length === 0 ){ return false; }

			// REMOVE THE BODY CLASS
			fw.body.removeClass('znpb-options-opened');

			// Update the options array
			if( typeof $.ZnPbFactory.current_layout[element_uid] != 'undefined' ) {
				$.ZnPbFactory.current_layout[element_uid].options = fw.get_form_values(form);
			}
			else {
				$.ZnPbFactory.current_layout[element_uid] = {
					options : fw.get_form_values(form)
				};
			}

			if ( $.page_builder.active_edit_checksum !== null && new_content_checksum === fw.active_edit_checksum  ) {
				return;
			}

			// RENDER THE NEW ELEMENT WITH CHANGED DATA
			fw.render_element( element , 'znpb_render_module' );
		},

		get_form_values : function(scope){

			var $inputs = $(':input',scope);
			var values = {};

			$inputs.each(function() {

				values[this.name] = $(this).val();
			});

			return scope.serializeObject();

		},

		get_checksum : function( scope ) {
			var elements = $(scope).find('.zn_option_container').not(".zn_live_change").find(':input').not("[type=button]"),
				checksum = '';

			elements.each(function() {

				// The value of checkboxes is always the default value
				if( $(this).is(':checkbox') && !$(this).is(':checked') ){
					return;
				}

				// Radio buttons have the same name for each option.. we only need to get the selected value
				if( $(this).is(':radio') && !$(this).is(':checked') ){
					return;
				}

				checksum += $(this).attr('name') + $(this).val();
			});

			return checksum;

		},

		clear_page_template : function(){
			var fw = this;

			$(document).on('click', '.zn_pb_clear_page', function(e){

				e.preventDefault();

				var current_layout = $('.zn_pb_wrapper'),
					all_elements = current_layout.find('.zn_pb_el_container'),
					reordered = all_elements.get().reverse(),
					callback = function() {
						if( $(reordered).length > 0 ){
							$(reordered).each(function(el){

								var element_container = $(this).parent();
								fw.scope.trigger({type: "ZnBeforeElementRemove",content : $(this)});
								$(this).remove();

								if ( element_container.children().length < 1 ) {
									element_container.addClass('zn_pb_no_content');
								}

								if( element_container.has('.ui-sortable') ){
									element_container.sortable('refreshPositions');
									element_container.sortable('refresh');
								}

							});
						}
						$('#zn_pb_sidebar_more').prop('checked', false);
					};
				new $.ZnModalConfirm( 'Are you sure you want to remove all the elements on this page?', 'No', 'Yes', callback );

			});


		}

	};

/*
*	INIT the JS framework
*/
klpb.app =  new $.ZnFramework();
$.page_builder = klpb.app; // For backward compatibility

$.extend(FormSerializer.patterns, {
	validate: /^[a-z][a-z0-9_-]*(?:\[(?:\d*|[a-z0-9_-]+)\])*$/i,
	key:      /[a-z0-9_-]+|(?=\[\])/gi,
	named:    /^[a-z0-9_-]+$/i
});

})(jQuery);

window.ALLOYEDITOR_BASEPATH = ZnKlPb.ALLOYEDITOR_BASEPATH;
window.CKEDITOR_BASEPATH = ZnKlPb.CKEDITOR_BASEPATH;

require('./react/components/changePage.js');
require( './backbone/app.js' );
require( './react/components/toolbar.js' );
require( './react/components/inlineEditor/inlineEditor' );