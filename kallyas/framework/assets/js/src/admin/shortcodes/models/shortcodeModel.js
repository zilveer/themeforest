module.exports = Backbone.Model.extend({
	defaults : {
		id : 'shortcode-tag',
		name : 'Shortcode Name',
		section : 'Section',
		description : 'Shortcode description',
		params : [],
	},
	setSelected:function() {
		this.collection.setSelected(this);
	}
});