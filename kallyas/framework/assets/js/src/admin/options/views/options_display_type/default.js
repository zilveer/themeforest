module.exports = Backbone.View.extend({

	template : require( '../../html/default_option_type_display.html' ),
	// className: 'znhg-option-container',
	initialize : function( options ){
		this.controller = options.controller;
	},
	render : function(){
		this.$el.html( this.template( this.model.toJSON() ) );
		this.$('.znhg-option-content').html( new this.controller.optionsType[this.model.get('type')]({model : this.model}).render().$el );
		return this;
	},
});