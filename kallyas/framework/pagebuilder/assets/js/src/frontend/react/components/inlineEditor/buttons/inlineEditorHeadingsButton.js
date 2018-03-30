require( './button-h3.js' );
require( './button-h4.js' );
require( './button-h5.js' );
require( './button-h6.js' );

import React from 'react';

var HeadingsButton = React.createClass({
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
				element: 'klheadings'
			}
		};
	},

	statics: {
		key: 'klheadings'
	},

	getInitialState: function() {
		return { showButtons: this.props.active === this.props.tabKey };
	},

	render: function() {
		var cssClass = 'button-kl-headings ae-button ' + ( this.props.active === this.props.tabKey ? 'ae-button-pressed':'' );

		return (
			<div className="ae-container ae-has-dropdown ae-pos-static">
				<button className={cssClass} data-type="button-klheadings" onClick={this.togglePopup} tabIndex={this.props.tabIndex}>
					<span className="ae-icon-h1"></span>
				</button>
				{ this.props.active === this.props.tabKey ? this.renderButtons() : null }
			</div>
		);
	},

	renderButtons : function(){
		var buttons = [ 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ];
		var alignmentButtons = this.getToolbarButtons(
			buttons,
			{
				manualSelection: this.props.editorEvent ? this.props.editorEvent.data.manualSelection : null,
				selectionType: 'text'
			}
		);

		return (
			<div className="ae-dropdown ae-dropdown--dropup ae-rounded-top">
				<div className="ae-container">
					{alignmentButtons}
				</div>
			</div>
		);
	},

	togglePopup: function(){
		this.props.changeActiveButton( this.props.tabKey );
	}
});

AlloyEditor.Buttons[HeadingsButton.key] = AlloyEditor.HeadingsButton = HeadingsButton;