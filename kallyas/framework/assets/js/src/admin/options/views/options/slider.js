var baseParam = require( './base' );
module.exports = baseParam.extend({
	template: require('../../html/slider.html'),
	events : {
		'change .wp-slider-input' : 'inputChange'
	},
	afterRender : function(){

		this.slider = this.$('.znhg-slider-control');
		var input = this.$('.wp-slider-input');

		this.slider.slider({
			range: "max",
			disabled: this.model.get('disabled'),
			min: this.model.get('minimumValue'),
			max: this.model.get('maximumValue'),
			value: this.model.get('value'),
			step: this.model.get('step'),
			slide: function( event, ui ) {
				input.val( ui.value );
			}
		});

		return this;
	},
	inputChange: function(e){

		var minimumVal = parseInt( this.model.get('minimumValue') ),
			maximumVal = parseInt( this.model.get('maximumValue') ),
			newValue   = parseInt( jQuery(e.currentTarget).val() );

		if( newValue < minimumVal ) { jQuery(e.currentTarget).val( minimumVal ); }
		if( newValue > maximumVal ) { jQuery(e.currentTarget).val( maximumVal ); }

		// CHECK IF THE INPUT IS NOT A NUMBER
		if( isNaN(newValue) ) { jQuery(this).val( minimumVal ); }

		this.slider.slider("value" ,  newValue );
	}
});