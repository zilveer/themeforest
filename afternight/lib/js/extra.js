var extra = new Object();
extra.add = function (group, struct) {
    var data = new Array();
    var k = 0;
    for (var key in struct) {
        if (struct.hasOwnProperty(key)) {
            if (( typeof struct[ key ] ).toString() != "string") {
                for (var i = 0; i < struct[ key ].length; i++) {
                    data[ k ] = { 'name':extra.name(key + '#' + struct[ key ][i]), 'value':extra.val(key + '#' + struct[ key ][i]) };
                    k++;
                }
            } else {
                data[ k ] = { 'name':extra.name(key + '#' + struct[ key ]), 'value':extra.val(key + '#' + struct[ key ]) };
                k++;
            }
        }
    }

    jQuery(document).ready(function () {
        jQuery.post(ajaxurl, { "action":'extra_add', "group":group, "data":data }, function (result) {
            extra.clear(struct);
            jQuery('#container_' + group).html(result);
        });
    });
};

extra.del = function (group, index) {
    if (confirm('You sure you want to delete this item from group ?')) {
        jQuery(document).ready(function () {
            jQuery.post(ajaxurl, { "action":'extra_del', "group":group, "index":index }, function (result) {
                jQuery('#container_' + group).html(result);
            });
        });
    }
};

extra.update = function (group, index, struct) {
    var data = new Array();
    var k = 0;
    for (var key in struct) {
        if (struct.hasOwnProperty(key)) {
            if (( typeof struct[ key ] ).toString() != "string") {
                for (var i = 0; i < struct[ key ].length; i++) {
                    data[ k ] = { 'name':extra.name('div#multiple_record_' + group + '_' + index + ' ' + key + '.' + struct[ key ][i]), 'value':extra.val('div#multiple_record_' + group + '_' + index + ' ' + key + '.' + struct[ key ][i]) };
                    k++;
                }
            } else {
                data[ k ] = { 'name':extra.name('div#multiple_record_' + group + '_' + index + ' ' + key + '.' + struct[ key ]), 'value':extra.val('div#multiple_record_' + group + '_' + index + ' ' + key + '.' + struct[ key ]) };
                k++;
            }
        }
    }

    jQuery(document).ready(function () {
        jQuery.post(ajaxurl, { "action":'extra_update', "group":group, "index":index, "data":data }, function (result) {
            jQuery('#container_' + group).html(result);
        });
    });
};

extra.edite = function (group, index) {
    jQuery(document).ready(function () {
        jQuery('div#multiple_record_' + group + '_' + index + ' .edit-action').hide();
        jQuery('div#multiple_record_' + group + '_' + index + ' .update-action').show();
        jQuery('div#multiple_record_' + group + '_' + index + ' .fvisible').show();
        jQuery('div#multiple_record_' + group + '_' + index + ' .lvisible').hide();
    });
};

extra.clear = function (struct) {
    jQuery(document).ready(function () {
        for (var key in struct) {
            if (struct.hasOwnProperty(key)) {
                if (( typeof struct[ key ] ).toString() != "string") {
                    for (var i = 0; i < struct[ key ].length; i++) {
                        jQuery(key + '#' + struct[ key ][i]).val('');
                    }
                } else {
                    jQuery(key + '#' + struct[ key ]).val('');
                }
            }
        }
    });
};
extra.name = function (selector) {
    var name = '';
    jQuery(document).ready(function () {
        name = jQuery(selector).attr('name');
    });
    return name;
};
extra.val = function (selector) {
    var result = '';
    jQuery(document).ready(function () {
        if (jQuery(selector).attr('type') == 'checkbox' || jQuery(selector).attr('type') == 'radio') {
            if (jQuery(selector).is(':checked')) {
                result = jQuery(selector).val();
            } else {
                result = '';
            }
        } else {
            result = jQuery(selector).val();
        }
    });

    return result;
};


extra.sort = function (group, name) {
    var data = new Array();
    jQuery(document).ready(function () {
        jQuery('input.' + group + '.index').each(function (i) {
            data[i] = { 'name':name, 'value':jQuery(this).val() };
        });

        jQuery.post(ajaxurl, { "action":"extra_sort", "group":group, "data":data },
            function (result) {
                jQuery('#container_' + group).html(result);
            }
        );
    });
};

function init_ui_slider(obj_selector){
    jQuery(obj_selector).each(function (i) {
        jQuery(this).slider({
             range: "min",
             min: jQuery(this).data('min'),
             max: jQuery(this).data('max'),
             value: jQuery(this).data('val') ,
             slide: function (event, ui) {
                jQuery(this).next('span.slider_val').text(ui.value+'%');
                jQuery(this).prev('.slider_value').val(ui.value);
             },
             
             change: function (event, ui) {

             }
        });
    });
}

jQuery(document).ready(function () {
    /*initialize DateTimePicker*/
    var nmdt1 = jQuery('.DateTimePicker');
    if (nmdt1.length > 0) {
        jQuery('.DateTimePicker').datetimepicker();
    }

    /* INIT prettyPhoto*/
    jQuery("a[rel^='prettyPhoto']").prettyPhoto({
        autoplay_slideshow: false,
        theme: 'light_square',
        social_tools:false,
        deeplinking: false 

    });
});

