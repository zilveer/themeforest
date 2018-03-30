import $ from 'jQuery';
import React from 'react';

export default class PageOptionsButton extends React.Component {

	handleClick(event){
		event.preventDefault();

		var params = {},
			options = $.ZnPbFactory.page_options;

		params.modal_ajax_hook = 'znpb_get_page_options';
		params.modal_backdrop_class = 'zn-modal-transparent';
		params.modal_ajax_params = {
			page_options : options,
			post_id : $('#zn_post_id').val(),
		};
		params.modal_title = 'Page options';
		params.modal_on_close = function(e){
			this.save_page_options( e.modal );
			$.page_builder.show_editor();
		}.bind(this);
		params.modal_on_ajax_load = function(e){
			var form = e.modal.find('.zn-modal-form');

			// Don't allow scroll on entire page
			$.page_builder.isolate_scroll(e.modal);
		};

		new $.ZnModal(params);
	}

	// This will save the page options to the pb factory
	save_page_options(scope){
		var form = scope.find('.zn-modal-form').first();

		// Update the options array
		$.ZnPbFactory.page_options = $.page_builder.get_form_values(form);

	}

	render() {
		return (
			<a className="zn_pb_icon zn_pb_options_trigger" href="#" data-tooltip="Page options" onClick={this.handleClick.bind(this)}>
				<span className="dashicons dashicons-admin-generic"></span>
			</a>
		)
	}
};