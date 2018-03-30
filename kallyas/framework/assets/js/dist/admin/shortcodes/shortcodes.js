/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			exports: {},
/******/ 			id: moduleId,
/******/ 			loaded: false
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.loaded = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ function(module, exports, __webpack_require__) {

	window.znhg = window.znhg || {};

	znhgShortcodesManagerData = {};
	znhgShortcodesManagerData.sections = [
		'Typography',
		'Layout',
		'Content',
		'Marketing'
	];

	znhgShortcodesManagerData.shortcodes = [
		{
			id : 'subtitle',
			name : 'Subtitle',
			section : 'Typography',
			hasContent: true,
			params : [
				{
					name : 'Subtitle',
					description : 'Enter the subtitle text',
					type : 'text',
					id : 'content'
				}
			],
		},
		{
			id : 'znhg_alternative_header',
			name : 'Alternative heading',
			section : 'Typography',
			hasContent: true,
			params : [
				{
					name : 'Heading type',
					id : 'heading_type',
					description : 'Choose what alternative heading type you want to use',
					type : 'select',
					value : 'h1',
					options: {
						'h1' : 'H1',
						'h2' : 'H2',
						'h3' : 'H3',
						'h4' : 'H4',
						'h5' : 'H5',
						'h6' : 'H6',
					}
				},
				{
					name : 'Heading text',
					id : 'content',
					description : 'Please enter the heading text you want to use',
					type : 'text',
					placeholder: 'heading text'
				},
			],
		},
		{
			id : 'blockquote',
			name : 'Blockquote',
			section : 'Typography',
			hasContent: true,
			params : [
				{
					name : 'Author',
					id : 'author',
					description : 'Enter the quote author name.',
					type : 'text',
					placeholder: 'John Doe'
				},
				{
					name : 'Quote',
					id : 'content',
					description : 'Enter the quote.',
					type : 'textarea',
				},
				{
					name : 'Alignment',
					id : 'align',
					description : 'Choose the quote alignment',
					type : 'select',
					value : 'left',
					options: {
						'left' : 'Left',
						'right' : 'Right'
					}
				},
			],
		},
		{
			id : 'code',
			name : 'Code',
			section : 'Typography',
			hasContent: true,
			params : [
				{
					name : 'Code content',
					id : 'content',
					description : 'Enter the desired code you want to display.',
					type : 'textarea',
				},
			],
		},
		{
			id : 'tooltip',
			name : 'Tooltip',
			section : 'Content',
			hasContent: true,
			params : [
				{
					name : 'Tooltip content',
					id : 'content',
					description : 'Enter the desired tooltip anchor text.',
					type : 'textarea',
				},
				{
					name : 'Tooltip title',
					id : 'title',
					description : 'Enter the desired tooltip content.',
					type : 'text',
				},
				{
					name : 'Tooltip placement',
					id : 'placement',
					description : 'Choose the desired tooltip placement.',
					type : 'select',
					value : 'top',
					options: {
						'top' : 'Top',
						'right' : 'Right',
						'bottom' : 'Bottom',
						'left' : 'Left'
					}
				},
				{
					name : 'Use border ?',
					id : 'border',
					description : 'Choose yes if you want to add a border around the tooltip.',
					type : 'select',
					value : 'yes',
					options: {
						'yes' : 'Yes',
						'no' : 'No'
					}
				},
			],
		},
		{
			id : 'row',
			name : 'Row',
			section : 'Layout',
			hasContent: true,
			params : [
				{
					name : 'css class',
					id : 'css_class',
					description : 'Enter the desired css class name that will be applied to this row.',
					type : 'text',
				},
			],
		},
		{
			id : 'znhg_column',
			name : 'Column',
			section : 'Layout',
			hasContent: true,
			params : [
				{
					name : 'Column size',
					id : 'size',
					description : 'Choose the desired column size.',
					type : 'select',
					value : 'col-sm-6',
					options: {
						'col-sm-6' : '1/2',
						'col-sm-4' : '1/3',
						'col-sm-3' : '1/4',
						'col-sm-8' : '2/3',
						'col-sm-9' : '3/4',
					}
				},
				{
					name : 'css class',
					id : 'css_class',
					description : 'Enter the desired css class name that will be applied to this row.',
					type : 'text',
				},
			],
		},
		{
			id : 'list',
			name : 'List',
			section : 'Content',
			hasContent: true,
			defaultContent: '<ul><li>First list item</li><li>Second list item</li></ul>',
			params : [
				{
					name : 'List style',
					id : 'type',
					description : 'Choose the desired list style you want to use.',
					type : 'select',
					value : 'list-style1',
					options: {
						'list-style1' : 'Arrow list',
						'list-style2' : 'Check list',
					}
				}
			]
		},
		{
			id : 'table',
			name : 'Table',
			section : 'Content',
			hasContent: true,
			defaultContent: '<table><thead><tr><th>#</th><th>First Name</th></tr></thead><tbody><tr><td>1</td><td>Mark</td></tr><tr><td>2</td><td>Jacob</td></tr><tr><td>3</td><td>Larry</td></tr></tbody></table>',
			params : [
				{
					name : 'Style',
					id : 'type',
					description : 'Choose the desired style you want to use.',
					type : 'select',
					value : 'table-striped',
					options: {
						'table-striped': 'Striped',
						'table-bordered': 'Bordered',
						'table-hover': 'Hover',
						'table-condensed': 'Condensed',
					}
				}
			]
		},
		{
			id : 'znhg_qr',
			name : 'Qr Code',
			section : 'Marketing',
			params : [
				{
					name : 'QR code URL',
					id : 'url',
					description : 'Enter the QR code url generated from <a target="_blank" href="http://goqr.me/">QR code generator</a>.',
					type : 'text',
					placeholder : 'QR code URL',
				},
				{
					name : 'Alignment',
					id : 'align',
					description : 'Choose the desired alignment.',
					type : 'select',
					value : 'right',
					options: {
						'right': 'Right',
						'left': 'Left',
					}
				},
			]
		},
		{
			id : 'button',
			name : 'Button',
			section : 'Content',
			hasContent: true,
			params : [
				{
					name : 'Style',
					id : 'style',
					description : 'Select the desired style you want to use for this button.',
					type : 'select',
					value : '',
					options: {
						'': 'Default',
						'btn-primary': 'Primary',
						'btn-info': 'Info',
						'btn-success': 'Success',
						'btn-warning': 'Warning',
						'btn-danger': 'Danger',
						'btn-inverse': 'Inverse',
					}
				},
				{
					name : 'Button content',
					id : 'content',
					description : 'Enter the desired button content text.',
					type : 'text',
					placeholder : 'Content',
				},
				{
					name : 'URL',
					id : 'url',
					description : 'Enter the desired button URL',
					type : 'text',
					placeholder : 'URL',
				},
				{
					name : 'Target',
					id : 'target',
					description : 'Select the desired target for this button.',
					type : 'select',
					value : '_self',
					options: {
						'_self': 'Self',
						'_blank': 'Blank',
					}
				},
				{
					name : 'Size',
					id : 'size',
					description : 'Select the desired size for this button.',
					type : 'select',
					value : '',
					options: {
						'': 'Default',
						'btn-lg': 'Large',
						'btn-md': 'Medium',
						'btn-sm': 'Small',
						'btn-xs': 'Extra small',
					}
				},
				{
					name : 'Block ?',
					id : 'block',
					description : 'Select if you want to display the button as block or not.',
					type : 'select',
					value : '',
					options: {
						'': 'Normal',
						'btn-block': 'Block',
					}
				},
			],
		},
		{
			id : 'accordion',
			name : 'Accordion',
			section : 'Content',
			params : [
				{
					name : 'Accordion title',
					id : 'title',
					description : 'Enter the desired title for this accordion.',
					type : 'text',
					placeholder : 'accordion title',
				},
				{
					name : 'Accordion content',
					id : 'content',
					description : 'Enter the desired content for this accordion.',
					type : 'textarea',
					placeholder : 'accordion content',
				},
				{
					name : 'Style',
					id : 'style',
					description : 'Choose the desired style.',
					type : 'select',
					value : 'default-style',
					options: {
						'default-style': 'Default style',
						'style2': 'Style 2',
						'style3': 'Style 3',
					}
				},
				{
					name : 'Collapsed ?',
					id : 'collapsed',
					description : 'Choose the initial state of the accordion pane.',
					type : 'select',
					value : 'false',
					options: {
						'false': 'Closed',
						'true': 'Open',
					}
				},
			]
		},
		{
			id : 'tabs',
			name : 'Tabs container',
			section : 'Content',
			hasContent : true,
			params : [
				{
					name : 'Style',
					id : 'style',
					description : 'Choose the desired style.',
					type : 'select',
					value : 'style1',
					options: {
						'style1': 'Style 1',
						'style2': 'Style 2',
						'style3': 'Style 3',
						'style4': 'Style 4',
					}
				},
			]
		},
		{
			id : 'tab',
			name : 'Single tab',
			section : 'Content',
			params : [
				{
					name : 'Tab title',
					id : 'title',
					description : 'Enter the desired tab title',
					type : 'text',
					placeholder : 'title'
				},
				{
					name : 'Tab content',
					id : 'content',
					description : 'Enter the desired tab content',
					type : 'textarea',
					placeholder : 'tab content'
				},
			]
		},
		{
			id : 'skills',
			name : 'Skills container',
			section : 'Content',
			hasContent : true,
			params : [
				{
					name : 'Main text',
					id : 'main_text',
					description : 'Enter the main text that will appear in the center of the skill bars.',
					type : 'text',
					placeholder : 'skills main text',
				},
				{
					name : 'Main color',
					id : 'main_color',
					description : 'Choose the main color you want to use.',
					type : 'colorpicker',
					value : '#193340',
				},
				{
					name : 'Text color',
					id : 'text_color',
					description : 'Choose the text color you want to use.',
					type : 'colorpicker',
					value : '#ffffff',
				},
			]
		},
		{
			id : 'skill',
			name : 'Single skill',
			section : 'Content',
			hasContent : true,
			params : [
				{
					name : 'Skill title',
					id : 'content',
					description : 'Enter the desired skill title',
					type : 'text',
					placeholder : 'My awesome skill'
				},
				{
					name : 'Main color',
					id : 'main_color',
					description : 'Choose the main color you want to use.',
					type : 'colorpicker',
					value : '#193340',
				},
				{
					name : 'Skill percentage',
					id : 'percentage',
					description : 'Enter the skill percentage value.',
					type : 'text',
					value : '',
					placeholder : '90',
				},
			]
		},
		{
			id : 'pricing_table',
			name : 'Pricing table container',
			section : 'Marketing',
			hasContent : true,
			params : [
				{
					name : 'Color',
					id : 'color',
					description : 'Choose the desired pricing table color.',
					type : 'select',
					value : 'red',
					options: {
						'red': 'Red',
						'blue': 'Blue',
						'green': 'Style 3',
						'turquoise': 'Turquoise',
						'orange': 'Orange',
						'purple': 'Purple',
						'yellow': 'Yellow',
						'green_lemon': 'Green lemon',
						'dark': 'Dark',
						'light': 'Light',
					}
				},
				{
					name : 'Columns',
					id : 'columns',
					description : 'Choose how many columns you want to use for this table.',
					type : 'select',
					value : '4',
					options: {
						'1': '1 Column',
						'2': '2 Columns',
						'3': '3 Columns',
						'4': '4 Columns',
						'6': '6 Columns',
					}
				},
				{
					name : 'Use rounded corners ?',
					id : 'rounded',
					description : 'Choose if you want to use rounded corners or not.',
					type : 'select',
					value : 'no',
					options: {
						'no': 'No',
						'yes': 'Yes',
					}
				},
			]
		},
		{
			id : 'pricing_caption',
			name : 'Pricing table caption',
			section : 'Marketing',
			hasContent : true,
			defaultContent: '<ul><li>First list item</li><li>Second list item</li></ul>',
			params : [
				{
					name : 'Name',
					id : 'name',
					description : 'Enter the desired pricing caption name',
					type : 'text',
					placeholder : 'column name',
				},
			]
		},
	];

	(function ($) {
		var App = function(){},
			ModalView = __webpack_require__(1),
			ShortcodesCollection = __webpack_require__(6);

		/**
		 * Starts the main shortcode manager class
		 */
		App.prototype.start = function(){
			// Bind the click event
			$(document).on('click', '#znhgtfw-shortcode-modal-open', function(e){
				e.preventDefault();
				this.openModal();
			}.bind(this));

			this.shortcodesCollection = new ShortcodesCollection(znhgShortcodesManagerData.shortcodes);

			// Allow chaining
			return this;
		};

		/**
		 * Opens the modal window
		 */
		App.prototype.openModal = function(){
			// Only allow an instance of the modalView
			if( this.modalView === undefined ){
				this.modalView = new ModalView({collection: this.shortcodesCollection, app : this});
			}
		};

		/**
		 * Opens the modal window
		 */
		App.prototype.closeModal = function(){
			this.modalView = undefined;
		};

		znhg.shortcodesManager = new App().start();

	})(jQuery);

/***/ },
/* 1 */
/***/ function(module, exports, __webpack_require__) {

	var navView = __webpack_require__(2);

	module.exports = Backbone.View.extend({
		id: "znhgtfw-shortcodes-modal",
		template : __webpack_require__(!(function webpackMissingModule() { var e = new Error("Cannot find module \"../html/modal.html\""); e.code = 'MODULE_NOT_FOUND'; throw e; }())),
		events : {
			'click .znhgtfw-modal-backdrop': 'modalClose',
			'click .media-modal-close':      'modalClose',
			'click .znhg-shortcode-insert':  'insertShortcode'
		},
		initialize : function( options ){
			this.mainApp = options.app;
			this.listenTo(this.collection, 'shortcodeSelected', this.renderParams);
			this.render();
		},
		render : function(){
			this.$el.html( this.template() );

			// Add the navigation
			this.$('.znhgtfw-modal-sidebar').append( new navView().render().$el );

			// Finally.. add the modal to the page
			jQuery( 'body' ).append( this.$el ).addClass('znhgtfw-modal-open');

			return this;
		},
		modalClose : function(){
			this.$el.remove();
			jQuery('body').removeClass('znhgtfw-modal-open');
			this.mainApp.closeModal();
			this.remove();
		},
		renderParams: function( shortcode ){
			// We will need to render the form
			this.paramsCollection = znhg.optionsMachine.setupParams( shortcode.get('params') );
			var form = znhg.optionsMachine.renderOptionsGroup(this.paramsCollection);
			this.$('.znhgtfw-modal-content').html(form);
		},
		insertShortcode : function(shortcode){

			var shortcodeTag    = this.collection.selected.get( 'id' ),
				changedParams   = this.paramsCollection.where({ isChanged: true }),
				closeShortcode  = this.collection.selected.get( 'hasContent' ) || false,
				shortcodeContent = this.collection.selected.get( 'defaultContent' ) || false,
				output;

			// Open the shortcode tag
			output = '['+ shortcodeTag;
				// output all the shortcode params/attributes
				_.each(changedParams, function(param){
					// Don't add the content attribute
					if( param.get('id') === 'content' ){
						// Set the closeShortcode to true
						closeShortcode = true;
						shortcodeContent = param.get('value');
						return true;
					}
					// Output the param_name=param_value
					output += ' '+ param.get('id') + '="' + param.get('value') +'"';
				});
			output += ']';

			// If we have content, add the content and also add the closing tag
			if ( shortcodeContent ) {
				output += shortcodeContent;
			}

			// Check if we need to close the shortcode
			if( closeShortcode ){
				output += '[/' + shortcodeTag + ']';
			}

			window.wp.media.editor.insert( output );
			this.modalClose();
		}
	});

/***/ },
/* 2 */
/***/ function(module, exports, __webpack_require__) {

	var navSection = __webpack_require__(3);
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

/***/ },
/* 3 */
/***/ function(module, exports, __webpack_require__) {

	var navItem = __webpack_require__(4);
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

/***/ },
/* 4 */
/***/ function(module, exports) {

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

/***/ },
/* 5 */,
/* 6 */
/***/ function(module, exports, __webpack_require__) {

	var ShortcodesCollection = Backbone.Collection.extend({
		model: __webpack_require__(7),
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

/***/ },
/* 7 */
/***/ function(module, exports) {

	module.exports = Backbone.Model.extend({
		defaults : {
			id : 'shortcode-tag',
			name : 'Shortcode Name',
			section : 'Section',
			description : 'Shortcode description',
			params : [],
		},
		setSelected:function() {
			this.collection.setSelected(this);
		}
	});

/***/ }
/******/ ]);