(function ($) {
	$.ZnAboutJs = function () {
		this.scope = $(document);
		this.zinit();
		this.zn_dummy_step = 0;
		this.failed = 0;
	};

	$.ZnAboutJs.prototype = {
		zinit : function() {
			var fw = this;

			fw.init_tabs();
			// Init theme registration form
			fw.init_theme_registration();

			// Init dummy data install
			fw.init_dummy_install();

			// Init misc
			fw.init_misc();
			// Init tooltips
			fw.init_tooltips();
			// Init plugin ajax actions
			fw.init_plugin_ajax();

		},

		init_tooltips : function(){
			$( '.zn-server-status-column-icon' ).tooltip({
				position : { my: 'center bottom', at: 'center top-10' }
			});
		},

		init_tabs : function(){

			var nav_li = $('.zn-about-navigation > li'),
				nav_links = $('.zn-about-navigation > li > a'),
				actions_area = $('#zn-about-actions');


			nav_li.on('click', function(e){

				var curlink = $('a', e.currentTarget).attr('href');
				$('.zn-about-header').attr('id', curlink + "-dashboard");
				// window.location.hash = '#dashboard-top';
				e.preventDefault();

				// Activate the menu
				$(e.currentTarget).addClass('active');
				$(e.currentTarget).siblings('li').removeClass('active');

				// Activate the current tab
				var tabs = $(this).closest('.zn-about-tabs-wrapper').find('.zn-about-tabs > .zn-about-tab'),
					current_tab = $( curlink );
				window.location.hash = curlink + "-dashboard";

				tabs.removeClass('active');
				current_tab.addClass('active');

			});

			// Activate
			var hash = window.location.hash;
			if (hash !== '') {
				var nodashboard = hash.replace('-dashboard', '');
				nav_li.find('a[href="' + nodashboard + '"]').parent().trigger('click');
			}

		},

		init_theme_registration : function(){
			$('.zn-about-register-form').submit(function(e){
				e.preventDefault();

				var username = $('.zn-about-register-form-username', this).val(),
					api_key  = $('.zn-about-register-form-api', this).val(),
					nonce = $('#zn_nonce', this).val(),
					form = $(this),
					button = form.find( '.zn-about-register-form-submit' ),
					is_submit = false;

				if( form.hasClass('zn-submitting') ){
					return;
				}

				// Don't do anything if we don't have the values filled in
				if( ! username.length || ! api_key.length || ! nonce.length ){
					$(this).addClass('zn-about-register-form--error');
					return;
				}

				var data = {
					'action': 'zn_theme_registration',
					'username': username,
					'api_key': api_key,
					'zn_nonce': nonce
				};

				$(this).addClass('zn-submitting');

				// Perform the Ajax call
				jQuery.post(ajaxurl, data, function(response) {
					var alert = $('#zn-register-theme-alert');
					// If we received an error, display it
					if( response.success === false ){
						if( response.data.error ){
							alert.html('<div class="alert alert-danger">ERROR: '+response.data.error+'</div>').show();
						}
					}
					else if( response.success === true ){
						alert.html('<div class="alert alert-success">'+response.data.message+'</div>').show();
					}
					else{
						alert.html('<div class="alert alert-danger">Something went wrong. Please try again later.</div>').show();
					}
					form.removeClass('zn-submitting');
				});

			});
		},

		init_dummy_install : function(){
			var fw = this;

			$('.zn-about-dummy-install').click(function(e){
				e.preventDefault();

				var self = $(this);

				// Remove disabled class from all buttons and disable the current clicked one
				var submitButtons = $( '.zn-about-dummy-install');
				submitButtons.removeClass('zn-submitting zn-installing');
				// prevents repeated clicks
				self.addClass('zn-submitting zn-installing');

				var nonce = self.closest('.zn-about-dummy-container').data('znnonce'),
					install_folder = self.data('install_folder');

				var data = {
					'action': 'zn_dummy_install',
					'install_folder': install_folder,
					'zn_nonce': nonce
				};

				$( '.zn-dummy-import-block').show();

				var __p = fw.popup,
					popup = __p.create(),
					el_title = self.parents('.zn-about-dummy-wrapper').find('.zn-about-dummy-title').first(),
					el_image = self.parents('.zn-about-dummy-wrapper').find('.zn-about-dummy-image > img').first()
					;
				if(popup){
					__p.setTitle( el_title ? el_title.text() : '' );
					__p.setImage( el_image ? el_image.attr('src') : '' );
					__p.show();

					// if/when the install button is clicked
					var btn = __p.getInstallButtonRef();
					if(btn){
						btn.on('click', function(e){
							e.preventDefault();
							e.stopPropagation();

							// We need at least one checkbox checked
							var chk = $(':checkbox:checked', popup);
							if( ! chk.length )
							{
								alert('Please select at least one option.');
								return false;
							}

							__p.installing(true);

							$(this).addClass('zn-submitting zn-installing');

							// Extend data to include the new options:
							data['options'] = __p.getOptions();
							// And the demo name
							data['options']['demo_name'] = self.attr('data-demo_name');

							fw.process_dummy_install( data, function(){
								$( '.zn-about-dummy-install').removeClass('zn-submitting');
								btn.removeClass('zn-submitting zn-installing');
								btn.text('Done!').addClass('zn-disabled');
								$( '.zn-dummy-import-block').hide();
								__p.installing(false);
							} );
						});
					}
				}
			});
		},

		process_dummy_install : function( data, callback ) {
			var fw = this,
				message_container = $('.zn_import_msg_container'),
				percent_bar = $('.zn_import_bar');

			jQuery.post( ajaxurl, data, function(response,textStatus, jqXHR  ) {

				if( textStatus.status == '500' || typeof response === 'undefined' || ! response ){
					setTimeout(function(){
						fw.failed += 1;

						if( fw.failed <= 3 ){
							fw.process_dummy_install(data,callback);
						}
						else{
							alert('The dummy data could not be imported. Your server blocks the process.');
						}

					}, 3000);
					fw.popup.installing(false);
					return false;
				}

				// GET ONLY THE AJAX RESPONSE
				var source = $('<div>' + response + '</div>');
				response = source.find(".zn_json_response").html();
				response = $.parseJSON( response );

				if( ! jQuery.isEmptyObject(response) && response.status == 'ok' ) {

					if ( response.percent ){
						percent_bar.width(response.percent+'%');

					}
					fw.process_dummy_install(data,callback);

				}
				else if( ! jQuery.isEmptyObject(response) && response.status == 'done' ){
					percent_bar.width('100%');
					callback();

					alert( 'Sample-data installed!' );
				}
				else{
					fw.zn_dummy_step = 0;
				}
			}, 'html').fail(function(){
				setTimeout(function(){
					fw.failed += 1;

					if( fw.failed <= 3 ){
						fw.process_dummy_install(data,callback);
					}
					else{
						fw.popup.installing(false);
						alert('The dummy data could not be imported. Your server blocks the process.');
					}
				}, 3000);
			});

		},

		init_misc : function(){
			$('#tf_username').on('keyup change', function(event) {
				var tfusername = $(this).val(),
					genlink = $(this).closest('.zn-about-register-form').find('.js-zn-label-tfusername-link');
				if(tfusername !== ''){
					genlink.attr('href','http://themeforest.net/user/'+ tfusername +'/api_keys/edit').removeClass('tfusername-link--nope').addClass('tfusername-link--ok');
				} else {
					genlink.addClass('tfusername-link--nope').removeClass('tfusername-link--ok');
				}
			}).trigger('change');
		},

		init_plugin_ajax : function(){
			var fw = this;

			$( document ).on( 'click', '.zn-extension-button', function(e){
				e.preventDefault();

				// Perform the ajax call based on action
				var config = {};
					config.button			= $( this );
					// config.button			= config.button.find('.spinner');
					config.status_classes	= 'zn-active zn-inactive zn-not-installed';
					config.elm_container	= config.button.closest('.zn-extension');
					config.status_holder	= config.elm_container.find( '.zn-extension-status' );
					// config.status_text		= config.button.closest( '.zn-extension-status' );
					config.action			= config.button.data( 'action' );
					config.nonce			= config.button.data( 'nonce' );
					config.slug				= config.button.data( 'slug' );

				if( config.elm_container.hasClass('zn-addons-disabled') ){
					return false;
				}

				var data = {
					security 		: config.nonce,
					action 			: 'zn_do_plugin_action',
					plugin_action 	: config.button.data( 'action' ) 		|| false,
					slug 			: config.button.data( 'slug' ) 			|| false,
				};

				// Don't allow the user to spam the button
				if( config.button.hasClass('is-active') ) { return false; }

				// Add the loading class
				config.button.addClass( 'is-active' );

				fw.perform_ajax_call( data, config );

				return false;
			});
		},

		perform_ajax_call : function( data, config, callback ){
			// Perform the ajax call
			$.ajax({
				'type' : 'post',
				'dataType' : 'json',
				'url' : ajaxurl,
				'data' : data,
				'success' : function( response ){

					// If we received an error, display it
					if( response.data.error ){
						new $.ZnModalMessage( "ERROR: " + response.data.error );
					}

					// Update the plugin status
					config.elm_container.removeClass( config.status_classes );
					config.elm_container.addClass( response.data.status );
					config.status_holder.text( response.data.status_text );

					// Update the plugin
					config.button.data( 'action', response.data.action );
					config.button.text( response.data.action_text );

					if( typeof callback != 'undefined' ){
						callback();
					}

					config.button.removeClass( 'is-active' );
				},
				'error' : function(response){
					if( typeof callback != 'undefined' ){
						callback();
					}
					new $.ZnModalMessage( 'There was a problem performing the action.' );
					config.button.removeClass( 'is-active' );
				}
			});
		},



//--------------
		popup: {
			__instance : null,
			__installing: false,
			create: function()
			{
				var self = this;

				self.__destroy();

				// clone and prepare
				var tmpl = $('.zn-install-popup-template'),
					clone = tmpl.clone(),
					parent = tmpl.parent();

				clone.removeClass('zn-install-popup-template').addClass('zn-install-popup');
				clone.insertAfter(tmpl);

				var popup = $('.zn-install-popup').first();

				// register default event handlers
				$('.zn-install-popup-close-button', popup).on('click', function(e){
					e.preventDefault();
					e.stopPropagation();
					if(self.__installing){
						// do not allow partial demo install (that is, closing the popup while installing the demo data)
						alert('You cannot close the popup until the demo data is installed.');
						return false;
					}
					self.__destroy();
				});

				// Check all options by default except the attachments dependency
				$(':checkbox', popup).not('#zn_dummy_data_import_attachments').attr('checked', 'checked');

				$('#zn_dummy_data_import_attachments_wrapper', popup).show();

				// Set dependency's visibility on state change
				$('#zn_dummy_data_import_content', popup).on('change', function(){
					var dep = $('#zn_dummy_data_import_attachments_wrapper', popup);
					if(dep){
						if($(this).is(':checked')){
							dep.fadeIn(350);
						}
						else { dep.removeAttr('checked').fadeOut(150); }
					}
				});
				return popup;
			},
			__destroy: function(){
				var self = this;
				$('.zn-install-popup').each(function(){
					$(this).fadeOut(300).remove();
					// Restore page state
					$( '.zn-about-dummy-install').removeClass('zn-submitting zn-installing');
					$( '.zn-dummy-import-block').hide();
					self.__installing = false;
				});
			},
			installing: function( value ){
				this.__installing = value;
			},
			show: function(){
				$('.zn-install-popup').addClass('zn-install-popup-visible').fadeIn(300);
			},

			setTitle: function( title ){
				$('.zn-install-popup .zn-install-popup-title').text( title );
			},
			setImage: function( imageUrl ){
				$('.zn-install-popup .zn-demo-image').attr('src', imageUrl );
			},

			getInstallButtonRef: function(){
				return $('.zn-popup-install-demo-button');
			},
			/*
			 * Retrieve all extra options from the popup as an object
			 * @see fw.init_dummy_install()
			 */
			getOptions: function(){
				var checkboxes = $('.zn-install-popup :checkbox'),
					result = {};
				if(! checkboxes){
					return result;
				}
				$.each(checkboxes, function(a,b){
					var self = $(b);
					if(self.is(':checked')) {
						result[self.attr('id')] = self.val();
					}
				});
				return result;
			}
		}
	};

	$(document).ready(function() {
		// Call this on document ready
		$.ZnAboutJs = new $.ZnAboutJs();
	});

})(jQuery);
