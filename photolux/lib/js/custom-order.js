(function($) {

	/**
	 * A custom ordering widget - uses a set of elements to specify a custom
	 * order to them by dragging and dropping the elements to the desired
	 * position. Makes an AJAX request on a "save" button click.
	 *
	 * Dependencies:
	 * - jQuery
	 * - jQuery UI Widget
	 * - jQuery UI Sortable
	 * - Undescrore.js
	 *
	 * @author Pexeto
	 * http://pexetothemes.com
	 */
	$.widget("pexeto.pexetoCustomOrder", {
		options: {
			loadingClass: 'co-loading',
			numberElSel: '.co-number'
		},

		/**
		 * Called when the widget is initialized, inits some variables.
		 */
		_create: function() {
			_.bindAll(this, 'init', 'doOnSaveClick', 'doOnUpdate', 'ajaxSave');
			this.saveBtn = $('#co-save-btn');
			this.currentXhr = null;
			this.loading = null;
			this.init();
		},

		/**
		 * Inits the main functionality and binds event handlers.
		 */
		init: function() {
			//init the sortable functionality
			this.ul = this.element.find('ul#co-ul').sortable({
				update : this.doOnUpdate
			});

			//add a loading element
			this.loading = $('<div />', {
				'class': this.options.loadingClass
			}).insertBefore(this.ul).hide();

			//register a save button event handler
			this.saveBtn.on('click', this.doOnSaveClick);
		},

		/**
		 * On save button click event handler. Calls a function to make the
		 * AJAX request.
		 */
		doOnSaveClick: function() {
			var order = this.ul.sortable("toArray", {
				attribute: "data-id"
			});

			this.ajaxSave(order);
		},

		/**
		 * On sort update event handler - when the sorting order gets changed,
		 * updates the order number in each of the elements.
		 */
		doOnUpdate : function(){
			this.ul.find('li').each($.proxy(function(i, el){
				$(el).find(this.options.numberElSel).html((i+1));
			}, this));
		},

		/**
		 * Makes an AJAX request to save the new order of items.
		 * @param  {array} order containing the IDs of the items in the order
		 * in whuich they should be saved.
		 */
		ajaxSave: function(order) {
			var data = {
				order: order,
				action: 'pexeto_save_custom_order_' + this.ul.data('post_type'),
				nonce: this.ul.data('nonce')
			};

			if(!this.currentXhr) {
				this.loading.show();
				this.currentXhr = $.ajax({
					url: ajaxurl,
					data: data,
					dataType: 'json',
					type: 'POST'
				}).always($.proxy(function() {
					this.currentXhr = null;
					this.loading.hide();
				}, this));
			}
		}

	});

})(jQuery);


jQuery(document).ready(function($) {

	//init the custom order widget
	$('#custom-order-wrapper').pexetoCustomOrder();

});