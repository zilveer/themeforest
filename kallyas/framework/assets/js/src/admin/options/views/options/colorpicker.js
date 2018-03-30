var baseParam = require( './base' );
module.exports = baseParam.extend({
	template: require('../../html/colorpicker.html'),
	render : function(){
		this.controlRender();
		this.$('.znhg-color-picker').wpColorPicker({
			change: this.colorChange.bind(this),
			defaultWidth: '65'
		});
		return this;
	},
	colorChange: function(event, ui){
		this.setValue( ui.color.toString() );
	}
});