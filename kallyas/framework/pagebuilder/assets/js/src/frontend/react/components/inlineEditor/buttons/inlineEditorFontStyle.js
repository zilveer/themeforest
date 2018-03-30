require( './inlineEditorFontSize' );
require( './inlineEditorLineHeight' );
require( './inlineEditorLetterSpacing' );
require( './inlineEditorHeadingsButton' );

import React from 'react';

var inlineEditorFontStyles = React.createClass({
	mixins: [
		AlloyEditor.WidgetDropdown,
		AlloyEditor.WidgetExclusive,
		AlloyEditor.ToolbarButtons
	],

	getInitialState: function() {
		return {
			active: 'klfontsize'
		};
	},

	render: function() {
		var buttons = [ 'klfontsize', 'klheadings', 'kllineheight', 'klletterspacing' ];
		var alignmentButtons = this.getToolbarButtons(
			buttons,
			{
				manualSelection: this.props.editorEvent ? this.props.editorEvent.data.manualSelection : null,
				selectionType: 'text',
				changeActiveButton : this.changeActiveButton,
				active: this.state.active
			}
		);

		return (
			<div className="ae-container ae-toolbar">
					{alignmentButtons}
			</div>
		);
	},

	changeActiveButton : function( key ){
		if( key !== this.state.active ){
			this.setState( { active: key } );
		}
	},

});

module.exports = inlineEditorFontStyles;