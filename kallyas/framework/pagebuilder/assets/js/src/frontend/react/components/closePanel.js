import $ from 'jQuery';
import React from 'react';

export default class ClosePanelButton extends React.Component {

	handleClick(event){
		event.preventDefault();

		var zn_front_pb_wrap = $('.zn_front_pb_wrap');
		if ( zn_front_pb_wrap.is('.znpb-editor-hidden') ) {
			$.page_builder.show_editor();
		} else {
			$.page_builder.hide_editor();
		}

		$(window.parent.document).height('100');
	}

	render() {
		return (
			<a className="zn_pb_icon zn_pb_close_panel" href="#" onClick={this.handleClick}>
				<span className="dashicons dashicons-arrow-down-alt2"></span>
			</a>
		)
	}
};