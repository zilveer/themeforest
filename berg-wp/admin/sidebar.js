jQuery(document).ready(function() {
    "use strict";

    var BergSidebar = function() {
        this.widgetWrapper = jQuery('.widget-liquid-right');
        this.widgetArea = jQuery('#widgets-right');
        this.widgetAddContents = jQuery('#berg-add-widget');
        this.createCustomWidgetAreaForm();
        this.addDeleteButton();
        this.bindFormEvents();
    };

    BergSidebar.prototype = {
        createCustomWidgetAreaForm: function() {
            this.widgetWrapper.append(this.widgetAddContents.html());
            this.widget_name = this.widgetWrapper.find('input[name="berg-sidebar-widgets"]');
            this.nonce = this.widgetWrapper.find('input[name="berg-delete-sidebar"]').val();
        },
        addDeleteButton: function() {
            this.widgetArea.find('.sidebar-berg-custom').append('<a class="berg-delete-button widget-control-remove" style="display: inline-block; position: absolute; bottom: 10px; right: 20px; z-index: 0; cursor: pointer; "><span class="berg-delete">Delete</span></a>');
        },
        bindFormEvents: function() {
            this.widgetWrapper.on('click', '.berg-delete-button', jQuery.proxy(this.deleteSidebar, this));
        },
        deleteSidebar: function(e) {
            var widget = jQuery(e.currentTarget).parents('.widgets-holder-wrap:eq(0)'),
                title = widget.find('.sidebar-name h2'),
                spinner = title.find('.spinner'),
                widget_name = jQuery.trim(title.text()),
                obj = this;

            jQuery.ajax({
                type: "POST",
                url: window.ajaxurl,
                data: {
                    action: 'berg_ajax_delete_custom_sidebar',
                    name: widget_name,
                    _wpnonce: obj.nonce
                },
                beforeSend: function() {
                    spinner.addClass('activate_spinner');
                },
                success: function(response) {
                    if (response == 'sidebar-deleted') {
                        console.log(widget);
                        widget.slideUp(200, function() {
                            jQuery('.widget-control-remove', widget).trigger('click');
                            widget.remove();
                            wpWidgets.saveOrder();
                        });
                    }
                }
            });
        }
    };

    new BergSidebar();
});