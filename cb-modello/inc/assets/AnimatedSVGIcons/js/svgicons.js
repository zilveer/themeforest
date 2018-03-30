/**
     * svgicons.js v1.0.0
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2013, Codrops
 * http://www.codrops.com
 */
;( function( window ) {
	
	'use strict';
	svgIcon.prototype.options = {
		speed : 200,
		easing : mina.linear,
		evtoggle : 'click', // click || mouseover
		size : { w : 64, h : 64 },
		onLoad : function() { return false; },
		onToggle : function() { return false; }
	};

	svgIcon.prototype._initEvents = function() {
		var self = this, toggleFn =  function( ev ) {
				if( ( ( ev.type.toLowerCase() === 'mouseover' || ev.type.toLowerCase() === 'mouseout' ) && isMouseLeaveOrEnter( ev, this ) ) || ev.type.toLowerCase() === self.clickevent ) {
					self.toggle(true);
					self.options.onToggle();	
				}
			};

		if( this.options.evtoggle === 'mouseover' ) {
			this.el.addEventListener( 'mouseover', toggleFn );
			this.el.addEventListener( 'mouseout', toggleFn );
		}
		else {
			this.el.addEventListener( this.clickevent, toggleFn );
		}
	};

	svgIcon.prototype.toggle = function( motion ) {
		if( !this.config.animation ) return;
		var self = this;
		for( var i = 0, len = this.config.animation.length; i < len; ++i ) {
			var a = this.config.animation[ i ],
				el = this.svg.select( a.el ),
				animProp = this.toggled ? a.animProperties.from : a.animProperties.to,
				val = animProp.val, 
				timeout = motion && animProp.delayFactor ? animProp.delayFactor : 0;
			
			if( animProp.before ) {
				el.attr( JSON.parse( animProp.before ) );
			}

			if( motion ) {
				setTimeout(function( el, val, animProp ) { 
					return function() { el.animate( JSON.parse( val ), self.options.speed, self.options.easing, function() {
						if( animProp.after ) {
							this.attr( JSON.parse( animProp.after ) );
						}
						if( animProp.animAfter ) {
							this.animate( JSON.parse( animProp.animAfter ), self.options.speed, self.options.easing );
						}
					} ); }; 
				}( el, val, animProp ), timeout * self.options.speed );
			}
			else {
				el.attr( JSON.parse( val ) );
			}
				
		}
		this.toggled = !this.toggled;
	};

	// add to global namespace
	window.svgIcon = svgIcon;

})( window );







jQuery(document).ready(function(){
	// initialize all
	
	[].slice.call( document.querySelectorAll( '.si-icon' ) ).forEach( function( el ) {
        var size = 64;
        if(el.getAttribute('data-size')!='')size=el.getAttribute('data-size');
		var svgicon = new svgIcon( el, svgIconConfig,{ easing : mina.backin, evtoggle : 'mouseover',size : { w : size, h : size } }  );


	} );

	new svgIcon( document.querySelector( '.si-icons-easing .si-icon-nav-left-arrow' ), svgIconConfig, { easing : mina.backin } );
	new svgIcon( document.querySelector( '.si-icons-easing .si-icon-hamburger' ), svgIconConfig, { easing : mina.backin } );
	new svgIcon( document.querySelector( '.si-icons-easing .si-icon-plus' ), svgIconConfig, { easing : mina.backin } );
	new svgIcon( document.querySelector( '.si-icons-easing .si-icon-volume' ), svgIconConfig, { easing : mina.backin } );
	new svgIcon( document.querySelector( '.si-icons-easing .si-icon-hourglass' ), svgIconConfig, { easing : mina.backin } );
	new svgIcon( document.querySelector( '.si-icons-easing .si-icon-equalizer' ), svgIconConfig, { easing : mina.backin } );
	new svgIcon( document.querySelector( '.si-icons-easing .si-icon-hamburger-cross' ), svgIconConfig, { easing : mina.elastic, speed: 600 } );
	new svgIcon( document.querySelector( '.si-icons-easing .si-icon-trash' ), svgIconConfig, { easing : mina.elastic, speed: 600 } );
	new svgIcon( document.querySelector( '.si-icons-easing .si-icon-clock' ), svgIconConfig, { easing : mina.elastic, speed: 600 } );
	new svgIcon( document.querySelector( '.si-icons-easing .si-icon-maximize' ), svgIconConfig, { easing : mina.elastic, speed: 600 } );
	new svgIcon( document.querySelector( '.si-icons-easing .si-icon-contract' ), svgIconConfig, { easing : mina.elastic, speed: 600 } );
	new svgIcon( document.querySelector( '.si-icons-easing .si-icon-glass-empty' ), svgIconConfig, { easing : mina.elastic, speed: 600 } );

	new svgIcon( document.querySelector( '.si-icons-hover .si-icon-clock' ), svgIconConfig, { easing : mina.backin, evtoggle : 'mouseover', size : { w : 128, h : 128 } } );
	new svgIcon( document.querySelector( '.si-icons-hover .si-icon-hamburger' ), svgIconConfig, { easing : mina.backin, evtoggle : 'mouseover', size : { w : 128, h : 128 } } );
	new svgIcon( document.querySelector( '.si-icons-hover .si-icon-flag' ), svgIconConfig, { easing : mina.backin, evtoggle : 'mouseover', size : { w : 128, h : 128 } } );
	new svgIcon( document.querySelector( '.si-icons-hover .si-icon-zoom' ), svgIconConfig, { easing : mina.backin, evtoggle : 'mouseover', size : { w : 128, h : 128 } } );
	new svgIcon( document.querySelector( '.si-icons-hover .si-icon-maximize' ), svgIconConfig, { easing : mina.backin, evtoggle : 'mouseover', size : { w : 128, h : 128 } } );
	new svgIcon( document.querySelector( '.si-icons-hover .si-icon-equalizer' ), svgIconConfig, { easing : mina.backin, evtoggle : 'mouseover', size : { w : 128, h : 128 } } );

    setInterval(function(){addColor();},1);
    function addColor(){
    jQuery('.si-icon').each(function() {
        var color = jQuery(this).attr('data-color');
        if(color !==undefined && color !=''){
            jQuery(this).find('g > *').each(function() {
                if(jQuery( this).attr('stroke')!==undefined && jQuery( this).attr('stroke')!='none')jQuery( this).css('stroke',color);
                if(jQuery( this).attr('fill')!==undefined && jQuery( this).attr('fill')!='none')jQuery( this).css('fill',color);
            });
        }

    });
    }
});