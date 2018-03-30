var ShortcodesCollection = Backbone.Collection.extend({
	model: require('./shortcodeModel'),
	initialize: function() {
		this.selected = null;
	},
	bySection : function(sectionName){
		filtered = this.filter(function ( shortcode ) {
			return shortcode.get('section') === sectionName;
		});
		return new ShortcodesCollection(filtered);
	},
	setSelected: function( shortcode ) {
		if (this.selected) {
			this.selected.set({selected:false});
		}
		shortcode.set({selected:true});
		this.selected = shortcode;
		this.trigger('shortcodeSelected', shortcode);
	},
	getSelected : function(){
		return this.selected;
	}
});

module.exports = ShortcodesCollection;