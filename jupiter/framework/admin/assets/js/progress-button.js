(function($) {
	'use strict';

	var transEndEventNames = {
			'WebkitTransition': 'webkitTransitionEnd',
			'MozTransition': 'transitionend',
			'OTransition': 'oTransitionEnd',
			'msTransition': 'MSTransitionEnd',
			'transition': 'transitionend'
		},
		transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
		support = { transitions : Modernizr.csstransitions };


	ABB.UIProgressButtonCircle = function( el, options ) {
		this.el = el;
		this.options = $.extend( {}, options );
		// extend( this.options, options );
		this._init();
	}

	ABB.UIProgressButtonCircle.prototype._init = function() {
		this.button = this.el.querySelector( 'button' );
		this.progressEl = new ABB.SVGEl( this.el.querySelector( 'svg.progress-circle' ) );
		this.successEl = new ABB.SVGEl( this.el.querySelector( 'svg.checkmark' ) );
		this.errorEl = new ABB.SVGEl( this.el.querySelector( 'svg.cross' ) );
		// init events
		this._initEvents();
		// enable button
		this._enable();
	}

	ABB.UIProgressButtonCircle.prototype._initEvents = function() {
		var self = this;
		this.button.addEventListener( 'click', function() { self._submit(); } );
	}

	ABB.UIProgressButtonCircle.prototype._submit = function() {
		$(this.el).addClass( 'loading' );
		
		var self = this,
			onEndBtnTransitionFn = function( ev ) {
				if( support.transitions ) {
					this.removeEventListener( transEndEventName, onEndBtnTransitionFn );
				}
				
				this.setAttribute( 'disabled', '' );

				if( typeof self.options.callback === 'function' ) {
					self.options.callback( self );
				}
				else {
					self.setProgress(1);
					self.stop();
				}
			};

		if( support.transitions ) {
			this.button.addEventListener( transEndEventName, onEndBtnTransitionFn );
		}
		else {
			onEndBtnTransitionFn();
		}
	}

	ABB.UIProgressButtonCircle.prototype.stop = function( status ) {
		var self = this,
			endLoading = function() {
				self.progressEl.draw(0);
				
				if( typeof status === 'number' ) {
					var statusClass = status >= 0 ? 'success' : 'error',
						statusEl = status >=0 ? self.successEl : self.errorEl;

					statusEl.draw( 1 );
					// add respective class to the element
					$(self.el).addClass( statusClass );
					// after options.statusTime remove status and undraw the respective stroke and enable the button
					setTimeout( function() {
						$(self.el).removeClass( statusClass );
						statusEl.draw(0);
						self._enable();
					}, self.options.statusTime );
				}
				else {
					self._enable();
				}

				$(self.el).removeClass( 'loading' );
			};

		// give it a little time (ideally the same like the transition time) so that the last progress increment animation is still visible.
		setTimeout( endLoading, 300 );
	}

	ABB.UIProgressButtonCircle.prototype.setProgress = function( val ) {
		this.progressEl.draw( val );
	}

	// enable button
	ABB.UIProgressButtonCircle.prototype._enable = function() {
		this.button.removeAttribute( 'disabled' );
	}


})(jQuery);