(function( $ ) {
	'use strict';

	var AjaxModal = function AjaxModal(el) {
		this.el = el;

		var $this = $(el);
		var action = $this.data( 'action' );
		var id = $this.data( 'id' );

		this.load(action, id);
	};

	AjaxModal.prototype = {
		// TODO decouple this
		init: function init(html) {
			var self = this;

			$('body').append( html );

			this.cacheElements();
			this.bindEvents();

			this.$modal.addClass( 'is-active' );

			MK.core.initAll(self.$modal.get(0));

			// Its used in Woocommerce Product variation script.
            $( '.variations_form' ).each( function() {
                $( this ).wc_variation_form().find('.variations select:eq(0)').change();
            });

            MK.utils.scroll.disable();
			MK.ui.loader.remove();
			MK.utils.eventManager.publish('quickViewOpen');
		},

		cacheElements: function cacheElement() {
			this.$modal = $('.mk-modal');
			this.$slider = this.$modal.find('.mk-slider-holder');
			this.$container = this.$modal.find('.mk-modal-container');
			this.$closeBtn = this.$modal.find('.js-modal-close');
		},

		bindEvents: function bindEvents() {
			this.$container.on('click', function(e) {
				e.stopPropagation();
			});

			this.$closeBtn.on('click', this.handleClose.bind(this));
			this.$modal.on('click', this.handleClose.bind(this));
		},

		handleClose: function handleClose(e) {
			e.preventDefault();
			MK.utils.scroll.enable();
			this.close();
		},

		close: function close() {
			this.$modal.remove();
		},

		load: function load(action, id) {
			$.ajax({
				url: MK.core.path.ajaxUrl,
				data: {
					action: action,
					id: id
				},
				success: this.init.bind( this ),
				error: this.error.bind( this )
			});
		},

		error: function error(response) {
			console.log(response);
		}
	};


	var createModal = function createModal(e) {
		e.preventDefault();
		var el = e.currentTarget;
		MK.ui.loader.add($(el).parents('.product-loop-thumb'));
		new AjaxModal(el);
	};


	$( document ).on( 'click', '.js-ajax-modal', createModal ); 

})( jQuery );