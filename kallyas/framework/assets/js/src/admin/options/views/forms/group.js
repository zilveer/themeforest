module.exports = Backbone.View.extend({
	className : 'znhg-options-group',
	initialize : function( options ){
		this.controller = options.controller;
	},
	render : function(){
		this.collection.each(function( param ){
			var optionType = param.get('type');
			if( typeof this.controller.optionsType[optionType] !== 'undefined' ){
				this.$el.append( new this.controller.optionsType[optionType]({model : param}).render().$el );
			}
			else{
				console.info('It seems that the "'+optionType+'" option type doesn\'t exists or it wasn\'t registered');
			}
		}.bind(this));

		return this;
	}
});