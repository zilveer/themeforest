/*
*  ShiftNav.js
*  
*  http://shiftnav.io
*
*  Copyright Chris Mavricos, SevenSpark http://sevenspark.com
*/

;(function ( $, window, document, undefined ) {

	var pluginName = "shiftnav",
		defaults = {
			mouseEvents: true,
			retractors: true,
			touchOffClose: true,
			clicktest: false,
			windowstest: false,
			debug: false
		};

	function Plugin ( element, options ) {

		this.element = element;

		this.$shiftnav = $( this.element );

		this.settings = $.extend( {}, defaults, options );
		this._defaults = defaults;
		this._name = pluginName;

		this.touchenabled = ('ontouchstart' in window) || (navigator.maxTouchPoints > 0) || (navigator.msMaxTouchPoints > 0);
		
		if( window.navigator.pointerEnabled ){
			this.touchStart = 'pointerdown';
			this.touchEnd	= 'pointerup';
			this.touchMove	= 'pointermove';
		}
		else if( window.navigator.msPointerEnabled ){
			this.touchStart = 'MSPointerDown';
			this.touchEnd	= 'MSPointerUp';
			this.touchMove	= 'MSPointerMove';
		}
		else{
			this.touchStart = 'touchstart';
			this.touchEnd	= 'touchend';
			this.touchMove	= 'touchmove';
		}

		this.toggleevent = this.touchEnd == 'touchend' ? this.touchEnd + ' click' : this.touchEnd;	//add click except for IE		
		this.transitionend = 'transitionend.shiftnav webkitTransitionEnd.shiftnav msTransitionEnd.shiftnav oTransitionEnd.shiftnav';

		//TESTING
		if( this.settings.clicktest ) this.touchEnd = 'click';

		this.init();
		
	}

	Plugin.prototype = {

		init: function () {


			this.$shiftnav.removeClass( 'shiftnav-nojs' );		//We're off and running

			//this.$toggles = $( '.shiftnav-toggle[data-shiftnav-target="'+this.$shiftnav.attr('id')+'"]' );
			this.$toggles = $( '.shiftnav-toggle[data-shiftnav-target="'+this.$shiftnav.data('shiftnav-id')+'"]' );

			//Initialize user interaction events

			this.initializeShiftNav();

			this.initializeTargets();
			this.initializeSubmenuToggleMouseEvents();
			this.initializeRetractors();
			this.initializeResponsiveToggle();

			//this.initializeTouchoffClose();  //attached on open instead
		
		},



		/* Initalizers */

		initializeShiftNav: function(){
		
			var $body = $('body');

			//Only enable the site once
			if( !$body.hasClass( 'shiftnav-enabled' ) ){
	
				$body.addClass( 'shiftnav-enabled' );
				if( shiftnav_data.lock_body == 'on' ) $body.addClass( 'shiftnav-lock' );
				$body.wrapInner( '<div class="shiftnav-wrap"></div>' );	//unique

				//Move elements outside of shifter
				$( '#shiftnav-toggle-main, #wpadminbar' ).appendTo( 'body' );

				//Pad top
				var toggleHeight = $( '#shiftnav-toggle-main' ).outerHeight();
				$( '.shiftnav-wrap' ).css( 'padding-top' , toggleHeight );

				//Setup non-transform
				if( !shift_supports( 'transform' ) ){
					$body.addClass( 'shiftnav-no-transforms' );
				}
				
			}

			this.$shiftnav.appendTo( 'body' );

			if( this.$shiftnav.hasClass( 'shiftnav-right-edge' ) ){
				this.edge = 'right';
			}
			else this.edge = 'left';

			this.openclass = 'shiftnav-open shiftnav-open-' + this.edge;

			//Set retractor heights
			this.$shiftnav.find( '.shiftnav-submenu-activation' ).each( function(){
				$( this ).css( 'height' , $( this ).outerHeight() );
				//$( this ).css( 'height' , $( this ).parent( '.menu-item' ).height() );
			});
			
		},
	
		initializeTargets: function(){

			this.$shiftnav.on( 'click' , '.shiftnav-target' , function( e ){
				var scrolltarget = $(this).data( 'shiftnav-scrolltarget' );
				if( scrolltarget !== '' ){
					var $target = $( scrolltarget ).first();
					if( $target.size() > 0 ){
						$( 'html,body' ).animate({
							scrollTop: $target.offset().top
						}, 1000 );
						return false; //don't follow any links if this scroll target is present
					}
					//if target isn't present here, redirect with hash
					else{
						var href = $(this).attr( 'href' );
						if( href.indexOf( '#' ) == -1 ){				//check that hash does not already exist
							if( scrolltarget.indexOf( '#' ) == -1 ){	//if this is a class, add a hash tag
								scrolltarget = '#'+scrolltarget;
							}
							window.location = href + scrolltarget;		//append hash/scroll target to URL and redirect
							e.preventDefault();
						}
					}
				}
			});

		},

		initializeSubmenuToggleMouseEvents: function(){

			//Don't initialize if mouse events are disabled
			if( !this.settings.mouseEvents ) return;
			if( this.settings.clicktest ) return;
			if( this.settings.windowstest ) return;


			if( this.settings.debug ) console.log( 'initializeSubmenuToggleMouseEvents' );

			var plugin = this;

			this.$shiftnav.on( 'mouseup.shift-submenu-toggle' , '.shiftnav-submenu-activation' , function(e){ plugin.handleMouseActivation( e , this , plugin ); } );
			//$shiftnav.on( 'mouseout.shift-submenu-toggle'  , '.menu-item' , this.handleMouseout );	//now only added on mouseover
		},

		disableSubmenuToggleMouseEvents: function(){
			if( this.settings.debug ) console.log( 'disableSubmenuToggleMouseEvents' );
			$shiftnav.off( 'mouseover.shift-submenu-toggle' );
			$shiftnav.off( 'mouseout.shift-submenu-toggle'  );
		},

		
		initializeRetractors: function() {

			if( !this.settings.retractors ) return;	//Don't initialize if retractors are disabled
			var plugin = this;
			
			//set up the retractors
			this.$shiftnav.on( 'mouseup.shiftnav' , '.shiftnav-retract' , function(e){ plugin.handleSubmenuRetractorEnd( e , this, plugin); } );
		},


		initializeResponsiveToggle: function(){
			
			var plugin = this;

			//this.$toggles.on( 'click', 'a', function(e){
			this.$toggles.on( this.toggleevent, 'a', function(e){
				//allow link to be clicked but don't propagate so toggle won't activate
				e.stopPropagation();
			});

			//this.$toggles.on( 'click', function(e){
			this.$toggles.on( this.toggleevent, function(e){
				
				e.preventDefault();
				e.stopPropagation();				
				
				//Ignore click events when toggle is disabled to avoid both touch and click events firing
				if( e.originalEvent.type == 'click' && $(this).data( 'disableToggle' ) ){
					console.log( 'nuh-uh' );
					return;
				}

				if( plugin.$shiftnav.hasClass( 'shiftnav-open-target' ) ){
					//console.log( 'close shift nav' );
					plugin.closeShiftNav();
				}
				else{
					//console.log('open shift nav');
					plugin.openShiftNav();
				}

				//Temporarily disable toggle for click event when touch is fired
				if( e.originalEvent.type != 'click' ){
					$( this ).data( 'disableToggle' , true );
					setTimeout( function(){
						$( this ).data( 'disableToggle' , false );
					}, 1000 );
				}

				return false;
								
			});

		},

		openShiftNav: function(){

			var plugin = this;

			$( 'body' )
				.removeClass( 'shiftnav-open-right shiftnav-open-left' )
				.addClass( this.openclass )
				.addClass( 'shiftnav-transitioning' );
				
			//console.log( 'close ' + $( '.shiftnav-open-target' ).attr( 'id' ) );
			$( '.shiftnav-open-target' ).removeClass( 'shiftnav-open-target' );
			this.$shiftnav
				.addClass( 'shiftnav-open-target' )
				.on( plugin.transitionend, function(){
						//if( plugin.settings.debug ) console.log( 'finished submenu close transition' );
						$( 'body' ).removeClass( 'shiftnav-transitioning' );
						$( this ).off( plugin.transitionend );
					});

			this.initializeTouchoffClose();
		},

		closeShiftNav: function(){

			var plugin = this;
			
			$( 'body' )
				.removeClass( this.openclass )
				.addClass( 'shiftnav-transitioning' );

			this.$shiftnav
				.removeClass( 'shiftnav-open-target' )
				.on( plugin.transitionend, function(){
						//if( plugin.settings.debug ) console.log( 'finished submenu close transition' );
						$( 'body' ).removeClass( 'shiftnav-transitioning' );
						$( this ).off( plugin.transitionend );
					});

			this.disableTouchoffClose();
		},

		initializeTouchoffClose: function(){

			if( !this.settings.touchOffClose ) return;  //Don't initialize if touch off close is disabled

			var plugin = this;
			$( document ).on( 'click.shiftnav ' + this.touchEnd + '.shiftnav' , function( e ){ plugin.handleTouchoffClose( e , this , plugin ); } );

		},
		disableTouchoffClose: function(){
			$( document ).off( '.shiftnav' );
		},

		handleMouseActivation: function( e , activator , plugin ){
			if( plugin.settings.debug ) console.log( 'handleMouseover, add mouseout', e );
			
			var $li = $( activator ).parent();

			if( $li.hasClass( 'shiftnav-active' ) ){
				plugin.closeSubmenu( $li , 'mouseActivate' , plugin );
			}
			else{
				plugin.openSubmenu( $li , 'mouseActivate' , plugin );
			}

			//Only attach mouseout after mouseover, this way menus opened by touch won't be closed by mouseout
			//$li.on( 'mouseout.shift-submenu-toggle' , function( e ){ plugin.handleMouseout( e , this , plugin ); } );
		},

		
		handleSubmenuRetractorEnd: function( e , li , plugin ){
			e.preventDefault();
			e.stopPropagation();

			var $li = $(li).parent( 'ul' ).parent( 'li' );
			plugin.closeSubmenu( $li , 'handleSubmenuRetractor' , plugin );

			if( plugin.settings.debug ) console.log( 'handleSubmenuRetractorEnd ' + $li.find('> a').text());

		},

		

		handleTouchoffClose: function( e , _this , plugin ){

			//Only fire if the touch event occurred outside the menus//plugin.$shiftnav.add( plugin.$toggles )
			//if( $(e.target).parents().index( $( '.shiftnav' ) ) == -1){

			if( $(e.target).parents().add( $(e.target) ).filter( '.shiftnav, .shiftnav-toggle, .shiftnav-ignore' ).size() === 0 ){


				if( plugin.settings.debug ) console.log( 'touchoff close ', e );

				e.preventDefault();
				e.stopPropagation();

				$( 'body' ).removeClass( 'shiftnav-open' );
				plugin.$shiftnav.removeClass( 'shiftnav-open-target' );
				
				plugin.disableTouchoffClose();

			}

		},




		/* Controllers */


		openSubmenu: function( $li , tag , plugin ){
			if( !$li.hasClass( 'shiftnav-active' ) ){
				if( $li.hasClass( 'shiftnav-sub-shift' ) ){
					$li.siblings( '.shiftnav-active' ).removeClass( 'shiftnav-active' );
					
					//switch to position absolute, then delay activation below due to Firefox browser bug
					$li.toggleClass( 'shiftnav-caulk' );
					
					plugin.$shiftnav.addClass( 'shiftnav-sub-shift-active' );
				}

				//A dumb timeout hack to fix this FireFox browser bug https://bugzilla.mozilla.org/show_bug.cgi?id=625289
				setTimeout( function(){
					$li.addClass( 'shiftnav-active' );
					$li.trigger( 'shiftnav-open-submenu' );
					$li.removeClass( 'shiftnav-caulk' );
				}, 1 );
			}
		},

		closeSubmenu: function( $li , tag , plugin ){

			//var plugin = this;

			if( this.settings.debug ) console.log( 'closeSubmenu ' + $li.find( '>a' ).text() + ' [' + tag + ']' );

			//If this menu is currently active and has a submenu, close it
			if( $li.hasClass( 'menu-item-has-children' ) && $li.hasClass( 'shiftnav-active' ) ){

				$li.addClass( 'shiftnav-in-transition' );	//transition class keeps visual flag until transition completes

				$li.each( function(){
					var _$li = $(this);
					var _$ul = _$li.find( '> ul' );

					//Remove the transition flag once the transition is completed
					_$ul.on( plugin.transitionend + '_closesubmenu', function(){
						if( plugin.settings.debug ) console.log( 'finished submenu close transition' );
						_$li.removeClass( 'shiftnav-in-transition' );
						_$ul.off( plugin.transitionend  + '_closesubmenu' );
					});
				});
			}
			
			//Actually remove the active class, which causes the submenu to close
			$li.removeClass( 'shiftnav-active' );

			if( $li.hasClass( 'shiftnav-sub-shift' ) ){
				plugin.$shiftnav.removeClass( 'shiftnav-sub-shift-active' );
			}

			$li.trigger( 'shiftnav-close-submenu' );
			
		},

		closeAllSubmenus: function(){
			$( this.element ).find( 'li.menu-item-has-children' ).removeClass( 'shiftnav-active' );
		},

	};

	$.fn[ pluginName ] = function ( options ) {

		var args = arguments;

		if ( options === undefined || typeof options === 'object' ) {
			return this.each(function() {
				if ( !$.data( this, "plugin_" + pluginName ) ) {
					$.data( this, "plugin_" + pluginName, new Plugin( this, options ) );
				}
			});
		}
		else if ( typeof options === 'string' && options[0] !== '_' && options !== 'init') {
			// Cache the method call to make it possible to return a value
			var returns;

			this.each(function () {
				var instance = $.data(this, 'plugin_' + pluginName);

				// Tests that there's already a plugin-instance and checks that the requested public method exists
				if ( instance instanceof Plugin && typeof instance[options] === 'function') {

					// Call the method of our plugin instance, and pass it the supplied arguments.
					returns = instance[options].apply( instance, Array.prototype.slice.call( args, 1 ) );
				}

				// Allow instances to be destroyed via the 'destroy' method
				if (options === 'destroy') {
					$.data(this, 'plugin_' + pluginName, null);
				}
			});

			// If the earlier cached method gives a value back return the value, otherwise return this to preserve chainability.
			return returns !== undefined ? returns : this;
		}
	};

})( jQuery, window, document );

jQuery( document ).ready( function($){

	//Remove Loading Message
	$( '.shiftnav-loading' ).remove();

	//Scroll to non-ID "hashes"
	if( window.location.hash.substring(1,2) == '.' ){
		var $scrollTarget = $( window.location.hash.substring(1) );
		if( $scrollTarget.size() ) window.scrollTo( 0 , $scrollTarget.offset().top );
	}

	//Run ShiftNav
	jQuery( '.shiftnav' ).shiftnav({
		//debug: true
		//mouseEvents: false
		//clicktest: true
	});
});



var shift_supports = (function() {
	var div = document.createElement('div'),
		vendors = 'Khtml Ms O Moz Webkit'.split(' ');
		

	return function(prop) {
		
		var len = vendors.length;

		if ( prop in div.style ) return true;

		prop = prop.replace(/^[a-z]/, function(val) {
			return val.toUpperCase();
		});
  
		while(len--) {
			if ( vendors[len] + prop in div.style ) {
				// browser supports box-shadow. Do what you need.
				// Or use a bang (!) to test if the browser doesn't.
				return true;
			}
		}
		return false;
	};
})();
