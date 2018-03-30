var navItem = require('./navItem');
module.exports = Backbone.View.extend({
	tagName: 'ul',
	className : 'znhgtfw-modal-menu-dropdown',
	render : function(){
		this.collection.each(function( shortcode ){
			this.$el.append(new navItem({model: shortcode}).render().$el);
		}.bind(this));
		return this;
	}
});