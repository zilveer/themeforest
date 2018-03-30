import React from 'react';
import $ from 'jQuery';

var ButtonKallyasFontList = React.createClass({
	mixins: [
		AlloyEditor.ButtonStyle,
		AlloyEditor.ButtonStateClasses,
		AlloyEditor.ButtonActionStyle,
		AlloyEditor.WidgetDropdown,
		AlloyEditor.WidgetExclusive,
		AlloyEditor.ToolbarButtons
	],

	propTypes: {
		editor: React.PropTypes.object.isRequired
	},

	getDefaultProps: function() {
		return {
			style: {
				element: 'span',
				styles: {
					'font-family': '#(family)'
				},
				overrides: [{
					element: 'font', attributes: { 'family': null }
				}]
			}
		};
	},

	statics: {
		key: 'klfonts'
	},

	getInitialState: function() {
		return { activeFont: this.getActiveFont() };
	},

	render: function() {
		var fonts = $.ZnPbFactory.fonts_list;

		return (
			<div className="ae-container">
				<ul className="ae-listbox ae-listbox-fonts" role="listbox">
					{this._renderFontsList(fonts)}
				</ul>
			</div>
		);
	},

	_renderFontsList : function( fonts ){
		var that = this;

		var fontsList = Object.keys(fonts).map(function(font, index) {
			var cssClass = ( that.state.activeFont.toLowerCase() == font.toLowerCase() ) ? 'ae-toolbar-element is-active' : 'ae-toolbar-element ';
			return (
				<li role="option" key={index} >
					<button className={cssClass} data-value={font} onClick={that._handleFontSelect}>{fonts[font]}</button>
				</li>
			);
		});

		return fontsList;
	},

	/**
	 * Checks if style is active in the current selection.
	 *
	 * @method isActive
	 * @return {Boolean} True if style is active, false otherwise.
	 */
	getActiveFont: function() {

		var span = this.props.editor.get('nativeEditor').elementPath().contains( isFontSizeSpan );
		return span ? span.getStyle( 'font-family' ).replace(/"/g, '') : '';

		function isFontSizeSpan( el ) {
			return el.is( 'span' ) && el.getStyle( 'font-family' );
		}

	},

	setFontStyle : function( font ){
		this._style = new CKEDITOR.style({
			element: 'span',
			styles: {
				'font-family': font
			},
			overrides: [{
				element: 'font', attributes: { 'family': null }
			}]
		});
	},

	_handleFontSelect : function(e){
		e.preventDefault();

		// Get clicked font
		var selectedFont = e.currentTarget.getAttribute('data-value');
		this.setFontStyle( selectedFont );

		// Set or remove the font
		var active = ( this.state.activeFont === selectedFont ) ? '' : selectedFont;
		// console.log(active);
		this.setState({activeFont: active});

		this.applyStyle();

	}
});

module.exports = ButtonKallyasFontList;