var meta = new Object();
meta.save = function (res, box, post_id, selector) {
    var selected_box_id = jQuery('.' + box + '-idrecord option:selected').val();

    /*for some meta we need to check if user has selected from provided select a real value
     In the array bellow add those meta  to be checked:
     */
    var exceptions_meta_arr = [ "conference", "presentation", "exhibitor", "sponsor" , "speaker" ];

    /*check if exceptions_meta_arr  contains  'box' */
    var is_exception_meta = jQuery.inArray(box, exceptions_meta_arr);
    if (selected_box_id > 0 || is_exception_meta == -1) {
        jQuery(document).ready(function () {
            jQuery('div#form' + box).wrap('<form id="wrapform' + box + '" />');
            var data = jQuery('form#wrapform' + box).serializeArray();
            jQuery('div#form' + box).unwrap('form#wrapform' + box);
            jQuery.post(
                ajaxurl, {
                    "action":'meta_save',
                    "res":res,
                    "box":box,
                    "post_id":post_id,
                    "data":data }, function (result) {
                    jQuery(selector).addClass('postbox');
                    jQuery(selector).html(result);
                });
        });
    } else {
        alert('Please select ' + box);
    }
};

meta.save_data = function (res, box, post_id, data, selector) {

    if (post_id > 0) {
        jQuery(document).ready(function () {
            jQuery.post(ajaxurl, { "action":'meta_save', "res":res, "box":box, "post_id":post_id, "data":data },
                function (result) {
                    if (selector != '.--') {
                        jQuery('#attach_' + box + '_' + res).fadeTo(100, 1);
                        jQuery('#attach_' + box + '_' + res).fadeTo(2000, 0);
                        jQuery.post(ajaxurl, { "action":"search_relation", "post_id":data[0].value, "args":[ res , box ] }, function (result) {
                            jQuery(selector).addClass('postbox');
                            jQuery(selector).html(result);
                        });
                    }
                }
            );
        });
    } else {
        if (res == 'presentation' && box == 'speaker') {
            alert('Please select ' + ' conferance and presentations');
        } else {
            alert('Please select ' + res);
        }
    }
};

meta.del = function (res, box, post_id, index, selector) {
    jQuery(document).ready(function () {
        jQuery.post(
            ajaxurl, {
                "action":'meta_delete',
                "res":res,
                "box":box,
                "post_id":post_id,
                "index":index }, function (result) {
                if (result.length > 0) {
                    jQuery(selector).addClass('postbox');
                } else {
                    jQuery(selector).removeClass('postbox');
                }
                jQuery(selector).html(result);
            });
    });
};

meta.del_data = function (res, box, post_id, index, post_id_result, selector) {
    jQuery(document).ready(function () {
        jQuery.post(
            ajaxurl, {
                "action":'meta_delete',
                "res":res,
                "box":box,
                "post_id":post_id,
                "index":index }, function (result) {
                if (selector != '.--') {
                    jQuery.post(ajaxurl, { "action":"search_relation", "post_id":post_id_result, "args":[ res , box ] },
                        function (result) {
                            if (result.length > 0) {
                                jQuery(selector).addClass('postbox');
                            } else {
                                jQuery(selector).removeClass('postbox');
                            }

                            jQuery(selector).html(result);

                        }
                    );
                }
            });
    });
};

meta.clear = function (selector) {
    jQuery(document).ready(function () {
        jQuery('input[type="radion"]' + selector).attr('checked', 'unchecked');
        jQuery('select' + selector).attr('selected', 'unselected');
        jQuery('textarea' + selector).val('');
        jQuery('input' + selector).val('');
    });
};

meta.sort = function (res, box, post_id, name) {
    var data = new Array();
    jQuery(document).ready(function () {
        jQuery('input.' + res + '-' + box + '-' + name).each(function (i) {
            data[i] = { 'name':name + '[]', 'value':jQuery(this).val() };
        });

        jQuery.post(ajaxurl, { "action":"meta_sort", "res":res, "box":box, "post_id":post_id, "data":data },
            function (result) {
                jQuery('div.layout-a.meta-box.sort-' + res + '-' + box).html(result);
            }
        );
    });
};

meta.update = function (res, box, post_id, struct, index, selector) {
    var data = new Array();
    var k = 0;
    for (var key in struct) {
        if (struct.hasOwnProperty(key)) {
            if (( typeof struct[ key ] ).toString() != "string") {
                for (var i = 0; i < struct[ key ].length; i++) {
                    data[ k ] = { 'name':extra.name('div.meta-' + box + '-' + index + ' .' + struct[ key ][i]), 'value':extra.val('div.meta-' + box + '-' + index + ' .' + struct[ key ][i]) };
                    k++;
                }
            } else {
                data[ k ] = { 'name':extra.name('div.meta-' + box + '-' + index + ' .' + struct[ key ]), 'value':extra.val('div.meta-' + box + '-' + index + ' .' + struct[ key ]) };
                k++;
            }
        }
    }
    jQuery(document).ready(function () {
        jQuery.post(ajaxurl, { "action":'meta_update', "res":res, "box":box, "post_id":post_id, "data":data, "index":index }, function (result) {
            jQuery('div.layout-a.meta-box.sort-' + res + '-' + box).html(result);
        });
    });
};

meta.edit = function (res, box, post_id, index, selector) {
    jQuery(document).ready(function () {
        jQuery('div.meta-' + box + '-' + index + ' .edit-action').hide();
        jQuery('div.meta-' + box + '-' + index + ' .update-action').show();
        jQuery('div.meta-' + box + '-' + index + ' .fvisible').show();
        jQuery('div.meta-' + box + '-' + index + ' .lvisible').hide();
        init_color_pickers('.generic-meta-color-picker');
    });
};
/*============================ BOF functions for adding custom meta fields ============================*/
function add_cosmo_custom_field(custom_meta, group, topic){
    var unique_class = group+'_'+topic;
    var  label_value = jQuery('input.'+unique_class).val();
    var label_value_no_space=jQuery.trim(label_value).replace(" ","_");
    if( jQuery.trim(label_value).length ){ /*if input is not empty*/
        
        var label_to_add = '<div class="custom-field-holder '+group+'_'+topic+'_'+label_value_no_space+'"><div class="generic-label"><label>'+label_value+'</label></div><div class="generic-field generic-field-text"> <input type="text" name="'+group+'['+topic+']['+jQuery.trim(label_value)+']" value="" class="generic-record  generic-info" /> <a href="javascript:deleteCustomField(\''+group+'\',\''+topic+'\',\''+label_value_no_space+'\')">Delete</a></div>  <div class="clear"></div>  </div>';

        jQuery('div.'+group+'_'+topic).append(label_to_add);
        jQuery('input.'+unique_class).val('');
    }
}

function deleteCustomField(group, topic, label_value){
    /*remove the container*/
    console.log(jQuery('div.custom-field-holder.'+group+'_'+topic+'_'+label_value).attr('class'));
    jQuery('div.custom-field-holder.'+group+'_'+topic+'_'+label_value).remove();
}

jQuery(document).ready(function(){
    /*init sortable for custom meta fields*/
    jQuery("div.custo-container-sortable").sortable({ handle: ".draggable_area" });
});
/*============================ EOF functions for adding custom meta fields ============================*/



/*bulk update the layout meta for posts of a given type*/
function update_post_layout_meta(layout_data, template, post_type, page){

    //console.log(layout_data);

    
    jQuery('.spinner.bulk_update_post_layout').show();
    jQuery.ajax({
        url: MyAjax.ajaxurl,
        data: '&layout='+layout_data+'&action=update_post_layout_meta&template_name='+template+'&post_type='+post_type+'&page='+page,
        type: 'POST',
        cache: false,
        success: function (data) { 
            
            jQuery('.spinner.bulk_update_post_layout').hide();
            if (data > 0) {
                /*if there are too many posts, then we update 150 at a time to avoid timeout, if there are more page, update next page*/
                update_post_layout_meta(layout_data, template, post_type, data);
            }
        },
        error: function (xhr) {
            jQuery('.spinner.bulk_update_post_layout').hide();
            console.log(xhr);
            
        }
    });
    
    //return flase;
}

jQuery(document).ready(function () {
    jQuery('.update_post_layout_meta').click(function (e) {
        // custom handling here
        e.preventDefault();

        var template = jQuery(this).data('template');
        var post_type = jQuery(this).data('post-type');
        var layout_data = jQuery(this).parents('form').serialize();
        update_post_layout_meta(layout_data, template, post_type, 1);
    });
});