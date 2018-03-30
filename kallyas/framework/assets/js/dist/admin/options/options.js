(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
module.exports = function(obj){
var __t,__p='',__j=Array.prototype.join,print=function(){__p+=__j.call(arguments,'');};
with(obj||{}){
__p+='';
 if( name.length > 0 ) { 
__p+='\r\n\t<h4 class="znhg-option-title">\r\n\t\t'+
((__t=( name ))==null?'':__t)+
'\r\n\t</h4>\r\n';
 } 
__p+='\r\n';
 if( description.length > 0 ) { 
__p+='\r\n\t<div class="znhg-option-description">\r\n\t\t'+
((__t=( description ))==null?'':__t)+
'\r\n\t</div>\r\n';
 } 
__p+='\r\n<div class="znhg-option-content">\r\n\t<div class="input-append color">\r\n\t\t<input id="znhg-control-id-'+
((__t=( id ))==null?'':__t)+
'" type="text" class="znhg-color-picker" data-default-color="'+
((__t=( value ))==null?'':__t)+
'" name="'+
((__t=( id ))==null?'':__t)+
'" ';
 if( alpha ) { 
__p+=' data-alpha="true" ';
 } 
__p+=' value="'+
((__t=( value ))==null?'':__t)+
'" >\r\n\t</div>\r\n</div>';
}
return __p;
};

},{}],2:[function(require,module,exports){
module.exports = function(obj){
var __t,__p='',__j=Array.prototype.join,print=function(){__p+=__j.call(arguments,'');};
with(obj||{}){
__p+='<div class="znhg-option-container">\r\n\t';
 if( name.length > 0 ) { 
__p+='\r\n\t\tthis is the name\r\n\t';
 } 
__p+='\r\n\t';
 if( description.length > 0 ) { 
__p+='\r\n\t\tthis is the description\r\n\t';
 } 
__p+='\r\n\t<div class="znhg-option-content"></div>\r\n</div>';
}
return __p;
};

},{}],3:[function(require,module,exports){
module.exports = function(obj){
var __t,__p='',__j=Array.prototype.join,print=function(){__p+=__j.call(arguments,'');};
with(obj||{}){
__p+='';
 if( name.length > 0 ) { 
__p+='\r\n\t<h4 class="znhg-option-title">\r\n\t\t'+
((__t=( name ))==null?'':__t)+
'\r\n\t</h4>\r\n';
 } 
__p+='\r\n';
 if( description.length > 0 ) { 
__p+='\r\n\t<div class="znhg-option-description">\r\n\t\t'+
((__t=( description ))==null?'':__t)+
'\r\n\t</div>\r\n';
 } 
__p+='\r\n<div class="znhg-option-content">\r\n\t<div class="znhg-group-option-container"></div>\r\n\t<div class="znhg-group-option-add">Add more</div>\r\n\t<!-- <input type="text" name="'+
((__t=( id ))==null?'':__t)+
'" id="znhg-control-id-'+
((__t=( id ))==null?'':__t)+
'" value="'+
((__t=( value ))==null?'':__t)+
'" ';
 if( placeholder.length > 0 ) { 
__p+=' placeholder="'+
((__t=( placeholder ))==null?'':__t)+
'" ';
 } 
__p+='> -->\r\n</div>';
}
return __p;
};

},{}],4:[function(require,module,exports){
arguments[4][3][0].apply(exports,arguments)
},{"dup":3}],5:[function(require,module,exports){
module.exports = function(obj){
var __t,__p='',__j=Array.prototype.join,print=function(){__p+=__j.call(arguments,'');};
with(obj||{}){
__p+='';
 if( name.length > 0 ) { 
__p+='\r\n\t<h4 class="znhg-option-title">\r\n\t\t'+
((__t=( name ))==null?'':__t)+
'\r\n\t</h4>\r\n';
 } 
__p+='\r\n';
 if( description.length > 0 ) { 
__p+='\r\n\t<div class="znhg-option-description">\r\n\t\t'+
((__t=( description ))==null?'':__t)+
'\r\n\t</div>\r\n';
 } 
__p+='\r\n<div class="znhg-option-content">\r\n\t<select name="'+
((__t=( id ))==null?'':__t)+
'" id="znhg-control-id-'+
((__t=( id ))==null?'':__t)+
'" ';
 if( multiple ) { 
__p+=' multiple ';
 } 
__p+='>\r\n\t\t<!-- <option value="volvo">Volvo</option> -->\r\n\t\t';
 _.each(options, function(name, id) {
			var selected = _.isArray(value) ? _.indexOf( value, id ) : value == id,
				selectedString = selected ? 'selected' : '';
		
__p+='\r\n\t\t\t<option value="'+
((__t=( id ))==null?'':__t)+
'" '+
((__t=( selectedString ))==null?'':__t)+
'>'+
((__t=( name ))==null?'':__t)+
'</option>\r\n\t\t';
 }); 
__p+='\r\n\t</select>\r\n</div>';
}
return __p;
};

},{}],6:[function(require,module,exports){
module.exports = function(obj){
var __t,__p='',__j=Array.prototype.join,print=function(){__p+=__j.call(arguments,'');};
with(obj||{}){
__p+='';
 if( name.length > 0 ) { 
__p+='\r\n\t<h4 class="znhg-option-title">\r\n\t\t'+
((__t=( name ))==null?'':__t)+
'\r\n\t</h4>\r\n';
 } 
__p+='\r\n';
 if( description.length > 0 ) { 
__p+='\r\n\t<div class="znhg-option-description">\r\n\t\t'+
((__t=( description ))==null?'':__t)+
'\r\n\t</div>\r\n';
 } 
__p+='\r\n<div class="znhg-option-content">\r\n\t<div class="zn_slider">\r\n\t\t<input id="znhg-control-id-'+
((__t=( id ))==null?'':__t)+
'" type="number" class="wp-slider-input" name="'+
((__t=( id ))==null?'':__t)+
'" value="'+
((__t=( parseInt(value) ))==null?'':__t)+
'">\r\n\t\t<div class="wp-slider znhg-slider-control"></div>\r\n\t</div>\r\n</div>';
}
return __p;
};

},{}],7:[function(require,module,exports){
module.exports = function(obj){
var __t,__p='',__j=Array.prototype.join,print=function(){__p+=__j.call(arguments,'');};
with(obj||{}){
__p+='';
 if( name.length > 0 ) { 
__p+='\r\n\t<h4 class="znhg-option-title">\r\n\t\t'+
((__t=( name ))==null?'':__t)+
'\r\n\t</h4>\r\n';
 } 
__p+='\r\n';
 if( description.length > 0 ) { 
__p+='\r\n\t<div class="znhg-option-description">\r\n\t\t'+
((__t=( description ))==null?'':__t)+
'\r\n\t</div>\r\n';
 } 
__p+='\r\n<div class="znhg-option-content">\r\n\t<input type="text" name="'+
((__t=( id ))==null?'':__t)+
'" id="znhg-control-id-'+
((__t=( id ))==null?'':__t)+
'" value="'+
((__t=( value ))==null?'':__t)+
'" ';
 if( placeholder.length > 0 ) { 
__p+=' placeholder="'+
((__t=( placeholder ))==null?'':__t)+
'" ';
 } 
__p+='>\r\n</div>';
}
return __p;
};

},{}],8:[function(require,module,exports){
module.exports = function(obj){
var __t,__p='',__j=Array.prototype.join,print=function(){__p+=__j.call(arguments,'');};
with(obj||{}){
__p+='';
 if( name.length > 0 ) { 
__p+='\r\n\t<h4 class="znhg-option-title">\r\n\t\t'+
((__t=( name ))==null?'':__t)+
'\r\n\t</h4>\r\n';
 } 
__p+='\r\n';
 if( description.length > 0 ) { 
__p+='\r\n\t<div class="znhg-option-description">\r\n\t\t'+
((__t=( description ))==null?'':__t)+
'\r\n\t</div>\r\n';
 } 
__p+='\r\n<div class="znhg-option-content">\r\n\t<textarea id="znhg-control-id-'+
((__t=( id ))==null?'':__t)+
'" name="'+
((__t=( id ))==null?'':__t)+
'" value="'+
((__t=( value ))==null?'':__t)+
'"></textarea>\r\n</div>';
}
return __p;
};

},{}],9:[function(require,module,exports){
module.exports = Backbone.Model.extend({
	defaults: {
		id: 'generic-param',
		title: 'Generic Param',
		description: '',
		placeholder: '',
		type: 'text',
		default_value: "",
		value: '',
		dependency: null,
		live: null,
		isChanged : false, // if the option value was changed
		options: false, // for select option ?
		multiple : false, // only for select option ?
		alpha : false, // only for colorpicker option ?
		min: 0,
		max: 100,
		disabled: false,
		step: 1,
		subelements: []
	}
});
},{}],10:[function(require,module,exports){
module.exports = Backbone.Collection.extend( { model: require('./param-model') } );
},{"./param-model":9}],11:[function(require,module,exports){
window.znhg = window.znhg || {};

(function ($){
	var App = {};

	// Will hold a refference to all options types registered
	App.optionsType = {
		'text' : require('./views/options/text'),
		'textarea' : require('./views/options/textarea'),
		'select' : require('./views/options/select'),
		'colorpicker' : require('./views/options/colorpicker'),
		'slider' : require('./views/options/slider'),
		'group' : require('./views/options/group')
	};

	// Will hold a refference to all options types registered
	App.optionsDisplayType = {
		'default' : require('./views/options_display_type/default')
	};

	App.start = function(){
		return this;
	};


	/**
	 * Will register an option type
	 * @param  {string} optionId   The option type unique id
	 * @param  {object} optionView The option view.
	 */
	App.registerOption = function( optionId, optionView ){
		this.optionsType[optionId] = optionView;
	};


	/**
	 * Creates a backbone collection containing all the params. Can be used to easily access the params
	 * @param  {object} params The params object
	 * @return {object}        An instance of the controls collection
	 */
	App.setupParams = function( params ){
		var paramsCollection = require('./models/params-collection');
		return new paramsCollection(params);
	};


	/**
	 * Will unregister an option type
	 * @param  {string} optionId   The option type unique id
	 */
	App.unregisterOption = function(optionId){
		delete this.optionsType[optionId];
	};


	App.renderForm = function(){
		// Will rener a form that has saving capabilities
	};


	/**
	 * Will render an option group
	 * Unlike options forms, options group doesn't have saving capabilities
	 * @param  {object} params The params that needs to be rendered
	 * @return {string}        The HTML markup for the form
	 */
	App.renderOptionsGroup = function( controlsCollection ){
		var optionsGroupView = require('./views/forms/group');
		return new optionsGroupView({ collection : controlsCollection, controller : this }).render().$el;
	};

	znhg.optionsMachine = App.start();
}(jQuery));
},{"./models/params-collection":10,"./views/forms/group":12,"./views/options/colorpicker":14,"./views/options/group":15,"./views/options/select":17,"./views/options/slider":18,"./views/options/text":19,"./views/options/textarea":20,"./views/options_display_type/default":21}],12:[function(require,module,exports){
module.exports = Backbone.View.extend({
	className : 'znhg-options-group',
	initialize : function( options ){
		this.controller = options.controller;
	},
	render : function(){
		this.collection.each(function( param ){
			var optionType = param.get('type');
			if( typeof this.controller.optionsType[optionType] !== 'undefined' ){
				this.$el.append( new this.controller.optionsType[optionType]({model : param}).render().$el );
			}
			else{
				console.info('It seems that the "'+optionType+'" option type doesn\'t exists or it wasn\'t registered');
			}
		}.bind(this));

		return this;
	}
});
},{}],13:[function(require,module,exports){
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
},{}],14:[function(require,module,exports){
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
},{"../../html/colorpicker.html":1,"./base":13}],15:[function(require,module,exports){
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
},{"../../html/group.html":3,"./base":13,"./group_item":16}],16:[function(require,module,exports){
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
},{"../../html/group_item.html":4}],17:[function(require,module,exports){
var baseParam = require( './base' );
module.exports = baseParam.extend({
	template: require('../../html/select.html'),
});
},{"../../html/select.html":5,"./base":13}],18:[function(require,module,exports){
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
},{"../../html/slider.html":6,"./base":13}],19:[function(require,module,exports){
var baseParam = require( './base' );
module.exports = baseParam.extend({
	template: require('../../html/text.html'),
});
},{"../../html/text.html":7,"./base":13}],20:[function(require,module,exports){
var baseParam = require( './base' );
module.exports = baseParam.extend({
	template: require('../../html/textarea.html'),
});
},{"../../html/textarea.html":8,"./base":13}],21:[function(require,module,exports){
module.exports = Backbone.View.extend({

	template : require( '../../html/default_option_type_display.html' ),
	// className: 'znhg-option-container',
	initialize : function( options ){
		this.controller = options.controller;
	},
	render : function(){
		this.$el.html( this.template( this.model.toJSON() ) );
		this.$('.znhg-option-content').html( new this.controller.optionsType[this.model.get('type')]({model : this.model}).render().$el );
		return this;
	},
});
},{"../../html/default_option_type_display.html":2}]},{},[11])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJmcmFtZXdvcmsvYXNzZXRzL2pzL3NyYy9hZG1pbi9vcHRpb25zL2h0bWwvY29sb3JwaWNrZXIuaHRtbCIsImZyYW1ld29yay9hc3NldHMvanMvc3JjL2FkbWluL29wdGlvbnMvaHRtbC9kZWZhdWx0X29wdGlvbl90eXBlX2Rpc3BsYXkuaHRtbCIsImZyYW1ld29yay9hc3NldHMvanMvc3JjL2FkbWluL29wdGlvbnMvaHRtbC9ncm91cC5odG1sIiwiZnJhbWV3b3JrL2Fzc2V0cy9qcy9zcmMvYWRtaW4vb3B0aW9ucy9odG1sL3NlbGVjdC5odG1sIiwiZnJhbWV3b3JrL2Fzc2V0cy9qcy9zcmMvYWRtaW4vb3B0aW9ucy9odG1sL3NsaWRlci5odG1sIiwiZnJhbWV3b3JrL2Fzc2V0cy9qcy9zcmMvYWRtaW4vb3B0aW9ucy9odG1sL3RleHQuaHRtbCIsImZyYW1ld29yay9hc3NldHMvanMvc3JjL2FkbWluL29wdGlvbnMvaHRtbC90ZXh0YXJlYS5odG1sIiwiZnJhbWV3b3JrL2Fzc2V0cy9qcy9zcmMvYWRtaW4vb3B0aW9ucy9tb2RlbHMvcGFyYW0tbW9kZWwuanMiLCJmcmFtZXdvcmsvYXNzZXRzL2pzL3NyYy9hZG1pbi9vcHRpb25zL21vZGVscy9wYXJhbXMtY29sbGVjdGlvbi5qcyIsImZyYW1ld29yay9hc3NldHMvanMvc3JjL2FkbWluL29wdGlvbnMvb3B0aW9ucy5qcyIsImZyYW1ld29yay9hc3NldHMvanMvc3JjL2FkbWluL29wdGlvbnMvdmlld3MvZm9ybXMvZ3JvdXAuanMiLCJmcmFtZXdvcmsvYXNzZXRzL2pzL3NyYy9hZG1pbi9vcHRpb25zL3ZpZXdzL29wdGlvbnMvYmFzZS5qcyIsImZyYW1ld29yay9hc3NldHMvanMvc3JjL2FkbWluL29wdGlvbnMvdmlld3Mvb3B0aW9ucy9jb2xvcnBpY2tlci5qcyIsImZyYW1ld29yay9hc3NldHMvanMvc3JjL2FkbWluL29wdGlvbnMvdmlld3Mvb3B0aW9ucy9ncm91cC5qcyIsImZyYW1ld29yay9hc3NldHMvanMvc3JjL2FkbWluL29wdGlvbnMvdmlld3Mvb3B0aW9ucy9ncm91cF9pdGVtLmpzIiwiZnJhbWV3b3JrL2Fzc2V0cy9qcy9zcmMvYWRtaW4vb3B0aW9ucy92aWV3cy9vcHRpb25zL3NlbGVjdC5qcyIsImZyYW1ld29yay9hc3NldHMvanMvc3JjL2FkbWluL29wdGlvbnMvdmlld3Mvb3B0aW9ucy9zbGlkZXIuanMiLCJmcmFtZXdvcmsvYXNzZXRzL2pzL3NyYy9hZG1pbi9vcHRpb25zL3ZpZXdzL29wdGlvbnMvdGV4dC5qcyIsImZyYW1ld29yay9hc3NldHMvanMvc3JjL2FkbWluL29wdGlvbnMvdmlld3Mvb3B0aW9ucy90ZXh0YXJlYS5qcyIsImZyYW1ld29yay9hc3NldHMvanMvc3JjL2FkbWluL29wdGlvbnMvdmlld3Mvb3B0aW9uc19kaXNwbGF5X3R5cGUvZGVmYXVsdC5qcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQTtBQ0FBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FDL0JBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQ2ZBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7Ozs7QUMvQkE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUN4Q0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUN6QkE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUMvQkE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUN6QkE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FDckJBOztBQ0FBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQ3hFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUNsQkE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FDMUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUNkQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUM5QkE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FDckJBO0FBQ0E7QUFDQTtBQUNBOztBQ0hBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQ3ZDQTtBQUNBO0FBQ0E7QUFDQTs7QUNIQTtBQUNBO0FBQ0E7QUFDQTs7QUNIQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSIsImZpbGUiOiJnZW5lcmF0ZWQuanMiLCJzb3VyY2VSb290IjoiIiwic291cmNlc0NvbnRlbnQiOlsiKGZ1bmN0aW9uIGUodCxuLHIpe2Z1bmN0aW9uIHMobyx1KXtpZighbltvXSl7aWYoIXRbb10pe3ZhciBhPXR5cGVvZiByZXF1aXJlPT1cImZ1bmN0aW9uXCImJnJlcXVpcmU7aWYoIXUmJmEpcmV0dXJuIGEobywhMCk7aWYoaSlyZXR1cm4gaShvLCEwKTt2YXIgZj1uZXcgRXJyb3IoXCJDYW5ub3QgZmluZCBtb2R1bGUgJ1wiK28rXCInXCIpO3Rocm93IGYuY29kZT1cIk1PRFVMRV9OT1RfRk9VTkRcIixmfXZhciBsPW5bb109e2V4cG9ydHM6e319O3Rbb11bMF0uY2FsbChsLmV4cG9ydHMsZnVuY3Rpb24oZSl7dmFyIG49dFtvXVsxXVtlXTtyZXR1cm4gcyhuP246ZSl9LGwsbC5leHBvcnRzLGUsdCxuLHIpfXJldHVybiBuW29dLmV4cG9ydHN9dmFyIGk9dHlwZW9mIHJlcXVpcmU9PVwiZnVuY3Rpb25cIiYmcmVxdWlyZTtmb3IodmFyIG89MDtvPHIubGVuZ3RoO28rKylzKHJbb10pO3JldHVybiBzfSkiLCJtb2R1bGUuZXhwb3J0cyA9IGZ1bmN0aW9uKG9iail7XG52YXIgX190LF9fcD0nJyxfX2o9QXJyYXkucHJvdG90eXBlLmpvaW4scHJpbnQ9ZnVuY3Rpb24oKXtfX3ArPV9fai5jYWxsKGFyZ3VtZW50cywnJyk7fTtcbndpdGgob2JqfHx7fSl7XG5fX3ArPScnO1xuIGlmKCBuYW1lLmxlbmd0aCA+IDAgKSB7IFxuX19wKz0nXFxyXFxuXFx0PGg0IGNsYXNzPVwiem5oZy1vcHRpb24tdGl0bGVcIj5cXHJcXG5cXHRcXHQnK1xuKChfX3Q9KCBuYW1lICkpPT1udWxsPycnOl9fdCkrXG4nXFxyXFxuXFx0PC9oND5cXHJcXG4nO1xuIH0gXG5fX3ArPSdcXHJcXG4nO1xuIGlmKCBkZXNjcmlwdGlvbi5sZW5ndGggPiAwICkgeyBcbl9fcCs9J1xcclxcblxcdDxkaXYgY2xhc3M9XCJ6bmhnLW9wdGlvbi1kZXNjcmlwdGlvblwiPlxcclxcblxcdFxcdCcrXG4oKF9fdD0oIGRlc2NyaXB0aW9uICkpPT1udWxsPycnOl9fdCkrXG4nXFxyXFxuXFx0PC9kaXY+XFxyXFxuJztcbiB9IFxuX19wKz0nXFxyXFxuPGRpdiBjbGFzcz1cInpuaGctb3B0aW9uLWNvbnRlbnRcIj5cXHJcXG5cXHQ8ZGl2IGNsYXNzPVwiaW5wdXQtYXBwZW5kIGNvbG9yXCI+XFxyXFxuXFx0XFx0PGlucHV0IGlkPVwiem5oZy1jb250cm9sLWlkLScrXG4oKF9fdD0oIGlkICkpPT1udWxsPycnOl9fdCkrXG4nXCIgdHlwZT1cInRleHRcIiBjbGFzcz1cInpuaGctY29sb3ItcGlja2VyXCIgZGF0YS1kZWZhdWx0LWNvbG9yPVwiJytcbigoX190PSggdmFsdWUgKSk9PW51bGw/Jyc6X190KStcbidcIiBuYW1lPVwiJytcbigoX190PSggaWQgKSk9PW51bGw/Jyc6X190KStcbidcIiAnO1xuIGlmKCBhbHBoYSApIHsgXG5fX3ArPScgZGF0YS1hbHBoYT1cInRydWVcIiAnO1xuIH0gXG5fX3ArPScgdmFsdWU9XCInK1xuKChfX3Q9KCB2YWx1ZSApKT09bnVsbD8nJzpfX3QpK1xuJ1wiID5cXHJcXG5cXHQ8L2Rpdj5cXHJcXG48L2Rpdj4nO1xufVxucmV0dXJuIF9fcDtcbn07XG4iLCJtb2R1bGUuZXhwb3J0cyA9IGZ1bmN0aW9uKG9iail7XG52YXIgX190LF9fcD0nJyxfX2o9QXJyYXkucHJvdG90eXBlLmpvaW4scHJpbnQ9ZnVuY3Rpb24oKXtfX3ArPV9fai5jYWxsKGFyZ3VtZW50cywnJyk7fTtcbndpdGgob2JqfHx7fSl7XG5fX3ArPSc8ZGl2IGNsYXNzPVwiem5oZy1vcHRpb24tY29udGFpbmVyXCI+XFxyXFxuXFx0JztcbiBpZiggbmFtZS5sZW5ndGggPiAwICkgeyBcbl9fcCs9J1xcclxcblxcdFxcdHRoaXMgaXMgdGhlIG5hbWVcXHJcXG5cXHQnO1xuIH0gXG5fX3ArPSdcXHJcXG5cXHQnO1xuIGlmKCBkZXNjcmlwdGlvbi5sZW5ndGggPiAwICkgeyBcbl9fcCs9J1xcclxcblxcdFxcdHRoaXMgaXMgdGhlIGRlc2NyaXB0aW9uXFxyXFxuXFx0JztcbiB9IFxuX19wKz0nXFxyXFxuXFx0PGRpdiBjbGFzcz1cInpuaGctb3B0aW9uLWNvbnRlbnRcIj48L2Rpdj5cXHJcXG48L2Rpdj4nO1xufVxucmV0dXJuIF9fcDtcbn07XG4iLCJtb2R1bGUuZXhwb3J0cyA9IGZ1bmN0aW9uKG9iail7XG52YXIgX190LF9fcD0nJyxfX2o9QXJyYXkucHJvdG90eXBlLmpvaW4scHJpbnQ9ZnVuY3Rpb24oKXtfX3ArPV9fai5jYWxsKGFyZ3VtZW50cywnJyk7fTtcbndpdGgob2JqfHx7fSl7XG5fX3ArPScnO1xuIGlmKCBuYW1lLmxlbmd0aCA+IDAgKSB7IFxuX19wKz0nXFxyXFxuXFx0PGg0IGNsYXNzPVwiem5oZy1vcHRpb24tdGl0bGVcIj5cXHJcXG5cXHRcXHQnK1xuKChfX3Q9KCBuYW1lICkpPT1udWxsPycnOl9fdCkrXG4nXFxyXFxuXFx0PC9oND5cXHJcXG4nO1xuIH0gXG5fX3ArPSdcXHJcXG4nO1xuIGlmKCBkZXNjcmlwdGlvbi5sZW5ndGggPiAwICkgeyBcbl9fcCs9J1xcclxcblxcdDxkaXYgY2xhc3M9XCJ6bmhnLW9wdGlvbi1kZXNjcmlwdGlvblwiPlxcclxcblxcdFxcdCcrXG4oKF9fdD0oIGRlc2NyaXB0aW9uICkpPT1udWxsPycnOl9fdCkrXG4nXFxyXFxuXFx0PC9kaXY+XFxyXFxuJztcbiB9IFxuX19wKz0nXFxyXFxuPGRpdiBjbGFzcz1cInpuaGctb3B0aW9uLWNvbnRlbnRcIj5cXHJcXG5cXHQ8ZGl2IGNsYXNzPVwiem5oZy1ncm91cC1vcHRpb24tY29udGFpbmVyXCI+PC9kaXY+XFxyXFxuXFx0PGRpdiBjbGFzcz1cInpuaGctZ3JvdXAtb3B0aW9uLWFkZFwiPkFkZCBtb3JlPC9kaXY+XFxyXFxuXFx0PCEtLSA8aW5wdXQgdHlwZT1cInRleHRcIiBuYW1lPVwiJytcbigoX190PSggaWQgKSk9PW51bGw/Jyc6X190KStcbidcIiBpZD1cInpuaGctY29udHJvbC1pZC0nK1xuKChfX3Q9KCBpZCApKT09bnVsbD8nJzpfX3QpK1xuJ1wiIHZhbHVlPVwiJytcbigoX190PSggdmFsdWUgKSk9PW51bGw/Jyc6X190KStcbidcIiAnO1xuIGlmKCBwbGFjZWhvbGRlci5sZW5ndGggPiAwICkgeyBcbl9fcCs9JyBwbGFjZWhvbGRlcj1cIicrXG4oKF9fdD0oIHBsYWNlaG9sZGVyICkpPT1udWxsPycnOl9fdCkrXG4nXCIgJztcbiB9IFxuX19wKz0nPiAtLT5cXHJcXG48L2Rpdj4nO1xufVxucmV0dXJuIF9fcDtcbn07XG4iLCJtb2R1bGUuZXhwb3J0cyA9IGZ1bmN0aW9uKG9iail7XG52YXIgX190LF9fcD0nJyxfX2o9QXJyYXkucHJvdG90eXBlLmpvaW4scHJpbnQ9ZnVuY3Rpb24oKXtfX3ArPV9fai5jYWxsKGFyZ3VtZW50cywnJyk7fTtcbndpdGgob2JqfHx7fSl7XG5fX3ArPScnO1xuIGlmKCBuYW1lLmxlbmd0aCA+IDAgKSB7IFxuX19wKz0nXFxyXFxuXFx0PGg0IGNsYXNzPVwiem5oZy1vcHRpb24tdGl0bGVcIj5cXHJcXG5cXHRcXHQnK1xuKChfX3Q9KCBuYW1lICkpPT1udWxsPycnOl9fdCkrXG4nXFxyXFxuXFx0PC9oND5cXHJcXG4nO1xuIH0gXG5fX3ArPSdcXHJcXG4nO1xuIGlmKCBkZXNjcmlwdGlvbi5sZW5ndGggPiAwICkgeyBcbl9fcCs9J1xcclxcblxcdDxkaXYgY2xhc3M9XCJ6bmhnLW9wdGlvbi1kZXNjcmlwdGlvblwiPlxcclxcblxcdFxcdCcrXG4oKF9fdD0oIGRlc2NyaXB0aW9uICkpPT1udWxsPycnOl9fdCkrXG4nXFxyXFxuXFx0PC9kaXY+XFxyXFxuJztcbiB9IFxuX19wKz0nXFxyXFxuPGRpdiBjbGFzcz1cInpuaGctb3B0aW9uLWNvbnRlbnRcIj5cXHJcXG5cXHQ8c2VsZWN0IG5hbWU9XCInK1xuKChfX3Q9KCBpZCApKT09bnVsbD8nJzpfX3QpK1xuJ1wiIGlkPVwiem5oZy1jb250cm9sLWlkLScrXG4oKF9fdD0oIGlkICkpPT1udWxsPycnOl9fdCkrXG4nXCIgJztcbiBpZiggbXVsdGlwbGUgKSB7IFxuX19wKz0nIG11bHRpcGxlICc7XG4gfSBcbl9fcCs9Jz5cXHJcXG5cXHRcXHQ8IS0tIDxvcHRpb24gdmFsdWU9XCJ2b2x2b1wiPlZvbHZvPC9vcHRpb24+IC0tPlxcclxcblxcdFxcdCc7XG4gXy5lYWNoKG9wdGlvbnMsIGZ1bmN0aW9uKG5hbWUsIGlkKSB7XHJcblx0XHRcdHZhciBzZWxlY3RlZCA9IF8uaXNBcnJheSh2YWx1ZSkgPyBfLmluZGV4T2YoIHZhbHVlLCBpZCApIDogdmFsdWUgPT0gaWQsXHJcblx0XHRcdFx0c2VsZWN0ZWRTdHJpbmcgPSBzZWxlY3RlZCA/ICdzZWxlY3RlZCcgOiAnJztcclxuXHRcdFxuX19wKz0nXFxyXFxuXFx0XFx0XFx0PG9wdGlvbiB2YWx1ZT1cIicrXG4oKF9fdD0oIGlkICkpPT1udWxsPycnOl9fdCkrXG4nXCIgJytcbigoX190PSggc2VsZWN0ZWRTdHJpbmcgKSk9PW51bGw/Jyc6X190KStcbic+JytcbigoX190PSggbmFtZSApKT09bnVsbD8nJzpfX3QpK1xuJzwvb3B0aW9uPlxcclxcblxcdFxcdCc7XG4gfSk7IFxuX19wKz0nXFxyXFxuXFx0PC9zZWxlY3Q+XFxyXFxuPC9kaXY+Jztcbn1cbnJldHVybiBfX3A7XG59O1xuIiwibW9kdWxlLmV4cG9ydHMgPSBmdW5jdGlvbihvYmope1xudmFyIF9fdCxfX3A9JycsX19qPUFycmF5LnByb3RvdHlwZS5qb2luLHByaW50PWZ1bmN0aW9uKCl7X19wKz1fX2ouY2FsbChhcmd1bWVudHMsJycpO307XG53aXRoKG9ianx8e30pe1xuX19wKz0nJztcbiBpZiggbmFtZS5sZW5ndGggPiAwICkgeyBcbl9fcCs9J1xcclxcblxcdDxoNCBjbGFzcz1cInpuaGctb3B0aW9uLXRpdGxlXCI+XFxyXFxuXFx0XFx0JytcbigoX190PSggbmFtZSApKT09bnVsbD8nJzpfX3QpK1xuJ1xcclxcblxcdDwvaDQ+XFxyXFxuJztcbiB9IFxuX19wKz0nXFxyXFxuJztcbiBpZiggZGVzY3JpcHRpb24ubGVuZ3RoID4gMCApIHsgXG5fX3ArPSdcXHJcXG5cXHQ8ZGl2IGNsYXNzPVwiem5oZy1vcHRpb24tZGVzY3JpcHRpb25cIj5cXHJcXG5cXHRcXHQnK1xuKChfX3Q9KCBkZXNjcmlwdGlvbiApKT09bnVsbD8nJzpfX3QpK1xuJ1xcclxcblxcdDwvZGl2Plxcclxcbic7XG4gfSBcbl9fcCs9J1xcclxcbjxkaXYgY2xhc3M9XCJ6bmhnLW9wdGlvbi1jb250ZW50XCI+XFxyXFxuXFx0PGRpdiBjbGFzcz1cInpuX3NsaWRlclwiPlxcclxcblxcdFxcdDxpbnB1dCBpZD1cInpuaGctY29udHJvbC1pZC0nK1xuKChfX3Q9KCBpZCApKT09bnVsbD8nJzpfX3QpK1xuJ1wiIHR5cGU9XCJudW1iZXJcIiBjbGFzcz1cIndwLXNsaWRlci1pbnB1dFwiIG5hbWU9XCInK1xuKChfX3Q9KCBpZCApKT09bnVsbD8nJzpfX3QpK1xuJ1wiIHZhbHVlPVwiJytcbigoX190PSggcGFyc2VJbnQodmFsdWUpICkpPT1udWxsPycnOl9fdCkrXG4nXCI+XFxyXFxuXFx0XFx0PGRpdiBjbGFzcz1cIndwLXNsaWRlciB6bmhnLXNsaWRlci1jb250cm9sXCI+PC9kaXY+XFxyXFxuXFx0PC9kaXY+XFxyXFxuPC9kaXY+Jztcbn1cbnJldHVybiBfX3A7XG59O1xuIiwibW9kdWxlLmV4cG9ydHMgPSBmdW5jdGlvbihvYmope1xudmFyIF9fdCxfX3A9JycsX19qPUFycmF5LnByb3RvdHlwZS5qb2luLHByaW50PWZ1bmN0aW9uKCl7X19wKz1fX2ouY2FsbChhcmd1bWVudHMsJycpO307XG53aXRoKG9ianx8e30pe1xuX19wKz0nJztcbiBpZiggbmFtZS5sZW5ndGggPiAwICkgeyBcbl9fcCs9J1xcclxcblxcdDxoNCBjbGFzcz1cInpuaGctb3B0aW9uLXRpdGxlXCI+XFxyXFxuXFx0XFx0JytcbigoX190PSggbmFtZSApKT09bnVsbD8nJzpfX3QpK1xuJ1xcclxcblxcdDwvaDQ+XFxyXFxuJztcbiB9IFxuX19wKz0nXFxyXFxuJztcbiBpZiggZGVzY3JpcHRpb24ubGVuZ3RoID4gMCApIHsgXG5fX3ArPSdcXHJcXG5cXHQ8ZGl2IGNsYXNzPVwiem5oZy1vcHRpb24tZGVzY3JpcHRpb25cIj5cXHJcXG5cXHRcXHQnK1xuKChfX3Q9KCBkZXNjcmlwdGlvbiApKT09bnVsbD8nJzpfX3QpK1xuJ1xcclxcblxcdDwvZGl2Plxcclxcbic7XG4gfSBcbl9fcCs9J1xcclxcbjxkaXYgY2xhc3M9XCJ6bmhnLW9wdGlvbi1jb250ZW50XCI+XFxyXFxuXFx0PGlucHV0IHR5cGU9XCJ0ZXh0XCIgbmFtZT1cIicrXG4oKF9fdD0oIGlkICkpPT1udWxsPycnOl9fdCkrXG4nXCIgaWQ9XCJ6bmhnLWNvbnRyb2wtaWQtJytcbigoX190PSggaWQgKSk9PW51bGw/Jyc6X190KStcbidcIiB2YWx1ZT1cIicrXG4oKF9fdD0oIHZhbHVlICkpPT1udWxsPycnOl9fdCkrXG4nXCIgJztcbiBpZiggcGxhY2Vob2xkZXIubGVuZ3RoID4gMCApIHsgXG5fX3ArPScgcGxhY2Vob2xkZXI9XCInK1xuKChfX3Q9KCBwbGFjZWhvbGRlciApKT09bnVsbD8nJzpfX3QpK1xuJ1wiICc7XG4gfSBcbl9fcCs9Jz5cXHJcXG48L2Rpdj4nO1xufVxucmV0dXJuIF9fcDtcbn07XG4iLCJtb2R1bGUuZXhwb3J0cyA9IGZ1bmN0aW9uKG9iail7XG52YXIgX190LF9fcD0nJyxfX2o9QXJyYXkucHJvdG90eXBlLmpvaW4scHJpbnQ9ZnVuY3Rpb24oKXtfX3ArPV9fai5jYWxsKGFyZ3VtZW50cywnJyk7fTtcbndpdGgob2JqfHx7fSl7XG5fX3ArPScnO1xuIGlmKCBuYW1lLmxlbmd0aCA+IDAgKSB7IFxuX19wKz0nXFxyXFxuXFx0PGg0IGNsYXNzPVwiem5oZy1vcHRpb24tdGl0bGVcIj5cXHJcXG5cXHRcXHQnK1xuKChfX3Q9KCBuYW1lICkpPT1udWxsPycnOl9fdCkrXG4nXFxyXFxuXFx0PC9oND5cXHJcXG4nO1xuIH0gXG5fX3ArPSdcXHJcXG4nO1xuIGlmKCBkZXNjcmlwdGlvbi5sZW5ndGggPiAwICkgeyBcbl9fcCs9J1xcclxcblxcdDxkaXYgY2xhc3M9XCJ6bmhnLW9wdGlvbi1kZXNjcmlwdGlvblwiPlxcclxcblxcdFxcdCcrXG4oKF9fdD0oIGRlc2NyaXB0aW9uICkpPT1udWxsPycnOl9fdCkrXG4nXFxyXFxuXFx0PC9kaXY+XFxyXFxuJztcbiB9IFxuX19wKz0nXFxyXFxuPGRpdiBjbGFzcz1cInpuaGctb3B0aW9uLWNvbnRlbnRcIj5cXHJcXG5cXHQ8dGV4dGFyZWEgaWQ9XCJ6bmhnLWNvbnRyb2wtaWQtJytcbigoX190PSggaWQgKSk9PW51bGw/Jyc6X190KStcbidcIiBuYW1lPVwiJytcbigoX190PSggaWQgKSk9PW51bGw/Jyc6X190KStcbidcIiB2YWx1ZT1cIicrXG4oKF9fdD0oIHZhbHVlICkpPT1udWxsPycnOl9fdCkrXG4nXCI+PC90ZXh0YXJlYT5cXHJcXG48L2Rpdj4nO1xufVxucmV0dXJuIF9fcDtcbn07XG4iLCJtb2R1bGUuZXhwb3J0cyA9IEJhY2tib25lLk1vZGVsLmV4dGVuZCh7XHJcblx0ZGVmYXVsdHM6IHtcclxuXHRcdGlkOiAnZ2VuZXJpYy1wYXJhbScsXHJcblx0XHR0aXRsZTogJ0dlbmVyaWMgUGFyYW0nLFxyXG5cdFx0ZGVzY3JpcHRpb246ICcnLFxyXG5cdFx0cGxhY2Vob2xkZXI6ICcnLFxyXG5cdFx0dHlwZTogJ3RleHQnLFxyXG5cdFx0ZGVmYXVsdF92YWx1ZTogXCJcIixcclxuXHRcdHZhbHVlOiAnJyxcclxuXHRcdGRlcGVuZGVuY3k6IG51bGwsXHJcblx0XHRsaXZlOiBudWxsLFxyXG5cdFx0aXNDaGFuZ2VkIDogZmFsc2UsIC8vIGlmIHRoZSBvcHRpb24gdmFsdWUgd2FzIGNoYW5nZWRcclxuXHRcdG9wdGlvbnM6IGZhbHNlLCAvLyBmb3Igc2VsZWN0IG9wdGlvbiA/XHJcblx0XHRtdWx0aXBsZSA6IGZhbHNlLCAvLyBvbmx5IGZvciBzZWxlY3Qgb3B0aW9uID9cclxuXHRcdGFscGhhIDogZmFsc2UsIC8vIG9ubHkgZm9yIGNvbG9ycGlja2VyIG9wdGlvbiA/XHJcblx0XHRtaW46IDAsXHJcblx0XHRtYXg6IDEwMCxcclxuXHRcdGRpc2FibGVkOiBmYWxzZSxcclxuXHRcdHN0ZXA6IDEsXHJcblx0XHRzdWJlbGVtZW50czogW11cclxuXHR9XHJcbn0pOyIsIm1vZHVsZS5leHBvcnRzID0gQmFja2JvbmUuQ29sbGVjdGlvbi5leHRlbmQoIHsgbW9kZWw6IHJlcXVpcmUoJy4vcGFyYW0tbW9kZWwnKSB9ICk7Iiwid2luZG93LnpuaGcgPSB3aW5kb3cuem5oZyB8fCB7fTtcclxuXHJcbihmdW5jdGlvbiAoJCl7XHJcblx0dmFyIEFwcCA9IHt9O1xyXG5cclxuXHQvLyBXaWxsIGhvbGQgYSByZWZmZXJlbmNlIHRvIGFsbCBvcHRpb25zIHR5cGVzIHJlZ2lzdGVyZWRcclxuXHRBcHAub3B0aW9uc1R5cGUgPSB7XHJcblx0XHQndGV4dCcgOiByZXF1aXJlKCcuL3ZpZXdzL29wdGlvbnMvdGV4dCcpLFxyXG5cdFx0J3RleHRhcmVhJyA6IHJlcXVpcmUoJy4vdmlld3Mvb3B0aW9ucy90ZXh0YXJlYScpLFxyXG5cdFx0J3NlbGVjdCcgOiByZXF1aXJlKCcuL3ZpZXdzL29wdGlvbnMvc2VsZWN0JyksXHJcblx0XHQnY29sb3JwaWNrZXInIDogcmVxdWlyZSgnLi92aWV3cy9vcHRpb25zL2NvbG9ycGlja2VyJyksXHJcblx0XHQnc2xpZGVyJyA6IHJlcXVpcmUoJy4vdmlld3Mvb3B0aW9ucy9zbGlkZXInKSxcclxuXHRcdCdncm91cCcgOiByZXF1aXJlKCcuL3ZpZXdzL29wdGlvbnMvZ3JvdXAnKVxyXG5cdH07XHJcblxyXG5cdC8vIFdpbGwgaG9sZCBhIHJlZmZlcmVuY2UgdG8gYWxsIG9wdGlvbnMgdHlwZXMgcmVnaXN0ZXJlZFxyXG5cdEFwcC5vcHRpb25zRGlzcGxheVR5cGUgPSB7XHJcblx0XHQnZGVmYXVsdCcgOiByZXF1aXJlKCcuL3ZpZXdzL29wdGlvbnNfZGlzcGxheV90eXBlL2RlZmF1bHQnKVxyXG5cdH07XHJcblxyXG5cdEFwcC5zdGFydCA9IGZ1bmN0aW9uKCl7XHJcblx0XHRyZXR1cm4gdGhpcztcclxuXHR9O1xyXG5cclxuXHJcblx0LyoqXHJcblx0ICogV2lsbCByZWdpc3RlciBhbiBvcHRpb24gdHlwZVxyXG5cdCAqIEBwYXJhbSAge3N0cmluZ30gb3B0aW9uSWQgICBUaGUgb3B0aW9uIHR5cGUgdW5pcXVlIGlkXHJcblx0ICogQHBhcmFtICB7b2JqZWN0fSBvcHRpb25WaWV3IFRoZSBvcHRpb24gdmlldy5cclxuXHQgKi9cclxuXHRBcHAucmVnaXN0ZXJPcHRpb24gPSBmdW5jdGlvbiggb3B0aW9uSWQsIG9wdGlvblZpZXcgKXtcclxuXHRcdHRoaXMub3B0aW9uc1R5cGVbb3B0aW9uSWRdID0gb3B0aW9uVmlldztcclxuXHR9O1xyXG5cclxuXHJcblx0LyoqXHJcblx0ICogQ3JlYXRlcyBhIGJhY2tib25lIGNvbGxlY3Rpb24gY29udGFpbmluZyBhbGwgdGhlIHBhcmFtcy4gQ2FuIGJlIHVzZWQgdG8gZWFzaWx5IGFjY2VzcyB0aGUgcGFyYW1zXHJcblx0ICogQHBhcmFtICB7b2JqZWN0fSBwYXJhbXMgVGhlIHBhcmFtcyBvYmplY3RcclxuXHQgKiBAcmV0dXJuIHtvYmplY3R9ICAgICAgICBBbiBpbnN0YW5jZSBvZiB0aGUgY29udHJvbHMgY29sbGVjdGlvblxyXG5cdCAqL1xyXG5cdEFwcC5zZXR1cFBhcmFtcyA9IGZ1bmN0aW9uKCBwYXJhbXMgKXtcclxuXHRcdHZhciBwYXJhbXNDb2xsZWN0aW9uID0gcmVxdWlyZSgnLi9tb2RlbHMvcGFyYW1zLWNvbGxlY3Rpb24nKTtcclxuXHRcdHJldHVybiBuZXcgcGFyYW1zQ29sbGVjdGlvbihwYXJhbXMpO1xyXG5cdH07XHJcblxyXG5cclxuXHQvKipcclxuXHQgKiBXaWxsIHVucmVnaXN0ZXIgYW4gb3B0aW9uIHR5cGVcclxuXHQgKiBAcGFyYW0gIHtzdHJpbmd9IG9wdGlvbklkICAgVGhlIG9wdGlvbiB0eXBlIHVuaXF1ZSBpZFxyXG5cdCAqL1xyXG5cdEFwcC51bnJlZ2lzdGVyT3B0aW9uID0gZnVuY3Rpb24ob3B0aW9uSWQpe1xyXG5cdFx0ZGVsZXRlIHRoaXMub3B0aW9uc1R5cGVbb3B0aW9uSWRdO1xyXG5cdH07XHJcblxyXG5cclxuXHRBcHAucmVuZGVyRm9ybSA9IGZ1bmN0aW9uKCl7XHJcblx0XHQvLyBXaWxsIHJlbmVyIGEgZm9ybSB0aGF0IGhhcyBzYXZpbmcgY2FwYWJpbGl0aWVzXHJcblx0fTtcclxuXHJcblxyXG5cdC8qKlxyXG5cdCAqIFdpbGwgcmVuZGVyIGFuIG9wdGlvbiBncm91cFxyXG5cdCAqIFVubGlrZSBvcHRpb25zIGZvcm1zLCBvcHRpb25zIGdyb3VwIGRvZXNuJ3QgaGF2ZSBzYXZpbmcgY2FwYWJpbGl0aWVzXHJcblx0ICogQHBhcmFtICB7b2JqZWN0fSBwYXJhbXMgVGhlIHBhcmFtcyB0aGF0IG5lZWRzIHRvIGJlIHJlbmRlcmVkXHJcblx0ICogQHJldHVybiB7c3RyaW5nfSAgICAgICAgVGhlIEhUTUwgbWFya3VwIGZvciB0aGUgZm9ybVxyXG5cdCAqL1xyXG5cdEFwcC5yZW5kZXJPcHRpb25zR3JvdXAgPSBmdW5jdGlvbiggY29udHJvbHNDb2xsZWN0aW9uICl7XHJcblx0XHR2YXIgb3B0aW9uc0dyb3VwVmlldyA9IHJlcXVpcmUoJy4vdmlld3MvZm9ybXMvZ3JvdXAnKTtcclxuXHRcdHJldHVybiBuZXcgb3B0aW9uc0dyb3VwVmlldyh7IGNvbGxlY3Rpb24gOiBjb250cm9sc0NvbGxlY3Rpb24sIGNvbnRyb2xsZXIgOiB0aGlzIH0pLnJlbmRlcigpLiRlbDtcclxuXHR9O1xyXG5cclxuXHR6bmhnLm9wdGlvbnNNYWNoaW5lID0gQXBwLnN0YXJ0KCk7XHJcbn0oalF1ZXJ5KSk7IiwibW9kdWxlLmV4cG9ydHMgPSBCYWNrYm9uZS5WaWV3LmV4dGVuZCh7XHJcblx0Y2xhc3NOYW1lIDogJ3puaGctb3B0aW9ucy1ncm91cCcsXHJcblx0aW5pdGlhbGl6ZSA6IGZ1bmN0aW9uKCBvcHRpb25zICl7XHJcblx0XHR0aGlzLmNvbnRyb2xsZXIgPSBvcHRpb25zLmNvbnRyb2xsZXI7XHJcblx0fSxcclxuXHRyZW5kZXIgOiBmdW5jdGlvbigpe1xyXG5cdFx0dGhpcy5jb2xsZWN0aW9uLmVhY2goZnVuY3Rpb24oIHBhcmFtICl7XHJcblx0XHRcdHZhciBvcHRpb25UeXBlID0gcGFyYW0uZ2V0KCd0eXBlJyk7XHJcblx0XHRcdGlmKCB0eXBlb2YgdGhpcy5jb250cm9sbGVyLm9wdGlvbnNUeXBlW29wdGlvblR5cGVdICE9PSAndW5kZWZpbmVkJyApe1xyXG5cdFx0XHRcdHRoaXMuJGVsLmFwcGVuZCggbmV3IHRoaXMuY29udHJvbGxlci5vcHRpb25zVHlwZVtvcHRpb25UeXBlXSh7bW9kZWwgOiBwYXJhbX0pLnJlbmRlcigpLiRlbCApO1xyXG5cdFx0XHR9XHJcblx0XHRcdGVsc2V7XHJcblx0XHRcdFx0Y29uc29sZS5pbmZvKCdJdCBzZWVtcyB0aGF0IHRoZSBcIicrb3B0aW9uVHlwZSsnXCIgb3B0aW9uIHR5cGUgZG9lc25cXCd0IGV4aXN0cyBvciBpdCB3YXNuXFwndCByZWdpc3RlcmVkJyk7XHJcblx0XHRcdH1cclxuXHRcdH0uYmluZCh0aGlzKSk7XHJcblxyXG5cdFx0cmV0dXJuIHRoaXM7XHJcblx0fVxyXG59KTsiLCJtb2R1bGUuZXhwb3J0cyA9IEJhY2tib25lLlZpZXcuZXh0ZW5kKHtcclxuXHRjbGFzc05hbWU6ICd6bmhnLW9wdGlvbi1jb250YWluZXInLFxyXG5cdHJlbmRlciA6IGZ1bmN0aW9uKCl7XHJcblx0XHR0aGlzLmNvbnRyb2xSZW5kZXIoKTtcclxuXHRcdHRoaXMuYWZ0ZXJSZW5kZXIoKTtcclxuXHRcdHRoaXMuYWN0aXZhdGVDb250cm9sKCk7XHJcblx0XHRyZXR1cm4gdGhpcztcclxuXHR9LFxyXG5cdGNvbnRyb2xSZW5kZXIgOiBmdW5jdGlvbigpe1xyXG5cdFx0dGhpcy4kZWwuYWRkQ2xhc3MoICd6bmhnLW9wdGlvbi10eXBlLScrIHRoaXMubW9kZWwuZ2V0KCd0eXBlJykgKTtcclxuXHRcdHRoaXMuJGVsLmh0bWwoIHRoaXMudGVtcGxhdGUoIHRoaXMubW9kZWwudG9KU09OKCkgKSApO1xyXG5cdFx0cmV0dXJuIHRoaXM7XHJcblx0fSxcclxuXHRhZnRlclJlbmRlcjogZnVuY3Rpb24oKXtcclxuXHRcdC8vIFRoaXMgc2hvdWxkIGJlIG92ZXJyaWRlIGJ5IHRoZSBjaGlsZCBjbGFzc1xyXG5cdFx0cmV0dXJuIHRoaXM7XHJcblx0fSxcclxuXHRhY3RpdmF0ZUNvbnRyb2wgOiBmdW5jdGlvbigpe1xyXG5cdFx0dmFyIHRoYXQgPSB0aGlzO1xyXG5cdFx0Ly8gSGVyZSB3ZSB3aWxsIGFjdGl2YXRlIGV4dHJhIGZ1bmN0aW9uYWxpdHkgZm9yIHRoaXMgcGFyYW1cclxuXHRcdHRoaXMuJCgnI3puaGctY29udHJvbC1pZC0nKyB0aGlzLm1vZGVsLmdldCgnaWQnKSApLm9uKCdjaGFuZ2UnLCBmdW5jdGlvbihlKXtcclxuXHRcdFx0dGhhdC5zZXRWYWx1ZSggalF1ZXJ5KHRoaXMpLnZhbCgpICk7XHJcblx0XHR9KTtcclxuXHR9LFxyXG5cdHNldFZhbHVlIDogZnVuY3Rpb24oIG5ld1ZhbHVlICl7XHJcblxyXG5cdFx0dmFyIG9sZFZhbHVlID0gdGhpcy5tb2RlbC5nZXQoJ3ZhbHVlJyk7XHJcblx0XHRuZXdWYWx1ZSA9IHRoaXMudmFsaWRhdGVWYWx1ZSggbmV3VmFsdWUgKTtcclxuXHJcblx0XHQvLyBXZSB3aWxsIHNldCB0aGUgdmFsdWUgaWYgaXQgdmFsaWRhdGVcclxuXHRcdGlmKCBudWxsICE9PSBuZXdWYWx1ZSAmJiBuZXdWYWx1ZSAhPT0gb2xkVmFsdWUgKXtcclxuXHRcdFx0dGhpcy5tb2RlbC5zZXQoJ3ZhbHVlJywgbmV3VmFsdWUpO1xyXG5cdFx0XHRpZiggdGhpcy5tb2RlbC5nZXQoJ3R5cGUnKSA9PSAnc2VsZWN0JyApe1xyXG5cdFx0XHRcdGNvbnNvbGUubG9nKG5ld1ZhbHVlKTtcclxuXHRcdFx0fVxyXG5cclxuXHRcdFx0dGhpcy5tb2RlbC5zZXQoICdpc0NoYW5nZWQnLCB0cnVlICk7XHJcblx0XHR9XHJcblx0fSxcclxuXHR2YWxpZGF0ZVZhbHVlIDogZnVuY3Rpb24oIHZhbHVlICl7XHJcblx0XHRyZXR1cm4gdmFsdWU7XHJcblx0fVxyXG59KTsiLCJ2YXIgYmFzZVBhcmFtID0gcmVxdWlyZSggJy4vYmFzZScgKTtcclxubW9kdWxlLmV4cG9ydHMgPSBiYXNlUGFyYW0uZXh0ZW5kKHtcclxuXHR0ZW1wbGF0ZTogcmVxdWlyZSgnLi4vLi4vaHRtbC9jb2xvcnBpY2tlci5odG1sJyksXHJcblx0cmVuZGVyIDogZnVuY3Rpb24oKXtcclxuXHRcdHRoaXMuY29udHJvbFJlbmRlcigpO1xyXG5cdFx0dGhpcy4kKCcuem5oZy1jb2xvci1waWNrZXInKS53cENvbG9yUGlja2VyKHtcclxuXHRcdFx0Y2hhbmdlOiB0aGlzLmNvbG9yQ2hhbmdlLmJpbmQodGhpcyksXHJcblx0XHRcdGRlZmF1bHRXaWR0aDogJzY1J1xyXG5cdFx0fSk7XHJcblx0XHRyZXR1cm4gdGhpcztcclxuXHR9LFxyXG5cdGNvbG9yQ2hhbmdlOiBmdW5jdGlvbihldmVudCwgdWkpe1xyXG5cdFx0dGhpcy5zZXRWYWx1ZSggdWkuY29sb3IudG9TdHJpbmcoKSApO1xyXG5cdH1cclxufSk7IiwidmFyIGJhc2VQYXJhbVZpZXcgPSByZXF1aXJlKCAnLi9iYXNlJyApO1xyXG52YXIgZ3JvdXBJdGVtVmlldyA9IHJlcXVpcmUoICcuL2dyb3VwX2l0ZW0nICk7XHJcbm1vZHVsZS5leHBvcnRzID0gYmFzZVBhcmFtVmlldy5leHRlbmQoe1xyXG5cdHRlbXBsYXRlOiByZXF1aXJlKCcuLi8uLi9odG1sL2dyb3VwLmh0bWwnKSxcclxuXHRhZnRlclJlbmRlcjogZnVuY3Rpb24oKXtcclxuXHJcblx0XHR0aGlzLml0ZW1zQ29udGFpbmVyID0gdGhpcy4kKCcuem5oZy1ncm91cC1vcHRpb24tY29udGFpbmVyJyk7XHJcblxyXG5cdFx0Ly8gQ2hlY2sgaWYgd2UgaGF2ZSBzYXZlZCB2YWx1ZXNcclxuXHRcdHZhciB2YWx1ZXMgPSB0aGlzLm1vZGVsLmdldCgndmFsdWUnKTtcclxuXHRcdGlmICh2YWx1ZXMubGVuZ3RoKSB7XHJcblx0XHRcdF8uZWFjaCh2YWx1ZXMsIGZ1bmN0aW9uKGl0ZW1WYWx1ZSkge1xyXG5cdFx0XHRcdHRoaXMuYWRkSXRlbShpdGVtVmFsdWUpO1xyXG5cdFx0XHR9LmJpbmQodGhpcykpO1xyXG5cdFx0fVxyXG5cclxuXHRcdHJldHVybiB0aGlzO1xyXG5cdH0sXHJcblx0YWRkSXRlbTogZnVuY3Rpb24oIGdyb3VwSXRlbSApe1xyXG5cdFx0dmFyIHBhcmFtc0NvbGxlY3Rpb24gPSB6bmhnLm9wdGlvbnNNYWNoaW5lLnNldHVwUGFyYW1zKCB0aGlzLm1vZGVsLmdldCgnc3ViZWxlbWVudHMnKSApO1xyXG5cclxuXHRcdHZhciBpdGVtID0gbmV3IGdyb3VwSXRlbVZpZXcoe1xyXG5cdFx0XHR2YWx1ZXMgOiBncm91cEl0ZW0sXHJcblx0XHRcdGNvbGxlY3Rpb246IHBhcmFtc0NvbGxlY3Rpb25cclxuXHRcdH0pLnJlbmRlcigpO1xyXG5cclxuXHRcdHRoaXMuaXRlbXNDb250YWluZXIuYXBwZW5kKGl0ZW0uJGVsKTtcclxuXHJcblx0XHRyZXR1cm4gdGhpcztcclxuXHR9XHJcbn0pOyIsIm1vZHVsZS5leHBvcnRzID0gQmFja2JvbmUuVmlldy5leHRlbmQoe1xyXG5cdHRlbXBsYXRlOiByZXF1aXJlKCcuLi8uLi9odG1sL2dyb3VwX2l0ZW0uaHRtbCcpLFxyXG5cdGluaXRpYWxpemU6IGZ1bmN0aW9uKG9wdGlvbnMpe1xyXG5cdFx0dGhpcy52YWx1ZXMgPSBvcHRpb25zLnZhbHVlcztcclxuXHJcblx0fSxcclxuXHRyZW5kZXI6IGZ1bmN0aW9uKCl7XHJcblx0XHR0aGlzLnNldFZhbHVlcygpO1xyXG5cdFx0dmFyIGZvcm0gPSB6bmhnLm9wdGlvbnNNYWNoaW5lLnJlbmRlck9wdGlvbnNHcm91cCh0aGlzLmNvbGxlY3Rpb24pO1xyXG5cdFx0dGhpcy4kZWwuaHRtbCggZm9ybSApO1xyXG5cdFx0cmV0dXJuIHRoaXM7XHJcblx0fSxcclxuXHQvLyBJZiB3ZSBoYXZlIHNhdmVkIHZhbHVlcywgd2Ugc2hvdWxkIGFkZCB0aGVtIHRvIHRoZSBvcHRpb25cclxuXHRzZXRWYWx1ZXM6IGZ1bmN0aW9uKCl7XHJcblx0XHR0aGlzLmNvbGxlY3Rpb24uZWFjaChmdW5jdGlvbihtb2RlbCl7XHJcblx0XHRcdGNvbnNvbGUubG9nKG1vZGVsKTtcclxuXHRcdFx0aWYoIHRoaXMudmFsdWVzW21vZGVsLmdldCgnaWQnKV0ubGVuZ3RoID4gMCApe1xyXG5cdFx0XHRcdG1vZGVsLnNldCgndmFsdWUnLCB0aGlzLnZhbHVlc1ttb2RlbC5nZXQoJ2lkJyldICk7XHJcblx0XHRcdH1cclxuXHRcdH0uYmluZCh0aGlzKSk7XHJcblx0fVxyXG59KTsiLCJ2YXIgYmFzZVBhcmFtID0gcmVxdWlyZSggJy4vYmFzZScgKTtcclxubW9kdWxlLmV4cG9ydHMgPSBiYXNlUGFyYW0uZXh0ZW5kKHtcclxuXHR0ZW1wbGF0ZTogcmVxdWlyZSgnLi4vLi4vaHRtbC9zZWxlY3QuaHRtbCcpLFxyXG59KTsiLCJ2YXIgYmFzZVBhcmFtID0gcmVxdWlyZSggJy4vYmFzZScgKTtcclxubW9kdWxlLmV4cG9ydHMgPSBiYXNlUGFyYW0uZXh0ZW5kKHtcclxuXHR0ZW1wbGF0ZTogcmVxdWlyZSgnLi4vLi4vaHRtbC9zbGlkZXIuaHRtbCcpLFxyXG5cdGV2ZW50cyA6IHtcclxuXHRcdCdjaGFuZ2UgLndwLXNsaWRlci1pbnB1dCcgOiAnaW5wdXRDaGFuZ2UnXHJcblx0fSxcclxuXHRhZnRlclJlbmRlciA6IGZ1bmN0aW9uKCl7XHJcblxyXG5cdFx0dGhpcy5zbGlkZXIgPSB0aGlzLiQoJy56bmhnLXNsaWRlci1jb250cm9sJyk7XHJcblx0XHR2YXIgaW5wdXQgPSB0aGlzLiQoJy53cC1zbGlkZXItaW5wdXQnKTtcclxuXHJcblx0XHR0aGlzLnNsaWRlci5zbGlkZXIoe1xyXG5cdFx0XHRyYW5nZTogXCJtYXhcIixcclxuXHRcdFx0ZGlzYWJsZWQ6IHRoaXMubW9kZWwuZ2V0KCdkaXNhYmxlZCcpLFxyXG5cdFx0XHRtaW46IHRoaXMubW9kZWwuZ2V0KCdtaW5pbXVtVmFsdWUnKSxcclxuXHRcdFx0bWF4OiB0aGlzLm1vZGVsLmdldCgnbWF4aW11bVZhbHVlJyksXHJcblx0XHRcdHZhbHVlOiB0aGlzLm1vZGVsLmdldCgndmFsdWUnKSxcclxuXHRcdFx0c3RlcDogdGhpcy5tb2RlbC5nZXQoJ3N0ZXAnKSxcclxuXHRcdFx0c2xpZGU6IGZ1bmN0aW9uKCBldmVudCwgdWkgKSB7XHJcblx0XHRcdFx0aW5wdXQudmFsKCB1aS52YWx1ZSApO1xyXG5cdFx0XHR9XHJcblx0XHR9KTtcclxuXHJcblx0XHRyZXR1cm4gdGhpcztcclxuXHR9LFxyXG5cdGlucHV0Q2hhbmdlOiBmdW5jdGlvbihlKXtcclxuXHJcblx0XHR2YXIgbWluaW11bVZhbCA9IHBhcnNlSW50KCB0aGlzLm1vZGVsLmdldCgnbWluaW11bVZhbHVlJykgKSxcclxuXHRcdFx0bWF4aW11bVZhbCA9IHBhcnNlSW50KCB0aGlzLm1vZGVsLmdldCgnbWF4aW11bVZhbHVlJykgKSxcclxuXHRcdFx0bmV3VmFsdWUgICA9IHBhcnNlSW50KCBqUXVlcnkoZS5jdXJyZW50VGFyZ2V0KS52YWwoKSApO1xyXG5cclxuXHRcdGlmKCBuZXdWYWx1ZSA8IG1pbmltdW1WYWwgKSB7IGpRdWVyeShlLmN1cnJlbnRUYXJnZXQpLnZhbCggbWluaW11bVZhbCApOyB9XHJcblx0XHRpZiggbmV3VmFsdWUgPiBtYXhpbXVtVmFsICkgeyBqUXVlcnkoZS5jdXJyZW50VGFyZ2V0KS52YWwoIG1heGltdW1WYWwgKTsgfVxyXG5cclxuXHRcdC8vIENIRUNLIElGIFRIRSBJTlBVVCBJUyBOT1QgQSBOVU1CRVJcclxuXHRcdGlmKCBpc05hTihuZXdWYWx1ZSkgKSB7IGpRdWVyeSh0aGlzKS52YWwoIG1pbmltdW1WYWwgKTsgfVxyXG5cclxuXHRcdHRoaXMuc2xpZGVyLnNsaWRlcihcInZhbHVlXCIgLCAgbmV3VmFsdWUgKTtcclxuXHR9XHJcbn0pOyIsInZhciBiYXNlUGFyYW0gPSByZXF1aXJlKCAnLi9iYXNlJyApO1xyXG5tb2R1bGUuZXhwb3J0cyA9IGJhc2VQYXJhbS5leHRlbmQoe1xyXG5cdHRlbXBsYXRlOiByZXF1aXJlKCcuLi8uLi9odG1sL3RleHQuaHRtbCcpLFxyXG59KTsiLCJ2YXIgYmFzZVBhcmFtID0gcmVxdWlyZSggJy4vYmFzZScgKTtcclxubW9kdWxlLmV4cG9ydHMgPSBiYXNlUGFyYW0uZXh0ZW5kKHtcclxuXHR0ZW1wbGF0ZTogcmVxdWlyZSgnLi4vLi4vaHRtbC90ZXh0YXJlYS5odG1sJyksXHJcbn0pOyIsIm1vZHVsZS5leHBvcnRzID0gQmFja2JvbmUuVmlldy5leHRlbmQoe1xyXG5cclxuXHR0ZW1wbGF0ZSA6IHJlcXVpcmUoICcuLi8uLi9odG1sL2RlZmF1bHRfb3B0aW9uX3R5cGVfZGlzcGxheS5odG1sJyApLFxyXG5cdC8vIGNsYXNzTmFtZTogJ3puaGctb3B0aW9uLWNvbnRhaW5lcicsXHJcblx0aW5pdGlhbGl6ZSA6IGZ1bmN0aW9uKCBvcHRpb25zICl7XHJcblx0XHR0aGlzLmNvbnRyb2xsZXIgPSBvcHRpb25zLmNvbnRyb2xsZXI7XHJcblx0fSxcclxuXHRyZW5kZXIgOiBmdW5jdGlvbigpe1xyXG5cdFx0dGhpcy4kZWwuaHRtbCggdGhpcy50ZW1wbGF0ZSggdGhpcy5tb2RlbC50b0pTT04oKSApICk7XHJcblx0XHR0aGlzLiQoJy56bmhnLW9wdGlvbi1jb250ZW50JykuaHRtbCggbmV3IHRoaXMuY29udHJvbGxlci5vcHRpb25zVHlwZVt0aGlzLm1vZGVsLmdldCgndHlwZScpXSh7bW9kZWwgOiB0aGlzLm1vZGVsfSkucmVuZGVyKCkuJGVsICk7XHJcblx0XHRyZXR1cm4gdGhpcztcclxuXHR9LFxyXG59KTsiXX0=
