/* global confirm, redux, redux_change */
jQuery(document).ready(function($) {
	$("#berg_contact_type-select").on('change', function(){
		if(this.value == 'contact1') {
			$('.contact-list-field').hide();
		} else {
			$('.contact-list-field').show();
		}

	}).change();
	/* adding info */
	$('#add-new-contact-info').on('click', function(){
		var contact_name = $('#contact_name').val(),
			// contact_pos = $('#contact_pos').val(),
			contact_desc = tinyMCE.get('contact_desc').getContent({format: 'raw'}),
			// social_icon_picker = $('#icon-content').val(),
			// social_icon_image = $('#icon-img-url').val(),
			last_val = $('#contact-string').val(),
			result = '',
			// social_icon,
			contact_data;
		contact_desc = contact_desc.replace(/"/g, '&quot;');
		// contact_desc = contact_desc.replace("'", "\'");
		// if ( $('#icon-manager-select').val() === 'iconpicker' ) {
		// 	social_icon = social_icon_picker;
		// } else {
		// 	social_icon = social_icon_image;
		// }

		if (!Date.now) {
			Date.now = function now() {
				return new Date().getTime();
			};
		}

		contact_data = { 'contact_name': contact_name, 'contact_desc': contact_desc, 'id':  Date.now().toString() };
		// console.log(contact_data);
		if ( last_val !== '' ){
			last_val += '|x;|'+returnJasonStr(contact_data);
		} else {
			last_val += returnJasonStr(contact_data);
		}
		
		$('#contact-string').val(last_val);
		
		clearFields();

		result += '<li class="contact-item" id="'+ contact_data.id +'">'+
		'<div class="contact-item-wrapper">'+
		// '<div class="contact-content">'+
		// '<div class="icon-wrapper pull-left">'+ returnProperIcon(social_data.soc_icon_str) +'</div>'+
		'<p class="contact-name"><span>Header: </span>'+ contact_data.contact_name +'</p>'+
		// '</div>'+
		// '<p class="contact-pos"><span>Position: </span>'+ contact_data.contact_pos +'</p>'+
		'<div class="contact-desc"><span>Info: </span>'+ contact_data.contact_desc +'</div></div>'+
		'<a href="javascript:void(0);" data-id="'+ contact_data.id + '" class="button-secondary remove-contact-item pull-right">'+ php_data.btn_name +'</a>'+
		'</li>';
		$('#contact-items-sorting').append(result);
		removeItem();
		sortItemesInit();

	});

	removeItem();
	
	/* return JSON string */
	function returnJasonStr(obj){
		var str_id = obj.id,
			obj_str = '{ "'+ str_id +'": [{ "name": "'+ obj.contact_name +'", "desc": "'+ obj.contact_desc +'"}]}';
		return obj_str;
	}

	/* clear fields */
	function clearFields() {
		$('#contact_name').val('');
		tinyMCE.get('contact_desc').setContent('');

		// $('.icon-prev i').text('');
		// $('.icon-image-option').remove();
	}
	
	/* checking icon type and return proper string */
	// function returnProperIcon(icon_str){
	// 	var result = '',
	// 		url_pattern = /^(ftp|http|https):\/\//;
	// 	if ( url_pattern.test(icon_str) ) {
	// 		result += '<img class="soc-icon-img" src="'+ icon_str +'">';
	// 	} else {
	// 		result += '<i class="'+icon_str+'"></i>';
	// 	}
	// 	return result;
	// }

	/* sorting items */
	$('#contact-items-sorting').sortable({
		placeholder: "sortable-placeholder",
		update: function( event, ui) {
			sortItemesInit();
		}
	});
	
	/* sort init */
	function sortItemesInit() {
		var sort_string = $('#contact-items-sorting').sortable('toArray').toString();
		$('#contact_info').val(sort_string);
	}

	/* delete value item */
	function deleteValue(id) {

		var str_val = $('#contact-string').val(),
			arr_str = str_val.split('|x;|'),
			result_str = '',
			index;
		
		for ( index = 0; index < arr_str.length; index++ ) {
			if ( JSON.parse(arr_str[index]).hasOwnProperty(id) ) {
				arr_str.splice(index,1);
				break;
			}
		}
		result_str = arr_str.join('|x;|');
		$('#contact-string').val(result_str);
	}

	/* remove item */
	function removeItem(){
		$('.remove-contact-item').on('click', function(){
			var item_id = $(this).data('id');
			deleteValue(item_id);
			$('#'+item_id).remove();
			sortItemesInit();
		});
	}
	
});
