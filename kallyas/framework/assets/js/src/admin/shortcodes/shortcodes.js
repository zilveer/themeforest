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
		ModalView = require('./views/modal'),
		ShortcodesCollection = require('./models/shortcodesCollection');

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