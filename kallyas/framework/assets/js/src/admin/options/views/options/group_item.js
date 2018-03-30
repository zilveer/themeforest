module.exports = Backbone.View.extend({
	template: require('../../html/group_item.html'),
	initialize: function(options){
		this.values = options.values;

	},
	render: function(){
		this.setValues();
		var form = znhg.optionsMachine.renderOptionsGroup(this.collection);
		this.$el.html( form );
		return this;
	},
	// If we have saved values, we should add them to the option
	setValues: function(){
		this.collection.each(function(model){
			console.log(model);
			if( this.values[model.get('id')].length > 0 ){
				model.set('value', this.values[model.get('id')] );
			}
		}.bind(this));
	}
});