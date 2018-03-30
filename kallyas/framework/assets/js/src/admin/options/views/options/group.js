var baseParamView = require( './base' );
var groupItemView = require( './group_item' );
module.exports = baseParamView.extend({
	template: require('../../html/group.html'),
	afterRender: function(){

		this.itemsContainer = this.$('.znhg-group-option-container');

		// Check if we have saved values
		var values = this.model.get('value');
		if (values.length) {
			_.each(values, function(itemValue) {
				this.addItem(itemValue);
			}.bind(this));
		}

		return this;
	},
	addItem: function( groupItem ){
		var paramsCollection = znhg.optionsMachine.setupParams( this.model.get('subelements') );

		var item = new groupItemView({
			values : groupItem,
			collection: paramsCollection
		}).render();

		this.itemsContainer.append(item.$el);

		return this;
	}
});