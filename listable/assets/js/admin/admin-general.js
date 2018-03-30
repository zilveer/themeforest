(function( $ ) {
	var pointers_array = [],
		number_of_pointers = null,
		button = null;


	//these hold the ajax responses
	var responseRaw = null;
	var res = null;
	var stepNumber = 0;
	var numberOfSteps = 10;

	$( document ).ready( function() {

		if ( typeof listing_page_pointers === "undefined" ) {
			return;
		}

		// get an array of pointers
		pointers_array = $.map( listing_page_pointers.pointers, function( value, index ) {
			return [value];
		} );

		number_of_pointers = Object.keys( listing_page_pointers.pointers ).length;
		if ( typeof listing_page_pointers.pointers !== "undefined" ) {

			// show the first pointer
			show_pointer( pointers_array[0] );
		}

		import_demodata_listing_categories();
		import_demodata_listing_tags();
	} );

	var show_pointer = function( pointer ) {

		// no target, no fun
		if ( typeof pointer.target === "undefined" ) {
			return;
		}

		pointer.content = '<h3>' + pointer.title + '</h3>' + pointer.content;

		// create an extendend pointer object which will show our tutorial step with direction buttons
		pointer = $.extend( pointer, {
			buttons: function( event, t ) {
				// get the current position of the pointer in array
				var current_position = pointers_array.map( function( obj, index ) {
					if ( obj == pointer ) {
						return index;
					}
				} ).filter( isFinite );
				current_position = parseInt( current_position ) + 1;

				var $buttons = $( '<div class="buttons"></div>' );

				// first let's create the counter
				if ( listing_page_pointers.counter ) {
					var counter_element = $( '<span id="pointer-counter">' + listing_page_pointers.step_label + ' ' + current_position + '/' + pointers_array.length + '</span>' );

					$buttons.append( counter_element );
				}

				var dismiss_button = $( '<a id="dismiss-pointer">' + listing_page_pointers.dismiss_label + '</a>' );
				dismiss_button.bind( 'click.pointer', function( i ) {

					$.post( ajaxurl, {
						pointer: listing_page_pointers.id, // pointer ID
						action: 'dismiss-wp-pointer'
					} );

					t.element.pointer( 'close' );
				} );

				$buttons.append( dismiss_button );

				// if this is the last step add the finish code and quit the other steps
				if ( typeof pointer.next_pointer === "undefined" || current_position === pointers_array.length ) {
					var finish_button = $( '<a id="pointer-next" class="button-primary">' + listing_page_pointers.finish_button_label + '</a>' );

					if ( pointers_array.length > 1 ) {
						// it doesn't mater anymore
						$.post( ajaxurl, {
							pointer: listing_page_pointers.id, // pointer ID
							action: 'dismiss-wp-pointer'
						} );
					}

					finish_button.bind( 'click.pointer', function( i ) {
						t.element.pointer( 'close' );
						$.post( ajaxurl, {
							pointer: listing_page_pointers.id, // pointer ID
							action: 'dismiss-wp-pointer'
						} );
					} );

					$buttons.append( finish_button );
					return $buttons;
				}

				var next_button = $( '<a id="pointer-next" class="button-primary">' + listing_page_pointers.next_button_label + '</a>' );
				next_button.bind( 'click.pointer', function( i ) {
					t.element.pointer( 'close' );
					show_pointer( listing_page_pointers.pointers[pointer.next_pointer] );
				} );

				$buttons.append( next_button );

				return $buttons;
			}
		} );

		$( pointer.target ).pointer( pointer ).pointer( 'open' );
	};



	function import_demodata_listing_categories() {

		//The demo data import-----------------------------------------------------
		var importButton = jQuery( '.import_category_listings' ),
			container = importButton.parent( '.wp-pointer-content' );

		var saveData = {
			container: container,
			ajaxUrl: $( 'input[name=wpGrade_import_ajax_url]', container ).val(),
			optionSlug: $( 'input[name=wpGrade_options_page_slug]', container ).val(),
			nonceImportListingCategories: $( 'input[name=wpGrade-nonce-import-listing-categories]', container ).val(),
			ref: $( 'input[name=_wp_http_referer]', container ).val()
		};

		//this is the ajax queue
		var this_data = {},
			resultcontainer = $( '.wpGrade-import-results', this_data.container );
		qInst = $.qjax( {
			timeout: 3000,
			ajaxSettings: {
				//Put any $.ajax options you want here, and they'll inherit to each Queue call, unless they're overridden.
				type: "POST",
				url: ajaxurl
			},
			onQueueChange: function( length ) {

				if ( length == 0 ) {

					if ( res.errors == false ) {

						setTimeout( function() {
							resultcontainer.append( '<i>' + listable_admin_js_texts.import_all_done + '</i><br />' );
						}, 1000 );

						setTimeout( function() {
							resultcontainer.append( '<h4>' + listable_admin_js_texts.import_phew + '</h4><br /><p>' + listable_admin_js_texts.import_success_note + '</p>' );
						}, 1000 );

						// dismiss this pointer after import
						$.post( ajaxurl, {
							pointer: listing_page_pointers.id, // pointer ID
							action: 'dismiss-wp-pointer'
						} );
					} else {
						//we have errors
						//re-enable the import button
						button.removeClass( 'button-disabled' );

						setTimeout( function() {
							resultcontainer.append( '<i>' + listable_admin_js_texts.import_failed + '</i><br />' );
						}, 1000 );
					}

					// we are done, let the user see what has been done
					//import_end_loading();
				}
			},
			onError: function() {
				//stop everything on error
				if ( res.errors != null && res.errors != false ) {
					qInst.Clear();
				}
			},
			//onTimeout: function(current) {
			//},
			onStart: function() {
				//show the loader and some messages
				//import_start_loading();
			},
			onStop: function() {
				//stop everything on error
				if ( res.errors != null && res.errors != false ) {
					qInst.Clear();
				}
			}
		} );

		//bind to click
		importButton.bind( 'click', {set: saveData}, function( receivedData ) {

			this_data = receivedData.data.set;

			var button = $( this );

			if ( button.is( '.wpGrade_button_inactive' ) ) return false;

			var activate = confirm( listable_admin_js_texts.import_confirm );

			if ( activate == false ) return false;

			//show loader
			$( '.wpGrade-loading-wrap', this_data.container ).css( {
				opacity: 0,
				display: "block",
				visibility: 'visible'
			} ).removeClass( "hidden" ).animate( {opacity: 1} );
			//disable the import button
			button.addClass( 'button-disabled' );
			resultcontainer.removeClass( 'hidden' );
			resultcontainer.append( '<br /><i>' + listable_admin_js_texts.import_working + '</i><br />' );

			//queue the calls
			ajax_import_listing_categories_stepped( resultcontainer, this_data );

			return false;
		} );
	}


	function ajax_import_listing_categories_stepped( resultcontainer, this_data ) {
		//add to queue the calls to import the posts, pages, custom posts, etc
		stepNumber = 0;
		while ( stepNumber < numberOfSteps ) {
			stepNumber++;
			qInst.Queue( {
					type: "POST",
					url: this_data.ajaxUrl,
					data: {
						action: 'wpGrade_ajax_import_listing_categories',
						_wpnonce: this_data.nonceImportListingCategories,
						_wp_http_referer: this_data.ref,
						step_number: stepNumber,
						number_of_steps: numberOfSteps
					}
				} )
				.fail( function( response ) {
					responseRaw = response;
					res = wpAjax.parseAjaxResponse( response, 'notifier' );
					resultcontainer.append( '<i style="color:red">' + listable_admin_js_texts.import_posts_failed + '</i><br />' );
				} )
				.done( function( response ) {
					responseRaw = response;
					res = wpAjax.parseAjaxResponse( response, 'notifier' );
					if ( res != null && res.errors != null ) {
						if ( res.errors == false ) {
							if ( res.responses[0] != null ) {
								resultcontainer.append( '<i>' + listable_admin_js_texts.import_posts_step + ' ' + +res.responses[0].supplemental.stepNumber + ' of ' + res.responses[0].supplemental.numberOfSteps + '</i><br />' );
								//for debuging purposes
								resultcontainer.append( '<div style="display:none;visibility:hidden;">Return data:<br />' + res.responses[0].data + '</div>' );
							} else {
								resultcontainer.append( '<i style="color:red">' + listable_admin_js_texts.import_posts_failed + '</i><br />' + listable_admin_js_texts.import_error + ' ' + res.responses[0].data );
							}
						}
						else {
							if ( res.responses[0] != null ) {
								resultcontainer.append( '<i style="color:red">' + listable_admin_js_texts.import_posts_failed + '</i><br />( ' + res.responses[0].errors[0].message + ' )<br/>' );
							} else {
								resultcontainer.append( '<i style="color:red">' + listable_admin_js_texts.import_posts_failed + '</i><br />' + listable_admin_js_texts.import_error + ' ' + res.responses[0].data );
							}
						}
					} else {
						resultcontainer.append( '<i style="color:red">' + listable_admin_js_texts.import_posts_failed + ' ' + listable_admin_js_texts.import_try_reload + ' </i><br />' );
					}
				} );
		}
	}

	/****** TAGS ***/

	function import_demodata_listing_tags() {

		//The demo data import-----------------------------------------------------
		var importButton = jQuery( '.import_tag_listings' ),
			container = importButton.parent( '.wp-pointer-content' );

		var saveData = {
			container: container,
			ajaxUrl: $( 'input[name=wpGrade_import_ajax_url]', container ).val(),
			optionSlug: $( 'input[name=wpGrade_options_page_slug]', container ).val(),
			nonceImportListingTags: $( 'input[name=wpGrade-nonce-import-listing-tags]', container ).val(),
			ref: $( 'input[name=_wp_http_referer]', container ).val()
		};

		//this is the ajax queue
		var this_data = {},
			resultcontainer = $( '.wpGrade-import-results', this_data.container );
		qInst = $.qjax( {
			timeout: 3000,
			ajaxSettings: {
				//Put any $.ajax options you want here, and they'll inherit to each Queue call, unless they're overridden.
				type: "POST",
				url: ajaxurl
			},
			onQueueChange: function( length ) {

				if ( length == 0 ) {

					if ( res.errors == false ) {

						setTimeout( function() {
							resultcontainer.append( '<i>' + listable_admin_js_texts.import_all_done + '</i><br />' );
						}, 1000 );

						setTimeout( function() {
							resultcontainer.append( '<h4>' + listable_admin_js_texts.import_phew + '</h4><br /><p>' + listable_admin_js_texts.import_success_note + '</p>' );
						}, 1000 );

						// dismiss this pointer after import
						$.post( ajaxurl, {
							pointer: listing_page_pointers.id, // pointer ID
							action: 'dismiss-wp-pointer'
						} );
					} else {
						//we have errors
						//re-enable the import button
						button.removeClass( 'button-disabled' );

						setTimeout( function() {
							resultcontainer.append( '<i>' + listable_admin_js_texts.import_failed + '</i><br />' );
						}, 1000 );
					}
					// we are done, let the user see what has been done
					//import_end_loading();
				}
			},
			onError: function() {
				//stop everything on error
				if ( res.errors != null && res.errors != false ) {
					qInst.Clear();
				}
			},
			//onTimeout: function(current) {
			//},
			onStart: function() {
				//show the loader and some messages
				//import_start_loading();
			},
			onStop: function() {
				//stop everything on error
				if ( res.errors != null && res.errors != false ) {
					qInst.Clear();
				}
			}
		} );

		//bind to click
		importButton.bind( 'click', {set: saveData}, function( receivedData ) {

			this_data = receivedData.data.set;

			var button = $( this );
			if ( button.is( '.wpGrade_button_inactive' ) ) return false;

			var activate = confirm( listable_admin_js_texts.import_confirm );
			if ( activate == false ) return false;

			//show loader
			$( '.wpGrade-loading-wrap', this_data.container ).css( {
				opacity: 0,
				display: "block",
				visibility: 'visible'
			} ).removeClass( "hidden" ).animate( {opacity: 1} );
			//disable the import button
			button.addClass( 'button-disabled' );
			resultcontainer.removeClass( 'hidden' );
			resultcontainer.append( '<br /><i>' + listable_admin_js_texts.import_working + '</i><br />' );

			//queue the calls
			ajax_import_listing_tags_stepped( resultcontainer, this_data );

			return false;
		} );
	}

	function ajax_import_listing_tags_stepped( resultcontainer, this_data ) {
		//add to queue the calls to import the posts, pages, custom posts, etc
		stepNumber = 0;
		while ( stepNumber < numberOfSteps ) {
			stepNumber++;
			qInst.Queue( {
					type: "POST",
					url: this_data.ajaxUrl,
					data: {
						action: 'wpGrade_ajax_import_listing_tags',
						_wpnonce: this_data.nonceImportListingTags,
						_wp_http_referer: this_data.ref,
						step_number: stepNumber,
						number_of_steps: numberOfSteps
					}
				} )
				.fail( function( response ) {
					responseRaw = response;
					res = wpAjax.parseAjaxResponse( response, 'notifier' );
					resultcontainer.append( '<i style="color:red">' + listable_admin_js_texts.import_posts_failed + '</i><br />' );
				} )
				.done( function( response ) {
					responseRaw = response;
					res = wpAjax.parseAjaxResponse( response, 'notifier' );
					if ( res != null && res.errors != null ) {
						if ( res.errors == false ) {
							if ( res.responses[0] != null ) {
								resultcontainer.append( '<i>' + listable_admin_js_texts.import_posts_step + ' ' + +res.responses[0].supplemental.stepNumber + ' of ' + res.responses[0].supplemental.numberOfSteps + '</i><br />' );
								//for debuging purposes
								resultcontainer.append( '<div style="display:none;visibility:hidden;">Return data:<br />' + res.responses[0].data + '</div>' );
							} else {
								resultcontainer.append( '<i style="color:red">' + listable_admin_js_texts.import_posts_failed + '</i><br />' + listable_admin_js_texts.import_error + ' ' + res.responses[0].data );
							}
						}
						else {
							if ( res.responses[0] != null ) {
								resultcontainer.append( '<i style="color:red">' + listable_admin_js_texts.import_posts_failed + '</i><br />( ' + res.responses[0].errors[0].message + ' )<br/>' );
							} else {
								resultcontainer.append( '<i style="color:red">' + listable_admin_js_texts.import_posts_failed + '</i><br />' + listable_admin_js_texts.import_error + ' ' + res.responses[0].data );
							}
						}
					} else {
						resultcontainer.append( '<i style="color:red">' + listable_admin_js_texts.import_posts_failed + ' ' + listable_admin_js_texts.import_try_reload + ' </i><br />' );
					}
				} );
		}
	}

	/****** TAGS ***/

	$.qjax = function( o ) {
		var opt = $.extend( {
				timeout: null,
				onStart: null,
				onStop: null,
				onError: null,
				onTimeout: null,
				onQueueChange: null,
				queueChangeDelay: 0,
				ajaxSettings: {
					contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
					type: 'GET'
				}
			}, o ), _queue = [], _currentReq = null, _timeoutRef = null, _this = this, _started = false,

			TriggerStartEvent = function() {
				if ( !_started ) {
					_started = true;
					//If we have a timeout handler, a timeout interval, and we have at least one thing in the queue...
					if ( opt.onTimeout && opt.timeout && $.isFunction( opt.onTimeout ) ) {
						//Kill the old timeout handle
						if ( _timeoutRef ) {
							clearTimeout( _timeoutRef );
						}
						//Create a new timeout, that calls the event when elapsed.
						_timeoutRef = setTimeout( $.proxy( function() {
							opt.onTimeout.call( this, _currentReq.options );
						}, this ), opt.timeout );
					}
					//If we have an onStart handler, call it.
					if ( opt.onStart && $.isFunction( opt.onStart ) ) {
						opt.onStart( this, _currentReq.options );
					}
				}
			},
			TriggerStopEvent = function() {
				//If we've started, and the queue is empty...
				if ( _started && _queue.length <= 0 ) {
					_started = false;
					if ( _timeoutRef ) {
						clearTimeout( _timeoutRef );
					}
					//Mark as stopped, and fire the onStop handler if possible.
					if ( opt.onStop && $.isFunction( opt.onStop ) ) {
						opt.onStop( this, _currentReq.options );
					}
				}
			},
			TriggerQueueChange = function() {
				if ( opt.onQueueChange ) {
					opt.onQueueChange.call( _this, _queue.length );
				}
				//Only start a new request if we have at least one, and another isn't in progress.
				if ( _queue.length >= 1 && !_currentReq ) {
					//Pull off the next request.
					_currentReq = _queue.shift();
					if ( _currentReq.options.isCallback ) {
						//It's a queued function... just call it.
						_currentReq.options.complete();
					} else {
						//Create the new ajax request, and assign any promise events.
						TriggerStartEvent();
						var request = $.ajax( _currentReq.options );
						for ( var i in _currentReq.promise ) {
							for ( var x in _currentReq.promise[i] ) {
								request[i].call( this, _currentReq.promise[i][x] );
							}
						}
					}
				}
			};

		var QueueObject = function( options, complete, context ) {
			this.options = options;
			this.complete = complete;
			this.context = context;
			this.promise = {done: [], then: [], always: [], fail: []};
		};
		QueueObject.prototype._promise = function( n, h ) {
			if ( this.promise[n] ) {
				this.promise[n].push( h );
			}
			return this;
		};
		QueueObject.prototype.done = function( handler ) {
			return this._promise( 'done', handler );
		};
		QueueObject.prototype.then = function( handler ) {
			return this._promise( 'then', handler );
		};
		QueueObject.prototype.always = function( handler ) {
			return this._promise( 'always', handler );
		};
		QueueObject.prototype.fail = function( handler ) {
			return this._promise( 'fail', handler );
		};

		this.Clear = function() {
			_queue = [];
		};
		this.Queue = function( obj, thisArg ) {
			var _o = {}, origComplete = null;
			if ( obj instanceof Function ) {
				//If the obj var is a function, set the options to reflect that, and set the origComplete var to the passed function.
				_o = {isCallback: true};
				origComplete = obj;
			} else {
				//The obj is an object of ajax settings. Extend the options with the instance ones, and store the complete function.
				_o = $.extend( {}, opt.ajaxSettings, obj || {} );
				origComplete = _o.complete;
			}
			//Create our own custom complete handler...
			_o.complete = function( request, status ) {
				if ( status == 'error' && opt.onError && $.isFunction( opt.onError ) ) {
					opt.onError.call( _currentReq.context || this, request, status );
				}
				if ( _currentReq ) {
					if ( _currentReq.complete ) {
						_currentReq.complete.call( _currentReq.context || this, request, status );
					}
					TriggerStopEvent();
					_currentReq = null;
					TriggerQueueChange();
				}
			};
			//Push the queue object into the queue, and notify the user that the queue length changed.
			var obj = new QueueObject( _o, origComplete, thisArg );
			_queue.push( obj );
			setTimeout( TriggerQueueChange, opt.queueChangeDelay );
			return obj;
		};
		return this;
	};
})( jQuery );

