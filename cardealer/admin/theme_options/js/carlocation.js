(function() {
    jQuery.fn.life = function(types, data, fn) {
        "use strict";
        jQuery(this.context).on(types, this.selector, data, fn);
        return this;
    };
})();

draw_locations_select(0, 2);

var add_new_country = jQuery('#add_new_country');
var add_new_state = jQuery('#add_new_state');
var add_new_city = jQuery('#add_new_city');

add_new_country.life('click', function(){
    var addtag_fields = jQuery('.addtag_fields');
    var h3='<h3>Add New Country</h3>';
    var add_new_loc=jQuery('#add_new_cars_location');
    var parent_id = 0;
    addtag_fields.find('h3').remove();
    addtag_fields.prepend(h3);
    addtag_fields.fadeIn(400);    
    add_new_loc.attr('data-type','country');
    return false;
});

add_new_state.life('click', function(){
    var addtag_fields = jQuery('.addtag_fields');
    var h3='<h3>Add New State</h3>';
    var add_new_loc=jQuery('#add_new_cars_location');
    var parent_id = jQuery('#tax_carlocation2').val();
    if (parent_id!=undefined){
        addtag_fields.find('h3').remove();
        addtag_fields.prepend(h3);
        addtag_fields.fadeIn(400);    
        add_new_loc.attr('data-type','state');
    }else{
        show_info_popup('Please add any countries!');
    }    
    return false;
});

add_new_city.life('click', function(){
    var addtag_fields = jQuery('.addtag_fields');
    var h3='<h3>Add New City</h3>';    
    var add_new_loc=jQuery('#add_new_cars_location');
    var parent_id = jQuery('#tax_carlocation3').val();
       
    if (parent_id!=undefined){
        addtag_fields.find('h3').remove();
        addtag_fields.prepend(h3);
        addtag_fields.fadeIn(400);    
        add_new_loc.attr('data-type','city');
    }
    else{
        show_info_popup('Please add any states!');
    }   
    return false;
});

var carlocation1 = jQuery('#tax_carlocation1'); 
carlocation1.change(function() {    
    draw_locations_select(jQuery(this).val(), 2);
});

jQuery('#tax_carlocation2').life('change', function() {
    draw_locations_select(jQuery(this).val(), 3);
});

jQuery('#add_new_cars_location').life('click', function() {
    var $this=jQuery(this),
        parent_id,
        type=$this.attr('data-type'),
        country_select_val = jQuery('#tax_carlocation2').val(),
        state_select_val = jQuery('#tax_carlocation3').val(),
        name = jQuery('#tag-name').val(),
        slug = jQuery('#tag-slug').val();
 
    if (name == '') {
         show_info_popup(lang_add_location_error1);
    }
    else {
        
        switch (type) {
            case 'state':
                if (country_select_val == '') {
                    show_info_popup(lang_add_location_error2);
                    return false;
                }
                parent_id = country_select_val;
                break;
            case 'city' :
                if (state_select_val == '') {
                    show_info_popup(lang_add_location_error3);
                    return false;
                }
                parent_id = state_select_val;
                break;
            case 'country' :
                parent_id = 0;
                break;
        }
        
        var data = {
            action: "add_new_cars_location",
            name: name,
            slug: slug,
            parent_id: parent_id
        };
        jQuery.post(ajaxurl, data, function(response) {
            var wrap=jQuery('#col-right .wrap');
            wrap.empty();
            response = response.replace(/wp-admin\/admin-ajax.php\?/g, "wp-admin/edit.php?post_type=car&page=tmm_cardealer_carlocation&");
            wrap.append(response);
            show_info_popup('New cars location successfully added!');
        });
    }

    return false;
});

jQuery('.delete-tag').life('click', function(){
   var $this = jQuery(this);  
   var id = $this.data('id');
   var data = {
       action:"delete_cars_location",       
       id : id
   }; 
   if (confirm('Do you really want to delete car location?')) {
        jQuery.post(ajaxurl, data, function(response){
       var wrap=jQuery('#col-right .wrap');
       wrap.empty();
       response = response.replace(/wp-admin\/admin-ajax.php\?/g, "wp-admin/edit.php?post_type=car&page=tmm_cardealer_carlocation&");
       wrap.append(response);
       show_info_popup('Car location successfully deleted!');
   });
}   
});

jQuery('.editinline').life('click', function(){    
    var $this=jQuery(this);
    var inline_block=jQuery('#inline_edit');
    var id =$this.data('id');
    var name = $this.data('name');
    var slug = $this.data('slug');
    var current_row=jQuery('#record_'+id);    
    var all_records=jQuery('#the-list tr');
    var cancel = jQuery('.tag_edit_cancel');    
    var update = jQuery('.tag_edit_update');  
    all_records.fadeIn(300);
    inline_block.hide().insertAfter(current_row).fadeOut().fadeIn(500);
    current_row.fadeOut(100);
    name = jQuery.trim(name);
    name = name.replace(/^—\s?/g, '').replace(/^—\s?/g, '');
    inline_block.find('input[name="name"]').val(name);    
    inline_block.find('input[name="slug"]').val(slug);    
    cancel.attr('data-id',id);
    update.attr('data-id',id);
});

jQuery('.tag_edit_cancel').life('click', function(){
    var $this=jQuery(this);
    var id=$this.attr('data-id');
    var current_row=jQuery('#record_'+id);    
    current_row.fadeIn(300);
    var inline_block=jQuery('#inline_edit');    
    var inline_table=jQuery('#inline_edit_table');
    inline_table.append(inline_block);
    
});

jQuery('.tag_edit_update').life('click', function(){
    var $this=jQuery(this);
    var id=$this.attr('data-id');    
    var name=jQuery('#inline_edit input[name="name"]').attr('value');
    var slug=jQuery('#inline_edit input[name="slug"]').val();        
    var data={
        action: "update_cars_location",
        id: id,
        name: name,
        slug: slug
    };
    jQuery.post(ajaxurl, data, function(response){
        var inline_block=jQuery('#inline_edit');
        var current_row=jQuery('#record_'+id);
        var inline_table=jQuery('#inline_edit_table');
        inline_table.append(inline_block);        
        current_row.fadeIn(300);
        var wrap=jQuery('#col-right .wrap');
        wrap.empty();
        response = response.replace(/wp-admin\/admin-ajax.php\?/g, "wp-admin/edit.php?post_type=car&page=tmm_cardealer_carlocation&");
        wrap.append(response);
        show_info_popup('Car location successfully updated!');
    });
});

jQuery('#doaction').life('click', function() {
   do_action_delete('');
});
jQuery('#doaction2').life('click', function() {
   do_action_delete('2');
});

function do_action_delete(k) {
    var action_name = jQuery('select[name="action'+ k +'"]').val();
    var checkbox = jQuery('.check-column>input:checked');
    var ids = [];
    var count = 0;
    checkbox.each(function() {
        var $this = jQuery(this);
        ids += $this.val() + ',';
        count += 1;
    });

    if (action_name == 'delete') {
        if (confirm('Do you really want to delete ' + count + ' car locations?')) {
            var data = {
                action: "doaction_delete_cars_locations",
                ids: ids
            };
            jQuery.post(ajaxurl, data, function(response) {
                var wrap = jQuery('#col-right .wrap');
                wrap.empty();
                response = response.replace(/wp-admin\/admin-ajax.php\?/g, "wp-admin/edit.php?post_type=car&page=tmm_cardealer_carlocation&");
                wrap.append(response);
                show_info_popup('Car locations successfully deleted!');
            });

        }
    }
}

function draw_locations_select(parent_id, id) {
    var locations = [0, 0, 0],
        locations_max_level = 3,
        select_cont = jQuery('#tax_carlocation_container' + id);
    if(parent_id !== ''){
        var data = {
            action: "app_cardealer_draw_locations_select",
            name: 'car_carlocation[]',
            id: 'tax_carlocation' + id,
            hide_empty: 0,
            parent_id: parent_id,
            selected: locations[id - 1]
        };
        jQuery.post(ajaxurl, data, function(responce) {
            select_cont.html(responce);
            if (locations_max_level >= 3) {
                if (id == 2) {
                    draw_locations_select(jQuery('#tax_carlocation2').val(), 3);
                }
            }       
        });
    }else{
        select_cont.empty();
        if(id === 2){
            jQuery('#tax_carlocation_container3').empty();
        }
    }
}

jQuery('#del_carlocation_select1').life('change', function() {
    draw_locations_select2(jQuery(this).val(), 2);
});

jQuery('#del_carlocation_select2').life('change', function() {
    draw_locations_select2(jQuery(this).val(), 3);
});

jQuery('#delete_location_button').life('click', function() {
    var country = jQuery('#del_carlocation_select1'),
        state = jQuery('#del_carlocation_select2'),
        city = jQuery('#del_carlocation_select3'),
        id = 0,
        action = '',
        name = '';
        
    if(city.val() != ''){
        id = city.val();
        action = 'doaction_delete_cars_locations';
        name = city.find('option').filter(':selected').text();
    }else if(state.val() != ''){
        id = state.val();
        action = 'doaction_delete_cars_state';
        name = state.find('option').filter(':selected').text();
    }else if(country.val() != ''){
        id = country.val();
        action = 'doaction_delete_cars_country';
        name = country.find('option').filter(':selected').text();
    }
    
    if (id != 0 && action != '' && confirm('Do you really want to delete ' + name + ' car location?')) {
        show_static_info_popup(lang_loading);
        var data = {
            action: action,
            ids: id
        };
        jQuery.post(ajaxurl, data, function(response) {
            var wrap = jQuery('#col-right .wrap');
            wrap.empty();
            response = response.replace(/wp-admin\/admin-ajax.php\?/g, "wp-admin/edit.php?post_type=car&page=tmm_cardealer_carlocation&");
            wrap.append(response);
            draw_locations_select(0, 2);
            draw_locations_select2(0, 1);
            clear_select(jQuery('#del_carlocation2'));
            clear_select(jQuery('#del_carlocation3'));
            hide_static_info_popup();
            show_info_popup('Car locations successfully deleted!');
        });

    }
});

function draw_locations_select2(parent_id, level) {
    var locations = [0, 0, 0],
        locations_max_level = 3,
        select_cont = jQuery('#del_carlocation' + level);
    if(parent_id !== ''){
        var data = {
            action: "app_cardealer_draw_locations_select",
            name: 'car_carlocation[]',
            id: 'del_carlocation_select'+level,
            hide_empty: 0,
            parent_id: parent_id,
            selected: locations[level - 1]
        };
        jQuery.post(ajaxurl, data, function(responce) {
            select_cont.html(responce);
            if (locations_max_level >= 3) {
                if (level == 2) {
                    draw_locations_select2(jQuery('#del_carlocation2').val(), 3);
                }
            }       
        });
    }else{
        clear_select(select_cont);
        if(level === 2){
            clear_select(jQuery('#del_carlocation3'))
        }
    }
}

function clear_select(select_cont) {
    var select = select_cont.find('select'),
        default_option = select.find('option:first');
    select.empty().append(default_option);
}
