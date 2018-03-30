var navSection = require('./navSection');
module.exports = Backbone.View.extend({
	tagName: 'ul',
	className : 'znhgtfw-modal-menu',
	events : {
		'click > li > a' : 'toggleSection'
	},
	render : function(){
		_(znhgShortcodesManagerData.sections).each(function(sectionName){
			var $li = jQuery('<li></li>');
			$li.append('<a href="#">'+ sectionName +'</a>');
			$li.append( new navSection( { collection: znhg.shortcodesManager.shortcodesCollection.bySection( sectionName ) } ).render().$el );
			this.$el.append($li);
		}.bind(this));
		return this;
	},
	toggleSection : function(e){
		this.$el.find('li').removeClass('active');
		jQuery(e.target).parent().addClass('active');
	}
});