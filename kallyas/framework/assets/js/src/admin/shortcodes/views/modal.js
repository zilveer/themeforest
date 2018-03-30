var navView = require('./navView');

module.exports = Backbone.View.extend({
	id: "znhgtfw-shortcodes-modal",
	template : require('../html/modal.html'),
	events : {
		'click .znhgtfw-modal-backdrop': 'modalClose',
		'click .media-modal-close':      'modalClose',
		'click .znhg-shortcode-insert':  'insertShortcode'
	},
	initialize : function( options ){
		this.mainApp = options.app;
		this.listenTo(this.collection, 'shortcodeSelected', this.renderParams);
		this.render();
	},
	render : function(){
		this.$el.html( this.template() );

		// Add the navigation
		this.$('.znhgtfw-modal-sidebar').append( new navView().render().$el );

		// Finally.. add the modal to the page
		jQuery( 'body' ).append( this.$el ).addClass('znhgtfw-modal-open');

		return this;
	},
	modalClose : function(){
		this.$el.remove();
		jQuery('body').removeClass('znhgtfw-modal-open');
		this.mainApp.closeModal();
		this.remove();
	},
	renderParams: function( shortcode ){
		// We will need to render the form
		this.paramsCollection = znhg.optionsMachine.setupParams( shortcode.get('params') );
		var form = znhg.optionsMachine.renderOptionsGroup(this.paramsCollection);
		this.$('.znhgtfw-modal-content').html(form);
	},
	insertShortcode : function(shortcode){

		var shortcodeTag    = this.collection.selected.get( 'id' ),
			changedParams   = this.paramsCollection.where({ isChanged: true }),
			closeShortcode  = this.collection.selected.get( 'hasContent' ) || false,
			shortcodeContent = this.collection.selected.get( 'defaultContent' ) || false,
			output;

		// Open the shortcode tag
		output = '['+ shortcodeTag;
			// output all the shortcode params/attributes
			_.each(changedParams, function(param){
				// Don't add the content attribute
				if( param.get('id') === 'content' ){
					// Set the closeShortcode to true
					closeShortcode = true;
					shortcodeContent = param.get('value');
					return true;
				}
				// Output the param_name=param_value
				output += ' '+ param.get('id') + '="' + param.get('value') +'"';
			});
		output += ']';

		// If we have content, add the content and also add the closing tag
		if ( shortcodeContent ) {
			output += shortcodeContent;
		}

		// Check if we need to close the shortcode
		if( closeShortcode ){
			output += '[/' + shortcodeTag + ']';
		}

		window.wp.media.editor.insert( output );
		this.modalClose();
	}
});