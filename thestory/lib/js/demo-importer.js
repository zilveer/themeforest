var PEXETO = PEXETO || {};

(function($){

/**
 * Demo Importer JavaScript functionality - handles the AJAX request to import
 * the demo data.
 */
PEXETO.demoImporter = {

	/**
	 * Inits the import functionality - binds event handlers.
	 */
	init : function(){
		var self = this;
		$('.pexeto-import-btn').on('click', function(e){
			e.preventDefault();
			self.doOnImportClick($(this));
		});

		window.onbeforeunload = function(){
			if(self.inLoading){
				return 'Leaving the page while importing can lead to partial data import.';
			}
		};
	},

	/**
	 * On import button click event handler - makes an AJAX request to start
	 * the import.
	 * @param  {object} $btn the button element that has been clicked
	 */
	doOnImportClick : function($btn){
		var self = this;

		if(this.inLoading){
			//do not start another import while importing one demo content
			return;
		}
		this.inLoading = true;
		this.addLoading($btn);

		var data = {
			action : 'pexeto_import_demo',
			demo : $btn.data('demo'),
			nonce : $btn.data('nonce')
		};

		$.ajax({
			url: ajaxurl,
			dataType: 'json',
			data: data,
			type: 'POST'
		}).done(function(res) {
			if(res && res.success) {
				self.addSuccess($btn);
			} else {
				var message = res && res.message ? res.message : '';
				self.addError($btn, message);
			}
		}).always(function() {
			//remove the loading
			self.inLoading = false;
			self.removeLoading($btn);
		});
	},

	/**
	 * Adds a loading after a button element.
	 * @param {object} $btn the button element
	 */
	addLoading : function($btn){
		$('<div class="pexeto-loading">Importing ...<br/> Please be patient - it can take a while</div>').insertAfter($btn);
		$('.pexeto-import-wrap').addClass('pexeto-importing');
	},

	/**
	 * Removes a loading after a button element.
	 * @param  {object} $btn the button element
	 */
	removeLoading : function($btn){
		$btn.siblings('.pexeto-loading').remove();
		$('.pexeto-import-wrap').removeClass('pexeto-importing');
	},

	/**
	 * Adds a success message after a button element.
	 * @param {object} $btn the button element
	 */
	addSuccess : function($btn){
		$('<div class="pexeto-success">All done!</div>').insertAfter($btn);
	},

	/**
	 * Adds an error message after a button element.
	 * @param {object} $btn    the button element
	 */
	addError: function($btn, message){
		message = 'There was a problem with the import. Please try again later or import the data manually.'+message;
		$('<div class="pexeto-error">'+message+'</div>').insertAfter($btn);
	}
};

})(jQuery);

jQuery('document').ready(function(){

	PEXETO.demoImporter.init();

});