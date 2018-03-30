import React from 'react';

var ButtonKallyasAlignment = React.createClass({
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
				element: 'klalignment'
			}
		};
	},

	statics: {
		key: 'klalignment'
	},

	getInitialState: function() {
		return { showButtons: false };
	},

	toggleAlignments: function(e){
		this.setState({ showButtons: ! this.state.showButtons });
	},

	render: function() {
		var cssClass = 'ae-button ' + this.getStateClasses();
		return (
			<div className="ae-container ae-has-dropdown">
				<button className={cssClass} data-type="button-kl-alignment" onClick={this.toggleAlignments} tabIndex={this.props.tabIndex}>
					<span className="ae-icon-align-center"></span>
				</button>
				{ this.state.showButtons ? this._renderAlignmentButtons() : null }
			</div>
		);
	},

	_renderAlignmentButtons : function() {
		var buttons = [ 'paragraphLeft', 'paragraphCenter', 'paragraphRight' ];
		var alignmentButtons = this.getToolbarButtons(
			buttons,
			{
				manualSelection: this.props.editorEvent ? this.props.editorEvent.data.manualSelection : null,
				selectionType: 'text'
			}
		);

		return (
			<div className="ae-dropdown ae-dropdown--dropup ae-dropdown--alignment ae-arrow-box ae-arrow-box-bottom">
				<div className="ae-listbox">
					{alignmentButtons}
				</div>
			</div>
		);
	}
});

AlloyEditor.Buttons[ButtonKallyasAlignment.key] = AlloyEditor.ButtonKallyasAlignment = ButtonKallyasAlignment;