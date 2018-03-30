window.cImageWidget = window.cImageWidget || {};

(function( window, $, wp, undefined ) {

	cImageWidget.MediaManager = function(options) {
		this.options = options;
		this.media = this;
		this.target = options.target;

		this.$target = $( '#' + this.options.target );
		this.$trigger = $( '.' + this.options.target + '-add' );

		this.setFrame();
		this.bindEvents();
	}

	cImageWidget.MediaManager.prototype.bindEvents = function() {
		var self = this;

		$(document).on( 'widget-added widget-updated', function(event, $widget) {
			var widgetNumber = $widget.find( 'input.multi_number' ).val();
			self.target = self.options.target.replace( '__i__', widgetNumber );

			self.$target = $( '#' + self.target );
			self.$trigger = $( '.' + self.target + '-add' );

			self.$trigger.on( 'click', function(e) {
				e.preventDefault();

				self.bindFrame();
			});
		});

		this.$trigger.on( 'click', function(e) {
			e.preventDefault();

			self.bindFrame();
		});
	}

	cImageWidget.MediaManager.prototype.bindFrame = function() {
		var self = this;

		this.frame.open();

		this.frame.on( 'select', function() {
			self.media.attachItem();
		});
	}

	cImageWidget.MediaManager.prototype.setFrame = function() {
		this.frame = wp.media.frames._frame = wp.media({
			title: 'Choose an Image',
			button: {
				text: 'Use Image'
			},
			multiple: false
		});
	}

	cImageWidget.MediaManager.prototype.attachItem = function($el) {
		var attachment = this.frame
			.state()
			.get( 'selection' )
			.first()
			.toJSON();

		this.$target.val(attachment.sizes.full.url);
	}

})( this, jQuery, wp );
