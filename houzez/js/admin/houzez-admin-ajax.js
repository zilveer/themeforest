/**
 * Created by waqasriaz on 22/06/16.
 */
jQuery(document).ready(function ($) {
    "use strict";

    var ajaxurl = houzez_admin_vars.ajaxurl;
    var paid_text = houzez_admin_vars.paid_status;

    $('#activate_purchase_listing').click(function(){
        var itemID, invoiceID, purchaseType;

        itemID       = $(this).attr('data-item');
        invoiceID    = $(this).attr('data-invoice');
        purchaseType = $(this).attr('data-purchaseType');

        jQuery.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                'action'        : 'houzez_activate_purchase_listing',
                'item_id'       : itemID,
                'invoice_id'    : invoiceID,
                'purchase_type' : purchaseType

            },
            success: function (data) {
                jQuery("#activate_purchase_listing").remove();
                jQuery("#houzez_invoice_payment_status .fave_admin_label").removeClass('label-red');
                jQuery("#houzez_invoice_payment_status .fave_admin_label").addClass('label-green');
                jQuery("#houzez_invoice_payment_status .fave_admin_label").empty().html(paid_text);

            },
            error: function (errorThrown) {}
        });

    });

    $('#activate_package').click(function(){
        var itemID, invoiceID;

        itemID       = $(this).attr('data-item');
        invoiceID    = $(this).attr('data-invoice');

        jQuery.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                'action'     : 'houzez_activate_pack_purchase',
                'item_id'    : itemID,
                'invoice_id' : invoiceID

            },
            success: function (data) {
                jQuery("#activate_package").remove();
                jQuery("#houzez_invoice_payment_status .fave_admin_label").removeClass('label-red');
                jQuery("#houzez_invoice_payment_status .fave_admin_label").addClass('label-green');
                jQuery("#houzez_invoice_payment_status .fave_admin_label").empty().html(paid_text);

            },
            error: function (errorThrown) {}
        });

    });


});
