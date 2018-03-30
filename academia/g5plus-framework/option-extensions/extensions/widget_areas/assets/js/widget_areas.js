(function ($) {
	"use strict";

	var Redux_Widget_Areas = function () {

		this.widget_area = $('#widgets-right');
		this.widget_wrap = $('.sidebars-column-' + this.widget_area.children().length);
		this.parent_area = $('.widget-liquid-right');

		this.widget_template = $('#redux-add-widget-template');

		this.add_form_html();
		this.add_del_button();
		this.bind_events();
	};

	Redux_Widget_Areas.prototype = {


		add_form_html: function () {

			this.widget_wrap.append(this.widget_template.html());
			this.widget_name = this.widget_wrap.find('input[name="redux-add-widget-input"]');
			this.nonce = this.widget_wrap.find('input[name="redux-nonce"]').val();
		},

		add_del_button: function () {
			var i = 0;
			this.widget_area.find('.sidebar-redux-custom .widgets-sortables').each(function () {
				if (i >= redux_widget_areas) {
					$(this).append('<span class="redux-widget_area-delete"></span>')
				}
				i++;
			});
		},

		bind_events: function () {
			this.parent_area.on('click', 'span.redux-widget_area-delete', $.proxy(this.delete_widget_area, this));
			//this.parent_area.on('click', '.addWidgetArea-button', $.proxy( this.add_widget_area, this));

			$("#addWidgetAreaForm").submit(function () {
				$.proxy(this.add_widget_area, this)
			});

		},

		add_widget_area: function (e) {
			e.preventDefault();
//      	console.log(e);
//      	alert('yo'+$('#redux-add-widget-input').val());
			return false;
		},

		//delete the widget_area area with all widgets within, then re calculate the other widget_area ids and re save the order
		delete_widget_area: function (e) {
			if (!confirm('Are you sure to delete this widget areas??')) {
				return;
			}

			var widget = $(e.currentTarget).parents('.widgets-holder-wrap:eq(0)'),
				title = widget.find('.sidebar-name h3'),
				spinner = title.find('.spinner'),
				widget_name = $.trim(title.text()),
				obj = this;
			widget.addClass('closed');
			spinner.css('display', 'inline-block');
			$.ajax({
				type: "POST",
				url: window.ajaxurl,
				data: {
					action: 'redux_delete_widget_area',
					name: widget_name,
					_wpnonce: obj.nonce
				},

				success: function (response) {
					if (response.trim() == 'widget_area-deleted') {
						widget.slideUp(200).remove();
					}
				}
			});
		}
	};

	$(function () {
		new Redux_Widget_Areas();
	});

})(jQuery);  