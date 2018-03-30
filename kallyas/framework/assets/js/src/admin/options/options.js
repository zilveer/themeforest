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