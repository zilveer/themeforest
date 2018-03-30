module.exports = Backbone.View.extend({
	tagName : 'li',
	events : {
		'click' : 'selectShortcode'
	},
	render : function(){
		this.$el.html( jQuery('<a href="#">' + this.model.get('name') + '</a>') );
		return this;
	},
	selectShortcode : function(){
		this.model.setSelected();
	}
});