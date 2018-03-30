module.exports = Backbone.View.extend({
	className: 'znhg-option-container',
	render : function(){
		this.controlRender();
		this.afterRender();
		this.activateControl();
		return this;
	},
	controlRender : function(){
		this.$el.addClass( 'znhg-option-type-'+ this.model.get('type') );
		this.$el.html( this.template( this.model.toJSON() ) );
		return this;
	},
	afterRender: function(){
		// This should be override by the child class
		return this;
	},
	activateControl : function(){
		var that = this;
		// Here we will activate extra functionality for this param
		this.$('#znhg-control-id-'+ this.model.get('id') ).on('change', function(e){
			that.setValue( jQuery(this).val() );
		});
	},
	setValue : function( newValue ){

		var oldValue = this.model.get('value');
		newValue = this.validateValue( newValue );

		// We will set the value if it validate
		if( null !== newValue && newValue !== oldValue ){
			this.model.set('value', newValue);
			if( this.model.get('type') == 'select' ){
				console.log(newValue);
			}

			this.model.set( 'isChanged', true );
		}
	},
	validateValue : function( value ){
		return value;
	}
});