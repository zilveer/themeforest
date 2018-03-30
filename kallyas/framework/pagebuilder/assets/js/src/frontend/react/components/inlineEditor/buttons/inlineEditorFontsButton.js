var ButtonKallyasFontList = require('./inlineEditorFontList');
var ButtonKallyasFontStyles = require('./inlineEditorFontStyle');
import React from 'react';

var ButtonKallyasFonts = React.createClass({
	// mixins: [
	// 	AlloyEditor.ButtonStateClasses,
	// 	AlloyEditor.WidgetDropdown,
	// 	AlloyEditor.WidgetExclusive,
	// 	AlloyEditor.WidgetFocusManager,
	// 	AlloyEditor.ToolbarButtons
	// ],

	propTypes: {
		editor: React.PropTypes.object.isRequired
	},


	statics: {
		key: 'klfonts'
	},

	getInitialState: function() {
		return { showButtons: false };
	},

	toggleFonts: function(e){
		this.setState({ showButtons: ! this.state.showButtons });
	},

	render: function() {
		var cssClass = 'ae-button ' + ( this.state.showButtons ? 'ae-button-pressed':'' );

		return (
			<div className="ae-container ae-has-dropdown ae-pos-static">
				<button className={cssClass} data-type="button-fontoptions" onClick={this.toggleFonts} tabIndex={this.props.tabIndex}>
					<span className="ae-icon-font-options"></span>
				</button>
				{ this.state.showButtons ? this.getModalContents() : null }
			</div>
		);
	},

	getModalContents : function(){
		return (
			<div className="ae-dropdown ae-dropdown--dropup ae-dropdown--fonts">
				<ButtonKallyasFontStyles {...this.props}/>
				<ButtonKallyasFontList {...this.props}/>
			</div>
		);
	}

});

AlloyEditor.Buttons[ButtonKallyasFonts.key] = AlloyEditor.ButtonKallyasFonts = ButtonKallyasFonts;