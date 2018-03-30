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